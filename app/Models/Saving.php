<?php


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
        'image',
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
        
        if ($this->current_amount >= $this->target_amount) {
            return 'Target Sudah Tercapai!';
        }

        
        if (!$this->min_amount || $this->min_amount <= 0) {
            return 'Belum ada rencana pengisian';
        }

        $remaining = $this->target_amount - $this->current_amount;
        $days = ceil($remaining / $this->min_amount);

        
        if ($this->frequency === 'weekly') {
            $days *= 7;
        } elseif ($this->frequency === 'monthly') {
            $days *= 30; 
        }

       
        if ($days <= 0) {
            return 'Hampir Tercapai!';
        } elseif ($days == 1) {
            return '1 Hari Lagi';
        } else {
            return "$days Hari Lagi";
        }
    }
    public function getImageUrlAttribute()
    {
    return $this->image ? asset('storage/' . $this->image) : asset('images/default.png');
    }
}