<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Log;

class SuggestionController extends Controller
{
    public function index()
    {
        $suggestions = Suggestion::latest()->get()->groupBy('is_read');
        
        $unreadSuggestions = $suggestions->get(0, collect());
        $readSuggestions = $suggestions->get(1, collect());

        return view('suggestions.index', compact('unreadSuggestions', 'readSuggestions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string',
        ]);

        Suggestion::create($request->all());

        return redirect()->back()->with('success', 'Saran Anda berhasil dikirim!');
    }

    public function markAsRead(Request $request, Suggestion $suggestion)
    {
        if (!$suggestion->is_read) {
            $suggestion->update(['is_read' => true]);
            return response()->json(['success' => true, 'message' => 'Saran ditandai sebagai sudah dibaca.']);
        }
        return response()->json(['success' => false, 'message' => 'Saran sudah dibaca sebelumnya.']);
    }

    /**
     * This method is no longer needed as its logic is merged into index().
     * Kept for now to avoid breaking existing routes if any, will be removed later.
     */
    public function readSuggestions()
    {
        return redirect()->route('suggestions.index');
    }
}
