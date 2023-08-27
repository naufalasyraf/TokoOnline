@extends('frontend.index')

@section('container')
<?php
function limitAndEllipsis($text, $maxLength) {
    if (strlen($text) > $maxLength) {
        return substr($text, 0, $maxLength) . '...';
    }
    return $text;
}
?>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%285%29.jpg" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%282%29.jpg"
                    class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!--Main layout-->
    <main>
        <div class="container">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark mt-3 mb-5 shadow p-3 bg-dark">
                <!-- Container wrapper -->
                <div class="container-fluid">

                    <!-- Navbar brand -->
                    <a class="navbar-brand" href="#">Categories:</a>

                    <!-- Toggle button -->
                    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                        data-mdb-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Collapsible wrapper -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <!-- Link -->
                            <li class="nav-item acitve">
                                <a class="nav-link text-white" href="#">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Kemeja & Blouse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Tunik</a>
                            </li>
                        </ul>



                    </div>
                </div>
                <!-- Container wrapper -->
            </nav>
            <!-- Navbar -->

            <!-- Products -->
            <section>
                <div class="text-center">
                    <div class="container">
                        <div class="row">
                            @foreach ($products as $value)
                                <div class="col-lg-3 col-md-6 mb-4">
                                    <div class="card profile-card" id="produk">
                                        <img src="{{ asset('img/' . $value->image) }}" alt="{{ $value->name }}"
                                            class="card-img-top" height="400">
                                        <div class="card-body">
                                            <div class="mask">
                                                <div class="d-flex justify-content-center align-items-end h-100">
                                                    <h5><span class="badge bg-dark">{{ $value->category->name }}</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="" class="text-reset">
                                                <h5 class="card-title mb-2"><?= limitAndEllipsis($value->name, 70); ?></h5>
                                            </a>
                                            <h6 class="mb-3 price">Rp. {{ number_format($value->price) }}</h6>
                                        </div>
                                        <a href="{{ url('order_proses') }}/{{ $value->id }}"
                                            class="btn btn-dark w-25 mx-auto">Pesan</a>
                                        <p class="text-end me-2">Tersisa : {{ $value->stock }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <!-- Pagination -->
            <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-3">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Pagination -->
        </div>
    </main>
@endsection
