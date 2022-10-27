<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
<ul class="nav nav-tabs">
    <li   ><a href="/index.php?c=site&a=entry&do=apply&op=dynamicltype&ac=dynamicltype&m=hyb_yl">板块分类管理</a></li>
	<li class="active"><a href="#">添加板块分类</a></li>
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
									<input type="text" name="sortid"   placeholder="排序号越大排列越靠前" class="form-control" value="<?php  echo $item['sortid'];?>" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">分类名称<span class="must-fill">*</span></label>
								<div class="col-sm-9">
									<input type="text" name="name" required autocomplete="off" class="form-control" value="<?php  echo $item['name'];?>" placeholder="请输入分类名称">
								</div>
							</div>
		                  	<div class="form-group">
								<label class="col-sm-2 control-label">分类描述<span class="must-fill">*</span></label>
								<div class="col-sm-9">
									<input type="text" name="describe" required autocomplete="off" class="form-control" value="<?php  echo $item['describe'];?>" maxlength="6" placeholder="分类描述 限制最多输入6个字">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">分类图片</label>
								<div class="col-sm-9">
									<?php  echo tpl_form_field_image('thumb', $item['thumb'])?>
								</div>
							</div>
							
							<!-- <div class="form-group">
								<label class="col-sm-2 control-label">外部链接<span class="must-fill"></span></label>
								<div class="col-sm-9">
									<input type="text" name="abroad" placeholder="" class="form-control" value="<?php  echo $item['abroad'];?>">
								</div>
							</div> -->
							<div class="form-group">
								<label class="col-sm-2 control-label">是否推荐</label>
								<div class="col-sm-9">
		                            <label class="radio-inline">
		                                <input type="radio" name='recommend' value='1' <?php  if($item['recommend']=='1') { ?> checked <?php  } ?>>是
		                            </label>
		                            <label class="radio-inline">
		                                <input type="radio" name='recommend' value='0' <?php  if($item['recommend']=='0' || empty($item['recommend'])) { ?> checked <?php  } ?>>否
		                            </label>
		                            <div class="help-block" style="color: red;">建议最多推荐4个</div>
								</div>
								
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">是否开启</label>
								<div class="col-sm-9">
		                            <label class="radio-inline">
		                                <input type="radio" name='enabled' value='1' <?php  if($item['enabled']=='1') { ?> checked <?php  } ?>>是
		                            </label>
		                            <label class="radio-inline">
		                                <input type="radio" name='enabled' value='0' <?php  if($item['enabled']=='0' || empty($item['enabled'])) { ?> checked <?php  } ?>>否
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
                    <input type="hidden" name="id" value="<?php  echo $_GPC['id'];?>" />
	                <input type="hidden" name="paretid" value="<?php  echo $_GPC['parentid'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>

