@extends('frontend.index')

@section('container')
<section class="h-100 h-custom" style="background-color: grey;">
    <div class="container py-5 h-100 mt-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="pt-5">
                                    <a href="/home" class="btn btn-secondary ms-5 bi bi-box-arrow-in-left"><i class="fas fa-long-arrow-alt-left me-2"></i>Kembali Berbelanja</a>
                                </div>
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h4 class="fw-bold mb-0 text-black mx-auto">Lakukan pembayaran sebanyak Rp. {{ number_format($data->total_pembayaran)}}</h4>
                                    </div>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Transfer Bank
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body d-flex align-items-center">
                                                    <img src="/img/mandiri.png" alt="Logo Mandiri" style="width: 5rem;">
                                                    <p class="ms-4">YVE.ID : 1110017107430</p>
                                                </div>
                                                <hr class="">
                                                <div class="accordion-body d-flex align-items-center">
                                                    <img src="/img/bri.png" alt="Logo Mandiri" style="width: 5rem;">
                                                    <p class="ms-4">YVE.ID : 1110017107430</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    E-Wallet
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body d-flex align-items-center">
                                                    <img src="/img/dana.png" alt="Logo Dana" style="width: 4rem;">
                                                    <p class="ms-4">YVE.ID : 1110017107430</p>
                                                </div>
                                                <hr class="">
                                                <div class="accordion-body d-flex align-items-center">
                                                    <img src="/img/ovo.png" alt="Logo Ovo" style="width: 4rem;">
                                                    <p class="ms-4">YVE.ID : 1110017107430</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                    Accordion Item #3
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <form action="{{ url('pembayaran-selesai') }}/{{$data->id}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-12 mt-5">
                                                    <h5 for="image" class="form-label my-3">Upload bukti pembayaran</h5>
                                                    <img class="mx-auto" id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; max-height: 200px; margin-bottom: 2rem; display: none;">
                                                    <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                                                </div>
                                                <button class="btn btn-dark mt-3">Saya sudah bayar</button>
                                            </form>
                                        </div>
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
<script>
    function previewImage(event) {
        var imagePreview = document.getElementById('imagePreview');
        imagePreview.style.display = 'block';
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection