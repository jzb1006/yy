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
	<li class="active"><a href="javascript:;">开通记录</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
        <div class="alert alert-warning">
            注意一：这里是医生团队开通服务包的记录以及续费记录<br />
            注意二：只有开通该服务包类型的团队，才拥有向用户设置该服务包费用的权益<br />
            注意三：一旦开通，平台将不会退款改服务项的钱
            注意四：团队开通服务包后，所获收益平台不会对团队的收益进行抽成，但提现时会扣除提现手续费
        </div>
		<div class="filter-action">
			当前团队:<span class="cored"><?php  echo $team;?></span>个，共计开通服务<span class="cored"><?php  echo $count;?></span>单，<span class="cored"><?php  echo $money;?></span>元;
		</div>
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="op" value="fwblist" />
				<input type="hidden" name="ac" value="fwblist" />
				<input type="hidden" name="do" value="sign" />
        <input type="hidden" name="hid" value="<?php  echo $_SESSION['hid'];?>" />
				<div class="form-group" style="max-width: 1180px;">
					<label class="col-sm-2 control-label">开通类型</label>
					<div class="col-sm-10">
						<div class="btn-group">
							<a href="<?php  echo $this->createWebUrl('sign',array('op'=>'fwblist','ac'=>'fwblist','bid'=>'','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if('' == $bid) { ?> btn-primary<?php  } else { ?> btn-default <?php  } ?>">不限</a>
							<?php  if(is_array($fw_list)) { foreach($fw_list as $fw) { ?>

							<a href="<?php  echo $this->createWebUrl('sign',array('op'=>'fwblist','ac'=>'fwblist','bid'=>$fw['id'],'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'hid'=>$_SESSION['hid']))?>" class="btn <?php  if($fw['id'] == $bid) { ?> btn-primary<?php  } else { ?> btn-default <?php  } ?>"><?php  echo $fw['titlme'];?></a>
							<?php  } } ?>
						</div>
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-sm-2 control-label">支付方式</label>
					<div class="col-sm-9">
						<div class="btn-group">
							
							<a href="#" class="btn btn-default">微信支付</a>
							<a href="#" class="btn btn-default">线下汇款</a>
						</div>
					</div>
				</div> -->
				<div class="form-group form-inline">
					<label class="col-sm-2 control-label">订单搜索</label>
					<div class="col-sm-9">
						<select name="keywordtype" class="form-control">
							<option value="" >订单搜索</option>
							<option value="1" <?php  if($keywordtype == '1') { ?> selected="" <?php  } ?>>订单号</option>
							<option value="2" <?php  if($keywordtype == '2') { ?> selected="" <?php  } ?>>团队名称</option>
						</select>
						<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>"  placeholder="请输入关键字"/>
	                </div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">时间筛选</label>
					<!-- <div class="col-md-3">
						<select name="timetype" class="form-control">
							<option value="">时间类型</option>
							<option value="1" >开通时间</option>
						</select>
                    </div> -->
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
	<button class="btn btn-default daterange daterange-date" type="button"><span class="date-title"><?php  echo $start;?> 至 <?php  echo $end;?></span> <i class="fa fa-calendar"></i></button>
						</div>
				</div>
			
	<div class="app-table-list"> 
   <div class="row"> 
    <div class="col-md-12"> 
     <div class=""> 
      <div class="table-header"> 
       <div style="width: 400px;text-align: left;">
        服务包类型
       </div> 
       <div class="others">
        团队
       </div> 
       <div class="others">
        支付方式
       </div> 
       <div class="others">
        价格
       </div> 
       <div class="others">
        时间
       </div> 
       <div class="others">
        状态
       </div> 
       <div class="others">
        操作
       </div> 
      </div> 
      <div class="table-row">
       <div style="height:20px;padding:0;border-top:none;">
        &nbsp;
       </div>
      </div> 
      <div class="tables"> 
      <?php  if(is_array($list)) { foreach($list as $item) { ?>
       <div class="table-row table-top"> 
        <div style="text-align: left;color: #8f8e8e;"> 
         <span style="font-weight: bold;margin-right: 10px;color: #2d2d31"> <span class="label label-info ordertype">服务包</span> <?php  echo $item['created'];?> </span> 订单编号：<?php  echo $item['orders'];?>&nbsp;&nbsp; 
        </div> 
       </div> 
       <div class="table-row" style="margin:0  20px"> 
        <div class="goods-des"> 
         <div style="display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;margin: 10px 0"> 
          <img src="http://www.webstrongtech.com/attachment/images/6/2019/06/svZOv186OVL8AY7L977VlY88v8vV8l.jpg" style="width:70px;height:70px;border:1px solid #efefef; padding:1px;" onerror="this.src='../addons/weliam_merchant/web/resource/images/nopic.jpg'" /> 
          <div style="-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;margin-left: 10px;text-align: left;display: flex;align-items: center"> 
           <div> 
            <div class="title">
              开通<?php  echo $item['titlme'];?>服务 
             <span style="color: #999"> </span> 
            </div> 
           </div> 
           <span style="float: right;text-align: right;display: inline-block;width:130px;"> ￥<?php  echo $item['money'];?><br /> x1 </span> 
          </div> 
         </div> 
        </div> 
        <div class="list-inner saler" style="text-align: center;"> 
         <div> 
          <a href="<?php  echo $this->createWebUrl('sign',array('op'=>'add','ac'=>'fwblist','id'=>$item['tid'],'hid'=>$_SESSION['hid']))?>"> <?php  echo $item['title'];?></a> 
          <br /> <?php  echo $item['title'];?>
          <!-- <br />13935196788 -->
          <br />TID:<?php  echo $item['tid'];?> 
         </div> 
        </div> 
        <!-- <div class="list-inner paystyle" style="text-align:center;"> 
         <span> <i class="icow icow-yue text-warning" style="font-size: 17px;"></i><span>微信支付</span></span> 
        </div>  -->
        <a class="list-inner" data-toggle="popover" data-html="true" data-placement="right" data-trigger="hover" data-content="&lt;table style='width:100%;'&gt;
	                                    &lt;tr&gt;
	                                        &lt;td  style='border:none;text-align:right;padding: 5px!important;'&gt;服务包小计：&lt;/td&gt;
	                                        &lt;td  style='border:none;text-align:right;padding: 5px!important;'&gt;￥<?php  echo $item['money'];?>&lt;/td&gt;
	                                    &lt;/tr&gt;
	                                    &lt;tr&gt;
	                                        &lt;td  style='border:none;text-align:right;padding: 5px!important;'&gt;时长：&lt;/td&gt;
	                                        &lt;td  style='border:none;text-align:right;padding: 5px!important;'&gt;<?php  echo $item['time_leng'];?>天&lt;/td&gt;
	                                    &lt;/tr&gt;
	                                    	                                    	                                    	                                    	                                    &lt;tr&gt;
	                                        &lt;td style='border:none;text-align:right;padding: 5px!important;'&gt;应收款：&lt;/td&gt;
	                                        &lt;td  style='border:none;text-align:right;color:green;padding: 5px!important;'&gt;￥{$item.money}.00&lt;/td&gt;
	                                    &lt;/tr&gt;
	
	                                &lt;/table&gt;
	                    "> 
         <div style="text-align:center">
           ￥<?php  echo $item['money'];?> 
         </div> </a> 
        <div class="list-inner" style="text-align:center">
        下单时间：<?php  echo $item['created'];?>
        <?php  if($item['status'] == '1') { ?>
          支付时间：<?php  echo $item['pay_time'];?>
         <br />有效时间：<?php  echo $item['end_time'];?> 
         <?php  } ?>

        </div> 
        <div class="list-inner paystyle" style="text-align:center;"> 
        <?php  if($item['status'] == '1') { ?>
         <span class="label label-info">已支付</span> 
        <?php  } else if($item['status'] == '0') { ?>
        <span class="label label-info">待支付</span> 
        <?php  } ?>
        </div> 
        <div class="" style="overflow:visible;margin-top: 40px; text-align: center;"> 
        <?php  if($item['status'] == '0') { ?>
         <a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('sign',array('op'=>'chengesfworder','ac'=>'fwblist','id'=>$item['id'],'hid'=>$_SESSION['hid']))?>">确定付款</a> 
         <?php  } ?>
         <a class="btn btn-danger btn-sm" data-toggle="ajaxRemove" href="<?php  echo $this->createWebUrl('sign',array('op'=>'delfworder','ac'=>'fwblist','id'=>$item['id'],'hid'=>$_SESSION['hid']))?>" data-confirm="确定要删除该记录吗？">快速删除</a> 
        </div> 
       </div> 
      </div> 
      <div class="table-row">
       <div style="height:20px;padding:0;border-top:none;">
        &nbsp;
       </div>
      </div> 
      <?php  } } ?>
      <div style="padding: 20px 0;text-align: right"> 
      </div> 
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
	</body>
</html>
