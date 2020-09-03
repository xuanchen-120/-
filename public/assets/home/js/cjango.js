$('[data-href]').on('click', function(event) {
    event.preventDefault();
    if ($(this).hasClass('ajax-get') || $(this).hasClass('ajax-post')) {
        return;
    }
    console.log($(this).data('href'));
    location.href = $(this).data('href');
});

// ajax GET 请求
$('body').on('click', '.ajax-get', function(event) {
    event.preventDefault();
    var $this   = $(this);
    var $tips   = $this.attr('tip') || '确认要执行该操作吗?';
    var $target = $this.data('href') || $this.attr('href') || $this.attr('url') || $this.data('url');

    if ($this.hasClass('confirm')) {
        if(!confirm($tips)){
            return false;
        }
    }

    $.get($target, function(data) {
        updateAlert(data.message, data.status, function() {
            if ($this.hasClass('no-refresh')) {
            } else if (data.redirect == null) {
                if ($this.hasClass('refresh')) {
                    location.reload(true);
                }
            } else if (data.redirect) {
                location.href = data.redirect;
            } else {
                location.reload(true);
            }
        });
    });
});

// ajax POST 请求
$('body').on('click', '.ajax-post', function(event) {
    if ($(this).hasClass('disabled') || $(this).attr('disabled')) {
        return false;
    };

    event.preventDefault();
    var $this   = $(this);
    var $form   = $this.parents('form');
    var $tips   = $this.attr('tip') || '确认要执行该操作吗?';
    var $action = $form.attr("action");
    if ($this.hasClass('confirm')) {
        if(!confirm($tips)){
            return false;
        }
    }
    $this.attr('disabled', 'disabled');
    var query = $form.serialize();

    $.ajax({
        type: "POST",
        url: $action,
        data: query,
        success: function(res) {
            updateAlert(res.message, res.status, function() {
                if (res.redirect) {
                    location.href = res.redirect;
                } else if (res.redirect == null) {
                } else {
                    location.reload(true);
                }
                $this.removeAttr('disabled');
            });
        },
        error: function(error) {
            $this.removeAttr('disabled');
            if (error.responseJSON.errors) {
                var err = '';
                $.each(error.responseJSON.errors, function(i, n) {
                    err += n + "\r\n";
                })
                updateAlert(err, 'warning');
            } else if (error.responseJSON.message) {
                updateAlert(error.responseJSON.message, 'warning');
            } else {
                updateAlert('发生未知错误', 'warning');
            }
        }
    });
});

window.updateAlert = function(text, type, callback) {
    layer.msg(text,{offset: ['35%', '15%'],
                            area: ['70%', ' ']});
    if (typeof callback == "function") {
        setTimeout(function() {
            callback();
        }, 1000)
    }
}

