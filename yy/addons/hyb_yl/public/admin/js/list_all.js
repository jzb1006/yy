$(function() {
var url=window.location.href;
console.log(url)
 $(".pian_gai_lun_box_img_div").click(function(){
        $(this).parent().remove()
    })
    $('.form1').submit(function(){
        if($(":checkbox[name='deleteall[]']:checked").size() > 0){
            return confirm('删除后不可恢复，您确定删除吗？');
        }
        return false;
    });
    // 勾选
    $(".gai_yaopin_lis_select_xuanze").click(function(){
        var num = $(this).attr("data-zt");

        if(num == "0"){
            $(this).attr("data-zt","1").addClass("color_span");
        }else{
            $(this).attr("data-zt","0").removeClass("color_span");
        }
    })

    $("document").ready(function(){
    var inputs = $("#stuName").children("input");
    var values = new Array();
    // 全选
    $("#checkAll").click(function(){
            // 全选按钮变色            
             $(".gai_yaopin_lis_select_xuanze").attr("data-zt","1").addClass("color_span");
            var str=$(this).parents('.panel-body').find('.gai_yaopin_lis_lis').find('.gai_yaopin_lis_odd').text()
            var str1=str.replace(/\s+/g, "")
            var str2=str1.split(',')
            str2.splice(-1,1)
            var values=str2
        });
   });
   
    // 取消
    $(".gai_yaopin_delete_quxiao").click(function(){
        $(".gai_yaopin_lis_select_xuanze").attr("data-zt","0").removeClass("color_span");
    })
    // 删除
    $(".gai_yaopin_delete_delete").click(function(){
        var str=$(this).parents('.panel-body').find(".color_span").parents('.gai_yaopin_lis_lis').find('.gai_yaopin_lis_odd').text()
        var str1=str.replace(/\s+/g, "")
            var str2=str1.split(',')
            str2.splice(-1,1)
            var values=str2
       $.ajax({  
            type: "POST",  
            url: url,  
            dataType: "json",  
            cache:false, 
            data: {values:values,type:'del'},  
            success: function(json){  
                window.location.href="";

            }
        });
        $(".gai_yaopin_lis_select_xuanze").removeClass("color_span");
        
        for(var i = 0;i<$(".gai_yaopin_lis_select_xuanze").length;i++){
            if($(".gai_yaopin_lis_select_xuanze").eq(i).attr("data-zt") == 1){
                $(".gai_yaopin_lis_select_xuanze").eq(i).parent().parent().css("display","none");
            }
        }
    })
    // 类表中的删除按钮
    $(".gai_delete").click(function(){
          var id =$(".gai_delete")[0].id
          var flag = confirm("确定删除吗?");
          if(flag){
             $.ajax({
                type:'POST',
                url: url, 
                dataType:'json',
                data:{id:id,type:'del_one'},
                 success: function(json){  
                
                }
             })
             $(this).parent().parent().parent().css("display","none");
            }else{
                
            }

       
    })

    //上架
    $('.gai_yaopin_delete_shenhe').click(function(){

     var str=$(this).parents('.panel-body').find('.color_span').parents('.gai_yaopin_lis_lis').find('.gai_yaopin_lis_odd').text();
        if(str==''){
            alert('必须选择一个或多个！')
            return;
        }else{
         var str=$(this).parents('.panel-body').find(".color_span").parents('.gai_yaopin_lis_lis').find('.gai_yaopin_lis_odd').text()
                var str1=str.replace(/\s+/g, "")
                    var str2=str1.split(',')
                    str2.splice(-1,1)
                    var values=str2
                    console.log(values)
               
               $.ajax({  
                    type: "POST",  
                    url: url,  
                    dataType: "json",  
                    cache:false, 
                    data: {values:values,type:'ups'},  
                    success: function(json){  
                       window.location.href="";

                    }
                }); 
        }
       
    })
    // 推荐
        $('.gai_yaopin_delete_tuijina').click(function(){
         var str=$(this).parents('.panel-body').find('.color_span').parents('.gai_yaopin_lis_lis').find('.gai_yaopin_lis_odd').text();
            if(str==''){
                alert('必须选择一个或多个！')
                return;
            }else{
                var str=$(this).parents('.panel-body').find(".color_span").parents('.gai_yaopin_lis_lis').find('.gai_yaopin_lis_odd').text()
                var str1=str.replace(/\s+/g, "")
                    var str2=str1.split(',')
                    str2.splice(-1,1)
                    var values=str2
                 $.ajax({  
                    type: "POST",  
                    url: url,  
                    dataType: "json",  
                    cache:false, 
                    data: {values:values,type:'rec'},  
                    success: function(json){  
                        window.location.href="";

                    }
                });  
            } 

    })
    $(".tuijian_xuanze").click(function(){

        for(var i = 0;i<$(".tuijian_xuanze").length;i++){
            $(".tuijian_xuanze").eq(i).removeClass("pianshen_kaiqi_xuanzes").children().eq(0).removeClass("pianshen_kaiqi_xuanze_titles").next().removeClass("pianshen_kaiqi_xuanze_imgs");
        }
        $(this).addClass("pianshen_kaiqi_xuanzes").children().eq(0).addClass("pianshen_kaiqi_xuanze_titles").next().addClass("pianshen_kaiqi_xuanze_imgs");
        if($(this).children().eq(0).html() == "推荐"){
            //1
            $(".tuijian_zt").val("1");
        }else{
           //0
            $(".tuijian_zt").val("0");
        }
    })
    $(".shangjia_xuanze").click(function(){
        for(var i = 0;i<$(".shangjia_xuanze").length;i++){
            $(".shangjia_xuanze").eq(i).removeClass("pianshen_kaiqi_xuanzes").children().eq(0).removeClass("pianshen_kaiqi_xuanze_titles").next().removeClass("pianshen_kaiqi_xuanze_imgs");
        }
        $(this).addClass("pianshen_kaiqi_xuanzes").children().eq(0).addClass("pianshen_kaiqi_xuanze_titles").next().addClass("pianshen_kaiqi_xuanze_imgs");
        if($(this).children().eq(0).html() == "推荐"){
            //1
            $(".shangjia_zt").val("1");
        }else{
           //0
            $(".shangjia_zt").val("0");
        }
    })
    //批量下架
    $(".gai_jiezhne").click(function(){
            var url=window.location.href;
            var str=$(this).parents('.panel-body').find('.color_span').parents('.gai_yaopin_lis_lis').find('.gai_yaopin_lis_odd').text();
            if(str==''){
                console.log(12)
                alert('必须选择一个或多个！')
                return;
            }else{
                var str1=str.replace(/\s+/g, "")
                var str2=str1.split(',')
                str2.splice(-1,1)
                var values=str2
               $.ajax({  
                    type: "POST",  
                    url: url,  
                    dataType: "json",  
                    cache:false, 
                    data: {values:values,type:'noups'},  
                    success: function(json){  
                        window.location.href="";

                    }
                });
            }


    })
    $(".gai_jiezhne2").click(function(){
            var url=window.location.href;

            var str=$(this).parents('.panel-body').find('.color_span').parents('.gai_yaopin_lis_lis').find('.gai_yaopin_lis_odd').text();
            if(str==''){
                alert('必须选择一个或多个！')
                return;
            }else{
            var str1=str.replace(/\s+/g, "")
            var str2=str1.split(',')
            str2.splice(-1,1)
            var values=str2
               $.ajax({  
                    type: "POST",  
                    url: url,  
                    dataType: "json",  
                    cache:false, 
                    data: {values:values,type:'norec'},  
                    success: function(json){  
                        window.location.href="";

                    }
                });
            }


    })
});
   



