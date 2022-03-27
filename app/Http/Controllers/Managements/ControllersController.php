<?php

namespace App\Http\Controllers\Managements;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Managements\Controllers;
use Illuminate\Http\Request;

class ControllersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('app.managements.controllers._index');
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
            "controller_name" => "required|max:100",
            "controller_desc" => "string",
        ]);

        $form['id'] = Str::uuid();
        $form['type'] = "common";
        $form['created_by'] = auth()->user()->username;

        $controller = Controllers::create($form);

        return response()->json([
            'success' => true,
            'message' => 'Successfully created new controller.',
            'controller' => $controller,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Managements\Controllers  $controller
     * @return \Illuminate\Http\Response
     */
    public function show(Controllers $controller)
    {
        //
        return response()->json([
            'success' => true,
            'message' => 'Controller found.',
            'controller' => $controller,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Managements\Controllers  $controllers
     * @return \Illuminate\Http\Response
     */
    public function edit(Controllers $controllers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Managements\Controllers  $controller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Controllers $controller)
    {
        //
        $form = $request->validate([
            "controller_name" => "required|max:100",
            "controller_desc" => "string",
        ]);

        $form['type'] = "core";
        $form['updated_by'] = auth()->user()->username;

        $controller->update($form);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated controller.',
            'controller' => $controller,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Managements\Controllers  $controllers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Controllers $controller)
    {
        //
        $controller->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted controller.',
        ]);
    }

    /**
     * Show all resources from storage.
     * 
     * 
     * @return \Illuminate\Http\Response and App\Models\Managements\Controllers
     * 
     */
    public function showall()
    {
        //
        $controllers = Controllers::all();

        return response()->json([
            'success' => true,
            'message' => 'Controllers found.',
            'controllers' => $controllers,
        ]);
    }
}
