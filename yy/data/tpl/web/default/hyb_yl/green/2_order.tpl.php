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
				.table-footer>div, .table-top>div{
					-webkit-box-flex: 1;
					-ms-flex: 1;
					flex: 1;
				}
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
			<a href="javascript:;">绿通订单</a>
		</li>
	</ul>

<form action="" method="post" class="form-horizontal" role="form" >
	<div class="app-content">
		<div class="app-filter">
			<div class="filter-action">
				当前订单:<span class="cored"><?php  echo $count;?></span>单，共计人数<span class="cored"><?php  echo $count_people;?></span>人，<span class="cored"><?php  echo $money;?></span>元;
			</div>
			<div class="filter-list">
				<form action="" method="post" class="form-horizontal">
					<input name="do" type="hidden" value="green" />
					<input name="op" type="hidden" value="order" />
					<input name="ac" type="hidden" value="order" />
					<input name="m" type="hidden" value="hyb_yl" />
					<input name="hid" id="hid" type="hidden" value="<?php  echo $_SESSION['hid'];?>" />
					<div class="form-group" style="max-width: 1180px;">
						<label class="col-sm-2 control-label">订单类型</label>
						<div class="col-sm-10">
							<div class="btn-group">
								
								<a href="<?php  echo $this->createWebUrl('green',array('op'=>'order','ac'=>'order','ifpay'=>'','type'=>'','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($type == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">不限</a>
								<?php  if(is_array($type_arr)) { foreach($type_arr as $typs) { ?>
								<a href="<?php  echo $this->createWebUrl('green',array('op'=>'order','ac'=>'order','ifpay'=>'','type'=>$typs['keyword'],'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($type == $typs['keyword']) { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>"><?php  echo $typs['title'];?></a>
								<?php  } } ?>
								

							</div>
						</div>
					</div>
					<div class="form-group" style="max-width: 1180px;">
						<label class="col-sm-2 control-label">订单状态</label>
						<div class="col-sm-10">
							<div class="btn-group">
								<a href="<?php  echo $this->createWebUrl('green',array('op'=>'order','ac'=>'order','ifpay'=>'','type'=>$type,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">不限</a>
								<a href="<?php  echo $this->createWebUrl('green',array('op'=>'order','ac'=>'order','ifpay'=>'0','type'=>$type,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">待支付</a>
								
								<a href="<?php  echo $this->createWebUrl('green',array('op'=>'order','ac'=>'order','ifpay'=>'1','type'=>$type,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">待接诊</a>
								<a href="<?php  echo $this->createWebUrl('green',array('op'=>'order','ac'=>'order','ifpay'=>'2','type'=>$type,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">接诊中</a>
								<a href="<?php  echo $this->createWebUrl('green',array('op'=>'order','ac'=>'order','ifpay'=>'3','type'=>$type,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '3') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已完成/待评价</a>
								<a href="<?php  echo $this->createWebUrl('green',array('op'=>'order','ac'=>'order','ifpay'=>'4','type'=>$type,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '4') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已评价</a>
								<a href="<?php  echo $this->createWebUrl('green',array('op'=>'order','ac'=>'order','ifpay'=>'5','type'=>$type,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '5') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">退款单</a>

							</div>
						</div>
					</div>
					<div class="form-group form-inline">
						<label class="col-sm-2 control-label">订单搜索</label>
						<div class="col-sm-9">
							<select name="keywordtype" class="form-control">
								<option value="">订单搜索</option>
								<option value="1" <?php  if($keywordtype == '1') { ?> selected="" <?php  } ?>>订单号</option>
								<option value="2" <?php  if($keywordtype == '2') { ?> selected="" <?php  } ?>>用户姓名</option>
								<option value="3" <?php  if($keywordtype == '3') { ?> selected="" <?php  } ?>>用户电话</option>
							</select>
							<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">时间筛选</label>
						<div class="col-md-3">
							<select name="timetype" class="form-control">
								<option value="">时间类型</option>
								<option value="1" <?php  if($timetype == '1') { ?> selected="" <?php  } ?>>下单时间</option>
								<option value="2" <?php  if($timetype == '2') { ?> selected="" <?php  } ?>>支付时间</option>
							</select>
						</div>
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
							<button class="btn btn-primary btn-sml J-submit-btn" type="submit" name="shaixuan">筛选</button>
							<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
							<input type="file" id="excelUpload" class="hide" />
							
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
							<div style='width: 400px;text-align: left;'>服务信息</div>
							<div class="others">用户信息</div>
							<div class="others">时间信息</div>
							<div class="others">费用信息</div>
							<div class="others">状态</div>
							<div class="others">操作</div>
						</div>
						<div class="table-row">
							<div style='height:20px;padding:0;border-top:none;'>&nbsp;</div>
						</div>
						<?php  if(is_array($list)) { foreach($list as $item) { ?>
						<div class="tables">

							<div class='table-row table-top'>
								<div style="text-align: left;color: #8f8e8e;">
									<span style="font-weight: bold;margin-right: 10px;color: #2d2d31">
										<span class="label label-info ordertype"><?php  echo $item['typs'];?></span> <?php  echo $item['time'];?>
									</span>
									订单编号：<?php  echo $item['orders'];?>
								</div>
								<div class='aops text-right'>

								<!-- 	<i class="icow icow-shutDown" title="订单退款" style="color: #999;margin-right: 3px;display: inline-block;vertical-align: middle"></i>
									订单退款
									&nbsp -->
									</a>

								<!-- 	<a class='op' data-toggle='ajaxPost' href="/index.php?c=site&a=entry&m=hyb_yl&p=order&ac=wlOrder&do=createdisorder&id=<?php  echo $item['id'];?>&type=a" data-confirm="确认生成相关分销订单？">
										<i class="icow icow-shutDown" title="查看详情" style="color: #999;margin-right: 3px;display: inline-block;vertical-align: middle"></i>
										生成推客订单
										&nbsp
									</a> -->
								</div>
							</div>

							<div class='table-row' style="margin:0  20px">
								<div>
									<center>
										<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['back_orser'];?>" />
									</center>
								</div>
								<div class="goods-des">
									<div style="display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;margin: 10px 0">
										<img src="<?php  echo $item['doc']['thumb'];?>" style='width:70px;height:70px;border:1px solid #efefef; padding:1px;' onerror="this.src='<?php  echo $item['doc']['thumb'];?>'">
										<div style="-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;margin-left: 10px;text-align: left;display: flex;align-items: center">
											<div>
												<div class="title">
													<?php  echo $item['doc']['title'];?><label class="label label-success"><?php  echo $item['doc']['name'];?></label>
													<span class="label label-warning"><?php  echo $item['doc']['job_name'];?></span>
													<br />
													<br />
													所属机构：<span class="label label-primary"><?php  echo $item['doc']['agentname'];?></span>

													<span style="color: #999"> </span>
												</div>
											</div>
											<span style="float: right;text-align: right;display: inline-block;width:130px;">
											<?php  if($item['fuwus'] == '') { ?>
												<?php  echo $item['typs'];?>：￥<?php  echo $item['money'];?>
											<?php  } else { ?>
											<?php  if(is_array($item['fuwus'])) { foreach($item['fuwus'] as $fuwu) { ?>
												<?php  echo $fuwu['title'];?>：￥<?php  echo $fuwu['money'];?>
												
												x<?php  echo $fuwu['num'];?> 
												<br />
											<?php  } } ?>
											<?php  } ?>
											</span>
										</div>
									</div>
								</div>

								<div class="list-inner saler" style='text-align: center;'>
									<div>
										<a href="/index.php?c=site&a=entry&op=adduser&do=copysite&m=hyb_yl&act=profile.adduser&ac=notice&u_id=<?php  echo $item['user']['u_id'];?>&hid=<?php  echo $_SESSION['hid'];?>">
											<?php  echo $item['user']['u_name'];?></a>
										<br />
										<?php  echo $item['names'];?>
										<br /><?php  echo $item['tel'];?>
										<br />MID:<?php  echo $item['randnum'];?>
									</div>
								</div>
								<div class="list-inner paystyle">

									<!-- 时间信息 -->
									<span>
										<i class="icow icow-yue text-warning" style="font-size: 13px;"></i>
										<br />下单：<?php  echo $item['created'];?>
										<br /><?php  if($item['ifpay'] =='1' || $item['ifpay'] =='2' || $item['ifpay'] =='3' || $item['ifpay'] =='4' || $item['ifpay'] =='5' || $item['ifpay'] =='6') { ?>支付：

										 <?php  echo $item['paytime'];?> <?php  } ?>
								</div>

								<a class="list-inner" data-toggle='popover' data-html='true' data-placement='right' data-trigger="hover" data-content="<table style='width:100%;'>

	<tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>平台抽成：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>￥<?php  echo $item['ptmoney'];?></td>
	                                    </tr>
	                                    <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>机构抽成：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>￥<?php  echo $item['hosmoney'];?></td>
	                                    </tr>
	         <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>分销支出：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>￥<?php  echo($item['tk_one']+$item['tk_two'])?></td>
	                                    </tr>
                                         <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>优惠券抵扣：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>￥<?php  echo $item['card_dk'];?></td>
	                                    </tr>
                                                                                                                                                       <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>会员折扣：</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>￥<?php  echo $item['vip_dk'];?></td>
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
									<?php  if($item['ifpay'] =='0') { ?>
									<span class="label label-warning">待支付</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='1') { ?>
									<span class="label label-warning">已支付待接诊</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='2') { ?>
									<span class="label label-warning">已接诊</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='3') { ?>
									<span class="label label-warning">已完成待评价</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='4') { ?>
									<span class="label label-warning">已评价</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='5') { ?>
									<span class="label label-warning">申请退款</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='6') { ?>
									<span class="label label-warning">已退款</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='7') { ?>
									<span class="label label-warning">订单关闭</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='8') { ?>
									<span class="label label-warning">订单已取消</span>
									<?php  } ?>
								</div>


								<div class="" style="overflow:visible;margin-top: 40px; text-align: center;">

									<a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('green',array('id'=>$item['id'],'ac'=>'order','op'=>'order_detail','hid'=>$_SESSION['hid']))?>" title="">查看详情</a>
									<?php  if($item['ifpay'] =='0') { ?>
									<a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('green',array('id'=>$item['id'],'ac'=>'order','op'=>'changeorder','hid'=>$_SESSION['hid']))?>">确定付款</a>
                                    <?php  } ?>
                                    <?php  if($item['ifpay'] == '1' && ($item['did'] == '' || $item['did'] == '0') && ($item['z_id'] == '' || $item['z_id'] == '0')) { ?>
                                    <a class="btn btn-info btn-sm" onclick="assign('<?php  echo $item['key_words'];?>','<?php  echo $item['id'];?>')">指派服务</a>
                                    <?php  } ?>
									<a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('green',array('back_orser'=>$item['back_orser'],'ac'=>'asklist','op'=>'askchat','hid'=>$_SESSION['hid']))?>">快速回复</a>

                                     <a class="btn btn-danger btn-sm" data-toggle='ajaxRemove' href="<?php  echo $this->createWebUrl('green',array('back_orser'=>$item['back_orser'],'ac'=>'order','op'=>'del_order','hid'=>$_SESSION['hid']))?>" data-confirm="确定要删除该记录吗？">快速删除</a>

								</div>

							</div>

						</div>
                       <?php  } } ?>
					</div>
					<div class="app-table-foot clearfix">
						<div class="pull-left">
							<div id="de1" class="pull-left">
								<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">删除选中订单</a>
							</div>
						</div>
						<div class="pull-right">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php  echo $pager;?>
