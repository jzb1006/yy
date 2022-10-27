<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>	
<?php  if($type=='display') { ?>
<style>
	.col-sm-4{
   	width:auto   
  }
  .col-sm-2{
   	width:auto   
  }
  .zhe{
  	position: fixed;
  	top: 0;
  	width: 100%;
  	height: 100%;
  	background: rgba(0,0,0,0.6);
  	display: flex;
  	justify-content: center;
  	align-items: center;
  }
  .zhe .imgBig{
  	width: 20%;
  }
</style>

<div class="app-container-right">

    <div class="app-content">
      <div class="app-filter">
			<div class="filter-list">
				<form action="" method="post" class="form-horizontal" role="form" id="form1">
	              	<div class="form-group">
						<label class="col-sm-2 control-label">关键字</label>
						<div class="col-md-5">
							<input type="text" name="keyword" class="form-control" value="" placeholder="请输入关键字">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-9">
							<button class="btn btn-primary" id="search">筛选</button>
							<a class="btn btn-danger " href="<?php  echo $this->createWeburl('medicine',array('type'=>'addmoban','op'=>'chufangmuban','pid'=>$id))?>" data-confirm="是否压缩二维码？">添加模板</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="app-table-list">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th style="width: 30px;">
								<input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
									</th>
									<th>分类名称</th>
									<th>操作</th>
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
									<td><?php  echo $item['title'];?></td>
									<td style="position: relative;">
									<a class="btn btn-default btn-sm" href="<?php  echo $this->createWeburl('medicine',array('type'=>'addmoban','op'=>'chufangmuban','id'=>$item['id']))?>" title="编辑">编辑</a>
									
									<a class="btn btn-default btn-sm"  href="<?php  echo $this->createWeburl('medicine',array('op'=>'chufangmubanpost','type'=>'post','ac'=>'chufangmuban','id'=>$item['id'],'hid'=>$_SESSION['hid']))?>" title="管理入口">处方列表</a>
                                    
									<a class="btn btn-danger btn-sm" href="<?php  echo $this->createWeburl('medicine',array('op'=>'delchufangmo','ac'=>'chufangmuban','id'=>$item['id'],'hid'=>$_SESSION['hid']))?>" data-toggle="ajaxRemove" data-confirm="删除机构会导致机构下专家和药品无法使用，确定要删除吗？" title="删除">删除</a>
									
									</td>
								</tr>
								<?php  } } ?>
							</tbody>
						</table>
						<?php  echo $pager;?>
					</div>
					<?php  if(is_agent != '1') { ?>
					<div class="app-table-foot clearfix">
						<div class="pull-left">
							<div id="de1" class="pull-left">
								<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">删除选中</a>
							</div>
						</div>
						<div class="pull-right">
						</div>
					</div>
					<?php  } ?>
				</div>
			</div>
			<script>
			$(document).on('click','.bigImg',function(){
				var src=$(this).attr('data-src')
				$('body').append(`
					<div class="zhe">
					<img class="imgBig" src="${src}"/>
					</div>
					`)
			})
			$(document).on('click','.zhe',function(){
				$(this).remove()
			})
				var enabled = "1";
					$('#de1').delegate('.pass','click',function(e){
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
						util.nailConfirm(this, function(state) {
						if(!state) return;
							if(enabled == 4){
								var type = 2;
							}else{
								var type = 1;
							}
							$.post("<?php  echo $this->createWeburl('medicine',array('op'=>'delchufanglists','type'=>'display'))?>", { ids : ids ,type:type}, function(data){
								if(data.errno=='1'){ 
				                    util.tips("操作成功！");
				                    setTimeout(function(){ 
				                        window.location.reload();
				                    }, 1000);
				                }else{
				                    util.tips("操作失败");  
				                };
							}, 'json');
						}, {html: '确认删除所选商户?'});
					});
			</script>
</div>
<?php  } ?>

