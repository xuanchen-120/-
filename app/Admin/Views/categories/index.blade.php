@extends('RuLong::layouts.app')

@section('title', 'categories - index')

@section('content')
<div class="row">
    <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>分类地图</h5>
            </div>
            <div class="ibox-content">
                <div id="tree"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-6 m-b">
                        @if (Request::get('parent_id') != 0)
                        <a class="btn btn-sm btn-white" href="{{ route('Admin.categories.index') }}"><i class="fa fa-angle-left"></i> 返回</a>
                        @endif
                        <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="420" href="{{ route('Admin.categories.create') }}">
                            <i class="fa fa-plus"></i>
                            新增分类
                        </a>
                    </div>
                    <div class="col-sm-6 m-b">
                        <form action="{{ url()->current() }}" class="form-inline pull-right" method="get" accept-charset="utf-8">
                            <select class="input-sm form-control" style="width:150px;margin-right: 2px" name="type">
                                <option value="">分类模型</option>
                                @foreach (config('catetype') as $key => $model)
                                <option value="{{ $key }}" @if ($key == Request::get('type')) selected @endif >{{ $model }}</option>
                                @endforeach
                            </select>
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
                                <th width="50">序号</th>
                                <th width="150">分类名称</th>
                                <th width="100">分类类别</th>
                                <th></th>
                                <th width="50">排序</th>
                                <th width="140">创建时间</th>
                                <th width="140">更新时间</th>
                                <th width="80"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('Admin.categories.index', ['parent_id' => $category->id]) }}">{{ $category->name }}</a></td>
                                <td>{{ $category->type_text }}</td>
                                <td></td>
                                <td>{{ $category->sort }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td>
                                    <a data-toggle="layer" data-height="420" href="{{ route('Admin.categories.edit', $category) }}">编辑</a>
                                    <form action="{{ route('Admin.categories.destroy', $category) }}" method="POST" style="display:inline">
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
                {{ $categories->appends(['parent_id' => Request::get('parent_id'), 'type' => Request::get('type'), 'keyword' => Request::get('keyword')])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ admin_assets('js/plugins/treeview/bootstrap-treeview.js') }}"></script>
<script type="text/javascript">
    $('#tree').treeview({data: {!! $categoriesJson !!}});
</script>
@endpush
