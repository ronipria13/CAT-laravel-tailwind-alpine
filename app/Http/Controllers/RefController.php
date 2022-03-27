<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ref\Province;
use App\Models\Ref\Regency;
use App\Models\Ref\District;
use App\Models\Ref\Village;
use App\Models\User;
use App\Models\Data\Penyuluh;

class RefController extends Controller
{
    public function provinces(Request $request)
    {
        if($request->ajax()) {
            if(!$request->id) {
                $provinces = Province::all();
            } else {
                $provinces = Province::find($request->id);
            }
            return response()->json(compact('provinces'));
        }
        return response()->failed('Not ajax request');
    }

    public function regencies(Request $request)
    {
        if($request->ajax()) {
            if(!$request->province_id){
                $regencies = ['message' => 'Data not found'];
            }
            else{
                $regencies = Regency::where('province_id',$request->province_id)->get();
            }
            return response()->json(compact('regencies'));
        }
        return response()->failed('Not ajax request');
    }

    public function districts(Request $request)
    {
        if($request->ajax()) {
            if(!$request->regency_id){
                $districts = ['message' => 'Data not found'];
            }
            else{
                $districts = District::where('regency_id',$request->regency_id)->get();
            }
            return response()->json(compact('districts'));
        }
        return response()->failed('Not ajax request');
    }

    public function villages(Request $request)
    {
        if($request->ajax()) {
            if(!$request->district_id){
                $villages = ['message' => 'Data not found'];
            }
            else{
                $villages = Village::where('district_id',$request->district_id)->get();
            }
            return response()->json(compact('villages'));
        }
        return response()->failed('Not ajax request');
    }

    public function users(Request $request)
    {
        if($request->ajax()) {
            if(!$request->id) {
                $users = User::all();
            } else {
                $users = User::find($request->id);
            }
            return response()->json(compact('users'));
        }
        return response()->failed('Not ajax request');
    }

    public function penyuluh(Request $request)
    {
        if($request->ajax()) {
            if(!$request->id) {
                $penyuluh = Penyuluh::all();
            } else {
                $penyuluh = Penyuluh::find($request->id);
            }
            return response()->json(compact('penyuluh'));
        }
        return response()->failed('Not ajax request');
    }
}
