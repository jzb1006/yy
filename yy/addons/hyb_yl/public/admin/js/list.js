
//开关
$(function(){

$(".pianshen_kaiqi_xuanze").each(function(){
    $(this).on('click',function(){
        var box=$(this).parents('.pianshen_kaiqi').find('.pianshen_kaiqi_xuanze')
        for(var i=0;i<box.length;i++){
            $(this).parents('.pianshen_kaiqi').find('.pianshen_kaiqi_xuanze').eq(i).removeClass("pianshen_kaiqi_xuanzes").children().eq(0).removeClass("pianshen_kaiqi_xuanze_titles").next().removeClass("pianshen_kaiqi_xuanze_imgs");
        }
        $(this).addClass('pianshen_kaiqi_xuanzes').children().eq(0).addClass("pianshen_kaiqi_xuanze_titles").next().addClass("pianshen_kaiqi_xuanze_imgs");
          
            $(this).parents('.pianshen_kaiqi').find('.zt').val($(this).attr('data-val'))
            if($(this).attr('data-val')=='0'){
                $(this).parents('.row').next().find('.jiangshi').css({display:'flex'})
            }else{
                $(this).parents('.row').next().find('.jiangshi').css({display:'none'})
                //$('#user_nickname').val('')

            }
            
    })
})



$(".pian_gai_lun_box_img_div").click(function(){
    $(this).parent().remove()
})
})

    