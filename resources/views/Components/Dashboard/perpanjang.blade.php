@extends("../../main")

@section("title", "Perpanjang Kamar #". $data->invoice_id)

@section("content")
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Booking Checkout</h4>
        </div>
    </div>
</div>
<!-- end page title -->
@if(session('error'))
    <div class="alert alert-warning">
        {{ session('error') }}
    </div>
@enderror
<div class="row">
    <div class="col-md-6 col-12">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="mb-3 header-title mt-0">Data Pribadi</h4>
                <form action="{{ route('perpanjang.post', [$data->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}" readonly disabled>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Alamat Email</label>
                                <input type="email" id="email" class="form-control" name="email" value="{{ $data->email }}" readonly disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Nomor Handphone</label>
                            <div class="mb-3 input-group">
                                <div class="input-group-text">+62</div>
                                <input type="number" id="nomor" class="form-control" name="nomor" value="{{ $data->nomor }}" readonly disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Jenis Pembayaran</label>
                                <select class="form-control" id="jenisPembayaran">
                                    <option selected>Pilih</option>
                                    @foreach($KategoriPembayaran as $tipe)
                                    <option value="{{ $tipe->id }}">{{ $tipe->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Tipe Pembayaran</label>
                                <select id="tipePembayaran" name="tipe" class="form-control">
                                    <option>Pilih Jenis Pembayaran</option>
                                </select>
                                @error('tipe'))
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mt-3">
                        <button id="continuePayment" class="btn btn-danger btn-md">Lanjutkan Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <img src="https://ima-prm-buck.s3-ap-southeast-1.amazonaws.com/unit/medium/Kost_Duren_Sawit_Getere_Main-1613037232.jpg" class="card-img">
                    </div>
                    <div class="col-md-7">
                        <h4 class="fw-bold">{{ $NamaKost }}</h4>
                        <h5 class="fw-light">{{ $AlamatKost }}</h5>
                    </div>
                </div>
                <div class="mt-2 fw-light text-dark">
                    <span class="text-dark">Check-in : {{ $CheckIn }} ( Setelah 14:00 )</span><br>
                    <span class="text-dark">Check-out : {{ $CheckOut }} ( Sebelum 12:00 )</span><br>
                </div>
                <div class="alert alert-secondary mt-2">
                    <h4 class="header-title mt-0 fs-1">Harus Dibayar</h4>
                    <span class="text-dark fw-light">Jangka Waktu ( {{ $CheckIn . " - " . $CheckOut }} )</span><br>
                    <div class="row">
                        <div class="col-6">
                            <span class="text-dark fw-light">Biaya Penambahan Waktu Sewa ( 1 Bulan )</span>
                        </div>
                        <div class="col-6">
                            <span class="text-dark fw-light float-end">Rp. {{ number_format($BiayaSewa, 0, ',', '.') }}</span><br>
                        </div>
                    </div>
                    <div class="row border-dark border-top mt-2">
                        <div class="col-6">
                            <span class="text-dark fw-bold">Total Pembayaran</span>
                        </div>
                        <div class="col-6">
                            <span class="text-danger fw-bold float-end">Rp. {{ number_format($BiayaSewa, 0, ',', '.') }}</span>
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
        $("#jenisPembayaran").change(function() {
            var jenisPembayaran = $("#jenisPembayaran option:selected").val();

            $.ajax({
                url: "<?php echo route('ajax.tipePembayaran') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    "_token": "<?php echo csrf_token() ?>",
                    "kategoriPembayaran": jenisPembayaran
                },
                success: function(res) {
                    $("#tipePembayaran").empty();
                    $("#tipePembayaran").append("<option value=''>Pilih Tipe Pembayaran</option>")
                    $.each(res.data, function(curr, index) {
                        var el = `<option value='${index.id}' id='tipe'>${index.nama}</option>`;
                        $("#tipePembayaran").append(el)
                    });

                }
            });
        });
    });
</script>
@endsection