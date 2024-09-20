<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <title>Sidebar Example</title>

    <style>
        /* Tambahan styling untuk submenu */
        #submenu {
            display: none;
        }

        #submenu.show {
            display: block;
        }

        @media print {

            .sidebar,
            .no-print,
            header,
            footer,
            button {
                display: none;
            }

            /* Atur ulang lebar konten utama agar memenuhi halaman */
            .content {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            body,
            .content {
                font-size: 12pt;
                line-height: 1.6;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table,
            th,
            td {
                border: 1px solid black;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
            }

            @page {
                margin: 1cm;
            }

            .container {
                padding: 0;
                margin: 0;
            }

            /* Hilangkan elemen lain yang tidak perlu saat print (opsional) */
            .no-print {
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
        <div class="flex-grow ml-64 p-6">
            @yield('content')
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const submenu = document.getElementById("submenu");
            submenu.classList.toggle("show");
            const arrow = document.getElementById("arrow");
            arrow.classList.toggle("bi-chevron-up");
            arrow.classList.toggle("bi-chevron-down");
        }
    </script>


</body>

</html>
