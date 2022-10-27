<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs">
		<li>
			<a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.docser&ac=docser&op=display">服务包列表</a>
		</li>
		<li class="active">
			<a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.docser&ac=docser&op=post">添加服务包</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-form">
			<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">

				<div class="panel panel-default">
					<div class="panel-heading">服务主页设置</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">选择服务</label>
						<div class="col-sm-9">
							<select name="url" class="form-control" id="selector">
							    <option value="" >选择服务</option>
								<option value="/hyb_yl/backstageServices/pages/shoushukuaiyue/shoushukuaiyue?key_words=shoushukuaiyue" data-title='手术快约' <?php if($res['url'] =='/hyb_yl/backstageServices/pages/shoushukuaiyue/shoushukuaiyue?key_words=shoushukuaiyue') { ?> selected="selected" <?php  } ?>> 手术快约</option>
								<option text='jQuery' value="/hyb_yl/backstageServices/pages/baogaojiedu/baogaojiedu?key_words=tijianjiedu" data-title='报告解读' <?php if($res['url'] =='/hyb_yl/backstageServices/pages/baogaojiedu/baogaojiedu?key_words=tijianjiedu') { ?> selected="selected" <?php  } ?>>报告解读</option>
								<option text='jQuery' value="/hyb_yl/czhuanjiasubpages/pages/longsever/index?key_words=jiatingyisheng" data-title='家庭医生' <?php if($res['url'] =='/hyb_yl/czhuanjiasubpages/pages/longsever/index?key_words=jiatingyisheng') { ?> selected="selected" <?php  } ?>> 家庭医生</option>
								<option text='jQuery' value="/hyb_yl/userCommunicate/pages/changeDoctor/changeDoctor?key_words=sirenyisheng" data-title='私人医生' <?php if($res['url'] =='/hyb_yl/userCommunicate/pages/changeDoctor/changeDoctor?key_words=sirenyisheng') { ?> selected="selected" <?php  } ?>>私人医生</option>
								<option text='jQuery' value="/hyb_yl/zhuanjiasubpages/pages/orderedtime/orderedtime?key_words=shipinwenzhen" data-title='视频咨询' <?php if($res['url'] =='/hyb_yl/zhuanjiasubpages/pages/orderedtime/orderedtime?key_words=shipinwenzhen') { ?> selected="selected" <?php  } ?>>视频咨询</option>
								<option text='jQuery' value="/hyb_yl/zhuanjiasubpages/pages/orderedtime/orderedtime?key_words=dianhuajizhen" data-title='电话咨询' <?php if($res['url'] =='/hyb_yl/zhuanjiasubpages/pages/orderedtime/orderedtime?key_words=dianhuajizhen') { ?> selected="selected" <?php  } ?>>电话咨询</option>
								<option text='jQuery' value="/hyb_yl/zhuanjiasubpages/pages/zhuanjiatiwen/zhuanjiatiwen?key_words=tuwenwenzhen" data-title='图文咨询' <?php if($res['url'] =='/hyb_yl/zhuanjiasubpages/pages/zhuanjiatiwen/zhuanjiatiwen?key_words=tuwenwenzhen') { ?> selected="selected" <?php  } ?>>图文咨询</option>
								<option text='jQuery' value="/hyb_yl/czhuanjiasubpages/pages/longsever/index?key_words=yuanchengguahao" data-title='在线挂号' <?php if($res['url'] =='/hyb_yl/czhuanjiasubpages/pages/longsever/index?key_words=yuanchengguahao') { ?> selected="selected" <?php  } ?>>在线挂号</option>
								<option text='jQuery' value="/hyb_yl/czhuanjiasubpages/pages/longsever/index?key_words=kuaisudaozhen" data-title='快速咨询' <?php if($res['url'] =='/hyb_yl/czhuanjiasubpages/pages/longsever/index?key_words=kuaisudaozhen') { ?> selected="selected" <?php  } ?>>快速咨询</option>

								<option text='jQuery' value="/hyb_yl/backstageServices/pages/yuanchengkaifang/yuanchengkaifang?key_words=yuanchengkaifang" data-title='在线开方' <?php if($res['url'] =='/hyb_yl/backstageServices/pages/yuanchengkaifang/yuanchengkaifang?key_words=yuanchengkaifang') { ?> selected="selected" <?php  } ?>>在线开方</option>
							</select>
						</div>
					</div>
					<script type="text/javascript">
					 $(function(){
					  //为Select添加事件，当选择其中一项时触发
					  $("select:eq(0)").change(function(){
						var text =$("select:eq(0) :selected").text() 
						console.log(text);
						$('input[name=titlme]').val(text)
						$('input[name=ftitle]').val(text)
					  });
                     });

					</script>
					<div class="form-group">
						<label class="col-sm-2 control-label">排序</label>
						<div class="col-sm-9">
							<input type="text" name="sort" placeholder="默认排序为0" class="form-control" value="<?php  echo $res['sort'];?>">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">服务包标题<span class="must-fill">*</span>
						</label>
						<div class="col-sm-9">
							<input type="text" name="titlme" required class="form-control" value="<?php  echo $res['titlme'];?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">服务描述<span class="must-fill">*</span>
						</label>
						<div class="col-sm-9">
							<input type="text" name="ftitle" required class="form-control" value="<?php  echo $res['ftitle'];?>">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">服务主页图片<span class="must-fill">*</span>
						</label>
						<div class="col-sm-9">
							<?php  echo tpl_form_field_image('thumb',$res['thumb'])?>
							<span class="help-block">建议图片大小为640*300，所有图片比例一样。</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">icon<span class="must-fill">*</span>
						</label>
						<div class="col-sm-9">
							<?php  echo tpl_form_field_image('icon',$res['icon'])?>
							<span class="help-block">建议图片大小为640*300，所有图片比例一样。</span>
						</div>
					</div>
					<div class="form-group" style="">
						<label class="col-sm-2 control-label">买前必读</label>
						<div class="col-sm-9" style="">
							<?php  echo tpl_ueditor('buyreading',$res['buyreading']);?>
						</div>
					</div>
					<div class="form-group" style="">
						<label class="col-sm-2 control-label">问诊协议</label>
						<div class="col-sm-9" style="">
							<?php  echo tpl_ueditor('server_content',$res['server_content']);?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">服务类型</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" name='type' value='0' <?php  if($res['type']=='0' ) { ?> checked="checked" <?php  } ?>>患者服务
									   </label>
									   <span class="help-block">在线挂号、手术快约、报告解读、快速问诊 请选择患者服务;</span>
							 <label class="radio-inline">
								<input type="radio" name='type' value='1' <?php  if($res['type']=='1' ) { ?> checked="checked" <?php  } ?>>患者问诊
						    </label>
						    <span class="help-block">电话问诊、视频问诊、图文问诊、在线开方 请选择患者问诊;</span>
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