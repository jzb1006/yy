<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#tab_basic">订单设置</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form form-validate">
			<div class="panel panel-default">
				<div class="panel-heading">订单设置</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">订单自动取消时间</label>
						<div class="col-sm-9">
							<div class="input-group">
								<input type="number" min="0" name="qx_time" class="form-control" value="<?php  echo $item['qx_time'];?>" />
								<span class="input-group-addon">分</span>
							</div>
							<span class="help-block">下单后超过此时间未支付，订单自动取消,不填或填0默认为10分钟。</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">订单过期提醒时间</label>
						<div class="col-sm-9">
							<div class="input-group">
								<input type="number" min="0" name="gq_time" class="form-control" value="<?php  echo $item['gq_time'];?>" />
								<span class="input-group-addon">时</span>
							</div>
							<span class="help-block">订单在此时间后过期时，提前发送过期提醒，不填或填0默认为48小时。</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">自动收货时间</label>
						<div class="col-sm-9">
							<div class="input-group">
								<input type="number" min="0" name="sh_time" class="form-control" value="<?php  echo $item['sh_time'];?>" />
								<span class="input-group-addon">天</span>
							</div>
							<span class="help-block">发货后超过时间的未确认收货订单将会标记为已签收,不填或填0则订单不会自动签收。</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">课程支付是否开启</label>
						<div class="col-sm-9">
							<label class="radio-inline"><input type="radio" name="kc_pay" value="1" <?php  if($item['kc_pay'] == '1') { ?> checked="" <?php  } ?>>开启</label>
							<label class="radio-inline"><input type="radio" name="kc_pay" value="0" <?php  if($item['kc_pay'] == '0' || !$item) { ?> checked="" <?php  } ?>>关闭</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">体检退款过期订单</label>
						<div class="col-sm-9">
							<label class="radio-inline"><input type="radio" name="tjgq_order" value="1" <?php  if($item['tjgq_order'] == '1') { ?> checked="" <?php  } ?>>开启</label>
							<label class="radio-inline"><input type="radio" name="tjgq_order" value="0" <?php  if($item['tjgq_order'] == '0' || !$item) { ?> checked="" <?php  } ?>>关闭</label>
							<span class="help-block">开启后,未使用过的过期订单会自动退款。</span>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-9">
					<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
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
