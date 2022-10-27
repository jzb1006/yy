<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li class="active"><a href="#">图标管理</a></li>
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
							<td>症状</td>
							
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
		                        <input type="checkbox" class="js-switch" name="is_symptom" <?php  if($item['is_symptom'] == '1') { ?> checked="" <?php  } ?> value="1"  >
							</td>
						
						
						</tr>
						<tr class="text-center">
							<td>病因</td>
							
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo $item['reason'];?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="reason"  value="<?php  echo $item['reason'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
                          	<td>
		                        <input type="checkbox" class="js-switch" name="is_reason" <?php  if($item['is_reason'] == '1') { ?> checked="" <?php  } ?> value="1"  >
							</td>
						
						</tr>
						<tr class="text-center">
							<td>诊断</td>
						
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
		                        <input type="checkbox" class="js-switch" name="is_diagnosis"  <?php  if($item['is_diagnosis'] == '1') { ?> checked="" <?php  } ?> value="1"  >
							</td>
					
						</tr>
						<tr class="text-center">
							<td>治疗</td>
						
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo $item['treatment'];?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="treatment"  value="<?php  echo $item['treatment'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="is_treatment" <?php  if($item['is_treatment'] == '1') { ?> checked="" checked="" <?php  } ?> value="1"  >
							</td>
							
						</tr>
                      	<tr class="text-center">
							<td>生活</td>
						
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo $item['life'];?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="life"  value="<?php  echo $item['life'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="is_life" <?php  if($item['is_life'] == '1') { ?> checked="" <?php  } ?> value="1"  >
							</td>
					
						</tr>
							<tr class="text-center">
							<td>预防</td>
						
							<td>
								<div class="input-group img-item">
									<div class="input-group-addon">
										<img src="<?php  echo $item['prevention'];?>" style="height:20px;width:20px" />
									</div>
									<input type="text" class="form-control" name="prevention"  value="<?php  echo $item['prevention'];?>"/>
									<div class="input-group-btn">
										<button type="button" class="btn btn-default btn-select-pic">选择图片</button>
									</div>
								</div>
							</td>
							<td>
		                        <input type="checkbox" class="js-switch" name="is_prevention" <?php  if($item['is_prevention'] == '1') { ?> checked="" <?php  } ?> value="1"  >
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

