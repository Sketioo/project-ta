@extends('layouts.app')

{{-- @push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/custom-login.css') }}">
@endpush --}}

@section('content')
<div class="container login-page-container">
    <div class="login-container">
        <div class="row g-0">
            <!-- Kolom Kiri (Welcome Panel) -->
            <div class="col-lg-6 login-welcome-panel">
                <div class="welcome-content text-center">
                    <i class="fas fa-graduation-cap welcome-icon animate__animated animate__fadeInDown" data-animation="animate__fadeInDown"></i>
                    <h2 class="welcome-title animate__animated animate__fadeInUp" data-animation="animate__fadeInUp">Selamat Datang Kembali!</h2>
                    <p class="welcome-text animate__animated animate__fadeInUp" data-animation="animate__fadeInUp" data-animation-delay="0.2s">Sistem Informasi Program Studi TRPL. Silakan masuk untuk melanjutkan.</p>
                    
                </div>
            </div>

            <!-- Kolom Kanan (Form Panel) -->
            <div class="col-lg-6 login-form-panel">
                <div class="card-body login-body-v2">
                    <div class="login-header-v2 text-center mb-4">
                        <i class="fas fa-user-circle login-icon-form mb-3" style="font-size: 3rem; color: var(--primary-color);"></i>
                        <h3 class="mb-0">{{ __('Login Akun') }}</h3>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 input-group-v2">
                            <span class="input-group-text-v2"><i class="fas fa-user"></i></span>
                            <input id="username" type="text" class="form-control login-input-v2 @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
                        </div>

                        <div class="mb-3 input-group-v2">
                            <span class="input-group-text-v2"><i class="fas fa-lock"></i></span>
                            <input id="password" type="password" class="form-control login-input-v2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
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

                    <div class="text-center mt-4">
                        <p class="register-link-text">Belum punya akun? <a href="#">Hubungi Administrator</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const footer = document.querySelector('.custom-footer');
            if (footer) {
                footer.style.display = 'none';
            }

            @if ($errors->any())
                let title = 'Terjadi Kesalahan Validasi!';
                let htmlMessage = '<ul>';

                @if ($errors->has('username') || $errors->has('password'))
                    htmlMessage += '<li>Kredensial yang Anda masukkan tidak cocok dengan catatan kami.</li>';
                @else
                    @foreach ($errors->all() as $error)
                        htmlMessage += '<li>{{ $error }}</li>';
                    @endforeach
                @endif
                htmlMessage += '</ul>';

                Swal.fire({
                    icon: 'error',
                    title: title,
                    html: htmlMessage,
                    showConfirmButton: true,
                    timer: 5000,
                    timerProgressBar: true,
                    position: 'center',
                    backdrop: true,
                });
            @endif
        });
    </script>
@endpush