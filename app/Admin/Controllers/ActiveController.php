<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\ActiveRequest;
use App\Models\Active;
use App\Models\ActiveUser;
use App\Models\Area;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActiveController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $actives = Active::when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->orderBy('id', 'desc')->paginate();
        return view('Admin::actives.index', compact('actives'));
    }

    public function create()
    {
        $areas = Area::where(['psn' => 0, 'type' => '省级'])->get();
        $clubs = Club::orderBy('id', 'asc')->get();

        return view('Admin::actives.create', compact('areas', 'clubs'));
    }

    public function store(ActiveRequest $request)
    {
        $data   = $request->all();
        $result = Active::create($data);
        if ($result) {
            return $this->success('添加成功', route('Admin.actives.index'));
        } else {
            return $this->error();
        }
    }

    public function edit(Active $active)
    {
        $areas     = Area::where(['psn' => 0, 'type' => '省级'])->get();
        $cities    = Area::where('psn', $active->province)->get();
        $districts = Area::where('psn', $active->city)->get();
        $clubs     = Club::orderBy('id', 'asc')->get();

        return view('Admin::actives.edit', compact('active', 'areas', 'cities', 'districts', 'clubs'));
    }

    public function update(ActiveRequest $request, Active $active)
    {
        $data = $request->all();
        if ($active->update($data)) {
            return $this->success('更新成功', route('Admin.actives.index'));
        } else {
            return $this->error();
        }
    }

    public function destroy(Active $active)
    {
        try {
            DB::transaction(function () use ($active) {
                $active->delete();
            });
            return $this->success('操作成功');
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function users(Request $request, Active $active)
    {
        $name = $request->keyword;

        $users = $active->users()
            ->when($name, function ($query) use ($name) {
                $query->where('name', 'like', "%{$name}%");
            })
            ->paginate(15);

        return view('Admin::actives.users', compact('active', 'users'));
    }

    public function userSign(ActiveUser $user)
    {
        $user->signed = 1;
        if ($user->save()) {
            return $this->success('操作成功');
        } else {
            return $this->error();
        }
    }
}
