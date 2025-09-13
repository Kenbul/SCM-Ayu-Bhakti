<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingGoods extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'quantity',
        'date_out',
        'destination',
        'user_id',
    ];

    // Relasi: Barang keluar milik 1 item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Relasi: Barang keluar diinput oleh user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
