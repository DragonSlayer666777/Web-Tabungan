<?php
// app/Models/Saving.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'target_amount',
        'current_amount',
        'deadline',
        'description',
    ];

    protected $dates = ['deadline', 'created_at', 'updated_at'];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(SavingTransaction::class);
    }

    // Accessor: persentase progres
    public function getProgressAttribute()
    {
        if ($this->target_amount <= 0) return 0;
        return round(($this->current_amount / $this->target_amount) * 100, 2);
    }

    // Accessor: sisa yang harus ditabung
    public function getRemainingAttribute()
    {
        return $this->target_amount - $this->current_amount;
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', auth()->id());
    }
    public function getRemainingTimeAttribute()
    {
        // Jika target sudah tercapai
        if ($this->current_amount >= $this->target_amount) {
            return 'Target Sudah Tercapai!';
        }

        // Jika min_amount 0 atau belum diisi → kasih pesan aman
        if (!$this->min_amount || $this->min_amount <= 0) {
            return 'Belum ada rencana pengisian';
        }

        $remaining = $this->target_amount - $this->current_amount;
        $days = ceil($remaining / $this->min_amount);

        // Sesuaikan dengan frekuensi
        if ($this->frequency === 'weekly') {
            $days *= 7;
        } elseif ($this->frequency === 'monthly') {
            $days *= 30; // perkiraan
        }

        // Format cantik
        if ($days <= 0) {
            return 'Hampir Tercapai!';
        } elseif ($days == 1) {
            return '1 Hari Lagi';
        } else {
            return "$days Hari Lagi";
        }
    }
}