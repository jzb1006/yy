<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<script type="text/javascript" src="https://www.webstrongtech.com/addons/hyb_yl/web/resource/js/diyarea.js"></script>
	<ul class="nav nav-tabs" id="myTab">
		<li class="active">
			<a href="#tab_1">基本信息</a>
		</li>
		<li>
			<a href="#tab_2">区域设置</a>
		</li>
		<li>
			<a href="#tab_3">结算提现</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-form">
			<form action="" method="post" class="form-horizontal form form-validate">
				<input type="hidden" name="id" value="" />
				<div class="tab-content">
					<!--代理商基本信息-->
					<div class="tab-pane  active" id="tab_1">
						<div class="panel panel-default">
							<div class="panel-heading">
								机构信息
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">机构LOGO<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">
										 <?php  echo tpl_form_field_image('logo', $res['logo'])?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">机构名称<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">
										<input type="text" name="agent[agentname]" required placeholder="请输入机构名称" class="form-control" value="<?php  echo $res['agentname'];?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">负责人姓名<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">
										<input type="text" name="agent[realname]" required placeholder="请输入真实姓名" class="form-control" value="<?php  echo $res['realname'];?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">联系电话</label>
									<div class="col-sm-9">
										<input type="text" name="agent[hospitaltel]" placeholder="请输入联系电话" class="form-control" value="<?php  echo $res['hospitaltel'];?>">
									</div>
								</div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">飞鹅云后台注册账号</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control max128 J-isDisable" value="<?php  echo $res['USER'];?>"  name="USER">
                            <span class="help-block">不填则无法使用打印小票</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">飞鹅云后台注册账号后生成的UKEY</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control max128 J-isDisable" value="<?php  echo $res['UKEY'];?>"  name="UKEY">
                            <span class="help-block">不填则无法使用打印小票</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">打印机编号</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control max128 J-isDisable" value="<?php  echo $res['SN'];?>" name="SN">
                            <span class="help-block">不填则无法使用打印小票</span>
                        </div>
                    </div>

								<div class="form-group">
									<label class="col-sm-2 control-label">简介</label>
									<div class="col-sm-9">
										<textarea class="form-control max2000" rows="5" name="lntroduction" placeholder="" id="advlink"><?php  echo $res['lntroduction'];?></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								机构账号
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">机构账号<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">
										<input type="text" name="username" required placeholder="请输入代理账号" class="form-control" value="<?php  echo $res['username'];?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">机构密码<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">
										<input type="text" name="password" required placeholder="请输入代理密码" class="form-control" value="<?php  echo $res['backpassword'];?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">所属分组<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">
										<select name="groupid" class="form-control">
											<option value="0">请选择分组</option>
											<option value="1" <?php  if('1'==$res['groupid']) { ?>  selected <?php  } ?>>医院</option>
											<option value="2" <?php  if('2'==$res['groupid']) { ?>  selected <?php  } ?>>药房</option>
											<option value="3" <?php  if('3'==$res['groupid']) { ?>  selected <?php  } ?>>体检机构</option>
											<option value="4" <?php  if('4'==$res['groupid']) { ?>  selected <?php  } ?>>诊所</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">所属级别<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">
										<select name="grade" class="form-control">
											<option value="10">请选择级别</option>
											<?php  if(is_array($level)) { foreach($level as $item) { ?>
                                                <option value="<?php  echo $item['id'];?>" <?php  if($item['id']==$res['grade']) { ?>  selected <?php  } ?>><?php  echo $item['level_name'];?></option>
											<?php  } } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">到期时间<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">
										<input type="text" name="agent[endtime]" value="<?php  echo $res['endtime'];?>" placeholder="请选择日期时间" readonly="readonly" class="datetimepicker form-control" style="padding-left:12px;" />
										<script type="text/javascript">
											require(["datetimepicker"], function(){
													var option = {
														lang : "zh",
														step : 5,
														timepicker : false,
														closeOnDateSelect : true,
														format : "Y-m-d"
													};
												$(".datetimepicker[name = 'agent[endtime]']").datetimepicker(option);
											});
										</script>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">是否启用</label>
									<div class="col-sm-9">
										<label class="radio-inline">
											<input type="radio" value="1" name="hos_tuijian" <?php  if($res['hos_tuijian'] =='1') { ?> checked <?php  } ?>>是
										</label>
										<label class="radio-inline">
											<input type="radio" value="0" name="hos_tuijian" <?php  if($res['hos_tuijian'] =='0' || !$res) { ?> checked <?php  } ?>>否
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">是否推荐</label>
									<div class="col-sm-9">
										<label class="radio-inline">
											<input type="radio" value="1" name="is_index" <?php  if($res['is_index'] =='1') { ?> checked <?php  } ?>>是
										</label>
										<label class="radio-inline">
											<input type="radio" value="0" name="is_index" <?php  if($res['is_index'] =='0' || !$res) { ?> checked <?php  } ?>>否
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--代理商代理区域设置-->
					<div class="tab-pane" id="tab_2">
						<div class="panel panel-default">
							<div class="panel-heading">
								机构所在区域
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">地区等级</label>
									<div class="col-sm-9">
										<label class="radio-inline" onclick="$('#tpl-district').hide();$('#tpl-city').hide();">
											<input type="radio" value="1" name="districtslevel" <?php  if($res['districtslevel'] =='1') { ?> checked <?php  } ?>>一级
										</label>
										<label class="radio-inline" onclick="$('#tpl-district').hide();$('#tpl-city').show();">
											<input type="radio" value="2" name="districtslevel" <?php  if($res['districtslevel'] =='2') { ?> checked <?php  } ?>>二级
										</label>
										<label class="radio-inline" onclick="$('#tpl-district').show();$('#tpl-city').show();$('#tpl-province').show();">
											<input type="radio" value="3" name="districtslevel" <?php  if($res['districtslevel'] =='3') { ?> checked <?php  } ?>>三级
										</label>
									</div>
								</div>
								<div class="form-group">
								    <label class="col-sm-2 control-label">运营地区</label>
								    <div class="col-sm-9">
								        <div class="row row-fix js-address-selector selectArea">
								            <div class="col-md-3" id="tpl-province">
								               
								                <select name="province" data-value="" level="1" class="form-control tpl-province changeArea">
								                    <option  value="0" >请选择一级区域</option>
								                    <?php  if(is_array($province)) { foreach($province as $item) { ?>

								                    <option id="province" value="<?php  echo $item['parentid'];?>" <?php  if($item['parentid']==$res['province'] ) { ?> selected="selected" <?php  } ?> data-province="<?php  echo $item['name'];?>"><?php  echo $item['name'];?></option>
								                    <?php  } } ?>
								                </select>
								            </div>
								            <div class="col-md-3" id="tpl-city" <?php  if($res['districtslevel'] =='2' || $res['districtslevel'] =='3') { ?> style="display: inline;"<?php  } else { ?> style="display: none;" <?php  } ?>>
											
												<select name="city" id="select3" data-value="" level="2" class="form-control tpl-city changeArea">
									            <?php  echo $city_html;?>
												</select>
								            </div>
								            <div class="col-md-3"  id="tpl-district" <?php  if($res['districtslevel'] =='3') { ?> style="display: inline;"<?php  } else { ?> style="display: none;" <?php  } ?>>
											
												 <select name="district" data-value="" level="3" class="form-control tpl-district changeArea">
									            	<?php  echo $district_html;?>
												</select>
								            </div>
								        </div>
								    </div>
								</div>
								
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">详细地址<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                    	<input type="text" name="xxaddress" placeholder="请输入详细地址" class="form-control" value="<?php  echo $res['xxaddress'];?>">
                                    </div>
     
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">地址经纬度<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                     <?php  echo tpl_form_field_coordinate('jingweidu',$res['jingweidu'])?>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
					<!--代理商结算提现设置-->
					<div class="tab-pane" id="tab_3">
						<div class="panel panel-default">
							<div class="panel-heading">
								机构提现到微信号
							</div>
							<div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">绑定专家微信</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="openid" name="openid" value="<?php  echo $res['openid'];?>">
                                        <div class="input-group">
                                            <input type="text" name="nickname" maxlength="30" value="<?php  echo $res['userinfo']['u_name'];?>" id="saler" class="form-control" readonly="" >
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#myModal">绑定专家微信</button>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="width: 660px;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                        <h3>绑定专家微信</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="keyword" value="" id="search-kwd" placeholder="可搜索微信昵称，openid，UID">
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="btn btn-default" onclick="search_members();">搜索</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div id="module-menus" style="padding-top:5px;"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>

						<!-- 				<div class="panel panel-default">
					<div class="panel-heading">
						专家提现设置
					</div>
					<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-2 control-label" >系统提成</label>
				    	<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="percent[syssalepercent]" class="form-control" value="" />
							<span class="input-group-addon">%</span>
						</div>
						</div>
					</div>
					</div>
				</div> -->

						<div class="panel panel-default">
							<div class="panel-heading">
								机构提现设置
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">订单抽成设置<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">
										<input type="text" name="agent[cut]" required placeholder="请输入订单抽成设置" class="form-control" value="<?php  echo $res['cut'];?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">系统提成</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="text" name="system_royalty" class="form-control" value="<?php  echo $res['system_royalty'];?>" />
											<span class="input-group-addon">%</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">银行卡号</label>
									<div class="col-sm-9">
										<input type="text" name="bank_num" class="form-control" value="<?php  echo $res['bank_num'];?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">开户名</label>
									<div class="col-sm-9">
										<input type="text" name="bank_user" class="form-control" value="<?php  echo $res['bank_user'];?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">开户行</label>
									<div class="col-sm-9">
										<input type="text" name="bank_name" class="form-control" value="<?php  echo $res['bank_name'];?>" />
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
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						<input type="hidden" name="hid" value="<?php  echo $hid;?>" />
					</div>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
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
		<li class="links_item">
			<div class="copyright">Powered by <a href="http://www.we7.cc">
					<b>系统</b>
				</a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a>
			</div>
		</li>
	</ul>
