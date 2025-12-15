<?php

// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi lewat create() atau fill()
    protected $fillable = [
        'user_id',
        'name',
        'type',     // income, expense, saving
    ];

    // Relasi: satu kategori punya satu user (owner)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: satu kategori bisa dipakai banyak transaksi (nanti kalau butuh)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Scope biar gampang ambil kategori per tipe (contoh: Category::income()->get())
    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    public function scopeSaving($query)
    {
        return $query->where('type', 'saving');
    }

    // Scope buat ambil hanya milik user yang login
    public function scopeMine($query)
    {
        return $query->where('user_id', auth()->id());
    }
}