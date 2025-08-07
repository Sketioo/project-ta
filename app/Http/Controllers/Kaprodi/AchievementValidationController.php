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
            'status' => 'sometimes|in:pending,disetujui,ditolak', // 'menunggu validasi' is not a state kaprodi can set.
            'keterangan_lomba' => 'nullable|string',
            'show_on_main_page' => 'sometimes|boolean',
        ]);

        $updateData = [];
        $statusChanged = false;

        // Only update status if it's present in the request
        if ($request->has('status')) {
            $newStatus = $validatedData['status'];
            if ($achievement->status !== $newStatus) {
                $statusChanged = true;
                $updateData['status'] = $newStatus;
                $updateData['validated_by'] = Auth::id();
                $updateData['validated_at'] = now();
            }
        }

        if ($request->has('keterangan_lomba')) {
            $updateData['keterangan_lomba'] = $validatedData['keterangan_lomba'];
        }

        // Handle the checkbox for showing on the main page
        $updateData['show_on_main_page'] = $request->has('show_on_main_page') ? 1 : 0;

        if (!empty($updateData)) {
            $achievement->update($updateData);
        }

        // Send email if status was changed to 'disetujui' or 'ditolak'
        if ($statusChanged && in_array($achievement->status, ['disetujui', 'ditolak'])) {
            // Make sure user and email exist to prevent errors
            if ($achievement->user && $achievement->user->email) {
                Mail::to($achievement->user->email)->send(new AchievementStatusUpdated($achievement));
            }
        }

        return redirect()->route('kaprodi.achievements.show', $achievement)->with('success', 'Perubahan berhasil disimpan.');
    }

    public function destroy(Achievement $achievement)
    {

        $achievement->delete();

        return redirect()->route('kaprodi.achievements.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}
