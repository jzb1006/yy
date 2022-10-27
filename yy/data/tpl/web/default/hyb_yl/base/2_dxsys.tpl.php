<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li class="active"><a href="#">短信参数编辑</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form form-validate" >
			<div class="panel panel-default">
				<div class="panel-heading">参数设置</div>
				<div class="panel-body">
					<div class="tab-content">
						<div class="form-group">
							<label class="col-sm-2 control-label">短信配置说明</label>
							<div class="col-sm-9">
								<div class="alert alert-warning">注: 仅支持阿里云或阿里大于，仅阿里云支持海外短信服务，阿里大于不支持。</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">appkey（AccessKeyId）</label>
							<div class="col-sm-9">
								<input type="text" name="key" class="form-control" value="<?php  echo $res['key'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">secretKey（AccessKeySecret）</label>
							<div class="col-sm-9">
								<input type="text" name="scret" class="form-control" value="<?php  echo $res['scret'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">短信签名</label>
							<div class="col-sm-9">
								<input type="text" name="qianming" class="form-control" value="<?php  echo $res['qianming'];?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">管理员手机号</label>
							<div class="col-sm-9">
								<input type="text" name="tel" class="form-control" value="<?php  echo $res['tel'];?>" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">问诊短息消息模板ID</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[templateid]" class="form-control" value="<?php  echo $moban_id['templateid'];?>" />
								<span class="help-block">通知管理员：手机号为${content},姓名为${name}的用户预约了${ksname}科室的${doctor}医生</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">提现申请通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[txmobel]" class="form-control" value="<?php  echo $moban_id['txmobel'];?>" />
								<span class="help-block">通知管理员：您好，您的有一条新的提现申请，请及时查看。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">退款申请通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[tkmoban]" class="form-control" value="<?php  echo $moban_id['tkmoban'];?>" />
								<span class="help-block">通知管理员：您好，您有一条心的退款申请，请及时查看。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">入驻申请通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[rzmobel]" class="form-control" value="<?php  echo $moban_id['rzmobel'];?>" />
								<span class="help-block">通知管理员：您好，您有一条待审核信息，请及时查看。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">验证码模板ID</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[moban_id]" class="form-control" value="<?php  echo $moban_id['moban_id'];?>" />
								<span class="help-block">通知手机验证的用户/专家：您的验证码为${code}，请在5分钟之内输入。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">签约申请通知id</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[qymobel]" class="form-control" value="<?php  echo $moban_id['qymobel'];?>" />
								<span class="help-block">通知专家患者签约：姓名为${name}的用户，发起了签约申请，请及时查看</span>
							</div>
						</div>
							<div class="form-group">
							<label class="col-sm-2 control-label">签约通过通知id</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[tgqymobel]" class="form-control" value="<?php  echo $moban_id['tgqymobel'];?>" />
								<span class="help-block">通知患者：您好，您申请的签约已被${name}的医生，通过了，请及时查看沟通</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">患者解约通知id</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[jymobel]" class="form-control" value="<?php  echo $moban_id['jymobel'];?>" />
								<span class="help-block">通知专家：您好，姓名为${name}的用户，解约了您。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">问诊通知id</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[wzmobel]" class="form-control" value="<?php  echo $moban_id['wzmobel'];?>" />
								<span class="help-block">通知专家：您好，姓名为${name}的用户，发起了咨询，请在${time}分钟内回复。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">接诊通知id</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[jzmobel]" class="form-control" value="<?php  echo $moban_id['jzmobel'];?>" />
								<span class="help-block">通知用户：您好，您的订单为${orderid}，已经被${name}的专家接诊，请在${time}分钟内回复。</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">问诊取消通知id</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[qzjzmobel]" class="form-control" value="<?php  echo $moban_id['qzjzmobel'];?>" />
								<span class="help-block">通知专家：您好，姓名为${name}的用户，取消了咨询，望下次再接再厉。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">入驻审核通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[rzshmobel]" class="form-control" value="<?php  echo $moban_id['rzshmobel'];?>" />
								<span class="help-block">通知专家：您好${name}，您的入驻申请已经通过，请及时完善资料</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">视频通话通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[spmobel]" class="form-control" value="<?php  echo $moban_id['spmobel'];?>" />
								<span class="help-block">通知专家：您好姓名为${name}的用户，向您发起视频，请在${time}分钟内进行回复。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">电话通话通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[telmobel]" class="form-control" value="<?php  echo $moban_id['telmobel'];?>" />
								<span class="help-block">通知专家：您好姓名为${name}的用户，向您发起语音，请在${time}分钟内进行回复。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">开方通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[kfmobel]" class="form-control" value="<?php  echo $moban_id['kfmobel'];?>" />
								<span class="help-block">通知专家：您好姓名为${name}的用户，邀请您来推荐产品，请在${time}分钟内进行回复。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">开方完成通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[kfovermobel]" class="form-control" value="<?php  echo $moban_id['kfovermobel'];?>" />
								<span class="help-block">通知用户：您好姓名为${name}的专家，已推荐产品，请在${time}分钟内进行回复。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">报告解读通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[bgmobel]" class="form-control" value="<?php  echo $moban_id['bgmobel'];?>" />
								<span class="help-block">通知专家：您好姓名为${name}的用户，邀请你解读报告，请在${time}分钟内进行回复。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">解读完成通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[bgjdmobel]" class="form-control" value="<?php  echo $moban_id['bgjdmobel'];?>" />
								<span class="help-block">通知用户：您好姓名为${name}的专家，已完成报告解读，请及时查看。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">处方审核通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[cfmobel]" class="form-control" value="<?php  echo $moban_id['cfmobel'];?>" />
								<span class="help-block">通知药师：您好，您有新的订单，请及时查看。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">处方审核完成通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[cfshmobel]" class="form-control" value="<?php  echo $moban_id['cfshmobel'];?>" />
								<span class="help-block">通知医生/用户：您好，您的订单，已经通过审核请及时查看。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">退款通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[tkmobel]" class="form-control" value="<?php  echo $moban_id['tkmobel'];?>" />
								<span class="help-block">通知用户：您好，您的订单${orderid}，已经退款成功请及时查看。</span>
							</div>
						</div>
							<div class="form-group">
							<label class="col-sm-2 control-label">提现通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[txtzmobel]" class="form-control" value="<?php  echo $moban_id['txtzmobel'];?>" />
								<span class="help-block">通知专家/药师/导诊：您好，您的收益已经提现成功，请及时查看。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">体检下单通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[tjxdmobel]" class="form-control" value="<?php  echo $moban_id['tjxdmobel'];?>" />
								<span class="help-block">通知用户：您好${name}，您的预约时间是${time}，请务必及时到。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">体检订单通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[tjmobel]" class="form-control" value="<?php  echo $moban_id['tjmobel'];?>" />
								<span class="help-block">通知机构：您好${name}的用户，手机号为${tel}预约了${taocantitle}的套餐，预约时间是${time}，请务必及时查看。</span>
							</div>
						</div>
