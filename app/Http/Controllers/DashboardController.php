<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth; // Pastikan ini ada

class DashboardController extends Controller
{
  
    public function index()
    {
        // mengautentikasi user

        $user = Auth::user(); // Ambil pengguna yang sedang terautentikasi

        if ($user->level == 1) {
            // Misalkan Anda sudah mendefinisikan variabel $kategori, $produk, $tanggal_awal, $tanggal_akhir, $data_tanggal, $data_pendapatan sebelumnya
            $products = Product::all();
            return view('admin.dashboard', compact('products'));
        } else {
            $products = Product::all();
            return view('kasir.dashboard', compact('products'));
        }
    }

   
} 
