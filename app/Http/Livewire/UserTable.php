<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UserTable extends LivewireDatatable
{
    protected $listeners = ['refreshUser' => '$refresh'];

    public function builder()
    {
        return User::query()
        ->select('a.name','a.username','a.created_at','a.id')
        ->from('roleplay as b')
        ->join('users as a', 'a.id', '=', 'b.user_id')
        ->join('roles as c', 'b.role_id', '=', 'c.id')
        ->groupBy('a.id')
        ->orderBy('a.created_at', 'desc');
    }


    public function columns()
    {
        return[
            // Column::name('id')
            // ->defaultSort('asc')
            // ->label('ID'),

            Column::name('a.name')
            ->label('Nama')
            ->searchable(),

            Column::name('a.username')
            ->label('Username')
            ->searchable(),

            Column::raw('STRING_AGG("c"."role_name", \', \') AS role_name')
            ->label('Role'),

            Column::callback('a.is_active', function($is_active){
                return $is_active ? '<span class="inline-block rounded-full text-white bg-blue-500 px-2 py-1 text-xs font-bold mr-3">Active</span>' 
                : '<span class="inline-block rounded-full text-white bg-red-500 px-2 py-1 text-xs font-bold mr-3">Inactive</span>';
            })
            ->label('Status'),

            DateColumn::name('a.created_at')
            ->label('Dibuat')
            ->defaultSort('desc'),

            Column::callback('a.id', function ($id) {
                $editAction = "editData('".$id."')";
                $deleteAction = "confirmDelete('".$id."')";
                return view('actions.editdelete', compact("id","editAction","deleteAction") );
            })
            ->label('Action')
            ->unsortable(),
        ];
    }

}