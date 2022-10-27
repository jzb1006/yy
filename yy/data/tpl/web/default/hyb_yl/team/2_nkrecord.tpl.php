<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<style type='text/css'>
	.goods-info{position:relative;padding-left:60px;}
	.goods-info .img{position:absolute;top:50%;margin-top:-25px;background: url(https://www.webstrongtech.com/addons/hyb_yl/web/resource/images/loading.gif) center center no-repeat;width:50px;height:50px;}
	.goods-info span{white-space: nowrap;overflow: hidden;text-overflow: ellipsis;display: block;}
	.all-tips{margin-left: 65px;}
</style>
<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#">办卡记录</a></li>
</ul>
<div class="app-content">
	<style type='text/css'>
		.goods-info{position:relative;padding-left:60px;}
		.goods-info .img{position:absolute;top:50%;margin-top:-25px;background: url(https://www.webstrongtech.com/addons/hyb_yl/web/resource/images/loading.gif		) center center no-repeat;width:50px;height:50px;}
		.goods-info span{white-space: nowrap;overflow: hidden;text-overflow: ellipsis;display: block;}
		.all-tips{margin-left: 65px;}
	</style>
	<div class="app-filter">
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="p" value="halfcard" />
				<input type="hidden" name="ac"  value="halftype" />
				<input type="hidden" name="do" value="memberlist" />
				<div class="form-group">
					<label class="col-sm-2 control-label">用户状态</label>
					<div class="col-sm-9">
						<div class="btn-group">
							<a href="<?php  echo $this->createWebUrl('team',array('op'=>'nkrecord','status'=>'','keyword'=>$keyword,'keywordtype'=>$keywordtype))?>" class="btn <?php  if($status == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">不限</a>
                          <a href="<?php  echo $this->createWebUrl('team',array('op'=>'nkrecord','status'=>'1','keyword'=>$keyword,'keywordtype'=>$keywordtype))?>" class="btn <?php  if($status == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">待付款</a>
							<a href="<?php  echo $this->createWebUrl('team',array('op'=>'nkrecord','status'=>'2','keyword'=>$keyword,'keywordtype'=>$keywordtype))?>" class="btn <?php  if($status == '2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">使用中</a>
							<a href="<?php  echo $this->createWebUrl('team',array('op'=>'nkrecord','status'=>'3','keyword'=>$keyword,'keywordtype'=>$keywordtype))?>" class="btn <?php  if($status == '3') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已过期</a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">关键字</label>
					<div class="col-md-3">
						<select name="keywordtype" class="form-control">
							<option value="">关键字类型</option>
							<option value="1" <?php  if($keywordtype == '1') { ?> selected="" <?php  } ?>>用户昵称</option>
							<option value="2" <?php  if($keywordtype == '2') { ?> selected="" <?php  } ?>>用户电话</option>
							<option value="4" <?php  if($keywordtype == '3') { ?> selected="" <?php  } ?>>实卡编号</option>
						</select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>"  placeholder="请输入关键字"/>
                    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-md-9">
						<button class="btn btn-primary" id="search">筛选</button>
						<input type="hidden" value="0" name="outflag" id="outflag" />
					</div>
				</div>
			</form>
		</div>
	</div>
		<script type="text/javascript">
			$("#search").click(function(){
				$('#outflag').val(0);
				$('#form1')[0].submit();
			});
			$("#output").click(function(){
				$('#outflag').val(1);
				$('#form1')[0].submit();
			});
			function sandh(asd){
				if ($(asd).val() == 3) {
					$('#keyword').hide();
					$('#usetype').show();
				}else{
					$('#keyword').show();
					$('#usetype').hide();
				}
			}
		</script>
	<div class="app-table-list">
		<div class="panel-body table-responsive collapse in" id="order-template-item-4" style="padding: 0;">
			<table class="table table-bordered">
				<thead style="background-color: #FFFFFF;">
				<tr>
					<th style="width:5%;">
                        <input type="checkbox" name="checkbox"  id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
                    </th>
					<th style="width:100px;text-align:center;">用户信息</th>
					<th style="width:100px;text-align: center;">专家信息</th>
                  	<th style="width:350px;text-align: center;">权益信息</th>
					<th style="width:50px; text-align:center;">充值时长</th>
					<th style="width:50; text-align:center;">年卡金额</th>
					<th style="width:50; text-align:center;">分销支出</th>
					<th style="width:50; text-align:center;">实际收入</th>
					<th style="width:50; text-align:center;">推荐人</th>
					<th style="width:50px; text-align:center;">状态</th>
					<th style="width:170px; text-align: center;">时间信息</th>
                  <th style="width:50px; text-align: center;">操作</th>
				</tr>
				</thead>
				<tbody >
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<!--一卡通内容-->
					<td style="width: 40px;">
                        <input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['id'];?>"  />
                    </td>
					<td class="goods-info line-feed" style="width:150px;padding-left: 10px;height: 60px;">
						<div class="img"><img src="<?php  echo $item['u_thumb'];?>" class="scrollLoading" data-url="<?php  echo $item['u_thumb'];?>" height="50" width="50" ></div>
						<div class="all-tips">
							<p class="" style="font-family: "Arial","Microsoft YaHei","黑体","宋体",sans-serif;"><?php  echo $item['u_name'];?></p>
						</div>
					</td>
					<!--用户信息-->
				<td>
							<span data-toggle="tooltip" data-placement="top" title="<?php  echo $item['z_name'];?>" class="text-lue" style="display: inline-block;max-width: 200px;"><?php  echo $item['z_name'];?>&nbsp<span class="label label-success"><?php  echo $item['keshi'];?></span><span class="label label-warning"><?php  echo $item['zhicheng'];?></span></span>
						</td>
                            <td class="text-left">
							<?php  if($item['card']['is_mianfei'] == '1') { ?><label class="label label-success">免费问诊次数<?php  echo $item['card']['wz_num'];?>次</label><?php  } ?>
							<?php  if($item['card']['is_wzzk'] == '1') { ?><label class="label label-danger">问诊折扣<?php  echo $item['card']['wz_zhekou'];?>折</label><?php  } ?>
                          <?php  if($item['card']['is_jd'] == '1') { ?><span class="label label-info">免费解读报告<?php  echo $item['card']['jd_num'];?></span><?php  } ?>
                          <?php  if($item['card']['is_hh'] == '1') { ?><span class="label label-default">免费会话次数<?php  echo $item['card']['hh_num'];?></span><?php  } ?>
						</td>
					<!--创建时间-->
					<td class="text-center" style="width:100px;font-family: "Arial","Microsoft YaHei","黑体","宋体",sans-serif;">
										<?php  echo $item['card']['times'];?>年
										</td>
					<!--核销时间-->
					<td class="text-center" style="width:100px;font-family: "Arial","Microsoft YaHei","黑体","宋体",sans-serif;" >
					<?php  echo $item['card']['new_price'];?>元
					</td>
					<td><?php  echo $item['tk_one']+$item['tk_two']?>元</td>
					<td><?php  echo $item['moneys'];?>元</td>
					<td><?php echo empty($item['tk']) ? '暂无' : $item['tk']?></td>
					<td class="text-center" style="width:100px;font-family: "Arial","Microsoft YaHei","黑体","宋体",sans-serif;" >
										<span class="label label-danger"><?php  if($item['status'] == '0') { ?>待支付<?php  } else if($item['end_time'] >= time()) { ?>已到期<?php  } else if($item['status'] == '0') { ?>待付款<?php  } else if($status == '1') { ?>使用中<?php  } ?></span>					</td>
					<!--验证码-->
					<td>
							下单时间：<?php  echo $item['p_time'];?><br>
						    有效时间：<?php  echo $item['endtime'];?>						</td>
                                  <td style="position: relative;">
														
																					<a href="<?php  echo $this->createWebUrl('team',array('op'=>'nkcarddel','status'=>'3','id'=>$item['id']))?>" data-toggle="ajaxRemove" data-confirm="此操作会删除会员卡记录，确定要删除吗？">删除</a>
													</td>
				</tr>
				<?php  } } ?>
								</tbody>
			</table>
		</div>
		<div class="app-table-foot clearfix">
            <div class="pull-left">
                <div class="pull-left" id="de1">
                    <label class="btn btn-default min-width " style="display: inline-flex;align-items:center;margin-right:1rem;">
                        <input type="checkbox" name="checkbox" value="" id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
                        <div style="margin-left: 10px">全选</div>
                    </label>
                    <a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_delete">批量删除</a>
                </div>
            </div>
            <div class="pull-right"><?php  echo $pager;?></div>
        </div>
	</div>
</div>
<script type="text/javascript">
    $("#search").click(function(){
        $('#form1')[0].submit();
    });
    function sandh(asd){
        if ($(asd).val() == 3) {
            $('#keyword').hide();
            $('#howlong').show();
        }else{
            $('#keyword').show();
            $('#howlong').hide();
        }
    }
</script>
<script type="text/javascript">
	require(['jquery', 'util'], function($, util){
		$('.js-copy').each(function(){
			var id=$(this).attr('data-id');
			util.clip($("#js-copy"+id), $(this).attr('data-url'));
		});
	});
</script>
<script type="text/javascript">
	$('#output').click(function(){
		var orderType = '';
		var status = '';
		var paytype = '';
		var keywordtype = '';
		var keyword = '';
		var timetype = '';
		var times = "";
		var timee = "";
		location.href = "https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=hyb_yl&p=halfcard&ac=order&do=output&&orderType="+orderType+"&status="+status+"&paytype="+paytype+"&keywordtype="+keywordtype+"&keyword="+keyword+"&timetype="+timetype+"&times="+times+"&timee="+timee;
	});
	$(function(){
		$('[name="rank_all"]').click(function() {
			var checked = this.checked;
			$('.js-rank').find('input:checkbox').each(function() {
				this.checked = checked;
			});
		});
		$('#export').click(function() {
			if ($('[name="selecttime[start]"]').val() == '') {
				alert('请选择下单时间');
				$(this).focus();
				return false;
			};
			$(this).attr('type', 'submit').submit();
		});
		
		$('.order-rank').each(function(){
			o.rank(this);
		});
		
		
		});
		
//转换日期
	var dt=$('.date1').text().replace(/^\s+|\s+$/g, "");
	var yy=dt.slice(0,4);
	var mm=dt.slice(4,6);
	var dd=dt.slice(6,8);
	var str=(yy+'-'+mm+'-'+dd).toString();
	$('.date1').text(str);

//二级联动切换
$('#sel_parent').click(function(){

if(this.value!=0){
		$('.daterange-date').hide();
		$('#sel_child').hide();
		$(".nickname").removeAttr("style");
		$('.nickname').show();
}
else{
		$('.daterange-date').hide();
		$('.nickname').hide();
		$('#sel_child').hide();	
		$('#sel_child').attr("display","block");
}
//alert(this.value);
//if(this.value==0)
//		$('#sel_child').hide();
})

    // 批量删除
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

        util.nailConfirm(this, function(state) {console.log(state)
        if(!state)  return;
            $.post("./index.php?c=site&a=entry&do=team&op=del_nkrecords&ac=integral&m=hyb_yl", { ids : ids }, function(data){
                if(data.errno=='1'){ 
                    util.tips("操作成功！");
                    setTimeout(function(){ 
                        window.location.reload();
                    }, 1000);
                }else{
                    util.tips("操作失败");  
                };
            }, 'json');
        }, {html: '确认批量删除?'});
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