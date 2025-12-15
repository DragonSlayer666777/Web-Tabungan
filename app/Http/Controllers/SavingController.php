<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\SavingTransaction;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function index()
    {
        $savings = Saving::mine()->with('transactions')->orderBy('created_at', 'desc')->get();
        
        return view('savings.index', compact('savings'));
    }

    public function create()
    {
        return view('savings.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
            'frequency' => 'required|in:daily,weekly,monthly',
            'min_amount' => 'required|numeric|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'target_amount', 'frequency', 'min_amount', 'description']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/target', 'public');
        }

        Saving::create($data);

        return redirect()->route('dashboard')->with('success', 'Target nabung berhasil dibuat!');
    }

    public function show(Saving $saving)
    {
        $saving->load('transactions');
        return view('savings.show', compact('saving'));
    }

    public function addTransaction(Saving $saving, Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            //'note' => 'nullable|string',
        ]);

        SavingTransaction::create([
            'saving_id' => $saving->id,
            'amount' => $request->amount,
            'date' => $request->date,
            //'note' => $request->note,
        ]);

        return redirect()->route('savings.show', $saving)->with('success', 'Setoran tabungan berhasil ditambahkan.');
    }

}