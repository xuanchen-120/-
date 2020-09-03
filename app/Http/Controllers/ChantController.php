<?php

namespace App\Http\Controllers;

use App\Models\Chant;
use App\Models\Data;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Validator;

class ChantController extends Controller
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
        View::share('nav', 2);
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $chant_data = [
            'today' => Chant::where('user_id', $user->id)->whereDate('created_at', date('Y-m-d', time()))->sum('number') ?? 0,
            'month' => Chant::where('user_id', $user->id)->where('created_at', 'like', date('Y-m', time()) . "%")->sum('number') ?? 0,
            'year'  => Chant::where('user_id', $user->id)->whereYear('created_at', date('Y', time()))->sum('number') ?? 0,
            'all'   => Chant::where('user_id', $user->id)->sum('number') ?? 0,
        ];

        $data = [
            'all_chant'  => Data::where('user_id', $user->id)->where('channel', 'all')->where('type', 'chant')->sum('number') ?? 0,
            'year_chant' => Data::where('user_id', $user->id)->where('channel', 'year')->where('type', 'chant')->whereYear('created_at', date('Y', time()))->sum('number') ?? 0,
        ];

        $chants  = Chant::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
        $desires = Data::where('user_id', $user->id)->where('channel', 'desires')->where('type', 'chant')->get();
        return view('chant.index', compact('chants', 'user', 'chant_data', 'data', 'desires'));
    }

    //分页加载更多诵经数据
    public function more(Request $request)
    {

        $chants = Chant::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(15);

        if ($chants->count() > 0) {
            $html = response(view('chant.list', compact('chants')))->getContent();
            return $this->success($html);
        } else {
            return $this->error('已经到最后一页');
        }
    }

    public function report()
    {
        return view('chant.report');
    }

    public function reportdo(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'number'     => 'required|numeric',
            'created_at' => 'required|date|before:tomorrow',
        ], [
            'number.required'     => '请输入诵经次数',
            'number.numeric'      => '请输入数字',
            'created_at.required' => '请输入日期',
            'created_at.date'     => '日期不正确',
            'created_at.before'   => '日期不正确',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), '', '');
        }

        $find = $user->chant()->whereDate('created_at', '=', $request->created_at)->count();
        if ($find) {
            return $this->error('一天只能提交一次');
        }
        if ($user->chant()->create($request->all())) {
            return $this->success('提交成功', route('chant.index'));
        } else {
            return $this->error('提交失败');

        }
    }

    public function edit(Request $request, Chant $chant)
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
            if ($chant->update($request->all())) {
                return $this->success('提交成功', route('chant.index'));
            } else {
                return $this->error();
            }
        } else {
            return view('chant.edit', compact('chant'));
        }
    }

    /**
     * 删除记录
     * @author 玄尘 2020-05-28
     * @param  Chant  $chant [description]
     * @return [type]        [description]
     */
    public function delete(Chant $chant)
    {
        if ($chant->delete()) {
            return $this->success('删除成功', url()->previous());
        } else {
            return $this->error('删除失败');
        }
    }

}
