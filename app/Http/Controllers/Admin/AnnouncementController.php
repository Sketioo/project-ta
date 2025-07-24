<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

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
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:akademik,non-akademik',
            'is_published' => 'boolean',
        ]);

        Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
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
            'is_published' => 'boolean',
        ]);

        $announcement->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
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