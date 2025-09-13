<?php

namespace App\Http\Controllers;

use App\Models\IncomingGoods;
use App\Models\Supplier;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class IncomingGoodsController extends Controller
{
    public function index()
    {
        $goods = IncomingGoods::with(['supplier', 'item'])
            ->orderBy('date_in', 'desc')
            ->paginate(10);

        return Inertia::render('IncomingGoods/Index', [
            'goods' => $goods,
        ]);
    }

    public function create()
    {
        return Inertia::render('IncomingGoods/Create', [
            'suppliers' => Supplier::all(),
            'items' => Item::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'date_in' => 'required|date',
        ]);

        // Tambahkan user yang sedang login
        $data['user_id'] = Auth::id();

        // Simpan barang masuk
        $incoming = IncomingGoods::create($data);

        // Update stok barang
        $incoming->item->increment('stock', $incoming->quantity);

        return redirect()->route('incoming-goods.index')
            ->with('success', 'Barang masuk berhasil dicatat.');
    }

    public function edit(IncomingGoods $incoming_good)
    {
        return Inertia::render('IncomingGoods/Edit', [
            'incoming_good' => $incoming_good->load(['supplier', 'item']),
            'suppliers' => Supplier::all(),
            'items' => Item::all(),
        ]);
    }

    public function update(Request $request, IncomingGoods $incoming_good)
    {
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'date_in' => 'required|date',
        ]);

        // Kembalikan stok lama
        $incoming_good->item->decrement('stock', $incoming_good->quantity);

        // Update data
        $incoming_good->update($data);

        // Tambahkan stok baru
        $incoming_good->item->increment('stock', $data['quantity']);

        return redirect()->route('incoming-goods.index')
            ->with('success', 'Barang masuk berhasil diperbarui.');
    }

    public function destroy(IncomingGoods $incoming_good)
    {
        // Kurangi stok saat data dihapus
        $incoming_good->item->decrement('stock', $incoming_good->quantity);

        $incoming_good->delete();

        return redirect()->route('incoming-goods.index')
            ->with('success', 'Data barang masuk berhasil dihapus.');
    }
}
