<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventShowController extends Controller
{
    /**
     * แสดง Event ไปที่หน้า EventShow.blade.php
     */
    public function __invoke($id)
    {
        $event = Event::findOrFail($id);
        $like = $event->likes()->where('user_id', auth()->id())->first();
        $savedEvent = $event->savedEvents()->where('user_id', auth()->id())->first();
        $attending = $event->attendings()->where('user_id', auth()->id())->first();

        return view('eventShow', compact('event', 'like', 'attending', 'savedEvent'));
    }
}
