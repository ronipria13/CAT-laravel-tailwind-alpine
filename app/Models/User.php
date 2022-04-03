<?php

namespace App\Models;

use App\Models\Data\Peserta;
use App\Models\Managements\Roles;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Managements\Roleplay;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
        'username',
        'password',
    ];
    public $incrementing = false;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsToMany(Roles::class, 'roleplay', 'user_id', 'id')->withTimestamps();
    }
    
    public function roleplay()
    {
        return $this->hasMany(Roleplay::class, 'user_id', 'id');
    }
    public function thisRole()
    {
        return $this->hasOne(Roles::class, 'id', 'current_role');
    }
    public function peserta()
    {
        return $this->hasOne(Peserta::class, 'user_id', 'id');
    }
}
