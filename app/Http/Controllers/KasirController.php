<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function tambahProduk(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_price' => 'required|numeric',
        ]);

        // Temukan produk berdasarkan ID
        $product = Product::find($request->input('product_id'));

        // Cek apakah stok produk cukup
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Stok produk habis!');
        }

        // Simpan produk yang dipilih dalam session
        $cart = session()->get('cart', []);
        $productId = $product->id;
        $productPrice = $request->input('product_price');

        // Tambah produk ke cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $productPrice,
                'quantity' => 1,
            ];
        }

        // Kurangi stok produk
        $product->stock--;
        $product->save();

        session()->put('cart', $cart);

        // Hitung total harga
        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return redirect()->back()->with('totalPrice', $totalPrice);
    }

    public function batal($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Kembalikan stok produk
            $product = Product::find($id);
            if ($product) {
                $product->stock += $cart[$id]['quantity'];
                $product->save();
            }

            unset($cart[$id]);
            session()->put('cart', $cart);

            // Hitung ulang total harga
            $totalPrice = array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);

            return redirect()->back()->with('totalPrice', $totalPrice);
        }

        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    public function store(Request $request)
    {
    // Mulai transaksi database
        DB::beginTransaction();
        try {
            // Simpan transaksi ke dalam database
            $transaction = Transaction::create([
                'total_price' => $request->total ?? 0,
                'transaction_date' => now(),
            ])->id;

            // Simpan detail transaksi
            foreach ($request->items as $product) {
                $productModel = Product::find($product['id']);
                
                // Kurangi stok produk
                if ($productModel->stock >= $product['quantity']) {
                    $productModel->stock -= $product['quantity'];
                    $productModel->save();

                    TransactionDetail::create([
                        'transaction_id' => $transaction,
                        'product_id' => $product['id'],
                        'quantity' => $product['quantity'],
                        'price' => $product['price']
                    ]);
                } else {
                    throw new \Exception('Stok tidak cukup untuk produk: ' . $productModel->name);
                }
            }

            // Commit transaksi jika berhasil
            DB::commit();

            // Redirect ke halaman nota
            return response()->json([
               'message' => 'success',
               'transaction_id' => $transaction
            ],200);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(), 
             ],401);
        }
}

    public function nota($transaction_id)
    {      
        // Ambil transaksi dan detailnya
        $transaction = Transaction::with('details.product')->findOrFail($transaction_id);

        // Kelompokkan produk berdasarkan product_id
        $groupedProducts = $transaction->details->groupBy('product_id')->map(function ($group) {
        $firstProduct = $group->first();
        $firstProduct->quantity = $group->sum('quantity');
        return $firstProduct;
    });
          // Ambil detail transaksi dan tampilkan halaman nota
          return view('kasir.nota', compact('transaction', 'groupedProducts'));
    }
}
