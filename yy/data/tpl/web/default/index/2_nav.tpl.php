<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li ><a href="">导航栏</a></li>
	<li <?php  if(empty($nav['id'])) { ?>class="active"<?php  } ?>><a href="">添加导航</a></li>
	<?php  if(!empty($nav['id'])) { ?>
	<li class="active"><a href="#">编辑导航</a></li>
	<?php  } ?>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
			<input type="hidden" name="id" value="<?php  echo $nav['id'];?>" />
			<div class="panel panel-default">
				<div class="panel-heading">导航栏设置</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">排序</label>
					<div class="col-sm-9">
						<input type="text" name="nav[displayorder]" placeholder="默认排序为0" class="form-control" value="<?php  echo $nav['displayorder'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">导航栏标题<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="nav[name]" required class="form-control" value="<?php  echo $nav['name'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">标题颜色</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="color" name="nav[color]" required id="color" value="<?php  echo $nav['color'];?>" class="form-control"  >
							<span id="reset"  class="input-group-addon btn btn-default">重置</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">导航栏图片<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<?php  echo tpl_form_field_image('nav[thumb]', $nav['thumb'])?>
						<span class="help-block">建议图片大小80*80</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >导航栏连接</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" value="<?php  echo $nav['link'];?>" class="form-control valid" name="link" placeholder="" id="advlink">
							<span data-input="#advlink" data-toggle="selectUrl" class="input-group-addon btn btn-default">选择链接</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">导航栏位置</label>
					<div class="col-sm-9">
						<select name="nav[type]" class="form-control">
							<option value="0" <?php  if($nav['type'] == 0 || empty($nav['type'])) { ?> selected="selected" <?php  } ?> >首页</option>
							<!--<option value="1" <?php  if($nav['type'] == 1) { ?> selected="selected" <?php  } ?> >一卡通</option>-->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">是否显示</label>
					<div class="col-sm-9">
						<div class="radio-inline">
							<input type="radio" name='enabled' value='1' <?php  if($nav['enabled']==1) { ?>checked<?php  } ?>>是
						</div>
						<div class="radio-inline">
							<input type="radio" name='enabled' value='0' <?php  if($nav['enabled']==0) { ?>checked<?php  } ?>>否
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
<script>
	$('input[name="nav[thumb]"]').attr('required','required');
	$("#reset").on('click',function(){
		$("#color").val('#666').trigger('propertychange');
	});
</script>