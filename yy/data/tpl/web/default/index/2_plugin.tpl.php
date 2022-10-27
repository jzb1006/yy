<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li class="active"><a href="#">特色服务管理</a></li>
</ul>
<div class="app-content">
	<div class="app-table-list">
		<form action="" method="post" enctype="multipart/form-data" >
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-center" width="15%">默认链接</th>
							<th class="text-center" width="16%">修改名称</th>
							<th class="text-center" width="20%">服务描述</th>
							<th class="text-center" width="16%">图标</th>
							<th class="text-center" width="10%">自定义开关</th>
							<th class="text-center" width="30%">链接</th>
						</tr>
					</thead>
					<tbody>
						<tr class="text-center">
							<td>手术快约</td>
							<td><input class="form-control" type="text" placeholder="手术快约"  name="info[list][one][name]"  value="<?php  echo $s_menu['list']['one']['name'];?>"/></td>

							<td><input class="form-control" type="text" placeholder="手术快约" name="info[list][one][desc]"  value="<?php  echo $s_menu['list']['one']['desc'];?>"/></td>

							<input type="hidden" name="info[list][one][pinyin]" value="shoushukuaiyue">
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo tomedia($s_menu['list']['one']['img']) ?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="info[list][one][img]"  value="<?php  echo $s_menu['list']['one']['img'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="info[list][one][status]" <?php  if($s_menu['list']['one']['status'] =='on') { ?> checked='checked' <?php  } ?>>
							</td>
							<td>
								<div class="input-group form-group" style="margin: 0;display: inline-block;">
								<input style="width: 15rem;" class="form-control valid" id="advlinkone" type="text"  name="info[list][one][url]"  value="<?php  echo $s_menu['list']['one']['url'];?>"/>
								<span class="input-group-btn">
									<span data-input="#advlinkone"  data-toggle="selectUrl" class="btn btn-default btnurl">选择链接</span>
								</span>
								</div>
							</td>
						</tr>
						<tr class="text-center">
							<td>报告解读</td>
							<td><input class="form-control" type="text" placeholder="报告解读"  name="info[list][two][name]"  value="<?php  echo $s_menu['list']['two']['name'];?>"/></td>

							<td><input class="form-control" type="text" placeholder="报告解读" name="info[list][two][desc]"  value="<?php  echo $s_menu['list']['two']['desc'];?>"/></td>

							<input type="hidden" name="info[list][two][pinyin]" value="tijianjiedu">
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo tomedia($s_menu['list']['two']['img']) ?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="info[list][two][img]"  value="<?php  echo $s_menu['list']['two']['img'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch"  class="form-control valid" name="info[list][two][status]"  <?php  if($s_menu['list']['two']['status'] =='on') { ?> checked='checked' <?php  } ?>>  
							</td>
							<td>
								<div class="input-group form-group" style="margin: 0;display: inline-block;">
								<input style="width: 15rem;" type="text"  class="form-control valid" id="advlink_2"  name="info[list][two][url]"  value="<?php  echo $s_menu['list']['two']['url'];?>"/>
								<span class="input-group-btn">
									<span data-input="#advlink_2" data-toggle="selectUrl" class="btn btn-default btnurl">选择链接</span>
								</span>
								</div>
							</td>
						</tr>
						<tr class="text-center">
							<td>家庭医生</td>
							<td><input class="form-control" type="text" placeholder="家庭医生" name="info[list][three][name]"  value="<?php  echo $s_menu['list']['three']['name'];?>"/></td>

							<td><input class="form-control" type="text" placeholder="家庭医生" name="info[list][three][desc]"  value="<?php  echo $s_menu['list']['three']['desc'];?>"/></td>

							<input type="hidden" name="info[list][three][pinyin]" value="zhuanjiatuandui">
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo tomedia($s_menu['list']['three']['img']) ?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="info[list][three][img]"  value="<?php  echo $s_menu['list']['three']['img'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="info[list][three][status]" <?php  if($s_menu['list']['three']['status'] =='on') { ?> checked='checked' <?php  } ?>>
							</td>
							<td>
								<div class="input-group form-group" style="margin: 0;display: inline-block;">
								<input style="width: 15rem;" type="text" class="form-control valid" id="advlink_3" name="info[list][three][url]"  value="<?php  echo $s_menu['list']['three']['url'];?>"/>
								<span class="input-group-btn">
									<span data-input="#advlink_3" data-toggle="selectUrl" class="btn btn-default btnurl">选择链接</span>
								</span>
								</div>
							</td>
						</tr>
						<tr class="text-center">
							<td>远程挂号</td>
							<td><input class="form-control" placeholder="远程挂号" type="text"  name="info[list][four][name]"  value="<?php  echo $s_menu['list']['four']['name'];?>"/></td>

							<td><input class="form-control" type="text" placeholder="远程挂号" name="info[list][four][desc]"  value="<?php  echo $s_menu['list']['four']['desc'];?>"/></td>

							<input type="hidden" name="info[list][four][pinyin]" value="yuanchengguahao">
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo tomedia($s_menu['list']['four']['img']) ?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="info[list][four][img]"  value="<?php  echo $s_menu['list']['four']['img'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="info[list][four][status]"  <?php  if($s_menu['list']['four']['status'] =='on') { ?> checked='checked' <?php  } ?> >
							</td>
							<td>
								<div class="input-group form-group" style="margin: 0;display: inline-block;">
								<input style="width: 15rem;" class="form-control valid" id="advlink_4" type="text"  name="info[list][four][url]"  value="<?php  echo $s_menu['list']['four']['url'];?>"/>
								<span class="input-group-btn">
									<span data-input="#advlink_4" data-toggle="selectUrl" class="btn btn-default btnurl">选择链接</span>
								</span>
								</div>
							</td>
						</tr>
						<tr class="text-center">
							<td>预约就诊</td>
							<td><input class="form-control" type="text" placeholder="预约就诊"  name="info[list][five][name]"  value="<?php  echo $s_menu['list']['five']['name'];?>"/></td>

							<td><input class="form-control" type="text" placeholder="预约就诊" name="info[list][five][desc]"  value="<?php  echo $s_menu['list']['five']['desc'];?>"/></td>

							<input type="hidden" name="info[list][five][pinyin]" value="yuyuejiuzhen">
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo tomedia($s_menu['list']['five']['img']) ?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="info[list][five][img]"  value="<?php  echo $s_menu['list']['five']['img'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="info[list][five][status]" <?php  if($s_menu['list']['five']['status'] =='on') { ?> checked='checked' <?php  } ?>>
							</td>
							<td>
								<div class="input-group form-group" style="margin: 0;display: inline-block;">
								<input style="width: 15rem;" class="form-control valid" id="advlink_5" type="text"  name="info[list][five][url]"  value="<?php  echo $s_menu['list']['five']['url'];?>"/>
								<span class="input-group-btn">
									<span data-input="#advlink_5"  data-toggle="selectUrl" class="btn btn-default btnurl">选择链接</span>
								</span>
								</div>
							</td>
						</tr>
						<tr class="text-center">
							<td>住院安排</td>
							<td><input class="form-control" type="text" placeholder="住院安排"  name="info[list][six][name]"  value="<?php  echo $s_menu['list']['six']['name'];?>"/></td>

							<td><input class="form-control" type="text" placeholder="住院安排" name="info[list][six][desc]"  value="<?php  echo $s_menu['list']['six']['desc'];?>"/></td>

							<input type="hidden" name="info[list][six][pinyin]" value="zhuyuananpai">
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo tomedia($s_menu['list']['six']['img']) ?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="info[list][six][img]"  value="<?php  echo $s_menu['list']['six']['img'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="info[list][six][status]" <?php  if($s_menu['list']['six']['status'] =='on') { ?> checked='checked' <?php  } ?>>
							</td>
							<td>
								<div class="input-group form-group" style="margin: 0;display: inline-block;">
								<input style="width: 15rem;" class="form-control valid" id="advlink_6" type="text"  name="info[list][six][url]"  value="<?php  echo $s_menu['list']['six']['url'];?>"/>
								<span class="input-group-btn">
									<span data-input="#advlink_6"  data-toggle="selectUrl" class="btn btn-default btnurl">选择链接</span>
								</span>
								</div>
							</td>
						</tr>
						<tr class="text-center">
							<td>手术安排</td>
							<td><input class="form-control" type="text" placeholder="手术安排"  name="info[list][seven][name]"  value="<?php  echo $s_menu['list']['seven']['name'];?>"/></td>

							<td><input class="form-control" type="text" placeholder="手术安排" name="info[list][seven][desc]"  value="<?php  echo $s_menu['list']['seven']['desc'];?>"/></td>

							<input type="hidden" name="info[list][seven][pinyin]" value="shoushuanpai">
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo tomedia($s_menu['list']['seven']['img']) ?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="info[list][seven][img]"  value="<?php  echo $s_menu['list']['seven']['img'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="info[list][seven][status]" <?php  if($s_menu['list']['seven']['status'] =='on') { ?> checked='checked' <?php  } ?>>
							</td>
							<td>
								<div class="input-group form-group" style="margin: 0;display: inline-block;">
								<input style="width: 15rem;" class="form-control valid" id="advlink_7" type="text"  name="info[list][seven][url]"  value="<?php  echo $s_menu['list']['seven']['url'];?>"/>
								<span class="input-group-btn">
									<span data-input="#advlink_7"  data-toggle="selectUrl" class="btn btn-default btnurl">选择链接</span>
								</span>
								</div>
							</td>
						</tr>
						<tr class="text-center">
							<td>报告加急</td>
							<td><input class="form-control" type="text" placeholder="报告加急"  name="info[list][eight][name]"  value="<?php  echo $s_menu['list']['eight']['name'];?>"/></td>

							<td><input class="form-control" type="text" placeholder="报告加急" name="info[list][eight][desc]"  value="<?php  echo $s_menu['list']['eight']['desc'];?>"/></td>

							<input type="hidden" name="info[list][eight][pinyin]" value="baogaojiaji">
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo tomedia($s_menu['list']['eight']['img']) ?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="info[list][eight][img]"  value="<?php  echo $s_menu['list']['eight']['img'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="info[list][eight][status]" <?php  if($s_menu['list']['eight']['status'] =='on') { ?> checked='checked' <?php  } ?>>
							</td>
							<td>
								<div class="input-group form-group" style="margin: 0;display: inline-block;">
								<input style="width: 15rem;" class="form-control valid" id="advlink_8" type="text"  name="info[list][eight][url]"  value="<?php  echo $s_menu['list']['eight']['url'];?>"/>
								<span class="input-group-btn">
									<span data-input="#advlink_8"  data-toggle="selectUrl" class="btn btn-default btnurl">选择链接</span>
								</span>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
	        <div class="app-table-info clearfix">
	            <div class="pull-left">
	                <input type="submit" name="submit" value="保存" class="btn btn-primary min-width" />
	                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
	                <input type="hidden" name="id" value="<?php echo $res['id']?$res['id']:$id?>" />
	            </div>
	            <div class="pull-right">
	
	            </div>
	        </div>
		</form>
	</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/menulist', TEMPLATE_INCLUDEPATH)) : (include template('./common/menulist', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript">
	$(function(){
		bindEvents();
		url_system();
		hideModal();

	});
	function bindEvents() {
		require(['jquery', 'util'], function ($, util) {
			$('.btn-select-pic').unbind('click').click(function () {
				var imgitem = $(this).closest('.img-item');
				util.image('', function (data) {
					imgitem.find('img').attr('src', data['url']);
					imgitem.find('input').val(data['attachment']);
				});
			});
		});
	}
</script>
<script type="text/javascript" src="<?php  echo HYB_YL_ADMIN?>/js/showmodel.js"></script>
			</div>
		</div>
	</div>
	<div class="info" >
		<ul class="links ft">
            <li class="links_item"><div class="copyright">Powered by <a href="http://www.we7.cc"><b>系统</b></a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a></div></li>
		</ul>
	</div>

   
    
	</body>
</html>