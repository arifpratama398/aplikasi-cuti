<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefJatahCuti extends Model
{
  protected $table      = 'ref_jatah_cuti';
  protected $primaryKey = 'id';
  const UPDATED_AT = 'updated_at';

  protected $fillable = [
      'name'
  ];
}
