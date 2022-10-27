<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#tab_basic">基础设置</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" id="setting-form" class="form-horizontal form">
			<div class="panel panel-default">
				<div class="panel-heading">基础设置</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">会员卡标题</label>
						<div class="col-sm-9">
							<input type="text"  class="form-control" name="setting_title" value="<?php  echo $items['setting_title'];?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">会员卡办卡说明</label>
						<div class="col-sm-9">
							<input type="text"  class="form-control" name="setting_goumai_content" value="<?php  echo $items['setting_goumai_content'];?>"/>
							<span class="help-block">建议：5~10个字</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">会员卡赠送说明</label>
						<div class="col-sm-9">
							<input type="text"  class="form-control" name="setting_zengsong_content" value="<?php  echo $items['setting_zengsong_content'];?>"/>
							<span class="help-block">建议：5~10个字</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">会员购买界面背景图片</label>
						<div class="col-sm-9">
							<?php  echo tpl_form_field_image('setting_goumai_thumb', $items['setting_goumai_thumb'])?>
							<span class="help-block">建议尺寸：750X392</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">会员赠送界面背景图片</label>
						<div class="col-sm-9">
							<?php  echo tpl_form_field_image('setting_zengsong_thumb', $items['setting_zengsong_thumb'])?>
							<span class="help-block">建议尺寸：702*291</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-9">
							<input type="submit" name="submit" lay-submit value="提交" class="btn btn-primary min-width" />
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>