<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    public function sessions()
    {
        return $this->belongsTo(Sessions::class);
    }
    protected $fillable = [
        'father_name',
        'mother_name',
        'region_id',
        'program_id',
        'session_id',
        'trainer_id',
    ];
}