</form>
<div class="modal" id="myModal">
  <form action="" method="get" class="form-horizontal" role="form" id="form1">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="hyb_yl" />
    <input type="hidden" name="op" value="doassign" />
    <input type="hidden" name="ac" value="doassign" />
    <input type="hidden" name="do" value="green" />
    <input type="hidden" name="id" id="id" value="" />
    <input type="hidden" name="hid" value="<?php  echo $_SESSION['hid'];?>" />
    <input type="hidden" name="keyword" id="keyword" value="" />
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close close1" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">指派服务</h4>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">服务人员</label>
          <div class="col-sm-9">
            <div class="row row-fix tpl-category-container">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="service">
                <select class="form-control tpl-category-parent we7-select">
                  <option value="">请选择服务人员</option>
                </select>
              </div>

            </div>
          </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default close1" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary addBtn" data-dismiss="modal">确认指派</button>
          </div>
        </div>
      </div>
  </form>
</div>
</div>
  <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
<script>
function assign(keyword,id)
{
	$("#id").val(id);
	$("#keyword").val(keyword);
	var hid = $("#hid").val();
	$.ajax({
		'url':"<?php  echo $this->createWebUrl('green',array('op'=>'assign_list'))?>",
		data:{
			keyword:keyword,
			hid:hid
		},
		dataType:"json",
		type:"get",
		success:function(res){
			if(keyword == 'baogaojiaji')
			{
				var html = "<select class='form-control tpl-category-parent we7-select' name='zid'><option value=''>请选择服务人员</option>";
				for(var i=0;i<res.length;i++)
				{
					html += "<option value='"+ res[i].zid +"'>"+res[i].z_name+"</option>";
				}
			}else{
				var html = "<select class='form-control tpl-category-parent we7-select' name='did'><option value=''>请选择服务人员</option>";
				for(var i=0;i<res.length;i++)
				{
					html += "<option value='"+ res[i].id +"'>"+res[i].title+"</option>";
				}
			}
			html += "</select>";
			$("#service").html(html);
			$("#myModal").show();
		}
	})
}
 $('.close1').on('click',function(){
    $('#myModal').hide()
  
    })
    $(function(){
        require(['bootstrap'], function () {
            $("[rel=pop]").popover({
                trigger: 'manual',
                placement: 'right',
                title: $(this).data('title'),
                html: 'true',
                content: $(this).data('content'),
                animation: false
            }).on("mouseenter", function () {
                var _this = this;
                $(this).popover("show");
                $(this).siblings(".popover").on("mouseleave", function () {
                    $(_this).popover('hide');
                });
            }).on("mouseleave", function () {
                var _this = this;
                setTimeout(function () {
                    if (!$(".popover:hover").length) {
                        $(_this).popover("hide")
                    }
                }, 100);
            });
        });
    });
