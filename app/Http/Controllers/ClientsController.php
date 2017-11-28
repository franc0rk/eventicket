<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $banner_events = Event::limit(3)->get();
        return view('client.index', compact('banner_events'));
    }

    public function showEvent($id)
    {
        $event = Event::with('place')->findOrFail($id);

        return view('client.event', compact('event'));
    }
}
