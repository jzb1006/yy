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
			<a href="javascript:;">????????????</a>
		</li>
	</ul>
<form action="" method="post" class="form-horizontal" role="form" >
	<div class="app-content">
		<div class="app-filter">
			<div class="alert alert-warning">
				??????????????????????????????????????????????????????????????????????????????
				<br />
				???????????????????????????????????????????????????????????????????????????
				<br />
			</div>
			<div class="filter-action">
				????????????:<span class="cored"><?php  echo $count_person;?></span>????????????????????????<span class="cored"><?php  echo $person_count;?></span>??????<span class="cored"><?php  echo $count_money_order;?></span>???;
			</div>
			<div class="filter-list">
				<form action="" method="post" class="form-horizontal">
					<div class="form-group" style="max-width: 1180px;">
						<label class="col-sm-2 control-label">????????????</label>
						<div class="col-sm-10">
							<div class="btn-group">
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'asklist','ifpay'=>'-1','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'pay_type'=>$pay_type,'ac'=>'asklist','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '-1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">??????</a>
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'asklist','ifpay'=>'0','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'pay_type'=>$pay_type,'ac'=>'asklist','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">?????????</a>
								
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'asklist','ifpay'=>'1','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'pay_type'=>$pay_type,'ac'=>'asklist','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">?????????</a>

								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'asklist','ifpay'=>'2','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'pay_type'=>$pay_type,'ac'=>'asklist','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">?????????</a>
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'asklist','ifpay'=>'3','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'pay_type'=>$pay_type,'ac'=>'asklist','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '3') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">?????????/?????????</a>
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'asklist','ifpay'=>'4','start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'pay_type'=>$pay_type,'ac'=>'asklist','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ifpay == '5') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">?????????</a>

							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">????????????</label>
						<div class="col-sm-9">
							<div class="btn-group">
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'asklist','ifpay'=>$ifpay,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'pay_type'=>'','ac'=>'asklist','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($pay_type == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">??????</a>
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'asklist','ifpay'=>$ifpay,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'pay_type'=>'0','ac'=>'asklist','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($pay_type == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">????????????</a>
								<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'asklist','ifpay'=>$ifpay,'start'=>$start,'end'=>$end,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'pay_type'=>'1','ac'=>'asklist','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($pay_type == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">????????????</a>
							</div>
						</div>
					</div>
					<div class="form-group form-inline">
						<label class="col-sm-2 control-label">????????????</label>
						<div class="col-sm-9">
							<select name="keywordtype" class="form-control">
								<option value="1">?????????</option>
								<option value="2">????????????</option>
								<option value="4">????????????</option>
								<option value="5">????????????</option>
							</select>
							<input type="text" name="keyword" class="form-control" value="" placeholder="??????????????????" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">????????????</label>
						<div class="col-md-3">
							<select name="timetype" class="form-control">
								<option value="">????????????</option>
								<option value="1">????????????</option>
								<option value="2">????????????</option>
							</select>
						</div>
						<div class="col-md-2">
							<?php  echo tpl_form_field_daterange('time')?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-md-9">
							<button class="btn btn-primary btn-sml J-submit-btn" type="submit" name="shaixuan">??????</button>
							<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
							<input name="hid" type="hidden" value="<?php  echo $_SESSION['hid'];?>" />
							<input type="file" id="excelUpload" class="hide" />
							<!-- 							<button class="btn btn-default min-width" >
								<i class="fa fa-download"></i><a href="<?php  echo $this->createWebUrl('ask',array('op'=>'downtw'))?>">????????????</a> 
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
							<div style='width: 400px;text-align: left;'>????????????</div>
							<div class="others">????????????</div>
							<div class="others">????????????</div>
							<div class="others">????????????</div>
							<div class="others">????????????</div>
							<div class="others">??????</div>
							<div class="others">??????</div>
						</div>
						<div class="table-row">
							<div style='height:20px;padding:0;border-top:none;'>&nbsp;</div>
						</div>
						<?php  if(is_array($res)) { foreach($res as $item) { ?>
						<div class="tables">

							<div class='table-row table-top'>
								<div style="text-align: left;color: #8f8e8e;">
									<span style="font-weight: bold;margin-right: 10px;color: #2d2d31">
										<span class="label label-info ordertype">??????</span> <?php  echo $item['time'];?>
									</span>
									???????????????<?php  echo $item['orders'];?>
								</div>
								<div class='aops text-right'>

								<!-- 	<i class="icow icow-shutDown" title="????????????" style="color: #999;margin-right: 3px;display: inline-block;vertical-align: middle"></i>
									????????????
									&nbsp -->
									</a>

								<!-- 	<a class='op' data-toggle='ajaxPost' href="/index.php?c=site&a=entry&m=hyb_yl&p=order&ac=wlOrder&do=createdisorder&id=<?php  echo $item['id'];?>&type=a" data-confirm="?????????????????????????????????">
										<i class="icow icow-shutDown" title="????????????" style="color: #999;margin-right: 3px;display: inline-block;vertical-align: middle"></i>
										??????????????????
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
													???????????????<span class="label label-primary"><?php  echo $item['host']['agentname'];?></span>

													<span style="color: #999"> </span>
												</div>
											</div>
											<span style="float: right;text-align: right;display: inline-block;width:130px;">
												??????????????????<?php  echo $item['ptmoneys'];?>
												<br />
												x<?php  echo $item['countarr'];?> </span>
										</div>
									</div>
								</div>

								<div class="list-inner saler" style='text-align: center;'>
									<div>
										<a href="/index.php?c=site&a=entry&op=adduser&do=copysite&m=hyb_yl&act=profile.adduser&ac=notice&u_id=<?php  echo $item['u_id'];?>&hid=<?php  echo $_SESSION['hid'];?>">
											<?php  echo $item['u_name'];?></a>
										<br />
										<?php  echo $item['names'];?>
										<br /><?php  echo $item['tel'];?>
										<br />MID:<?php  echo $item['randnum'];?>
									</div>
								</div>
								<div class="list-inner paystyle" style='text-align:center;'>

									<!-- ????????? -->
									<span>
										<i class="icow icow-yue text-warning" style="font-size: 17px;"></i>
										<span>????????????</span>
									</span>
								</div>
								<div class="list-inner paystyle">

									<!-- ???????????? -->
									<span>
										<i class="icow icow-yue text-warning" style="font-size: 13px;"></i>
										<br />?????????<?php  echo $item['xdtime'];?>
										<br />?????????
										<?php  if($item['ifpay'] =='1' || $item['ifpay'] =='2' || $item['ifpay'] =='3' || $item['ifpay'] =='4' || $item['ifpay'] =='5' || $item['ifpay'] =='6') { ?> <?php  echo $item['paytime'];?> <?php  } else if($item['ifgb'] =='1') { ?> [<?php  if($item['ifpay']=='1') { ?>?????????<?php  } else { ?>?????????<?php  } ?>]???????????? <?php  } else { ?>????????? <?php  } ?>
								</div>

								<a class="list-inner" data-toggle='popover' data-html='true' data-placement='right' data-trigger="hover" data-content="<table style='width:100%;'>
 <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>???????????????</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-???<?php  echo $item['ptmoney'];?></td>
	                                    </tr>
	                                    <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>???????????????</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-???<?php  echo $item['hosmoney'];?></td>
	                                    </tr>
	         <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>???????????????</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-???<?php  echo $item['tk_one'] + $item['tk_two']?></td>
	                                    </tr>
                                         <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>??????????????????</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-???<?php  echo $item['coupon_dk'];?></td>
	                                    </tr>
	                                    <tr>
	                                        <td style='border:none;text-align:right;padding: 5px!important;'>???????????????</td>
	                                        <td  style='border:none;text-align:right;color:green;padding: 5px!important;'>-???<?php  echo $item['card_dk']?></td>
	                                    </tr>
                                                                                                                                                       <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>???????????????</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-???<?php  echo $item['year_dk'];?></td>
	                                    </tr>                                  	                                    
	                                    <tr>
	                                        <td style='border:none;text-align:right;padding: 5px!important;'>????????????</td>
	                                        <td  style='border:none;text-align:right;color:green;padding: 5px!important;'>???<?php  echo $item['moneyss'];?></td>
	                                    </tr>
	
	                                </table>
	                            ">
									<div style='text-align:center'>
										???<?php  echo $item['moneyss'];?> </div>
								</a>




								<div class="list-inner" style='text-align:center'>
									<?php  if($item['ifpay'] =='0') { ?>
									<span class="label label-warning">?????????</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='1') { ?>
									<span class="label label-warning">??????????????????</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='3') { ?>
									<span class="label label-warning">??????????????????</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='4') { ?>
									<span class="label label-warning">?????????</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='5') { ?>
									<span class="label label-warning">????????????</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='6') { ?>
									<span class="label label-warning">?????????</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='7') { ?>
									<span class="label label-warning">????????????</span>
									<?php  } ?>
									<?php  if($item['ifpay'] =='8') { ?>
									<span class="label label-warning">???????????????</span>
									<?php  } ?>
								</div>


								<div class="" style="overflow:visible;margin-top: 40px; text-align: center;">

									<a class="btn btn-primary btn-sm" href="/index.php?c=site&a=entry&do=ask&op=askdetails&ac=asklist&m=hyb_yl&id=<?php  echo $item['id'];?>&hid=<?php  echo $_SESSION['hid'];?>" title="">????????????</a>
									<?php  if($item['ifpay'] =='0') { ?>
									<a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('ask',array('id'=>$item['id'],'ac'=>'asklist','op'=>'enterorder','hid'=>$_SESSION['hid']))?>">????????????</a>
                                    <?php  } ?>
									<a class="btn btn-info btn-sm" href="/index.php?c=site&a=entry&do=ask&op=askchat&ac=asklist&m=hyb_yl&back_orser=<?php  echo $item['back_orser'];?>&hid=<?php  echo $_SESSION['hid'];?>">????????????</a>

                                     <a class="btn btn-danger btn-sm" data-toggle='ajaxRemove' href="/index.php?c=site&a=entry&do=ask&op=deletetuwen&ac=asklist&m=hyb_yl&back_orser=<?php  echo $item['back_orser'];?>&hid=<?php  echo $_SESSION['hid'];?>" data-confirm="??????????????????????????????">????????????</a>

								</div>

							</div>

						</div>
                       <?php  } } ?>
					</div>
					<div class="app-table-foot clearfix">
			            <div class="pull-left">
			                <div class="pull-left" id="de1">
			                    <label class="btn btn-default min-width " style="display: inline-flex;align-items:center;margin-right:1rem;">
			                        <input type="checkbox" name="checkbox" value="" id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
			                        <div style="margin-left: 10px">??????</div>
			                    </label>
			                    <a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">????????????</a>
			                </div>
			            </div>
			            <div class="pull-right"><?php  echo $pager;?></div>
			        </div>
				</div>
			</div>
		</div>
	</div>

</form>

</div>
  <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
<script>
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
		var url="../web/index.php?c=site&a=entry&m=hyb_yl&op=del_asklists&ac=asklist&do=ask&ids="+ids;
				console.log(ids);
		util.nailConfirm(this, function(state) {
		if(!state) return;
			if(enabled == 4){
				var type = 2;
			}else{
				var type = 1;
			}

			$.post("../web/index.php?c=site&a=entry&m=hyb_yl&op=del_asklists&ac=asklist&do=ask&", { ids : ids ,type:type}, function(data){
			
				if(data.errno=='1'){ 
                    util.tips("???????????????");
                    setTimeout(function(){ 
                        window.location.reload();
                    }, 1000);
                }else{
                    util.tips("????????????");  
                };
			}, 'json');
		}, {html: '?????????????????????????'});
	});
</script>