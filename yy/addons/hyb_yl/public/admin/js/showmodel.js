
//开关
$(function(){
    bindModel();//引用链接选择触发器
})
/**
* 点击显示模态框
*/
var show_url=''
function bindModel(index) {
    $(".btnurl").unbind('click').click(function () {
        $(document).ready(function() {  //锁定模态框
            $("#selectUrl").modal({backdrop: 'static', keyboard: false}) 
        })
        show_url = $(this).attr('data-input')


    })
}

//隐藏模态框
function hideModal(){
    $("#selectUrl").modal('hide');
}

//选择链接 
function url_system( ){
    $(".btn-sm").unbind('click').click(function () {
        // console.log("001",$(this).attr('data-href'))
        $(`${show_url}`).val($(this).attr('data-href'))
        hideModal()
    })
}

    