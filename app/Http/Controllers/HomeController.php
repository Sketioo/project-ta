<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\Partner;
use App\Models\Document;
use App\Models\Agenda;
use App\Models\Achievement;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $stats = [];

        if ($user->role == 'admin' || $user->role == 'kaprodi') {
            $stats['totalSuggestions'] = Suggestion::count();
            $stats['unreadSuggestions'] = Suggestion::where('is_read', false)->count();
        }

        if ($user->role == 'admin') {
            $stats['totalPartners'] = Partner::count();
            $stats['totalDocuments'] = Document::count();
            $stats['totalAgendas'] = Agenda::count();
        }

        if ($user->role == 'kaprodi') {
            $stats['pendingAchievements'] = Achievement::where('status', 'pending')->count();
        }

        return view('dashboard', compact('stats'));
    }

    /**
     * Show the student dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mahasiswaDashboard()
    {
        $user = Auth::user();
        $achievementsQuery = Achievement::where('user_id', $user->id);

        $stats = [
            'total' => $achievementsQuery->count(),
            'approved' => $achievementsQuery->clone()->where('status', 'approved')->count(),
            'pending' => $achievementsQuery->clone()->where('status', 'pending')->count(),
        ];

        $achievements = $achievementsQuery->clone()->orderBy('created_at', 'desc')->paginate(10);

        return view('mahasiswa.dashboard', compact('achievements', 'stats'));
    }
}