</script>
<script>
	var enabled = "1";
	$('#de1').delegate('.pass','click',function(e){
		e.stopPropagation();
		var back_orsers = [];
		var hid = "<?php  echo $hid;?>";
		var $checks=$('.checkbox:checkbox:checked');
		$checks.each(function() {
			if (this.checked) {
				back_orsers.push(this.value);
			};
		});
		var $this = $(this);
		var back_orsers = back_orsers;
		util.nailConfirm(this, function(state) {
		if(!state) return;
			if(enabled == 4){
				var type = 2;
			}else{
				var type = 1;
			}
			$.post("/web/index.php?c=site&a=entry&m=hyb_yl&op=del_orders&ac=order&do=green&", { back_orsers : back_orsers ,type:type,hid:hid}, function(data){
				if(!data.errno){
				util.tips("删除成功！");
				location.reload();
				}else{
				util.tips(data.message);	
				};
			}, 'json');
		}, {html: '确认删除所选订单?'});
	});
    // require(['bootstrap'], function ($) {
    //     $('[data-toggle="tooltip"]').tooltip({
    //         container: $(document.body)
    //     });
    //     $('[data-toggle="popover"]').popover({
    //         container: $(document.body)
    //     });
    //     $('[data-toggle="dropdown"]').dropdown({
    //         container: $(document.body)
    //     });
    // });
    // myrequire(['js/init']);
    //     $('.app-login-info-name, .app-login-info-sel').mouseover(function(){
    //   $('.app-login-info-sel').show();
    // });
    // $('.app-login-info-name, .app-login-info-sel').mouseout(function(){
    //   $('.app-login-info-sel').hide();
    // });
    // $('.app-login-info-sel .login-out').hover(function(){
    //   $('.app-login-info-sel-arrow').css('border-color', '#1ab394 transparent transparent transparent');
    // },function(){
    //   $('.app-login-info-sel-arrow').css('border-color', '#f2f2f2 transparent transparent transparent');
    // });
</script>