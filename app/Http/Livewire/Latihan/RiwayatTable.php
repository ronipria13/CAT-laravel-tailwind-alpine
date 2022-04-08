<?php

namespace App\Http\Livewire\Latihan;

use App\Models\Data\Latihan;
use Carbon\Carbon;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RiwayatTable extends LivewireDatatable
{
    
    private function getCurrentRole()
    {
        return session()->get('current_role');
    }
    private function getCurrentUser()
    {
        return auth()->user();
    }

    public function builder()
    {
        //
        $user = $this->getCurrentUser();
        $query = Latihan::query()
        // ->select('latihan.*,peserta.name, paketsoal.name')
        ->join('peserta','peserta.id','=','latihan.peserta_id')
        ->join('users','users.id','=','peserta.user_id')
        ->join('paketsoal','paketsoal.id','=','latihan.paketsoal_id');
        if($this->getCurrentRole() == '9bae3fae-4b49-4a47-950e-b9722def4804') { $query->where('users.id', $user->id ); }
        $query->orderBy('latihan.created_at', 'desc');
        return $query;
    }

    public function columns()
    {
        //
        return [
            Column::callback(['paketsoal.name','paketsoal.desc'],function($name,$desc){
                return '<p class="font-bold text-gray-50">'.$name.'</p><p class="text-sm text-gray-50">'.$desc."</p>";
            })
            ->label('Paket Soal')
            ->searchable(),

            Column::name('users.username')
            ->label('Username')
            ->searchable(),

            Column::name('peserta.name')
            ->label('Nama')
            ->searchable(),


            Column::callback('latihan.start_at', function ($start_at) {
                $jam = Carbon::parse($start_at)->diffInHours();
                if($jam > 24) {
                    return Carbon::parse($start_at)->format('d M Y H:i');
                }
                else
                return Carbon::createFromFormat('Y-m-d H:i:s', $start_at)->diffForHumans();
            })
            ->label('Waktu'),

            Column::callback('latihan.id', function ($id) {
                return '<a href="/latihan/riwayat/'.$id.'" class="inline-flex items-center justify-center w-8 h-8 mr-2 text-indigo-100 transition-colors duration-150 bg-indigo-600 rounded-full focus:shadow-outline hover:bg-indigo-800" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>';
            })
            ->label('Action')
            ->unsortable(),
        ];
    }
}