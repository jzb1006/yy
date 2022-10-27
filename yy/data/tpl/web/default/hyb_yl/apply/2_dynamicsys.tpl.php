<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#tab_basic">基本设置</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
			<form action="" method="post" class="form-horizontal" id="setting-form">
				<div class="panel panel-default">
					<div class="panel-heading">基本设置</div>
					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane active" id="tab_basic">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否免审核</label>
                                    <div class="col-sm-9 col-xs-12">
                                        <label class="radio-inline">
                                            <input type="radio" value="1" name="is_shenhe" <?php  if($item['is_shenhe']=='1') { ?>  checked="checked" <?php  } ?>> 开启
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" value="0" name="is_shenhe" <?php  if($item['is_shenhe']=='0' || empty($item['is_shenhe'])) { ?>  checked="checked" <?php  } ?> > 禁用
                                        </label>
                                    </div>
                                </div>
								<div class="form-group search_float" >
									<label class="col-sm-2 control-label">是否启用</label>
									<div class="col-sm-9">
										<label class="radio-inline">
											<input type="radio" value="1" name="is_status" <?php  if($item['is_status']=='1') { ?>  checked="checked" <?php  } ?> > 是
										</label>
										<label class="radio-inline">
											<input type="radio" value="0" name="is_status" <?php  if($item['is_status']=='0' || empty($item['is_status'])) { ?>  checked="checked" <?php  } ?> > 否
										</label>
										<span class="help-block">不启用时不可以发布动态</span>
									</div>
								</div>
							

							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-9">
						<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
						<input type="hidden" name="token" value="c5514e9f" />
					</div>
				</div>
			</form>
	</div>
</div>
<script>
	$(function() {
		window.optionchanged = false;
		$('#myTab a').click(function(e) {
			e.preventDefault(); //阻止a链接的跳转行为
			$(this).tab('show'); //显示当前选中的链接及关联的content
		})
	});
    //监听搜索框是否启用
    $("[name='store_set[search]']").change(function () {
        var val = $(this).val();
        if(val == 1){
            $(".form-group.search_float").hide();
            $(".form-group.search_bgColor").hide();
        }else{
            $(".form-group.search_float").show();
            if($("[name='store_set[search_float]']:checked").val() == 1){
                $(".form-group.search_bgColor").show();
            }else{
                $(".form-group.search_bgColor").hide();
            }
        }
    });
    //监听搜索框是否浮动
    $("[name='store_set[search_float]']").change(function () {
        var val = $(this).val();
        if(val == 1){
            $(".form-group.search_bgColor").show();
        }else{
            $(".form-group.search_bgColor").hide();
        }
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