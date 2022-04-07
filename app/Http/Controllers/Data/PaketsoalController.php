<?php

namespace App\Http\Controllers\Data;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Data\Paketsoal;
use App\Http\Controllers\Controller;

class PaketsoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $total = Paketsoal::count();
        $max = 10;
        return view('app.data.paketsoal._index', compact('total', 'max'));
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
        $total = Paketsoal::count();
        $max = 10;
        if($total >= $max) {
            return response()->json([
                'status' => false,
                'message' => 'Paket soal sudah melebihi batas maksimal',
            ],422);
        }
        $request->validate([
            'name' => 'required',
            'desc' => '',
            'type' => 'required',
            'status' => 'required',
        ]);

        $paketsoal = Paketsoal::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'desc' => $request->desc,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data paket berhasil disimpan',
            'paketsoal' => $paketsoal,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Data\Paketsoal  $paketsoal
     * @return \Illuminate\Http\Response
     */
    public function show(Paketsoal $paketsoal)
    {
        //
        return response()->json([
            'status' => true,
            'message' => 'Data Paket Soal berhasil ditemukan',
            'paketsoal' => $paketsoal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Data\Paketsoal  $paketsoal
     * @return \Illuminate\Http\Response
     */
    public function edit(Paketsoal $paketsoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Data\Paketsoal  $paketsoal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paketsoal $paketsoal)
    {
        //
        $request->validate([
            'name' => 'required',
            'desc' => '',
            'type' => 'required',
            'status' => 'required',
        ]);

        $paketsoal->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Paket Soal berhasil diupdate',
            'paketsoal' => $paketsoal,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Data\Paketsoal  $paketsoal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paketsoal $paketsoal)
    {
        //
        $name = $paketsoal->name;
        $paketsoal->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data Paket Soal berhasil dihapus',
            'paketsoal' => $paketsoal,
        ]);
    }
}
