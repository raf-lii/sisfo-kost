@extends("../../main")

@section("title", "Daftar Booking")

@section("content")
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Daftar Pesanan</h4>
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
                <h4 class="mb-3 header-title mt-0">Daftar Pesanan</h4>
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Booking ID</th>
                                <th>Kamar</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                        @php
                            $i = 1;
                            if($data->status_booking == "Lunas"){
                                $label = "success";
                            }else if($data->status_booking == "Belum Lunas"){
                                $label = "warning";
                            }else if($data->status_booking == "Kadaluarsa"){
                                $label = "error";
                            }
                        @endphp
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->invoice_id }}</td>
                                <td>{{ $data->nama_kamar }}</td>
                                <td>{{ $data->checkin }}</td>
                                <td>{{ $data->checkout }}</td>
                                <td><span class="badge bg-{{ $label }}">{{ $data->status_booking }}</span></td>
                                <td><a href="{{ route('detail.booking', [$data->invoice_id]) }}" class="badge bg-info"><i data-feather="eye"></i> Detail</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection