@extends('layouts.index')

@section('container')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="w-85 mx-auto">
                <div class="card">
                    <div class="card-body container">
                        <div class="row mt-3">
                            <div class="col-6">
                                <h5 class="card-title">Data Produk</h5>
                            </div>
                            <div class="col-6 pe-4 text-end">
                                <a href="{{url('products/create')}}" class="btn btn-primary bi bi-plus-circle"> Tambah Data</a>
                            </div>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama produk</th>
                                    <th>Gambar</th>
                                    <th>Harga</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Stok</th>
                                    <th class="col-2">Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($products as $produk)
                                <tr>
                                    <th scope="row"><b>{{$loop->iteration}}</b></th>
                                    <td>{{$produk->name}}</td>
                                    <td><img src="{{ asset('img/' . $produk->image) }}" alt="{{ $produk->name }}" width="100" height="100"></td>
                                    <td>{{$produk->price}}</td>
                                    <td>{{$produk->category->name}}</td>
                                    <td>{{$produk->description}}</td>
                                    <td>{{$produk->stock}}</td>
                                    @if (auth()->user()->role === 'Administrator')
                                    <td>
                                        <form action="products/{{ $produk->id }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm bi bi-trash3-fill" onClick="return confirm('Yakin akan menghapus data?')"></button>
                                        </form>
                                        <a href="{{ route('products.edit', $produk->id) }}" class="btn btn-warning btn-sm bi bi-pencil-square"></a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="{{ route('products.edit', $produk->id) }}" class="btn btn-warning btn-sm bi bi-pencil-square"></a>
                                    </td>
                                    @endif
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