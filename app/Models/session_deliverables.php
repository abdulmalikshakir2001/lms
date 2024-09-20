<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class session_deliverables extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'path', // Assuming you're also storing the path
        // Add any other fields that should be mass assignable
    ];
}
