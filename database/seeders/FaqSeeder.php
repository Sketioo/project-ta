<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'question' => 'Apa itu Program Studi TRPL?',
            'answer' => 'Program Studi Teknologi Rekayasa Perangkat Lunak (TRPL) adalah program pendidikan tinggi yang fokus pada pengembangan perangkat lunak, mulai dari perancangan, implementasi, pengujian, hingga pemeliharaan. Kami membekali mahasiswa dengan keterampilan praktis dan teoritis untuk menjadi profesional di bidang rekayasa perangkat lunak.',
        ]);

        Faq::create([
            'question' => 'Bagaimana prospek kerja lulusan TRPL?',
            'answer' => 'Lulusan TRPL memiliki prospek kerja yang sangat cerah di era digital ini. Mereka dapat berkarir sebagai Software Engineer, Web Developer, Mobile App Developer, Quality Assurance Engineer, Data Scientist, DevOps Engineer, dan berbagai peran lain di industri teknologi yang terus berkembang.',
        ]);

        Faq::create([
            'question' => 'Apa saja keunggulan belajar di TRPL Politeknik Negeri Banyuwangi?',
            'answer' => 'Keunggulan kami meliputi kurikulum berbasis industri, fasilitas laboratorium modern, dosen yang berpengalaman di bidangnya, serta program magang wajib yang memungkinkan mahasiswa mendapatkan pengalaman kerja nyata sebelum lulus. Kami juga memiliki kemitraan erat dengan perusahaan teknologi terkemuka.',
        ]);

        Faq::create([
            'question' => 'Apakah ada beasiswa yang tersedia untuk mahasiswa TRPL?',
            'answer' => 'Ya, Politeknik Negeri Banyuwangi menyediakan berbagai jenis beasiswa, baik dari pemerintah maupun swasta, yang dapat diajukan oleh mahasiswa TRPL. Informasi lebih lanjut mengenai jenis beasiswa, persyaratan, dan prosedur pendaftaran dapat diakses melalui bagian kemahasiswaan.',
        ]);

        Faq::create([
            'question' => 'Bagaimana cara menghubungi Program Studi TRPL?',
            'answer' => 'Anda dapat menghubungi kami melalui email di trpl@poliwangi.ac.id atau melalui telepon di (0333) 636780. Anda juga bisa mengunjungi kampus kami di Jl. Raya Jember - Banyuwangi KM.13, Labanasem, Kabat, Banyuwangi.',
        ]);
    }
}
