<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    public function create()
    {
        return view('event.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $event->image = $imagePath;
        }
        $event->save();
        return redirect()->route('event.index')->with('success', 'Event created successfully!');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->description = $request->description;
        if ($request->hasFile('image')) {
            if ($event->image && Storage::exists('public/' . $event->image)) {
                Storage::delete('public/' . $event->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $event->image = $imagePath;
        }
        $event->save();
        return redirect()->route('event.index')->with('success', 'Event updated successfully!');
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);
        if ($event->image && Storage::exists('public/' . $event->image)) {
            Storage::delete('public/' . $event->image);
        }
        $event->delete();
        return redirect()->route('event.index')->with('success', 'Event deleted successfully!');
    }
}
