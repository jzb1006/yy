<?php defined('IN_IA') or exit('Access Denied');?>        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
        <div class="app-container-right">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a href="#tab_basic">基本信息</a>
                </li>
                <li>
                    <a href="#tab_rush">价格信息</a>
                </li>
<!--                 <li>
                    <a href="#tab_option">规格设置</a>
                </li>
                <li>
                    <a href="#tab_detail">结算设置</a>
                </li>
                <li>
                    <a href="#tab_share">分享设置</a>
                </li>
                <li>
                    <a href="#tab_jifen">积分设置</a>
                </li> -->
            </ul>
            <div class="app-content">
                <div class="app-form">

        <form action="" method="post" class="form-horizontal form form-validate" onsubmit="return formcheck(this);">
            <div class="tab-content">
                <div class="tab-pane" id="tab_rush">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            价格信息
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否启用</label>
                                <div class="col-sm-9 col-xs-12">
                                    <label class="radio-inline"><input type="radio" value="1" name="goods[state]" <?php  if($item['state'] == '1') { ?> checked="" <?php  } ?>> 上架</label>
                                    <label class="radio-inline"><input type="radio" value="0" name="goods[state]" <?php  if($item['state'] == '0') { ?> checked="" <?php  } ?>> 禁用</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">所属机构<span class="must-fill">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="row row-fix tpl-category-container">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <select class="form-control tpl-category-parent we7-select" id="category_parentjg" name="goods[jigou_one]" >
                                                <option value="0">请选择一级分类</option>
                                                <option value="2" <?php  if($item['jigou_one'] =='2') { ?> selected="" <?php  } ?>>药房</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <select class="form-control tpl-category-child we7-select" id="category_childjg" name="goods[jigou_two]">
                                                 <option value='0'>请选择二级分类</option>
                                                 <?php  if(is_array($athuo_lists)) { foreach($athuo_lists as $itemss) { ?>
                                                <option value="<?php  echo $itemss['hid'];?>" <?php  if($item['jigou_two'] ==$itemss['hid']) { ?> selected="" <?php  } ?>><?php  echo $itemss['agentname'];?></option>
                                                <?php  } } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">开方服务费</label>
                                <div class="col-md-6">
                                    <input type="text" name="goods[kf_money]" required="" class="form-control" value="<?php  echo $item['kf_money'];?>">
                                </div>
                            </div>
                            <div class="form-group" style="display: block;">
                                <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">现价</label>
                                <div class="col-md-2" style="padding-right: 0;">
                                    <div class="input-group">
                                        <span class="input-group-addon">￥</span> <input type="text" name="goods[smoney]" id="goodsprice" class="form-control" value="<?php  echo $item['smoney'];?>">
                                    </div>
                                </div><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label" style="padding-left: 0;padding-right: 0;">零售价</label>
                                <div class="col-md-2" style="padding-right: 0;">
                                    <div class="input-group">
                                        <span class="input-group-addon">￥</span> <input type="text" name="goods[retail_price]" class="form-control" value="<?php  echo $item['retail_price'];?>">
                                    </div>
                                </div><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label" style="padding-left: 0;padding-right: 0;">批发价</label>
                                <div class="col-md-2" style="padding-right: 0;">
                                    <div class="input-group">
                                        <span class="input-group-addon">￥</span> <input type="text" name="goods[trade_price]" class="form-control" value="<?php  echo $item['trade_price'];?>">
                                    </div>
                                </div><br>
                                <br>
                                <div class="help-block col-md-10 col-lg-offset-2">
                                    无规格或同价格商品以此为准，不同规格不同价格商品的此项数据只做列表展示使用。
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">买家申请退款</label>
                                <div class="col-md-6">
                                    <label class="radio-inline"><input type="radio" name="goods[is_tui]" value="0" <?php  if($item['is_tui'] == '0') { ?> checked <?php  } ?>> 允许</label>
                                    <label class="radio-inline"><input type="radio" name="goods[is_tui]" value="1" <?php  if($item['is_tui'] == '1') { ?> checked <?php  } ?>> 禁止</label>
                                </div>
                            </div>
                            <div class="form-group" style="display: block;">
                                <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">会员减免</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">￥</span> <input type="text" name="goods[hy_money]" class="form-control" value="<?php  echo $item['hy_money'];?>">
                                    </div>
                                </div>
                                <div class="help-block col-md-10 col-lg-offset-2">
                                   会员的减免金额，不填或填0即为无会员减免。
                                </div>
                            </div>

                            <div class="form-group" >
                                <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">库存</label>
                                <div class="col-md-2" style="padding-right: 0;">
                                    <div class="input-group">
                                        <input type="number" name="goods[snum]" class="form-control" value="<?php  echo $item['snum'];?>"> <span class="input-group-addon">个</span>
                                    </div>
                                </div>
                                <!-- <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label" style="padding-left: 0;padding-right: 0;">虚拟销量</label>
                                <div class="col-md-2" style="padding-right: 0;">
                                    <div class="input-group">
                                        <input type="text" name="goods[xn_num]" class="form-control" value="<?php  echo $item['xn_num'];?>"> <span class="input-group-addon">个</span>
                                    </div>
                                </div><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label" style="padding-left: 0;padding-right: 0;">限购数量</label>
                                <div class="col-md-2" style="padding-right: 0;">
                                    <div class="input-group">
                                        <input type="text" name="goods[xg_num]" class="form-control" value="<?php  echo $item['xg_num'];?>"> <span class="input-group-addon">个</span>
                                    </div>
                                </div><br> -->
                                <br>
                                <div class="help-block col-md-10 col-lg-offset-2">
                                    <!-- 下单库存减少，取消订单会恢复；虚拟销量会在商品展示时使用；限购数量为0或不设置即为“不限购”; -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="modal-module-merchant" class="modal fade" tabindex="-1">
                        <div class="modal-dialog" style="width: 920px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <h3>
                                        选取
                                    </h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="keyword" value="" id="search-kwd-merchant" placeholder="请输入商家名称，不输入任何内容搜索结果为所有商家。"> <span class="input-group-btn"><button type="button" class="btn btn-default" onclick="search_merchant();"><span class="input-group-btn"><span class="input-group-btn"><span class="input-group-btn">搜索</span></span></span></button></span>
                                        </div>
                                    </div>
                                    <div id="module-merchant" style="padding-top:5px;"></div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane active" id="tab_basic">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            商品信息
                        </div>
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商品名称</label>
                                    <div class="col-md-6">
                                        <input type="text" name="goods[sname]" id="name" required="" class="form-control" value="<?php  echo $item['sname'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">批准文号</label>
                                    <div class="col-md-6">
                                        <input type="text" name="goods[doc_num]" id="doc_num" required="" class="form-control" value="<?php  echo $item['doc_num'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">品牌名称</label>
                                    <div class="col-md-6">
                                        <input type="text" name="goods[pp_title]" required="" id="pp_title" class="form-control" value="<?php  echo $item['pp_title'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">单位</label>
                                    <div class="col-md-6">
                                        <input type="text" name="goods[company]" required="" class="form-control" value="<?php  echo $item['company'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">排序</label>
                                    <div class="col-md-6">
                                        <input type="text" name="goods[sort]" class="form-control" value="<?php  echo $item['sort'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">首页图片</label>
                                    <div class="col-md-6">
                                        <?php  echo  tpl_form_field_image('goods[sthumb]', $item['sthumb'])?>
                                        <span class="help-block">图片请选用正方形。</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商品图集</label>
                                    <div class="col-sm-6">
                                        <?php  echo  tpl_form_field_multi_image('goods[spic]', $item['spic'])?>
                                        <span class="help-block">商品详情幻灯片，建议640X300</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否推荐后在首页展示</label>
                                    <div class="col-sm-9 col-xs-12">
                                        <label class="radio-inline"><input type="radio" value="0" name="goods[rec]" <?php  if($item['rec'] == '0') { ?> checked <?php  } ?>> 禁用</label> <label class="radio-inline"><input type="radio" value="1"  <?php  if($item['rec'] == '1') { ?> checked <?php  } ?> name="goods[rec]"> 开启</label>
                                    </div>
                                </div>
                                <!-- <div class="form-group" id="timelimit" style="display: none;">
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">购买时间</label>
                                    <div class="col-sm-5 col-lg-7 col-xs-12">
                                        <script type="text/javascript">
                                            require(["daterangepicker"], function(){
                                            $(function(){
                                            $(".daterange.daterange-time").each(function(){
                                            var elm = this;
                                            $(this).daterangepicker({
                                            startDate: $(elm).prev().prev().val(),
                                            endDate: $(elm).prev().val(),
                                            format: "YYYY-MM-DD HH:mm",
                                            timePicker: true,
                                            timePicker12Hour : false,
                                            timePickerIncrement: 1,
                                            minuteStep: 1
                                            }, function(start, end){
                                            $(elm).find(".date-title").html(start.toDateTimeStr() + " 至 " + end.toDateTimeStr());
                                            $(elm).prev().prev().val(start.toDateTimeStr());
                                            $(elm).prev().val(end.toDateTimeStr());
                                            });
                                            });
                                            });
                                            });
                                        </script> <input name="goods[start]" type="hidden" value="<?php  echo $item['start'];?>"> <input name="goods[end]" type="hidden" value="<?php  echo $item['end'];?>"> <button class="btn btn-default daterange daterange-time" type="button"><span class="date-title"><?php  echo $item['start'];?> 至 <?php  echo $item['end'];?></span></button>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">处方药类型</label>
                                    <div class="col-sm-9 col-xs-12">
                                        <label class="radio-inline"><input type="radio" value="0" name="goods[ifcfy]" <?php  if($item['ifcfy'] == '0') { ?> checked <?php  } ?>> 非处方药</label> <label class="radio-inline"><input type="radio" value="1" name="goods[ifcfy]" <?php  if($item['ifcfy'] == '1') { ?> checked <?php  } ?>> 处方药</label>
                                    </div>
                                </div>

                                <div id="cutoff">
