<?php

namespace App\Http\Controllers;


use App\Models\Item;
use App\Models\OutgoingGoods;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class OutgoingGoodsController extends Controller
{
    public function index()
    {
        $goods = OutgoingGoods::with(['item', 'user'])
            ->orderBy('date_out', 'desc')
            ->paginate(10);

        return Inertia::render('OutgoingGoods/Index', [
            'goods' => $goods,
        ]);
    }

    public function create()
    {
        return Inertia::render('OutgoingGoods/Create', [
            'items' => Item::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'date_out' => 'required|date',
            'destination' => 'nullable|string|max:255',
        ]);

        $data['user_id'] = Auth::id();

        $outgoing = OutgoingGoods::create($data);

        // Kurangi stok barang
        $outgoing->item->decrement('stock', $outgoing->quantity);

        return redirect()->route('outgoing-goods.index')
            ->with('success', 'Barang keluar berhasil dicatat.');
    }

    public function edit(OutgoingGoods $outgoing_good)
    {
        return Inertia::render('OutgoingGoods/Edit', [
            'outgoing_good' => $outgoing_good->load('item'),
            'items' => Item::all(),
        ]);
    }

    public function update(Request $request, OutgoingGoods $outgoing_good)
    {
        $data = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'date_out' => 'required|date',
            'destination' => 'nullable|string|max:255',
        ]);

        // Kembalikan stok lama
        $outgoing_good->item->increment('stock', $outgoing_good->quantity);

        // Update data
        $outgoing_good->update($data);

        // Kurangi stok baru
        $outgoing_good->item->decrement('stock', $data['quantity']);

        return redirect()->route('outgoing-goods.index')
            ->with('success', 'Barang keluar berhasil diperbarui.');
    }

    public function destroy(OutgoingGoods $outgoing_good)
    {
        // Kembalikan stok saat data dihapus
        $outgoing_good->item->increment('stock', $outgoing_good->quantity);

        $outgoing_good->delete();

        return redirect()->route('outgoing-goods.index')
            ->with('success', 'Data barang keluar berhasil dihapus.');
    }
}
