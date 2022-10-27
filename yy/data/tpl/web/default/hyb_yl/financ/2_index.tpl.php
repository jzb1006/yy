<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
			<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li class="active"><a href="">账单明细</a></li>
</ul>
<div class="app-content">
    <div class="app-filter">
        <div class="filter-list">
            <form action="" method="post" class="form-horizontal" role="form" id="form1">
                <input type="hidden" name="c" value="site" />
	            <input type="hidden" name="a" value="entry" />
	            <input type="hidden" name="m" value="hyb_yl" />
	            <input type="hidden" name="op" value="index" />
				<input type="hidden" name="ac" value="cashrecord" />
				<input type="hidden" name="do" value="financ" />
                <input type="hidden" name="hid" value="$_SESSION['hid']" />
                <div class="form-group max-with-all">
                    <label class="col-sm-2 control-label">结算类型</label>
                    <div class="col-sm-9">
                        <div class="btn-group">
                            <?php  if(is_array($type_arr)) { foreach($type_arr as $typs) { ?>
							<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'index','ac'=>'cashrecord','key_words'=>$typs['key_words'],'title'=>$typs['ftitle'],'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($key_words == $typs['key_words']) { ?> btn-primary <?php  } else { ?> btn-default<?php  } ?>"><?php  echo $typs['ftitle'];?></a>
                            <?php  } } ?>
						</div>
                    </div>
                </div>
                <div class="form-group form-inline">
                    <label class="col-sm-2 control-label">搜索内容</label>
                    <div class="col-sm-9">
                    	<select name="keywordtype" class="form-control">
                            <option value="">关键字类型</option>
                            <option value="1" <?php  if($keywordtype == '1') { ?> selected="" <?php  } ?>>专家(商品)名称</option>
                            <option value="2" <?php  if($keywordtype == '2') { ?> selected="" <?php  } ?>>订单编号</option>
                            
                        </select>
                        <input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>"  placeholder="请输入关键字"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">时间段</label>
                    <div class="col-sm-9">
                        
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
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-md-9">
                            <button class="btn btn-primary btn-sml J-submit-btn" type="submit" name="shaixuan">筛选</button>
                            <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                            <input name="hid" type="hidden" value="<?php  echo $_SESSION['hid'];?>" />
                            <input type="file" id="excelUpload" class="hide" />
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="app-table-list">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                    	<th>订单编号</th>
                        <th>订单类型</th>
                        <!-- <th>费用信息</th> -->
                        <th>订单总金额</th>
                        <th>专家名称</th>
                        <th>订单状态</th>
                        <!-- <th>机构收入</th> -->
                        <th>结算时间</th>
                        <!-- <th>操作</th> -->
                    </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                        	<td>
	                            <?php  echo $item['back_orser'];?>                           </td>
                            <td>
	                            <span class="label label-info"><?php  echo $ftitle;?></span>
                            </td>
                            
                            <td>
	                         ￥<?php  echo $item['money'];?>	<?php  echo $item['totals'];?>
                             </td>
                             <td>
                                <p><?php  echo $item['z_name'];?></p>
                              </td>
                              <td>
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
                                    <?php  if($item['ispay'] =='0') { ?>
                                    <span class="label label-warning">待支付</span>
                                    <?php  } ?>
                                    <?php  if($item['ispay'] =='1') { ?>
                                    <span class="label label-warning">已支付待接诊</span>
                                    <?php  } ?>
                                    <?php  if($item['ispay'] =='2') { ?>
                                    <span class="label label-warning">已接诊</span>
                                    <?php  } ?>
                                    <?php  if($item['ispay'] =='3') { ?>
                                    <span class="label label-warning">已完成待评价</span>
                                    <?php  } ?>
                                    <?php  if($item['ispay'] =='4') { ?>
                                    <span class="label label-warning">已评价</span>
                                    <?php  } ?>
                                    <?php  if($item['ispay'] =='5') { ?>
                                    <span class="label label-warning">申请退款</span>
                                    <?php  } ?>
                                    <?php  if($item['ispay'] =='6') { ?>
                                    <span class="label label-warning">已退款</span>
                                    <?php  } ?>
                                    <?php  if($item['ispay'] =='7') { ?>
                                    <span class="label label-warning">订单关闭</span>
                                    <?php  } ?>

                              </td>
                            <!-- <td>
                                0.00	                                                        </td>
                            <td>
	                            +0.00<br/>
	                            +0.00                            </td>
                            <td>
	                            <span style="color: orangered ;"> +2.00</span><br />
	                            <span style="color: goldenrod;">(0.00)</span>
                            </td> -->
                            <td>
                            	<?php  echo $item['time'];?>                            </td>
                            <!-- <td>
                            	<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'order_detail','ac'=>'cashrecord','id'=>$item['id']))?>" class="btn btn-default btn-sm">查看订单</a>
                            </td> -->
                        </tr>
                        <?php  } } ?>                
                    </tbody>
            </table>
            <?php  echo $pager;?>
        </div>
        <div class="app-table-foot clearfix">
            <div class="pull-left">

            </div>
            <div class="pull-right">
                            </div>
        </div>
    </div>
</div>
			</div>
		</div>
	</div>
	<div class="foot" id="footer">
		<ul class="links ft">
            <li class="links_item"><div class="copyright">Powered by <a href="http://www.we7.cc"><b>系统</b></a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a></div></li>
		</ul>
	</div>
	</body>
</html>

