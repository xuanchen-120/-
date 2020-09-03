@extends('RuLong::layouts.app')

@section('title', 'actives - create')

@section('css')
<link rel="stylesheet" href="{{ admin_assets('css/plugins/datetimepicker/bootstrap-datetimepicker.min.css') }}" />
<link rel="stylesheet" href="{{ admin_assets('css/plugins/chosen/chosen.css') }}" />
@endsection

@section('content')
<div class="row">
    <form method="post" action="{{ route('Admin.actives.update', $active) }}" class="form-horizontal">
        <div class="col-sm-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑活动</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">活动名称</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{ $active->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">所属俱乐部</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="club_id" id="chosen" data-placeholder="Select Your Options">
                                <option value="">请选择俱乐部</option>
                                @foreach($clubs as $club)
                                <option value="{{ $club->id }}" @if($club->id == $active->club_id) selected @endif>{{ $club->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">活动类型</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="is_fee" name="is_fee">
                                <option value="0" @if($active->is_fee == 0) selected @endif>免费活动</option>
                                <option value="1" @if($active->is_fee == 1) selected @endif>收费活动</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group active-money" style="display:none;">
                        <label class="col-sm-2 control-label">活动金额</label>
                        <div class="col-sm-5">
                            <input type="text" name="fee" class="form-control" value="{{ $active->fee ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">开始时间</label>
                        <div class="col-sm-5">
                            <input name="start_date" class="form-control date-class" type="text" placeholder="请选择活动开始时间" value="{{ $active->start_date }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">结束时间</label>
                        <div class="col-sm-5">
                            <input name="finish_date" class="form-control date-class" type="text" placeholder="请选择活动结束时间" value="{{ $active->finish_date }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">限定名额</label>
                        <div class="col-sm-5">
                            <input name="limits" class="form-control" type="text" placeholder="无人数限制可不填" value="{{ $active->limits ?? '' }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">正文</label>
                        <div class="col-sm-10">
                            @include('Admin::common.ueditor', ['content' => $active->content])
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            @csrf
                            @method('put')
                            <button class="btn btn-primary ajax-post" type="submit">保存活动</button>
                            <a class="btn btn-white" href="javascript:history.go(-1)" title="返回">返回</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>附加属性</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">省份</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="province" id="province">
                                <option value="">请选择...</option>
                                @foreach ($areas as $area)
                                <option value="{{ $area->sn }}"  @if ($active->province == $area->sn) selected @endif>{{ $area->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">城市</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="city" id="city">
                                @foreach ($cities as $city)
                                <option value="{{ $city->sn }}" @if ($active->city == $city->sn) selected @endif>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">区域</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="district" id="district">
                                @foreach ($districts as $district)
                                <option value="{{ $district->sn }}" @if ($active->district == $district->sn) selected @endif>{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">详细地址</label>
                        <div class="col-sm-9">
                            <textarea name="address" class="form-control" rows="3" placeholder="如街道、门牌等">{{ $active->address ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">封面</label>
                        <div class="col-sm-9">
                            @include('Admin::common.webuploader', ['storage' => $active->storage])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('script')
<script type="text/javascript" src="{{ admin_assets('js/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ admin_assets('js/plugins/datetimepicker/bootstrap-datetimepicker.zh-CN.js') }}"></script>
<script type="text/javascript" src="{{ admin_assets('js/plugins/chosen/chosen.jquery.js') }}"></script>
<script type="text/javascript">
    if ($('#is_fee').val() == 1) {
        $('.active-money').show();
    }
    $('.date-class').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        format: 'yyyy-mm-dd hh:ii:ss'
    });
    $("#is_fee").change(function(event) {
        var is_fee = $(this).val();
        if (is_fee == 1) {
            $('.active-money').show();
        } else {
            $('.active-money').hide();
            $('#fee').val('');
        }
    });

    $('#chosen').chosen({
        disable_search_threshold: 10,
        no_results_text: 'Oops, nothing found!',
        width: '95%'
    });

    // 省市区联动
    $('#province').change(function(event){
        var psn = $(this).val();
        $.post('{{ route("Admin.ajaxs.getcities") }}?_token={{ csrf_token() }}', {psn: psn}, function(data){
            var str = '';
            if (data.code == 1) {
                for (var second in data.data)
                {
                    str +='<option value="' + data.data[second].sn + '">' + data.data[second].name + '</option>';
                }
                $('#city').append(str);

            } else {
                updateAlert('获取失败');
            }
        });
    });

    $('#city').change(function(event){
        var psn = $(this).val();
        $.post('{{ route("Admin.ajaxs.getdistrict") }}?_token={{ csrf_token() }}', {psn: psn}, function(data){
            $('#district').empty();
            var str = '';
            if (data.code == 1) {
                for (var second in data.data)
                {
                    str +='<option value="' + data.data[second].sn + '">' + data.data[second].name + '</option>';
                }
                $('#district').append(str);
            } else {
                updateAlert('获取失败');
            }
        });
    });
</script>
@endpush
