@extends("main")

@section("title", "Tipe Pembayaran")

@section("content")
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Admin/Tipe Pembayaran</h4>
        </div>
    </div>
</div>
<!-- end page title -->
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="mb-3 header-title mt-0">Tambah Tipe Pembayaran</h4>
                <form action="{{ route('admin.tambah.tipe-pembayaran') }}" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="example-fileinput">Kategori Pembayaran</label>
                        <div class="col-lg-10">
                            <select class="form-control" name="kategori_pembayaran" id="">
                                <option selected>Pilih kategori</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="example-fileinput">Nama</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" name="nama">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                     <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="example-fileinput">Kode Channel</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('kode_channel') is-invalid @enderror" value="{{ old('kode_channel') }}" name="kode_channel">
                            @error('kode_channel')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>               
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="mb-3 header-title mt-0">Daftar Tipe Pembayaran</h4>
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kategori Pembayaran</th>
                                <th>Nama</th>
                                <th>Kode Channel</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($datas as $data)
                            @php
                            if($data->status == "active"){
                                $label = "success";
                            }else if($data->status == "inactive"){
                                $label = "warning";
                            }
                            @endphp
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $data->nama_kategori }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->kode_channel }}</td>
                                <td><span class="badge bg-{{ $label }}">{{ $data->status }}</span></td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.hapus.tipe-pembayaran', [$data->id]) }}" class="btn btn-danger btn-sm"><i data-feather="trash"></i> Delete</a>
                                    <div class="btn-group-vertical">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-{{$label}} dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="chevron-down"></i> Ubah Status </button>
                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <li><a class="dropdown-item" href="{{ route('admin.update.tipe-pembayaran', [$data->id, 'inactive']) }}">inactve</a></li>
                                            <li><a class="dropdown-item" href="{{ route('admin.update.tipe-pembayaran', [$data->id, 'active']) }}">active</a></li>
                                        </ul>
                                    </div>
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