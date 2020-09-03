<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('setting.index', compact('user'));
        View::share('nav', 1);
    }

    public function avatar(User $user, Request $request)
    {
        $storage = $request->avatar;
        if ($user->info()->update(['storage' => $storage])) {
            return $this->success('操作成功');
        } else {
            return $this->error('操作失败');
        }
    }

    public function info(User $user, $field, Request $request)
    {
        if ($request->isMethod('put')) {
            if ($field == 'nickname') {
                $validator = Validator::make($request->all(), [
                    'nickname' => 'required',
                ], [
                    'nickname.required' => '法名必须填写',
                ]);
            } elseif ($field == 'desires') {
                $validator = Validator::make($request->all(), [
                    'desires' => 'required',
                ], [
                    'desires.required' => '发愿数必须填写',
                ]);
            }

            if ($validator->fails()) {
                return $this->error($validator->errors()->first(), '', '');
            }

            $result = $user->info()->update([$field => $request->$field]);
            if ($result) {
                $url = route('settings.index', $user);
                return $this->success('操作成功', $url);
            } else {
                return $this->error('操作失败');
            }
        } else {
            switch ($field) {
                case 'nickname':
                    $placeholder = "请输入法名";
                    break;

                case 'desires':
                    $placeholder = "请输入发愿数";
                    break;
            }
            return view('setting.info', compact('user', 'field', 'placeholder'));
        }
    }

    public function password(Request $request)
    {
        if ($request->isMethod('PUT')) {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'old_password' => 'required|min:6',
                'password'     => 'required|min:6|confirmed',
            ], [
                'old_password.required' => '原密码不能为空',
                'old_password.min'      => '原密码不能少于6个字符',
                'password.required'     => '新密码必须填写',
                'password.min'          => '新密码不能少于6个字符',
                'password.confirmed'    => '确认密码与登录密码不一致',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }

            if (\Hash::check($request->get('old_password'), $user->password)) {
                $user->password = $request->password;
                $user->save();
                return $this->success('修改成功', route('settings.index', $user));
            }
            return $this->error('修改失败');

        } else {
            return view('setting.password');
        }
    }

}
