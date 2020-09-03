@extends('layouts.app')

@section('footer')
@endsection
@section('content')

<section class="padding_btm" >
    <!-- 提现表单 Start -->
    <form action=" {{ route('mydata.desiresdo',$data) }} " method="post" accept-charset="utf-8">
        <div class="formbox">
            <div class="formbox-label">
                类型
            </div>
            <div class="formbox-radio">
             <select name="type" class="select1">
                <option value="chant" @if($data->type=='chant') selected @endif >诵经</option>
                <option value="write" @if($data->type=='write') selected @endif >抄经</option>
            </select>
            <i class="cash_sel_i icon-caret-down"></i>
        </div>

        <div class="formbox">
            <div class="formbox-label">
                发愿年份
            </div>
            <div class="formbox-input">
                <input type="number" name="dated_at" value="{{ $data->dated_at->format('Y') }}" placeholder="输入发愿年份" class="formbox-input-text">
            </div>
        </div>

        <div class="formbox">
            <div class="formbox-label">
                发愿数
            </div>
            <div class="formbox-input">
                <input type="number" name="number" value="{{ $data->number }}" placeholder="发愿数">
            </div>
        </div>
    </div>
    <div class="button_btm">
        @csrf
        @method('post')
        <button type="button" class="btn ajax-post">修改</button>
    </div>
</form>
<!-- 提现表单 End -->
</section>


@endsection
