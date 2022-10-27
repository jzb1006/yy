<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li>
	
	<a href="/index.php?c=site&a=entry&do=green&m=hyb_yl&op=special&ac=special">绿通服务项目</a>
	
	</li>
	<li <?php  if(empty($id)) { ?>class="active"<?php  } ?>><a href="">添加绿通服务项目</a></li>
	<?php  if(!empty($id)) { ?>
	<li class="active"><a href="#">编辑绿通服务项目</a></li>
	<?php  } ?>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
			<input type="hidden" name="id" value="<?php  echo $id;?>" />
			<div class="panel panel-default">
				<div class="panel-heading">绿通服务项目设置</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">排序</label>
					<div class="col-sm-9">
						<input type="text" name="sort" placeholder="默认排序为0" class="form-control" value="<?php  echo $item['sort'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">简介</label>
					<div class="col-sm-9">
						<input type="text" name="content" placeholder="请输入简介" class="form-control" value="<?php  echo $item['content'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">标题<span class="must-fill">*</span></label>
					<?php  if($pid && $pid != '0') { ?>
					<div class="col-sm-9">
						<input type="text" name="title" required class="form-control" value="<?php  echo $item['title'];?>" >
					</div>
					<?php  } else { ?>

					<div class="col-sm-9">
		      			<select name="title" class="form-control valid" aria-invalid="false" required="">
		      				<option value="" <?php  if($item['title'] == '') { ?> selected="" <?php  } ?>>请选择标题</option>
        					<option value="预约就诊" <?php  if($item['title'] == '预约就诊') { ?> selected="" <?php  } ?>>预约就诊</option>
        					<option value="住院安排" <?php  if($item['title'] == '住院安排') { ?> selected="" <?php  } ?>>住院安排</option>
        					<option value="手术安排" <?php  if($item['title'] == '手术安排') { ?> selected="" <?php  } ?>>手术安排</option>
        					<option value="报告加急" <?php  if($item['title'] == '报告加急') { ?> selected="" <?php  } ?>>报告加急</option>
      					</select>
		    		</div>
		    		<?php  } ?>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">普通价格<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="money" class="form-control" value="<?php  echo $item['money'];?>" >
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-sm-2 control-label">会员价格<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="vip_money" class="form-control" value="<?php  echo $item['vip_money'];?>" >
					</div>
				</div> -->
				<div class="form-group">
					<label class="col-sm-2 control-label">图片<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<?php  echo tpl_form_field_image('thumb', $item['thumb'])?>
						<span class="help-block">建议图片大小80*80</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">上级id</label>
					<div class="col-sm-9">
						<select name="pid" class="form-control">
							<option value="" <?php  if($item['pid'] == '') { ?> selected="selected" <?php  } ?> >一级</option>
						<?php  if(is_array($parent)) { foreach($parent as $pa) { ?>
							<option value="<?php  echo $pa['id'];?>" <?php  if($item['pid'] == $pa['id'] || $pid == $pa['id']) { ?> selected="selected" <?php  } ?> ><?php  echo $pa['title'];?></option>
						<?php  } } ?>
						</select>
					</div>
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


<script type="text/javascript" src="<?php  echo HYB_YL_ADMIN?>/js/showmodel.js"></script>
<script>
	$('input[name="nav[thumb]"]').attr('required','required');
	$("#reset").on('click',function(){
		$("#color").val('#666').trigger('propertychange');
	});
	
</script>