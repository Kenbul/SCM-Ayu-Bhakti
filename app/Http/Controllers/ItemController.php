<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    // Tampilkan daftar barang
    public function index(Request $request)
    {
        // Ambil query filter
        $search   = $request->input('search');
        $category = $request->input('category');

        // Query dengan filter
        $items = Item::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            })
            ->when($category, function ($query, $category) {
                $query->where('category', $category);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10) // tampil 10 per halaman
            ->withQueryString(); // biar query filter tetap saat ganti halaman

        // Ambil kategori unik untuk dropdown
        $categories = Item::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');

        return Inertia::render('Items/Index', [
            'items'      => $items,
            'filters'    => [
                'search' => $search,
                'category' => $category,
            ],
            'categories' => $categories,
        ]);
    }


    // Tampilkan form create
    public function create()
    {
        return Inertia::render('Items/Create');
    }

    // Simpan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'category'  => 'nullable|string|max:100',
            'stock'     => 'required|integer|min:0',
            'price'     => 'required|numeric|min:0',
            'expired_at' => 'nullable|date',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit(Item $item)
    {
        return Inertia::render('Items/Edit', [
            'item' => $item
        ]);
    }

    // Update barang
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'category'  => 'nullable|string|max:100',
            'stock'     => 'required|integer|min:0',
            'price'     => 'required|numeric|min:0',
            'expired_at' => 'nullable|date',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    // Hapus barang
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}
