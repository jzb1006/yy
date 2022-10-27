<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:;">分类列表</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'add_category','hid'=>$_SESSION['hid'],'ac'=>'categry'))?>" class="btn btn-primary">添加分类</a>
		</div>
	</div>	
	<div class="app-table-list">
		<div class="table-responsive">
			<table id="de1" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th class="text-center" style="width:100px;">ID</th>
						<th class="text-center" style="width:100px;">分类排序</th>
						<th class="text-center" style="width:400px;">分类信息</th>
						<th class="text-center" style="width:100px;">首页显示</th>
						<th class="text-center" style="width:240px;">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
										<tr class="text-center" >
						<td><?php  echo $item['fid'];?></td>
						<td><?php  echo $item['sort'];?></td>
						<td>
							<div class="img" style="text-align: left;padding-left: 2rem;">
								<img style="height: 50px;width: 50px;margin-right: 10px;"   src ="<?php  echo $item['fenlpic'];?>">
								<span> <?php  echo $item['fenlname'];?></span>
							</div>
						</td>
						<td><span class="label label-success"><?php  if($item['rec'] == '1') { ?>显示<?php  } else if($item['rec'] == '0') { ?> 隐藏 <?php  } ?></span></td>
						<td>
							<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'add_category','fid'=>$item['fid'],'hid'=>$_SESSION['hid']))?>" class="btn btn-primary">修改</a>
							<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'del_category','fid'=>$item['fid'],'hid'=>$_SESSION['hid']))?>" class="btn btn-danger" data-toggle="ajaxRemove" data-confirm="此操作会删除当前分类，确定要删除吗？">删除</a>
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

