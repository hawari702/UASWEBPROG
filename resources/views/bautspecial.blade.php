<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
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

    <div class="container mx-auto my-4">
        <a href="{{ url('blog') }}" class="btn-back">
            <i class="bi bi-arrow-left me-2"></i> Back to Blog
        </a>
    </div>
            
    <div class="container mx-auto my-10 px-5">
        <div class="text-center">
            <h2 class="text-3xl text-black-700">Produk Baut - Kategori Special</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
            @foreach ($products as $product)
                <div class="bg-white shadow-lg rounded-xl overflow-hidden transform transition hover:scale-105">
                    <img src="{{ $product->image ? asset($product->image) : asset('images/default.jpg') }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-black-500 font-bold">Stok: {{ $product->stock }}</span>
                            <span class="text-black-600 font-bold">Rp {{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <div id="detail-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-content">
                    <!-- Konten akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const modal = new bootstrap.Modal(document.getElementById('detail-modal'));
        const modalContent = document.getElementById('modal-content');
    
        function showModal(product) {
            modalContent.innerHTML = `
                <div class="text-center mb-4">
                    <img src="${product.image ? '/' + product.image : '/images/special-3.jpeg'}" 
                         alt="${product.name}" 
                         class="img-fluid rounded"
                         style="max-height: 400px; object-fit: contain;">
                </div>
                <h2 class="h4 mb-3">${product.name}</h2>
                <p class="text-muted">${product.description || 'Deskripsi tidak tersedia.'}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-5">
                        <i class="fas fa-box me-2"></i>Stok: ${product.stock}
                    </span>
                    <span class="fs-5 text-primary fw-bold">
                        Rp ${parseFloat(product.price).toLocaleString('id-ID', { minimumFractionDigits: 0 })}
                    </span>
                </div>
            `;
            modal.show();
        }
    </script>

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
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
