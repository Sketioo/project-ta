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

        $request->validate([
            'nim' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'nama_kompetisi' => 'required|string|max:255',
            'tingkat_kompetisi' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'prestasi' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'dosen_pembimbing' => 'nullable|string|max:255',
            'file_sertifikat' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'keterangan_lomba' => 'nullable|string',
            'photos_dokumentasi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|aspect_ratio:16/9',
        ], [
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

        Auth::user()->achievements()->create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'nama_kompetisi' => $request->nama_kompetisi,
            'tingkat_kompetisi' => $request->tingkat_kompetisi,
            'penyelenggara' => $request->penyelenggara,
            'prestasi' => $request->prestasi,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'dosen_pembimbing' => $request->dosen_pembimbing,
            'file_sertifikat' => $fileSertifikatPath,
            'keterangan_lomba' => $request->keterangan_lomba,
            'photos_dokumentasi' => $photosDokumentasiPaths,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan prestasi berhasil dikirim!');
    }
}