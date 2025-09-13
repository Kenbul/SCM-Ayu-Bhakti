<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingGoods extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'supplier_id',
        'quantity',
        'date_in',
        'user_id',
    ];

    // Relasi: Barang masuk milik 1 item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Relasi: Barang masuk milik 1 supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relasi: Barang masuk diinput oleh user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
