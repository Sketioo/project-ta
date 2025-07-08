@extends('layouts.app')

@section('title', 'Selamat Datang di Poliwangi')

@section('content')

    <!-- Hero Section -->
    <section id="home" class="hero">
        <h1>Selamat Datang di Website Kami</h1>
        <p>Menyediakan informasi lengkap seputar Politeknik Negeri Banyuwangi.</p>
        <a href="#about" class="btn btn-primary">Pelajari Lebih Lanjut</a>
    </section>

    <!-- About Section -->
    <section id="about" class="content-section">
        <div class="container">
            <h2 class="section-title">Tentang Kami</h2>
            <p style="max-width: 800px; margin: 0 auto 40px auto;">Politeknik Negeri Banyuwangi (Poliwangi) adalah perguruan tinggi negeri yang berlokasi di Banyuwangi, Jawa Timur. Kami berkomitmen untuk menghasilkan lulusan yang kompeten dan siap kerja di bidang rekayasa dan tata niaga.</p>
            <div class="grid-container">
                <div class="card">
                    <h3>Visi</h3>
                    <p>Menjadi politeknik unggul yang menghasilkan lulusan berkarakter dan berdaya saing di tingkat nasional maupun internasional.</p>
                </div>
                <div class="card">
                    <h3>Misi</h3>
                    <p>Menyelenggarakan pendidikan vokasi yang berkualitas, inovatif, dan relevan dengan kebutuhan industri. Mengembangkan penelitian terapan dan pengabdian kepada masyarakat untuk kemajuan bangsa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="content-section">
        <div class="container">
            <h2 class="section-title">Layanan Kami</h2>
            <div class="grid-container">
                <div class="card">
                    <h3>Pendidikan Vokasi</h3>
                    <p>Program studi D3 dan D4 yang dirancang untuk memenuhi kebutuhan industri dengan kurikulum yang relevan dan fasilitas modern.</p>
                </div>
                <div class="card">
                    <h3>Pusat Karir</h3>
                    <p>Membantu mahasiswa dan alumni dalam mempersiapkan karir, mulai dari pelatihan, informasi lowongan, hingga rekrutmen kampus.</p>
                </div>
                <div class="card">
                    <h3>Sistem Informasi</h3>
                    <p>Menyediakan sistem informasi akademik dan non-akademik yang terintegrasi untuk kemudahan akses bagi seluruh civitas akademika.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="content-section">
        <div class="container">
            <h2 class="section-title">Hubungi Kami</h2>
            <p style="max-width: 800px; margin: 0 auto 40px auto;">Jika Anda memiliki pertanyaan atau memerlukan informasi lebih lanjut, jangan ragu untuk menghubungi kami melalui detail kontak di bawah ini.</p>
            <div class="card" style="max-width: 600px; margin: 0 auto; text-align: left;">
                <p><strong>Alamat:</strong> Jl. Raya Jember No.KM 13, Labanasem, Kabat, Banyuwangi, Jawa Timur 68461</p>
                <p><strong>Telepon:</strong> (0333) 636780</p>
                <p><strong>Email:</strong> <a href="mailto:poliwangi@poliwangi.ac.id">poliwangi@poliwangi.ac.id</a></p>
            </div>
        </div>
    </section>

@endsection
