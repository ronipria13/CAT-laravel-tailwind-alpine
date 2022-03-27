<?php

namespace App\Http\Controllers\Managements;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Managements\Roleplay;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $current = Route::current();
        // $path = collect(explode('\\', $current->action['controller']));
        // $controller = $path->last();
        // dd($current->action['controller']);
        // dd(request()->method());
        // dd(request()->isMethod("GET"));
        // dd(Route::currentRouteAction());

        return view('app.managements.user._index');
    
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
        $validation = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users|max:15',
            'password' => ['required', 'confirmed', 'min:8'],
            'roles' => 'required',
            'is_active' => 'required',
        ]);

        $user = User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'is_active' => $request->is_active,
        ]);

        
        $roles = collect($request->roles)->map(function($item){
            return [
                "id" => Str::uuid(),
                "role_id" => $item,
                "type" => "common",
                "created_by" => auth()->user()->username,
                "updated_by" => auth()->user()->username,
            ];
        });

        $user->role()->attach($roles);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'user' => $user->load('roleplay'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        // if($request->ajax()){
            return response()->json([
                'status' => true,
                'message' => 'User found',
                'user' => $user->load('roleplay'),
            ]);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'username' => 'required|max:15',
            'roles' => 'required',
            'is_active' => 'required',
        ];

        $updatefield = [
            'name' => $request->name,
            'username' => $request->username,
            'is_active' => $request->is_active == "true" ? true : false,
        ];

        if($request->username != $user->username) {
            $rules['username'] = 'required|unique:users|max:15';
        }

        if($request->password != '') {
            $rules['password'] = ['required', 'confirmed', 'min:8'];
            $updatefield['password'] = bcrypt($request->password);
        }
        
        $validation = $request->validate($rules);

        $nowroles = Roleplay::where('user_id', $user->id)->get();
        $nowroles = $nowroles->pluck('role_id');
        $roles = collect($request->roles);

        $newroles = $roles->diff($nowroles);
        $oldroles = $nowroles->diff($roles);

        Roleplay::whereIn('role_id', $oldroles->all())->where('user_id', $user->id)->delete();

        $save = $newroles->map(function($role) use ($user) {
            return [
                'id' => Str::uuid(),
                'user_id' => $user->id,
                'role_id' => $role,
                'type' => 'core',
                'created_by' => auth()->user()->username,
                'updated_by' => auth()->user()->username,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        Roleplay::insert($save->all());
        // dd($updatefield);
        $updatefield['updated_at'] = now();
        User::where('id', $user->id)->update($updatefield);

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();

        return response()->json([
            'message' => 'User '.$name.' deleted successfully',
        ]);
    }
}
