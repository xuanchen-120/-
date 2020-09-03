<script id="editor" name="content" type="text/plain" style="width:100%;">
<?php echo $content ?? ''; ?>

</script>

<?php $__env->startPush('script'); ?>
<script src="<?php echo admin_assets('ueditor/ueditor.config.js'); ?>"></script>
<script src="<?php echo admin_assets('ueditor/ueditor.all.min.js'); ?>"></script>
<script type="text/javascript">
    var ue = UE.getEditor('editor', {
        autoHeightEnabled: false
        ,initialFrameHeight: 400
        ,serverUrl: "<?php echo e(route('Admin.ueditor')); ?>"
        ,toolbars: [[
        'fullscreen', 'source', '|', 'undo', 'redo', '|',
        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
        'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
        'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
        'directionalityltr', 'directionalityrtl', 'indent', '|',
        'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
        'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
        'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'attachment', 'map', 'insertframe', 'pagebreak', 'template', 'background', '|',
        'horizontal', 'date', 'time', 'spechars', 'wordimage', '|',
        'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|', 'preview', 'searchreplace', 'drafts'
        ]]
    });

ue.ready(function() {
    ue.execCommand('serverparam', '_token', '<?php echo e(csrf_token()); ?>');
});
</script>
<?php $__env->stopPush(); ?>
