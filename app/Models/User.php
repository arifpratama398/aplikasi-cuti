<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'username', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cuti() {
        return $this->hasMany(
            'App\Models\Cuti',
        );
    }

    public function hasRole($role_name)
    {
        if ($this->role->nama === $role_name) {
            return true;
        }

        return 0;
    }    
    
    public function isAdmin()
    {
        return $this->hasRole('Admin');
    }

    public function isHRD()
    {
        return $this->hasRole('HRD');
    }

    public function isManajer()
    {
        return $this->hasRole('Manajer');
    }

    public function isKaryawan()
    {
        return $this->hasRole('Karyawan');
    }

    public function karyawan()
    {
        return $this->hasOne('App\Models\Karyawan', 'user_id', 'id');
    } 

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }
}
