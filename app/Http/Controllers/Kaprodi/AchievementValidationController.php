<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchievementValidationController extends Controller
{
    public function index()
    {
        $achievements = Achievement::where('status', 'pending')->get();
        return view('kaprodi.achievements.index', compact('achievements'));
    }

    public function show(Achievement $achievement)
    {
        return view('kaprodi.achievements.show', compact('achievement'));
    }

    public function validateAchievement(Achievement $achievement)
    {
        $achievement->update([
            'status' => 'validated',
            'validated_by' => Auth::id(),
            'validated_at' => now(),
        ]);

        return redirect()->route('kaprodi.achievements.index')->with('success', 'Achievement validated successfully.');
    }

    public function rejectAchievement(Achievement $achievement)
    {
        $achievement->update([
            'status' => 'rejected',
            'validated_by' => Auth::id(),
            'validated_at' => now(),
        ]);

        return redirect()->route('kaprodi.achievements.index')->with('success', 'Achievement rejected successfully.');
    }
}
