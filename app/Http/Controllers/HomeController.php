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
}