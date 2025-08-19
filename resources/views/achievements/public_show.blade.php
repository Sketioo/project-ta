@extends('layouts.app')

@section('title', $achievement->nama_kompetisi . ' - ' . $achievement->prestasi . ' - Sistem Informasi Prodi TRPL')

@section('content')
    <div class="container py-5 agenda-detail-container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <article class="agenda-article" data-animation="animate__fadeInUp">
                    <h1 class="agenda-article-title text-center mb-3">{{ $achievement->nama_kompetisi }} - {{ $achievement->prestasi }}</h1>
                    <div class="agenda-article-meta text-center text-muted mb-5">
                        <i class="fas fa-calendar-alt me-1"></i> {{ $achievement->tanggal_pelaksanaan->format('d F Y') }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-trophy me-1"></i> {{ $achievement->tingkat_kompetisi }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-building me-1"></i> {{ $achievement->penyelenggara }}
                        @if($achievement->jenis_lomba)
                            <span class="mx-2">•</span>
                            <i class="fas fa-users me-1"></i> {{ ucfirst($achievement->jenis_lomba) }}
                        @endif
                    </div>

                    @if($achievement->photos_dokumentasi && count($achievement->photos_dokumentasi) > 0)
                        @if(count($achievement->photos_dokumentasi) > 1)
                            <div id="achievementCarousel" class="carousel slide agenda-carousel mb-4" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach($achievement->photos_dokumentasi as $index => $photoPath)
                                        <button type="button" data-bs-target="#achievementCarousel" data-bs-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach($achievement->photos_dokumentasi as $index => $photoPath)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $photoPath) }}" class="d-block w-100" alt="Dokumentasi Prestasi {{ $achievement->nama_kompetisi }} Image {{ $index + 1 }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#achievementCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#achievementCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <div class="agenda-article-main-image mb-4">
                                <img src="{{ asset('storage/' . $achievement->photos_dokumentasi[0]) }}" alt="{{ $achievement->nama_kompetisi }}" class="img-fluid rounded shadow-sm">
                            </div>
                        @endif
                    @else
                        <div class="agenda-article-main-image mb-4">
                            <img src="https://via.placeholder.com/800x400.png/cccccc/ffffff?text=No+Image" alt="No Image" class="img-fluid rounded shadow-sm">
                        </div>
                    @endif

                    <div class="agenda-article-content mb-5">
                        @if($achievement->jenis_lomba === 'kelompok')
                            @php
                                // Parse team member information from keterangan_lomba
                                $lines = explode("\n", $achievement->keterangan_lomba);
                                $teamInfo = [];
                                $keteranganLomba = [];
                                $isTeamInfo = false;
                                $isKeterangan = false;
                                
                                foreach($lines as $line) {
                                    if (strpos($line, 'Jenis Lomba:') === 0) {
                                        $isTeamInfo = true;
                                        continue;
                                    }
                                    
                                    if (strpos($line, 'Data Anggota:') === 0) {
                                        $isTeamInfo = true;
                                        continue;
                                    }
                                    
                                    if (strpos($line, 'Keterangan Lomba:') === 0) {
                                        $isTeamInfo = false;
                                        $isKeterangan = true;
                                        continue;
                                    }
                                    
                                    if ($isTeamInfo && trim($line) !== '') {
                                        $teamInfo[] = $line;
                                    } elseif ($isKeterangan || (trim($line) !== '' && !$isTeamInfo)) {
                                        $keteranganLomba[] = $line;
                                    }
                                }
                            @endphp
                            
                            @if(count($teamInfo) > 0)
                                <h5 class="mb-3">{{ __('messages.team_members') }}</h5>
                                <ul class="list-group mb-4">
                                    @foreach($teamInfo as $member)
                                        <li class="list-group-item">{{ $member }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            
                            @if(count($keteranganLomba) > 0)
                                <h5 class="mb-3">{{ __('messages.competition_details') }}</h5>
                                <p>{{ implode("\n", $keteranganLomba) }}</p>
                            @endif
                        @else
                            <p>{{ $achievement->keterangan_lomba }}</p>
                        @endif
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{ route('home') }}#prestasi" class="btn btn-outline-secondary agenda-back-btn" data-animation="animate__fadeInUp" data-animation-delay="0.2s"><i class="fas fa-arrow-left me-2"></i>{{ __('messages.back_to_achievements') }}</a>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
