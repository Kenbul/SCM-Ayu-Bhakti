<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'address',
    ];

    // Relasi: Supplier bisa punya banyak barang masuk
    public function incomingGoods()
    {
        return $this->hasMany(IncomingGoods::class);
    }
}
