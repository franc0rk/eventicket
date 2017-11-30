<?php

namespace App\Http\Controllers;

use App\Event;
use App\Reservation;
use PDF;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $banner_events = Event::inRandomOrder()->limit(3)->get();
        return view('client.index', compact('banner_events'));
    }

    public function showEvent($id)
    {
        $event = Event::with('place')->findOrFail($id);

        return view('client.event', compact('event'));
    }

    public function showReservation($id)
    {
        $reservation = Reservation::with(['user', 'event'])->findOrFail($id);
        $pdf = PDF::loadView('emails.reservation_pdf', ['reservation' => $reservation]);
        return $pdf->download('eventicket_reservation_'.$id.'.pdf');
    }

    public function profile()
    {
        return view('client.profile.index');
    }
}
