<?php

namespace App\Http\Livewire\Data;

use App\Models\Data\Soalkecermatan;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\LabelColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SoalkecermatanTable extends LivewireDatatable
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    protected $listeners = ['refreshSoalkecermatan' => '$refresh'];

    private function getCurrentRole()
    {
        return session()->get('current_role');
    }

    public function builder()
    {
        //
        return Soalkecermatan::query()
        ->where('kolom_id', $this->id)
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

            Column::callback('soal', function($soal){
                return str_replace("-"," ",$soal);
            })
            ->label('Soal')
            ->unsortable(),

            Column::name('key')
            ->label('Kunci Jawaban'),

            Column::callback('id', function ($id) {
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