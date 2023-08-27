@extends('layouts.index')

@section('container')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Daftar Pesanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Daftar Pesanan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="w-85 mx-auto">
                <div class="card">
                    <div class="card-body container overflow-x-auto">
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
                                    <th>Nama Pelanggan</th>
                                    <th>Order ID</th>
                                    <th>Status</th>
                                    <th>Total Pembayaran</th>
                                    <th>Bukti Pembayaran</th>
                                    <th class="col-2">Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($transactions as $value)
                                @if($value->status == 1)
                                <tr>
                                    <th scope="row"><b>{{$loop->iteration}}</b></th>
                                    <td>{{$value->user->name}}</td>
                                    <td>{{$value->order_id}}</td>
                                    <td>
                                    <span class="badge text-bg-primary">Belum Dibayar</span>
                                    </td>
                                    <td>{{ number_format($value->total_pembayaran, 0, ',', '.') }}</td>
                                    <td><img src="{{ asset('img/' . $value->image) }}" alt="bukti pembayaran" width="100" height="100"></td>
                                    <td>
                                        <a href="/konfirmasi-pembayaran/detail/{{$value->order_id}}" class="btn btn-primary bi bi-eye"> Detail</a>
                                        <form action="{{ url('konfirmasi/' . $value->id) }}" method="POST">
                                            @csrf
                                        <button type="submit" class="btn btn-success bi bi-check-circle mt-2"> Konfirmasi</button>
                                    </form>
                                    </td>
                                </tr>
                                @endif
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