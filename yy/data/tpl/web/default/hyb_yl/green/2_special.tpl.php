<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs">
	<li class="active"><a href="#">绿通服务项目</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action">
			<a class="btn btn-primary" href="/index.php?c=site&a=entry&do=green&m=hyb_yl&op=addspecial&ac=addspecial&hid=<?php  echo $_SESSION['hid'];?>">添加绿通服务项目</a>
		</div>
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form" id="form1">
                    <input type="hidden" name="c" value="site" />
                    <input type="hidden" name="a" value="entry" />
                    <input type="hidden" name="m" value="hyb_yl" />
                    <input type="hidden" name="op" value="special" />
                    <input type="hidden" name="ac" value="special" />
                    <input type="hidden" name="do" value="green" />
                    <input type="hidden" name="hid" id="hid" value="<?php  echo $_SESSION['hid'];?>" />
                    <div class="form-group form-inline">
                        <!-- <label class="col-sm-2 control-label">所在位置</label> -->
                        <div class="col-sm-9">
                            
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
						<th class="text-center">下级项目</th>
						<th class="text-center">状态</th>
						<th class="text-center">价格</th>
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
							<?php  echo $item['childs'];?> 
							<a class="btn btn-sm btn-warning" href="/index.php?c=site&a=entry&do=green&m=hyb_yl&op=specialtwo&ac=special&pid=<?php  echo $item['id'];?>&hid=<?php  echo $_SESSION['hid'];?>">查看下级</a>
							</td>
							<td><input type="checkbox" class="js-switch tpl_change_status" data-url="" data-open="1" data-close="0"  onchange="changestatus('<?php  echo $item['id'];?>','<?php  echo $item['status'];?>','<?php  echo $item['pid'];?>')" <?php  if($item['status'] =='1') { ?> checked="checked" <?php  } ?>></td>
							<td>
								<?php  echo $item['money'];?>
								
							</td>
							<td>
								<a class="btn btn-sm btn-warning" href="/index.php?c=site&a=entry&do=green&m=hyb_yl&op=addspecial&ac=addspecial&id=<?php  echo $item['id'];?>&hid=<?php  echo $_SESSION['hid'];?>">编辑</a>
								<a class="btn btn-sm btn-danger" data-toggle="ajaxRemove" href="/index.php?c=site&a=entry&do=green&m=hyb_yl&op=delspecial&ac=delspecial&id=<?php  echo $item['id'];?>&hid=<?php  echo $_SESSION['hid'];?>" data-confirm="确定删除当前信息?">删除</a>
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
		var hid = $("#hid").val();
		if(status == '1')
		{
			var  statuss = '0';
		}else{
			 var statuss = '1';
		}
		$.ajax({
            url:"/index.php?c=site&a=entry&do=green&m=hyb_yl&op=change_special&ac=special&id="+id+"&status="+statuss+"&pid="+pid+"&hid="+hid,
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
