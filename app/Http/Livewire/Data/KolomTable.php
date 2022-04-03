<?php

namespace App\Http\Livewire\Data;

use App\Models\Data\Kolom;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\LabelColumn;

class KolomTable extends LivewireDatatable
{

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    protected $listeners = ['refreshKolom' => '$refresh'];

    private function getCurrentRole()
    {
        return session()->get('current_role');
    }

    public function builder()
    {
        //
        return Kolom::query()
        ->where('paketsoal_id', $this->id)
        ->orderBy('created_at', 'desc');
    }

    public function columns()
    {
        //
        return [
            Column::name('id')
            ->label('ID')
            ->hide(),

            // (new LabelColumn())
            // ->label("Paket Soal")
            // ->content($this->id),

            Column::name('col_a')
            ->label('A')
            ->unsortable(),

            Column::name('col_b')
            ->label('B'),

            Column::name('col_c')
            ->label('C'),

            Column::name('col_d')
            ->label('D'),

            Column::name('col_e')
            ->label('E'),

            Column::callback('id', function ($id) {
                $editAction = "editData('".$id."')";
                $deleteAction = "confirmDelete('".$id."')";
                $path = "/data/paketsoal/soalkecermatan/".$id;
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