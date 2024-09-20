<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    protected $fillable = [
        'father_name',
        'mother_name',
        'region_id',
        'program_id',
        'session_id'
    ];
}
