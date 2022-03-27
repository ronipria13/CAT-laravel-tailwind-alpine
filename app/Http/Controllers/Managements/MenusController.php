<?php

namespace App\Http\Controllers\Managements;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Managements\Menus;
use App\Http\Controllers\Controller;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('app.managements.menus._index');
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
            "menugroup_id" => 'required',
            "menu_label" => 'required',
            "menu_order" => 'required|numeric',
            "action_id" => 'required',
            "route" => 'required'
        ]);

        $menu = Menus::create([
            "id" => Str::uuid(),
            "menugroup_id" => $request->menugroup_id,
            "menu_label" => $request->menu_label,
            "menu_icon" => $request->menu_icon,
            "menu_desc" => $request->menu_desc,
            "menu_order" => $request->menu_order,
            "action_id" => $request->action_id,
            "route" => $request->route,
            "type" => 'common',
            "created_by" => auth()->user()->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Menu has been created',
            'menu' => $menu
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Managements\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function show(Menus $menu)
    {
        //
        return response()->json([
            'status' => true,
            'message' => 'Menu has been retrieved',
            'menu' => $menu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Managements\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function edit(Menus $menus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Managements\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menus $menu)
    {
        //
        $request->validate([
            "menugroup_id" => 'required',
            "menu_label" => 'required',
            "menu_order" => 'required|numeric',
            "action_id" => 'required',
            "route" => 'required'
        ]);

        $menu->update([
            "menugroup_id" => $request->menugroup_id,
            "menu_label" => $request->menu_label,
            "menu_icon" => $request->menu_icon,
            "menu_desc" => $request->menu_desc,
            "menu_order" => $request->menu_order,
            "action_id" => $request->action_id,
            "route" => $request->route,
            "updated_by" => auth()->user()->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Menu has been updated',
            'menu' => $menu
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Managements\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menus $menu)
    {
        //
        $menu->delete();

        return response()->json([
            'status' => true,
            'message' => 'Menu has been deleted',
            'menu' => $menu
        ]);
    }
}
