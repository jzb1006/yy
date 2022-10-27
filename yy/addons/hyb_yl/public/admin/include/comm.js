$(function() {

		$(".content-area").each(function() {
			var footPage = $(this).find("div").hasClass("footer_page");
			var footButton = $(this).find("div").hasClass("main-button");
			if(footPage==true){
				$(this).addClass('pageBlank');
			};
			if(footButton==true){
				$(this).addClass('footBlank');
			}
		});
		
		$(".property").hover(function(){
			$(this).find(".propertyBox").show();
			
		},function(){
			$(this).find(".propertyBox").hide();
        });

       initialSearchForm();   //初始化搜索表单
		

});


//搜索表单初始化
function initialSearchForm() {
    $("#btnsearch").click(function () {
        form = $("<form></form>")
        form.attr('action', '?')
        form.attr('method', 'get')
        $(".search").each(function () {
            form.append($(this));
        })
        form.appendTo("body")
        form.submit();

        //var sectionData = $(".search").serialize();
        //alert(sectionData);
        //return false;
    });
    $(".search").each(function () {
        var name = $(this).attr("name");
        var v = getUrlVal(name);
        if (v != null) {
            var type = $(this).attr("type");
            if (type == "radio") {
                if ($(this).val() == v) {
                    $(this).attr("checked", true);
                }
            } else if (type == "checkbox") {
                //alert(v);
                if (v.indexOf($(this).val(), ",") != -1) {
                    $(this).attr("checked", true);
                }
            } else {
                $(this).val(v);
            }
        }
    });
}

function getUrlVal(para) {
    var search = location.search; //页面URL的查询部分字符串
    var arrPara = new Array(); //参数数组。数组单项为包含参数名和参数值的字符串，如“para=value”
    var arrVal = new Array(); //参数值数组。用于存储查找到的参数值

    if (search != "") {
        var index = 0;
        search = search.substr(1); //去除开头的“?”
        arrPara = search.split("&");

        for (i in arrPara) {
            var paraPre = para + "="; //参数前缀。即参数名+“=”，如“para=”
            if (arrPara[i].indexOf(paraPre) == 0 && paraPre.length < arrPara[i].length) {
                arrVal[index] = decodeURI(arrPara[i].substr(paraPre.length)); //顺带URI解码避免出现乱码
                index++;
            }
        }
    }

    if (arrVal.length == 1) {
        return arrVal[0];
    } else if (arrVal.length == 0) {
        return null;
    } else {
        return arrVal;
    }
}

function doNone(evt) {
    var e = (evt) ? evt : window.event; //判断浏览器的类型，在基于ie内核的浏览器中的使用cancelBubble
    if (window.event) {
        e.cancelBubble = true;
    } else {
        e.stopPropagation();
    }
}
