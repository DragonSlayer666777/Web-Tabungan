<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month');
        $year  = $request->get('year', now()->year);
        $search = $request->get('search');

        $transactions = Transaction::mine()
            ->with('category')
            ->when($month, fn($q) => $q->whereMonth('date', $month))
            ->when($year, fn($q) => $q->whereYear('date', $year))
            ->when($search, function($q) use ($search) {
                $q->where(function($q2) use ($search) {
                    $q2->where('description', 'like', "%{$search}%")
                    ->orWhereHas('category', fn($q3) =>
                            $q3->where('name', 'like', "%{$search}%")
                    );
                });
            })
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();


        return view('riwayat.index', compact('transactions', 'month', 'year'));
    }
}