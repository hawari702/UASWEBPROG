<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tentang.css') }}">
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

    <div class="content-section mt-3">
        <h2 class="text-center">TENTANG KAMI</h2>
        <div id="aboutCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
            <div class="carousel-inner text-center">
                <div class="carousel-item active">
                    <img src="{{ asset('images/carousel1.jpeg') }}" class="d-block mx-auto" alt="Foto 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/carousel2.jpeg') }}" class="d-block mx-auto" alt="Foto 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/carousel3.jpeg') }}" class="d-block mx-auto" alt="Foto 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <p>
            Dimulai dari sebuah toko offline, toko online PT. Dua Naga Perkasa sekarang hadir dengan komitmen untuk memberikan kepuasan terbaik untuk pelanggan. 
            Kami memahami bahwa di tengah kesibukan dan tantangan mobilitas sehari-hari, kemudahan dalam berbelanja adalah kebutuhan yang sangat penting. 
            Untuk itu, kami menghadirkan toko online sebagai solusi praktis, memberikan akses mudah kepada pelanggan kami kapan saja dan di mana saja. 
            Kami berharap pengalaman belanja pelanggan menjadi lebih nyaman tanpa harus meninggalkan rumah. 
            Kami bertekad untuk terus melayani pelanggan kami dengan harga yang terjangkau untuk semua kalangan, baik pembeli ecer maupun grosir.
            Jangan ragu untuk menghubungi kami jika ada pertanyaan atau membutuhkan bantuan..
        </p>
    </div>

    <div class="content-section">
        <h2>PT. Dua Naga Perkasa PILIHAN ANDA</h2>
        <ul>
            <li>Belanja toko online nyaman</li>
            <li>Produk berkualitas dengan harga terbaik</li>
            <li>Navigasi kategori baut yang mudah</li>
            <li>Pilihan lengkap berbagai macam baut</li>
            <li>Layanan customer service terbaik</li>
        </ul>
    </div>

    <footer class="footer mt-3">
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
