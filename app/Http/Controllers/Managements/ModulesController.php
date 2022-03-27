<?php

namespace App\Http\Controllers\Managements;

use App\Http\Controllers\Controller;
use App\Models\Managements\Modules;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('app.managements.modules._index');
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
            "module_name" => "required|string|max:100",
            "module_desc" => "string",
        ]);

        $form['id'] = Str::uuid();
        $form['type'] = "common";
        $form['created_by'] = auth()->user()->username;

        $module = Modules::create($form);

        return response()->json([
            'success' => true,
            'message' => 'Successfully created new module.',
            'module' => $module,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Modules $module)
    {
        //
        return response()->json([
            'success' => true,
            'message' => 'Module found.',
            'module' => $module,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Modules $module)
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
    public function update(Request $request, Modules $module)
    {
        //
        $form = $request->validate([
            "module_name" => "required|string|max:100",
            "module_desc" => "string",
        ]);

        $form['updated_by'] = auth()->user()->username;

        $module->update($form);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated module.',
            'module' => $module,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modules $module)
    {
        //
        $module->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted module.',
            'module' => $module,
        ]);
    }
}
