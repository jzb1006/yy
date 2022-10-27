<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:;">兑换码列表</a></li>
	<li ><a href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponchangecode','op'=>'addcouponchangecode'))?>">添加兑换码</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="op" value="couponchangecode" />
				<input type="hidden" name="ac" value="couponchangecode" />
				<input type="hidden" name="do" value="apply"/>
				<input type="hidden" name="status" value="<?php  echo $_GPC['status'];?>"/>
				<div class="form-group">
					<label class="col-sm-2 control-label">状态</label>
					<div class="col-sm-9">
						<div class="btn-group">
							<a  href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponchangecode','op'=>'couponchangecode','status'=>'0'))?>" class="btn <?php  if(intval($_GPC['status']) == 0 || empty($_GPC['status'])) { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">全部</a>
							<a href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponchangecode','op'=>'couponchangecode','status'=>'1'))?>"  class="btn <?php  if(intval($_GPC['status']) == 1) { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已使用</a>
							<a href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponchangecode','op'=>'couponchangecode','status'=>'2'))?>"  class="btn <?php  if(intval($_GPC['status']) == 2) { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">未使用</a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">关键字</label>
					<div class="col-md-3">
						<select name="keywordtype" class="form-control">
							<option value="">关键字类型</option>
							<option value="1" <?php  if($_GPC['keywordtype']==1) { ?>selected="selected"<?php  } ?>>激活码</option>
							<option value="2" <?php  if($_GPC['keywordtype']==2) { ?>selected="selected"<?php  } ?>>所属优惠券</option>
						</select>
                    </div>
                    <div class="col-md-5">
						<input type="text" name="keyword" class="form-control" value="<?php  echo $_GPC['keyword'];?>"  placeholder="请输入关键字"/>
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
        	$('#outflag').val(0);
            $('#form1')[0].submit();
        });
        $('#output').click(function(){
        	$('#outflag').val(1);
            $('#form1')[0].submit();
        });
	</script>
	<div class="app-table-list">
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th  class="text-center"  style="width:40px; height: auto;">
						<input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});"  style="margin-top: 0;"/>  ID
					</th>
					<th class="text-center" style="width:90px;">所属优惠券</th>
					<th class="text-center" style="width:90px;">兑换码</th>
					<th class="text-center" style="width:50px;">状态</th>
					<!-- <th class="text-center" style="width:100px;">使用详情</th> -->
					<th class="text-center" style="width:120px;">生成时间</th>
					<th class="text-center" style="width:80px;">操作</th>
				</tr>
				</thead>
				<tbody>
					<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<tr class="text-center" >
						<td class="text-center" style="width:40px; height: auto;">
							<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['id'];?>" style="position: absolute;margin-top: 0;" />  <?php  echo $item['id'];?>
						</td>
						<td><?php  echo $item['coupon_name'];?></td>
						<td><?php  echo $item['code'];?></td>
						<td>
							<?php  if($item['status']==2) { ?>
							<span id="" class="label label-default">
							已使用
							</span>
							<?php  } else { ?>
							<span id="" class="label label-success">
							未使用
							</span>
							<?php  } ?>
						</td>
						<!-- <td>
							啊实打实大
						</td> -->
						<td><?php  echo $item['createtime'];?></td>
						<td>
							<a href="<?php  echo $this->createWebUrl('apply', array('ac'=>'couponchangecode','op'=>'delcouponchangecode','id'=>$item['id']))?>" title="删除"  class="btn btn-danger btn-sm">删除</a>
						</td>
					</tr>
					<?php  } } ?>
				</tbody>
			</table>
		</div>
		<div class="app-table-foot clearfix">
			<div id="de1" class="pull-left">
				<label class="btn btn-default min-width " style="display: inline-flex;align-items:center;margin-right:1rem;">
					<input type="checkbox" name="checkbox" value="" id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});">
					<div style="margin-left: 10px">全选</div>
				</label>
				<a href="javascript:;" class="btn btn-default min-width js-batch js-delete">删除选中记录</a>
			</div>
			<div class="pull-right">
				<?php  echo $pagers;?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
        $('#de1').delegate('.js-delete','click',function(e){
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

            util.nailConfirm(this, function(state) {
                if(!state) return;
                $.post("<?php  echo $this->createWebUrl('apply',array('ac'=>'couponchangecode','op'=>'couponchangecode_pass_pldelete'))?>", { ids : ids }, function(data){
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
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>