</div>


<script src="<?php  echo HYB_YL_ADMIN?>/js/user.js" type="text/javascript"></script> 



</body>
</html>
<script type="text/javascript">
	$(".tpl-province").on("change",function(){
    
     var id = $(this).val()
     console.log(id)
     //查询二级
	    $.post("/index.php?c=site&a=entry&do=jiancha&op=ajax&type=erji&m=hyb_yl&id="+id,{id:id},function (res) {
	    	    console.log(res)
                $("select[name='city']").empty();
                var html = "<option value='0'>请选择二级分类</option>";
                $(res).each(function (v, k) {

                    html += "<option value='" + k.parentid + "'>" + k.name + "</option>";
                });
                //把遍历的数据放到select表里面
                $("select[name='city']").append(html);

	        },'json');
 	}); 
 	$(".tpl-city").on("change",function(){
     var id = $(this).val()
     console.log(id)
     //查询三级
	    $.post("/index.php?c=site&a=entry&do=jiancha&op=ajax&type=sanji&m=hyb_yl&id="+id,{id:id},function (res) {
	    	    console.log(res)
                $("select[name='district']").empty();
                var html = "<option value='0'>请选择三级分类</option>";
                $(res).each(function (v, k) {

                    html += "<option value='" + k.parentid + "'>" + k.name + "</option>";
                });
                //把遍历的数据放到select表里面
                $("select[name='district']").append(html);

	        },'json');
 	}); 
 	$(".tpl-district").on("change",function(){
     console.log($(this).val())
 	});   
</script>