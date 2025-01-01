<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
</head>
<body>
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

    <div class="container mt-5">
        <h2 class="text-center mb-5">KATALOG PRODUK</h2>
    
        <form action="{{ route('catalog.customer') }}" method="GET" class="search-form mb-4">
            <input type="text" name="search" placeholder="Cari produk..." value="{{ request()->query('search') }}" class="search-input">
            <button type="submit" class="search-button">
                <i class="fas fa-search"></i>
            </button>
    
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                <option value="umum" {{ request()->query('category') == 'umum' ? 'selected' : '' }}>Umum</option>
                <option value="special" {{ request()->query('category') == 'special' ? 'selected' : '' }}>Special</option>
            </select>
        </form>
        
        @if(request()->query('category') == 'umum' || !request()->query('category'))
        <h3>Kategori Umum</h3>
        <div class="overflow-auto d-flex" id="umum" style="scroll-behavior: smooth; overflow-x: auto; padding-bottom: 10px;">
            @foreach($products->where('category', 'umum') as $product)
                <div class="card h-100" style="min-width: 280px; margin-right: 15px;">
                    <img src="{{ $product->image ? asset($product->image) : asset('images/default-image.jpg') }}" 
                         class="card-img-top rounded" 
                         alt="{{ $product->name }}"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ $product->description }}</p>
                            <p class="text-muted mb-2"><strong>Stok:</strong> {{ $product->stock }}</p>
                            <p class="text-primary"><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="quantity-control">
                            <input type="number" data-product-id="{{ $product->id }}" value="0" min="0" readonly class="form-control">
                            <button type="button" onclick="updateQuantity({{ $product->id }}, 'increase')" class="btn btn-success">+</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    
    @if(request()->query('category') == 'special' || !request()->query('category'))
        <h3 class="mt-4">Kategori Special</h3>
        <div class="overflow-auto d-flex" id="special" style="scroll-behavior: smooth; overflow-x: auto; padding-bottom: 10px;">
            @foreach($products->where('category', 'special') as $product)
                <div class="card h-100" style="min-width: 280px; margin-right: 15px;">
                    <img src="{{ $product->image ? asset($product->image) : asset('images/special-3.jpeg') }}" 
                         class="card-img-top rounded" 
                         alt="{{ $product->name }}"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ $product->description }}</p>
                            <p class="text-muted mb-2"><strong>Stok:</strong> {{ $product->stock }}</p>
                            <p class="text-primary"><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="quantity-control">
                            <input type="number" data-product-id="{{ $product->id }}" value="0" min="0" readonly class="form-control">
                            <button type="button" onclick="updateQuantity({{ $product->id }}, 'increase')" class="btn btn-success">+</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    </div>
    
    <script>
        const cart = JSON.parse(localStorage.getItem('cart')) || {}; 

        function updateCart(productId, change) {
            if (!cart[productId]) {
                cart[productId] = 0;
            }
            cart[productId] += change;

            if (cart[productId] < 0) {
                cart[productId] = 0;
            }

            const quantitySpan = document.getElementById(`quantity-${productId}`);
            const minusButton = document.getElementById(`btn-minus-${productId}`);

            if (cart[productId] > 0) {
                quantitySpan.innerText = cart[productId];
                quantitySpan.style.display = 'inline-block'; 
                minusButton.style.display = 'inline-block'; 
            } else {
                quantitySpan.style.display = 'none'; 
                minusButton.style.display = 'none'; 
            }

            localStorage.setItem('cart', JSON.stringify(cart));

            updateCartDatabase(productId, cart[productId]);
        }

        function updateCartDatabase(productId, quantity) {
            fetch('{{ route("cart.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Cart updated:', data);
            })
            .catch(error => {
                console.error('Error updating cart:', error);
            });
        }

        document.addEventListener("DOMContentLoaded", () => {
            for (const productId in cart) {
                if (cart.hasOwnProperty(productId)) {
                    const quantity = cart[productId];
                    const quantitySpan = document.getElementById(`quantity-${productId}`);
                    const minusButton = document.getElementById(`btn-minus-${productId}`);

                    if (quantity > 0) {
                        quantitySpan.innerText = quantity;
                        quantitySpan.style.display = 'inline-block';
                        minusButton.style.display = 'inline-block';
                    }
                }
            }
        });

        function updateQuantity(productId, action) {
            const quantityInput = document.querySelector(`input[data-product-id="${productId}"]`);
            let currentQuantity = parseInt(quantityInput.value);
            
            if (action === 'increase') {
                currentQuantity++;
                addToCart(productId, 1);
            } else if (action === 'decrease' && currentQuantity > 0) {
                currentQuantity--;
                updateCartQuantity(productId, currentQuantity);
            }
            
            quantityInput.value = currentQuantity;
        }

        function addToCart(productId, quantity) {
            const token = document.querySelector('meta[name="csrf-token"]').content;
            
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Cart updated:', data.cart);
                    showNotification('Produk berhasil ditambahkan');
                } else {
                    console.error('Failed to update cart:', data.message);
                    showNotification('Gagal menambahkan produk', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan', 'error');
            });
        }

        function updateCartQuantity(productId, quantity) {
            const token = document.querySelector('meta[name="csrf-token"]').content;
            
            fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Quantity updated:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function showNotification(message, type = 'success') {
            alert(message);
        }

        document.querySelectorAll('.quantity-control input').forEach(input => {
            input.addEventListener('keydown', (e) => e.preventDefault());
        });
    </script>
    
    
    <style>
        #umum::-webkit-scrollbar, #special::-webkit-scrollbar {
            height: 8px;
        }
        
        #umum::-webkit-scrollbar-thumb, #special::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 4px;
        }
    
        #umum::-webkit-scrollbar-track, #special::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
    
        #umum:hover::-webkit-scrollbar, #special:hover::-webkit-scrollbar {
            height: 10px;
        }
    
        #umum:hover::-webkit-scrollbar-thumb, #special:hover::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
    
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Navigasi</h5>
                    <ul class="list-unstyled">
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
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Alamat</h5>
                    <p>
                        <a href="https://www.google.com/maps?q=Grand+Tomang+Blok+R3+No.+7,+Tangerang" target="_blank">
                            Grand Tomang Blok R3 No. 7, Tangerang
                        </a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h5>Hubungi Kami</h5>
                    <a href="https://api.whatsapp.com/send?phone=62811986129" target="_blank" class="text-decoration-none">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>
            <div class="footer-bottom text-center mt-4">
                <p>&copy; 2024 PT. Dua Naga Perkasa. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>