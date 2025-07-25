<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::latest()->paginate(10);
        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'person_in_charge' => 'nullable|string|max:255',
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('public/facilities');
                $photoPaths[] = str_replace('public/', '', $path);
            }
        }

        Facility::create([
            'name' => $request->name,
            'description' => $request->description,
            'person_in_charge' => $request->person_in_charge,
            'photos' => $photoPaths,
        ]);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function show(Facility $facility)
    {
        return view('admin.facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'person_in_charge' => 'nullable|string|max:255',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deleted_photos' => 'nullable|array',
            'deleted_photos.*' => 'string',
        ]);

        $currentPhotos = $facility->photos ?? [];

        // Hapus foto yang ditandai untuk dihapus
        if ($request->has('deleted_photos')) {
            $deletedPhotos = $request->deleted_photos;
            foreach ($deletedPhotos as $photoPath) {
                Storage::delete('public/' . $photoPath);
            }
            $currentPhotos = array_diff($currentPhotos, $deletedPhotos);
        }

        // Tambah foto baru
        $newPhotoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('public/facilities');
                $newPhotoPaths[] = str_replace('public/', '', $path);
            }
        }

        $facility->update([
            'name' => $request->name,
            'description' => $request->description,
            'person_in_charge' => $request->person_in_charge,
            'photos' => array_merge(array_values($currentPhotos), $newPhotoPaths),
        ]);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Facility $facility)
    {
        if ($facility->photos) {
            foreach ($facility->photos as $photoPath) {
                Storage::delete('public/' . $photoPath);
            }
        }
        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
