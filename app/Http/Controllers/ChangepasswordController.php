<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangepasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $thisUser = auth()->user();
        return view('changepassword._index',compact('thisUser'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        //
        if(!Hash::check($request->oldpassword, $user->password) AND $request->oldpassword != ''){
            return response()->json([
                'message' => 'Password lama salah',
                'errors' => [
                    'oldpassword' => 'Password lama salah',
                ]
            ],422);
        }
        $validation = $request->validate([
            'oldpassword' => 'required',
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        if($request->oldpassword === $request->password){
            return response()->json([
                'message' => 'Password baru tidak boleh sama dengan password lama',
                'errors' => [
                    'password' => 'Password baru tidak boleh sama dengan password lama',
                ]
            ],422);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'New password has been saved',
            'user' => $user->username,
        ]);
    }
}
