 @if($writes->count() > 0)
 @foreach($writes as $write)
 <li style="background-color: #fff">
    <div class="record_left">
        <div class="record_time text-nowrap">{{ $write->created_at->format('Y-m-d') }}</div>
        <div class="record_name text-nowrap">{{ $write->number }}部</div>
    </div>
    <div class="j_withdraw_btn1" data-href="{{ route('write.edit',$write) }}">修改</div>
    <div class="j_withdraw_btn2 ajax-get confirm " data-href="{{ route('write.delete',$write)}}" >删除</div>

</li>
@endforeach
@else
<div class="empty" style="padding-top: 10%;">
    <img src="/assets/home/img/c010.png">
    <p>暂无记录</p>
</div>
@endif
