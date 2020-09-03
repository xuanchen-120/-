@extends('RuLong::layouts.app')

@section('title', 'users - index')

@section('content')
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-8 m-b">
                <form action="{{ url()->current() }}" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <input type="text" placeholder="请输入手机号" name="mobile" class="input-sm form-control" value="{{ Request::get('mobile') }}" />
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="请输入用户昵称" name="nickname" class="input-sm form-control" value="{{ Request::get('nickname') }}" />
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
                        <th width="45">编号</th>
                        <th width="250">手机号</th>
                        <th width="250">法名</th>
                        <th width="250">发愿数</th>
                        <th width="250">诵经总数</th>
                        <th width="250">抄经总数</th>
                        <th width="140">创建时间</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td style="padding:0">{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->info->nickname ?? '' }}</td>
                        <td>
                            @foreach ($user->data as $data)
                            @if ($data['channel']=='desires')
                                {{ $data->dated_at->format('Y-m-d') }} {{ $data->channel_name }}{{ $data->name }}:{{ $data->number }}<br>
                            @endif
                            @endforeach

                        </td>
                        <td>{{ $user->chant()->sum('number') }} </td>
                        <td>{{ $user->write()->sum('number') }} </td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a title="编辑用户" data-toggle="layer" target="dialog" data-height="500"  data-width="500"   href="{{ route('Admin.users.edit', $user) }}" rel="dialog{{ time() }}" class="btnEdit">编辑</a>
                            <form action="{{ route('Admin.users.destroy', $user) }}" method="POST" style="display:inline">
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
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
