<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#tab_basic">充值设置</a></li>
</ul>
<div class="app-content">
<div class="app-form">
	<form action="" method="post" class="form-horizontal form form-validate" id="setting-form">
		<div class="panel panel-default">
			<div class="panel-heading">充值设置</div>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_basic">
					<div class="form-group">
						<label class="col-sm-2 control-label">余额充值</label>
						<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" onclick="$('#set_list').show()" id="inlineRadio1" name="status" <?php  if($item['status'] == '1') { ?> checked="checked" <?php  } ?> value="1" >开启
							</label>
							<label class="radio-inline">
								<input type="radio" onclick="$('#set_list').hide()" id="inlineRadio2" name="status" value="0"  <?php  if($item['status'] == '0') { ?> checked="checked" <?php  } ?>>关闭
							</label>
						</div>
					</div>

					<?php  if($item['status'] == 1) { ?>

					<div id="set_list">
						<div id="newrule">
							<?php  if(is_array($item['content'])) { foreach($item['content'] as $key => $con) { ?>
							<div class="form-group tag contents">
				                <label class="col-sm-2 control-label">充值优惠</label>
				                <div class="col-sm-9">
					                <div class="input-group">
						                <span class="input-group-addon">满</span>
						                <input type="text" class="form-control" name="recharge[<?php  echo $key;?>][min]" value="<?php  echo $con['min'];?>">
						                <span class="input-group-addon">送</span>
						                <input type="text" class="form-control" name="recharge[<?php  echo $key;?>][song]"  value="<?php  echo $con['song'];?>">
						                <span class="input-group-addon">元</span>
						                <div class="col-sm-1">
							                <span class="btn btn-default btn-add-type2 delrule" >
							                <i class="fa fa-remove delrule"></i>
							                </span>
						                </div>
					                </div>
				                </div>
			                </div>
			                <?php  } } ?>
						</div>
						<div class="form-group formone">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-9">
								<div class="input-group">
									<a class=" btn btn-default btn-add-type2" href="javascript:;" id="addrule">
										<i class="fa fa-plus" title=""></i>增加一条优惠
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php  } ?>
					<div id="set_list" style="display:none;">
						<div id="newrule"></div>
						<div class="form-group formone">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-9">
							<div class="input-group">
								<a class=" btn btn-default btn-add-type2" href="javascript:;" id="addrule">
									<i class="fa fa-plus" title=""></i>增加一条优惠
								</a>
							</div>
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
				<input type="hidden" name="token" value="da1c10f4" />
			</div>
		</div>
	</form>
</div>
</div>
<script>
$(function () {
		window.optionchanged = false;
		$('#myTab a').click(function (e) {
			e.preventDefault();//阻止a链接的跳转行为
			$(this).tab('show');//显示当前选中的链接及关联的content
		})
	});
	
	$('#addrule').click(function(){
		var length = document.querySelectorAll('.contents').length;
		console.log(length);

		var html='';
			html+=
			'<div class="form-group tag contents">\n' +
                '\t\t\t\t\t\t<label class="col-sm-2 control-label">充值优惠</label>\n' +
                '\t\t\t\t\t\t<div class="col-sm-9">\n' +
                '\t\t\t\t\t\t\t<div class="input-group">\n' +
                '\t\t\t\t\t\t\t\t<span class="input-group-addon">满</span>\n' +
                '\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="recharge['+length+'][min]" value="">\n' +
                '\t\t\t\t\t\t\t\t<span class="input-group-addon">送</span>\n' +
                '\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="recharge['+length+'][song]"  value="">\n' +
                '\t\t\t\t\t\t\t\t<span class="input-group-addon">元</span>\n' +
                '\t\t\t\t\t\t\t\t<div class="col-sm-1">\n' +
                '\t\t\t\t\t\t\t\t<span class="btn btn-default btn-add-type2 delrule" >\n' +
                '\t\t\t\t\t\t\t\t\t\t<i class="fa fa-remove delrule"></i>\n' +
                '\t\t\t\t\t\t\t\t</span>\n' +
                '\t\t\t\t\t\t\t\t</div>\n' +
                '\t\t\t\t\t\t\t</div>\n' +
                '\t\t\t\t\t\t</div>\n' +
                '\t\t\t\t\t</div>';
		$('#newrule').append(html);	
	})
	$(document).on('click', '.delrule', function() {
		$(this).closest('.tag').remove();
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
	
	

	</body>
</html>