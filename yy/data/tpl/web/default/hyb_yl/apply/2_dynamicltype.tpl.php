<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<style>
    td>i{cursor:pointer; display:inline-block; width:100%; height:100%; color:#428bca;}
    .category-caret{display:inline-block; width:20px; margin: 0 10px; text-align:center; cursor:pointer; color:#d9534f;}
    .add.add_level0{cursor:pointer;}
    .scrollLoading{border-radius: 50px;}
</style>
<ul class="nav nav-tabs">
	<li  class="active" ><a href="#">板块分类管理</a></li>
	<li ><a href="/index.php?c=site&a=entry&do=apply&op=dynamicltypeadd&ac=dynamicltypeadd&m=hyb_yl">添加板块分类</a></li>
</ul>
<div class="app-content">
    <div class="app-filter">
        <div class="filter-action">
            <a href="javascript:;" class="btn btn-primary js-category-all js-collapse">全部折叠</a>
        </div>
    </div>
    <div class="app-table-list">
        <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%">排序</th>
                            <th class="text-center" width="10%">分类图片</th>
                            <th class="text-center" width="30%">分类名称</th>
                            <th class="text-center" width="10%">推荐状态</th>
                            <th class="text-center" width="10%">开启状态</th>
                            <th class="text-center" width="20%">操作</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php  if(is_array($dynamicltype_list)) { foreach($dynamicltype_list as $list) { ?>
                        <tr class="text-center">
                            <td><?php  echo $list['sortid'];?></td>
                            <td class="text-center">
                                <img class="" src="<?php  if(empty($list['thumb'])) { ?>../web/resource/images/nopic.jpg<?php  } else { ?><?php  echo tomedia($list['thumb'])?><?php  } ?>"  height="45" width="45" >
                            </td>
                            <td class="text-center">
                                <div>
                                    <span><?php  echo $list['name'];?></span>
                                </div>
                                <div>
                                    <span>
                                        <a href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamicltype','op'=>'dynamicltypeadd','parentid'=>$list['id']))?>" class="add add_level1" title="添加子分类" >
                                            <i class="fa fa-plus-circle"></i>添加子分类
                                        </a>
                                    </span>
                                    <span class="category-caret">
                                        <i class="fa fa-caret-down js-category-down" style="display:none;" pid="<?php  echo $list['id'];?>"></i>
                                        <i class="fa fa-caret-up js-category-up" pid="<?php  echo $list['id'];?>"></i>
                                    </span>
                                </div>
                            </td>
                           
                            <td  class="text-center">
                                <label class='label label-success'><?php  if($list['recommend']=='1') { ?>开启<?php  } else { ?>关闭<?php  } ?></label>
                            </td>
                            <td  class="text-center">
                                <label class='label label-success'><?php  if($list['enabled']=='1') { ?>开启<?php  } else { ?>关闭<?php  } ?></label>
                            </td>
                            
                            <td  class="text-center">
                                <a href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamicltype','op'=>'dynamicltypeadd','id'=>$list['id']))?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="修改">
                                    编辑
                                </a>
                                -
                                <a href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamicltype','op'=>'dynamicltypedel','id'=>$list['id']))?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="删除">
                                    删除
                                </a>
                            </td>
                        </tr>
                        <?php  if(is_array($list['subordinate_list'])) { foreach($list['subordinate_list'] as $children) { ?>
                        <tr class="js-collpase js-child-category text-center" pid="<?php  echo $list['id'];?>">
                                <td class="text-center" style='float:right;'><?php  echo $children['sortid'];?></td>
                                <td class="text-center">
                                    <img class="" src="<?php  if(empty($children['thumb'])) { ?>../web/resource/images/nopic.jpg<?php  } else { ?><?php  echo tomedia($children['thumb'])?><?php  } ?>"  height="45" width="45" style='float:right;'  >
                                </td>
                                <td class="text-center"><?php  echo $children['name'];?></td>
                                <td class="text-center">
                                    <label class='label label-success'><?php  if($children['recommend']=='1') { ?>开启<?php  } else { ?>关闭<?php  } ?></label>
                                </td>
                                <td class="text-center">
                                    <label class='label label-success'><?php  if($children['enabled']=='1') { ?>开启<?php  } else { ?>关闭<?php  } ?></label>
                                </td>
                                <td class="text-center" style="position:relative;">
                                    <a href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamicltype','op'=>'dynamicltypeadd','id'=>$children['id']))?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="修改">
                                        编辑
                                    </a>
                                    -
                                    <a href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamicltype','op'=>'dynamicltypedel','id'=>$children['id']))?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="删除">
                                        删除
                                    </a>
                                </td>
                        </tr>
                        <?php  } } ?>
                        <?php  } } ?>
                </tbody>

                </table>
            </div>
            <?php  echo $pager;?>
	</div>
</div>
<script type="text/javascript">
	//控制显示
	$(function(){
		$('.js-category-all').click(function() {
			if($(this).hasClass('js-collapse')) {
				$('.js-child-category').fadeOut("slow");
				$('.fa-caret-up').hide();
				$('.fa-caret-down').show();
				$(this).text('全部展开').removeClass('js-collapse');
				
			} else {
				$('.js-child-category').fadeIn("slow");
				$('.fa-caret-up').show();
				$('.fa-caret-down').hide();
				$(this).text('全部折叠').addClass('js-collapse');
			}
		});
		$('.js-category-up').click(function() {
			var parentId = $(this).attr('pid');
			$('tr[pid="'+parentId+'"]').fadeOut("slow");
			$(this).prev().show();
			$(this).hide();
		});
		$('.js-category-down').click(function() {
			var parentId = $(this).attr('pid');
			$('tr[pid="'+parentId+'"]').fadeIn("slow");
			$(this).next().show();
			$(this).hide();
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>
