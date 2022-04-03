<?php

namespace App\Http\Controllers\Latihan;

use App\Http\Controllers\Controller;
use App\Models\Data\Latihan;
use App\Models\Data\Paketsoal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaketsoalController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Latihan $latihan)
    {
        //
        $paketsoal = Paketsoal::where(['type' => 'kecermatan', 'id' => $latihan->paketsoal_id])->firstOrFail();
        $timer = now()->diffInSeconds(Carbon::createFromFormat('Y-m-d H:i:s',$latihan->end_at),false);
        return view('app.latihan.paketsoal._index', compact('latihan','paketsoal','timer'));
    }
}
