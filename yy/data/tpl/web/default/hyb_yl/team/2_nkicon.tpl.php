<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li class="active"><a href="#">年卡图标管理</a></li>
</ul>
<div class="app-content">
	<div class="app-table-list">
		<form action="" method="post" enctype="multipart/form-data" >
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-center" width="15%">默认名称</th>
							<th class="text-center" width="20%">修改名称</th>
							<th class="text-center" width="25%">图标</th>
							<th class="text-center" width="10%">自定义开关</th>
							<th class="text-center" width="30%">描述</th>
						</tr>
					</thead>
					<tbody>
						<tr class="text-center">
							<td>免费问诊</td>
							<td><input class="form-control" type="text" placeholder="免费问诊"  name="mf_title"  value="<?php  echo $item['mf_title'];?>"/></td>
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo $item['mf_thumb'];?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="mf_thumb"  value="<?php  echo $item['mf_thumb'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="mf_status" value="1" <?php  if($item['mf_status'] == '1') { ?> checked="" <?php  } ?>>
							</td>
							<td><input class="form-control" type="text" placeholder="请输入描述" name="mf_content" value="<?php  echo $item['mf_content'];?>"/></td>
							<td>
						</tr>
						<tr class="text-center">
							<td>问诊85折</td>
							<td><input class="form-control" type="text" placeholder="问诊85折"  name="wz_title"  value="<?php  echo $item['wz_title'];?>"/></td>
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo $item['wz_thumb'];?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="wz_thumb"  value="<?php  echo $item['wz_thumb'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
                          	<td>
		                        <input type="checkbox" class="js-switch" name="wz_status" value="1" <?php  if($item['wz_status'] == '1') { ?> checked="" <?php  } ?>>
							</td>
							<td><input class="form-control" type="text" placeholder="请输入描述"  name="wz_content" value="<?php  echo $item['wz_content'];?>"/></td>
						</tr>
						<tr class="text-center">
							<td>免费会话</td>
							<td><input class="form-control" type="text" placeholder="免费会话" name="hh_title"  value="<?php  echo $item['hh_title'];?>"/></td>
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo $item['hh_thumb'];?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="hh_thumb"  value="<?php  echo $item['hh_thumb'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="hh_status" value="1" <?php  if($item['hh_status'] == '1') { ?> checked="" <?php  } ?>>
							</td>
						<td><input class="form-control" type="text" placeholder="请输入描述"  name="hh_content"  value="<?php  echo $item['hh_content'];?>"/></td>
						</tr>
						<tr class="text-center">
							<td>免费解读报告</td>
							<td><input class="form-control" placeholder="免费解读报告" type="text"  name="jd_title"  value="<?php  echo $item['jd_title'];?>"/></td>
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo $item['jd_thumb'];?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="jd_thumb"  value="<?php  echo $item['jd_thumb'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="jd_status" value="1" <?php  if($item['jd_status'] == '1') { ?> checked="" <?php  } ?>>
							</td>
							<td><input class="form-control" type="text" placeholder="请输入描述"  name="jd_content"  value="<?php  echo $item['jd_content'];?>"/></td>
						</tr>
						
					</tbody>
				</table>
			</div>
	        <div class="app-table-foot clearfix">
	            <div class="pull-left">
	                <input type="submit" name="submit" value="保存" class="btn btn-primary min-width" />
	                <input type="hidden" name="token" value="da1c10f4" />
	            </div>
	            <div class="pull-right">
	
	            </div>
	        </div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		bindEvents();
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

