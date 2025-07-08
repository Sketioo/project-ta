<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Display the agenda page.
     *
     * @return \Illuminate\View\View
     */
    public function agenda()
    {
        return view('agenda');
    }
}