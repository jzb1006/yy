<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li class="active"><a href="#">提现列表</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-list">
			<form action="" method="post" class="form-horizontal" role="form">
				<input type="hidden" name="status" value="1" />
				<input type="hidden" name="type" value="" />
				<div class="form-group">
					<label class="col-sm-2 control-label">提现状态</label>
					<div class="col-sm-9">
						<div class="btn-group">
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>'','style'=>$style,'keywordtype'=>$keywordtype,'start'=>$start,'end'=>$end))?>" class="btn <?php  if($status == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">不限</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>'0','style'=>$style,'keywordtype'=>$keywordtype,'start'=>$start,'end'=>$end))?>" class="btn <?php  if($status == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">待审核</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>'1','style'=>$style,'keywordtype'=>$keywordtype,'start'=>$start,'end'=>$end))?>" class="btn <?php  if($status == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已完成</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>'2','style'=>$style,'keywordtype'=>$keywordtype,'start'=>$start,'end'=>$end))?>" class="btn <?php  if($status == '2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">未通过</a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">提现类型</label>
					<div class="">
						<div class="btn-group">

							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>'','start'=>$start,'end'=>$end))?>" class="btn <?php  if($style == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">不限</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>'0','start'=>$start,'end'=>$end))?>" class="btn <?php  if($style == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">导诊提现</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>'1','start'=>$start,'end'=>$end))?>" class="btn <?php  if($style == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">专家提现</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>'2','start'=>$start,'end'=>$end))?>" class="btn <?php  if($style == '2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">团队提现</a>
                            <a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>'3','start'=>$start,'end'=>$end))?>" class="btn <?php  if($style == '3') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">代理提现</a>
                            <a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>'4','start'=>$start,'end'=>$end))?>" class="btn <?php  if($style == '4') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">分销提现</a>
                            <a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>'5','start'=>$start,'end'=>$end))?>" class="btn <?php  if($style == '5') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">用户余额提现</a>
                            <a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>'6','start'=>$start,'end'=>$end))?>" class="btn <?php  if($style == '6') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">药师提现</a>
                            <a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>'7','start'=>$start,'end'=>$end))?>" class="btn <?php  if($style == '7') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">机构提现</a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">提现方式</label>
					<div class="col-sm-9">
						<div class="btn-group">

							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>$style,'cash_type'=>'','start'=>$start,'end'=>$end))?>" class="btn <?php  if($cash_type == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">不限</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>$style,'start'=>$start,'end'=>$end,'cash_type'=>'0'))?>" class="btn <?php  if($cash_type == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">微信</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>$style,'start'=>$start,'end'=>$end,'cash_type'=>'1'))?>" class="btn <?php  if($cash_type == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">支付宝</a>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','status'=>$status,'style'=>$style,'start'=>$start,'end'=>$end,'cash_type'=>'2'))?>" class="btn <?php  if($cash_type == '2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">银行卡</a>
                            
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

	<input name="start" type="hidden" value="<?php  echo $start;?>" />
	<input name="end" type="hidden" value="<?php  echo $end;?>" />
	<button class="btn btn-default daterange daterange-date" type="button"><span class="date-title"><?php  echo $start;?> 至 <?php  echo $end;?></span> <i class="fa fa-calendar"></i></button>
							</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9">
                        <div class="btn-group">
							<button class="btn btn-primary" type="submit">筛选</button>
							<a href="javascript:;" id="getExport" class="btn btn-default min-width" ><i class="fa fa-download"></i>  导出记录</a>
                        </div>
                    </div>
                </div>
			</form>
		</div>
	</div>
	<div class="app-table-list">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th style="width: 30px;">
                            <input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
                        </th>
						<th>提现人信息</th>
						<th>提现类型</th>
						<th>提现方式</th>
						<th>提现金额</th>
                        <!-- <th>提现方式</th> -->
						<th>手续费</th>
						<th>到账金额</th>
						<!-- <th>到账类型</th> -->
						<th>申请时间</th>
						<!-- <th>操作时间</th> -->
						<th>状态</th>
						<th class="text-center">操作</th>
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
				<td><?php  echo $item['name'];?></td>
				<td>
				<?php  if($item['style'] == '0') { ?>
				导诊提现
				<?php  } else if($item['style'] == '1') { ?>
				专家提现
				<?php  } else if($item['style'] == '2') { ?>
				团队提现
				<?php  } else if($item['style'] == '3') { ?>
				代理提现
				<?php  } else if($item['style'] == '4') { ?>
				分销提现
				<?php  } else if($item['style'] == '5') { ?>
				用户余额提现
				<?php  } else if($item['style'] == '6') { ?>
				药师提现
				<?php  } else if($item['style'] == '7') { ?>
				机构提现
				<?php  } ?>
				</td>
				<td>
				<?php  if($item['cash_type'] == '0') { ?>
					微信
					<br>
					<?php  echo $item['nickname'];?>
				<?php  } else if($item['cash_type'] == '1') { ?>
					支付宝
					<br>
					姓名：<?php  echo $item['zfb_name'];?>
					账号：<?php  echo $item['zfb_number'];?>
				<?php  } else if($item['cash_type'] == '2') { ?>
					银行卡
					<br>
					卡号：<?php  echo $item['bank_card'];?>
					<br>
					开户行：<?php  echo $item['bank_address'];?>
					<br>
					持有人：<?php  echo $item['bank_user'];?>
				<?php  } ?>

				</td>
				<td><?php  echo $item['old_money'];?></td>
				<!-- <td>微信</td> -->
				<td><?php  echo $item['fee'];?></td>
				<td><?php  echo $item['old_money']-$item['fee']?></td>
				<!-- <td><?php  echo $item['account_type'];?></td> -->
				<td><?php  echo $item['created'];?></td>
				<!-- <td><?php  echo date("Y-m-d H:i:s",$item['s_time'])?></td> -->
				<td>
				
					<?php  if($item['status'] == '0') { ?>
					待审核
					<?php  } else if($item['status'] == '1') { ?>
					已完成
					<?php  } else if($item['status'] == '2') { ?>
					未通过
					
					<?php  } ?>
				</td>
				<td>
					<?php  if($item['status'] == '0') { ?>
					<a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('financ',array('op'=>'tx_change','id'=>$item['id'],'ac'=>'givemoney','status'=>'1'))?>">通过申请</a>
					<a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('financ',array('op'=>'tx_change','id'=>$item['id'],'ac'=>'givemoney','status'=>'2'))?>">拒绝申请</a>
					
					<?php  } else if($item['status'] == '1') { ?>
						已完成
					<?php  } else if($item['status'] == '2') { ?>
					未通过
					<?php  } ?>
					<a class="btn btn-danger btn-sm" data-toggle="ajaxRemove" href="<?php  echo $this->createWebUrl('financ',array('op'=>'tx_del','ac'=>'givemoney','id'=>$item['id']))?>" data-confirm="确定要删除该记录吗？">快速删除</a>

				</td>
				</tr>
				<?php  } } ?>
									</tbody>
					
			</table>
			<?php  if(count($list) == 0) { ?>
							<div class="panel-body" style="text-align: center;padding:30px;">
					暂时没有任何数据!
				</div>
				<?php  } ?>
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
</div>
<script>
    $(function () {
        //初始化信息内容
        var url = "./index.php?c=site&a=entry&m=weliam_merchant&p=finace&ac=wlCash&do=cashApply&status=1&page=1&export=export";//导出请求地址
        //申请导出记录信息
        $("#getExport").on('click',function () {
            //开始时间
            var startDate = $("[name='time[start]']").val();
            var startTime = Date.parse(new Date(startDate +" 00:00:00"));
            startTime = startTime / 1000;
            //结束时间
            var endDate = $("[name='time[end]']").val();
            var endTime = Date.parse(new Date(endDate +" 23:59:59"));
            endTime = endTime / 1000;
            //url拼接
            url = url+"&startTime="+startTime+"&endTime="+endTime;
            //请求导出内容
            window.location.href = url;
        });
    });
</script>
			</div>
		</div>
	</div>
	<div class="foot" id="footer">
		<ul class="links ft">
            <li class="links_item"><div class="copyright">Powered by <a href="http://www.we7.cc"><b>系统</b></a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a></div></li>
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
<script type="text/javascript">
    // 批量删除
    $('#de1').delegate('.pass_delete','click',function(e){
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

        util.nailConfirm(this, function(state) {console.log(state)
        if(!state)  return;
            $.post("<?php  echo $this->createWebUrl('financ',array('op'=>'del_givemoneys','ac'=>'givemoney'))?>", { ids : ids }, function(data){
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
	</body>
</html>

