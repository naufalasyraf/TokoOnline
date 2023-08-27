@extends('layouts.index')

@section('container')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tambah Data Kategori</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('categories')}}">Categories</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            @if (session() ->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error')}}
            </div>
            @endif
            <div class="card w-50 mx-auto">
                <div class="card-body">
                    <h5 class="card-title">Form Input Data</h5>

                    <!-- Vertical Form -->
                    <form action="{{url('categories')}}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label for="categori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="categori" name="name">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- Vertical Form -->
                </div>
            </div>
        </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection