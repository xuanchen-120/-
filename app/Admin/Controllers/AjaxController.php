<?php

namespace App\Admin\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\UserNo;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getcities(Request $request)
    {
        $psn  = $request->post('psn');
        $area = Area::where(['psn' => $psn])->whereIn('type', ['地级', '特区'])->get();
        if ($area) {
            return ['code' => 1, 'data' => $area];
        } else {
            return ['code' => 0, 'msg' => '无数据'];
        }
    }

    public function getdistrict(Request $request)
    {
        $psn  = $request->post('psn');
        $area = Area::where(['psn' => $psn, 'type' => '县级'])->get();
        if ($area) {
            return ['code' => 1, 'data' => $area];
        } else {
            return ['code' => 0];
        }
    }

    public function usernos($no)
    {
        $result = UserNo::where('no', 'like', "{$no}%")->where('used', 0)->limit(10)->get();
        return [
            'code'    => 200,
            'message' => '',
            'value'   => $result,
        ];
    }

    public function clubUsers($user)
    {
        $users = User::with('info')
            ->where('is_vip', 1)
            ->when($user, function ($query) use ($user) {
                $query->wherehas('info', function ($query) use ($user) {
                    $query->where('nickname', 'like', "%{$user}%");
                });
            })
            ->orderBy('id', 'desc')->limit(10)->get();
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'user_id'  => $user->id,
                'nickname' => $user->info->nickname,
            ];
        }
        return [
            'code'    => 200,
            'message' => '',
            'value'   => $data,
        ];
    }
}
