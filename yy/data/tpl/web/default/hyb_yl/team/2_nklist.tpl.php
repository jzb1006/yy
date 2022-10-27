<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
<ul class="nav nav-tabs">
	<li <?php  if($status == '') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('team',array('op'=>'nklist','status'=>'','keyword'=>$keyword,'keshi'=>$keshi,'hid'=>$_SESSION['hid']))?>">全部<?php  if($count > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $count;?></span><?php  } ?></a></li>
	<li <?php  if($status == '0') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('team',array('op'=>'nklist','status'=>'0','keyword'=>$keyword,'keshi'=>$keshi,'hid'=>$_SESSION['hid']))?>">待审核<?php  if($shenhe > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $shenhe;?></span><?php  } ?></a></li>
	<li <?php  if($status == '1') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('team',array('op'=>'nklist','status'=>'1','keyword'=>$keyword,'keshi'=>$keshi,'hid'=>$_SESSION['hid']))?>">已通过<?php  if($tongguo > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $tongguo;?></span><?php  } ?></a></li>
	<li <?php  if($status == '2') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('team',array('op'=>'nklist','status'=>'2','keyword'=>$keyword,'keshi'=>$keshi,'hid'=>$_SESSION['hid']))?>">拒绝<?php  if($jujue > 0) { ?><span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $jujue;?></span><?php  } ?></a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="op" value="nklist" />
				<input type="hidden" name="ac" value="nklist" />
				<input type="hidden" name="do" value="team" />
				<!-- <input type="hidden" name="enabled" value="1" /> -->
              <div class="filter-action"><a href="<?php  echo $this->createWebUrl('team',array('op'=>'nklistadd','hid'=>$_SESSION['hid']))?>" class="btn btn-primary">添加年卡</a></div>
				<div class="form-group form-inline">
					<label class="col-sm-2 control-label">搜索内容</label>
					<div class="col-sm-9">
						
						<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>"  placeholder="请输入关键字"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">科室</label>
					<div class="col-sm-6" style="display: flex;">
						<select name="keshi" style="width: 100%;" id="one" onchange="keshi_change()">
							<option value="" >请选择一级科室</option>
							<?php  if(is_array($keshi_arr)) { foreach($keshi_arr as $ks) { ?>
							<option value="<?php  echo $ks['id'];?>" <?php  if($ks['id'] == $keshi) { ?> selected="" <?php  } ?>><?php  echo $ks['ctname'];?></option>
							<?php  } } ?>
						</select>
						<select name="keshi_two" style="width: 100%;" id="two">
							<option value="" >请选择二级科室</option>
							<?php  if(is_array($keshis_arr)) { foreach($keshis_arr as $kss) { ?>
							<option value="<?php  echo $kss['id'];?>" <?php  if($kss['id'] == $keshi_two) { ?> selected="" <?php  } ?>><?php  echo $kss['name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-md-9">
						<button class="btn btn-primary" id="search">搜索</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="app-table-list">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th style="width: 30px;"><input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" /></th>
						<th>ID</th>
						<th style="width: 50px;">创建人</th>
						<th></th>
						<th>费用信息</th>
						<th>库存信息</th>
						<th>权益列表</th>
						<th>时间</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
									<tr>
						<td><center><input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['id'];?>" /></center></td>
						<td><?php  echo $item['id'];?></td>
						<td class="text-left"><img class="scrollLoading" src="<?php  echo $item['advertisement'];?>" data-url="<?php  echo $item['advertisement'];?>" height="50" width="50"/>
						</td>
						<td>
							<span data-toggle="tooltip" data-placement="top" title="<?php  echo $item['z_name'];?>" class="text-lue" style="display: inline-block;max-width: 200px;"><?php  echo $item['z_name'];?>&nbsp<span class="label label-success"><?php  echo $item['keshi'];?></span><span class="label label-warning"><?php  echo $item['zhicheng'];?></span></span>
						</td>
						<td class="text-left">
							<label class="label label-warning">原价<?php  echo $item['old_price'];?>现价<?php  echo $item['new_price'];?></label>
						</td>
						<td>
										1				<br>
													</td>
						<td class="text-left">
							<?php  if($item['is_mianfei'] == '1') { ?><label class="label label-success">免费问诊次数<?php  echo $item['wz_num'];?>次</label><?php  } ?>
							<?php  if($item['is_wzzk'] == '1') { ?><label class="label label-danger">问诊折扣<?php  echo $item['wz_zhekou'];?>折</label><?php  } ?>
                          <?php  if($item['is_jd'] == '1') { ?><span class="label label-info">免费解读报告<?php  echo $item['jd_num'];?></span><?php  } ?>
                          <?php  if($item['is_hh'] == '1') { ?><span class="label label-default">免费会话次数<?php  echo $item['hh_num'];?></span><?php  } ?>
						</td>
						<td>
							创建：<?php  echo $item['created'];?><br>
							审核：<?php  echo $item['s_time'];?>						</td>
						<td>
							<label class="label label-success"><?php  if($item['status'] == 0) { ?>
							审核中
							<?php  } else if($item['status'] == '1') { ?>
							通过
							<?php  } else if($item['status'] == '2') { ?>
							拒绝
							<?php  } ?>
							</label>
													</td>
					<td style="position: relative;">
                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('team',array('op'=>'nklistadd','id'=>$item['id'],'hid'=>$_SESSION['hid']))?>" title="编辑">编辑</a>
                            <?php  if($item['status'] == '0') { ?>
                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('team',array('op'=>'nklistshenhe','id'=>$item['id'],'status'=>'1','hid'=>$_SESSION['hid']))?>" title="通过">通过</a>
                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('team',array('op'=>'nklistshenhe','id'=>$item['id'],'status'=>'2','hid'=>$_SESSION['hid']))?>" title="拒绝">拒绝</a>
                            <?php  } ?>
                            <a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('team',array('op'=>'nkdel','id'=>$item['id'],'hid'=>$_SESSION['hid']))?>" data-toggle="ajaxRemove" data-confirm="确定要删除吗？" title="删除">删除</a>
                        </td>
					</tr>
					<?php  } } ?>
								</tbody>
			</table>
			<?php  echo $pager;?>
		</div>
		<div class="app-table-foot clearfix">
			<div class="pull-left">
				<div id="de1" class="pull-left">
					<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">删除选中年卡</a>
				</div>
			</div>
			<div class="pull-right">
							</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    function keshi_change()
    {
        var id = $('#one option:selected') .val();
        if(id != '')
        {
            $.ajax({
                'url':"/index.php?c=site&a=entry&do=team&op=ajax&type=all&m=hyb_yl&hid=<?php  echo $_SESSION['hid'];?>",
                data:{
                    id:id,
                },
                dataType:"json",
                type:"get",
                success:function(res){
                    var html = '';
                    html +="<select name='keshi_two' class='form-control' id='two'>";
                    html +="<option value=''>请选择二级科室</option>";
                    for(var i=0;i<res.length;i++)
                    {
                        html +="<option value='"+ res[i].id +"'>"+ res[i].name +"</option>";
                    }
                    html +="</select>";
                    $("#two").html(html)
                }
            })
        }
        
    }

</script>
<script>
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
		util.nailConfirm(this, function(state) {
		if(!state) return;
			if(enabled == 4){
				var type = 2;
			}else{
				var type = 1;
			}
			$.post("<?php  echo $this->createWebUrl('team',array('op'=>'nkdels'))?>&", { ids : ids ,type:type}, function(data){
				if(!data.errno){
				util.tips("删除成功！");
				location.reload();
				}else{
				util.tips(data.message);	
				};
			}, 'json');
		}, {html: '确认删除所选商户?'});
	});
	//商户申请结算
    $(".shopSettlement").on('click',function () {
        var sid = $(this).attr("sid");//获取店铺id
        var balance = $(this).attr("balance");//总余额
        tip.prompt('请输入提现金额,不能超过'+balance+'元！',function () {
            var money = $("[name='confirm']").val();//提现金额
            if(money > 0 && parseInt(balance) >= parseInt(money)){
                $.post("https://xiaochuang.webstrongtech.net/web/index.php?c=site&a=entry&m=hyb_yl&p=store&ac=merchant&do=cash&",{money:money,sid:sid},function (res) {
                    if(res.errno == 1){
                        tip.alert(res.message,function () {
                            history.go(0);
                        });
                    }else{
                        tip.alert(res.message);
                    }
                },'json');
            }else{
                tip.alert("请输入正确的提现金额");
            }
        });
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
	</body>
</html>
