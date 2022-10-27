<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
			<div class="app-content">
              
				<div class="app-filter">
                  <div class="filter-action">
			<a href="/index.php?c=site&a=entry&do=physical&op=sortadd&ac=sortadd&m=hyb_yl" class="btn btn-primary">添加分类</a>
		</div>
               
					<div class="filter-list">
						<form action="" method="get" class="form-horizontal" role="form" id="form1">
							<input type="hidden" name="c" value="site" />
							<input type="hidden" name="a" value="entry" />
							<input type="hidden" name="m" value="hyb_yl" />
							<input type="hidden" name="p" value="physical" />
							<input type="hidden" name="ac" value="sort" />
							<input type="hidden" name="do" value="sort" />
							<input type="hidden" name="enabled" value="1" />
							<div class="form-group form-inline">
								<label class="col-sm-2 control-label">搜索内容</label>
								<div class="col-sm-9">
									<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
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
									<th style="width: 50px;">分类名称</th>
									<th>icon</th>
									<th>中心推荐图</th>
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
								
									<td>
										<span data-toggle="tooltip" data-placement="top" title="<?php  echo $item['title'];?>" class="text-lue" style="display: inline-block;max-width: 200px;"><a><?php  echo $item['title'];?></a></span>
									</td>
									<td class="text-left">
										<img class="scrollLoading" src="<?php  echo tomedia($item['icon']) ?>" height="50" width="50" />
									</td>
									<td>
									<img class="scrollLoading" src="<?php  echo tomedia($item['thumb']) ?>" height="50" width="50" />
									</td>
									<td>
										<label class="label label-success"><?php  if($item['is_tuijian'] == '1') { ?>推荐中
										<?php  } else if($item['is_tuijian'] == '0') { ?>
										未推荐
										<?php  } ?>
										</label>
									</td>
									<td style="position: relative;">
									<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('physical',array('op'=>'sortadd','id'=>$item['id']))?>" title="编辑">编辑</a>
										<a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('physical',array('op'=>'sortdel','id'=>$item['id']))?>" data-toggle="ajaxRemove" data-confirm="确定要删除吗？" title="删除">删除</a>
									</td>
								</tr>
								<?php  } } ?>
							</tbody>
						</table>
					</div>
					<div class="app-table-foot clearfix">
						<div class="pull-left">
							<div id="de1" class="pull-left">
								<label class="btn btn-default min-width " style="display: inline-flex;align-items:center;margin-right:1rem;">
		                        <input type="checkbox" name="checkbox" value="" id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
		                        <div style="margin-left: 10px">全选</div>
		                    </label>
								<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">删除选中分类</a>
							</div>
						</div>
						<div class="pull-right">
						<?php  echo $pager;?>
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
							$.post("<?php  echo $this->createWebUrl('physical',array('op'=>'sortdels'))?>", { ids : ids ,type:type}, function(data){
								if(!data.errno){
								util.tips("删除成功！");
								window.location.reload();
								}else{
								util.tips(data.message);	
								};
							}, 'json');
						}, {html: '确认删除所选商户?'});
					});
					//商户申请结算
				    $(".shopSettlement").on('click',function () {
				        var sid = $(this).attr("sid");//获取店铺id
				        var balance = $(this).attr("balance");//总余额
				        tip.prompt('请输入提现金额,不能超过'+balance+'元！',function () {
				            var money = $("[name='confirm']").val();//提现金额
				            if(money > 0 && parseInt(balance) >= parseInt(money)){
				                $.post("/web/index.php?c=site&a=entry&m=weliam_merchant&p=store&ac=merchant&do=cash&",{money:money,sid:sid},function (res) {
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