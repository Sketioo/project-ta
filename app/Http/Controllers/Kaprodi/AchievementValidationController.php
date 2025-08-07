<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AchievementStatusUpdated;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AchievementsExport;

class AchievementValidationController extends Controller
{
    public function index(Request $request)
    {
        $query = Achievement::with('user')->latest();

        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $achievements = $query->get();
        return view('kaprodi.achievements.index', compact('achievements'));
    }

    public function export()
    {
        return Excel::download(new AchievementsExport, 'achievements.xlsx');
    }

    public function show(Achievement $achievement)
    {
        return view('kaprodi.achievements.show', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $validatedData = $request->validate([
            'status' => 'sometimes|required|in:pending,menunggu validasi,disetujui,ditolak',
            'keterangan_lomba' => 'sometimes|required|string',
            'show_on_main_page' => 'sometimes|boolean',
        ]);

        $updateData = [];
        $statusChanged = false;

        // When Kaprodi sets to "Revisi", we store it as "pending"
        if (isset($validatedData['status'])) {
            $newStatus = $validatedData['status'];
            if ($achievement->status !== $newStatus) {
                $statusChanged = true;
            }
            $updateData['status'] = $newStatus;
            $updateData['validated_by'] = Auth::id();
            $updateData['validated_at'] = now();
        }

        if (isset($validatedData['keterangan_lomba'])) {
            $updateData['keterangan_lomba'] = $validatedData['keterangan_lomba'];
        }

        if (isset($validatedData['show_on_main_page'])) {
            $updateData['show_on_main_page'] = $validatedData['show_on_main_page'];
        } else {
            // Ensure the value is set to 0 if the checkbox is not checked
            $updateData['show_on_main_page'] = 0;
        }

        $achievement->update($updateData);

        // Send email if status was changed
        if ($statusChanged) {
            Mail::to($achievement->user->email)->send(new AchievementStatusUpdated($achievement));
        }

        return redirect()->route('kaprodi.achievements.show', $achievement)->with('success', 'Perubahan berhasil disimpan.');
    }

    public function destroy(Achievement $achievement)
    {

        $achievement->delete();

        return redirect()->route('kaprodi.achievements.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}
