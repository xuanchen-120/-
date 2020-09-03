<?php

namespace App\Models;

class Banner extends Model
{
    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function showable()
    {
        return $this->morphTo();
    }

    public function setShowableAttribute($model)
    {
        $this->attributes['showable_type'] = get_class($model);
        $this->attributes['showable_id']   = $model->id;
    }

    public function getTypeAttribute()
    {
        switch ($this->showable_type) {
            case 'App\Models\Active':
                return '活动模型';
                break;

            case 'App\Models\Article':
                return '文章模型';
                break;

            default:
                return 'ERROR';
                break;
        }
    }
}
