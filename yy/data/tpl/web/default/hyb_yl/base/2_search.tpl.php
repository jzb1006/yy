<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#">搜索设置</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a class="btn btn-primary" href="/index.php?c=site&a=entry&do=base&m=hyb_yl&op=add_search&ac=search">添加搜索设置</a>
		</div>
	</div>
	<div class="app-table-list">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="text-center">图片</th>
						<th class="text-center">显示顺序</th>
						<th class="text-center">标题</th>
						<th class="text-center">所搜内容</th>
						<th class="text-center">状态</th>
						<th class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($list)) { foreach($list as $adv) { ?>
						<tr  class="text-center">
							<td><img class="scrollLoading" src="<?php  echo tomedia($adv['thumb'])?>" data-url="<?php  echo tomedia($adv['thumb'])?>" onerror="this.src='<?php  echo tomedia($adv['thumb'])?>'" height="50" width="100"/></td>
							<td><?php  echo $adv['sort'];?></td>
							<td><?php  echo $adv['title'];?></td>
							<td>
								<?php  if($adv['keyword'] == 1) { ?>
								医生
								<?php  } else if($adv['keyword'] == 2) { ?>
								医院
								<?php  } else if($adv['keyword'] == 3) { ?>
								药房
								<?php  } ?>
							</td>
							<td><?php  if($adv['status'] == 0) { ?><span class="label label-default">隐藏</span><?php  } ?>
								<?php  if($adv['status'] == 1) { ?><span class="label label-success">显示</span><?php  } ?>
							</td>
							<td>
								<a href="/index.php?c=site&a=entry&do=base&m=hyb_yl&op=add_search&ac=search&id=<?php  echo $adv['id'];?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="修改"><i class="fa fa-edit"></i>修改</a>
								<a href="/index.php?c=site&a=entry&do=base&m=hyb_yl&op=del_search&ac=search&id=<?php  echo $adv['id'];?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="删除"><i class="fa fa-times">删除</i></a>
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
				<?php  echo $pager;?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#search").click(function(){
		$('#form1')[0].submit();
	});
</script>