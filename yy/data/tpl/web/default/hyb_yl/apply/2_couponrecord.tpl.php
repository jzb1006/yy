<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
<style type='text/css'>
.trbody td{text-align: center;vertical-align:top;border-left:1px solid #ccc;border-bottom: 1px solid #ddd;}
.order-rank img{width:16px;height:16px;}
.js-remark,.js-admin-remark{word-break:break-all;overflow:hidden;background: #FDEEEE;color: #ED5050;padding: 5px 10px;}
td.goods-info{position:relative;padding-left:60px;}
.goods-info .img{position:absolute;top:50%;margin-top:-25px;background: url(http://www.webstrongtech.com/addons/weliam_merchant/web/resource/images/loading.gif) center center no-repeat;width:50px;height:50px;}
.goods-info span{white-space: nowrap;overflow: hidden;text-overflow: ellipsis;display: block;}
.status-text{cursor:pointer;}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{border-top: 1px solid rgba(221, 221, 221, 0);}
.col-md-1{padding-right: 0px;}
.all-tips{margin-left: 65px;}
span.effect-time{font-size: 12px;display: block;font-weight: 500;}
.row.row-fix, .form-group.form-group-fix{margin-left: -15px;margin-right: -15px;width: 500px;}
button.btn.btn-default.daterange.daterange-date{float: left;position: absolute;z-index: 100;}
#sel_child{z-index: 10;width: 200px;position: absolute;display: none;}
.show1{display: block;}
.hide1{display: none;}
.sty{display: block;width: 100%;font-size: 13px;height: 46px;overflow: hidden;white-space: nowrap;line-height: 46px;text-overflow: ellipsis;text-align: center;}
.spe{display: inline-block;text-align: center;display: block;height: 33px;margin-left: -12px;padding-top: 0px;line-height: 33px;}
.table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{white-space: normal;}
span.ppp{text-align: center;display: inline-block;font-size: 14px;width: 100%;overflow: hidden;text-overflow: ellipsis;color: #e43;}
select#sel_parent{z-index: 1000;}
.nickname{margin-left: 94px;height: 34px;width: 200px;display: none;}
.col-xs-12.col-sm-6.col-md-6.col-lg-6{z-index: 9999;}
.start-time{font-size: 12px;}
.end-time{font-size: 12px;}
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:;">领取列表</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="op" value="couponrecord" />
				<input type="hidden" name="ac" value="couponrecord" />
				<input type="hidden" name="do" value="apply"/>
				<input type="hidden" name="status" value="<?php  echo $_GPC['status'];?>"/>
				<div class="form-group">
					<label class="col-sm-2 control-label">状态</label>
					<div class="col-sm-9">
						<div class="btn-group">
							<a  href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponrecord','op'=>'couponrecord','status'=>'0'))?>" class="btn <?php  if(intval($_GPC['status']) == 0 || empty($_GPC['status'])) { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">全部</a>
							<a href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponrecord','op'=>'couponrecord','status'=>'1'))?>"  class="btn <?php  if(intval($_GPC['status']) == 1) { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已使用</a>
							<a href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponrecord','op'=>'couponrecord','status'=>'2'))?>"  class="btn <?php  if(intval($_GPC['status']) == 2) { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">未使用</a>
						</div>
					</div>
				</div>
<!-- 				<div class="form-group">
					<label class="col-sm-2 control-label">类型</label>
					<div class="col-sm-9">
						<div class="btn-group">
							<a href="" class="btn btn-primary">不限</a>
						</div>
				</div> -->
				<div class="form-group">
					<label class="col-sm-2 control-label">关键字</label>
					<div class="col-md-3">
						<select name="keywordtype" class="form-control">
							<option value="">关键字类型</option>
							<option value="1" >优惠券标题</option>
							<option value="2" >用户名称</option>
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
						<!-- <button class="btn btn-default min-width" name="export" type="submit" value="export"><i class="fa fa-download"></i>  导出记录</button> -->
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
				<table class="table table-bordered  table-hover">
					<thead style="background-color: #FFFFFF;">
					<tr>
						<th style="width:50px;" class="text-center"><input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" /></th>
						<th style="width:50px">序号</th>
						<th style="width:190px;text-align:center;">优惠券标题</th>
						<th style="width:120px; text-align:center;">所属机构</th>
						<th style="width:80px; text-align:center;">类型</th>
						<th style="width:170px; text-align: center;">用户信息</th>
						<th style="width:80px; text-align:center;">优惠券价格</th>
						<th style="width:200px; text-align:center;">适用服务</th>
						<th style="width:160px; text-align:center;">优惠券有效期</th>
						<th style="width:100px; text-align:center;">领取时间</th>
						<th style="width:70px; text-align:center;">使用状态</th>
						<th style="width:70px; text-align: center;">操作</th>
					</tr>
					</thead>
					<tbody >
						<?php  if(is_array($list)) { foreach($list as $item) { ?>
						<tr>
							<td>
								<center><input type="checkbox" name="checkbox[]" value="<?php  echo $item['id'];?>"  class="item" /></center>
							</td>
							<td><?php  echo $item['id'];?></td>
							<td><?php  echo $item['title'];?></td>
							<td><?php  echo $item['hospital'];?></td>
							<td>
									<!--优惠券类型 0 代金券 1 折扣券 2套餐券 3团购券 -->
									<?php  if($item['type']=='0') { ?>代金券<?php  } ?>
							</td>		
							<td> 
								<img class="scrollLoading" src="<?php  echo tomedia($item['u_thumb']) ?>" height="50" width="50" />
								<span data-toggle="tooltip" data-placement="top" title="<?php  echo $item['z_name'];?>" class="text-lue" style="display: inline-block;max-width: 200px;"><?php  echo $item['u_name'];?></span>
							</td>					
							<td><?php  echo $item['deductible_amount'];?></td>
							<td><?php  echo $item['shiyongfuwu'];?></td>
							<td><?php  echo $item['start_time'];?>~<?php  echo $item['end_time'];?></td>
							<td><?php  echo $item['createtime'];?></td>
							<td>
								<?php  if($item['status']=='0') { ?>待使用
								<?php  } else if($item['status']=='1') { ?>已使用
								<?php  } else if($item['end_time']<date("Y-m-d",time())) { ?>已过期<?php  } ?>
							</td>
							<td>
	                    		<a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('apply', array('ac'=>'delcouponrecord','op'=>'delcouponrecord','id'=>$item['id']))?>" data-id="11">删除</a> 
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
			$.post("<?php  echo $this->createWebUrl('apply',array('ac'=>'pldelcouponrecord','op'=>'pldelcouponrecord'))?>", { ids : ids }, function(data){
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

