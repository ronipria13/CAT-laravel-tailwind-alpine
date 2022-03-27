<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    protected $table = 'reg_regencies';

    public function district()
    {
        return $this->hasMany(District::class, 'regency_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
