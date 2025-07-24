<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all() );
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:akademik,non-akademik',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'boolean',
        ]);

        $photosPath = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photosPath[] = $photo->store('announcements', 'public');
            }
        }

        Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'photos_path' => $photosPath,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:akademik,non-akademik',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'boolean',
        ]);

        $data = $request->only(['title', 'content', 'category', 'is_published']);
        $data['is_published'] = $request->has('is_published');

        $photosPath = $announcement->photos_path ?? [];

        if ($request->hasFile('photos')) {
            // Delete old photos if new ones are uploaded
            foreach ($photosPath as $oldPhotoPath) {
                Storage::delete($oldPhotoPath);
            }
            $photosPath = []; // Reset array for new photos

            foreach ($request->file('photos') as $photo) {
                $photosPath[] = $photo->store('announcements', 'public');
            }
        }

        $data['photos_path'] = $photosPath;

        $announcement->update($data);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        if ($announcement->photos_path) {
            foreach ($announcement->photos_path as $photoPath) {
                Storage::delete($photoPath);
            }
        }
        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dihapus!');
    }

    public function togglePublication(Announcement $announcement)
    {
        $announcement->is_published = !$announcement->is_published;
        $announcement->save();

        $status = $announcement->is_published ? 'dipublikasikan' : 'disimpan sebagai draft';
        return back()->with('success', "Status pengumuman '{$announcement->title}' berhasil diubah menjadi {$status}.");
    }
}