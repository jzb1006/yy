<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>

<div class="app-container-right">
	<ul class="nav nav-tabs" id="myTab">
		<li class="active">
			<a href="#tab_basic">新增用户</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-form">
			<form action="" method="post" class="form-horizontal form form-validate">
				<div class="panel panel-default">
					<div class="panel-heading">新增用户</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">姓名</label>
							<div class="col-sm-9">
								<input type="text" name="u_name" class="form-control" value="<?php  echo $item['u_name'];?>">
							</div>
							<div class="help-block col-md-10 col-lg-offset-2">姓名</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">性别</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" id="inlineRadio1" name="u_sex" value="1" <?php  if($item['u_sex'] == '1') { ?> checked="" <?php  } ?>>男
								</label>
								<label class="radio-inline">
									<input type="radio" id="inlineRadio2" name="u_sex" value="0" <?php  if($item['u_sex'] == '0') { ?> checked="" <?php  } ?>>女
								</label>
							</div>
							<div class="help-block col-md-10 col-lg-offset-2">性别</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">头像</label>
							<div class="col-sm-9">
								<?php  echo tpl_form_field_image('u_thumb', $item['u_thumb'])?>
							</div>
							<div class="help-block col-md-10 col-lg-offset-2">头像</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">联系电话</label>
							<div class="col-sm-9">
								<input type="text" name="u_phone" class="form-control" value="<?php  echo $item['u_phone'];?>">
							</div>
							<div class="help-block col-md-10 col-lg-offset-2">联系电话</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">年龄</label>
							<div class="col-sm-9">
								<input type="number" name="u_age" class="form-control" value="<?php  echo $item['u_age'];?>">
							</div>
							<div class="help-block col-md-10 col-lg-offset-2">年龄</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">用户余额</label>
							<div class="col-sm-9">
								<input type="number" name="money" class="form-control" value="<?php  echo $item['money'];?>">
							</div>
							<div class="help-block col-md-10 col-lg-offset-2">用户余额</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">用户积分</label>
							<div class="col-sm-9">
								<input type="number" name="score" class="form-control" value="<?php  echo $item['score'];?>">
							</div>
							<div class="help-block col-md-10 col-lg-offset-2">用户积分</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">是否核销员</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" id="inlineRadio1" name="u_type" value="1" <?php  if($item['u_type'] == '1') { ?> checked="" <?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" id="inlineRadio2" name="u_type" value="0" <?php  if($item['u_type'] == '0') { ?> checked="" <?php  } ?>>否
								</label>
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