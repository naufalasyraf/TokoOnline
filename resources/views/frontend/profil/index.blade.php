@extends('frontend.index')

@section('container')
    <form action={{ url('edit-user/' . $user->id) }} method="post">
        @csrf
        <section style="background-color: #eee;">
            <div class="container py-5 mt-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg>
                                <h5 class="my-3">{{ $user->name }}</h5>
                                <p class="text-muted mb-4 bi bi-telephone-fill"></i> {{ $user->telephone }}</p>

                            </div>
                        </div>
                    </div>
                    @foreach ($addresses as $value)
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Nama</p>
                                        </div>
                                        <div class="col-sm-9 form-outline">
                                            <input type="text" name="name" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Telepon</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="telephone" value="{{ $user->telephone }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Provinsi</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="form-control country_to_state provinsi" name="provinsi"
                                                id="provinsi" rel="calc_shipping_state">
                                                <option value="">{{ $value->provinsi }}</option>
                                                @foreach ($provinsi->rajaongkir->results as $provinsiItem)
                                                    <option value="{{ $provinsiItem->province_id }}">
                                                        {{ $provinsiItem->province }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Kota</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="form-control country_to_state kota" name="kota" id="kota"
                                                rel="calc_shipping_state">
                                                <option value="">{{ $value->kota }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Alamat</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="detail" value="{{ $value->detail }}">
                                        </div>
                                    </div>
                                    <hr>
                    @endforeach
                    <div class="d-flex justify-content-center mb-2 mt-5">
                        <a href="/home" class="btn btn-outline-dark ms-1 me-4">Kembali</a>
                        <button type="submit" class="btn btn-dark">Simpan</button>
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>
        </section>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(function() {
            $('.provinsi').change(function() {
                $.ajax({
                    url: '/get_kotaaa/' + $(this).val(),
                    success: function(data) {
                        data = JSON.parse(data)
                        option = ""
                        data.rajaongkir.results.map((kota) => {
                            option +=
                                `<option value=${kota.city_id}>${kota.city_name}</option>`
                        })
                        $('.kota').html(option)
                    }
                });
            });
        });
    </script>
@endsection
