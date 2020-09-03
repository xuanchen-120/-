@extends('RuLong::layouts.app')

@section('title', 'actives - index')

@section('content')
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-8 m-b">
                <a class="btn btn-sm btn-primary" href="{{ route('Admin.actives.create') }}">
                    <i class="fa fa-plus"></i>
                    新增活动
                </a>
            </div>
            <div class="col-sm-4 m-b">
                <form action="{{ url()->current() }}" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <input type="text" placeholder="请输入关键词" name="keyword" class="input-sm form-control" value="{{ Request::get('keyword') }}">
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
                        <th width="250">活动名称</th>
                        <th width="80">活动类型</th>
                        <th width="80">活动人数</th>
                        <th width="300">活动时间</th>
                        <th width="120">创建时间</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actives as $active)
                    <tr>
                        <td>{{ $active->id }}</td>
                        <td>{{ $active->name }}</td>
                        <td>@if($active->is_fee == 1) 收费活动 @else 免费活动 @endif</td>
                        <td>{{ $active->limits ?? '无限制' }}/<a href="{{ route('Admin.actives.users', $active) }}">{{ $active->users->count() }}</a></td>
                        <td>{{ $active->start_date->toDateTimeString() }} 至 {{ $active->finish_date->toDateTimeString() }}</td>
                        <td>{{ $active->created_at }}</td>
                        <td>
                            {{-- <a href="{{ route('Admin.actives.users', $active) }}">报名{{ $active->joins()->count() }}</a> --}}
                            <a href="{{ route('Admin.actives.edit', $active) }}">编辑</a>
                            <form action="{{ route('Admin.actives.destroy', $active) }}" method="POST" style="display:inline">
                                <a href="javascript:void(0);" class="ajax-post confirm">
                                    删除
                                </a>
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-right">
            {{ $actives->links() }}
        </div>
    </div>
</div>
@endsection
