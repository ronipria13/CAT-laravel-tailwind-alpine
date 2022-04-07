<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Data\Peserta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $current_role_name = session()->get('current_role_name');
        $user = auth()->user();
        if($current_role_name == 'Peserta'){
            $peserta = Peserta::where('user_id', $user->id)->first();
            return view('profile.peserta._index', compact('user','peserta','current_role_name'));
        }
        elseif($current_role_name == 'Admin' OR $current_role_name == 'Superadmin'){
            return view('profile.admin._index', compact('user','current_role_name'));
        }
        else{
            return view('dashboard');
        }
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
        $current_role_name = session()->get('current_role_name');
        if($current_role_name == 'Peserta'){
            $rules = [
                'name' => 'required',
                'no_peserta' => '',
                'gender' => 'required',
                'birthplace' => 'required',
                'birthdate' => 'required',
            ];
            $validation = $request->validate($rules);

            
            //save data ke peserta
            $peserta = Peserta::where('user_id', $user->id)->first();
            $peserta->update($validation);
        }
        else{
            $rules = [
                'name' => 'required',
            ];
            $validation = $request->validate($rules);
        }
        
        //save data ke user
        $user->name = $request->name;
        $user->save();


        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'user' => $validation,
        ]);
    }
}
