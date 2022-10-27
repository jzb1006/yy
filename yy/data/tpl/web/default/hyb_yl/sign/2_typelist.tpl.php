<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
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
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:;">收费设置</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
      <div class="alert alert-warning">
						注意一：该收费是针对医生团队开通对应服务包所设定的收费项目
						<br>
						注意二：医生团队开通服务包后团队才可以设置服务包针对用户的收费，开通服务包费用计入平台盈利
						<br>
						注意三：医生团队所开通的服务包到期后，将提醒团队负责人进行续费，续费记录可去开通记录中查找
					</div>
		<div class="filter-action">
			<a class="btn btn-primary" href="<?php  echo $this->createWebUrl('sign',array('op'=>'typelistadd'))?>">增加类别</a>
		</div>
	</div>
	<div class="app-table-list">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="text-center">类型名称</th>
						<th class="text-center">时长</th>
						<th class="text-center">价格</th>
						<th class="text-center">服务类型</th>
						<th class="text-center">是否免审核</th>
						<th class="text-center">排序</th>
						<th class="text-center">是否启用</th>
						<th class="text-center">是否用于续费</th>
						<th class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
											<tr class="text-center" >
							<td>
								<?php  echo $item['title'];?>							</td>
							<td>
								<?php  echo $item['time'];?>天
							</td>
							<td><?php  echo $item['price'];?></td>
							<td><label class="label label-info"><?php  echo $item['type_name'];?></label></td>
							<td><label class="label label-primary">
							<?php  if($item['is_shenhe'] == '1') { ?>
							免审核
							<?php  } else if($item['is_shenhe'] == '0') { ?>
							需审核
							<?php  } ?>
							</label></td>
							<td>
								<?php  echo $item['sort'];?>							</td>
							<td><label class="label label-primary">
							<?php  if($item['status'] == '1') { ?> 
							启用
							<?php  } else if($item['status'] == '0') { ?>
							禁用
							<?php  } ?>
							</label></td>
							<td><label class="label label-primary">
							<?php  if($item['is_xufei'] == '1') { ?>
							续费可用
							<?php  } else if($item['is_xufei'] == '0') { ?>
							不可续费
							<?php  } ?>
							</label></td>
							<td style="position:relative;">
								<a href="<?php  echo $this->createWebUrl('sign',array('op'=>'typelistadd','id'=>$item['id']))?>">编辑  </a> -
								<a href="<?php  echo $this->createWebUrl('sign',array('op'=>'typelistdel','id'=>$item['id']))?>">删除  </a>
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
