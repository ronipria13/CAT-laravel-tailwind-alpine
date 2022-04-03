<?php

namespace App\Http\Livewire\Data;

use App\Models\Data\Peserta;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PesertaTable extends LivewireDatatable
{
    protected $listeners = ['refreshPeserta' => '$refresh'];

    private function getCurrentRole()
    {
        return session()->get('current_role');
    }

    public function builder()
    {
        //
        return Peserta::query()
        ->select('peserta.*','users.username')
        ->join('users','users.id','=','peserta.user_id')
        ->orderBy('peserta.created_at', 'desc');

    }

    public function columns()
    {
        //
        return [
            Column::name('users.username')
            ->label('Username')
            ->searchable(),

            Column::name('peserta.no_peserta')
            ->label('No. Peserta')
            ->searchable(),

            Column::name('peserta.name')
            ->label('Nama')
            ->searchable(),

            Column::name('peserta.gender')
            ->label('Jenis Kelamin'),

            DateColumn::name('peserta.created_at')
            ->label('Bergabung Sejak'),

            
            Column::callback('peserta.id', function ($id) {
                $editAction = "editData('".$id."')";
                $deleteAction = "confirmDelete('".$id."')";
                if($this->getCurrentRole() == 'e4510500-70b4-44a9-968c-3e66fecc6fb9')
                    return view('actions.editdelete', compact("id","editAction","deleteAction") );
                else
                    return view('actions.edit', compact("id","editAction") );
            })
            ->label('Action')
            ->unsortable(),
        ];
    }
}