<!--                                     <div class="form-group">
                                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否支持优惠券</label>
                                        <div class="col-md-6">
                                            <label class="radio-inline">
                                            <input type="radio" name="goods[yhqy]" value="1" <?php  if($item['yhqy'] == '1') { ?> checked="" <?php  } ?>> 启用</label>
                                            <label class="radio-inline"><input type="radio" name="goods[yhqy]" value="0" <?php  if($item['yhqy'] == '0') { ?> checked="" <?php  } ?>> 禁用</label>
                                        </div>
                                    </div> -->
                                       <div class="form-group">
                                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否包邮</label>
                                        <div class="col-md-6">
                                            <label class="radio-inline"><input type="radio" name="goods[g_baoyou]" value="1" <?php  if($item['g_baoyou'] == '1') { ?> checked="" <?php  } ?>> 包邮</label> <label class="radio-inline"><input type="radio" name="goods[g_baoyou]" value="0"  <?php  if($item['g_baoyou'] == '0') { ?> checked="" <?php  } ?>> 不包邮</label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="expresstemplate" >
                                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">运费模板</label>
                                        <div class="col-sm-4 col-xs-4">
                                            <select name="goods[yf_id]" class="form-control">
                                                <option value="">
                                                    请选择运费模板
                                                </option>
                                                <?php  if(is_array($yunfei)) { foreach($yunfei as $yf) { ?>
                                                <option value="<?php  echo $yf['id'];?>" <?php  if($item['yf_id'] == $yf['id']) { ?> selected="" <?php  } ?>>
                                                    <?php  echo $yf['title'];?>
                                                </option>
                                                <?php  } } ?>
                                            </select>
                                        </div>
                                        <div class="help-block col-md-10 col-lg-offset-2">
                                            不选择运费模板即为包邮。
                                        </div>
                                    </div>
