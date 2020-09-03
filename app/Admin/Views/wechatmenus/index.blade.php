@extends('RuLong::layouts.app')

@section('title', 'menus - index')

@section('content')
<div class="row">
    <div class="col-sm-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>菜单树形图</h5>
                <div class="ibox-tools">
                    <a class="btn btn-primary btn-xs ajax-get" href="{{ route('Admin.wechatmenus.sync') }}">同步菜单</a>
                    <a class="btn btn-primary btn-xs ajax-get" href="{{ route('Admin.wechatmenus.publish') }}">发布到微信</a>
                </div>
            </div>
            <div class="ibox-content">
                <div id="tree"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12 m-b" style="display:flex">
                        <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="560" href="{{ route('Admin.wechatmenus.create') }}">
                            <i class="fa fa-plus"></i> 创建菜单
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">序号</th>
                                <th>内容标题</th>
                                <th width="100">按钮类型</th>
                                <th width="140">创建时间</th>
                                <th width="140">更新时间</th>
                                <th width="80"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $menu)
                            <tr>
                                <td>{{ $menu->id }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->type }}</td>
                                <td>{{ $menu->created_at }}</td>
                                <td>{{ $menu->updated_at }}</td>
                                <td>
                                    <a data-toggle="layer" data-height="560" href="{{ route('Admin.wechatmenus.edit', $menu) }}">编辑</a>
                                    <form action="{{ route('Admin.wechatmenus.destroy', $menu) }}" method="POST" style="display:inline">
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
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ admin_assets('js/plugins/treeview/bootstrap-treeview.js') }}"></script>
<script src="{{ admin_assets('js/vue.min.js') }}"></script>
<script type="text/javascript">
    $('#tree').treeview({data: {!! $menus !!}});

    $('#tree').on('nodeSelected', function(event, data) {
        console.log(data)
    });
</script>
@endpush
