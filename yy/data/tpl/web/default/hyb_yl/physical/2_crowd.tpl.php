<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
			<div class="app-content">
              
				<div class="app-filter">
                  <div class="filter-action">
			<a href="/index.php?c=site&a=entry&do=physical&op=addcrowd&ac=addcrowd&m=hyb_yl" class="btn btn-primary">添加人群</a>
		</div>
               
					<div class="filter-list">
						<form action="" method="get" class="form-horizontal" role="form" id="form1">
							<input type="hidden" name="c" value="site" />
							<input type="hidden" name="a" value="entry" />
							<input type="hidden" name="m" value="hyb_yl" />
							<input type="hidden" name="p" value="crowd" />
							<input type="hidden" name="ac" value="crowd" />
							<input type="hidden" name="do" value="physical" />
							<input type="hidden" name="enabled" value="1" />
							<input type="hidden" name="op" value="crowd" />
							<div class="form-group form-inline">
								<label class="col-sm-2 control-label">搜索内容</label>
								<div class="col-sm-9">
									<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-sm-9">
									<button class="btn btn-primary" id="search">筛选</button>
								</div>
							</div>
					
						</form>
					</div>
				</div>
				<div class="app-table-list">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th style="width: 30px;">
										<input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
									</th>
									<th>ID</th>
									<th style="width: 50px;">人群名称</th>
									<th>现在状态</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
							<?php  if(is_array($list)) { foreach($list as $item) { ?>
								<tr>
									<td>
										<center>
											<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['id'];?>" />
										</center>
									</td>
									<td><?php  echo $item['id'];?></td>
								
									<td>
										<span data-toggle="tooltip" data-placement="top" title="5" class="text-lue" style="display: inline-block;max-width: 200px;"><a><?php  echo $item['title'];?></a></span>
									</td>
									<td>
									<?php  if($item['status'] == '1') { ?>
										<label class="label label-success">显示</label>
									<?php  } else if($item['status'] == '0') { ?>
										<label class="label label-success">隐藏</label>
									<?php  } ?>
									</td>
									<td style="position: relative;">
									<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('physical',array('op'=>'addcrowd','id'=>$item['id']))?>" title="编辑">编辑</a>
										<a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('physical',array('op'=>'delcrowd','id'=>$item['id']))?>" data-toggle="ajaxRemove" data-confirm="确定要删除吗？" title="删除">删除</a>
									</td>
								</tr>
								<?php  } } ?>
							</tbody>
						</table>
					</div>
					<div class="app-table-foot clearfix">
						<div class="pull-left">
							<div id="de1" class="pull-left">
								<label class="btn btn-default min-width " style="display: inline-flex;align-items:center;margin-right:1rem;">
		                        <input type="checkbox" name="checkbox" value="" id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
		                        <div style="margin-left: 10px">全选</div>
		                    </label>
								<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">删除选中人群</a>
							</div>
						</div>
						<div class="pull-right">
						<?php  echo $pager;?>
						</div>
					</div>
				</div>
			</div>
			<script>
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
							$.post("/web/index.php?c=site&a=entry&do=physical&op=delcrowds&ac=delcrowds&m=hyb_yl&", { ids : ids ,type:type}, function(data){
								if(!data.errno){
								util.tips("删除成功！");
								window.location.reload();
								}else{
								util.tips(data.message);	
								};
							}, 'json');
						}, {html: '确认删除所选人群分类?'});
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
</body>
</html>