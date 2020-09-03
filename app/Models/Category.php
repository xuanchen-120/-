<?php

namespace App\Models;

use App\Admin\Extensions\Tree;

class Category extends Model
{

    public static function treeJson()
    {
        $list = self::select('id', 'parent_id', 'name as text')->orderBy('sort', 'asc')->get()->toArray();
        return json_encode(Tree::list2tree($list, 'id', 'parent_id', 'nodes'), JSON_UNESCAPED_UNICODE);
    }

    public static function treeShow($id = 0)
    {
        $categoies = self::when($id, function ($query) use ($id) {
            return $query->where('id', '<>', $id);
        })->orderBy('sort', 'asc')->get()->toArray();

        $categoies = Tree::toFormatTree($categoies, 'name');

        $categoies = array_merge([0 => ['id' => 0, 'title_show' => '顶级分类']], $categoies);
        return $categoies;
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function getTypeTextAttribute()
    {
        return config('catetype')[$this->type];
    }
}
