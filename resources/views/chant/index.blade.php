
@extends('layouts.app')

@section('content')
<section class="padding_btm" id="app" >
    @include('layouts.header')

    <!--记录-->
    <div class="accounts_detail" style="background-color:#eee">
        诵经数据
    </div>
    <ul class="bi-list" style="background:none">
        <div class="record_title">
            <span>本日</span>
            <span>本月</span>
            <span>本年</span>
            <span>迄今为止</span>
        </div>

        <li style="background-color: #fff;padding: .6rem 0">
            <div class="record_block">
                <div class="bi-list-r bi-list-small">{{ $chant_data['today'] }}</div>
                <div class="bi-list-l bi-list-small">{{ $chant_data['month'] }}</div>
                <div class="bi-list-r bi-list-small">{{ $chant_data['year'] }}</div>
                <div class="bi-list-r bi-list-small">{{ $chant_data['all'] + $data['all_chant'] }}</div>
            </div>
        </li>
    </ul>
    <!--end 记录-->

    <div class="beer-order-list">

        <div class="num_0415">
            发愿数
        </div>
        <ul class="num_statistics_list">
            @if($desires->isEmpty())
            <li>
                <div class="statistics_list_name text-nowrap">未提交数据</div>
                <div class="report_proportion"></div>
            </li>
            @else
            @foreach($desires as $data)
            <li>
                <div class="statistics_list_name text-nowrap"> {{  $data->year  }} </div>
                <div class="report_proportion">{{  $data->name  }}</div>
                <div class="statistics_list_num text-nowrap"><span> {{  $data->number  }} </span></div>
            </li>
            @endforeach
            @endif

        </ul>
    </div>
    <!-- 账户总额 Start -->
    <!-- 账户总额 End -->
    <!-- 收支记录 Start -->
    <div class="accounts_detail">
        <div class="j_withdraw_btn1" data-href="{{ route('chant.report') }}">报数</div>
        诵经明细
    </div>
    <ul class="bi-list" style="background:none" id="list">
        @if($chants->count() > 0)
        @include('chant.list')

        @else
        <div class="empty">
            <img src="/assets/home/img/c010.png">
            <p>暂无提现记录</p>
        </div>
        @endif
    </ul>
    <!-- 收支记录 End -->
</section>
@endsection

@section('js')
<script src="/assets/home/js/swiper.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="/assets/home/js/PullToRefresh.min.js"></script>
@endsection

@section('script')
<script type="text/javascript">

    @if($chants->count()>9)
    /*上拉加载更多*/
    var page = 1, flag = true;
    var refreshBox = new PullToRefresh({
        container:"#app",
        up:{
            callback:function(){
                setTimeout(function(){
                    if (page < {{ $chants->lastPage() }}) { //执行page次加载
                        page++
                        $.get("{{ route('chant.more') }}",{page:page},function(res){

                            if(res.statusCode==200){
                                $("#list").append(res.message);
                                refreshBox.endUpLoading(true)
                            }else{
                                refreshBox.endUpLoading(false)
                            }
                        });

                        console.log("循环")
                    } else {    //没有数据
                        refreshBox.endUpLoading(false)
                    }
                }, 100)
            }

        }
    })
    @endif

    $(".delete").click(function(){
        var id = $(this).data('id');
        console.log(id);
    });


</script>
@endsection
