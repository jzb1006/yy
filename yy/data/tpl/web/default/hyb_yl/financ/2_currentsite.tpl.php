<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#tab_basic">结算设置</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form" >
			<div class="panel-heading">结算设置</div>
			<div class="tab-content">
				<div class="form-group">
					<label class="col-sm-2 control-label">最低提现金额</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">￥</span>
							<input type="text" name="min_money" class="form-control" value="<?php  echo $item['min_money'];?>" />
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">余额低于最低提现金额，则不能提交提现申请。</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">提现金额设置</label>
					<div class="col-md-9">
						<div id="datas" class="sms-template-1" style="display:block;">
						<?php  if(is_array($item['money'])) { foreach($item['money'] as $mo) { ?>
							<div class="col-sm-12 data-item" style="margin-bottom: 10px;padding-left: 0;padding-right: 0;">
								
								<div class="input-group form-group col-sm-11" style="margin: 0px;padding-right: 0;float: left;">
									<input type="text" name="money[]" class="form-control" value="<?php  echo $mo;?>">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-time"></span>
									</span>

									<span class="input-group-addon btn btn-default data-item-delete">
										<i class="fa fa-remove"></i>删除
									</span>
								</div>
							</div>
							<script type="text/javascript">
								$(document).on('click', '.data-item-delete', function () {
								        $(this).closest('.data-item').remove();
								  });
							</script>
						<?php  } } ?>
						</div>
						<div class="form-group sms-template-1" style="display:block;">
							<div class="col-sm-6" style="padding-left: 0;">
								<a class="btn btn-default btn-add-type btn1 col-sm-12 col-xs-12" href="javascript:;" onclick="addType();">
									<i class="fa fa-plus" title=""></i>增加金额
								</a>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					function addType(){
				$('#datas').append(`
						<div class="col-sm-12 data-item" style="margin-bottom: 10px;padding-left: 0;padding-right: 0;">
	    <div class="input-group form-group col-sm-11" style="margin: 0px;padding-right: 0;float: left;">
	      	<input type="text" name="money[]" class="form-control" value="">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time"></span>
											</span>
	
			<span class="input-group-addon btn btn-default data-item-delete"><i class="fa fa-remove"></i>删除</span>
	    </div>
	</div>
	</div>
					`)
			}
				</script>
                <div class="form-group">
                    <label class="col-sm-2 control-label">打款方式</label>
                    <div class="col-sm-9">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="pay_type[]" <?php  if(in_array('支付宝',$item['pay_type'])) { ?> checked <?php  } ?> value="支付宝" > 支付宝
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="pay_type[]" <?php  if(in_array('微信',$item['pay_type'])) { ?> checked <?php  } ?> value="微信" > 微信
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="pay_type[]" <?php  if(in_array('银行卡',$item['pay_type'])) { ?> checked <?php  } ?> value="银行卡" > 银行卡
                        </label>
                    </div>
                </div>
                <div class="form-group">
					<label class="col-sm-2 control-label" >微信提现说明</label>
					<div class="col-sm-9">
						<?php  echo tpl_ueditor('weixin_content',$item['weixin_content']);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >支付宝提现说明</label>
					<div class="col-sm-9">
						<?php  echo tpl_ueditor('zfb_content',$item['zfb_content']);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >银行卡提现说明</label>
					<div class="col-sm-9">
						<?php  echo tpl_ueditor('bank_content',$item['bank_content']);?>
					</div>
				</div>
                <div class="form-group">
					<label class="col-sm-2 control-label">用户余额提现</label>
					<div class="col-sm-9">
						<label class="radio-inline" onclick="$('#withdrawals').show()">
							<input type="radio" value="1" name="is_user" <?php  if($item['is_user'] == '1') { ?> checked <?php  } ?> /> 开启
						</label>
						<label class="radio-inline" onclick="$('#withdrawals').hide()">
							<input type="radio" value="0" name="is_user" <?php  if($item['is_user'] == '0') { ?> checked <?php  } ?> /> 禁用
						</label>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">开启后，用户可以提现自己的余额。</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">机构代理提现免审核</label>
					<div class="col-sm-9">
						<label class="radio-inline">
							<input type="radio" value="1" name="is_agent" <?php  if($item['is_agent'] == '1') { ?> checked <?php  } ?>/> 开启
						</label>
						<label class="radio-inline">
							<input type="radio" value="0" name="is_agent"  <?php  if($item['is_agent'] == '0') { ?> checked <?php  } ?>  /> 禁用
						</label>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">开启后，机构提现申请会自动标记为已提现订单。</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">推客提现免审核</label>
					<div class="col-sm-9">
						<label class="radio-inline">
							<input type="radio" value="1" name="is_twitter" <?php  if($item['is_twitter'] == '1') { ?> checked <?php  } ?> /> 开启
						</label>
						<label class="radio-inline">
							<input type="radio" value="0" name="is_twitter" <?php  if($item['is_twitter'] == '0') { ?> checked <?php  } ?> /> 禁用
						</label>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">开启后，推客提现申请会自动标记为已提现订单。</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">专家提现免审核</label>
					<div class="col-sm-9">
						<label class="radio-inline">
							<input type="radio" value="1" name="is_expert" <?php  if($item['is_expert'] == '1') { ?> checked <?php  } ?> /> 开启
						</label>
						<label class="radio-inline">
							<input type="radio" value="0" name="is_expert" <?php  if($item['is_expert'] == '0') { ?> checked <?php  } ?> /> 禁用
						</label>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">开启后，专家提现申请会自动标记为已提现订单。</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >默认专家提现手续费</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="expert_fee" class="form-control" value="<?php  echo $item['expert_fee'];?>" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">代理详情中未设置时，会调用这里的默认比例</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >默认机构提现手续费</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="agent_fee" class="form-control" value="<?php  echo $item['agent_fee'];?>" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">机构详情中未设置时，会调用这里的默认比例</div>
				</div>
				<div class="form-group" id="withdrawals" <?php  if($item['is_user'] == '0') { ?>  style="display: none;"  <?php  } ?>>
					<label class="col-sm-2 control-label" >用户提现余额手续费比例</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="user_fee" class="form-control" value="<?php  echo $item['user_fee'];?>" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">用户余额提现的比例</div>
				</div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >提现间隔时间</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" name="interval_time" class="form-control" value="<?php  echo $item['interval_time'];?>" />
                            <span class="input-group-addon">天</span>
                        </div>
                    </div>
                    <div class="help-block col-md-10 col-lg-offset-2">为0天时，则没有间隔时间！</div>
                </div>
                <div class="form-group">
					<label class="col-sm-2 control-label" >默认绿通结算手续费</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="lvtong_fee" class="form-control" value="<?php  echo $item['lvtong_fee'];?>" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">默认绿通结算手续费</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">绿通提现免审核</label>
					<div class="col-sm-9">
						<label class="radio-inline">
							<input type="radio" value="1" name="is_lvtong" <?php  if($item['is_lvtong'] == '1') { ?> checked <?php  } ?> /> 开启
						</label>
						<label class="radio-inline">
							<input type="radio" value="0" name="is_lvtong" <?php  if($item['is_lvtong'] == '0') { ?> checked <?php  } ?> /> 禁用
						</label>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">开启后，绿通提现申请会自动标记为已提现订单。</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >绿通提现手续费</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="lvtong_cash" class="form-control" value="<?php  echo $item['lvtong_cash'];?>" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">绿通提现手续费</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >机构抽成设置</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="hos_cut" class="form-control" value="<?php  echo $item['hos_cut'];?>" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">机构抽成设置</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >专家订单抽成设置</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="doc_cut" class="form-control" value="<?php  echo $item['doc_cut'];?>" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">专家订单抽成设置</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >年卡订单抽成设置</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="card_cut" class="form-control" value="<?php  echo $item['card_cut'];?>" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">年卡订单抽成设置</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >绿通订单抽成设置</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="green_cut" class="form-control" value="<?php  echo $item['green_cut'];?>" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">绿通订单抽成设置</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >团队订单抽成设置</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="team_cut" class="form-control" value="<?php  echo $item['team_cut'];?>" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">团队订单抽成设置</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >药师订单抽成设置</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="yaoshi_cut" class="form-control" value="<?php  echo $item['yaoshi_cut'];?>" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">药师订单抽成设置</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >提现须知</label>
					<div class="col-sm-9">
						<?php  echo tpl_ueditor('content',$item['content']);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >微信提现说明</label>
					<div class="col-sm-9">
						<?php  echo tpl_ueditor('weixin_content',$item['weixin_content']);?>
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