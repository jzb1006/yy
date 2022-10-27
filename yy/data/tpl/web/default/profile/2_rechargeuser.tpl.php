<?php defined('IN_IA') or exit('Access Denied');?><style>
  .df{
    display:flex;
    align-items: center;
  }
  .tab_cg{
    border:1px solid #eaeaea;
    margin-left:20px;
  }
  .tab_text,.tab_btn{
    padding: 5px 10px;
  }
  .tab_btn{
    border-left:1px solid #eaeaea;
  }
  button{
    outline: none;
  }
  .tabBox{
    margin-top:20px;
  }
  label{
    margin:0;
  }
  .tab_box{
    height:200px;
    overflow:hidden;
    overflow-y:auto;
    margin-top:20px;
  }
  .tab{
    display:inline-block;
    padding:5px;
    border:1px solid #eaeaea;
    margin-right:10px;
    cursor: pointer;
  }
  
  .tabBox label{
    white-space: nowrap;
  }
  #tabBox_xz{
    flex-wrap:wrap;
    max-height:200px;
    overflow:hidden;
    overflow-y:auto;
  }
    #tabBox_xz .tab_cg{
    margin-bottom:10px;
  }
  .tab:hover{
    background:#2aabd2;
    color:#fff;
  }
  #myModal{
    background: rgba(0,0,0,0.5)
  }
  .we7-modal-dialog, .modal-dialog1{
  	
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin-top: 100px;
    margin-left: auto;
    margin-right: auto;
  }
  .modal-dialog1{width: 750px!important;}
  .modal-footer{display: flex;justify-content: center;}
  /*账户充值样式*/
   .recharge_info{display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;justify-content: space-around;margin-bottom: 10px;}
.recharge_info>div{-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;border:1px solid #efefef;padding:10px 22px;line-height: 25px;color: #333;}
.recharge_info>div:first-child{margin-right: 10px;}
.recharge_info>div:last-child{margin-left: 10px;}
.zhe{background: rgba(0,0,0,0.6);position: fixed;display: flex;align-items: center;justify-content: center;width: 100%;height: 100%;top: 0;left: 0;}
.modal-dialog1{position: initial;}

.modal.in .modal-dialog1 {
    transform: translate(0,0);
    top: 70px;
    left: 0;
    position: absolute;
    right: 0;
    bottom: 0;
    margin: auto auto;
}
.modal-dialog1 .modal-content {
    border-radius: 0;
    max-height: inherit;
}
.alert{
	position: fixed;
	top: 30px;
	left: 0;
	z-index: 9999;
	right: 0;
	width: 200px;
	margin: 0 auto;
	text-align: center;
	height: 32px;
	line-height: 32px;
	padding: 0;
}
  /*账户充值end*/
}
</style>

