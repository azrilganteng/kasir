<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;


class TransactionController extends Controller
{
    // Fungsi lainnya...

    public function rekap(Request $request)
    {
        // Mendapatkan filter (bisa harian, bulanan, atau tahunan)
        $filterType = $request->input('filter_type', 'daily');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Default filter berdasarkan tanggal hari ini
        $query = Transaction::query();
        
        if ($filterType == 'daily') {
            $query->whereDate('transaction_date', Carbon::today());
        } elseif ($filterType == 'monthly') {
            $query->whereMonth('transaction_date', Carbon::now()->month);
        } elseif ($filterType == 'custom') {
            $query->whereBetween('transaction_date', [$startDate, $endDate]);
        }

        // Mendapatkan data transaksi
        $transactions = $query->with('details.product')->get();

        // Rekap data penjualan
        $totalSales = $transactions->sum('total_price');
        $totalTransactions = $transactions->count();
        $bestSellingProducts = TransactionDetail::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->take(5)
            ->with('product')
            ->get();

        // Return ke view dengan data rekap
        return view('kasir.rekap', compact('totalSales', 'totalTransactions', 'bestSellingProducts', 'transactions'));
    }
}
