<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs">
		<li>
			<a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.cube&ac=cube">服务主页列表</a>
		</li>
		<li class="active">
			<a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.cubeedit&ac=cubeedit">添加服务主页</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-form">
			<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
				<input type="hidden" name="id" value="" />
				<input type="hidden" name="cateid" value="0" />
				<div class="panel panel-default">
					<div class="panel-heading">服务主页设置</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">排序</label>
						<div class="col-sm-9">
							<input type="text" name="stort" placeholder="默认排序为0" class="form-control" value="<?php  echo $res['stort'];?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">服务主页标题<span class="must-fill">*</span>
						</label>
						<div class="col-sm-9">
							<input type="text" name="serh_name" required class="form-control" value="<?php  echo $res['serh_name'];?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">副标题<span class="must-fill">*</span>
						</label>
						<div class="col-sm-9">
							<input type="text" name="serh_ftitle" required class="form-control" value="<?php  echo $res['serh_ftitle'];?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">选择服务</label>
						<div class="col-sm-9">
							<select name="ids" class="form-control">
							    <option value="/hyb_yl/tabBar/index/index">小程序首页</option>
							    <?php  if(is_array($row)) { foreach($row as $item) { ?>
								<option value="<?php  echo $item['ids'];?>" <?php  if($item['ids']==$res['ids']) { ?> selected="selected" <?php  } ?>><?php  echo $item['titles'];?></option>
							    <?php  } } ?> 
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">选择展示位置</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" name='weizhi' value='1' <?php  if($res['weizhi']=='1' ) { ?> checked="checked" <?php  } ?>>首页
							</label>
							<label class="radio-inline">
								<input type="radio" name='weizhi' value='0' <?php  if($res['weizhi']=='0' || !$res ) { ?> checked="checked" <?php  } ?>>问诊页
							</label>
							<label class="radio-inline">
								<input type="radio" name='weizhi' value='2' <?php  if($res['weizhi']=='2' || !$res ) { ?> checked="checked" <?php  } ?>>绿通页
							</label>
						  </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">服务主页图片<span class="must-fill">*</span>
						</label>
						<div class="col-sm-9">
							<?php  echo tpl_form_field_image('serh_thumb',$res['serh_thumb'])?>
							<span class="help-block">建议图片大小为640*300，所有图片比例一样。</span>
						</div>
					</div>
					<div class="form-group" style="">
						<label class="col-sm-2 control-label">服务内容/保障服务</label>
						<div class="col-sm-9" style="">
							<?php  echo tpl_ueditor('serh_content',$res['serh_content']);?>
							<span class="help-block">设置处方主页时，不展示</span>
						</div>
					</div>
						
					<div class="form-group" style="">
						<label class="col-sm-2 control-label">服务流程/出诊方式</label>
						<div class="col-sm-9" style="">
							<?php  echo tpl_ueditor('serh_liuc',$res['serh_liuc']);?>
							<span class="help-block">设置处方主页时，填写这一项即可，其余不展示</span>
						</div>
					
					</div>
					
					<div class="form-group" style="">
						<label class="col-sm-2 control-label">服务协议</label>
						<div class="col-sm-9" style="">
							<?php  echo tpl_ueditor('serh_xiey',$res['serh_xiey']);?>
						</div>
					</div>
					<div class="form-group" style="">
						<label class="col-sm-2 control-label">退款协议</label>
						<div class="col-sm-9" style="">
							<?php  echo tpl_ueditor('tui_money',$res['tui_money']);?>
							<span class="help-block">设置处方主页时，退款协议不展示</span>
						</div>
					</div>
						
					<div class="form-group">
						<label class="col-sm-2 control-label">是否显示</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" name='state' value='1' <?php  if($res['state']=='1' ) { ?> checked="checked" <?php  } ?>>是
									   </label>
									   <label class="radio-inline">
								<input type="radio" name='state' value='0' <?php  if($res['state']=='0' ) { ?> checked="checked" <?php  } ?>>否
							</label>
						</div>
					</div>
					</div>
					 <div class="form-group">
						<label class="col-sm-2 control-label"></label>
							<div class="col-sm-9">
								<input type="submit" name="submit" lay-submit value="提交" class="btn btn-primary min-width" />
								<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
								<input type="hidden" name="id" value="<?php  echo $id;?>" />
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



<script>
	require(['bootstrap'], function ($) {
				    $('[data-toggle="tooltip"]').tooltip({
			            container: $(document.body)
			        });
			        $('[data-toggle="popover"]').popover({
			            container: $(document.body)
			        });
			        $('[data-toggle="dropdown"]').dropdown({
			            container: $(document.body)
			        });
			    });
				myrequire(['js/init']);
				$('.app-login-info-name, .app-login-info-sel').mouseover(function(){
					$('.app-login-info-sel').show();
				});
				$('.app-login-info-name, .app-login-info-sel').mouseout(function(){
					$('.app-login-info-sel').hide();
				});
				$('.app-login-info-sel .login-out').hover(function(){
					$('.app-login-info-sel-arrow').css('border-color', '#1ab394 transparent transparent transparent');
				},function(){
					$('.app-login-info-sel-arrow').css('border-color', '#f2f2f2 transparent transparent transparent');
				});
</script>
</body>
</html>