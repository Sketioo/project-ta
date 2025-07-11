<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendas = Agenda::latest()->get();
        return view('agendas.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agendas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('agenda_images', 'public');
            }
        }

        Agenda::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'is_published' => $request->has('is_published'),
            'images' => $imagePaths,
        ]);

        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        return view('agendas.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        return view('agendas.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePaths = $agenda->images ?? []; // Get existing images

        if ($request->hasFile('images')) {
            // Delete old images if new ones are uploaded
            foreach ($imagePaths as $oldImagePath) {
                Storage::disk('public')->delete($oldImagePath);
            }
            $imagePaths = []; // Reset array for new images

            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('agenda_images', 'public');
            }
        }

        $agenda->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'is_published' => $request->has('is_published'),
            'images' => $imagePaths,
        ]);

        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        // Delete associated images from storage
        if ($agenda->images) {
            foreach ($agenda->images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        $agenda->delete();

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil dihapus!');
    }

    public function togglePublication(Agenda $agenda)
    {
        $agenda->is_published = !$agenda->is_published;
        $agenda->save();

        $status = $agenda->is_published ? 'dipublikasikan' : 'disimpan sebagai draft';
        return back()->with('success', "Status agenda '{$agenda->title}' berhasil diubah menjadi {$status}.");
    }
}
