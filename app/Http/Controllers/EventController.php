<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Province;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller 
{
    public function __construct()
    {
        // Middleware ที่ตรวจสอบว่าเฉพาะผู้ใช้ที่เป็น Admin เท่านั้นที่สามารถเข้าถึงได้
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $events = Event::with('province')->get();
        return view('events.index', compact(('events')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('admin-only');
        $provinces = Province::all();
        return view('events.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request): RedirectResponse
    {

        if($request->hasFile('image')){
            $data = $request->validated();
            $data ['image'] = Storage::putFile('events', $request->file('image'));
            $data ['admin_id'] = auth()->id();
            $data ['slug'] = Str::slug($request->title);

            Event::create($data);
            return to_route('events.index');
        }else{
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): view
    {
        $this->authorize('admin-only');
        $provinces = Province::all();
        return view('events.edit', compact('provinces','event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $this->authorize('admin-only');
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::delete($event->image);
            $data['image'] = Storage::putFile('events', $request->file('image'));
        }

        $data['slug'] = Str::slug($request->title);
        $event->update($data);
        return to_route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        $this->authorize('admin-only');
        Storage::delete($event->image);
        $event->delete();
        return to_route('events.index');
    }
}
