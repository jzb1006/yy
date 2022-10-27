<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#">幻灯片</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a class="btn btn-primary" href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.addadv&ac=addadv">添加幻灯片</a>
		</div>
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site">
				<input type="hidden" name="a" value="entry">
				<input type="hidden" name="m" value="hyb_yl">
				<input type="hidden" name="ac" value="adv">
				<input type="hidden" name="act" value="index.adv">
				<input type="hidden" name="do" value="copysite">
				<!-- <div class="form-group">
					<label class="col-sm-2 control-label">请选择类型</label>
					<div class="col-sm-9">
						<select name="type" class="form-control">
							<option value="">请选择类型</option>
						</select>
					</div>
				</div> -->
				<div class="form-group">
					<label class="col-sm-2 control-label">搜索内容</label>
					<div class="col-sm-9">
						<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入搜索内容">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-md-9">
						<span class="btn btn-primary" id="search">搜索</span>
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
						<th class="text-center">图片</th>
						<th class="text-center">显示顺序</th>
						<th class="text-center">标题</th>
						<th class="text-center">连接</th>
						<th class="text-center">状态</th>
						<th class="text-center">位置</th>
						<th class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($list)) { foreach($list as $adv) { ?>
						<tr  class="text-center">
							<td><img class="scrollLoading" src="<?php  echo tomedia($adv['thumb'])?>" data-url="<?php  echo tomedia($adv['thumb'])?>" onerror="this.src='<?php  echo tomedia($adv['thumb'])?>'" height="50" width="100"/></td>
							<td><?php  echo $adv['sort'];?></td>
							<td><?php  echo $adv['title'];?></td>
							<td class="text-lue" style="max-width: 300px;"><?php  echo $adv['link'];?></td>
							<td><?php  if($adv['status'] == 0) { ?><span class="label label-default">隐藏</span><?php  } ?>
								<?php  if($adv['status'] == 1) { ?><span class="label label-success">显示</span><?php  } ?></td>
							<td>
							
								<?php  if($adv['position'] == 0 || empty($adv['position'])) { ?>
								首页位置1
								<?php  } else if($adv['position'] == 1) { ?>
								首页位置2
								<?php  } else if($adv['position'] == 2) { ?>
								首页位置3
								<?php  } else if($adv['position'] == 3) { ?>
								体检首页
								<?php  } else if($adv['position'] == 4) { ?>
								<!--看一看-->
								<?php  } else if($adv['position'] == 5) { ?>
								<!--积分-->
								<?php  } else if($adv['position'] == 6) { ?>
								专家首页位置1
								<?php  } else if($adv['position'] == 8) { ?>
								专家首页位置2
								<?php  } else if($adv['position'] == 9) { ?>
								专家首页位置3
								<?php  } else if($adv['position'] == 7) { ?>
								推客首页
								<?php  } else if($adv['position'] == 10) { ?>
								患教首页
								<?php  } else if($adv['position'] == 11) { ?>
								查疾病
								<?php  } else if($adv['position'] == 12) { ?>
								查症状
								<?php  } else if($adv['position'] == 13) { ?>
								查疫苗
								<?php  } else if($adv['position'] == 14) { ?>
								体检解读
								<?php  } else if($adv['position'] == 15) { ?>
								家庭常备药
								<?php  } else if($adv['position'] == 16) { ?>
								法定传染病
								<?php  } else if($adv['position'] == 17) { ?>
								院后服务
								<?php  } else if($adv['position'] == 18) { ?>
								绿色通道
								<?php  } else if($adv['position'] == 19) { ?>
								商品首页
								<?php  } else if($adv['position'] == 20) { ?>
								问诊主页
								<?php  } else if($adv['position'] == 21) { ?>
								机构入驻页
								<?php  } ?>
							</td>
							<td>
								<a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.addadv&ac=addadv&id=<?php  echo $adv['id'];?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="修改"><i class="fa fa-edit"></i>修改</a>
								<a href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.adv_del&ac=adv_del&id=<?php  echo $adv['id'];?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="删除"><i class="fa fa-times">删除</i></a>
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