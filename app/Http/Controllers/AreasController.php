<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreasController extends Controller
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
            $areas = Area::with('place')->search($search)->paginate();
            return response()->json($areas);
        }
        $search = $request->input('search');
        $areas = Area::with('place')->search($search)->paginate();
        return view('admin.catalogs.areas.index', compact('areas', 'search'));
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
        $area = Area::create($data);
        return response()->json($area);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = Area::with('place')->findOrFail($id);
        return response()->json($area);
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
        $area = Area::findOrFail($id);
        $this->validate($request, $this->validationRules());
        $data = $request->all();
        $area->fill($data);
        $area->save();

        return response()->json($area);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return response()->json($area);
    }

    private function validationRules()
    {
        return [
            'capacity' => 'required|integer|min:1|max:9999',
            'place_id' => 'required',
            'name' => 'required',
        ];
    }
}
