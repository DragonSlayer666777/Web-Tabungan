<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;

class MoneyFlowController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'income'); // income | expense | saving

        $categories = Category::mine()
            ->where('type', $type === 'saving' ? 'income' : $type)
            ->get();
        return view('moneyflow.index', compact('categories', 'type'));    

    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'category_id' => 'nullable|exists:categories,id',
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Transaction::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Transaksi berhasil dicatat!');
    }
}