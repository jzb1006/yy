$(function () {
    $("#contBox").sortable();
    $(".cont").disableSelection();
});
//添加栏目

$(".addCont").on("click",function () {
    $("#contBox").append("<div class=\"cont\">\n" +
        "            <div class=\"top\">\n" +
        "                    <div class=\"title\">题目</div>\n" +
        "                <input type=\"text\" name=\"guigeName\">\n" +
        "                <div class=\"imgBox\"><img src=\"tuozhuai.png\" alt=\"\"></div>\n" +
        "                <div class=\"add\">添加选择项</div>\n" +
        "                <div class=\"remove\">X</div>\n" +
        "            </div>\n" +
        "            <div class=\"bottom\">\n" +
        "                <!--<div class=\"title\">选项</div>-->\n" +
        "                <div class=\"dataBox\">\n" +
        "                </div>\n" +
        "            </div>\n" +
        "        </div>");
});
$("#contBox").on("click",".remove",function () {
    $(this).parents(".cont").remove();
})
//添加规格项
$("#contBox").on("click",".add",function (ev) {
        $(this).parents(".cont").find(".dataBox").append("<div class=\"data\" >\n" +
            "                        <button class=\"addImg btn btn-default\" type=\"button\">选项</button>\n" +
            "                        <input type=\"text\" name=\"checkName\">\n" +
            "                        <text>分数</text>\n" + 
            "                        <input type=\"text\" name=\"score\">\n" +
            "                        <div class=\"imgBox1\"><img src=\"tuozhuai.png\" alt=\"\"></div>\n" +
            "                        <div class=\"remove1\">X</div>\n" +
            "                    </div>");

});

$( function() {
    $( ".dataBox" ).sortable();
    $( ".data" ).disableSelection();
} );
//删除规格项
$("#contBox").on("click",".remove1",function () {
    $(this).parent().remove();
})
//选择医生药品
var arr=[
    {
        start:"",
        last:"",
        suggest:"",
        drugs:[],
        doctor:[]
    },{
        start:"",
        last:"",
        suggest:"",
        drugs:[],
        doctor:[]
    }
    ]
$("#scoreBox").on("click", ".yy", function () {
        dialog();
        var index = $('.yy').index(this);
        $("#checkYP").toggleClass("open");
        arr[index].drugs=[];
        console.log(index);
    $(".queren").on("click",function (ev){
        $("#checkYP input[name=yp]:checked").each(function(key,value){
            arr[index].drugs.push($(value).val());
        });
        $(".yy").eq(index).parents(".form1").find(".xx").val(arr[index].drugs);
        index=0;
        $("#checkYP").prop("class","close");
        $("#dialog").remove();
    })
});

$("#scoreBox").on("click",".yy1",function () {
    dialog();
    var index = $('.yy1').index(this);
    $("#checkYS").toggleClass("open");
    arr[index].doctor=[];
    $(".queren").on("click",function (ev){
        $("#checkYS input[name=ys]:checked").each(function(key,value){
            arr[index].doctor.push($(value).val());
        });
        $(".yy1").eq(index).parents(".form1").find(".xx").val(arr[index].doctor);
        index=0;
        $("#checkYS").prop("class","close");
        $("#dialog").remove();
    })
});
$(".quxiao").on("click",function () {
    $(this).parents().toggleClass("open");
    $(" input:checked ").attr("checked",false);
    $("#dialog").remove();
})
//添加得分区间
$(".addScore").on("click",function () {
    arr.push({
        start:"",
        last:"",
        suggest:"",
        drugs:[],
        doctor:[]
    });
    $(this).parents("#scoreBox").append("<div class=\"score\">\n" +
        "            <div><input type=\"text\" name=\"start\">至<input type=\"text\" name=\"last\"></div>\n" +
        "            <div><input type=\"text\" placeholder=\"建议\" name=\"suggest\"></div>\n" +
        "        <div class=\"inputCheck\">\n" +
        "            <div align=\"center\" class=\"div2\" >\n" +
        "                <form class=\"form1\">\n" +
        "                    <input type=\"text\" class=\"xx\"/>\n" +
        "                    <input type=\"button\" value=\"选择药品\"  class=\"yy\"/>\n" +
        "                </form>\n" +
        "            </div>\n" +
        "        </div>\n" +
        "        <div class=\"inputCheck\">\n" +
        "            <div align=\"center\" class=\"div2\" >\n" +
        "                <form class=\"form1\">\n" +
        "                    <input type=\"text\"  class=\"xx\"/>\n" +
        "                    <input type=\"button\" value=\"选择医生\" class=\"yy1\"/>\n" +
        "                </form>\n" +
        "            </div>\n" +
        "        </div>\n" +
        "        <div class=\"loseScore\">-</div>\n" +
        "    </div>")
})
$("#scoreBox").on("click",".loseScore",function () {
    var index=$('.loseScore').index(this);
    arr.splice(index,1);
    $(this).parent().remove();
})

//保存
$(".saveCont").on("click",function () {
    $("#scoreBox input[name=start]").each(function(key,value){
        arr[key].start=$(value).val();
    });
    $("#scoreBox input[name=last]").each(function(key,value){
        arr[key].last=$(value).val();
    });
    $("#scoreBox input[name=suggest]").each(function(key,value){
        arr[key].suggest=$(value).val();
    });
    arr.splice(0,1);
    console.log(arr);
})

//遮罩层
function dialog() {
    $("body").append("<div id=\"dialog\" style=\"position:fixed;top: 0;left: 0;right: 0;bottom: 0;z-index: 95;opacity:0.7;alpha(opacity=50);background-color: #000000\"></div>" +
        "")
}

