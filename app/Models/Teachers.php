<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;

    public function region()
    {
        return $this->belongsTo(Regions::class, 'region_id', 'id');
    }
    public function sessions()
    {
        return $this->belongsTo(Sessions::class);
    }
}

