<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li ><a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.adv&ac=adv">幻灯片</a></li>
	<li <?php  if(empty($id)) { ?>class="active"<?php  } ?>><a href="">添加幻灯片</a></li>
	<?php  if(!empty($id)) { ?>
	<li class="active"><a href="#">编辑幻灯片</a></li>
	<?php  } ?>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
			<input type="hidden" name="id" value="<?php  echo $id;?>" />
			<div class="panel panel-default">
				<div class="panel-heading">幻灯片设置</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">排序</label>
					<div class="col-sm-9">
						<input type="text" name="sort" placeholder="默认排序为0" class="form-control" value="<?php  echo $adv['sort'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">导航栏标题<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="title" class="form-control" value="<?php  echo $adv['title'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">图片<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<?php  echo tpl_form_field_image('thumb', $adv['thumb'])?>
						<span class="help-block">建议图片大小80*80</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >幻灯片连接</label>
					<div class="col-sm-9">
						<!-- <div class="input-group"> -->
							<input type="text"  class="form-control valid" id="advlink_2"  name="link"  value="<?php  echo $adv['link'];?>"/>
							<span class="input-group-btn">
								<span data-input="#advlink_2" data-toggle="selectUrl" class="btn btn-default btnurl">选择链接</span>
							</span>
							<!-- <span data-input="#advlink" data-toggle="selectUrl" class="input-group-addon btn btn-default">选择链接</span> -->
						<!-- </div> -->
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">导航栏位置</label>
					<div class="col-sm-9">
						<select name="position" class="form-control">
							<option value="0" <?php  if($adv['position'] == 0 || empty($adv['position'])) { ?> selected="selected" <?php  } ?> >首页位置1</option>
							<option value="1" <?php  if($adv['position'] == '1') { ?> selected="selected" <?php  } ?> >首页位置2</option>
							<option value="2" <?php  if($adv['position'] == '2') { ?> selected="selected" <?php  } ?> >首页位置3</option>
							<option value="3" <?php  if($adv['position'] == '3') { ?> selected="selected" <?php  } ?> >体检首页</option>
							<!--<option value="4" <?php  if($adv['position'] == '4') { ?> selected="selected" <?php  } ?> >看一看</option>-->
							<!--<option value="5" <?php  if($adv['position'] == '5') { ?> selected="selected" <?php  } ?> >积分</option>-->
							<option value="6" <?php  if($adv['position'] == '6') { ?> selected="selected" <?php  } ?> >专家首页位置1</option>
							<option value="7" <?php  if($adv['position'] == '7') { ?> selected="selected" <?php  } ?> >专家首页位置2</option>
							<option value="8" <?php  if($adv['position'] == '8') { ?> selected="selected" <?php  } ?> >专家首页位置3</option>
							<option value="9" <?php  if($adv['position'] == '9') { ?> selected="selected" <?php  } ?> >推客首页</option>
							<option value="10" <?php  if($adv['position'] == '10') { ?> selected="selected" <?php  } ?> >患教首页</option>
							<option value="11" <?php  if($adv['position'] == '11') { ?> selected="selected" <?php  } ?> >查疾病</option>
							<option value="12" <?php  if($adv['position'] == '12') { ?> selected="selected" <?php  } ?> >查症状</option>
							<option value="13" <?php  if($adv['position'] == '13') { ?> selected="selected" <?php  } ?> >查疫苗</option>
							<option value="14" <?php  if($adv['position'] == '14') { ?> selected="selected" <?php  } ?> >体检解读</option>
							<option value="15" <?php  if($adv['position'] == '15') { ?> selected="selected" <?php  } ?> >家庭常备药</option>
							<option value="16" <?php  if($adv['position'] == '16') { ?> selected="selected" <?php  } ?> >法定传染病</option>
							<option value="17" <?php  if($adv['position'] == '17') { ?> selected="selected" <?php  } ?> >院后服务</option>
							<option value="18" <?php  if($adv['position'] == '18') { ?> selected="selected" <?php  } ?> >绿色通道</option>
							<option value="19" <?php  if($adv['position'] == '19') { ?> selected="selected" <?php  } ?> >商品首页</option>
							<option value="20" <?php  if($adv['position'] == '20') { ?> selected="selected" <?php  } ?> >问诊主页</option>
							<option value="21" <?php  if($adv['position'] == '21') { ?> selected="selected" <?php  } ?> >机构入驻页</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">外链小程序appid</label>
					<div class="col-sm-9">
						<input type="text" name="appid" class="form-control" value="<?php  echo $adv['appid'];?>" >
						<span class="help-block">外链小程序和幻灯片链接二选一</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">外链地址</label>
					<div class="col-sm-9">
						<input type="text" name="url" class="form-control" value="<?php  echo $adv['url'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">外链参数</label>
					<div class="col-sm-9">
						<input type="text" name="data" class="form-control" value="<?php  echo $adv['data'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">是否显示</label>
					<div class="col-sm-9">
						<div class="radio-inline">
							<input type="radio" name='status' value='1' <?php  if($adv['status']==1) { ?>checked<?php  } ?>>是
						</div>
						<div class="radio-inline">
							<input type="radio" name='status' value='0' <?php  if($adv['status']==0) { ?>checked<?php  } ?>>否
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
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/menulist', TEMPLATE_INCLUDEPATH)) : (include template('./common/menulist', TEMPLATE_INCLUDEPATH));?>
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
</script>