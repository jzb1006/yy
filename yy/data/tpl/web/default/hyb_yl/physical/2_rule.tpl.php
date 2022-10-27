<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#tab_basic">套餐规则设置</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form form-validate">
			<div class="panel panel-default">
				<div class="panel-heading">规则设置</div>
				<div class="panel-body">
					<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">体检首页</label>
							<div class="col-md-6">
								<div class="input-group">
									<input type="text" name="num" class="form-control" value="<?php  echo $item['num'];?>">
									<span class="input-group-addon">个</span>
								</div>
								<span class="help-block">最多显示推荐的数量，填0则不限制</span>
							</div>
						</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">机构是否允许上传套餐</label>
						<div class="col-sm-9">
							<label class="radio-inline"><input type="radio" name="is_send" value="1" <?php  if($item['is_send'] == '1') { ?> checked="" <?php  } ?>>开启</label>
							<label class="radio-inline"><input type="radio" name="is_send" value="0" <?php  if($item['is_send'] == '0') { ?> checked="" <?php  } ?>>关闭</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">套餐是否开启审核</label>
						<div class="col-sm-9">
							<label class="radio-inline"><input type="radio" name="status" value="1" <?php  if($item['status'] == '1') { ?> checked="" <?php  } ?>>开启</label>
							<label class="radio-inline"><input type="radio" name="status" value="0" <?php  if($item['status'] == '0') { ?> checked="" <?php  } ?>>关闭</label>
							
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-9">
					<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
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
