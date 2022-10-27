<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li class="active"><a href="#">服务主页</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a class="btn btn-primary" href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.cubeedit&ac=cubeedit">添加服务主页</a>
		</div>
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<div class="form-group">
					<label class="col-sm-2 control-label">搜索内容</label>
					<div class="col-sm-9">
						<input type="text" name="keyname" class="form-control" value="" placeholder="请输入搜索内容">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-9">
						<span class="btn btn-primary" id="search">搜索</span>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="app-table-list">
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th class="text-center">服务主页图片</th>
						<th class="text-center">显示顺序</th>
						<th class="text-center">标题</th>
						<th class="text-center">展示位置</th>
						<th class="text-center">状态</th>
						<th class="text-center">类型</th>
						<th class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php  if(is_array($res)) { foreach($res as $item) { ?>
						<tr  class="text-center">
							<td><img class="scrollLoading" src="<?php  echo tomedia($item['serh_thumb'])?>" data-url="<?php  echo tomedia($item['serh_thumb'])?>" width="100"/></td>
							<td><?php  echo $item['stort'];?></td>
							<td><?php  echo $item['serh_name'];?></td>
							<td class="text-lue"><?php  if($item['weizhi'] =='0') { ?> 问诊页 <?php  } else if($item['weizhi'] == '1') { ?> 首页<?php  } else if($item['weizhi'] == '2') { ?>绿通页<?php  } ?></td>
							<td><input type="checkbox" class="js-switch tpl_change_status" data-url="" data-open="1" data-close="0" <?php  if($item['state'] =='1') { ?> checked="checked" <?php  } ?>></td>
							<td>
								<?php  echo $item['titles'];?>
							</td>
							<td>
								<a class="btn btn-sm btn-warning" href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.cubeedit&ac=cubeedit&id=<?php  echo $item['id'];?>">编辑</a>
								<a class="btn btn-sm btn-danger" href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.cubedelete&ac=cubedelete&id=<?php  echo $item['id'];?>" data-confirm="确定删除当前信息?">删除</a>
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
<script type="text/javascript">
	$("#search").click(function(){
		$('#form1')[0].submit();
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
	
    <script>
		require(['bootstrap'], function ($) {
		    $('[data-toggle="tooltip"]').tooltip({
	            container: $(document.body)
	        });
	        $('[data-toggle="popover"]').popover({
	            container: $(document.body)
	        });
	        $('[data-toggle="dropdown"]').dropdown({
	            container: $(document.body)
	        });
	    });
		myrequire(['js/init']);
		$('.app-login-info-name, .app-login-info-sel').mouseover(function(){
			$('.app-login-info-sel').show();
		});
		$('.app-login-info-name, .app-login-info-sel').mouseout(function(){
			$('.app-login-info-sel').hide();
		});
		$('.app-login-info-sel .login-out').hover(function(){
			$('.app-login-info-sel-arrow').css('border-color', '#1ab394 transparent transparent transparent');
		},function(){
			$('.app-login-info-sel-arrow').css('border-color', '#f2f2f2 transparent transparent transparent');
		});
	</script>
	</body>
</html>
