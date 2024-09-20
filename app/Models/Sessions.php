<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{

    public function users() {
        return $this->belongsTo(User::class, 'trainer'); // Assuming 'trainer' is a user
    }

    public function programs() {
        return $this->belongsTo(Programs::class, 'program_id');
    }

    public function session_fors() {
        return $this->belongsTo(Session_for::class, 'session_for_id');
    }

    public function regions() {
        return $this->belongsTo(Regions::class, 'region_id');
    }
    use HasFactory;
}
