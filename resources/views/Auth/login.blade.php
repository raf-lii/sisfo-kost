@extends("main-auth")

@section("title", "Masuk")

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

                <p class="text-muted mt-1 mb-4">
                    Masuk sekarang dan cari kamar favorite anda.
                </p>

                @if(session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif
                <form action="{{ route('login.post') }}" method="POST" class="authentication-form">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="icon-dual" data-feather="user"></i>
                            </span>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username anda" required>
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
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password anda" required>
                        </div>
                        @error("password")
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3 text-center d-grid">
                        <button class="btn btn-primary" type="submit">Masuk</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 d-none d-md-inline-block">
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
        <p class="text-muted">Belum memiliki akun? <a href="{{ route('register') }}" class="text-primary fw-bold ms-1">Daftar</a></p>
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection