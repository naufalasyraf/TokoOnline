@extends('layouts.index')

@section('container')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Banner</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Banner</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="w-75 mx-auto">
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
                                <h5 class="card-title">Gambar Banner</h5>
                            </div>
                            <div class="col-6 pe-4 text-end">
                                <a href="{{url('banners/create')}}" class="btn btn-primary bi bi-plus-circle"> Tambah Gambar</a>
                            </div>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($banners as $banner)
                                <tr>
                                    <th scope="row"><b>{{$loop->iteration}}</b></th>
                                    <td><img src="{{ asset('img/' . $banner->image) }}" alt="gambar banner" width="100" height="100"></td>
                                    <td>
                                        <form action={{ route('banners.destroy', $banner) }} method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger bi bi-trash3-fill" onClick="return confirm('Yakin akan menghapus data?')">Delete</button>
                                        </form>
                                    </td>
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