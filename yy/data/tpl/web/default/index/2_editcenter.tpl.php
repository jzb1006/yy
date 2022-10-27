<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li>
	<?php  if(empty($pid)) { ?>
	<a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.mycenter&ac=mycenter">个人菜单</a>
	<?php  } else { ?>
	<a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.erjicenter&ac=erjicenter&pid=<?php  echo $pid;?>">二级菜单</a>
	<?php  } ?>
	</li>
	<li <?php  if(empty($id)) { ?>class="active"<?php  } ?>><a href="">添加个人菜单</a></li>
	<?php  if(!empty($id)) { ?>
	<li class="active"><a href="#">编辑个人菜单</a></li>
	<?php  } ?>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
			<input type="hidden" name="id" value="<?php  echo $id;?>" />
			<div class="panel panel-default">
				<div class="panel-heading">个人菜单设置</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">排序</label>
					<div class="col-sm-9">
						<input type="text" name="sort" placeholder="默认排序为0" class="form-control" value="<?php  echo $item['sort'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">标题<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="title" required class="form-control" value="<?php  echo $item['title'];?>" >
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
					<label class="col-sm-2 control-label">菜单位置</label>
					<div class="col-sm-9">
					<input type="hidden" name="type" value="<?php  echo $type;?>">
						<select name="type" onchange="changetype()" id="one" class="form-control" <?php  if($pid != '0' && !empty($pid)) { ?> disabled="" <?php  } ?>>
							<option value="0" <?php  if($item['type'] == 0 || $type == 0) { ?> selected="selected" <?php  } ?> >个人中心</option>
							<option value="1" <?php  if($item['type'] == '1' || $type == '1') { ?> selected="selected" <?php  } ?> >专家中心</option>
							<option value="2" <?php  if($item['type'] == '2' || $type == '2') { ?> selected="selected" <?php  } ?> >机构中心</option>
							
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">上级菜单</label>
					<div class="col-sm-9">
						<select name="pid" class="form-control" id="two">
							<option value=''>请选择上级菜单</option>
							<?php  if(is_array($parent)) { foreach($parent as $par) { ?>
							<option value="<?php  echo $par['id'];?>" <?php  if($item['pid'] == $par['id']) { ?> selected="selected" <?php  } ?> ><?php  echo $par['title'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >导航连接</label>
					<div class="col-sm-9">
						<!-- <div class="input-group"> -->
							<input type="text"  class="form-control valid" id="advlink_2"  name="url"  value="<?php  echo $item['url'];?>"/>
							<span class="input-group-btn">
								<span data-input="#advlink_2" data-toggle="selectUrl" class="btn btn-default btnurl">选择链接</span>
							</span>
							<!-- <span data-input="#advlink" data-toggle="selectUrl" class="input-group-addon btn btn-default">选择链接</span> -->
						<!-- </div> -->
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
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/centermenu', TEMPLATE_INCLUDEPATH)) : (include template('./common/centermenu', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript">
	$(function(){
		bindEvents();
		url_system();
		hideModal();

	});
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
	function changetype()
	{
		var type = $("#one option:selected").val();
		$.ajax({
			'url':"/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.onecenter&ac=mycenter",
			data:{
				type:type
			},
			dataType:"json",
			type:"get",
			success:function(res){
				var html = '';
				for(var i=0;i<res.length;i++)
				{
					html += "<option value=''>请选择上级菜单</option>";
					html += "<option value="+res[i].id +">"+ res[i]['title'] +"</option>";
				}
				$("#two").html(html);
			}
		})
	}
</script>