@extends('layouts.index')

@section('container')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Kategori</h1>
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
                                <h5 class="card-title">Data Kategori</h5>
                            </div>
                            <div class="col-6 pe-4 text-end">
                                <a href="{{url('categories/create')}}" class="btn btn-primary bi bi-plus-circle"> Tambah Data</a>
                            </div>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table datatable text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($categories as $kategori)
                                <tr>
                                    <th scope="row"><b>{{$loop->iteration}}</b></th>
                                    <td>{{$kategori->name}}</td>
                                    @if (auth()->user()->role === 'Administrator')
                                    <td>
                                        <form action="categories/{{ $kategori->id}}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger bi bi-trash3-fill" onClick="return confirm('Yakin akan menghapus data?')">Delete</button>
                                        </form>
                                        <a href="" class="btn btn-warning bi bi-pencil-square"> Edit</a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="" class="btn btn-warning bi bi-pencil-square"> Edit</a>
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