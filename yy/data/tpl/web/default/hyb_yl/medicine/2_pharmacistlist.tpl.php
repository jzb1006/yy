<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<style>
	.col-sm-4{
   	width:auto   
  }
  .col-sm-2{
   	width:auto   
  }
</style>
			<ul class="nav nav-tabs">
				<li <?php  if($status == '1') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'pharmacistlist','ac'=>'pharmacistlist','status'=>'1','hid'=>$_SESSION['hid']))?>">入驻中
					<?php  if($ruzhu > 0) { ?>
					<span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $tuzhu;?></span>
					<?php  } ?>
					</a>
				</li>
				<li <?php  if($status == '2') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'pharmacistlist','ac'=>'pharmacistlist','status'=>'2','hid'=>$_SESSION['hid']))?>">待入驻
					<?php  if($shenhe > 0) { ?>
					<span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $shenhe;?></span>
					<?php  } ?>
					</a>
					</a>
				</li>
				<li <?php  if($status == '3') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'pharmacistlist','ac'=>'pharmacistlist','status'=>'3','hid'=>$_SESSION['hid']))?>">暂停中
					<?php  if($zanting > 0) { ?>
					<span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $zanting;?></span>
					<?php  } ?>
					</a>
					</a>
				</li>
				<li <?php  if($status == '4') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'pharmacistlist','ac'=>'pharmacistlist','status'=>'4','hid'=>$_SESSION['hid']))?>">已到期
					<?php  if($daoqi > 0) { ?>
					<span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $daoqi;?></span>
					<?php  } ?>
					</a>
					</a>
				</li <?php  if($status == '5') { ?> class="active" <?php  } ?>>
				<li>
					<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'pharmacistlist','ac'=>'pharmacistlist','status'=>'5','hid'=>$_SESSION['hid']))?>">入驻拒绝
					<?php  if($jujue > 0) { ?>
					<span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $jujue;?></span>
					<?php  } ?>
					</a>
					</a>
				</li>
			</ul>
			<div class="app-content">
				<div class="app-filter">
					<div class="filter-action">
						<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'edit_yaoshi','ac'=>'pharmacistlist','hid'=>$_SESSION['hid']))?>" class="btn btn-primary">添加药师</a>
					</div>
				</div>
				<div class="app-filter">

					<div class="filter-list">
						<form action="" method="get" class="form-horizontal" role="form" id="form1" style="display:flex">
							<input type="hidden" name="c" value="site" />
							<input type="hidden" name="a" value="entry" />
							<input type="hidden" name="m" value="hyb_yl" />
							<input type="hidden" name="p" value="medicine" />
							<input type="hidden" name="ac" value="pharmacistlist" />
							<input type="hidden" name="do" value="index" />
							<input type="hidden" name="enabled" value="1" />
							<input type="hidden" name="op" value="pharmacistlist" />
							<input type="hidden" name="hid" value="<?php  echo $_SESSION['hid'];?>" />
							<div class="form-group form-inline">
								<label class="col-sm-2 control-label">搜索内容</label>
								<div class="col-sm-9" style="display:flex">
									<select name="keywordtype" class="form-control">
										<option value="1">机构名称</option>
										<option value="2">专家名称</option>
										<option value="3">联系人名称</option>
										<option value="4">联系人电话</option>
										<option value="5">业务员MID</option>
									</select>
									<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
								</div>
							</div>
                             <div class="form-group">
								<label class="col-sm-2 control-label">按工作状态</label>
								<div class="col-sm-4">
									<select name="typs" style="width: 100%;">
										<option value="">工作中</option>
										<option value="27">休息中</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-md-9">
									<button class="btn btn-primary" id="search">搜索</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="app-table-list">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th style="width: 30px;">
										<input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
									</th>
									<th>ID</th>
									<th style="width: 50px;">药师</th>
									<th></th>
									<th>药师余额</th>
									<th>所属机构</th>
									<th>时间</th>
									<th>现在状态</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
							<?php  if(is_array($list)) { foreach($list as $item) { ?>
								<tr>
									<td>
										<center>
											<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['id'];?>" />
										</center>
									</td>
									<td><?php  echo $item['id'];?></td>
									<td class="text-left">
										<img class="scrollLoading" src="<?php  echo $item['thumb'];?>" height="50" width="50" />
									</td>
									<td>
										<span data-toggle="tooltip" data-placement="top" title="<?php  echo $item['title'];?>" class="text-lue" style="display: inline-block;max-width: 200px;"><?php  echo $item['title'];?></span>
									</td>
									<td class="text-left">
										<label class="label label-warning"><?php  echo $item['money'];?></label>
									</td>
									<td>
										<?php  echo $item['agentname'];?><br>
									</td>
								
									<td>
										加入：<?php  echo $item['add_time'];?>
										 </td>
									<td>
										<label class="label label-success">
										<?php  if($item['status'] == '0') { ?>
										待审核
										<?php  } else if($item['status'] == '1') { ?>
										入驻中
										<?php  } else if($item['status'] == '2') { ?>
										审核拒绝
										<?php  } else if($item['status'] == '3') { ?>
										暂停中
										<?php  } ?>
										</label>
										<label class="label label-error">
										<?php  if($item['typs'] == '0') { ?>
										休息中
										<?php  } else if($item['typs'] == '1') { ?>
										工作中
										<?php  } ?>
										</label>
									</td>
									<td style="overflow:visible;">
										<?php  if($item['status'] == '0') { ?>
										<a class="btn btn-primary btn-sm" href="<?php  echo $this->createWeburl('medicine',array('op'=>'yschanges','id'=>$item['id'],'status'=>'1'))?>" title="通过">通过</a>
										<a class="btn btn-primary btn-sm" href="<?php  echo $this->createWeburl('medicine',array('op'=>'yschanges','id'=>$item['id'],'status'=>'0'))?>" title="拒绝">拒绝</a>
										<?php  } ?>
                                        <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWeburl('medicine',array('op'=>'edit_yaoshi','id'=>$item['id']))?>" title="">快速编辑</a>
                                        <a class="btn btn-warning btn-sm" data-toggle="ajaxModal" href="<?php  echo $this->createWeburl('medicine',array('op'=>'profit_list','ac'=>'pharmacistlist','id'=>$item['id']))?>">收益明细</a>
                                        <a class="btn btn-warning btn-sm" data-toggle="ajaxModal" href="<?php  echo $this->createWeburl('medicine',array('op'=>'cash_list','ac'=>'pharmacistlist','id'=>$item['id']))?>">提现明细</a>
                                        <a class="btn btn-warning btn-sm" data-toggle="ajaxModal" href="<?php  echo $this->createWeburl('medicine',array('op'=>'shlist','ac'=>'pharmacistlist','id'=>$item['id']))?>">开方记录</a>
                                        <a class="btn btn-danger btn-sm" data-toggle="ajaxRemove" href="<?php  echo $this->createWeburl('medicine',array('op'=>'del_yaoshi','ac'=>'pharmacistlist','id'=>$item['id']))?>" data-confirm="确定要删除该药师吗？">立即删除</a>
                                    </td>
								</tr>
								<?php  } } ?>
							</tbody>
						</table>
						<?php  echo $pager;?>
					</div>
					<div class="app-table-foot clearfix">
						<div class="pull-left">
							<div id="de1" class="pull-left">
								<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">删除选中药师</a>
							</div>
						</div>
						<div class="pull-right">
						</div>
					</div>
				</div>
			</div>
			<script>
				var enabled = "1";
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
						util.nailConfirm(this, function(state) {
						if(!state) return;
							if(enabled == 4){
								var type = 2;
							}else{
								var type = 1;
							}
							$.post("<?php  echo $this->createWeburl('medicine',array('op'=>'del_yaoshis','id'=>$item['id']))?>", { ids : ids ,type:type}, function(data){
								if(!data.errno){
								util.tips("删除成功！");
								location.reload();
								}else{
								util.tips(data.message);	
								};
							}, 'json');
						}, {html: '确认删除所选药师?'});
					});
					//商户申请结算
				    
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