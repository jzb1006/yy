<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:;">热词搜索列表</a></li>
	<li><a href="<?php  echo $this->copysiteUrl('ceshi.addhotwordsearch');?>&ac=hotwordsearch">添加热词</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-list">
			<form action="" method="get">
				<input type="hidden" name="c" value="site" />
	            <input type="hidden" name="a" value="entry" />
	            <input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="do" value="copysite" />
				<input type="hidden" name="act" value="ceshi.hotwordsearch" />
				<input type="hidden" name="ac" value="hotwordsearch" />
				<div class="form-group " style="display: block;">
					<label class="col-sm-2 control-label">关键字</label>
                    <div class="col-sm-4">
                        <input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>"  placeholder="请输入关键字"/>
                    </div>
                    <div class="col-sm-3">
						<button class="btn btn-primary">筛选</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="app-table-list">
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead class="navbar-inner">
				<tr>
					<th style="width: 50px;" class="text-center">
							<input type="checkbox" name="checkbox"  id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
						</th>
					<th style="width: 50px;">排序</th>
					<th style="width: 200px;">名称</th>
					<th style="width: 100px;">状态</th>
					<th style="width: 180px;">操作</th>
				</tr>
				</thead>
				<tbody>
					<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<tr>
						<td style="width: 50px;">
							<center>
								<input type="checkbox" name="checkbox[]" value="<?php  echo $item['id'];?>"  class="item" />
							</center>
						</td>
						<td><?php  echo $item['sort'];?></td>
						<td>
							<?php  echo $item['name'];?>
						</td>
						<td>
							<?php  if($item['status']=='0') { ?>
							<span class='label label-default'>禁用</span>
							<?php  } else { ?>
							<span class="label label-success">启用</span>
							<?php  } ?>
						</td>
						<td >
							<a class="btn btn-primary btn-sm" href="./index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addhotwordsearch&ac=hotwordsearch&id=<?php  echo $item['id'];?>" title="">编辑</a>
							<a class="btn btn-sm btn-danger" data-toggle="ajaxRemove" href="./index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.deletehotwordsearch&ac=hotwordsearch&id=<?php  echo $item['id'];?>" data-confirm="确认删除此？">删除</a>
						</td>
					</tr>
					<?php  } } ?>
				</tbody>
			</table>
		</div>
		<div class="app-table-foot clearfix">
			<div class="pull-left" id="de1">
				<label class="btn btn-default min-width " style="display: inline-flex;align-items:center;margin-right:1rem;">
				<input type="checkbox" name="checkbox" value="" id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
				<div style="margin-left: 10px">全选</div>
				</label>
				<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_delete">批量删除</a>
				<a style="margin-left: 1rem;" href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_shenhetg">批量启用</a>
				<a style="margin-left: 1rem;" href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_noshenhetg">批量禁用</a>
			</div>
			<div class="pull-right"><?php  echo $pager;?></div>
		</div>
	</div>

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
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/hyb_yl/public/admin/layui/layui.js"></script>
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
			$.post("./index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.savehotwordsearch&ac=hotwordsearch&op=delete", { ids : ids }, function(data){
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
			$.post("./index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.savehotwordsearch&ac=hotwordsearch&op=qiyong", { ids : ids }, function(data){
				if(data.errno=='1'){ 
					util.tips("操作成功！");
					setTimeout(function(){ 
						window.location.reload();
					}, 1000);
				}else{
					util.tips("操作失败"); 	
				};
			}, 'json');
		}, {html: '确认批量启用?'});
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
			$.post("./index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.savehotwordsearch&ac=hotwordsearch&op=jinyong", { ids : ids }, function(data){
				if(data.errno=='1'){ 
					util.tips("操作成功！");

					setTimeout(function(){ 
						window.location.reload();
					}, 1000);
				}else{
					util.tips("操作失败"); 	
				};
			}, 'json');
		}, {html: '确认批量禁用?'});
	});	
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>
			
	

   
