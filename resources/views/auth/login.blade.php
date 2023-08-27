@extends('layouts.login')

@section('content')
    <section class="bg-white mt-4">
        <div class="container py-5">
            <div class="text-center my-5">
                <h2>Selamat Datang, Silahkan Login</h2>
            </div>
            <div class="row d-flex align-items-center justify-content-center h-100 mb-5">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="img/logo.jpg" class="img-fluid rounded" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    @if (session()->has('errorLogin'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('errorLogin') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <script>
                            swal({
                                title: "Berhasil Keluar",
                                text: "{{ session('success') }}",
                                icon: "success",
                            });
                        </script>
                    @endif

                    <form method="POST" action="/login">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form1Example13">Email address</label>
                            <input type="email" id="form1Example13" class="form-control form-control-lg" name="email" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form1Example23">Password</label>
                            <input type="password" id="form1Example23" class="form-control form-control-lg"
                                name="password" />
                        </div>



                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block w-100">Login</button>

                        <div class="my-4 text-center">
                            <p class="fw-bold">OR</p>
                        </div>

                        <a class="btn btn-lg btn-block w-100 text-white" style="background-color: black"
                            href="{{ url('register') }}" role="button">
                            <i class="me-2"></i>
                            Register</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
