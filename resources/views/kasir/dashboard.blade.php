@extends('layouts.kasir')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex flex-col lg:flex-row lg:space-x-6 space-y-6 lg:space-y-0">
            <!-- Tabel Produk -->
            <div class="lg:w-2/3 bg-white p-6 shadow-md rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Produk</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white" id="product-table">
                        <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">Nama Produk</th>
                                <th class="py-3 px-6 text-left">Harga</th>
                                <th class="py-3 px-6 text-left">Stok</th>
                                <th class="py-3 px-6 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="product-list" class="text-gray-600 text-sm font-light">
                            @foreach ($products as $product)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">{{ $product->name }}</td>
                                    <td class="py-3 px-6 text-left">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="py-3 px-6 text-left" id="stock-{{ $product->id }}">{{ $product->stock }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <button
                                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 add-to-cart"
                                            data-index="{{ $product->id }}">Tambah</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bagian Kasir -->
            <div class="lg:w-1/3 bg-white p-6 shadow-md rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Kasir</h2>
                <div class="space-y-4">
                    <!-- Produk yang Dipilih -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-700">Item Terpilih</h3>
                        <ul id="selected-items" class="mt-2 space-y-2">
                           
                        </ul>
                    </div>

                    <!-- Total Harga -->
                    <div class="flex justify-between text-lg font-semibold text-gray-800">
                        <span>Total</span>
                        <span id="total-price">Rp{{ number_format(session('totalPrice', 0), 0, ',', '.') }}</span>
                    </div>

                    <!-- Tombol Checkout -->
                    <div>
                        <button id="checkout-button"
                            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                            Bayar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedItems = [];
        let totalPrice = 0;
    
        // Tambahkan event listener untuk tombol "Tambah" di setiap produk
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-index');
                const productName = this.closest('tr').querySelector('td:first-child').innerText;
                const productPrice = parseInt(this.closest('tr').querySelector('td:nth-child(2)').innerText.replace(/\D/g, ''));
                const productStock = document.querySelector(`#stock-${productId}`);
    
                // Update stok jika stok lebih dari 0
                if (parseInt(productStock.innerText) > 0) {
                    // Cek apakah produk sudah ada di dalam selectedItems
                    let existingItem = selectedItems.find(item => item.id === productId);
    
                    if (existingItem) {
                        // Jika produk sudah ada, tambahkan quantity
                        existingItem.quantity += 1;
                    } else {
                        // Jika produk belum ada, tambahkan produk baru ke dalam array selectedItems
                        selectedItems.push({
                            id: productId,
                            name: productName,
                            price: productPrice,
                            quantity: 1,
                        });
                    }
    
                    // Tambahkan harga ke total price
                    totalPrice += productPrice;
    
                    // Update UI
                    updateSelectedItemsUI();
                    updateTotalPriceUI();
    
                    // Aktifkan tombol Batal
                    // document.querySelector('#cancel-all').disabled = false;
    
                    // Kurangi stok
                    productStock.innerText = parseInt(productStock.innerText) - 1;
                } else {
                    alert('Stok habis!');
                }
            });
        });
    
        // Fungsi untuk memperbarui item yang dipilih di UI
        function updateSelectedItemsUI() {
            const selectedItemsContainer = document.querySelector('#selected-items');
            selectedItemsContainer.innerHTML = ''; // Kosongkan list sebelumnya
    
            // Loop untuk menampilkan item terpilih dengan quantity dan tombol kurangi
            selectedItems.forEach((item, index) => {
                selectedItemsContainer.innerHTML += `
                    <li class="flex justify-between items-center p-2 bg-gray-100 rounded">
                        <div>
                            <span class="font-medium">${item.name}</span>
                            <span class="text-sm text-gray-500 ml-2">x${item.quantity}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-gray-700 mr-4">Rp${(item.price * item.quantity).toLocaleString()}</span>
                            <!-- Tombol Kurangi -->
                            <button class="bg-yellow-500 text-white py-1 px-2 rounded" onclick="decreaseItem(${index})">Kurangi</button>
                        </div>
                    </li>`;
            });
    
        }
    
        // Fungsi untuk memperbarui total harga di UI
        function updateTotalPriceUI() {
            document.querySelector('#total-price').innerText = 'Rp' + totalPrice.toLocaleString();
        }
    
        // Fungsi untuk mengurangi quantity item yang sudah dipilih
        function decreaseItem(index) {
            const item = selectedItems[index];
            if (item.quantity > 1) {
                // Kurangi quantity
                item.quantity -= 1;
                totalPrice -= item.price;
            } else {
                // Hapus item dari daftar jika quantity menjadi 0
                totalPrice -= item.price;
                selectedItems.splice(index, 1);
            }
            updateSelectedItemsUI();
            updateTotalPriceUI();
    
            // Kembalikan stok
            const productStock = document.querySelector(`#stock-${item.id}`);
            productStock.innerText = parseInt(productStock.innerText) + 1;
        }
    
        // Event listener untuk tombol "Batal Semua"
        // document.querySelector('#cancel-all').addEventListener('click', function() {
        //     if (confirm('Apakah Anda yakin ingin membatalkan semua item?')) {
        //         // Kembalikan stok untuk semua item yang dipilih
        //         selectedItems.forEach(item => {
        //             const productStock = document.querySelector(`#stock-${item.id}`);
        //             productStock.innerText = parseInt(productStock.innerText) + item.quantity;
        //         });
    
        //         // Kosongkan daftar item dan harga total
        //         selectedItems = [];
        //         totalPrice = 0;
        //         updateSelectedItemsUI();
        //         updateTotalPriceUI();
        //     }
        // });
    
        // Event listener untuk tombol "Bayar"
        document.querySelector('#checkout-button').addEventListener('click', function() {
            if (selectedItems.length === 0) {
                alert('Tidak ada item yang dipilih.');
                return;
            }
    
            // Konfirmasi pembayaran
            if (confirm('Apakah Anda yakin ingin melakukan pembayaran?')) {
                // Kirim data ke server untuk disimpan
                processCheckout();
            }
        });
    
        // Fungsi untuk memproses checkout dan mengirim data ke server
        function processCheckout() {
            // Kirim data melalui AJAX ke route Laravel
            fetch('{{ route('checkout') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token Laravel
                    },
                    body: JSON.stringify({
                        items: selectedItems,
                        total: totalPrice
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.message == 'success') {
                        // Setelah transaksi berhasil disimpan, arahkan ke halaman nota
                        window.location.href = `{{ url('kasir/nota') }}/${data.transaction_id}`;
                    } else {
                        alert('Terjadi kesalahan saat memproses transaksi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengirim data transaksi.');
                });
        }
    </script>
    
