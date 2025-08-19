<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AchievementController extends Controller
{
    public function create()
    {
        return view('achievements.create');
    }

    public function store(Request $request)
    {
        Validator::extend('aspect_ratio', function ($attribute, $value, $parameters, $validator) {
            if (!$value->isValid()) {
                return false;
            }

            $imageSize = getimagesize($value->getRealPath());
            if (!$imageSize) {
                return false;
            }

            $width = $imageSize[0];
            $height = $imageSize[1];

            // Prevent division by zero
            if ($height == 0) {
                return false;
            }

            $ratio = explode('/', $parameters[0]);
            $expectedRatio = (float)$ratio[0] / (float)$ratio[1];
            $actualRatio = (float)$width / (float)$height;

            // Compare with a small tolerance for floating point inaccuracies
            return abs($actualRatio - $expectedRatio) < 0.01;
        });

        // Validasi dasar
        $rules = [
            'jenis_lomba' => 'required|in:individu,kelompok',
            'nim' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'nama_kompetisi' => 'required|string|max:255',
            'tingkat_kompetisi' => 'required|in:Internal,Kabupaten,Provinsi,Nasional,Internasional',
            'penyelenggara' => 'required|string|max:255',
            'prestasi' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'dosen_pembimbing' => 'nullable|string|max:255',
            'file_sertifikat' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'keterangan_lomba' => 'nullable|string',
            'photos_dokumentasi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|aspect_ratio:16/9',
        ];

        // Validasi tambahan untuk lomba kelompok
        if ($request->jenis_lomba === 'kelompok') {
            $rules['jumlah_anggota'] = 'required|integer|min:2|max:10';
            $rules['nim_anggota.*'] = 'required|string|max:255';
            $rules['nama_anggota.*'] = 'required|string|max:255';
        }

        $request->validate($rules, [
            'photos_dokumentasi.*.aspect_ratio' => 'Setiap foto dokumentasi harus memiliki rasio aspek 16:9.',
        ]);

        $fileSertifikatPath = null;
        if ($request->hasFile('file_sertifikat')) {
            $fileSertifikatPath = $request->file('file_sertifikat')->store('achievements/sertifikat', 'public');
        }

        $photosDokumentasiPaths = [];
        if ($request->hasFile('photos_dokumentasi')) {
            foreach ($request->file('photos_dokumentasi') as $photo) {
                $photosDokumentasiPaths[] = $photo->store('achievements/dokumentasi', 'public');
            }
        }

        // Siapkan data anggota kelompok jika jenis lomba adalah kelompok
        $teamMembersInfo = '';
        if ($request->jenis_lomba === 'kelompok') {
            $teamMembersInfo = "Jenis Lomba: Kelompok\n";
            $teamMembersInfo .= "Jumlah Anggota: " . $request->jumlah_anggota . "\n\n";
            $teamMembersInfo .= "Data Anggota:\n";
            $teamMembersInfo .= "1. " . $request->nim . " - " . $request->nama . " (Ketua)\n";
            
            // Tambahkan data anggota tambahan
            if ($request->has('nim_anggota') && $request->has('nama_anggota')) {
                for ($i = 0; $i < count($request->nim_anggota); $i++) {
                    $memberNumber = $i + 2; // Karena ketua sudah dihitung sebagai anggota ke-1
                    $teamMembersInfo .= "{$memberNumber}. " . $request->nim_anggota[$i] . " - " . $request->nama_anggota[$i] . "\n";
                }
            }
            
            // Gabungkan dengan keterangan lomba yang ada
            if ($request->keterangan_lomba) {
                $teamMembersInfo .= "\nKeterangan Lomba:\n" . $request->keterangan_lomba;
            }
        } else {
            $teamMembersInfo = $request->keterangan_lomba;
        }

        Auth::user()->achievements()->create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_lomba' => $request->jenis_lomba,
            'nama_kompetisi' => $request->nama_kompetisi,
            'tingkat_kompetisi' => $request->tingkat_kompetisi,
            'penyelenggara' => $request->penyelenggara,
            'prestasi' => $request->prestasi,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'dosen_pembimbing' => $request->dosen_pembimbing,
            'file_sertifikat' => $fileSertifikatPath,
            'keterangan_lomba' => $teamMembersInfo,
            'photos_dokumentasi' => $photosDokumentasiPaths,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan prestasi berhasil dikirim!');
    }
}