@extends('layouts.index')

@section('container')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Data Produk</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('products') }}">Products</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="card w-75 mx-auto">
                    <div class="card-body">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                <li>{{ $error }}</li>
                            </div>
                        @endforeach
                        <h5 class="card-title text-center">Edit Data Produk</h5>
                        <!-- No Labels Form -->
                        <form class="row g-3" method="POST" action="{{ route('products.update', $product->id) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="col-md-12">
                                <label for="name" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $product->name }}">
                            </div>
                            <div class="col-12">
                                <label for="image" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    value="{{ $product->image }}">
                            </div>

                            <div class="col-md-6">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="price"
                                    name="price"value="{{ $product->price }}">
                            </div>
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stock" name="stock"
                                    value="{{ $product->stock }}">
                            </div>
                            <div class="col-12">
                                <label for="id_categori" class="form-label">Kategori</label>
                                <select id="id_categori" class="form-select" name="id_categori">
                                    @foreach($categories as $kategori)
                                    <option value="{{$kategori->id}}">{{$kategori->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea type="text" class="form-control" id="description" name="description" rows="6" >{{ $product->description }}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- End No Labels Form -->

                    </div>
                </div>

            </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
