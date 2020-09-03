<?php

namespace App\Admin\Controllers;

use App\Models\Write;
use Illuminate\Http\Request;

class WriteController extends Controller
{
    public function index(Request $request)
    {
        $nickname = $request->nickname;
        $start    = $request->start;
        $end      = $request->end;

        $writes = Write::with('user.info')
            ->when($nickname, function ($query) use ($nickname) {
                $query->whereHas('user.info', function ($query) use ($nickname) {
                    $query->where('nickname', 'like', "%{$nickname}%");
                });
            })
            ->when($start && $end, function ($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end]);
            })
            ->when($start && !$end, function ($query) use ($start) {
                $query->where('created_at', '>=', $start);
            })
            ->when((!$start && $end), function ($query) use ($end) {
                $query->where('created_at', '<=', $end);
            })
            ->orderBy('id', 'desc')->paginate(15);

        $allsum = Write::with('user.info')
            ->when($nickname, function ($query) use ($nickname) {
                $query->whereHas('user.info', function ($query) use ($nickname) {
                    $query->where('nickname', 'like', "%{$nickname}%");
                });
            })
            ->when($start && $end, function ($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end]);
            })
            ->when($start && !$end, function ($query) use ($start) {
                $query->where('created_at', '>=', $start);
            })
            ->when((!$start && $end), function ($query) use ($end) {
                $query->where('created_at', '<=', $end);
            })
            ->sum('number');

        return view('Admin::write.index', compact('writes', 'allsum'));
    }

}
