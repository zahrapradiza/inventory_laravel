@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">Data Master Produk</h2>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('products.create') }}" class="btn">+ Tambah Produk</a>
        @endif
    </div>

    <!-- Form Pencarian & Filter Asli P4 Teman -->
    <form method="GET" action="{{ route('products.index') }}" style="display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap;">
        <input type="text" name="search" placeholder="Cari nama atau SKU..." value="{{ request('search') }}" style="padding: 8px; border: 1px solid #d1d5db; border-radius: 4px; flex: 2; min-width: 150px;">
        
        <select name="category_id" style="padding: 8px; border: 1px solid #d1d5db; border-radius: 4px; flex: 1; min-width: 150px;">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <select name="sort" style="padding: 8px; border: 1px solid #d1d5db; border-radius: 4px; flex: 1; min-width: 150px;">
            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Urutkan Nama</option>
            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Urutkan Harga</option>
            <option value="stock" {{ request('sort') == 'stock' ? 'selected' : '' }}>Urutkan Stok</option>
        </select>

        <button type="submit" class="btn" style="background-color: #4b5563;">Filter</button>
        <a href="{{ route('products.index') }}" class="btn" style="background-color: #9ca3af;">Reset</a>
    </form>

    <!-- Tabel Produk Asli P4 Teman -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>SKU</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Min. Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $prod)
            <tr>
                <td>{{ $products->firstItem() + $index }}</td>
                <td><strong>{{ $prod->sku }}</strong></td>
                <td>{{ $prod->name }}</td>
                <td>{{ $prod->category->name ?? '-' }}</td>
                <td>Rp {{ number_format($prod->price, 0, ',', '.') }}</td>
                <td>
                    @if($prod->stock <= $prod->minimum_stock)
                        <span style="color: #dc2626; font-weight: bold;">{{ $prod->stock }} (Menipis!)</span>
                    @else
                        {{ $prod->stock }}
                    @endif
                </td>
                <td>{{ $prod->minimum_stock }}</td>
                <td>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('products.edit', $prod->id) }}" style="color: #2563eb; text-decoration: none; margin-right: 10px;">Edit</a>
                        <form action="{{ route('products.destroy', $prod->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #dc2626; cursor: pointer; padding: 0; font-size: 14px;">Hapus</button>
                        </form>
                    @else
                        <span style="color: #9ca3af; font-size: 12px;">Hanya Lihat</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; color: #6b7280; padding: 20px;">Belum ada data produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $products->links() }}
    </div>
</div>
@endsection
