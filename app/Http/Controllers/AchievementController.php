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
            'semester' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('achievements', 'public');
        }

        Auth::user()->achievements()->create([
            'nim' => $request->nim,
            'semester' => $request->semester,
            'class' => $request->class,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'is_accepted' => false, // Default to false on submission
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan prestasi berhasil dikirim!');
    }
}