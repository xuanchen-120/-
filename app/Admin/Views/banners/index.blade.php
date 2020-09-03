@extends('RuLong::layouts.app')

@section('title', 'banners - index')

@section('content')
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-8 m-b">
                <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="420" href="{{ route('Admin.banners.create') }}">
                    <i class="fa fa-plus"></i>
                    新增节点
                </a>
            </div>
            <div class="col-sm-4 m-b">
                <form action="{{ url()->current() }}" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <input type="text" placeholder="请输入节点名称" name="keyword" class="input-sm form-control" value="{{ Request::get('keyword') }}">
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
                        <th width="100">调用标签</th>
                        <th width="100">节点名称</th>
                        <th>描述</th>
                        <th width="100">Banner条数</th>
                        <th width="140">创建时间</th>
                        <th width="140">更新时间</th>
                        <td width="80">操作</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($positions as $banner)
                    <tr class="edit">
                        <td>{{ $banner->tag }}</td>
                        <td>{{ $banner->name }}</td>
                        <td>{{ $banner->description }}</td>
                        <td><a href="{{ route('Admin.banners.show', $banner) }}">{{ $banner->banners_count }}</a></td>
                        <td>{{ $banner->created_at }}</td>
                        <td>{{ $banner->updated_at }}</td>
                        <td>
                            <a data-toggle="layer" data-height="350" href="{{ route('Admin.banners.edit', $banner) }}">编辑</a>
                            <form action="{{ route('Admin.banners.destroy', $banner) }}" method="POST" style="display:inline">
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
            {{ $positions->links() }}
        </div>
    </div>
</div>
@endsection
