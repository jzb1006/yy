<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="javascript:;">分组权限</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-table-list">
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead class="navbar-inner">
						<tr>
							<th style="width: 50px;">ID</th>
							<th style="">分组名称</th>
							<th style="width: 80px">操作</th>
						</tr>
					</thead>
					<tbody>
					    <?php  if(is_array($list)) { foreach($list as $item) { ?>
						<tr>
							<td><?php  echo $item['id'];?></td>
							<td>
								
									<?php  echo $item['title'];?> 
							</td>
							<td style="position: relative;">
								<a class="btn btn-default btn-sm" href="/index.php?c=site&a=entry&do=jiancha&op=editrole&ac=editrole&m=hyb_yl&id=<?php  echo $item['id'];?>&h_id=<?php  echo $_SESSION['hid'];?>&keyword=<?php  echo $item['keyword'];?>" title="编辑">编辑</a>
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

    <script type="text/javascript" src="<?php  echo HYB_YL_ADMIN?>/js/table_edit.js"></script>
	
</div>
</div>
</div>
<div class="foot" id="footer">
	<ul class="links ft">
		<li class="links_item">
			<div class="copyright">Powered by <a href="http://www.we7.cc">
					<b>系统</b>
				</a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a>
			</div>
		</li>
	</ul>
</div>


</body>
</html>