<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefJenisKelamin extends Model
{
  protected $table      = 'ref_jenis_kelamin';
  protected $primaryKey = 'id';
  const UPDATED_AT = 'updated_at';

  protected $fillable = [
      'name'
  ];
}
