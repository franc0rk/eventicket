<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StatesController extends Controller
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
            $states = State::search($search)->paginate();
            return response()->json($states);
        }
        $search = $request->input('search');
        $states = State::search($search)->paginate();
        return view('admin.catalogs.states.index', compact('states', 'search'));
    }

    public function store(Request $request)
    {
        $this->validate($request,$this->validationRules(0));
        $data = $request->all();
        $state = State::create($data);
        return response()->json($state);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $state = State::findOrFail($id);
        return response()->json($state);
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
        $state = State::findOrFail($id);
        $this->validate($request, $this->validationRules($id));
        $data = $request->all();
        $state->fill($data);
        $state->save();

        return response()->json($state);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::findOrFail($id);
        $state->delete();

        return response()->json($state);
    }

    public function all()
    {
        return response()->json(State::all());
    }

    public function getMexicoStates()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://battuta.medunes.net/api/']);
        $response = $client->get('region/mx/all/?key=31d3d80c89e5324a48f0923ec8da31ae');

        $states = json_decode($response->getBody()->getContents());

        return response()->json($states);
    }

    private function validationRules($id)
    {
        return [
            'name' => 'required|unique:states,name,'.$id
        ];
    }
}
