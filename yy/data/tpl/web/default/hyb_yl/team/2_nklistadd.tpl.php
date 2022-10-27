<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.inputBox{
		margin-top: 20px;
	}
</style>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#">添加年卡</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form form-validate" id="commentForm">
			<input type="hidden" name="hid" id="hid" value="<?php  echo $_SESSION['hid'];?>">
			<div class="tab-content">
				<div class="tab-pane  active" id="tab_rush">
					<div class="panel panel-default">
						<div class="panel-heading">年卡信息</div>
						<div class="panel-body">
							<div class="form-group">
									<label class="col-sm-2 control-label">选择专家</label>
									<div class="col-sm-8">
										<input type="hidden" id="openid" name="openid" value="<?php  echo $item['openid'];?>">
										<input type="hidden" id="zid" name="zid" value="<?php  echo $item['zid'];?>">
										<div class="input-group">
											<input type="text" name="z_name" maxlength="30" class="form-control" id="salers" value="<?php  echo $item['z_name'];?>" readonly="">
											<span class="btn input-group-addon" onclick="popwin = $('#modal-module-menus-doc').modal();">选择专家</span>
										</div>
										<div id="modal-module-menus-doc" class="modal fade" tabindex="-1">
											<div class="modal-dialog" style="width: 660px;">
												<div class="modal-content">
													<div class="modal-header">
														<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
														<h3>选择专家</h3>
													</div>
													<div class="modal-body">
														<div class="row">
															<div class="input-group">
																<input type="text" class="form-control" name="keyword" value="" id="search-kwd" placeholder="输入编辑员名称或openid或uid">
																<span class="input-group-btn">
																	<button type="button" class="btn btn-default" onclick="search_membersdoc();">搜索</button>
																</span>
															</div>
														</div>
                                                        <div id="user_list_doc" style="padding-top:5px;">
                                                            
                                                        </div>
													</div>
													<div class="modal-footer">
														<a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
					
						
							
						<!---->
					
				
				<div class="form-group">
						<label class="col-sm-2 control-label">医生设置免费问诊</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" class="inlineRadio1" name="is_mianfei" <?php  if($item['is_mianfei'] == '1') { ?> checked="" <?php  } ?> value="1" >开启
							</label>
							<label class="radio-inline">
								<input type="radio" class="inlineRadio2" name="is_mianfei" value="0" <?php  if($item['is_mianfei'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
						</div>
						<br/>
						<div class="form-group inputBox"  <?php  if($item['is_mianfei'] == '0') { ?> style="display: none;" <?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">免费问诊次数</label>
							<div class="col-sm-5 col-md-5 col-lg-4">
								<div class="input-group">
									<input type="tel" class="form-control" name="wz_num" value="<?php  echo $item['wz_num'];?>">
									<span class="input-group-addon">次</span>
								</div>
							</div>
						</div>
					</div>
                  	<div class="form-group">
						<label class="col-sm-2 control-label">医生设置问诊折扣</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" class="inlineRadio1" name="is_wzzk" <?php  if($item['is_wzzk'] == '1') { ?> checked="" <?php  } ?> value="1" >开启
							</label>
							<label class="radio-inline">
								<input type="radio" class="inlineRadio2" name="is_wzzk" value="0" <?php  if($item['is_wzzk'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
						</div>
						<br/>
						<div class="form-group inputBox" <?php  if($item['is_wzzk'] == '0') { ?> style="display: none;" <?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">问诊折扣</label>
							<div class="col-sm-5 col-md-5 col-lg-4">
								<div class="input-group">
									<input type="text" class="form-control" name="wz_zhekou" value="<?php  echo $item['wz_zhekou'];?>">
									<span class="input-group-addon">折</span>
								</div>
							</div>
						</div>
					</div>
                  	<!-- <div class="form-group">
						<label class="col-sm-2 control-label">医生设置会话次数</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" class="inlineRadio1" name="is_hh" <?php  if($item['is_hh'] == '1') { ?> checked="" <?php  } ?> value="1" >开启
							</label>
							<label class="radio-inline">
								<input type="radio" class="inlineRadio2" name="is_hh" <?php  if($item['is_hh'] == '0') { ?> checked="" <?php  } ?> value="0">关闭
							</label>
						</div>
						<br/>
						<div class="form-group inputBox" <?php  if($item['is_hh'] == '0') { ?> style="display: none;" <?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">会话次数</label>
							<div class="col-sm-5 col-md-5 col-lg-4">
								<div class="input-group">
									<input type="tel" class="form-control" name="hh_num" value="<?php  echo $item['hh_num'];?>">
									<span class="input-group-addon">次</span>
								</div>
							</div>
						</div>
					</div> -->
                  	<div class="form-group">
						<label class="col-sm-2 control-label">医生设置解读次数</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" class="inlineRadio1" name="is_jd" <?php  if($item['is_jd'] == '1') { ?> checked="" <?php  } ?> value="1" >开启
							</label>
							<label class="radio-inline">
								<input type="radio" class="inlineRadio2" name="is_jd" value="0" <?php  if($item['is_jd'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
						</div>
						<br/>
						<div class="form-group inputBox" <?php  if($item['is_jd'] == '0') { ?> style="display: none;" <?php  } ?>>
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">解读次数</label>
							<div class="col-sm-5 col-md-5 col-lg-4">
								<div class="input-group">
									<input type="tel" class="form-control" name="jd_num" value="<?php  echo $item['jd_num'];?>">
									<span class="input-group-addon">次</span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
							<label class="col-sm-2 control-label">库存</label>
							<div class="col-md-4">
								<div class="input-group">
									<input type="text" name="num" class="form-control" value="<?php  echo $item['num'];?>">
									<span class="input-group-addon">个</span>
								</div>
								<span class="help-block">不填或则填0表示不限制</span>
							</div>
						</div>
					<div class="form-group">
							<label class="col-sm-2 control-label">原价格</label>
							<div class="col-md-4">
								<div class="input-group">
									<span class="input-group-addon">￥</span>
									<input type="text" name="old_price" class="form-control" value="<?php  echo $item['old_price'];?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">现价格</label>
							<div class="col-md-4">
								<div class="input-group">
									<span class="input-group-addon">￥</span>
									<input type="text" name="new_price" class="form-control" value="<?php  echo $item['new_price'];?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">时长(/年)</label>
							<div class="col-md-4">
								<div class="input-group">
									<input type="text" name="times" class="form-control" value="<?php  echo $item['times'];?>">
								</div>
							</div>
						</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">使用限制</label>
					<div class="col-md-9 col-sm-9">
						<div class="input-group col-md-7 col-sm-7">
							<input type="text" name="notes" class="form-control" value="<?php  echo $item['notes'];?>" id="use_limit" />
						</div>
						<span class="help-block">如：仅图文问诊免费</span>
					</div>
				</div>
				
			
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">使用说明</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_ueditor('content',$item['content']);?>					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">排序</label>
					<div class="col-sm-5 col-md-5 col-lg-4">
						<input type="tel" class="form-control" name="sort" value="<?php  echo $item['sort'];?>"/>
						<span class="help-block">请输入整数数字，序号越大，排序靠前</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">抽成设置</label>
					<div class="col-sm-5 col-md-5 col-lg-4">
						<input type="text" class="form-control" name="cut" value="<?php  echo $item['cut'];?>"/>
						<span class="help-block">请输入整数数字</span>
					</div>
				</div>
				<div class="form-group layui-form-item">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label layui-form-label">审核状态</label>
					<div class="col-sm-5 col-md-5 col-lg-4">
						<input type="checkbox" class="js-switch" name="status" value="1" <?php  if($item['status'] == '1') { ?> checked="checked" <?php  } ?>>
					</div>
				</div>
			</div>
			</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-9">
					<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
					<input type="hidden" name="token" value="da1c10f4" />
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$('input[type=radio]').on('click',function(){
		console.log($(this).attr('name'))
		var name1=$(this).attr('name')
			if($('input[name='+name1+']:checked').val()==1){
				$(this).parents('.form-group').find('.inputBox').show()
			}else{
				$(this).parents('.form-group').find('.inputBox').hide()
			}
	})

</script>
<script>
$(function () {
	window.optionchanged = false;
	$('#myTab a').click(function (e) {
		e.preventDefault();//阻止a链接的跳转行为
		$(this).tab('show');//显示当前选中的链接及关联的content
	});
	var dailyflag = $('#dailyflag').val();
	//alert(dailyflag);
	if(dailyflag == 0){
		$('#discount').hide();
	}else{
		$('#discount').show();
	}
});
</script>
<script language='javascript'>
	

	function inspect(){
		var merchantid = $('#sidmerchant').val();
		$.post("https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=halfcard&ac=halfcard_web&do=inspect&", { id : merchantid,type:1 }, function(data){
			if(data.errno){
				util.tips("该商户已有特权活动");
				$('#inspectflag').val(2);
			}else{
				$('#inspectflag').val(1);
				$('#storetitle').val($('#namemerchant').val());
				util.tips("操作成功");
			}
		}, 'json');
	}

	function search_merchant() {
			$("#module-merchant").html("正在搜索....")
			$.get("https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=halfcard&ac=halfcard_web&do=selectMerchant&type=1", {
				keyword: $.trim($('#search-kwd-merchant').val())
			}, function(dat){
				$('#module-merchant').html(dat);
			});
		}
	function remove_merchant(obj){
        $('#goodsidmerchant').val('');
        $('#namemerchant').val('');
        $('#imgmerchant').attr("src",'');
        $('#sidmerchant').val('');
       }
	function select_merchant(o) {
		var lastid = $('#sidmerchant').val();
		var fristid = $('#firstid').val();
		if (lastid != o.id) {
			$('#sidmerchant').val(o.id);
        	$('#namemerchant').val(o.storename);
        	$('#imgmerchant').attr("src",o.logo);
	    	$('#modal-module-merchant').modal('hide');
	    	if(fristid != o.id){
	    		inspect();
	    	}
		}else{
	    	$('#modal-module-merchant').modal('hide');
		}
 	}
	function asd(){
		var dailyflag = $('#dailyflag').val();
		if (dailyflag == 0) {
			$('#discount').show();
			$('#dailyflag').val(1);
		}else{
			$('#discount').hide();
			$('#dailyflag').val(0);
		}
	}
	function search_membersdoc() {
            var keyword_user = $("#search-kwd").val();
            console.log(keyword_user);
            var hid = $("#hid").val();
            var url ="<?php  echo $_W['siteroot'];?>/web/index.php?c=site&a=entry&op=user&do=alldoctor&m=hyb_yl&hid="+hid;
            $("#user_list_doc").empty();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: url,
                dataType: "html",  
                data: {
                    keyword_user: keyword_user
                },

                success: function(result) {
                   $("#user_list_doc").html(result);
                }
            });
        }
        function select_member_doc(o)
        {
        	$("#z_name").val(o.z_name);
	        $("#zid").val(o.zid);
	        $("#openid").val(o.openid);
	        $("#salers").val(o.z_name);
	        $("#user_list_doc").html("");
	        $("#myModal").modal("hide");
	        $("#modal-module-menus-doc").attr("style",'display:none');
	        $(".modal-backdrop").remove();
        }

</script>
			</div>
		</div>
	</div>
	<div class="foot" id="footer">
		<ul class="links ft">
            <li class="links_item"><div class="copyright">Powered by <a href="http://www.we7.cc"><b>系统</b></a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a></div></li>
		</ul>
	</div>
	</body>
</html>
