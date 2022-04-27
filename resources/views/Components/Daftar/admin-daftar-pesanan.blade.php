@extends("main")

@section("title", "Daftar Pesanan")

@section("content")
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Admin/Daftar Pesanan</h4>
        </div>
    </div>
</div>
<!-- end page title -->
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="mb-3 header-title mt-0">Daftar Pesanan Pengguna</h4>
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Username</th>
                                <th>Booking ID</th>
                                <th>Kamar</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($datas as $data)
                            @php
                            if($data->status_booking == "Lunas"){
                            $label = "success";
                            }else if($data->status_booking == "Menunggu Pembayaran"){
                            $label = "warning";
                            }else if($data->status_booking == "Kadaluarsa"){
                            $label = "error";
                            }
                            @endphp
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->invoice_id }}</td>
                                <td>{{ $data->nama_kamar }}</td>
                                <td>{{ $data->checkin }}</td>
                                <td>{{ $data->checkout }}</td>
                                <td><span class="badge bg-{{ $label }}">{{ $data->status_booking }}</span></td>
                                <td>
                                    <a href="javascript:;" onclick="modal('Detail Pesanan #{{ $data->invoice_id }}','{{ route('admin.detail.booking', [$data->invoice_id]) }}')" class="badge bg-info"><i data-feather="eye"></i> Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $datas->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function modal(name, link) {
        var myModal = new bootstrap.Modal($('#modal-detail'))
        $.ajax({
            type: "GET",
            url: link,
            beforeSend: function() {
                $('#modal-detail-title').html(name);
                $('#modal-detail-body').html('Loading...');
            },
            success: function(result) {
                $('#modal-detail-title').html(name);
                $('#modal-detail-body').html(result);
            },
            error: function() {
                $('#modal-detail-title').html(name);
                $('#modal-detail-body').html('There is an error...');
            }
        });
        myModal.show();
    }
</script>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modal-detail" style="border-radius:7%">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-detail-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-detail-body"></div>
        </div>
    </div>
</div>
@endsection