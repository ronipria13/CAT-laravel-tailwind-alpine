<?php

namespace App\Http\Livewire\Managements;

use App\Models\Managements\Controllers;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ControllersTable extends LivewireDatatable
{
    protected $listeners = ['refreshControllers' => '$refresh'];

    public function builder()
    {
        return Controllers::query()
        ->from('controllers')
        ->orderBy('created_at', 'desc');
    }

    public function columns()
    {
        return [
            Column::name('id')
            ->hide(),

            Column::name('controller_name')
            ->label('Controller Name')
            ->searchable(),

            Column::name('controller_desc')
            ->label('Description')
            ->searchable(),

            Column::name('type')
            ->label('Type'),

            DateColumn::name('created_at')
            ->label('Created At'),

            Column::callback('id', function ($id) {
                $editAction = "editData('".$id."')";
                $deleteAction = "confirmDelete('".$id."')";
                return view('actions.editdelete', compact("id","editAction","deleteAction") );
            })
            ->label('Action')
            ->unsortable(),
        ];
        
    }
}