@extends('layouts.kasir')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Rekap Penjualan</h2>

        {{-- Form Filter --}}
        <form method="GET" action="{{ route('kasir.rekap') }}" class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="filter_type" class="block text-sm font-medium text-gray-700 mb-2">Pilih Filter</label>
                    <select name="filter_type" id="filter_type" class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="daily">Harian</option>
                        <option value="monthly">Bulanan</option>
                        <option value="custom">Custom Tanggal</option>
                    </select>
                </div>

                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                    <input type="date" name="end_date" id="end_date" class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Filter
                </button>
            </div>
        </form>

        {{-- Kartu Ringkasan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Total Penjualan</h3>
                <p class="text-3xl font-bold text-green-600">Rp{{ number_format($totalSales, 0, ',', '.') }}</p>
            </div>

            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Jumlah Transaksi</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $totalTransactions }}</p>
            </div>
        </div>

        {{-- Tabel Produk Terlaris --}}
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Produk Terlaris</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Terjual</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($bestSellingProducts as $productDetail)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $productDetail->product->name }}</td>
                            <td class="py-4 px-6 text-sm text-gray-600">{{ $productDetail->total_quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
