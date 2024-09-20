<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('admin.kasir.createkasir');
    }

        public function alluser()
    {
        $users = User::all(); // Mengambil semua data dari tabel 'users'
        return view('admin.kasir.semuauser', compact('users'))->with('success', 'Product created successfully.'); 
    }

        public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'level'=>'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);

        // Redirect ke halaman semua user dengan pesan sukses
        return redirect('/admin/kasir/semuauser')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Temukan user berdasarkan ID

        // Hapus user dari database
        $user->delete();
    
        // Redirect kembali ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.kasir.semuauser')->with('success', 'Pengguna berhasil dihapus');
    }

}

