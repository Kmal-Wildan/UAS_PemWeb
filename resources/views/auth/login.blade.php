@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="auth-card">
    <div class="auth-card-header text-center">
        <div class="auth-logo">
            <i class="bi bi-shield-lock"></i>
        </div>
        <h2 class="auth-title">Selamat Datang</h2>
        <p class="auth-subtitle">Masuk ke {{ config('app.name', 'UAS PEMWEB') }}</p>
    </div>

    <div class="auth-card-body">
        @if(session('error'))
            <div class="alert alert-danger py-2">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger py-2">
                <ul class="mb-0 small">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" id="loginForm">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="admin@gmail.com"
                           required
                           autofocus>
                </div>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           name="password"
                           placeholder="••••••••"
                           required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-login" id="btnLogin">
                <span class="btn-text"><i class="bi bi-box-arrow-in-right me-2"></i>Masuk</span>
                <span class="btn-loading d-none">
                    <span class="spinner-border spinner-border-sm me-2"></span>Memproses...
                </span>
            </button>
        </form>

        <div class="auth-demo mt-4">
            <p class="text-muted small mb-2 text-center">Akun demo (password: <code>password123</code>):</p>
            <div class="row g-2">
                <div class="col-6">
                    <div class="demo-account">
                        <strong>Admin</strong>
                        <small>admin@gmail.com</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="demo-account">
                        <strong>User</strong>
                        <small>user@gmail.com</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#togglePassword').on('click', function () {
            const input = $('#password');
            const icon = $(this).find('i');
            const isPassword = input.attr('type') === 'password';
            input.attr('type', isPassword ? 'text' : 'password');
            icon.toggleClass('bi-eye bi-eye-slash');
        });

        $('#loginForm').on('submit', function () {
            $('#btnLogin .btn-text').addClass('d-none');
            $('#btnLogin .btn-loading').removeClass('d-none');
            $('#btnLogin').prop('disabled', true);
        });
    });
</script>
@endpush
