<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<style type='text/css'>
	.goods-info{position:relative;padding-left:60px;}
	.goods-info .img{position:absolute;top:50%;margin-top:-25px;background: url(https://xiaochuang.webstrongtech.net/addons/hyb_yl/web/resource/images/loading.gif) center center no-repeat;width:50px;height:50px;}
	.goods-info span{white-space: nowrap;overflow: hidden;text-overflow: ellipsis;display: block;}
	.all-tips{margin-left: 65px;}
</style>
<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#">转赠记录</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="op" value="donation" />
				<input type="hidden" name="ac" value="donation" />
				<input type="hidden" name="do" value="member" />
				<div class="form-group">
					<label class="col-sm-2 control-label">关键字</label>
					<div class="col-md-3">
						<select name="keywordtype" class="form-control">
							<option value="">关键字类型</option>
							<option value="1" <?php  if($keywordtype == '1') { ?> selected="" <?php  } ?>>用户昵称</option>
							<option value="2" <?php  if($keywordtype == '2') { ?> selected="" <?php  } ?>>用户电话</option>
							<option value="3" <?php  if($keywordtype == '3') { ?> selected="" <?php  } ?>>会员类型</option>
						</select>
                    </div>
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
		<div class="panel-body table-responsive collapse in" id="order-template-item-4" style="padding: 0;">
			<table class="table table-bordered">
				<thead style="background-color: #FFFFFF;">
				<tr>
					<th style="width:25px;text-align:center;">
                		<input type="checkbox" name="checkbox"  id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
                	</th>
					<th style="width:150px;text-align: center;">转赠人信息</th>
					<th style="width:100px; text-align:center;">转赠时长</th>
                    <th style="width:100px; text-align:center;">转赠会员卡</th>
					<th style="width:100px; text-align:center;">订单金额</th>
					
					<th style="width:150px;text-align: center;">领取人信息</th>
					<th style="width:100px; text-align:center;">领取状态</th>
					<th style="width:110px; text-align: center;">时间信息</th>
				</tr>
				</thead>
				<tbody >
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td style="text-align: center;">
	    				<input type="checkbox" name="checkbox[]" value="<?php  echo $item['id'];?>"  class="item" />
	    			</td>
					<td style="text-align:center;">
						<img src="<?php  echo $item['give_thumb'];?>" class="scrollLoading" data-url="<?php  echo $item['thumb'];?>" height="50" width="50" >
						<?php  echo $item['give_name'];?>
					</td>
					<td style="text-align:center;"><?php  echo $item['shichang'];?></td>
					<td style="text-align:center;"><?php  echo $item['title'];?></td>
					<td style="text-align:center;"><?php  echo $item['price'];?>元</td>
					<td style="text-align:center;">
						<?php  if($item['receive']=='1') { ?>
						<img src="<?php  echo $item['receive_thumb'];?>" class="scrollLoading" data-url="<?php  echo $item['thumb'];?>" height="50" width="50" >
						<?php  } ?>
						<?php  echo $item['receive_name'];?>
					</td>
					<td style="text-align:center;"><?php  if($item['receive'] == '0') { ?>待领取<?php  } else if($item['status'] == '1') { ?>已领取<?php  } ?></td>
					<td style="text-align:center;"><?php  if(!empty($item['receive_time'])) { ?><?php  echo date("Y-m-d H:i:s",$item['receive_time'])?><?php  } else { ?>无<?php  } ?></td>
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
<script type="text/javascript">
    $("#search").click(function(){
        $('#form1')[0].submit();
    });
</script>
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
			$.post("./index.php?c=site&a=entry&do=member&op=donationdelete&ac=donation&m=hyb_yl", { ids : ids }, function(data){
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
