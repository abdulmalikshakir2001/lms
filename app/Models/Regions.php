<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    use HasFactory;

    public function teachers()
    {
        return $this->hasMany(Teachers::class, 'region_id', 'id');
    }
    public function facilitators()
    {
        return $this->hasMany(Facilitators::class, 'region_id', 'id');
    }
}
