@extends('RuLong::layouts.app')

@section('title', 'actives - users')

@section('content')
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-8 m-b">
                <a class="btn btn-sm btn-primary" href="{{ route('Admin.actives.index') }}">
                    <i class="fa fa-level-up"></i>
                    返回
                </a>
            </div>
            <div class="col-sm-4 m-b">
                <form action="{{ url()->current() }}" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <input type="text" placeholder="请输入用户姓名" name="keyword" class="input-sm form-control" value="{{ Request::get('keyword') }}">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="80">序号</th>
                        <th width="250">所属用户姓名</th>
                        <th width="250">报名人姓名</th>
                        <th width="150">报名人联系方式</th>
                        <th width="250">报名人行业</th>
                        <th width="120">报名时间</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->user->info->nickname }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->contact }}</td>
                        <td>{{ $user->category->name }}</td>
                        <td>{{ $user->created_at->toDateTimeString() }}</td>
                        <td>
                            @if($active->start_date->timestamp < time() && $active->finish_date->timestamp > time())
                            @if($user->signed == 1)
                            已签到
                            @else
                            <a class="ajax-get" href="{{ route('Admin.actives.userSign', $user) }}">签到</a>
                            @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-right">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
