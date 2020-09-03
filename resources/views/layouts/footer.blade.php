<footer class="row baby_footer">
    <div class="@if( ($nav??'1') ==1) footer-current @endif cell" data-href="{{ route('user.index') }}">
        <div class="footer-i"><i class="icon-home"></i></div>
        <div class="footer-name">个人中心</div>
    </div>

    <!-- <div class="@if( ($nav??'1') ==2) footer-current @endif cell" data-href="{{ route('chant.index') }}">
        <div class="footer-i"><i class="icon-user"></i></div>
        <div class="footer-name">我的报数</div>
    </div> -->

    <div class="@if( ($nav??'1') ==3) footer-current @endif cell" data-href="{{ route('data.index') }}">
        <div class="footer-i"><i class="icon-group"></i></div>
        <div class="footer-name">共修数据</div>
    </div>
    <div class="@if( ($nav??'1') ==4) footer-current @endif cell" data-href="{{ route('articles.meditation') }}">
        <div class="footer-i"><i class="icon-book"></i></div>
        <div class="footer-name">经文仪轨</div>
    </div>
    <div class="@if( ($nav??'1') ==4) footer-current @endif cell" data-href="{{ route('articles.index') }}">
        <div class="footer-i"><i class="icon-list"></i></div>
        <div class="footer-name">感应文章</div>
    </div>
</footer>
