<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'reg_provinces';

    public function regency()
    {
        return $this->hasMany(Regency::class, 'province_id');
    }

}
