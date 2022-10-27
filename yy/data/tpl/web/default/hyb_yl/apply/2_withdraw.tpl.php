<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs" id="myTab">
		<li class="active">
			<a href="javascript:;">分销商列表</a>
		</li>
	</ul>

	<div class="app-content">
		<div class="app-filter">
			<div class="filter-list">
				<form action="" method="post" class="form-horizontal" role="form">
					<input type="hidden" name="status" value="" />
					<input type="hidden" name="type" value="3" />
					<div class="form-group">
						<label class="col-sm-2 control-label">提现状态</label>
						<div class="col-sm-9">
							<div class="btn-group">
								<a href="#" class="btn btn-primary">不限</a>
								<a href="#" class="btn btn-default">待审核</a>
								<a href="#" class="btn btn-default">待打款</a>
								<a href="#" class="btn btn-default">已完成</a>
								<a href="#" class="btn btn-default">未通过</a>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						$(function(){
						        	$(".btn-group").find("a").click(function(e){
						        		console.log(e)
						        		$(".btn-group a").removeClass("primary");
						        		$(this).addClass("primary");
						        	});
						        })
					</script>
					<div class="form-group">
						<label class="col-sm-2 control-label">提现类型</label>
						<div class="col-sm-9">
							<div class="btn-group">
								<a href="#" class="btn btn-primary">推客提现</a>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">申请时间段</label>
						<div class="col-sm-9">
							<div class="btn-group">

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

								<input name="time[start]" type="hidden" value="2020-02-18" />
								<input name="time[end]" type="hidden" value="2020-03-18" />
								<button class="btn btn-default daterange daterange-date" type="button">
									<span class="date-title">2020-02-18 至 2020-03-18</span>
									<i class="fa fa-calendar"></i>
								</button>
							</div>
						</div>
					</div>
<!-- 					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-9">
							<div class="btn-group">
								<button class="btn btn-primary" type="submit">筛选</button>
								<a href="javascript:;" id="getExport" class="btn btn-default min-width">
									<i class="fa fa-download"></i> 导出记录
								</a>
							</div>
						</div>
					</div> -->
				</form>
			</div>
		</div>
		<div class="app-table-list">
			<div class="table-responsive order-list">
				<table class="table table-hover">
					<thead class="navbar-inner">
						<tr>
							<th  class="text-center" >提现人信息</th>
							<th  class="text-center"  >提现类型</th>
							<th  class="text-center" >提现金额</th>
							<th  class="text-center" >提现方式</th>
							<th  class="text-center" >手续费</th>
							<th  class="text-center" >到账金额</th>
							<th  class="text-center" >申请时间</th>
							<th  class="text-center" >操作时间</th>
							<th class="text-center">操作</th>
						</tr>
					</thead>
					<tbody>
					<?php  if(is_array($row)) { foreach($row as $item) { ?>
						<tr data-toggle="popover" data-trigger="hover" data-placement="left" class="js-goods-img">
							
							<td class="line-feed">
								<?php  echo $item['username'];?>
								</td>
							<td class="text-center">
								<span class="">分销提现</span>
								<br />
								<span class="">微信</span>
							</td>
							<td class="text-center" style="position: relative;">
								<?php  echo $item['txprice'];?>
							</td>
							<td class="text-center">
								微信 </td>

							<td class="text-center" style="line-height:25px;">
								<span class="label label-success"><?php  echo $pricelv['withdrawcharge'];?>%</span>
						
							</td>
							<td class="text-center" style="line-height:25px;">
								<span class="label label-success">￥<?php  echo $item['sjprice'];?></span>
						
							</td>

							<td class="text-center">
								<span class="label label-danger"><?php  echo $item['addtime'];?></span>
							</td>
							
							<td class="text-center">
							<?php  if($item['type'] =='1') { ?>
								<span class="label label-success"><?php  echo $item['tgtime'];?></span>
							<?php  } ?>
							</td>
							<td style="position:relative;text-align: center;">
								<a href="/index.php?c=site&a=entry&m=hyb_yl&p=distribution&op=tongguosh&do=apply&id=<?php  echo $item['id'];?>&openid=<?php  echo $item['openid'];?>&sjprice=<?php  echo $item['sjprice'];?>"  >通过 </a> -
								<a href="/index.php?c=site&a=entry&m=hyb_yl&p=distribution&op=jujuesh&do=apply&id=<?php  echo $item['id'];?>" >拒绝 </a> -
								<a href="javascript:;" class="canceldis" disid="<?php  echo $item['id'];?>">删除</a>
							</td>
						</tr>
                    <?php  } } ?>
					</tbody>
				</table>
			</div>
			<div class="app-table-foot clearfix">
				<div class="pull-left">

				</div>
				<div class="pull-right">
				</div>
			</div>
		</div>
	</div>

	<script>
		$('.order-list').delegate('.canceldis', 'click', function(e){
				e.stopPropagation();
				var $this = $(this);
				var id = $this.attr('disid');

				util.nailConfirm(this, function(state) {

					if(!state) return;
					$.post("/index.php?c=site&a=entry&m=hyb_yl&op=deleteongjin&ac=deleteongjin&do=apply&id="+id, { id : id }, function(data){
						console.log(data)
						if(!data.errno){
							$this.parent().parent().remove();
							util.tips("删除成功！");
						};
					}, 'json');
				}, {html: "删除提现记录，<span style='color:red;'>删除提现记录</span>，确认?"});
			});
			
			function search_members(){
				if( $.trim($('#search-kwd2').val())==''){
		        	Tip.focus('#search-kwd2','请输入关键词');
		        	return;
		     	}
				$("#module-menus2").html("正在搜索....")
				$.get("http://www.webstrongtech.com/web/index.php?c=site&a=entry&m=hyb_yl&p=distribution&ac=dissysbase&do=searchmember&", {
					keyword: $.trim($('#search-kwd2').val())
				}, function(dat){
					$('#module-menus2').html(dat);
				});
			}
			
			function select_member(o,type) {
				$("#memberid").val(o.id);
				$("#messagesaler").val(o.nickname);
				$("#imgmerchant").attr('src', o.avatar);
				$(".two").click();
			}
			
			function remove_merchant(obj){
		        $('#messageopenid').val('');
		        $('#messagesaler').val('');
		        $('#imgmerchant').attr("src",'');
		    }
			
			function de(){
				myrequire(['select2'], function() {
					$('.select2').select2();
				});
			}
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