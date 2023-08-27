<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-box-seam-fill"></i><span>Produk</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('products') }}">
                        <i class="bi bi-circle"></i><span>Daftar Produk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('categories') }}">
                        <i class="bi bi-circle"></i><span>Kategori Produk</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Charts Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#pesanan" data-bs-toggle="collapse" href="#">
                <i class="bi bi-box2-fill"></i><span>Pesanan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="pesanan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('konfirmasi-pembayaran') }}">
                        <i class="bi bi-circle"></i><span>Konfirmasi Pembayaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('pesanan-dikirim') }}">
                        <i class="bi bi-circle"></i><span>Pesanan Dikirim</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('pesanan-diterima') }}">
                        <i class="bi bi-circle"></i><span>Pesanan Diterima</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/banners">
                <i class="bi bi-card-heading"></i>
                <span>Banner</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        @if (auth()->user()->role === 'Administrator')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('kelola-user') }}">
                    <i class="bi bi-person"></i>
                    <span>User</span>
                </a>
            </li><!-- End Profile Page Nav -->
        @endif

    </ul>

</aside><!-- End Sidebar-->

