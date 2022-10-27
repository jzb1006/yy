<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="">收入记录</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-filter">
			<div class="filter-list">
				<form action="./index.php" method="get" class="form-horizontal form" id="form1">
					<input type="hidden" name="c" value="site" />
					<input type="hidden" name="a" value="entry" />
					<input type="hidden" name="m" value="hyb_yl" />
					<input type="hidden" name="op" value="currentmy" />
					<input type="hidden" name="ac" value="currentmy" />
					<input type="hidden" name="do" value="financ" />
					<div class="form-group max-with-all">
						<label class="col-sm-2 control-label">类型</label>
						<div class="col-sm-9">
							<div class="btn-group">
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'currentmy','ac'=>'currentmy','type'=>'','keyword'=>$keyword))?>" class="btn <?php  if($type == '') { ?> btn-primary <?php  } else { ?> btn-default<?php  } ?>">不限</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'currentmy','ac'=>'currentmy','type'=>'1','keyword'=>$keyword))?>" class="btn <?php  if($type == '1') { ?> btn-primary <?php  } else { ?> btn-default<?php  } ?>">医院</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'currentmy','ac'=>'currentmy','type'=>'2','keyword'=>$keyword))?>" class="btn <?php  if($type == '2') { ?> btn-primary <?php  } else { ?> btn-default<?php  } ?>">药房</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'currentmy','ac'=>'currentmy','type'=>'3','keyword'=>$keyword))?>" class="btn <?php  if($type == '3') { ?> btn-primary <?php  } else { ?> btn-default<?php  } ?>">体检机构</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'currentmy','ac'=>'currentmy','type'=>'4','keyword'=>$keyword))?>" class="btn <?php  if($type == '4') { ?> btn-primary <?php  } else { ?> btn-default<?php  } ?>">诊所</a>
							</div>
						</div>
					</div>
					

					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-9">
							<button class="btn btn-primary">搜索</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="app-table-list">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<!-- <th style="text-align:center;">时间</th> -->
							<th style="text-align:center;">账户名称</th>
							<th style="text-align:center;">类型</th>
							<th style="text-align:center;">收入|支出(元)</th>
							<th style="text-align:center;">账户余额</th>
							<!-- <th style="text-align:center;">详情/备注</th> -->
						</tr>
					</thead>
					<tbody>
					<?php  if(is_array($list)) { foreach($list as $item) { ?>
						<tr>
							<!--时间-->
							<!-- <td class="goods-info line-feed" style="padding-left: 10px;">
								<?php  echo $item['time'];?> </td> -->
							<td class="text-center" style="height:60px;font-family: " Arial","Microsoft YaHei","黑体","宋体",sans-serif ;">
							<?php  echo $item['agentname'];?>
							</td>
							<!--类型-->
							<td class="text-center" style="font-family: " Arial","Microsoft YaHei","黑体","宋体",sans-serif;">
								<span class="label label-info"><?php  if($item['cash'] == 0) { ?>订单抽成<?php  } else if($item['cash'] == '1') { ?>机构提现<?php  } ?></span>
							</td>
							<!--代理收入|支出-->
							<td class="text-center" style="font-family: " Arial","Microsoft YaHei","黑体","宋体",sans-serif;">
								<span style="color: green ;"> <?php  if($item['type'] == '0') { ?>+<?php  } else if($item['type'] == '1') { ?>-<?php  } ?><?php  echo $item['money'];?></span>
								<br />
							</td>
							<td class="text-center" style="font-family: " Arial","Microsoft YaHei","黑体","宋体",sans-serif;">
								<?php  echo $item['h_money'];?> </td>
							<!-- <td class="text-center" style="font-family: " Arial","Microsoft YaHei","黑体","宋体",sans-serif;">
								<a href="http://www.webstrongtech.com/web/index.php?c=site&a=entry&m=hyb_yl&p=order&ac=wlOrder&do=orderdetail&currentid=140" class="btn btn-default btn-sm">查看详情</a>
							</td> -->
						</tr>
						<?php  } } ?>
					</tbody>
				</table>

			</div>
			<div class="app-table-foot clearfix">
				<div class="pull-left">
						<?php  echo $pager;?>
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