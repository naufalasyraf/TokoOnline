@extends('layouts.app')

@section('container')
    <section class="section p-5 bg-dark">
        <form class="mx-1 mx-md-4" method="POST" action="{{ url('register/proses') }}">
            @csrf
            <div class="mx-auto">
                <div class="card bg-secondary">
                    <div class="card-body container bg-grey">
                        <div class="row justify-content-center">
                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Daftar Akun Baru</p>
                            <div class="col-md-6"> <!-- Form Nama, Email, Password -->

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="form3Example1c">Nama</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus />
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="form3Example3c">Email</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" />
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" required
                                            autocomplete="new-password" />
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="form3Example4cd">Konfirmasi Password</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password" />
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="form3Example3c">Telepon</label>
                                        <input id="telephone" type="number"
                                            class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                                            value="{{ old('telephone') }}" required autocomplete="telephone" />
                                    </div>
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="col-md-6"> <!-- Form Provinsi, Kota, Button -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="typeText">Pilih Provinsi</label>
                                    <select class="form-control country_to_state provinsi" name="provinsi" id="provinsi"
                                        rel="calc_shipping_state">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinsi->rajaongkir->results as $provinsiItem)
                                            <option value="{{ $provinsiItem->province_id }}">{{ $provinsiItem->province }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="typeText">Pilih Kota</label>
                                        <select class="form-control country_to_state kota" name="kota" id="kota"
                                            rel="calc_shipping_state">
                                            <option value="">Pilih Kota</option>
                                        </select>
                                    </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="detail">Detail Alamat</label>
                                    <textarea id="detail" class="form-control @error('detail') is-invalid @enderror" name="detail" rows="4"
                                        required>{{ old('detail') }}</textarea>
                                    @error('detail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-3 mb-lg-4">
                                <button type="submit" class="btn btn-dark btn-lg rounded-4">Registrasi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(function() {
            $('.provinsi').change(function() {
                $.ajax({
                    url: '/get_kotaa/' + $(this).val(),
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
