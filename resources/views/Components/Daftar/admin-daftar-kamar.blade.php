@extends("main")

@section("title", "Daftar Kamar")

@section("content")
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Admin/Daftar Kamar</h4>
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
                <h4 class="mb-3 header-title mt-0">Tambah Kamar</h4>
                <form action="{{ route('admin.tambah.kamar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                        <label class="col-lg-2 col-form-label" for="example-fileinput">Gambar</label>
                        <div class="col-lg-10">
                            <input type="file" class="form-control" name="thumbnail">
                            @error('thumbnail')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-lg-2 col-form-label">Harga</label>
                        <div class="col-lg-10">
                            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}">
                            @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-lg-2 col-form-label">Stock</label>
                        <div class="col-lg-10">
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}">
                            @error('stock')
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
                <h4 class="mb-3 header-title mt-0">Daftar Kamar</h4>
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Thumbnail</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Created At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($datas as $data)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $data->nama }}</td>
                                <td><img src="{{ $data->gambar }}" width="100px"></td>
                                <td>Rp. {{ number_format($data->harga, 0, ',', '.') }}</td>
                                <td>{{ $data->stock }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.hapus.kamar', [$data->id]) }}" class="badge bg-danger"><i data-feather="trash"></i> Delete</a>
                                    <a href="javascript:;" onclick="modal('{{ $data->nama }}', '<?php  echo route('admin.detail.kamar', [$data->id]) ?>')" class="badge bg-info"><i data-feather="edit"></i> Edit</a>
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