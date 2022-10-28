<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<style>
  .df{
    display:flex;
    align-items: center;
  }
  .tab_cg{
    border:1px solid #eaeaea;
    margin-left:20px;
  }
  .tab_text,.tab_btn{
    padding: 5px 10px;
  }
  .tab_btn{
    border-left:1px solid #eaeaea;
  }
  button{
    outline: none;
  }
  .tabBox{
    margin-top:20px;
  }
  label{
    margin:0;
  }
  .tab_box{
    height:200px;
    overflow:hidden;
    overflow-y:auto;
    margin-top:20px;
  }
  .tab{
    display:inline-block;
    padding:5px;
    border:1px solid #eaeaea;
    margin-right:10px;
    cursor: pointer;
  }
  
  .tabBox label{
    white-space: nowrap;
  }
  #tabBox_xz{
    flex-wrap:wrap;
    max-height:200px;
    overflow:hidden;
    overflow-y:auto;
  }
    #tabBox_xz .tab_cg{
    margin-bottom:10px;
  }
  .tab:hover{
    background:#2aabd2;
    color:#fff;
  }
  #myModal{
    background: rgba(0,0,0,0.5)
  }
  .we7-modal-dialog, .modal-dialog{
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin-top: 100px;
    margin-left: auto;
    margin-right: auto;
  }
  /*账户充值样式*/
   .recharge_info{display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;justify-content: space-around;margin-bottom: 10px;}
