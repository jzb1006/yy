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
			<a href="javascript:;">药品订单</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-filter">
			<div class="alert alert-warning">
				注意一：批量发货功能在同一时间最大处理单数是999单，超过将出现不可估计的错误!
				<br />
				注意二：批量发货表中填写的物流公司名称需要与确认返回中的物流名称一致，否则将发货失败!
				<br />
				注意三：请将批量发货表中的单元格的格式设置为文本格式,否则可能读取错误导致发货失败!
			</div>
			<div class="filter-action">
				当前订单:<span class="cored"><?php  echo $total;?></span>个，共计药品数量<span class="cored"><?php  echo $sum;?></span>份，<span class="cored"><?php  echo $money4;?></span>元;
			</div>
			<div class="filter-list">
				<form action="" method="get" class="form-horizontal" role="form" id="form1">
					<input type="hidden" name="c" value="site" />
					<input type="hidden" name="a" value="entry" />
					<input type="hidden" name="m" value="hyb_yl" />
					<input type="hidden" name="op" value="yporder" />
					<input type="hidden" name="ac" value="wlOrder" />
					<input type="hidden" name="do" value="order" />
					<input type="hidden" name="hid" value="<?php  echo $_SESSION['hid'];?>" />
					<div class="form-group" style="max-width: 1180px;">
						<label class="col-sm-2 control-label">订单状态</label>
						<div class="col-sm-10">
							<div class="btn-group">
								<a href="<?php  echo $this->createWebUrl('order',array('op'=>'yporder','ac'=>'yporder','isPay'=>'','orderStatus'=>'','isRefund'=>'','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($isPay == '' && $orderStatus == '' && $isRefund == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">不限</a>
								<a href="<?php  echo $this->createWebUrl('order',array('op'=>'yporder','ac'=>'yporder','isPay'=>'0','orderStatus'=>'-2','isRefund'=>$isRefund,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($orderStatus == '-2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">未支付</a>
								
								<a href="<?php  echo $this->createWebUrl('order',array('op'=>'yporder','ac'=>'yporder','isPay'=>$isPay,'orderStatus'=>'0','isRefund'=>$isRefund,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($orderStatus == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已支付待发货</a>
								
								<a href="<?php  echo $this->createWebUrl('order',array('op'=>'yporder','ac'=>'yporder','isPay'=>$isPay,'orderStatus'=>'-3','isRefund'=>$isRefund,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($orderStatus == '-3') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">用户拒收</a>
								<a href="<?php  echo $this->createWebUrl('order',array('op'=>'yporder','ac'=>'yporder','isPay'=>$isPay,'orderStatus'=>'-1','isRefund'=>$isRefund,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($orderStatus == '-1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">用户取消</a>
								
								<!--<a href="<?php  echo $this->createWebUrl('order',array('op'=>'yporder','ac'=>'yporder','isPay'=>$isPay,'orderStatus'=>'0','isRefund'=>$isRefund,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($orderStatus == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">待发货</a>-->
								
								<a href="<?php  echo $this->createWebUrl('order',array('op'=>'yporder','ac'=>'yporder','isPay'=>$isPay,'orderStatus'=>'1','isRefund'=>$isRefund,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($orderStatus == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">配送中</a>
								<a href="<?php  echo $this->createWebUrl('order',array('op'=>'yporder','ac'=>'yporder','isPay'=>$isPay,'orderStatus'=>'2','isRefund'=>$isRefund,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($orderStatus == '2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">用户确认收货</a>

							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否允许退款</label>
						<div class="col-sm-9">
							<div class="btn-group">
								<a href="<?php  echo $this->createWebUrl('order',array('op'=>'yporder','ac'=>'yporder','isPay'=>$isPay,'orderStatus'=>$orderStatus,'isRefund'=>'','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($isRefund == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">不限</a>
								<a href="<?php  echo $this->createWebUrl('order',array('op'=>'yporder','ac'=>'yporder','isPay'=>$isPay,'orderStatus'=>$orderStatus,'isRefund'=>'1','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($isRefund == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">允许退款</a>
								<!--<a href="<?php  echo $this->createWebUrl('order',array('op'=>'yporder','ac'=>'yporder','isPay'=>$isPay,'orderStatus'=>$orderStatus,'isRefund'=>'0','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($isRefund == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">拒绝退款</a>-->
							</div>
						</div>
					</div>
					<div class="form-group form-inline">
						<label class="col-sm-2 control-label">订单搜索</label>
						<div class="col-sm-9">
							<select name="keywordtype" class="form-control">
							        	<option value="1" <?php  if($keywordtype=='1' ) { ?> selected="" <?php  } ?>>订单号 </option>
										<option value="2" <?php  if($keywordtype=='2' ) { ?> selected="" <?php  } ?>>商品名称 </option>
										<option value="3" <?php  if($keywordtype=='3' ) { ?> selected="" <?php  } ?>>买家昵称 </option>
										<option value="4" <?php  if($keywordtype=='4' ) { ?> selected="" <?php  } ?>>买家电话 </option>
										</select>
										<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">时间筛选</label>

						<div class="col-md-2">

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
							<button class="btn btn-default daterange daterange-date" type="button">
								<span class="date-title"><?php  echo $start;?> 至 <?php  echo $end;?></span>
								<i class="fa fa-calendar"></i>
							</button>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-md-9">
							<button class="btn btn-primary" id="search">筛选</button>
							<!--<button class="btn btn-warning min-width" onclick="$('#excelUpload').click();return false;"><i class="fa fa-upload"></i>  批量发货</button>-->
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
							<div style='width: 400px;text-align: left;'>药品</div>
							<div class="others">买家</div>
							<div class="others">价格</div>
							<div class="others">时间</div>
							<div class="others">支付/配送</div>
							<div class="others">状态</div>
							<!-- <div class="others">操作</div> -->
						</div>
						<?php  if(is_array($list)) { foreach($list as $item) { ?>
						<div class="table-row">
							<div style='height:20px;padding:0;border-top:none;'>&nbsp;</div>
						</div>
						<div class="tables">
							<div class='table-row table-top'>
								<div style="text-align: left;color: #8f8e8e;">
									<span style="font-weight: bold;margin-right: 10px;color: #2d2d31">
										<span class="label label-info ordertype">药品</span> <?php  echo $item['createTime'];?>
									</span>
									订单编号：<?php  echo $item['orderNo'];?>&nbsp;&nbsp;
								</div>
								<div class='aops text-right'>
									<!--  <a class='op'  data-toggle="ajaxModal" href="https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=weliam_merchant&p=order&ac=wlOrder&do=remarksaler&id=289&type=a" >
	                                    	                                    <i class="icow icow-yibiaoji" style="color: #999;display: inline-block;vertical-align: middle" title="  添加备注" ></i>
	                                    备注
	                                    &nbsp
	                                    	                                </a> -->
									<!--<a>-->
									<!--	<i class="icow icow-shutDown" title="订单退款" style="color: #999;margin-right: 3px;display: inline-block;vertical-align: middle"></i>-->
									<!--	订单退款-->
									<!--	&nbsp-->
									<!--</a>-->
								</div>
							</div>
							<div class='table-row' style="margin:0  20px">
								<div class="goods-des">
									<div style="display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;margin: 10px 0">
										<!-- <img src="<?php  echo $item['goods']['sthumb'];?>" style='width:70px;height:70px;border:1px solid #efefef; padding:1px;'onerror="this.src='<?php  echo $item['goods']['sthumb'];?>'"> -->
										<div style="-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;margin-left: 10px;text-align: left;display: flex;align-items: center">
											<div>
											<?php  if(is_array($item['goods'])) { foreach($item['goods'] as $itemarr) { ?>
												<div class="title">
													<?php  echo $itemarr['sname'];?>
													<br />
													<span style="color: #999"> x<?php  echo $itemarr['num'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;￥<?php  echo $itemarr['smoney'];?></span>
												</div>

											<?php  } } ?>	
											</div>
											<span style="float: right;text-align: right;display: inline-block;width:130px;">
											   <!-- ￥<?php  echo $item['totalMoney'];?> -->
												<br />
												<!-- x<?php  echo count($item['goods'])?> </span> -->
										</div>
									</div>
								</div>

								<div class="list-inner saler" style='text-align: center;'>
									<div>
										<a href="/index.php?c=site&a=entry&op=adduser&do=copysite&m=hyb_yl&act=profile.adduser&ac=notice&u_id=<?php  echo $item['u_id'];?>&hid=<?php  echo $_SESSION['hid'];?>"> <?php  echo $item['u_name'];?></a>
										<br />
										<?php  echo $item['u_name'];?>
										<br /><?php  echo $item['u_tel'];?>
										<br />MID:<?php  echo $item['u_id'];?>
									</div>
								</div>
<!-- 								<div class="list-inner paystyle" style='text-align:center;'>

									<span>
										<i class="icow icow-yue text-warning" style="font-size: 17px;"></i>
										<span><?php  echo $item['expressNo'];?></span>
									</span>
								</div> -->

								<a class="list-inner" data-toggle='popover' data-html='true' data-placement='right' data-trigger="hover" data-content="<table style='width:100%;'>
	                                    <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>商品小计：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>￥<?php  echo $item['totalMoney'];?></td>
	                                    </tr>
<tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>平台抽成：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>￥<?php  echo $item['totalMoney'];?></td>
	                                    </tr>
	                                    <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>分销支出：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>￥<?php  echo $item['tkmoney'];?></td>
	                                    </tr>
	                                    <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>开药服务费支出：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>￥<?php  echo $item['totalMoney'];?></td>
	                                    </tr>
	                                        <td style='border:none;text-align:right;padding: 5px!important;'>机构实收款：</td>
	                                        <td  style='border:none;text-align:right;color:green;padding: 5px!important;'>￥<?php  echo $item['realTotalMoney'];?></td>
	                                    </tr>
	
	                                </table>
	                    ">
									<div style='text-align:center'>
										￥<?php  echo $item['totalMoney'];?> </div>

								</a>
									                        <div class="list-inner paystyle"  >
	
	                         <span> <i class="icow icow-yue text-warning" style="font-size: 13px;"></i><span>
                                <br/>下单：<?php  echo $item['createTime'];?> <br/>
                                <?php  if($item['orderStatus']=='0') { ?>
                                支付：<?php  echo $item['paytime'];?>
                                <?php  } ?>
	                         </div>
								<div class="list-inner" style='text-align:center'>
									<span class="label label-warning">
										<?php  if($item['orderStatus'] == '-3') { ?>
										用户拒收
										<?php  } else if($item['orderStatus'] == '-2') { ?>
										未付款
										<?php  } else if($item['orderStatus'] == '-1') { ?>
										用户取消
										<?php  } else if($item['orderStatus'] == '0') { ?>
										待发货
										<?php  } else if($item['orderStatus'] == '1') { ?>
										配送中
										<?php  } else if($item['orderStatus'] == '2') { ?>
										用户确认收货
										<?php  } ?>
									</span>
								</div>

								<div class="" style="overflow:visible;margin-top: 40px; text-align: center;">

									<a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('order',array('op'=>'yporderxq','ac'=>'yporderxq','id'=>$item['id'],'hid'=>$_SESSION['hid']))?>" title="">查看详情</a>
					
									
                                     <?php  if($item['orderStatus'] !== '2') { ?>
									  <a class="btn btn-info btn-sm" data-toggle="ajaxModal"  href="<?php  echo $this->createWebUrl('order',array('op'=>'yporderchange','addressId'=>$item['addressId'], 'ac'=>'yporderchange','id'=>$item['id'],'orderStatus'=>'1','hid'=>$_SESSION['hid']))?>"><?php  if($item['orderStatus'] == '0' ) { ?>确定发货<?php  } else { ?> 修改物流信息<?php  } ?></a>
									 <?php  } ?>

									<?php  if($item['orderStatus'] == '1') { ?>
									<a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('order',array('op'=>'yporderchangeshou','ac'=>'yporderchange','id'=>$item['id'],'orderStatus'=>'2','hid'=>$_SESSION['hid']))?>">确认收货</a>
									<?php  } ?>
									<?php  if($item['isPay'] == '0') { ?>
									<a class="btn btn-danger btn-sm" data-toggle="ajaxRemove" href="<?php  echo $this->createWebUrl('order',array('op'=>'yporderchange','ac'=>'yporderchange','id'=>$item['id'],'orderStatus'=>'-1','hid'=>$_SESSION['hid']))?>" data-confirm="确定要取消该记录吗？">取消订单</a>
									<?php  } ?>
									<a class="btn btn-danger btn-sm" data-toggle="ajaxRemove" href="<?php  echo $this->createWebUrl('order',array('op'=>'yporderdel','ac'=>'yporderdel','id'=>$item['id'],'hid'=>$_SESSION['hid']))?>" data-confirm="确定要删除该记录吗？">删除订单</a>

								</div>
							</div>
						</div>
						<?php  } } ?>
						<div class="table-row">
							<div style='height:20px;padding:0;border-top:none;'>&nbsp;</div>
						</div>
					</div>
				</div>
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
		<?php  echo $pager;?>
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