<!-- resources/views/transactions/nota.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <title>Nota Pembelian</title>
    <style>
        /* Styling untuk mencetak tanpa sidebar */
        @media print {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
            }

            button {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar fixed top-0 left-0 h-full w-64 bg-gray-900 text-gray-100 p-5">
            <h1 class="text-2xl font-bold mb-5">PROGRAM KASIR</h1>

            <div class="mt-3">
                <a href="/kasir/dashboard"
                    class="flex items-center p-2 rounded-md {{ request()->is('kasir/dashboard') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                    <i class="bi bi-house-door-fill"></i>
                    <span class="ml-3">Home</span>
                </a>

                <div
                    class="mt-4 {{ request()->is('admin/produk/create') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                    <div class="flex items-center p-2 rounded-md cursor-pointer hover:bg-gray-800"
                        onclick="toggleDropdown()">
                        <i class="bi bi-chat-left-text-fill"></i>
                        <span class="ml-3">Data Menu</span>
                        <i class="bi bi-chevron-down ml-auto" id="arrow"></i>
                    </div>

                    <!-- Dropdown menu -->
                    <div id="submenu" class="hidden pl-5">
                        <a href="/kasir/rekap" class="block py-1 hover:bg-gray-800 rounded-md text-gray-300">Rekap
                            Data</a>
                    </div>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>

                <a href="#" class="flex items-center p-2 rounded-md hover:bg-gray-800 mt-2"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span class="ml-3">Logout</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow ml-64 p-6">
            <div class="flex justify-center mt-10">
                <!-- Main Content -->
                <div class="main-content w-full max-w-4xl p-6 bg-gray-200 shadow-md rounded-lg">
                    <!-- Title and Logo -->
                    <div class="border border-red-500 p-6 rounded-lg mb-6 bg-gray-100 shadow-lg text-center">
                        <!-- Title -->
                        <h1 class="text-2xl font-bold mb-2">Nota Penjualan</h1>
        
                        <!-- Logo -->
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-30 h-40 mb-2 mx-auto rounded-lg  ">
                        <h6 class="text-2l font-light">Company</h6>
                        <h5 class="text-2l font-light mb-2 font-mono">Azril & Filbeth</h5>
                    </div>
        
                    <p class="mb-5"><strong>Tanggal:</strong> {{ $transaction->transaction_date }}</p>
        
                    <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg mb-6">
                        <thead class="bg-purple-200 text-gray-600 text-sm uppercase">
                            <tr>
                                <th class="py-3 px-6 text-left">Nama Produk</th>
                                <th class="py-3 px-6 text-left">Rate</th>
                                <th class="py-3 px-6 text-left">Jumlah</th>
                                <th class="py-3 px-6 text-left">Harga Total</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @php
                                $groupedProducts = [];
                                foreach ($transaction->products as $product) {
                                    if (isset($groupedProducts[$product->name])) {
                                        $groupedProducts[$product->name]['quantity'] += $product->pivot->quantity;
                                        $groupedProducts[$product->name]['total_price'] +=
                                            $product->pivot->price * $product->pivot->quantity;
                                    } else {
                                        $groupedProducts[$product->name] = [
                                            'name' => $product->name,
                                            'quantity' => $product->pivot->quantity,
                                            'price' => $product->pivot->price,
                                            'total_price' => $product->pivot->price * $product->pivot->quantity,
                                        ];
                                    }
                                }
                            @endphp
        
                            @foreach ($groupedProducts as $product)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">{{ $product['name'] }}</td>
                                    <td class="py-3 px-6 text-left">
                                        Rp{{ number_format($product['price'], 0, ',', '.') }}</td>
                                    <td class="py-3 px-6 text-left">{{ $product['quantity'] }}</td>
                                    <td class="py-3 px-6 text-left">
                                        Rp{{ number_format($product['total_price'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
        
                    <div class="flex justify-between mb-6">
                        <div></div>
                        <div class="text-right">
                            <p><strong>Subtotal:</strong> Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                            <p><strong>Total:</strong> Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
        
                    <button class="mt-6 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                        onclick="window.print()">Cetak Nota</button>
                </div>
            </div>
        </div>
        
    </div>

    <script>
        function toggleDropdown() {
            const submenu = document.getElementById("submenu");
            submenu.classList.toggle("hidden");
            const arrow = document.getElementById("arrow");
            arrow.classList.toggle("bi-chevron-up");
            arrow.classList.toggle("bi-chevron-down");
        }
    </script>
</body>

</html>
