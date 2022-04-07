<?php

namespace App\Http\Controllers\Latihan;

use App\Http\Controllers\Controller;
use App\Models\Data\Latihan;
use App\Models\Data\Paketsoal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.latihan.riwayat._index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Managements\Controllers  $controller
     * @return \Illuminate\Http\Response
     */
    public function show(Latihan $latihan)
    {
        $diff = Carbon::createFromFormat('Y-m-d H:i:s',$latihan->end_at) ->diffInSeconds(now(),false);
        //jika timer sudah habis
        if($diff > 0 OR $latihan->ended_at != null)
        {
            $seconds = $latihan->start_at->diffInSeconds($latihan->end_at,false);
            if($latihan->ended_at != null)
            {
                $seconds = $latihan->start_at->diffInSeconds($latihan->ended_at,false);
            }

            $lamaPengerjaan = $this->convertSecondsToTime($seconds);

            $paketsoal = Paketsoal::findorfail($latihan->paketsoal_id);
            $soalJawaban = DB::query()
                            ->select('a.*','b.*')
                            ->from('soalkecermatan as a')
                            ->leftJoin('jawaban as b', function($join) use ($latihan) {
                                $join->on('a.id', '=', 'b.soal_id')
                                ->where('b.latihan_id', '=', $latihan->id);
                                
                            })
                            ->where('a.paketsoal_id',$latihan->paketsoal_id)
                            ->get();
            $jmlSoal = $soalJawaban->count();
            $tidakJawab = 0;
            $salahJawab = 0;
            $benarJawab = 0;
            $score = 0;
            $kecepatan = round(($seconds / ($jmlSoal-$tidakJawab)),2) . " detik/soal";
            foreach($soalJawaban as $soal)
            {
                if($soal->id == null)
                {
                    $tidakJawab++;
                }
                else{
                    if($soal->true)
                    {
                        $benarJawab++;
                    }
                    if(!$soal->true)
                    {
                        $salahJawab++;
                    }
                }
                $score += $soal->value;
            }
            $stats = [
                'lamaPengerjaan' => $lamaPengerjaan,
                'jumlahSoal' => $jmlSoal,
                'benarJawab' => $benarJawab,
                'salahJawab' => $salahJawab,
                'tidakJawab' => $tidakJawab,
                'nilai' => $score,
                'kecepatan' => $kecepatan
            ];
            return view('app.latihan.riwayat._show',compact('latihan','paketsoal','stats'));
        }
        //jika masih tersisa waktu
        return redirect()->route('latihan.paketsoal', $latihan->id);
    }

    private function convertSecondsToTime($seconds)
    {
        $seconds = abs($seconds);
        $hours = floor($seconds / 3600);
        $mins = floor($seconds/60 % 60);
        $secs = floor($seconds % 60);
        $time = "";
        if($hours > 0)
        {
            $time .= $hours." jam ";
        }
        if($mins > 0)
        {
            $time .= $mins." menit ";
        }
        if($secs > 0)
        {
            $time .= $secs." detik";
        }
        return $time;
    }
}
