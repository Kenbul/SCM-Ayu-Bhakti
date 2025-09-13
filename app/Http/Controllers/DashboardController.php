<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Item;
use App\Models\IncomingGoods;
use App\Models\OutgoingGoods;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'suppliers' => Supplier::count(),
            'items' => Item::count(),
            'incoming' => IncomingGoods::whereMonth('date_in', now()->month)->sum('quantity'),
            'outgoing' => OutgoingGoods::whereMonth('date_out', now()->month)->sum('quantity'),
        ];

        // Barang dengan stok menipis
        $lowStockItems = Item::whereColumn('stock', '<=', 'min_stock')->get(['id', 'name', 'stock', 'min_stock']);

        // Barang kadaluarsa atau akan kadaluarsa dalam 7 hari
        $expiringItems = Item::whereNotNull('expired_at')
            ->whereDate('expired_at', '<=', now()->addDays(7))
            ->get(['id', 'name', 'expired_at']);

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'lowStockItems' => $lowStockItems,
            'expiringItems' => $expiringItems,
        ]);
    }
}
