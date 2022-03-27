<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $table = 'reg_villages';

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    
}
