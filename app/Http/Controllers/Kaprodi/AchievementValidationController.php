<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchievementValidationController extends Controller
{
    public function index(Request $request)
    {
        $query = Achievement::query();

        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $achievements = $query->get();
        return view('kaprodi.achievements.index', compact('achievements'));
    }

    public function show(Achievement $achievement)
    {
        return view('kaprodi.achievements.show', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $validatedData = $request->validate([
            'status' => 'sometimes|required|in:pending,validated,rejected',
            'show_on_main_page' => 'sometimes|boolean',
        ]);

        $updateData = [];

        if (isset($validatedData['status'])) {
            $updateData['status'] = $validatedData['status'];
            $updateData['validated_by'] = Auth::id();
            $updateData['validated_at'] = now();
        }

        if (isset($validatedData['show_on_main_page'])) {
            $updateData['show_on_main_page'] = $validatedData['show_on_main_page'];
        }

        $achievement->update($updateData);

        return redirect()->route('kaprodi.achievements.index')->with('success', 'Achievement updated successfully.');
    }
}
