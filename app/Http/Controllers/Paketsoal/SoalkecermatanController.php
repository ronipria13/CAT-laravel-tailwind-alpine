<?php

namespace App\Http\Controllers\Paketsoal;

use Illuminate\Support\Str;
use App\Models\Data\Latihan;
use App\Models\Data\Peserta;
use Illuminate\Http\Request;
use App\Models\Data\Paketsoal;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class SoalkecermatanController extends Controller
{
    /**
     * menampilkan halaman daftar pelatihan yang bisa dipilih oleh peserta
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $paketsoal = Paketsoal::where('type', 'kecermatan')->where('status', 'released')->get();
        return view('app.paketsoal.soalkecermatan._index', compact('paketsoal'));
    }

    
    /**
     * Take latihan untuk initiate latihan soal kecermatan
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Paketsoal $paketsoal)
    {
        $paketsoal = $paketsoal->with('kolom', 'soalkecermatan')->get()->toArray();
        $dataPeserta = Peserta::where('user_id', auth()->user()->id)->firstOrFail();
        $soallist = [];
        foreach($paketsoal[0]['kolom'] as $kolom){
            $col = [];
            $col['id'] = $kolom['id'];
            $col['col_a'] = trim($kolom['col_a']);
            $col['col_b'] = trim($kolom['col_b']);
            $col['col_c'] = trim($kolom['col_c']);
            $col['col_d'] = trim($kolom['col_d']);
            $col['col_e'] = trim($kolom['col_e']);
            foreach($paketsoal[0]['soalkecermatan'] as $soal){
                if($soal['kolom_id'] == $kolom['id']){
                    $soalcol = [];
                    $soalcol['id'] = $soal['id'];
                    $soalcol['soal'] = explode('-', $soal['soal']);
                    $col['soals'][] = $soalcol;
                }
            }
            $soallist[] = $col;
        }

        $latihan = Latihan::create([
            'id' => Str::uuid()->toString(),
            'paketsoal_id' => $paketsoal[0]['id'],
            'peserta_id' => $dataPeserta->id,
            'start_at' => now(),
            'end_at' => now()->addMinutes(10),
            'soal_list' => json_encode($soallist),
            'created_by' => auth()->user()->username,
        ]);
        return redirect()->route('latihan.paketsoal', $latihan->id);
    }
    
    /**
     * menampilkan halaman detail dan persiapan sebelum memulai test
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Paketsoal $paketsoal)
    {
        //
        $user = auth()->user()->load('peserta');
        $latihan = Latihan::where('peserta_id', $user->peserta->id )->where('paketsoal_id', $paketsoal->id)->orderBy('end_at', 'desc')->first();
        // dd($latihan->end_at . " - " . now());
        // jika latihan yang sama belum diakhiri
        if(Carbon::createFromFormat('Y-m-d H:i:s',$latihan->end_at)->diffInSeconds(now(),false) < 0 AND $latihan->ended_at == null){
            return redirect()->route('latihan.paketsoal', $latihan->id);
        }
        return view('app.paketsoal.soalkecermatan._ready', compact('paketsoal'));
    }
}
