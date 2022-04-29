@extends("main")

@section("title", "Pengaturan Kost")

@section("content")
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Admin/Pengaturan Kost</h4>
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
                <h4 class="mb-3 header-title mt-0">Pengaturan Kost</h4>
                <form action="{{ route('admin.update.pengaturan-kost') }}" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="example-fileinput">Nama Kost</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ $data[0] }}" name="nama">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-lg-2 col-form-label">Deskripsi</label>
                        <div class="col-lg-10">
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ $data[1] }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-lg-2 col-form-label">Alamat</label>
                        <div class="col-lg-10">
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ $data[2] }}</textarea>
                            @error('alamat')
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
</div>
@endsection