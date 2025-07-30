<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Curriculum;
use App\Models\CurriculumImage;
use Illuminate\Support\Facades\Storage;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curriculums = Curriculum::latest()->paginate(10);
        return view('admin.curriculums.index', compact('curriculums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.curriculums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_visible' => 'boolean',
        ]);

        $curriculum = Curriculum::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_visible' => $request->has('is_visible'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/curriculums');
                $curriculum->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.curriculums.index')->with('success', 'Kurikulum berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curriculum $curriculum)
    {
        return view('admin.curriculums.edit', compact('curriculum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curriculum $curriculum)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_visible' => 'boolean',
        ]);

        $curriculum->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_visible' => $request->has('is_visible'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/curriculums');
                $curriculum->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.curriculums.index')->with('success', 'Kurikulum berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curriculum $curriculum)
    {
        // Delete all associated images from storage
        foreach ($curriculum->images as $image) {
            Storage::delete($image->image_path);
        }

        // Delete the curriculum record (and images records due to cascade)
        $curriculum->delete();

        return redirect()->route('admin.curriculums.index')->with('success', 'Kurikulum berhasil dihapus.');
    }
}
