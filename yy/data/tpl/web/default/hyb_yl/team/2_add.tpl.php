<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
    <script type="text/javascript" src="http://www.webstrongtech.com/addons/hyb_yl/web/resource/js/diyarea.js"></script>
    <ul class="nav nav-tabs" id="myTab">
        <li class="active">
            <a href="#tab_1">基本信息</a>
        </li>
        <li>
            <a href="#tab_2">专家设置</a>
        </li>
        <li>
            <a href="#tab_3">开通服务</a>
        </li>
    </ul>
    <div class="app-content">
        <div class="app-form">
            <form action="" method="post" class="form-horizontal form form-validate"  onsubmit="return checkValidate(this.form);">
                <input type="hidden" name="id" value="" />
                <div class="tab-content">
                    <!--代理商基本信息-->
                    <div class="tab-pane  active" id="tab_1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                专家信息
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">绑定专家微信</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="openid" name="openid" value="<?php  echo $res['openid'];?>">
                                        <div class="input-group">
                                            <input type="text" name="nickname" maxlength="30" value="<?php  echo $res['u_name'];?>" id="saler" class="form-control" readonly="" >
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#myModal">绑定专家微信</button>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="width: 660px;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                        <h3>绑定专家微信</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="keyword" value="" id="search-kwd" placeholder="可搜索微信昵称，openid，UID">
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="btn btn-default" onclick="search_members();">搜索</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div id="module-menus" style="padding-top:5px;"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">真实姓名<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="z_name" required placeholder="请输入真实姓名" class="form-control" value="<?php  echo $res['z_name'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">专家排序</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="sord" class="form-control" value="<?php  echo $res['sord'];?>">
                                        <div class="help-block">数字越大排序越靠前。</div>
                                    </div>
                                </div>
                                <div class="form-group" id="noleveldiv">
                                    <label class="col-sm-2 control-label">评分等级</label>
                                    <div class="col-sm-9">
                                        <div class="star-rating rating-xs rating-active">
                                            <input type="hidden" name="register[score]" id="star" value="<?php  echo $res['score'];?>">
                                            <div class="rating-container rating-gly-star">
                                                <img src="../addons/hyb_yl/web/resource/images/star-on-big.png" alt="1" class="star">
                                                <img src="../addons/hyb_yl/web/resource/images/star-on-big.png" alt="2" class="star">
                                                <img src="../addons/hyb_yl/web/resource/images/star-on-big.png" alt="3" class="star">
                                                <img src="../addons/hyb_yl/web/resource/images/star-on-big.png" alt="4" class="star">
                                                <img src="../addons/hyb_yl/web/resource/images/star-on-big.png" alt="5" class="star">
                                            </div>
                                            <div class="caption">
                                                <span class="label label-danger">非常棒!!</span>
                                            </div>

                                        </div>
                                        <span class="help-block text-danger" id="nolevel" style="display:none">请选择评分等级</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">性别<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="z_sex" class="form-control">
                                            <option value="1" <?php  if($res['z_sex']=='1') { ?> selected="selected" <?php  } ?>>男</option>
                                            <option value="0" <?php  if($res['z_sex']=='0') { ?> selected="selected" <?php  } ?>>女</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">身份证号码<span class="must-fill" >*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="sfzbianhao" required="" class="form-control" value="<?php  echo $res['sfzbianhao'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">专家工作照<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                     <?php  echo  tpl_form_field_image('advertisement', $res['advertisement'])?>
                                     <span class="help-block">建议使用正方形图片</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">联系电话</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="z_telephone" required="" placeholder="请输入联系电话" class="form-control" value="<?php  echo $res['z_telephone'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">职称<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="z_zhicheng" class="form-control" required="">
                                            <option value="">请选择职称</option>
                                            <?php  if(is_array($job_list)) { foreach($job_list as $item) { ?>
                                              <option value="<?php  echo $item['id'];?>" <?php  if($res['z_zhicheng']==$item['id']) { ?> selected="selected" <?php  } ?>><?php  echo $item['job_name'];?></option>
                                            <?php  } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所在区域<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                     <?php  echo tpl_form_field_district('address',array('province' =>$res['province'],'city'=>$res['city'],'district'=>$res['district']))?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所在位置</label>
                                    <div class="col-sm-9">
                                        <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&amp;ak=F51571495f717ff1194de02366bb8da9&amp;s=1"></script>
                                        <script type="text/javascript" src="https://api.map.baidu.com/getscript?v=2.0&amp;ak=F51571495f717ff1194de02366bb8da9&amp;services=&amp;t=20200327103013"></script>
                                        <script type="text/javascript">
                                            function showCoordinate(elm) {
                                                                require(["util"], function(util){
                                                                    var val = {};
                                                                    val.lng = parseFloat($(elm).parent().prev().prev().find(":text").val());
                                                                    val.lat = parseFloat($(elm).parent().prev().find(":text").val());
                                                                    util.map(val, function(r){
                                                                        $(elm).parent().prev().prev().find(":text").val(r.lng);
                                                                        $(elm).parent().prev().find(":text").val(r.lat);
                                                                    });
                                            
                                                                });
                                                            }
                                        </script>
                                        <div class="row row-fix">
                                            <div class="col-xs-4 col-sm-4">
                                                <input type="text" name="register[location][lng]" required="" placeholder="地理经度" class="form-control" value="<?php  echo $res['lng'];?>">
                                            </div>
                                            <div class="col-xs-4 col-sm-4">
                                                <input type="text" name="register[location][lat]" required="" placeholder="地理纬度" class="form-control" value="<?php  echo $res['lat'];?>">
                                            </div>
                                            <div class="col-xs-4 col-sm-4">
                                                <button onclick="showCoordinate(this);" class="btn btn-default" type="button">选择坐标</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">科室类别<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">

                                        <div class="row row-fix tpl-category-container">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <select class="form-control tpl-category-parent we7-select" id="category_parent" name="z_room" required="">
                                                    <option>请选择一级分类</option>
                                                    <?php  if(is_array($ks_list)) { foreach($ks_list as $item) { ?>
                                                          <option value="<?php  echo $item['id'];?>" <?php  if($item['id']==$res['z_room']) { ?> selected="selected" <?php  } ?>><?php  echo $item['ctname'];?></option>
                                                    <?php  } } ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <select class="form-control tpl-category-child we7-select" id="category_child" name="parentid"  required="">
                                                     <option>请选择二级分类</option>
                                                     <?php  if(is_array($ks_two)) { foreach($ks_two as $kst) { ?>
                                                     <option value="<?php  echo $kst['id'];?>" <?php  if($kst['id']==$res['parentid']) { ?> selected="selected" <?php  } ?>><?php  echo $kst['name'];?></option>
                                                     <?php  } } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">擅长标签</label>
                                    <div class="col-sm-9" id="biaoqian">
                                    <?php  if(is_array($res_sc)) { foreach($res_sc as $item) { ?>
                                         <label class="checkbox-inline"><input checked="checked" type="checkbox" name="authority[]" value="<?php  echo $item;?>"><?php  echo $item;?></label>
                                    <?php  } } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">精选标签</label>
                                    <div class="col-sm-9" id="biaoqian">
                                    <?php  if(is_array($jingxuan)) { foreach($jingxuan as $item) { ?>
                                         <label class="checkbox-inline"><input  <?php  if(in_array($item['name'],$res_jingxuan)) { ?> checked="checked" <?php  } ?> type="checkbox" name="jingxuan[]" value="<?php  echo $item['name'];?>"><?php  echo $item['name'];?></label>
                                    <?php  } } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                专家账号
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">专家账号<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="username" id="username" required placeholder="请输入专家账号" class="form-control" value="<?php  echo $res['username'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">专家密码<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="password" required placeholder="请输入专家密码" class="form-control" value="<?php  echo $res['password'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所属组别<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <?php  if(is_array($groups)) { foreach($groups as $group) { ?>
                                        <label class="checkbox-inline"><input  <?php  if(in_array($group,$res['groupid'])) { ?> checked="checked" <?php  } ?> type="checkbox" name="groupid[]" value="<?php  echo $group;?>"><?php  echo $group;?></label>
                                        <?php  } } ?>
                                        <!-- <select name="groupid" class="form-control">
                                            <option value="在线专家">在线专家</option>
                                            <option value="审核专家">审核专家</option>
                                            <option value="词条专家">词条专家</option>
                                        </select> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">工作状态<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="gzstype" class="form-control valid" aria-invalid="false">
                                            <option value="1" <?php  if($res['gzstype'] =='1') { ?> selected="selected" <?php  } ?>>工作中</option>
                                            <option value="0" <?php  if($res['gzstype'] =='0') { ?> selected="selected" <?php  } ?>>休息中</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所属机构<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">


                                        <div class="row row-fix tpl-category-container">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            
                                                <select class="form-control tpl-category-parent we7-select" id="category_parentjg" name="qx_id" required="">
                                                    <option>请选择一级分类</option>
                                                    <option value="1" <?php  if($res['qx_id'] =='1') { ?> selected <?php  } ?>>医院</option>
                                                    <option value="2" <?php  if($res['qx_id'] =='2') { ?> selected <?php  } ?>>药房</option>
                                                    <option value="3" <?php  if($res['qx_id'] =='3') { ?> selected <?php  } ?>>体检机构</option>
                                                    <option value="4" <?php  if($res['qx_id'] =='4') { ?> selected <?php  } ?>>诊所</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <select class="form-control tpl-category-child we7-select" id="category_childjg" name="hid" required="">
                                                    <option>请选择二级分类</option>
                                                    <?php  if(is_array($quanxian2)) { foreach($quanxian2 as $qx) { ?>
                                                    <option value="<?php  echo $qx['hid'];?>" <?php  if($res['hid'] == $qx['hid']) { ?> selected <?php  } ?>><?php  echo $qx['agentname'];?></option>
                                                    <?php  } } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否在列表显示</label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="listshow" value="0" <?php  if($res['listshow'] =='0' | !$res) { ?> checked="" <?php  } ?>> 显示
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="listshow" value="1" <?php  if($res['listshow'] =='1') { ?> checked="" <?php  } ?>> 隐藏
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">专家状态</label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="exa" value="0"  <?php  if($res['exa'] =='0') { ?> checked="checked"<?php  } ?>> 待入驻
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="exa" value="1" <?php  if($res['exa'] =='1' || !$res) { ?> checked="checked"<?php  } ?>> 已入驻
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="exa" value="2" <?php  if($res['exa'] =='2') { ?> checked="checked"<?php  } ?>> 暂停中
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">到期时间<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <?php  echo tpl_form_field_date('endtime', $res['endtime'],true);?>   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否绿通<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="is_green" value="0"  <?php  if($res['is_green'] =='0') { ?> checked="checked"<?php  } ?>> 否
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="is_green" value="1" <?php  if($res['is_green'] =='1' || !$res) { ?> checked="checked"<?php  } ?>> 是
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否陪诊<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="is_examine" value="0"  <?php  if($res['is_examine'] =='0') { ?> checked="checked"<?php  } ?>> 否
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="is_examine" value="1" <?php  if($res['is_examine'] =='1' || !$res) { ?> checked="checked"<?php  } ?>> 是
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否加急<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="is_urgent" value="0"  <?php  if($res['is_urgent'] =='0') { ?> checked="checked"<?php  } ?>> 否
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="is_urgent" value="1" <?php  if($res['is_urgent'] =='1' || !$res) { ?> checked="checked"<?php  } ?>> 是
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--专家设置-->
                    <div class="tab-pane" id="tab_2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                专家设置
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">问诊排班设置<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="jobtime" class="form-control">
                                        <option value="" <?php  if('' == $res['jobtime'] || $res['jobtime'] == '0') { ?> selected="selected" <?php  } ?>>请选择排班</option>
                                        <?php  if(is_array($jobtime)) { foreach($jobtime as $time) { ?>
                                            <option value="<?php  echo $time['id'];?>" <?php  if($time['id'] == $res['jobtime']) { ?> selected="selected" <?php  } ?>><?php  echo $time['title'];?></option>
                                        <?php  } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">挂号排班设置<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="register_jobtime" class="form-control">
                                        <option value="" <?php  if('' == $res['register_jobtime'] || $res['register_jobtime'] == '0') { ?> selected="selected" <?php  } ?>>请选择排班</option>
                                        <?php  if(is_array($jobtimes)) { foreach($jobtimes as $times) { ?>
                                            <option value="<?php  echo $times['id'];?>" <?php  if($times['id'] == $res['register_jobtime']) { ?> selected="selected" <?php  } ?>><?php  echo $times['title'];?></option>
                                        <?php  } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">问诊订单抽成</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="cut" class="form-control" value="<?php  echo $res['cut'];?>">
                                        <div class="help-block">问诊订单抽成</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">开药订单抽成</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="ky_cut" class="form-control" value="<?php  echo $res['ky_cut'];?>">
                                        <div class="help-block">开药订单抽成</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">专家视频</label>
                                    <div class="col-sm-9">

                                       <?php  echo tpl_form_field_video('video',$res['video'])?>
                                        <div class="help-block">专家视频</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">视频封面</label>
                                    <div class="col-sm-9">

                                       <?php  echo tpl_form_field_image('video_thumb',$res['video_thumb'])?>
                                        <div class="help-block">视频封面</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">身份证正面</label>
                                    <div class="col-sm-9">

                                       <?php  echo tpl_form_field_image('sfzimgurl1back',$res['sfzimgurl1back'])?>
                                        <div class="help-block">身份证正面</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">身份证反面</label>
                                    <div class="col-sm-9">
                                       <?php  echo tpl_form_field_image('sfzimgurl2back',$res['sfzimgurl2back'])?>
                                        <div class="help-block">身份证反面</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">虚拟月回答</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="xn_reoly" class="form-control" value="<?php  echo $res['xn_reoly'];?>">
                                        <div class="help-block">当前月回答次数</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">虚拟月处方</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="xn_cf" class="form-control" value="<?php  echo $res['xn_cf'];?>">
                                        <div class="help-block">当前月处方数</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">响应时间</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="xytime" class="form-control" value="<?php  echo $res['xytime'];?>">
                                        <div class="help-block">分钟数</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">专家证件</label>
                                    <div class="col-sm-9">
                                       <?php  echo tpl_form_field_image('zgzimgurl1back',$res['zgzimgurl1back'])?>
                                    </div>
                                </div>
                                <div class="form-group" style="">
                                    <label class="col-sm-2 control-label">专家简介</label>
                                    <div class="col-sm-9" style="">
                                       <textarea rows="6" cols="20" class="form-control ng-pristine ng-untouched ng-valid ng-empty"  name="z_content" id="z_content"><?php  echo $res['z_content'];?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--代理商结算提现设置-->
                    <div class="tab-pane" id="tab_3">

                        <div class="panel panel-default">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="20%">服务开通</th>
                                            <th class="text-center" width="20%">普通用户(问诊价格)</th>
                                            <th class="text-center" width="10%">免费追问次数</th>
                                            <th class="text-center" width="20%">会员用户（问诊价格）</th>
                                            <th class="text-center" width="10%">免费追问次数</th>
                                            <th class="text-center" width="10%">开关</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php  if(is_array($data_list2)) { foreach($data_list2 as $key => $item) { ?>
                                        <tr>
                                            <input type="hidden" name="plugin[info][<?php  echo $key;?>][ids]" value="<?php  echo $item['ids'];?>">
                                            <input type="hidden" name="plugin[info][<?php  echo $key;?>][key_words]" value="<?php  echo $item['key_words'];?>">
                                            <input type="hidden" name="plugin[info][<?php  echo $key;?>][bid]" value="<?php echo
                                             !$item['id']?$item['bid']:$item['id']?>">
                                            <input type="hidden" name="plugin[info][<?php  echo $key;?>][titlme]" value="<?php  echo $item['titlme'];?>">
                                            <input type="hidden" name="plugin[info][<?php  echo $key;?>][time]" value="<?php  echo date('Y-m-d H:i:s');?>">
                                            <input type="hidden" name="plugin[info][<?php  echo $key;?>][time_leng]" value="<?php  echo $item['time_leng'];?>">
                                            <input type="hidden" name="plugin[info][<?php  echo $key;?>][money]" value="<?php  echo $item['money'];?>">
                                            <td style="text-align: center;"><?php  echo $item['titlme'];?></td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="输入问诊价格" name="plugin[info][<?php  echo $key;?>][ptmoney]" value="<?php  echo $item['ptmoney'];?>" />
                                            </td>
                                            <td>
                                                <input class="form-control" type="number" name="plugin[info][<?php  echo $key;?>][ptzhuiw]" value="<?php  echo $item['ptzhuiw'];?>" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="输入问诊价格" name="plugin[info][<?php  echo $key;?>][hymoney]" value="<?php  echo $item['hymoney'];?>" />
                                            </td>
                                            <td>
                                                <input class="form-control" type="number" name="plugin[info][<?php  echo $key;?>][hyzhuiw]" value="<?php  echo $item['hyzhuiw'];?>" />
                                            </td>
                                            <td>
                                                <input type="checkbox" class="js-switch" name="plugin[info][<?php  echo $key;?>][stateback]" value="1" <?php  if($item['stateback'] =='1') { ?> checked="checked" <?php  } ?>>
                                            </td>
                                        
                                        </tr>
                                         <?php  } } ?>
                                       

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-9">
                            <input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                            <input type="hidden" name="zid" value="<?php  echo $zid;?>" />
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
                window.optionchanged = false;
                $('#myTab a').click(function (e) {
                    e.preventDefault();//阻止a链接的跳转行为
                    $(this).tab('show');//显示当前选中的链接及关联的content
                })
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
<script type="text/javascript">
    function checkValidate(e)
    {
        console.log(111)
        return
      var username = $("#username").val();
      if(username=='admin'){
        util.tips("禁止使用admin");
        return false;
      }
    }

</script>

<script type="text/javascript">
    $('.star').click(function(){
        var _t = $(this);
        var star = _t.attr('alt');
        $('#star').val(star);
        $('.caption').html('');
        if(star==1){
            $('.caption').html('<span class="label label-default">非常差</span>');
        }else if(star==2){
            $('.caption').html('<span class="label label-warning">不太好</span>');
        }else if(star==3){
            $('.caption').html('<span class="label label-info">一般</span>');
        }else if(star==4){
            $('.caption').html('<span class="label label-success">很好!</span>');
        }else if(star==5){
            $('.caption').html('<span class="label label-danger">非常棒!!</span>');
        }
        $(".star").each(function(){
            $(".rating-container").find('img').each(function(){
                var _this = $(this);
                if(_this.attr('alt') <= star){
                    _this.attr('src','../addons/hyb_yl/web/resource/images/star-on-big.png');
                }else{
                    _this.attr('src','../addons/hyb_yl/web/resource/images/star-off-big.png');
                }
            }
            );
        });

    });
</script>

<script type="text/javascript">
    $("#category_parent").on("change",function(){
    
     var id = $(this).val()
     //查询二级
        $.post("/index.php?c=site&a=entry&do=team&op=ajax&type=all&m=hyb_yl&id="+id,{id:id},function (res) {
              
                $("select[name='parentid']").empty();
                var html = "<option value='0'>请选择二级分类</option>";
                $(res).each(function (v, k) {

                    html += "<option value='" + k.id + "'>" + k.name + "</option>";
                });
                //把遍历的数据放到select表里面
                $("select[name='parentid']").append(html);

            },'json');
    });

    $("#category_child").on("change",function(){
    
     var id = $(this).val()
     //查询二级

        $.post("/index.php?c=site&a=entry&do=team&op=ajax&type=detail&m=hyb_yl&id="+id,{id:id},function (res) {
            console.log(res)
                var html="";
                $(res.description).each(function (v, k) {
                    html += "<label class='checkbox-inline'>";
                    html += "<input type='checkbox' name='authority[]' value='"+k+"'>"+ k +"</input>";
                    html += "</label>";
                });
            
                 $("#biaoqian").html(html);
            },'json');
    });

//机构
    $("#category_parentjg").on("change",function(){
    
     var id = $(this).val()
     //查询二级
        $.post("/index.php?c=site&a=entry&do=team&op=ajax&type=jgall&m=hyb_yl&id="+id,{id:id},function (res) {
              console.log(res)
                $("select[name='hid']").empty();
                var html = "<option value='0'>请选择二级分类</option>";
                $(res).each(function (v, k) {

                    html += "<option value='" + k.hid + "'>" + k.agentname + "</option>";
                });
                //把遍历的数据放到select表里面
                $("select[name='hid']").append(html);

            },'json');
    });


</script>

<script src="<?php  echo HYB_YL_ADMIN?>/js/user.js" type="text/javascript"></script> 
</body>
</html>