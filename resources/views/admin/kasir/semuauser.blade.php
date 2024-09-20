@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Daftar Semua Pengguna</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Level</th>
                        <th class="py-3 px-6 text-left">Dibuat Pada</th>
                        <th class="py-3 px-6 text-center">Aksi</th> {{-- Ubah posisi ke center --}}
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                            <td class="py-3 px-6 text-left">
                                @if($user->level == 1)
                                    <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">Admin</span>
                                @elseif($user->level == 2)
                                    <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Kasir</span>
                                @else
                                    <span class="bg-gray-200 text-gray-600 py-1 px-3 rounded-full text-xs">User</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-left">{{ $user->created_at->format('d-m-Y') }}</td>
                            <td class="py-3 px-6 text-center">
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 mx-auto">
                                        {{-- Ikon Hapus --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
