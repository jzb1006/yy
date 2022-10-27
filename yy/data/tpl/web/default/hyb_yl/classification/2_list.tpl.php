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
</style>
<ul class="nav nav-tabs">
	<li <?php  if($status == '') { ?> class="active" <?php  } ?>>
		<a href="<?php  echo $this->createWeburl('classification',array('op'=>'list','status'=>'','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end));?>">所有文章
		<?php  if($all > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $all;?></span><?php  } ?>
		</a>
	</li>
	<li <?php  if($status == '1') { ?> class="active" <?php  } ?>>
		<a href="<?php  echo $this->createWeburl('classification',array('op'=>'list','status'=>'1','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end));?>">待审核
		<?php  if($shenhe > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $shenhe;?></span><?php  } ?>
		</a>
	</li>
	<li <?php  if($status == '2') { ?> class="active" <?php  } ?>>
		<a href="<?php  echo $this->createWeburl('classification',array('op'=>'list','status'=>'2','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end));?>">显示中
		<?php  if($show > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $show;?></span><?php  } ?>
		</a>
	</li>
	<li <?php  if($status == '3') { ?> class="active" <?php  } ?>>
		<a href="<?php  echo $this->createWeburl('classification',array('op'=>'list','status'=>'3','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end));?>">置顶中
		<?php  if($zhiding > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $zhiding;?></span><?php  } ?>
		</a>
	</li>
	<li <?php  if($status == '4') { ?> class="active" <?php  } ?>>
		<a href="<?php  echo $this->createWeburl('classification',array('op'=>'list','status'=>'4','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end));?>">未通过
		<?php  if($jujue > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $jujue;?></span><?php  } ?>
		</a>
	</li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a href="<?php  echo $this->createWeburl('classification',array('op'=>'add','status'=>'4','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end));?>" class="btn btn-primary">发布文章</a>
		</div>
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="op" value="list" />
				<input type="hidden" name="ac" value="list" />
				<input type="hidden" name="do" value="classification" />
				<div class="form-group">
					<label class="col-sm-2 control-label">关键字</label>
					<div class="col-md-3">
						<select name="keywordtype" class="form-control">
							<option value="" <?php  if($keywordtype == '') { ?> selected="" <?php  } ?>>关键字类型</option>
							<option value="1" <?php  if($keywordtype == '1') { ?> selected="" <?php  } ?>>文章内容</option>
							<option value="2" <?php  if($keywordtype == '2') { ?> selected="" <?php  } ?>>文章分类</option>
							<option value="3" <?php  if($keywordtype == '3') { ?> selected="" <?php  } ?>>用户昵称</option>
							<option value="4" <?php  if($keywordtype == '4') { ?> selected="" <?php  } ?>>用户电话</option>
						</select>
					</div>
					<div class="col-md-4">
						<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">时间筛选</label>
					<div class="col-md-3">
						<select name="timetype" class="form-control">
							<option value="">时间类型</option>
							<option value="1">发布时间</option>
						</select>
					</div>
					<div class="col-md-2">

						<script type="text/javascript">
							require(["daterangepicker"], function(){
								$(function(){
									$(".daterange.daterange-date").each(function(){
										var elm = this;
										$(this).daterangepicker({
											startDate: $(elm).prev().prev().val(),
											endDate: $(elm).prev().val(),
											format: "YYYY-MM-DD"
										}, function(start, end){
											$(elm).find(".date-title").html(start.toDateStr() + " 至 " + end.toDateStr());
											$(elm).prev().prev().val(start.toDateStr());
											$(elm).prev().val(end.toDateStr());
										});
									});
								});
							});
						</script>

						<input name="start" type="hidden" value="<?php  echo $start;?>">
						<input name="end" type="hidden" value="<?php  echo $end;?>">
						<button class="btn btn-default daterange daterange-date" type="button">
							<span class="date-title"><?php  echo $start;?> 至 <?php  echo $end;?></span>
							<i class="fa fa-calendar"></i>
						</button>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-md-9">
						<button class="btn btn-primary" id="search">筛选</button>
						<a class="btn btn-danger btn-sm" data-toggle="ajaxRemove" href="<?php  echo $this->createWebUrl('classification',array('op'=>'delerweima','ac'=>'delerweima'))?>" data-confirm="删除后需要在前端重新获取，是否删除？">清空二维码</a>
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
							<input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
						</th>
						<th width="15%" class="text-left">文章标题</th>
						<th width="10%" class="text-center">文章分类</th>
						<th width="10%" class="text-center">文章信息</th>
						<th width="10%" class="text-center">发布时间</th>
						<th width="10%" class="text-center">发布人</th>
						<th width="10%" class="text-center">文章状态</th>
						<th width="10%" class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($row)) { foreach($row as $item) { ?>
					<tr>
						<td style="width: 50px;">
							<center>
								<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['id'];?>" />
							</center>
						</td>
						<td class="goods-info line-feed" style="width:170px;">
							<div class="title">
								<span><?php  echo $item['title'];?></span>
							</div>
						</td>
						<td class="text-center" style="width:100px;">

							<div class="title">
								<span class="label label-success"><?php  echo $item['zx_name'];?></span>
							</div>
						</td>
						<td class="text-center" style="width:90px;">
							<p>分享：<?php  echo $item['fxcs'];?></p>
							<p>帮助：<?php  echo $item['dz'];?></p>
							<p>浏览：<?php  echo $item['ydcs'];?></p>
						</td>
						<td class="text-center" style="width:100px;">
							<span><?php  echo $item['time'];?></span>
						</td>
						<td class="goods-info line-feed" style="width:180px;padding-left: 10px;">
							<div style="position: relative;top: 38px;left: 5px;" class="img">
								<img style="height: 100%;width: 100%;" class="scrollLoading" src="<?php  echo $item['u_thumb'];?>" data-url="">
							</div>
							<div class="title" style="padding-left: 60px;position: relative;top: -15px;">
								<span></span>
								<span></span>
								<span><?php  echo $item['u_name'];?></span>
							</div>
						</td>
						<td class="text-center" style="width:80px;">
							<?php  if($item['display']=='1') { ?>
							<span class="label label-success">显示中</span>
							<?php  } else { ?>
							<span class="label label-error">不显示</span>
							<?php  } ?>
							<br>
							<br>
							<?php  if($item['zdtype']=='1') { ?>
							<span class="label label-danger">置顶</span>
							<?php  } else { ?>
							<span class="label label-error">不置顶</span>
							<?php  } ?>
						</td>
						<td class="text-center" style="text-align: center;">
							<a class="btn btn-default btn-sm" href="/index.php?c=site&a=entry&do=classification&op=add&ac=addart&m=hyb_yl&id=<?php  echo $item['id'];?>" title="编辑">编辑</a>
							<?php  if($item['status']=='0') { ?>
							<a class="btn btn-success btn-sm" href="/
							index.php?c=site&a=entry&do=classification&op=tuijian&ac=addart&m=hyb_yl&id=<?php  echo $item['id'];?>&status=1" title="推荐">推荐</a>
                             <?php  } ?>
							<?php  if($item['status']=='1') { ?>
							<a class="btn btn-danger btn-sm" href="/
							index.php?c=site&a=entry&do=classification&op=tuijian&ac=addart&m=hyb_yl&id=<?php  echo $item['id'];?>&status=0" title="推荐">不推荐</a>
                             <?php  } ?>  
							<a class="btn btn-danger btn-sm" href="/index.php?c=site&a=entry&do=classification&op=delete&ac=addart&m=hyb_yl&id=<?php  echo $item['id'];?>" data-toggle="ajaxRemove" data-confirm="删除文章，确定要删除吗？" title="删除">删除</a>
						</td>
					</tr>
					<?php  } } ?>
				</tbody>
			</table>
			<?php  echo $pager;?>
		</div>
		<div class="app-table-foot clearfix">
			<div id="de1" class="pull-left">
				<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">通过选中文章</a>
				<a style="margin-left: 1rem;" href="javascript:;" class="btn btn-default min-width js-batch js-delete nopass">关闭选中文章</a>
				<a style="margin-left: 1rem;" href="javascript:;" class="btn btn-default min-width js-batch js-delete delete">删除选中文章</a>
			</div>
			<div class="pull-right">
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#search").click(function(){
					$('#form1')[0].submit();
				});
