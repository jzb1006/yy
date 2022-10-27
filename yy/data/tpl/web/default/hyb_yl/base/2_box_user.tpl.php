<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#">云音响可操作用户</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
	<?php  if(count($list) == '0') { ?>
		<div class="filter-action">
			<a class="btn btn-primary" href="/index.php?c=site&a=entry&op=addbox_user&ac=box_user&do=base&m=hyb_yl">添加可操作用户</a>
		</div>
		
	</div>
	<?php  } ?>
	<div class="app-table-list">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="text-center">id</th>
						<th class="text-center">用户id</th>
						<th class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($list)) { foreach($list as $adv) { ?>
						<tr  class="text-center">
							
							<td><?php  echo $adv['id'];?></td>
							<td><?php  echo $adv['uid'];?></td>
							<td>
								<a href="/index.php?c=site&a=entry&op=addbox_user&ac=box_user&do=base&m=hyb_yl&id=<?php  echo $adv['id'];?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="查看"><i class="fa fa-edit"></i>查看</a>
								<a href="/index.php?c=site&a=entry&op=delbox_user&ac=box_user&do=base&m=hyb_yl&id=<?php  echo $adv['id'];?>&uid=<?php  echo $adv['uid'];?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="删除"><i class="fa fa-times">删除</i></a>
							</td>
						</tr>
					<?php  } } ?>
				</tbody>
			</table>
		</div>
		
	</div>
</div>
<script type="text/javascript">
	$("#search").click(function(){
		$('#form1')[0].submit();
	});
</script>