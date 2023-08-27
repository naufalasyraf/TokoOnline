@extends('frontend.index')

@section('container')
    <!--Main layout-->
    <section class="h-100 h-custom" style="background-color: grey;">
        <div class="container py-5 h-100 mt-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="bg-grey" style="border-radius: 12px">
                            <h3 class="fw-bold pt-1 text-center mt-5">Pesanan Saya</h3>
                            @php
                                // Urutkan transactions secara descending berdasarkan id
                                $sortedTransactions = $transactions->sortByDesc('id');
                            @endphp
                            @foreach ($sortedTransactions as $transaction)
                                <div class="px-5">
                                    <hr class="">
                                    <table class="table text-center">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order_items as $order_item)
                                                @if ($order_item->order_id == $transaction->order_id)
                                                    <tr>
                                                        <td>
                                                            <div style="display: flex; align-items: center;">
                                                                <img src="{{ asset('img/' . $order_item->product->image) }}"
                                                                    alt="gambar produk" width="100" height="100">
                                                                <div style="margin-left: 10px;">
                                                                    {{ $order_item->product->name }}</div>
                                                            </div>
                                                        </td>
                                                        <td> {{ $order_item->jumlah }}</td>
                                                        <td>{{ number_format($order_item->jumlah_harga, 0, ',', '.') }}</td>
                                                        <td>
                                                            @if ($transaction->status == 0)
                                                                <span class="badge text-bg-primary">Belum Dibayar</span>
                                                            @elseif($transaction->status == 1)
                                                                <span class="badge text-bg-secondary">Menunggu
                                                                    Konfirmasi</span>
                                                            @elseif($transaction->status == 2)
                                                                <span class="badge text-bg-warning">Sedang Dikirim</span>
                                                            @elseif($transaction->status == 3)
                                                                <span class="badge text-bg-success">Pesanan Selesai</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-between mb-5">
                                        <h5>Total Pembayaran <small>(termasuk ongkir)</small>:</h5>
                                        <h5>{{ 'Rp ' . number_format($transaction->total_pembayaran, 0, ',', '.') }}</h5>
                                    </div>
                                    @if ($transaction->status == 2)
                                        <div class="d-flex justify-content-end mb-3">
                                            <button class="btn btn-dark"
                                                onclick="location.href='{{ route('pesanan-saya.review', ['order_id' => $transaction->order_id]) }}'">Pesanan
                                                Diterima</button>
                                        </div>
                                    @endif
                                    <hr class="my-4">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
