<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function create()
    {
        return view('achievements.create');
    }

    public function store(Request $request)
    {
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
        ]);

        $fileSertifikatPath = null;
        if ($request->hasFile('file_sertifikat')) {
            $fileSertifikatPath = $request->file('file_sertifikat')->store('achievements/sertifikat', 'public');
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
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan prestasi berhasil dikirim!');
    }
}