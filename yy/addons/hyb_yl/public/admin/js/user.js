
    function search_members() {
        $("#module-menus").html("正在搜索....");
        var url ="../web/index.php?c=site&a=entry&do=alluser&op=user&m=hyb_yl";
        $.ajax({  
            type: "POST",  
            url: url,  
            dataType: "html",  
            data: {keyword_user: $.trim($("#search-kwd").val()),op:'user'},  
            success: function(dat){ 
            $("#module-menus").html(dat);
          }
      });
    }
    function select_member(o) {
        console.log(o);
        $("#openid").val(o.openid);
        $("#u_id").val(o.u_id);
        $("#saler").val(o.u_name);
        $("#search-kwd").val(o.u_name);
        $("#module-menus").html("");
        $("#myModal").modal("hide");
        $(".modal-backdrop").remove();
    }
    