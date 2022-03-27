<?php

namespace App\Http\Livewire\Managements;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;

class MenugroupsTable extends LivewireDatatable
{

    protected $listeners = ['refreshMenugroups' => '$refresh'];

    public function builder()
    {
        return \App\Models\Managements\Menugroups::query()
        ->orderBy('menugroup_order', 'asc');
    }

    public function columns()
    {
        return [
            Column::name('id')
            ->hide(),

            NumberColumn::name('menugroup_order')
            ->label('urutan'),

            Column::name('menugroup_label')
            ->label('Label')
            ->searchable(),

            Column::name('menugroup_desc')
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
                    // return $type != "core" ? view('actions.editdelete', compact("id","editAction","deleteAction") ) : "";
                    return view('actions.editdelete', compact("id","editAction","deleteAction") );
            })
            ->label('Action')
            ->unsortable(),
        ];
    }
}