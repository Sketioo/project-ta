@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom-login.css') }}">
@endpush

@section('content')
<div class="container login-page-container">
    <div class="login-container">
        <div class="row g-0">
            <!-- Kolom Kiri (Welcome Panel) -->
            <div class="col-lg-6 login-welcome-panel">
                <div class="welcome-content text-center">
                    <i class="fas fa-graduation-cap welcome-icon"></i>
                    <h2 class="welcome-title">Selamat Datang Kembali!</h2>
                    <p class="welcome-text">Sistem Informasi Program Studi TRPL. Silakan masuk untuk melanjutkan.</p>
                </div>
            </div>

            <!-- Kolom Kanan (Form Panel) -->
            <div class="col-lg-6 login-form-panel">
                <div class="card-body login-body-v2">
                    <div class="login-header-v2 text-center mb-4">
                        <h3 class="mb-0">{{ __('Login Akun') }}</h3>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 input-group-v2">
                            <span class="input-group-text-v2"><i class="fas fa-user"></i></span>
                            <input id="username" type="text" class="form-control login-input-v2 @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 input-group-v2">
                            <span class="input-group-text-v2"><i class="fas fa-lock"></i></span>
                            <input id="password" type="password" class="form-control login-input-v2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <div>
                                    <a class="btn btn-link login-link-v2" href="{{ route('password.request') }}">
                                        {{ __('Lupa Password?') }}
                                    </a>
                                </div>
                            @endif
                        </div>


                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary login-button-v2">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Menghapus footer dari halaman login jika ada
    document.addEventListener('DOMContentLoaded', function() {
        const footer = document.querySelector('.custom-footer');
        if (footer) {
            footer.style.display = 'none';
        }
    });
</script>
@endpush