$(function () {
$(document).on("click", '[data-toggle="ajaxEdit"]', function (e) {
        var obj = $(this), url = obj.data('href') || obj.attr('href'), data = obj.data('set') || {},
            html = $.trim(obj.text()), required = obj.data('required') || true, edit = obj.data('edit') || 'input';
        var oldval = $.trim($(this).text());
        e.preventDefault();
        submit = function () {
            e.preventDefault();
            var val = $.trim(input.val());
            if (required) {
                if (val == '') {
                    util.tips("不能为空")
                    return
                }
            }
            if (val == html) {
                input.remove(), obj.html(val).show();
                return
            }
            if (url) {
                $.post(url, {value: val}, function (ret) {
                    ret = eval("(" + ret + ")");
                    if (ret.status == 1) {
                        obj.html(val).show()
                    } else {
                        util.tips("error")
                    }
                    input.remove()
                }).fail(function () {
                    input.remove(), til.tips("error")
                })
            } else {
                input.remove();
                obj.html(val).show()
            }
            obj.trigger('valueChange', [val, oldval])
        }, obj.hide().html('<i class="fa fa-spinner fa-spin"></i>');
        var input = $('<input type="text" class="form-control input-sm" style="width: 80%;display: inline;" />');
        if (edit == 'textarea') {
            input = $('<textarea type="text" class="form-control" style="resize:none" rows=3 ></textarea>')
        }
        obj.after(input);
        input.val(html).select().blur(function () {
            submit(input)
        }).keypress(function (e) {
            if (e.which == 13) {
                submit(input)
            }
        })
    });

  $(document).on("click", '[data-toggle="ajaxSwitch"]', function (e) {
        e.preventDefault();
        var obj = $(this), confirm = obj.data('msg') || obj.data('confirm'), othercss = obj.data('switch-css'),
            other = obj.data('switch-other'), refresh = obj.data('switch-refresh') || false;
        if (obj.attr('submitting') == '1') {
            return
        }
        var value = obj.data('switch-value'), value0 = obj.data('switch-value0'),
            value1 = obj.data('switch-value1');
        if (value === undefined || value0 === undefined || value1 === undefined) {
            return
        }
        var url, css, text, newvalue, newurl, newcss, newtext;
        value0 = value0.split('|');
        value1 = value1.split('|');
        if (value == value0[0]) {
            url = value0[3], css = value0[2], text = value0[1], newvalue = value1[0], newtext = value1[1], newcss = value1[2]
        } else {
            url = value1[3], css = value1[2], text = value1[1], newvalue = value0[0], newtext = value0[1], newcss = value0[2]
        }
        var html = obj.html();
        var submit = function () {
            $.post(url).done(function (data) {
                data = eval("(" + data + ")");
                if (data.status == 1) {
                    if (other && othercss) {
                        if (newvalue == '1') {
                            $(othercss).each(function () {
                                if ($(this).data('switch-value') == newvalue) {
                                    this.className = css;
                                    $(this).data('switch-value', value).html(text || html)
                                }
                            })
                        }
                    }
                    obj.data('switch-value', newvalue);
                    obj.html(newtext || html);
                    obj[0].className = newcss;
                    refresh && location.reload()
                } else {
                    obj.html(html), util.tips("error")
                }
                obj.removeAttr('submitting')
            }).fail(function () {
                obj.removeAttr('submitting');
                obj.button('reset');
                util.tips("error")
            })
        }, a;
        if (confirm) {
            tip.confirm(confirm, function () {
                obj.html('<i class="fa fa-spinner fa-spin"></i>').attr('submitting', 1), submit()
            })
        } else {
            obj.html('<i class="fa fa-spinner fa-spin"></i>').attr('submitting', 1), submit()
        }
    });
});
