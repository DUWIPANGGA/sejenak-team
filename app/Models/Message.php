<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'sender_id',
        'content',
        'type'
    ];

    protected $casts = [
        'type' => 'string'
    ];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}