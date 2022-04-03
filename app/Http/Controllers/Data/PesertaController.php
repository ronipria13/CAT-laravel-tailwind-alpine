<?php

namespace App\Http\Controllers\Data;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Data\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('app.data.peserta._index');
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
        $validation = $request->validate([
            'name' => 'required',
            'no_peserta' => '',
            'gender' => 'required',
            'birthplace' => 'required',
            'birthdate' => 'required',
            'username' => 'required|unique:users|max:15',
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $peserta = "";
        DB::transaction(function() use ($request) {
            $user = User::create([
                'id' => Str::uuid(),
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'is_active' => true,
            ]);

            
            $roles[] =  array(
                    "id" => Str::uuid(),
                    "role_id" => '9bae3fae-4b49-4a47-950e-b9722def4804',
                    "type" => "common",
                    "created_by" => auth()->user()->username,
                    "updated_by" => auth()->user()->username,
            );

            $user->role()->attach($roles);

            $peserta = Peserta::create([
                'id' => Str::uuid(),
                'user_id' => $user->id,
                'no_peserta' => $request->no_peserta,
                'name' => $request->name,
                'gender' => $request->gender,
                'birthplace' => $request->birthplace,
                'birthdate' => $request->birthdate,
                'created_by' => auth()->user()->username
            ]);

        });

        return response()->json([
            'status' => true,
            'message' => 'Peserta created successfully',
            'peserta' => $peserta,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Data\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function show(Peserta $peserta)
    {
        //
        return response()->json([
            'status' => true,
            'message' => 'Peserta found',
            'peserta' => $peserta->load('user'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Data\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function edit(Peserta $peserta)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Data\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peserta $peserta)
    {
        //
        $rules = [
            'name' => 'required',
            'no_peserta' => '',
            'gender' => 'required',
            'birthplace' => 'required',
            'birthdate' => 'required',
            'username' => 'required|unique:users|max:15',
        ];

        $pesertaUser = $peserta->load('user');
        $user = $pesertaUser->user;


        if($request->username != $user->username) {
            $rules['username'] = 'required|unique:users|max:15';
        }

        if($request->password != '') {
            $rules['password'] = ['required', 'confirmed', 'min:8'];
            $updatefield['password'] = bcrypt($request->password);
        }
        $validation = $request->validate($rules);

        $updatefield['username'] = $request->username;
        $updatefield['name'] = $request->name;
        $updatefield['updated_at'] = now();
        User::where('id', $user->id)->update($updatefield);

        $peserta->update([
            'no_peserta' => $request->no_peserta,
            'name' => $request->name,
            'gender' => $request->gender,
            'birthplace' => $request->birthplace,
            'birthdate' => $request->birthdate,
            'updated_by' => auth()->user()->username
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Peserta updated successfully',
            'peserta' => $peserta->load('user'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Data\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peserta $peserta)
    {
        //
        $name = $peserta->name;
        $pesertaUser = $peserta->load('user');
        $user = $pesertaUser->user;
        // dd($user);
        DB::transaction(function() use ($peserta,$user) {
            DB::table('roleplay')->where('user_id', $user->id)->delete();
            $peserta->delete();
            $user->delete();
        });

        return response()->json([
            'status' => true,
            'message' => 'Peserta deleted successfully',
            'peserta' => $name,
        ]);
    }
}
