<?php

namespace App\Http\Controllers\Managements;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Managements\Roles;

use App\Http\Controllers\Controller;
use App\Models\Managements\Permissions;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Roles::all();
        return view('app.managements.permissions._index',compact('roles'));
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
        $request->validate([
            "role_id" => "required",
            "action_id" => "",
        ]);
        $nowpermissions = Permissions::where('role_id',$request->role_id)->get();
        $nowpermissions = $nowpermissions->pluck('action_id');
        $action_id = collect($request->action_id);

        $newpermissions = $action_id->diff($nowpermissions);
        $oldpermissions = $nowpermissions->diff($action_id);


        Permissions::whereIn('action_id',$oldpermissions->all())->where('role_id',$request->role_id)->delete();

        $save = $newpermissions->map(function($item) use($request){
            return [
                "id" => Str::uuid()->toString(),
                "role_id" => $request->role_id,
                "action_id" => $item,
                "type" => "common",
                "created_by" => auth()->user()->id,
                "updated_by" => auth()->user()->id
            ];
        });
        Permissions::insert($save->all());

        $permissions = Permissions::where('role_id',$request->role_id)->get();
        return response()->json([
            "status" => "success",
            "message" => "Permissions saved",
            "permissions" => $permissions
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Managements\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permissions $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Managements\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permissions $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Managements\Permissions  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permissions $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Managements\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permissions $permission)
    {
        //
    }

    /**
     * 
     * show all permissions
     * @param id
     * @return \Illuminate\Http\Response
     */
    public function showall($id)
    {
        $permissions = $id != "all" ? Permissions::where('role_id',$id)->get() : Permissions::all();
        return response()->json([
            'success' => true,
            'message' => 'Permissions found.',
            'permissions' => $permissions,
        ]);
    }

}
