<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'stock',
        'price',
        'expired_at',
    ];

    // Relasi: Barang punya banyak barang masuk
    public function incomingGoods()
    {
        return $this->hasMany(IncomingGoods::class);
    }

    // Relasi: Barang punya banyak barang keluar
    public function outgoingGoods()
    {
        return $this->hasMany(OutgoingGoods::class);
    }
}
