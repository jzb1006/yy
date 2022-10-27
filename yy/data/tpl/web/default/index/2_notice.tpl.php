<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li ><a href="">公告</a></li>
	<li <?php  if(empty($notice['id'])) { ?>class="active"<?php  } ?>><a href="">添加公告</a></li>
	<?php  if(!empty($notice['id'])) { ?>
	<li class="active"><a href="#">编辑公告</a></li>
	<?php  } ?>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form">
			<input type="hidden" name="id" value="<?php  echo $notice['id'];?>" />
			<div class="panel panel-default">
				<div class="panel-heading">公告设置</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">公告标题<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="title" required  autocomplete="off" class="form-control" value="<?php  echo $item['title'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">公告内容</label>
					<div class="col-sm-9">
						<?php  echo tpl_ueditor('content', $item['content']);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >公告连接</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" value="<?php  echo $item['link'];?>" class="form-control valid" name="link" placeholder="" id="advlink">
							<span data-input="#advlink" data-toggle="selectUrl" class="input-group-addon btn btn-default">选择链接</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">若设置了跳转链接则无法显示公告内容</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">是否显示</label>
					<div class="col-sm-9">
						<div class="radio-inline">
							<input type="radio" name='status' value='1' <?php  if($item['status']==1) { ?>checked<?php  } ?>>是
						</div>
						<div class="radio-inline">
							<input type="radio" name='status' value='0' <?php  if($item['status']==0) { ?>checked<?php  } ?>>否
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
	myrequire(['layui'],function(){
		layui.use(['layer','form','laydate'], function(){
		  	var layer = layui.layer,
			form = layui.form();
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/footer', TEMPLATE_INCLUDEPATH)) : (include template('./common/footer', TEMPLATE_INCLUDEPATH));?>