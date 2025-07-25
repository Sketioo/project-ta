<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Facility::with('photos')->latest()->paginate(9);
        return view('facilities.index', compact('facilities'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        $facility->load('photos');
        return view('facilities.show', compact('facility'));
    }
}
