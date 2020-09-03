<?php

namespace App\Models;

use App\Models\Data;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $info    = [];

    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();

        self::saved(function ($model) {
            if (is_array($model->info) && !empty($model->info)) {
                $model->info()->updateOrCreate(['user_id' => $model->id], $model->info);
            }
        });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 修改用户资料
     * @Author:<C.Jason>
     * @Date:2018-11-07T13:30:14+0800
     * @param array $info UserInfo fields
     */
    protected function setInfoAttribute($info)
    {
        $this->info = $info;
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }

    /**
     * 修改密码，留空则不修改
     * @Author:<C.Jason>
     * @Date:2018-10-31T15:04:59+0800
     * @param void
     */
    protected function setPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function write()
    {
        return $this->hasMany(Write::class);
    }

    public function chant()
    {
        return $this->hasMany(Chant::class);
    }

    public function data()
    {
        return $this->hasMany(Data::class);
    }

    //所有数据数
    protected function getChantCountAttribute()
    {
        return $this->chant()->sum('number') ?? 0;
    }

    //所有数据数
    protected function getWriteCountAttribute()
    {
        return $this->write()->sum('number') ?? 0;
    }

    protected function getYearWriteCountAttribute()
    {
        $year        = date('Y', time());
        $write_count = $this->write()->where('created_at', 'like', "{$year}%")->sum('number');
        // $year_write  = Data::where('user_id', $this->id)->where('channel', 'year')->where('type', 'write')->whereYear('created_at', $year)->sum('number') ?? 0;
        $year_write = 0;
        return $write_count + $year_write;
    }

    protected function getYearChantCountAttribute()
    {
        $year        = date('Y', time());
        $chant_count = $this->chant()->where('created_at', 'like', "{$year}%")->sum('number');

        // $year_chant = Data::where('user_id', $this->id)->where('channel', 'year')->where('type', 'chant')->whereYear('created_at', $year)->sum('number') ?? 0;
        $year_chant = 0;
        return $chant_count + $year_chant;
    }

    protected function getAllWriteCountAttribute()
    {
        $write_count = $this->write_count;
        $all_write   = Data::where('user_id', $this->id)->where('channel', 'all')->where('type', 'write')->sum('number') ?? 0;

        return $write_count + $all_write;
    }

    protected function getAllChantCountAttribute()
    {
        $chant_count = $this->chant_count;

        $all_chant = Data::where('user_id', $this->id)->where('channel', 'all')->where('type', 'chant')->sum('number') ?? 0;
        return $chant_count + $all_chant;
    }

    public function getDir($value = '')
    {
        # code...
    }

    public function getData($type, $category, $datetime)
    {
        $other = 0;
        $year  = date('Y', time());

        $this_count = $this->$category()
            ->when(in_array($type, ['day', 'month', 'year']), function ($q) use ($type, $datetime, $year) {
                if (in_array($type, ['day', 'month'])) {
                    $q->where('created_at', 'like', "{$datetime}%");
                } else {
                    $q->whereYear('created_at', $year);
                }
            })
            ->sum('number');

        if (in_array($type, ['year'])) {
            // $other = Data::where('user_id', $this->id)->where('channel', $type)->where('type', $category)->whereYear('created_at', $year)->sum('number') ?? 0;
            $other = 0;
        } elseif (in_array($type, ['all'])) {
            $other = Data::where('user_id', $this->id)->where('channel', $type)->where('type', $category)->sum('number') ?? 0;
        } else {
            $other = 0;
        }
        return $this_count + $other;
    }

}
