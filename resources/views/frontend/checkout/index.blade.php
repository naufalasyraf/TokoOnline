@extends('frontend.index')

@section('container')
    <main class="mt-5 pt-4 bg-grey">
        <div class="container">
            <h2 class="my-5 text-center">Checkout form</h2>
            <form action="{{ url('pembayaran-proses/' . $orders->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8 mb-4">
                        <div class="card p-4">
                            <div class="row mb-3">
                                <div class="col-md-6 mb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="typeText">Nama</label>
                                        <input type="text" id="name" value="{{ $orders->user->name }}" readonly
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typeText">Email</label>
                                <input type="email" class="form-control" value="{{ $orders->user->email }}" readonly
                                    aria-describedby="basic-addon1" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typeText">Telepon</label>
                                <input type="text" class="form-control" name="telephone"
                                    value="{{ $orders->user->telephone }}" placeholder="08xxxxxxxx" />
                            </div>

                            <div hidden>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="typeText"></label>
                                    <input type="text" name="provinsi" id="provinsi" class="provinsi"
                                        value="{{ $address->provinsi }}" />
                                    <select class="form-control country_to_state " name="" id=""
                                        rel="calc_shipping_state">
                                        <option value="">Pilih Provinsi</option>

                                    </select>

                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="typeText"></label>
                                    <input type="text" name="kota" id="kota" class="kota"
                                        value="{{ $address->kota }}" />
                                </div>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typeText">Pilih Kota</label>
                                <select class="form-control" id="shippingOption"
                                    rel="calc_shipping_state">
                                    <option value="shippingCost1">JNE OKE</option>
                                    <option value="shippingCost2">JNE REG</option>
                                </select>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typeText">Berat</label>
                                <input type="text" class="form-control berat" name="berat" placeholder="berat"
                                    id="berat" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typeText">Alamat</label>
                                <textarea type="text" class="form-control" placeholder="Masukkan alamat" style="height: 10rem;" name="address">{{ $address->detail }}</textarea>
                            </div>

                            <hr class="mb-4" />

                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Keranjang kamu</span>
                        </h4>

                        <ul class="list-group mb-3">
                            @foreach ($order_items as $value)
                                <li class="list-group-item d-flex justify-content-between">
                                    <div>
                                        <h6 class="my-0"></h6>
                                        <small class="text-muted">{{ $value->product->name }}</small>
                                    </div>
                                    <span class="text-muted">{{ number_format($value->jumlah_harga) }}</span>
                                </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">Biaya pengiriman</h6>
                                    <small class="text-muted">*dikirimkan melalui jasa JNE</small>
                                </div>
                                <input type="text" name="shipping-cost" id="shipping-cost" class="shipping-cost" readonly
                                    value="0">
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total</span>
                                <strong class="cart-total">Rp. {{ number_format($orders->jumlah_harga) }}</strong>
                            </li>
                            <button class="btn btn-dark mt-3 w-50" type="submit">Lanjutkan ke Pembayaran</button>
                        </ul>
                    </div>
                </div>
            </form>
            <input type="submit" class="form-control btn btn-dark update-total" name="calc_shipping" value="Cek Ongkir" />
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(function() {
    $('.update-total').click(function(e) {
        e.preventDefault();
        var selectedShippingOption = $('#shippingOption').val(); // Get the selected shipping option value

        $.ajax({
            url: '/get_ongkir/' + $('.kota').val() + '/' + $('.berat').val(),
            success: function(data) {
                data = JSON.parse(data);
                var shippingCost;

                // Determine the shipping cost based on the selected option
                if (selectedShippingOption === 'shippingCost1') {
                    shippingCost = parseInt(data.rajaongkir.results[0].costs[0].cost[0].value);
                } else if (selectedShippingOption === 'shippingCost2') {
                    shippingCost = parseInt(data.rajaongkir.results[0].costs[1].cost[0].value);
                }

                console.log(data);
                var cartTotal = parseInt({{ $orders->jumlah_harga }});
                var grandTotal = shippingCost + cartTotal;

                // Update shipping cost input value
                $('.shipping-cost').val(shippingCost);

                // Update the cart total display
                $('.cart-total').text(grandTotal);
            }
        });

    });
});

    </script>
@endsection
