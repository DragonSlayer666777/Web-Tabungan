<?php
// app/Models/DebtTransaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtsTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['debt_id', 'amount', 'date', 'note'];
    protected $dates = ['date'];

    public function debt()
    {
        return $this->belongsTo(Debts::class);
    }

    // Otomatis update paid_amount + cek lunas atau belum
    protected static function booted()
    {
        static::created(function ($transaction) {
            $debt = $transaction->debt;
            $debt->increment('paid_amount', $transaction->amount);

            if ($debt->paid_amount >= $debt->amount) {
                $debt->update(['is_paid' => true]);
            }
        });

        static::deleted(function ($transaction) {
            $debt = $transaction->debt;
            $debt->decrement('paid_amount', $transaction->amount);
            $debt->update(['is_paid' => false]);
        });
    }
}