</script>
<script>
	//批量软删除帖子
							$('#de1').delegate('.delete','click',function(e){
								e.stopPropagation();
								var order_ids = [];
								var $checks=$('.checkbox:checkbox:checked');
								$checks.each(function() {
									if (this.checked) {
										order_ids.push(this.value);
									};
								});
								var $this = $(this);
								var ids = order_ids;
								//alert(ids);
								
								util.nailConfirm(this, function(state) {
								if(!state) return;
									$.post("https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=pocket&ac=Tiezi&do=delete&", { ids : ids,flag:1 }, function(data){
										if(!data.errno){
										util.tips("删除成功！");
										location.reload();
										}else{
										util.tips(data.message);	
										};
									}, 'json');
								}, {html: '确认删除?'});
							});
							//批量彻底删除帖子
							$('#de1').delegate('.thorough','click',function(e){
								e.stopPropagation();
								var order_ids = [];
								var $checks=$('.checkbox:checkbox:checked');
								$checks.each(function() {
									if (this.checked) {
										order_ids.push(this.value);
									};
								});
								var $this = $(this);
								var ids = order_ids;
								//alert(ids);
								
								util.nailConfirm(this, function(state) {
								if(!state) return;
									$.post("https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=pocket&ac=Tiezi&do=delete&", { ids : ids,flag:2}, function(data){
										if(!data.errno){
										util.tips("彻底删除成功！");
										location.reload();
										}else{
										util.tips(data.message);	
										};
									}, 'json');
								}, {html: '彻底删除?'});
							});
							//批量通过帖子
							$('#de1').delegate('.pass','click',function(e){
								e.stopPropagation();
								var order_ids = [];
								var $checks=$('.checkbox:checkbox:checked');
								$checks.each(function() {
									if (this.checked) {
										order_ids.push(this.value);
									};
								});
								var $this = $(this);
								var ids = order_ids;
								//alert(ids);
								
								util.nailConfirm(this, function(state) {
								if(!state) return;
									$.post("https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=pocket&ac=Tiezi&do=pass&", { ids : ids }, function(data){
										if(!data.errno){
										util.tips("通过成功！");
										location.reload();
										}else{
										util.tips(data.message);	
										};
									}, 'json');
								}, {html: '确认通过?'});
							});
							//批量禁用帖子
							$('#de1').delegate('.nopass','click',function(e){
								e.stopPropagation();
								var order_ids = [];
								var $checks=$('.checkbox:checkbox:checked');
								$checks.each(function() {
									if (this.checked) {
										order_ids.push(this.value);
									};
								});
								var $this = $(this);
								var ids = order_ids;
								//alert(ids);
								
								util.nailConfirm(this, function(state) {
								if(!state) return;
									$.post("https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=pocket&ac=Tiezi&do=nopass&", { ids : ids }, function(data){
										if(!data.errno){
										util.tips("禁用成功！");
										location.reload();
										}else{
										util.tips(data.message);	
										};
									}, 'json');
								}, {html: '确认禁用?'});
							});
							//单个帖子通过
							$('.asdp').click(function(){
								var id = $(this).attr('tieziid');
								$.post("https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=pocket&ac=Tiezi&do=pass&", { id : id }, function(data){
									if(!data.errno){
									util.tips("关闭成功！");
									location.reload();
									}else{
									util.tips(data.message);	
									};
								}, 'json');
							});
							//单个帖子禁用
							$('.asdn').click(function(){
								var id = $(this).attr('tieziid');
								$.post("https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=pocket&ac=Tiezi&do=nopass&", { id : id }, function(data){
									if(!data.errno){
									util.tips("禁用成功！");
									location.reload();
									}else{
									util.tips(data.message);	
									};
								}, 'json');
							});
							//驳回帖子
						    $('.reject').click(function(){
						        var id = $(this).attr('tieziid');
						        tip.prompt('请输入驳回理由!',function (text) {
									console.log(text);
						            $.post("https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=pocket&ac=Tiezi&do=reject&", { id : id ,text:text}, function(res){
						                console.log(res);
						                if(res.errno == 1){
						                    util.tips("驳回成功！");
						                    location.reload();
										}else{
						                    tip.alert("驳回失败，请与页面刷新后再试!",function () {
						                        location.reload();
						                    });
										}
						            }, 'json');
						        });
						    });
</script>
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