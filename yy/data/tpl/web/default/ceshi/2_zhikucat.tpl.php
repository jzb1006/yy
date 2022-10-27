<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.zhikucat&ac=zhikucat">类别列表</a>
		</li>
     
  
	</ul>
	<div class="app-content">
		<div class="app-filter">
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1" style="display:flex">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="p" value="medicine" />
				<input type="hidden" name="act" value="ceshi.zhikucat" />
				<input type="hidden" name="do" value="copysite" />
				<input type="hidden" name="ac" value="zhikucat" />
				<div class="form-group form-inline">
					<label class="col-sm-2 control-label">所属类型</label>
					<div class="col-sm-9" style="display:flex">
						<select name="typeint" class="form-control">
							<option value="" >所属类型</option>
							<option value="0" <?php  if($typeint == '0') { ?> selected="" <?php  } ?>>科室类别</option>
							<option value="1" <?php  if($typeint == '1') { ?> selected="" <?php  } ?>>疾病类别</option>
							<option value="2" <?php  if($typeint == '2') { ?> selected="" <?php  } ?>>症状类别</option>
							<option value="3" <?php  if($typeint == '3') { ?> selected="" <?php  } ?>>疫苗类别</option>
							<option value="4" <?php  if($typeint == '4') { ?> selected="" <?php  } ?>>检查项类别</option>
							<option value="5" <?php  if($typeint == '5') { ?> selected="" <?php  } ?>>备药类别</option>
							<option value="6" <?php  if($typeint == '6') { ?> selected="" <?php  } ?>>传染病类别</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-md-9">
						<button class="btn btn-primary" id="search">搜索</button>
					</div>
				</div>
			</form>
			</div>
			<div class="filter-action">
				<a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addzhiku&ac=addzhiku" class="btn btn-primary">添加类别</a>
			</div>
		</div>
		<div class="app-table-list">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>
								<input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
							</th>
							<th>类别名称</th>
							<th>描述</th>
							<th>所属列表</th>
							<th>是否开启</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
                      <?php  if(is_array($row)) { foreach($row as $item) { ?>
						<tr>
							<td>
								<center>
									<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['id'];?>" />
								</center>
							</td>
							<td> <?php  echo $item['ctname'];?></td>
							<td><?php  echo $item['describe'];?></td>
					        <td><?php  if($item['state'] == 0) { ?><span class="label label-default">开启</span><?php  } ?>
						    	<?php  if($item['state'] == 1) { ?><span class="label label-success">显示</span><?php  } ?>
							</td>
							<td>
								<?php  if($item['typeint'] == '0') { ?>
									科室类别
								<?php  } else if($item['typeint'] == '1') { ?>
									疾病类别
								<?php  } else if($item['typeint'] == '2') { ?>
									症状类别
								<?php  } else if($item['typeint'] == '3') { ?>
									疫苗类别
								<?php  } else if($item['typeint'] == '4') { ?>
									检查项类别
								<?php  } else if($item['typeint'] == '5') { ?>
									备药类别
								<?php  } else if($item['typeint'] == '6') { ?>
									传染病类别
								<?php  } ?>
							</td>
							<td>
								<a href="<?php  echo $this->copysiteUrl('ceshi.edit_zhiku');?>&id=<?php  echo $item['id'];?>&ac=addzhiku&page=<?php  echo $_GPC['page'];?>">编辑</a> -
								<a href="<?php  echo $this->copysiteUrl('ceshi.delcate');?>&id=<?php  echo $item['id'];?>&ac=zhikucat&page=<?php  echo $_GPC['page'];?>">删除</a>
							</td>
						</tr>
                      <?php  } } ?>
					</tbody>
				</table>
				<div class="app-table-foot clearfix">
	            <div class="pull-left">
	                <div class="pull-left" id="de1">
	                    <label class="btn btn-default min-width " style="display: inline-flex;align-items:center;margin-right:1rem;">
	                        <input type="checkbox" name="checkbox" value="" id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
	                        <div style="margin-left: 10px">全选</div>
	                    </label>
	                    <a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">批量删除</a>
	                </div>
	            </div>
	            <div class="pull-right"><?php  echo $pager;?></div>
	        </div>
			</div>
		</div>
	</div>
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

			var enabled = "1";
			$('#de1').delegate('.pass','click',function(e){
				e.stopPropagation();
				var order_ids = [];
				var $checks=$('.checkbox:checkbox:checked');
				$checks.each(function() {
					if (this.checked) {
						order_ids.push(this.value);
					};
				});
				var $this = $(this);
				var ids = order_ids;
				util.nailConfirm(this, function(state) {
				if(!state) return;
					if(enabled == 4){
						var type = 2;
					}else{
						var type = 1;
					}
					$.post("<?php  echo $this->copysiteUrl('ceshi.del_zhikus');?>&ac=addzhiku", { ids : ids ,type:type}, function(data){
						if(data.errno=='1'){ 
		                    util.tips("操作成功！");
		                    setTimeout(function(){ 
		                        window.location.reload();
		                    }, 1000);
		                }else{
		                    util.tips("操作失败");  
		                };
					}, 'json');
				}, {html: '确认删除所选商户?'});
			});
</script>
</body>
</html>