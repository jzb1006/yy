<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active">
		<a href="<?php  echo $this->copysiteUrl('ceshi.lists');?>&ac=addappAttributelist">科室列表</a>
	</li>
</ul>
<style>
	td>i{cursor:pointer; display:inline-block; width:100%; height:100%; color:#428bca;}
                            .category-caret{display:inline-block; width:20px; margin: 0 10px; text-align:center; cursor:pointer; color:#d9534f;}
                            .add.add_level0{cursor:pointer;}
                            .scrollLoading{border-radius: 50px;}
                            .areaNameStyle{display:block;width:100px;text-align:left;float:left;}
                            .lineheight30{line-height:30px}
                            .provinceAreaName{height:30px;line-height:30px;width:180px;}
                            .provinceAreaState{display: block;width: 30px;float: left;text-align: center;cursor: pointer;}
                            .cityAreaName{padding-left:50px;height:30px;line-height:30px;background:url('./resource/images/bg_repno.gif') no-repeat -245px -545px;width:150px;position: relative;margin-left:70px;}
                            .cityAreaState{position: absolute;left: -30px;width: 30px;text-align: center;cursor: pointer;}
                            .districtAreaName{padding-left:50px;height:30px;line-height:30px;background:url('./resource/images/bg_repno.gif') no-repeat -245px -545px;width:150px;margin-left: 120px;position: relative;}
                            .districtAreaState{position: absolute;left: -30px;width: 30px;text-align: center;cursor: pointer;}
                            .townAreaName{padding-left:50px;height:30px;line-height:30px;background:url('./resource/images/bg_repno.gif') no-repeat -245px -545px;margin-left: 170px;}
                            .glyphicon.glyphicon-chevron-up {color:#CCC;}
                            .glyphicon.glyphicon-chevron-down {color:#ff0000;;}
                    </style>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a href="<?php  echo $this->copysiteUrl('ceshi.addappAttribute');?>&ac=addappAttributelist" class="btn btn-primary">添加科室</a>
			<a href="javascript:;" class="btn btn-default min-width" id='caiji'>一键获取科室</a>
		</div>
		<div class="filter-list">
			<form action="" method="get">
				<input type="hidden" name="c" value="site" />
	            <input type="hidden" name="a" value="entry" />
	            <input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="do" value="copysite" />
				<input type="hidden" name="act" value="ceshi.lists" />
				<input type="hidden" name="ac" value="addappAttributelist" />
				<div class="form-group " style="display: block;">
					<label class="col-sm-2 control-label">关键字</label>
                    <div class="col-sm-4">
                        <input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>"  placeholder="可搜索科室名称"/>
                    </div>
                    <div class="col-sm-3">
						<button class="btn btn-primary">筛选</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<form>

		<div class="app-table-list">
			<div class="panel panel-default">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center" width="5%">
			                		<input type="checkbox" name="checkbox"  id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"  class="item" />
			                	</th>
								<th class="text-center" width="5%">排序</th>
								<th class="text-center" width="10%">图片</th>
								<th class="text-center" width="20%">名称</th>
								<th class="text-center" width="30%">关键词</th>
								<th class="text-center" width="10%">位置</th>
								<th class="text-center" width="10%">状态</th>
								<th class="text-center" width="15%">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($list)) { foreach($list as $item) { ?>
                        
							<tr class="text-center">
								<td style="text-align: center;">
				    				<input type="checkbox" name="checkbox[]" value="<?php  echo $item['aid'];?>"  class="item" />
				    			</td>
				    			<td><?php  echo $item['sort'];?></td>
								<td>
									<img class="" src="<?php  echo tomedia($item['detail_cover_url']);?>" data-url="<?php  echo $item['detail_cover_url'];?>" height="50" width="50">
								</td>
								
								<td>
									<span style="color: <?php  echo $item['color'];?>;"><?php  echo $item['name'];?></span>
								</td>
								<td class="text-lue"><?php  echo $item['description'];?></td>
								<td class="text-lue"><?php  echo $item['ctname'];?> </td>
						        <td><?php  if($item['enabled'] == 0) { ?><span class="label label-default">隐藏</span><?php  } ?>
						    	<?php  if($item['enabled'] == 1) { ?><span class="label label-success">显示</span><?php  } ?>
								</td>
								<td>
									<a href="<?php  echo $this->copysiteUrl('ceshi.addappAttribute');?>&id=<?php  echo $item['aid'];?>&ac=addappAttributelist&page=<?php  echo $_GPC['page'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="修改">
										<i class="fa fa-edit"></i>
									</a>
									<a href="<?php  echo $this->copysiteUrl('ceshi.delkeshi');?>&id=<?php  echo $item['aid'];?>&ac=addappAttributelist" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
										<i class="fa fa-times"></i>
									</a>
								</td>
							</tr>
							<?php  } } ?>
						</tbody>
					</table>
				</div>
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
		
	</form>
</div>
</body>

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
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/hyb_yl/public/admin/layui/layui.js"></script>
<script type="text/javascript">


	//采集
	$('#caiji').click(function(){

				var url1 =  "<?php  echo $this->copysiteUrl('ceshi.collection_department');?>&ac=addappAttributelist";
				console.log(url1);
			 	$.ajax({
			        type: "POST",
			        url:url1,
			        data:{},
			        dataType:'json',
			        beforeSend: function () {
                    	layui.use('layer', function () {
                        	layui.layer.load();
                        	$(".layui-layer-shade").css('background', '#000000')
                        	$(".layui-layer-shade").css('opacity', '0.2')
                        	$(".layui-layer-loading").css('top', '45%')
                        	$(".layui-layer-shade").click(function (event) {
                            	event.stopPropagation(); 
                        	})
                    	});
               		},
			        success: function(data) {
			        	layer.msg('操作成功！', {
						  icon: 1,
						  time: 1000 
						}, function(){
						  window.location.reload() 
						}); 
			        }
			    });
	})


	// 批量删除
	$('#de1').delegate('.pass_delete','click',function(e){
		e.stopPropagation();
		var order_ids = [];
		var $checks=$(".item:checkbox:checked");
		$checks.each(function() {
			if (this.checked) {
				order_ids.push(this.value);
			};
		});
		var $this = $(this);
		var ids = order_ids;
		util.nailConfirm(this, function(state) {console.log(state)
		if(!state)  return;
			var url = "<?php  echo $this->copysiteUrl('ceshi.bulk_deletekeshi');?>&ac=addappAttributelist"; 
			$.post(url, { ids : ids }, function(data){
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