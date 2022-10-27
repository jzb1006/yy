<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li class="active"><a href="#">参数编辑</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form form-validate" >
			<div class="panel panel-default">
				<div class="panel-heading">类目行业： 医疗护理/医药医疗</div>
				<div class="panel-body">
					<div class="tab-content">
						<div class="form-group">
							<label class="col-sm-2 control-label">开发者ID(AppID)</label>
							<div class="col-sm-9">
								<input type="text" name="pub_appid" class="form-control" value="<?php  echo $base['pub_appid'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">开发者密码(AppSecret)</label>
							<div class="col-sm-9">
								<input type="text" name="appkey" class="form-control" value="<?php  echo $base['appkey'];?>" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">咨询请求通知模版ID</label>
							<div class="col-sm-9">
								<input type="text" name="mobel[templateid]" class="form-control" value="<?php  echo $moban_id['templateid'];?>" />
								<span class="help-block">标题搜索：咨询请求通知</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">处方开具成功通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[cfmobel]" class="form-control" value="<?php  echo $moban_id['cfmobel'];?>" />
								<span class="help-block">标题搜索：处方开具成功通知</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">退款申请通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[tkmoban]" class="form-control" value="<?php  echo $moban_id['tkmoban'];?>" />
								<span class="help-block">标题搜索：退款申请通知</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">医生已接诊通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[jzmoban]" class="form-control" value="<?php  echo $moban_id['jzmoban'];?>" />
								<span class="help-block">标题搜索：医生已接诊通知</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">医生回复通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[hfmoban]" class="form-control" value="<?php  echo $moban_id['hfmoban'];?>" />
								<span class="help-block">标题搜索：咨询反馈通知</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">体检预约成功提醒</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[tjmoban]" class="form-control" value="<?php  echo $moban_id['tjmoban'];?>" />
								<span class="help-block">标题搜索：预约成功通知 行业 医疗护理 - 医药医疗</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">体检预约成功通知管理员</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[yymoban]" class="form-control" value="<?php  echo $moban_id['yymoban'];?>" />
								<span class="help-block">标题搜索：预约通知 行业 医疗护理 - 医药医疗</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">体检取消预约通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[qxymoban]" class="form-control" value="<?php  echo $moban_id['qxymoban'];?>" />
								<span class="help-block">标题搜索：取消预约通知 行业 医疗护理 - 医药医疗</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">预约挂号成功通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[ghsmoban]" class="form-control" value="<?php  echo $moban_id['ghsmoban'];?>" />
								<span class="help-block">标题搜索：预约挂号成功通知 行业 医疗护理 - 医药医疗</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">预约挂号取消通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[qxghmoban]" class="form-control" value="<?php  echo $moban_id['qxghmoban'];?>" />
								<span class="help-block">标题搜索：预约挂号取消通知 行业 医疗护理 - 医药医疗</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">签约申请通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[qyghmoban]" class="form-control" value="<?php  echo $moban_id['qyghmoban'];?>" />
								<span class="help-block">标题搜索：签约申请通知 行业 医疗护理 - 医药医疗</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">签约成功通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[qysuccmoban]" class="form-control" value="<?php  echo $moban_id['qysuccmoban'];?>" />
								<span class="help-block">标题搜索：签约成功通知 行业 医疗护理 - 医药医疗</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">签约失败通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[qysbmoban]" class="form-control" value="<?php  echo $moban_id['qysbmoban'];?>" />
								<span class="help-block">标题搜索：签约失败通知 行业 医疗护理 - 医药医疗</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">发货提醒</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[fahuo]" class="form-control" value="<?php  echo $moban_id['fahuo'];?>" />
								<span class="help-block">标题搜索：签约失败通知 行业 医疗护理 - 医药医疗收货人：{{keyword1.DATA}收货手机：{{keyword2.DATA}} 收货地址：{{keyword3.DATA}}</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">信息核对通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[hedui]" class="form-control" value="<?php  echo $moban_id['hedui'];?>" />
								<span class="help-block">标题搜索：信息核对通知 行业 医疗护理 - 医药医疗 患者姓名：{{keyword1.DATA}} 医生：{{keyword2.DATA}} 核对事项：{{keyword3.DATA}}</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">复诊提醒</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[fuzhen]" class="form-control" value="<?php  echo $moban_id['fuzhen'];?>" />
								<span class="help-block">标题搜索：信息核对通知 行业 医疗护理 - 医药医疗 就诊人：{{keyword1.DATA}}复诊日期：{{keyword2.DATA}}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-9">
					<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					<input type="hidden" name="id" value="<?php  echo $base['id'];?>" />
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
	

	</body>
</html>
