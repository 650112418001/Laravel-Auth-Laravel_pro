<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventIndexController extends Controller
{
    /**
     * Event โชว์ในหน้า EventIndex.blade.php
     */
    public function __invoke()
    {
        $events = Event::with('province')->orderBy('created_at', 'desc')->paginate(12);
        return view('eventIndex', compact('events'));
    }
}
