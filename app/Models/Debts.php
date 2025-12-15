<?php
// app/Models/Debt.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'person_name',
        'amount',
        'paid_amount',
        'type',        // debt atau receivable
        'due_date',
        'description',
        'is_paid',
    ];

    protected $dates = ['due_date', 'created_at', 'updated_at'];
    protected $casts = ['is_paid' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(DebtsTransaction::class);
    }

    // Accessor
    public function getRemainingAttribute()
    {
        return $this->amount - $this->paid_amount;
    }

    public function getProgressAttribute()
    {
        if ($this->amount <= 0) return 100;
        return round(($this->paid_amount / $this->amount) * 100, 2);
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeDebt($query)
    {
        return $query->where('type', 'debt');
    }

    public function scopeReceivable($query)
    {
        return $query->where('type', 'receivable');
    }

    public function scopeUnpaid($query)
    {
        return $query->where('is_paid', false);
    }
}