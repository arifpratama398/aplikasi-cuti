<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    protected $fillable = [
        'start', 'finish', 'needs', 'status'
    ];


    public function user() {
        return $this->belongsTo(
            'App\Models\User',
        );
    }
}
