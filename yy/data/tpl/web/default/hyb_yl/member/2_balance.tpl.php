<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
    <li><a href="javascript:;">余额明细</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="op" value="balance" />
				<input type="hidden" name="ac" value="balance" />
				<input type="hidden" name="do" value="member" />
				<div class="form-group">
					<label class="col-sm-2 control-label">时间筛选</label>
					<div class="col-md-3">
						<select name="timetype" class="form-control">
							<option value="">--时间筛选--</option>
							<option value="1" <?php  if($timetype=='1') { ?> selected  <?php  } ?>>操作时间</option>
						</select>
                    </div>
					<div class="col-md-6">
					<?php  echo tpl_form_field_daterange('time_limit', array('starttime' =>$starttime,'endtime' => $endtime));?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">关键字搜索</label>
					<div class="col-md-9">
						<input type="text" name="keyword" class="form-control" value=""  placeholder="请输入用户昵称/用户手机号搜索"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-9">
						<button class="btn btn-primary" id="search">筛选</button>
					</div>
				</div>
			</form>	
		</div>
	</div>
	<div class="app-table-list">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="navbar-inner">
                    <tr>
                    	<th style="width:5%;">
                    		<input type="checkbox" name="checkbox"  id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
                    	</th>
                        <th style="width:25%;">用户信息</th>
                        <th style="width:10%;">余额变化</th>
                        <th style="width:10%;">当前余额</th>
                        <th style="width:30%;">备注</th>
                        <th style="width:25%;">时间</th>
                    </tr>
                </thead>
                <tbody>
                	<?php  if(is_array($list)) { foreach($list as $item) { ?>
                		<tr>
                			<td>
                				<input type="checkbox" name="checkbox[]" value="<?php  echo $item['id'];?>"  class="item" />
                			</td>
                			<td>
                				<img class="img-40" src="<?php  echo $item['u_thumb'];?>" style='border-radius:50%;border:1px solid #efefef;' onerror="this.src='<?php  echo $item['u_thumb'];?>'" height="40" width="40" />
                				<?php  echo $item['u_name'];?>
                			</td>
                			<td><?php  echo $item['num'];?></td>
                			<td><?php  echo $item['presentcredit'];?></td>
                			<td><?php  echo $item['remark'];?></td>
                			<td><?php  echo date("Y-m-d H:i:s",$item['createtime'])?></td>
                		</tr>
                	<?php  } } ?>
                </tbody>
            </table>
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
    </div>
</div>	

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>
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
			$.post("./index.php?c=site&a=entry&do=member&op=balancedelete&ac=integral&m=hyb_yl", { ids : ids }, function(data){
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