@endsection

{{-- <script>
        const products = @json($products);
        let totalPrice = 0;
        let selectedItems = [];

        function addToCart(index) {
            const product = products.find(p => p.id === index);
            if (!product) {
                alert("Produk tidak ditemukan dengan id: " + index);
                return;
            }

            if (product.stock <= 0) {
                alert('Stok produk habis!');
                return;
            }

            // Tambah item ke selectedItems
            selectedItems.push({
                id: product.id,
                name: product.name,
                price: product.price,
                quantity: 1 // Atur quantity default menjadi 1
            });

            const itemId = `item-${selectedItems.length - 1}`;
            const item = document.createElement('li');
            item.classList.add('flex', 'justify-between', 'text-gray-600');
            item.dataset.itemId = itemId;
            item.innerHTML = `
                <span>${product.name}</span>
                <span>Rp${formatRupiah(product.price)}</span>
                <button class="text-red-500 hover:text-red-700 ml-2 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75" 
                        onclick="removeFromCart('${itemId}', ${index})">Batal</button>
            `;
            document.getElementById('selected-items').appendChild(item);

            // Update harga total
            updateTotalPrice(product.price);
            product.stock--; // Kurangi stok di sisi klien
            updateStockDisplay(index);
        }

        function removeFromCart(itemId, index) {
            const item = document.querySelector(`li[data-item-id="${itemId}"]`);
            if (item) {
                const productIndex = selectedItems.findIndex(i => i.id === index);
                if (productIndex !== -1) {
                    // Mengurangi harga dari total
                    updateTotalPrice(-selectedItems[productIndex].price);
                    selectedItems.splice(productIndex, 1); // Hapus item dari selectedItems
                }

                document.getElementById('selected-items').removeChild(item);
                const product = products.find(p => p.id === index);
                if (product) {
                    product.stock++; // Kembalikan stok di sisi klien
                    updateStockDisplay(index);
                }
            }
        }

        function updateTotalPrice(amount) {
            totalPrice += Math.round(amount);
            document.getElementById('total-price').innerHTML = `Rp${formatRupiah(totalPrice)}`;
        }

        function updateStockDisplay(index) {
            document.getElementById(`stock-${index}`).innerHTML = products.find(p => p.id === index).stock;
        }

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function handleCheckout() {
            console.log("Tombol Bayar diklik");

            if (selectedItems.length === 0) {
                alert("Tidak ada item yang dipilih untuk checkout.");
                return;
            }

            const totalCheckoutPrice = selectedItems.reduce((total, item) => total + item.price, 0);

            console.log("Data yang akan dikirim:", selectedItems, "Total Harga:", totalCheckoutPrice);

            // Kirim data ke server menggunakan fetch
            fetch('{{ route('checkout') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    items: selectedItems,
                    total_price: totalCheckoutPrice
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error in fetch response');
                }
                return response.json();
            })
            .then(data => {
                console.log("Response dari server:", data);
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                } else {
                    alert('Gagal mendapatkan URL nota.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memproses checkout.');
            });
        }

        // Event listener for adding items to the cart
        document.getElementById('product-table').addEventListener('click', function(event) {
            if (event.target.classList.contains('add-to-cart')) {
                const index = parseInt(event.target.getAttribute('data-index'));
                addToCart(index);
            }
        });
    </script> --}}
