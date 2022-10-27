function Exit(){KesionJS.Confirm("确定退出系统吗?","http://kv6.user.kesion.com/admin/include/location.href='Index.aspx?Action=Logout';",null); }
var box=null;
var isreload=false;
function openWin(title,url,reload,width,height){ 
      if (width==null) width=760;
      if (height == null) height = 450;
	  isreload=reload;
	  box=$.dialog.open(url,{ id:'topbox',lock: true, title: title, width: width, height: height, close: function() {
       if (isreload) {
          top.frames['main'].location.reload();
          }
      }
      });
}
   
function rz() {
    //调整宽和高
    $(".main").height($(window).height() - $(".mainHeader").height());
    $("#main").height($(window).height() - $(".mainHeader").height());
}
$(function() {
			
        rz();
        $(window).resize(function () {
            rz();
        });

        //关于
        $('.topnav li').hover(function () {
            $(this).children('ul').stop(true, true).show();
        }, function () {
            $(this).children('ul').stop(true, true).hide();
        });




        //顶部菜单
        $('.menu-two  > li > a').click(function (i) {
            $('.menu-two  > li > a').removeClass("curr");
            $(this).addClass("curr");
        });
        $('.pane > .icons > a').click(function (i) {
            $('.pane > .icons > a').removeClass("curr");
            $(this).addClass("curr");
        });
		
        $('.topnav li').click(function (i) {
			var i = $(this).index();
            $(this).addClass("curr").siblings("li").removeClass("curr");
			$(".navBar li:eq("+i+")").addClass("on").siblings("li").removeClass("on");
            $(".rightnav .content:eq("+i+")").fadeIn(300).siblings(".content").hide();
            if (isCloseLeft) closeLeft();
        });
		$(".navBar li").click(function(){
			var i = $(this).index();
			$(".topnav li:eq("+i+")").addClass("curr").siblings("li").removeClass("curr");
			$(".rightnav .content:eq("+i+")").fadeIn(300).siblings(".content").hide();
			$(this).addClass("on").siblings("li").removeClass("on");
		});
		
		
        //左边菜单
//        $(".leftmain div.content").each(function () {
//            var index = $(this).index();
//            var aMenuOneLi = $("#left" + index + " .menu-one > li");
//            var aMenuTwo = $("#left" + index + " .menu-two");
//            $("#left" + index + " .menu-one > li > .header").each(function (i) {
//                $(this).click(function () {
//                    if ($(aMenuTwo[i]).css("display") == "block") {
//                        $(aMenuTwo[i]).slideUp(100);
//                        $(aMenuOneLi[i]).addClass("menu-show")
//                    } else {
//                        for (var j = 0; j < aMenuTwo.length; j++) {
//                           // $(aMenuTwo[j]).slideUp(100);
//                           // $(aMenuOneLi[j]).removeClass("menu-show");
//                        }
//                        $(aMenuTwo[i]).slideDown(100);
//                        $(aMenuOneLi[i]).removeClass("menu-show")
//                        
//                    }
//                });
//            });
//        });
		

    });
 var isCloseLeft = false;
function closeLeft() {
        if (isCloseLeft == false) {
            $("#closeBtn").attr("class", "left_frame_close");
            $(".rightnav").hide();
            $(".rightmain").width($(window).width()-$(".topnav").width()-20);
            isCloseLeft = true;
        }
        else {
            $("#closeBtn").attr("class", "left_frame_open");
            $(".rightnav").show();
            $(".rightmain").width($(window).width() - $(".leftmain").width()-21);
            isCloseLeft = false;

        }

 }   



function SubMenu(module, num) {
    $("#" + module + "_submenu_" + num).toggle();
	$("#" + module + "_submenu_" + num).siblings('.header').toggleClass('curr');
}
function showPlan(d) {
     openWin("查看["+d+"]工作计划", "User/KS.AdminPlan.aspx?action=show&date="+d,false, 820, 450);
 }
   
   
   
var isLoadField=false;
function loadModelField(){
    if (isLoadField==false){
        jQuery("#showfield").html("<img src='../admin/images/loading.gif'/*tpa=http://kv6.user.kesion.com/admin/admin/images/loading.gif*/ />加载中...");
        jQuery.get('http://kv6.user.kesion.com/admin/plus/ajaxs.ashx',{a:"getmodelfieldmanage"},function(r){
           jQuery("#showfield").html(r);
           isLoadField=true;
        });
    }
   }

function fHideFocus(tName){
		aTag=document.getElementsByTagName(tName);
		for(i=0;i<aTag.length;i++)aTag[i].onfocus=function(){this.blur();};
}
fHideFocus("A");

var checkPerSecond=120; //120秒检测一次
var checkInterval=null;
jQuery(document).ready(function() {

 if (showtips=='true'){ 
	 checkMsg();
	 checkInterval=setInterval("checkMsg();", 1000*checkPerSecond); }
});﻿

function stopInterval(){
    clearInterval(checkInterval);
}
function checkMsg(){
	$.ajax({type:"get",async:false,url:"../plus/Ajaxs.ashx?a=admincheckmsg&anticache=" + Math.floor(Math.random()*1000),cache:false,dataType:"html",success:function(d){
  if (d!=''){																																								   var mytips=$.dialog.notice({
		title: '消息提示',
		width: 320,  /*必须指定一个像素宽度值或者百分比，否则浏览器窗口改变可能导致lhgDialog收缩 */
		height: 150,
		padding:"0px",
		max: false,
		min: false,
		content: 'loading...',
		time: 1200
	});
	mytips.content("<div class='sliupmsgtips'><ul>"+d+"</ul></div><div style='text-align:right'><label><input type='checkbox' onclick='stopInterval()'>不再提示</label></div>");
  }
																																									 }});
	
	
}

/* 扩展窗口外部方法 */
$.dialog.notice = function(options) {
        var opts = options || {},
        api, aConfig, hide, wrap, top,
        duration = opts.duration || 800;

        var config = {
            id: 'Notice',
            left: '100%',
            top: '100%',
            fixed: true,
            drag: false,
            resize: false,
            init: function(here) {
                api = this;
                aConfig = api.config;
                wrap = api.DOM.wrap;
                top = parseInt(wrap[0].style.top);
                hide = top + wrap[0].offsetHeight;

                wrap.css('top', hide + 'px')
            .animate({ top: top + 'px' }, duration, function() {
                opts.init && opts.init.call(api, here);
            });
            },
            close: function(here) {
                wrap.animate({ top: hide + 'px' }, duration, function() {
                    opts.close && opts.close.call(this, here);
                    aConfig.close = $.noop;
                    api.close();
                });

                return false;
            }
        };

        for (var i in opts) {
            if (config[i] === undefined) config[i] = opts[i];
        }

        return $.dialog(config);
};

//组图预览
$(document).ready(function () {
    $("a[rel^='prettyPhoto']").prettyPhoto();
});
//a链接加 rel='prettyPhoto' href为图片地址
function initialPrettyPhoto() {
    $(window.frames["main"].document).find("a[rel^='prettyPhoto']").prettyPhoto();
}
//格式 1.jpg|2.jpg
function initialPrettyPhotoPicStr(str) {
    var arr = str.split('|');
    var api_images = new Array();
    for (var i = 0; i < arr.length; i++) {
        api_images[i] = arr[i];
    }
    $.prettyPhoto.open(api_images);
}