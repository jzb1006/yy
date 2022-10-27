<?php defined('IN_IA') or exit('Access Denied');?>	<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>	
<style>
	.col-sm-4{
   	width:auto   
  }
  .col-sm-2{
   	width:auto   
  }
  .zhe{
  	position: fixed;
  	top: 0;
  	width: 100%;
  	height: 100%;
  	background: rgba(0,0,0,0.6);
  	display: flex;
  	justify-content: center;
  	align-items: center;
  }
  .zhe .imgBig{
  	width: 20%;
  }
</style>
		<div class="app-container-right">
		<?php  if(is_agent != '1') { ?>
			              			<ul class="nav nav-tabs">
				<li <?php  if($state == '1') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'drugstorelist','state'=>'1'))?>">入驻中<?php  if($ruzhu > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $ruzhu;?></span><?php  } ?>
					</a>
				</li>
				<li <?php  if($state == '2') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'drugstorelist','state'=>'2'))?>">待入驻<?php  if($shenhe > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $shenhe;?></span><?php  } ?></a>
				</li>
				<li <?php  if($state == '3') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'drugstorelist','state'=>'3'))?>">暂停中<?php  if($zanting > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $zanting;?></span><?php  } ?></a>
				</li>
				<li <?php  if($state == '4') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'drugstorelist','state'=>'4'))?>">已到期<?php  if($daoqi > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $daoqi;?></span><?php  } ?></a>
				</li>
				<!-- <li <?php  if($state == '5') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWeburl('medicine',array('op'=>'drugstorelist','state'=>'5'))?>">垃圾箱<?php  if($del > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $del;?></span><?php  } ?></a>
				</li> -->
			</ul>
			<?php  } ?>
			<div class="app-content">
              
				<div class="app-filter">
                  <!-- <div class="alert alert-warning">
			药房登录地址：<a href="https://www.webstrongtech.com/web/agent.php?p=user&amp;ac=login&amp;do=agent_login&amp;" target="_blank">https://www.webstrongtech.com/web/agent.php?p=user&amp;ac=login&amp;do=agent_login&amp;</a>
		</div> -->
					<div class="filter-list">
					<?php  if(is_agent != '1') { ?>
						<form action="" method="get" class="form-horizontal" role="form" id="form1">
							<input type="hidden" name="c" value="site" />
							<input type="hidden" name="a" value="entry" />
							<input type="hidden" name="m" value="hyb_yl" />
							<!-- <input type="hidden" name="p" value="drugstorelist" /> -->
							<input type="hidden" name="op" value="drugstorelist" />
							<input type="hidden" name="do" value="medicine" />
							<input type="hidden" name="enabled" value="1" />
							<div class="form-group form-inline">
								<label class="col-sm-2 control-label">地区查询</label>
								<div class="col-sm-9">
									<select name="province" id="province" onchange="changes_pro()" class="form-control">
										<option value="" <?php  if($province == '') { ?> selected="" <?php  } ?>>所在省</option>
									<?php  if(is_array($province_arr)) { foreach($province_arr as $pro) { ?>
										<option value="<?php  echo $pro['name'];?>" <?php  if($pro['name'] == $province) { ?> selected="" <?php  } ?>><?php  echo $pro['name'];?></option>
									<?php  } } ?>
									</select>
									<select name="city" id="city" class="form-control">
										<option value="" <?php  if($province == '') { ?> selected="" <?php  } ?>>所在市</option>
									<?php  if(is_array($city_arr)) { foreach($city_arr as $citys) { ?>
										<option value="<?php  echo $citys['name'];?>" <?php  if($citys['name'] == $city) { ?> selected="" <?php  } ?>><?php  echo $citys['name'];?></option>
									<?php  } } ?>
									</select>
									<select name="district" id="district" class="form-control">
										<option value="" <?php  if($district == '') { ?> selected="" <?php  } ?>>所在区</option>
									<?php  if(is_array($district_arr)) { foreach($district_arr as $dis) { ?>
										<option value="<?php  echo $dis['name'];?>" <?php  if($dis['name'] == $district) { ?> selected="" <?php  } ?>><?php  echo $dis['name'];?></option>
									<?php  } } ?>
									</select>
								</div>
							</div>
							<script type="text/javascript">
								$("#province").on('change',function(){
									$.ajax({
										'url':"<?php  echo $this->createWeburl('medicine',array('op'=>'citys'))?>",
										data:{
											name:$("#province").val()
										},
										dataType:"json",
										type:"get",
										success:function(res){
											var city = res.city;
											var district = res.district;
											var html = "<option value=''>所在市</option>";
											var htmls = "<option value=''>所在区</option>";
											for(var i=0;i<city.length;i++)
											{
												html += "<option value='"+ city[i]['name'] +"'>"+ city[i]['name'] +"</option>";
											}
											$("#city").html(html);
											for(var j=0;j<district.length;j++)
											{
												htmls += "<option value='"+ district[j]['name'] +"'>"+ district[j]['name'] +"</option>";
											}
											$("#district").html(htmls);
										}
									})
								})
								$("#city").on('change',function(){
									$.ajax({
										'url':"<?php  echo $this->createWeburl('medicine',array('op'=>'district'))?>",
										data:{
											name:$("#city").val()
										},
										dataType:"json",
										type:"get",
										success:function(res){
											
											var html = "<option value=''>所在区</option>";
											for(var i=0;i<res.length;i++)
											{
												html += "<option value='"+ res[i]['name'] +"'>"+ res[i]['name'] +"</option>";
											}
											$("#district").html(html);
										}
									})
								})
							</script>
							<div class="form-group form-inline">
								<label class="col-sm-2 control-label">搜索内容</label>
								<div class="col-sm-9">
									<select name="keywordtype" class="form-control">
										<option value="" <?php  if($keywordtype == '') { ?> selected="" <?php  } ?>>筛选类型</option>
										<option value="1" <?php  if($keywordtype == '1') { ?> selected="" <?php  } ?>>药店ID</option>
										<option value="2" <?php  if($keywordtype == '2') { ?> selected="" <?php  } ?>>药店名称</option>
										<option value="3" <?php  if($keywordtype == '3') { ?> selected="" <?php  } ?>>联系人名称</option>
										<option value="4" <?php  if($keywordtype == '4') { ?> selected="" <?php  } ?>>联系人电话</option>

									</select>
									<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
								</div>
							</div>
							
							<!-- <div class="form-group">
								<label class="col-sm-2 control-label">药店分组</label>
								<div class="col-sm-4">
									<select name="groupid" style="width: 100%;">
										<option value="">全部分组</option>
										<?php  if(is_array($groups)) { foreach($groups as $gro) { ?>
										<option value="<?php  echo $gro['id'];?>" <?php  if($groupid == $gro['id']) { ?> selected="" <?php  } ?>><?php  echo $gro['name'];?></option>
										<?php  } } ?>
									</select>
								</div>
							</div> -->
							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-md-9">
									<button class="btn btn-primary" id="search">搜索</button>
								</div>
							</div>
						</form>
						<?php  } ?>
						<button class="btn btn-primary" id="search"><a href="<?php  echo $this->createWeburl('medicine',array('op'=>'erweima'))?>">生成二维码</a></button>
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
									<th style="width: 50px;">药房名称</th>
									<th>类别</th>
									<th>药房所在地</th>
									
									<th>负责人</th>
									<th>入驻时间</th>
									<th>产品数</th>
									<th>订单数</th>
									<th>药师数</th>
									<th>药房收益总数</th>
									<th>推广总支出</th>
									<th>开方服务费总支出</th>
									<th>药师审方总支出</th>
									<th>账户余额</th>
									<th>现在状态</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<?php  if(is_array($list)) { foreach($list as $item) { ?>
								<tr>
									<td>
										<center>
											<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['hid'];?>" />
										</center>
									</td>
									<td><?php  echo $item['hid'];?></td>
									<td class="text-left">
										<img class="scrollLoading" src="<?php  echo $item['logo'];?>" data-url="<?php  echo $item['logo'];?>" height="50" width="50" />
										<span data-toggle="tooltip" data-placement="top" title="<?php  echo $item['agentname'];?>" class="text-lue" style="display: inline-block;max-width: 200px;"><?php  echo $item['agentname'];?></span>
									</td>
									
									<td class="text-left">
										<label class="label label-success"><?php  echo $item['level_name'];?></label>
										
									</td>
									<td class="text-left">
										<label class="label label-warning"><?php  echo $item['address'];?>-<?php  echo $item['xxaddress'];?></label>
									</td>
									<td>
										<?php  echo $item['realname'];?><br>
									</td>
									<td class="text-left">
										<?php  echo $item['zctime'];?>
										
									</td>
									<td>
										<?php  echo $item['goodscount'];?>
									</td>
									<td>
										<?php  echo $item['ordercount'];?>
									</td>
									<td>
										<?php  echo $item['yaoshicount'];?>
									</td>
									<td>
										<?php  echo $item['shouyi'];?>
									</td>
									<td>
										<?php  echo $item['tkmoney'];?>
									</td>
									<td>
										<?php  echo $item['kfmoney'];?>
									</td>
									<td>
										<?php  echo $item['shmoney'];?>
									</td>
									<td>
										<?php  echo $item['money'];?>
									</td>
									<td>
										<label class="label label-success">
										<?php  if($item['state'] == '0') { ?>
										待审核
										<?php  } else if($item['state'] == '1') { ?>
										入驻中
										<?php  } else if($item['state'] == '2') { ?>
										暂停中
										<?php  } else if($item['state'] == '3') { ?>
										已到期
										<?php  } else if($item['state'] == '4') { ?>
										已删除
										<?php  } ?>
										</label>
									</td>
									<td style="position: relative;">
									<a class="btn btn-default btn-sm" href="<?php  echo $this->createWeburl('medicine',array('op'=>'editdrugstore','ac'=>'drugstorelist','h_id'=>$item['hid'],'hid'=>$_SESSION['hid']))?>" title="编辑">编辑</a>
									<a class="btn btn-default btn-sm" href="<?php  echo $this->createWeburl('medicine',array('op'=>'drug_order','ac'=>'drugstorelist','h_id'=>$item['hid'],'hid'=>$_SESSION['hid']))?>" title="订单明细">订单明细</a>
									<a class="btn btn-default btn-sm" href="<?php  echo $this->createWeburl('medicine',array('op'=>'drug_tixian','ac'=>'drugstorelist','h_id'=>$item['hid'],'hid'=>$_SESSION['hid']))?>" title="提现明细">提现明细</a>
									
									<a class="btn btn-default btn-sm" target="_blank" href="<?php  echo $_W['siteroot'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&act=index&do=login&m=hyb_yl" title="管理入口">管理入口</a>
									<a class="btn btn-info btn-sm bigImg" href="javascript:;" data-src="<?php  echo $item['erweima'];?>">二维码</a>
                                      <?php  if(is_agent != '1') { ?>
										<a class="btn btn-danger btn-sm" href="<?php  echo $this->createWeburl('medicine',array('op'=>'deldrugstore','ac'=>'drugstorelist','h_id'=>$item['hid'],'hid'=>$_SESSION['hid']))?>" data-toggle="ajaxRemove" data-confirm="删除机构会导致机构下专家和药品无法使用，确定要删除吗？" title="删除">删除</a>
										<?php  } ?>
									</td>
								</tr>
								<?php  } } ?>
							</tbody>
						</table>
						<?php  echo $pager;?>
					</div>
					<?php  if(is_agent != '1') { ?>
					<div class="app-table-foot clearfix">
						<div class="pull-left">
							<div id="de1" class="pull-left">
								<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">删除选中药房</a>
							</div>
						</div>
						<div class="pull-right">
						</div>
					</div>
					<?php  } ?>
				</div>
			</div>
			<script>
			$(document).on('click','.bigImg',function(){
				var src=$(this).attr('data-src')
				$('body').append(`
					<div class="zhe">
					<img class="imgBig" src="${src}"/>
					</div>
					`)
			})
			$(document).on('click','.zhe',function(){
				$(this).remove()
			})
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
							$.post("<?php  echo $this->createWeburl('medicine',array('op'=>'del_drugstorelists'))?>", { ids : ids ,type:type}, function(data){
								if(data.errno=='1'){ 
				                    util.tips("操作成功！");
				                    setTimeout(function(){ 
				                        window.location.reload();
				                    }, 1000);
				                }else{
				                    util.tips("操作失败");  
				                };
							}, 'json');
						}, {html: '确认删除所选商户?'});
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