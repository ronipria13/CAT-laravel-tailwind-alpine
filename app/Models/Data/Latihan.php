<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    use HasFactory;

    protected $table = 'latihan';

    protected $keyType = 'string';
    
    protected $hidden = ['created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $guarded = ['created_at','updated_at'];

    protected $dates = ['start_at', 'end_at', 'ended_at'];

    public $incrementing = false;

    public function soal()
    {
        return $this->hasMany('App\Models\Data\Soalkecermatan', 'paketsoal_id', 'paketsoal_id');
    }
}