<!--                                     <div class="form-group">
                                       <label class="col-sm-2 control-label">物流公司<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">

                                        <select name="com" class="form-control">
                                            <option value="">请选择物流公司</option>
                                            <?php  if(is_array($kuaidi)) { foreach($kuaidi as $shop) { ?>
                                                <option value="<?php  echo $shop['com'];?>" <?php  if($shop['com'] == $item['com']) { ?> selected="" <?php  } ?>><?php  echo $shop['name'];?></option>
                                            <?php  } } ?>
                                        </select>
                                    </div>
                                     </div> -->
                                    <div class="form-group">
									<label class="col-sm-2 control-label">供应商<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">
										<select name="goods[s_id]" class="form-control" required="">
											<option value="">请选择供应商</option>
                                            <?php  if(is_array($store)) { foreach($store as $shop) { ?>
                                                <option value="<?php  echo $shop['id'];?>" <?php  if($shop['id'] == $item['s_id']) { ?> selected="" <?php  } ?>><?php  echo $shop['title'];?></option>
                                            <?php  } } ?>
										</select>
									</div>
								</div>
                                </div>
                              <div class="form-group">
                                    <label class="col-sm-2 control-label">商品分类<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">

                                        <div class="row row-fix tpl-category-container">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <select class="form-control tpl-category-parent we7-select" name="goods[g_id]" required="">
                                                    <option value="0">请选择一级分类</option>
                                                    <?php  if(is_array($type)) { foreach($type as $typs) { ?>
                                                    <option value="<?php  echo $typs['fid'];?>" <?php  if($typs['fid'] == $item['g_id']) { ?> selected="" <?php  } ?>><?php  echo $typs['fenlname'];?></option>
                                                    <?php  } } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品详情</label>
                                    <div class="col-sm-9 col-xs-12">
                                    <textarea  name="goods[sdescribe]" cols="80" required="" rows="6"><?php  echo $item['sdescribe'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">成分</label>
                                    <div class="col-sm-9 col-xs-12">
                                    <textarea  name="goods[component]" cols="80" required="" rows="6"><?php  echo $item['component'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">性状</label>
                                    <div class="col-sm-9 col-xs-12">
                                    <textarea  name="goods[character]" cols="80" rows="6"><?php  echo $item['character'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">适应症</label>
                                    <div class="col-sm-9 col-xs-12">
                                    <textarea  name="goods[adapt]" cols="80" rows="6"><?php  echo $item['adapt'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">用法用量</label>
                                    <div class="col-sm-9 col-xs-12">
                                    <textarea  name="goods[use]" cols="80" rows="6"><?php  echo $item['use'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">不良反应</label>
                                    <div class="col-sm-9 col-xs-12">
                                    <textarea  name="goods[adverse_reactions]" cols="80" rows="6"><?php  echo $item['adverse_reactions'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">商品详细内容</label>
                                    <div class="col-sm-9">
                                        <?php  echo tpl_ueditor('goods[scontent]',$item['scontent']);?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_option">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            规格设置
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 col-md-2 control-label">规格开关</label>
                                <div class="col-sm-9 col-xs-12">
                                    <label class="radio-inline" onclick="$('#tboption').show();"><input type="radio" value="1" onclick="showtimelimit(1)" name="goods[gg_type]" <?php  if($item['gg_type'] == '1') { ?> checked="" <?php  } ?>> 开启</label> <label class="radio-inline" onclick="$('#tboption').hide();"><input type="radio" value="0" onclick="showtimelimit(0)" name="goods[gg_type]" <?php  if($item['gg_type'] == '0') { ?> checked="" <?php  } ?>> 禁用</label> <span class="help-block">开启规格后，商品价格与库存以规格项为准</span>
                                </div>
                            </div>
                            <div id="tboption"  <?php  if(count($guige) > 0 && $item['gg_type'] == '1') { ?> style="padding-left:15px;display:block" <?php  } else { ?>  style="display:none" <?php  } ?>>
                                <div class="alert alert-info">

                                    1. 拖动规格可调整规格显示顺序, 更改规格及规格项后请点击下方的【刷新规格项目表】来更新数据。<br>
                                    2. 每一种规格代表不同型号，例如颜色为一种规格，尺寸为一种规格，如果设置多规格，手机用户必须每一种规格都选择一个规格项，才能进行购买。<br>
                                    3. 设置多规格后，订单的价格，结算，分销金额全部按照核销设置处理。<br>
                                    <span style="color: orangered;">重要：请勿在商品销售中修改规格参数，刷新规格项目表。</span>
                                </div>
                                <div id="specs" class="ui-sortable">
									<div class="spec_item" id="">
	                                   <div style="border:1px solid #e7eaec;padding:10px;margin-bottom: 10px;">
                            		<input name="spec_id[]" type="hidden" class="form-control spec_id" value="">
                            		<div class="form-group">
                            		    <div class="col-sm-12">
                            				<div class="input-group">
                            					<input name="goods[guige]" type="text" class="form-control  spec_title" value="<?php  echo $item['guige'];?>" placeholder="规格名称 (比如: 颜色)">
                            					<div class="input-group-btn">
                            						<a href="javascript:;" class="btn btn-info add-specitem" onclick="addSpecItem(this)"><i class="fa fa-plus"></i> 添加规格项</a>
                            						<a href="javascript:void(0);" class="btn btn-danger" onclick="removeSpec(this)"><i class="fa fa-remove"></i></a>
                            					</div>
                            				</div>
                            			</div>
                            		</div>
                        		<div class="form-group">
                        			<div class="col-md-12">
                        	            <div class="spec_item_items"></div>
			</div>
		</div>
   </div>
</div>
</div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h4>
                                                    <!-- <a href="javascript:;" class="btn btn-primary" id="add-spec" onclick="addSpec()" style="margin-top:10px;margin-bottom:10px;" title="添加规格">添加规格</a> --> <a href="javascript:;" onclick="refreshOptions();" title="刷新规格项目表" class="btn btn-primary">刷新规格项目表</a>
                                                </h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                               <div id="options" style="padding:0;">

                               
                               <table class="table table-bordered table-condensed">
                               <thead>
                               <tr class="active">
                               <th><?php  echo $item['guige'];?></th>
                               <th>
                               <div class=""><div style="padding-bottom:10px;text-align:center;">库存</div>
                               </th>
                               <th><div class=""><div style="padding-bottom:10px;text-align:center;">现价</div></div>
                               </th>
                               <th>
                               <div class=""><div style="padding-bottom:10px;text-align:center;">零售价</div></div>
                               </th>
                               <th><div class=""><div style="padding-bottom:10px;text-align:center;">批发价</div></div>
                               </th>
                               <th>
                               <div class=""><div style="padding-bottom:10px;text-align:center;">会员结算价</div></div>
                               </th>
                               <th>
                               <div class=""><div style="padding-bottom:10px;text-align:center;">一级分销</div></div>
                               </th>
                               <th>
                               <div class=""><div style="padding-bottom:10px;text-align:center;">二级分销</div></div>
                               </th>
                               </tr>
                               </thead>
                               <tbody>
                               
                               <?php  if(is_array($guige)) { foreach($guige as $kk => $gg) { ?>
                               <tr>
                               <td class="full" rowspan="1"><?php  echo $gg['gg_name'];?></td>
                                <td>
                                <input type="hidden" name="guige[<?php  echo $kk;?>][gg_name]" class="form-control option_stock" value="<?php  echo $gg['gg_name'];?>">
                                <input type="text" name="guige[<?php  echo $kk;?>][gg_kucun]" class="form-control option_stock" value="<?php  echo $gg['gg_kucun'];?>">
                                </td>
                                <td>
                                <input type="text" name='guige[<?php  echo $kk;?>][gg_money]' class="form-control option_vipprice" value="<?php  echo $gg['gg_money'];?>">
                                </td>
                                <td>
                                <input type="text" name='guige[<?php  echo $kk;?>][gg_retail]' class="form-control option_vipprice" value="<?php  echo $gg['gg_retail'];?>">
                                </td>
                                <td>
                                <input type="text" name="guige[<?php  echo $kk;?>][gg_trade]" class="form-control option_settlementmoney" value="<?php  echo $gg['gg_trade'];?>">
                                </td>
                                <td>
                                <input name="guige[<?php  echo $kk;?>][vip_money]" type="text" class="form-control option_vipsettlementmoney" value="<?php  echo $gg['vip_money'];?>">
                                </td>
                                <td>
                                <input type="text" name="guige[<?php  echo $kk;?>][fx_one]" class="form-control option_onedismoney" value="<?php  echo $gg['fx_one'];?>">
                                </td>
                                <td>
                                <input type="text" name="guige[<?php  echo $kk;?>][fx_two]" class="form-control option_twodismoney" value="<?php  echo $gg['fx_two'];?>">
                                </td>
                                </tr>
                                <?php  } } ?>
                                
                                </tbody></table>
                                
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_detail">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            结算设置
                        </div>
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">独立结算规则</label>
                                    <div class="col-sm-9 col-xs-12">
                                        <label class="radio-inline" onclick="indepen(1)"><input type="radio" value="1" name="goods[is_dl]" <?php  if($item['is_dl'] == '1') { ?> checked="" <?php  } ?>>开启</label> <label class="radio-inline" onclick="indepen(2)"><input type="radio" value="0" name="goods[is_dl]" <?php  if($item['is_dl'] == '0') { ?> checked <?php  } ?>>关闭</label>
                                    </div>
                                </div>
                                <div class="form-group" id="indediv" <?php  if($item['is_dl'] == '0') { ?> style="display:none" <?php  } ?>>
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">结算金额</label>
                                    <div class="col-xs-12 col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">￥</span> <input type="text" name="goods[js_money]" class="form-control" value="<?php  echo $item['js_money'];?>">
                                        </div><span class="help-block">结算给药房的单价，最多保留两位小数</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否参与分销</label>
                                    <div class="col-sm-9 col-xs-12">
                                        <label onclick="distri(1)" class="radio-inline"><input type="radio" name="goods[is_fenxiao]" <?php  if($item['is_fenxiao'] == '1') { ?> checked="" <?php  } ?> value="1"> 参与</label> <label onclick="distri(2)" class="radio-inline"><input type="radio" name="goods[is_fenxiao]" value="0" <?php  if($item['is_fenxiao'] == '0') { ?> checked="" <?php  } ?>> 不参与</label>
                                    </div>
                                </div>
                                <div id="distridiv" class="form-group row" <?php  if($item['is_fenxiao'] == '0') { ?> style="display:none" <?php  } ?>>
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">一级分销结算金额</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">￥</span> <input type="text" name="goods[fx_one]" class="form-control" value="<?php  echo $item['fx_one'];?>">
                                            </div><span class="help-block">一级分销结算金额,不填按默认比例,最多保留两位小数</span>
                                        </div>
                                    </div>
                                    <div class="form-group" <?php  if($item['is_fenxiao'] == '0') { ?> style="display:none" <?php  } ?>>
                                        <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">二级分销结算金额</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">￥</span> <input type="text" name="goods[fx_two]" class="form-control" value="<?php  echo $item['fx_two'];?>">
                                            </div><span class="help-block">二级分销结算金额,不填按默认比例,最多保留两位小数</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销佣金结算时间</label>
                                    <div class="col-sm-9 col-xs-12">
                                        <label class="radio-inline"><input type="radio" value="0" name="goods[js_type]" <?php  if($item['js_type'] == '0') { ?> checked <?php  } ?>>订单完成时结算</label>
                                        <label class="radio-inline"><input type="radio" value="1" name="goods[js_type]" <?php  if($item['js_type'] == '1') { ?> checked <?php  } ?>>订单支付时结算</label> <span class="help-block">注：若订单支付时结算，在订单退款时会扣除分销商对应的佣金，如果分销商可提现佣金不足，会扣至负数</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_jifen">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            积分设置
                        </div>
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">购买获得积分</label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="number" name="goods[buy_score]" class="form-control" value="<?php  echo $item['buy_score'];?>"> <span class="input-group-addon">个</span>
                                        </div><span class="help-block">请输入正整数</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">积分抵扣比例</label>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">1个积分 抵扣</span> <input type="text" name="goods[one_dikou]" value="<?php  echo $item['one_dikou'];?>" class="form-control"> <span class="input-group-addon">元</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">积分抵扣</label>
                                    <div class="col-sm-5 col-xs-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">单件最多抵扣</span> <input type="text" name="goods[dikou]" value="<?php  echo $item['dikou'];?>" class="form-control"> <span class="input-group-addon">元</span>
                                        </div><!--<label class="checkbox-inline" for="manydeduct">
                                                        <input id="manydeduct" type="checkbox" value="1"  name="mark[manydeduct]"> 允许多件累计抵扣
                                                    </label>--><span class="help-block">如果设置0，则不支持积分抵扣</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_share">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            分享设置
                        </div>
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="alert alert-info">
                                    <b>适用模板变量：[昵称] [时间] [商品名称] [商家名称]  [单购价] [会员减免金额] </b>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享图片</label>
                                    <div class="col-xs-12 col-sm-8">
                                        <?php  echo tpl_form_field_image('goods[share_thumb]', $item['share_thumb'])?>
                                        <span class="help-block">图片建议为正方形，如果不选择，默认为商品缩略图片</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享标题</label>
                                    <div class="col-xs-12 col-sm-8">
                                        <input type="text" name="goods[share_title]" class="form-control" value="<?php  echo $item['share_title'];?>"> <span class="help-block">如果不填写，默认为商品名称</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享描述</label>
                                    <div class="col-xs-12 col-sm-8">
                                        <input type="text" name="goods[share_detail]" class="form-control" value="<?php  echo $item['share_detail'];?>"> <span class="help-block">如果不填写，默认为首页网址</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9">
                    <input type="hidden" id="optionArray" name="optionArray" value=""> <input type="submit" name="submit" value="提交" class="btn btn-primary min-width"> <input type="hidden" name="token" value="c5514e9f">
                </div>
            </div>
        </form>
                </div>
            </div>
        </div>
    </body>
</html>

            <script type="text/javascript">
                    $("#category_parentjg").on("change",function(){
    
                     var id = $(this).val()
                     //查询二级
                        $.post("/index.php?c=site&a=entry&do=team&op=ajax&type=jgall&m=hyb_yl&id="+id,{id:id},function (res) {
                              console.log(res)
                                $("select[name='goods[jigou_two]']").empty();
                                var html = "<option value='0'>请选择二级分类</option>";
                                $(res).each(function (v, k) {

                                    html += "<option value='" + k.hid + "'>" + k.agentname + "</option>";
                                });
                                //把遍历的数据放到select表里面
                                $("select[name='goods[jigou_two]']").append(html);

                            },'json');
                    });
                            $(function () {
                            window.optionchanged = false;
                            $('#myTab a').click(function (e) {
                                e.preventDefault();//阻止a链接的跳转行为
                                $(this).tab('show');//显示当前选中的链接及关联的content
                            });

                            require(['jquery.ui'],function(){
                                $("#specs").sortable({
                                    handle:'.fa-arrows',
                                    stop: function(){
                                        refreshOptions();
                                    }
                                });
                            });

                            });

                            function showcutoff(flag){
                            if(flag){
                                $('#cutoffday').show();
                                $('#cutofftime').hide();
                            }else{
                                $('#cutoffday').hide();
                                $('#cutofftime').show();
                            }
                            }

                            function indepen(flag){
                            if (flag == 1) {
                                $('#indediv').show();
                            } else{
                                $('#indediv').hide();
                            }
                            }

                            $('form').submit(function(){
                            optionArray();
                            });

                            function search_merchant() {
                            $("#module-merchant").html("正在搜索....")
                            $.get("https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=weliam_merchant&p=goodshouse&ac=goodshouse&do=selectMerchant&", {
                                keyword: $.trim($('#search-kwd-merchant').val())
                            }, function(dat){
                                $('#module-merchant').html(dat);
                            });
                            }
                            function remove_merchant(obj){
                            $('#goodsidmerchant').val('');
                            $('#namemerchant').val('');
                            $('#imgmerchant').attr("src",'');
                            }
                            function select_merchant(o) {
                            $('#sidmerchant').val(o.id);
                            $('#namemerchant').val(o.storename);
                            $('#imgmerchant').attr("src",o.logo);
                            $('#modal-module-merchant').modal('hide');
                            util.tips("操作成功");
                            }

                            $(function(){
                            $("#chkoption").click(function(){
                                var obj =$(this);
                                if(obj.get(0).checked){
                                    $("#tboption").show();
                                    $(".trp").hide();
                                }
                                else{
                                    $("#tboption").hide();
                                    $(".trp").show();
                                }
                            });
                            })
                            function distri(flag){
                            if (flag == 1) {
                                $('#distridiv').show();
                            } else{
                                $('#distridiv').hide();
                            }
                            }

                            function express(flag){
                            if(flag == 0){
                                $('#expresstemplate').hide();
                                $('#cutoff').show();
                            }else if(flag == 1){
                                $('#expresstemplate').show();
                                $('#cutoff').hide();
                            }else if(flag == 2){
                                $('#expresstemplate').show();
                                $('#cutoff').show();
                            }
                            }

                            function showtimelimit(flag){
                            if(flag){
                                $('#timelimit').show();
                            }else{
                                $('#timelimit').hide();
                            }
                            }

                            //规格
                            function addSpec(){
                            var len = $(".spec_item").length;
                            $("#add-spec").html("正在处理...").attr("disabled", "true").toggleClass("btn-primary");
                                $("#add-spec").html('<i class="fa fa-plus"><\/i> 添加规格').removeAttr("disabled").toggleClass("btn-primary"); ;
                                $('#specs').append(`<div class="spec_item" id="">
	                                   <div style="border:1px solid #e7eaec;padding:10px;margin-bottom: 10px;">
                            		<input name="spec_id[]" type="hidden" class="form-control spec_id" value="">
                            		<div class="form-group">
                            		    <div class="col-sm-12">
                            				<div class="input-group">
                            					<input name="goods[guige]" type="text" class="form-control  spec_title" value="<?php  echo $item['guige'];?>" placeholder="规格名称 (比如: 颜色)">
                            					<div class="input-group-btn">
                            						// <a href="javascript:;" class="btn btn-info add-specitem" onclick="addSpecItem(this)"><i class="fa fa-plus"></i> 添加规格项</a>

                            						<a href="javascript:void(0);" class="btn btn-danger" onclick="removeSpec(this)"><i class="fa fa-remove"></i></a>
                            					</div>
                            				</div>
                            			</div>
                            		</div>
                        		<div class="form-group">
                        			<div class="col-md-12">
                        				<div id="" class="spec_item_items">

</div>
			</div>
		</div>
   </div>
</div>`);
                                var len = $(".add-specitem").length -1;
                                $(".add-specitem:eq(" +len+ ")").focus();
                            var url = "https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=weliam_merchant&p=rush&ac=active&do=spec&";
                            // $.ajax({
                            //     "url": url,
                            //     success:function(data){
                            //         $("#add-spec").html('<i class="fa fa-plus"><\/i> 添加规格').removeAttr("disabled").toggleClass("btn-primary"); ;
                            //         $('#specs').append(data);
                            //         var len = $(".add-specitem").length -1;
                            //         $(".add-specitem:eq(" +len+ ")").focus();
                            //     }
                            // });
                            }

                            function refreshOptions(){
                            var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
                            var specs = [];
                            if($('.spec_item').length<=0){
                                 $("#options").html('');
                            }
                            $(".spec_item").each(function(i){
                                var _this = $(this);

                                var spec = {
                                    id: _this.find(".spec_id").val(),
                                    title: _this.find(".spec_title").val()
                                };

                                var items = [];
                                _this.find(".spec_item_item").each(function(){
                                    var __this = $(this);
                                    var item = {
                                        id: __this.find(".spec_item_id").val(),
                                        title: __this.find(".spec_item_title").val(),
                                        show:__this.find(".spec_item_show").get(0).checked?"1":"0"
                                    }
                                    items.push(item);
                                });
                                spec.items = items;
                                specs.push(spec);
                            });

                            var len = specs.length;
                            var newlen = 1;
                            var h = new Array(len);
                            var rowspans = new Array(len);
                            for(var i=0;i<len;i++){
                                html+="<th>" + specs[i].title + "<\/th>";
                                var itemlen = specs[i].items.length;
                                if(itemlen<=0) { itemlen = 1 };
                                newlen*=itemlen;

                                h[i] = new Array(newlen);
                                for(var j=0;j<newlen;j++){
                                    h[i][j] = new Array();
                                }
                                var l = specs[i].items.length;
                                rowspans[i] = 1;
                                for(j=i+1;j<len;j++){
                                    rowspans[i]*= specs[j].items.length;
                                }
                            }

                            html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">库存<\/div><\/div><\/th>';
                            html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">现价<\/div><\/div><\/th>';
                            html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">零售价<\/div><\/div><\/th>';
                            html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">批发价<\/div><\/div><\/th>';
                            html+='<th><div class=""><div style="padding-bottom:10px;text-align:center;">会员结算价<\/div><\/div><\/th>';
                            html+='<th><div class=""><div style="padding-bottom:10px;text-align:center;">一级分销<\/div><\/div><\/th>';
                            html+='<th><div class=""><div style="padding-bottom:10px;text-align:center;">二级分销<\/div><\/div><\/th>';

                            html+='<\/tr><\/thead>';

                            for(var m=0;m<len;m++){
                                var k = 0,kid = 0,n=0;
                                for(var j=0;j<newlen;j++){
                                    var rowspan = rowspans[m];
                                    if( j % rowspan==0){
                                        h[m][j]={title: specs[m].items[kid].title, virtual: specs[m].items[kid].virtual,html: "<td class='full' rowspan='" +rowspan + "'>"+ specs[m].items[kid].title+"<\/td>\r\n",id: specs[m].items[kid].id};
                                    }
                                    else{
                                        h[m][j]={title:specs[m].items[kid].title,virtual: specs[m].items[kid].virtual, html: "",id: specs[m].items[kid].id};
                                    }
                                    n++;
                                    if(n==rowspan){
                                    kid++; if(kid>specs[m].items.length-1) { kid=0; }
                                    n=0;
                                    }
                                }
                            }

                            var hh = "";
                            for(var i=0;i<newlen;i++){
                                hh+="<tr>";
                                var ids = [];
                                var titles = [];
                                var virtuals = [];
                                for(var j=0;j<len;j++){
                                    hh+=h[j][i].html;
                                    ids.push( h[j][i].id);
                                    titles.push( h[j][i].title);
                                    virtuals.push( h[j][i].virtual);
                                }
                                ids =ids.join('_');
                                titles= titles.join('+');

                                var val ={ id : "",title:titles, stock : "",price : "",settlementmoney : "",vipprice : "",threedismoney:"",twodismoney:"",onedismoney:"",virtual:virtuals };
                                if( $(".option_id_" + ids).length>0){
                                    val ={
                                        id : $(".option_id_" + ids+":eq(0)").val(),
                                        title: titles,
                                        stock : $(".option_stock_" + ids+":eq(0)").val(),
                                        price : $(".option_price_" + ids+":eq(0)").val(),
                                        settlementmoney : $(".option_settlementmoney_" + ids+":eq(0)").val(),
                                        vipprice : $(".option_vipprice_" + ids +":eq(0)").val(),
                                        onedismoney : $(".option_onedismoney_" + ids +":eq(0)").val(),
                                        twodismoney : $(".option_twodismoney_" + ids +":eq(0)").val(),
                                        threedismoney : $(".option_threedismoney_" + ids+":eq(0)").val(),
                                                          virtual : virtuals
                                    }
                                }

                                hh += '<td>'
                                hh += '<input type="hidden" name="guige['+i+'][gg_name]" class="form-control option_stock" value="' +(val.title=='undefined'?'':val.title )+'"/>';
                                hh += '<input type="text" name="guige['+i+'][gg_kucun]" class="form-control option_id" value="' +(val.id=='undefined'?'':val.id )+'"/>';
                                hh += '<input type="hidden" class="form-control option_ids" value="' + ids +'"/>';
                                hh += '<\/td>';
                                hh += '<td><input type="text" name="guige['+i+'][gg_money]" class="form-control option_settlementmoney" " value="' +(val.settlementmoney=='undefined'?'':val.settlementmoney )+'"/><\/td>';
                                hh += '<td>';
                                hh += '<input type="text" name="guige['+i+'][gg_retail]" class="form-control option_title" value="' +(val.price=='undefined'?'':val.price )+'"/><\/td>';
                                hh += '<\/td>';
                                hh += '<td><input type="text" name="guige['+i+'][gg_trade]" class="form-control option_price" value="' +(val.price=='undefined'?'':val.price )+'"/><\/td>';
                                hh += '<td><input type="text" name="guige['+i+'][vip_money]" class="form-control option_vipprice" value="' +(val.vipprice=='undefined'?'':val.vipprice )+'"/><\/td>';
                                
                                hh += '<td><input type="text" name="guige['+i+'][fx_one]" class="form-control option_onedismoney" value="' +(val.onedismoney=='undefined'?'':val.onedismoney )+'"/><\/td>';
                                hh += '<td><input type="text" name=guige['+i+'][fx_two] class="form-control option_twodismoney" value="' +(val.twodismoney=='undefined'?'':val.twodismoney )+'"/><\/td>';
                                hh += "<\/tr>";
                            }
                            html+=hh;
                            html+="<\/table>";
                            $("#options").html(html);
                            }

                            function removeSpec(specid){
                            if (confirm('确认要删除此规格?')){
                                $(specid).parents('.spec_item').remove();
                            }
                            }

                            function addSpecItem(specid){
                            $( specid).html("正在处理...").attr("disabled", "true");
                            console.log(222)
                                $(specid).html('<i class="fa fa-plus"><\/i> 添加规格项').removeAttr("disabled");
                                $(specid).parents('.spec_item').find('.spec_item_items').append(`<div class="spec_item_item" style="float:left;margin:5px;width:250px; position: relative">
                        	               <input type="hidden" class="form-control spec_item_show" name="" value="1">
                        	               <input type="hidden" class="form-control spec_item_id" name="" value="YB2YbkKi0J624i4K4n4q46wK9ZytKRMN">

                                        	<div class="input-group">
                                        		<span class="input-group-addon">
                                        			<input style="display:inline-block" type="checkbox" checked="" value="1" onclick="showItem(this)">
                                        		</span>
                                        		<input type="text" class="form-control spec_item_title valid" name="" value="" aria-invalid="false">

                                        		<span class="input-group-addon spec_item_thumb " style="padding: 0;">
                                        			<input type="hidden" name="" value="">
                                        				<img onclick="selectSpecItemImage(this)" onerror="this.src='http://www.webstrongtech.com/addons/weliam_merchant/web/resource/images/nopic-small.jpg'" style="width:32px;height:32px;" src="http://www.webstrongtech.com/addons/weliam_merchant/web/resource/images/nopic-small.jpg">
                                        				<i class="fa fa-times-circle" style="display:none"></i>
                                        		</span>
                                        		<span class="input-group-addon">
                                        			<a href="javascript:;" onclick="removeSpecItem(this)" title="删除"><i class="fa fa-times"></i></a>

                                        		</span>
                                        	</div>
                                        </div>`);
                                var len = $(specid).parents('.spec_item').find('.spec_item_title').length -1;
                                $(specid).parents('.spec_item').find('.spec_item_title').eq(len).focus();
                            var url = "https://www.webstrongtech.com/web/index.php?c=site&a=entry&m=weliam_merchant&p=rush&ac=active&do=spec_item&" + "&specid=" + specid;
                            console.log(111)
                            // $.ajax({
                            //     "url": url,
                            //     success:function(data){
                            //         console.log(data)
                            //         $("#add-specitem-" + specid).html('<i class="fa fa-plus"><\/i> 添加规格项').removeAttr("disabled");
                            //         $('#spec_item_' + specid).append(data);
                            //         var len = $("#spec_" + specid + " .spec_item_title").length -1;
                            //         $("#spec_" + specid + " .spec_item_title:eq(" +len+ ")").focus();
                            //     }
                            //
                            // });
                            }

                            function removeSpecItem(obj){
                            $(obj).closest('.spec_item_item').remove();
                            }

                            function selectSpecItemImage(obj){
                            util.image('',function(val){
                                $(obj).attr('src',val.url).popover({
                                    trigger: 'hover',
                                    html: true,
                                    container: $(document.body),
                                    content: "<img src='" + val.url  + "' style='width:100px;height:100px;' />",
                                    placement: 'top'
                                });

                                var group  =$(obj).parent();

                                group.find(':hidden').val(val.attachment), group.find('i').show().unbind('click').click(function(){
                                    $(obj).attr('src',"https://www.webstrongtech.com/addons/weliam_merchant/web/resource/images/nopic-small.jpg");
                                    group.find(':hidden').val('');
                                    group.find('i').hide();
                                    $(obj).popover('destroy');
                                });
                            });
                            }

                            function setCol(cls){
                            $("."+cls).val( $("."+cls+"_all").val());
                            }

                            function optionArray(){
                            var option_stock = new Array();
                            $('.option_stock').each(function (index,item) {
                                option_stock.push($(item).val());
                            });

                            var option_id = new Array();
                            $('.option_id').each(function (index,item) {
                                option_id.push($(item).val());
                            });

                            var option_ids = new Array();
                            $('.option_ids').each(function (index,item) {
                                option_ids.push($(item).val());
                            });

                            var option_title = new Array();
                            $('.option_title').each(function (index,item) {
                                option_title.push($(item).val());
                            });


                            var option_price = new Array();
                            $('.option_price').each(function (index,item) {
                                option_price.push($(item).val());
                            });
                            var option_vipprice = new Array();
                            $('.option_vipprice').each(function (index,item) {
                                option_vipprice.push($(item).val());
                            });

                            var option_settlementmoney = new Array();
                            $('.option_settlementmoney').each(function (index,item) {
                                option_settlementmoney.push($(item).val());
                            });


                            var option_onedismoney = new Array();
                            $('.option_onedismoney').each(function (index,item) {
                                option_onedismoney.push($(item).val());
                            });

                            var option_twodismoney = new Array();
                            $('.option_twodismoney').each(function (index,item) {
                                option_twodismoney.push($(item).val());
                            });

                            var option_threedismoney = new Array();
                            $('.option_threedismoney').each(function (index,item) {
                                option_threedismoney.push($(item).val());
                            });

                            var options = {
                                    option_stock : option_stock,
                                    option_id : option_id,
                                    option_ids : option_ids,
                                    option_title : option_title,
                                    option_price : option_price,
                                    option_vipprice : option_vipprice,
                                    option_settlementmoney : option_settlementmoney,
                                    option_onedismoney : option_onedismoney,
                                    option_twodismoney : option_twodismoney,
                                    option_threedismoney : option_threedismoney,
                            };
                            $("input[name='optionArray']").val(JSON.stringify(options));
                            }

                            function showItem(obj){
                            var show = $(obj).get(0).checked?"1":"0";
                            $(obj).parents('.spec_item_item').find('.spec_item_show:eq(0)').val(show);
                            }

            </script>
            <script type="text/javascript">
                $(document).on('click', '.data-item-delete', function () {
                            $(this).closest('.data-item').remove();
                            });
                            $('body').on('click','.addshux',function(){
                            var valueinput = $(this).parent().find('input');
                            var value = valueinput.val();
                            if(value == ''){
                            util.tips('请在编辑框输入内容');return false;
                            }
                            var valueelemt = $(this).parents('.data-item').find('.rule_pro');
                            valueelemt.append(value+',');
                            var nowvalue = valueelemt.next().val();
                            valueelemt.next().val(nowvalue+value+',');
                            valueinput.val('').focus();
                            });
                            $('body').on('click','.chongzhi',function(){
                            $(this).parents('.data-item').find('.rule_pro').text('').next().val('');
                            });
            </script>
            <div class="foot" id="footer">
                <ul class="links ft">
                    <li class="links_item">
                        <div class="copyright">
                            Powered by <a href="http://www.we7.cc"><b>系统</b></a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a>
                        </div>
                    </li>
                </ul>
            </div>
    <script type="text/javascript">
            function showImageDialog(elm, opts, options) {
                require(["util"], function(util){
                var btn = $(elm);
                var ipt = btn.parent().prev();
                var val = ipt.val();
                var img = ipt.parent().next().children();
                options = {'global':false,'class_extra':'','direct':true,'multiple':false,'fileSizeLimit':5120000};
                util.image(val, function(url){
                if(url.url){
                if(img.length > 0){
                img.get(0).src = url.url;
                }
                ipt.val(url.attachment);
                ipt.attr("filename",url.filename);
                ipt.attr("url",url.url);
                }
                if(url.media_id){
                if(img.length > 0){
                img.get(0).src = url.url;
                }
                ipt.val(url.media_id);
                }
                }, options);
                });
                }
                function deleteImage(elm){
                $(elm).prev().attr("src", "./resource/images/nopic.jpg");
                $(elm).parent().prev().find("input").val("");
                }
    </script>