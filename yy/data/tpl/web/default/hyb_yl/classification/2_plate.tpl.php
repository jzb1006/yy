<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs">
		<li>
			<a href="/index.php?c=site&a=entry&do=classification&op=catefl&ac=catefl&m=hyb_yl">板块分类列表</a>
		</li>
		<li class="active">
			<a href="/index.php?c=site&a=entry&do=classification&op=plate&ac=plate&m=hyb_yl">添加板块分类</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-form">
			<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
				<div class="panel panel-default" id="step1">
					<div class="panel-heading">分类管理</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">分类名称<span class="must-fill">*</span>
							</label>
							<div class="col-sm-9">
								<input type="text" name="zx_name" required autocomplete="off" class="form-control" value="<?php  echo $res['zx_name'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">分类描述<span class="must-fill">*</span>
							</label>
							<div class="col-sm-9">
								<input type="text" name="zx_kew" required autocomplete="off" class="form-control" value="<?php  echo $res['zx_kew'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">分类图片</label>
							<div class="col-sm-9">
                                <?php  echo tpl_form_field_image('zx_thumb', $res['zx_thumb'])?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">背景颜色</label>
							<div class="col-sm-9">
                                <?php  echo tpl_form_field_color('background', $res['background'])?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">分类排序</label>
							<div class="col-sm-9">
								<input type="text" name="sort" placeholder="排序号越大排列越靠前" class="form-control" value="<?php  echo $res['sort'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">是否开启外链</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name='link_type' value='1' <?php  if($res['link_type'] == '1') { ?> checked="" <?php  } ?>>开启
								</label>
								<label class="radio-inline">
									<input type="radio" name='link_type' value='0' <?php  if($res['link_type'] == '0') { ?> checked="" <?php  } ?>>关闭
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">外部链接<span class="must-fill"></span>
							</label>
							<div class="col-sm-9">
								<input type="text" name="link_url" placeholder="" class="form-control" value="<?php  echo $res['link_url'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">是否开启</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name='enabled' value='1' <?php  if($res['enabled'] == '1') { ?> checked="" <?php  } ?>>开启
								</label>
								<label class="radio-inline">
									<input type="radio" name='enabled' value='0' <?php  if($res['enabled'] == '0') { ?> checked="" <?php  } ?>>关闭
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">是否推荐</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name='recommend' value='1' <?php  if($res['recommend'] == '1') { ?> checked <?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name='recommend' value='0' <?php  if($res['recommend'] == '0') { ?> checked <?php  } ?>>否
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-9">
								<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
								<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
								<input type="hidden" name="zx_id" value="<?php  echo $zx_id;?>" />
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script>
		myrequire(['layui'],function(){
				layui.use(['layer','form','laydate'], function(){
				  	var layer = layui.layer,
					form = layui.form();
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