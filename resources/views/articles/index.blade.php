@extends('layouts.app')

@section('title', '感应文章')

@section('css')
<style type="text/css" media="screen">
body {
    background: #fff;
}
</style>
@endsection


@section('content')
<div class="content">
    @if($articles->toArray())
    <ul class="usersList">
        @foreach($articles as $article)
        <li data-href="{{ route('articles.show', $article) }}">
            <div class="usersListImg chancesListImg usersMember">
                <img src="{{ $article->storage->path ?? '' }}"/>
            </div>
            <div class="usersListText projectListText">
                <div class="ce-nowrap usersListText-name">
                    {{ $article->title }}
                </div>
                <div class="chancesText">
                    <p>
                        <i class="icon icon-eye-open"></i>
                        <span>{{ $article->click }}</span>
                    </p>
                    <p>
                        <i class="icon icon-time"></i>
                        <span>{{ $article->created_at->toDateString() }}</span>
                    </p>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    @else
    <div>
        <div class="mychancesTips">
            <img src="{{ asset('assets/home/img/Tips.jpg') }}">
        </div>
        <div class="mychancesCont">
            <span>还没有文章哟！</span>
        </div>
    </div>
    @endif
</div>
@endsection
