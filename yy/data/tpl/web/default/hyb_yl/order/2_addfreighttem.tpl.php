<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<style>
	.express_main{border: 1px solid #f3f4f9;}
	.express_body_top{background:#f4f5f9;padding:10px;}
	.express_btn_out,.area_item{line-height: 34px;}
	.area_item{padding-left: 130px;}
	.express_btn_money{padding: 0 10px;}
	.express_main_item{padding: 10px;border-bottom: 1px solid #f7f7f7;}
	.express_main_item:last-child{border-bottom:0px;}
	.express_modal .province{padding: 5px 10px;border: 1px solid #eee;color: #666666;white-space: nowrap;overflow: hidden;cursor: pointer;margin-bottom: 0;font-weight: normal;border-radius: 2px;}
	.express_modal .province input{display:none;}
	.modal-body{overflow:hidden;}
	.express_modal .province_btn{margin-bottom: 9px;}
	.area_selected{background: #44b549;color: #fff!important;border: 1px solid #44b549!important;}
	.item_cell_box{display: flex;}
	.item_cell_flex{-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;}
</style>
<ul class="nav nav-tabs">
	<li ><a href="/index.php?c=site&a=entry&do=order&op=freightlist&ac=freightlist&m=hyb_yl">模板列表</a></li>
	<li class="active"><a href="/index.php?c=site&a=entry&do=order&op=addfreighttem&ac=addfreighttem&m=hyb_yl">添加模板</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form method="post" action="" class="form-horizontal form form-validate">
		<input type="hidden" name="add_main" id="add_main" value="0">
			<div class="form-group-title">运费模板</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">运费名称</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>">
					<p class="help-block"> 填入文字，便于辨识</p>
				</div>
			</div>
					
						<div class="form-group">
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-9 express_body">
					<div class="express_body_top">
						设置运费
					</div>
					<div class="express_main">
						<div class="express_main_item">
							<div class="item_cell_box">
								<li class="item_cell_flex express_btn_out">默认</li>
								<li class="express_btn_money input-group col-sm-10">
									<span class="input-group-addon">下单量</span>
									<input type="text" class="form-control" name="first" value="<?php  echo $item['details'][0]['first'];?>">
									<span class="input-group-addon">件内，邮费</span>
									<input type="text" class="form-control" name="first_price" value="<?php  echo $item['details'][0]['first_price'];?>">
									<span class="input-group-addon">元，每增加</span>
									<input type="text" class="form-control" name="continue" value="<?php  echo $item['details'][0]['continue'];?>">
									<span class="input-group-addon">件，加邮费</span>
									<input type="text" class="form-control" name="continue_price" value="<?php  echo $item['details'][0]['continue_price'];?>">
									<span class="input-group-addon">元</span>
								</li>
							</div>
						</div>
						</div>
					<p class="help-block">提示：当下单地址不在相应区域内时，会使用默认区域费用。</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-9">
					<input class="btn btn-success btn-sm min-width" value="增加一个区域" type="button" id="addonearea">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-9">
				    <textarea hidden id="details"><?php  echo $item['detailslist'];?></textarea>
					<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
	;
	<div class="modal fade express_modal " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">选择地区</h4>
				</div>
				<div class="modal-body">
										<div class="col-sm-3 province_btn"><label class="province">北京市 <input type="checkbox" value="北京市"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">天津市 <input type="checkbox" value="天津市"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">河北省 <input type="checkbox" value="河北省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">山西省 <input type="checkbox" value="山西省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">内蒙古自治区 <input type="checkbox" value="内蒙古自治区"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">辽宁省 <input type="checkbox" value="辽宁省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">吉林省 <input type="checkbox" value="吉林省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">黑龙江省 <input type="checkbox" value="黑龙江省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">上海市 <input type="checkbox" value="上海市"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">江苏省 <input type="checkbox" value="江苏省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">浙江省 <input type="checkbox" value="浙江省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">安徽省 <input type="checkbox" value="安徽省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">福建省 <input type="checkbox" value="福建省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">江西省 <input type="checkbox" value="江西省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">山东省 <input type="checkbox" value="山东省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">河南省 <input type="checkbox" value="河南省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">湖北省 <input type="checkbox" value="湖北省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">湖南省 <input type="checkbox" value="湖南省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">广东省 <input type="checkbox" value="广东省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">广西壮族自治区 <input type="checkbox" value="广西壮族自治区"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">海南省 <input type="checkbox" value="海南省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">重庆省 <input type="checkbox" value="重庆省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">四川省 <input type="checkbox" value="四川省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">贵州省 <input type="checkbox" value="贵州省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">云南省 <input type="checkbox" value="云南省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">西藏自治区 <input type="checkbox" value="西藏自治区"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">陕西省 <input type="checkbox" value="陕西省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">甘肃省 <input type="checkbox" value="甘肃省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">青海省 <input type="checkbox" value="青海省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">宁夏回族自治区 <input type="checkbox" value="宁夏回族自治区"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">新疆维吾尔自治区 <input type="checkbox" value="新疆维吾尔自治区"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">台湾省 <input type="checkbox" value="台湾省"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">香港特别行政区 <input type="checkbox" value="香港特别行政区"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">澳门特别行政区 <input type="checkbox" value="澳门特别行政区"></label></div>
										<div class="col-sm-3 province_btn"><label class="province">海外 <input type="checkbox" value="海外"></label></div>
									</div>
				<div class="modal-footer">
					<button type="button"data-dismiss="modal" aria-label="Close" class="btn btn-primary area_confirm">确定</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	/*运费模板*/
	var province = ['北京市','天津市','河北省','山西省','内蒙古省','辽宁省','吉林省','黑龙江省','上海市','江苏省','浙江省','安徽省','福建省','江西省','山东省','河南省','湖北省','湖南省','广东省','广西省','海南省','重庆市','四川省','贵州省','云南省','西藏自治区','陕西省','甘肃省','青海省','宁夏回族自治区','新疆维吾尔自治区','台湾省','香港特别行政区','澳门特别行政区','海外'];
	var details = $("#details").text();
	if(details != '')
	{
		var detailss = JSON.parse(details);
	
		var addstr = "";
		for(var i=1;i<detailss.length;i++)
		{
			
			addstr += '<div class="express_main_item">';
			addstr += '<div class="item_cell_box">';
			addstr += '<li class="item_cell_flex express_btn_out">';
			addstr += '<a href="javascript:;" class="a_href edit_province" data-toggle="modal" data-target="#myModal">编辑地区 </a>';
			addstr += '<input type="hidden" name="express[area][]" class="col-sm-2 area_value_input"  value="'+detailss[i].address+'" />';
			addstr += ' - <a href="javascript:;" class="a_href delete_express">删除</a>';
			addstr += '</li>';
			addstr += '<li class="express_btn_money input-group col-sm-10">';
			addstr += '<span class="input-group-addon"> 下单量 </span>';
			addstr += '<input type="text" class="form-control" name="express[num][]" value="'+ detailss[i].first +'">';
			addstr += '<span class="input-group-addon"> 件内，邮费 </span>';
			addstr += '<input type="text" class="form-control" name="express[money][]" value="'+ detailss[i].first_price +'">';
			addstr += '<span class="input-group-addon"> 元，每增加 </span>';
			addstr += '<input type="text" class="form-control" name="express[numex][]" value="'+ detailss[i].continue +'">';
			addstr += '<span class="input-group-addon"> 件，加邮费 </span>';
			addstr += '<input type="text" class="form-control" name="express[moneyex][]" value="'+ detailss[i].continue_price +'">';
			addstr += '<span class="input-group-addon"> 元 </span>';
			addstr += '</li>';
			addstr += '</div>';
			addstr += '<div class="area_item">';
			addstr += '<span class="help-block">'+ detailss[i].address +'</span>';
			addstr += '</div>';
			addstr += '</div>';

		}
		$('.express_main').append(addstr);
	}
	
	//添加一个地区
	$('#addonearea').click(function(){ 
		var addstr = 
			'<div class="express_main_item">'
				+'<div class="item_cell_box">'
					+'<li class="item_cell_flex express_btn_out">'
						+'<a href="javascript:;" class="a_href edit_province" data-toggle="modal" data-target="#myModal">编辑地区 </a>'
						+'<input type="hidden" name="express[area][]" class="col-sm-2 area_value_input"  value="" />'
						+' - <a href="javascript:;" class="a_href delete_express">删除</a>'
					+'</li>'
					+'<li class="express_btn_money input-group col-sm-10">'
						+'<span class="input-group-addon"> 下单量 </span>'
						+'<input type="text" class="form-control" name="express[num][]" value="">'
						+'<span class="input-group-addon"> 件内，邮费 </span>'
						+'<input type="text" class="form-control" name="express[money][]" value="">'
						+'<span class="input-group-addon"> 元，每增加 </span>'
						+'<input type="text" class="form-control" name="express[numex][]" value="">'
						+'<span class="input-group-addon"> 件，加邮费 </span>'
						+'<input type="text" class="form-control" name="express[moneyex][]" value="">'
						+'<span class="input-group-addon"> 元 </span>'
					+'</li>'
				+'</div>'
				+'<div class="area_item">'
					+'<span class="help-block"></span>'
				+'</div>'
			+'</div>';
		$('.express_main').append(addstr);
		$('#add_main').val(1);
	});
	
	//删除地区选择项
	$('body').on('click','.delete_express',function(){
		$('#add_main').val(0);
		$(this).parents('.express_main_item').remove();
	})

	//编辑地区
	$('body').on('click','.edit_province',function(){
		thisclass = $(this);
		thisinput = thisclass.next();
		var areaArrayed = [];
		var selected = '';
		$('.area_value_input').not(thisinput).each(function(){
			selected += $(this).val();
		});
		selected = selected.replace(/,$/,'');
		selectedArray=selected.split(","); //其余的值,数组
	
		selfvalue = thisinput.val();
		selfvalue = selfvalue.replace(/,$/,'');
		selfArray=selfvalue.split(","); //自己的值，数组
		
		$('.express_modal .province').each(function(){
			$(this).removeClass('area_selected');
			if($.inArray($(this).find('input').val(),selectedArray) >= 0){
			
				$(this).parent().hide();
			}
			if($.inArray($(this).find('input').val(),selfArray) >= 0){
				$(this).addClass('area_selected').find('input').attr('checked',true);
				$(this).parent().show();
			}			
		});
	});

	$('body').on('click','.express_modal .province',function(){
		var ischecked = $(this).find('input').is(':checked');
		if(ischecked){
			$(this).addClass('area_selected');
		}else{
			$(this).removeClass('area_selected');
		}
		
	});	
	$('.area_confirm').click(function(){
		var str = '';
		$('.express_modal .area_selected input:checked').each(function(){
			str += $(this).val() + ',';
		});
		thisclass.next().val(str);
		thisclass.parents('.express_main_item').find('.area_item span').text(str);
		//$('#myModal').modal('hide');
	});
	
	//提交
	$('input[name=addexpress').click(function(){
		var expressname = $('input[name=expressname]').val();
		if(expressname == ''){
			alert('请填写模板名称');return false;
		}
		var isempty = 0;
		$('.express_main_item input').each(function(){
			if($(this).val() == ''){
				isempty = 1;return;
			}
		});
		if(isempty == 1){
			alert('区域运费不能存在空项');return false;
		}
	});
</script>
			</div>
		</div>
	</div>
	<div class="foot" id="footer">
		<ul class="links ft">
            <li class="links_item"><div class="copyright">Powered by <a href="http://www.we7.cc"><b>系统</b></a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a></div></li>
		</ul>
	</div>
	</body>
</html>
