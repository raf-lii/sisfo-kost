@extends("../../main")

@section("title", "Detail #".$data->invoice_id)

@section("content")
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Detail Pesanan</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Logo & title -->
                <div class="clearfix">
                    <div class="float-sm-end">
                        <img src="assets/images/logo-dark.png" alt="" height="24" />
                        <address class="mt-2">
                            {{ $alamatKost }}
                        </address>
                    </div>
                    <div class="float-sm-start">
                        <h4 class="m-0 d-print-none">Invoice</h4>
                        <dl class="row mb-2 mt-3">
                            <dt class="col-sm-3 fw-normal">Nomor Pesanan :</dt>
                            <dd class="col-sm-9 fw-normal">#{{ $data->invoice_id }}</dd>

                            <dt class="col-sm-3 fw-normal">Check-in :</dt>
                            <dd class="col-sm-9 fw-normal">{{ $data->checkin }}</dd>

                            <dt class="col-sm-3 fw-normal">Check-out :</dt>
                            <dd class="col-sm-9 fw-normal">{{ $data->checkout }}</dd>
                        </dl>
                    </div>

                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6 class="fw-normal">Pesanan atas Nama :</h6>
                        <h6 class="fs-16">{{ $data->nama }}</h6>
                        <address>
                            {{ $data->email }}<br>
                            <abbr title="Phone">P:</abbr> (62) {{ $data->nomor }}
                        </address>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="text-md-end">
                            <h6 class="fw-normal">Total</h6>
                            <h2>Rp. {{ number_format($data->harga, 0, ',', '.') }}</h2>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mt-4 table-centered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Pesanan</th>
                                        <th>Status Pembayaran</th>
                                        <th style="width: 15%">Jangka Waktu</th>
                                        <th style="width: 15%" class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <h5 class="fs-16 mt-0 mb-2">{{ $data->kamar }}</h5>
                                        </td>
                                        <td>{{ $data->status_pembayaran }}</td>
                                        <td>{{ $jangkaWaktu }} Bulan</td>
                                        <td class="text-end">Rp. {{ number_format($data->harga, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-6">
                        <div class="clearfix pt-5">
                            <h6 class="text-muted">Catatan:</h6>

                            <small class="text-muted">
                                Harap menunjukkan invoice ini ketika akan melakukan check-in.
                            </small>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="float-end mt-4">
                            <p><span class="fw-medium">Sub-total :</span>
                                <span class="float-end">Rp. {{ number_format($data->harga, 0, ',', '.') }}</span>
                            </p>
                            <h3>Rp. {{ number_format($data->harga, 0, ',', '.') }}</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="mt-5 mb-1">
                    <div class="text-end d-print-none">
                        <a href="javascript:window.print()" class="btn btn-primary">
                            <i class="uil uil-print me-1"></i> Print</a>
                        <a href="#" class="btn btn-info">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection