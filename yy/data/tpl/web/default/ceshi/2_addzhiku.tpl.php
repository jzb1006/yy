<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs">
		<li>
			<a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.zhikucat&ac=zhikucat">类别列表</a>
		</li>
		<li <?php  if(empty($id)) { ?>class="active" <?php  } ?>> <a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addzhiku&ac=addzhiku">添加类别</a>
		</li>
		<?php  if(!empty($id)) { ?>
		<li class="active">
			<a href="#">编辑类别</a>
		</li>
		<?php  } ?>
	</ul>
	<div class="app-content">
		<div class="app-form">
			<form action="" method="post" class="form-horizontal form form-validate">
				<input type="hidden" name="id" value="" />
				<div class="panel panel-default">
					<div class="panel-heading">
						类别设置
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">类别名称<span class="must-fill">*</span>
							</label>
							<div class="col-sm-9">
								<input type="text" name="ctname" required placeholder="请输入类别名称" class="form-control" value="<?php  echo $res['ctname'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">类别描述</label>
							<div class="col-sm-9">
								<input type="text" name="describe" class="form-control" value="<?php  echo $res['describe'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">所属列表<span class="must-fill">*</span>
							</label>
							<div class="col-sm-9 col-xs-12">
             					<select name="typeint" class="form-control valid" aria-invalid="false">
                                    <option value="">请选择所属列表</option>
                                  	<option value="0" <?php  if($res['typeint']=='0') { ?> selected="selected" <?php  } ?>>科室类别</option>
                                  	<option value="1" <?php  if($res['typeint']=='1') { ?> selected="selected" <?php  } ?>>疾病类别</option>
                                  	<option value="2" <?php  if($res['typeint']=='2') { ?> selected="selected" <?php  } ?>>症状类别</option>
                                  	<option value="3" <?php  if($res['typeint']=='3') { ?> selected="selected" <?php  } ?>>疫苗类别</option>
                                  	<option value="4" <?php  if($res['typeint']=='4') { ?> selected="selected" <?php  } ?>>检查项类别</option>
                                  	<option value="5" <?php  if($res['typeint']=='5') { ?> selected="selected" <?php  } ?>>备药类别</option>
                                  	<option value="6" <?php  if($res['typeint']=='6') { ?> selected="selected" <?php  } ?>>传染病类别</option>
                                </select> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">是否开启</label>
							<div class="col-sm-9">
								<label class="radio-inline">
									<input type="radio" name="state" value="1" <?php  if($res['state']==1) { ?> checked='checked' <?php  } ?>>是
								</label>
								<label class="radio-inline">
									<input type="radio" name="state" value="0" <?php  if($res['state']==0) { ?> checked <?php  } ?>>否
										   </label>
										   </div>
										   </div>
										   <div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-9">
										<input type="submit" name="submit" lay-submit value="提交" class="btn btn-primary min-width" />
										<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                                        <input name="id" type="hidden" value="<?php  echo $id;?>" />
									</div>
							</div>
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

</body>
</html>