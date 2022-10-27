<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/hyb_yl/public/admin/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/hyb_yl/public/admin/bootstrap-multiselect.css" type="text/css"/>
<div class="app-container-right">
	<ul class="nav nav-tabs" id="myTab">
		<li class="active"><a href="#tab_basic">基础信息</a></li>
		<li class=""><a href="#tab_admin">开关设置</a></li>
		<li class=""><a href="#tab_other">模板信息</a></li>
		<li class=""><a href="#tab_fenyuan">适用分院</a></li>
	</ul>
<div class="app-content">
<style>
	.category-container .category-item {position: relative; height: 80px; border: 1px solid #eee; margin-bottom: 10px;}
	.category-container .btn-del {height: 0; width: 100%; display: block; position: relative;}
	.category-container .btn-del::before {content: "×"; position: absolute; height: 16px; width: 16px; text-align: center; line-height: 14px; color: rgb(255, 255, 255); cursor: pointer; top: -6px; right: -6px; z-index: 10; background: rgba(0, 0, 0, 0.3); border-radius: 16px;}
	.category-container .category-item img {width: 100%; height: 80px;}
	.category-container .category-item .title {position: absolute; height: 20px; left: 0; right: 0; bottom: -1px; background: rgba(0,0,0,0.5); color: #fff; text-align: center; font-size: 12px; line-height: 20px; cursor: pointer;}
	.tab-content > .tab-pane {display: none;visibility: hidden;}
	.tab-content > .active {display: block;visibility: visible;}
	.df{display: flex;align-items: center;}
	#moban{width: 800px;border:1px solid #f4f5f9;padding-bottom: 10px;}
	#moban input{width: 80px;margin-left: 10px;}
	.title{padding: 10px;background: #f4f5f9;}
	.name1{font-size: 14px;color: #999;white-space: nowrap;margin:0 5px;}
	.conts{margin-top: 10px;padding:0 10px 10px 10px;border-bottom:1px solid #f4f5f9; }
	.conts:last-child{border:0;}
	.btn-group{width: 100%;}
	.btn-group button{width: 100%;display: flex;justify-content: space-between;align-items: center;}
</style>
<div class="app-form">


	<form class="form-horizontal form form-validate tab-content layui-form"" id="form1" action="" method="post" enctype="multipart/form-data">
		<div id='tab_basic' class="tab-pane active">
			<div class="form-group-title active">编辑套餐</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">排序</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="taocan[sort]" value="<?php  echo $itemArr['sort'];?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">套餐名称</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="taocan[title]" value="<?php  echo $itemArr['title'];?>" required="true">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">套餐缩略图</label>
				<div class="col-sm-9">
					<?php  echo  tpl_form_field_image('taocan[thumb]', $itemArr['thumb'])?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">套餐图集</label>
				<div class="col-sm-9 col-xs-12">
				<?php  echo  tpl_form_field_multi_image('taocan[imgpath]', $itemArr['imgpath'])?>
				</div>				
				<span class="help-block">建议640X300</span>
				
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">套餐分类</label>
				<div class="col-sm-9">
					<select class="form-control" name="taocan[type]">
						<option value="">请选择套餐</option>
					<?php  if(is_array($cate)) { foreach($cate as $type) { ?>
						<option value="<?php  echo $type['id'];?>" <?php  if($itemArr['type'] == $type['id']) { ?> selected="selected" <?php  } ?>><?php  echo $type['title'];?></option>
					<?php  } } ?>
					</select>
				</div>
			</div>
<!-- 			<div class="form-group">
				<label class="col-sm-2 control-label">人群<span class="must-fill">*</span></label>
				<div class="col-sm-9">
					<select name="taocan[crowd]" class="form-control">
						<option value="">请选择人群</option>
						<?php  if(is_array($crowds)) { foreach($crowds as $cro) { ?>
						<option value="<?php  echo $cro['id'];?>" <?php  if($cro['id'] == $item['crowd']) { ?> selected="selected" <?php  } ?>><?php  echo $cro['title'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div> -->
	        <div class="form-group">
	            <label class="col-sm-2 control-label">适用人群</label>
	            <div class="col-sm-9" id="biaoqian">
	            <?php  if(is_array($crowds)) { foreach($crowds as $item) { ?>
	                 <label class="checkbox-inline"><input type="checkbox" name="crowd[]" <?php  if(in_array($item['id'],$crowdArr)) { ?> checked="checked" <?php  } ?>  value="<?php  echo $item['id'];?>"><?php  echo $item['title'];?></label>
	            <?php  } } ?>
	            </div>
	        </div>
<!-- 			<div class="form-group">

                <label class="col-sm-2 control-label">所属机构<span class="must-fill">*</span>
                </label>
                <div class="col-sm-9">
                    <div class="row row-fix tpl-category-container">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <select class="form-control tpl-category-parent we7-select" id="category_parentjg" name="taocan[jigou_one]" >
                                <option value="0">请选择一级分类</option>
                                <?php  if(is_array($athuo_list)) { foreach($athuo_list as $items) { ?>
                                <option value="<?php  echo $items['id'];?>" <?php  if($itemArr['jigou_one']==$items['id']) { ?> selected="selected" <?php  } ?>><?php  echo $items['name'];?></option>
                                <?php  } } ?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <select class="form-control tpl-category-child we7-select" id="category_childjg" name="taocan[jigou_two]">
                                 <option value='0'>请选择二级分类</option>
                                <?php  if(is_array($erji)) { foreach($erji as $items) { ?>
                                <option value="<?php  echo $items['hid'];?>" <?php  if($itemArr['jigou_two']==$items['hid']) { ?> selected="selected" <?php  } ?>><?php  echo $items['agentname'];?></option>
                                <?php  } } ?>
                            </select>
                        </div>
                    </div>
                </div>
                
            </div> -->

			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">预约小时</label>
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon">请于</span>
						<input type="number" name="taocan[time]" class="form-control" value="<?php  echo $itemArr['time'];?>">
						<span class="input-group-addon">小时前预约</span>
					</div>
					<span class="help-block">不填或填0即为免预约</span>
				</div>
			</div>
<!-- 			<div class="form-group" id="expresstemplate" >
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">报告运费模板</label>
				<div class="col-sm-4 col-xs-4">
					<select name='taocan[yunfei]' class="form-control" >
						<option value="">请选择报告运费模板</option>
					<?php  if(is_array($yunfei)) { foreach($yunfei as $yun) { ?>
						<option value="<?php  echo $yun['id'];?>" <?php  if($item['yunfei'] == $yun['id']) { ?> selected="selected" <?php  } ?>><?php  echo $yun['title'];?></option>
					<?php  } } ?>
					</select>
				</div>
				<div class="help-block col-md-10 col-lg-offset-2">不选择运费模板即为包邮。</div>
			</div> -->
			<div class="form-group">
				<label class="col-sm-2 control-label">套餐价</label>
				<div class="col-sm-9">
					<div class="input-group">
						<input type="text" class="form-control" name="taocan[price]" value="<?php  echo $itemArr['price'];?>">
						<div class="input-group-addon">元</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">套餐库存</label>
				<div class="col-sm-9">
					<div class="input-group">
						<input type="text" class="form-control" name="taocan[num]" value="<?php  echo $itemArr['num'];?>">
						<div class="input-group-addon">份</div>
					</div>
					<div class="help-block">
						填0或者不填则为无限库存的商品
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">套餐描述</label>
				<div class="col-xs-12 col-sm-8">
					<input type="text" name="taocan[content]" class="form-control" value="<?php  echo $itemArr['content'];?>">
					<span class="help-block">如果不填写，默认为套餐标题</span>
				</div>
			</div>
					
			<div class="form-group">
				<label class="col-sm-2 control-label">注意事项</label>
				<div class="col-sm-9">
					<?php  echo tpl_ueditor('taocan[notes]',$itemArr['notes']);?>
				</div>
			</div>
		</div>
		<div id='tab_admin' class="tab-pane">
			<div class="form-group">
                <label class="col-sm-2 control-label">审核状态</label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input type="radio" name="taocan[status]" value="0" <?php  if($itemArr['status'] == '0') { ?> checked="" <?php  } ?>> 待审核
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="taocan[status]" value="1" <?php  if($itemArr['status'] == '1') { ?> checked="" <?php  } ?>> 已通过
                    </label>
                  
                </div>
			</div>
			<div class="form-group">
                <label class="col-sm-2 control-label">上架状态</label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input type="radio" name="taocan[typs]" value="0" <?php  if($itemArr['typs'] == '0') { ?> checked="" <?php  } ?>> 上架
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="taocan[typs]" value="1" <?php  if($itemArr['typs'] == '1') { ?> checked="" <?php  } ?>> 下架
                    </label>
                </div>
		    </div>
	      	<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">用户申请退款</label>
				<div class="col-md-6">
					<label class="radio-inline">
	    				<input type="radio" name="taocan[is_tui]" value="0" <?php  if($itemArr['is_tui'] == '0') { ?> checked="" <?php  } ?>> 允许
	    			</label>
					<label class="radio-inline">
	    				<input type="radio" name="taocan[is_tui]" value="1" <?php  if($itemArr['is_tui'] == '1') { ?> checked="" <?php  } ?>> 禁止
	    			</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">过期订单退款</label>
				<div class="col-md-6">
					<label class="radio-inline">
	    				<input type="radio" name="taocan[is_guoqi]" value="1" <?php  if($itemArr['is_guoqi'] == '1') { ?> checked="" <?php  } ?>> 启用
	    			</label>
					<label class="radio-inline">
	    				<input type="radio" name="taocan[is_guoqi]" value="0" <?php  if($itemArr['is_guoqi'] == '0') { ?> checked="" <?php  } ?>> 禁用
	    			</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">推荐套餐</label>
				<div class="col-md-6">
					<label class="radio-inline">
	    				<input type="radio" name="taocan[is_tuijian]" value="1" <?php  if($itemArr['is_tuijian'] == '1') { ?> checked="" <?php  } ?>> 推荐
	    			</label>
					<label class="radio-inline">
	    				<input type="radio" name="taocan[is_tuijian]" value="0" <?php  if($itemArr['is_tuijian'] == '0') { ?> checked="" <?php  } ?>> 不推荐
	    			</label>
					<span class="help-block">推荐套餐会显示在体检的首页列表</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">会员优惠</label>
				<div class="col-sm-9 col-xs-12">
					<label class="radio-inline" onclick="$('#vipprice').hide();" >
	                    <input type="radio" value="0" name="taocan[is_vip]" <?php  if($itemArr['is_vip'] == '0') { ?> checked <?php  } ?> onclick="vipchange(0)">无
	                </label>
	                <label class="radio-inline" onclick="$('#vipprice').show();">
	                    <input type="radio" value="1" name="taocan[is_vip]" <?php  if($itemArr['is_vip'] == '1') { ?> checked="" <?php  } ?> onclick="vipchange(1)">会员特价
	                </label>
	              
				</div>
			</div>
			<div id="vipchs" class="form-group" <?php  if($itemArr['is_vip'] == '0') { ?> style="display: none" <?php  } ?>>
				<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">会员优惠价</label>
				<div class="col-xs-12 col-sm-8">
					<input type="text" name="taocan[vip_money]" class="form-control" value="<?php  echo $itemArr['vip_money'];?>">
					
				</div>
			</div>
			<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否参与分销</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" value="1" name="taocan[is_fenxiao]" <?php  if($itemArr['is_fenxiao'] == '1') { ?> checked="" <?php  } ?> onclick="distri(1)"/> 参与
						</label>
						<label class="radio-inline">
							<input type="radio" value="0" name="taocan[is_fenxiao]" <?php  if($itemArr['is_fenxiao'] == '0') { ?> checked <?php  } ?> onclick="distri(0)" /> 不参与
						</label>
					</div>
			</div>
			<div id="distridiv" class="form-group row" <?php  if($itemArr['is_fenxiao'] == 0) { ?> style="display: none;" <?php  } ?>>
				<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">一级分销结算金额</label>
						<div class="col-xs-12 col-sm-8">
							<div class="input-group">
								<span class="input-group-addon">￥</span>
								<input type="text" name="taocan[fx_one]" class="form-control" value="<?php  echo $itemArr['fx_one'];?>" />
							</div>
							<span class="help-block">一级分销结算金额,不填按默认比例,最多保留两位小数</span>
						</div>
				</div>
				<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">二级分销结算金额</label>
						<div class="col-xs-12 col-sm-8">
							<div class="input-group">
								<span class="input-group-addon">￥</span>
								<input type="text" name="taocan[fx_two]" class="form-control" value="<?php  echo $itemArr['fx_two'];?>" />
							</div>
							<span class="help-block">二级分销结算金额,不填按默认比例,最多保留两位小数</span>
						</div>
				</div>
				<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">分销佣金结算时间</label>
						<div class="col-sm-9 col-xs-12">
							<label class="radio-inline">
								<input type="radio" value="0" name="taocan[js_time]" <?php  if($itemArr['js_time'] == '0') { ?> checked <?php  } ?>>订单完成时结算
							</label>
				<!-- 			<label class="radio-inline">
								<input type="radio" value="1" name="taocan[js_time]"  <?php  if($itemArr['js_time'] == '1') { ?> checked <?php  } ?>>订单支付时结算
							</label> -->
							<span class="help-block">注：若订单完成时结算，在订单退款时会扣除分销商对应的佣金，如果分销商可提现佣金不足，会扣至负数</span>
						</div>	
				</div>		
			</div>
		</div>
		<div id='tab_other' class="tab-pane">
			<div class="form-group">
				<label class="col-sm-2 control-label">模板选择<span class="must-fill">*</span></label>
				<div class="col-sm-9">
					<select name="taocan[tijian]" class="form-control" id="mobans">

						<option value="">请选择模板</option>
						<?php  if(is_array($moban)) { foreach($moban as $tijian) { ?>

						   <option value="<?php  echo $tijian['id'];?>" <?php  if($tijian['id'] == $itemArr['tijian']) { ?> selected="" <?php  } ?>><?php  echo $tijian['title'];?></option>

						<?php  } } ?>
					</select>
				</div>
			</div>
			<div id='moban' style="display:none;margin-left:177px;">
				<div class="title">设置模板</div>
				<?php  if(is_array($project)) { foreach($project as $pro) { ?>
				<div class="df conts">
					<div class="df">
						<div class="name1">项目名称</div>
						<input type="text" value="<?php  echo $pro['title'];?>" class="form-control">
					</div>
					<div class="df">
						<div class="name1">英文缩写</div>
						<input type="text" value="<?php  echo $pro['english'];?>" class="form-control">
					</div>
					<div class="df">
						<div class="name1">单位</div>
						<input type="text" value="<?php  echo $pro['unit'];?>" class="form-control">
					</div>
					<div class="df">
						<div class="name1">参考值</div>
						<input type="text" value="<?php  echo $pro['min'];?>~<?php  echo $pro['max'];?>" class="form-control">
					</div>
					<div class="df">
						<div class="name1">检查单价</div>
						<input type="text" class="form-control" value="<?php  echo $pro['price'];?>">
						<div class="name1">元/次</div>
					</div>
				</div>
				<?php  } } ?>
			</div>
		</div>
		<div id="tab_fenyuan" class="tab-pane">
		<div class="form-group">
				<label class="col-sm-2 control-label">分院选择<span class="must-fill">*</span></label>
				<div class="col-sm-9">
			<select  class="col-sm-9" id="example-filter-placeholder" multiple="multiple" name="hid[]">
                <?php  if(is_array($lit_host)) { foreach($lit_host as $item) { ?>
			    <option value="<?php  echo $item['hid'];?>" <?php  if(in_array($item['hid'],$hidArr)) { ?> selected="selected" <?php  } ?>><?php  echo $item['agentname'];?></option>
                <?php  } } ?>

			</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label"></label>
			<div class="col-sm-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary min-width">
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	     $(document).ready(function() {
        $('#example-filter-placeholder').multiselect({
            enableFiltering: true,
            numberDisplayed:0,
            nonSelectedText:'选择适用分院',
            filterPlaceholder:'搜索'
        });
    });
</script>


<script>
	function vipchange(flags)
	{
		if(flags == 1)
		{
			$("#vipchs").show();
		}else{
			$("#vipchs").hide();
		}
	}
	function distri(flag){
		if (flag == 1) {
			$('#distridiv').show();
		} else{
			$('#distridiv').hide();
		}
	}
	$("#category_parentjg").on("change",function(){
    
     var id = $(this).val()
     //查询二级
        $.post("/index.php?c=site&a=entry&do=team&op=ajax&type=jgall&m=hyb_yl&id="+id,{id:id},function (res) {
              console.log(res)
                $("select[name='taocan[jigou_two]']").empty();
                var html = "<option value='0'>请选择二级分类</option>";
                $(res).each(function (v, k) {

                    html += "<option value='" + k.hid + "'>" + k.agentname + "</option>";
                });
                //把遍历的数据放到select表里面
                $("select[name='taocan[jigou_two]']").append(html);

            },'json');
    });
    var moban = "<?php  echo $item['tijian'];?>";
    if(moban != '' || moban != 0)
    {
    	var id = moban;
    	$.post("/web/index.php?c=site&a=entry&do=physical&op=ajax&m=hyb_yl&id="+id,{id:id},function (res) {
            $("#moban").empty();
            var html = "<div class='title'>设置模板</div>";
            $(res).each(function (v, k) {
            	html += "<div class='df conts'>";
				html += "<div class='df'>";
				html += "<div class='name1'>项目名称</div>";
				html += "<input type='text' disabled='' value='" + k.title + "' class='form-control'>";
				html += "</div>";
				html += "<div class='df'>";
				html += "<div class='name1'>英文缩写</div>";
				html += "<input type='text' disabled='' value='" + k.english + "' class='form-control'>";
				html += "</div>";
				html += "<div class='df'>";
				html += "<div class='name1'>单位</div>";
				html += "<input type='text' disabled='' value='" + k.unit + "' class='form-control'>";
				html += "</div>";
				html += "<div class='df'>";
				html += "<div class='name1'>参考值</div>";
				html += "<input type='text' disabled='' value='" + k.min + "~"+ k.max +"' class='form-control'>";
				html += "</div>";
				html += "<div class='df'>";
				html += "<div class='name1'>检查单价</div>";
				html += "<input type='text' disabled='' class='form-control' value='" + k.price + "'>";
				html += "<div class='name1'>元/次</div>";
				html += "</div>";
				html += "</div>";
            });
            //把遍历的数据放到select表里面
            $("#moban").append(html);

        },'json');
    }
    $("#mobans").on('change',function(){
    	var id = $(this).val();
    	$.post("/index.php?c=site&a=entry&do=physical&op=ajax&m=hyb_yl&id="+id,{id:id},function (res) {
            $("#moban").empty();
            var html = "<div class='title'>设置模板</div>";
            $(res).each(function (v, k) {
            	html += "<div class='df conts'>";
				html += "<div class='df'>";
				html += "<div class='name1'>项目名称</div>";
				html += "<input type='text' disabled='' value='" + k.title + "' class='form-control'>";
				html += "</div>";
				html += "<div class='df'>";
				html += "<div class='name1'>英文缩写</div>";
				html += "<input type='text' disabled='' value='" + k.english + "' class='form-control'>";
				html += "</div>";
				html += "<div class='df'>";
				html += "<div class='name1'>单位</div>";
				html += "<input type='text' disabled='' value='" + k.unit + "' class='form-control'>";
				html += "</div>";
				html += "<div class='df'>";
				html += "<div class='name1'>参考值</div>";
				html += "<input type='text' disabled='' value='" + k.min + "~"+ k.max +"' class='form-control'>";
				html += "</div>";
				html += "<div class='df'>";
				html += "<div class='name1'>检查单价</div>";
				html += "<input type='text' disabled='' class='form-control' value='" + k.price + "'>";
				html += "<div class='name1'>元/次</div>";
				html += "</div>";
				html += "</div>";
            });
            //把遍历的数据放到select表里面
            $("#moban").append(html);

        },'json');
    })
</script>

</div>
<script>
	$(".upperShelf").on('click',function () {
	    var the = $(this);
		var isUpperShelf = the.children(".isUpperShelf");
		var status = isUpperShelf.data("status");//1=上架中要修改为下架。0=下架中要修改为上架
		var id = isUpperShelf.data("id");
        var url = biz.url('consumption/goods/isUpperShelf');
        //请求后台 进行上下架操作
		$.post(url,{status:status,id:id},function (res) {
		    var result = res.data['status'];
            isUpperShelf.data("status",result);
		    if(result == 1){
                the.html('<span class="label label-primary isUpperShelf" data-status="'+result+'" data-id="'+id+'">上架</span>');
			}else{
                the.html('<span class="label label-default isUpperShelf" data-status="'+result+'" data-id="'+id+'">下架</span>');
			}
        },'json');
    });
    
    function changetype(type){
    	if(type == 'goods'){
    		$('#credit').hide();
    		$('#redpacket').hide();
    		$('#expresstemplate').show();
    		$('#halfcard').hide();
    	}else if(type == 'credit2'){
    		$('#credit').show();
    		$('#redpacket').hide();
    		$('#expresstemplate').hide();
    		$('#halfcard').hide();
    	}else if(type == 'halfcard'){
    		$('#credit').hide();
    		$('#redpacket').hide();
    		$('#expresstemplate').hide();
    		$('#halfcard').show();
    	}
    	
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
		$(function () {
			window.optionchanged = false;
			$('#myTab a').click(function (e) {
				e.preventDefault();//阻止a链接的跳转行为
				$(this).tab('show');//显示当前选中的链接及关联的content
			});
			$('.form-control').on('change',function(){
				var vid=$(this).children('option:selected').val()
				if(vid!=''){
					$('#moban').show()
				}else{
					$('#moban').hide()
				}
			})
		});
	</script>
	</body>
</html>

