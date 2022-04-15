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
                    <div class="col-md-8 col-12">
                        <span class="badge bg-primary fs-13">Campur</span>
                        <h5 class="fs-1 mt-2">{{ $namaKost }}</h5>
                        <p class="text-mute mt-2">{{ $alamatKost }} - <a href="https://goo.gl/maps/U3qYrY3QA6DTB1E48">View on Map</a></p>
                        <p class=" text-mute mt-2">{{ $deskripsiKost }}</p>
                    </div>
                    <div class="col-md-4 col-12">
                        <iframe class="mt-2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2125064506986!2d106.91808451404425!3d-6.235695762798581!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cc9c9979b19%3A0x774d362800371451!2sJl.%20Pendidikan%20XI%20No.2%2C%20Duren%20Sawit%2C%20Kec.%20Duren%20Sawit%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2013440!5e0!3m2!1sen!2sid!4v1649779875783!5m2!1sen!2sid" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="col-md-12 col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Check In</label>
                            <div class="input-group">
                                <div class="input-group-text"><i data-feather="calendar"></i></div>
                                <input type="text" class="form-control" id="checkIn">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Check Out</label>
                        <div class="input-group">
                            <div class="input-group-text"><i data-feather="calendar"></i></div>
                            <input type="text" class="form-control" id="checkOut">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        @foreach($daftarKamar as $kamar)
        <div class="card shadow">
            <div class="row g-0 align-items-center">
                <div class="col-md-4">
                    <img src="{{ $kamar->gambar }}" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title fs-16">{{ $kamar->nama }}</h5>
                                <span class="card-text text-muted">
                                    <small class="mx-2"><i data-feather="tv"></i> TV</small>
                                    <small class="mx-2"><i data-feather="wind"></i> AC</small>
                                    <small class="mx-2"><i data-feather="clipboard"></i> Bed</small>
                                    <small class="mx-2"><i data-feather="wifi"></i> Wifi</small>
                                </span>
                                <h5 class="text-danger float-end mt-3 fs-16">Rp {{ number_format($kamar->harga, 0, '.', ',') }} / Bulan</h5>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <input id="{{ $kamar->id }}" class="btn-check" type="radio" name="kamar" autocomplete="off" value="{{ $kamar->id }}">
                                    <label class="btn btn-outline-dark mt-2 btn-md" for="{{ $kamar->id }}">Pilih Kamar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="col-md-6 col-12">
        <div class="card shadow">
            <div class="card-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#summary" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                            <span class="d-block d-sm-none"><i data-feather="book-open"></i></span>
                            <span class="d-none d-sm-block">Ringkasan Pemesanan</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane show active" id="summary">
                        <div id="bookingDetail">
                            <p>- Pemesanan mudah</p>
                            <p>- Pembayaran dilakukan dengan cepat dan otomatis</p>
                        </div>
                        <div class="d-grid">
                            <button id="continuePayment" class="btn btn-danger btn-md">Lanjutkan Pembayaran</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        var strArray = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $("#checkIn").flatpickr({
            defaultDate: "today",
            allowInput: true,
            minDate: "today",
            dateFormat: "d M Y",
            onChange: function(selectedDates, dateStr) {
                var date = new Date(dateStr).fp_incr(30);
                $("#checkOut").val(date.getDate() + " " + strArray[date.getMonth()] + " " + date.getFullYear());
            }
        })

        $("#checkOut").flatpickr({
            minDate: new Date($("#checkIn").val()).fp_incr(30),
            defaultDate: new Date($("#checkIn").val()).fp_incr(30),
            allowInput: true,
            dateFormat: "d M Y",
            onChange: function(selectedDates, dateStr) {
                var date = new Date(dateStr).fp_incr(-30);
                $("#checkIn").val(date.getDate() + " " + strArray[date.getMonth()] + " " + date.getFullYear());
            }
        })

        $("input[type=radio][name=kamar]").change(function() {
            var kamar = $("input[name=kamar]:checked").val();
            var checkIn = $("#checkIn").val();
            var checkOut = $("#checkOut").val();

            $.ajax({
                url: "<?php echo route('dashboard.post'); ?>",
                type: "POST",
                data: {
                    "_token": "<?php echo csrf_token(); ?>",
                    "kamar": kamar,
                    "checkIn": checkIn,
                    "checkOut": checkOut
                },
                success: function(res) {
                    $("#bookingDetail").empty();
                    $("#bookingDetail").html(res);
                },
                error: function(e) {
                    $("#bookingDetail").empt();
                    $("#bookingDetail").html("<p class='text-danger fs-5'>Terjadi kesalahan harap reload page</p>")
                }
            })
        })

        $("#continuePayment").on("click", function() {
            console.log("tes");
            var kamar = $("input[name=kamar]:checked").val();
            var checkIn = $("#checkIn").val();
            var checkOut = $("#checkOut").val();

            location.href = "<?php echo env('APP_URL'); ?>/booking?kamar="+kamar+"&checkIn="+checkIn+"&checkOut="+checkOut;
        });
    })
</script>
@endsection