<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Log;

class SuggestionController extends Controller
{
    public function index()
    {
        // Fetch only unread suggestions by default
        $suggestions = Suggestion::where('is_read', false)->latest()->get();
        return view('suggestions.index', compact('suggestions'));
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
        $suggestion->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    public function readSuggestions()
    {
        // Fetch only read suggestions
        $suggestions = Suggestion::where('is_read', true)->latest()->get();
        return view('suggestions.read', compact('suggestions'));
    }
}