<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
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
				.table-footer>div, .table-top>div{-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;height:100%;}
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
	<div class="app-content">
		<div class="app-filter">
			<div class="alert alert-warning">
				?????????????????????????????????????????????????????????????????????
				<br />
				?????????????????????????????????????????????????????????????????????????????????????????????????????????
				<br />
				??????????????????????????????????????????????????????????????????

			</div>
			<div class="filter-action">
				????????????:<span class="cored"><?php  echo $zhuangjia_count;?></span>????????????????????????<span class="cored"><?php  echo $fuwu_count;?></span>??????<span class="cored"><?php  echo $fuwu_money;?></span>???;
			</div>
			<div class="filter-list">
				<form action="" method="post" class="form-horizontal" role="form" id="form1">
					<div class="form-group" style="max-width:1180px;">
						<label class="col-sm-2 control-label">????????????</label>
						<div class="col-sm-10">
							<div class="btn-group">
								<a href="<?php  echo $this->createWebUrl('team',array('op'=>'serviceboxlog','type'=>'','pay_type'=>$pay_type,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($type == '') { ?> btn-primary <?php  } else { ?>  btn-default <?php  } ?>">??????</a>
								<?php  if(is_array($type_arr)) { foreach($type_arr as $typs) { ?>
								<a href="<?php  echo $this->createWebUrl('team',array('op'=>'serviceboxlog','type'=>$typs['typeid'],'pay_type'=>$pay_type,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($type == $typs['typeid']) { ?> btn-primary <?php  } else { ?>  btn-default <?php  } ?>"><?php  echo $typs['title'];?></a>
								<?php  } } ?>
							</div>
						</div>
					</div>
<!-- 					<div class="form-group">
						<label class="col-sm-2 control-label">????????????</label>
						<div class="col-sm-9">
							<div class="btn-group">

								<a href="<?php  echo $this->createWebUrl('team',array('op'=>'serviceboxlog','type'=>$type,'pay_type'=>'0','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end))?>" class="btn <?php  if($pay_type == '0') { ?> btn-primary <?php  } else { ?>  btn-default <?php  } ?>">????????????</a>
								<a href="<?php  echo $this->createWebUrl('team',array('op'=>'serviceboxlog','type'=>$type,'pay_type'=>'1','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end))?>" class="btn <?php  if($pay_type == '1') { ?> btn-primary <?php  } else { ?>  btn-default <?php  } ?>">????????????</a>
							</div>
						</div>
					</div> -->
					<div class="form-group form-inline">
						<label class="col-sm-2 control-label">????????????</label>
						<div class="col-sm-9">
							<select name="keywordtype" class="form-control">
								<option value="" <?php  if($keywordtype=='' ) { ?> selected="" <?php  } ?>>???????????? </option>
								<option value="1" <?php  if($keywordtype=='1' ) { ?> selected="" <?php  } ?>>????????? </option>
								<option value="2" <?php  if($keywordtype=='2' ) { ?> selected="" <?php  } ?>>???????????? </option>
							</select>
							<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="??????????????????" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">????????????</label>

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
												$(elm).find(".date-title").html(start.toDateStr() + " ??? " + end.toDateStr());
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
								<span class="date-title"><?php  echo $start;?> ??? <?php  echo $end;?></span>
								<i class="fa fa-calendar"></i>
							</button>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-md-9">
							<button class="btn btn-primary btn-sml J-submit-btn" type="submit" name="shaixuan">??????</button>
							<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
							<input type="file" id="excelUpload" class="hide" />
							<!-- 							<button class="btn btn-default min-width" name="export" type="submit" value="export">
								<i class="fa fa-download"></i> ????????????
							</button> -->
						</div>
					</div>
				</form>
			</div>

				<div class="app-table-list">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<div class="table-header">
									<div style="width:5%;">
			                            <input type="checkbox" name="checkbox"  id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
			                        </div>
									<div style='width: 400px;text-align: left;'>???????????????</div>
									<div class="others">??????</div>
									<div class="others">????????????</div>
									<div class="others">??????</div>
									<div class="others">??????</div>
									<div class="others">??????</div>
								</div>

								 <tbody>
								<?php  if(is_array($list)) { foreach($list as $item) { ?>
								<tr>
								<div class="table-row">
									<div style='height:20px;padding:0;border-top:none;'>&nbsp;</div>
								</div>
								<div class="tables">

									<div class='table-row table-top'>
										<div style="text-align: left;color: #8f8e8e;">
											<span style="font-weight: bold;margin-right: 10px;color: #2d2d31">
												<span class="label label-info ordertype">?????????</span> <?php  echo $item['time'];?>
											</span>
											???????????????<?php  echo $item['orders'];?>&nbsp;&nbsp;
										</div>

									</div>
									<div class='table-row' style="margin:0  20px">
										<div class="list-inner saler item" style='text-align: center;width:40px'>
			                            	<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['ids'];?>"  />
			                        	</div>
										<div class="goods-des">
											<div style="display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;margin: 10px 0">
												<img src="<?php  echo  tomedia($item['thumb']) ?>" style='width:70px;height:70px;border:1px solid #efefef; padding:1px;' onerror="this.src='<?php  echo  tomedia($item['thumb'])?>'">
												<div style="-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;margin-left: 10px;text-align: left;display: flex;align-items: center">
													<div>
														<div class="title">
															??????<?php  echo $item['titlme'];?>??????

															<span style="color: #999"> </span>
														</div>
													</div>
													<span style="float: right;text-align: right;display: inline-block;width:130px;">
														???<?php  echo $item['money'];?>
														<br />
														x1 </span>
												</div>
											</div>
										</div>
										
										<div class="list-inner saler" style='text-align: center;'>
											<div>
												<a href="<?php  echo $this->createWebUrl('team',array('op'=>'edit','zid'=>$item['zid'],'hid'=>$_SESSION['hid']))?>"> <?php  echo $item['zhizheng'];?></a>
												<br />
												<?php  echo $item['z_name'];?>
												<br /><?php  echo $item['z_telephone'];?>
												<br />TID:<?php  echo $item['zid'];?>
											</div>
										</div>
										<div class="list-inner paystyle" style='text-align:center;'>

											<!-- ????????? -->

											<span>
												<i class="icow icow-yue text-warning" style="font-size: 17px;"></i>
												<span>
													<?php  if($item['kt_type']=='1') { ?>
													????????????
													<?php  } else { ?>
													????????????
													<?php  } ?>
												</span>
											</span>
										</div>

										<a class="list-inner" data-toggle='popover' data-html='true' data-placement='right' data-trigger="hover" data-content="<table style='width:100%;'>
	                                    <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>??????????????????</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>???<?php  echo $item['money'];?></td>
	                                    </tr>
	                                    <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>?????????</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'><?php  echo $item['ltime_leng'];?>???</td>
	                                    </tr> 
	                                    	                                    	                                    	                                    	                                    <tr>
	                                        <td style='border:none;text-align:right;padding: 5px!important;'>????????????</td>
	                                        <td  style='border:none;text-align:right;color:green;padding: 5px!important;'>???<?php  echo $item['money'];?></td>
	                                    </tr>
	
	                                </table>
	                    ">
											<div style='text-align:center'>
												???<?php  echo $item['money'];?> </div>
										</a>
										<div class="list-inner" style='text-align:center'>
											???????????????<?php  echo $item['time'];?>
											</br>???????????????<?php  echo date('Y-m-d H:i:s',$item['overtime'])?>
										</div>


										<div class="" style="overflow:visible;margin-top: 40px; text-align: center;">

											<a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('team',array('op'=>'serviceboxdetail','ids'=>$item['ids'],'ac'=>'serviceboxlog','hid'=>$_SESSION['hid']))?>" title="">????????????</a>

											<a class="btn btn-danger btn-sm" data-toggle="ajaxRemove" href="<?php  echo $this->createWebUrl('team',array('op'=>'serviceboxdel','ids'=>$item['ids'],'ac'=>'serviceboxlog','hid'=>$_SESSION['hid']))?>" data-confirm="?????????????????????????????????????????????????????????">????????????</a>
										</div>
									</div>
								</div>
								<?php  } } ?>
								</tr>
                              </tbody>
							</div>
							
						</div>
						<div class="app-table-foot clearfix">
				            <div class="pull-left">
				                <div class="pull-left" id="de1">
				                    <label class="btn btn-default min-width " style="display: inline-flex;align-items:center;margin-right:1rem;">
				                        <input type="checkbox" name="checkbox" value="" id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
				                        <div style="margin-left: 10px">??????</div>
				                    </label>
				                    <a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_delete">????????????</a>
				                </div>
				            </div>
				            <div class="pull-right"><?php  echo $pager;?></div>
				        </div>
					</div>
				</div>
		
		</div>
	</div>
