<?php

namespace App\Models\Managements;

use App\Models\Managements\Menugroups;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menus extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $keyType = 'string';

    protected $hidden = ['created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $guarded = ['created_at','updated_at'];

    public $incrementing = false;

    public function menugroups()
    {
        return $this->belongsTo(Menugroups::class, 'menugroup_id', 'id');
    }

    public function scopeOwned($query)
    {
        $query->where('active', 1);
    }
}
