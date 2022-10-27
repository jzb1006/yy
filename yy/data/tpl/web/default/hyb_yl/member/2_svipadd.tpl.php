<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<div class="app-content">
	<ul class="nav nav-tabs" id="myTab">
		<li class="active"><a href="#">增加类别</a></li>
	</ul>
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form" id="form">
			<div class="panel panel-default">
				<div class="panel-heading">会员类别</div>
				<div class="panel-body">
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">排序</label>
							<div class="col-md-9">
								
									<input type="number" min="0" name="sort" class="form-control" value="<?php  echo $item['sort'];?>" />
					
								<span class="help-block">数字越大越靠前</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">类别名称</label>
							<div class="col-sm-9">
								<input type="text" name="title" id="title" class="form-control" value="<?php  echo $item['title'];?>" />
							</div>
						</div>
                        <!-- <div class="form-group">
                            <label class="col-sm-2 control-label">详细信息</label>
                            <div class="col-sm-9">
                                <textarea name="content" placeholder="请输入该卡的详细信息..." class="form-control" role="1" style="resize:none;" rows="5"><?php  echo $item['content'];?></textarea>
                            </div>
                        </div> -->
						<div class="form-group">
							<label class="col-sm-2 control-label">时长</label>
							<div class="col-md-9">
								<div class="input-group">
									<input type="text" name="times" class="form-control" value="<?php  echo $item['times'];?>" />
									<span class="input-group-addon">天</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" >价格</label>
							<div class="col-md-9">
								<div class="input-group">
									<span class="input-group-addon">￥</span>
									<input type="text" name="price" class="form-control" value="<?php  echo $item['price'];?>" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" >原价格</label>
							<div class="col-md-9">
								<div class="input-group">
									<span class="input-group-addon">￥</span>
									<input type="text" name="oldprice" class="form-control" value="<?php  echo $item['oldprice'];?>" />
								</div>
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-2 control-label">匹配权益</label>
							<div class="col-md-9">
								<select name="quanyi" class="form-control">
									<option value="">请选择权益</option>
									<?php  if(is_array($quanyi)) { foreach($quanyi as $qy) { ?>
									<option value="<?php  echo $qy['id'];?>" <?php  if($item['quanyi'] == $qy['id']) { ?> selected="" <?php  } ?>><?php  echo $qy['title'];?></option>
									<?php  } } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" >可开通次数</label>
							<div class="col-md-9">
								<div class="input-group">
									<input type="text" name="num" class="form-control" value="<?php  echo $item['num'];?>" />
									<span class="input-group-addon">次</span>
								</div>
								<span class="help-block">不填或则填0表示不限制</span>
							</div>
						</div>
						
											<div class="form-group">
						<label class="col-sm-2 control-label">是否可用于续费</label>
						<div class="col-xs-12 col-sm-8">
							<label class="radio radio-success radio-inline">
								<input type="radio" name="is_xf" value="1" <?php  if($item['is_xf'] == '1') { ?> checked="checked" <?php  } ?>>是
							</label>
							<label class="radio radio-success radio-inline">
								<input type="radio" name="is_xf" value="0" <?php  if($item['is_xf'] == '0') { ?> checked="checked" <?php  } ?>>否
							</label>
							<label class="radio radio-success radio-inline">
								<input type="radio" name="is_xf" value="2" <?php  if($item['is_xf'] == '2') { ?> checked="checked" <?php  } ?>>只能用于续费
							</label>
							<span class="help-block">已开通的会员是否可以使用此类型进行续费延期</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否推荐</label>
						<div class="col-xs-12 col-sm-8">
							<div class="radio radio-success radio-inline">
								<input type="radio" id="inlineRadio1" name="is_tuijian" value="1" <?php  if($item['is_tuijian'] == '1') { ?> checked="" <?php  } ?>>
								<label for="inlineRadio1"> 是 </label>
							</div>
							<div class="radio radio-success radio-inline">
								<input type="radio" id="inlineRadio2" name="is_tuijian" value="0"  <?php  if($item['is_tuijian'] == '0') { ?> checked="" <?php  } ?>>
								<label for="inlineRadio2"> 否 </label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否启用</label>
						<div class="col-xs-12 col-sm-8">
							<div class="radio radio-success radio-inline">
								<input type="radio" id="inlineRadio3" name="status" value="1" <?php  if($item['status'] == '1') { ?> checked="" <?php  } ?>>
								<label for="inlineRadio3"> 是 </label>
							</div>
							<div class="radio radio-success radio-inline">
								<input type="radio" id="inlineRadio4" name="status" value="0" <?php  if($item['status'] == '0') { ?> checked="" <?php  } ?>>
								<label for="inlineRadio4"> 否 </label>
							</div>
						</div>
					</div>
									</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label"></label>
			<div class="col-sm-9">
				<input type="hidden" name="postType" value="" />
				<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
				<input type="hidden" name="token" value="da1c10f4" />
				<input type="button" name="back" onclick="history.back()" style="margin-left:10px;" value="返回列表" class="btn btn-default min-width">
			</div>
		</div>
		</from>
	</div>
</div>
<script>
	function distri(flag){
		if (flag == 1) {
			$('#distridiv').show();
		} else{
			$('#distridiv').hide();
		}
	}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>
