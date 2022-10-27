<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#tab_basic">问诊设置</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form form-validate">
			<div class="panel panel-default">
				<div class="panel-heading">问诊设置</div>
				<div class="panel-body">
					<div class="form-group"  style="display: block;">
						<label class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">未支付订单超过取消</label>
						<div class="col-md-8" style="padding-right: 0;">
							<div class="input-group col-md-3">
								<input type="number" name="chaoshi" class="form-control" value="<?php  echo $item['chaoshi'];?>" />
								<span class="input-group-addon">分钟</span>
							</div>
							<span class="help-block">未支付订单超过该时间，将自动取消订单</span>
						</div>
					</div>
                  <div class="form-group"  style="display: block;">
						<label class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">问题未追问自动结束</label>
						<div class="col-md-8" style="padding-right: 0;">
							<div class="input-group col-md-3">
								<input type="number" name="over" class="form-control" value="<?php  echo $item['over'];?>" />
								<span class="input-group-addon">分钟</span>
							</div>
							<span class="help-block">问题超过该时间未追问自动结束，将自动取消订单不可再发起追问</span>
						</div>
					</div>
                   <div class="form-group"  style="display: block;">
						<label class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">支付后未接诊</label>
						<div class="col-md-8" style="padding-right: 0;">
							<div class="input-group col-md-3">
								<input type="number" name="p_jiezhen" class="form-control" value="<?php  echo $item['p_jiezhen'];?>" />
								<span class="input-group-addon">分钟</span>
							</div>
							<span class="help-block">支付后未在指定时间接诊，订单将取消款项原路返回</span>
						</div>
					</div>
               
                    <div class="form-group">
					<label class="col-sm-2 control-label">免费追问次数</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">次数</span>
							<input type="text" name="mianfei_num" class="form-control" value="<?php  echo $item['mianfei_num'];?>">
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">超过追问次数，则追加问诊费用。</div>
				</div>
                    <div class="form-group">
					<label class="col-sm-2 control-label">超过每次追加</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">元</span>
							<input type="text" name="chao_price" class="form-control" value="<?php  echo $item['chao_price'];?>">
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">付费追问后，重新获得免费追问次数。</div>
				</div>
				  <div class="form-group">
					<label class="col-sm-2 control-label">视频问诊默认分钟</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">分</span>
							<input type="text" name="default_spnum" class="form-control" value="<?php  echo $item['default_spnum'];?>">
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">视频问诊默认分钟数</div>
				</div>
				  <div class="form-group">
					<label class="col-sm-2 control-label">视频问诊价格</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">分/元</span>
							<input type="text" name="default_spprice" class="form-control" value="<?php  echo $item['default_spprice'];?>">
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">视频问诊每分钟的价格</div>
				</div>
				  <div class="form-group">
					<label class="col-sm-2 control-label">电话问诊默认分钟</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">分</span>
							<input type="text" name="default_telnum" class="form-control" value="<?php  echo $item['default_telnum'];?>">
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">电话问诊默认分钟数</div>
				</div>
				 <div class="form-group">
					<label class="col-sm-2 control-label">电话问诊价格</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">分/元</span>
							<input type="text" name="default_telprice" class="form-control" value="<?php  echo $item['default_telprice'];?>">
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">电话问诊每分钟的价格</div>
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

