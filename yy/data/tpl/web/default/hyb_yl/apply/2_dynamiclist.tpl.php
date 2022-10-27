<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>

<style type='text/css'>
	.trbody td {text-align: center; vertical-align:top;border-left:1px solid #ccc; border-bottom: 1px solid #ddd;}
		.order-rank img{width:16px; height:16px;}
		.js-remark,.js-admin-remark{word-break:break-all; overflow:hidden; background: #FDEEEE;color: #ED5050;padding: 5px 10px;}
		td.goods-info{position:relative; padding-left:60px;}
		.goods-info .img{position:absolute;top:50%; margin-top:-25px; background: url(https://xiaochuang.webstrongtech.net/addons/hyb_yl/web/resource/images/loading.gif) center center no-repeat; width:50px;height:50px; }
		.goods-info span {white-space: inherit;overflow: hidden;text-overflow: ellipsis;display: block;}
		.status-text{cursor:pointer;}
		.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {border-top: 1px solid rgba(221, 221, 221, 0);}
		.col-md-1{padding-right: 0px;}
		.asd{cursor: pointer;}
		.cont_text{width: 240px;display: block;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;text-align: left;}
		.name_text{overflow: hidden;text-overflow: ellipsis;width: 200px;white-space: nowrap;}
</style>
<ul class="nav nav-tabs">
	<li <?php  if($status=='0') { ?> class="active" <?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclist','status'=>'0'))?>">所有动态<span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $suoyoudongtai_num;?></span>
		</a>
	</li>
	<li <?php  if($status=='1') { ?> class="active" <?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclist','status'=>'1'))?>">待审核<span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $daishenhedongtai_num;?></span>
		</a>
	</li>
	<li <?php  if($status=='2') { ?> class="active" <?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclist','status'=>'2'))?>">显示中<span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $xianshizhongdongtai_num;?></span>
		</a>
	</li>
	
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a class="btn btn-primary" href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclistadd'))?>">发布动态</a>
		</div>
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="do" value="apply" />
				<input type="hidden" name="op" value="dynamiclist" />
				<input type="hidden" name="ac" value="dynamiclist" />
				<input type="hidden" name="status" value="<?php  echo $status;?>" />
				<div class="form-group">
					<label class="col-sm-2 control-label">关键字</label>
					<div class="col-md-3">
						<select name="keywordtype" class="form-control">
							<option value="">关键字类型</option>
							<option value="1" <?php  if($keywordtype=='1') { ?> selected  <?php  } ?>>动态内容</option>
							<option value="2" <?php  if($keywordtype=='2') { ?> selected  <?php  } ?>>动态分类</option>
							<option value="3" <?php  if($keywordtype=='3') { ?> selected  <?php  } ?>>用户昵称</option>
						</select>
					</div>
					<div class="col-md-4">
						<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">可见状态筛选</label>
					<div class="col-md-3">
						<select name="looktype" class="form-control">
							<option value="">可见状态</option>
							<option value="1" <?php  if($looktype=='1') { ?> selected  <?php  } ?>>所有用户可见</option>
							<option value="2" <?php  if($looktype=='2') { ?> selected  <?php  } ?>>专家可见</option>
						</select>
                    </div>
				</div>
              	<div class="form-group">
					<label class="col-sm-2 control-label">时间筛选</label>
					<div class="col-md-3">
						<select name="timetype" class="form-control">
							<option value="">时间类型</option>
							<option value="1" <?php  if($timetype=='1') { ?> selected  <?php  } ?>>发布时间</option>
						</select>
                    </div>
					<div class="col-md-2">
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
	<div class="app-table-list">
		<div class="panel-body table-responsive collapse in" id="order-template-item-4" style="padding: 0;">
			<table class="table table-bordered">
				<thead style="background-color: #FFFFFF;">
					<tr>
						<th width="5%" class="text-center">
							<input type="checkbox" name="checkbox"  id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
						</th>
						<th>动态内容</th>
						<th>动态分类</th>
						<th>动态信息</th>
						<th>可见状态</th>
						<th>发布人</th>
						<th>发布身份</th>
						<th >发布时间</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<tr>
						<td style="width: 50px;">
							<center>
								<input type="checkbox" name="checkbox[]" value="<?php  echo $item['a_id'];?>"  class="item" />
							</center>
						</td>
						<td >
							<div class="title cont_text" >
								<span><?php  echo $item['contents'];?></span>
							</div>
						</td>
						<td >
			
							<div class="title">
							<span class="label label-success" style="padding:10px 8px;"><?php  echo $item['categoryname'];?></span>
							</div>
						</td>
						<td class="text-center" style="width:90px;">
							<p>点赞：<?php  echo $item['dianj'];?></p>
							<p>评论：<?php  echo $item['pinglunnum'];?></p>
							<p>浏览：<?php  echo $item['virtual_accesses'];?></p>
							
						</td>
						<td>
                           <?php  if($item['doctor_visible']=='1') { ?><span class="label label-success">专家可见</span><?php  } else { ?><span class="label label-warning">所有用户可见</span><?php  } ?>
						</td>
						<td class="goods-info line-feed" style="width:180px;padding-left: 10px;">
							<div style="position: relative;top: 38px;left: 5px;" class="img">
								<img style="height: 100%;width: 100%;" class="scrollLoading" src="<?php  echo $item['u_thumb'];?>" data-url="<?php  echo $item['u_thumb'];?>">
							</div>
							<div class="title name_text" style="padding-left: 60px;position: relative;top: -15px;">
								<?php  echo $item['u_name'];?>
							</div>
							
						</td>
						<td><?php  if($item['user_identity']=='0') { ?><span class="label label-warning" >用户发布</span><?php  } ?>
								<?php  if($item['user_identity']=='1') { ?><span class="label label-info" >专家发布</span><?php  } ?>
								<?php  if($item['user_identity']=='2') { ?><span class="label label-success" >虚拟发布</span><?php  } ?></td>
						<td><?php  echo date("Y-m-d H:i:s",$item['times'])?></td>
						<td >
							<?php  if($item['type']=='0') { ?><span class="label label-warning" style="background-color: red;">待审核</span><?php  } ?>
							<?php  if($item['type']=='1' && $item['share_tj']=='0') { ?><span class="label label-info" style="background-color: orange;">不推荐</span><?php  } ?>
							<?php  if($item['type']=='1' && $item['share_tj']=='1') { ?><span class="label label-success" >推荐</span><?php  } ?>
						</td>
						<td >
							<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclistadd','a_id'=>$item['a_id']))?>" title="查看详情">查看详情</a>
                   		 	
                   		 	<a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamicpllist','a_id'=>$item['a_id']))?>" title="查看评论">查看评论</a>
 							<?php  if($item['type']=='0') { ?>
                    		<a class="btn btn-success btn-sm" href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclistsaveshenhe','a_id'=>$item['a_id']))?>" target="_blank" title="审核通过">审核通过</a>
                    		<?php  } else { ?>
                    		<?php  if($item['share_tj']=='0') { ?>
                    		<a class="btn btn-warning btn-sm" href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclistsavetuijian','a_id'=>$item['a_id']))?>" target="_blank" title="推荐">推荐</a>
                    		<?php  } ?>
                    		<?php  } ?>
                    		<a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclistsavedelete','a_id'=>$item['a_id']))?>" class="js-remove"  data-id="<?php  echo $item['a_id'];?>">删除</a> 
						</td>
					</tr>
					<?php  } } ?>
				</tbody>
			</table>
			
		</div>
		<div class="app-table-foot clearfix">
			<div id="de1" class="pull-left">
				<label class="btn btn-default min-width " style="display: inline-flex;align-items:center;margin-right:1rem;">
				<input type="checkbox" name="checkbox" value="" id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
				<div style="margin-left: 10px">全选</div>
				</label>
				<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_delete">批量删除</a>
				<a style="margin-left: 1rem;" href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_shenhetg">批量审核通过</a>
				<a style="margin-left: 1rem;" href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_noshenhetg">批量审核拒绝</a>
				<a style="margin-left: 1rem;" href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_tuijian">批量推荐</a>
				<a style="margin-left: 1rem;" href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_notuijian">批量取消推荐</a>
			</div>
			<div class="pull-right"><?php  echo $pagers;?></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#search").click(function(){
		$('#form1')[0].submit();
	});
</script>
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
			$.post("<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclistsave_pldelete'))?>", { ids : ids }, function(data){
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
	// 批量审核通过
	$('#de1').delegate('.pass_shenhetg','click',function(e){

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
			$.post("<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclistsave_plshenhetg'))?>", { ids : ids }, function(data){
				if(data.errno=='1'){ 
					util.tips("操作成功！");
					setTimeout(function(){ 
						window.location.reload();
					}, 1000);
				}else{
					util.tips("操作失败"); 	
				};
			}, 'json');
		}, {html: '确认审核通过?'});
	});	
	// 批量审核拒绝
	$('#de1').delegate('.pass_noshenhetg','click',function(e){

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
			$.post("<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclistsave_plnoshenhetg'))?>", { ids : ids }, function(data){
				if(data.errno=='1'){ 
					util.tips("操作成功！");
					setTimeout(function(){ 
						window.location.reload();
					}, 1000);
				}else{
					util.tips("操作失败"); 	
				};
			}, 'json');
		}, {html: '确认审核拒绝?'});
	});	
	// 批量推荐
	$('#de1').delegate('.pass_tuijian','click',function(e){

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
			$.post("<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclistsave_pltuijian'))?>", { ids : ids }, function(data){
				if(data.errno=='1'){ 
					util.tips("操作成功！");
					setTimeout(function(){ 
						window.location.reload();
					}, 1000);
				}else{
					util.tips("操作失败"); 	
				};
			}, 'json');
		}, {html: '确认推荐?'});
	});	
	// 批量取消推荐
	$('#de1').delegate('.pass_notuijian','click',function(e){

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
			$.post("<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclistsave_plnotuijian'))?>", { ids : ids }, function(data){
				if(data.errno=='1'){ 
					util.tips("操作成功！");
					setTimeout(function(){ 
						window.location.reload();
					}, 1000);
				}else{
					util.tips("操作失败"); 	
				};
			}, 'json');
		}, {html: '确认不推荐?'});
	});	
</script>
		
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>