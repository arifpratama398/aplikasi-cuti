<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefAgama extends Model
{
  protected $table      = 'ref_agama';
  protected $primaryKey = 'id';
  const UPDATED_AT = 'updated_at';

  protected $fillable = [
      'name'
  ];
}
