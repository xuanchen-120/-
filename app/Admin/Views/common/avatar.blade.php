<!-- 封面 -->
<div id="webuploader" class="webuploader">
    <input class="img-id" type="hidden" name="storage" value="{{ $storage ?? '' }}">
    <div class="img-preview">
        <div class="progress progress-striped active">
            <span style="width: 0%" class="progress-bar progress-bar-info"></span>
        </div>
        <span class="fa fa-close"></span>
        <div id="filePicker">
            <div><i class="fa fa-picture-o"></i></div>
            <p>点击上传<br/>或将图片拖拽到这里</p>
        </div>
        <img style="display:none;" src="{{ $storage ?? '' }}">
    </div>
</div>
<!-- 封面 -->

@push('script')
<script type="text/javascript" src="{{ admin_assets('js/plugins/webuploader/webuploader.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ admin_assets('css/plugins/webuploader/webuploader.css') }}">

<script type="text/javascript">
    var uploader;
    uploader = WebUploader.create({
        swf: "__JS__/plugins/webuploader/Uploader.swf",
        server: "{{ route('Admin.storages.picture') }}?_token={{ csrf_token() }}",
        pick: {
            id: "#filePicker",
            multiple: false
        },
        dnd: ".img-preview",
        disableGlobalDnd: true,
        accept: {
            title: "Images",
            extensions: "gif,jpg,jpeg,png",
            mimeTypes: "image/jpg,image/jpeg,image/png,image/gif"
        },
        fileVal: 'image',
        compress: false,
        thumb: {
            quality: 50,
            allowMagnify: true,
            crop: true,
            type: 'image/jpeg'
        }
    });

    uploader.on('fileQueued', function(file) {
        uploader.md5File(file).then(function(val) {
            $.get("{{ route('Admin.storages.picture') }}", {md5: val}, function(response) {
                if (response.code) {
                    $("#webuploader-container").hide();
                    $("#webuploader .img-preview img").show().attr("src", response.data.path);
                    $("#webuploader .img-id").val("");
                    $("#webuploader .img-id").val(response.data.path);
                    $("#webuploader .fa-close").show();
                    uploader.cancelFile(file)
                } else {
                    uploader.upload();
                }
            });
        });
        uploader.makeThumb(file, function(error, ret) {
            if (error) {
            } else {
                $("#webuploader .webuploader-container").hide();
                $("#webuploader .img-preview img").show().attr("src", ret)
            }
        });
    });

    uploader.on("ready", function() {
        if ($("#webuploader .img-preview img").attr("src") != "") {
            $("#webuploader .webuploader-container").hide();
            $("#webuploader .img-preview img").show();
            $("#webuploader .fa-close").show();
        }
    });

    uploader.on("uploadProgress", function(file, percentage) {
        $progress = $("#webuploader .progress");
        $progress.show().find("span").css("width", percentage * 100 + "%");
    });

    uploader.on("uploadSuccess", function(file, response) {
        if (response.code == 1) {
            $("#webuploader-container").hide();
            $("#webuploader .img-preview img").show().attr("src", response.path);
            $("#webuploader .img-id").val("");
            $("#webuploader .img-id").val(response.path);
            $("#webuploader .fa-close").show();
        } else {
            $("#webuploader-container").show();
            $("#webuploader .img-id").val("");
            $("#webuploader .img-preview img").hide();
            updateAlert(response.msg);
        }
    });

    uploader.on("uploadError", function(file, response) {
        $("#webuploader .webuploader-container").show();
        updateAlert("上传失败");
    });

    uploader.on("uploadComplete", function(file) {
        uploader.removeFile(file);
        $progress = $("#webuploader .progress");
        $progress.delay(1000).fadeOut("slow")
    });

    $("#webuploader .fa-close").click(function() {
        $("#webuploader .img-preview img").hide();
        $("#webuploader .img-id").val("");
        $("#webuploader .webuploader-container").show();
        $(this).hide();
    });
</script>
@endpush
