@extends("../../main")

@section("title", "Booking Checkout")

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
<div class="row">
    <div class="col-md-6 col-12">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="mb-3 header-title mt-0">Data Pribadi</h4>
                <form>
                    <div class="mb-3">
                        <label class="form-label text-muted">Nama Lengkap</label>
                        <input type="text" class="form-control" id="" placeholder="Masukkan nama lengkap sesuai dengan tanda pengenal">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Alamat Email</label>
                                <input type="email" class="form-control" placeholder="email@gmail.com">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Nomor Handphone</label>
                            <div class="mb-3 input-group">
                                <div class="input-group-text">+62</div>
                                <input type="number" class="form-control" placeholder="Cth : 8971230123">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="alert alert-secondary">
            <h4 class="mb-3 header-title mt-0">Kebijakan Pembatalan</h4>
            <p>Pemesanan ini tidak dapat di refund</p>
        </div>
        <div class="border border-secondary bg-white p-2">
            <h4 class="mb-3 header-title mt-0 text-muted">Catatan Penting</h4>
            <ul>
                <li>Mohon pastikan nama yang tertera di data pribadi sama dengan nama yang ada di KTP anda.</li>
                <li>Jika anda membuat pesanan untuk orang lain, mohon untuk memberikan kode pesanan saat check-in.</li>
                <li>Pastkan tanggal check-in & check-out sudah benar ketika melakukan proses pesanan.</li>
                <li>Pelanggan diwajibkan memberikan tanda pengenal pada saat check-in.</li>
            </ul>
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
                            <span class="text-dark fw-light">Biaya Sewa ( {{ $PerbedaanBulan }} Bulan )</span>
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
                <div class="d-grid mt-3">
                    <button id="continuePayment" class="btn btn-danger btn-md">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection