@extends('layouts.index')

@section('container')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tambah Gambar Banner</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('banners')}}">List Gambar</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="card w-75 mx-auto">
                <div class="card-body">
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <li>{{ $error }}</li>
                    </div>
                    @endforeach
                    <h5 class="card-title text-center">Tambah Gambar Banner</h5>
                    <!-- No Labels Form -->
                    <form class="row g-3" method="POST" action="/banners" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 mt-5">
                            <img class="mx-auto" id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; max-height: 200px; margin-bottom: 2rem; display: none;">
                            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                        </div>

                        <div class="text-center">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form><!-- End No Labels Form -->

                </div>
            </div>

        </div>
        </div>
    </section>

</main><!-- End #main -->
<script>
    function previewImage(event) {
        var imagePreview = document.getElementById('imagePreview');
        imagePreview.style.display = 'block';
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection