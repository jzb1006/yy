<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<style type='text/css'>
		.trhead td{background:#efefef;text-align: center}
				.trbody td{text-align: center;vertical-align:top;border-left:1px solid #f2f2f2;overflow: hidden;font-size:12px;}
				.trorder{background:#f8f8f8;border:1px solid #f2f2f2;text-align:left;}
				.ops{border-right:1px solid #f2f2f2;text-align: center;}
				.ops a,.ops span{margin: 3px 0;}
				.table-top{padding: 0 20px;background: #f7f7f7;border-bottom: 1px solid #e5e5e5;}
				.table-top .op:hover{color: #000;}
				.tables{border:1px solid #e5e5e5;font-size: 14px;line-height: 18px;}
				.tables:hover{border:1px solid #1ab394;}
				.table-row,.table-header,.table-footer,.table-top{display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;justify-content: center;-webkit-justify-content: center;-webkit-align-content: space-around;align-content: space-around;}
				.tables .table-row.table-top>div{padding: 10.5px 0;}
				.tables .table-row .ops.list-inner{border-right:none;}
				.tables .table-row .buyremark{background:#fdeeee;color:red;flex: 1;padding: 10px 20px!important;}
				.tables .table-row .remark{background:#ffffcc;color:red;flex: 1;padding: 10px 20px!important;}
				.tables .list-inner{border-right: 1px solid #efefef;vertical-align: middle;}
				.table-row .goods-des .title{width:180px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
				.table-row .goods-des{border-right: 1px solid #efefef;vertical-align: middle;width:400px;text-align: left;padding: 14px 0;}
				.table-row .list-inner{-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;text-align: center;display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;-webkit-align-items: center;align-items: center;-webkit-justify-content: center;justify-content: center;-webkit-flex-direction: column;flex-direction: column;}
				.saler>div{width:130px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
				.table-row .list-inner.ops, .table-row .list-inner.paystyle{-webkit-flex-direction: column;flex-direction: column;-webkit-justify-content: center;justify-content: center;}
				.table-header{background:#f8f8f8;height: 40px;line-height: 40px;padding: 0 20px;font-weight: 600;}
				.table-header .others{-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;text-align: center;}
				.table-footer{border-top: 1px solid #efefef;margin:0 20px;padding: 10.5px 0;}
				.table-footer>div, .table-top>div{-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;/*height:100%;*/}
				.fixed-header div{padding:0;}
				.fixed-header.table-header{display: none;}
				.fixed-header.table-header.active{display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;}
				.shop{display: inline-block;width:48px;height:18px;text-align: center;border:1px solid #1b86ff;color: #1b86ff;margin-right: 10px;}
				.min_program{display: inline-block;width:48px;height:18px;text-align: center;border:1px solid #ff5555;color: #ff5555;margin-right: 10px;}
				.ordertype{display: inline-block;height:18px;margin-right: 10px;border-radius: 0;font-weight: 500;}
				.popover{border: 1px solid #efefef;border: 1px solid #efefef;border-radius: 6px;-webkit-filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.1));-moz-filter: drop-shadow(0 5px 10px rgba(0, 0, 0, .1));-o-filter: drop-shadow(0 5px 10px rgba(0, 0, 0, .1));filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.1));padding: 0!important;}
				.popover-content{padding: 10px!important;font-size:12px;}
				.popover-content table{margin-bottom: 0!important;}
				.popover.right>.arrow{border-right-color: #efefef;}
				.cored{color: orangered;}
	</style>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="javascript:;">开方问诊</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-filter">
			<div class="alert alert-warning">
				注意一：全程问诊跟踪，消息提醒务必全填，否则体验不畅
				<br />
				注意二：开方问诊非即时通讯，接诊则需要等待专家接诊
				<br />
			</div>
			<div class="filter-action">
				当前订单:<span class="cored"><?php  echo $count_order;?></span>单，共计问诊人数<span class="cored"><?php  echo $count;?></span>人，<span class="cored"><?php  echo $money;?></span>元;
			</div>
			<div class="filter-list">
				<form action="" method="post" class="form-horizontal" role="form" id="form1">

					<div class="form-group" style="max-width: 1180px;">
						<label class="col-sm-2 control-label">订单状态</label>
						<div class="col-sm-10">
							<div class="btn-group">
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'squareask','ispay'=>'','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'p_type'=>$p_type,'ac'=>'squareask','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">不限</a>
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'squareask','ispay'=>'0','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'p_type'=>$p_type,'ac'=>'squareask','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">待支付</a>
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'squareask','ispay'=>'1','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'p_type'=>$p_type,'ac'=>'squareask','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已支付待发货</a>
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'squareask','ispay'=>'2','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'p_type'=>$p_type,'ac'=>'squareask','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已发货配送中</a>
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'squareask','ispay'=>'3','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'p_type'=>$p_type,'ac'=>'squareask','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '3') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已送达</a>

								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'squareask','ispay'=>'5','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'p_type'=>$p_type,'ac'=>'squareask','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '5') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已评价</a>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">支付方式</label>
						<div class="col-sm-9">
							<div class="btn-group">
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'squareask','ispay'=>$ispay,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'p_type'=>'','ac'=>'squareask','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($p_type == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">不限</a>
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'squareask','ispay'=>$ispay,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'p_type'=>'1','ac'=>'squareask','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($p_type == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">微信支付</a>
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'squareask','ispay'=>$ispay,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'p_type'=>'0','ac'=>'squareask','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($p_type == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">余额支付</a>
							</div>
						</div>
					</div>
					<div class="form-group form-inline">
						<label class="col-sm-2 control-label">订单搜索</label>
						<div class="col-sm-9">
							<select name="keywordtype" class="form-control">
								<option value="1" <?php  if($keywordtype=='1' ) { ?> selected="" <?php  } ?>>订单号 </option>
										<option value="2" <?php  if($keywordtype=='2' ) { ?> selected="" <?php  } ?>>用户信息 </option>
										<option value="3" <?php  if($keywordtype=='3' ) { ?> selected="" <?php  } ?>>接诊医生 </option>
										<option value="4" <?php  if($keywordtype=='4' ) { ?> selected="" <?php  } ?>>买家电话 </option>
										</select>
										<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">时间筛选</label>
						<div class="col-md-3">
							<select name="timetype" class="form-control">
								<option value="">时间类型</option>
								<option value="1">下单时间</option>
								<option value="2">支付时间</option>
							</select>
						</div>
						<div class="col-md-2">
							<?php  echo tpl_form_field_daterange('time')?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-md-9">
							<button class="btn btn-primary btn-sml J-submit-btn" type="submit" name="shaixuan">筛选</button>
							<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
							<input name="hid" type="hidden" value="<?php  echo $_SESSION['hid'];?>" />
							<input type="file" id="excelUpload" class="hide" />
							<!-- 							<button class="btn btn-default min-width" name="export" type="submit" value="export">
								<i class="fa fa-download"></i> 导出记录
							</button> -->
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="app-table-list">
			<div class="row">
				<div class="col-md-12">
					<div class="">
						<div class="table-header">
							<div style="width: 30px;">
								<input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
							</div>
							<div style='width: 400px;text-align: left;'>接诊信息</div>
							<div class="others">用户信息</div>
							<div class="others">支付方式</div>
							<div class="others">时间信息</div>
							<div class="others">费用信息</div>

							<div class="others">状态</div>
							<div class="others">操作</div>
						</div>
						<div class="table-row">
							<div style='height:20px;padding:0;border-top:none;'>&nbsp;</div>
						</div>
						<?php  if(is_array($res)) { foreach($res as $item) { ?>
						<div class="tables">

							<div class='table-row table-top'>
								<div style="text-align: left;color: #8f8e8e;">
									<span style="font-weight: bold;margin-right: 10px;color: #2d2d31">
										<span class="label label-info ordertype">开方</span> <?php  echo $item['time'];?>
									</span>
									订单编号：<?php  echo $item['orders'];?>
								</div>
								<div class='aops text-right'>

								<!-- 	<i class="icow icow-shutDown" title="订单退款" style="color: #999;margin-right: 3px;display: inline-block;vertical-align: middle"></i>
									订单退款
									&nbsp -->
									</a>

									<!-- <a class='op' data-toggle='ajaxPost' href="https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=hyb_yl&p=order&ac=wlOrder&do=createdisorder&id=289&type=a" data-confirm="确认生成相关分销订单？">
										<i class="icow icow-shutDown" title="查看详情" style="color: #999;margin-right: 3px;display: inline-block;vertical-align: middle"></i>
										生成推客订单
										&nbsp
									</a> -->
								</div>
							</div>

							<div class='table-row' style="margin:0  20px">
								<div class="list-inner saler" style='text-align: center;'>
									<center>
										<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['back_orser'];?>" />
									</center>
								</div>
								<div class="goods-des">
									<div style="display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;margin: 10px 0">
										<img src="<?php  echo $item['advertisement'];?>" style='width:70px;height:70px;border:1px solid #efefef; padding:1px;' onerror="this.src='<?php  echo $item['advertisement'];?>'">
										<div style="-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;margin-left: 10px;text-align: left;display: flex;align-items: center">
											<div>
												<div class="title">
													<?php  echo $item['z_name'];?><label class="label label-success"><?php  echo $item['keshi']['name'];?></label>
													<span class="label label-warning"><?php  echo $item['job']['job_name'];?></span>
													<br />
													<br />
													所属机构：<span class="label label-primary"><?php  echo $item['host']['agentname'];?></span>

													<span style="color: #999"> </span>
												</div>
											</div>
											<span style="float: right;text-align: right;display: inline-block;width:130px;">
												问诊费用：￥<?php  echo $item['ptmoneys'];?>
												<br />
												x<?php  echo $item['countarr'];?> </span>
										</div>
									</div>
								</div>

								<div class="list-inner saler" style='text-align: center;'>
									<div>
										<a href="">
											<?php  echo $item['u_name'];?></a>
										<br />
										<?php  echo $item['names'];?>
										<br /><?php  echo $item['tel'];?>
										<br />MID:<?php  echo $item['randnum'];?>
									</div>
								</div>
								<div class="list-inner paystyle" style='text-align:center;'>

									<!-- 已支付 -->
									<span>
										<i class="icow icow-yue text-warning" style="font-size: 17px;"></i>
										<span>微信支付</span>
									</span>
								</div>
								<div class="list-inner paystyle">

									<!-- 时间信息 -->
									<span>
										<i class="icow icow-yue text-warning" style="font-size: 13px;"></i>
										<br />下单：<?php  echo $item['time'];?>
										<br />支付：<?php  if($item['ispay'] =='1' || $item['ispay'] =='2' || $item['ispay'] =='3' || $item['ispay'] =='4' || $item['ispay'] =='5' || $item['ispay'] =='6') { ?> <?php  echo $item['paytime'];?> <?php  } else if($item['ispay'] =='7') { ?>订单已关闭 <?php  } else { ?>未支付 <?php  } ?>
								</div>

								<a class="list-inner" data-toggle='popover' data-html='true' data-placement='right' data-trigger="hover" data-content="<table style='width:100%;'>
 										<td  style='border:none;text-align:right;padding: 5px!important;'>平台抽成：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-￥<?php  echo $item['ptmoney'];?></td>
	                                    </tr>
	                                    <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>机构抽成：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-￥<?php  echo $item['hosmoney'];?></td>
	                                    </tr>
	         <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>分销支出：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-￥<?php  echo $item['tk_one']+$item['tk_two']?></td>
	                                    </tr>
                                         <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>优惠券抵扣：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-￥<?php  echo $item['coupon_dk'];?></td>
	                                    </tr>
	                                    <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>会员抵扣：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-￥<?php  echo $item['card_dk'];?></td>
	                                    </tr>
                                                                                                                                                       <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>年卡折扣：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-￥<?php  echo $item['year_dk'];?></td>
	                                    </tr>
	                                    	                                    	                                    	                                    	                                    <tr>
	                                        <td style='border:none;text-align:right;padding: 5px!important;'>应收款：</td>
	                                        <td  style='border:none;text-align:right;color:green;padding: 5px!important;'>￥<?php  echo $item['moneyss'];?></td>
	                                    </tr>
	                                </table>
	                            ">
									<div style='text-align:center'>
										￥<?php  echo $item['moneyss'];?> </div>
								</a>



								<div class="list-inner" style='text-align:center'>
									<?php  if($item['ispay'] =='0') { ?>
									<span class="label label-warning">待支付</span>
									<?php  } ?>
									<?php  if($item['ispay'] =='1') { ?>
									<span class="label label-warning">已支付待发货</span>
									<?php  } ?>
									<?php  if($item['ispay'] =='2') { ?>
									<span class="label label-warning">已发货配送中</span>
									<?php  } ?>
									<?php  if($item['ispay'] =='3') { ?>
									<span class="label label-warning">已送达</span>
									<?php  } ?>
									<?php  if($item['ispay'] =='4') { ?>
									<span class="label label-warning">确认收货</span>
									<?php  } ?>
									<?php  if($item['ispay'] =='5') { ?>
									<span class="label label-warning">已完成待评价</span>
									<?php  } ?>
									<?php  if($item['ispay'] =='6') { ?>
									<span class="label label-warning">已评价</span>
									<?php  } ?>
									<?php  if($item['ispay'] =='7') { ?>
									<span class="label label-warning">已关闭</span>
									<?php  } ?>
									<?php  if($item['ispay'] =='8') { ?>
									<span class="label label-warning">订单已取消</span>
									<?php  } ?>
								</div>


								<div class="" style="overflow:visible;margin-top: 40px; text-align: center;">

									<a class="btn btn-primary btn-sm" href="/index.php?c=site&a=entry&do=ask&op=squareaskdetails&ac=squareask&m=hyb_yl&c_id=<?php  echo $item['c_id'];?>&hid=<?php  echo $_SESSION['hid'];?>" title="">查看详情</a>
									<?php  if($item['ispay'] =='0') { ?>
									<a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('ask',array('c_id'=>$item['c_id'],'ac'=>'squareask','op'=>'entercforder','hid'=>$_SESSION['hid']))?>">确定付款</a>
                                    <?php  } ?>
									<a class="btn btn-info btn-sm" href="/index.php?c=site&a=entry&do=ask&op=askchat&ac=squareask&m=hyb_yl&back_orser=<?php  echo $item['back_orser'];?>&keyword=yuanchengkaifang&hid=<?php  echo $_SESSION['hid'];?>">快速回复</a>
									<a class="btn btn-danger btn-sm" data-toggle="ajaxRemove" href="/index.php?c=site&a=entry&do=ask&op=deletekaifang&ac=asklist&m=hyb_yl&back_orser=<?php  echo $item['back_orser'];?>&hid=<?php  echo $_SESSION['hid'];?>" data-confirm="确定要删除该记录吗？">快速删除</a>




								</div>


							</div>

						</div>
                      <?php  } } ?>
					</div>
					
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
			<script>
				$("#excelUpload").on('change',function () {
								        var val = $("#excelUpload").get(0).files[0];//文件内容
								        var type = val['name'].split(".");//文件名称+文件后缀
								        type = $.trim(type[type.length - 1]);//文件后缀
								        $("#excelUpload").val('');
								        if(type == 'csv'){
								            var fd = new FormData();
								            fd.append("file",val);//上传的文件file
								            tip.confirm("内容处理中，请不要刷新页面/离开页面!<br />确定后开始处理",function () {
								                $.ajax({
								                    url:"https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=weliam_merchant&p=order&ac=wlOrder&do=bulkShipment&",
								                    type:"post",
								                    data:fd,
								                    dataType:"json",
								                    cache: false,
								                    processData: false,
								                    contentType: false,
								                    async:false,
								                    success:function(data){
								                        tip.alert(data.message,function () {
								                            if(data.errno == 1){
								                                var url = "https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=weliam_merchant&p=order&ac=wlOrder&do=batchSend&"+"name="+data.data;
								                                window.location.href = url;
								                            }
								                        });
								                    },
								                    error:function(){
								                        tip.alert("网络错误，请重试！！");
								                    }
								                });
								            });
								        }else{
								            tip.alert("只能上传csv类型的表格文件");
								        }
								    });
			</script>
<script type="text/javascript">
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
		var url="../web/index.php?c=site&a=entry&m=hyb_yl&op=del_squareaks&ac=squareak&do=ask&ids="+ids;
				console.log(ids);
		util.nailConfirm(this, function(state) {
		if(!state) return;
			if(enabled == 4){
				var type = 2;
			}else{
				var type = 1;
			}

			$.post("../web/index.php?c=site&a=entry&m=hyb_yl&op=del_squareaks&ac=squareak&do=ask&", { ids : ids ,type:type}, function(data){
			
				if(data.errno=='1'){ 
                    util.tips("操作成功！");
                    setTimeout(function(){ 
                        window.location.reload();
                    }, 1000);
                }else{
                    util.tips("操作失败");  
                };
			}, 'json');
		}, {html: '确认删除所选订单?'});
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