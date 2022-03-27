<?php

namespace App\Http\Controllers\Managements;

use App\Http\Controllers\Controller;
use App\Models\Managements\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('app.managements.roles._index');
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
        $form = $request->validate([
            "role_name" => "required|string|max:100",
            "role_desc" => "",
        ]);

        $form['id'] = Str::uuid();
        $form['type'] = "common";
        $form['created_by'] = auth()->user()->username;

        $role = Roles::create($form);

        return response()->json([
            'success' => true,
            'message' => 'Successfully created new role.',
            'role' => $role,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Managements\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $role)
    {
        //
        return response()->json([
            'success' => true,
            'message' => 'Role Found.',
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Managements\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Managements\Roles  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roles $role)
    {
        //
        $form = $request->validate([
            "role_name" => "required|string|max:100",
            "role_desc" => "",
        ]);
        $form['type'] = "core";
        $form['created_by'] = auth()->user()->username;

        $role->update($form);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated role.',
            'role' => $role,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Managements\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $role)
    {
        //
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted role.',
            'role' => $role,
        ]);

    }

    /**
     * Get all roles
     */

     public function showall()
     {
         //
         $roles = Roles::all();

         return response()->json([
             'success' => true,
             'message' => 'Successfully retrieved all roles.',
             'roles' => $roles,
         ]);
     }
}
