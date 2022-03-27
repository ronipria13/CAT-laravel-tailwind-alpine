<?php

namespace App\Http\Livewire\Managements;

use App\Models\Managements\Functions;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class FunctionsTable extends LivewireDatatable
{

    protected $listeners = ['refreshFunctions' => '$refresh'];

    public function builder()
    {
        return Functions::query()
        ->orderBy('created_at', 'desc');
    }

    public function columns()
    {
        return [
            Column::name('id')
            ->hide(),

            Column::name('function_name')
            ->label('Function Name')
            ->searchable(),

            Column::name('function_desc')
            ->label('Description')
            ->searchable(),

            Column::name('type')
            ->label('Type'),

            DateColumn::name('created_at')
            ->label('Created At'),

            Column::callback(['id::varchar(255)','type'], function ($id,$type) {
                // $id = explode('++', $id_type)[0];
                $editAction = "editData('".$id."')";
                $deleteAction = "confirmDelete('".$id."')";
                    return $type != "core" ? view('actions.editdelete', compact("id","editAction","deleteAction") ) : "";
            })
            ->label('Action')
            ->unsortable(),
        ];
        
    }
}