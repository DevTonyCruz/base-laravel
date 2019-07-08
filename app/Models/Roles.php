<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public function scopeActive($query) {
        return $query->where('status', 1);
     }
}
