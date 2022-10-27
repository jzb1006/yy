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
			<a href="<?php  echo $this->createWebUrl('team',array('op'=>'settledadd'))?>" class="btn btn-primary">增加条件</a>
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
					
						<td>2</td>
						<td><label class="label label-primary">
						<?php  if($item['status'] == '1') { ?>
						启用
						<?php  } else if($item['status'] == '0') { ?>
						禁用
						<?php  } ?>
						</label></td>
						<td style="position:relative;">
							<a href="<?php  echo $this->createWebUrl('team',array('op'=>'settledadd','id'=>$item['id'],'ac'=>'settled'))?>">编辑  </a>
							-<a data-toggle='ajaxPost' href="<?php  echo $this->createWebUrl('team',array('op'=>'delsettled','id'=>$item['id'],'ac'=>'settled'))?>" data-confirm="确认删除该类型？">删除</a>
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
