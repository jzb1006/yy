<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#">申请列表</a>
		</li>
	</ul>

	<div class="app-content">
		<div class="main" style="margin-top: 0;">
			<div class="app-table-list">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th style="width:50px;text-align: center;">MID</th>
								<th style="width:115px;text-align: center;">头像/昵称</th>
								<th style="width:65px;text-align: center;">真实姓名</th>
								<th style="width:65px;text-align: center;">联系电话</th>
								<th style="width:65px;text-align: center;">申请状态</th>
								<th style="width:110px;text-align: center;">申请时间</th>
								<th style="width:120px;text-align: center;" class="text-center">操作</th>
							</tr>
						</thead>
                   <tbody>
					<?php  if(is_array($res)) { foreach($res as $item) { ?>
						<tr data-toggle="popover" data-trigger="hover" data-placement="left" class="js-goods-img">
							<td>
								<img class="scrollLoading" src="<?php  echo $item['u_thumb'];?>" onerror="this.src='<?php  echo $item['u_thumb'];?>'" height="50" width="50" />
							</td>
							<td class="line-feed">
								<?php  echo $item['u_name'];?>
								<br>
								MID:<?php  echo $item['id'];?> </td>
							<td class="text-center">
								<span class=""><?php  echo $item['username'];?></span>
								<br />
								<span class=""><?php  echo $item['tel'];?></span>
							</td>
							<td class="text-center">
								<?php  echo $item['tel'];?></td>

					
							<td class="text-center">
								<span class="label label-danger">待审核</span>
							</td>
					
							<td class="text-center">
								<span class="label label-success"><?php  echo $item['addtime'];?> </span>
							</td>
							<td style="position:relative;text-align: center;">
								<a href="/index.php?c=site&a=entry&do=apply&op=tgshenhe&ac=spreadrecord&m=hyb_yl&id=<?php  echo $item['id'];?>" >通过 </a> -
								<a href="/index.php?c=site&a=entry&m=hyb_yl&p=distribution&ac=dissysbase&do=distributordetail&todo=base&memid=<?php  echo $item['id'];?>" class="">拒绝</a> -
								<a href="javascript:;" class="canceldis" disid="175">删除</a>
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
			<div id="modal-module-gift" class="modal fade" tabindex="-1">
				<div class="modal-dialog" style='width: 920px;'>
					<div class="modal-content">
						<div class="modal-header">
							<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
							<h3>驳回理由</h3>
						</div>
						<div class="modal-body" style="padding: 0;">
							<div class="modal-body">
								<textarea id="remark" name="admin_remark" class="form-control" rows="5"></textarea>
							</div>
						</div>
						<div class="modal-footer" style="padding:15px;">
							<a class="btn btn-default js-cancel" aria-hidden="true" data-dismiss="modal">取消</a>
							<a class="btn btn-primary js-order-remark-post" order-id="" data-dismiss="modal" aria-hidden="true">确定</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('#statistics').click(function(){
				$('#statistics').text('请稍等...');
				var disid = $(this).attr('disid');
				$.post("https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=hyb_yl&p=distribution&ac=dissysbase&do=statistics&",{disid:disid},function(d){
		          	if(d.errno == 0){
		          		$('#statistics').text('￥'+d.message);
		          	}
			    },"json");		
			}); 
			
			$("#submit2").click(function(){
				$('#form2')[0].submit();
			});
			$('.js-recharge2').click(function() {
				$('#modal-message2').show();
				var topfx = $(this).attr('leadname');
				$('#topfx').text(topfx);
				var leaduid = $(this).attr('leaduid');
				$('#leaduid').val(leaduid);
				var leadmid = $(this).attr('leadmid');
				$('#leadmid').val(leadmid);
				var memid = $(this).attr('memid');
				$('#memid').val(memid);
				$('.panel').css("opacity","0.2");$('.nav').css("opacity","0.2");$('.pagination').css("opacity","0.2");
			});
			$('.close').click(function() {
				$('#modal-message').hide();
				$('#modal-message2').hide();
				$('.panel').css("opacity","1");$('.nav').css("opacity","1");$('.pagination').css("opacity","1");
			});
			
			$('.pass').click(function(e) {
				e.stopPropagation();
				var id = $(this).attr('appid');
				util.nailConfirm(this, function(state) {
					if(!state) return;
					location.href = "https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=hyb_yl&p=distribution&ac=dissysbase&do=pass&id="+id;
				}, {html: "确认审核通过?"});
			});
			
			$('.passdis').click(function(e){
				e.stopPropagation();
				var id = $(this).attr('appid');
				util.nailConfirm(this, function(state) {
					if(!state) return;
					location.href = "https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=hyb_yl&p=distribution&ac=dissysbase&do=passdis&id="+id;
				}, {html: "确认审核通过?"});
			});
			
			$('.reject').click(function(e) {
				e.stopPropagation();
				var id = $(this).attr('appid');
				util.nailConfirm(this, function(state) {
					if(!state) return;
					location.href = "https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=hyb_yl&p=distribution&ac=dissysbase&do=reject&id="+id;
				}, {html: "确认驳回申请?"});
			});
			//驳回申请理由
			$('.rejectdis').click(function(){
		  		var appid = $(this).attr('appid');
				$('.js-order-remark-post').attr("order-id",appid);
				popwin = $('#modal-module-gift').modal();
			});
			$('.js-cancel,.close').click(function() {
					$('#order-remark-container').hide();
					$('.main').css("opacity","1");$('.nav').css("opacity","1");$('.big-menu').css("opacity","1");
				});
			$('.js-order-remark-post').click(function() {
				var order_id = $(this).attr('order-id');
				var remark = $('#remark').val();
				$.post("https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=hyb_yl&p=distribution&ac=dissysbase&do=rejectreason&",{id:order_id,reason:remark},function(d){
					if(!d.errno){
						util.tips('驳回成功!');
						location.reload();
					}
				},"json");
				$('#order-remark-container').hide();
				$('.main').css("opacity","1");$('.nav').css("opacity","1");$('.big-menu').css("opacity","1");
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