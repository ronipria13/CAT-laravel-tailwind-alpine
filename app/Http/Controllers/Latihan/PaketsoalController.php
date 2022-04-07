<?php

namespace App\Http\Controllers\Latihan;

use App\Http\Controllers\Controller;
use App\Models\Data\Jawaban;
use App\Models\Data\Latihan;
use App\Models\Data\Paketsoal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaketsoalController extends Controller
{
    //
    /**
     * Halaman saat mengerjakan latihan paketsoal
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Latihan $latihan)
    {
        //
        $answer = [];
        $answerList = [];
        $jawaban = Jawaban::where('latihan_id', $latihan->id)->get();
        $answer = $jawaban->map(function($item) {
            return $item->soal_id;
        });

        foreach($jawaban as $jawab) {
            $answerList[$jawab->soal_id] = $jawab->answer;
        }


        $answer = json_encode($answer->toArray());
        $answerList = json_encode($answerList);
        $paketsoal = Paketsoal::where(['type' => 'kecermatan', 'id' => $latihan->paketsoal_id])->firstOrFail();
        $timer = now()->diffInSeconds(Carbon::createFromFormat('Y-m-d H:i:s',$latihan->end_at),false);
        $timerpercol = 60;
        if($timer < 0 OR $latihan->ended_at != null)
        {
            return redirect()->route('latihan.riwayat',$latihan->id);
        }
        return view('app.latihan.paketsoal._index', compact('latihan','paketsoal','timer','timerpercol','answer','answerList'));
    }

    /**
     * Function / service untuk mengakhiri latihan secara manual sebelum timer waktu habis
     */
    public function update(Latihan $latihan)
    {
        //
        $latihan->ended_at = now();
        $latihan->save();
        return response()->json([
            'success' => true,
            'message' => 'Latihan has been ended.',
            'latihan' => $latihan,
        ]);
    }
}
