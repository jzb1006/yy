<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<style>
.select2{width: 100%;}
.select2-container .select2-choice .select2-arrow b{background-color: #eeeeee}
.w200{width: 200px;}
.w60{width: 60px;text-align: right;}
.form-horizontal .form-group{margin-left: 0;margin-right: 0;}
.table> thead> tr> th{border: none;}
.is_default{display: table-block;}
.is_advanced{display: none;}
#openids_selector .input-group{width: 100%;}
.is_sms{display: table-block;}
</style>
<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#tab_basic">模板消息</a></li>
</ul>
<div class="app-content">
    <div class="app-form">
        <form action="" method="post" class="form-horizontal form" id="setting-form">
            <div class="panel panel-default">
                <div class="panel-heading">模板设置</div>
                <div class="alert alert-info">
                    <b>注意：</b>
                    <p>请将小程序模板消息所在行业选择为： 医疗 医疗|健康咨询，医疗|就医服务，医疗|互联网医院</p>
                    <p>需手动填写模板ID</p>
                </div>
                <div class="app-table-list">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center" width="10%">标题</th>
                                <th class="text-center" width="25%">关键词</th>
                                <th class="text-center" width="15%">服务类目</th>
                                 <th class="text-center" width="15%">订阅类型</th>
                                <th class="text-center" width="25%">模板id</th>
                                <th class="text-center" width="10%">是否开启</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>就诊提醒</td>
                                    <td>就诊人、证件类型、证件号码、就诊科室、就诊时间、预约医生、提示说明、医院名称</td>
                                     <td>医疗|健康资讯</td>
                                      <td>长期订阅</td>
                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[submitOrder]" value="<?php  echo $wxapp_mb['submitOrder'];?>" class="form-control" />
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[submitOrderSwitch]" <?php  if($wxapp_mb['submitOrderSwitch'] =='on') { ?> checked="checked" <?php  } ?> >
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>用药提醒</td>
                                    <td>就诊人、服药时间、药品信息、提示说明</td>
                                    <td>医疗|健康资讯</td>
                                     <td>长期订阅</td>
                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[OpenHalfcard]" class="form-control" value="<?php  echo $wxapp_mb['OpenHalfcard'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[OpenHalfcardSwitch]"  <?php  if($wxapp_mb['OpenHalfcardSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>处方生成通知</td>
                                    <td>就诊人、诊断、医生</td>
                                    <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>
                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[cfoverfcard]" class="form-control" value="<?php  echo $wxapp_mb['cfoverfcard'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[cfoverfcardSwitch]"  <?php  if($wxapp_mb['cfoverfcardSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>问诊提醒</td>
                                    <td>问诊内容、提醒内容、问诊医生、提示说明</td>
                                     <td>医疗|健康资讯</td>
                                      <td>长期订阅</td>
                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[Mobile]" class="form-control" value="<?php  echo $wxapp_mb['Mobile'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[MobileSwitch]" <?php  if($wxapp_mb['MobileSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>问诊异常提醒</td>
                                    <td>订单ID、问诊医生、问诊时间、取消原因、提示说明</td>
                                     <td>医疗|健康资讯</td>
                                      <td>长期订阅</td>
                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[hexiao]" class="form-control" value="<?php  echo $wxapp_mb['hexiao'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[hexiaoSwitch]" <?php  if($wxapp_mb['hexiaoSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>接种疫苗提醒</td>
                                    <td>就诊人、证件号码、证件类型、接种地点、接种时间、联系电话、提示说明、接种人、疫苗种类</td>
                                    <td>医疗|就医服务</td>
                                     <td>长期订阅</td>
                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[settled]" class="form-control" value="<?php  echo $wxapp_mb['settled'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[settledSwitch]" <?php  if($wxapp_mb['settledSwitch'] =='on') { ?> checked="checked" <?php  } ?> >
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>动账提醒</td>
                                    <td>时间、机构、账户变动、提示说明</td>
                                    <td>医疗|就医服务</td>
                                     <td>长期订阅</td>
                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[refundNotice]" value="<?php  echo $wxapp_mb['refundNotice'];?>" class="form-control" />
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[refundNoticeSwitch]" <?php  if($wxapp_mb['refundNoticeSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>体检预约变更提醒</td>
                                    <td>体检人、体检时间、体检机构、体检套餐、体检地址、变更说明</td>
                                    <td>医疗|健康资讯</td>
                                    <td>长期订阅</td>
                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[pocketnotice]" class="form-control" value="<?php  echo $wxapp_mb['pocketnotice'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[pocketSwitch]"  <?php  if($wxapp_mb['pocketSwitch'] =='on') { ?> checked="checked" <?php  } ?> >
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>体检提醒</td>
                                    <td>体检说明、体检人、体检时间、体检机构、体检套餐</td>
                                     <td>医疗|健康资讯</td>
                                      <td>长期订阅</td>
                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[jobnotice]" class="form-control" value="<?php  echo $wxapp_mb['jobnotice'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[jobSwitch]" <?php  if($wxapp_mb['jobSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>挂号成功通知</td>
                                    <td>就诊医生、就诊地点、就诊时间、就诊人</td>
                                    <td>医疗|就医服务</td>
                                      <td>一次性订阅</td>
                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[overtime]" class="form-control" value="<?php  echo $wxapp_mb['overtime'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[overtimeSwitch]" <?php  if($wxapp_mb['overtimeSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>诊后随访提醒</td>
                                    <td>随访科室、随访时间、随访内容、提示说明、医生、医院、患者信息</td>
                                     <td>医疗|健康资讯</td>
                                      <td>一次性订阅</td>
                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[groupresult]" class="form-control" value="<?php  echo $wxapp_mb['groupresult'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[groupresultSwitch]" <?php  if($wxapp_mb['groupresultSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>咨询回复通知</td>
                                    <td>回复内容、回复时间、医生姓名、所属科室、所属医院、医生职称、温馨提示、咨询类型</td>
                                     <td>医疗|健康资讯</td>
                                      <td>一次性订阅</td>
                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[sendremind]" class="form-control" value="<?php  echo $wxapp_mb['sendremind'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[sendremindSwitch]" <?php  if($wxapp_mb['sendremindSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>审核结果通知</td>
                                    <td>审核内容、申请人、审核状态、备注</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[shenSuccess]" class="form-control" value="<?php  echo $wxapp_mb['shenSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[shenSuccessSwitch]" <?php  if($wxapp_mb['shenSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>视频通话提醒</td>
                                    <td>申请时间、申请人、备注</td>
                                     <td>视频|客服</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[videoSuccess]" class="form-control" value="<?php  echo $wxapp_mb['videoSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[videoSuccessSwitch]"  <?php  if($wxapp_mb['videoSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                  <tr class="text-center">
                                    <td>咨询回复通知</td>
                                    <td> 发送人、发送时间、咨询内容、回复内容、备注</td>
                                     <td>视频|客服</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[zxSuccess]" class="form-control" value="<?php  echo $wxapp_mb['zxSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[zxSuccessSwitch]" <?php  if($wxapp_mb['zxSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>视频开始通知</td>
                                    <td>发起人、温馨提示</td>
                                     <td>视频|客服</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[spstratSuccess]" class="form-control" value="<?php  echo $wxapp_mb['spstratSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[spstratSuccessSwitch]" <?php  if($wxapp_mb['spstratSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                  <tr class="text-center">
                                    <td>预约取消通知</td>
                                    <td>取消原因、温馨提醒、预约主题、预约时间、订单号</td>
                                     <td>视频|客服</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[yyqxSuccess]" class="form-control" value="<?php  echo $wxapp_mb['yyqxSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[yyqxSuccessSwitch]" <?php  if($wxapp_mb['yyqxSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                  <tr class="text-center">
                                    <td>预约成功通知</td>
                                    <td>订单编号、开始时间、温馨提示</td>
                                     <td>视频|客服</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[yycgSuccess]" class="form-control" value="<?php  echo $wxapp_mb['yycgSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[yycgSuccessSwitch]" <?php  if($wxapp_mb['yycgSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                   <tr class="text-center">
                                    <td>退款成功通知</td>
                                    <td>退款金额、温馨提醒</td>
                                     <td>视频|客服</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[tuikSuccess]" class="form-control" value="<?php  echo $wxapp_mb['tuikSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[tuikSuccessSwitch]" <?php  if($wxapp_mb['tuikSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>退款申请通知</td>
                                    <td>订单编号、申请时间、退款金额、温馨提醒</td>
                                     <td>视频|客服</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[tkSuccess]" class="form-control" value="<?php  echo $wxapp_mb['tkSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[tkSuccessSwitch]" <?php  if($wxapp_mb['tkSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                   <tr class="text-center">
                                    <td>健康评估报告生成通知</td>
                                    <td> 姓名、时间、评估结果、温馨提示</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[jkSuccess]" class="form-control" value="<?php  echo $wxapp_mb['jkSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[jkSuccessSwitch]" <?php  if($wxapp_mb['jkSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                  <tr class="text-center">
                                    <td>诊后评价提醒</td>
                                    <td> 温馨提示、就诊人信息、看诊医生、诊疗机构、类型</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[zhSuccess]" class="form-control" value="<?php  echo $wxapp_mb['zhSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[zhSuccessSwitch]" <?php  if($wxapp_mb['zhSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                   <tr class="text-center">
                                    <td>订单支付提醒</td>
                                    <td>    服务名称、金额、备注</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[orderSuccess]" class="form-control" value="<?php  echo $wxapp_mb['orderSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[orderSuccessSwitch]" <?php  if($wxapp_mb['orderSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                  <tr class="text-center">
                                    <td>订单取消成功通知</td>
                                    <td>订单号、服务名称、退款金额、备注</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[ddqxSuccess]" class="form-control" value="<?php  echo $wxapp_mb['ddqxSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[ddqxSuccessSwitch]" <?php  if($wxapp_mb['ddqxSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>医嘱提醒</td>
                                    <td>患者姓名、医嘱信息、就诊机构、时间</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[yzSuccess]" class="form-control" value="<?php  echo $wxapp_mb['yzSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[yzSuccessSwitch]" <?php  if($wxapp_mb['yzSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                  <tr class="text-center">
                                    <td>医生发起视频通知</td>
                                    <td>发起人、所属科室、视频内容</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[ysSuccess]" class="form-control" value="<?php  echo $wxapp_mb['ysSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[ysSuccessSwitch]" <?php  if($wxapp_mb['ysSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                  <tr class="text-center">
                                    <td>订单支付完成提醒</td>
                                    <td>咨询服务、订单金额、支付时间、订单编号、订单号、患者姓名、客服电话、商品名称</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[ddwcSuccess]" class="form-control" value="<?php  echo $wxapp_mb['ddwcSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[ddwcSuccessSwitch]" <?php  if($wxapp_mb['ddwcSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                  <tr class="text-center">
                                    <td>问诊单提醒</td>
                                    <td>患者信息、病情描述、填写时间、服务名称、订单详情</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[wzdSuccess]" class="form-control" value="<?php  echo $wxapp_mb['wzdSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[wzdSuccessSwitch]" <?php  if($wxapp_mb['wzdSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>护士资料审核通知</td>
                                    <td>审核结果、审核时间</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[hsSuccess]" class="form-control" value="<?php  echo $wxapp_mb['hsSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[hsSuccessSwitch]" <?php  if($wxapp_mb['hsSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>护理订单接单提醒</td>
                                    <td>护士姓名、服务时间</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[hlSuccess]" class="form-control" value="<?php  echo $wxapp_mb['hlSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[hlSuccessSwitch]" <?php  if($wxapp_mb['hlSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>挂号取消通知</td>
                                    <td>预约医院、预约科室、患者信息、挂号金额、取消时间、预约医生、温馨提示</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[quxiaoSuccess]" class="form-control" value="<?php  echo $wxapp_mb['quxiaoSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[quxiaoSuccessSwitch]" <?php  if($wxapp_mb['quxiaoSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>课程评价提醒</td>
                                    <td>课程名称、上课日期、讲师、备注、上课地点</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[kcSuccess]" class="form-control" value="<?php  echo $wxapp_mb['kcSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[kcSuccessSwitch]" <?php  if($wxapp_mb['kcSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                  <tr class="text-center">
                                    <td>药品寄出通知</td>
                                    <td>课   快递公司、快递单号、温馨提示</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[yaopinSuccess]" class="form-control" value="<?php  echo $wxapp_mb['yaopinSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[yaopinSuccessSwitch]" <?php  if($wxapp_mb['yaopinSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>检查报告提醒</td>
                                    <td>姓名、检查机构、检查设备、检查时间、温馨提示</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[jcSuccess]" class="form-control" value="<?php  echo $wxapp_mb['jcSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[jcSuccessSwitch]" <?php  if($wxapp_mb['jcSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                   <tr class="text-center">
                                    <td>检验报告状态通知</td>
                                    <td>姓名、检验项目、报告状态</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[bgztSuccess]" class="form-control" value="<?php  echo $wxapp_mb['bgztSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[bgztSuccessSwitch]" <?php  if($wxapp_mb['bgztSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>关注申请提醒</td>
                                    <td>患者姓名、关注时间、温馨提示</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[gzSuccess]" class="form-control" value="<?php  echo $wxapp_mb['gzSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[gzSuccessSwitch]" <?php  if($wxapp_mb['gzSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                  <tr class="text-center">
                                    <td>预约时间到期提醒</td>
                                    <td>预约时间、就诊地点、医生姓名、就诊人、备注、预约地点</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[yysjSuccess]" class="form-control" value="<?php  echo $wxapp_mb['yysjSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[yydqSuccessSwitch]" <?php  if($wxapp_mb['yydqSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>服务结束通知</td>
                                    <td>订单编号、服务人、服务名称、完成时间</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[fwSuccess]" class="form-control" value="<?php  echo $wxapp_mb['fwSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[fwSuccessSwitch]" <?php  if($wxapp_mb['fwSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>提现审核结果通知</td>
                                    <td>提现金额、审核结果、备注、医生姓名</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[tixianSuccess]" class="form-control" value="<?php  echo $wxapp_mb['tixianSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[tixianSuccessSwitch]" <?php  if($wxapp_mb['tixianSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>注册审核结果通知</td>
                                    <td>医生姓名、审核结果、温馨提示</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[zhucSuccess]" class="form-control" value="<?php  echo $wxapp_mb['zhucSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[zhucSuccessSwitch]" <?php  if($wxapp_mb['zhucSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>用户签约提醒</td>
                                    <td>用户姓名、签约类型、申请时间</td>
                                     <td>医疗|就医服务</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[qainSuccess]" class="form-control"  value="<?php  echo $wxapp_mb['qainSuccess'];?>"/>

                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[qianSuccessSwitch]" <?php  if($wxapp_mb['qianSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?> >
                                    </td>
                                </tr>
                                    <tr class="text-center">
                                    <td>复诊提醒</td>
                                    <td>复诊事项、复诊医院、复诊医生、复诊时间、备注</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[fzSuccess]" class="form-control" value="<?php  echo $wxapp_mb['fzSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[fzSuccessSwitch]" <?php  if($wxapp_mb['fzSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                   <tr class="text-center">
                                    <td>处方待确认提醒</td>
                                    <td>处方号、就诊人</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[chufangSuccess]" class="form-control" value="<?php  echo $wxapp_mb['chufangSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[chufangSuccessSwitch]"  <?php  if($wxapp_mb['chufangSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>取药提醒</td>
                                    <td>姓名、取药地点</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[signSuccess]" class="form-control" value="<?php  echo $wxapp_mb['qySuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[qySuccessSwitch]" <?php  if($wxapp_mb['qySuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                  <tr class="text-center">
                                    <td>药品发货提醒</td>
                                    <td>收货人、收货手机、收货地址、快递公司、快递单号</td>
                                     <td>医疗|健康资讯</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[ypfhSuccess]" class="form-control" value="<?php  echo $wxapp_mb['ypfhSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[ypfhSuccessSwitch]" <?php  if($wxapp_mb['ypfhSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                 <tr class="text-center">
                                    <td>实名认证结果通知</td>
                                    <td>审核结果、备注、通知时间</td>
                                     <td>视频|客服</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[smSuccess]" class="form-control" value="<?php  echo $wxapp_mb['smSuccess'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[smSuccessSwitch]" <?php  if($wxapp_mb['smSuccessSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>集市活动提醒</td>
                                    <td>通知内容、通知时间</td>
                                     <td>软件服务提供商</td>
                                     <td>一次性订阅</td>

                                    <td>
                                        <input type="text" placeholder="请输入模板ID" name="notice[active]" class="form-control" value="<?php  echo $wxapp_mb['active'];?>"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch" name="notice[activeSwitch]" <?php  if($wxapp_mb['activeSwitch'] =='on') { ?> checked="checked" <?php  } ?>>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="app-table-foot clearfix">
                        <div class="pull-left">
                            <input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                            <input type="hidden" name="p_id" value="<?php  echo $res['p_id'];?>" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
	$(function() {
		window.optionchanged = false;
		$('#myTab a').click(function(e) {
			e.preventDefault(); //阻止a链接的跳转行为
			$(this).tab('show'); //显示当前选中的链接及关联的content
		})
	});
	
	function search_members() {
       	if( $.trim($('#search-kwd').val())==''){
            Tip.focus('#search-kwd','请输入关键词');
            return;
        }

		$("#module-menus").html("正在搜索....")
		$.get('https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=hyb_yl&p=store&ac=register&do=add&op=selectnickname', {
			keyword: $.trim($('#search-kwd').val())
		}, function(dat){
			$('#module-menus').html(dat);
		});
	}
    function select_member(o) {
		$("#openid").val(o.openid);
		$("#saler").val(o.nickname);
		$('#search-kwd').val(o.nickname)
		$('#module-menus').html('');
		$("#modal-module-menus").modal("hide");
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

