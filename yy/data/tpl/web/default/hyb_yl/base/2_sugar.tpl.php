<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>

<div class="app-content">
    <div class="app-filter">
        <div class="filter-action">
            <a class="btn btn-primary" href="/index.php?c=site&a=entry&do=base&op=add_sugar&ac=sugar&m=hyb_yl&hid=<?php  echo $_SESSION['hid'];?>">新增血糖标准</a>
        </div>
    </div>
    <div class="app-table-list">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 30px;">
                            <input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
                        </th>
                        <th>ID</th>
                        <th style="width: 150px;">正常最低血糖</th>
                        <th>正常最高血糖</th>
                        <th>所属性别</th>
                        <th>所属年龄</th>
                        <th>添加时间</th>
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
                        <td><?php  echo $item['id'];?></td>
                        <td class="text-left">
                            <?php  echo $item['high_range_down'];?>
                        </td>
                        <td>
                            <?php  echo $item['high_range_up'];?>
                        </td>
                        <td>
                            <?php  echo $item['sex'];?>
                        </td>
                        <td>
                            <?php  echo $item['min_age'];?>~<?php  echo $item['max_age'];?>
                        </td>
                        <td class="text-left">
                            <?php  echo date("Y-m-d H:i:s",$item['created'])?>
                        </td>
                        <td style="position: relative;">
                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('base',array('op'=>'add_sugar','id'=>$item['id'],'hid'=>$_SESSION['hid']))?>" title="编辑">编辑</a>

                            <a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('base',array('op'=>'del_sugar','id'=>$item['id'],'hid'=>$_SESSION['hid']))?>" data-toggle="ajaxRemove" data-confirm="确定要删除吗？" title="删除">删除</a>
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
                    <a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">删除选中标准</a>
                </div>
            </div>
            <div class="pull-right">
            </div>
        </div>
    </div>
</div>
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
            $.post("<?php  echo $this->createWebUrl('base',array('op'=>'del_sugars'))?>", { ids : ids ,type:type}, function(data){
                if(!data.errno){
                util.tips("删除成功！");
                location.reload();
                }else{
                util.tips(data.message);    
                };
            }, 'json');
        }, {html: '确认删除所选标准?'});
    });
                        
</script>
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