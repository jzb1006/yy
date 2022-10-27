
    function search_members_doc() {
        $("#module-menus-doc").html("正在搜索....");
        var url ="../web/index.php?c=site&a=entry&do=alldoctor&op=user&m=hyb_yl";
        $.ajax({  
            type: "POST",  
            url: url,  
            dataType: "html",  
            data: {keyword_user: $.trim($("#search-kwd-doc").val()),op:'user'},  
            success: function(dat){ 
                console.log(dat)
            $("#module-menus-doc").html(dat);
          }
      });
    }
    function select_member_doc(o) {
        console.log($("#openid").val(o.openid))
        $("#zid").val(o.zid);
        $("#openid").val(o.openid);
        $("#salerdoc").val(o.z_name);
        $("#search-kwd-doc").val(o.u_name);
        $("#module-menus-doc").html("");
        $("#myModaldoc").modal("hide");
        $(".modal-backdrop").remove();
    }
    