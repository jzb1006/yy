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
	<li class="active"><a href="javascript:;">????????????</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
        <div class="alert alert-warning">
        ??????????????????????????????????????????????????????????????????????????????<br />
        ??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????<br />
        </div>
		<div class="filter-action">
			????????????:<span class="cored"><?php  echo $count;?></span>??????????????????????????????<span class="cored"><?php  echo $count;?></span>??????<span class="cored"><?php  echo $money;?></span>???;
		</div>
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="op" value="operativeask" />
				<input type="hidden" name="ac" value="operativeask" />
				<input type="hidden" name="do" value="ask" />
				<input type="hidden" name="fightgroupid" value="" />
				<input type="hidden" name="hid" value="<?php  echo $_SESSION['hid'];?>" />
				<div class="form-group" style="max-width: 1180px;">
					<label class="col-sm-2 control-label">????????????</label>
					<div class="col-sm-10">
						<div class="btn-group">
							<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'operativeask','ac'=>'operativeask','ispay'=>'','keywordtype'=>$keywordtype,'keyword'=>$keyword,'timetype'=>$timetype,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">??????</a>
							<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'operativeask','ac'=>'operativeask','ispay'=>'0','keywordtype'=>$keywordtype,'keyword'=>$keyword,'timetype'=>$timetype,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">?????????</a>
							<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'operativeask','ac'=>'operativeask','ispay'=>'1','keywordtype'=>$keywordtype,'keyword'=>$keyword,'timetype'=>$timetype,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">?????????</a>
							<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'operativeask','ac'=>'operativeask','ispay'=>'2','keywordtype'=>$keywordtype,'keyword'=>$keyword,'timetype'=>$timetype,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">?????????</a>
							<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'operativeask','ac'=>'operativeask','ispay'=>'3','keywordtype'=>$keywordtype,'keyword'=>$keyword,'timetype'=>$timetype,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '3') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">????????????</a>
							<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'operativeask','ac'=>'operativeask','ispay'=>'4','keywordtype'=>$keywordtype,'keyword'=>$keyword,'timetype'=>$timetype,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '4') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">????????????</a>
							<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'operativeask','ac'=>'operativeask','ispay'=>'5','keywordtype'=>$keywordtype,'keyword'=>$keyword,'timetype'=>$timetype,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '5') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">????????????</a>
							<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'operativeask','ac'=>'operativeask','ispay'=>'6','keywordtype'=>$keywordtype,'keyword'=>$keyword,'timetype'=>$timetype,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '6') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">?????????</a>
							<a href="<?php  echo $this->createWebUrl('ask',array('op'=>'operativeask','ac'=>'operativeask','ispay'=>'7','keywordtype'=>$keywordtype,'keyword'=>$keyword,'timetype'=>$timetype,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '7') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">?????????</a>
						
						</div>
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-sm-2 control-label">????????????</label>
					<div class="col-sm-9">
						<div class="btn-group">
							<a href="#" class="btn btn-primary">??????</a>
							<a href="#" class="btn btn-default">????????????</a>
							<a href="#" class="btn btn-default">????????????</a>
						</div>
					</div>
				</div> -->
				<div class="form-group form-inline">
					<label class="col-sm-2 control-label">????????????</label>
					<div class="col-sm-9">
						<select name="keywordtype" class="form-control">
							<option value="" >????????????</option>
							<option value="1" <?php  if($keywordtype == '1') { ?> selected="" <?php  } ?>>?????????</option>
							<option value="2" <?php  if($keywordtype == '2') { ?> selected="" <?php  } ?>>????????????</option>
							<option value="3" <?php  if($keywordtype == '3') { ?> selected="" <?php  } ?>>????????????</option>
							<option value="4" <?php  if($keywordtype == '4') { ?> selected="" <?php  } ?>>????????????</option>
						</select>
						<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>"  placeholder="??????????????????"/>
	                </div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">????????????</label>
					<div class="col-md-3">
						<select name="timetype" class="form-control">
							<option value="">????????????</option>
							<option value="1" <?php  if($timetype == '1') { ?> selected="" <?php  } ?>>????????????</option>
							<option value="2" <?php  if($timetype == '2') { ?> selected="" <?php  } ?>>????????????</option>
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
	<button class="btn btn-default daterange daterange-date" type="button"><span class="date-title"><?php  echo $start;?> ??? <?php  echo $end;?></span> <i class="fa fa-calendar"></i></button>
						</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-md-9">
						<button class="btn btn-primary" id="search">??????</button>
                        <input type="file" id="excelUpload" class="hide"/>
						<button class="btn btn-default min-width" name="export" type="submit" value="export"><i class="fa fa-download"></i>  <a href="<?php  echo $this->createWebUrl('ask',array('op'=>'export','ac'=>'operativeask','ispay'=>$ispay,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'timetype'=>$timetype,'start'=>$start,'end'=>$end,'key_words'=>'shoushukuaiyue','hid'=>$_SESSION['hid']))?>">????????????</a></button>
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
	                <?php  if(is_array($list)) { foreach($list as $item) { ?>
	            		            	<div class="table-row"><div style='height:20px;padding:0;border-top:none;'>&nbsp;</div></div>
	                <div class="tables">
	                    <div class='table-row table-top'>
	                        <div style="text-align: left;color: #8f8e8e;">
	                            <span style="font-weight: bold;margin-right: 10px;color: #2d2d31">
	                                <span class="label label-info ordertype">??????</span> <?php  echo $item['time'];?>	                            </span>
	                                                        ???????????????<?php  echo $item['orders'];?>&nbsp;&nbsp;
	                        </div>
	                        <div class='aops text-right'>

	                                    <i class="icow icow-shutDown" title="????????????"  style="color: #999;margin-right: 3px;display: inline-block;vertical-align: middle"></i>
	                                    
	                                    <?php  if($item['ifpay'] == '0') { ?>
	                                   	 ?????????
	                                   	<?php  } else if($item['ifpay'] == '1') { ?>
	                                   	??????????????????
	                                   	<?php  } else if($item['ifpay'] == '2') { ?>
	                                   	?????????
	                                   	<?php  } else if($item['ifpay'] == '3') { ?>
	                                   	??????????????????
	                                   	<?php  } else if($item['ifpay'] == '4') { ?>
	                                   	?????????
	                                   	<?php  } else if($item['ifpay'] == '5') { ?>
	                                   	????????????
	                                   	<?php  } else if($item['ifpay'] == '6') { ?>
	                                   	????????????
	                                   	<?php  } else if($item['ifpay'] == '7') { ?>
	                                   	????????????
	                                   	<?php  } ?>
	                                    &nbsp
                                 
                              <!--   <a class='op'  data-toggle='ajaxPost' href="https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=hyb_yl&p=order&ac=wlOrder&do=createdisorder&id=289&type=a" data-confirm="?????????????????????????????????" >
	                                    <i class="icow icow-shutDown" title="????????????"  style="color: #999;margin-right: 3px;display: inline-block;vertical-align: middle"></i>
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
	                                <img src="<?php  echo $item['advertisement'];?>" style='width:70px;height:70px;border:1px solid #efefef; padding:1px;'onerror="this.src='<?php  echo $item['advertisement'];?>'">
	                                <div style="-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;margin-left: 10px;text-align: left;display: flex;align-items: center">
	                                    <div>
	                                       <div class="title">
	                                           <?php  echo $item['z_name'];?>&nbsp<label class="label label-success"><?php  echo $item['keshi'];?></label> <span class="label label-warning"><?php  echo $item['zhicheng'];?></span><br/>
											 <br/>
                                             ???????????????<span class="label label-primary"><?php  echo $item['jigou'];?></span>
                                               
	                                           <span style="color: #999"> </span>
	                                       	</div>
	                                    </div>
	                                    <span style="float: right;text-align: right;display: inline-block;width:130px;">
	                                                                                ??????????????????<?php  echo $item['ptmoneys'];?><br/>
	                                    	x1	                                    </span>
	                                </div>
	                            </div>
	                        </div>
	
	                        <div class="list-inner saler" style='text-align: center;' >
	                            <div>
	                                <a  href="/index.php?c=site&a=entry&op=adduser&do=copysite&m=hyb_yl&act=profile.adduser&ac=notice&u_id=<?php  echo $item['u_id'];?>&hid=<?php  echo $_SESSION['hid'];?>"  > <?php  echo $item['u_name'];?></a>
	                                <br/>
	                                <?php  echo $item['names'];?><br/><?php  echo $item['tel'];?><br/>MID:<?php  echo $item['u_id'];?>	                            </div>
	                        </div>
	                        <div class="list-inner paystyle" style='text-align:center;' >
	
	                            <!-- ????????? -->
	                                   <span> <i class="icow icow-yue text-warning" style="font-size: 17px;"></i><span>????????????</span></span>
	                        </div>
	 						<div class="list-inner paystyle"  >
	
	                            <!-- ???????????? -->
	                         <span> <i class="icow icow-yue text-warning" style="font-size: 13px;"></i><span>

	                         ?????????<?php  echo $item['time'];?><span></span>
                                <br/>
                                
                               <?php  if($item['ifpay'] == '1') { ?>
                            ?????????<?php  echo $item['paytime'];?>
                            <?php  } else if($item['ifpay'] == '2') { ?>
                             <br/>?????????<?php  echo $item['jz_time'];?>
	                                	                            	                        
                            <?php  } ?>
							</div>
	                        <a class="list-inner" data-toggle='popover' data-html='true' data-placement='right' data-trigger="hover" data-content="<table style='width:100%;'>
 								<td  style='border:none;text-align:right;padding: 5px!important;'>???????????????</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-???<?php  echo $item['ptmoney'];?></td>
	                                    </tr>
	                                    <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>???????????????</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-???<?php  echo $item['hosmoney'];?></td>
	                                    </tr>
	         <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>???????????????</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-???<?php  echo $item['tk_one']+$item['tk_two']?></td>
	                                    </tr>
                                         <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>??????????????????</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-???<?php  echo $item['coupon_dk'];?></td>
	                                    </tr>
	                                    <tr>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>???????????????</td>
	                                        <td  style='border:none;text-align:right;padding: 5px!important;'>-???<?php  echo $item['card_dk'];?></td>
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
	                        	<div style='text-align:center' >
	                                ???<?php  echo $item['moneyss'];?>
	                            </div>
	                        </a>
	                        <div  class="list-inner"  style='text-align:center' >
	                          <span class="label label-warning">
	                          <?php  if($item['ifpay'] == '0') { ?>
	                          ?????????
	                          <?php  } else if($item['ifpay'] == '1') { ?>
	                          ??????????????????
	                          <?php  } else if($item['ifpay'] == '2') { ?>
	                          ?????????
	                          <?php  } else if($item['ifpay'] == '3') { ?>
	                          ??????????????????
	                          <?php  } else if($item['ifpay'] == '4') { ?>
	                          ?????????
	                          <?php  } else if($item['ifpay'] == '5') { ?>
	                          ????????????
	                          <?php  } else if($item['ifpay'] == '6') { ?>
	                          ????????????
	                          <?php  } else if($item['ifpay'] == '7') { ?>
	                          ????????????
	                          <?php  } ?>
	                          </span>
							</div>
	                      <div class="" style="overflow:visible;margin-top: 40px; text-align: center;">
		                       <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('ask',array('id'=>$item['id'],'ac'=>'operativeaskdetails','op'=>'operativeaskdetails','hid'=>$_SESSION['hid']))?>" title="">????????????</a>
		                       <?php  if($item['ifpay'] == '0') { ?>
	                            <a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('ask',array('back_orser'=>$item['back_orser'],'ifpay'=>'1','ac'=>'operativeaskpay','op'=>'operativeaskpay','hid'=>$_SESSION['hid']))?>">????????????</a>
	                            <?php  } ?>
	                         <a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('ask',array('back_orser'=>$item['back_orser'],'keyword'=>'shoushukuaiyue','ac'=>'askchat','op'=>'askchat','hid'=>$_SESSION['hid']))?>">????????????</a>
	                            <a class="btn btn-danger btn-sm" data-toggle="ajaxRemove" href="<?php  echo $this->createWebUrl('ask',array('back_orser'=>$item['back_orser'],'ac'=>'operativeaskdetails','op'=>'operativeaskdel','hid'=>$_SESSION['hid']))?>" data-confirm="??????????????????????????????">????????????</a>
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
	</div>
	<div class="foot" id="footer">
		<ul class="links ft">
            <li class="links_item"><div class="copyright">Powered by <a href="http://www.we7.cc"><b>??????</b></a> v2.0.4 ?? 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a></div></li>
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
		var url="../web/index.php?c=site&a=entry&m=hyb_yl&op=del_telasks&ac=squareak&do=ask&ids="+ids;
				console.log(ids);
		util.nailConfirm(this, function(state) {
		if(!state) return;
			if(enabled == 4){
				var type = 2;
			}else{
				var type = 1;
			}

			$.post("../web/index.php?c=site&a=entry&m=hyb_yl&op=del_telasks&ac=squareak&do=ask&", { ids : ids ,type:type}, function(data){
			
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
	</body>
</html>
