<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Wedding;

class EventController extends Controller
{
    public function index()
    {
        $wedding = Wedding::firstOrFail();
        $events = $wedding->events;
        return view('admin.events', compact('events', 'wedding'));
    }

    public function update(EventRequest $request)
    {
        $wedding = Wedding::firstOrFail();

        Event::updateOrCreate(
            ['wedding_id' => $wedding->id, 'type' => 'akad'],
            $request->input('akad') + ['wedding_id' => $wedding->id, 'type' => 'akad']
        );

        Event::updateOrCreate(
            ['wedding_id' => $wedding->id, 'type' => 'resepsi'],
            $request->input('resepsi') + ['wedding_id' => $wedding->id, 'type' => 'resepsi']
        );

        return response()->json(['success' => true, 'message' => 'Event berhasil disimpan.']);
    }
}
