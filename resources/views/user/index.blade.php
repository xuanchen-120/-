@extends('layouts.app')

@section('content')
<section class="padding_btm" >
    <!-- 个人信息  Start -->
    <div class="my_data">
        <div class="my_head">
            <span style="background-image:url({{ $user->info->head_img  }})"></span>
        </div>
        <div class="my_data_container">
            <div class="my_data_name">{{ $user->info->nickname??'' }}</div>
            <div class="my_data_identity">
                <div class="my_data_tip">佛子</div>
                <!-- <div class="my_data_tip2">备用标签</div> -->
                <!-- <div class="my_data_tip3">备用标签</div> -->
            </div>
        </div>
    </div>
    <div class="beer-order-list">
        <ul class="num_statistics_list">
            <li>
                <div class="report_child">
                    <span>{{ date('Y',time()) }}年发愿诵经 {{ $chant_desires }} 部</span>
                </div>
                <div class="statistics_list_name text-nowrap">已完成诵经</div>
                <div class="report_proportion">
                    @if($chant_desires)
                    <div class="proportion_block">
                        <span class="proportion_name">占比</span>
                        <span class="proportion_num">{{ round(Auth::user()->year_chant_count / $chant_desires ,4)*100 }}%</span>
                    </div>
                    @else
                    <div class="proportion_block">
                        <span class="proportion_name">占比</span>
                        <span class="proportion_num">100%</span>
                    </div>
                    @endif
                </div>
                <div class="statistics_list_num text-nowrap">
                    <span>
                        {{ Auth::user()->year_chant_count }}部
                    </span>
                </div>

            </li>

             <li>
                <div class="report_child">
                    <span>{{ date('Y',time()) }}年发愿抄经 {{ $write_desires }} 部</span>
                </div>
                <div class="statistics_list_name text-nowrap">已完成抄经</div>
                <div class="report_proportion">
                    @if($write_desires)
                    <div class="proportion_block">
                        <span class="proportion_name">占比</span>
                        <span class="proportion_num">{{ round(Auth::user()->year_write_count / $write_desires ,4)*100 }}%</span>
                    </div>
                    @else
                    <div class="proportion_block">
                        <span class="proportion_name">占比</span>
                        <span class="proportion_num">100%</span>
                    </div>
                    @endif
                </div>
                <div class="statistics_list_num text-nowrap">
                    <span>
                        {{ Auth::user()->year_write_count }}部
                    </span>
                </div>

            </li>

        </ul>
    </div>
    {{-- <div class="j_account_withdraw">
        <div class="j_account_withdraw_top">诵经总数</div>
        <div class="j_withdraw_num">
            <span>{{ Auth::user()->chant_count }}</span>
            <div class="j_withdraw_btn2" data-href="{{ route('chant.index') }}">明细</div>
        </div>
    </div>

     <div class="j_account_withdraw">
        <div class="j_account_withdraw_top">抄经总数</div>
        <div class="j_withdraw_num">
            <span>{{ Auth::user()->write_count }}</span>
            <div class="j_withdraw_btn2" data-href="{{ route('write.index') }}">明细</div>
        </div>
    </div> --}}
    <!-- 个人信息 End -->
    <!-- 宝宝课  Start -->
    <div class="j_order">
        <div class="j_order_top" data-href="">我的修行</div>
        <ul class="j_order_list">
            <li data-href="{{ route('chant.index') }}">
                <div class="j_order_i"><img src="/assets/home/img//j11.png"></div>
                <div class="j_order_status">每日报数</div>
            </li>
            <!-- <li data-href="{{ route('write.index') }}">
                <div class="j_order_i"><img src="/assets/home/img//j12.png"></div>
                <div class="j_order_status">我的抄经</div>
            </li> -->

            <li data-href="{{ route('mydata.index') }}">
                <div class="j_order_i"><img src="/assets/home/img//j12.png"></div>
                <div class="j_order_status">数据管理</div>
            </li>

            <li data-href="{{ route('data.my') }}">
                <div class="j_order_i"><img src="/assets/home/img//j12.png"></div>
                <div class="j_order_status">修行成果</div>
            </li>

        </ul>
    </div>


    <div class="j_my_list"  data-href="{{ route('settings.index') }}">
        <i class="icon-pie-chart j_i j_i_grey"></i>&nbsp;设置<i class="icon-angle-right j_my_list_i"></i>
    </div>

    <button type="button ajax-get" data-href="{{ route('logout') }}" class="my_out btn">退出登录</button>
</section>
@endsection
