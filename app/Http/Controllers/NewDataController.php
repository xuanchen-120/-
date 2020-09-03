<?php

namespace App\Http\Controllers;

use App\Models\Chant;
use App\Models\Data;
use App\Models\User;
use App\Models\Write;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class NewDataController extends Controller
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
        $this->todayTime = [Carbon::today()->toDateTimeString(), Carbon::today()->addSecond(86399)->toDateTimeString()];
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $category = $request->input('category', 'chant');
        $type     = $request->input('type', 'day');
        $datetime = $request->input('datetime', '');
        $dateDef  = [
            'day'   => date('Y-m-d', time()),
            'month' => date('Y-m', time()),
            'year'  => date('Y-m-d', time()),
            'all'   => date('Y-m-d', time()),
        ];

        if (!$datetime) {
            $datetime = $dateDef[$type];
        }

        if ($category == 'chant') {
            $modelName = 'Chant';
            $model     = new Chant();
        } else {
            $modelName = 'Write';
            $model     = new Write();

        }

        $lists = User::query()
            ->withCount([$modelName . ' as count' => function ($query) use ($datetime, $type, $user, $category) {
                switch ($type) {
                    case 'day':
                    case 'month':
                        $query->select(DB::raw("sum(number) as chantsum"))->where('created_at', 'like', "{$datetime}%");
                        break;
                    case 'year':
                        $query->select(DB::raw("sum(number) as chantsum"))->whereYear('created_at', date('Y', time()));
                        break;

                    default:
                        $query->select(DB::raw("sum(number) as chantsum"));
                        break;
                }
            }])
            ->get();

        if ($type == 'all') {
            $lists = $lists->map(function ($user) use ($type, $category) {
                $number = Data::where('user_id', $user->id)->where('channel', $type)->where('type', $category)->sum('number') ?? 0;
                $user->count += $number;
                return $user;
            });
        }

        $lists   = $lists->sortByDesc('count')->where('count', '>', 0);
        $sum     = $lists->sum('count');
        $count   = $lists->count();
        $average = $lists->avg('count');
        $ranking = $lists->pluck('username')->search($user->username);
        $ranking = $ranking ? $ranking + 1 : 0;
        $lists   = $lists->take(10);

        return view('data.index', compact('category', 'type', 'average', 'sum', 'lists', 'datetime', 'ranking', 'count'));

    }

    public function my()
    {
        $user = Auth::user();

        view()->share('nav', 2);
        $chants = [
            'today' => Chant::where('user_id', $user->id)->whereDate('created_at', date('Y-m-d', time()))->sum('number'),
            'month' => Chant::where('user_id', $user->id)->where('created_at', 'like', date('Y-m', time()) . "%")->sum('number'),
            'year'  => Chant::where('user_id', $user->id)->whereYear('created_at', date('Y', time()))->sum('number'),
            'all'   => Chant::where('user_id', $user->id)->sum('number'),
        ];

        $data = [
            'all_chant'  => Data::where('user_id', $user->id)->where('channel', 'all')->where('type', 'chant')->sum('number') ?? 0,
            'all_write'  => Data::where('user_id', $user->id)->where('channel', 'all')->where('type', 'write')->sum('number') ?? 0,
            'year_chant' => Data::where('user_id', $user->id)->where('channel', 'year')->where('type', 'chant')->whereYear('created_at', date('Y', time()))->sum('number') ?? 0,
            'year_write' => Data::where('user_id', $user->id)->where('channel', 'year')->where('type', 'write')->whereYear('created_at', date('Y', time()))->sum('number') ?? 0,
        ];

        $writes = [
            'today' => Write::where('user_id', $user->id)->whereDate('created_at', date('Y-m-d', time()))->sum('number'),
            'month' => Write::where('user_id', $user->id)->where('created_at', 'like', date('Y-m', time()) . "%")->sum('number'),
            'year'  => Write::where('user_id', $user->id)->whereYear('created_at', date('Y', time()))->sum('number'),
            'all'   => Write::where('user_id', $user->id)->sum('number'),
        ];

        return view('data.my', compact('chants', 'data', 'writes'));
    }

    public function chants()
    {
        $user = Auth::user();

        $days = Chant::select(DB::raw('sum(number) as count,user_id'))
            ->groupBy('user_id')
            ->orderBy('count', 'desc')
            ->get();

        $top = $days->search(function ($item, $key) use ($user) {
            return $item->user_id == $user->id;
        });
        return view('data.chants', compact('days', 'top'));
    }

    public function writes()
    {
        # code...
        return view('data.writes', compact('chants', 'data', 'writes'));
    }

}
