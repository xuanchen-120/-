<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Validator;

class MyDataController extends Controller
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
        view()->share('nav', 1);
    }

    public function index()
    {
        $user = Auth::user();
        $year = [
            'chant' => Data::where('user_id', $user->id)->where('channel', 'year')->where('type', 'chant')->whereYear('created_at', now()->year)->first(),
            'write' => Data::where('user_id', $user->id)->where('channel', 'year')->where('type', 'write')->whereYear('created_at', now()->year)->first(),
        ];

        $all = [
            'chant' => Data::where('user_id', $user->id)->where('channel', 'all')->where('type', 'chant')->first(),
            'write' => Data::where('user_id', $user->id)->where('channel', 'all')->where('type', 'write')->first(),
        ];

        $desires = Data::where('user_id', $user->id)->where('channel', 'desires')->get();
        return view('mydata.index', compact('user', 'year', 'all', 'desires'));
    }

    public function year(Request $request)
    {
        $user = Auth::user();
        $type = $request->type;

        switch ($type) {
            case 'chant':
                $placeholder = '请输入年度诵经数';
                break;
            case 'write':
                $placeholder = '请输入年度抄经数';
                break;
        }

        if ($request->isMethod('post')) {
            // if (!is_numeric($request->number)) {
            //     return $this->error($placeholder);
            // }

            $validator = Validator::make($request->all(), [
                'number' => 'required|numeric',
            ], [
                'number.numeric'  => '请输入数字',
                'number.required' => $placeholder,
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first(), '', '');
            }

            $info = Data::where('type', $request->type)->where('user_id', $user->id)->where('channel', 'year')->whereYear('created_at', now()->year)->first();
            if ($info) {
                $info->number   = $request->number;
                $info->dated_at = now();
                $res            = $info->save();
            } else {
                $data = [
                    'user_id'  => $user->id,
                    'type'     => $request->type,
                    'number'   => $request->number,
                    'channel'  => 'year',
                    'dated_at' => now(),
                ];
                $res = Data::create($data);

            }

            if ($res) {
                return $this->success('提交成功', route('mydata.index'));
            } else {
                return $this->error('提交失败');
            }

        } else {

            return view('mydata.year', compact('type', 'placeholder', 'user'));
        }

    }

    //修改
    public function yeardo(Request $request, Data $data)
    {
        $user = Auth::user();
        $type = $data->type;

        switch ($type) {
            case 'chant':
                $placeholder = '请输入年度诵经数';
                break;
            case 'write':
                $placeholder = '请输入年度抄经数';
                break;
        }

        if ($request->isMethod('post')) {
            // if (!is_numeric($request->number)) {
            //     return $this->error($placeholder);
            // }
            $validator = Validator::make($request->all(), [
                'number' => 'required|numeric',
            ], [
                'number.numeric'  => '请输入数字',
                'number.required' => $placeholder,
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first(), '', '');
            }

            if ($data->update($request->all())) {
                return $this->success('提交成功', route('mydata.index'));
            } else {
                return $this->error('提交失败');
            }
        } else {

            return view('mydata.yeardo', compact('type', 'placeholder', 'user', 'data'));
        }

    }

    public function all(Request $request)
    {
        $user = Auth::user();
        $type = $request->type;

        switch ($type) {
            case 'chant':
                $placeholder = '请输入迄今为止诵经数';
                break;
            case 'write':
                $placeholder = '请输入迄今为止抄经数';
                break;
        }

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'number' => 'required|numeric',
            ], [
                'number.numeric'  => '请输入数字',
                'number.required' => $placeholder,
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first(), '', '');
            }

            $info = Data::where('type', $request->type)->where('user_id', $user->id)->where('channel', 'all')->first();
            if ($info) {
                $info->number   = $request->number;
                $info->dated_at = now();
                $res            = $info->save();
            } else {
                $data = [
                    'user_id'  => $user->id,
                    'type'     => $request->type,
                    'number'   => $request->number,
                    'channel'  => 'all',
                    'dated_at' => now(),
                ];
                $res = Data::create($data);
            }

            if ($res) {
                return $this->success('提交成功', route('mydata.index'));
            } else {
                return $this->error('提交失败');
            }
        } else {

            return view('mydata.all', compact('type', 'placeholder', 'user'));
        }

    }

    //发愿
    public function desires(Request $request)
    {
        $user     = Auth::user();
        $type     = $request->type;
        $dated_at = $request->dated_at;

        if ($request->isMethod('post')) {
            $name = [
                'chant' => '诵经',
                'write' => '抄经',
            ];
            $request->validate([
                'type'     => 'required',
                'number'   => 'required|numeric|min:1',
                'dated_at' => 'required|numeric',
            ], [
                'type.required'     => '请选择类型',
                'number.required'   => '发愿数必填',
                'number.numeric'    => '发愿数必须是数字',
                'number.min'        => '发愿数最少是:min',
                'dated_at.required' => '发愿年份必须填写',
                'dated_at.numeric'  => '发愿年份必须是数字',
            ]);

            if ($request->dated_at < date('Y', time())) {
                return $this->error('发愿年份不对');
            }

            $find = Data::where('user_id', $user->id)->whereYear('dated_at', $dated_at)->where('channel', 'desires')->where('type', $type)->first();

            if ($find) {
                return $this->error('您已经提交了' . $request->dated_at . '年' . $name[$type] . '数据');
            }

            $data = [
                'user_id'  => $user->id,
                'type'     => $request->type,
                'number'   => $request->number,
                'channel'  => 'desires',
                'dated_at' => $request->dated_at . '-' . date('m-d H:i:s', time()),
            ];

            if (Data::create($data)) {
                return $this->success('提交成功', route('mydata.index'));
            } else {
                return $this->error('提交失败');
            }
        } else {

            return view('mydata.desires');
        }
    }

    //修改发愿
    public function desiresdo(Request $request, Data $data)
    {

        $user = Auth::user();
        $type = $data->type;

        if ($request->isMethod('post')) {
            $request->validate([
                'type'     => 'required',
                'number'   => 'required|numeric|min:1',
                'dated_at' => 'required|numeric',
            ], [
                'type.required'     => '请选择类型',
                'number.required'   => '发愿数必填',
                'number.numeric'    => '发愿数必须是数字',
                'number.min'        => '发愿数最少是:min',
                'dated_at.required' => '发愿年份必须填写',
                'dated_at.numeric'  => '发愿年份必须是数字',
            ]);

            $request->offsetSet('dated_at', $request->dated_at . '-' . date('m-d H:i:s', time()));
            if ($data->update($request->all())) {
                return $this->success('提交成功', route('mydata.index'));
            } else {
                return $this->error('提交失败');
            }
        } else {

            return view('mydata.desiresdo', compact('data'));
        }

    }

}
