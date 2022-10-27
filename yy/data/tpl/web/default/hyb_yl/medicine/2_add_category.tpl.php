<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<!-- 订阅消息列表 -->

<div class="app-container-right">
            <ul class="nav nav-tabs">
    <li ><a href="<?php  echo $this->createWeburl('medicine',array('op'=>'categry','type_id'=>$type_id))?>">分类列表</a></li>
    <li class="active"><a href="<?php  echo $this->createWeburl('medicine',array('op'=>'add_category','type_id'=>$type_id))?>">添加分类</a></li>
</ul>
<div class="app-content">
    <div class="app-form">
        <form action="" method="post" class="form-horizontal form" onsubmit="return formcheck(this);">
            <div class="tab-content">
                <div class="tab-pane  active">
                    <div class="panel panel-default">
                        <div class="panel-heading">添加分类</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">分类排序</label>
                                <div class="col-sm-9">
                                    <input type="number" placeholder="数字越大，排序越靠前。" name="sort" class="form-control" value="<?php  echo $item['sort'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span style="color: red;">*</span>分类名称</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="本项必须填写" name="fenlname" class="form-control" value="<?php  echo $item['fenlname'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span style="color: red;">*</span>分类logo</label>
                                <div class="col-sm-9" id="logo_upload">
                                    <?php  echo tpl_form_field_image('fenlpic', $item['fenlpic'])?>
                                </div>
                            </div>
        
                            <div class="form-group">
                                <label class="col-sm-2 control-label">首页展示</label>
                                <div class="col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" value="1" name="rec" <?php  if($item['rec'] == '1') { ?> checked <?php  } ?> /> 显示
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="0" name="rec" <?php  if($item['rec'] == '0') { ?> checked <?php  } ?>/> 隐藏
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-9">
                    <input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
                    <input type="hidden" name="token" value="c5514e9f" />
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function formcheck(){
        if($("input[name='category[name]']").val() == ''){
            layer.alert('请填写分类名称');
            return false;
        }
        return true;
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