<?php  if($type=='post') { ?>
<div class="app-container-right">
    <div class="app-content">
      <div class="app-filter">
			<div class="filter-list">
				<form action="" method="post" class="form-horizontal" role="form" id="form1">
	              	<div class="form-group">
						<label class="col-sm-2 control-label">关键字</label>
						<div class="col-md-5">
							<input type="text" name="keyword" class="form-control" value="" placeholder="请输入关键字">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-9">
							<button class="btn btn-primary" id="search">筛选</button>
							<a class="btn btn-danger " href="<?php  echo $this->createWeburl('medicine',array('type'=>'add','op'=>'chufangmuban','pid'=>$id))?>" data-confirm="是否压缩二维码？">添加处方</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="app-table-list">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th style="width: 30px;">
								<input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
									</th>
									<th>处方列表</th>
									<th>描述</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<?php  if(is_array($cflist)) { foreach($cflist as $item) { ?>
								<tr>
									<td>
										<center>
											<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php  echo $item['id'];?>" />
										</center>
									</td>
									<td><?php  echo $item['title'];?></td>
									<td><?php  echo $item['desc'];?></td>
									<td style="position: relative;">
									<a class="btn btn-default btn-sm" href="<?php  echo $this->createWeburl('medicine',array('type'=>'add','op'=>'chufangmuban','pid'=>$item['pid'],'id'=>$item['id']))?>" title="编辑">编辑</a>
									
									<a class="btn btn-danger btn-sm" href="<?php  echo $this->createWeburl('medicine',array('op'=>'delchufangmuban','ac'=>'drugstorelist','id'=>$item['id'],'hid'=>$_SESSION['hid'],'pid'=>$id))?>" data-toggle="ajaxRemove" data-confirm="删除机构会导致机构下专家和药品无法使用，确定要删除吗？" title="删除">删除</a>
									
									</td>
								</tr>
								<?php  } } ?>
							</tbody>
						</table>
						<?php  echo $pager;?>
					</div>
					<?php  if(is_agent != '1') { ?>
					<div class="app-table-foot clearfix">
						<div class="pull-left">
							<div id="de1" class="pull-left">
								<a href="javascript:;" class="btn btn-default min-width js-batch js-delete pass">删除选中</a>
							</div>
						</div>
						<div class="pull-right">
						</div>
					</div>
					<?php  } ?>
				</div>
			</div>
			<script>
			$(document).on('click','.bigImg',function(){
				var src=$(this).attr('data-src')
				$('body').append(`
					<div class="zhe">
					<img class="imgBig" src="${src}"/>
					</div>
					`)
			})
			$(document).on('click','.zhe',function(){
				$(this).remove()
			})
				var enabled = "1";
					$('#de1').delegate('.pass','click',function(e){
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
						util.nailConfirm(this, function(state) {
						if(!state) return;
							if(enabled == 4){
								var type = 2;
							}else{
								var type = 1;
							}
							$.post("<?php  echo $this->createWeburl('medicine',array('op'=>'delchufanglists','type'=>'post'))?>", { ids : ids ,type:type}, function(data){
								if(data.errno=='1'){ 
				                    util.tips("操作成功！");
				                    setTimeout(function(){ 
				                        window.location.reload();
				                    }, 1000);
				                }else{
				                    util.tips("操作失败");  
				                };
							}, 'json');
						}, {html: '确认删除所选商户?'});
					});
			</script>
</div>
<?php  } ?>
<?php  if($type=='add') { ?>

<div class="app-container-right">
    <script type="text/javascript" src="http://www.webstrongtech.com/addons/hyb_yl/web/resource/js/diyarea.js"></script>
    <ul class="nav nav-tabs" id="myTab">
        <li class="active">
            <a href="#tab_1">编辑处方</a>
        </li>
    </ul>
    <div class="app-content">
        <div class="app-form">
            <form action="" method="post" class="form-horizontal form form-validate"  onsubmit="return checkValidate(this.form);">
                <input type="hidden" name="id" value="" />
                <div class="tab-content">
                    <div class="tab-pane  active" id="tab_1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                处方信息
                            </div>
                            <div class="panel-body">
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">处方名称<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" id="login_name" required placeholder="请输处方名称" class="form-control" value="<?php  echo $item['title'];?>">
                                    </div>
                                 </div>
                                 <div class="form-group" style="">
                                    <label class="col-sm-2 control-label">诊断建议<span class="must-fill">*</span></label>
                                    <div class="col-sm-9" style="">
                                       <textarea rows="6" cols="20" class="form-control ng-pristine ng-untouched ng-valid ng-empty" name="zhenduan" id="zhenduan"><?php  echo $item['zhenduan'];?></textarea>
                                    </div>
                                </div>
                                 <div class="form-group" style="">
                                    <label class="col-sm-2 control-label">用药建议<span class="must-fill">*</span></label>
                                    <div class="col-sm-9" style="">
                                       <textarea rows="6" cols="20" class="form-control ng-pristine ng-untouched ng-valid ng-empty" name="yongyao" id="yongyao"><?php  echo $item['yongyao'];?></textarea>
                                    </div>
                                </div>
                                 <div class="form-group" style="">
                                    <label class="col-sm-2 control-label">处方描述<span class="must-fill">*</span></label>
                                    <div class="col-sm-9" style="">
                                       <textarea rows="6" cols="20" class="form-control ng-pristine ng-untouched ng-valid ng-empty" name="desc" id="desc"><?php  echo $item['desc'];?></textarea>
                                    </div>
                                </div>
<!--                                  <div class="form-group" style="">
                                    <label class="col-sm-2 control-label">处方详情<span class="must-fill">*</span></label>
                                    <div class="col-sm-9" style="">
                                       <textarea rows="6" cols="20" class="form-control ng-pristine ng-untouched ng-valid ng-empty" name="content" id="content"><?php  echo $item['content'];?></textarea>
                                    </div>
                                </div> -->
								<div class="form-group">
									<label class="col-sm-2 control-label">处方详情</label>
									<div class="col-md-9">

									<?php  if(is_array($content)) { foreach($content as $it) { ?>
									
										<div id="datas" class="sms-template-1" style="display:block;">
											<div class="col-sm-12 data-item" style="margin-bottom: 10px;padding-left: 0;padding-right: 0;">
												<div class="input-group form-group col-sm-6" style="margin: 0px;padding-left: 0;float: left;">
													<span class="input-group-addon">药品名称</span>
													<input type="text" name="registerdate[ypname][]" class="form-control" value="<?php  echo $it['ypname'];?>">
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-time"></span>
													</span>

												</div>
												<div class="input-group form-group col-sm-6" style="margin: 0px;padding-left: 0;float: left;">
													<span class="input-group-addon">用法</span>
													<input type="text" name="registerdate[yfa][]" class="form-control" value="<?php  echo $it['yfa'];?>">
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-time"></span>
													</span>

												</div>
												<div class="input-group form-group col-sm-6" style="margin: 0px;padding-left: 0;float: left;">
													<span class="input-group-addon">单次用量</span>
													<input type="text" name="registerdate[yliang][]" class="form-control" value="<?php  echo $it['yliang'];?>">
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-time"></span>
													</span>

												</div>

												<div class="input-group form-group col-sm-6" style="margin: 0px;padding-right: 0;float: left;">
													<span class="input-group-addon">用药次数</span>
													<input type="text" name="registerdate[jiliang][]" class="form-control" value="<?php  echo $it['jiliang'];?>">
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-time"></span>
													</span>

													<span class="input-group-addon btn btn-default data-item-delete">
														<i class="fa fa-remove"></i>删除
													</span>
												</div>
											</div>
											<script type="text/javascript">
												$(document).on('click', '.data-item-delete', function () {
												        $(this).closest('.data-item').remove();
												  });
											</script>
										</div>
									
									<?php  } } ?>	
									
										<div class="form-group sms-template-1" style="display:block;">
											<div class="col-sm-6" style="padding-left: 0;">
												<a class="btn btn-default btn-add-type btn1 col-sm-12 col-xs-12" href="javascript:;" onclick="addType();">
													<i class="fa fa-plus" title=""></i>增加药品
												</a>
											</div>
										</div>
									</div>
								</div>


                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php  echo $id;?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-9">
                            <input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
                window.optionchanged = false;
                $('#myTab a').click(function (e) {
                    e.preventDefault();//阻止a链接的跳转行为
                    $(this).tab('show');//显示当前选中的链接及关联的content
                })
            });
    </script>
