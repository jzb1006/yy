<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<link href="https://assets.dxycdn.com/app/DXYClinic/test/business/css/style.default.min.css?t=1582515292" rel="stylesheet">
<style>
    .we7-modal-dialog, .modal-dialog{
    top:0;
  left:0;
  }
  select{
    height:41px!important;
    line-height: 21px!important;
  }
  .trbody td {text-align: center; vertical-align:top;border-left:1px solid #ccc; border-bottom: 1px solid #ddd;}
    .order-rank img{width:16px; height:16px;}
    .js-remark,.js-admin-remark{word-break:break-all; overflow:hidden; background: #FDEEEE;color: #ED5050;padding: 5px 10px;}
    td.goods-info{position:relative; padding-left:60px;}
    .goods-info .img{position:absolute;top:50%; margin-top:-25px; background: url(https://xiaochuang.webstrongtech.net/addons/hyb_yl/web/resource/images/loading.gif) center center no-repeat; width:50px;height:50px; }
    .goods-info span {white-space: inherit;overflow: hidden;text-overflow: ellipsis;display: block;}
    .status-text{cursor:pointer;}
    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {border-top: 1px solid rgba(221, 221, 221, 0);}
    .col-md-1{padding-right: 0px;}
    .asd{cursor: pointer;}
    .cont_text{width: 240px;display: block;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;text-align: left;}
    .name_text{overflow: hidden;text-overflow: ellipsis;width: 200px;white-space: nowrap;}
  .modal-dialog{
    margin:15px auto;
  }
  .we7-form .form-group, form .form-group{
   margin-bottom:10px; 
  }
  #tab3 .row{
    display:flex;
  }
  #tab3 .row ul li{
    white-space: nowrap;
    padding:10px;
    cursor: pointer;
    width:100px;
    text-align:center;
  }
  .ractive{
    color:#fff;
    background:#1ab394;
  }
  .btnBox{
    display:flex;
    align-items: center;
    justify-content: space-around;
  }
  .mr10{
    margin-right:10px;
  }
  .content_wrap.image{
     width: 100px;
  }
  .cont_box{
    display: flex;
    justify-content: space-between;
  }
  .ul_scroll{overflow: hidden;overflow-y: auto;max-height: 600px;margin-right: 10px;width: 8%}
  .ul_scroll li{padding:10px 0;width:100%;font-size: 18px;border: 1px solid #eaeaea;text-align: center;}
  .ul_scroll_active{background: #4381c6;color: #fff;}
</style>


<!--??????????????????-->
<style>
    .labelTip {
        width: 14px;
        height: 14px;
        display: inline-block;
        margin-right: 7px;
        margin-top: 1px;
        background-color: #4381c6;
        border-radius: 100%;
    }

    .recordInfo {
        padding-left: 24px;
    }

    .boxTitle {
        margin-bottom: 30px;
        height: 16px;
        line-height: 16px;
        color: #4a4a4a;
        font-size: 16px;
    }

    .boxBtn {
        height: 32px;
        line-height: 32px;
    }

    .floatL {
        float: left;
    }

    .floatR {
        float: right;
    }

    .boxBtn .btnGoInfo {
        margin-right: 14px;
        color: #4381c6;
        font-size: 14px;
        cursor: pointer;
    }

    .boxBtn {
        margin-bottom: 20px;
    }

    .is-active{
        background-color: #fff;
        border-color: #4381c6 !important;
        color: #4381c6;
        box-shadow: -1px 0 0 0 #409eff;
    }

    .el-radio-button__inner {
        padding: 0;
        height: 32px;
        line-height: 32px;
        text-align: center;
    }

    .chineseInfo {
        margin-top: 26px;
        margin-bottom: 0;
        color: #f65952;
        font-size: 14px;
    }

    .boxMeds {
        width: calc(80% - 30px);
        border-right: 1px solid #d8d8d8;
        padding-right: 17px;
    }

    .boxDays {
        width: calc(20% - 33px);
        padding-left: 20px;
        position: absolute;
        bottom: 0;
        left: calc(80% - 12px);
    }

    .marginR20 {
        margin-right: 20px;
    }

    .boxUse {
        margin-top: 5px;
        margin-bottom: 0;
        color: #f65952;
    }

    .mb30 {
        margin-bottom: 30px;
    }

    .consumption-info, .consumption-info-item {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 20px;
    }

    .consumption-info-item {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: end;
        -ms-flex-align: end;
        align-items: flex-end;
        font-size: 13px;
        color: #6d7278;
    }

    .consumption-info-item span {
        display: inline-block;
        font-size: 44px;
        margin: 0 10px;
        -webkit-transform: translateY(8px);
        transform: translateY(8px);
        white-space: nowrap;
    }

    .consumption-info-item .total {
        color: #4381c6;
    }

    .consumption-info-item .cash {
        color: #ef4646;
    }

    .consumption-info-item .healthCare {
        color: #f5a623;
    }

    .consumption-info-item .wechat {
        color: #50af64;
    }

    .consumption-info-item .alipay {
        color: #30a2ff;
    }
    .consumption-search-type-text{
        color: rgba(0,0,0,.65);
        white-space: nowrap;
    }
    .df{
        display: flex;
        align-items: center;
        margin-right: 20px;
    }
    .consumption-search-btn-search {
        margin-left: 27px;
        width: 80px;
        height: 32px;
        line-height: 32px;
        font-size: 14px;
        padding: 0;
        background-color: #4381c6;
        border: none;
        color: #fff;
    }.df>select{padding: 0}
    .df>select,.consumption-info input{
        height: 32px!important;
        line-height: 32px!important;
        box-sizing: border-box;
    }
    .el-button--primary:focus, .el-button--primary:hover {
        background: #66b1ff;
        border-color: #66b1ff;
        color: #fff;
        box-shadow: 0 0 4px 0 #66b1ff;
    }
    .consumption-table-detail {
        color: #4381c6;
        cursor: pointer;
    }
    .el-radio-group{
        display: flex;
        
    }
    .el-radio-button:nth-child(1){
        border: 1px solid #eaeaea;
        border-radius: 5px;
        border-top-right-radius:0; 
        border-bottom-right-radius:0; 
    }
    .el-radio-button{
        border: 1px solid #eaeaea;
        border-radius: 5px;
        border-left: 0;
        height: 32px;
        line-height: 32px;
        padding:0 10px; 
    }

    .ul_scroll{
        overflow: hidden;
        max-height: 500px;
        overflow-y: auto;
        scrollbar-width: none; 
    }
    .ul_scroll::-webkit-scrollbar{/*?????????????????????*/
 
??????width:4px;/*??????????????????????????????????????????*/
 
??????height:4px;
 
??????}
 
??????.ul_scroll::-webkit-scrollbar-thumb{/*????????????????????????*/
 
??????border-radius:5px;
 
??????-webkit-box-shadow:inset005pxrgba(0,0,0,0.2);
 
??????background:rgba(0,0,0,0.2);
 
??????}
 
??????.ul_scroll::-webkit-scrollbar-track{/*?????????????????????*/
 
??????-webkit-box-shadow:inset005pxrgba(0,0,0,0.2);
 
??????border-radius:0;
 
??????background:rgba(0,0,0,0.1);
 
??????}

</style>
<!--????????????end-->
</div>
<div class="pageheader">
    <h2>
        <i class="fa fa-user-md"></i> ????????????
    </h2>
    <div class="breadcrumb-wrapper">
        <a class="btn btn-sm btn-white" onclick="window.history.back();">
            <i class="fa fa-angle-left"></i> ??????
        </a>
    </div>
</div>
<div class="contentpanel">
    <!-- ???????????? -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="row">
                        <input type="hidden" class="J-patientId" name="u_id" value="<?php  echo $u_id;?>">
                        <div class="col-sm-12 col-md-2 mb20">
                            <div class="form-group J-show-img-box">
                                <div class=" mr0">
                                    <div class="image-select avatar-view">
                                        <div class="col-xs-4 col-sm-2 col-md-12">
                                            <img src="<?php  echo $res['u_thumb'];?>" alt="??????">
                                        </div>
                                        <div class="col-xs-8 col-sm-10 col-md-12" id="J-basic-info-wrap">
                                            <h2 class="profile-name"><?php  echo $res['names'];?>
                                                <small class="tooltips font16" data-toggle="tooltip" data-placement="top" data-original-title="<?php  echo $res['region'];?> ??????: <?php  echo $res['tel'];?>">
                                                    <i class="fa fa-phone"></i>
                                                </small>
                                                <span class="display-block pad-inline">
                                                    <span>
                                                        <a href="javascript:void(0);" class="btn btn-default btn-sm J-patient-record">????????????</a>
                                                    </span>
                                                </span>
                                            </h2>
                                            <div class="mb20 mbn20"></div>
                                            <ul class="profile-social-list sm-10">
                                                <li>
                                                    <span>????????????<?php  echo $res['randnum'];?></span>
                                                </li>
                                                <li>
                                                    <span>?????????<?php  echo $res['my']['sex'];?></span>
                                                </li>
                                                <li>
                                                    <span>?????????
                                                        <span class="J-age">

                                                            <?php  echo $res['my']['age'];?>???

                                                        </span>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span>?????????<?php  echo $res['my']['shengao'];?>cm

                                                    </span>
                                                </li>
                                                <li>
                                                    <span>?????????<?php  echo $res['my']['tizhong'];?>kg

                                                    </span>
                                                </li>
                                                <li>
                                                    <span>
                                                        ?????????????????????

                                                    </span>
                                                </li>

                                                <li>
                                                    <span>????????????<?php  if($res['my']['allergy_index'] == '1') { ?>????????????<?php  } else { ?> ??? <?php  } ?></span>
                                                </li>
                                                <li>
                                                    <span>???????????????
                                                    <?php  if($res['my']['feritin_index'] == '1') { ?>?????????<?php  } ?>
                                                    <?php  if($res['my']['diabetes_index'] == '1') { ?>?????????<?php  } ?>
                                                    <?php  if($res['my']['feritin_index'] == '0' && $res['my']['diabetes_index'] == '0') { ?>???<?php  } ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span>????????????<?php  if($res['my']['gan_index'] == '1') { ?> ?????? <?php  } else { ?> ?????? <?php  } ?></span>
                                                </li>
                                                <li>
                                                    <span>????????????<?php  if($res['my']['shen_index'] == '1') { ?> ?????? <?php  } else { ?>?????? <?php  } ?></span>
                                                </li>
                                                <li>
                                                    <span>???????????????<?php  echo $res['my']['hunyin'];?></span>
                                                </li>
                                                <li>
                                                    <span>???????????????<?php  if($res['my']['be_index'] == '1') { ?> ??? <?php  } else { ?>??? <?php  } ?></span>
                                                </li>
                                                <li>
                                                    <span>?????????<?php  echo $res['my']['zhiye'];?></span>
                                                </li>
                                                <li>
                                                    <span>?????????<?php  echo $res['my']['xuex'];?>???</span>
                                                </li>
                                                <li>
                                                    <span>????????????<?php  echo $res['my']['region'];?></span>
                                                </li>
                                                <li>
                                                    <span>???????????????<?php  if($res['admintype']==0) { ?>????????????<?php  } else { ?>????????????<?php  } ?></span>
                                                </li>
                                                <?php  if($res['adminuserdj']!='0') { ?>
                                                <li>
                                                    <span>???????????????<?php  echo $res['adminuserdj_name'];?></span>
                                                </li>
                                                <li>
                                                    <span>??????????????????<?php  if($res['adminguanbi']>time()) { ?> <?php  echo date("Y-m-d H:i:s",$res['adminoptime'])?>~ <?php  echo date("Y-m-d H:i:s",$res['adminguanbi'])?><?php  } else { ?>?????????<?php  } ?></span>
                                                </li>
                                                <?php  } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ???????????? -->
                            <div class="form-group J-edit-img-box" style="display: none;" id="crop-avatar" data-url="/Index/uploadImage">
                                <div class="J_image_upload mr0">
                                    <div class="image-select J_image_select avatar-view empty" data-original-title="" title="">
                                        <div class="image-preview">
                                            <img src="//assets.dxycdn.com/app/DXYClinic/test/business/images/child-avatar.png">
                                        </div>
                                        <div class="image-upload">
                                            <a class="btn btn-default btn-sm">????????????</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Cropping modal -->
                                <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="avatar-form" action="" enctype="multipart/form-data" method="post">
                                                <form>
                                                    <div class="modal-header">
                                                        <button class="close" data-dismiss="modal" type="button">??</button>
                                                        <h4 class="modal-title" id="avatar-modal-label">????????????</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="avatar-body">
                                                            <div class="row">
                                                                <div class="avatar-upload col-sm-12">
                                                                    <div class="input-group">
                                                                        <span class="input-group-btn">
                                                                            <div class="btn btn-default image-preview-input">
                                                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                                                <span class="image-preview-input-title">????????????</span>
                                                                                <input class="avatar-src" name="avatar_src" type="hidden">
                                                                                <input class="avatar-data" name="image_data" type="hidden">
                                                                                <input name="is_protected" value="true" type="hidden">
                                                                                <input name="owner_type" value="1" type="hidden">
                                                                                <input name="type" value="1" type="hidden">
                                                                                <input name="media_type" value="image" type="hidden">
                                                                                <input class="avatar-input" id="avatarInput" name="uploadFile" type="file" accept="image/*">
                                                                            </div>
                                                                        </span>
                                                                        <button type="button" class="btn btn-white J-btn-camera ml10 black">
                                                                            <i class="fa fa-camera"></i> ????????????
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Crop and preview -->
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <div class="avatar-wrapper J-show-pic"></div>
                                                                    <video style="display:none;" class="avatar-wrapper" id="video"></video>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="avatar-preview preview-lg"></div>
                                                                    <div class="avatar-preview preview-md"></div>
                                                                    <div class="avatar-preview preview-sm"></div>
                                                                </div>
                                                            </div>
                                                            <div class="row avatar-btns">
                                                                <a class="btn btn-primary btn-block avatar-save" type="javascript:;">??????</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-10">
                            <ul class="nav nav-tabs patient-tabs nav-white mb20 J-pane-body-title">
                                <li class="active">
                                    <a href="#tab1" data-toggle="tab">
                                        <strong>????????????</strong>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#tab2" data-toggle="tab">
                                        <strong>????????????</strong>
                                    </a>
                                </li>
                                <li class="J-module-control" data-modules="16">
                                    <a href="#tab7" data-toggle="tab">
                                        <strong>????????????</strong>
                                    </a>
                                </li>
                                <li class="J-module-control" data-modules="48">
                                    <a href="#tab8" data-toggle="tab">
                                        <strong>????????????</strong>
                                    </a>
                                </li>
                                <li class="J-module-control" data-permission="13">
                                    <a href="#tab4" data-toggle="tab">
                                        <strong>????????????</strong>
                                    </a>
                                </li>
                                <li class="J-module-control" data-permission="72">
                                    <a href="#tab3" data-toggle="tab" class="J-wechat-panel">
                                        <strong>????????????</strong>
                                    </a>
                                </li>
                                <li class="J-module-control" data-permission="72">
                                    <a href="#tab11" data-toggle="tab" class="J-wechat-panel">
                                        <strong>????????????</strong>
                                    </a>
                                </li>
                                <li class="J-module-control" data-permission="72">
                                    <a href="#tab5" data-toggle="tab" class="J-wechat-panel">
                                        <strong>????????????</strong>
                                    </a>
                                </li>

                                <li class="J-module-control" data-permission="72">
                                    <a href="#tab6" data-toggle="tab" class="J-wechat-panel">
                                        <strong>???????????????</strong>
                                    </a>
                                </li>
                                <li class="J-module-control" data-permission="72">
                                    <a href="#tab9" data-toggle="tab" class="J-wechat-panel">
                                        <strong>????????????</strong>
                                    </a>
                                </li>
                                <li class="J-module-control" data-permission="72">
                                    <a href="#tab10" data-toggle="tab" class="J-wechat-panel">
                                        <strong>????????????</strong>
                                    </a>
                                </li>
                                <li class="J-module-control" data-permission="72">
                                    <a href="#tab12" data-toggle="tab" class="J-wechat-panel">
                                        <strong>????????????</strong>
                                    </a>
                                </li>
                            </ul>




                            <div class="tab-content shadow-none pd0" id="J-tab-content-1">
                                <div class="tab-pane" id="tab5">
                                    <table class="table table-profile">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>????????????</th>
                                                <th>????????????</th>
                                                <th>?????????</th>
                                                <th>????????????</th>
                                                <th>????????????</th>
                                                <th>????????????</th>
                                                <th>????????????</th>
                                                <th>??????</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($teamorder)) { foreach($teamorder as $teams) { ?>
                                            <tr>
                                                <td>5</td>

                                                <td>
                                                    <span data-toggle="tooltip" data-placement="top" title="" class="text-lue" style="display: inline-block;max-width: 200px;" data-original-title="<?php  echo $teams['names'];?>">
                                                        <a><?php  echo $teams['names'];?></a>
                                                    </span>
                                                </td>
                                                <td class="text-left">
                                                    <label class="label label-warning"><?php  echo $teams['t_money'];?></label>
                                                </td>
                                                <td class="text-left">
                                                    <label class="label label-warning"><?php  echo $teams['z_name'];?></label>
                                                </td>
                                                <td>
                                                    <?php  echo $teams[''];?>??????
                                                    <br>
                                                </td>
                                                <td class="text-left">
                                                    <label class="label label-success">
                                                        <?php  echo $teams['typs'];?>
                                                    </label>

                                                </td>
                                                <td>
                                                    ???????????????<?php  echo $teams['created'];?> </td>
                                                <td>
                                                    <label class="label label-success">
                                                        ?????????
                                                    </label>
                                                </td>
                                                <td style="position: relative;">

                                                    <a class="btn btn-warning btn-sm chankanBtn" href="javascript:;" data-toggle="" title="????????????">????????????</a>
                                                </td>
                                            </tr>
                                            <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab6">
                                    <table class="table table-profile">
                                        <thead>
                                            <tr>
                                                <th style="width:100px;">???????????????</th>
                                                <th style="width:150px;">????????????</th>
                                                <th style="width:80px; ">??????</th>
                                                <th style="width:150px;">????????????</th>
                                                <th style="width:200px;">?????????????????????</th>
                                                <th style="width:200px; ">????????????</th>
                                                <th style="width:50px; ">??????</th>
                                                <th style="width:100px;">????????????</th>
                                                <th style="width:150px; ">??????</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($couponlist)) { foreach($couponlist as $coupon) { ?>
                                            <tr>
                                                <td style="width:100px;"><?php  echo $coupon['coupon_name'];?></td>
                                                <td style="width:150px;"><?php  echo $coupon['hospital'];?></td>
                                                <td style="width:80px;"><?php  if($coupon['type']=='0') { ?>?????????<?php  } ?></td>
                                                <td style="width:150px;"><?php  echo $coupon['deductible_amount'];?></td>
                                                <td style="width:200px;"><?php  echo $coupon['sub_title'];?></td>
                                                <td style="width:200px;"><?php  echo $coupon['shiyongfuwu'];?></td>
                                                <td style="width:50px;">
                                                    <label class="label label-warning">
                                                        <?php  if($coupon['status']=='0') { ?>?????????
                                                        <?php  } else if($coupon['status']=='1') { ?>?????????
                                                        <?php  } else if($coupon['end_time']<date("Y-m-d",time())) { ?>?????????
                                                                                  <?php  } ?>
                                                                                  </label>
                                                                                  </td>
                                                                                  <td style="width:100px;"><?php  echo $coupon['start_time'];?>~<?php  echo $coupon['end_time'];?>
                                                </td>
                                                <td style="width:150px;">
                                                    <a class="btn btn-danger btn-sm" href="javascript:;" data-id="11">??????</a>
                                                </td>
                                            </tr>
                                            <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- ???????????? -->
                                <div class="tab-pane active" id="tab1">
                                    <div class="table-responsive" id="profile_11">
                                        <table class="table table-profile">
                                            <tbody>

                                                <tr>
                                                    <th colspan="2">????????????

                                                        <span class="pull-right font-normal">
                                                            <a onclick="showOrHide(12, 11)" class="gray J-btn-base-edit">
                                                                <i class="fa fa-pencil"></i> ??????
                                                            </a>
                                                        </span>

                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <strong>?????????</strong>
                                                        <?php  if($res['my']['names']) { ?>
                                                        <?php  echo $res['my']['names'];?>
                                                        <?php  } else { ?>
                                                        <?php  echo $res['u_name'];?>
                                                        <?php  } ?>
                                                    </td>
                                                    <td width="60%">
                                                        <strong>?????????</strong>
                                                        <?php  if(!$res['my']['sex'] ) { ?> ?????? <?php  } else { ?> <?php  echo $res['my']['sex'];?> <?php  } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>???????????????</strong>
                                                        <?php  echo $res['my']['datetime'];?>
                                                    </td>
                                                    <td>
                                                        <strong>?????????</strong>

                                                        <?php  if(!$res['my']['age'] ) { ?> ?????? <?php  } else { ?> <?php  echo $res['my']['age'];?> <?php  } ?>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>????????????</strong>

                                                        <a href="tel:<?php  echo $res['my']['tel'];?>"><?php  echo $res['my']['tel'];?> </a>

                                                    </td>
                                                    <td>

                                                        <strong>??????openid???<?php  echo $res['openid'];?></strong>


                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>???????????????</strong>
                                                        <?php  echo $res['my']['numcard'];?>
                                                    </td>
                                                    <td>
                                                        <strong>???????????????</strong>
                                                        ??????
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>???????????????</strong>
                                                        <?php  if(empty($res['my']['hunyin'])) { ?>??????<?php  } else { ?>??????<?php  } ?>
                                                    </td>


                                                    <td>
                                                        <strong>?????????</strong>
                                                        <?php  echo $res['my']['zhiye'];?>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>????????????</strong>
                                                        <?php  echo $res['randnum'];?>
                                                    </td>
                                                    <td class="J-module-control" data-modules="35">
                                                        <strong>???????????????</strong>
                                                        <span class="J-source-name">????????????</span>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>?????????</strong>
                                                        <?php  echo $res['my']['region'];?>
                                                    </td>
                                                    <td class="J-module-control" data-modules="35">
                                                        <strong>???????????????</strong><?php  echo $res['u_label'];?><?php  echo $biaoqian;?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="" id="profile_12" style="display: none;">
                                        <form class="form-horizontal" method="post" action="">
                                            <input type="hidden" name="do" value="copysite">
                                            <input type="hidden" name="m" value="hyb_yl">
                                            <input type="hidden" name="act" value="profile.edituser">
                                            <input type="hidden" name="ac" value="notice">
                                            <input type="hidden" name="u_id" value="<?php  echo $u_id;?>">
                                            <input type="hidden" name="openid" value="<?php  echo $openid;?>">
                                            <input type="hidden" name="typs" value="base">
                                            <table class="table table-profile">
                                                <tbody>
                                                    <tr>
                                                        <th colspan="2">????????????</th>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%">
                                                            <strong>?????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input name="names" class="form-control" type="text" value="<?php  if($res['my']['names']) { ?><?php  echo $res['my']['names'];?><?php  } else { ?> <?php  echo $res['u_name'];?><?php  } ?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="60%">
                                                            <strong>?????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="sex" id="radioDefault23" value="???" <?php  if($res['my']['sex']=='???' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault23">???</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="sex" id="radioDefault24" value="???" <?php  if($res['my']['sex']=='???' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault24">???</label>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>???????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <?php  echo tpl_form_field_date('datetime', $res['my']['datetime'])?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <strong>????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input name="tel" class="form-control cellphone" type="text" value="<?php  echo $res['my']['tel'];?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td>
                                                            <strong>???????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input name="numcard" class="form-control isPid" type="text" value="<?php  echo $res['my']['numcard'];?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <strong>???????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <select class="form-control input-sm mt0" data-placeholder="?????????" name="hunyin">
                                                                        <option value="">?????????</option>
                                                                        <option value="??????" <?php  if($res['my']['hunyin']=='??????' ) { ?> selected="" <?php  } ?>>?????? </option>
                                                                                <option value="??????" <?php  if($res['my']['hunyin']=='??????' ) { ?>selected="" <?php  } ?>>?????? </option>
                                                                                <option value="" <?php  if($res['my']['hunyin']=='' ) { ?>selected="" <?php  } ?>>?????? </option>
                                                                                </select>
                                                                                </div>
                                                                                </div>
                                                                                </td>
                                                                                </tr>
                                                                                <tr>
                                                        <td>
                                                            <strong>?????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12 J-job-box">
                                                                    <input name="zhiye" class="form-control email" type="text" value="<?php  echo $res['my']['zhiye'];?>">
                                                                </div>
                                                                <div class="col-sm-6 hidden J-otherjob-box">
                                                                    <input type="text" name="job_name" value="" class="form-control J-other-job">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="J-module-control" data-modules="35">
                                                            <strong>???????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input class="hidden J-tagIds" name="tagIds" type="text" value="">
                                                                    <input class="form-control J-set-tags" name="u_label" type="text" value="<?php  echo $res['u_label'];?><?php  echo $biaoqian;?>">
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="gan_index" id="radioDefault34" value="0" <?php  if($res['my']['gan_index']=='0' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault34">??????</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="gan_index" id="radioDefault35" value="1" <?php  if($res['my']['gan_index']=='1' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault35">??????</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <strong>????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="shen_index" id="radioDefault36" value="0" <?php  if($res['my']['shen_index']=='0' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault36">??????</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="shen_index" id="radioDefault37" value="1" <?php  if($res['my']['shen_index']=='1' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault37">??????</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    </tr>


                                                    <tr>
                                                        <td colspan="2">
                                                            <strong>?????????</strong>
                                                            <div class="form-group mt10 mlf10 J-load-location">

                                                                <?php  echo tpl_form_field_district('address',array('province' =>$res['regions']['0'],'city'=>$res['regions']['1'],'district'=>$res['regions']['2']))?>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td>
                                                            <strong>???????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="be_index" id="radioDefault25" value="0" <?php  if($res['my']['be_index']=='0' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault25">???</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="be_index" id="radioDefault26" value="1" <?php  if($res['my']['be_index']=='1' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault26">?????????</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <!-- <td class="J-module-control" data-modules="35">
                                                            <strong>???????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input class="hidden J-tagIds" name="tagIds" type="text" value="">
                                                                    <input class="form-control J-set-tags" name="u_label" type="text" value="<?php  echo $res['u_label'];?>">
                                                                </div>
                                                            </div>
                                                        </td> -->
                                                    </tr>
                                                    <!-- <tr>
                                                        <td>
                                                            <strong>?????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input name="remark" class="form-control" type="text" value="">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr> -->
                                                    <tr>
                                                        <td colspan="2" class="panel-btn-col2">
                                                            <input type="submit" name="submit" value="??????" class="btn btn-primary J-base-submit" />
                                                            <button type="button" class="btn btn-default J-base-cancel" data-dismiss="modal" onclick="showOrHide(11, 12)">??????</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="table-responsive" id="profile_21">
                                        <table class="table table-profile">
                                            <tbody>

                                                <tr>
                                                    <th colspan="2">????????????

                                                        <span class="pull-right font-normal">
                                                            <a onclick="showOrHide(22, 21)" class="gray">
                                                                <i class="fa fa-pencil"></i> ??????
                                                            </a>
                                                        </span>

                                                    </th>
                                                </tr>

                                                <tr>
                                                    <td width="40%">
                                                        <strong>????????????</strong><?php  if($res['my']['gan_index'] == '1') { ?> ?????? <?php  } else { ?> ?????? <?php  } ?>

                                                    </td>
                                                    <td>
                                                        <strong>????????????</strong><?php  if($res['my']['shen_index'] == '1') { ?> ?????? <?php  } else { ?>?????? <?php  } ?>

                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="" id="profile_22" style="display: none;">
                                        <form class="form-horizontal" method="post" action="./index.php?c=site&a=entry&op=adduser&do=copysite&m=hyb_yl&act=profile.updateuserbli&ac=notice">
                                        <input type="hidden" name="j_id" value="<?php  echo $res['my']['j_id'];?>">
                                        <input type="hidden" name="u_id" value="<?php  echo $res['u_id'];?>">
                                            <table class="table table-profile">
                                                <tbody>

                                                    <tr>
                                                        <th colspan="2">????????????</th>
                                                    </tr>
                                                    <!-- ????????? -->
                                                    <tr>
                                                        <td>
                                                            <div class="J-allergy-box">
                                                                <div class="form-group mb0 mlf10">
                                                                    <div class="col-xs-2 col-sm-2 w10">
                                                                        <strong>????????????</strong>
                                                                    </div>
                                                                    <input type="hidden" name="gan_index" class="J-allergy-json">
                                                                    <div class="col-xs-3 col-sm-3 w10 rdio rdio-default mr20">
                                                                        <input type="radio" class="J-has-allergy1 J-check-wrap" name="gan_index" id="radioDefault5" value="0" <?php  if($res['my']['gan_index'] =='0') { ?> checked="checked" <?php  } ?>>
                                                                        <label for="radioDefault5">??????</label>
                                                                    </div>
                                                                    <div class="col-xs-3 col-sm-3 rdio rdio-default mr20">
                                                                        <input type="radio" class="J-has-allergy0 J-check-wrap" name="gan_index" id="radioDefault6" value="1" <?php  if($res['my']['gan_index'] =='1') { ?> checked="checked" <?php  } ?>">
                                                                        <label for="radioDefault6">?????????</label>
                                                                    </div>
                                                                </div>
                                                                <!-- ????????????????????? -->

                                                          <!--       <div class="form-group allergy-list" style="display: none;">
                                                                    <div>
                                                                        <div class="col-sm-4">
                                                                            <div class="select2-container mt0 J-sel-allergy1" id="s2id_autogen1" style="width: 100%;">
                                                                                <a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">
                                                                                    <span class="select2-chosen" id="select2-chosen-2">?????????</span>
                                                                                    <abbr class="select2-search-choice-close"></abbr>
                                                                                    <span class="select2-arrow" role="presentation">
                                                                                        <b role="presentation"></b>
                                                                                    </span>
                                                                                </a>
                                                                                <label for="s2id_autogen2" class="select2-offscreen"></label>
                                                                                <input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-2" id="s2id_autogen2">
                                                                                <div class="select2-drop select2-display-none select2-with-searchbox">
                                                                                    <div class="select2-search">
                                                                                        <label for="s2id_autogen2_search" class="select2-offscreen"></label>
                                                                                        <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-2" id="s2id_autogen2_search" placeholder="">
                                                                                    </div>
                                                                                    <ul class="select2-results" role="listbox" id="select2-results-2"> </ul>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" data-placeholder="?????????" class="mt0 J-sel-allergy1 select2-offscreen" value="" tabindex="-1" title="">
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="select2-container mt0 J-sel-allergy2" id="s2id_autogen3" style="width: 100%;">
                                                                                <a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">
                                                                                    <span class="select2-chosen" id="select2-chosen-4">????????????</span>
                                                                                    <abbr class="select2-search-choice-close"></abbr>
                                                                                    <span class="select2-arrow" role="presentation">
                                                                                        <b role="presentation"></b>
                                                                                    </span>
                                                                                </a>
                                                                                <label for="s2id_autogen4" class="select2-offscreen"></label>
                                                                                <input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-4" id="s2id_autogen4">
                                                                                <div class="select2-drop select2-display-none select2-with-searchbox">
                                                                                    <div class="select2-search">
                                                                                        <label for="s2id_autogen4_search" class="select2-offscreen"></label>
                                                                                        <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-4" id="s2id_autogen4_search" placeholder="">
                                                                                    </div>
                                                                                    <ul class="select2-results" role="listbox" id="select2-results-4"> </ul>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" data-placeholder="????????????" class="mt0 J-sel-allergy2 select2-offscreen" value="" tabindex="-1" title="">
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="select2-container mt0 J-sel-allergy3" id="s2id_autogen5" style="width: 100%;">
                                                                                <a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">
                                                                                    <span class="select2-chosen" id="select2-chosen-6">????????????</span>
                                                                                    <abbr class="select2-search-choice-close"></abbr>
                                                                                    <span class="select2-arrow" role="presentation">
                                                                                        <b role="presentation"></b>
                                                                                    </span>
                                                                                </a>
                                                                                <label for="s2id_autogen6" class="select2-offscreen"></label>
                                                                                <input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-6" id="s2id_autogen6">
                                                                                <div class="select2-drop select2-display-none select2-with-searchbox">
                                                                                    <div class="select2-search">
                                                                                        <label for="s2id_autogen6_search" class="select2-offscreen"></label>
                                                                                        <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-6" id="s2id_autogen6_search" placeholder="">
                                                                                    </div>
                                                                                    <ul class="select2-results" role="listbox" id="select2-results-6"> </ul>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" data-placeholder="????????????" class="mt0 J-sel-allergy3 select2-offscreen" value="" tabindex="-1" title="">
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <a class="btn btn-sm btn-white J-btn-delete-allergy hidden">
                                                                                <i class="fa fa-minus"></i>
                                                                            </a>
                                                                            <a class="btn btn-sm btn-white J-btn-add-allergy">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div> -->

                                                            </div>
                                                            <div class="J-allergy-box">
                                                                <div class="form-group mb0 mlf10">
                                                                    <div class="col-xs-2 col-sm-2 w10">
                                                                        <strong>????????????</strong>
                                                                    </div>
                                                                    <input type="hidden" name="shen_index" class="J-allergy-json">

                                                                    <div class="col-xs-3 col-sm-3 w10 rdio rdio-default mr20">
                                                                        <input type="radio" class="J-has-allergy1 J-check-wrap" name="shen_index" id="radioDefault5" value="0" <?php  if($res['my']['shen_index'] =='0') { ?> checked="checked" <?php  } ?>>
                                                                        <label for="radioDefault5">??????</label>
                                                                    </div>
                                                                    <div class="col-xs-3 col-sm-3 rdio rdio-default mr20">
                                                                        <input type="radio" class="J-has-allergy0 J-check-wrap" name="shen_index" id="radioDefault6" value="1" <?php  if($res['my']['shen_index'] =='1') { ?> checked="checked" <?php  } ?>">
                                                                        <label for="radioDefault6">?????????</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- ????????? -->
     

                                                    <tr>
                                                        <td colspan="2">
                                                            <input type="submit" name="submit" value="??????" class="btn btn-primary J-base-submit" />
                                                            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="showOrHide(21, 22)">??????</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="table-responsive" id="profile_31">
                                        <table class="table table-profile">
                                            <tbody>

                                                <tr>
                                                    <th colspan="2">????????????

                                                        <span class="pull-right font-normal">
                                                            <a onclick="showOrHide(32, 31)" class="gray">
                                                                <i class="fa fa-pencil"></i> ??????
                                                            </a>
                                                        </span>

                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <strong>?????????</strong>
                                                        <?php  echo $res['my']['shengao'];?>CM
                                                    </td>
                                                    <td width="60%">
                                                        <strong>?????????</strong>
                                                        <?php  echo $res['my']['tizhong'];?>Kg
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>?????????</strong>
                                                        <?php  echo $res['my']['xuex'];?>

                                                    </td>
                                                    <td>
                                                        <strong>???????????????</strong><?php  if($res['my']['be_index'] == '1') { ?> ??? <?php  } else { ?>??? <?php  } ?>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="" id="profile_32" style="display: none;">
                                        <form class="form-horizontal" method="post" action="" id="J-other-information">
                                            <input type="hidden" name="do" value="copysite">
                                            <input type="hidden" name="m" value="hyb_yl">
                                            <input type="hidden" name="act" value="profile.edituser">
                                            <input type="hidden" name="ac" value="notice">
                                            <input type="hidden" name="u_id" value="<?php  echo $u_id;?>">
                                            <input type="hidden" name="openid" value="<?php  echo $openid;?>">
                                            <input type="hidden" name="typs" value="qita">
                                            <table class="table table-profile">
                                                <tbody>
                                                    <tr>
                                                        <th colspan="2">????????????</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>??????(/kg)</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input name="tizhong" class="form-control isPid" type="text" value="<?php  echo $res['my']['tizhong'];?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <strong>?????????(/cm)</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input name="shengao" class="form-control isPid" type="text" value="<?php  echo $res['my']['shengao'];?>">
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>?????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input name="xuex" class="form-control" type="text" value="<?php  echo $res['my']['xuex'];?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="panel-btn-col2">
                                                            <input type="submit" name="submit" value="??????" class="btn btn-primary J-base-submit" />
                                                            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="showOrHide(31, 32)">??????</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="table-family mb30">
                                        <table class="table table-profile">
                                            <tbody>

                                                <tr>
                                                    <th colspan="2">??????</th>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <?php  if(is_array($family)) { foreach($family as $item) { ?>
                                        <table class="table table-profile" id="profile_<?php  echo ($item['j_id']-1); ?>">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2">
                                                        <strong>?????????</strong>
                                                        <b> <?php  if($item['sick_index'] =='1') { ?> ???????????? <?php  } ?>
                                                            <?php  if($item['sick_index'] =='2') { ?> ?????? <?php  } ?>
                                                            <?php  if($item['sick_index'] =='3') { ?> ?????? <?php  } ?>
                                                            <?php  if($item['sick_index'] =='4') { ?> ?????? <?php  } ?>
                                                        </b>

                                                        <span class="pull-right font-normal">
                                                            <a href="javascript:void(0);" onclick="showOrHide(<?php  echo $item['j_id'];?>,<?php  echo $item['j_id'];?>1)" class="gray">
                                                                <i class="fa fa-pencil"></i> ??????
                                                            </a> - <a class="gray J-del-family" data-toggle="modal" data-id="2992" data-delid="profile_<?php  echo ($item['j_id']-1); ?>" href="./index.php?c=site&a=entry&op=deleteuserjr&do=copysite&m=hyb_yl&act=profile.deleteuserjr&ac=notice&j_id=<?php  echo $item['j_id'];?>">
                                                                <i class="fa fa-trash-o"></i> ??????
                                                            </a>
                                                        </span>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%">
                                                        <strong>?????????</strong>
                                                        <a href="/Clinic/Patient/profile/patient_id/00020123449.html">
                                                         <?php  if($res['my']['names']) { ?>
                                                        <?php  echo $res['my']['names'];?>
                                                        <?php  } else { ?>
                                                        <?php  echo $res['u_name'];?>
                                                        <?php  } ?>
                                                        </a>
                                                    </td>
                                                    <td width="60%">
                                                        <strong>???????????????</strong>
                                                        <?php  echo $item['datetime'];?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="33.%">
                                                        <strong>?????????</strong>
                                                        <?php  echo $item['sex'];?>

                                                    </td>
                                                    <td>
                                                        <strong>?????????</strong>

                                                        <?php  echo $item['age'];?>???

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>????????????</strong>
                                                        <?php  echo $res['my']['tel'];?> 
                                                    </td>
                                                    <td>

                                                        <strong>????????????</strong>


                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>???????????????</strong>
                                                        <?php  echo $item['numcard'];?>
                                                    </td>
                                                    <td colspan="2">
                                                        <strong>?????????</strong>
                                                        <?php  echo $item['region'];?>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <form class="form-horizontal" method="post" action="">
                                            <input type="hidden" name="j_id" value="<?php  echo $item['j_id'];?>">
                                            <input type="hidden" name="do" value="copysite">
                                            <input type="hidden" name="m" value="hyb_yl">
                                            <input type="hidden" name="act" value="profile.edituser_list">
                                            <input type="hidden" name="ac" value="notice">
                                            <input type="hidden" name="u_id" value="<?php  echo $u_id;?>">
                                            <input type="hidden" name="openid" value="<?php  echo $openid;?>">
                                            <table class="table table-profile" id="profile_<?php  echo $item['j_id'];?>" style="display: none;">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            <select class="form-control input-sm mt0 J-member-select" data-placeholder="?????????" select-data="109" name="sick_index">

                                                                <option value="1" <?php  if($item['sick_index']=='1' ) { ?> selected="" <?php  } ?>>
                                                                        ????????????
                                                                        </option>

                                                                        <option value="2" <?php  if($item['sick_index']=='2' ) { ?> selected="" <?php  } ?>>
                                                                        ??????
                                                                        </option>

                                                                        <option value="3" <?php  if($item['sick_index']=='3' ) { ?> selected="" <?php  } ?>>
                                                                        ??????
                                                                        </option>

                                                                        <option value="4" <?php  if($item['sick_index']=='4' ) { ?> selected="" <?php  } ?>>
                                                                        ??????
                                                                        </option>

                                                                        </select>
                                                                        </td>
                                                                        </tr>
                                                                        <tr>
                                                        <td width="40%">
                                                            <strong>?????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input name="names" class="form-control" type="text" value=" <?php  if($res['my']['names']) { ?><?php  echo $res['my']['names'];?><?php  } else { ?> <?php  echo $res['u_name'];?><?php  } ?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="60%">
                                                            <strong>?????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="sex" id="radioDefault27" value="???" <?php  if($item['sex']=='???' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault27">???</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="sex" id="radioDefault28" value="???" <?php  if($item['sex']=='???' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault28">???</label>
                                                                    </div>
                                                                </div>
 
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>???????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <?php  echo tpl_form_field_date('datetime', $res['my']['datetime'])?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <strong>????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input name="tel" class="form-control cellphone" type="text" value="<?php  echo $res['my']['tel'];?> ">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <!-- <td>

                                                            <strong>????????????</strong>
                                                            <div class="form-group mt10 mlr0">
                                                                <div class="input-group col-sm-12">
                                                                    <input type="text" name="wechatid" value="0" class="form-control" readonly="">
                                                                    <span class="input-group-addon J-wechat-bind">??????</span>
                                                                </div>
                                                            </div>

                                                        </td> -->
                                                    </tr>
                                                    <tr>

                                                        <td>
                                                            <strong>???????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input name="numcard" class="form-control isPid" type="text" value="<?php  echo $item['numcard'];?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <strong>???????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <select class="form-control input-sm mt0" data-placeholder="?????????" name="hunyin">
                                                                        <option value="">?????????</option>
                                                                        <option value="??????" <?php  if($item['hunyin']=='??????' ) { ?> selected="" <?php  } ?>>?????? </option>
                                                                                <option value="??????" <?php  if($item['hunyin']=='??????' ) { ?>selected="" <?php  } ?>>?????? </option>
                                                                                <option value="" <?php  if($item['hunyin']=='' ) { ?>selected="" <?php  } ?>>?????? </option>
                                                                                </select>
                                                                                </div>
                                                                                </div>
                                                                                </td>
                                                                                </tr>
                                                                                <tr>
                                                        <td>
                                                            <strong>?????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12 J-job-box">
                                                                    <input name="zhiye" class="form-control email" type="text" value="<?php  echo $item['zhiye'];?>">
                                                                </div>

                                                            </div>
                                                        </td>


                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="gan_index" id="radioDefault3" value="0" <?php  if($item['gan_index']=='0' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault3">??????</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="gan_index" id="radioDefault4" value="1" <?php  if($item['gan_index']=='1' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault4">??????</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <strong>????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="shen_index" id="radioDefault5" value="0" <?php  if($item['shen_index']=='0' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault5">??????</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="shen_index" id="radioDefault6" value="1" <?php  if($item['shen_index']=='1' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault6">??????</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <!--  <td>
                                                            <strong>???????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12">
                                                                    <input name="company" class="form-control" type="text" value="">
                                                                </div>
                                                            </div>
                                                        </td> -->
                                                        <!-- <td class="J-module-control" data-modules="35">
                                                            <strong>???????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-12 J-source-box">
                                                                    <input type="hidden" class="J-source" value="0">
                                                                    <select class="form-control input-sm mt0 J-source-select" data-placeholder="?????????" name="source">
                                                                        <option selected="selected" value="">?????????</option>
                                                                        <option selected="selected" value="0">???</option>
                                                                        <option value="1">????????????</option>
                                                                        <option value="2">??????</option>
                                                                        <option value="3">????????????</option>
                                                                        <option value="4">??????</option>
                                                                        <option value="5">??????</option>
                                                                        <option value="6">????????????</option>
                                                                        <option value="7">???????????????</option>
                                                                        <option value="8">????????????</option>
                                                                        <option value="10025">????????????</option>
                                                                        <option value="10026">A??????</option>
                                                                        <option value="10029">A</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6 hidden J-othersource-box">
                                                                    <input type="text" name="source_name" value="" class="form-control J-other-source">
                                                                </div>
                                                            </div>
                                                        </td> -->
                                                    </tr>


                                                    <tr>
                                                        <td colspan="2">
                                                            <strong>?????????</strong>
                                                            <div class="form-group mt10 mlf10 J-load-location">

                                                                <?php  echo tpl_form_field_district('address',array('province' =>$item['regions']['0'],'city'=>$item['regions']['1'],'district'=>$item['regions']['2']))?>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td>
                                                            <strong>???????????????</strong>
                                                            <div class="form-group mt10 mlf10">
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="be_index" id="radioDefault29" value="0" <?php  if($item['be_index']=='0' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault29">???</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-pad-sm">
                                                                    <div class="rdio rdio-default">
                                                                        <input type="radio" name="be_index" id="radioDefault30" value="1" <?php  if($item['be_index']=='1' ) { ?> checked="" <?php  } ?> required="">
                                                                        <label for="radioDefault30">?????????</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>

                                                    <tr>
                                                        <td colspan="2" class="panel-btn-col2">
                                                            <input type="submit" name="submit" value="??????" class="btn btn-primary J-base-submit" />
                                                            <button type="button" class="btn btn-default J-base-cancel" data-dismiss="modal" onclick="showOrHide(11, 12)">??????</button>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </form>

                                        <?php  } } ?>
                                        <table class="table table-profile">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-white btn-block" data-toggle="modal" data-target="#myModal">
                                                            <i class="fa fa-plus"></i> ??????????????????
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <!--????????????-->
                                <div class="tab-pane" id="tab2">
                                    <div class="mb30">
                                        <div class="boxTitle">
                                            <span class="labelTip"></span>????????????<span class="sub">???????????????<?php  echo $res['randnum'];?>???</span>
                                        </div>
                                        <div class="boxInfo recordInfo">
                                            <p class="recordRead">
                                                ?????????<?php  echo $res['u_label'];?><?php  echo $biaoqian;?>
                                            </p>

                                            <p class="recordRead"></p>

                                            <p class="recordRead">
                                                ????????????<?php  if($res['my']['allergy_index'] == '1') { ?>????????????<?php  } else { ?> ??? <?php  } ?>
                                            </p>
                                            <p class="recordRead">
                                                ???????????????<?php  if($res['my']['feritin_index'] == '1') { ?>?????????<?php  } ?>
                                                    <?php  if($res['my']['diabetes_index'] == '1') { ?>?????????<?php  } ?>
                                                    <?php  if($res['my']['feritin_index'] == '0' && $res['my']['diabetes_index'] == '0') { ?>???<?php  } ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="cont_box">
                                       
                                    <ul class="ul_scroll">
                                        <?php  if(is_array($times_arr)) { foreach($times_arr as $times) { ?>
                                        <li class="ll" id="data_<?php  echo $times;?>" data-time="<?php  echo $times;?>" onclick="changejz('<?php  echo $times;?>','<?php  echo $openid;?>')")"><?php  echo $times;?></li>
                                        <?php  } } ?>
                                    </ul>
                                    <div style="width:90%;" id="chufangs">
                                        
                                        <!--????????????-->
                                        
                                    </div>

                                    </div>
                                    

                                    <!--end-->
                                </div>
                                <script type="text/javascript">
                                    var openid = "<?php  echo $openid;?>";
                                    var time = "<?php  echo $one_time;?>";
                                    changejz(time,openid);
                                    function changejz(time,openid)
                                    {   
                                        $(".ll").removeClass('ul_scroll_active');
                                        $("#data_"+time).addClass('ul_scroll_active');
                                        $.ajax({
                                            url:"./index.php?c=site&a=entry&op=chufan_arr&do=copysite&m=hyb_yl&act=profile.chufan_arr&ac=notice&openid="+openid+"&time="+time,
                                            type:"get",
                                            dataType:"json",
                                            cache: false,
                                            processData: false,
                                            contentType: false,
                                            async:false,
                                            success:function(res){
                                                var html = '';

                                                for(var i=0;i<res.length;i++)
                                                {
                                                    html +="<div class='mb30'>";
                                                    html +="<div class='boxTitle'>";
                                                    html +="<span class='labelTip'></span>?????????";
                                                    html +="</div>";
                                                    html +="<div class='boxBtn'>";
                                                    html +="<div role='radiogroup' class='el-radio-group floatL'>";
                                                    html +="<div class='el-radio-button is-active'>";
                                                    html +="<span class='el-radio-button__inner'>??????"+res[i].orderNo+"</span>";
                                                    html +="</div>";
                                                    html +="</div>";
                                                    html +="<div class='btnGoInfo floatR' data-id='"+res[i].id+"' onclick='showss(this)'>???????????????</div>";
                                                    html +="</div>";
                                                    html +="</div>";
                                                    for(var j=0;j<res[i].cartlist.length;j++)
                                                    {
                                                        
                                                        html +="<table class='table'>";
                                                        html +="<thead class='table-header'>";
                                                        html +="<tr>";
                                                        html +="<th>????????????</th>";
                                                        html +="<th>?????????</th>";
                                                        html +="<th>??????/??????</th>";
                                                        html +="<th>??????</th>";
                                                        html +="<th>??????</th>";
                                                        html +="<th>??????</th>";
                                                        html +="</tr>";
                                                        html +="</thead>";
                                                        html +="<tbody class='tbale-tbody'>";
                                                        html +="<tr>";
                                                        html +="<td>"+res[i]['cartlist'][j]['sname']+"</td>";
                                                        html +="<td>"+res[i]['cartlist'][j]['zhiyaochang']+"</td>";
                                                        html +="<td style='max-width: 110px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;''>"+res[i]['cartlist'][j]['use']+"</td>";
                                                        html +="<td>"+res[i]['cartlist'][j]['adapt']+"</td>";
                                                        html +="<td>"+res[i]['cartlist'][j]['num']+"</td>";
                                                        html +="<td>"+res[i]['cartlist'][j]['smoney']+"???</td>";
                                                        html +="</tr>";
                                                        html +="</tbody>";
                                                        html +="<tfoot>";
                                                        html +="<tr>";
                                                        html +="<td>??????</td>";
                                                        html +="<td></td>";
                                                        html +="<td></td>";
                                                        html +="<td></td>";
                                                        html +="<td></td>";
                                                        html +="<td></td>";
                                                        html +="<td>"+res[i]['cartlist'][j]['smoney']*res[i]['cartlist'][j]['num']+"???</td>";
                                                        html +="</tr>";
                                                        html +="</tfoot>";
                                                        html +="</table>";
                                                    }
                                                    html +="</div>";
                                                }

                                                $("#chufangs").html(html)
                                
                                            }
                                
                                        })
                                    }
                                </script>

                                <div class="tab-pane" id="tab12">
                                    
                                    <div class="cont_box">
                                       
                                    <ul class="ul_scroll">
                                        <?php  if(is_array($case_date)) { foreach($case_date as $cass) { ?>
                                        <li class="ll" id="datas_<?php  echo $cass['date'];?>" data-time="<?php  echo $cass['date'];?>" onclick="changejk('<?php  echo $cass['date'];?>','<?php  echo $openid;?>')")"><?php  echo $cass['date'];?></li>
                                        <?php  } } ?>
                                    </ul>
                                    <div style="width:90%;" id="jiankang">
                                        
                                        <!--????????????-->
                                        
                                    </div>

                                    </div>
                                    

                                    <!--end-->
                                </div>
                                <script type="text/javascript">
                                    var openid = "<?php  echo $openid;?>";
                                    var time = "<?php  echo $one_case_date;?>";
                                    changejk(time,openid);
                                    function changejk(time,openid)
                                    {   
                                        $(".ll").removeClass('ul_scroll_active');
                                        $("#datas_"+time).addClass('ul_scroll_active');
                                        $.ajax({
                                            url:"index.php?c=site&a=entry&op=adduser&do=copysite&m=hyb_yl&act=profile.search_case&ac=notice&date="+time+"&openid="+openid,
                                            type:"get",
                                            dataType:"json",
                                            cache: false,
                                            processData: false,
                                            contentType: false,
                                            async:false,
                                            success:function(res){
                                                var html = '';

                                                for(var i=0;i<res.length;i++)
                                                {
                                                    html +="<div class='mb30'>";
                                                    html +="<div class='boxTitle'>";
                                                    html +="<span class='labelTip'></span>????????????";
                                                    html +="</div>";
                                                    html +="<div class='boxBtn'>";
                                                    html +="<div role='radiogroup' class='el-radio-group floatL'>";
                                                    html +="<div class='el-radio-button is-active'>";
                                                    html +="<span class='el-radio-button__inner'>??????"+res[i].number+"</span>";
                                                    html +="</div>";
                                                    html +="</div>";
                                                    html +="</div>";
                                                    html +="</div>";
                                                    html +="<table class='table'>";
                                                    html +="<thead class='table-header'>";
                                                    html +="<tr>";
                                                    html +="<th>??????</th>";
                                                    html +="<th>??????</th>";
                                                    html +="<th>??????</th>";
                                                    html +="<th>????????????</th>";
                                                    html +="</tr>";
                                                    html +="</thead>";
                                                    html +="<tbody class='tbale-tbody'>";
                                                    html +="<tr>";
                                                    html +="<td>"+res[i]['name']+"</td>";
                                                    if(res[i]['sex'] == '1')
                                                    {
                                                        html +="<td>???</td>"; 
                                                    }else if(res[i]['sex'] == '0')
                                                    {
                                                        html +="<td>???</td>"; 
                                                    }
                                                    html +="<td>"+res[i]['age']+"</td>";
                                                    html +="<td>";
                                                    for(var j=0;j<res[i]['content'].length;j++)
                                                    {
                                                        html += "<span>"+res[i]['content'][j]['title']+"???"+res[i]['content'][j]['value']+"</span><br>";
                                                    }
                                                    html+="</td>";
                                                    html +="</tr>";
                                                    html +="</tbody>";
                                                    html +="</table>";
                                                    html +="</div>";
                                                }

                                                $("#jiankang").html(html)
                                
                                            }
                                
                                        })
                                    }
                                </script>
                                <!--????????????-->
                                <!-- strat ???????????? -->
                                <div class="tab-pane" id="tab8">
                                    <div class="table-responsive">
                                        <table class="table table-profile">
                                            <tbody>
                                                <tr>
                                                    <th colspan="2">????????????</th>
                                                </tr>
                                                <tr>
                                                    <td width="50%">
                                                        <strong>????????????</strong>
                                                        <span id="J-current-points"><?php  echo $res['score'];?></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="table-responsive">
                                            <table class="table table-profile">
                                                <thead>
                                                    <tr>
                                                        <th width="20%">
                                                            <strong>????????????</strong>
                                                        </th>
                                                        <th width="20%">
                                                            <strong>??????</strong>
                                                        </th>
                                                        <th width="20%">
                                                            <strong>??????</strong>
                                                        </th>
                                                        <th width="20%">
                                                            <strong>??????</strong>
                                                        </th>
                                                        <th width="20%">
                                                            <strong>????????????</strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="J-points-infos-wrap">
                                                    <?php  if(is_array($jifenjilu)) { foreach($jifenjilu as $jifen) { ?>
                                                    <tr>
                                                        <td><?php  echo $jifen['num'];?></td>
                                                        <td><?php  echo date("Y-m-d H:i:s",$jifen['createtime'])?></td>
                                                        <td>
                                                            <?php  if($jifen['operator']=='0') { ?>
                                                            ????????????
                                                            <?php  } ?>
                                                        </td>
                                                        <td><?php  echo $jifen['remark'];?></td>
                                                        <td><?php  echo $jifen['presentcredit'];?></td>
                                                    </tr>
                                                    <?php  } } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--                                  <div class="J-page-wrap1">
                                        <div class="base_page"><?php  echo $jifenjilupagers;?></div>
                                    </div> -->
                                </div>
                                <!-- ???????????? -->
                                <div class="tab-pane" id="tab10">
                                    <div class="table-responsive">
                                        <div class="table-responsive">
                                            <table class="table table-profile">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <strong>????????????</strong>
                                                        </th>
                                                        <th>
                                                            <strong>????????????</strong>
                                                        </th>
                                                        <th>
                                                            <strong>????????????</strong>
                                                        </th>
                                                        <th>
                                                            <strong>????????????</strong>
                                                        </th>
                                                        <th>
                                                            <strong>????????????</strong>
                                                        </th>
                                                        <th>
                                                            <strong>??????</strong>
                                                        </th>
                                                        <!-- <th>
                                                            <strong>??????</strong>
                                                        </th> -->
                                                    </tr>
                                                </thead>
                                                <tbody id="J-points-infos-wrap">
                                                    <?php  if(is_array($dongtai)) { foreach($dongtai as $dong) { ?>
                                                    <tr>
                                                        <td>
                                                            
                                                            <div class="cont_text" >
                                                                <span><?php  echo $dong['contents'];?></span>
                                                            </div>
                                                        </td>
                                                        <td><?php  echo $dong['label_name'];?></td>
                                                        <td>
                                                            <p>?????????<?php  echo $dong['dianj'];?></p>
                                                            <p>?????????<?php  echo $dong['pinglunnum'];?></p>
                                                            <p>?????????<?php  echo $dong['virtual_accesses'];?></p>
                                                        </td>
                                                        <td>
                                                        <?php  if($dong['doctor_visible']=='1') { ?><span class="label label-success">????????????</span><?php  } else { ?><span class="label label-warning">??????????????????</span><?php  } ?>
                                                        </td>
                                                        <td><?php  echo $dong['times'];?></td>
                                                        <td>
                                                            <?php  if($dong['type']=='0') { ?><span class="label label-warning" style="background-color: red;">?????????</span><?php  } ?>
                                                            <?php  if($dong['type']=='1' && $dong['share_tj']=='0') { ?><span class="label label-info" style="background-color: orange;">?????????</span><?php  } ?>
                                                            <?php  if($dong['type']=='1' && $dong['share_tj']=='1') { ?><span class="label label-success" >??????</span><?php  } ?>
                                                        </td>
                                                        <!-- <td>
                                                        <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamiclistadd','a_id'=>$dong['a_id']))?>" title="????????????">????????????</a>
                            
                                                        <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('apply',array('ac'=>'dynamiclist','op'=>'dynamicpllist','a_id'=>$dong['a_id']))?>" title="????????????">????????????</a></td> -->
                                                    </tr>
                                                    <?php  } } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--                                  <div class="J-page-wrap1">
                                        <div class="base_page"><?php  echo $jifenjilupagers;?></div>
                                    </div> -->
                                </div>
                                <!-- ?????????????????? -->
                                <div class="tab-pane" id="tab11">
                                    <div class="table-responsive">
                                        <div class="table-responsive">
                                            <a class="btn btn-white btn-block" style="width: 120px;margin-bottom: 20px;" data-toggle="modal" data-target="#mybaogao">
                                                <i class="fa fa-plus"></i> ????????????
                                            </a>
                                            <table class="table table-profile">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <strong>????????????</strong>
                                                        </th>
                                                        <th>
                                                            <strong>????????????</strong>
                                                        </th>
                                                        <th>
                                                            <strong>????????????</strong>
                                                        </th>
                                                        <th>
                                                            <strong>??????</strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="J-points-infos-wrap">
                                                    <?php  if(is_array($sharebaogao)) { foreach($sharebaogao as $bg) { ?>
                                                    <tr>
                                                        <td>
                                                            
                                                            <div class="cont_text" >
                                                                <span><?php  echo $bg['contents'];?></span>
                                                            </div>
                                                        </td>
                                                        <td>

                                                        <?php  if(count($bg['sharepic']) > 0) { ?>
                                                        <?php  if(is_array($bg['sharepic'])) { foreach($bg['sharepic'] as $img) { ?>
                                                        <img src="<?php  echo $img;?>" style="width: 100px">
                                                        <?php  } } ?>
                                                        <?php  } else { ?>
                                                        ??????
                                                        <?php  } ?>
                                                        </td>
                                                        <td>
                                                            <?php  echo $bg['times'];?>
                                                        </td>
                                                        <td>
                                                             <a class="btn btn-danger btn-sm" href="./index.php?c=site&a=entry&op=rechargeuser&do=copysite&m=hyb_yl&act=profile.delbg&ac=notice&a_id=<?php  echo $bg['a_id'];?>" data-toggle="ajaxRemove" data-confirm="????????????????????????????????????" title="??????">??????</a>
                                                        </td>
                                                    </tr>
                                                    <?php  } } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--                                  <div class="J-page-wrap1">
                                        <div class="base_page"><?php  echo $jifenjilupagers;?></div>
                                    </div> -->
                                </div>

                                <!-- ?????????????????? -->
<div tabindex="-1" class="modal fade" id="mybaogao" style="z-index:889!important" role="dialog" aria-hidden="true" aria-labelledby="mybaogaoLabel">
    <div class="modal-dialog modal-lg">
        <form id="J-add-family-form" action="" method="post">
            <input type="hidden" name="do" value="copysite">
            <input type="hidden" name="m" value="hyb_yl">
            <input type="hidden" name="act" value="profile.edituser_baogao">
            <input type="hidden" name="ac" value="notice">
            <input type="hidden" name="u_id" value="<?php  echo $u_id;?>">
            <input type="hidden" name="openid" value="<?php  echo $openid;?>">
            <input type="hidden" name="j_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" aria-hidden="true" type="button" data-dismiss="modal">??</button>
                    <h4 class="modal-title">????????????</h4>
                </div>
                <div class="modal-body">
                    <div class="m10">
                        <!-- row -->
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label">???????????? <span class="asterisk">*</span>
                                </label>
                                <input name="contents" class="form-control" type="text" value="<?php  echo $item['contents'];?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label">???????????? <span class="asterisk">*</span>
                                </label>
                                <?php  echo tpl_form_field_multi_image('sharepic', $item['sharepic'])?>
                            </div>
                        </div>
                        <div class="modal-footer modal-btn-col2">
                            <input type="submit" name="submit" value="??????" class="btn btn-primary J-base-submit" />
                            <button class="btn btn-default" type="button" data-dismiss="modal">??????</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


                                <!-- end ???????????? -->
                                <!-- strat ??????????????? -->
                                <div class="tab-pane" id="tab9">
                                    <div class="table-responsive">
                                        <div class="row J-patient-insepects-tip">
                                            <div class="col-md-12">
                                                <table class="table table-profile">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:100px;">????????????</th>
                                                            <th style="width:100px;">????????????</th>
                                                            <th style="width:100px;">????????????</th>
                                                            <th style="width:100px;">????????????</th>
                                                            <th style="width:200px;">????????????</th>
                                                            <th style="width:50px;">????????????</th>
                                                            <th style="width:50;">????????????</th>
                                                            <th style="width:50px; ">??????</th>
                                                            <th style="width:170px; ">????????????</th>
                                                            <th style="width:50px; ">??????</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  if(is_array($yearorder)) { foreach($yearorder as $years) { ?>
                                                        <tr>
                                                            <td><?php  echo $years['z_name'];?></td>
                                                            <td><?php  echo $years['hospital'];?></td>
                                                            <td><?php  echo $years['keshi'];?></td>
                                                            <td><?php  echo $years['zhicheng'];?></td>
                                                            <td>????????????</td>
                                                            <td><?php  echo $years['times'];?>??????</td>
                                                            <td>???<?php  echo $years['money'];?></td>
                                                            <td>
                                                                <label class="label label-success">?????????</label>
                                                            </td>
                                                            <td><?php  echo date("Y-m-d H:i:s",$years['created']);?></td>
                                                            <td>
                                                                <div class="btnBox">
                                                                    <div class="btn btn-danger remove">
                                                                        <a href="">??????</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php  } } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div id="J-patient-insepect-wrap"></div>
                                        <div class="J-page-wrap3 hidden">
                                            <div class="base_page">
                                                <a href="javascript: void(0)" type="button" data-page_num="1" class="btn btn-default pull-left" data-type="pre_page" id="J-insepect-pre-page">
                                                    <i class="fa fa-chevron-left"></i>
                                                </a>
                                                <button type="button" class="btn btn-default base_page_info pull-left" id="J-insepect-page-info" disabled="disabled" data-page="1" data-total="">1/1</button>
                                                <a href="javascript: void(0)" type="button" data-page_num="1" class="btn btn-default pull-left" data-type="next_page" id="J-insepect-next-page">
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>
                                                <input class="form-control base_page_search_input pull-left font14" id="J-insepect-page-input" type="number">
                                                <a href="javascript: void(0)" class="btn btn-default pull-left ml5" type="button" data-type="go" id="J-go-insepect">Go</a>
                                            </div>
                                        </div>
                                        <!-- ???????????? ??????????????? -->
                                        <script type="text/template" id="J-patient-insepect-tpl">
                                            <div class="panel-group mb0">
        <% $.each(items, function(i, ele) { %>
            <div class="panel panel-default">
                <div class="panel-heading pt10">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapseOne-<%-i%>">
                        <%-ele.clinic_time_format%> - <%-ele.is_first%> - <%-ele.clinic_name%> - <%-ele.doctor_name%> 
                        </a>
                    </h4>
                </div>
                
                <div id="collapseOne-<%-i%>" class='panel-collapse collapse in'>
                    <div class="panel-body plr0 J-panel-body">
                        <!-- ?????? ul -->
                        <ul class="nav nav-tabs patient-tabs nav-tabs-white">
                            <%var tempIndex = 0;%>
                            <% $.each(ele.resultList || [], function(i1, item1){ %>
                                <%if(item1.barcode){%>
                                    <li class="<% if(tempIndex == 0){ %>active<% } %>"><a href="#insepect<%-item1.billId%>" data-toggle="tab"><strong><%-item1.name%></strong></a></li>
                                    <%++tempIndex;%>
                                <%}%>
                            <% }); %>
                        </ul>
                        <!--  -->
                        <div class="tab-content pd0">
                            <%tempIndex = 0;%>
                            <% $.each(ele.resultList || [], function(i2, item2){ %>
                                <%if(item2.barcode){%>
                                    <div class="tab-pane <% if(tempIndex == 0){ %>active<% } %>" id="insepect<%-item2.billId%>">
                                        <form class="form-inline J-inspect-form" method="post" action="/Clinic/Inspect/setInspect.html">
                                            <input type='hidden' name='bill_id' value='<%-item2.billId%>' />
                                            <input type='hidden' name='clinic_id' value='<%-item2.clinicId%>' />
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <div class="panel-btns">
                                                        <a class="minimize" href="javascript:;">???</a>
                                                        <h4 align="center" class="panel-title color111 pt10"><%-item2.name%> - <%-item2.barcode%>???<%-item2.barcode%>???
                                                            <%if(item2.chargedStatus == 0){%>
                                                                <span class="red">?????????</span>
                                                            <%}else if(item2.chargedStatus == 1){%>
                                                                <span class="end">?????????</span>
                                                            <%}else if(item2.chargedStatus == 2){%>
                                                                ?????????
                                                            <%}%>???
                                                        </h4>
                                                        <div class="row font12 mt10 pl10">
                                                            <div class="col-xs-2">
                                                                <span>???????????????<%-item2.doctor_name%></span>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <span>???????????????<%-item2.create_time%></span>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <span>???????????????<%-item2.report_time%></span>
                                                            </div>
                                                            <div class="col-xs-2">
                                                                <span>????????????<%-item2.report_name%></span>
                                                            </div>
                                                        </div>
                                                        <% if(item2.result || item2.doctor_remark){ %>
                                                            <div class="alert alert-warning mt10 mb0">
                                                                ?????????<%-item2.result%><br>
                                                                <div class="hidden J-alert-allergy">????????????<span></span></div>
                                                                ?????????<%-item2.doctor_remark%>
                                                            </div>
                                                        <% } else { %>
                                                            <div class="alert alert-warning mt10 mb0 J-alert-allergy hidden">
                                                                ????????????<span></span>
                                                            </div>
                                                        <% } %>
                                                    </div>
                                                </div>
                                                <div class="panel-body prl0 pt0" style="display: block;">
                                                    <div>
                                                        <table class="table table-hover table-report shadow-none mt0 mbf10">
                                                            <thead>
                                                            <tr>
                                                                <th class="pl20" width="8%" >??????</th>
                                                                <th width="35%">??????</th>
                                                                <th width="20%">????????????</th>
                                                                <th width="10%">??????</th>
                                                                <th>??????</th>
                                                                <th width="12%">????????????</th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="J-report-list">
                                                                <% $.each(JSON.parse(item2.subitem), function(i3, item3){ %>
                                                                    <tr>
                                                                        <td class="text-center J-index"><%-++i3%></td>
                                                                        <td data-id="<%-item3.id%>" class="J-show-item"><%-item3.checkitemname%><% if(item3.checkitemspec){ %>(<%-item3.checkitemspec%>)<% } %></td>
                                                                        <td>
                                                                            <span <% if(item3.value == '??????'){ %>style="color: red"<% } %>><%-item3.value %></span>
                                                                            <div class="form-group mrf15 mb0 hidden">
                                                                                <input type="hidden" name="sub_key[]" value="<%-item3.id%>" />
                                                                                <input type="text" name="sub_value[]" value="<%-item3.value%>" class="form-control input-sm input-auto J-reference-input" />
                                                                            </div>
                                                                        </td>
                                                                        <td><%-item3.checkitemunit%></td>
                                                                        <td class="J-reference-style">
                                                                            <% if(item3.value !== '' && item3.value * 1 === item3.value * 1 && item3.radiox == 1 && item3.reference != ''){ %>
                                                                                <% 
                                                                                    var reference = item3.reference;
                                                                                    var values = reference.indexOf('-') != -1 ? reference.split('-') : reference.split('~');
                                                                                    var v1 = values[0]*1 || '';
                                                                                    var v2 = values[1]*1 || '';
                                                                                %>
                                                                                <% if(v1 === '' && v2 === ''){ %>
                                                                                <% }else if((v1 < v2 || v2 === '') && item3.value < v1){ %>
                                                                                <i class="fa fa-long-arrow-down text-primary"></i>
                                                                                <% }else if((v1 < v2 || v1 === '') && item3.value > v2){ %>
                                                                                <i class="fa fa-long-arrow-up text-danger"></i>
                                                                                <% }else{ %><%  } %>
                                                                            <% } %>
                                                                        </td>
                                                                        <td class="J-reference"><%= item3.reference.replace(/\n/g, '<br/>')%></td>
                                                                        <td>
                                                                            <a href="javascript:;" class="btn btn-sm btn-white J-del-item hidden"><i class="fa fa-minus"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                <% }) %>
                                                            </tbody>
                                                        </table>
                                                        <table class="table table-report shadow-none mt10 mbf10">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="6" class="pd20">
                                                                        <input type="hidden" class="J-select-inspect bigdrop select2-offscreen hidden" data-init="" data-initlist="" data-placeholder="?????????">
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="table table-report shadow-none mt10 mbf10">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="6" class="pl20">
                                                                        <% if(item2.remark != ''){ %>
                                                                        <p class="mt5">??????</p>
                                                                        <div class="J-remark-text"><%-item2.remark%></div>
                                                                        <% }else{ %>
                                                                        <p class="mt5 hidden J-remark-title">??????</p>
                                                                        <% } %>
                                                                        <input name="remark" value="<%-item2.remark%>" class="form-control w100 mb20 J-remark hidden">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6" class="pl20 border-none">
                                                                        <!-- ?????????????????? -->
                                                                        <div class="J-show-imgs-box image-preview-warp">
                                                                            <% $.each(item2.image || '', function(i4, item4){ %>
                                                                                <div class="col-xs-6 col-sm-3 col-md-3 image">
                                                                                    <div class="image-preview pos-relative">
                                                                                        <% if(item4.type == 'doc' || item4.type == 'docx'){ %>
                                                                                            <a href="<%-item4.url%>" target="_blank" class="display-block mbf8">
                                                                                                <i class="fa font48 dropdown-menu-head lh3 fa-file-word-o"></i>
                                                                                            </a>
                                                                                            <span class="upload-progress upload-doc-style" percent="100" style="width: 100%;">
                                                                                            <%-item4.name%>.<%-item4.type%>
                                                                                        </span>
                                                                                        <% }else if(item4.type == 'pdf'){ %>
                                                                                            <a href="<%-item4.url%>" target="_blank" class="display-block mbf8">
                                                                                                <i class="fa font48 dropdown-menu-head lh3 fa-file-pdf-o"></i>
                                                                                            </a>
                                                                                            <span class="upload-progress upload-doc-style" percent="100" style="width: 100%;">
                                                                                            <%-item4.name%>.<%-item4.type%>
                                                                                        </span>
                                                                                        <% }else if(item4.type == 'xls' || item4.type == 'xlsx'){ %>
                                                                                            <a href="<%-item4.url%>" target="_blank" class="display-block mbf8">
                                                                                                <i class="fa font48 dropdown-menu-head lh3 fa-file-excel-o"></i>
                                                                                            </a>
                                                                                            <span class="upload-progress upload-doc-style" percent="100" style="width: 100%;">
                                                                                            <%-item4.name%>.<%-item4.type%>
                                                                                        </span>
                                                                                        <% }else{ %>
                                                                                            <img data-original='<%-item4.url%>' src="<%-item4.url%>&pattern=200" class="img-responsive" alt="">
                                                                                        <% } %>
                                                                                    </div>
                                                                                </div>
                                                                            <% }) %>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <%++tempIndex;%>
                                <%}%>
                            <% }); %>
                        </div>
                    </div>
                </div>
            </div>
        <% }) %>
    </div>
</script>
                                    </div>
                                </div>
                                <!-- end ??????????????? -->
                                <!-- strat ???????????? -->

                                <!-- end ???????????? -->
                                <!-- ???????????? -->
                                <div class="tab-pane" id="tab4">
                                    <div class="panel panel-default shadow-none">
                                        <div class="panel-body pd0">
                                            <div class="table-responsive">
                                                <table class="table table-profile">
                                                    <thead>
                                                        <tr>
                                                            <th class="pl20" width="15%">????????????</th>
                                                            <th width="15%">????????????</th>
                                                            <th width="15%">????????????</th>
                                                            <th width="15%">????????????</th>
                                                            <th width="15%">????????????</th>
                                                            <th>????????????</th>
                                                            <th width="15%">??????</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="J-reservation-infos-wrap">
                                                        <?php  if(is_array($yuyueorder)) { foreach($yuyueorder as $yuy) { ?>
                                                        <tr>
                                                            <td><?php  echo $yuy['typs'];?></td>
                                                            <td><?php  echo $yuy['hospital'];?></td>
                                                            <td><?php  echo $yuy['yy_time'];?></td>
                                                            <td><?php  echo $yuy['keshi'];?></td>
                                                            <td><?php  echo $yuy['z_name'];?></td>
                                                            <td><?php  echo $yuy['yy_content'];?></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php  } } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ???????????? -->
                                <!-- ???????????? -->
                                <div class="tab-pane" id="tab3">
                                    <div class="row">

                                        <ul class="ul_scroll" id="wenzhens">
                                            <?php  if(is_array($wenzhenorder)) { foreach($wenzhenorder as $wenzhen) { ?>
                                            <div onclick="delwenzhen('<?php  echo $wenzhen['back_orser'];?>','<?php  echo $wenzhen['typs'];?>')">X</div>
                                            <li onclick="changemsg('<?php  echo $wenzhen['back_orser'];?>','<?php  echo $wenzhen['typs'];?>')"><?php  echo $wenzhen['names'];?></li>
                                            <?php  } } ?>
                                        </ul>

                                        <div class="col-md-12">
                                            <div class="panel panel-default shadow-none">
                                                <div class="panel-body msg_container_base" id="j_messages_talk_lst" style="max-height:auto;">

                                                    <!-- <div class="msg-item">

                                                        <div class="row msg_container base_receive">
                                                            <div class="col-md-2 col-xs-2 avatar">
                                                                <a href="javascript:void(0);">

                                                                    <img class="img-circle" src="https://thirdwx.qlogo.cn/mmopen/QgJh9Ohc8WmkcEf3PxZ2rIQxT6J8J65aFf1X3jtjcNiaqzNbStViakhOoWuVa41PY4HExNgPzlB0rkwvTByOVutpvfnicYY0TibH/132">

                                                                </a>
                                                                <a href="javascript:void(0);" class="name">????????????</a>
                                                            </div>
                                                            <div class="col-md-9 col-xs-10">
                                                                <div class="messages msg_receive">
                                                                    <p>

                                                                    </p>
                                                                    <div class="content_wrap">?????????????????????????????????</div>

                                                                    <p></p>
                                                                    <time datetime="2009-11-13T20:00">2020-03-10 18:16:45</time>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="msg-item">

                                                        <div class="row msg_container base_sent">
                                                            <div class="col-md-9 col-xs-10">
                                                                <div class="messages msg_sent">
                                                                    <p>

                                                                    </p>
                                                                    <div class="content_wrap">&lt;script&gt;alert(6)&lt;/script&gt;
                                                                        <img src="">
                                                                    </div>

                                                                    <p></p>
                                                                    <time datetime="2009-11-13T20:00">2020-03-11 10:18:41</time>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-xs-2 avatar">
                                                                <a href="javascript:void(0);">

                                                                    <img class="img-circle" src="https://img1.dxycdn.com/2018/0815/021/3294892008078052734-25.png">

                                                                </a>
                                                                <a href="javascript:void(0);" class="name">?????????????????????</a>
                                                            </div>
                                                        </div>

                                                    </div> -->
                                                </div>
                                                <div class="j_page_wrap ml15 mt20 display-none" style="display: block;">
                                                    <div class="base_page">
                                                        <a href="#/user/@null/hideauto/@null/desc/@null/tag/@null/url//japi/messages/list/member/OTRlNjAyOQ==/reverse/@null/size/@null/page/1" type="button" data-page_num="1" class="btn btn-default j_page_prev_btn pull-left">
                                                            <i class="fa fa-chevron-left"></i>
                                                        </a>
                                                        <button href="" type="button" class="btn btn-default j_page_info base_page_info pull-left" disabled="disabled">1/3</button>
                                                        <a href="#/user/@null/hideauto/@null/desc/@null/tag/@null/url//japi/messages/list/member/OTRlNjAyOQ==/reverse/@null/size/@null/page/2" type="button" data-page_num="2" class="btn btn-default j_page_next_btn pull-left">
                                                            <i class="fa fa-chevron-right"></i>
                                                        </a>
                                                        <input class="form-control base_page_search_input pull-left" id="j_madule_page_search_input" type="text">
                                                        <a class="btn btn-default j_madule_page_search_submit pull-left ml5" type="button">Go</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ???????????? -->
                                    <div class="table-responsive">
                                        <?php  if(is_array($family)) { foreach($family as $item) { ?>
                                        <table class="table table-profile">
                                            <tbody id="J-family-wrap">
                                                <tr>
                                                    <th colspan="3">????????????</th>
                                                </tr>

                                                <tr>
                                                    <td width="33.%">
                                                        <strong id="cy_gx">
                                                        <?php  if($item['sick_index'] =='1') { ?> ???????????? <?php  } ?>
                                                            <?php  if($item['sick_index'] =='2') { ?> ?????? <?php  } ?>
                                                            <?php  if($item['sick_index'] =='3') { ?> ?????? <?php  } ?>
                                                            <?php  if($item['sick_index'] =='4') { ?> ?????? <?php  } ?>???</strong>
                                                        <a id="cy_name"><?php  echo $item['names'];?></a>
                                                    </td>
                                                    <td width="33.%">
                                                        <strong>?????????</strong>
                                                        <span id="cy_sex"><?php  echo $item['sex'];?></span>

                                                    </td>

                                                </tr>

                                            </tbody>
                                        </table>
                                       
                                        <?php  } } ?>
                                        
                                    </div>
                                </div>
                                <!-- ???????????? -->
                                <script type="text/javascript">
                                    wenzorder('<?php  echo $openid;?>');
                                    function wenzorder(openid){
                                        $.ajax({
                                            'url':"./index.php?c=site&a=entry&op=getmsg&do=copysite&m=hyb_yl&act=profile.usre_wenzhen&ac=notice&openid="+openid,
                                            type:"get",
                                            dataType:"json",
                                            cache: false,
                                            processData: false,
                                            contentType: false,
                                            async:false,
                                            success:function(res){
                                                var html = "";
                                                for(var i=0;i<res.length;i++)
                                                {
                                                    var back_orser = res[i]['back_orser'];
                                                    var typs = res[i]['typs'];
                                                    var names = res[i]['names'];
                                                    html += `<li><div onclick="changemsg('`+back_orser+`','`+ typs +`')">`+names+`</div><div onclick="delwenzhen('`+back_orser+`','`+ typs +`')">X</div></li>`;
                                                }
                                                $("#wenzhens").html(html);
                                                changemsg(res[0]['back_orser'],res[0]['typs']);
                                            }
                                        })
                                    }
                                    function delwenzhen(back_orser,typs){
                                        
                                        $.ajax({
                                            'url':"./index.php?c=site&a=entry&op=getmsg&do=copysite&m=hyb_yl&act=profile.delwenzhen&ac=notice&back_orser="+back_orser+"&typs="+typs,
                                            type:"get",
                                            dataType:"json",
                                            cache: false,
                                            processData: false,
                                            contentType: false,
                                            async:false,
                                            success:function(res){
                                                if(res.code == '1')
                                                {
                                                    alert('????????????');
                                                    wenzorder('<?php  echo $openid;?>');
                                                }else{
                                                    alert('??????????????????????????????');
                                                }
                                                
                                                
                                            }
                                        })
                                    }
                                    // changemsg('<?php  echo $wenzhenorder[0]['back_orser'];?>','<?php  echo $wenzhenorder[0]['typs'];?>')
                                        function changemsg(back_orser,typs)
                                        {
                                            
                                            $.ajax({
                                                url:"./index.php?c=site&a=entry&op=getmsg&do=copysite&m=hyb_yl&act=profile.getmsg&ac=notice&back_orser="+back_orser+"&typs="+typs,
                                                type:"get",
                                                dataType:"json",
                                                cache: false,
                                                processData: false,
                                                contentType: false,
                                                async:false,
                                                success:function(res){
                                                    var html = '';
                                                    $("#cy_name").text(res[0].jiaren.names)
                                                    $("#cy_gx").text(res[0].jiaren.gx)
                                                    $("#cy_sex").text(res[0].jiaren.sex)

                                                    for(var i=0;i<res.length;i++)
                                                    {
                                                        if(res[i].role == '0')
                                                        {
                                                            html +="<div class='msg-item'>";
                                                            html +="<div class='row msg_container base_receive'>";
                                                            html +="<div class='col-md-2 col-xs-2 avatar'>";
                                                            html +="<a href='javascript:void(0);'>";
                                                            html +="<img class='img-circle' src='"+res[i].u_thumb+"'>";
                                                            html +="</a>";
                                                            html +="<a href='javascript:void(0);' class='name'>"+ res[i]['names'] +"</a>";
                                                            html +="</div>";
                                                            html +="<div class='col-md-9 col-xs-10'>";
                                                            html +="<div class='messages msg_receive'>";
                                                            html +="<p>";
                                                            html +="</p>";
                                                            html +="<div class='content_wrap'>"+res[i]['content']['text'];
                                                            if(res[i]['content']['typedate'] == '1' && res[i]['content']['upload_picture_list'].length != '0' && res[i]['content']['upload_picture_list'] != '[]')
                                                            {
                                                                for(var j=0;j<res[i]['content']['upload_picture_list'].length;j++)
                                                                {
                                                                    html += "<img width='100' src='" + res[i]['content']['upload_picture_list'][j] + "'>";     
                                                                }
                                                            } 
                                                            html += "</div>";
                                                            html +="<p></p>";
                                                            html +="<time datetime='2009-11-13T20:00'>"+res[i]['time']+"</time>";
                                                            html +="</div>";
                                                            html +="</div>";
                                                            html +="</div>";
                                                            html +="</div>";
                                                        }
                                                        else if(res[i].role == '1'){
                                                            html +="<div class='msg-item'>";
                                                            html +="<div class='row msg_container base_sent'>";
                                                            html +="<div class='col-md-9 col-xs-10'>";
                                                            html +="<div class='messages msg_sent'>";
                                                            html +="<p>";
                                                            html +="</p>";
                                                            html +="<div class='content_wrap'>"+res[i]['content']['text'];
                                                            if(res[i]['content']['upload_picture_list'].length != 0 && res[i]['content']['upload_picture_list'] != '[]')
                                                            {
                                                                for(var j=0;j<res[i]['content']['upload_picture_list'].length;j++)
                                                                {
                                                                    html += "<img width='100' src='" + res[i]['content']['upload_picture_list'][j] + "'>";     
                                                                }
                                                            }  
                                                            html +="</div>";
                                                            html +="<p></p>";
                                                            html +="<time datetime='2009-11-13T20:00'>"+res[i]['time']+"</time>";
                                                            html +="</div>";
                                                            html +="</div>";
                                                            html +="<div class='col-md-2 col-xs-2 avatar'>";
                                                            html +="<a href='javascript:void(0);'>";
                                                            html +="<img class='img-circle' src='"+res[i]['advertisement']+"'>";
                                                            html +="</a>";
                                                            html +="<a href='javascript:void(0);' class='name'>"+res[i]['z_name']+"</a>";
                                                            html +="</div>";
                                                            html +="</div>";
                                                            html +="</div>";
                                                        }
                                                    }
                                                    $("#j_messages_talk_lst").html(html)
                                    
                                                }
                                    
                                            })
                                        }
                                </script>

                                <!--????????????-->
                                <div class="tab-pane" id="tab7">
                                    <div class="consumption-info">
                                        <div class="consumption-info-item">?????????<span class="total"><?php  echo $money;?></span>???</div>
                                        <!-- <div class="consumption-info-item">??????<span class="cash">519.27</span>???</div>
                                        <div class="consumption-info-item">??????<span class="healthCare">0</span>???</div>
                                        <div class="consumption-info-item">??????<span class="wechat">0</span>???</div>
                                        <div class="consumption-info-item">?????????<span class="alipay">0</span>???</div> -->
                                    </div>
                                    <div class="consumption-info">
                                        <!-- <div class="df">
                                            <div class="consumption-search-type-text">???????????????</div>
                                            <select name="" class="form-control" style="">
                                                <option value="">?????????</option>
                                                <option>????????????????????????</option>
                                            </select>
                                        </div>
                                        <div class="df">
                                            <div class="consumption-search-type-text">???????????????</div>
                                            <select name="" class="form-control" style="">
                                                <option value="">??????</option>
                                                <option>????????????</option>
                                                <option>????????????</option>
                                                <option>????????????</option>
                                                <option>????????????</option>
                                                <option>????????????</option>
                                                <option>??????</option>
                                                <option>??????</option>
                                                <option>??????</option>
                                            </select>
                                        </div> -->
                                        <!-- <div class="df">
                                            <div class="consumption-search-type-text">???????????????</div>
                                            <div class="el-date-editor el-range-editor el-input__inner consumption-search-type-date el-date-editor--daterange" style="height: 32px;">
                                                <i class="el-input__icon el-range__icon el-icon-date"></i>
                                                <input autocomplete="off" placeholder="????????????" name="" class="el-range-input" style="height: 30px!important;">
                                                <span class="el-range-separator">-</span>
                                                <input autocomplete="off" placeholder="????????????" name="" class="el-range-input" style="height: 30px!important;"><i class="el-input__icon el-range__close-icon"></i>
                                            </div>
                                        </div>
                                        <input type="text" autocomplete="off" placeholder="????????????/?????????" maxlength="50" class="form-control" style="width: 20%">
                                        <button type="button" class="el-button consumption-search-btn-search el-button--primary"><span>
      ??????
    </span></button> -->
                                    </div>
                                    <table class="table table-hover">
                                        <thead class="table-header">
                                            <tr>
                                                <th>????????????</th>
                                                <th>?????????</th>
                                                <th>??????</th>
                                                <th>??????</th>
                                                <!-- <th>?????????</th> -->
                                                <th>?????????????????????</th>
                                                <!-- <th>??????</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="table-body">
                                            <?php  if(is_array($order)) { foreach($order as $orders) { ?>
                                            <tr>
                                                <td><?php  echo $orders['time'];?></td>
                                                <td>
                                                    <div class="cell"><?php  echo $orders['back_orser'];?></div>
                                                </td>
                                                <td><?php  echo $orders['types'];?></td>
                                                <td>
                                                    <div class="cell"><?php  echo $orders['names'];?></div>
                                                </td>
                                                <!-- <td>??????</td> -->
                                                <td><?php  echo $orders['money'];?>???</td>
                                                <!-- <td>
                                                    <span class="consumption-table-detail">??????</span>
                                                </td> -->
                                            </tr>
                                            <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!--????????????-->
                            </div>
                            <div class="tab-content hidden shadow-none pd0" id="J-tab-content-2">
                                <div class="panel-heading">
                                    <h4 class="panel-title">????????????</h4>
                                </div>
                                <div>
                                    <button class="btn btn-primary J-record-bloodsugar">????????????</button>
                                    <button class="btn btn-primary J-setting-bloodsugar-range">??????????????????</button>
                                </div>
                                <div class="panel-body">
                                    <h4 class="panel-title">????????????</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ???????????? -->
</div>

<!--???????????????????????? -->
<div tabindex="-1" class="modal fade" id="myModal" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <form id="J-add-family-form" action="" method="post">
            <input type="hidden" name="do" value="copysite">
            <input type="hidden" name="m" value="hyb_yl">
            <input type="hidden" name="act" value="profile.edituser_list">
            <input type="hidden" name="ac" value="notice">
            <input type="hidden" name="u_id" value="<?php  echo $u_id;?>">
            <input type="hidden" name="openid" value="<?php  echo $openid;?>">
            <input type="hidden" name="j_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" aria-hidden="true" type="button" data-dismiss="modal">??</button>
                    <h4 class="modal-title">??????????????????</h4>
                </div>
                <div class="modal-body">
                    <div class="m10">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label">???????????? <span class="asterisk">*</span>
                                    </label>
                                    <select class="form-control input-sm mt0 J-member-select" data-placeholder="?????????" select-data="109" name="sick_index">

                                        <option value="1" <?php  if($item['sick_index']=='1' ) { ?> selected="" <?php  } ?>>
                                                ????????????
                                                </option>

                                                <option value="2" <?php  if($item['sick_index']=='2' ) { ?> selected="" <?php  } ?>>
                                                ??????
                                                </option>

                                                <option value="3" <?php  if($item['sick_index']=='3' ) { ?> selected="" <?php  } ?>>
                                                ??????
                                                </option>

                                                <option value="4" <?php  if($item['sick_index']=='4' ) { ?> selected="" <?php  } ?>>
                                                ??????
                                                </option>

                                                </select>
                                                </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                            <div class="form-group pos-relative">
                                                <div class="form-group">
                                                    <label class="control-label">?????? <span class="asterisk">*</span>
                                                    </label>
                                                    <input name="names" class="form-control J-patient-name" type="text" value="<?php  echo $item['my']['names'];?>">
                                                </div>
                                                <div class="search-block hidden J-search-name">
                                                    <div class="tips">??????????????????????????????</div>
                                                    <ul></ul>
                                                </div>
                                            </div>
                                </div>
                            </div>
                            <!-- row -->
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">?????? <span class="asterisk">*</span>
                                        </label>
                                        <div class="row mt10">
                                            <div class="col-sm-4 col-pad-sm">
                                                <div class="rdio rdio-default">
                                                    <input type="radio" name="sex" id="radioDefault31" value="???" <?php  if($item['sex']=='???' ) { ?> checked="" <?php  } ?> required="">
                                                    <label for="radioDefault31">???</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-pad-sm">
                                                <div class="rdio rdio-default">
                                                    <input type="radio" name="sex" id="radioDefault32" value="???" <?php  if($item['sex']=='???' ) { ?> checked="" <?php  } ?> required="">
                                                    <label for="radioDefault32">???</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">???????????? <span class="asterisk">*</span>
                                        </label>
                                        <?php  echo tpl_form_field_date('datetime', $item['datetime'])?>
                                    </div>
                                </div>
                                <!-- col-sm-4 -->
                            </div>
                            <!-- row -->
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">????????? <span class="asterisk">*</span>
                                        </label>
                                        <input name="tel" class="form-control" type="number" value="<?php  echo $item['tel'];?>">
                                    </div>
                                </div>
                                <!-- col-sm-4 -->
                                <div class="col-sm-6 col-md-6 J-module-control" data-modules="32">
                                    <div class="form-group">
                                        <label class="control-label">???????????????</label>
                                        <div class="form-group input-group">
                                            <input name="numcard" class="form-control" type="text" value="<?php  echo $item['numcard'];?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- col-sm-4 -->
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">??????????????? <span class="asterisk">*</span>
                                        </label>
                                        <select class="form-control input-sm mt0" data-placeholder="?????????" name="hunyin">
                                            <option value="">?????????</option>
                                            <option value="??????" <?php  if($item['hunyin']=='??????' ) { ?> selected="" <?php  } ?>>?????? </option>
                                                    <option value="??????" <?php  if($item['hunyin']=='??????' ) { ?>selected="" <?php  } ?>>?????? </option>
                                                    <option value="" <?php  if($item['hunyin']=='' ) { ?>selected="" <?php  } ?>>?????? </option>
                                                    </select>
                                                    </div>
                                                    </div>
                                                    <!-- col-sm-4 -->
                                                <div class="col-sm-6 col-md-6 J-module-control" data-modules="32">
                                                    <div class="form-group">
                                                        <label class="control-label">?????????</label>
                                                        <div class="form-group input-group">
                                                            <input name="zhiye" class="form-control email" type="text" value="<?php  echo $item['zhiye'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- col-sm-4 -->
                                    </div>
                                    <!-- <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label">???????????? <span class="asterisk">*</span>
                                    </label>
                                    <div class="form-group input-group">
                                    <div class="col-sm-4 col-pad-sm">
                                        <div class="rdio rdio-default">
                                            <input type="radio" name="gan_index" id="radioDefault1" value="0" <?php  if($item['gan_index'] == '0') { ?> checked="" <?php  } ?> required="">
                                            <label for="radioDefault1">??????</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-pad-sm">
                                        <div class="rdio rdio-default">
                                            <input type="radio" name="gan_index" id="radioDefault2" value="1" <?php  if($item['gan_index'] == '1') { ?> checked="" <?php  } ?> required="">
                                            <label for="radioDefault2">??????</label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 J-module-control" data-modules="32">
                                <div class="form-group">
                                    <label class="control-label">????????????</label>
                                    <div class="form-group input-group">
                                    <div class="col-sm-4 col-pad-sm">
                                        <div class="rdio rdio-default">
                                            <input type="radio" name="shen_index" id="radioDefault1" value="0" <?php  if($item['shen_index'] == '0') { ?> checked="" <?php  } ?> required="">
                                            <label for="radioDefault1">??????</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-pad-sm">
                                        <div class="rdio rdio-default">
                                            <input type="radio" name="shen_index" id="radioDefault2" value="1" <?php  if($item['shen_index'] == '1') { ?> checked="" <?php  } ?> required="">
                                            <label for="radioDefault2">??????</label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label">??????????????? <span class="asterisk">*</span>
                                    </label>
                                    <div class="form-group input-group">
                                    <div class="col-sm-4 col-pad-sm">
                                        <div class="rdio rdio-default">
                                            <input type="radio" name="be_index" id="radioDefault1" value="0" <?php  if($item['be_index'] == '0') { ?> checked="" <?php  } ?> required="">
                                            <label for="radioDefault1">???</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-pad-sm">
                                        <div class="rdio rdio-default">
                                            <input type="radio" name="be_index" id="radioDefault2" value="1" <?php  if($item['be_index'] == '1') { ?> checked="" <?php  } ?> required="">
                                            <label for="radioDefault2">?????????</label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                                    <div class="row J-load-location">
                                        <div class="col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">??????</label>
                                                <?php  echo tpl_form_field_district('address',array('province' =>$item['regions']['0'],'city'=>$item['regions']['1'],'district'=>$item['regions']['2']))?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer modal-btn-col2">
                                <input type="submit" name="submit" value="??????" class="btn btn-primary J-base-submit" />
                                <button class="btn btn-default" type="button" data-dismiss="modal">??????</button>
                            </div>
                        </div>
        </form>
    </div>
</div>





<!--????????????-->
<style>
    .zhe{
        position: fixed;
        top:0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .zhe .cont{
        width: 60%;
        background: #fff;
        position: relative;
        padding: 20px;
    }
    .close_top{
        padding: 10px;
    }
    .cont .title{
        padding: 10px 0;
        color:#666;
        font-size: 16px;
        font-weight: 400;
    }
</style>
<div class="zhe" style="display: none;">
    <div class="cont">
        <div class="close_top">
            <button type="button" class="el-dialog__headerbtn Close">x</button>
        </div>
        <div class="title">13202006011654218323703341</div>
        <table class="table table-hover">
            <thead class="table-header">
                <tr>
                    <th>??????</th>
                    <th>??????</th>
                    <th>??????</th>
                    <th>??????</th>
                    <th>??????</th>
                    <th>????????????</th>
                </tr>
            </thead>
            <tbody class="table-body">
                <tr>
                    <td>??????</td>
                    <td>???</td>
                    <td>50???</td>
                    <td>1???</td>
                    <td>???50</td>
                    <td>??????</td>
                </tr>
            </tbody>

        </table>
        <div class="text-right" style="color: #4381c6;font-size: 14px;">??????????????????50</div>
        <div class="text-right" style="color: #666;font-size: 14px;">??????????????????????????????50</div>
    </div>
</div>
<!--??????????????????-->
<!-- ???????????? -->
<style>
    .chenyuanzhe{
        position: fixed;
        top: 0;
        left: 0;
        background: rgba(0,0,0,0.4);
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }
    .title{
        text-align: center;
        font-size: 30px;
        color: #666;
        font-weight: bold;
        padding:20px;
    }
    .cont1{
        width: 60%;
        background: #fff;
        padding: 0 20px;

    }
    .btnBox3{
        display: flex;
        justify-content: flex-end;
        padding: 20px 0;
    }
</style>
<div class="chenyuanzhe" style="z-index: 2052;display: none;">
    <div class="cont1">
        <div class="title">????????????</div>
        <table class="table table-profile">
            <thead>
                <tr>
                    <th>????????????</th>
                    <th>????????????</th>
                    <th>????????????</th>
                    <th>??????</th>
                    <th>????????????</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>??????</td>
                    <td>??????</td>
                    <td>????????????</td>
                    <td>????????????</td>
                    <td>2020-02-06 12:35:00</td>
                </tr>
            </tbody>
        </table>
        <div class="btnBox3">
            <button class="close3 btn btn-danger el-button el-button--primary">??????</button>
        </div>

    </div>
</div>
<script>
    // ??????????????????
         $(document).on('click','.chankanBtn',function(){
                    $('.chenyuanzhe').show()
                })
        $(document).on('click','.close3',function(){
            $('.chenyuanzhe').hide()
        })
        // ??????????????????
    </script>
<!-- ???????????? -->

<!-- ??????????????? -->
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
<!--?????????????????????  -->

<!--??????-->
<script>
    $('.el-radio-button').click(function () {
            $(this).parents('.boxBtn').find('.el-radio-button').removeClass('is-active')
            $(this).addClass('is-active')
        })
        $('.consumption-table-detail').click(function () {
            $('.zhe').show()
        })
        $('.Close').click(function () {
            $('.zhe').hide()
        })
</script>

<script>
    function showOrHide(a,b){
        $('#profile_'+b).toggle()
        $('#profile_'+a).toggle()
    
    }
    $('#tab3 ul li').on('click',function(){
        $('#tab3 ul li').removeClass('ractive')
        $(this).addClass('ractive')
    })
      
      $(document).on('click','.remove',function(){
        $(this).parents('tbody').remove()
      })
      function showss(e)
      {
        console.log(e.getAttribute('data-id'));
        $('.el-dialog__wrapper').show()
        var id = e.getAttribute('data-id')
        var url ="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=profile.userchufang&id="+id
     
        $.ajax({
            url:url,
            type: "POST",  
            dataType: "html",  
            cache:false, 

            success:function(res){
                $('#module-menus-doc').html(res)
            }
        })
      }
      // $('.btnGoInfo').click(function(e){
      //   console.log(e.currentTarget.dataset.id);
      //   $('.el-dialog__wrapper').show()
      //   var id = e.currentTarget.dataset.id
      //   var url ="/index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=profile.userchufang&id="+id
     
      //   $.ajax({
      //       url:url,
      //       type: "POST",  
      //       dataType: "html",  
      //       cache:false, 

      //       success:function(res){
      //           $('#module-menus-doc').html(res)
      //       }
      //   })
      // })

</script>