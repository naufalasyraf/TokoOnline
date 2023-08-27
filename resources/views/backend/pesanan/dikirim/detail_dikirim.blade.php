@extends('layouts.index')

@section('container')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Daftar Pesanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active"><a href="/pesanan-dikirim">Daftar Pesanan</a></li>
                <li class="breadcrumb-item active">Detail Pesanan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="w-85 mx-auto">
                <div class="card">
                    @if (session() ->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (session() ->has('sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('sukses')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-body container">
                        <div class="row mt-3">
                            <div class="col-6">
                                <h5 class="card-title">Data Konfirmasi Pesanan</h5>
                            </div>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                            </thead>
                            <tbody>
                                @foreach($order_items as $value)
                                <tr>
                                    <th scope="row"><b>{{$loop->iteration}}</b></th>
                                    <td>{{$value->product->name}}</td>
                                    <td>{{$value->jumlah}}</td>
                                    <td>{{$value->jumlah_harga}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection