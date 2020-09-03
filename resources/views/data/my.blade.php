@extends('layouts.app')

@section('content')
<section class="padding_btm" >
    <div class="beer-order-list">
        <div class="num_0415">
            诵经数据
        </div>
        <ul class="num_statistics_list">
            <li>
                <div class="statistics_list_name text-nowrap">本日</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> {{ $chants['today'] }} </span></div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">本月</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> {{ $chants['month'] }} </span></div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">本年</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> {{ $chants['year'] + $data['year_chant'] }} </span></div>
                <div class="report_child">
                    <span>以往数据：{{ $data['year_chant'] }}</span>
                    <span>系统数据：{{ $chants['year'] }}</span>
                </div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">迄今为止</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> {{ $chants['all'] + $data['all_chant'] }} </span></div>
                <div class="report_child">
                    <span>以往数据：{{ $data['all_chant'] }}</span>
                    <span>系统数据：{{ $chants['all'] }}</span>
                </div>
            </li>
        </ul>
        <div class="num_0415">
            抄经数据
        </div>
        <ul class="num_statistics_list">
            <li>
                <div class="statistics_list_name text-nowrap">本日</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> {{ $writes['today'] }} </span></div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">本月</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> {{ $writes['month'] }} </span></div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">本年</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span>{{ $writes['year'] + $data['year_write'] }}  </span></div>
                 <div class="report_child">
                    <span>以往数据：{{ $data['year_write'] }}</span>
                    <span>系统数据：{{ $writes['year'] }}</span>
                </div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">迄今为止</div>
                <div class="report_proportion"></div>
                <div class="statistics_list_num text-nowrap"><span> {{ $writes['all'] + $data['all_write'] }}  </span></div>
                <div class="report_child">
                    <span>以往数据：{{ $data['all_write'] }}</span>
                    <span>系统数据：{{ $writes['year'] }}</span>
                </div>
            </li>

        </ul>
    </div>
</div>

</section>
@endsection
