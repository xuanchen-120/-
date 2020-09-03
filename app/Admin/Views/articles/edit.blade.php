@extends('RuLong::layouts.app')

@section('title', 'articles - edit')

@section('content')
<div class="row">
    <form method="post" action="{{ route('Admin.articles.update', $article) }}" class="form-horizontal">
        <div class="col-sm-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑文章内容</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">内容标题</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" value="{{ $article->title }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">文章正文</label>
                        <div class="col-sm-10">
                            @include('Admin::common.ueditor', ['content' => $article->content])
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            @csrf
                            @method('put')
                            <button class="btn btn-primary ajax-post" type="submit">保存内容</button>
                            <a class="btn btn-white" href="javascript:history.go(-1)" title="返回">返回</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>附加属性</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">分类</label>
                        <div class="col-xs-8">
                            <select class="form-control" name="category_id">
                                @foreach ($category_list as $key=> $value)
                                <option value="{{ $value['id'] }}" @if ($value['id'] == $article->category_id) selected @endif >{!! $value['title_show'] !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">内容简介</label>
                        <div class="col-sm-9">
                            <textarea name="description" rows="4" class="form-control">{{ $article->description }}</textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">封面图片</label>
                        <div class="col-sm-9">
                            @include('Admin::common.webuploader', ['storage' => $article->storage])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
