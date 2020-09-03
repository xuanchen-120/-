<?php

namespace App\Models;

class BannerPosition extends Model
{
    public function banners()
    {
        return $this->hasMany(Banner::class, 'position_id');
    }

    public function getBannersCountAttribute()
    {
        return $this->banners()->count();
    }
}