.recharge_info>div{-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;border:1px solid #efefef;padding:10px 22px;line-height: 25px;color: #333;}
.recharge_info>div:first-child{margin-right: 10px;}
.recharge_info>div:last-child{margin-left: 10px;}
.zhe{background: rgba(0,0,0,0.6);position: fixed;display: flex;align-items: center;justify-content: center;width: 100%;height: 100%;top: 0;left: 0;}
.modal-dialog{position: initial;}
  /*账户充值end*/
  .text-warning {
    color: #f8ac59;
    white-space: nowrap;
    width: 180px;
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
<div class="app-container-right">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#">用户列表</a>
        </li>
    </ul>
    <div class="app-content">
        <div class="app-filter">
            <div class="filter-list">
                <form action="" method="get" class="form-horizontal" role="form" id="form1">
                    <input type="hidden" name="c" value="site" />
                    <input type="hidden" name="a" value="entry" />
                    <input type="hidden" name="m" value="hyb_yl" />
                    <input type="hidden" name="op" value="userlist" />
                    <input type="hidden" name="ac" value="notice" />
                    <input type="hidden" name="do" value="copysite" />
                    <input type="hidden" name="act" value="profile.userlist" />
                    <input type="hidden" name="zhuangtai" value="<?php  echo $_GPC['zhuangtai'];?>">
                    <div class="form-group form-inline">
                        <label class="col-sm-2 control-label">用户筛选</label>
                        <div class="col-sm-9">
                            <select name="keywordtype" class="form-control">
                                <option value="">--请选择--</option>
                                <option value="1" <?php  if($_GPC['keywordtype']=='1') { ?> selected <?php  } ?>>病案号</option>
                                <option value="2" <?php  if($_GPC['keywordtype']=='2') { ?> selected <?php  } ?>>手机号</option>
                                <option value="3" <?php  if($_GPC['keywordtype']=='3') { ?> selected <?php  } ?>>昵称</option>
                            </select>
                            <input type="text" name="keyword" class="form-control" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键字" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户状态</label>
                        <div class="col-sm-9">
                            <div class="btn-group">
                                <a href="./index.php?c=site&a=entry&op=userlist&do=copysite&m=hyb_yl&act=profile.userlist&ac=notice&zhuangtai=0" class="btn  <?php  if($_GPC['zhuangtai']=='0' || empty($_GPC['zhuangtai'])) { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">不限</a>
                                <a href="./index.php?c=site&a=entry&op=userlist&do=copysite&m=hyb_yl&act=profile.userlist&ac=notice&zhuangtai=1" class="btn <?php  if($_GPC['zhuangtai']=='1') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">正常</a>
                                <a href="./index.php?c=site&a=entry&op=userlist&do=copysite&m=hyb_yl&act=profile.userlist&ac=notice&zhuangtai=2" class="btn <?php  if($_GPC['zhuangtai']=='2') { ?> btn-primary <?php  } else { ?> btn-default <?php  } ?>">黑名单</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户身份</label>
                        <div class="col-sm-4">
                            <select name="groupid" style="width: 100%;">
                                <option value="">全部用户</option>
                                <option value="1" <?php  if($_GPC['groupid']=='1') { ?> selected <?php  } ?>>普通用户</option>
                                <option value="2" <?php  if($_GPC['groupid']=='2') { ?> selected <?php  } ?>>会员用户</option>

                                <!-- <option value="26">年卡用户</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-md-9">
                            <button class="btn btn-primary" type="submit">筛选</button>
                        </div>
                    </div>
                </form>
     
                <div class="filter-action">
            <a href="./index.php?c=site&a=entry&op=sendmsg&do=copysite&m=hyb_yl&act=profile.addusers&ac=notice"class="btn btn-primary">添加用户</a>
        </div>
                
            </div>
        </div>
        <div class="app-table-list">
            <div class="table-responsive">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th style="width: 250px;">用户</th>
                            <th style="">性别年龄</th>
                            <th style="">病案号</th>
                            <th style="">处方单</th>
                            <th style="">检查报告</th>
                            <th style="">优惠券</th>
                            <th style="">患者标签</th>
                            <th style="">用户身份</th>
                            <th style="">会员等级</th>
                            <th style="">用户积分</th>
                            <th style="">注册时间</th>
                            <th style="">最后登录时间</th>
                            <th style="width: 350px;text-align: right;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($listarray)) { foreach($listarray as $item) { ?>
                        <tr>
                            <td style="overflow: visible"><!-- <span>总消费：</span>6000元<br/>-->
                                <div rel="pop" style="display: flex" data-content=" 
                                    <span>ID: </span><?php  echo $item['u_id'];?> </br>                                                                    
                                    <span>真实姓名：</span> <?php  if(empty($item['zhenshixingming'])) { ?> 未填写 <?php  } else { ?> <?php  echo $item['zhenshixingming'];?> <?php  } ?><br/>
                                    <span>手机号：</span><?php  if($item['telphone'] =='') { ?> 未绑定 <?php  } else { ?> <?php  echo $item['telphone'];?>   <?php  } ?><br/>
                                    <span>问诊次数：</span><?php  echo $item['numcount'];?> <br/>
                                    <span>购药订单：</span><?php  echo $item['gycount'];?> <br/>
                                    <span>体检订单：</span><?php  echo $item['tjcount'];?> <br/>
                                    <span>挂号订单：</span><?php  echo $item['ghcount'];?> <br/>
                                   
                                
                                    <span>推荐人：</span>无 <br/>
                                    <span>用户来源：</span><i>自然进入</i><br/>
                                    <span>状态:</span><?php  if($item['type'] =='1') { ?> 正常 <?php  } else { ?> 黑户 <?php  } ?>">
                                    <img class="img-40" src="<?php  echo $item['u_thumb'];?>" style='border-radius:50%;border:1px solid #efefef;' onerror="this.src='<?php  echo $item['u_thumb'];?>'" height="40" width="40" />
                                    <span style="display: flex;flex-direction: column;justify-content: center;align-items: flex-start;padding-left: 5px">
                                        <span class="nickname">
                                            <?php  echo $item['u_name'];?> </span>
                                    </span>
                                </div>
                            </td>
                            <td style="position: relative;">
                                <span class="label label-info"><?php  if(!empty($item['xingbie']) ) { ?> <?php  echo $item['xingbie'];?>  <?php  } else { ?> 未知 <?php  } ?></span>
                                <br />
                                <span class="label label-warning" style="display: inline-block;margin-top: 5px;"><?php  if(!empty($item['nianlin']) ) { ?> <?php  echo $item['nianlin'];?>岁 <?php  } else { ?> 未知 <?php  } ?> </span>
                            </td>
                            <td style="position: relative;">
                                <?php  echo $item['randnum'];?>
                            </td>
                            <td style="position: relative;">
                                <a>共计<?php  echo $item['cfcount'];?>单</a>
                            </td>
                            <td style="position: relative;">
                                <a>共计检查报告<?php  echo $item['baogao'];?>单</a>
                            </td>
                            <td style="position: relative;">
                                <a>优惠券<?php  echo $item['yhqcount'];?>张</a>
                            </td>
                            <td style="overflow: visible">
                                <?php  if(empty($item['u_label'])) { ?>
                                无
                                <?php  } else { ?>
                                <div rel="pop" style="display: flex" data-content=" <span><?php  echo $item['u_label'];?> </br>">
                                    
                                    <span style="display: flex;flex-direction: column;justify-content: center;align-items: flex-start;padding-left: 5px">
                                        <span class="nickname"><?php  echo $item['u_label'];?> </span>
                                    </span>
                                </div>
                                <?php  } ?>
                            </td>
                            <td style="position: relative;">
                                <span class="text-info"><?php  if($item['admintype'] =='1') { ?>会员用户<?php  } else { ?> 普通用户<?php  } ?></span>
                            </td>
                            <td style="position: relative;"> <?php  echo $item['vip'];?></td>
                            <td style="position: relative;"> <?php  echo $item['num'];?></td>
                            <td style="position: relative;"> <?php  echo $item['zctime'];?></td>
                            <td style="position: relative;"> <?php  echo $item['longtime'];?></td>

                            <td style="position: relative;text-align: right;">
                                <?php  if($item['is_tips'] == '1') { ?>
                                <a class="btn btn-warning btn-sm send"  data-toggle="ajaxModal" href="./index.php?c=site&a=entry&op=sendmsg&do=copysite&m=hyb_yl&act=profile.sendmsg&ac=notice&u_id=<?php  echo $item['u_id'];?>" >发送消息</a>
                                <?php  } ?>
                                <a class="btn btn-primary btn-sm" href="/index.php?c=site&a=entry&op=suifanglist&do=physical&m=hyb_yl&ac=suifanglist&u_id=<?php  echo $item['u_id'];?>&u_openid=<?php  echo $item['u_openid'];?>&id=<?php  echo $item['id'];?>" title="">随访记录</a>



                                <a class="btn btn-primary btn-sm" href="/index.php?c=site&a=entry&op=adduser&do=copysite&m=hyb_yl&act=profile.adduser&ac=notice&u_id=<?php  echo $item['u_id'];?>&openid=<?php  echo $item['u_openid'];?>" title="">档案</a>
                                <!-- <a class="btn btn-info btn-sm" href="">订单</a> -->
                                 <a class="btn btn-info btn-sm biaoqian"  data-toggle="ajaxModal" href="./index.php?c=site&a=entry&op=userlabel&do=copysite&m=hyb_yl&act=profile.userlabel&ac=notice&u_id=<?php  echo $item['u_id'];?>">标签</a>
                                <a class="btn btn-warning btn-sm ajaxModal" data-toggle="ajaxModal" href="./index.php?c=site&a=entry&op=rechargeuser&do=copysite&m=hyb_yl&act=profile.rechargeuser&ac=notice&u_id=<?php  echo $item['u_id'];?>" >账户</a>
                                <?php  if($item['type']=='1') { ?>
                                <a class="btn btn-default btn-sm" data-toggle='ajaxRemove' href="./index.php?c=site&a=entry&op=rechargeuser&do=copysite&m=hyb_yl&act=profile.saveusertype&ac=notice&caozuo=yes&u_id=<?php  echo $item['u_id'];?>" data-confirm="被加入黑名单的用户无法再访问并被删除所有，确认要拉黑用户吗？">拉黑</a>
                                <?php  } else { ?>
                                <a class="btn btn-default btn-sm" data-toggle='ajaxRemove' href="./index.php?c=site&a=entry&op=rechargeuser&do=copysite&m=hyb_yl&act=profile.saveusertype&ac=notice&caozuo=no&u_id=<?php  echo $item['u_id'];?>" data-confirm="确认要取消拉黑用户吗？">取消拉黑</a>
                                <?php  } ?>
                                 <a class="btn btn-danger btn-sm" data-toggle='ajaxRemove' href="./index.php?c=site&a=entry&op=deleteuser&do=copysite&m=hyb_yl&act=profile.deleteuser&ac=notice&u_id=<?php  echo $item['u_id'];?>" data-confirm="确定要删除该会员吗？">删除</a>
                            </td>
                        </tr>
                    <?php  } } ?>
                    </tbody>
                </table>
            </div>
            <div class="app-table-foot clearfix">
                <div class="pull-left">

                </div>
                <div class="pull-right"><?php  echo $pager;?></div>
            </div>
        </div>
    </div>
</div>
  <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>
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



