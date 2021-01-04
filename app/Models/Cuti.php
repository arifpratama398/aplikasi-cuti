<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
	protected $table = 'cuti';

    use HasFactory;
    protected $fillable = [
        'karyawan_id', 'tgl_mulai', 'tgl_selesai', 'deskripsi', 'status_1', 'status_2'
    ];

    public function karyawan() {
        return $this->belongsTo('App\Models\Karyawan', 'karyawan_id', 'id');
    }
}
