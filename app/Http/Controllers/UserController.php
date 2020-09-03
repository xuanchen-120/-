<?php
namespace App\Http\Controllers;

use App\Models\Data;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
        view()->share('nav', 1);

    }

    public function index()
    {
        $user          = Auth::user();
        $chant_desires = Data::where('user_id', $user->id)->where('channel', 'desires')->where('type', 'chant')->whereYear('dated_at', date('Y', time()))->value('number') ?? 0;
        $write_desires = Data::where('user_id', $user->id)->where('channel', 'desires')->where('type', 'write')->whereYear('dated_at', date('Y', time()))->value('number') ?? 0;

        $data = [
            'year_write' => Data::where('user_id', $user->id)->where('channel', 'year')->where('type', 'write')->sum('number') ?? 0,
            'year_chant' => Data::where('user_id', $user->id)->where('channel', 'year')->where('type', 'chant')->sum('number') ?? 0,
        ];
        return view('user.index', compact('user', 'chant_desires', 'write_desires', 'data'));
    }

    //收益规则
    public function rules()
    {
        return view('user.rules');
    }

    //联盟合作
    public function alliance(Request $request)
    {
        return view('user.alliance');
    }

    //0元代理
    public function agency(Request $request)
    {
        return view('user.agency');
    }

}
