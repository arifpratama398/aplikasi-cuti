<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table      = 'karyawan';
    protected $primaryKey = 'id';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'user_id',
        'nomor_karyawan',
        'name',
        'alamat',
        'no_telp',
        'jk_id',
        'agama_id',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function jenisKelamin()
    {
        return $this->belongsTo('App\Models\RefJenisKelamin', 'jk_id', 'id');
    }

    public function agama()
    {
        return $this->belongsTo('App\Models\RefAgama', 'agama_id', 'id');
    }
}
