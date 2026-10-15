@extends('layouts.app')

@section('title', 'Transaksi Stok')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">Riwayat Pergerakan Stok</h2>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('stock.in') }}" class="btn btn-success">+ Barang Masuk (IN)</a>
            <a href="{{ route('stock.out') }}" class="btn btn-danger">- Barang Keluar (OUT)</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Petugas</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movements as $index => $m)
            <tr>
                <td>{{ $movements->firstItem() + $index }}</td>
                <td>{{ \Carbon\Carbon::parse($m->movement_date)->format('d/m/Y H:i') }}</td>
                <td><strong>{{ $m->product->name ?? '-' }}</strong> <small style="color: #6b7280;">({{ $m->product->sku ?? '' }})</small></td>
                <td>
                    @if($m->type === 'IN')
                        <span style="background-color: #d1fae5; color: #065f46; padding: 3px 8px; border-radius: 4px; font-weight: bold; font-size: 12px;">MASUK (IN)</span>
                    @else
                        <span style="background-color: #fee2e2; color: #991b1b; padding: 3px 8px; border-radius: 4px; font-weight: bold; font-size: 12px;">KELUAR (OUT)</span>
                    @endif
                </td>
                <td style="font-weight: bold;">{{ $m->quantity }}</td>
                <td>{{ $m->user->username ?? '-' }}</td>
                <td>{{ $m->notes ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; color: #6b7280; padding: 20px;">Belum ada riwayat transaksi mutasi stok.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $movements->links() }}
    </div>
</div>
@endsection
