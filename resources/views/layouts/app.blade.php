<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"
    />
    <title>Sidebar Example</title>
    <style>
        /* Tambahan styling untuk submenu */
        #submenu {
            display: none;
        }
        #submenu.show {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar fixed top-0 left-0 h-full w-64 bg-gray-900 text-gray-100 p-5">
            <h1 class="text-2xl font-bold mb-5">PROGRAM KASIR</h1>
            <div class="mb-4">
                <input
                    type="text"
                    placeholder="Search"
                    class="w-full px-3 py-2 rounded-md bg-gray-700 text-white focus:outline-none"
                />
            </div>
            <div class="mt-3">
                <a href="/admin/dashboard" class="flex items-center p-2 rounded-md {{ request()->is('admin/dashboard')? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                    <i class="bi bi-house-door-fill"></i>
                    <span class="ml-3">Home</span>
                </a>
                
                <div class="mt-4 {{ request()->is('admin/produk/create') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">

                    <div class="flex items-center p-2 rounded-md cursor-pointer hover:bg-gray-800" onclick="toggleDropdown()">
                        <i class="bi bi-chat-left-text-fill"></i>
                        <span class="ml-3">Data Menu</span>
                        <i class="bi bi-chevron-down ml-auto" id="arrow"></i>
                    </div>
                
                    <!-- Dropdown menu -->
                    <div id="submenu" class="hidden pl-5">
                        <a href="/admin/produk/create" class="block py-1 hover:bg-gray-800 rounded-md text-gray-300">Produk</a>
                        <a href="/admin/kasir/createkasir" class="block py-1 hover:bg-gray-800 rounded-md text-gray-300">Tambah Pengguna</a>
                        <a href="/admin/kasir/semuauser" class="block py-1 hover:bg-gray-800 rounded-md text-gray-300">Semua Pengguna</a>
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
