<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li class="active"><a href="#">个人菜单</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a class="btn btn-primary" href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.editmycenter&ac=mycenter">添加个人菜单</a>
		</div>
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
                    <input type="hidden" name="c" value="site" />
                    <input type="hidden" name="a" value="entry" />
                    <input type="hidden" name="m" value="hyb_yl" />
                    <input type="hidden" name="op" value="mycenter" />
                    <input type="hidden" name="ac" value="mycenter" />
                    <input type="hidden" name="act" value="index.mycenter" />
                    <input type="hidden" name="do" value="copysite" />
                    <div class="form-group form-inline">
                        <label class="col-sm-2 control-label">所在位置</label>
                        <div class="col-sm-9">
                            <select name="type" class="form-control">
                                <option value="">--请选择--</option>
                                <option value="0" <?php  if($_GPC['type']=='0') { ?> selected <?php  } ?>>个人中心</option>
                                <option value="1" <?php  if($_GPC['type']=='1') { ?> selected <?php  } ?>>专家中心</option>
                                <option value="2" <?php  if($_GPC['type']=='2') { ?> selected <?php  } ?>>机构中心</option>
                            </select>
                            <input type="text" name="keyword" class="form-control" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键字" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-md-9">
                            <button class="btn btn-primary" type="submit">筛选</button>
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
						<th class="text-center">缩略图片</th>
						<th class="text-center">显示顺序</th>
						<th class="text-center">标题</th>
						<th class="text-center">展示位置</th>
						<th class="text-center">状态</th>
						<th class="text-center">下级个数</th>
						<th class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
						<tr  class="text-center">
							<td><img class="scrollLoading" src="<?php  echo $item['thumb'];?>" data-url="<?php  echo $item['thumb'];?>"  height="50" width="100"/></td>
							<td><?php  echo $item['sort'];?></td>
							<td><?php  echo $item['title'];?></td>
							<td class="text-lue">
							<?php  if($item['type'] =='0') { ?> 
							个人中心 
							<?php  } else if($item['type'] == '1') { ?> 
							专家中心
							<?php  } else if($item['type'] == '2') { ?> 
							机构中心
							<?php  } ?>
							</td>
							<td><input type="checkbox" class="js-switch tpl_change_status" data-url="" data-open="1" data-close="0"  onchange="changestatus('<?php  echo $item['id'];?>','<?php  echo $item['status'];?>','<?php  echo $item['pid'];?>')" <?php  if($item['status'] =='1') { ?> checked="checked" <?php  } ?>></td>
							<td>
								<?php  echo $item['child'];?>
								<a class="btn btn-sm btn-warning" href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.erjicenter&ac=erjicenter&pid=<?php  echo $item['id'];?>">二级菜单</a>
							</td>
							<td>
								<a class="btn btn-sm btn-warning" href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.editmycenter&ac=mycenter&id=<?php  echo $item['id'];?>">编辑</a>

								<a class="btn btn-sm btn-danger" data-toggle="ajaxRemove" href="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.delmycenter&ac=delmycenter&id=<?php  echo $item['id'];?>&pid=<?php  echo $item['pid'];?>" data-confirm="删除该信息会删除下级菜单，确定删除当前信息?">删除</a>
							</td>
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
<script type="text/javascript">
	$("#search").click(function(){
		$('#form1')[0].submit();
	});
	function changestatus(id,status,pid)
	{
		if(status == '1')
		{
			var  statuss = '0';
		}else{
			 var statuss = '1';
		}
		$.ajax({
            url:"/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.change_mycenter&ac=mycenter&id="+id+"&status="+statuss+"&pid="+pid,
            type:"post",
            dataType:"json",
            cache: false,
            processData: false,
            contentType: false,
            async:false,
            success:function(data){
                window.location.reload()
            },
            error:function(){
                
            }
        });
	}
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
