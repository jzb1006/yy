<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<style type='text/css'>
	.trbody td {text-align: center; vertical-align:top;border-left:1px solid #ccc; border-bottom: 1px solid #ddd;}
</style>
<style>
	.order-rank img{width:16px; height:16px;}
	.js-remark,.js-admin-remark{word-break:break-all; overflow:hidden; background: #FDEEEE;color: #ED5050;padding: 5px 10px;}
	td.goods-info{position:relative; padding-left:60px;}
	.goods-info .img{position:absolute;top:50%; margin-top:-25px; background: url(https://www.webstrongtech.com/addons/weliam_merchant/web/resource/images/loading.gif) center center no-repeat; width:50px;height:50px; }
	.goods-info span {white-space: nowrap;overflow: hidden;text-overflow: ellipsis;display: block;}
	.status-text{cursor:pointer;}
	.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {border-top: 1px solid rgba(221, 221, 221, 0);}
	.col-md-1{padding-right: 0px;}
	.all-tips{
		margin-left: 65px;
	}
	span.effect-time {
		font-size: 12px;
		display: block;
		font-weight: 500;
	}
	.row.row-fix, .form-group.form-group-fix {
		margin-left: -15px;
		margin-right: -15px;
		width: 500px;
	}
	#sel_child{
		display: none;
	}
	.show1{
		display: block;
	}
	.hide1{
		display: none;
	}
	.sty {
		display: block;
		width: 100%;
		font-size: 13px;
		height: 46px;
		overflow: hidden;
		white-space: nowrap;
		line-height: 46px;
		text-overflow: ellipsis;
		text-align: center;
	}
	.spe {
		display: inline-block;
		text-align: center;
		display: block;
		height: 33px;
		margin-left: -12px;
		padding-top: 0px;
		line-height: 33px;
	}
	.table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
		white-space: normal;
	}
	span.ppp {
		text-align: center;
		display: inline-block;
		font-size: 14px;
		width: 100%;
		overflow: hidden;
		text-overflow: ellipsis;
		color: #e43;
	}
	.todetail{
		text-align: center;
		display: inline-block;
		font-size: 14px;
		width: 100%;
		overflow: hidden;
		text-overflow: ellipsis;
		color: deepskyblue;
	}
	.todetail:hover{cursor:pointer;}
</style>
<ul class="nav nav-tabs">
	<li <?php  if(empty($listtype) || $listtype=='0') { ?> class="active" <?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponlist','op'=>'couponlist','listtype'=>'0'))?>">全部<span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $countnum;?></span></a>
	</li>
	<li <?php  if($listtype=='1') { ?> class="active" <?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponlist','op'=>'couponlist','listtype'=>'1'))?>">启用中<span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $qiyongnum;?></span>
		</a>
	</li>
	<li <?php  if($listtype=='2') { ?> class="active" <?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponlist','op'=>'couponlist','listtype'=>'2'))?>">禁用中<span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $jinyongnum;?></span>
		</a>
	</li>
	<li <?php  if($listtype=='3') { ?> class="active" <?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponlist','op'=>'couponlist','listtype'=>'3'))?>">已失效<span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $guoqinum;?></span>
		</a>
	</li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponadd','op'=>'couponadd','id'=>$item['id']))?>" class="btn btn-primary">添加优惠券</a>
		</div>
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="op" value="couponlist" />
				<input type="hidden" name="ac" value="couponlist" />
				<input type="hidden" name="do" value="apply" />
				<input type="hidden" name="listtype" value="<?php  echo $listtype;?>" />
				<!-- <div class="form-group">
					<label class="col-sm-2 control-label">类型</label>
					<div class="col-sm-9">
						<div class="btn-group">
							<a href="./index.php?c=site&a=entry&m=weliam_merchant&p=wlcoupon&ac=couponlist&do=couponsList&type=0&page=1" class="btn btn-primary">不限</a>		
							<a href="./index.php?c=site&a=entry&m=weliam_merchant&p=wlcoupon&ac=couponlist&do=couponsList&type=0&page=1" class="btn btn-primary">代金券</a>																			
						</div>
					</div>
				</div> -->
				<div class="form-group">
					<label class="col-sm-2 control-label">关键字</label>
					<div class="col-md-3">
						<select name="keywordtype" class="form-control">
							<option value="">关键字类型</option>
							<option value="1" >优惠券标题</option>
							<option value="2" >机构名称</option>
						</select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="keyword" class="form-control" value="<?php  echo $_GPC['keyword'];?>"  placeholder="请输入关键字"/>
                    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">时间筛选</label>
					<div class="col-md-2">
						<select name="timetype" class="form-control">
							<option value="0">--请选择--</option>
							<option value="1" <?php  if($timetype=='1') { ?> selected  <?php  } ?>>有效时间</option>
						</select>
					</div>
					<div class="col-sm-6">
						<?php  echo tpl_form_field_daterange('time_limit', array('starttime' =>$starttime,'endtime' => $endtime));?>
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
	<script type="text/javascript">
        $("#search").click(function(){
            $('#form1')[0].submit();
        });
	</script>
	<div class="app-table-list">
			<div class="panel-body table-responsive collapse in" id="order-template-item-4" style="padding: 0;">
				<table class="table table-hover table-bordered">
					<thead style="background-color: #FFFFFF;">
					<tr>
						<th style="width:20px;">
							<input type="checkbox" name="checkall" value="" id="checkall" class="checkboxall" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});">
						</th>
						<th style="width:30px;">序号</th>
						<th style="width:100px;">优惠券名称</th>
						<th style="width:150px;">所属机构</th>
						<th style="width:80px; ">类型</th>
						<!-- <th style="width:150px;">优惠券使用条件</th> -->
						<th style="width:100px;">优惠金额</th>
						<th style="width:200px;">优惠券使用说明</th>
						<th style="width:100px;">已售/库存</th>
						<th style="width:200px; ">适用服务</th>
						<th style="width:50px; ">状态</th>
						<th style="width:100px;">有效时间</th>
						<th style="width:150px; ">操作</th>
					</tr>
					</thead>
					<tbody >
						<?php  if(is_array($list)) { foreach($list as $item) { ?>
						<tr>
							<td style="width: 20px;" >
								<center><input type="checkbox" name="checkbox[]" value="<?php  echo $item['id'];?>"  class="item" /></center>
							</td>
							<td style="width:30px;"><?php  echo $item['id'];?></td>
							<td style="width:100px;"><?php  echo $item['title'];?></td>
							<td style="width:150px;"><?php  echo $item['jigouname'];?></td>
							<td style="width:80px;">
									<!--优惠券类型 0 代金券 1 折扣券 2套餐券 3团购券 -->
									<?php  if($item['usagetype']=='0') { ?>代金券<?php  } ?>
							</td>
							<!-- <td style="width:150px;">满<?php  echo $item['daily'];?>元减<?php  echo $item['first'];?>元</td> -->
							<td style="width:100px;"><?php  echo $item['deductible_amount'];?></td>
							<td style="width:200px;"><?php  echo $item['sub_title'];?></td>
							<td style="width:100px;"><?php  echo $item['couponcode_duihuantnum'];?>/<?php  echo $item['couponcode_countnum'];?></td>
							<td style="width:200px;"><?php  echo $item['shiyongfuwu'];?></td>
							<td style="width:50px;"><?php  if($item['state']=='0') { ?>启用<?php  } else { ?>禁用<?php  } ?></td>
							<td style="width:100px;"><?php  echo $item['starttime'];?>~<?php  echo $item['endtime'];?></td>
							<td style="width:150px;">
								<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponadd','op'=>'couponadd','id'=>$item['id']))?>" title="编辑/查看详情">查看详情</a>
	                    		<a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('apply', array('ac'=>'coupondel','op'=>'coupondel','id'=>$item['id']))?>" data-id="11">删除</a> 
							</td>
						</tr>
						<?php  } } ?>
					</tbody>
				</table>
			</div>
			<div class="app-table-foot clearfix">
				<div class="pull-left" id='de1'>
					<label class="btn btn-default min-width " style="display: inline-flex;align-items:center;margin-right:1rem;">
					<input type="checkbox" name="checkbox" value="" id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});">
					<div style="margin-left: 10px">全选</div>
					</label>
					<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_delete">批量删除</a>
				</div>
				<div class="pull-right"><?php  echo $pagers;?></div>
			</div>
		</div>
	</div>
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
			$.post("<?php  echo $this->createWebUrl('apply',array('ac'=>'couponlist','op'=>'couponlist_pass_pldelete'))?>", { ids : ids }, function(data){
				if(data.errno=='1'){ 
					util.tips("操作成功！");
					setTimeout(function(){ 
						window.location.reload();
					}, 1000);
				}else{
					util.tips("操作失败"); 	
				};
			}, 'json');
		}, {html: '确认删除?'});
	});
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>
