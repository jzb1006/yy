<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#">运营地区列表</a></li>
</ul>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-list">
			<form action="" method="get" class="form-horizontal" role="form">
				<input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="op" value="hotareaIndex" />
				<input type="hidden" name="ac" value="hotareaIndex" />
				<input type="hidden" name="do" value="jiancha" />
				<div class="form-group">
					<label class="col-sm-2 control-label">是否开启</label>
					<div class="col-sm-9">
						<div class="btn-group">
							<a href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'hotareaIndex','ac'=>'hotareaIndex','status'=>'','is_hot'=>$is_hot,'keyword'=>$keyword))?>" class="btn <?php  if($status == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
							<a href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'hotareaIndex','ac'=>'hotareaIndex','status'=>'1','is_hot'=>$is_hot,'keyword'=>$keyword))?>" class="btn <?php  if($status == '1') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">开启</a>
							<a href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'hotareaIndex','ac'=>'hotareaIndex','status'=>'0','is_hot'=>$is_hot,'keyword'=>$keyword))?>" class="btn <?php  if($status == '0') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">禁用</a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">是否热门</label>
					<div class="col-sm-9">
						<div class="btn-group">
							<a href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'hotareaIndex','ac'=>'hotareaIndex','status'=>$status,'is_hot'=>'','keyword'=>$keyword))?>" class="btn <?php  if($is_hot == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
							<a href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'hotareaIndex','ac'=>'hotareaIndex','status'=>$status,'is_hot'=>'1','keyword'=>$keyword))?>" class="btn <?php  if($is_hot == '1') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">热门</a>
							<a href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'hotareaIndex','ac'=>'hotareaIndex','status'=>$status,'is_hot'=>'0','keyword'=>$keyword))?>" class="btn <?php  if($is_hot == '0') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">普通</a>
						</div>
					</div>
				</div>
				<div class="form-group form-inline">
					<label class="col-sm-2 control-label">地区搜索</label>
					<div class="col-sm-9">
						<!-- <select name="keywordtype" class="form-control">
							<option value="0" <?php  if($_GPC['keywordtype']==0) { ?>selected="selected"<?php  } ?>>请选择</option>
							<option value="1" <?php  if($_GPC['keywordtype']==1) { ?>selected="selected"<?php  } ?>>地区名称</option>
							<option value="2" <?php  if($_GPC['keywordtype']==2) { ?>selected="selected"<?php  } ?>>所属代理</option>
						</select> -->
						<input type="text" name="keyword" class="form-control" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键字"  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-md-9">
						<button class="btn btn-primary">筛选</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="app-table-list">
		<div class="app-filter">
			<div class="filter-action">
				<a href="<?php  echo $this->createWeburl('jiancha',array('op'=>'hotareaedit','ac'=>'hotareaedit'))?>" class="btn btn-primary">添加地区</a>
				<?php  if(!$list) { ?>
				<a href="<?php  echo $this->createWeburl('jiancha',array('op'=>'hotareaimport','ac'=>'hotareaimport'))?>" class="btn btn-primary">一键提取地区数据</a>
				<?php  } ?>
			</div>
		</div> 
		<form class="form form-horizontal form-validate" action="" method="post">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th style="width:100px; text-align:center;">编码</th>
							<th style="width:100px; text-align:center;">名称</th>
							<!-- <th style="width:100px; text-align:center;">分组</th> -->
							<th style="width:50px; text-align:center;">排序(数字越大越靠前)</th>
							<!-- <th style="width:100px; text-align:center;">所属代理</th> -->
							<th style="width:100px; text-align:center;">下级地区</th>
							<th style="width:100px; text-align:center;">是否开启</th>
							<th style="width:100px; text-align:center;">是否热门</th>
							<th style="width:100px; text-align:center;">操作</th>
						</tr>
					</thead>
					<tbody>
					<?php  if(is_array($list)) { foreach($list as $address) { ?>
						<tr>
							<td style="white-space: normal;" class="text-center"><?php  echo $address['id'];?></td>
							<td class="text-center"><?php  echo $address['name'];?></td>
							<!-- <td class="text-center">
								<select name="group[<?php  echo $address['id'];?>]" style="width: 100%;" class="select2">
									<option value="0" <?php  if(empty($address['gid'])) { ?>selected="selected"<?php  } ?>>请选择地区分组</option>
									<?php  if(is_array($remark_arr)) { foreach($remark_arr as $row) { ?>
							            <option value="<?php  echo $row['id'];?>" <?php  if($address['gid'] == $row['id']) { ?>selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
									<?php  } } ?>
						        </select>
							</td> -->
							<td class="text-center">
								<span class="form-control"><?php  echo $address['sort'];?></span>
								<!-- <input type="number" class="form-control" value="<?php  echo $address['sort'];?>" name="sort" /> -->
							</td>
							<!-- <td class="text-center"><?php  echo $address['agent'];?></td> -->
							<td class="text-center">
							    <a class="btn btn-success btn-sm" href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'hotareatwo','ac'=>'hotareaIndex','parentid'=>$address['parentid']))?>">下级地区</a>
							</td>
							<td class="text-center">
								<input type="checkbox" class="js-switch" onchange="changestatus('<?php  echo $address['id'];?>','<?php  echo $address['status'];?>','<?php  echo $address['level'];?>')" name="status" <?php  if($address['status'] == 1) { ?> checked="checked" <?php  } ?>>
							</td>
							<td class="text-center">
								<input type="checkbox" class="js-switch" onchange="changehot('<?php  echo $address['id'];?>','<?php  echo $address['is_host'];?>','<?php  echo $address['level'];?>')" name="is_hots" <?php  if($address['is_host'] == 1) { ?> checked="checked" <?php  } ?>>
							</td>
							<td class="text-center">
								<a class="btn btn-success btn-sm" data-toggle="ajaxModal" href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'hotareaedit','ac'=>'hotareaedit','id'=>$address['id']))?>">编辑地区</a>
								<a class="btn btn-success btn-sm" data-toggle="ajaxModal" data-confirm="删除地区会导致下级地区同步删除，确定要删除吗？" href="<?php  echo $this->createWebUrl('jiancha',array('op'=>'hotareadel','ac'=>'hotareadel','id'=>$address['id'],'level'=>$address['level']))?>">删除地区</a>
							</td>
						</tr>
					<?php  } } ?>
					</tbody>
				</table>
			</div>
			<?php  echo $pager;?>
			
		</form>
	</div>
</div>
<script type="text/javascript">
	
	function changestatus(id,status,level)
	{
		if(status == '1')
		{
			var  statuss = '0';
		}else{
			 var statuss = '1';
		}
		$.ajax({
            url:"/index.php?c=site&a=entry&do=jiancha&op=change_area&ac=change_area&m=hyb_yl&id="+id+"&type=status&status="+statuss+"&level="+level,
            type:"post",
            dataType:"json",
            cache: false,
            processData: false,
            contentType: false,
            async:false,
            success:function(data){
                
            },
            error:function(){
                
            }
        });
	}
	function changehot(id,hot,level)
	{
		if(hot == '1')
		{
			var  hots = '0';
		}else{
			 var hots = '1';
		}
		$.ajax({
            url:"/index.php?c=site&a=entry&do=jiancha&op=change_area&m=hyb_yl&id="+id+"&type=hot&hot="+hots+"&level="+level,
            type:"post",
            dataType:"json",
            cache: false,
            processData: false,
            contentType: false,
            async:false,
            success:function(data){
            },
            error:function(){
            }
        });
	}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>
