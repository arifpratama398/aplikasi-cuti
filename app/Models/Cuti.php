<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
	protected $table = 'cuti';

    use HasFactory;
    protected $fillable = [
        'karyawan_id', 'tgl_mulai', 'tgl_selesai', 'deskripsi', 'status_1', 'status_2', 'jumlah_cuti'
    ];

    public function karyawan() {
        return $this->belongsTo('App\Models\Karyawan', 'karyawan_id', 'id');
    }
    
    public function getStatusAttribute() {
        $status = '';
        if($this->status_1 === 1 && $this->status_1 === 1)
            $status = '<span class="badge badge-success">Diterima</span>';
        elseif($this->status_1 === 0|| $this->status_1 === 0) 
            $status = '<span class="badge badge-danger">Ditolak</span>';
        else
            $status = '<span class="badge badge-warning">Pending</span>';                
        return $status;
    }
}
