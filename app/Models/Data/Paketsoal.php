<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paketsoal extends Model
{
    use HasFactory;

    protected $table = 'paketsoal';

    protected $keyType = 'string';
    
    protected $hidden = ['created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $guarded = ['created_at','updated_at'];

    public $incrementing = false;

    public function kolom()
    {
        return $this->hasMany('App\Models\Data\Kolom', 'paketsoal_id', 'id');
    }

    public function soalkecermatan()
    {
        return $this->hasMany('App\Models\Data\Soalkecermatan', 'paketsoal_id', 'id');
    }
}
