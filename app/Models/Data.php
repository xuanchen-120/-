<?php

namespace App\Models;

class Data extends Model
{
    protected $dates = [
        'dated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getYearAttribute()
    {
        return $this->dated_at->format('Y');
    }

    public function getNameAttribute()
    {
        switch ($this->type) {
            case 'chant':
                $name = '诵经';
                break;
            case 'write':
                $name = '抄经';
                break;

            default:
                $name = '未知';
                break;
        }

        return $name;
    }

    public function getChannelNameAttribute()
    {
        switch ($this->channel) {
            case 'year':
                $name = '年';
                break;
            case 'desires':
                $name = '发愿';
                break;
            case 'all':
                $name = '迄今';
                break;
            default:
                $name = '未知';
                break;
        }

        return $name;
    }
}