</div>
</div>
</body>
</html>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>
<script>
myrequire(['/js/tip']);
        var div = $(".tables")
        batch = $('[data-toggle^="batch"]')
        console.log(div.length)
        if (div.length > 0) {

        $(document).on("click", '[data-toggle="ajaxRemove"]', function (e) { //?????????
                    e.preventDefault();
                    var obj = $(this), url = obj.attr('href') || obj.data('href') || obj.data('url'), confirm = obj.data('msg') || obj.data('confirm');

                    var submit = function () {

                        obj.html('<i class="fa fa-spinner fa-spin"></i> ' + tip.lang.processing);
                        $.post(url).done(function (data) {
                             
                            data = eval("(" + data + ")");
                             
                            if (data.status == 1) {
                               window.location.reload()
                            }
                            else {
                                obj.button('reset'), tip.msgbox.err(data.result.message || tip.lang.error, data.result.url);
                            }
                        }).fail(function () {
                            obj.button('reset');
                            tip.msgbox.err(tip.lang.exception);
                        })
                    };

                    if (confirm) {
                        tip.confirm(confirm, submit, function () {
                            obj.removeAttr("disabled", "disabled");
                             
                        });

                    } else {
                    	
                        submit();
                    }

                });
        }else {
			batch.attr("disabled", "disabled");
		}

</script> 
<script type="text/javascript">
    // ????????????
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
        console.log(ids);
        util.nailConfirm(this, function(state) {console.log(state)
        if(!state)  return;
            $.post("./index.php?c=site&a=entry&do=team&op=del_serviceboxlogs&ac=serviceboxlog&m=hyb_yl", { ids : ids }, function(data){
                if(data.errno=='1'){ 
                    util.tips("???????????????");
                    setTimeout(function(){ 
                        window.location.reload();
                    }, 1000);
                }else{
                    util.tips("????????????");  
                };
            }, 'json');
        }, {html: '???????????????????'});
    });
</script>