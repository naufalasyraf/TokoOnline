@extends('frontend.index')

@section('container')
    <!--Main layout-->
    <section class="h-100 h-custom" style="background-color: grey;">
        <div class="container py-5 h-100 mt-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="bg-grey" style="border-radius: 12px">
                            <h3 class="fw-bold pt-1 text-center mt-5">Nilai Pesanan</h3>
                            <form action="/review/store" method="post">
                                @csrf
                                @foreach ($order_items as $value)
                                    <div class="px-5 mb-4">
                                        <hr class="">
                                        <div class="row mb-3">
                                            <input type="hidden" name="order_item_id[]" value="{{ $value->id }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                <img src="{{ asset('img/' . $value->product->image) }}"
                                                    class="img-fluid rounded-3" alt="Product Image">
                                            </div>
                                            <div class="col-md-10 col-lg-10 col-xl-10">
                                                <h4 class="mb-2">{{ $value->product->name }}</h4>
                                                <label for="rating" class="form-label">Rating</label>
                                                <select class="form-select" name="rating[]" id="rating" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                <div class="mb-3">
                                                    <label for="content" class="form-label">Review</label>
                                                    <textarea class="form-control" name="content[]" id="content" rows="3" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-end p-5"> <!-- Add this div to align the button to the right -->
                                    <button type="submit" class="btn btn-dark">Submit Review</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
