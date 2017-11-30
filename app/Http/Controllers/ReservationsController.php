<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $search = $request->input('search');
            $reservations = Reservation::with(['user', 'event'])->search($search)->paginate();
            return response()->json($reservations);
        }
        $search = $request->input('search');
        $reservations = Reservation::with(['user', 'event'])->search($search)->paginate();
        return view('admin.reservations.index', compact('reservations', 'search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules());
        $data = $request->all();
        $reservation = Reservation::create($data);

        \Mail::send('emails.reservation',['reservation' => $reservation], function($message) use ($reservation) {
            $message->to($reservation->user->email, $reservation->user->name, 'Reservación '.$reservation->id);
        });

        return response()->json($reservation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::with(['user','event'])->findOrFail($id);
        return response()->json($reservation);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json($reservation);
    }

    private function validationRules()
    {
        return [
            'event_id' => 'required',
            'tickets'  => 'required|integer|min:1|max:5',
        ];
    }
}
