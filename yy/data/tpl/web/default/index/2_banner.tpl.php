<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li class="active"><a href="#">广告位</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a class="btn btn-primary" href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.banneradd&ac=banneradd">添加广告</a>
		</div>
	</div>
	<div class="app-table-list">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="text-center" width="15%">图片</th>
						<th class="text-center" width="10%">显示顺序</th>
						<th class="text-center" width="20%">标题</th>
						<th class="text-center" width="30%">连接</th>
						<th class="text-center" width="10%">状态</th>
						<th class="text-center" width="15%">操作</th>
					</tr>
				</thead>
				<tbody>
										<tr class="text-center">
						<td><img class="scrollLoading" src="https://caiji123258.oss-cn-beijing.aliyuncs.com/images/1/2020/02/edDIcXxeRzCAR4JAEcCXYE4Rc6Zrc6.jpg" data-url="https://caiji123258.oss-cn-beijing.aliyuncs.com/images/1/2020/02/edDIcXxeRzCAR4JAEcCXYE4Rc6Zrc6.jpg" height="50" width="100"/></td>
						<td>0</td>
						<td>测试广告</td>
						<td class="text-lue">https://xiaochuang.webstrongtech.net/app/index.php?i=1&c=entry&m=hyb_yl&p=wlfightgroup&ac=fightapp&do=fightindex</td>
						<td><input type="checkbox" class="js-switch tpl_change_status" data-url="https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=weliam_smartcity&p=dashboard&ac=banner&do=changeStatus&id=15&" data-open="1" data-close="0" checked="checked"></td>
						<td>
							<a class="btn btn-sm btn-warning" href="https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=weliam_smartcity&p=dashboard&ac=banner&do=edit&id=15">编辑</a>
							<a class="btn btn-sm btn-danger" data-toggle="ajaxRemove" href="https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=weliam_smartcity&p=dashboard&ac=banner&do=delete&id=15" data-confirm="确定删除当前信息?">删除</a>
						</td>
					</tr>
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