<form>
	    <input type='hidden' name='u_id' value="<?php  echo $u_id;?>" />
	    <input type='hidden' name='credittype' value="" />
        <div class="modal-dialog1">
            <div class="modal-content">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">会员充值</h4>
                </div>
                <div class="modal-body">

                    <div class="recharge_info">
                        <div>
                            <label class="pull-left" style="margin-right: 25px">粉丝</label>
                            <div class="pull-left">
                                <img class="radius50" src="<?php  echo $userinfo['u_thumb'];?>" style='width:20px;height:20px;padding:1px;border:1px solid #ccc' onerror="this.src='http://www.webstrongtech.com/addons/weliam_merchant/web/resource/images/nopic-small.jpg'"/>
                                <?php  echo $userinfo['u_name'];?>                        </div>
                        </div>
                        <div>
                            <label class="pull-left " style="margin-right: 25px">会员信息</label>
                                <div class="pull-left">
                                    ID: <?php  echo $userinfo['u_id'];?></br>
                                    姓名:<?php  if(empty($userinfo['u_zhenshixingming'])) { ?>无<?php  } else { ?><?php  echo $userinfo['u_zhenshixingming'];?><?php  } ?> </br>
                                    手机号:<?php  if($userinfo['u_phone'] =='') { ?> 未绑定 <?php  } else { ?> <?php  echo $userinfo['u_phone'];?><?php  } ?></div>
                        </div>

                    </div>
                    <div class="tabs-container">
                        <div class="tabs">
                            <ul class="nav nav-tabs">
                                <li class="tab_Btn1 active"><a data-toggle="tab" href="#tab-1" data-rechargetype="credit1" aria-expanded="true"> 充值积分</a></li>

                                <li class="tab_Btn1"><a data-toggle="tab" href="#tab-2"  data-rechargetype="credit2" aria-expanded="false"> 充值余额</a></li>
                            </ul>
                            <div class="tab-content ">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="form-group"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">当前积分</label>
                                        <div class="col-sm-9 col-xs-12">
                                            <div class="form-control-static"><?php  echo $userinfo['score'];?></div>
                                        </div>
                                    </div>

                                </div>
                                <div id="tab-2" class="tab-pane ">
                                    <div class="form-group"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">当前余额</label>
                                        <div class="col-sm-9 col-xs-12">
                                            <div class="form-control-static"><?php  echo $userinfo['money'];?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">变化</label>
                        <div class="col-sm-9 col-xs-12">
                            <label class='radio-inline'>
                                <input type='radio' name='changetype' value='0' checked /> 增加
                            </label>
                            <label class='radio-inline'>
                                <input type='radio' name='changetype' value='1' /> 减少
                            </label>
                            <!--<label class='radio-inline'>
                                <input type='radio' name='changetype' value='2' /> 最终<span class='name'>积分</span>
                            </label>-->
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label mustl">充值数目</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="num" class="form-control" value="" data-rule-number='true' data-rule-required='true' data-rule-min='0.01' />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">备注</label>
                        <div class="col-sm-9 col-xs-12">
                            <textarea name="remark" class="form-control richtext" cols="70"></textarea>
                        </div>
                    </div>

                </div> <div class="modal-footer">
                <div class="btn btn-primary btn-submit" id="submit" onsubmit='return false';>确认充值</div>
                <button data-dismiss="modal" class="btn btn-default  btn-submit  quxiao" type="button">取消</button>
            </div>
            </div>
        </div>
    </form>
    <script type="text/javascript">
    $('input[name=credittype]').val('credit1')
    	$('.tab_Btn1').on('click',function(){
    		var credit=$(this).find('a').attr('data-rechargetype')
    		console.log(credit)
    		$('input[name=credittype]').val(credit)
    	})
    	// id="importFile" action="./index.php?c=site&a=entry&op=rechargeuser&do=copysite&m=hyb_yl&act=profile.rechargeuser&ac=notice" method="post" class="form-horizontal form-validate " enctype="multipart/form-data"
    	$('#submit').on('click',function(e){
    		var url="./index.php?c=site&a=entry&op=rechargeuser&do=copysite&m=hyb_yl&act=profile.rechargeuser&ac=notice";
    		var credittype=$('input[name=credittype]').val();
    		var remark=$('textarea[name=remark]').val();
    		var num=$('input[name=num]').val();
    		var u_id=$('input[name=u_id]').val();
    		var changetype=$("input[name='changetype']:checked").val();
    		console.log(credittype,remark,num,u_id,changetype)
    		$.ajax({
    			url:url,
    			method:'POST',
    			data:{
    				credittype:credittype,
    				remark:remark,
    				num:num,
    				u_id:u_id,
    				changetype:changetype,
    			},
    			success:function(data){
    				console.log(JSON.parse(data))
    				var data=JSON.parse(data)
    				if(data.message==1){
    					$('body').append(`
							<div class="alert alert-success" role="alert">操作成功！</div>
    						`)
    				}else{
						$('body').append(`
							<div class="alert alert-danger" role="alert">操作失败！</div>
    						`)
    				}
    				setTimeout(function(){
							$('.alert').remove()
							window.location.reload() 
    					},2000)
    			}
    		})

    	})
    </script>