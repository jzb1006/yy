<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<style>
		.prstyle{color: orangered;}
</style>
	<ul class="nav nav-tabs">
		<li>
			<a href="<?php  echo $this->createWebUrl('physical',array('op'=>'tclist','status'=>''))?>">套餐全部
				<?php  if($count > 0 && $count) { ?>
				<span class="label label-warning pull-right"><?php  echo $count;?></span>
				<?php  } ?>
			</a>
		</li>
		<li>
			<a href="<?php  echo $this->createWebUrl('physical',array('op'=>'tclist','status'=>'1'))?>">销售中
				<?php  if($sell > 0 && $sell) { ?>
				<span class="label label-warning pull-right"><?php  echo $sell;?></span>
				<?php  } ?>
			</a>
		</li>
		<li>
			<a href="<?php  echo $this->createWebUrl('physical',array('op'=>'tclist','status'=>'2'))?>">待审核
				<?php  if($shenhe > 0 && $shenhe) { ?>
				<span class="label label-warning pull-right"><?php  echo $shenhe;?></span>
				<?php  } ?>
			</a>
		</li>
		<li>
			<a href="<?php  echo $this->createWebUrl('physical',array('op'=>'tclist','status'=>'3'))?>">未通过
				<?php  if($jujue > 0 && $jujue) { ?>
				<span class="label label-warning pull-right"><?php  echo $jujue;?></span>
				<?php  } ?>
			</a>
		</li>
		<li>
			<a href="<?php  echo $this->createWebUrl('physical',array('op'=>'tclist','status'=>'4'))?>">已下架
				<?php  if($xiajia > 0 && $xiajia) { ?>
				<span class="label label-warning pull-right"><?php  echo $xiajia;?></span>
				<?php  } ?>
			</a>
		</li>
		<li>
			<a href="<?php  echo $this->createWebUrl('physical',array('op'=>'tclist','status'=>'5'))?>">已删除
				<?php  if($del > 0 && $del) { ?>
				<span class="label label-warning pull-right"><?php  echo $del;?></span>
				<?php  } ?>
			</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-filter">
			<div class="app-filter">
				<div class="filter-action">
					<a href="<?php  echo $this->createWebUrl('physical',array('op'=>'tclistadd'))?>">添加套餐</a>
				</div>
			</div>
			<div class="filter-list">
				<form action="" method="get" class="form-horizontal" role="form" id="form1">
					<input type="hidden" name="c" value="site" />
					<input type="hidden" name="a" value="entry" />
					<input type="hidden" name="m" value="hyb_yl" />
					<input type="hidden" name="ac" value="tclist" />
					<input type="hidden" name="do" value="physical" />
					<input type="hidden" name="enabled" value="1" />
					<input type="hidden" name="op" value="tclist" />
					<div class="form-group form-inline">
						<label class="col-sm-2 control-label">关键字</label>
						<div class="col-sm-9">
							<select name="keywordtype" class="form-control">
								<option value="">关键字类型</option>
								<option value="1">套餐ID</option>
								<option value="2">商家ID</option>
								<option value="3">套餐名称</option>
								<option value="4">商家名称</option>
							</select>
							<input type="text" name="keyword" class="form-control" value="" placeholder="请输入关键字" />
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
				<table id="de1" class="table table-hover table-bordered">
					<thead>
						<tr>
							<th class="text-center" style="width:40px;">
								<input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
							</th>
							<th class="text-center" style="width:40px;">ID</th>
							<th class="text-center" style="width:170px;">套餐名称</th>
							<th class="text-center" style="width:120px;">套餐分类</th>
							<th class="text-center" style="width:120px;">所属分院</th>
							<th class="text-center" style="width:100px;">价格</th>
							<th class="text-center" style="width:80px;">人群</th>
							<th class="text-center" style="width:100px;">销量</th>
							<th class="text-center" style="width:60px;">状态</th>
							<th class="text-center" style="width:200px;">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($list)) { foreach($list as $item) { ?>
						<tr class="text-center">
							<td>
								<center>
									<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['id'];?>" />
								</center>
							</td>
							<td>
								<center><?php  echo $item['id'];?></center>
							</td>
							<td>
								<div class="img" style="text-align: left;padding-left: 2rem;">
									<img style="height: 50px;width: 50px;margin-right: 10px;" class="scrollLoading" src="<?php  echo tomedia($item['thumb'])?>" data-url="<?php  echo tomedia($item['thumb'])?>">
									<span> <?php  echo $item['title'];?></span>
								</div>
							</td>
							<td>
								<label class="label label-success"><?php  echo $item['tcfl']['title'];?></label>

							</td>
							<!--所属商家-->
							<td>
							<?php  if(is_array($item['fenyuan'])) { foreach($item['fenyuan'] as $fy) { ?>
								<?php  echo $fy['agentname'];?>&nbsp;&nbsp;&nbsp;&nbsp;
							<?php  } } ?>
						    </td>
					
							<!--价格-->
							<td>
								<span>套餐价：<span class="prstyle">￥<?php  echo $item['price'];?></span>
								</span>
								<br />
								<span>体检项：<span class="prstyle"><?php  echo $item['tijianxiang'];?></span>
								</span>
								<br />
							</td>
							<!--仓储-->
							<td>
								<span>
									<span class="prstyle">
									<?php  if(is_array($item['tcper'])) { foreach($item['tcper'] as $fy) { ?>
										<?php  echo $fy['title'];?>&nbsp;&nbsp;&nbsp;&nbsp;
									<?php  } } ?>
									</span>
								</span>

							</td>
							<!--数据-->
							<td>
								<p style="color: #428bca;margin-bottom: 0;">
									<a href="#">已下单：<?php echo $count = $item['xiaoliang']?$item['xiaoliang']:0?></a>
								</p>
								<p style="color: #428bca;margin-bottom: 0;">
									<a href="#">已支付：<?php echo $count = $item['payover']?$item['payover']:0?></a>
								</p>
								<p style="color: #428bca;margin-bottom: 0;">
									<a href="#">已完成：<?php echo $count = $item['overdrder']?$item['overdrder']:0?></a>
								</p>
							</td>
							<!--状态-->
							<td>
								<span class="label label-warning">
									<?php  if($item['typs'] == '0') { ?>
									上架
									<?php  } else if($item['typs'] == '1') { ?>
									未上架
									<?php  } ?>
								</span>
							</td>
							<!--操作-->
							<td class="text-center" style="text-align: center;">
								<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('physical',array('op'=>'tclistadd','id'=>$item['id']))?>" title="编辑">编辑</a>
								<?php  if($item['is_tuijian'] == '0') { ?>
								<a class="btn btn-warning" href="<?php  echo $this->createWebUrl('physical',array('op'=>'changes','id'=>$item['id'],'type'=>'tuijian'))?>" title="推荐">推荐</a>
								<?php  } else if($item['is_tuijian'] == '1') { ?>
								<a class="btn btn-success" href="<?php  echo $this->createWebUrl('physical',array('op'=>'changes','id'=>$item['id'],'type'=>'tuijian'))?>" title="不推荐">不推荐</a>
								<?php  } ?>
								<?php  if($item['typs'] == '1') { ?>
								<a class="btn btn-warning" href="<?php  echo $this->createWebUrl('physical',array('op'=>'changes','id'=>$item['id'],'type'=>'shangji'))?>" title="上架">上架</a>
								<?php  } else if($item['typs'] == '0') { ?>
								<a class="btn btn-success" href="<?php  echo $this->createWebUrl('physical',array('op'=>'changes','id'=>$item['id'],'type'=>'xiajia'))?>" title="下架">下架</a>
								<?php  } ?>
								<?php  if($item['status'] == '0' ) { ?>
								<a class="btn btn-success" href="<?php  echo $this->createWebUrl('physical',array('op'=>'changes','id'=>$item['id'],'type'=>'shenhe','status'=>'1'))?>" title="通过">通过</a>

								<a class="btn btn-danger" href="<?php  echo $this->createWebUrl('physical',array('op'=>'changes','id'=>$item['id'],'type'=>'shenhe','status'=>'-1'))?>" title="拒绝">拒绝</a>
								<?php  } else if($item['status'] == '-1') { ?>
								<span class="btn btn-warning">已拒绝</span>
								<?php  } else if($item['status'] == '1') { ?>
							
                              <!--   <a class="btn label-success" href="<?php  echo $this->createWebUrl('physical',array('op'=>'changes','id'=>$item['id'],'type'=>'shenhe','status'=>'0'))?>" title="审核通过">已通过</a> -->
							
								<?php  } else if($item['status'] == '3') { ?>
								<span class="btn btn-warning">已删除</span>
								<?php  } ?>
								<?php  if($item['status'] == '3') { ?>
								<a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('physical',array('op'=>'tcdel','id'=>$item['id']))?>" data-toggle="ajaxRemove" data-confirm="删除套餐，确定要删除吗？" title="删除">删除</a>
								<?php  } else { ?>
								<a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('physical',array('op'=>'tcdelete','id'=>$item['id']))?>" data-toggle="ajaxRemove" data-confirm="删除套餐，确定要删除吗？" title="删除">删除</a>
								<?php  } ?>
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
						<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">删除选中套餐</a>
					</div>
				</div>
				<div class="pull-right">
				<?php  echo $pager;?>
				</div>
			</div>
		</div>
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
				$.post("/web/index.php?c=site&a=entry&do=physical&op=del_tclists&ac=tclist&m=hyb_yl&", { ids : ids ,type:type}, function(data){
					if(!data.errno){
					util.tips("删除成功！");
					window.location.reload();
					}else{
					util.tips(data.message);	
					};
				}, 'json');
			}, {html: '确认删除所选套餐?'});
		});
</script>
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