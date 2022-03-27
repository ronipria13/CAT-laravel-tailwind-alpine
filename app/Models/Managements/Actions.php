<?php

namespace App\Models\Managements;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Managements\Modules;
use App\Models\Managements\Controllers;
use App\Models\Managements\Functions;

class Actions extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    
    protected $hidden = ['created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $guarded = ['created_at','updated_at'];

    public $incrementing = false;

    public function module()
    {
        return $this->belongsTo(Modules::class);
    }

    public function controller()
    {
        return $this->belongsTo(Controllers::class);
    }

    public function function()
    {
        return $this->belongsTo(Functions::class);
    }
}
