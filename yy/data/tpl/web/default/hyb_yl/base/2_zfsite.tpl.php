<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<style>
    .file_button{
        align-items: flex-start;
        background-attachment: scroll;
        background-clip: border-box;
        background-color: rgb(240, 249, 235);
        background-image: none;
        background-origin: padding-box;
        background-position-x: 0%;
        background-position-y: 0%;
        background-repeat-x: ;
        background-repeat-y: ;
        background-size: auto;
        border-bottom-color: rgb(194, 231, 176);
        border-bottom-left-radius: 3px;
        border-bottom-right-radius: 3px;
        border-bottom-style: solid;
        border-bottom-width: 1px;
        border-image-outset: 0px;
        border-image-repeat: stretch;
        border-image-slice: 100%;
        border-image-source: none;
        border-image-width: 1;
        border-left-color: rgb(194, 231, 176);
        border-left-style: solid;
        border-left-width: 1px;
        border-right-color: rgb(194, 231, 176);
        border-right-style: solid;
        border-right-width: 1px;
        border-top-color: rgb(194, 231, 176);
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        border-top-style: solid;
        border-top-width: 1px;
        box-sizing: border-box;
        color: rgb(103, 194, 58);
        cursor: pointer;
        display: inline-block;
        font-family: sans-serif;
        font-size: 12px;
        font-stretch: 100%;
        font-style: normal;
        font-variant-caps: normal;
        font-variant-east-asian: normal;
        font-variant-ligatures: normal;
        font-variant-numeric: normal;
        font-weight: 500;
        height: 32px;
        letter-spacing: normal;
        line-height: 12px;
        margin-bottom: 0px;
        margin-left: 0px;
        margin-right: 0px;
        margin-top: 0px;
        outline-color: rgb(103, 194, 58);
        outline-style: none;
        outline-width: 0px;
        overflow-x: visible;
        overflow-y: visible;
        padding-bottom: 9px;
        padding-left: 15px;
        padding-right: 15px;
        padding-top: 9px;
        text-align: center;
        text-indent: 0px;
        text-rendering: auto;
        text-shadow: none;
        nonebutton
        text-size-adjust: 100%;
        text-transform: none;
        nonebutton, select
        nonebutton
        transition-delay: 0s;
        transition-duration: 0.1s;
        transition-property: all;
        transition-timing-function: ease;
        user-select: none;
        white-space: nowrap;
        width: 80px;
        word-spacing: 0px;
        writing-mode: horizontal-tb;
        -webkit-appearance: none;
        -webkit-font-smoothing: antialiased;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        -webkit-border-image: none;
    }
    textarea{
        resize: none;
    }
    .file_tips{
        color: red;
        position: relative;
        top: 5px;
        font-size: 12px;
    }
</style>
<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#tab_basic">??????????????????</a></li>
</ul>
<div class="app-content" id="mainContent">
    <div class="app-form">
        <form action="" method="post" class="form-horizontal form form-validate" role="form" enctype="multipart/form-data">
         
            <div class="panel panel-default">
                <div class="panel-heading">??????????????????</div>
                <div class="panel-body">
                    <!--??????????????????-->
<!--                     <div class="form-group">
                        <label class="col-sm-2 control-label">????????????<span class="must-fill">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" v-model="info.name" required placeholder="?????????????????????" autocomplete="off" class="form-control" >
                        </div>
                    </div> -->
<!--                     <div class="form-group">
                        <label class="col-sm-2 control-label">????????????<span class="must-fill">*</span></label>
                        <div class="col-sm-9">
                            <label class="radio-inline"><input type="radio" v-model="info.type" value="1">????????????</label>
                         
                        </div>
                    </div> -->
                    <!--??????????????????-->
                    <span v-if="info.type == 1">
                        <div class="form-group" v-if="info.type == 2">
                            <label class="col-sm-2 control-label">?????????AppId<span class="must-fill">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" v-model="info.app_id" name="pub_appid" required placeholder="??????????????????appid" autocomplete="off" class="form-control" value="<?php  echo $res['pub_appid'];?>">
                            </div>
                        </div>
