function JSONToCSVConvertor(e, t, a, n, i, r) {
    function o() {
        c.fn_toDown(m, s).submit()
    }
    const c = {
        type: "online",
        fn_toDown: function(e, t) {
            const a = document.createElement("form");
            a.method = "post",
            a.action = "/japi/file/export",
            a.target = "csv_iframe",
            a.style.display = "none";
            const n = document.createElement("iframe");
            n.id = n.name = "csv_iframe",
            a.appendChild(n);
            const r = document.createElement("input");
            r.type = "hidden",
            r.name = "data",
            r.value = t,
            a.appendChild(r);
            const o = document.createElement("input");
            o.type = "hidden",
            o.name = "type",
            o.value = i,
            a.appendChild(o);
            const c = document.createElement("input");
            return c.type = "hidden",
            c.name = "name",
            c.value = e.replace(/\//g, ""),
            a.appendChild(c),
            document.body.appendChild(a),
            a
        }
    }
      , l = "object" != typeof e ? JSON.parse(e) : e;
    let s = "";
    if (a) {
        p = "";
        for (var d in l[0])
            "object" == typeof a && (d = a[d]),
            p += `${d},`;
        p = p.slice(0, -1),
        s += `${p}\r\n`
    }
    for (let e = 0; e < l.length; e++) {
        var p = "";
        for (var d in r) {
            void 0 !== l[e][r[d]] && null !== l[e][r[d]] || (l[e][r[d]] = "");
            p += `"${(`${l[e][r[d]]}` || "").replace(/"/g, "&quot;").replace(/'/g, "&apos;")}",`
        }
        p.slice(0, p.length - 1),
        s += `${p}\r\n`
    }
    if ("" == s)
        return void alert("Invalid data");
    let m = "";
    if (m += t.replace(/ /g, "_"),
    n) {
        const e = document.getElementById(n);
        if ("online" == c.type)
            e.onclick = function(e) {
                o()
            }
            ;
        else {
            const t = `data:text/xls;charset=utf-8,${encodeURIComponent(s)}`;
            e.href = t,
            e.download = `${m}.${i}`
        }
    }
    return {
        down: function() {
            o()
        }
    }
}
!function(e) {
    e.gritter = {},
    e.gritter.options = {
        position: "",
        class_name: "",
        fade_in_speed: "medium",
        fade_out_speed: 1e3,
        time: 1e3
    },
    e.gritter.add = function(e) {
        try {
            return t.add(e || {})
        } catch (t) {
            var a = "Gritter Error: " + t;
            "undefined" != typeof console && console.error ? console.error(a, e) : alert(a)
        }
    }
    ,
    e.gritter.remove = function(e, a) {
        t.removeSpecific(e, a || {})
    }
    ,
    e.gritter.removeAll = function(e) {
        t.stop(e || {})
    }
    ;
    var t = {
        position: "",
        fade_in_speed: "",
        fade_out_speed: "",
        time: "",
        _custom_timer: 0,
        _item_count: 0,
        _is_setup: 0,
        _tpl_close: '<a class="gritter-close" href="#" tabindex="1">Close Notification</a>',
        _tpl_title: '<span class="gritter-title">[[title]]</span>',
        _tpl_item: '<div id="gritter-item-[[number]]" class="gritter-item-wrapper [[item_class]]" style="display:none" role="alert"><div class="gritter-top"></div><div class="gritter-item">[[close]][[image]]<div class="[[class_name]]">[[title]]<p>[[text]]</p></div><div style="clear:both"></div></div><div class="gritter-bottom"></div></div>',
        _tpl_wrap: '<div id="gritter-notice-wrapper"></div>',
        add: function(a) {
            if ("string" == typeof a && (a = {
                text: a
            }),
            null === a.text)
                throw 'You must supply "text" parameter.';
            this._is_setup || this._runSetup();
            var n = a.title
              , i = a.text
              , r = a.image || ""
              , o = a.sticky || !1
              , c = a.class_name || e.gritter.options.class_name
              , l = e.gritter.options.position
              , s = a.time || "";
            this._verifyWrapper(),
            this._item_count++;
            var d = this._item_count
              , p = this._tpl_item;
            e(["before_open", "after_open", "before_close", "after_close"]).each(function(n, i) {
                t["_" + i + "_" + d] = e.isFunction(a[i]) ? a[i] : function() {}
            }),
            this._custom_timer = 0,
            s && (this._custom_timer = s);
            var m = "" != r ? '<img src="' + r + '" class="gritter-image" />' : ""
              , u = "" != r ? "gritter-with-image" : "gritter-without-image";
            if (n = n ? this._str_replace("[[title]]", n, this._tpl_title) : "",
            p = this._str_replace(["[[title]]", "[[text]]", "[[close]]", "[[image]]", "[[number]]", "[[class_name]]", "[[item_class]]"], [n, i, this._tpl_close, m, this._item_count, u, c], p),
            !1 === this["_before_open_" + d]())
                return !1;
            e("#gritter-notice-wrapper").addClass(l).append(p);
            var f = e("#gritter-item-" + this._item_count);
            return f.fadeIn(this.fade_in_speed, function() {
                t["_after_open_" + d](e(this))
            }),
            o || this._setFadeTimer(f, d),
            e(f).bind("mouseenter mouseleave", function(a) {
                "mouseenter" == a.type || o || t._setFadeTimer(e(this), d),
                t._hoverState(e(this), a.type)
            }),
            e(f).find(".gritter-close").click(function() {
                return t.removeSpecific(d, {}, null, !0),
                !1
            }),
            d
        },
        _countRemoveWrapper: function(t, a, n) {
            a.remove(),
            this["_after_close_" + t](a, n),
            0 == e(".gritter-item-wrapper").length && e("#gritter-notice-wrapper").remove()
        },
        _fade: function(e, a, n, i) {
            var r = void 0 === (n = n || {}).fade || n.fade
              , o = n.speed || this.fade_out_speed
              , c = i;
            this["_before_close_" + a](e, c),
            i && e.unbind("mouseenter mouseleave"),
            r ? e.animate({
                opacity: 0
            }, o, function() {
                e.animate({
                    height: 0
                }, 300, function() {
                    t._countRemoveWrapper(a, e, c)
                })
            }) : this._countRemoveWrapper(a, e)
        },
        _hoverState: function(e, t) {
            "mouseenter" == t ? (e.addClass("hover"),
            e.find(".gritter-close").show()) : (e.removeClass("hover"),
            e.find(".gritter-close").hide())
        },
        removeSpecific: function(t, a, n, i) {
            if (!n)
                n = e("#gritter-item-" + t);
            this._fade(n, t, a || {}, i)
        },
        _restoreItemIfFading: function(e, t) {
            clearTimeout(this["_int_id_" + t]),
            e.stop().css({
                opacity: "",
                height: ""
            })
        },
        _runSetup: function() {
            for (opt in e.gritter.options)
                this[opt] = e.gritter.options[opt];
            this._is_setup = 1
        },
        _setFadeTimer: function(e, a) {
            var n = this._custom_timer ? this._custom_timer : this.time;
            this["_int_id_" + a] = setTimeout(function() {
                t._fade(e, a)
            }, n)
        },
        stop: function(t) {
            var a = e.isFunction(t.before_close) ? t.before_close : function() {}
              , n = e.isFunction(t.after_close) ? t.after_close : function() {}
              , i = e("#gritter-notice-wrapper");
            a(i),
            i.fadeOut(function() {
                e(this).remove(),
                n()
            })
        },
        _str_replace: function(e, t, a, n) {
            var i = 0
              , r = 0
              , o = ""
              , c = ""
              , l = 0
              , s = 0
              , d = [].concat(e)
              , p = [].concat(t)
              , m = a
              , u = p instanceof Array
              , f = m instanceof Array;
            for (m = [].concat(m),
            n && (this.window[n] = 0),
            i = 0,
            l = m.length; i < l; i++)
                if ("" !== m[i])
                    for (r = 0,
                    s = d.length; r < s; r++)
                        o = m[i] + "",
                        c = u ? void 0 !== p[r] ? p[r] : "" : p[0],
                        m[i] = o.split(d[r]).join(c),
                        n && m[i] !== o && (this.window[n] += (o.length - m[i].length) / d[r].length);
            return f ? m : m[0]
        },
        _verifyWrapper: function() {
            0 == e("#gritter-notice-wrapper").length && e("body").append(this._tpl_wrap)
        }
    }
}(jQuery),
define("gritter", function() {});
var _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
    return typeof e
}
: function(e) {
    return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
}
;
define("common/global", ["gritter", "datetime"], function() {
    "use strict";
    function e(e, t) {
        var a = !1;
        return e.forEach(function(e) {
            t.indexOf(e) > -1 && (a = !0)
        }),
        a
    }
    var t = {
        getTime: function() {
            return (new Date).getTime()
        },
        getParam: function(e) {
            var t = new RegExp("(^|&)" + e + "=([^&]*)(&|$)","i")
              , a = window.location.search.substr(1).match(t);
            return null != a ? decodeURI(a[2]) : null
        },
        da: function(e, t, a) {
            var n = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : ""
              , i = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : ""
              , r = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : {}
              , o = null
              , c = {
                union_uri: window.localStorage.getItem("dxy_institution_code"),
                shop_id: window.localStorage.getItem(localStorage.getItem("dxy_institution_code") + "_shop_id")
            };
            r = $.extend({}, c, r),
            o = setInterval(function() {
                "function" == typeof _daTrackEvent && (clearInterval(o),
                n && i ? $("body").on(i, n, function() {
                    _daTrackEvent(e, t, a, JSON.stringify(r))
                }) : _daTrackEvent(e, t, a, JSON.stringify(r)))
            }, 500)
        },
        getFormatParam: function(e) {
            var t = window.location.pathname
              , a = []
              , n = "";
            return e ? (Array.indexOf || (Array.prototype.indexOf = function(e) {
                for (var t = 0; t < this.length; t++)
                    if (this[t] == e)
                        return t;
                return -1
            }
            ),
            a = t.split("/"),
            (n = a.indexOf(e)) ? a[n + 1].replace(".html", "") : "") : ""
        },
        getUrlParam: function(e) {
            return t.getFormatParam(e) || t.getParam(e)
        },
        getHash: function() {
            return location.hash.replace("##", "#")
        },
        getUserAvatar: function(e) {
            var t = assets_domain + "/business/images/unknown-avatar.png"
              , a = assets_domain + "/business/images/child-avatar.png"
              , n = assets_domain + "/business/images/female-avatar.png"
              , i = assets_domain + "/business/images/male-avatar.png"
              , r = "";
            e.ageInfo && void 0 !== e.ageInfo && (r = e.ageInfo.toString()),
            e.age && void 0 !== e.age && (r = e.age.toString()),
            e.age && e.age.age && void 0 !== e.age.age && (r = e.age.age.toString());
            var o = parseInt(r, 10)
              , c = e.sex_name || e.sexName || e.sexLabel
              , l = e.image || e.doctor_img;
            return l ? l + global_img_rule : "男" === c ? !isNaN(o) && o <= 14 ? a : i : "女" === c ? !isNaN(o) && o <= 14 ? a : n : t
        },
        renderSelect: function(e, t) {
            t = t || 0;
            var a = '<option value="">请选择</option>';
            return $.each(e, function(e, n) {
                a += '<option value="' + n.key + '" ' + (t == n.key ? 'selected="selected"' : "") + ">" + n.label + "</option>"
            }),
            a
        },
        alert: function(e, t, a) {
            $("#gritter-notice-wrapper").length || $.gritter.add({
                title: a && a.title || (e ? "操作成功" : "操作失败"),
                text: t.replace(/<[^>]+>/g, ""),
                fade: !0,
                class_name: e ? "growl-success gritter-center" : "growl-danger gritter-center",
                sticky: !1,
                image: assets_domain + "/business/images" + (e ? "/icon-check.png" : "/icon-error.png"),
                time: a ? a.time || 1500 : 1500
            })
        },
        log: function(e) {
            console.log("errorCode：" + e.errorCode + "，errorId：" + e.errorId)
        },
        confirm: function(e, t, a, n) {
            var i = '<div class="modal fade in index-65501" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="false"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h4 class="modal-title" id="confirmModalLabel">' + (n = n || "系统提示") + '</h4></div><div class="modal-body"><h4>' + e + '</h4></div><div class="modal-footer modal-btn-col2"><button type="submit" class="btn btn-primary J-cnf-confirm">确定</button><button type="button" class="btn btn-default J-cnf-cancel" data-dismiss="modal">取消</button></div></div></div></div>';
            $("#confirmModal").length || $("body").append(i);
            var r = $("#confirmModal");
            r.modal("show"),
            $(".modal-backdrop").last().addClass("index-65500"),
            r.off("click", ".J-cnf-confirm"),
            r.off("click", ".J-cnf-cancel"),
            r.on("click", ".J-cnf-confirm", function() {
                var e = null;
                "function" == typeof t && (e = t()),
                e || r.modal("hide")
            }).on("click", ".J-cnf-cancel", function() {
                if ("function" == typeof a)
                    a();
                r.modal("hide")
            })
        },
        initDate: function(e, t, a) {
            var n = this
              , i = (new Date).getFullYear()
              , r = a && a.mask ? a.mask : ""
              , o = a && a.formatDate ? a.formatDate : "9999-99-99"
              , c = $(e);
            c.each(function(e, l) {
                var s = $(l)
                  , d = {};
                d.defaults = {
                    theme: "mobiscroll",
                    mode: "scroller",
                    display: "modal",
                    lang: "zh",
                    dateOrder: "yyyymmdd",
                    dateFormat: "yy-mm-dd",
                    showNow: !1,
                    showLabel: !0,
                    stepMinute: 15,
                    startYear: i - 100,
                    buttons: ["set", {
                        text: "取消",
                        handler: null
                    }]
                },
                d.defaults = $.extend({}, d.defaults, a),
                d.defaults.buttons[1].handler = function(e, t) {
                    t.cancel(),
                    s.val("")
                }
                ,
                r && !n.mobilecheck() && $.mask ? c.removeAttr("readonly").mask(o) : "date" === t ? n.mobilecheck() ? s.mobiscroll().date(d.defaults) : s.mobiscroll().calendar(d.defaults) : "datetime" === t ? s.mobiscroll().datetime(d.defaults) : "time" === t ? s.mobiscroll().time(d.defaults) : "calendar" === t && s.mobiscroll().calendar(d.defaults)
            })
        },
        handleInfo: function(e, a, n, i, r) {
            var o = {};
            r = !1 !== r || r,
            Array.isArray(n) ? $.each(n, function(e, t) {
                void 0 !== o[t.name] ? o[t.name] = o[t.name] + "|" + t.value : o[t.name] = t.value
            }) : o = n;
            for (name in o)
                name.match(/\[\]$/) && (o[name] = o[name].match(/\|/) ? o[name].split("|") : o[name]);
            $.ajax({
                url: e,
                type: a,
                data: o,
                dataType: "json",
                async: r,
                success: function(e) {
                    e.success && t.alert(1, "保存成功"),
                    i && i(e)
                }
            })
        },
        getAjaxData: function() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
            if ($.isEmptyObject(e))
                return t.alert(0, "参数错误"),
                t.log("ajax参数错误"),
                !1;
            e.async = null === e.async || "" === e.async || void 0 === e.async || e.async,
            e.type = null == e.type || "" == e.type || void 0 === e.type ? "get" : e.type,
            e.dataType = null == e.dataType || "" == e.dataType || void 0 === e.dataType ? "json" : e.dataType,
            e.data = null == e.data || "" == e.data || void 0 === e.data ? "" : e.data,
            $.ajax({
                type: e.type,
                async: e.async,
                data: e.data,
                url: e.url,
                dataType: e.dataType,
                success: function(t) {
                    try {
                        t = JSON.parse(JSON.stringify(t).replace(/&amp;/g, "&")),
                        e.successfn(t)
                    } catch (a) {
                        e.successfn(t)
                    }
                },
                error: function(t) {
                    void 0 !== e.errorfn && e.errorfn(t)
                }
            })
        },
        print: function() {
            var e = $("#print, #curePrint, #recipe, #medical").find("img")
              , t = e.length
              , a = 0;
            $("#gritter-notice-wrapper").remove(),
            t ? e.each(function(e, n) {
                var i = new Image;
                i.onload = function() {
                    ++a === t && window.print()
                }
                ,
                i.onerror = function() {
                    ++a === t && window.print()
                }
                ,
                i.src = n.src
            }) : window.print()
        },
        mobilecheck: function() {
            var e = !1
              , t = navigator.userAgent || navigator.vendor || window.opera;
            return (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(t) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(t.substr(0, 4))) && (e = !0),
            e
        },
        getBrowserType: function() {
            var e = navigator.userAgent
              , t = e.indexOf("Opera") > -1;
            return t ? "Opera" : e.indexOf("Firefox") > -1 ? "Firefox" : e.indexOf("Chrome") > -1 ? "Chrome" : e.indexOf("Safari") > -1 ? "Safari" : e.indexOf("compatible") > -1 && e.indexOf("MSIE") > -1 && !t ? "IE" : void 0
        },
        jxcRealDownload: function(e) {
            e.preventDefault();
            var a = $(e.currentTarget)
              , n = a.attr("href")
              , i = a.closest(".J-jsx-stock")
              , r = i.attr("id")
              , o = i.find(".J-start-date").val()
              , c = i.find(".J-end-date").val()
              , l = "";
            switch (a.addClass("disabled").find("span").text("下载中.."),
            r) {
            case "stockin":
                l = "704030";
                break;
            case "stockout":
                l = "704040";
                break;
            case "reportJxc":
                l = "702010";
                break;
            case "materialStockin":
                l = "401047";
                break;
            case "materialStockout":
                l = "401048";
                break;
            case "reportJxcMaterial":
                l = "401049"
            }
            o.length && c.length && l ? t.getAjaxData({
                url: global_japi + "/704050",
                type: "get",
                dataType: "json",
                data: {
                    startDate: o,
                    endDate: c,
                    apiId: l
                },
                successfn: function(e) {
                    e.success ? (window.location.href = n,
                    setTimeout(function() {
                        a.removeClass("disabled").find("span").text("导出")
                    }, 3e3)) : t.alert(0, e.message)
                }
            }) : t.alert(0, "请先选择要导出的日期")
        },
        loading: function(e) {
            var t = "";
            6 == e && (t = "正在加载中，请稍后..."),
            ZENG && ZENG.msgbox.show(t, e, 2e3)
        },
        update: function(e, t) {
            var a = "";
            6 == e && (a = t),
            ZENG && ZENG.msgbox.show(a, e, 2e3)
        },
        safariCacheReload: function() {
            window.onpageshow = function(e) {
                e.persisted && window.location.reload()
            }
        },
        easeOutAnimation: function(e, t, a) {
            if (e != t && "number" == typeof e) {
                var n = document.body.scrollTop ? document.body : document.documentElement;
                t = t || 0,
                a = a || 2;
                !function i() {
                    (e += (t - e) / a) < 1 ? n.scrollTop = 0 : (n.scrollTop = e,
                    requestAnimationFrame(i))
                }()
            }
        },
        setLocationAdd2Cookie: function(e) {
            var t = (e = e || []).length
              , a = {
                expires: 7,
                path: "/"
            };
            if (t > 0)
                for (var n = 0; n < t; n++) {
                    var i = e[n]
                      , r = i.name
                      , o = i.value
                      , c = $.cookie(r);
                    r && o && c != o && ($.cookie(r, "", {
                        expires: -1
                    }),
                    $.cookie(r, o, a))
                }
        },
        wordLimit: function(e, a) {
            for (var n = $(e), i = a || 500, r = 0; r < n.length; r++) {
                var o = $(n[r])
                  , c = o.parent()
                  , l = o.attr("maxlength") || i
                  , s = o.val().slice(0, l)
                  , d = '<div class="J-limitFontNum" style="float: right;bottom:-10px;">' + t.htmlEncode(s).length + "/" + l + "</div>";
                !c.find(".J-limitFontNum").length && o.attr("maxlength") && (o.val(s),
                c.append(d))
            }
        },
        wordLimitChange: function(e) {
            e.preventDefault && e.preventDefault(),
            e.stopPropagation && e.stopPropagation();
            var a = t.isDom(e) ? e : $(e.currentTarget)
              , n = a.attr("maxlength")
              , i = a.parent().find(".J-limitFontNum")
              , r = a.val()
              , o = t.htmlEncode(r || "");
            r = o.length > n ? r.slice(0, n - o.length) : r,
            a.val(r),
            n && i.length && i.html(t.htmlEncode(r).length + "/" + n)
        },
        getPromiseAjax: function() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
            return $.isEmptyObject(e) ? (t.alert(0, "参数错误"),
            t.log("ajax参数错误"),
            !1) : e.url ? new Promise(function(t, a) {
                $.ajax({
                    url: e.url,
                    type: e.type || "post",
                    data: e.data,
                    dataType: "json",
                    success: function(n) {
                        n.success ? (e.successfn && e.successfn(),
                        t(n)) : a(n.message)
                    },
                    error: function(t) {
                        void 0 !== e.errorfn && e.errorfn(t)
                    }
                })
            }
            ) : (t.alert(0, "url不能为空"),
            t.log("url不能为空"),
            !1)
        },
        htmlEncode: function(e) {
            return e.replace(/&/g, "&amp;").replace(/"/g, "&quot;").replace(/'/g, "&#39;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, "\n\r")
        },
        isDom: function(e) {
            return e && "object" === (void 0 === e ? "undefined" : _typeof(e)) && e[0] && 1 === e[0].nodeType && "string" == typeof e[0].nodeName
        },
        fillAge: function(e, t) {
            var a = $(e)
              , n = $(t).val()
              , i = new Date;
            if ("Invalid Date" == new Date(n) || i < new Date(n))
                return !1;
            var r = (i - new Date(n)) / 31536e6;
            r < 1 ? a.val("0岁").blur() : a.val(Math.floor(r) + "岁").blur()
        },
        fillBirthday: function(e, t) {
            var a = $(e)
              , n = $(t)
              , i = parseInt(a.val(), 10)
              , r = (new Date).getFullYear() - i;
            if (isNaN(parseFloat(i)))
                return !1;
            n.val(r + "-01-01").blur()
        },
        getFamilyObj: function() {
            return {
                101: 1,
                102: 2,
                103: "",
                104: 1,
                105: 2,
                106: "",
                107: "",
                108: "",
                109: "",
                110: "",
                111: ""
            }
        },
        initMask: function(e) {
            if (e)
                for (var t in e)
                    $(t).mask(e[t])
        },
        replaceUnknowMsg: function(e) {
            return "【收到不支持的消息类型，暂无法显示】" == e.content && (e.content = "对方发了个自定义的表情"),
            e
        },
        search: function(e, t) {
            return t = t || 400,
            _(function(t) {
                e(t, this)
            }).debounce(t)
        },
        escapeHTML: function(e) {
            return (e = "" + e).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&apos;")
        },
        unescapeHTML: function(e) {
            return (e = "" + e).replace(/&lt;/g, "<").replace(/&gt;/g, ">").replace(/&amp;/g, "&").replace(/&quot;/g, '"').replace(/&apos;/g, "'")
        },
        setHashToEl: function(e, t) {
            if (void 0 !== (void 0 === e ? "undefined" : _typeof(e)) && e && void 0 !== (void 0 === t ? "undefined" : _typeof(t)) && t) {
                var a = null;
                $.each(t || {}, function(t, n) {
                    decodeURIComponent(n) == GPP.Null && (n = ""),
                    (a = e.find('[name="' + t + '"]')).length && ("input" == a[0].tagName.toLowerCase() && "text" == a.attr("type") || "select" == a[0].tagName.toLowerCase()) && a.val(decodeURIComponent(n))
                })
            }
        },
        filterPrintTpl: function(e) {
            return (e || "").replace(/\\"/g, "&quot;").replace(/\\&quot;/g, "&quot;").replace(/%3C/g, "<").replace(/%3E/g, ">").replace(/%20/g, " ")
        },
        char2HtmlChar: function(e) {
            return this.escapeHTML(e || "").replace(/\r\n/g, "<br/>").replace(/\n/g, "<br/>").replace(/ /g, "&nbsp;")
        },
        setCookie: function(e, t) {
            var a = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 3e5;
            return $.cookie(e, t, {
                expires: new Date((new Date).getTime() + a)
            })
        },
        getCookie: function(e) {
            return $.cookie(e)
        },
        checkIsInUnion: function() {
            return ["dxy", "jhmd", "hndxyy", "ydgh", "mhyl", "lnxc", "gyt", "bhjk", "hazs", "shqk", "ljf", "ssxc", "jzsy", "xsgyg", "jczs", "axmzb", "zzmz", "hcj", "jhmzb", "skek", "cyg", "tyzs", "sgrzy", "ggk", "zst", "alhy", "renxin168", "fszy", "spbthf", "ljzs", "hfgk", "ng", "hst", "esydd", "qjzy", "djs", "ysn", "rht", "kyt", "pazs"].includes(CURRENT_UNION_URI.toLowerCase())
        },
        noticeChangePassDate: ["03-19", "06-19", "09-19", "12-19"],
        caseFields: [{
            key: 1,
            label: "发病日期",
            required: !0
        }, {
            key: 2,
            label: "主诉",
            required: !0
        }, {
            key: 3,
            label: "现病史",
            required: !0
        }, {
            key: 4,
            label: "既往史",
            required: !0
        }, {
            key: 5,
            label: "过敏史",
            required: !0
        }, {
            key: 6,
            label: "个人史",
            required: !0
        }, {
            key: 7,
            label: "家族史",
            required: !0
        }, {
            key: 8,
            label: "疫苗接种史",
            required: !0
        }, {
            key: 9,
            label: "实验室及辅助检查",
            required: !0
        }, {
            key: 10,
            label: "体格检查",
            required: !0
        }, {
            key: 11,
            label: "初步诊断",
            required: !0
        }, {
            key: 12,
            label: "四诊",
            required: !1
        }, {
            key: 13,
            label: "中医诊断",
            required: !1
        }, {
            key: 14,
            label: "治疗意见",
            required: !0
        }, {
            key: 15,
            label: "文件",
            required: !0
        }, {
            key: 16,
            label: "备注",
            required: !0
        }, {
            key: 17,
            label: "月经及婚育史",
            required: !0
        }]
    };
    setTimeout(function() {
        var e = $('[data-toggle="tooltip"]');
        e.length && e.tooltip()
    }, 1500);
    var a = window.location.hash;
    if ("" !== a && !a.match(/\//)) {
        3 == a.split("#").length && (a = a.substring(1, a.length),
        location.hash = a);
        try {
            a = encodeURIComponent(a)
        } catch (e) {}
        $('[data-toggle="tab"][href="' + a + '"]').tab("show"),
        $("body").scrollTop(0)
    }
    return $("body").on("click", '[data-toggle="tab"]', function() {
        var e = $(this).attr("href");
        window.location.hash = "#" + e
    }),
    1 == localStorage.getItem("v_clinic_isbasic") && $(".J-mobile-report-tab").remove(),
    location.href.indexOf("/Admin/") < 0 && (t.da("clinic", "click_doctor_panel", "", "#doctor_control a", "click"),
    t.da("clinic", "click_reservation", "", "#reservation a", "click"),
    t.da("clinic", "click_patient_checkin", "", "#checkin a", "click"),
    t.da("clinic", "click_clinic", "", "#clinic a", "click"),
    t.da("clinic", "click_triage", "", "#triage a", "click"),
    t.da("clinic", "click_inspect", "", "#inspect a", "click"),
    t.da("clinic", "click_checking", "", "#checking a", "click"),
    t.da("clinic", "click_cure", "", "#cure a", "click"),
    t.da("clinic", "click_report", "", "#reports a", "click"),
    t.da("clinic", "click_pharmacy", "", "#pharmacy a", "click"),
    t.da("clinic", "click_wechat", "", "#wechat a", "click"),
    t.da("clinic", "click_material", "", "#material a", "click"),
    t.da("clinic", "click_patientdb", "", "#patientdb a", "click"),
    t.da("clinic", "clinic_points", "", "#pointsManage a", "click"),
    t.da("clinic", "click_schedule", "", "#schedule a", "click"),
    t.da("clinic", "click_charge", "", "#charge a", "click"),
    t.da("clinic", "click_retail", "", "#drugView a", "click"),
    t.da("clinic", "click_follow", "", "#follow a", "click"),
    t.da("clinic", "click_admin", "", "#User a", "click")),
    setTimeout(function() {
        if (0 == location.pathname.indexOf("/Clinic/") || 0 == location.pathname.indexOf("/Admin/")) {
            var e = function() {
                var e = n.find("form")
                  , a = e.find(".J-user-password").val()
                  , i = e.find(".J-user-repassword").val();
                return a && i ? a !== i ? (t.alert(0, "请重新检查，密码不一致"),
                !1) : void t.getAjaxData({
                    url: "/japi/session/100032",
                    type: "post",
                    data: e.serializeArray(),
                    successfn: function(e) {
                        e.success ? (t.alert(1, "修改成功"),
                        localStorage.setItem("hasChangePass", "true"),
                        n.modal("hide")) : (t.alert(0, e.message),
                        t.log(e))
                    }
                }) : (t.alert(0, "请填写完整"),
                !1)
            }
              , a = function() {
                "false" === localStorage.getItem("hasChangePass") && localStorage.removeItem("hasChangePass", "true")
            }
              , n = $("#globalChangePassModal")
              , i = (new Date).Format("MM-dd")
              , r = localStorage.getItem("hasChangePass");
            t.noticeChangePassDate.includes(i) && "false" == r && (n.modal("show"),
            n.find('input[type="password"]').val(""),
            $("body").on("click", "#globalChangePassModal .J-change-pass-sub", e).on("hide.bs.modal", "#globalChangePassModal", a))
        }
    }, 1e3),
    function() {
        var t = $("li#reports a");
        if (t.length) {
            var a = window.PERMISSIONANDMODULES.permissions;
            e(["48", "49", "50", "51", "52", "53", "60", "61"], a) ? t.attr("href", "/Clinic/Report/menu.html") : e(["42", "43", "44", "47", "55", "9004", "58", "59", "68", "69", "89", "90"], a) ? t.attr("href", "/Clinic/Report/reportMedical.html") : e(["62", "63", "64", "65", "66", "67"], a) ? t.attr("href", "/Clinic/Report/reportJxc.html") : e(["45", "46", "56", "57", "91", "92", "93"], a) ? t.attr("href", "/Clinic/Report/reportOperate.html") : e(["73"], a) && t.attr("href", "/Clinic/Report/reportMobile.html")
        }
    }(),
    t
}),
define("json2csv", function() {}),
define("report_day", ["common/global", "json2csv"], function(e) {
    var t = {
        name: "姓名",
        clinicId: "门诊号",
        price: "应收金额",
        realPrice: "折后金额",
        total: "实收金额",
        cash: "现金",
        pos: "银行卡",
        wx_pub_qr: "微信",
        alipay_qr: "支付宝",
        points_reduce: "积分抵扣",
        membecard_pay: "余额支付",
        medicare_pay: "医保支付",
        commercial_pay: "商保支付",
        loan: "挂账",
        cardReduce: "卡券",
        chargeReduce: "减免",
        insurance_reason: "备注",
        chargeTime: "日期",
        chargetor: "操作人员",
        doctor: "接诊医生"
    }
      , a = {
        name: "姓名",
        clinicId: "门诊号",
        admission: "诊疗费",
        recipe: "药费",
        inspect: "实验室检查",
        check: "辅助检查",
        cure: "治疗",
        goods: "材料",
        other: "其他",
        total: "合计",
        chargeTime: "收费时间",
        chargetor: "收费人员",
        doctor: "接诊医生"
    }
      , n = window.PERMISSIONANDMODULES.modules;
    n.indexOf(33) < 0 && delete t.membecard_pay,
    n.indexOf(10) < 0 && delete a.other,
    n.indexOf(13) < 0 && delete a.inspect,
    n.indexOf(14) < 0 && delete a.check,
    n.indexOf(15) < 0 && delete a.cure,
    n.indexOf(20) < 0 && delete a.goods;
    var i = _.keys(t)
      , r = _.keys(a);
    new GM.LIST_APP({
        defaults: {
            getURL: global_japi + "/704020",
            list_wrap_id: "#J-reportday-list-wrap",
            model_tpl_id: "#reportday-list-tpl",
            page_wrap: !1,
            list_args: ["patient_name", "start_date", "end_date", "cash_name", "type", "channel", "page"],
            hash_history: 0
        },
        model_defaults: {
            name: "",
            clinicId: "",
            orderId: "",
            price: "",
            realPrice: "",
            cash: "",
            pos: "",
            wx_pub_qr: "",
            alipay_qr: "",
            points_reduce: "",
            cardReduce: "",
            chargeReduce: "",
            membecard_pay: "",
            medicare_pay: "",
            commercial_pay: "",
            loan: "",
            insurance_reason: "",
            total: "",
            channel: "",
            chargeTime: "",
            chargetor: "",
            doctor: "",
            hasDetail: !0,
            detailType: "clinic",
            points_reduce_sum: ""
        },
        modelView_defaults: function() {
            this.tagName = "tr"
        },
        mainView_defaults: function() {
            var t = this;
            t.el = $("#reportDay"),
            t.events = {
                "change .J-start-date": "resetSearch",
                "change .J-end-date": "resetSearch",
                "change .J-charge-type": "resetSearch",
                "change .J-type": "resetSearch",
                "blur .J-patient-name": "resetSearch",
                "blur .J-cash-name": "resetSearch",
                "click .J-search-submit": "resetSearch",
                "change .J-channel": "resetSearch",
                "click .J-type": "showPayMethod"
            },
            t.showPayMethod = function(e) {
                var t = $(e.currentTarget).val()
                  , a = $(".J-pay-method-block");
                1 == t ? a.removeClass("hidden") : 2 == t && (a.addClass("hidden"),
                a.find("select.J-channel").val(""))
            }
            ,
            t.resetSearch = function(t) {
                var a = this
                  , n = a.$el.find(".J-charge-date")
                  , i = $(t.currentTarget)
                  , r = a.$el.find(".J-start-date").val()
                  , o = a.$el.find(".J-end-date").val()
                  , c = a.$el.find(".J-patient-name").val()
                  , l = a.$el.find(".J-cash-name").val()
                  , s = a.$el.find(".J-channel").val()
                  , d = a.$el.find(".J-type:checked").val();
                if ($.cookie("report_day_patient_name", c, {
                    expires: new Date((new Date).getTime() + 3e5)
                }),
                $.cookie("report_day_cash_name", l, {
                    expires: new Date((new Date).getTime() + 3e5)
                }),
                $.cookie("report_day_channel", s, {
                    expires: new Date((new Date).getTime() + 3e5)
                }),
                $.cookie("report_day_type", d, {
                    expires: new Date((new Date).getTime() + 3e5)
                }),
                r && !o || !r && o) {
                    return "start_date" != i.attr("name") && e.alert(0, "日期必须两个都填写"),
                    !1
                }
                if (e.checkIsInUnion()) {
                    if ((new Date(o) - new Date(r)) / 864e5 > 90)
                        return e.alert(0, "年底数据查询量大且频繁为避免系统重启，查询时间不能超过90天，如需导出1年数据请提前1-2天联系实施"),
                        !1
                }
                if (o < r)
                    return e.alert(0, "日期结束时间必须大于开始时间"),
                    !1;
                if (r && o) {
                    var p = new Date(r)
                      , m = new Date(o);
                    p.getFullYear() == m.getFullYear() ? n.text(p.Format("yyyy年MM月dd日") + " - " + m.Format("MM月dd日")) : n.text(p.Format("yyyy年MM月dd日") + " - " + m.Format("yyyy年MM月dd日"))
                } else
                    n.text("");
                var u = {}
                  , f = a.$el.find("#J-report-form")
                  , h = f.find("input")
                  , g = f.find("select");
                $.each(h, function(e, t) {
                    var a = $(t);
                    ("radio" != a.attr("type") || "radio" == a.attr("type") && a.prop("checked")) && (u[a.attr("name")] = a.val() || GPP.Null)
                }),
                $.each(g, function(e, t) {
                    var a = $(t);
                    u[a.attr("name")] = a.val() || GPP.Null
                }),
                a.options = $.extend(a.options, u),
                a._getLst()
            }
            ,
            t.initSearchInput = function() {
                var e = $.cookie("report_day_patient_name") || ""
                  , t = $.cookie("report_day_cash_name") || ""
                  , a = $.cookie("report_day_channel") || ""
                  , n = $.cookie("report_day_type") || 1
                  , i = $(".J-pay-method-block");
                1 == n ? i.removeClass("hidden") : 2 == n && (i.addClass("hidden"),
                i.find("select.J-channel").val("")),
                this.el.find(".J-patient-name").val(e),
                this.el.find(".J-cash-name").val(t),
                this.el.find(".J-channel").val(a),
                this.el.find(".J-type").eq(1 * n - 1).prop("checked", !0)
            }
            ,
            t.initDate = function() {
                var a = (new Date).Format("yyyy-MM-dd")
                  , n = t.el.find(".J-start-date")
                  , i = t.el.find(".J-end-date")
                  , r = $.cookie("report_day_start_date") || a
                  , o = $.cookie("report_day_end_date") || a
                  , c = (new Date(o) - new Date(r)) / 864e5;
                e.checkIsInUnion() && c > 90 && (r = a,
                o = a),
                n.val(r),
                i.val(o),
                t.el.find(".J-charge-date").text(new Date(r).Format("yyyy年MM月dd日") + " - " + new Date(o).Format("MM月dd日")),
                e.initDate(n, "date", {
                    maxDate: new Date,
                    onSelect: function(e) {
                        $.cookie("report_day_start_date", e, {
                            expires: new Date((new Date).getTime() + 3e5)
                        })
                    }
                }),
                e.initDate(i, "date", {
                    maxDate: new Date,
                    onSelect: function(e) {
                        $.cookie("report_day_end_date", e, {
                            expires: new Date((new Date).getTime() + 3e5)
                        })
                    }
                })
            }
            ,
            t.initDate(),
            t.initSearchInput()
        },
        fn: {
            addOne_before_fn: function(e, t) {
                return t.curShowType = this.$el.find(".J-type:checked").val(),
                "CASH" == t.card_type && (t.card_type = "代金券"),
                t
            },
            init_getLstBefore_fn: function(e) {
                e.options.start_date = e.$el.find(".J-start-date").val(),
                e.options.end_date = e.$el.find(".J-end-date").val(),
                e.options.type = e.$el.find(".J-type:checked").val(),
                e.options.channel = $.cookie("report_day_channel"),
                e.options.patient_name = $.cookie("report_day_patient_name"),
                e.options.cash_name = $.cookie("report_day_cash_name")
            },
            getAjaxResponse_fn: function(e) {
                var n = e.data
                  , o = this.$el.find("#J-report-form")
                  , c = this.$el.find("#J-reportday-list-title")
                  , l = o.find(".J-type:checked").val()
                  , s = o.find("select")
                  , d = [];
                1 == l ? c.html(_.template($("#J-reportday-recharge-method").html(), {})) : c.html(_.template($("#J-reportday-recharge-type").html(), {})),
                d.push(this.$el.find(".J-charge-date").text().replace(/\s+/g, "") + " 收费日报报表"),
                $.each($(".J-download-info"), function(e, t) {
                    var a = $(t);
                    "" !== a.val() && d.push(a.val())
                }),
                d.push(1 == l ? "按收费方式" : "按收费分类"),
                $.each(s, function(e, t) {
                    var a = $(t);
                    "" !== a.val() && d.push(a.find("option:selected").text())
                }),
                n && n.length && (n.splice(0, 0, 1 == l ? t : a),
                JSONToCSVConvertor(n, d.join("--"), !1, "export-day", "xls", 1 == l ? i : r),
                e.data.splice(0, 1))
            },
            getAjaxFailure_fn: function(t) {
                var a = this.$el.find("#J-reportday-list-title");
                1 == this.$el.find(".J-type:checked").val() ? a.html($("#J-reportday-recharge-method").html()) : a.html($("#J-reportday-recharge-type").html()),
                this.$el.find("#J-reportday-list-wrap").html(""),
                this.initDate(),
                e.alert(0, t.message),
                e.log(t)
            }
        }
    })
});