<div class="form-group">
							<label class="col-sm-2 control-label">体检取消通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[tjqxmobel]" class="form-control" value="<?php  echo $moban_id['tjqxmobel'];?>" />
								<span class="help-block">通知机构：您好${name}的用户，手机号为${tel}取消了${taocantitle}的套餐，取消时间是${time}，请务必及时查看。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">挂号通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[ghmobel]" class="form-control" value="<?php  echo $moban_id['ghmobel'];?>" />
								<span class="help-block">通知机构/专家：您好${name}的用户，手机号为${tel}预约了${keshi}的${name}医生，预约时间是${time}，请务必及时查看。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">挂号取消通知</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[ghqxmobel]" class="form-control" value="<?php  echo $moban_id['ghqxmobel'];?>" />
								<span class="help-block">通知机构/专家：您好${name}的用户，手机号为${tel}取消了${keshi}的${name}医生，请务必及时查看。</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">药品订单模板ID</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[ypmobel]" class="form-control" value="<?php  echo $moban_id['ypmobel'];?>" />
								<span class="help-block">通知管理员：手机号为${content},姓名为${name}的用户购买了${productname},请及时发货</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">药品发货模板ID</label>
							<div class="col-sm-9">
							
								<input type="text" name="mobel[ypfhmobel]" class="form-control" value="<?php  echo $moban_id['ypfhmobel'];?>" />
								<span class="help-block">通知用户：您购买的${productname}，已经发货，物流单号为${orderwl},物流公司为${company},发货时间为${time}</span>
							</div>
						</div>
<!-- 						<div class="form-group note_quhao" style="display: none;">
							<label class="col-sm-2 control-label">国际区号</label>
							<div class="col-sm-9">
								<input type="text" name="note_quhao" class="form-control" value="" />
								<span class="help-block">请添加所有需要发送的国家的国际区号，例如我们需要添加中国和韩国则填入：86,82。</span>
							</div>
						</div> -->
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-9">
					<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					<input type="hidden" name="id" value="<?php  echo $res['id'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<!-- <script type="text/javascript">
$(".js-switch").change(function() { 
	if($('.js-switch').is(':checked')) {
    	$('.note_quhao').show();
	} else {
		$('.note_quhao').hide();
	}
});
</script> -->
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
