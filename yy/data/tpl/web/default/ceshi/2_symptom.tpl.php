<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active">
		<a href="<?php  echo $this->copysiteUrl('ceshi.symptom');?>&ac=symptom">症状列表</a>
	</li>
</ul>
<style>
	td>i{cursor:pointer; display:inline-block; width:100%; height:100%; color:#428bca;}
                            .category-caret{display:inline-block; width:20px; margin: 0 10px; text-align:center; cursor:pointer; color:#d9534f;}
                            .add.add_level0{cursor:pointer;}
                            .scrollLoading{border-radius: 50px;}
                            .areaNameStyle{display:block;width:100px;text-align:left;float:left;}
                            .lineheight30{line-height:30px}
                            .provinceAreaName{height:30px;line-height:30px;width:180px;}
                            .provinceAreaState{display: block;width: 30px;float: left;text-align: center;cursor: pointer;}
                            .cityAreaName{padding-left:50px;height:30px;line-height:30px;background:url('./resource/images/bg_repno.gif') no-repeat -245px -545px;width:150px;position: relative;margin-left:70px;}
                            .cityAreaState{position: absolute;left: -30px;width: 30px;text-align: center;cursor: pointer;}
                            .districtAreaName{padding-left:50px;height:30px;line-height:30px;background:url('./resource/images/bg_repno.gif') no-repeat -245px -545px;width:150px;margin-left: 120px;position: relative;}
                            .districtAreaState{position: absolute;left: -30px;width: 30px;text-align: center;cursor: pointer;}
                            .townAreaName{padding-left:50px;height:30px;line-height:30px;background:url('./resource/images/bg_repno.gif') no-repeat -245px -545px;margin-left: 170px;}
                            .glyphicon.glyphicon-chevron-up {color:#CCC;}
                            .glyphicon.glyphicon-chevron-down {color:#ff0000;;}
                    </style>
<div class="app-content">
	<div class="app-filter">
		<div class="filter-action" style="margin-bottom:-34px;">
			<a class="btn btn-primary" href="<?php  echo $this->copysiteUrl('ceshi.addSymptom');?>&ac=addSymptom">添加症状</a>
		</div>
		<div class="filter-action" style=" margin-left: 107px;">
			<a class="btn btn-primary" href="<?php  echo $this->copysiteUrl('ceshi.getSymptom');?>&ac=symptom">一键获取症状</a>
		</div>
		<!-- <div style=" margin-left: 107px;">
			<form action="" method="POST">
				<input class="btn btn-primary" type="submit" value="一键获取症状" name="submit">
			</form>
		</div> -->
	</div>
	<form>

		<div class="app-table-list">
			<div class="panel panel-default">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th style="width: 30px;">
		                            <input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
		                        </th>
								<th style="width:100px; text-align:center;">症状名称</th>
								<th style="width:50px; text-align:center;">字母</th>
								<th style="width:100px; text-align:center;">审核专家</th>
								<th style="width:100px; text-align:center;">是否开启</th>
								<th style="width:100px; text-align:center;">词条作者</th>
								<th style="width:100px; text-align:center;">操作</th>
							</tr>
						</thead>
						<tbody>
                          <?php  if(is_array($list)) { foreach($list as $item) { ?>
							<tr>
								<td>
		                            <center>
		                                <input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['id'];?>" />
		                            </center>
		                        </td>
								<td class="text-center">

									<?php  echo $item['title'];?>
								</td>
								<td class="text-center">
									<?php  echo $item['first'];?>
								</td>
								<td class="text-center"><?php  echo $item['zhuanjia'];?></td>
                                <td class="text-center">
                                    <input type="checkbox" class="js-switch" name="status[<?php  echo $item['id'];?>]" <?php  if($item['status'] == '1') { ?> checked="checked" <?php  } ?> >
                                </td>
								<td class="text-center">
									<?php  echo $item['u_name'];?>
								</td>
								<td class="text-center">
									<a class="btn btn-success btn-sm"  href="<?php  echo $this->copysiteUrl('ceshi.addSymptom');?>&ac=addSymptom&id=<?php  echo $item['id'];?>">编辑症状</a>
									<a class="btn btn-success btn-sm"  href="<?php  echo $this->copysiteUrl('ceshi.delsymptom');?>&ac=delsymptom&id=<?php  echo $item['id'];?>">删除症状</a>
								</td>
							</tr>
                          <?php  } } ?>
						</tbody>
					</table>
					<div class="app-table-foot clearfix">
			            <div class="pull-left">
			                <div class="pull-left" id="de1">
			                    <label class="btn btn-default min-width " style="display: inline-flex;align-items:center;margin-right:1rem;">
			                        <input type="checkbox" name="checkbox" value="" id="checkbox" onclick="var ck = this.checked; $(':checkbox').each(function(){this.checked = ck});"/>
			                        <div style="margin-left: 10px">全选</div>
			                    </label>
			                    <a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass_delete">批量删除</a>
			                </div>
			            </div>
			            <div class="pull-right"><?php  echo $pager;?></div>
			        </div>
				</div>
			</div>
			
		</div>
	</form>
	<script type="text/javascript">
    // 批量删除
    $('#de1').delegate('.pass_delete','click',function(e){
        e.stopPropagation();
        var order_ids = [];
        var $checks=$('.checkbox:checkbox:checked');

        $checks.each(function() {
            if (this.checked) {
                order_ids.push(this.value);
            };
        });
        var $this = $(this);
        var ids = order_ids;

        util.nailConfirm(this, function(state) {console.log(state)
        if(!state)  return;
            $.post("<?php  echo $this->copysiteUrl('ceshi.del_diseaselists');?>&ac=diseaselist", { ids : ids }, function(data){
                if(data.errno=='1'){ 
                    util.tips("操作成功！");
                    setTimeout(function(){ 
                        window.location.reload();
                    }, 1000);
                }else{
                    util.tips("操作失败");  
                };
            }, 'json');
        }, {html: '确认批量删除?'});
    });
</script>
</div>
</body>