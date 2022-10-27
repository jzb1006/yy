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
							<th class="text-center" width="35%">默认名称</th>
							<th class="text-center" width="25%">图标</th>
							<th class="text-center" width="40%">自定义开关</th>
							
						</tr>
					</thead>
					<tbody>
						<tr class="text-center">
							<td>症状表现</td>
							
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo $item['symptom'];?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="symptom"  value="<?php  echo $item['symptom'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="is_symptom" <?php  if($item['is_symptom'] == '1') { ?> checked="" <?php  } ?> value="1" >
							</td>
						
						
						</tr>
						<tr class="text-center">
							<td>缓解方式</td>
							
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo $item['relieve'];?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="relieve"  value="<?php  echo $item['relieve'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
                          	<td>
		                        <input type="checkbox" class="js-switch" name="is_relieve" <?php  if($item['is_relieve'] == '1') { ?> checked="" <?php  } ?> value="1" >
							</td>
						
						</tr>
						<tr class="text-center">
							<td>就诊判断</td>
						
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo $item['diagnosis'];?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="diagnosis"  value="<?php  echo $item['diagnosis'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="is_diagnosis" <?php  if($item['is_diagnosis'] == '1') { ?> checked="" <?php  } ?> value="1" >
							</td>
					
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

