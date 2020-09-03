@extends('RuLong::layouts.app')

@section('title', 'articles - index')



@section('content')
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-12 m-b">
                <form action="{{ url()->current() }}" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <div class="form-group">
                            <input type="text" style="width:250px;" placeholder="请输入法名" name="nickname" class="input-sm form-control" value="{{ Request::get('nickname') }}">
                        </div>
                        <div class="form-group" id="time-interval">
                            <div class="input-daterange input-group">
                                <input type="text" class="input-sm form-control" placeholder="开始时间" readonly name="start" value="{{ Request::get('start') }}" />
                                <span class="input-group-addon">到</span>
                                <input type="text" class="input-sm form-control" placeholder="结束时间" readonly name="end" value="{{ Request::get('end') }}" />
                            </div>
                        </div>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <h4 class="example-title">总数：{{ $allsum }}</h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">序号</th>
                        <th width="50">法名</th>
                        <th width="50">手机号</th>
                        <th width="50">诵经数</th>
                        <th width="140">提交时间</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chants as $chant)
                    <tr>
                        <td>{{ $chant->id }}</td>
                        <td>{{ $chant->user->info->nickname }}</td>
                        <td>{{ $chant->user->username }}</td>
                        <td>{{ $chant->number }}</td>
                        <td>{{ $chant->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-right">
            {{ $chants->appends(['nickname'=>Request::get('nickname')])->links() }}
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript" src="{{ admin_assets('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
    $("#time-interval .input-daterange").datepicker({
        keyboardNavigation: !1,
        forceParse: !1,
        autoclose: !0
    });
</script>
@endpush

@section('css')
<link rel="stylesheet" href="{{ admin_assets('css/plugins/datapicker/datepicker3.css') }}" />
<style>
    .edit {
        cursor: pointer;
    }
</style>
@endsection
