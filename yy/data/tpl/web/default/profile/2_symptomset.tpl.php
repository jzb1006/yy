<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<style type='text/css'>
	.trbody td{text-align: center;vertical-align:top;border-left:1px solid #ccc;border-bottom: 1px solid #ddd;}
	.order-rank img{width:16px;height:16px;}
	.js-remark,.js-admin-remark{word-break:break-all;overflow:hidden;background: #FDEEEE;color: #ED5050;padding: 5px 10px;}
	td.goods-info{position:relative;padding-left:60px;}
	.goods-info .img{position:absolute;top:50%;margin-top:-25px;background: url(https://xiaochuang.webstrongtech.net/addons/hyb_yl/web/resource/images/loading.gif	) center center no-repeat;width:50px;height:50px;}
	.goods-info span{white-space: inherit;overflow: hidden;text-overflow: ellipsis;display: block;}
	.status-text{cursor:pointer;}
	.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{border-top: 1px solid rgba(221, 221, 221, 0);}
	.col-md-1{padding-right: 0px;}
	.all-tips{margin-left: 65px;}
	span.effect-time{font-size: 12px;display: block;font-weight: 500;}
	.row.row-fix, .form-group.form-group-fix{margin-left: -15px;margin-right: -15px;width: 500px;}
	button.btn.btn-default.daterange.daterange-date{float: left;margin-left: 234px;position: absolute;z-index: 100;}
	#sel_child{z-index: 10;width: 200px;position: absolute;display: none;}
	.show1{display: block;}
	.hide1{display: none;}
	.daterange-date{display: none;}
	.sty{display: block;width: 100%;font-size: 13px;height: 46px;overflow: hidden;white-space: nowrap;line-height: 46px;text-overflow: ellipsis;text-align: center;}
	.spe{display: inline-block;text-align: center;display: block;height: 33px;margin-left: -12px;padding-top: 0px;line-height: 33px;}
	.table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{white-space: normal;}
	span.ppp{text-align: center;display: inline-block;font-size: 14px;width: 100%;overflow: hidden;text-overflow: ellipsis;color: #e43;}
	select#sel_parent{z-index: 1000;}
	.nickname{margin-left: 94px;height: 34px;width: 200px;}
	.col-xs-12.col-sm-6.col-md-6.col-lg-6{z-index: 9999;}
	.start-time{font-size: 12px;}
	.end-time{font-size: 12px;}
	.mouth{margin-left: 94px;height: 34px;width:130px;display: none;}
</style>
<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#">档案字段设置</a></li>
</ul>
<div class="app-content">
<?php  if(count($list)<3) { ?>
	<div class="app-filter">
		<div class="filter-action"><a href="./index.php?c=site&a=entry&op=userlist&do=copysite&m=hyb_yl&act=profile.addsymptomset&ac=symptomset" class="btn btn-primary">添加档案字段</a></div>
		
	</div>
<?php  } ?>
	<div class="app-table-list">
		<div class="order-list">
			<div class="panel-body table-responsive collapse in" id="order-template-item-4" style="padding: 0;">
				<table class="table table-bordered">
					<thead style="background-color: #FFFFFF;">
					<tr>
						<th style="width:40px">序号</th>
						<th style="width:190px;text-align:center;">步骤</th>
						<th style="width:90px; text-align: center;">字段值</th>
						<th style="width:120px; text-align: center;">操作</th>
					</tr>
					</thead>

				</table>
			</div>
			<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<div class="panel panel-default">
					<div class="panel-body table-responsive" style="padding: 0px;">
						<table class="table table-bordered">
							<tbody >
							<tr>
								<td style="width: 40px;" ><center><?php  echo $item['id'];?></center></td>
								<td class="goods-info line-feed" style="width:190px;">
									
									<div class="all-tips">
										<span class="" style="font-family: "Arial","Microsoft YaHei","黑体","宋体",sans-serif ;"><?php  echo $item['step'];?></span>
									</div>
								</td>
								
								<td class="text-center" id="text-click" order-id="15" order-status="1" style="width:90px;">
									<?php  echo $item['cons'];?>							
								</td>
								<td class="text-center" style="width:120px;">
								
								<a class="btn btn-warning btn-sm"  href="./index.php?c=site&a=entry&op=userlist&do=copysite&m=hyb_yl&act=profile.addsymptomset&ac=symptomset&id=<?php  echo $item['id'];?>" class="js-edit" order-id="15"> 编辑 </a>
								<a class="btn btn-danger btn-sm" href="./index.php?c=site&a=entry&op=userlist&do=copysite&m=hyb_yl&act=profile.delsymptomset&ac=symptomset&id=<?php  echo $item['id'];?>" class="js-remove" order-id="15" >删除</a>					
								</td>

							</tr>
							</tbody>
						</table>
					</div>
				</div>
			<?php  } } ?>
		</div>	
		<div class="app-table-foot clearfix">
			<div class="pull-left"></div>
			<div class="pull-right"><?php  echo $pager;?></div>
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