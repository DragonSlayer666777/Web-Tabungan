<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Transaction;
use App\Models\Saving;
use App\Models\Debt;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'theme',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
    'email_verified_at' => 'datetime',
    'notification_enabled' => 'boolean',
    'notification_debt_reminder' => 'boolean',
    'notification_saving_reminder' => 'boolean',
    ];
    public function isDarkMode(): bool
{
    return $this->theme === 'dark';
}
public function getBalanceAttribute(): float
{
    $income   = Transaction::mine()
                 ->whereHas('category', fn($q) => $q->where('type', 'income'))
                 ->sum('amount');

    $expense  = Transaction::mine()
                 ->whereHas('category', fn($q) => $q->where('type', 'expense'))
                 ->sum('amount');

    $saving   = Saving::mine()->sum('current_amount');

    $debt     = Debts::mine()
                 ->where('type', 'debt')
                 ->where('is_paid', false)
                 ->sum('amount');

    $receivable = Debts::mine()
                 ->where('type', 'receivable')
                 ->where('is_paid', false)
                 ->sum('amount');

    return ($income + $receivable) - ($expense + $saving + $debt);
}
public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
