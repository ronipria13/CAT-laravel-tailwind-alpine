<?php

namespace App\Http\Controllers\Data;

use App\Models\Data\Kolom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Data\Soalkecermatan;
use App\Http\Controllers\Controller;
use App\Models\Data\Paketsoal;

class SoalkecermatanController extends Controller
{
    /**
     * maximum soal per kolom
     */
    protected $max = 50;
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
        $kolom = Kolom::findorfail($id);
        $paketsoal = Paketsoal::findorfail($kolom->paketsoal_id);
        $total = Soalkecermatan::where('kolom_id',$id)->count();
        $max = $this->max;
        return view('app.data.soalkecermatan._index', compact('kolom','paketsoal','total','max'));
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
        
        $total = Soalkecermatan::where('kolom_id',$request->kolom_id)->count();
        $max = $this->max;
        if($total >= $max) {
            return response()->json([
                'status' => false,
                'message' => 'Soal sudah melebihi batas maksimal',
            ],422);
        }
        $validation = $request->validate([
            'paketsoal_id' => 'required|uuid',
            'kolom_id' => 'required|uuid',
            'soal' => 'required',
            'key' => 'required',
        ]);
        $validation['id'] = Str::uuid();
        $validation['created_by'] = auth()->user()->username;
        $soalkecermatan = Soalkecermatan::create($validation);
        return response()->json([
            'success' => true,
            'message' => 'Soal kecermatan berhasil ditambahkan',
            'soalkecermatan' => $soalkecermatan
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Data\Soalkecermatan  $soalkecermatan
     * @return \Illuminate\Http\Response
     */
    public function show(Soalkecermatan $soalkecermatan)
    {
        //
        return response()->json([
            'success' => true,
            'message' => 'Soal kecermatan ditemukan',
            'soalkecermatan' => $soalkecermatan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Data\Soalkecermatan  $soalkecermatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Soalkecermatan $soalkecermatan)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Data\Soalkecermatan  $soalkecermatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soalkecermatan $soalkecermatan)
    {
        //
        $validation = $request->validate([
            'paketsoal_id' => 'required|uuid',
            'kolom_id' => 'required|uuid',
            'soal' => 'required',
            'key' => 'required',
        ]);
        $validation['updated_by'] = auth()->user()->username;
        $soalkecermatan->update($validation);
        return response()->json([
            'success' => true,
            'message' => 'Soal kecermatan berhasil diupdate',
            'soalkecermatan' => $soalkecermatan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Data\Soalkecermatan  $soalkecermatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soalkecermatan $soalkecermatan)
    {
        //
        $soalkecermatan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Soal kecermatan berhasil dihapus'
        ]);
    }
}
