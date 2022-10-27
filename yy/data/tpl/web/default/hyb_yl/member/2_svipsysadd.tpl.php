<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#">添加权益</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form form-validate" id="commentForm">
			<div class="tab-content">
				<div class="tab-pane  active" id="tab_rush">
					<div class="panel panel-default">
						<div class="panel-heading">权益信息</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="col-md-2  control-label">排序</label>
								<div class="col-sm-9">
									<input type="number" min="0" class="form-control" name="sort" value="<?php  echo $item['sort'];?>"/>
									<span class="help-block">请输入整数数字，序号越大，排序靠前</span>
								</div>
							</div>
							<div class="form-group"  style="display: block;">
								<label class="col-md-2  control-label">名称</label>
								<div class="col-md-9">
									<input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>" id="storetitle" />
								</div>
							</div>
							<div class="form-group">
				                <label for="" class="col-md-2 control-label">图片</label>
				                <div class="col-md-9">
				                    <?php  echo tpl_form_field_image('thumb', $item['thumb'])?>
				                </div>
				            </div> 
				            <div class="form-group"  id="activediscount">
								<label class="col-md-2 control-label">特权折扣</label>
								<div class="col-sm-9">
									<div class="input-group">
										<input type="tel" class="form-control" name="zhekou" value="<?php  echo $item['zhekou'];?>"/>
										<span class="input-group-addon">折</span>
									</div>
									<span class="help-block">请输入小数,保留一位小数</span>
								</div>
							</div>
							<!--一卡通-->
							<!-- <div class="form-group">
					    		<label class="col-sm-2 control-label">特权类型</label>
					    		<div class="col-sm-9">
					    			<label class="radio-inline">
	                                    <input type="radio" value="0" id="wk" name="type" <?php  if($item['type'] == '0') { ?>  checked <?php  } ?>>按类型
	                                </label>
	                          
	                                <label class="radio-inline">
	                                    <input type="radio" value="1" id="cc" name="type"  <?php  if($item['type'] == '1') { ?>  checked <?php  } ?>>关闭
	                                </label>
					    		</div>
					  		</div> -->
						
							<div class="form-group layui-form-item"  id="weeke">
								<label class="col-md-2 control-label">问诊权益选择</label>
								<div class="col-md-9">
									<div class="layui-input-block">
										<?php  if(is_array($fuwu)) { foreach($fuwu as $fw) { ?>

										<label class="checkbox-inline">
											<input type="checkbox" value="<?php  echo $fw['titlme'];?>" name="quanyi[]" <?php  if(in_array($fw['titlme'],$item['quanyi'])) { ?> checked="" <?php  } ?> /> <?php  echo $fw['titlme'];?>
										</label>
										<?php  } } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2  control-label">问诊权益使用限制</label>
								<div class="col-md-9 ">
									<input type="text" name="xianzhi" class="form-control" value="<?php  echo $item['xianzhi'];?>" id="use_limit" />
									<span class="help-block" >如：仅图文问诊免费</span>
								</div>
							</div>
					
							
							<div class="form-group"  style="display: block;">
								<label class="col-md-2  control-label">免费追问</label>
								<div class="col-sm-9">
									<!-- <input type="checkbox" class="js-switch" value="1" name="is_mianfei" onclick="asd()" <?php  if($item['is_mianfei'] == '1') { ?> checked="" <?php  } ?>> -->
									<input type="hidden" id="dailyflag"  value=""  />
									<label class="radio-inline">
	                                    <input type="radio" value="1" id="is_mianfeiopen" name="is_mianfei" <?php  if($item['is_mianfei'] == '1') { ?>  checked <?php  } ?>>开启
	                                </label>
	                          
	                                <label class="radio-inline">
	                                    <input type="radio" value="0" id="is_mianfeicolse" name="is_mianfei"  <?php  if($item['is_mianfei'] == '0') { ?>  checked <?php  } ?>>关闭
	                                </label>
								</div>
							</div>
							<script type="text/javascript">
								var dailyflag = $('#dailyflag').val();
							    $("#is_mianfeiopen").click(function(){
							        $("#discount").show();
							        $('#dailyflag').val(0);
							    })
							    $("#is_mianfeicolse").click(function(){
							        $("#discount").hide();
							        $('#dailyflag').val(1);
							    })
							</script>
							<div class="form-group" id="discount"  style="display: none;">
								<label class="col-md-2 control-label">免费追问次数</label>
								<div class="col-sm-9">
									<div class="input-group">
										<input type="tel" class="form-control" name="mianfei_num" value="<?php  echo $item['mianfei_num'];?>"/>
										<span class="input-group-addon">次</span>
									</div>
									<span class="help-block">请输入数字,不能填小数</span>
								</div>
							</div>
							
				
							<div class="form-group">
								<label class="col-md-2  control-label">免费问诊次数限制</label>
								<div class="col-md-9 ">
									<input type="tel" name="mfwz_num" class="form-control" value="<?php  echo $item['mfwz_num'];?>" id="time_limit" />
									<span class="help-block">填0或不提填则无限制</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">说明</label>
								<div class="col-md-9">
									<?php  echo tpl_ueditor('content',$item['content']);?>					
									</div>
							</div>
				
							<div class="form-group layui-form-item">
								<label class="col-md-2 control-label">状态</label>
								<div class="col-md-9 ">
									
									<label class="radio-inline">
	                                    <input type="radio" value="1"  name="status" <?php  if($item['status'] == '1') { ?>  checked <?php  } ?>>开启
	                                </label>
	                          
	                                <label class="radio-inline">
	                                    <input type="radio" value="0"  name="status"  <?php  if($item['status'] == '0') { ?>  checked <?php  } ?>>关闭
	                                </label>
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
					<input type="button" name="back" onclick="history.back()" style="margin-left:10px;" value="返回列表" class="btn btn-default min-width">
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(function () {
	window.optionchanged = false;
	$('#myTab a').click(function (e) {
		e.preventDefault();//阻止a链接的跳转行为
		$(this).tab('show');//显示当前选中的链接及关联的content
	});
	var dailyflag = $('#dailyflag').val();
	//alert(dailyflag);
	// if(dailyflag == 0){
	// 	$('#discount').hide();
	// }else{
	// 	$('#discount').show();
	// }
	<?php  if($item['is_mianfei']=='1') { ?>
		$('#discount').show();
	<?php  } else { ?>
		$('#discount').hide();
	<?php  } ?>
});
</script>
<!-- <script language='javascript'>
	
	// function asd(that){

	// 	var dailyflag = $('#dailyflag').val();
	// 	if (dailyflag == 1) {
	// 		$('#discount').show();
	// 		$('#dailyflag').val(0);
	// 	}else{
	// 		$('#discount').hide();
	// 		$('#dailyflag').val(1);
	// 	}
	// }
</script>	
 -->	


		
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>