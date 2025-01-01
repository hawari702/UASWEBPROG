<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
    
</head>
<div>
    <div class="header-top">
        <div class="container">
            <div class="news-marquee">
                <p>
                    PT. Dua Naga Perkasa - Toko online pilihan Anda untuk belanja murah &amp; aman |
                    | Anda bisa menghubungi nomor ini: <a href="https://api.whatsapp.com/send?phone=62811986129">0811-986-129</a>
                </p>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('catalog.customer') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="taskbar-logo">
                <span class="ms-2">PT. Dua Naga Perkasa</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('catalog/customer') ? 'active' : '' }}" href="{{ route('catalog.customer') }}">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}" href="tentang">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="faq">FAQ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('blog*') ? 'active' : '' }}" href="{{ url('blog') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Blog
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ request()->is('bautumum') ? 'active' : '' }}" href="{{ url('bautumum') }}">Baut Umum</a></li>
                            <li><a class="dropdown-item {{ request()->is('bautspecial') ? 'active' : '' }}" href="{{ url('bautspecial') }}">Baut Special</a></li>
                        </ul>
                    </li>

                    <script>
                        document.getElementById('navbarDropdown').addEventListener('click', function (event) {
                            if (!this.getAttribute('aria-expanded') || this.getAttribute('aria-expanded') === "false") {
                                window.location.href = this.href;
                            }
                        });
                    </script>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pesanan') ? 'active' : '' }}" href="{{ url('pesanan') }}">Pesanan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mx-auto my-4">
        <a href="{{ url('catalog') }}" class="btn-back">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Katalog
        </a>
    </div>

    <div class="container mx-auto mt-8 p-5 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Pesanan Anda</h2>
    
        @if (empty($pesanan))
            <p class="text-gray-600 text-center">Keranjang Anda kosong.</p>
        @else
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border rounded-lg overflow-hidden shadow-lg">
                <thead class="bg-gradient-to-r from-blue-500 to-blue-500 text-white text-left">
                    <tr>
                        <th class="py-3 px-4 text-left font-medium text-sm tracking-wider">#</th>
                        <th class="py-3 px-4 text-left font-medium text-sm tracking-wider">Nama Produk</th>
                        <th class="py-3 px-4 text-center font-medium text-sm tracking-wider">Jumlah</th>
                        <th class="py-3 px-4 text-center font-medium text-sm tracking-wider">Harga</th>
                        <th class="py-3 px-4 text-center font-medium text-sm tracking-wider">Total</th>
                        <th class="py-3 px-4 text-center font-medium text-sm tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanan as $id => $item)
                        <tr class="hover:bg-gray-50 border-t border-gray-200 transition duration-300">
                            <td class="py-2 px-4 text-gray-600 text-sm">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 text-gray-600 text-sm">{{ $item['name'] }}</td>
                            <td class="py-2 px-4 text-center text-gray-600 text-sm">{{ $item['quantity'] }}</td>
                            <td class="py-2 px-4 text-center text-gray-600 text-sm">
                                Rp {{ number_format($item['price'], 2) }}
                            </td>
                            <td class="py-2 px-4 text-center text-gray-600 text-sm">
                                Rp {{ number_format($item['price'] * $item['quantity'], 2) }}
                            </td>
                            <td class="py-2 px-4 text-center">
                                <a href="{{ route('pesanan.remove', $id) }}" 
                                   class="text-red-500 hover:text-red-600 transition duration-300"
                                   title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

            <h3 class="text-xl font-bold mt-8 mb-4">Formulir Checkout</h3>
            <form action="https://api.whatsapp.com/send" method="GET" target="_blank" class="bg-gray-50 p-6 rounded-lg shadow-lg">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" required placeholder="Masukkan nama lengkap Anda"
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring focus:ring-yellow-300">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-medium mb-2">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" required placeholder="Masukkan nomor telepon Anda"
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring focus:ring-yellow-300">
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-gray-700 font-medium mb-2">Alamat</label>
                    <textarea id="address" name="address" rows="4" required placeholder="Masukkan alamat lengkap Anda"
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring focus:ring-yellow-300"></textarea>
                </div>
                <input type="hidden" name="product_quantity" id="product_quantity"
                    value="{{ json_encode(collect($pesanan)->map(function($item) { 
                        return ['product_name' => $item['name'], 'quantity' => $item['quantity']]; 
                    })->values()) }}">
                <div class="mb-4">
                    <label for="total" class="block text-gray-700 font-medium mb-2">Total Pembayaran</label>
                    <input type="text" id="total" name="total" readonly
                        value="Rp {{ number_format(collect($pesanan)->sum(function($item) { 
                            return $item['price'] * $item['quantity']; 
                        }), 2) }}"
                        class="w-full border border-gray-300 rounded-lg p-3 bg-gray-100 shadow-sm">
                </div>
                <h6>Pastikan kembali produk serta jumlah pesanan yang anda pesan sudah sesuai</h6>
                <br>
                <button type="submit"
                    class="w-32 bg-green-500 text-white font-bold py-3 rounded-lg shadow-md hover:bg-green-600 focus:ring focus:ring-green-300">
                    Checkout
                </button>
            </form>
    </div>
            
    <script>
        const form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            e.preventDefault();
        
            const name = document.getElementById('name').value;
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;
            const total = document.getElementById('total').value;
        
            const cartItems = JSON.parse(document.getElementById('product_quantity').value);
        
            let productQuantityText = '';
            cartItems.forEach(item => {
                productQuantityText += `\n*Produk:* ${item.product_name}\n*Kuantitas:* ${item.quantity} pcs\n-------------------`;
            });
        
            if (productQuantityText === '') {
                productQuantityText = `*Tidak ada produk yang dipilih.*`;
            }
        
            
            const message = `
            *Detail Pesanan:*
            -------------------
            👤 *Nama:* ${name}
            📞 *Telepon:* ${phone}
            🏠 *Alamat:* ${address}
            📦 *Produk & Kuantitas:*
            ${productQuantityText}
            💰 *Total Pembayaran:* ${total}
            -------------------
            *Terima kasih atas pesanan Anda!*
            `.trim();

            const whatsappUrl = `https://api.whatsapp.com/send?phone=+62811986129&text=${encodeURIComponent(message)}`;
        
            window.open(whatsappUrl, '_blank');
        });
    </script>
        @endif
    </div>

    <div class="button-container">
        <button onclick="window.location.reload()" class="refresh-button">
            <i class="fas fa-sync-alt"></i> Refresh Pesanan
        </button>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
