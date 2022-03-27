<?php

namespace App\Http\Controllers\Managements;

use App\Http\Controllers\Controller;
use App\Models\Managements\Modules;
use App\Models\Managements\Controllers;
use App\Models\Managements\Functions;
use App\Models\Managements\Actions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        if(!Str::isUuid($id)){
            $code = 404;
            return response()->view('app.error.page', [
                "title" => "Sorry we couldn't find this page.",
                "message" => "But dont worry, you can find plenty of other things on our homepage.",
                "code" => $code
            ] ,$code);
        }
        $module = Modules::findorfail($id);
        $actions = Actions::where('module_id', $id)->get();
        return view('app.managements.actions._index', compact('module', 'actions'));
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
            "module_id" => "",
            "controller_id" => "required",
            "function_id" => "required",
            "ajax_only" => "",
        ]);
        $modules = Modules::findorfail($form['module_id']);
        $controllers = Controllers::findorfail($form['controller_id']);
        $functions = Functions::whereIn('id', $form['function_id'])->get();
        $function_ids = collect($form['function_id']);
        $saved = $function_ids->map(function($item) use ($form, $modules, $controllers, $functions) {
            $function = $functions->find($item);
            $action = Actions::where('module_id', $form['module_id'])->where('controller_id', $form['controller_id'])->where('function_id', $item);

            $batch['action_path'] = "App\\Http\\Controllers\\" . $modules->module_name . "\\" . $controllers->controller_name . 'Controller@' . $function->function_name;
            $batch['ajax_only'] = $form['ajax_only'];
            $batch['type'] = "common";


            if($action->exists()) {
                if($action->first()->type == "core"){
                    $batch['updated_by'] = auth()->user()->username;
                    $action->first()->update($batch);
                    $saved['updated'] = $action;
                }
                $saved['updated'] = [];
            }
            else{
                $batch['id'] = Str::uuid()->toString();
                $batch['module_id'] = $form['module_id'];
                $batch['controller_id'] = $form['controller_id'];
                $batch['function_id'] = $item;
                $batch['created_by'] = auth()->user()->username;
                $action = Actions::create($batch);
                $saved['inserted'] = $action;
            }

            return $saved;

        });

        return response()->json([
            'success' => true,
            'message' => 'Actions has been added.',
            'actions' => $saved,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Managements\Actions  $actions
     * @return \Illuminate\Http\Response
     */
    public function show(Actions $action)
    {
        //
        return response()->json([
            'success' => true,
            'message' => 'Action found.',
            'action' => $action,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Managements\Actions  $actions
     * @return \Illuminate\Http\Response
     */
    public function edit(Actions $action)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Managements\Actions  $actions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actions $action)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Managements\Actions  $actions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $deleteId = explode('&', $id);
        $actions = Actions::whereIn('id', $deleteId)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Actions has been deleted.',
            'actions' => $actions,
        ]);
        
    }

    /**
     * 
     * get All action from a module
     * 
     * @return \Illuminate\Http\Response
     */
    public function showall($id)
    {
        //
        $a = [];
        $actions = [];
        if($id == 'all'){
            $rawActions = Actions::with(['controller','module','function'])->get();
            $rawActions->sortBy([
                ['module.module_name','asc'],
                ['controller.controller_name','asc'],
                ['function.function_name','asc'],
            ]);
            // dd($actions);
        }
        else if($id == 'nonajaxonly'){
            $rawActions = Actions::where('ajax_only', "false")->get();
            return response()->json([
                'success' => true,
                'message' => 'Actions non ajax only.',
                'actions' => $rawActions,
            ]);
        }
        else{
            $rawActions = Actions::where("module_id", $id)->with(['controller','module','function'])->get();
        }
        /** remap data from eloquent into array associative */
        foreach($rawActions as $action) {
            $a[$action->module->module_name][$action->controller->controller_name][] = [
                "action_id" => $action->id,
                "module_id" => $action->module->id,
                "controller_id" => $action->controller->id,
                "function_name" => $action->function->function_name,
                "function_desc" => $action->function->function_desc,
                "ajax_only" => $action->ajax_only,
                "type" => $action->type,
            ];
        }
        /** remap data again into array index before encapsuleted into json */
        foreach($a as $key => $value) {
            $actions[] = [
                "module" => $key,
            ];
            foreach($value as $k => $v){
                $actions[count($actions)-1]["module_id"] = $v[0]['module_id'];
                $actions[count($actions)-1]["controllers"][] = [
                    "controller" => $k,
                    "controller_id" => $v[0]['controller_id'],
                    "functions" => $v,
                ];
            }
        }


        return response()->json([
            'success' => true,
            'message' => 'Actions found.',
            'actions' => $actions,
        ]);
    }
}
