<?php

namespace App\Http\Livewire\Managements;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;

class MenuTable extends LivewireDatatable
{
    protected $listeners = ['refreshMenus' => '$refresh'];

    public function builder()
    {
        return \App\Models\Managements\Menus::query()
        ->join('menugroups', 'menus.menugroup_id', '=', 'menugroups.id')
        ->orderBy('menugroups.menugroup_order', 'asc')
        ->orderBy('menus.menu_order', 'asc');
    }

    public function columns()
    {
        //
        return [
            Column::name('id')
            ->hide(),

            NumberColumn::name('menus.menu_order')
            ->label('urutan'),

            Column::name('menugroups.menugroup_label')
            ->label('Menu Group'),

            Column::name('menus.menu_label')
            ->label('Label')
            ->searchable(),

            Column::name('menus.menu_desc')
            ->label('Description')
            ->searchable(),

            Column::name('menus.route')
            ->label('URL')
            ->searchable(),


            Column::callback(['menus.id::varchar(255)','menus.type'], function ($id,$type) {
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