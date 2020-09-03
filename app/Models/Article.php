<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'description', 'content', 'storage_id', 'type', 'category_id'];

    public function link()
    {
        return route('articles.show', $this);
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class)->withDefault();
    }

}
