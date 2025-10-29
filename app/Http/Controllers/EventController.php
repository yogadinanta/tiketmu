<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        // Ambil semua event dengan relasi vendor
        $events = Event::with('vendor')->latest()->get();

        return view('events.index', compact('events'));
    }
}
