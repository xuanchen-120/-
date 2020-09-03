<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct(Request $request)
    {
    }

    public function index(Request $request)
    {
        $type       = 'month';
        $category   = 'chant';
        $datetime   = '2020-01';
        $user       = User::find(2030);
        $data_month = session('data_month');
        $data_year  = session('data_year');

        // $user_month = $user->getData($type, $category, $datetime);
        // $type       = 'year';
        // $user_year  = $user->getData($type, $category, $datetime);
        // dump($user_month);
        // dump($user_year);
        // dump('-------');
        // dd($data_month, $data_year);
        // dd();
        echo '------------';
        $data_month_val = $data_year_val = [];
        foreach ($data_month as $key => $value) {
            $data_month_val[$value['id']] = $value['count'];
        }

        foreach ($data_year as $key => $value) {
            $data_year_val[$value['id']] = $value['count'];
        }
        $diff_val = [];
        foreach ($data_month_val as $key => $value) {
            if ($data_month_val[$key] != $data_year_val[$key]) {
                $diff['month'][$key] = $value;
                $diff['year'][$key]  = $data_year_val[$key] ?? '--';
            }
        }
        dump(array_diff($data_month_val, $data_year_val));
        dump($diff);
        dump($data_month_val);
        dump($data_year_val);
        dd();

        $user_month = $user->getData($type, $category, $datetime);
        $type       = 'year';
        $user_year  = $user->getData($type, $category, $datetime);
        dump($user_month);
        dump($user_year);
        dump('-------');
        dd($data_month, $data_year);

        $diff = $data_month->diff($data_year->toArray());
        dump(array_diff($data_month->toArray(), $data_year->toArray()));
        $m = [];
        foreach ($data_month as $key => $value) {
            if ($data_month[$key] != $data_year[$key]) {
                $m[] = [
                    'data_month' . $key => $data_month[$key],
                    'data_year' . $key  => $data_year[$key] ?? '--',
                ];
            }
        }
        dd($m);
        $lists = User::whereDoesntHave('info')->get();
        dd($lists);
        $user           = User::find(3);
        $user->password = '111111';
        $user->save();

    }

}
