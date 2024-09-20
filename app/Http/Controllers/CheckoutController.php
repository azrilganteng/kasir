<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon; 
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // Validasi data yang dikirim dari frontend
    $validated = $request->validate([
        'items' => 'required|array',
        'total_price' => 'required|numeric',
    ]);

    // Simpan data transaksi ke tabel 'transactions'
    $transaction = Transaction::create([
        'total_price' => $validated['total_price'],
        'transaction_date' => Carbon::now(), // Menggunakan waktu saat ini
    ]);

    // Simpan detail transaksi ke tabel 'transaction_details'
    foreach ($validated['items'] as $item) {
        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'product_name' => $item['name'],
            'price' => $item['price'],
        ]);
    }

    // Simpan data transaksi ke session (opsional)
    session(['nota_items' => $validated['items'], 'nota_total_price' => $validated['total_price']]);

    // Kembalikan response JSON yang mengarah ke route 'kasir.nota'
    return response()->json([
        'message' => 'Checkout berhasil!',
        'redirect_url' => route('kasir.nota')
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
