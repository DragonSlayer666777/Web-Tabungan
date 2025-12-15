<?php
// app/Models/Notification.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'is_read',
        'data',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'data'    => 'array',     // otomatis jadi array di PHP
        'read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope
    public function scopeMine($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Method: tandai sudah dibaca
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    // Method: tandai semua notif user sudah dibaca
    public static function markAllAsRead($userId)
    {
        static::where('user_id', $userId)
              ->where('is_read', false)
              ->update([
                  'is_read' => true,
                  'read_at' => now(),
              ]);
    }
}