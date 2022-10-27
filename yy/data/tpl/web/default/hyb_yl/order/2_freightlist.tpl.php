<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<style>
	.prstyle{color: orangered;}
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="/index.php?c=site&a=entry&do=order&op=freightlist&ac=freightlist&m=hyb_yl">模板列表</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a href="/index.php?c=site&a=entry&do=order&op=addfreighttem&ac=addfreighttem&m=hyb_yl">添加模板</a>
		</div>
	</div>
	<div class="app-table-list">
		<div class="table-responsive">
			<table id="de1" class="table table-hover table-bordered">
				<thead>
				<tr>
					<th class="text-center" style="width:50px;">序号</th>
					<th class="text-center" style="width:100px;">模板名称</th>
					<th class="text-center" style="width:250px;">默认区域邮费</th>
					<th class="text-center" style="width:120px;">最新修改时间</th>
					<th class="text-center" style="width:80px;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<tr class="text-center" >
					<td>
						<center><?php  echo $item['id'];?></center>
					</td>
					<!--模板名称-->
					<td>
						<?php  echo $item['title'];?>					</td>
					<!--默认地区邮费-->
					<td>
					<?php  if(is_array($item['detail'])) { foreach($item['detail'] as $det) { ?>
						<?php  echo $det['address'];?>下单量在<span class="prstyle"><?php  echo $det['first'];?></span>件内，运费<span class="prstyle"><?php  echo $det['first_price'];?></span>元，每增加<span class="prstyle"><?php  echo $det['continue'];?></span>件，加运费<span class="prstyle"><?php  echo $det['continue_price'];?></span>元<br>
					<?php  } } ?>
					
					</td>
					<!--最新修改时间-->
					<td>
						<?php  echo $item['update'];?>					</td>
					<!--操作-->
					<td>
						<a href="<?php  echo $this->createWebUrl('order',array('op'=>'addfreighttem','id'=>$item['id']))?>">编辑</a> -
						<a href="javascript:;" itemid="<?php  echo $item['id'];?>" class="shanchu">删除</a>
					</td>
				</tr>
				<?php  } } ?>
								</tbody>
			</table>
		</div>
		<div class="app-table-foot clearfix">
			<div class="pull-left">
				
			</div>
			<div class="pull-right">
							</div>
		</div>
	</div>
</div>
<script>
	$('#de1').delegate('.shanchu','click',function(e){
		e.stopPropagation();
		var id = $(this).attr('itemid');
		util.nailConfirm(this, function(state) {
		if(!state) return;
			$.post("<?php  echo $this->createWebUrl('order',array('op'=>'delfreight'))?>", { id : id }, function(data){
				if(!data.errno){
				util.tips("删除成功！");
				location.reload();
				};
			}, 'json');
		}, {html: '确认删除?'});
	});
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

