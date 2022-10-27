<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li><a href="/index.php?c=site&a=entry&do=physical&op=sort&ac=sort&m=hyb_yl">分类列表</a></li>
	<li class="active"><a href="/index.php?c=site&a=entry&do=physical&op=sortadd&ac=sortadd&m=hyb_yl">添加分类</a></li>
	</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
			<div class="panel panel-default" id="step1">
				<div class="panel-heading">分类管理</div>
				<div class="panel-body">
										<div class="form-group">
						<label class="col-sm-2 control-label">分类名称<span class="must-fill">*</span></label>
						<div class="col-sm-9">
							<input type="text" name="title" required autocomplete="off" class="form-control" value="<?php  echo $item['title'];?>">
						</div>
					</div>
                  	
					<div class="form-group">
						<label class="col-sm-2 control-label">分类图片</label>
						<div class="col-sm-9">
							<?php  echo tpl_form_field_image('thumb', $item['thumb'])?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">icon</label>
						<div class="col-sm-9">
							<?php  echo tpl_form_field_image('icon', $item['icon'])?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否开启</label>
						<div class="col-sm-9">
                            <label class="radio-inline">
                                <input type="radio" name='status' value='1' <?php  if($item['status'] == '1') { ?> checked="" <?php  } ?>>开启
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name='status' value='0' <?php  if($item['status'] == '0') { ?> checked="" <?php  } ?>>关闭
                            </label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否推荐</label>
						<div class="col-sm-9">
                            <label class="radio-inline">
                                <input type="radio" name='is_tuijian' value='1' <?php  if($item['is_tuijian'] == '1') { ?> checked="" <?php  } ?>>开启
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name='is_tuijian' value='0' <?php  if($item['is_tuijian'] == '0') { ?> checked="" <?php  } ?>>关闭
                            </label>
						</div>
					</div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-9">
                            <input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
                            <input type="hidden" name="token" value="c5514e9f" />
                        </div>
                    </div>
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

