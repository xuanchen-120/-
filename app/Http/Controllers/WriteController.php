<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Write;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Validator;

class WriteController extends Controller
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
        View::share('nav', 2);
    }

    public function index(Request $request)
    {
        $writes = Write::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(15);
        $user   = Auth::user();

        $data = [
            'all_write'  => Data::where('user_id', $user->id)->where('channel', 'all')->where('type', 'write')->sum('number') ?? 0,
            'year_write' => Data::where('user_id', $user->id)->where('channel', 'year')->where('type', 'write')->whereYear('created_at', date('Y', time()))->sum('number') ?? 0,
        ];

        $write_data = [
            'today' => Write::where('user_id', $user->id)->whereDate('created_at', date('Y-m-d', time()))->sum('number'),
            'month' => Write::where('user_id', $user->id)->where('created_at', 'like', date('Y-m', time()) . "%")->sum('number'),
            'year'  => Write::where('user_id', $user->id)->whereYear('created_at', date('Y', time()))->sum('number'),
            'all'   => Write::where('user_id', $user->id)->sum('number'),
        ];
        $desires = Data::where('user_id', $user->id)->where('channel', 'desires')->where('type', 'write')->get();

        return view('write.index', compact('writes', 'user', 'write_data', 'data', 'desires'));
    }

    //分页加载更多诵经数据
    public function more(Request $request)
    {
        $writes = Write::where('user_id', Auth::id())->paginate(15);

        if ($writes->count() > 0) {
            $html = response(view('write.list', compact('writes')))->getContent();
            return $this->success($html);
        } else {
            return $this->error('已经到最后一页');
        }
    }

    public function report()
    {
        return view('write.report');
    }

    public function reportdo(Request $request)
    {
        $user      = Auth::user();
        $validator = Validator::make($request->all(), [
            'number'     => 'required|numeric',
            'created_at' => 'required|date|before:tomorrow',
        ], [
            'number.required'     => '请输入抄经次数',
            'number.numeric'      => '请输入数字',
            'created_at.required' => '请输入日期',
            'created_at.date'     => '日期不正确',
            'created_at.before'   => '日期不正确',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), '', '');
        }

        $find = $user->write()->whereDate('created_at', '=', $request->created_at)->count();
        if ($find) {
            return $this->error('一天只能提交一次');
        }
        if ($user->write()->create($request->all())) {
            return $this->success('提交成功', route('write.index'));
        } else {
            return $this->error('提交失败');

        }
    }

    public function edit(Request $request, Write $write)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'number' => 'required|numeric',
            ], [
                'number.required' => '请输入诵经次数',
                'number.numeric'  => '请输入数字',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first(), '', '');
            }
            if ($write->update($request->all())) {
                return $this->success('提交成功', route('write.index'));
            } else {
                return $this->error();
            }
        } else {
            return view('write.edit', compact('write'));
        }
    }

    /**
     * 删除记录
     * @author 玄尘 2020-05-28
     * @param  Write  $write [description]
     * @return [type]        [description]
     */
    public function delete(Write $write)
    {
        if ($write->delete()) {
            return $this->success('删除成功', url()->previous());
        } else {
            return $this->error('删除失败');
        }
    }

}
