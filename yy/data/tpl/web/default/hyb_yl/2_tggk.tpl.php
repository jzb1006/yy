<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>


<div class="pages-dashboard">
	<div class="dashb-h"><?php  echo $_W['uniaccount']['name'];?></div>
	<div class="dashb-c">
		<div class="dashb-c-d">
			<div class="dashb-c-t1 dashb-c-top">
				<div class="dashb-c-p-title">
					<span>推广概况</span><i>更新时间：<?php  echo $todayss;?></i>
				</div>
				<div class="dashb-c-t1-c">
					<div class="dashb-c-p">
						<div class="dashb-c-p-l">
							<div class="icon p-l-icon1"><i class="icon iconfont icon-moneybagfill"></i></div>
						</div>
						<div class="dashb-c-p-r">
							<div class="h2">新增用户(人)</div>
							<div class="h1" id="html-allmoney-today"><?php  echo $today['people'];?></div>
							<div class="p" id="html-allmoney-yestoday">昨日：<?php  echo $yesterday['people'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">新增专家(人)</div>
							<div class="h1" id="html-refund-today"><?php  echo $today['zhuangjia'];?></div>
							<div class="p" id="html-refund-yestoday">昨日：<?php  echo $yesterday['zhuangjia'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-l">
							<div class="icon p-l-icon2"><i class="icon iconfont icon-shopfill"></i></div>
						</div>
						<div class="dashb-c-p-r">
							<div class="h2">新增机构数</div>
							<div class="h1" id="html-store-today"><?php  echo $today['jigou'];?></div>
							<div class="p" id="html-store-yestoday">昨日：<?php  echo $yesterday['jigou'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">新增推客（人）</div>
							<div class="h1" id="html-newcharge-today"><?php  echo $today['tuike'];?></div>
							<div class="p" id="html-newcharge-yestoday">昨日：<?php  echo $yesterday['tuike'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-l">
							<div class="icon p-l-icon3"><i class="icon iconfont icon-peoplefill"></i></div>
						</div>
						<div class="dashb-c-p-r">
							<div class="h2">新增推广订单（个）</div>
							<div class="h1" id="html-newmember-today"><?php  echo $today['tuike_order'];?></div>
							<div class="p" id="html-newmember-yestoday">昨日：<?php  echo $yesterday['tuike_order'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">新增会员（人）</div>
							<div class="h1" id="html-paymember-today"><?php  echo $today['vip'];?></div>
							<div class="p" id="html-paymember-yestoday">昨日：<?php  echo $yesterday['vip'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-l">
							<div class="icon p-l-icon4"><i class="icon iconfont icon-caifub"></i></div>
						</div>
						<div class="dashb-c-p-r">
							<div class="h2">新增签约用户（人）</div>
							<div class="h1" id="html-order-today"><?php  echo $today['team_user'];?></div>
							<div class="p" id="html-order-yestoday">昨日：<?php  echo $today['team_user'];?></div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">新增医生团队（队）</div>
							<div class="h1" id="html-payorder-today"><?php  echo $today['team'];?></div>
							<div class="p" id="html-payorder-yestoday">昨日：<?php  echo $yesterday['team'];?></div>
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
                        <div class="item_tit">推客订单相关</div>
                        <div class="item_body">
                            <a href="https://xiaochuang.webstrongtech.net/web/index.php?c=site&amp;a=entry&amp;m=hyb_yl&amp;p=order&amp;ac=wlOrder&amp;do=orderlist&amp;status=8"><div class="item_info">待结算订单：<span id="order-dfh">0</span></div></a>
                            <a href="https://xiaochuang.webstrongtech.net/web/index.php?c=site&amp;a=entry&amp;m=hyb_yl&amp;p=order&amp;ac=wlOrder&amp;do=orderlist&amp;status=6"><div class="item_info">待提现订单：<span id="order-dtk">0</span></div></a>
							
                        </div>
                    </div>
                                                            <div class="item">
                        <div class="item_tit">其他信息</div>
                        <div class="item_body">
                            <a href="https://xiaochuang.webstrongtech.net/web/index.php?c=site&amp;a=entry&amp;m=hyb_yl&amp;p=finace&amp;ac=wlCash&amp;do=cashApply&amp;type=1&amp;status=2"><div class="item_info">推客提现申请：<span id="storeapply">0</span></div></a>
                            <a href="https://xiaochuang.webstrongtech.net/web/index.php?c=site&amp;a=entry&amp;m=hyb_yl&amp;p=finace&amp;ac=wlCash&amp;do=cashApply&amp;type=2&amp;status=2"><div class="item_info">推客待审核申请：<span id="agentapply">0</span></div></a>
                            
                        </div>
                    </div>
                                      
                </div>
			</div>

			<div class="dashb-c-t2 dashb-c-top">
				<div class="dashb-c-p-title">
					<span>推广支出金额</span>
				</div>
				<div class="dashb-c-t2-c">
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">今日推广支出金额(元)</div>
							<div class="h1" id="html-allmoney">0.00</div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">昨日推广支出金额(元)</div>
							<div class="h1" id="html-yesmoney">0.00</div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">近七日推广支出金额(元)</div>
							<div class="h1" id="html-sevenmoney">0.00</div>
						</div>
					</div>
					<div class="dashb-c-p">
						<div class="dashb-c-p-r">
							<div class="h2">近三十日推广支出金额(元)</div>
							<div class="h1" id="html-threemoney">0.00</div>
						</div>
					</div>
				</div>
				<div class="dashb-c-t2-b">
					<div id="mountNode"><div style="position:relative;"><canvas id="canvas_1" width="960" height="500" style="width: 960px; height: 500px; cursor: default;"></canvas><div class="g2-tooltip" style="position: absolute; visibility: hidden; z-index: 8; transition: visibility 0.2s cubic-bezier(0.23, 1, 0.32, 1), left 0.4s cubic-bezier(0.23, 1, 0.32, 1), top 0.4s cubic-bezier(0.23, 1, 0.32, 1); background-color: rgba(255, 255, 255, 0.9); box-shadow: rgb(174, 174, 174) 0px 0px 10px; border-radius: 3px; color: rgb(87, 87, 87); font-size: 12px; font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, SimSun, sans-serif; line-height: 20px; padding: 10px 10px 6px; left: 121px; top: 134px;"><div class="g2-tooltip-title" style="margin-bottom: 4px;">02-06</div><ul class="g2-tooltip-list" style="margin: 0px; list-style-type: none; padding: 0px;"><li data-index="0" style="margin-bottom: 4px;"><span style="background-color: rgb(24, 144, 255); width: 5px; height: 5px; border-radius: 50%; display: inline-block; margin-right: 8px;" class="g2-tooltip-marker"></span>金额<span class="g2-tooltip-value" style="display: inline-block; float: right; margin-left: 30px;">0</span></li></ul></div></div></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	myrequire(['g2','data-set'],function(){
		$.post(location.href, function(stat){
			var data = $.parseJSON(stat);
			console.log(data);
			var chart = new G2.Chart({
			  	container: 'mountNode',
			  	forceFit: true,
			  	height: 500
			});
			chart.source(data.list);
			chart.scale('金额', {});
			chart.interval().position('year*金额');
			chart.render();

			$('#html-allmoney-today').html(data.allmoney);
			$('#html-allmoney-yestoday').html('昨日：' + data.yesmoney);
			$('#html-refund-today').html(data.refmoney);
			$('#html-refund-yestoday').html('昨日：' + data.refyesmoney);
			$('#html-store-today').html(data.newmerchant);
			$('#html-store-yestoday').html('昨日：' + data.yesnewmerchant);
			$('#html-newcharge-today').html(data.newcharge);
			$('#html-newcharge-yestoday').html('昨日：' + data.yesnewcharge);
			$('#html-newmember-today').html(data.newmember);
			$('#html-newmember-yestoday').html('昨日：' + data.yesnewmember);
			$('#html-paymember-today').html(data.paymember);
			$('#html-paymember-yestoday').html('昨日：' + data.yespaymember);
			$('#html-order-today').html(data.neworder);
			$('#html-order-yestoday').html('昨日：' + data.yesneworder);
			$('#html-payorder-today').html(data.newpayorder);
			$('#html-payorder-yestoday').html('昨日：' + data.yesnewpayorder);

			$('#html-allmoney').html(data.allmoney);
			$('#html-yesmoney').html(data.yesmoney);
			$('#html-sevenmoney').html(data.sevenmoney);
			$('#html-threemoney').html(data.threemoney);
			
			//重要提醒
			$('#order-dfh').html(data.dfhorder);
			$('#order-dtk').html(data.dtkorder);
			$('#order-sqtk').html(data.sqtkorder);
			$('#merchantnum').html(data.merchantnum);
			$('#dynamicnum').html(data.dynamicnum);
			$('#commentnum').html(data.commentnum);
			$('#storeapply').html(data.storeapply);
			$('#agentapply').html(data.agentapply);
			$('#disapply').html(data.disapply);
			$('#pocketnum').html(data.pocketnum);
			$('#disnum').html(data.disnum);
			$('#rushnum').html(data.rushnum);
			$('#grouponnum').html(data.grouponnum);
		});
	})
</script>
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
			    function check_wl_upgrade() {
	        require(['util'], function (util) {
	            if (util.cookie.get('checkwlupgrade_sys')) {
	                return;
	            }
	            $.post('https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=cloud&ac=auth&do=check&', function (ret) {
	                if (ret.errno == 0 && ret.message.result == 1) {
                        var html = '<div class="dashb-header" id="upgrade-tips"><div class="dashb-check"><div class="dashb-check-l"><p>系统检测到有文件变化，请立即校验文件查看！</p><span>如有疑问请联系官方QQ：2972720130</span></div><div class="dashb-check-r"><a href="https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=cloud&ac=auth&do=upgrade&">立即校验</a><a href="javascript:;" onclick="check_wl_upgrade_hide();">忽略提醒</a></div></div></div>'
                        $('.pages-dashboard').prepend(html);
	                }
	            },'json');
	        });
	    }
	    function check_wl_upgrade_hide() {
	        require(['util'], function (util) {
	            util.cookie.set('checkwlupgrade_sys', 1, 3600);
	            $('#upgrade-tips').fadeOut(150);
	        });
	    }
	    $(function () {
	        check_wl_upgrade();
	    });
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
		
				//修改更新逻辑
		$(function () {
	        $.post('https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=cloud&ac=auth&do=check_upgrade&', function (ret) {
                if (ret.errno == 0) {
	            	$.post('https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=cloud&ac=auth&do=upgrade_post&', function (rett) {
		                if (rett.errno == 0) {
                        	$('#upgrade-modal-page').show();
		                	check_post_upgrade();
		                } else {
                            myrequire(['js/tip'], function() {
                                tip.alert(rett.message.message);
                            });
		                }
	            	},'json');
                }
            },'json');
            function check_post_upgrade() {
				var pragress = 0;
				var proc = function() {
					$.post('https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=cloud&ac=auth&do=download&', function (dat) {
						if(dat.result == 1){
							pragress = dat.success/dat.total*100;
							$('.progress-bar').css('width', pragress + '%');
							proc();
						} else if (dat.result == 0) {
							window.location.reload();
						}
					},'json');
				};
				proc();
		    }
	    });
	    	</script>
	


<div id="tip-msgbox" class="msgbox"></div></body></html>