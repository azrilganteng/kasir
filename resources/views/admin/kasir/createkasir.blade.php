@extends('layouts.app')

@section('content')

@if(session('success'))
    <div id="alert-box" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>

        {{-- Tombol Tutup --}}
        <span id="close-alert" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer text-green-500">
            <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M14.348 14.849a1 1 0 01-1.415 0L10 11.414 7.066 14.35a1 1 0 01-1.415-1.415L8.586 10 5.651 7.066a1 1 0 011.415-1.415L10 8.586l2.935-2.935a1 1 0 011.415 1.415L11.414 10l2.935 2.935a1 1 0 010 1.415z"/>
            </svg>
        </span>
    </div>

    {{-- Script untuk menutup alert --}}
    <script>
        document.getElementById('close-alert').onclick = function() {
            document.getElementById('alert-box').style.display = 'none';
        };
    </script>
@endif


<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6 text-center">Tambah Kasir</h1>

    <form action="/admin/kasir/storekasir" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Kasir</label>
            <input type="text" class="form-input mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="name" name="name" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" class="form-input mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="email" name="email" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" class="form-input mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="password" name="password" required>
        </div>
        <div class="mb-4">
            <label for="level" class="block text-gray-700 text-sm font-bold mb-2">Level</label>
            <input type="text" class="form-input mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="level" name="level" required>
        </div>
        
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Simpan
        </button>
    </form>
</div>
@endsection

