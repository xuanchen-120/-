<?php

namespace App\Facades\Sms;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class SmsModel extends EloquentModel
{

    protected $table = 'sms';

    protected $guarded = [];

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //     });
    // }
}
