<?php

namespace App\Http\Controllers\Latihan;

use App\Models\Data\Soalkecermatan;
use App\Models\Data\Jawaban;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JawabanController extends Controller
{
    //
    /**
     * Fungsi/Service untuk menyimpan jawaban dari peserta
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $validation = $request->validate([
            'latihan_id' => 'required|exists:latihan,id',
            'soal_id' => 'required|exists:soalkecermatan,id',
            'answer' => 'required|max:5',
        ]);
        $soal = SoalKecermatan::findOrFail($request->soal_id);

        //cek jawaban benar atau salah
        if(trim($soal->key) == trim($request->answer)){
            $validation['true'] = true;
            $validation['value'] = 1;
            $validation['answered_time'] = now();
        }else{
            $validation['true'] = false;
            $validation['value'] = -3;
            $validation['answered_time'] = now();
        }
        //cek apakah sudah pernah menjawab
        $jawaban = Jawaban::where('latihan_id',$request->latihan_id)
            ->where('soal_id',$request->soal_id)
            ->where('created_by',auth()->user()->username)
            ->first();

        //update jawaban
        if($jawaban){
            $validation['updated_by'] = auth()->user()->username;
            $jawaban->update($validation);
        }
        else{
        //create jawaban
            $validation['id'] = Str::uuid();
            $validation['created_by'] = auth()->user()->username;
            $jawaban = Jawaban::create($validation);
        }
        return response()->json([
            'success' => true,
            'message' => 'Successfully answered the question',
            'jawaban' => $jawaban,
        
        ]);
    }
}
