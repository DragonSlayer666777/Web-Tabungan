<?php
// app/Models/SavingTransaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'saving_id',
        'amount',
        'date',
        'note',
    ];

    protected $dates = ['date'];

    public function savings()
    {
        return $this->belongsTo(Saving::class);
    }

protected static function booted()
{
    static::created(function ($transaction) {
        $transaction->saving->increment('current_amount', $transaction->amount);
    });

    static::deleted(function ($transaction) {
        $transaction->saving->decrement('current_amount', $transaction->amount);
    });
}
}