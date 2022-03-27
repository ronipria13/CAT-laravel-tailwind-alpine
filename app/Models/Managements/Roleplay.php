<?php

namespace App\Models\Managements;

use App\Models\Managements\Roles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roleplay extends Model
{
    use HasFactory;

    protected $table = 'roleplay';
    
    protected $keyType = 'string';
    
    protected $hidden = ['created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $guarded = ['created_at','updated_at'];

    public $incrementing = false;

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function roles()
    {
        return $this->hasOne(Roles::class, 'id', 'role_id');
    }
    /**
     * Check if current user has this role
     * @param string role_id $role
     * @return boolean
     */
    public function scopeThisUserHasRole($query, $role)
    {
        return $query->where('user_id', auth()->user()->id)
        ->where('role_id', $role)->count();
    }
}
