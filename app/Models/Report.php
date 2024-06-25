<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'reason', 'status']; // Tambahkan 'status' ke dalam fillable

    // Relasi ke model User (pengguna)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Product (produk)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
