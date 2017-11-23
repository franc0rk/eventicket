<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
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
            $events = Event::with(['eventType', 'place'])->search($search)->paginate();
            return response()->json($events);
        }
        $search = $request->input('search');
        $events = Event::with(['eventType', 'place'])->search($search)->paginate();
        return view('admin.events.index', compact('events', 'search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,$this->validationRules(false));
        $data = $request->all();
        $event = Event::create($data);

        return response()->json($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::with(['eventType','place'])->findOrFail($id);
        return response()->json($event);
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
        $event = Event::findOrFail($id);
        $this->validate($request, $this->validationRules(true));
        $data = $request->all();
        $event->fill($data);
        $event->save();

        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json($event);
    }

    public function getEventTypes()
    {
        $event_types = EventType::all();
        return response()->json($event_types);
    }

    private function validationRules($update)
    {
        $image_rule = '';
        (!$update) ? $image_rule = 'required|image|mimes:jpeg,jpg,png|max:1000' : '';
        return [
            'event_type_id' => 'required',
            'place_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image_cover' => $image_rule,
            'image_thumbnail' => $image_rule,
            'date' => 'required|date'
        ];
    }
}
