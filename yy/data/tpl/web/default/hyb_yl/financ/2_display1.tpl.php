<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs" id="myTab">
		<li>
			<a href="javascript:;">退款记录</a>
		</li>
	</ul>
	<div class="app-content">
		<div class="app-filter">
			<div class="filter-list">
				<form action="" method="post" class="form-horizontal" role="form" id="form1">
					<div class="form-group">
						<label class="col-sm-2 control-label">退款方式</label>
						<div class="col-sm-9">
							<div class="btn-group">
								<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'display1','ac'=>'display1','refund'=>'','key_words'=>$key_words,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end))?>" class="btn <?php  if($refund == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">全部</a>
								<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'display1','ac'=>'display1','refund'=>'0','key_words'=>$key_words,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end))?>" class="btn <?php  if($refund == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">手机端退款</a>
								<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'display1','ac'=>'display1','refund'=>'1','key_words'=>$key_words,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end))?>" class="btn <?php  if($refund == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">后台退款</a>
								<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'display1','ac'=>'display1','refund'=>'2','key_words'=>$key_words,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end))?>" class="btn <?php  if($refund == '2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">自动退款</a>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">所属类型</label>
						<div class="col-sm-9">
							<div class="btn-group">
								<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'display1','ac'=>'display1','refund'=>$refund,'key_words'=>'','keywordtype'=>$keywordtype,'keyword'=>$typs['key_words'],'start'=>$start,'end'=>$end))?>" class="btn <?php  if($key_words == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">全部</a>
								<?php  if(is_array($type_arr)) { foreach($type_arr as $typs) { ?>
								
								<a href="<?php  echo $this->createWebUrl('financ',array('op'=>'display1','ac'=>'display1','refund'=>$refund,'key_words'=>$typs['id'],'keywordtype'=>$keywordtype,'keyword'=>$typs['key_words'],'start'=>$start,'end'=>$end))?>" class="btn <?php  if($key_words == $typs['id']) { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>"><?php  echo $typs['titlme'];?></a>
								<?php  } } ?>
								
							</div>
						</div>
					</div>
					<div class="form-group form-inline">
						<label class="col-sm-2 control-label">记录搜索</label>
						<div class="col-sm-9">
							<select name="keywordtype" class="form-control">
								<option value="">记录搜索</option>
								<option value="1" <?php  if($keywordtype == '1') { ?> selected="" <?php  } ?>>订单号</option>
								<option value="2" <?php  if($keywordtype == '2') { ?> selected="" <?php  } ?>>买家昵称</option>
								<option value="3" <?php  if($keywordtype == '3') { ?> selected="" <?php  } ?>>买家电话</option>
							</select>
							<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">退款时间</label>
						<div class="col-sm-9">
                           <?php  echo tpl_form_field_daterange('time',$value = array(), $time = false)?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-md-9">
							<button class="btn btn-primary" type="submit">筛选</button>
							<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
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
							<th style="width: 30px;">
	                            <input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
	                        </th>
							<th>订单编号(三方单号)</th>
							<th>用户信息</th>
							<th>商品信息</th>
							<th>支付金额</th>
							<th>支付方式</th>
							<th>退款金额</th>
							<th>退款方式</th>
							<th>退款状态</th>
							<th>退款申请时间</th>
							<th>退款时间</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
					    <?php  if(is_array($list)) { foreach($list as $item) { ?>
						<tr>
							<td>
				                <center>
				                    <input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['id'];?>" />
				                </center>
				            </td>
							<td>
								<?php  echo $item['orders'];?> 
							</td>
							<td>
								<?php  echo $item['names'];?> 
							</td>
							<td>
							 <?php  if($item['key_words'] =="tuwenwenzhen" ) { ?>
								<span class="label label-info">图文问诊</span>
							 <?php  } ?>
							 <?php  if($item['key_words'] =="yuanchengkaifang" ) { ?>
								<span class="label label-info" >远程开方</span>
							<?php  } ?>
							 <?php  if($item['key_words'] =="dianhuajizhen" ) { ?>
								<span class="label label-info" >电话问诊</span>
							 <?php  } ?>
							 <?php  if($item['key_words'] =="shipinwenzhen" ) { ?>
								<span class="label label-info" >视频问诊</span>
							 <?php  } ?>
							 <?php  if($item['key_words'] =="tijianjiedu" ) { ?>
								<span class="label label-info" >体检解读</span>
							 <?php  } ?>
							 <?php  if($item['key_words'] =="yuanchengguahao" ) { ?>
								<span class="label label-info" >远程挂号</span>
							 <?php  } ?>
							</td>
							<td>
								￥<?php  echo $item['money'];?>
						    </td>
							<td>
								微信支付
							</td>
							<td>
								<?php  echo $item['money'];?>
							</td>
							<td>
								<span style="color: orangered ;"> 原路返回</span>
							</td>
							<td>
							<?php  if($item['status'] =='0') { ?>
								<span style="color: orangered ;"> 待审核</span>
							<?php  } ?>
							<?php  if($item['status'] =='1') { ?>
								<span style="color: orangered ;"> 审核通过</span>
							<?php  } ?>
							<?php  if($item['status'] =='2') { ?>
								<span style="color: orangered ;"> 审核拒绝</span>
							<?php  } ?>
							<?php  if($item['status'] =='3') { ?>
								<span style="color: orangered ;"> 已退回</span>
							<?php  } ?>
							</td>
							<td>
                                 <?php  echo date("Y-m-d H:i:s",$item['created']); ?>
							</td>
							<td>
							    <?php  if($item['status'] =='3') { ?>
								<?php  echo date("Y-m-d H:i:s",$item['s_time']); ?>
								<?php  } else { ?>
								未退款
								<?php  } ?>
							</td>
					        <td>
								<!-- <a class="btn btn-primary btn-sm" href="/index.php?c=site&amp;a=entry&amp;do=order&amp;op=kcorderxq&amp;ac=kcorderxq&amp;m=hyb_yl" title="">查看详情</a> -->
								<?php  if($item['status'] == '0') { ?>
								<a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('financ',array('op'=>'tk_change','id'=>$item['id'],'ac'=>'display1','status'=>'1'))?>">通过申请</a>
								<a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('financ',array('op'=>'tk_change','id'=>$item['id'],'ac'=>'display1','status'=>'2'))?>">拒绝申请</a>
								<?php  } else if($item['status'] == '1') { ?>
								<a class="btn btn-info btn-sm" href="<?php  echo $this->createWebUrl('financ',array('op'=>'tx_change_money','id'=>$item['id'],'ac'=>'display1','status'=>'3','money'=>$item['money'],'openid'=>$item['openid'],'u_name'=>$item['names']))?>">确认打款</a>
								<?php  } else if($item['status'] == '2') { ?>
								已拒绝
								<?php  } else if($item['status'] == '3') { ?>
								已打款
								<?php  } ?>
								<a class="btn btn-danger btn-sm" data-toggle="ajaxRemove" href="<?php  echo $this->createWebUrl('financ',array('op'=>'tk_del','ac'=>'display1','id'=>$item['id']))?>" data-confirm="确定要删除该记录吗？">快速删除</a>
							</td>
						</tr>
                      <?php  } } ?>
					</tbody>
				</table>
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

	</div>
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
<script type="text/javascript">
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
            $.post("<?php  echo $this->createWebUrl('financ',array('op'=>'del_refunds','ac'=>'refund'))?>", { ids : ids }, function(data){
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
</body>
</html>