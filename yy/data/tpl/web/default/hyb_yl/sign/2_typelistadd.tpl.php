<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#">增加类别</a></li>
</ul>
<div class="app-content">
<div class="app-form">
	<form action="" method="post" class="form-horizontal form" id="form">
		<div class="panel panel-default">
			<div class="panel-heading">服务包类别</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">类别名称</label>
					<div class="col-sm-9">
						<input type="text" name="title" id="title" class="form-control" value="<?php  echo $item['title'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">时长</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="time" class="form-control" value="<?php  echo $item['time'];?>" />
							<span class="input-group-addon">天</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >价格</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">￥</span>
							<input type="text" name="price" class="form-control" value="<?php  echo $item['price'];?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">类型</label>
					<div class="col-sm-9">
						<select class="form-control select2" name="type">
							<option value="">全部类型</option>
							<?php  if(is_array($service)) { foreach($service as $typs) { ?>
							<option value="<?php  echo $typs['id'];?>" ><?php  echo $typs['titlme'];?></option>
							<?php  } } ?>
						
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">排序</label>
					<div class="col-sm-9">
						<input type="text" name="sort" class="form-control" value="<?php  echo $item['sort'];?>" />
					</div>
				</div>
								<div class="form-group">
					<label class="col-sm-2 control-label">是否参与分销</label>
					<div class="col-sm-9">
						<label class="radio-inline" onclick="distri(1)">
							<input type="radio" name="is_fenxiao" value="0" <?php  if($item['is_fenxiao'] == '0') { ?> checked="checked" <?php  } ?>>不参与
						</label>
						<label class="radio-inline" onclick="distri(2)">
							<input type="radio" name="is_fenxiao" value="1"  <?php  if($item['is_fenxiao'] == '1') { ?> checked="checked" <?php  } ?>>参与
						</label>
					</div>
				</div>
				<div id="distridiv"  <?php  if($itme['is_fenxiao'] == '0') { ?> style="display: none" <?php  } ?>>
				<div class="form-group">
					<label class="col-sm-2 control-label" >一级分销结算金额</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">￥</span>
							<input type="text" name="fx_one" class="form-control" value="<?php  echo $item['fx_one'];?>" />
						</div>
					</div>
				</div>
								<div class="form-group">
					<label class="col-sm-2 control-label" >二级分销结算金额</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">￥</span>
							<input type="text" name="fx_two" class="form-control" value="<?php  echo $item['fx_two'];?>" />
						</div>
					</div>
				</div>
												</div>
								<div class="form-group">
					<label class="col-sm-2 control-label">是否免审核</label>
					<div class="col-sm-9">
						<label class="radio-inline">
							<input type="radio" name="is_shenhe" value="1" <?php  if($item['is_shenhe'] == '1') { ?> checked="" <?php  } ?>>是
						</label>
						<label class="radio-inline">
							<input type="radio" name="is_shenhe" value="0"  <?php  if($item['is_shenhe'] == '0') { ?> checked="" <?php  } ?>>否
						</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">是否用于续费</label>
					<div class="col-sm-9">
						<label class="radio-inline">
							<input type="radio" name="is_xufei" <?php  if($item['is_xufei'] == '1') { ?> checked="" <?php  } ?> value="1" >是
						</label>
						<label class="radio-inline">
							<input type="radio" name="is_xufei" value="0" <?php  if($item['is_xufei'] == '0') { ?> checked="" <?php  } ?>>否
						</label>
						<div class="help-block">开启后,该付费类型可以用于专家服务包续费增加服务时间。</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">是否启用</label>
					<div class="col-sm-9">
						<label class="radio-inline">
							<input type="radio" name="status" <?php  if($item['status'] == '1') { ?> checked="" <?php  } ?> value="1" >是
						</label>
						<label class="radio-inline">
							<input type="radio" name="status" value="0" <?php  if($item['status'] == '0') { ?> checked="" <?php  } ?>>否
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label"></label>
			<div class="col-sm-9">
				<input type="hidden" name="id" value="" />
				<input type="hidden" name="postType" value="" />
				<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
				<input type="hidden" name="token" value="c5514e9f" />
			</div>
		</div>
	</form>
</div>
</div>
<script>
	function distri(flag){
		if (flag == 2) {
			$('#distridiv').show();
		} else{
			$('#distridiv').hide();
		}
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
