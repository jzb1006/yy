<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
    <ul class="nav nav-tabs">
        <li class="active"><a href="http://www.webstrongtech.com/web/index.php?c=site&a=entry&m=weliam_merchant&p=finace&ac=wlCash&do=cashrecord&">账单明细</a></li>
    </ul>
    <div class="app-content">
        <div class="app-filter">
            <div class="filter-list">
                <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
                    <input type="hidden" name="c" value="site" />
                    <input type="hidden" name="a" value="entry" />
                    <input type="hidden" name="m" value="weliam_merchant" />
                    <input type="hidden" name="p" value="finace" />
                    <input type="hidden" name="ac" value="newCash" />
                    <input type="hidden" name="do" value="cashrecord" />
                    <input type="hidden" name="cashtype" value="" />
<!--                     <div class="form-group max-with-all">
                        <label class="col-sm-2 control-label">报告类型</label>
                        <div class="col-sm-9">
                            <div class="btn-group">
                                <a href="" class="btn btn-primary">全部</a>
                                <a href="" class="btn btn-default">体检</a>
                                <a href="" class="btn btn-default">检验</a>
                                <a href="" class="btn btn-default">基因</a>


                            </div>
                        </div>
                    </div> -->
                    <div class="form-group form-inline">
                        <label class="col-sm-2 control-label">搜索内容</label>
                        <div class="col-sm-9">
                            <select name="keywordtype" class="form-control">
                                <option value="">关键字类型</option>
                                <option value="1">订单编号</option>
                                <option value="2">用户名称</option>
                            </select>
                            <input type="text" name="keyword" class="form-control" value="" placeholder="请输入关键字" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">对比时间段</label>
                        <div class="col-sm-9">

                            <script type="text/javascript">
                                require(["daterangepicker"], function() {
                                    $(function() {
                                        $(".daterange.daterange-date").each(function() {
                                            var elm = this;
                                            $(this).daterangepicker({
                                                startDate: $(elm).prev().prev().val(),
                                                endDate: $(elm).prev().val(),
                                                format: "YYYY-MM-DD"
                                            }, function(start, end) {
                                                $(elm).find(".date-title").html(start.toDateStr() + " 至 " + end.toDateStr());
                                                $(elm).prev().prev().val(start.toDateStr());
                                                $(elm).prev().val(end.toDateStr());
                                            });
                                        });
                                    });
                                });
                            </script>

                            <input name="time_limit[start]" type="hidden" value="2020-03-24" />
                            <input name="time_limit[end]" type="hidden" value="2020-04-25" />
                            <button class="btn btn-default daterange daterange-date" type="button"><span class="date-title">2020-03-24 至 2020-04-25</span> <i class="fa fa-calendar"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-md-9">
                            <button class="btn btn-primary">筛选</button>
                        <!--     <button class="btn btn-default min-width" name="export" type="submit" value="export"><i class="fa fa-download"></i> 导出记录</button> -->
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
                            <th>用户信息</th>
                            <th>订单编号（原）</th>
                            <th>订单编号（对比）</th>
                            <th>对比信息</th>
                            <th>对比时间</th>
                            <th>潜在分析</th>
                            <th>危险程度</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    
                        <tr>
                            <td style="overflow: visible">
                            <div rel="pop" style="display: flex" data-content=" 
                            <span>ID: </span><?php  echo $item['u_id'];?> </br>
                            <span>真实姓名：<?php  echo $item['u_name'];?></span> 未填写<br/>
                            <span>手机号：<?php  echo $item['u_phone'];?></span>未绑定 <br/>
                            <span>问诊次数：</span>3 <br/>
                            <span>购药订单：</span>5 <br/>
                            <span>体检订单：</span>5 <br/>
                            <span>挂号订单：</span>6<br/>
                            <span>总消费：</span>6000元<br/>
                            <span>用户余额：</span>610元<br/>
                            <span>推荐人：</span>无 <br/>
                            <span>用户来源：</span>
                            <i>自然进入</i>
                            <br/>
                           <span>状态:</span>正常" data-original-title="" title="">
                                    <img class="img-40" src="<?php  echo $item['userinfo']['u_thumb'];?>" style="border-radius:50%;border:1px solid #efefef;"  width="40" height="40">
                                    <span style="display: flex;flex-direction: column;justify-content: center;align-items: flex-start;padding-left: 5px">
                                        <span class="nickname">

                                            <?php  echo $item['u_name'];?> </span>
                                    </span>

                                </div>
                            </td>
                              <td>
                               <?php  if(is_array($tijian)) { foreach($tijian as $tt) { ?>
                                <?php  echo $tt['ordernums'];?>,
                               <?php  } } ?>
                                </td>
                            <td>
                                <?php  echo $tt['ordernums'];?> </td>
                            <td>
                                <span class="label label-success">正常项：<?php  echo $item['zcount'];?></span> <span class="label label-danger">异常项：<?php  echo $item['ycount'];?></span>
                            </td>
                            <td>
                                <?php  echo $item['addtime'];?> </td>
                            <td>
                                 <?php  echo $item['userinfo']['u_label'];?> 
                            </td>
                            <td>
                                <span class="label label-danger"><?php  if($item['ycount']>3) { ?>危险<?php  } else if($item['ycount']<=3) { ?> 中度<?php  } else { ?> 一般 <?php  } ?></span> </td>

                            <td>
                                <a href="/index.php?c=site&a=entry&do=physical&op=dbdetails&ac=dbdetails&m=hyb_yl&u_id=<?php  echo $item['userinfo']['u_id'];?>&openid=<?php  echo $item['userinfo']['openid'];?>&id=<?php  echo $item['id'];?>" class="btn btn-default btn-sm" target="_blank">查看详情</a>
                            </td>
                        </tr>
                    <?php  } } ?>
                    </tbody>
                </table>
            </div>
            <div class="app-table-foot clearfix">
                <div class="pull-left">

                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="foot" id="footer">
    <ul class="links ft">
        <li class="links_item">
            <div class="copyright">Powered by <a href="http://www.we7.cc"><b>系统</b></a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a></div>
        </li>
    </ul>
</div>


<script>
    require(['bootstrap'], function($) {
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
    $('.app-login-info-name, .app-login-info-sel').mouseover(function() {
        $('.app-login-info-sel').show();
    });
    $('.app-login-info-name, .app-login-info-sel').mouseout(function() {
        $('.app-login-info-sel').hide();
    });
    $('.app-login-info-sel .login-out').hover(function() {
        $('.app-login-info-sel-arrow').css('border-color', '#1ab394 transparent transparent transparent');
    }, function() {
        $('.app-login-info-sel-arrow').css('border-color', '#f2f2f2 transparent transparent transparent');
    });
</script>
</body>

</html>