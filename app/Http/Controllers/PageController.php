<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Agenda;
use App\Models\Achievement;
use App\Models\Partner;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Faq; // Import the Faq model
use App\Models\Announcement; // Import the Announcement model

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
        $documents = Document::where('is_visible', true)->where('status', 'berlaku')->latest()->get();
        $documentCategories = DocumentCategory::all();
        $faqs = Faq::where('is_visible', true)->latest()->get(); // Fetch only visible FAQs
        return view('home', compact('achievements', 'partners', 'documents', 'documentCategories', 'faqs'));
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

    /**
     * Display the announcements page.
     *
     * @return \Illuminate\View\View
     */
    public function announcements(Request $request)
    {
        $query = Announcement::where('is_published', true);

        if ($request->has('search') && !empty($request->input('search'))) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('content', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->ajax()) {
            $announcements = $query->latest('created_at')->get();
            return response()->json($announcements);
        }

        $announcements = $query->latest('created_at')->paginate(9);

        return view('announcements', compact('announcements'));
    }

    public function showAnnouncementPublic(Announcement $announcement)
    {
        if (!$announcement->is_published) {
            abort(404); // Or redirect to a 404 page if not published
        }
        return view('announcements.public_show', compact('announcement'));
    }

    public function searchDocuments(Request $request)
    {
        $searchTerm = $request->input('search');
        $documents = Document::where('is_visible', true)
                            ->where('status', 'berlaku')
                            ->where('title', 'like', '%' . $searchTerm . '%')
                            ->latest()
                            ->get();

        return response()->json($documents);
    }

    public function filterDocuments(Request $request)
    {
        $categoryIds = $request->input('category_ids', []);

        $query = Document::where('is_visible', true)->where('status', 'berlaku');

        // If category_ids is not empty and is an array, filter by it
        if (!empty($categoryIds) && is_array($categoryIds)) {
            $query->whereIn('document_category_id', $categoryIds);
        }

        $documents = $query->latest()->get();

        return response()->json($documents);
    }
}