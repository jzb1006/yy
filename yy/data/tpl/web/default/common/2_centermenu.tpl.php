<?php defined('IN_IA') or exit('Access Denied');?><div class="modal fade" id="selectUrl" style=" padding-right: 4px;" role="dialog" aria-labelledby="selectUrlContent" aria-hidden="true">
    <div class="modal-dialog">
        <link rel="stylesheet" href="https://www.webstrongtech.com/addons/hyb_yl/web/resource/css/utility.css">
    <div class="modal-content">
        <!--顶部标题-->

            <!--顶部标题-->

            <!--中间内容-->
            <div class="modal-body">

                <div class="tab-content" id="selectUrlContent" pageclass="1">
                    <!--系统选择-->
                    
                <div class="tab-pane active" id="url_system">
                <?php  $system = Menulitarr::centerMenu(); ?>
                    <?php  if(is_array($system)) { foreach($system as $item) { ?>
                        <div class="page-head"><h5 class="margin-0"><i class="fa fa-folder-open-o"></i> <?php  echo $item['title'];?></h5></div>
                        <?php  if(is_array($item['child'])) { foreach($item['child'] as $ch) { ?>
                            <div class="page-head"><h5 class="margin-0"><i class="fa fa-folder-open-o"></i> <?php  echo $ch['title'];?></h5></div>
                            <?php  if(is_array($ch['list'])) { foreach($ch['list'] as $child) { ?>
                            <nav data-href="<?php  echo $child['url']?>" class="btn btn-default btn-sm" title="<?php  echo $child['name'];?>" data-page_path="<?php  echo $child['page_path'];?>" data-type="<?php  echo $child['url_type'];?>" ><?php  echo $child['name'];?></nav>
                            <?php  } } ?>
                        <?php  } } ?>
                    <?php  } } ?>
                </div>

                </div>
            </div>
            <!--底部关闭-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>
            </div>
            <script>
                //显示隐藏内容栏
                            $("#selectUrlTab").on('click',"li",function () {
                                //改变按钮样式
                                $("#selectUrlTab li").removeClass("active");
                                $(this).addClass("active");
                                //显示隐藏内容
                                var id = $(this).data("id");
                                $("#selectUrlContent .tab-pane").removeClass("active");
                                $("#url_"+id).addClass("active");
                            });
            </script>
        </div>


    </div>
</div>