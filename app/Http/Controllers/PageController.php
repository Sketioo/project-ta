<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Agenda;
use App\Models\Achievement;
use App\Models\Partner;
use App\Models\Document;
use App\Models\Faq; // Import the Faq model

class PageController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $achievements = Achievement::where('status', 'disetujui')
                                ->where('show_on_main_page', true)
                                ->latest()
                                ->get();
        $partners = Partner::where('is_visible', true)->get();
        $documents = Document::where('is_visible', true)->latest()->get();
        $faqs = Faq::where('is_visible', true)->latest()->get(); // Fetch only visible FAQs
        return view('home', compact('achievements', 'partners', 'documents', 'faqs'));
    }

    /**
     * Display the agenda page.
     *
     * @return \Illuminate\View\View
     */
    public function agenda(Request $request)
    {
        $query = Agenda::where('is_published', true);

        if ($request->has('search') && !empty($request->input('search'))) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->ajax()) {
            $agendas = $query->latest('date')->get();
            return response()->json($agendas);
        }

        $agendas = $query->latest('date')->paginate(9);

        return view('agenda', compact('agendas'));
    }

    public function showAgendaPublic(Agenda $agenda)
    {
        if (!$agenda->is_published) {
            abort(404); // Or redirect to a 404 page if not published
        }
        return view('agendas.public_show', compact('agenda'));
    }

    public function searchDocuments(Request $request)
    {
        $searchTerm = $request->input('search');
        $documents = Document::where('is_visible', true)
                            ->where('title', 'like', '%' . $searchTerm . '%')
                            ->latest()
                            ->get();

        return response()->json($documents);
    }
}