<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventListController extends Controller
{
    public function index() {

        // Obtiene todos los eventos que existan
        $events = Event::all();
        return view('event.event_show', compact('events'));
    }
}
