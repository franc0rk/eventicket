<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;

class PlacesController extends Controller
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
            $places = Place::with('state')->search($search)->paginate();
            return response()->json($places);
        }
        $search = $request->input('search');
        $places = Place::with('state')->search($search)->paginate();
        return view('admin.catalogs.places.index', compact('places', 'search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,$this->validationRules());
        $data = $request->all();
        $place = Place::create($data);
        return response()->json($place);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::with('state')->findOrFail($id);
        return response()->json($place);
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
        $place = Place::findOrFail($id);
        $this->validate($request, $this->validationRules());
        $data = $request->all();
        $place->fill($data);
        $place->save();

        return response()->json($place);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();

        return response()->json($place);
    }

    private function validationRules()
    {
        return [
            'state_id' => 'required',
            'name' => 'required'
        ];
    }
}
