@extends('layouts.app')

@section('footer')
@endsection
@section('content')

<section class="padding_btm" >
    <!-- 提现表单 Start -->
    <form action=" {{ route('mydata.desires') }} " method="post" accept-charset="utf-8">
        <div class="formbox">
            <div class="formbox-label">
                类型
            </div>
            <div class="formbox-radio">
               <select name="type" class="select1">
                <option value="chant">诵经</option>
                <option value="write">抄经</option>
            </select>
            <i class="cash_sel_i icon-caret-down"></i>
        </div>

        <div class="formbox">
            <div class="formbox-label">
                发愿年份
            </div>
            <div class="formbox-input">
                <input type="number" name="dated_at" id="dated_at" value="" placeholder="输入发愿年份" class="formbox-input-text">
            </div>
        </div>

        <div class="formbox">
            <div class="formbox-label">
                发愿数
            </div>
            <div class="formbox-input">
                <input type="number" name="number" value="" placeholder="发愿数">
            </div>
        </div>
    </div>
    <div class="button_btm">
        @csrf
        <button type="button" class="btn ajax-post">提交发愿</button>
    </div>
</form>
<!-- 提现表单 End -->
</section>


@endsection

@section('js')
<script src="/assets/home/js/laydate/laydate.js" type="text/javascript" ></script>
@endsection

@section('script')
<script type="text/javascript">

    laydate.render({
      elem: '#dated_at'
      ,value: '{{ date('Y',time()) }}'
      ,type: 'year'
  });

</script>
@endsection
