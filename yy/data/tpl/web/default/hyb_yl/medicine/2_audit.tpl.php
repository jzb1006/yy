<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
  <div class="app-container-right">
    <ul class="nav nav-tabs">
      <li <?php  if($status == '') { ?> class="active" <?php  } ?>>
        <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','ac'=>'audit','hid'=>$_SESSION['hid']))?>">全部
        <?php  if($count >0) { ?>
        <span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $count;?></span>
        <?php  } ?>
        </a>
      </li>
      <li <?php  if($status == '0') { ?> class="active" <?php  } ?>>
        <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','status'=>'0','ac'=>'audit','hid'=>$_SESSION['hid']))?>">待审核
        <?php  if($shenhe >0) { ?>
        <span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $shenhe;?></span>
        <?php  } ?>
        </a>
      </li>
      <li <?php  if($status == '1') { ?> class="active" <?php  } ?>>
        <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','status'=>'1','ac'=>'audit','hid'=>$_SESSION['hid']))?>">已通过
        <?php  if($agree >0) { ?>
        <span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $agree;?></span>
        <?php  } ?>
        </a>
      </li>
      <li <?php  if($status == '2') { ?> class="active" <?php  } ?>>
        <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','status'=>'2','ac'=>'audit','hid'=>$_SESSION['hid']))?>">已拒绝
        <?php  if($jujue >0) { ?>
        <span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $jujue;?></span>
        <?php  } ?>
        </a>
      </li>
      <li <?php  if($status == '3') { ?> class="active" <?php  } ?>>
        <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','status'=>'3','ac'=>'audit','hid'=>$_SESSION['hid']))?>">已取消
        <?php  if($quxiao >0) { ?>
        <span class="label label-warning pull-right" style="margin-left: 10px;"><?php  echo $quxiao;?></span>
        <?php  } ?>
        </a>
      </li>

    </ul>
    <div class="app-content">
      <div class="app-filter">
      <div class="alert alert-warning">
        算法专家开方提成说明：开方服务费实际到账=开方总服务费-（开方总服务费X药师审方抽成）
        <br>
        算法机构实际收入说明：订单A实际机构到账=总金额-开方服务费总金额-平台抽成-分销支出
        <br>
        算法机构药师收入说明：药师收入=开方总服务费X药师审方抽成
      </div>
        <div class="filter-list">
          <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="hyb_yl" />
            <input type="hidden" name="op" value="audit" />
            <input type="hidden" name="ac" value="audit" />
            <input type="hidden" name="do" value="medicine" />
            <input type="hidden" name="cashtype" value="" />
            <input type="hidden" name="hid" value="<?php  echo $_SESSION['hid'];?>" />
            <div class="form-group max-with-all">
              <label class="col-sm-2 control-label">订单状态</label>
              <div class="col-sm-9">
                <div class="btn-group">
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','ispay'=>'','typs'=>$typs,'status'=>$status,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">全部</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>$status,'ispay'=>'0','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">待支付</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>$status,'ispay'=>'1','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已支付</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>$status,'ispay'=>'2','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">接诊中</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>$status,'ispay'=>'3','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '3') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">待评价</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>$status,'ispay'=>'4','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '4') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已评价</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>$status,'ispay'=>'5','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '5') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">申请退款</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>$status,'ispay'=>'6','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '6') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已退款</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>$status,'ispay'=>'7','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '7') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已关闭</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>$status,'ispay'=>'8','keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($ispay == '8') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已取消</a>

                </div>
              </div>
            </div>
            <div class="form-group max-with-all">
              <label class="col-sm-2 control-label">处方类型</label>
              <div class="col-sm-9">
                <div class="btn-group">
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>'','status'=>$status,'ispay'=>$ispay,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($typs == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">全部</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>'1','status'=>$status,'ispay'=>$ispay,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($typs == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">有处方</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>'0','status'=>$status,'ispay'=>$ispay,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($typs == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">无处方</a>
                </div>
              </div>
            </div>
            <div class="form-group max-with-all">
              <label class="col-sm-2 control-label">审核状态</label>
              <div class="col-sm-9">
                <div class="btn-group">
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>'','ispay'=>$ispay,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($status == '') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">全部</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>'0','ispay'=>$ispay,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($status == '0') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">待审核</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>'1','ispay'=>$ispay,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($status == '1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">审核通过</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>'2','ispay'=>$ispay,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($status == '2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">审核拒绝</a>
                  <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'audit','typs'=>$typs,'status'=>'3','ispay'=>$ispay,'keywordtype'=>$keywordtype,'keyword'=>$keyword,'start'=>$start,'end'=>$end,'ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn <?php  if($status == '3') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">已取消</a>
                </div>
              </div>
            </div>
            <div class="form-group form-inline">
              <label class="col-sm-2 control-label">搜索内容</label>
              <div class="col-sm-9">
                <select name="keywordtype" class="form-control">
                  <option value="">关键字类型</option>
                  <option value="1" <?php  if($keywordtype=='1' ) { ?> selected="" <?php  } ?>>订单编号 </option>
                      <option value="2" <?php  if($keywordtype=='2' ) { ?> selected="" <?php  } ?>>用户名称 </option>
                      <option value="3" <?php  if($keywordtype=='3' ) { ?> selected="" <?php  } ?>>药师id </option>
                      </select>
                      <input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" placeholder="请输入关键字" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">开方时间段</label>
              <div class="col-sm-9">

                <script type="text/javascript">
                  require(["daterangepicker"], function(){
                              $(function(){
                                $(".daterange.daterange-date").each(function(){
                                  var elm = this;
                                  $(this).daterangepicker({
                                    startDate: $(elm).prev().prev().val(),
                                    endDate: $(elm).prev().val(),
                                    format: "YYYY-MM-DD"
                                  }, function(start, end){
                                    $(elm).find(".date-title").html(start.toDateStr() + " 至 " + end.toDateStr());
                                    $(elm).prev().prev().val(start.toDateStr());
                                    $(elm).prev().val(end.toDateStr());
                                  });
                                });
                              });
                            });
                </script>

                <input name="start" type="hidden" value="<?php  echo $start;?>" />
                <input name="end" type="hidden" value="<?php  echo $end;?>" />
                <button class="btn btn-default daterange daterange-date" type="button">
                  <span class="date-title"><?php  echo $start;?> 至 <?php  echo $end;?></span>
                  <i class="fa fa-calendar"></i>
                </button>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-md-9">
                <button class="btn btn-primary">筛选</button>
                <a href="<?php  echo $this->createWeburl('medicine',array('op'=>'zips','ac'=>'audit','hid'=>$_SESSION['hid']))?>" class="btn btn-default">导出报告</a>
                <!-- <button class="btn btn-default min-width" name="export" type="submit" value="export"><i class="fa fa-download"></i>  导出记录</button> -->
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
                <th>  
                  <input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
                </th>
                <th>用户信息</th>
                <th>订单编号</th>
                <th>开方专家</th>
                <th>处方单</th>
                <th>下单时间</th>
                <th>下单费用</th>
                <th>总开方费</th>
                <th>药师抽成</th>
                <!-- <th>实际到账开方费</th> -->
                <th>平台抽成</th>
                <th>分销支出</th>
                <th>实际到账</th>
                <th>药师审核</th>
                <th>订单状态</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <?php  if(is_array($list)) { foreach($list as $item) { ?>
              <tr>
                <td>
                  <center>
                    <input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['back_orser'];?>" />
                  </center>
                </td>
                <td style="overflow: visible">
                  <!-- <div rel="pop" style="display: flex" data-content=" <span>ID: </span><?php  echo $item['id'];?> </br>                                                                                                                     <span>真实姓名：</span> <?php  echo $item['u_name'];?><br/>
                          <span>手机号：</span><?php  echo $item[''];?> <br/>
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
                           <span>状态:</span>正常" data-original-title="" title=""> -->

                  <img class="img-40" src="<?php  echo $item['u_thumb'];?>" style="border-radius:50%;border:1px solid #efefef;" onerror="this.src='<?php  echo $item['u_thumb'];?>'" width="40" height="40">

                  <span style="display: flex;flex-direction: column;justify-content: center;align-items: flex-start;padding-left: 5px">
                    <span class="nickname">

                      <?php  echo $item['u_name'];?> </span>
                  </span>

        </div>
        </td>
        <td>
          <?php  echo $item['orders'];?> </td>
        <td style="overflow: visible">
          <!-- <div rel="pop" style="display: flex" data-content=" <span>ID: </span>5924 </br>                                                                                                                     <span>真实姓名：</span> 未填写<br/>
                          <span>手机号：</span>未绑定 <br/>
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
                           <span>状态:</span>正常" data-original-title="" title=""> -->
          <img class="img-40" src="<?php  echo $item['z_thumb'];?>" style="border-radius:50%;border:1px solid #efefef;" onerror="this.src='<?php  echo $item['z_thumb'];?>'" width="40" height="40">
          <span style="display: flex;flex-direction: column;justify-content: center;align-items: flex-start;padding-left: 5px">
            <span class="nickname">

              <?php  echo $item['z_name'];?> </span>
          </span>

      </div>
      </td>
      <!--                             <td>
                              <span class="label label-success">
                              <?php  if($item['typs'] == '0') { ?>
                              无处方
                              <?php  } else if($item['typs'] == '1') { ?>
                              有处方
                              <?php  } ?>
                              </span> 
                            </td> -->
      <td>
        <?php  if($item['ispay'] != '0' && $item['cfimg'] != '') { ?>
        <!-- <a class="btn btn-info btn-sm btnGoInfo" data-id="<?php  echo $item['id'];?>" href="javascript:;">报告查看</a> -->
        <a href="javascript:;" class="chakanchufang" data-c_id="<?php  echo $item['c_id'];?>">点击查看处方单</a>
        <?php  } else { ?>
        暂无
        <?php  } ?>
      </td>

      <td>
        <?php  if(empty($item['time'])) { ?>
        待开
        <?php  } else { ?>
        <?php  echo date('Y-m-d H:i:s',$item['time'])?>
        <?php  } ?>
      </td>

      <td>
        <span class="label label-danger">+￥<?php  echo $item['money'];?></span>
      </td>
         <td>
        <span class="label label-danger">+￥<?php  echo $item['money'];?></span>
      </td>
         <td>
        <span class="label label-danger">+￥<?php echo $item['yaoshimoney'] ? $item['yaoshimoney'] : '0.00'?></span>
      </td>
        <!--  <td>
        <span class="label label-danger">+￥<?php  echo $item['money'];?></span>
      </td> -->
         <td>
        <span class="label label-danger">+￥<?php echo $item['ptmoney'] ? $item['ptmoney'] : '0.00'?></span>
      </td>
       <td>
        <span class="label label-danger">+￥<?php echo $item['tkmoney'] ? $item['tkmoney'] : '0.00'?></span>
      </td>
       <td>
        <span class="label label-danger">+￥<?php  echo $item['money']-$item['ptmoney']-$item['tkmoney']-$item['yaoshimoney']?></span>
      </td>


      <td style="overflow: visible">
        <!-- <div rel="pop" style="display: flex" data-content=" <span>ID: </span>5924 </br>                                                                                                                     <span>真实姓名：</span> 未填写<br/>
                          <span>手机号：</span>未绑定 <br/>
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
                           <span>状态:</span>正常" data-original-title="" title=""> -->
        <img class="img-40" src="<?php echo $item['y_thumb']?$item['y_thumb']:''?>" style="border-radius:50%;border:1px solid #efefef;" onerror="this.src='<?php  echo $item['y_thumb'];?>'" width="40" height="40">
        <span style="display: flex;flex-direction: column;justify-content: center;align-items: flex-start;padding-left: 5px">
          <span class="nickname">

            <?php echo $item['y_name']? $item['y_name'] : '平台审核'?> </span>
        </span>

    </div>
    </td>
    <td>
      <span class="label label-warning">
        <?php  if($item['status'] == '0') { ?>
        待审核
        <?php  } else if($item['status'] == '1') { ?>
        审核通过
        <?php  } else if($item['status'] == '2') { ?>
        审核拒绝
        <?php  } else { ?>
        待开
        <?php  } ?>
        <?php  if($item['ispay'] == '0') { ?>
        待支付
        <?php  } else if($item['ispay'] == '1') { ?>
        已支付待接诊
        <?php  } else if($item['ispay'] == '2') { ?>
        接诊中
        <?php  } else if($item['ispay'] == '3') { ?>
        已完成待评价
        <?php  } else if($item['ispay'] == '4') { ?>
        已评价
        <?php  } else if($item['ispay'] == '5') { ?>
        申请退款
        <?php  } else if($item['ispay'] == '6') { ?>
        已退款
        <?php  } else if($item['ispay'] == '7') { ?>
        已关闭
        <?php  } else if($item['ispay'] == '8') { ?>
        取消
        <?php  } else { ?>
        待开
        <?php  } ?>
      </span>
    </td>
    <td class="text-center" style="text-align: center;">
      <?php  if($item['status'] == '0' && ($item['ispay'] == '1' || $item['ispay'] == '2' || $item['ispay'] == '3' || $itme['ispay'] == '4')) { ?>

      <a class="btn btn-success btn-sm" href="<?php  echo $this->createWeburl('medicine',array('op'=>'changesaudit','c_id'=>$item['c_id'],'status'=>'1','ac'=>'audit','hid'=>$_SESSION['hid']))?>" data-toggle="ajaxRemove" data-confirm="确定通过审核吗？"  title="审核">通过</a>
      <a class="btn btn-default btn-sm" href="<?php  echo $this->createWeburl('medicine',array('op'=>'changesaudit','c_id'=>$item['c_id'],'status'=>'2','ac'=>'audit','hid'=>$_SESSION['hid']))?>" data-toggle="ajaxRemove" data-confirm="确定拒绝审核吗？"  title="拒绝">拒绝</a>
      <?php  } ?>
      <a class="btn btn-warning" href="<?php  echo $this->createWeburl('medicine',array('op'=>'auditdetails','c_id'=>$item['c_id'],'ac'=>'audit','ac'=>'audit','hid'=>$_SESSION['hid']))?>" title="详情">详情</a>
      <a class="btn btn-danger btn-sm" href="<?php  echo $this->createWeburl('medicine',array('op'=>'del_audit','c_id'=>$item['c_id'],'ac'=>'audit','ac'=>'audit','hid'=>$_SESSION['hid']))?>" data-toggle="ajaxRemove" data-confirm="删除文章，确定要删除吗？" title="删除">删除</a>
    </td>
    </tr>
    <?php  } } ?>
    </tbody>
    </table>
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
<!-- 处方单详情 -->
<div id="module-menus-doc"></div>

<style type="text/css">
  .el-dialog__wrapper {
       position:fixed;
       top:0;
       right:0;
       bottom:0;
       left:0;
       overflow:auto;
       margin:0;
       background: rgba(0,0,0,0.5);
      }
      .el-dialog {
       position:relative;
       margin:0 auto 50px;
       border-radius:2px;
       -webkit-box-shadow:0 1px 3px rgba(0,0,0,.3);
       box-shadow:0 1px 3px rgba(0,0,0,.3);
       -webkit-box-sizing:border-box;
       box-sizing:border-box;
       width:50%;
       background: #fff;
  
      }
      .el-dialog__body {
       padding:30px 20px;
       color:#606266;
       font-size:14px;
       word-break:break-all;
      }
       .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain {
       margin:0;
       width:calc(100% - 26px);
       position:relative;
       border-radius:4px;
       background-color:#fff;
       padding:24px 13px 30px 13px
      }
      .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain p {
       margin:0
      }
      .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain .cardHead {
       color:#b9b9b9;
       font-size:14px;
       line-height:14px;
       border-bottom:1px dashed rgba(0,0,0,.15)
      }
      .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain .cardHead .title {
       color:#4a4a4a;
       font-size:16px;
       line-height:16px;
       text-align:center;
       margin-top:33px
      }
       .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain .cardHead .presType {
       color:#4a4a4a;
       font-size:20px;
       line-height:20px;
       text-align:center;
       margin-top:17px;
       margin-bottom:44px
      }
       .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain .cardHead .row1 {
       margin-bottom:22px;
       padding:0 25px 0 12px
      }
      .floatR {
       float:right;
      }
      .flex{
        display: flex;
      }
      .justyBetween{
        justify-content: space-between;
      }
      .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain .cardBody.chinese {
          padding: 30px 25px 100px 12px;
      }
      .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain .cardBody {
          color: #6b6b6b;
          font-size: 14px;
      }
      .rp {
          color: #4a4a4a;
          font-size: 16px;
          margin-bottom: 8px;
      }
       .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain .cardBody .itemMed.read.chinese {
          display: inline-block;
          width: 33%;
          border-bottom: none;
          padding: 0;
          margin-top: 22px;
          overflow: hidden;
          text-overflow: ellipsis;
          white-space: nowrap;
      }
      .yellow {
          color: #ffa726;
      }
      .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain .cardBody .chineseTotalRead {
          color: #6b6b6b;
          font-size: 14px;
      }
       .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain .cardBody .chineseTotalRead p:first-child {
          margin: 20px 0 25px;
      }
      .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain .cardBody .chineseTotalRead p {
          margin-top: 12px;
      }
      .area {
          display: inline-block;
          min-width: 60px;
          border-bottom: 1px solid #6b6b6b;
      }
      .el-dialog__wrapper .el-dialog .el-dialog__footer .el-button.el-button--primary:hover {
          background-color: #2f6eb4;
      }
      .el-dialog__wrapper .el-dialog .el-dialog__footer .el-button {
          padding: 0;
          height: 32px;
          line-height: 32px;
          width: 100px;
      }
      .el-button {
          display: inline-block;
          line-height: 1;
          white-space: nowrap;
          cursor: pointer;
          background: #fff;
          border: 1px solid #dcdfe6;
          color: #606266;
          -webkit-appearance: none;
          text-align: center;
          -webkit-box-sizing: border-box;
          box-sizing: border-box;
          outline: 0;
          margin: 0;
          -webkit-transition: .1s;
          transition: .1s;
          font-weight: 500;
          padding: 12px 20px;
          font-size: 14px;
          border-radius: 4px;
      }
      .el-dialog__wrapper .el-dialog .el-dialog__footer .el-button {
          padding: 0;
          height: 32px;
          line-height: 32px;
          width: 100px;
          background: 
      }
      .el-dialog__footer {
          padding: 10px 35px 25px;
      }
      .el-dialog__footer {
          text-align: right;
      }
      .el-dialog__wrapper .el-dialog .el-dialog__footer .el-button.el-button--primary {
          background-color: #4381c6;
      }
      .el-button--primary {
          color: #fff;
          background-color: #409eff;
          border-color: #409eff;
      }
      .el-dialog__wrapper .el-dialog .el-dialog__body .boxPresMain .cardBody .boxSign {
          position: absolute;
          bottom: 20px;
          left: 34px;
          right: 34px;
      }
</style>
<!--处方单详情结束  -->


</body>
</html>

<script>
    $(function(){
        require(['bootstrap'], function () {
            $("[rel=pop]").popover({
                trigger: 'manual',
                placement: 'right',
                title: $(this).data('title'),
                html: 'true',
                content: $(this).data('content'),
                animation: false
            }).on("mouseenter", function () {
                var _this = this;
                $(this).popover("show");
                $(this).siblings(".popover").on("mouseleave", function () {
                    $(_this).popover('hide');
                });
            }).on("mouseleave", function () {
                var _this = this;
                setTimeout(function () {
                    if (!$(".popover:hover").length) {
                        $(_this).popover("hide")
                    }
                }, 100);
            });
        });
    });
</script> 
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
<script type="text/javascript">
  $(document).on('click','.chakanchufang',function(e){

      $('.el-dialog__wrapper').show()
        var c_id = e.currentTarget.dataset.c_id
        var url ="/index.php?c=site&a=entry&do=medicine&m=hyb_yl&op=cfdetail&c_id="+c_id
     
        $.ajax({
            url:url,
            type: "POST",  
            dataType: "html",  
            cache:false, 

            success:function(res){
                console.log(res)
                $('#module-menus-doc').html(res)
            }
        })
    })
    $('.close2').on('click',function(){
      $('.el-dialog__wrapper').hide()
    })
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
        console.log(ids);
        util.nailConfirm(this, function(state) {console.log(state)
        if(!state)  return;
            $.post("./index.php?c=site&a=entry&do=medicine&op=del_audits&ac=audit&m=hyb_yl", { ids : ids }, function(data){
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