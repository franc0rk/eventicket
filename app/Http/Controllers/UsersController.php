<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user = User::findOrFail($id);
        $this->validate($request, $this->validationRules($id));
        $data = $request->all();
        $user->fill($data);
        $user->save();

        return response()->json($user);
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed'
        ]);
        if(\Hash::check($request->get('current_password'), $user->password)) {
            $user->password = bcrypt($request->get('password'));
            $user->save();
            return response()->json($user);
        }
        return response()->json($this->jsonCurrentPasswordError(), 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();


        return response()->json($user);
    }

    private function validationRules($id)
    {
        return [
            'first_name' => 'required|string|max:30',
            'last_name'  => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone' => 'required|string|max:30',
            'birthday' => 'required|date|before:-18 years'
        ];
    }

    private function jsonCurrentPasswordError()
    {
        return [
            'message' => 'The given data was invalid',
            'errors' => [
                'current_password' => 'La contraseña actual no es valida'
            ]
        ];
    }
}
