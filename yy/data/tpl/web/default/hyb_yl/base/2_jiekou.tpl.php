<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="javascript:;">接口设置</a></li>
</ul>
<div class="app-content">
<div class="alert alert-warning">
            注意一：去微信公众平台填写合法域名https://api.map.baidu.com(百度地图)https://official.opensso.tencent-cloud.com WebRTC 音视频鉴权服务域名<br>
            注意二：https://yun.tim.qq.com WebRTC 音视频鉴权服务域名https://cloud.tencent.com 推流域名，https://webim.tim.qq.com IM 域名<br>
            注意三：https://pingtas.qq.com IM 填入合法域名 https://wx.qlogo.cn 也填入
        </div>
<div class="app-form" id="interfaceManagement">
	<form action="" method="post" class="form-horizontal form form-validate">
		<!--基本接口设置-->
<!-- 		<div class="panel-heading">地图接口设置</div>
		<div class="tab-content">
			<div class="form-group">
				<label class="col-sm-2 control-label">百度地图KEY</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" v-model="info.txmapkey"  name="baidu_key" />
					<span class="help-block">不填则调用系统默认KEY，为提高接口稳定性，建议自行填写</span>
				</div>
			</div>
          <div class="form-group">
                    <label class="col-sm-2 control-label">地区定位方式</label>
                    <div class="col-sm-9">
                        <label class="radio radio-success radio-inline" onclick="$('#noagentarea').hide();">
                            <input type="radio" name="location" value="0" checked="checked">城市定位
                        </label>
                        <label class="radio-inline" onclick="$('#noagentarea').show();">
                            <input type="radio" name="location" value="1">精确定位
                        </label>
                        <span class="help-block">系统默认使用城市定位，精确定位会定位到用户当前位置，并根据用户所在位置加载数据</span>
                    </div>
                </div>
          <div class="form-group">
				<label class="col-sm-2 control-label">引导切换地区</label>
				<div class="col-sm-9">
					<label class="radio-inline">
						<input type="radio" class="form-control" name="guide" value="0" checked="checked"> 开启
					</label>
					<label class="radio-inline">
						<input type="radio" class="form-control" name="guide" value="1"> 关闭
					</label>
					<span class="help-block">默认开启引导切换地区，如果单地区不建议开启</span>
				</div>
			</div>
		</div> -->
      		<!--基本接口设置-->
		<div class="panel-heading">小程序设置</div>
		<div class="tab-content">
			<div class="form-group">
				<label class="col-sm-2 control-label">小程序appid</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" v-model="info.txmapkey" name="appid"  value="<?php  echo $res['appid'];?>" />
					<span class="help-block">不填则小程序打开空白</span>
				</div>
			</div>
          <div class="form-group">
				<label class="col-sm-2 control-label">小程序key</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" v-model="info.txmapkey" name="appsecret"  value="<?php  echo $res['appsecret'];?>" />
					<span class="help-block">不填则小程序打开空白</span>
				</div>
			</div>
		</div>
      <div class="panel-heading">腾讯音视频设置</div>
		<div class="tab-content">
			<div class="form-group">
				<label class="col-sm-2 control-label">音视频appid</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="tencent_sdkappid" v-model="info.txmapkey" value="<?php  echo $res['tencent_sdkappid'];?>" />
					<span class="help-block">不填则小程序视频问诊无法实现视频</span>
				</div>
			</div>
          <div class="form-group">
				<label class="col-sm-2 control-label">音视频key</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="tencent_key" v-model="info.txmapkey"  value="<?php  echo $res['tencent_key'];?>" />
					<span class="help-block">不填则小程序视频问诊无法实现视频</span>
				</div>
			</div>
		</div>
        <div class="panel-heading">华为云电话设置</div>
		<div class="tab-content">
			<div class="form-group">
				<label class="col-sm-2 control-label">电话应用appid</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" v-model="info.txmapkey" name="huaw_appid" value="<?php  echo $res['huaw_appid'];?>" />
					<span class="help-block">不填则小程序电话问诊无法打通</span>
				</div>
			</div>
          <div class="form-group">
				<label class="col-sm-2 control-label">电话应用key</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" v-model="info.txmapkey" name="huaw_key" value="<?php  echo $res['huaw_key'];?>" />
					<span class="help-block">不填则小程序电话问诊无法打通</span>
				</div>
			</div>
          <div class="form-group">
				<label class="col-sm-2 control-label">区号</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" v-model="info.txmapkey" name="areaCode" value="<?php  echo $res['areaCode'];?>"/>
					<span class="help-block">不填则小程序电话问诊无法打通</span>
				</div>
			</div>
		</div>
		<!--物流查询接口管理-->
		<div class="panel-heading">物流查询接口管理</div>
		<div class="tab-content">
			<div class="form-group">
				<label class="col-sm-2 control-label">接口类型</label>
				<div class="col-sm-9">
						<label class="radio-inline">
						    <input type="radio" name='wuliu_state' value='1' <?php  if($res['wuliu_state']=='1' ) { ?> checked="checked" <?php  } ?>>关闭
						           </label>
						           <label class="radio-inline">
						    <input type="radio" name='wuliu_state' value='0' <?php  if($res['wuliu_state']=='0' || !$res) { ?> checked="checked" <?php  } ?>>快递1000
						</label>					
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">选择默认物流</label>
				<div class="col-sm-9">
					<select name="wlid" class="form-control">
                        <?php  if(is_array($row)) { foreach($row as $item) { ?>
					    <option value="<?php  echo $item['id'];?>" <?php  if($item['id'] ==$res['wlid']) { ?> selected="selected" <?php  } ?>><?php  echo $item['name'];?></option>
                        <?php  } } ?>
					   
					</select>
					<span class="help-block">没有物流请先添加物流公司 <a href="/index.php?c=site&a=entry&op=add&ac=addwuli&do=wuliu&m=hyb_yl"> 点击这里 </a></span>
				</div>
			</div>
			<!--快递鸟配置信息-->
			<span v-if="info.logistics.type == 1">
				<div class="form-group">
					<label class="col-sm-2 control-label">授权KEY</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="wuliu_key" value="<?php  echo $res['wuliu_key'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">customer</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="wuliu_appid"  value="<?php  echo $res['wuliu_appid'];?>"/>
					</div>
				</div>
			</span>
		</div>
		<div class="panel-heading">云收款音箱设置<span class="help-block">设置完成请添加操作用户 <a href="/index.php?c=site&a=entry&op=addbox_user&ac=box_user&do=base&m=hyb_yl"> 点击这里 </a></span></div>

		<div class="tab-content">
			<div class="form-group">
				<label class="col-sm-2 control-label">云收款音箱SN码</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="box_sn" value="<?php  echo $res['box_sn'];?>" />
					<span class="help-block">不填则云收款音箱无法正常</span>
				</div>
			</div>
          <div class="form-group">
				<label class="col-sm-2 control-label">开发商分配token</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="box_token" value="<?php  echo $res['box_token'];?>" />
					<span class="help-block">不填则云收款音箱无法使用</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">云收款音箱版本号</label>
				<div class="col-sm-9">
					<select name="box_version" class="form-control">
					    <option value="1" <?php  if(1 ==$res['box_version']) { ?> selected="selected" <?php  } ?>>1</option>
					    <option value="2" <?php  if(2 ==$res['box_version']) { ?> selected="selected" <?php  } ?>>2</option>
					    <option value="3" <?php  if(3 ==$res['box_version']) { ?> selected="selected" <?php  } ?>>3</option>
					    <option value="4" <?php  if(4 ==$res['box_version']) { ?> selected="selected" <?php  } ?>>4</option>
					    <option value="5" <?php  if(5 ==$res['box_version']) { ?> selected="selected" <?php  } ?>>5</option>
					    <option value="6" <?php  if(6 ==$res['box_version']) { ?> selected="selected" <?php  } ?>>6</option>
					    <option value="7" <?php  if(7 ==$res['box_version']) { ?> selected="selected" <?php  } ?>>7</option>
					    <option value="8" <?php  if(8 ==$res['box_version']) { ?> selected="selected" <?php  } ?>>8</option>
					    <option value="9" <?php  if(9 ==$res['box_version']) { ?> selected="selected" <?php  } ?>>9</option>
					</select>
					
				</div>
			</div>
          
		<!--提交按钮-->
		<div class="form-group">
			<label class="col-sm-2 control-label"></label>
			<div class="col-sm-9">
				<input type="submit" value="提交" class="btn btn-primary min-width"/>
	            <input type="hidden" name="p_id" value="<?php  echo $p_id;?>">
	            <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
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

