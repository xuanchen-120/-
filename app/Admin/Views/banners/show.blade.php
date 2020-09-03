@extends('RuLong::layouts.app')

@section('title', 'banners - show')

@section('content')
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-8 m-b">
                <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="420" href="{{ route('Admin.banners.nodeCreate', $position) }}">
                    <i class="fa fa-plus"></i>
                    新增轮播
                </a>
            </div>
            <div class="col-sm-4 m-b">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="200">MorphTo</th>
                        <th width="100">类型</th>
                        <th>显示名称</th>
                        <th width="140">创建时间</th>
                        <th width="140">更新时间</th>
                        <th width="80">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                    <tr class="edit">
                        <td>{{ $banner->showable_type }}::{{ $banner->showable_id }}</td>
                        <td>{{ $banner->type }}</td>
                        <td>{{ $banner->showable->name ?? $banner->showable->title }}</td>
                        <td>{{ $banner->created_at }}</td>
                        <td>{{ $banner->updated_at }}</td>
                        <td>
                            <form action="{{ route('Admin.banners.nodeDelete', $banner) }}" method="POST" style="display:inline">
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
            {{ $banners->links() }}
        </div>
    </div>
</div>
@endsection
