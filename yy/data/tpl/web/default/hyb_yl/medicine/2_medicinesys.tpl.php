<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="pages-dashboard">
	<div class="dashb-h">体检概况</div>
	<div class="dashb-c">
		<div class="dashb-c-d">
			<div class="dashb-c-t1 dashb-c-top">
				<div class="dashb-c-p-title">
					<span>实时概况</span><i>更新时间：<?php  echo $todayss;?></i>
				</div>
				<div class="dashb-c-t1-c">
					<div class="dashb-c-p">
						<div class="dashb-c-p-l">
							<div class="icon p-l-icon1"><i class="icon iconfont icon-moneybagfill"></i></div>
						</div>
						<div class="dashb-c-p-r">
							<div class="h2">新增商品(个)</div>
							<div class="h1" id="html-allmoney-today"><?php  echo $today['goods'];?></div>
							<div class="p" id="html-allmoney-yestoday">昨日：<?php  echo $yesterday['goods'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">新增商户(人)</div>
							<div class="h1" id="html-refund-today"><?php  echo $today['store'];?></div>
							<div class="p" id="html-refund-yestoday">昨日：<?php  echo $yesterday['store'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-l">
							<div class="icon p-l-icon2"><i class="icon iconfont icon-shopfill"></i></div>
						</div>
						<div class="dashb-c-p-r">
							<div class="h2">新增药品订单</div>
							<div class="h1" id="html-store-today"><?php  echo $today['order'];?></div>
							<div class="p" id="html-store-yestoday">昨日：<?php  echo $today['order'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">新增处方订单</div>
							<div class="h1" id="html-newcharge-today"><?php  echo $today['chufang'];?></div>
							<div class="p" id="html-newcharge-yestoday">昨日：<?php  echo $today['chufang'];?></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="dashb-c-t1 dashb-c-top">
			    <div class="dashb-c-p-title">
                    <span>重要提醒</span>
                </div>
                <div class="dashb-c-t1-c">
                    <div class="item">
                        <div class="item_tit">订单相关</div>
                        <div class="item_body">
                            <a href=""><div class="item_info">待发货订单：<span id="order-dfh"><?php  echo $fahuo;?></span></div></a>
                            <a href=""><div class="item_info">待收货订单：<span id="order-dtk"><?php  echo $send;?></span></div></a>
							<a href=""><div class="item_info">已完成订单：<span id="order-sqtk"><?php  echo $over;?></span></div></a>
                        </div>
                    </div>
                                                            <div class="item">
                        <div class="item_tit">供应商相关</div>
                        <div class="item_body">
                            <a href=""><div class="item_info">新增供应商：<span id="storeapply"><?php  echo $store;?></span></div></a>
                            <!-- <a href="/web/index.php?c=site&amp;a=entry&amp;m=weliam_merchant&amp;p=finace&amp;ac=wlCash&amp;do=cashApply&amp;type=2&amp;status=2"><div class="item_info">新增报告对比：<span id="agentapply">0</span></div></a> -->
                            
                        </div>
                    </div>
                                        
                </div>
			</div>

			<div class="dashb-c-t2 dashb-c-top">
				<div class="dashb-c-p-title">
					<span>交易金额</span>
				</div>
				<div class="dashb-c-t2-c">
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">今日支付金额(元)</div>
							<div class="h1" id="html-allmoney"><?php  echo $today['money'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">昨日支付金额(元)</div>
							<div class="h1" id="html-yesmoney"><?php  echo $yesterday['money'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">近七日支付金额(元)</div>
							<div class="h1" id="html-sevenmoney"><?php  echo $seven['money'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">近三十日支付金额(元)</div>
							<div class="h1" id="html-threemoney"><?php  echo $monthss['money'];?></div>
						</div>
					</div>
				</div>
				<div class="page-content">
			        <form action=""  class="form-horizontal" onsubmit='return checkform()'>
			           <input type="hidden" name="c" value="site" />
			           <input type="hidden" name="a" value="entry" />
			           <input type="hidden" name="m" value="hyb_yl" />
			           <input type="hidden" name="do" value="medicine" />
			           <input type="hidden" name="op"  value="index" />
			           <input type="hidden" name="ac" value="medicinesys" />
			           <input type="hidden" name="search" value="1" />
			           <input type="hidden" name="hid" value="<?php  echo $_SESSION['hid'];?>" />
			           <div class="page-toolbar">
			               <div class="pull-right" style="padding: 50px 15px;">
			                   <div class="input-group">
			                       <span class="input-group-select">
			                           <select id='days' name="days" >
			                               <option value="7"  <?php  if($days==7) { ?>selected<?php  } ?>>最近</option>
			                               <option value="7"  <?php  if($days==7) { ?>selected<?php  } ?>>7天</option>
			                               <option value="14"  <?php  if($days==14) { ?>selected<?php  } ?>>14天</option>
			                               <option value="30"  <?php  if($days==30) { ?>selected<?php  } ?>>30天</option>
			                               <option value=""  <?php  if($days=='') { ?>selected<?php  } ?>>按日期</option>
			                           </select>
			                       </span>
			                        <span class="input-group-select">
			                            <select id='year' name="year" >
			                                <option value=''>年份</option>
			                                <?php  if(is_array($years)) { foreach($years as $y) { ?>
			                                <option value="<?php  echo $y['data'];?>"  <?php  if($y['selected']) { ?>selected="selected"<?php  } ?>><?php  echo $y['data'];?>年</option>
			                                <?php  } } ?>
			                            </select>
			                        </span>
			                       <span class="input-group-select">
			                            <select id='month' name="month" >
			                                <option value=''>月份</option>
			                                <?php  if(is_array($months)) { foreach($months as $m) { ?>
			                                <option value="<?php  echo $m['data'];?>"  <?php  if($m['selected']) { ?>selected="selected"<?php  } ?>><?php  echo $m['data'];?>月</option>
			                                <?php  } } ?>
			                            </select>
			                       </span>
			                       <div class="input-group-btn">
			                           <button class="btn  btn-primary" type="submit"> 搜索</button>
			                       </div>
			                   </div>
			               </div>
			           </div>
			       </form>
			       	<div class="panel panel-default">
			         	<div class="panel-heading">订单走势图</div>
			           	<div class="panel-body">
			               <div id="container" style="min-width: 800px; height: 400px; margin: 0 auto"></div>
			           	</div>
			       	</div>
				</div>
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
	
	
    <style>
    	#upgrade-modal-page{display: none;}
    	#upgrade-modal-page .upgrade-modal-mask{position: fixed;top: 0;bottom: 0;left: 0;right: 0;background-color: rgba(55, 55, 55, 0.6);height: 100%;z-index: 1000;}
    	#upgrade-modal-page .upgrade-modal{width: 600px;z-index: 1001;position: absolute;padding: 30px 50px;background: #ffffff;top: 50%;left: 50%;transform: translate(-50%,-50%);border-radius: 5px;}
    	#upgrade-modal-page .upgrade-modal img{display: block;margin: 0 auto 20px;width: 250px;}
    	#upgrade-modal-page .upgrade-modal .progress{margin-bottom: 0;height: 15px;}
    	#upgrade-modal-page .upgrade-modal .upgrade-modal-tip{text-align: center;margin-top: 20px;}
    </style>
    <div id="upgrade-modal-page">
    	<div class="upgrade-modal-mask">
    		<div class="upgrade-modal">
    			<div>
    				<img src="https://weilamdemo.oss-cn-qingdao.aliyuncs.com/upgrade.png">
    			</div>
	    		<div class="progress">
					<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
					    <span class="sr-only"></span>
					</div>
				</div>
				<div class="upgrade-modal-tip">
					系统正在处理更新以后的文件，请耐心等待~~~
				</div>
	    	</div>
    	</div>
    </div>
    <script language="javascript" src="<?php  echo $_W['siteroot'];?>addons/hyb_yl/public/js/highcharts/highcharts.js"></script>
<script type="text/javascript">
   
   	function checkform(){
       if($('#days').val()==''){    
           	if($('#year').val()==''){    
               	alert('请选择年份!');
               	return false;
           	}
       }
       return true;
   	}
      $('#days').change(function(){
            if($(this).val()!=''){ 
                $('#year').val('');
                $('#month').val('').attr('disabled',true);;
            }
          
        })
       $('#year').change(function(){
            if($(this).val()==''){ 
                $('#month').val('').attr('disabled',true);
            }
            else{
                $('#days').val('');
                $('#month').removeAttr('disabled');
            }
        })
        
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                 text: '<?php  echo $charttitle;?>',
            },
            subtitle: {
                text: ''
            },
            
            xAxis: {
                categories: [    <?php  if(is_array($datas)) { foreach($datas as $key => $row) { ?>
                       <?php  if($key>0) { ?>,<?php  } ?>"<?php  echo $row['date'];?>"
                       <?php  } } ?>]
            },
            yAxis: {
                title: {
                    text: '个数'
                },allowDecimals:false
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br>'+this.x +': '+ this.y +'°C';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
	            name: '新增商户',
	            data: [
	                <?php  if(is_array($datas)) { foreach($datas as $key => $row) { ?>
	                <?php  if($key>0) { ?>,<?php  } ?><?php  echo $row['store'];?>
	                <?php  } } ?>
	            ]
	        }, {
	            name: '新增订单',
	            data: [
	                <?php  if(is_array($datas)) { foreach($datas as $key => $row) { ?>
	                <?php  if($key>0) { ?>,<?php  } ?><?php  echo $row['order'];?>
	                <?php  } } ?>
	            ]
	        }],
    	});
	});
</script>
<div id="tip-msgbox" class="msgbox"></div></body></html>