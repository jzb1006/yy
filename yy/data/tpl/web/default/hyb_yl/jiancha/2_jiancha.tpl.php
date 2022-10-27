<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
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

<?php  if(is_agent != '1') { ?>
			<ul class="nav nav-tabs">
				<li <?php  if($state == '1') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'display','state'=>'1','keywordtype'=>$keywordtype,'keyword'=>$keyword,'groupid'=>$groupid))?>">已入驻<?php  if($ruzhu > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $ruzhu;?></span><?php  } ?>
					</a>
				</li>
				<li <?php  if($state == '0') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'display','state'=>'0','keywordtype'=>$keywordtype,'keyword'=>$keyword,'groupid'=>$groupid))?>">待入驻<?php  if($shenhe > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $shenhe;?></span><?php  } ?></a>
				</li>
				<li <?php  if($state == '2') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'display','state'=>'2','keywordtype'=>$keywordtype,'keyword'=>$keyword,'groupid'=>$groupid))?>">暂停中<?php  if($zanting > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $zanting;?></span><?php  } ?></a>
				</li>
				<li <?php  if($state == '3') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'display','state'=>'3','keywordtype'=>$keywordtype,'keyword'=>$keyword,'groupid'=>$groupid))?>">已到期<?php  if($daoqi > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $daoqi;?></span><?php  } ?></a>
				</li>
				<!-- <li <?php  if($state == '4') { ?> class="active" <?php  } ?>>
					<a href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'display','state'=>'4','keywordtype'=>$keywordtype,'keyword'=>$keyword,'groupid'=>$groupid))?>">垃圾箱<?php  if($laji > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $laji;?></span><?php  } ?></a>
				</li> -->

			</ul>
			<?php  } ?>
			<div class="app-content">
              
				<div class="app-filter">
                  <div class="alert alert-warning">
                  <input type="hidden" name="h_id" value="<?php  echo $_SESSION['hid'];?>">
			机构登录地址：<a href='<?php  echo $_W['siteroot'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&act=index&do=login&m=hyb_yl' target="_blank"><?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&act=index&do=login&m=hyb_yl</a>
		</div>
		
					<?php  if(is_agent != '1') { ?>
					<div class="filter-list">
						<form action="" method="get" class="form-horizontal" role="form" id="form1">
							<input type="hidden" name="c" value="site" />
							<input type="hidden" name="a" value="entry" />
							<input type="hidden" name="m" value="hyb_yl" />
							<input type="hidden" name="op" value="display" />
							<input type="hidden" name="ac" value="display" />
							<input type="hidden" name="do" value="jiancha" />
							<div class="form-group form-inline">
								<label class="col-sm-2 control-label">搜索内容</label>
								<div class="col-sm-9">
									<select name="keywordtype" class="form-control">
										<option value="" <?php  if($keywordtype == '') { ?> selected="" <?php  } ?>>搜索内容</option>
										<option value="1" <?php  if($keywordtype == '1') { ?> selected="" <?php  } ?>>机构ID</option>
										<option value="2" <?php  if($keywordtype == '2') { ?> selected="" <?php  } ?>>机构名称</option>
										<option value="3" <?php  if($keywordtype == '3') { ?> selected="" <?php  } ?>>联系人名称</option>
										<option value="4" <?php  if($keywordtype == '4') { ?> selected="" <?php  } ?>>联系人电话</option>

									</select>
									<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">机构分组</label>
								<div class="col-sm-4">
									<select name="groupid" style="width: 100%;">
										<option value="">全部分组</option>
										<option value="1" <?php  if('1'==$groupid) { ?>  selected <?php  } ?>>医院</option>
										<option value="2" <?php  if('2'==$groupid) { ?>  selected <?php  } ?>>药房</option>
										<option value="3" <?php  if('3'==$groupid) { ?>  selected <?php  } ?>>体检机构</option>
										<option value="4" <?php  if('4'==$groupid) { ?>  selected <?php  } ?>>诊所</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-md-9">
									<button class="btn btn-primary" id="search">搜索</button>
									<button class="btn btn-primary" id="search"><a href="<?php  echo $this->createWeburl('jiancha',array('op'=>'erweima'))?>">生成二维码</a></button>
									<button class="btn btn-primary" id="search"><a href="<?php  echo $this->createWeburl('jiancha',array('op'=>'del_erweima'))?>">删除二维码</a></button>
								</div>
							</div>
						</form>
					</div>
					<?php  } ?>
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
									<th style="width: 50px;">机构</th>
									<th></th>
									<th>账户余额</th>
									<th>负责人</th>
									<th>所属分组</th>
									<th>时间</th>
									<th>现在状态</th>
									<th>是否推荐</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
							  <?php  if(is_array($res)) { foreach($res as $item) { ?>
								<tr>
									<td>
										<center>
											<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['hid'];?>" />
										</center>
									</td>
									<td><?php  echo $item['hid'];?></td>
									<td class="text-left">
										<img class="scrollLoading" src="<?php  echo $item['logo'];?>" data-url="<?php  echo $item['logo'];?>" height="50" width="50" />
									</td>
									<td>
										<span data-toggle="tooltip" data-placement="top" title="<?php  echo $item['agentname'];?>" class="text-lue" style="display: inline-block;max-width: 200px;"><?php  echo $item['agentname'];?></span>
									</td>
									<td class="text-left">
										<label class="label label-warning"><?php  echo $item['money'];?></label>
									</td>
									<td>
										<?php  echo $item['u_name'];?><br>
									</td>
									<td class="text-left">
										<label class="label label-success"><?php  echo $item['name'];?></label>
										
									</td>
									<td>
										入驻：<?php  echo $item['zctime'];?>
										<br>
										到期：<?php  echo $item['endtime'];?> </td>
									<td>
									
									<?php  if($item['state'] == '1') { ?>
										<label class="label label-success">入驻中</label>
									<?php  } else if($item['state'] == '0') { ?>
										<label class="label label-success">待审核</label>
									<?php  } else if($item['state'] == '2') { ?>
										<label class="label label-success">暂停中</label>
									<?php  } else if($item['state'] == '3') { ?>
										<label class="label label-success">已到期</label>
									<?php  } else if($item['state'] == '4') { ?>
										<label class="label label-success">垃圾箱</label>
									<?php  } else if($item['state'] == '5') { ?>
										<label class="label label-success">已拒绝</label>
									<?php  } ?>
									</td>
									<td>
									
									<?php  if($item['is_index'] == '1') { ?>
										<label class="label label-success">推荐中</label>
										<a class="btn btn-default btn-sm" href="/index.php?c=site&a=entry&do=jiancha&op=change_index&ac=change_index&m=hyb_yl&hid=<?php  echo $item['hid'];?>&is_index=0&h_id=<?php  echo $_SESSION['hid'];?>" title="取消推荐">取消推荐</a>
									<?php  } else if($item['is_index'] == '0') { ?>
										<label class="label label-success">不推荐</label>
										<a class="btn btn-default btn-sm" href="/index.php?c=site&a=entry&do=jiancha&op=change_index&ac=change_index&m=hyb_yl&hid=<?php  echo $item['hid'];?>&is_index=1&h_id=<?php  echo $_SESSION['hid'];?>" title="推荐">推荐</a>
									<?php  } ?>
									</td>
									<td style="position: relative;">
									<a class="btn btn-default btn-sm" href="/index.php?c=site&a=entry&do=jiancha&op=order_list&ac=jgindex&m=hyb_yl&hid=<?php  echo $item['hid'];?>&h_id=<?php  echo $_SESSION['hid'];?>" title="查看">机构订单</a>
									<a class="btn btn-default btn-sm" href="/index.php?c=site&a=entry&do=jiancha&op=zhuanjia&ac=jgindex&m=hyb_yl&hid=<?php  echo $item['hid'];?>&h_id=<?php  echo $_SESSION['hid'];?>" title="查看">机构专家</a>
									<a class="btn btn-default btn-sm" href="/index.php?c=site&a=entry&do=jiancha&op=shouyi&ac=jgindex&m=hyb_yl&hid=<?php  echo $item['hid'];?>&h_id=<?php  echo $_SESSION['hid'];?>" title="查看">机构收益</a>
									<a class="btn btn-default btn-sm" href="/index.php?c=site&a=entry&do=jiancha&op=tixian&ac=jgindex&m=hyb_yl&hid=<?php  echo $item['hid'];?>&h_id=<?php  echo $_SESSION['hid'];?>" title="查看">提现记录</a>
									<a class="btn btn-info btn-sm bigImg" href="javascript:;" data-src="<?php  echo $item['erweima'];?>">二维码</a>
									<?php  if($item['state'] == 0) { ?>
									<a class="btn btn-default btn-sm" href="/index.php?c=site&a=entry&do=jiancha&op=change_status&ac=change_status&m=hyb_yl&hid=<?php  echo $item['hid'];?>&state=1&h_id=<?php  echo $_SESSION['hid'];?>" title="审核通过">审核通过</a>
									<a class="btn btn-default btn-sm" href="/index.php?c=site&a=entry&do=jiancha&op=change_status&ac=change_status&m=hyb_yl&hid=<?php  echo $item['hid'];?>&state=5&h_id=<?php  echo $_SESSION['hid'];?>" title="审核拒绝">审核拒绝</a>
									<?php  } ?>
									<a class="btn btn-default btn-sm" href="/index.php?c=site&a=entry&do=jiancha&op=edit&ac=edit&m=hyb_yl&hid=<?php  echo $item['hid'];?>&h_id=<?php  echo $_SESSION['hid'];?>" title="编辑">编辑</a>
		
                                      <a class="btn btn-success btn-sm" href="/index.php?c=site&a=entry&do=jiancha&op=jigoutime&ac=jigoutime&m=hyb_yl&hid=<?php  echo $item['hid'];?>&h_id=<?php  echo $_SESSION['hid'];?>"  title="管理">体检时间管理</a>

										<a class="btn btn-danger btn-sm" href="../web/index.php?c=site&a=entry&m=hyb_yl&op=delete&ac=jgindex&do=jiancha&hid=<?php  echo $item['hid'];?>&h_id=<?php  echo $_SESSION['hid'];?>" data-toggle="ajaxRemove" data-confirm="删除机构会导致机构下专家和药品无法使用，确定要删除吗？" title="删除">删除</a>
									</td>
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
			                    <a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">批量删除</a>
			                </div>
			            </div>
			            <div class="pull-right"><?php  echo $pager;?></div>
			        </div>
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
				var h_id = $("#h_id").val();
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
						var url="../web/index.php?c=site&a=entry&m=hyb_yl&op=deleteall&ac=jgindex&do=jiancha&ids="+ids+"&h_id="+h_id;
								console.log(ids);
						util.nailConfirm(this, function(state) {
						if(!state) return;
							if(enabled == 4){
								var type = 2;
							}else{
								var type = 1;
							}

							$.post("../web/index.php?c=site&a=entry&m=hyb_yl&op=deleteall&ac=jgindex&do=jiancha&h_id="+h_id+"&", { ids : ids ,type:type}, function(data){
							
								if(data.errno=='1'){ 
				                    util.tips("操作成功！");
				                    setTimeout(function(){ 
				                        window.location.reload();
				                    }, 1000);
				                }else{
				                    util.tips("操作失败");  
				                };
							}, 'json');
						}, {html: '确认删除所选机构?'});
					});
					//商户申请结算
				    $(".shopSettlement").on('click',function () {
				        var sid = $(this).attr("sid");//获取店铺id
				        var balance = $(this).attr("balance");//总余额
				        tip.prompt('请输入提现金额,不能超过'+balance+'元！',function () {
				            var money = $("[name='confirm']").val();//提现金额
				            if(money > 0 && parseInt(balance) >= parseInt(money)){
				                $.post("https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=store&ac=merchant&do=cash&",{money:money,sid:sid},function (res) {
				                    if(res.errno == 1){
				                        tip.alert(res.message,function () {
				                            history.go(0);
				                        });
				                    }else{
				                        tip.alert(res.message);
				                    }
				                },'json');
				            }else{
				                tip.alert("请输入正确的提现金额");
				            }
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
</body>
</html>