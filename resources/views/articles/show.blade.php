@extends('layouts.app')

@section('content')
<section class="padding_btm" >
    <!-- banner  Start -->
    <div class="swiper-container banner_home">
        <div class="swiper-wrapper banner-img">
            <a class="swiper-slide" href="javascript:void(0)">
                <div class="carousel-block img-bg">
                    <span style="background-image:url({{ $article->storage->path  }})"></span>
                </div>
            </a>
        </div>
        <div class="banner-page"></div>
    </div>
    <!-- banner End -->
    <!-- 课程信息  Start -->
    <div class="lesson_name">
        {{ $article->title }}
    </div>
    <!-- 图文介绍  Start -->
    <div class="shop_title">
        <img src="/assets/home/img/shop005.jpg" class="shop_title_icon">详情
    </div>
    <div class="lesson_introduce">
        {!! $article->content !!}
    </div>
    <!-- 图文介绍 End -->

</section>
<!-- 底部  Start -->
@endsection

@section('css')
<link rel="stylesheet" href="/assets/home/css/swiper.min.css">
@endsection
@section('js')
<script src="/assets/home/js/swiper.min.js" type="text/javascript" ></script>
@endsection

@section('script')
<script type="text/javascript">
    /*轮播*/
    var banner = new Swiper('.banner_home', {
        pagination: '.banner-page',
        paginationClickable: true,
        loop:true,
        autoplay:4000
    });
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true
    });

    /*显示微信二维码*/
    $(".shop_contact_wechet").click(function (e) {
        $(".shop_wechet_show").show();
    });
    $(".shop_wechet_close").click(function (e) {
        $(".shop_wechet_show").hide();
    });
</script>
@endsection
