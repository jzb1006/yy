<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs" id="myTab">
		<li class="active">
			<a href="#">增加类别</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-form">
			<form action="" method="post" class="form-horizontal form" id="form">
				<div class="panel panel-default">
					<div class="panel-heading">服务包类别</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">类型</label>
							<div class="col-sm-9">
								<select class="form-control select2" name="typeid">
									<option value="0" selected>全部类型</option>
									<?php  if(is_array($list)) { foreach($list as $item) { ?>
									<option value="<?php  echo $item['id'];?>"><?php  echo $item['titlme'];?></option>
									<?php  } } ?>

								</select>
							</div>
						</div>		
						<div class="form-group">
							<label class="col-sm-2 control-label">类别名称</label>
							<div class="col-sm-9">
								<input type="text" name="title" id="name" class="form-control" value="<?php  echo $res['title'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">时长</label>
							<div class="col-sm-9">
								<div class="input-group">
									<input type="text" name="time_leng" class="form-control" value="<?php  echo $res['time_leng'];?>" />
									<span class="input-group-addon">天</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">价格</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon">￥</span>
									<input type="text" name="money" class="form-control" value="<?php  echo $res['money'];?>" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">排序</label>
							<div class="col-sm-9">
								<input type="text" name="stort" class="form-control" value="<?php  echo $res['money'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">是否参与分销</label>
							<div class="col-sm-9">
								<label class="radio-inline" onclick="distri(1)">
									<input type="radio" name="fx_type" value="0" <?php  if($res['fx_type'] == '0') { ?> checked="checked" <?php  } ?>>参与
								</label>
								<label class="radio-inline" onclick="distri(2)">
									<input type="radio" name="fx_type" value="1" <?php  if($res['fx_type'] == '1') { ?> checked="checked" <?php  } ?>>不参与
								</label>
							</div>
						</div>
						<div id="distridiv">
							<div class="form-group">
								<label class="col-sm-2 control-label">一级分销结算金额</label>
								<div class="col-sm-9">
									<div class="input-group">
										<span class="input-group-addon">￥</span>
										<input type="text" name="one_fx" class="form-control" value="<?php  echo $res['one_fx'];?>" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">二级分销结算金额</label>
								<div class="col-sm-9">
									<div class="input-group">
										<span class="input-group-addon">￥</span>
										<input type="text" name="two_tx" class="form-control" value="<?php  echo $res['two_tx'];?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">是否免审核</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="if_store" value="1" <?php  if($res['if_store'] == '1') { ?> checked="checked" <?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="if_store" value="0" <?php  if($res['if_store'] == '0') { ?> checked="checked" <?php  } ?>>否
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">是否用于续费</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="if_xf" value="1" <?php  if($res['if_xf'] == '1') { ?> checked="checked" <?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="if_xf" value="0" <?php  if($res['if_xf'] == '0') { ?> checked="checked" <?php  } ?>>否
								</label>
								<div class="help-block">开启后,该付费类型可以用于专家服务包续费增加服务时间。</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">是否启用</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="if_open" value="1" <?php  if($res['if_open'] == '1') { ?> checked="checked" <?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="if_open" value="2" <?php  if($res['if_open'] == '2') { ?> checked="checked" <?php  } ?>>否
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-9">
						<input type="hidden" name="id" value="<?php  echo $id;?>" />
						<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					</div>
				</div>
			</form>
		</div>
	</div>
	<script>
		function distri(flag){
				if (flag == 1) {
					$('#distridiv').show();
				} else{
					$('#distridiv').hide();
				}
			}
	</script>
	<script type="text/javascript">
	 $(function(){
	  //为Select添加事件，当选择其中一项时触发
	  $("select:eq(0)").change(function(){
		var text =$("select:eq(0) :selected").text() 
		$('input[name=title]').val(text)
	  });
	 });
	</script>
</div>
</div>
</div>
<div class="foot" id="footer">
	<ul class="links ft">
		<li class="links_item">
			<div class="copyright">Powered by <a href="http://www.we7.cc">
					<b>系统</b>
				</a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a>
			</div>
		</li>
	</ul>
</div>

</body>
</html>