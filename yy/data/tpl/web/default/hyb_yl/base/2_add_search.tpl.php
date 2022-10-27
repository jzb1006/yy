<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li ><a href="/index.php?c=site&a=entry&do=base&m=hyb_yl&ac=search&op=search">搜索设置</a></li>
	<li <?php  if(empty($id)) { ?>class="active"<?php  } ?>><a href="">添加搜索设置</a></li>
	<?php  if(!empty($id)) { ?>
	<li class="active"><a href="#">编辑搜索设置</a></li>
	<?php  } ?>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
			<input type="hidden" name="id" value="<?php  echo $id;?>" />
			<div class="panel panel-default">
				<div class="panel-heading">搜索设置</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">标题</label>
					<div class="col-sm-9">
						<input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">图片<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<?php  echo tpl_form_field_image('thumb', $item['thumb'])?>
						<span class="help-block">建议图片大小80*80</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">排序<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="sort" required class="form-control" value="<?php  echo $item['sort'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">搜索类型</label>
					<div class="col-sm-9">
						<select name="keyword" class="form-control">
							<option value="1" <?php  if($item['keyword'] == '1') { ?> selected="selected" <?php  } ?> >医生</option>
							<option value="2" <?php  if($item['keyword'] == '2') { ?> selected="selected" <?php  } ?> >医院</option>
							<option value="3" <?php  if($item['keyword'] == '3') { ?> selected="selected" <?php  } ?> >药房</option>
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
<script type="text/javascript">
	
	function bindEvents() {
		require(['jquery', 'util'], function ($, util) {
			$('.btn-select-pic').unbind('click').click(function () {
				var imgitem = $(this).closest('.img-item');
				util.image('', function (data) {
					imgitem.find('img').attr('src', data['url']);
					imgitem.find('input').val(data['attachment']);
				});
			});
		});
	}
</script>
<script type="text/javascript" src="<?php  echo HYB_YL_ADMIN?>/js/showmodel.js"></script>
<script>
	$('input[name="nav[thumb]"]').attr('required','required');
	$("#reset").on('click',function(){
		$("#color").val('#666').trigger('propertychange');
	});
</script>