<?php

namespace App\Http\Controllers\Managements;

use App\Http\Controllers\Controller;
use App\Models\Managements\Functions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FunctionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('app.managements.functions._index');
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
            "function_name" => "required|string|max:100",
            "function_desc" => "string",
        ]);

        $form['id'] = Str::uuid();
        $form['type'] = "common";
        $form['created_by'] = auth()->user()->username;

        $function = Functions::create($form);

        return response()->json([
            'success' => true,
            'message' => 'Successfully created new function.',
            'function' => $function,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Managements\Functions  $functions
     * @return \Illuminate\Http\Response
     */
    public function show(Functions $function)
    {
        //
        return response()->json([
            'success' => true,
            'message' => 'Function found.',
            'function' => $function,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Managements\Functions  $functions
     * @return \Illuminate\Http\Response
     */
    public function edit(Functions $functions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Managements\Functions  $function
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Functions $function)
    {
        //
        $form = $request->validate([
            "function_name" => "required|max:100",
            "function_desc" => "max:255",
        ]);

        $form['updated_by'] = auth()->user()->username;

        $function->update($form);

        return response()->json([
            'success' => true,
            'message' => 'Function updated.',
            'function' => $function,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Managements\Functions  $functions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Functions $function)
    {
        //
        $function->delete();

        return response()->json([
            'success' => true,
            'message' => 'Function deleted.',
        ]);
    }

    /**
     * Show all resources from storage.
     * 
     * 
     * @return \Illuminate\Http\Response and App\Models\Managements\Functions
     * 
     */
    public function showall()
    {
        //
        $functions = Functions::all();

        return response()->json([
            'success' => true,
            'message' => 'Functions found.',
            'functions' => $functions,
        ]);
    }
}
