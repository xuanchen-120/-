<?php

namespace App\Models;

use App\Admin\Extensions\Tree;

class WechatMenu extends Model
{
    public static function treeJson()
    {
        $list = self::select('id', 'parent_id', 'name as text')->orderBy('sort', 'asc')->get()->toArray();
        return json_encode(Tree::list2tree($list, 'id', 'parent_id', 'nodes'), JSON_UNESCAPED_UNICODE);
    }

    public static function treeShow($id = 0)
    {
        $parents = self::when($id, function ($query) use ($id) {
            return $query->where('id', '<>', $id);
        })->orderBy('sort', 'asc')->get()->toArray();

        $parents = Tree::toFormatTree($parents, 'name');

        $parents = array_merge([0 => ['id' => 0, 'title_show' => '顶级分类']], $parents);
        return $parents;
    }
}
