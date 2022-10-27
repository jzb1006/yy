<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#">疾病列表</a>
		</li>
	</ul>
	<div class="app-content">

		<div class="app-filter">
			<div class="filter-list">
				<form action="./index.php" method="get" class="form-horizontal" role="form">
					<input type="hidden" name="c" value="site" />
					<input type="hidden" name="a" value="entry" />
					<input type="hidden" name="m" value="hyb_yl" />
					<!-- <input type="hidden" name="p" value="area" /> -->
					<input type="hidden" name="ac" value="diseaselist" />
					<input type="hidden" name="do" value="copysite" />
					<input type="hidden" name="act" value="ceshi.diseaselist" />
					<!-- <input type="hidden" name="statusflag" value="" />
					<input type="hidden" name="ishotflag" value="" /> -->

					<div class="form-group form-inline">
						<!-- <label class="col-sm-2 control-label">科室名</label> -->
						<div class="col-sm-9">
							<!-- <select name="keywordtype" class="form-control">
								<option value="0" selected="selected">请选择</option>
								<option value="1">骨科</option>
								<option value="2">脑科</option>
							</select> -->
							<input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-9">
							<button class="btn btn-primary">筛选</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="app-filter">
			<div class="filter-action">
				<a class="btn btn-primary" href="<?php  echo $this->copysiteUrl('ceshi.adddisease');?>&ac=adddisease">添加疾病</a>
				<a class="btn btn-primary" href="<?php  echo $this->copysiteUrl('ceshi.getdiseaselist');?>&ac=diseaselist">一键获取疾病</a>
			</div>
				
			
		</div>
		<div class="app-table-list">
			<form class="form form-horizontal form-validate" action="" method="post">
				<input type="hidden" name="statusflag" value="" />
				<input type="hidden" name="ishotflag" value="" />
				<input type="hidden" name="keywordtype" value="" />
				<input type="hidden" name="agentname" value="" />
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th style="width: 30px;">
		                            <input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
		                        </th>
								<th style="width:100px; text-align:center;">疾病名称</th>
								<!-- <th style="width:50px; text-align:center;">字母</th> -->
								<th style="width:100px; text-align:center;">审核专家</th>
								<th style="width:100px; text-align:center;">是否开启</th>
								<th style="width:100px; text-align:center;">词条作者</th>
								<th style="width:100px; text-align:center;">操作</th>
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
								<td class="text-center">

									<?php  echo $item['title'];?>
								</td>
								<!-- <td class="text-center">
									<?php  echo $item['first'];?>
								</td> -->
								<td class="text-center"><?php  echo $item['zhuanjia'];?></td>
                                <td class="text-center">
                                    <input type="checkbox" class="js-switch" value="<?php  echo $item['id'];?>" name="state[<?php  echo $item['id'];?>]" <?php  if($item['status'] == '1') { ?> checked="checked" <?php  } ?> >
                                </td>
								<td class="text-center">
									<?php  echo $item['u_name'];?>
								</td>
								<td class="text-center">
									<a class="btn btn-success btn-sm"  href="<?php  echo $this->copysiteUrl('ceshi.adddisease');?>&ac=adddisease&id=<?php  echo $item['id'];?>">编辑疾病</a>
									<a class="btn btn-success btn-sm"  href="<?php  echo $this->copysiteUrl('ceshi.deldisease');?>&ac=deldisease&id=<?php  echo $item['id'];?>">删除疾病</a>
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
		</form>
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

</body>
</html>
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
            $.post("<?php  echo $this->copysiteUrl('ceshi.del_diseaselists');?>&ac=diseaselist", { ids : ids }, function(data){
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
<script>
	$('.js-switch').on('click',function(){
      var id=$(this).val()
      if($(this).next('.checked').length==0){
                var url ="<?php  echo $_W['siteroot'];?>/web/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.ajaxinfo&ac=adddisease&op=type";
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: url,
                    data: {
                        id: id
                    },
                    success: function(result) {
                         console.log('关闭')
                    }
                });
      }else{
                var url ="<?php  echo $_W['siteroot'];?>/web/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.ajaxinfo&ac=adddisease&op=kqtype";
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: url,
                    data: {
                        id: id
                    },
                    success: function(result) {
                         console.log('开启')
                    }
                });
         
         }
    })
</script>