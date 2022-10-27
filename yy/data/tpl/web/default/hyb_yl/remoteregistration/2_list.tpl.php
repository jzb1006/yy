<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>

<div class="app-content">

    <div class="app-filter">
        <div class="alert alert-warning">
            注意一：设置多个排班模板可以对以后专家排班设置更加方便
            <br>
            注意二：排班时间切勿重复添加，以免选择混乱


        </div>
        <div class="filter-action">
            <a class="btn btn-primary" href="/index.php?c=site&a=entry&do=remoteregistration&op=schedulingadd&ac=schedulingadd&m=hyb_yl&zid=<?php  echo $zid;?>">新增排班模板</a>
        </div>

        <div class="filter-list">
            <form action="" method="get" class="form-horizontal" role="form" id="form1">

                <input type="hidden" name="c" value="site" />
				<input type="hidden" name="a" value="entry" />
				<input type="hidden" name="m" value="hyb_yl" />
				<input type="hidden" name="op" value="list" />
				<input type="hidden" name="ac" value="list" />
				<input type="hidden" name="do" value="remoteregistration" />
                <div class="form-group">
                    <label class="col-sm-2 control-label">按状态</label>
                    <div class="col-sm-4">
                        <select name="state" style="width: 100%;">
                            <option value="1" <?php  if($state == '1') { ?> selected="" <?php  } ?>>正常</option>
                            <option value="0" <?php  if($state == '0') { ?> selected="" <?php  } ?>>停用</option>
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
                        <th style="width: 30px;">
                            <input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
                        </th>
                        <th>ID</th>
                        <th style="width: 150px;">班次名称</th>
                        <th>班次时间</th>
                        <th>星期</th>
                        <th>现在状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php  if(is_array($res)) { foreach($res as $item) { ?>
                    <tr>
                        <td>
                            <center>
                                <input type="checkbox" name="checkbox[]" class="checkbox" value="94" />
                            </center>
                        </td>
                        <td><?php  echo $item['id'];?></td>
                        <td class="text-left">
                            <?php  echo $item['title'];?>
                        </td>
                        <td>
                            <?php  echo $item['times'];?>
                        </td>
                        <td>
                            <?php  echo $item['weeks'];?>
                        </td>
                        <td class="text-left">
                            <?php  if($item['state'] =='1') { ?>
                            <label class="label label-success">开启</label>
                            <?php  } else { ?>
                            <label class="label label-error">关闭</label>
                            <?php  } ?>
                        </td>
                        <td style="position: relative;">
                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('remoteregistration',array('op'=>'schedulingadd','id'=>$item['id'],'zid'=>$zid))?>" title="编辑">编辑</a>

                            <a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('remoteregistration',array('op'=>'schedulingdel','id'=>$item['id'],'zid'=>$zid))?>" data-toggle="ajaxRemove" data-confirm="确定要删除吗？" title="删除">删除</a>
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
                    <a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">删除选中排班</a>
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
                                $.post("<?php  echo $this->createWebUrl('remoteregistration',array('op'=>'schedulingdels'))?>", { ids : ids ,type:type}, function(data){
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
                                    $.post("/web/index.php?c=site&a=entry&m=weliam_merchant&p=store&ac=merchant&do=cash&",{money:money,sid:sid},function (res) {
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