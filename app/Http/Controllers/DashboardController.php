<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Saving;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        // 1. Pemasukan Bulan Ini
        $pemasukanBulanIni = Transaction::mine()
            ->whereHas('category', fn($q) => $q->where('type', 'income'))
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        // 2. Pengeluaran Bulan Ini
        $pengeluaranBulanIni = Transaction::mine()
            ->whereHas('category', fn($q) => $q->where('type', 'expense'))
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        // 3. Total Tabungan (current_amount dari semua target)
        $totalTabungan = Saving::mine()->sum('current_amount');

        // 4. Transaksi Terakhir (5 terbaru)
        $transaksiTerakhir = Transaction::mine()
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        // 5. Total Saldo (pemasukan - pengeluaran + tabungan + piutang - hutang)
        $saldo = $pemasukanBulanIni - $pengeluaranBulanIni + $totalTabungan;
        $targetNabung = Saving::mine()->latest()->get();

        return view('dashboard', compact(
            'pemasukanBulanIni',
            'pengeluaranBulanIni',
            'totalTabungan',
            'transaksiTerakhir',
            'saldo',
            'targetNabung'
        ));
    }
}