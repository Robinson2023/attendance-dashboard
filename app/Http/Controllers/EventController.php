<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
        ]);

        Event::create($request->all());
        return redirect()->route('events.index')->with('success', 'Evento creado correctamente.');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
        ]);

        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado.');
    }

    public function calendar()
    {
        $events = Event::all();
        return view('events.calendar', compact('events'));
    }
}
