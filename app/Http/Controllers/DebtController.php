<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Debts;
use App\Models\DebtTransaction;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function index()
    {
        $debts = Debt::mine()
            ->with('transactions')
            ->orderBy('is_paid')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('debts.index', compact('debts'));
    }

    public function create()
    {
        return view('debts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'person_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:debt,receivable',
            'due_date' => 'nullable|date|after:today',
            'description' => 'nullable|string',
        ]);

        Debts::create([
            'user_id' => auth()->id(),
            'person_name' => $request->person_name,
            'amount' => $request->amount,
            'type' => $request->type,
            'due_date' => $request->due_date,
            'description' => $request->description,
        ]);

        $typeText = $request->type === 'debt' ? 'hutang' : 'piutang';
        return redirect()->route('debts.index')->with('success', "Hutang/Piutang kepada {$request->person_name} berhasil dicatat.");
    }

    public function show(Debts $debt)
    {
        $debt->load('transactions');
        return view('debts.show', compact('debt'));
    }

    public function addTransaction(Debts $debt, Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01|max:' . $debt->remaining,
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        DebtTransaction::create([
            'debt_id' => $debt->id,
            'amount' => $request->amount,
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return redirect()->route('debts.show', $debt)->with('success', 'Pembayaran/cicilan berhasil ditambahkan.');
    }
}