</div>

<?php  } ?>

<?php  if($type=='addmoban') { ?>

<div class="app-container-right">
    <script type="text/javascript" src="http://www.webstrongtech.com/addons/hyb_yl/web/resource/js/diyarea.js"></script>
    <ul class="nav nav-tabs" id="myTab">
        <li class="active">
            <a href="#tab_1">编辑处方</a>
        </li>
    </ul>
    <div class="app-content">
        <div class="app-form">
            <form action="" method="post" class="form-horizontal form form-validate"  onsubmit="return checkValidate(this.form);">
                <input type="hidden" name="id" value="" />
                <div class="tab-content">
                    <div class="tab-pane  active" id="tab_1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                模板信息
                            </div>
                            <div class="panel-body">
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">模板名称<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" id="login_name" required placeholder="请输模板名称" class="form-control" value="<?php  echo $item['title'];?>">
                                    </div>
                                 </div>
<!--                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">模板分类<span class="must-fill">*</span>
                                    </label>
                                    <div class="col-sm-9">
									<select class="form-control tpl-category-parent we7-select" id="category_parent" name="pid">
									<option value="0">请选择一级分类</option>
									<?php  if(is_array($fllist)) { foreach($fllist as $items) { ?>
									<option value="<?php  echo $items['id'];?>" <?php  if($items['id']==$item['pid']) { ?> selected="selected" <?php  } ?>><?php  echo $items['title'];?></option>
									<?php  } } ?>
									</select>
									</div>
                                 </div> -->
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php  echo $id;?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-9">
                            <input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
                window.optionchanged = false;
                $('#myTab a').click(function (e) {
                    e.preventDefault();//阻止a链接的跳转行为
                    $(this).tab('show');//显示当前选中的链接及关联的content
                })
            });
    </script>
