@extends('RuLong::layouts.app')

@section('title', 'articles - index')

@section('content')
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-4 m-b">
                <a class="btn btn-sm btn-primary" href="{{ route('Admin.articles.create') }}">
                    <i class="fa fa-plus"></i>
                    新增内容
                </a>
            </div>
            <div class="col-sm-8 m-b">
                <form action="{{ url()->current() }}" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <input type="text" style="width:250px;" placeholder="请输入内容标题" name="title" class="input-sm form-control" value="{{ Request::get('title') }}">
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
                        <th>内容标题</th>
                        <th width="50">点击</th>
                        <th width="140">创建时间</th>
                        <th width="140">更新时间</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->click }}</td>
                        <td>{{ $article->created_at }}</td>
                        <td>{{ $article->updated_at }}</td>
                        <td>
                            <a href="{{ route('Admin.articles.edit', $article) }}">编辑</a>
                            <form action="{{ route('Admin.articles.destroy', $article) }}" method="POST" style="display:inline">
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
            {{ $articles->appends(['keyword'=>Request::get('keyword')])->links() }}
        </div>
    </div>
</div>
@endsection
