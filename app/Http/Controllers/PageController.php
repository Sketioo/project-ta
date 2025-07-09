<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Agenda;
use App\Models\Achievement;

class PageController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        $achievements = Achievement::where('status', 'validated')
                                ->where('show_on_main_page', true)
                                ->latest()
                                ->get();
        return view('home', compact('achievements'));
    }

    /**
     * Display the agenda page.
     *
     * @return \Illuminate\View\View
     */
    public function agenda()
    {
        $agendas = Agenda::where('is_published', true)->latest('date')->get();
        return view('agenda', compact('agendas'));
    }

    public function showAgendaPublic(Agenda $agenda)
    {
        if (!$agenda->is_published) {
            abort(404); // Or redirect to a 404 page if not published
        }
        return view('agendas.public_show', compact('agenda'));
    }
}