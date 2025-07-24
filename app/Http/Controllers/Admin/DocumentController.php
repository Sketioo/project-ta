<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\DocumentCategory;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::with('category')->latest()->get();
        return view('admin.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DocumentCategory::orderBy('name')->get();
        return view('admin.documents.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'kode_dokumen' => 'nullable|string|max:100',
            'category' => 'required|string|max:100',
            'document_file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240', // 10MB Max
        ]);

        // Find or create the category
        $categoryName = strtolower($request->input('category'));
        $category = DocumentCategory::firstOrCreate(['name' => $categoryName]);

        $path = $request->file('document_file')->store('documents', 'public');

        Document::create([
            'title' => $request->title,
            'kode_dokumen' => $request->kode_dokumen,
            'document_category_id' => $category->id,
            'file_path' => $path,
            'is_visible' => $request->has('is_visible'),
        ]);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return Storage::download($document->file_path);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        $categories = DocumentCategory::orderBy('name')->get();
        return view('admin.documents.edit', compact('document', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'kode_dokumen' => 'nullable|string|max:100',
            'category' => 'required|string|max:100',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240', // 10MB Max
        ]);

        // Find or create the category
        $categoryName = strtolower($request->input('category'));
        $category = DocumentCategory::firstOrCreate(['name' => $categoryName]);

        $document->title = $request->title;
        $document->kode_dokumen = $request->kode_dokumen;
        $document->document_category_id = $category->id;
        $document->is_visible = $request->has('is_visible');

        if ($request->hasFile('document_file')) {
            // Delete old file
            Storage::disk('public')->delete($document->file_path);
            // Store new file
            $path = $request->file('document_file')->store('documents', 'public');
            $document->file_path = $path;
        }

        $document->save();

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        Storage::delete($document->file_path);
        $document->delete();

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil dihapus.');
    }

    public function toggleVisibility(Document $document)
    {
        $document->is_visible = !$document->is_visible;
        $document->save();

        $status = $document->is_visible ? 'ditampilkan' : 'disembunyikan';
        return back()->with('success', "Status dokumen '{$document->title}' berhasil diubah menjadi {$status}.");
    }
}