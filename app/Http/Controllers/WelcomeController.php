<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $events = Event::with('province')->where('start_date', '>=', today())->orderBy('created_at', 'desc')->get();

        return view('welcome', compact('events'));
    }
}
