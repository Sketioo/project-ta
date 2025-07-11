<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Prodi')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="d-flex flex-column min-vh-100">

    @include('components.header')

    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include('components.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Floating Suggestion Button -->
    <button class="btn btn-primary floating-btn" data-bs-toggle="modal" data-bs-target="#suggestionModal">
        <i class="fas fa-comment-dots"></i>
    </button>

    <!-- Suggestion Modal -->
    <div class="modal fade" id="suggestionModal" tabindex="-1" aria-labelledby="suggestionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header custom-modal-header">
                    <h5 class="modal-title" id="suggestionModalLabel">Saran & Keluhan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body custom-modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="modalName" class="form-label contact-label">Nama</label>
                            <input type="text" class="form-control contact-input" id="modalName">
                        </div>
                        <div class="mb-3">
                            <label for="modalEmail" class="form-label contact-label">Email</label>
                            <input type="email" class="form-control contact-input" id="modalEmail">
                        </div>
                        <div class="mb-3">
                            <label for="modalMessage" class="form-label contact-label">Pesan</label>
                            <textarea class="form-control contact-textarea" id="modalMessage" rows="5"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary contact-button">Kirim Pesan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
