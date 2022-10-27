<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<!-- 订阅消息列表 -->
<div class="app-container-right">
    <ul class="nav nav-tabs" id="myTab">
        <li class="active">
            <a href="javascript:;">小程序设置</a>
        </li>
    </ul>
    <div class="app-content">
        <div class="alert alert-warning">
            注意一：去微信公众平台填写合法域名https://api.map.baidu.com(百度地图)
            <br>
            注意二：小程序参数请去mp.weixin.qq.com获取
            <br>
            注意三：先签约后问诊是私人医生模式，开启搜索和关闭搜索主要运作与过审核
        </div>
        <div class="app-form" id="interfaceManagement">
            <form action="" method="post" novalidate="novalidate">
                <div class="panel-heading">基础设置</div>
                <div class="tab-content">
                    <div class="form-group">

                        <label class="col-sm-2 control-label">小程序标题</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control max128 J-isDisable" value="<?php  echo $res['show_title'];?>" required="" name="show_title">
                            <span class="help-block">不填则小程序没有标题</span>
                        </div>
                    </div>

<!--                     <div class="form-group">
                        <label class="col-sm-2 control-label">首页幻灯片</label>
                        <div class="col-sm-9">

                            <?php  echo tpl_form_field_multi_image('show_thumb', $res['show_thumb'])?>
                            <span class="help-block">不填则小程序首页无幻灯片，幻灯片尺寸为750x375</span>
                        </div>
                    </div> -->
                </div>

                <div class="panel-heading">地图设置</div>
                <div class="tab-content">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">百度地图key</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control max128 J-isDisable" value="<?php  echo $res['baidukey'];?>" required="" name="baidukey">
                            <span class="help-block">不填则小程序无法定位，要申请服务端应用ak</span>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">版权/授权/处方公章/设置</div>
                <div class="tab-content">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">版权logo</label>
                        <div class="col-sm-9">
                            <?php  echo tpl_form_field_image('bq_thumb', $res['bq_thumb'])?>
                            <span class="help-block">不填则无版权显示</span>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">授权logo</label>
                        <div class="col-sm-9">
                            <?php  echo tpl_form_field_image('yy_thumb', $res['yy_thumb'])?>
                            <span class="help-block">不填则授权页面无logo</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">处方公章</label>
                        <div class="col-sm-9">
                            <?php  echo tpl_form_field_image('slide', $res['slide'])?>
                            <span class="help-block">不填则无版权显示规定大小：250px*250px 必须为jpg格式的公章，否则后果自负</span>
                        </div>

                    </div>
                </div>
                <div class="panel-heading">其他设置</div>
                <div class="tab-content">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">飞鹅云后台注册账号</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control max128 J-isDisable" value="<?php  echo $res['USER'];?>" required="" name="USER">
                            <span class="help-block">不填则无法使用打印小票</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">飞鹅云后台注册账号后生成的UKEY</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control max128 J-isDisable" value="<?php  echo $res['UKEY'];?>" required="" name="UKEY">
                            <span class="help-block">不填则无法使用打印小票</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">打印机编号</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control max128 J-isDisable" value="<?php  echo $res['SN'];?>" required="" name="SN">
                            <span class="help-block">不填则无法使用打印小票</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">小程序全局背景色</label>
                        <div class="col-sm-9">

                            <?php  echo tpl_form_field_color('ztcolor', $res['ztcolor'])?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">帮助手册</label>
                        <div class="col-sm-9">

                            <?php  echo tpl_ueditor('content',$res['content']);?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">先签约后问诊</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input type="radio" name='state' value='1' <?php  if($res['state']=='1' ) { ?> checked="checked" <?php  } ?>>是
                                       </label>
                                       <label class="radio-inline">
                                <input type="radio" name='state' value='0' <?php  if($res['state']=='0' || !$res) { ?> checked="checked" <?php  } ?>>否
                                       </label>
                                       </div>
                                       </div>
                                       <div class="form-group">
                                <label class="col-sm-2 control-label">是否开启搜索</label>
                                <div class="col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" name='is_search' value='1' <?php  if($res['is_search']=='1' ) { ?> checked="checked" <?php  } ?>>是
                                               </label>
                                               <label class="radio-inline">
                                        <input type="radio" name='is_search' value='0' <?php  if($res['is_search']=='0' || !$res) { ?> checked="checked" <?php  } ?>>否
                                               </label>
                                               </div>
                                               </div>
                                <div class="tab-content">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">搜索设置</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control max128 J-isDisable" value="<?php  echo $res['search_title'];?>" required="" name="search_title">
                                            
                                        </div>
                                    </div>
                                </div>
                                               <div class="form-group">
                                <label class="col-sm-2 control-label">是否首页展示机构</label>
                                <div class="col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" name='is_hospital' value='1' <?php  if($res['is_hospital']=='1' ) { ?> checked="checked" <?php  } ?>>是
                                               </label>
                                               <label class="radio-inline">
                                        <input type="radio" name='is_hospital' value='0' <?php  if($res['is_hospital']=='0' || !$res) { ?> checked="checked" <?php  } ?>>否
                                               </label>
                                               </div>
                                               </div>

                                               <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-9">
                                            <button class="btn btn-primary btn-sml J-submit-btn" type="submit">保存</button>
                                            <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                                        </div>
            </form>
        </div>
    </div>
</div>
</div>


<!--[if IE]>
<script src="//assets.dxycdn.com/app/DXYClinic/test/vendor/lib/bootstrap/html5shiv.js?t=1560312126"></script>
<script src="//assets.dxycdn.com/app/DXYClinic/test/vendor/lib/bootstrap/respond.min.js?t=1560312126"></script>
<link href="//assets.dxycdn.com/app/DXYClinic/test/vendor/lib/bootstrap/respond-proxy.html?t=1560312126" id="respond-proxy" rel="respond-proxy" />
<link href="/Public/sites/crossdomain/respond.proxy.gif?t=1560312126" id="respond-redirect" rel="respond-redirect" />
<script src="/Public/sites/crossdomain/respond.proxy.js?t=1560312126"></script>
<![endif]-->


</body>

</html>