<?php

namespace App\Http\Controllers\Data;

use App\Models\Data\Kolom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Data\Paketsoal;
use App\Http\Controllers\Controller;

class KolomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id ="")
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
        $paketsoal = Paketsoal::findorfail($id);
        return view('app.data.kolom._index', compact('paketsoal'));
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
        $validation = $request->validate([
            'paketsoal_id' => 'required|uuid',
            'col_a' => 'required|max:9|numeric',
            'col_b' => 'required|max:9|numeric',
            'col_c' => 'required|max:9|numeric',
            'col_d' => 'required|max:9|numeric',
            'col_e' => 'required|max:9|numeric',
        ]);

        $kolom = Kolom::create([
            'id' => Str::uuid(),
            'paketsoal_id' => $request->paketsoal_id,
            'col_a' => $request->col_a,
            'col_b' => $request->col_b,
            'col_c' => $request->col_c,
            'col_d' => $request->col_d,
            'col_e' => $request->col_e,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data kolom berhasil disimpan',
            'kolom' => $kolom,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Data\Kolom  $kolom
     * @return \Illuminate\Http\Response
     */
    public function show(Kolom $kolom)
    {
        //
        return response()->json([
            'status' => true,
            'message' => 'Data kolom berhasil ditampilkan',
            'kolom' => $kolom,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Data\Kolom  $kolom
     * @return \Illuminate\Http\Response
     */
    public function edit(Kolom $kolom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Data\Kolom  $kolom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kolom $kolom)
    {
        //
        $validation = $request->validate([
            'paketsoal_id' => 'required|uuid',
            'col_a' => 'required|max:9|numeric',
            'col_b' => 'required|max:9|numeric',
            'col_c' => 'required|max:9|numeric',
            'col_d' => 'required|max:9|numeric',
            'col_e' => 'required|max:9|numeric',
        ]);


        $kolom->update([
            'col_a' => $request->col_a,
            'col_b' => $request->col_b,
            'col_c' => $request->col_c,
            'col_d' => $request->col_d,
            'col_e' => $request->col_e,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data kolom berhasil diupdate',
            'kolom' => $kolom,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Data\Kolom  $kolom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kolom $kolom)
    {
        //
        $kolom->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data kolom berhasil dihapus',
        ]);
    }
}
