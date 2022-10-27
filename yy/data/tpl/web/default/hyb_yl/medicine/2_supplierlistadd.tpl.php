<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
	<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#tab_share">添加供应商</a></li>
              <li ><a href="<?php  echo $this->createWeburl('medicine',array('op'=>'supplierlist'))?>">供应商列表</a></li>
</ul>
<div class="app-content">
<div class="app-form">
	<form action="" method="post" class="form-horizontal form">
		<div class="panel-heading">供应商设置</div>
		<div class="tab-content">
			<div class="form-group">
								<label class="col-sm-2 control-label">供应商名称<span class="must-fill">*</span></label>
								<div class="col-sm-9">
									<input type="text" name="title" required="" class="form-control" value="<?php  echo $item['title'];?>">
								</div>
							</div>
          <div class="form-group">
								<label class="col-sm-2 control-label">所在区域<span class="must-fill">*</span></label>
								<div class="col-sm-9">
									<?php  echo tpl_form_field_district('address',array('province' =>$item['province'],'city'=>$item['city'],'district'=>$item['district']))?>
								</div>
							</div>
      <div class="form-group">
                            <label class="col-sm-2 control-label">联系电话</label>
                            <div class="col-sm-9">
                                <input type="text" name="telphone" placeholder="请输入联系电话" class="form-control" value="<?php  echo $item['telphone'];?>">
                            </div>
                        </div>
			<div class="form-group">
				<label class="col-sm-2 control-label">是否启用</label>
				<div class="col-sm-9">
					<label class="radio-inline">
						<input type="radio" class="form-control" name="status" value="1" <?php  if($item['status'] == '1') { ?> checked="checked" <?php  } ?>> 开启
					</label>
					<label class="radio-inline">
						<input type="radio" class="form-control" name="status" value="0" <?php  if($item['status'] == '0') { ?> checked="checked" <?php  } ?>> 关闭
					</label>
					
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
$(function () {
		window.optionchanged = false;
		$('#myTab a').click(function (e) {
			e.preventDefault();//阻止a链接的跳转行为
			$(this).tab('show');//显示当前选中的链接及关联的content
		})
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
