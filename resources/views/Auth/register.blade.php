@extends("main-auth")

@section("title", "Daftar")

@section("content")
<div class="card">
    <div class="card-body p-0">
        <div class="row g-0">
            <div class="col-lg-6 p-4">
                <div class="mx-auto">
                    <a href="index-2.html">
                        <img src="assets/images/logo-dark.png" alt="" height="24" />
                    </a>
                </div>

                <p class="text-muted mt-1 mb-4">Daftar sekarang, dan pilih kamar favorite anda.</p>

                <form action="{{ route('register.post') }}" method="POST" class="authentication-form">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="icon-dual" data-feather="user"></i>
                            </span>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama lengkap" value="{{ old('nama') }}">
                        </div>
                        @error("nama")
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="icon-dual" data-feather="user"></i>
                            </span>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username" value="{{ old('username') }}">
                        </div>
                        @error("username")
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="icon-dual" data-feather="lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password">
                        </div>
                        @error("password")
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3 text-center d-grid">
                        <button class="btn btn-primary" type="submit">Daftar</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 d-none d-lg-inline-block">
                <div class="auth-page-sidebar">
                    <div class="overlay"></div>
                    <div class="auth-user-testimonial">
                        <p class="fs-24 fw-bold text-white mb-1">I simply love it!</p>
                        <p class="lead">"It's a elegent templete. I love it very much!"</p>
                        <p>- Admin User</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-body -->
</div>
<!-- end card -->

<div class="row mt-3">
    <div class="col-12 text-center">
        <p class="text-muted">Sudah memiliki akun? <a href="{{ route('login') }}" class="text-primary fw-bold ms-1">Masuk</a></p>
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection