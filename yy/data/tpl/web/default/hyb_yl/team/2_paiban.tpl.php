<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>

<div class="app-content">

    <div class="app-filter">
        <div class="filter-list">
            <form action="" method="get" class="form-horizontal" role="form" id="form1">

                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="hyb_yl" />
                <input type="hidden" name="op" value="paiban" />
                <input type="hidden" name="ac" value="paiban" />
                <input type="hidden" name="hid" value="<?php  echo $_SESSION['hid'];?>" />
                <input type="hidden" name="do" value="team" />
                <div class="form-group form-inline">
                    <label class="col-sm-2 control-label">排班搜索</label>
                    <div class="col-sm-9">
                        <select name="keywordtype" class="form-control">
                            <option value="" <?php  if($keywordtype=='' ) { ?> selected="" <?php  } ?>>排班搜索 </option>
                            <option value="1" <?php  if($keywordtype=='1' ) { ?> selected="" <?php  } ?>>专家名称 </option>
                            <option value="2" <?php  if($keywordtype=='2' ) { ?> selected="" <?php  } ?>>机构名称 </option>
                            <option value="3" <?php  if($keywordtype=='3' ) { ?> selected="" <?php  } ?>>排班名称 </option>
                        </select>
                        <input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">时间筛选</label>

                    <div class="col-md-2">
                    <?php  echo tpl_form_field_date('time', $item['time']);?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-md-9">
                        <button class="btn btn-primary btn-sml J-submit-btn" type="submit" name="shaixuan">筛选</button>
                        <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                        <input type="file" id="excelUpload" class="hide" />
                        
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
                        <th style="width:5%;">
                            <input type="checkbox" name="checkbox"  id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
                        </th>
                        <th>ID</th>
                        <th style="width: 150px;">班次名称</th>
                        <th>所属专家</th>
                        <th>所属机构</th>
                        <th>班次时间</th>
                        <th>星期</th>
                        <th>预约量</th>
                    </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <tr>
                        <td style="width: 40px;">
                            <input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['id'];?>"  />
                        </td>
                        <td><?php  echo $item['zid'];?></td>
                        <td class="text-left">
                            <?php  echo $item['title'];?>
                        </td>
                        <td>
                            <?php  echo $item['z_name'];?>
                        </td>
                        <td>
                            <?php  echo $item['agentname'];?>
                        </td>
                        <td>
                            <?php  echo $item['times'];?>
                        </td>
                        <td>
                            <?php  echo $item['weeks'];?>
                        </td>
                        <td>
                            <?php  echo $item['yuyue'];?>
                        </td>
                        
                    </tr>
                    <?php  } } ?>
                </tbody>
            </table>
            
        </div>
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
            $.post("./index.php?c=site&a=entry&do=team&op=del_paibans&ac=integral&m=hyb_yl", { ids : ids }, function(data){
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