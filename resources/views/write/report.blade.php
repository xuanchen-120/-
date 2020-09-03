@extends('layouts.app')

@section('footer')
@endsection
@section('content')

<section class="padding_btm" >
    <!-- 提现表单 Start -->
    <form action="{{ route('write.reportdo') }}" method="POST" accept-charset="utf-8">
       <div class="formbox">
            <div class="formbox-label">
                日期
            </div>
            <div class="formbox-input">
                <input type="text" name="created_at" id="datetime" value=""  class="formbox-input-text">
            </div>
        </div>

        <div class="formbox">
            <div class="formbox-label">
                抄经数
            </div>
            <div class="formbox-input">
                <input type="number" name="number" value="" placeholder="输入抄经数" class="formbox-input-text">
            </div>
        </div>

    </div>
    <div class="button_btm">
        @csrf
        <button type="button" class="btn ajax-post">提交</button>
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
      elem: '#datetime'
      ,type: 'date'
      ,value: '{{ date('Y-m-d',time()) }}'
      ,format: 'yyyy-MM-dd'
  });

</script>
@endsection