</div>

<?php  } ?>
<div class="foot" id="footer">
	<ul class="links ft">
		<li class="links_item">
			<div class="copyright">Powered by <a href="http://www.we7.cc">
					<b>系统</b>
				</a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a>
			</div>
		</li>
	</ul>
</div>
<script>
			function addType(){
				$('#datas').append(`
						<div class="col-sm-12 data-item" style="margin-bottom: 10px;padding-left: 0;padding-right: 0;">
	    <div class="input-group form-group col-sm-6" style="margin: 0px;padding-left: 0;float: left;">
	    	<span class="input-group-addon">药品名称</span>
			<input type="text" name="registerdate[ypname][]" class="form-control" value="">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time"></span>
											</span>
	    
		</div>
	    <div class="input-group form-group col-sm-6" style="margin: 0px;padding-left: 0;float: left;">
	    	<span class="input-group-addon">用法</span>
			<input type="text" name="registerdate[yfa][]" class="form-control" value="">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time"></span>
											</span>
	    
		</div>
	    <div class="input-group form-group col-sm-6" style="margin: 0px;padding-left: 0;float: left;">
	    	<span class="input-group-addon">单次用量</span>
			<input type="text" name="registerdate[yliang][]" class="form-control" value="">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time"></span>
											</span>
	    
		</div>	

	    <div class="input-group form-group col-sm-6" style="margin: 0px;padding-right: 0;float: left;">
	    	<span class="input-group-addon">用药次数</span>
	      	<input type="text" name="registerdate[jiliang][]" class="form-control" value="">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time"></span>
											</span>
	
			<span class="input-group-addon btn btn-default data-item-delete"><i class="fa fa-remove"></i>删除</span>
	    </div>
	</div>
	</div>
					`)
			}

</script>
</body>
</html>