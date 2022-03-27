<?php

namespace App\Http\Livewire\Managements;

use App\Models\Managements\Roles;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RolesTable extends LivewireDatatable
{

    protected $listeners = ['refreshRoles' => '$refresh'];

    public function builder()
    {
        //
        return Roles::query()
        ->from('roles')
        ->orderBy('created_at', 'desc');
    }

    public function columns()
    {
        //
        return [
            NumberColumn::name('id')
            ->hide(),

            Column::name('role_name')
            ->label('Role Name')
            ->searchable(),

            Column::name('role_desc')
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