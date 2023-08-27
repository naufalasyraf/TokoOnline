@extends('frontend.index')

@section('container')
@if ($order_item ==null)
<section class="h-100 h-custom" style="background-color: grey;">
    <div class="container py-5 h-100 mt-5">
        <div class="row d-flex justify-content-center align-items-center h-100">

            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Keranjang</h1>
                                    </div>
                                    <hr class="my-4">
                                    belum ada data
                                    <hr class="my-4">

                                    <div class="pt-5">
                                        <h6 class="mb-0"><a href="#!" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Ringkasan</h3>
                                    <hr class="my-4">
                                    belum ada data
                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total Harga</h5>
                                        belum ada data
                                    </div>
                                    <div class="text-end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@else
<section class="h-100 h-custom" style="background-color: grey;">
    <div class="container py-5 h-100 mt-5">
        <div class="row d-flex justify-content-center align-items-center h-100">

            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Keranjang</h1>
                                    </div>
                                    <hr class="my-4">
                                    @foreach ($order_item as $value)
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="{{ asset('img/' . $value->product->image) }}" class="img-fluid rounded-3" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <h6 class="text-muted">{{$value->product->name}}</h6>
                                        </div>
                                        <div class="col-md-2 col-lg-3 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="form1" min="0" name="quantity" value="{{$value->jumlah}}" readonly type="number" class="form-control form-control-sm" />

                                            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-2">
                                            <h6 class="mb-0">Rp. {{ number_format($value->jumlah_harga)}}</h6>
                                        </div>
                                        <div class="col-md-2">
                                            <form action="{{ url('cart/' . $value->id) }}" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn-close" data-bs-dismiss="toast"></button>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                    <hr class="my-4">

                                    <div class="pt-5">
                                        <h6 class="mb-0"><a href="/home" class="btn btn-secondary"><i class="bi bi-box-arrow-in-left"></i> Kembali berbelanja</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Ringkasan</h3>
                                    <hr class="my-4">
                                    @foreach ($order_item as $value)
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="">Barang {{$loop->iteration}}</h5>
                                        <h5>{{ $value->jumlah_harga}}</h5>
                                    </div>
                                    @endforeach
                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total Harga</h5>
                                        <h5>Rp. {{ number_format($order->jumlah_harga)}}</h5>
                                    </div>
                                    <div class="text-end">
                                        <a href="{{ url('checkout') }}/{{$order->id}}" class="btn btn-dark btn-lg rounded-5 w-50" data-mdb-ripple-color="dark">Pesan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif
<!--Main layout-->

@endsection