<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
    <ul class="nav nav-tabs">
        <li>
            <a href="/index.php?c=site&a=entry&do=jiancha&op=role&ac=role&m=hyb_yl">权限列表</a>
        </li>
        <li class="active">
            <a href="https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=hyb_yl&op=jiancha&ac=editrole&do=editrole&keyword=<?php  echo $keyword;?>&id=<?php  echo $id;?>">编辑权限</a>
        </li>
    </ul>
    <div class="app-content">
        <div class="app-form">
            <form action="" method="post" class="form-horizontal form form-validate">
                <input type="hidden" name="id" value="<?php  echo $id;?>" />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        权限设置
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">分组名称<span class="must-fill">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="title" disabled="disabled" placeholder="请输入分组名称" class="form-control" value="<?php  echo $item['title'];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">权限<span class="must-fill">*</span></label>
                            <div class="col-sm-9">
                            <?php  $getallmenu = Data::getallmenu();?>
                                
                                <?php  $top_menus = Data::webMenu(); ?>

                                <?php  if(is_array($top_menus)) { foreach($top_menus as $topmenus) { ?>
                                        
                                    <input type='checkbox' name='role[]' <?php  if(in_array(htmlspecialchars($topmenus['title']),$item['role'])) { ?> checked="checked" <?php  } ?> class="form-control" value='<?php  echo $topmenus['title'];?>' /> <?php  echo $topmenus['title'];?>
                                    <?php  $frames_name = get.$topmenus['active'].Frames;$menusclass = Data;$frames = $menusclass::$frames_name();$menusclass::_calc_current_frames2($frames);?>

                                    <?php  if(is_array($frames)) { foreach($frames as $k => $frame) { ?>
                                    <input type='checkbox' name='role[]' value='<?php  echo $frame['title'];?>' <?php  if(in_array(htmlspecialchars($frame['title']),$item['role'])) { ?> checked="checked" <?php  } ?>/> <?php  echo $frame['title'];?>
                                        <?php  if(is_array($frame['items'])) { foreach($frame['items'] as $link) { ?> 
                                        <input type='checkbox' class="list-group-item <?php  echo $link['active'];?>" name='role[]' value='<?php  echo $link['title'];?>'  <?php  if(in_array(htmlspecialchars($link['title']),$item['role'])) { ?> checked="checked" <?php  } ?>/> <?php  echo $link['title'];?>
                                    
                                <?php  } } ?>
                                        
                                    <?php  } } ?>  
                                <?php  } } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-9">
                                <input type="submit" name="submit" lay-submit value="提交" class="btn btn-primary min-width" />
                                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                                <input type="hidden" name="id" value="<?php  echo $id;?>" />
                            </div>
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
    $('.checkbox input').on('click',function () {
        // body...
        var checkids = [];
        $("input[name='plugins[]']:checked").each(function(inx,val){
                checkids.push($(val).parents('label').text().trim())
        })
        $('#plugins').val(checkids)
    })
</script>