<?php

namespace App\Http\Livewire\Managements;

use App\Models\Managements\Modules;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ModulesTable extends LivewireDatatable
{
    protected $listeners = ['refreshModules' => '$refresh'];

    public function builder()
    {
        return Modules::query()
        ->from('modules')
        ->orderBy('created_at', 'desc');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
            ->hide(),

            Column::name('module_name')
            ->label('Module Name')
            ->searchable(),

            Column::name('module_desc')
            ->label('Description')
            ->searchable(),

            Column::name('type')
            ->label('Type'),

            DateColumn::name('created_at')
            ->label('Created At'),

            Column::callback('id', function ($id) {
                $editAction = "editData('".$id."')";
                $deleteAction = "confirmDelete('".$id."')";
                return view('actions.action-module', compact("id","editAction","deleteAction") );
            })
            ->label('Action')
            ->unsortable(),
        ];
        
    }
}