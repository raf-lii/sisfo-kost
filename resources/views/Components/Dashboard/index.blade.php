@extends("../../main")

@section("title", "Dashboard")

@section("content")
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card shadow">
            <div class="card-body">
                <img src="https://ima-prm-buck.s3-ap-southeast-1.amazonaws.com/unit/medium/Kost_Duren_Sawit_Getere_Main-1613037232.jpg" class="img-thumbanil" width="100%">
                <div class="row mt-4">
                    <div class="col-8">
                        <span class="badge bg-primary fs-13">Campur</span>
                        <h5 class="fs-1 mt-2">{{ $namaKost }}</h5>
                        <p class="text-mute mt-2">{{ $alamatKost }} - <a href="https://goo.gl/maps/U3qYrY3QA6DTB1E48">View on Map</a></p>
                        <p class=" text-mute mt-2">{{ $deskripsiKost }}</p>
                    </div>
                    <div class="col-4">
                        <iframe class="mt-2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2125064506986!2d106.91808451404425!3d-6.235695762798581!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cc9c9979b19%3A0x774d362800371451!2sJl.%20Pendidikan%20XI%20No.2%2C%20Duren%20Sawit%2C%20Kec.%20Duren%20Sawit%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2013440!5e0!3m2!1sen!2sid!4v1649779875783!5m2!1sen!2sid" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card shadow">
            <div class="row g-0 align-items-center">
                <div class="col-md-4">
                    <img src="https://ima-prm-buck.s3-ap-southeast-1.amazonaws.com/unit/medium/Comfort_Trundle_Bed_Main-1613037287.jpg" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title fs-16">Comfort Trundel Bed</h5>
                                <span class="card-text text-muted">
                                    <small class="mx-2"><i data-feather="tv"></i> TV</small>
                                    <small class="mx-2"><i data-feather="wind"></i> AC</small>
                                    <small class="mx-2"><i data-feather="clipboard"></i> Bed</small>
                                    <small class="mx-2"><i data-feather="wifi"></i> Wifi</small>
                                </span>
                                <h5 class="text-danger float-end mt-3 fs-16">Rp 3.000.000 / Bulan</h5>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-outline-dark mt-2 btn-md">Pilih Kamar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection