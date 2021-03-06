<?php

namespace App\Http\Livewire\Data;

use App\Models\Data\Paketsoal;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class PaketsoalTable extends LivewireDatatable
{

    protected $listeners = ['refreshPaketsoal' => '$refresh'];

    private function getCurrentRole()
    {
        return session()->get('current_role');
    }

    public function builder()
    {
        //
        return Paketsoal::query()
        ->orderBy('created_at', 'desc');
    }

    public function columns()
    {
        //
        return [
            Column::name('id')
            ->label('ID')
            ->hide(),

            Column::name('name')
            ->label('Nama Paket Soal')
            ->searchable(),

            Column::name('desc')
            ->label('Deskripsi'),

            Column::name('type')
            ->label('Tipe'),

            Column::name('status')
            ->label('Status'),

            Column::raw('(SELECT COUNT(*) FROM kolom WHERE kolom.paketsoal_id = paketsoal.id) AS jml')
            ->label('Jumlah Kolom'),

            Column::raw('(SELECT COUNT(*) FROM soalkecermatan WHERE soalkecermatan.paketsoal_id = paketsoal.id) AS jml_soal')
            ->label('Jumlah Soal'),

            
            Column::callback('id', function ($id) {
                $editAction = "editData('".$id."')";
                $deleteAction = "confirmDelete('".$id."')";
                $path = "/data/paketsoal/kolom/".$id;
                if($this->getCurrentRole() == 'e4510500-70b4-44a9-968c-3e66fecc6fb9')
                    return view('actions.edit-delete-details', compact("id","editAction","deleteAction","path") );
                else
                    return view('actions.edit-details', compact("id","editAction","path") );
            })
            ->label('Action')
            ->unsortable(),
        ];
    }
}