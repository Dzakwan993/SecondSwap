<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'receiver_id',
        'product_id', // Add product_id here
        'status', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}