
@extends('layouts.app')

@section('content')
<section class="padding_btm" id="app" >
    @include('layouts.header')
    <div class="accounts_detail" style="background-color:#eee">
        抄经数据
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
                <div class="bi-list-r bi-list-small">{{ $write_data['today'] }}</div>
                <div class="bi-list-l bi-list-small">{{ $write_data['month'] }}</div><!--提现金额-->
                <div class="bi-list-r bi-list-small">{{ $write_data['year'] }}</div><!--实到金额-->
                <div class="bi-list-r bi-list-small">{{ $write_data['all'] + $data['all_write'] }}</div><!--提现方式-->
            </div>
        </li>
    </ul>
    <div class="beer-order-list">
       {{-- <div class="num_0415">
            抄经数据
        </div>
        <ul class="num_statistics_list">
            <li>
                <div class="statistics_list_name text-nowrap">本日</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> {{ $write_data['today'] }} </span></div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">本月</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> {{ $write_data['month'] }} </span></div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">本年</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span>{{ $write_data['year'] + $data['year_write'] }}  </span></div>
                <div class="report_child">
                    <span>以往数据：{{ $data['year_write'] }}</span>
                    <span>系统数据：{{ $write_data['year'] }}</span>
                </div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">迄今为止</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> {{ $write_data['all'] + $data['all_write'] }}  </span></div>
                <div class="report_child">
                    <span>以往数据：{{ $data['all_write'] }}</span>
                    <span>系统数据：{{ $write_data['year'] }}</span>
                </div>
            </li>

        </ul>--}}
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
    <!-- 收支记录 Start -->
    <div class="accounts_detail">
        <div class="j_withdraw_btn1" data-href="{{ route('write.report') }}">报数</div>
        抄经明细
    </div>
    <ul class="bi-list" style="background:none" id="list">
        @if($writes->count() > 0)
        @include('write.list')

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
<script type="text/javascript" src="/assets/home/js/PullToRefresh.min.js"></script>
@endsection

@section('script')
<script type="text/javascript">

    @if($writes->count()>14)
    /*上拉加载更多*/
    var n=2,flag=true;
    var refreshBox=new PullToRefresh({
        container:"#app",
        up:{
            callback:function(){
                $.get("{{ route('chant.more') }}",{page:n},function(res){
                    if(res.statusCode==200){
                        $("#list").append(res.message);
                        refreshBox.endUpLoading(true)
                        n++
                    }else{
                        refreshBox.endUpLoading(false)

                    }
                });
            }
        }
    })
    @endif


</script>
@endsection
