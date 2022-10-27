<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
	<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li  class="active" ><a href="#">年卡规则</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form">
			<div class="panel panel-default">
				<div class="panel-heading">规则设置</div>
				<div class="tab-content">
					<div class="form-group">
						<label class="col-sm-2 control-label">是否启用年卡</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" id="inlineRadio1" name="status" <?php  if($item['status'] == '1') { ?> checked="" <?php  } ?> value="1" >开启
							</label>
							<label class="radio-inline">
								<input type="radio" id="inlineRadio2" name="status" <?php  if($item['status'] == '0') { ?> checked="" <?php  } ?> value="0">关闭
							</label>
						</div>
					</div>
                  	<div class="form-group">
						<label class="col-sm-2 control-label">医生设置免费问诊</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" id="inlineRadio1" name="is_wz" value="1" <?php  if($item['is_wz'] == '1') { ?> checked="" <?php  } ?>>开启
							</label>
							<label class="radio-inline">
								<input type="radio" id="inlineRadio2" name="is_wz" value="0" <?php  if($item['is_wz'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
						</div>
					</div>
                  	<div class="form-group">
						<label class="col-sm-2 control-label">医生设置问诊折扣</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" id="inlineRadio1" name="is_zk" value="1" <?php  if($item['is_zk'] == '1') { ?> checked="" <?php  } ?>>开启
							</label>
							<label class="radio-inline">
								<input type="radio" id="inlineRadio2" name="is_zk" value="0" <?php  if($item['is_zk'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
						</div>
					</div>
                  	<div class="form-group">
						<label class="col-sm-2 control-label">医生设置会话次数</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" id="inlineRadio1" name="is_hh" value="1" <?php  if($item['is_hh'] == '1') { ?> checked="" <?php  } ?>>开启
							</label>
							<label class="radio-inline">
								<input type="radio" id="inlineRadio2" name="is_hh" value="0" <?php  if($item['is_hh'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
						</div>
					</div>
                  	<div class="form-group">
						<label class="col-sm-2 control-label">医生设置解读次数</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" id="inlineRadio1" name="is_jd" value="1" <?php  if($item['is_jd'] == '1') { ?> checked="" <?php  } ?>>开启
							</label>
							<label class="radio-inline">
								<input type="radio" id="inlineRadio2" name="is_jd" value="0" <?php  if($item['is_jd'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
						</div>
					</div>
                  	<div class="form-group">
						<label class="col-sm-2 control-label">医生年卡免审核</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" id="inlineRadio1" name="is_ms" value="1" <?php  if($item['is_ms'] == '1') { ?> checked="" <?php  } ?>>开启
							</label>
							<label class="radio-inline">
								<input type="radio" id="inlineRadio2" name="is_ms" value="0" <?php  if($item['is_ms'] == '0') { ?> checked="" <?php  } ?>>关闭
							</label>
                          <span class="help-block">开启年卡免审核，时刻要注意费用问题</span>
						</div>
					</div>
				
					<div class="form-group">
						<label class="col-sm-2 control-label">年卡协议</label>
						<div class="col-sm-9">
							<?php  echo tpl_ueditor('content',$item['content']);?>		</div>
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

