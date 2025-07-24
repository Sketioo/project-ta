<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_url' => 'nullable|url',
            'contact_person' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        $path = $request->file('logo')->store('public/partners');

        Partner::create([
            'name' => $request->name,
            'logo_path' => $path,
            'website_url' => $request->website_url,
            'contact_person' => $request->contact_person,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'is_visible' => $request->has('is_visible'),
        ]);

        return redirect()->route('admin.partners.index')->with('success', 'Partner added successfully.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_url' => 'nullable|url',
            'contact_person' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'website_url', 'contact_person', 'alamat', 'deskripsi']);
        $data['is_visible'] = $request->has('is_visible');

        if ($request->hasFile('logo')) {
            // Delete old logo
            Storage::delete($partner->logo_path);
            // Store new logo
            $data['logo_path'] = $request->file('logo')->store('public/partners');
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully.');
    }

    public function destroy(Partner $partner)
    {
        Storage::delete($partner->logo_path);
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner deleted successfully.');
    }

    public function toggleVisibility(Partner $partner)
    {
        $partner->is_visible = !$partner->is_visible;
        $partner->save();

        $status = $partner->is_visible ? 'ditampilkan' : 'disembunyikan';
        return back()->with('success', "Status mitra {$partner->name} berhasil diubah menjadi {$status}.");
    }
}