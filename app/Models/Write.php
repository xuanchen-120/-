<?php

namespace App\Models;

class Write extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function getCanAlterAttribute()
    {
        $first = self::where('user_id', $this->user_id)->orderBy('id', 'asc')->first();
        if ($first && $first->id == $this->id && $first->created_at == $first->updated_at) {
            return 1;
        }

        return 0;
    }

}
