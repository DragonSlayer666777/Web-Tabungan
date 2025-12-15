<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function create()
    {
        $categories = Category::mine()->whereIn('type', ['income', 'expense'])->get();
        
        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        Transaction::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil ditambahkan.');
    }
    public function index(Request $request)
{
    $year = $request->get('year', now()->year);
    $month = $request->get('month', now()->month);

    $transactions = Transaction::mine()
        ->with('category')
        ->when($month, function ($query) use ($year, $month) {
            return $query->whereYear('date', $year)->whereMonth('date', $month);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    // Generate array bulan untuk dropdown
    $months = collect(range(1, 12))->map(function ($monthNumber) {
        return [
            'number' => $monthNumber,
            'name' => date('F', mktime(0, 0, 0, $monthNumber, 1))
        ];
    });

    return view('transactions.index', compact('transactions', 'months', 'year', 'month'));
}
}