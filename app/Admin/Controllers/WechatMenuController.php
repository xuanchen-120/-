<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tree;
use App\Admin\Requests\WechatMenuRequest;
use App\Models\WechatMenu;

class WechatMenuController extends Controller
{
    public function index()
    {
        $menus = WechatMenu::treeJson();
        $lists = WechatMenu::paginate();
        return view('Admin::wechatmenus.index', compact('menus', 'lists'));
    }

    public function create()
    {
        $parents = WechatMenu::treeShow();
        return view('Admin::wechatmenus.create', compact('parents'));
    }

    public function store(WechatMenuRequest $request)
    {
        $data   = $request->post();
        $result = WechatMenu::create($data);
        if ($result) {
            return $this->success('添加成功');
        } else {
            return $this->error();
        }
    }

    public function edit(WechatMenu $wechatmenu)
    {
        $parents = WechatMenu::treeShow();
        return view('Admin::wechatmenus.edit', compact('wechatmenu', 'parents'));
    }

    public function update(WechatMenuRequest $request, WechatMenu $wechatmenu)
    {
        if ($wechatmenu->update($request->all())) {
            return $this->success('编辑成功');
        } else {
            return $this->error();
        }
    }

    public function destroy(WechatMenu $wechatmenu)
    {
        if ($wechatmenu->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function sync()
    {
        $app     = app('wechat.official_account');
        $current = $app->menu->current();
        if ($current->is_menu_open) {
            DB::table('wechat_menus')->truncate();
            $menus = $current->selfmenu_info["button"];
            foreach ($menus as $key => $menu) {
                $result = WechatMenu::create([
                    'parent_id' => 0,
                    'type'      => $menu['type'] ?? '',
                    'name'      => $menu['name'],
                    'sort'      => $key + 1,
                    'key'       => $menu['key'] ?? '',
                    'url'       => $menu['url'] ?? '',
                    'media_id'  => $menu['media_id'] ?? '',
                    'appid'     => $menu['appid'] ?? '',
                    'pagepath'  => $menu['pagepath'] ?? '',
                ]);
                if (isset($menu['sub_button'])) {
                    foreach ($menu['sub_button']['list'] as $k => $value) {
                        $resultchild = WechatMenu::create([
                            'parent_id' => $result->id,
                            'type'      => $value['type'] ?? '',
                            'name'      => $value['name'],
                            'sort'      => $k + 1,
                            'key'       => $value['key'] ?? '',
                            'url'       => $value['url'] ?? '',
                            'media_id'  => $value['media_id'] ?? '',
                            'appid'     => $value['appid'] ?? '',
                            'pagepath'  => $value['pagepath'] ?? '',
                        ]);
                    }
                }
            }
            return $this->success();
        } else {
            return $this->error('同步失败');
        }
    }

    public function publish()
    {
        $app   = app('wechat.official_account');
        $menus = WechatMenu::orderBy('sort')->get()->toArray();
        $menus = Tree::list2tree($menus);
        foreach ($menus as $key => $menu) {
            $temp         = [];
            $temp['name'] = $menu['name'];
            if (empty($menu['children'])) {
                $temp['type'] = $menu['type'];
                if ($temp['type'] == 'view') {
                    $temp['url'] = $menu['url'];
                } elseif ($temp['type'] == 'media_id' || $temp['type'] == 'view_limited') {
                    $temp['media_id'] = $menu['media_id'];
                } elseif ($temp['type'] == 'miniprogram') {
                    $temp['url']      = $menu['url'];
                    $temp['appid']    = $menu['appid'];
                    $temp['pagepath'] = $menu['pagepath'];
                } else {
                    $temp['key'] = $menu['keyword'];
                }
            } else {
                $sub = [];
                foreach ($menu['children'] as $submenu) {
                    $sub['name'] = $submenu['name'];
                    $sub['type'] = $submenu['type'];
                    if ($sub['type'] == 'view') {
                        $sub['url'] = $submenu['url'];
                    } elseif ($sub['type'] == 'media_id' || $sub['type'] == 'view_limited') {
                        $sub['media_id'] = $submenu['media_id'];
                    } elseif ($submenu['type'] == 'miniprogram') {
                        $sub['url']      = $submenu['url'];
                        $sub['appid']    = $submenu['appid'];
                        $sub['pagepath'] = $submenu['pagepath'];
                    } else {
                        $sub['key'] = $submenu['keyword'];
                    }
                    $temp['sub_button'][] = $sub;
                }
            }
            $buttons[] = $temp;
        }
        $res = $app->menu->create($buttons);
        return $this->success();
    }
}
