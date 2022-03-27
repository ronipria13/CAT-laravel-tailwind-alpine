<?php

namespace App\Models\Managements;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;
    
    protected $keyType = 'string';
    
    protected $hidden = ['created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $guarded = ['created_at','updated_at'];

    public $incrementing = false;

    /**
     * get all permissions based on current role in session for generate menu
     * 
     */
    public function scopeMypermissionsForMenu($query)
    {
        return $query->join('actions', 'actions.id', '=', 'permissions.action_id')
            ->where('actions.ajax_only', false)
            ->where('permissions.role_id', session()->get('current_role'))
            ->select('permissions.*');
    }
    /**
     * check user's request has permission or not 
     * naturaly use in middleware roleplay
     * return boolean
     */
    public function scopeCheckAccess($query, $action,$ajax_request)
    {
        $thisUser = auth()->user();
        return $query->join('actions', 'actions.id', '=', 'permissions.action_id')
        ->where('actions.ajax_only', $ajax_request)
        ->where('actions.action_path', $action)
        ->where('permissions.role_id', $thisUser->current_role)
        ->count();
    }
}
