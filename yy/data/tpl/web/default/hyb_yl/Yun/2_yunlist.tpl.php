<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs" id="myTab">
		<li class="active">
			<a href="javascript:;">应用信息</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-filter">

			<div class="filter-list">
				<form class="form-horizontal form-filter" id="form1" action="./index.php?">
					<div class="form-group">
						<label class="col-sm-2 control-label">类型</label>
						<div class="col-sm-9">
							<!-- 							<div class="btn-group">
								<a class="btn btn-primary" href="./index.php?c=site&amp;a=entry&amp;m=hyb_yl&amp;p=cloud&amp;ac=plugin&amp;do=index&amp;type=&amp;page=1">不限</a>
								<a class="btn btn-default" href="./index.php?c=site&amp;a=entry&amp;m=hyb_yl&amp;p=cloud&amp;ac=plugin&amp;do=index&amp;type=market&amp;page=1">营销应用</a>
								<a class="btn btn-default" href="./index.php?c=site&amp;a=entry&amp;m=hyb_yl&amp;p=cloud&amp;ac=plugin&amp;do=index&amp;type=interact&amp;page=1">互动应用</a>
								<a class="btn btn-default" href="./index.php?c=site&amp;a=entry&amp;m=hyb_yl&amp;p=cloud&amp;ac=plugin&amp;do=index&amp;type=expand&amp;page=1">拓展应用</a>
								<a class="btn btn-default" href="./index.php?c=site&amp;a=entry&amp;m=hyb_yl&amp;p=cloud&amp;ac=plugin&amp;do=index&amp;type=help&amp;page=1">辅助应用</a>
							</div> -->
						</div>
					</div>
					<div class="form-group form-inline">
						<label class="col-sm-2 control-label">关键字</label>
						<div class="col-sm-9">
							<input name="keyword" class="form-control" type="text" placeholder="插件名称/插件标识" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-9">

							 <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
		                     <input type="submit" class="btn btn-primary col-lg-1" name="submit" value="筛选" >

						</div>
					</div>
				</form>

			</div>
		</div>
		<div class="app-table-list">

			<form class="form-table form form-validate" action="" method="post" novalidate="novalidate">
				<div class="table-responsive js-table">
					<table class="table table-hover">
						<thead>
							<tr>

								<th>标识</th>
								<th>插件名称</th>
								<th>路径</th>

							</tr>
						</thead>
						<tbody>


                             <?php  if(is_array($res)) { foreach($res as $item) { ?>
							<tr>

								<td>
									<input name="server_key[]" value="<?php  echo $item['server_key'];?>" class="form-control with200" type="text" value="dianhuajizhen" disabled>
									<input name="server_key[]" value="<?php  echo $item['server_key'];?>" class="form-control with200" type="hidden" value="dianhuajizhen">
								</td>
								<td> 
									<input name="titles[]"  disabled class="form-control with200" type="text" value="<?php  echo $item['titles'];?>">
								</td>
								<td>
									<input name="ser_url[]" class="form-control" disabled  value="<?php  echo $item['ser_url'];?>" >
								</td>

							</tr>
                            <?php  } } ?>



						</tbody>
					</table>
					<div class="app-table-foot clearfix">
						<div class="pull-left">
							
							<a href="<?php  echo $this->createWebUrl('cloud',array('op'=>'json_mun'))?>" class="btn btn-primary">提取数据</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script language="javascript">
		$(function(){
		require(['jquery', 'util'], function ($, util) {
		$('.js-selectImg').unbind('click').click(function () {
		var imgitem = $(this).closest('.img-item');
		util.image('', function (data) {
		imgitem.find('img').attr('src', data['url']);
		imgitem.find('input').val(data['attachment']);
		});
		});
		});
		});
	</script>
</div>