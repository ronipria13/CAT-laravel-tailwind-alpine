<?php

namespace App\Models\Managements;

use Illuminate\Support\Str;
use App\Models\Managements\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Controllers extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $hidden = ['created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $guarded = ['created_at','updated_at'];

    public $incrementing = false;

    public function actions()
    {
        return $this->hasMany(Actions::class);
    }
}
