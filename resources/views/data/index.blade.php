
@extends('layouts.app')

@section('content')
<section class="padding_btm" >
 <nav class="nav cn_nav" data-display=""  data-show-single="true" data-active-class="active" data-animate="false" style="margin-bottom: 0">
  <span data-href="{{ route('data.index',['category'=>'chant']) }}"  @if($category=='chant') class="active" @endif >诵经</span>
  <span data-href="{{ route('data.index',['category'=>'write']) }}"  @if($category=='write') class="active" @endif >抄经</span>
</nav>
<nav class="nav cn_nav" data-display=""  data-show-single="true" data-active-class="active" data-animate="false" style="background-color:#eee">
  <span data-href="{{ route('data.index',['category'=>$category,'type'=>'day']) }}" @if($type=='day') class="active" @endif >每日</span>
  <span data-href="{{ route('data.index',['category'=>$category,'type'=>'month']) }}" @if($type=='month') class="active" @endif >月度</span>
  <span data-href="{{ route('data.index',['category'=>$category,'type'=>'year']) }}" @if($type=='year') class="active" @endif >年度</span>
  <span data-href="{{ route('data.index',['category'=>$category,'type'=>'all']) }}" @if($type=='all') class="active" @endif >总数</span>
</nav>

<form action="{{ route('data.index') }}" id="form" method="get" accept-charset="utf-8">
 <div class="formbox">
  <div class="formbox-label">
    @if(in_array($type,['year','all']))
    截止
    @else
    日期
    @endif
  </div>
  <div class="formbox-input">
    <input type="text" name="datetime" id="datetime" value="{{ $datetime }}"  class="formbox-input-text">
    <input type="hidden" name="category" value="{{ $category }}">
    <input type="hidden" name="type" value="{{ $type }}">
  </div>
</div>
</form>


<!--记录-->
@if(in_array($type,['day','month']))
<div class="accounts_detail" style="background-color:#eee">
</div>
@endif
<ul class="bi-list" style="background:none">
  <div class="record_title1 record_block2">
    <span>共计</span>
    <span>参与人数</span>
    <span>平均值</span>
    <span>我的排名</span>
  </div>

  <li style="background-color: #fff;padding: .6rem 0">
    <div class="record_block1 record_block2">
      <div class="bi-list-r bi-list-small">{{ $sum??'0' }}</div>
      <div class="bi-list-l bi-list-small">{{ $count??0 }}</div>
      <div class="bi-list-r bi-list-small">{{ intval($average) }}</div>
      <div class="bi-list-r bi-list-small">{{ $ranking??'0' }}</div>
    </div>
  </li>
</ul>

<div class="accounts_detail" style="background-color:#eee">
  排行数据
</div>
<ul class="bi-list" style="background:none">
  @if(!$lists->isEmpty())
  @foreach($lists as $key=> $data)
  <li style="background-color: #fff;padding: .6rem 0">
    <div class="record_block1">
      <div class="bi-list-r bi-list-small">TOP {{ $loop->iteration }}</div>
      <div class="bi-list-l bi-list-small">{{ $data->info->nickname }}</div>
      <div class="bi-list-r bi-list-small">{{ $data->count }}部</div>
    </div>
  </li>

  @endforeach
  @endif

</ul>
<!--end 记录-->
</section>
@endsection

@section('js')
<script src="/assets/home/js/laydate/laydate.js" type="text/javascript" ></script>
@endsection

@section('script')
<script type="text/javascript">

  laydate.render({
  elem: '#datetime' //指定元素
  @if($type=='month')
  ,type: 'month'
  ,format: 'yyyy-MM'
  @else
  ,type: 'date'
  ,format: 'yyyy-MM-dd'
  @endif

  // ,min: '{{ date('Y',time()) }}-1-1'
  // ,max: '{{ date('Y',time()) }}-12-31'
  ,done: function(value, date, endDate){
    $('#datetime').val(value);
    $("#form").submit();
  }
});

  // $.get('https://api.yousupin.cn/articles/news',function(res){
    // console.log(res);
  // });

</script>
@endsection
