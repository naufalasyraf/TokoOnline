<!DOCTYPE html>
<html lang="en">
<head>
    <title>Website Sederhana</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <!-- Tambahkan menu lain di sini -->
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        <h1>Selamat Datang di Website Sederhana</h1>
        <p>Ini adalah halaman beranda</p>
        <button class="btn btn-dark"></button>
    </div>

    <footer class="mt-4 bg-light">
        <div class="container">
            <p>Hak Cipta &copy; 2023. Semua Hak Dilindungi.</p>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>