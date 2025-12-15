<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Default bulan ini
        $month = $request->get('month', now()->month);
        $year  = $request->get('year', now()->year);

        $startDate = Carbon::create($year, $month, 1);
        $endDate   = $startDate->copy()->endOfMonth();

        // Ambil data harian pemasukan & pengeluaran
        $dailyData = Transaction::query()
            ->selectRaw('DAY(date) as day, 
                        SUM(CASE WHEN categories.type = "income" THEN amount ELSE 0 END) as income,
                        SUM(CASE WHEN categories.type = "expense" THEN amount ELSE 0 END) as expense')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.user_id', auth()->id())  // INI YANG DIPERBAIKI
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->groupByRaw('DAY(date)')
            ->orderBy('day')
            ->get();

        // Isi data lengkap 1-31 hari (biar grafik mulus)
        $incomeData  = [];
        $expenseData = [];
        $labels      = [];

        for ($day = 1; $day <= $endDate->day; $day++) {
            $labels[] = $day;
            $record = $dailyData->firstWhere('day', $day);

            $incomeData[]  = $record ? $record->income : 0;
            $expenseData[] = $record ? $record->expense : 0;
        }

        return view('report.index', compact('incomeData', 'expenseData', 'labels', 'month', 'year', 'startDate'));
    }
}