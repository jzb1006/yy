define("report", [], function() {
    "use strict";
    var e = $(".J-toggle-tabs").find("a:not(.module-hide)")[0]
      , r = window.PERMISSIONANDMODULES.permissions
      , t = !1;
    $.each(["48", "49", "50", "51", "52", "53", "60", "61", "95"], function(e, a) {
        if (r.indexOf(a) > -1)
            return t = !0,
            !1
    }),
    e.click(),
    !t && $(".J-report-tabs").find("li:not(.module-hide) a")[0].click();
    var a = $(".J-toggle-tabs a[data-toggle=tab]")
      , o = ""
      , p = "#" + $(e).attr("href");
    switch (location.hash = p,
    p) {
    case "#reportDayMoney":
    case "##reportDayMoney":
        require(["report_money"]);
        break;
    case "#reportMonth":
    case "##reportMonth":
        require(["report_month"]);
        break;
    case "#reportDetail":
    case "##reportDetail":
        require(["report_detail"]);
        break;
    case "#reportCategory":
    case "##reportCategory":
        require(["report_category"]);
        break;
    case "#reportMethod":
    case "##reportMethod":
        require(["report_method"]);
        break;
    case "#reportRecharge":
    case "##reportRecharge":
        require(["report_recharge"]);
        break;
    case "#reportMemberCard":
    case "##reportMemberCard":
        require(["report_card"]);
        break;
    case "#reportUnpayInfo":
    case "##reportUnpayInfo":
        require(["report_unpay"]);
        break;
    case "#appointFee":
    case "##appointFee":
        require(["report_reservation_fee"]);
        break;
    default:
        require(["report_day"])
    }
    a.on("shown.bs.tab", function(e) {
        var r = $(e.currentTarget).attr("href");
        switch (a.removeClass("active"),
        $(".J-toggle-tabs").find('a[href="' + r + '"]').addClass("active"),
        r) {
        case "#reportDayMoney":
        case "##reportDayMoney":
            require(["report_money"]);
            break;
        case "#reportMonth":
        case "##reportMonth":
            require(["report_month"]),
            o = "report_month";
            break;
        case "#reportDetail":
        case "##reportDetail":
            require(["report_detail"]),
            o = "report_detail";
            break;
        case "#reportCategory":
        case "##reportCategory":
            require(["report_category"]),
            o = "report_category";
            break;
        case "#reportMethod":
        case "##reportMethod":
            require(["report_method"]),
            o = "report_method";
            break;
        case "#reportRecharge":
        case "##reportRecharge":
            require(["report_recharge"]),
            o = "report_recharge";
            break;
        case "#reportMemberCard":
        case "##reportMemberCard":
            require(["report_card"]),
            o = "report_member_card";
            break;
        case "#reportUnpayInfo":
        case "##reportUnpayInfo":
            require(["report_unpay"]),
            o = "report_unpay_info";
            break;
        case "#appointFee":
        case "##appointFee":
            require(["report_reservation_fee"]);
            break;
        default:
            require(["report_day"]),
            o = "report_day"
        }
        o && "function" == typeof _daTrackEvent && _daTrackEvent("clinic", "click_report", o, JSON.stringify({
            union_uri: window.localStorage.getItem("dxy_institution_code"),
            shop_id: window.localStorage.getItem(localStorage.getItem("dxy_institution_code") + "_shop_id")
        }))
    })
});
