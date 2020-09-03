<?php

namespace App\Models;

class UserInfo extends Model
{
    protected $dates = ['subscribed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSexTextAttribute()
    {
        switch ($this->sex) {
            case '1':
                $res = '男';
                break;
            case '2':
                $res = '女';
                break;

            default:
                $res = '保密';
                break;
        }
        return $res;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getHeadImgAttribute()
    {
        return $this->storage ?? '/assets/home/img/mnf.jpg';
    }
}
