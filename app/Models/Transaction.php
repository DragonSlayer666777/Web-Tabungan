<?php
// app/Models/Transaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'amount',
        'description',
        'date',
    ];

    
    protected $dates = ['date', 'created_at', 'updated_at'];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope biar gampang filter
    public function scopeMine($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeIncome($query)
    {
        return $query->whereHas('category', fn($q) => $q->where('type', 'income'));
    }

    public function scopeExpense($query)
    {
        return $query->whereHas('category', fn($q) => $q->where('type', 'expense'));
    }

    public function scopeSaving($query)
    {
        return $query->whereHas('category', fn($q) => $q->where('type', 'saving'));
    }

    // Scope filter berdasarkan bulan & tahun (super berguna untuk laporan!)
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('date', now()->month)
                     ->whereYear('date', now()->year);
    }

    public function scopeByMonth($query, $year, $month)
    {
        return $query->whereYear('date', $year)->whereMonth('date', $month);
    }
}