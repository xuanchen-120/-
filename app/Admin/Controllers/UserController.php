<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\UserRequest;
use App\Models\Area;
use App\Models\User;
use App\Rules\CheckMobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $nickname = $request->nickname;
        $mobile   = $request->mobile;

        $users = User::with('info')
            ->when($nickname, function ($query) use ($nickname) {
                $query->whereHas('info', function ($query) use ($nickname) {
                    $query->where('nickname', 'like', "%{$nickname}%");
                });
            })
            ->when($mobile, function ($query) use ($mobile) {
                $query->where('username', $mobile);

            })
            ->orderBy('id', 'desc')->paginate(15);

        return view('Admin::users.index', compact('users'));
    }
    public function create()
    {
        $areas = Area::where(['psn' => 0, 'type' => '省级'])->get();

        return view('Admin::users.create', compact('areas'));
    }

    public function store(UserRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'username' => $request->username,
            ]);
            $user->info()->create([
                'nickname' => $request->nickname,
                'idcard'   => $request->idcard,
                'country'  => $request->country,
                'address'  => $request->province . ' ' . $request->city,
            ]);
        });
        return $this->success('操作成功');
    }

    public function edit(User $user)
    {
        return view('Admin::users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'nullable|between:6,32',
            'nickname' => 'required',
            'username' => ['required', new CheckMobile, 'unique:users,username,' . $user->id],
        ], [
            'nickname.required' => '必须填写法名',
            'username.required' => '手机号必须填写',
            'username.unique'   => '手机号已存在',
            'password.between'  => '登录密码长度应在:min-:max位之间',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }
        $user_data = [
            'username' => $request->username,
        ];
        if ($request->password) {
            $user_data['password'] = $request->password;
        }
        if ($user->update($user_data)) {
            $user->info()->update(['nickname' => $request->nickname]);
            return $this->success('修改成功');
        } else {
            return $this->error();
        }
    }

    /**
     * 删除
     * @Author:<C.Jason>
     * @Date:2018-11-02T13:44:52+0800
     * @param User $user [description]
     * @return [type] [description]
     */
    public function destroy(User $user)
    {
        try {
            DB::transaction(function () use ($user) {
                $user->info()->delete();
                $user->delete();
            });
            return $this->success();
        } catch (\Exception $e) {
            return $this->error('删除失败' . $e->getmessage());
        }
    }

}
