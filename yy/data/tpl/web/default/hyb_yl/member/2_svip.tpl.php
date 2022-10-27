<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<style type="text/css">
	.page-heading {
    padding: 5px 0;
    border-bottom: 1px solid #ccc;
    margin-bottom: 20px;
    position: relative;
    margin-left: 15px;
    }
</style>
<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#">类型列表</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a href="./index.php?c=site&a=entry&do=member&op=svipadd&ac=member&m=hyb_yl" class="btn btn-primary">增加类别</a>
		</div>
	</div>	
	<div class="app-table-list">
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th class="text-center" style="width:120px;">类型名称</th>
					<th class="text-center" style="width:60px;">时长</th>
					<th class="text-center" style="width:100px;">价格</th>
					<th class="text-center" style="width:100px;">匹配权益</th>
					<th class="text-center" style="width:40px;">排序</th>
					<th class="text-center" style="width:80px;">是否启用</th>
					<th class="text-center" style="width:80px;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
										<tr class="text-center" >
						<td>
							<?php  echo $item['title'];?>						</td>
						<td>
							<?php  echo $item['times'];?>天
						</td>
						<td><?php  echo $item['price'];?></td>
						<td><?php  echo $item['quanyi'];?></td>
						<td><?php  echo $item['sort'];?></td>
						<td><label class="label label-primary">
						<?php  if($item['status'] == '1') { ?>
						启用
						<?php  } else if($item['status'] == '0') { ?>
						禁用
						<?php  } ?>
						</label></td>
						<td style="position:relative;">
							<a href="<?php  echo $this->createWebUrl('member',array('op'=>'svipadd','id'=>$item['id']))?>">编辑  </a>
							-<a data-toggle='ajaxPost' href="<?php  echo $this->createWebUrl('member',array('op'=>'del_vip','id'=>$item['id']))?>" data-confirm="确认删除该类型？">删除</a>
						</td>
					</tr>
					<?php  } } ?>
									</tbody>
			</table>
			<?php  echo $pager;?>
		</div>
		<div class="app-table-foot clearfix">
			<div class="pull-left">
				
			</div>
			<div class="pull-right">
							</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	require(['jquery', 'util'], function($, util){
		$('.js-copy').each(function(){
			var id=$(this).attr('data-id');
			util.clip($("#js-copy"+id), $(this).attr('data-url'));
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>