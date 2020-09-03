@extends('layouts.app')

@section('content')
<section class="padding_btm" >
    <div class="beer-order-list">
        {{-- <div class="num_0415">
            @if ($year['chant'])
                {{ $year['chant']->year??'' }}
                @else
                {{ date('Y') }}
            @endif

            年数据（使用报数系统前的 {{ date('Y') }} 年功课数）
        </div>
        <ul class="num_statistics_list">
            <li>
                <div class="statistics_list_name text-nowrap">诵经</div>
                <div class="report_proportion">{{ $year['chant']->number??'0' }}</div>
                <div class="statistics_list_num text-nowrap">
                    <span>
                        @if(empty($year['chant']))
                        <div class="j_sm_btn1" data-href="{{ route('mydata.year',['type'=>'chant']) }}"><i class="icon icon-plus"></i></div>
                        @else
                        <div class="j_sm_btn1" data-href="{{ route('mydata.yeardo',['data'=>$year['chant']]) }}"><i class="icon icon-pencil"></i></div>
                        @endif
                    </span>
                </div>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">抄经</div>
                <div class="report_proportion">{{ $year['write']->number??'0' }}</div>
                <div class="statistics_list_num text-nowrap">
                    <span>
                        @if(empty($year['write']))
                        <div class="j_sm_btn1" data-href="{{ route('mydata.year',['type'=>'write']) }}"><i class="icon icon-plus"></i></div>
                        @else
                        <div class="j_sm_btn1" data-href="{{ route('mydata.yeardo',['data'=>$year['write']]) }}"><i class="icon icon-pencil"></i></div>
                        @endif
                    </span>
                </div>
            </li>
        </ul> --}}
        <div class="num_0415">
            迄今为止（使用报数系统前的功课总数）
        </div>
        <ul class="num_statistics_list">
            <li>
                <div class="statistics_list_name text-nowrap">诵经</div>
                <div class="report_proportion">{{ $all['chant']->number??'0' }}</div>
                <span>
                    @if(empty($all['chant']))
                    <div class="j_sm_btn1" data-href="{{ route('mydata.all',['type'=>'chant']) }}"><i class="icon icon-plus"></i></div>
                    @else
                    <div class="j_sm_btn1" data-href="{{ route('mydata.yeardo',['data'=>$all['chant']]) }}"><i class="icon icon-pencil"></i></div>
                    @endif
                </span>
            </li>
            <li>
                <div class="statistics_list_name text-nowrap">抄经</div>
                <div class="report_proportion">{{ $all['write']->number??'0' }}</div>
                <span>
                    @if(empty($all['write']))
                    <div class="j_sm_btn1" data-href="{{ route('mydata.all',['type'=>'write']) }}"><i class="icon icon-plus"></i></div>
                    @else
                    <div class="j_sm_btn1" data-href="{{ route('mydata.yeardo',['data'=>$all['write']]) }}"><i class="icon icon-pencil"></i></div>
                    @endif
                </span>
            </li>
        </ul>
        <div class="num_0415">
            发愿数 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type="button" class="btn info has-badge " data-href="{{ route('mydata.desires') }}"><i class="icon icon-plus"></i> </button>
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
                <div class="statistics_list_num text-nowrap"><span> {{  $data->number  }} </span><i class="icon icon-pencil" data-href="{{ route('mydata.desiresdo',$data) }}" ></i></div>
            </li>
            @endforeach
            @endif

        </ul>
    </div>
</div>

</section>
@endsection
