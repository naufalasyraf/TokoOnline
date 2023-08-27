@extends('frontend.index')

@section('container')
    <!--Main layout-->
    <main>
        <div class="container" style="margin-top: 5rem;">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-6 mb-4">
                    <img src="{{ asset('img/' . $products->image) }}" alt="{{ $products->name }}" class="img-fluid"
                        alt="" />
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6 mb-4">
                    <!--Content-->
                    <div class="p-4">
                        <h4>{{ $products->name }}</h4>
                        <div class="mb-3">
                            <span class="badge bg-dark me-1">{{ $products->category->name }}</span>
                        </div>
                        <p class="lead">
                            <span>Rp. {{ number_format($products->price) }}</span>
                        </p>

                        <hr>
                        <strong>
                            <p style="font-size: 20px;">Deskripsi</p>
                        </strong>

                        <p>{{ $products->description }}</p>

                        <hr>
                        <p><strong>Stok : </strong>{{ $products->stock }}</p>
                        <form class="d-flex justify-content-left" method="POST"
                            action="{{ url('order') }}/{{ $products->id }}">
                            @csrf
                            <!-- Default input -->
                            <div class="form-outline me-1" style="width: 100px;">
                                <input type="number" name="jumlah_order" value="1" class="form-control" />
                            </div>
                            <button class="btn btn-dark ms-1 bi bi-cart-plus" type="submit">
                                Add to cart
                                <i class="fas fa-shopping-cart ms-1"></i>
                            </button>
                        </form>
                    </div>
                    <!--Content-->
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->

            <hr />

            <div class="p-5">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h4 class="mb-0 text-black">Ulasan</h4>
                </div>
                <hr class="my-4">
                @foreach ($reviews as $value)
                    <div class="review">
                        <div class="user-rating d-flex align-items-center">
                            <span class="username me-3">{{$value->user->name}}</span>
                            <div class="rating ">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $value->rating)
                                        <span class="star">&#9733;</span> <!-- Bintang terisi -->
                                    @else
                                        <span class="star">&#9734;</span> <!-- Bintang tidak terisi -->
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p>Deskripsi: <span class="text-secondary">{{$value->content}}</span></p>
                        <hr class="my-4">
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
