<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">
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
        <h2>Cara Memesan</h2>
            <div class="faq-item">
                <p>1. Pesan produk yang anda inginkan di halaman Katalog <br>
                    2. Setelah anda selesai memilih produk yang ingin anda pesan, produk akan tersimpan di halaman Pesanan, silahkan anda ke halaman Pesanan<br>
                    3. Pastikan produk yang akan ada pesan sesuai dengan yang anda inginkan<br>
                    4. Jangan lupa isi data diri anda<br>
                    5. Klik check out sampai produk terkirim melalui WhatsApp<br>
                </p>
            </div>    
        <br>
        <h2>FAQ - Pertanyaan yang Sering Ditanyakan</h2>
        <div class="faq-item">
            <h5>1. Apakah ada pembelian minimum?</h5>
            <p>Tidak ada pembelian minimum. Anda dapat berbelanja sesuai dengan kebutuhan Anda.</p>
        </div>
        <div class="faq-item">
            <h5>2. Saya mau mengubah order/pesanan yang sudah dibuat.</h5>
            <p>
                Selama Anda belum melakukan checkout pesanan, Anda masih dapat merubah pesanan Anda.<br> 
                Namun, jika sudah checkout, Anda dapat menghubungi WhatsApp <a href="https://api.whatsapp.com/send?phone=62811986129">0811-986-129</a>.
            </p>
        </div>
        <div class="faq-item">
            <h5>3. Apakah barang ready?</h5>
            <p>
                Biasanya jika produk habis stok, Anda tidak dapat mengklik keranjang belanja. Namun, untuk 
                beberapa kasus, ada barang yang terlewat oleh kami. Silakan konfirmasi di WhatsApp <a href="https://api.whatsapp.com/send?phone=62811986129">0811-986-129</a>.
            </p>
        </div>
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
