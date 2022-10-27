<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
	<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li  class="active" ><a href="#">入驻设置</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form">
			<div class="panel panel-default">
				<div class="panel-heading">入驻设置</div>
				<div class="tab-content">
                  	<div class="form-group">
						<label class="col-sm-2 control-label">入驻免审核</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" id="inlineRadio1" name="is_ruzhu" value="1" <?php  if($item['is_ruzhu'] == '1') { ?> checked="" <?php  } ?>>开启
							</label>
							<label class="radio-inline">
								<input type="radio" id="inlineRadio2" name="is_ruzhu" value="0" <?php  if($item['is_ruzhu'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
						</div>
					</div>
                  	<div class="form-group">
						<label class="col-sm-2 control-label">患教免审核</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" id="inlineRadio1" name="is_huanjiao" value="1" <?php  if($item['is_huanjiao'] == '1') { ?> checked="" <?php  } ?>>开启
							</label>
							<label class="radio-inline">
								<input type="radio" id="inlineRadio2" name="is_huanjiao" value="0" <?php  if($item['is_huanjiao'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
						</div>
					</div>
                  	<div class="form-group">
						<label class="col-sm-2 control-label">动态免审核</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" id="inlineRadio1" name="is_dongtai" value="1" <?php  if($item['is_dongtai'] == '1') { ?> checked="" <?php  } ?>>开启
							</label>
							<label class="radio-inline">
								<input type="radio" id="inlineRadio2" name="is_dongtai" value="0" <?php  if($item['is_dongtai'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
						</div>
					</div>
                  	<div class="form-group">
						<label class="col-sm-2 control-label">评论免审核</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" id="inlineRadio1" name="is_pinglun" value="1" <?php  if($item['is_pinglun'] == '1') { ?> checked="" <?php  } ?>>开启
							</label>
							<label class="radio-inline">
								<input type="radio" id="inlineRadio2" name="is_pinglun" value="0" <?php  if($item['is_pinglun'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
						</div>
					</div>
                  	<div class="form-group">
						<label class="col-sm-2 control-label">默认星级评分</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" id="inlineRadio1" name="score" value="1" <?php  if($item['score'] == '1') { ?> checked="" <?php  } ?>>开启
							</label>
							<label class="radio-inline">
								<input type="radio" id="inlineRadio2" name="score" value="0" <?php  if($item['score'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
                          <span class="help-block">默认是5分</span>
						</div>
					</div>
					<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">专家列表默认排序方式</label>
									<div class="col-sm-9 col-xs-12">
										<label class="radio-inline">
											<input type="radio" value="0" name="sort_type" <?php  if($item['sort_type'] == '0') { ?> checked="" <?php  } ?>> 综合评分排序
										</label>
										<label class="radio-inline">
											<input type="radio" value="1" name="sort_type" <?php  if($item['sort_type'] == '3') { ?> checked="" <?php  } ?>> 入驻时间
										</label>
										<label class="radio-inline">
											<input type="radio" value="2" name="sort_type"  <?php  if($item['sort_type'] == '2') { ?> checked="" <?php  } ?>> 附近优先
										</label>
									</div>
								</div>
<!-- 					<div class="form-group">
						<label class="col-sm-2 control-label">入驻条款</label>
						<div class="col-sm-9">
							<?php  echo tpl_ueditor('rz_content',$item['rz_content']);?>	</div>
					</div> -->
<!-- 					<div class="form-group">
						<label class="col-sm-2 control-label">电话分钟数</label>
						<div class="col-sm-9">
								<input type="number" name="rz_content" class="form-control" value="<?php  echo $item['rz_content'];?>" />			
							</div>
					</div> -->
					<div class="form-group">
						<label class="col-sm-2 control-label">专家抽成</label>
						<div class="col-sm-9">
							<div class="input-group">
								<input type="number" name="fee" class="form-control" value="<?php  echo $item['fee'];?>" />
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">专家海报背景图</label>
						<div class="col-sm-9">
							<?php  echo tpl_form_field_image('background',$item['background']);?>						
							</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-9">
					<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
					<input type="hidden" name="token" value="da1c10f4" />
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
            <li class="links_item"><div class="copyright">Powered by <a href="http://www.we7.cc"><b>系统</b></a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a></div></li>
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

