<nav class="navbar fixed-top navbar-expand-lg bg-dark">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent1"
            aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-sm-0" href="https://mdbootstrap.com/">
                <img src="img/logo.jpg" class="rounded-4" height="30" width="60" alt="MDB Logo" loading="lazy" />
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="/home">Home</a>
                </li>
                <li class="nav-item text-white">
                    <a class="nav-link text-white" href="https://mdbootstrap.com/docs/standard/">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="https://mdbootstrap.com/education/bootstrap/">Kontak</a>
                </li>
            </ul>
            <!-- Left links -->
        </div>

        <!-- Right elements -->
        <div>
            <div class="d-flex align-items-center ">
                <!-- Icon -->
                @if (Auth::check())
                    <a class="nav-link " href="{{ url('cart') }}">
                        <button type="button" class="btn btn-link position-relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white"
                                class="bi bi-bag-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                            </svg>

                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $notif }}
                                <span class="visually-hidden">unread messages</span>
                            </span>

                        </button>
                    </a>
                @else
                    <a class="nav-link " href="{{ url('cart') }}">
                        <button type="button" class="btn btn-link position-relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white"
                                class="bi bi-bag-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                            </svg>
                        </button>
                    </a>
                @endif

                <ul class="my-auto">
                    <li class="nav-link dropdown me-3">
                        @if (Auth::check())
                            <a class="nav-link d-flex" href="#" data-bs-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg>
                                <span class="d-md-block dropdown-toggle ps-2 text-white">{{ Auth::user()->name }}</span>
                            </a><!-- End Profile Iamge Icon -->
                        @else
                            <a href="{{ url('login') }}" class="btn btn-light rounded-3">Login</a>
                        @endif


                        @if (Auth::check())
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="/profil-saya">
                                        <i class="bi bi-person"></i>
                                        <span>Profile Saya</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="/pesanan-saya">
                                        <i class="bi bi-inboxes-fill"></i>
                                        <span>Pesanan Saya</span>
                                    </a>
                                </li>
                        @endif
                </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->
                </ul>
            </div>
        </div>
        @if (Auth::check())
            <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center">
                @csrf
                <button type="submit" class="btn tombol-logout bi bi-box-arrow-left"> Logout</button>
            </form>
        @endif
        <!-- Container wrapper -->
</nav>
