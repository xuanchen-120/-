<?php

namespace App\Models;

class Chant extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
