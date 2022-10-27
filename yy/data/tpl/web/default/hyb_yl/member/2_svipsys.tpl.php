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
	<li class="active"><a href="#">会员特权</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action"><a href="<?php  echo $this->createWebUrl('member',array('op'=>'svipsysadd'))?>" class="btn btn-primary">添加权益</a></div>
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="op" value="svipsys" />
				<input type="hidden" name="ac" value="svipsys" />
				<input type="hidden" name="do" value="member" />
				<div class="form-group">
					<label class="col-sm-2 control-label">状态</label>
					<div class="col-sm-9">
						<div class="btn-group">
							<a href="<?php  echo $this->createWebUrl('member',array('op'=>'svipsys','status'=>'','keyword'=>$keyword))?>" class="btn <?php  if(empty($status)) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
							<a href="<?php  echo $this->createWebUrl('member',array('op'=>'svipsys','status'=>'1','keyword'=>$keyword))?>" class="btn <?php  if($status==1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">启用中</a>
							<a href="<?php  echo $this->createWebUrl('member',array('op'=>'svipsys','status'=>'2','keyword'=>$keyword))?>" class="btn <?php  if($status==2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未启用</a>
							
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">关键字</label>
					
                    <div class="col-md-4">
                        <input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>"  placeholder="请输入关键字"/>
                    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-md-9">
						<button class="btn btn-primary" id="search">筛选</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="app-table-list">
		<div class="order-list">
			<div class="panel-body table-responsive collapse in" id="order-template-item-4" style="padding: 0;">
				<table class="table table-bordered">
					<thead style="background-color: #FFFFFF;">
					<tr>
						<th style="width:5%;">
                    		<input type="checkbox" name="checkbox"  id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
                    	</th>
						<th style="width:40px">序号</th>
						<th style="width:190px;text-align:center;">特权标题</th>
						<!-- <th style="width:150px;text-align:center;">会员类型</th> -->
						<th style="width:180px; text-align:center;">使用限制说明</th>
						<th style="width:60px; text-align: center;">特权折扣</th>
						<th style="width:120px; text-align: center;">免费领券</th>
						<th style="width:60px; text-align: center;">免费问诊次数</th>
						<th style="width:90px; text-align: center;">状态</th>
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
								<td style="width: 40px;">
	                				<input type="checkbox" name="checkbox[]" value="<?php  echo $item['id'];?>"  />
	                			</td>
								<td style="width: 40px;" ><center><?php  echo $item['id'];?></center></td>
								<td class="goods-info line-feed" style="width:190px;">
									<div class="img"><img src="<?php  echo $item['thumb'];?>" class="scrollLoading" data-url="<?php  echo $item['thumb'];?>" height="50" width="50" ></div>
									<div class="all-tips">
										<span class="" style="font-family: "Arial","Microsoft YaHei","黑体","宋体",sans-serif ;"><?php  echo $item['title'];?></span>
									</div>
								</td>
								<td class="text-center" style="width:180px;height:60px;font-family: "Arial","Microsoft YaHei","黑体","宋体",sans-serif ;">
								<p><?php  echo $item['xianzhi'];?></p>
								</td>
								<td class="text-center" style="width:60px;">
									<span  class="label label-default"> <?php  echo $item['zhekou'];?>折 </span>
								</td>
								<td class="text-center" style="width: 120px; font-size: 12px;" id="td1">
								<span  class="label label-danger"><?php  echo $item['mianfei_num'];?>次</span>
								</td>
								<td class="text-center" style="width:60px;">
								<span  class="label label-danger"><?php  echo $item['mfwz_num'];?>次</span>							
								</td>
								<td class="text-center" id="text-click" order-id="15" order-status="1" style="width:90px;">
							
									<span  class="label label-success"><?php  if($item['status'] == '1') { ?>已启用<?php  } else if($item['status'] == '0') { ?>已禁用<?php  } ?></span>																				
								</td>
								<td class="text-center" style="width:120px;">
								<!-- <a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('member',array('op'=>'svipsys','status'=>'2','keyword'=>$keyword))?>" > 用户使用记录 </a> -->
								<a class="btn btn-warning btn-sm"  href="<?php  echo $this->createWebUrl('member',array('op'=>'svipsysadd','id'=>$item['id']))?>" class="js-edit" order-id="15"> 编辑 </a>
								<a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('member',array('op'=>'svipsysdel','id'=>$item['id']))?>" class="js-remove" order-id="15" >删除</a>					
								</td>

							</tr>
							</tbody>
						</table>
					</div>
				</div>
			<?php  } } ?>
		</div>		
		<div class="app-table-foot clearfix">
			<div class="pull-left">
				<div class="pull-left" id="de1">
					<label class="btn btn-default min-width " style="display: inline-flex;align-items:center;margin-right:1rem;">
						<input type="checkbox" name="checkbox" value="" id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
						<div style="margin-left: 10px">全选</div>
					</label>
					<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_delete">批量删除</a>
				</div>
			</div>
			<div class="pull-right"><?php  echo $pager;?></div>
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
	<script type="text/javascript">
	// 批量删除
	$('#de1').delegate('.pass_delete','click',function(e){
		e.stopPropagation();
		var order_ids = [];
		var $checks=$('.item:checkbox:checked');

		$checks.each(function() {
			if (this.checked) {
				order_ids.push(this.value);
			};
		});
		var $this = $(this);
		var ids = order_ids;

		util.nailConfirm(this, function(state) {console.log(state)
		if(!state)  return;
			$.post("./index.php?c=site&a=entry&do=member&op=del_svipsys&ac=integral&m=hyb_yl", { ids : ids }, function(data){
				if(data.errno=='1'){ 
					util.tips("操作成功！");
					setTimeout(function(){ 
						window.location.reload();
					}, 1000);
				}else{
					util.tips("操作失败"); 	
				};
			}, 'json');
		}, {html: '确认批量删除?'});
	});
</script>
	</body>
</html>