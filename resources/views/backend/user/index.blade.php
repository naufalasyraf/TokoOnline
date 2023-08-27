@extends('layouts.index')

@section('container')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Data User</li>
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
                    <div class="card-body container overflow-x-auto">
                        <div class="row mt-3">
                            <div class="col-6">
                                <h5 class="card-title">Data User</h5>
                            </div>
                            @if(Auth::user()->role==='Administrator')
                            <div class="col-6 pe-4 text-end">
                                <a href="{{url('user/tambah-admin')}}" class="btn btn-primary bi bi-plus-circle"> Tambah Data Admin</a>
                            </div>
                            @endif
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table text-center datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="col-2">Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($users as $value)
                                <tr>
                                    <th scope="row"><b>{{$loop->iteration}}</b></th>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->role}}</td>
                                    <td>
                                        <form action="/user/{{ $value->id }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm bi bi-trash3-fill">Delete</button>
                                        </form>
                                        <a href="" class="btn btn-warning bi bi-pencil-square"> Edit</a>
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