<!--                         <div class="form-group">
                            <label class="col-sm-2 control-label">????????????<span class="must-fill">*</span></label>
                            <div class="col-sm-9">
                                <label class="radio-inline"><input type="radio" v-model="info.shop_type" value="1">????????????????????????????????????</label>
                               
                            </div>
                        </div> -->
                        <!--????????????-->
                        <span v-if="info.shop_type == 1">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">?????????<span class="must-fill">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" v-model="info.shop_number" required placeholder="??????????????????"
                                           autocomplete="off" class="form-control" name="mch_id" value="<?php  echo $res['mch_id'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">??????????????????<span class="must-fill">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" v-model="info.secret_key" required placeholder="???????????????????????????"
                                           autocomplete="off" class="form-control" name="pub_api" value="<?php  echo $res['pub_api'];?>">
                                </div>
                            </div>
                        </span>
                        <!--?????????-->
                       
                        <div class="form-group">
                            <label class="col-sm-2 control-label">cert??????<span class="must-fill">*</span></label>
                            <div class="col-sm-9 addFileBox">
                                <button type="button" class="file_button" style="position: relative;">
                                    <span>????????????</span>
                                    <input type="file" accept="file" onchange="addFile(this)" name="upfile" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;opacity: 0;" value="<?php  echo $res['upfile'];?>">
                                </button>
                               
                                <a class="textHref" href=""><?php  echo $res['upfile'];?></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">key??????<span class="must-fill">*</span></label>
                            <div class="col-sm-9 addFileBox">
                                <button type="button" class="file_button" style="position: relative;">
                                    <span>????????????</span>
                                     <input type="file" accept="file" onchange="addFile(this)" name="keypem" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;opacity: 0;" value="<?php  echo $res['keypem'];?>">
                                </button>
                                
                                <a class="textHref" href=""><?php  echo $res['keypem'];?></a>
                            </div>
                        </div>
                        <!--?????????????????????-->
<!--                         <span v-if="info.shop_type == 2">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">?????????????????????<span class="must-fill">*</span></label>
                                <div class="col-sm-9">
                                    <label class="radio-inline"><input type="radio" v-model="info.sub_enterprise_payment" value="1">?????????</label>
                                    <label class="radio-inline"><input type="radio" v-model="info.sub_enterprise_payment" value="2">??????</label>
                                </div>
                            </div>
                            <span  v-if="info.sub_enterprise_payment == 2">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">?????????????????????<span class="must-fill">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" v-model="info.sub_secret_key" required placeholder="??????????????????????????????" autocomplete="off" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">?????????cert??????<span class="must-fill">*</span></label>
                                    <div class="col-sm-9">
                                        <button type="button" class="file_button" @click="selectFile('sub_cert_certificate')">
                                            <span>????????????</span>
                                        </button>
                                        <span class="file_tips" v-if="!info.sub_cert_certificate">???????????????</span>
                                        <span class="file_tips" v-else>????????????</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">?????????key??????<span class="must-fill">*</span></label>
                                    <div class="col-sm-9">
                                        <button type="button" class="file_button" @click="selectFile('sub_key_certificate')">
                                            <span>????????????</span>
                                        </button>
                                        <span class="file_tips" v-if="!info.sub_key_certificate">???????????????</span>
                                        <span class="file_tips" v-else>????????????</span>
                                    </div>
                                </div>
                            </span>
                        </span> -->
                    </span>
                    <!--?????????????????????-->
                   
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary min-width" ><span>??????</span></button>
                    <input type="file" id="upload" class="hide" />
                    <input type="hidden" name="p_id" value="<?php  echo $res['p_id'];?>">
                </div>
            </div>
        </form>
    </div>
</div>

			</div>
		</div>
	</div>
	<div class="foot" id="footer">
		<ul class="links ft">
            <li class="links_item"><div class="copyright">Powered by <a href="http://www.we7.cc"><b>??????</b></a> v2.0.4 ?? 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a></div></li>
		</ul>
	</div>

	</body>
</html>

<script type="text/javascript">
function addFile(obj) {
    console.log(obj)
     var file = obj.files[0];
     console.log(file.name)
     var reader = new  FileReader();
     reader.readAsDataURL(file);
     reader.onload = function (ev) {

         $(obj).parents('.addFileBox').find(".textHref").text(file.name);
     }
}      
</script>