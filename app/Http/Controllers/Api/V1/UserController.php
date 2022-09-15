<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $users = User::all();
        $response = [
            'users' => UserResource::collection($users),
            'status'=> 'success'
        ];
        return response($response, 200);
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
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        
        $data['password'] = bcrypt($request->password);
        
        $user = User::create($data);
        
        $response = [ 'user' => $user, 'status' => 'success'];
        return response($response, 200);
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $user = User::find($id);
        if(!$user){
            $response = [ 'message' => 'User Not Found', 'status' => 'error'];
            return response($response, 404);
        }
        $response = [ 'user' => $user, 'status' => 'success'];
        return response($response, 200);
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
        $user = User::find($id);
        if(!$user){
            $response = [ 'message' => 'User Not Found', 'status' => 'error'];
            return response($response, 404);
        }
        $data = $request->validate([
            'name' => 'required|max:255',
        ]);
        $user->update($data);
        $response = [ 'message' => 'User Updated.', 'status' => 'success'];
        return response($response, 200);
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            $response = [ 'message' => 'User Not Found', 'status' => 'error'];
            return response($response, 404);
        }
        $user->delete();
        $response = [ 'message' => 'User Deleted.', 'status' => 'success'];
        return response($response, 200);
        
    }
}
