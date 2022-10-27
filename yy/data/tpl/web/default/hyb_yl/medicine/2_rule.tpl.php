<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('/common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('/common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#tab_basic">规则设置</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form form-validate">
			<div class="panel panel-default">
				<div class="panel-heading">规则设置</div>
				<div class="panel-body">
					
				<div class="form-group" style="">
					<label class="col-sm-2 control-label">药师协议</label>
					<div class="col-sm-9" style="">
						<?php  echo tpl_ueditor('content',$item['content']);?>
					</div>
				</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">自动审核</label>
						<div class="col-sm-9">
							<label class="radio-inline"><input type="radio" name="status" <?php  if($item['status'] == '1') { ?> checked="" <?php  } ?> value="1" >开启</label>
							<label class="radio-inline"><input type="radio" name="status" value="0" <?php  if($item['status'] == '0') { ?> checked="" <?php  } ?> >关闭</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否开启处方审核</label>
						<div class="col-sm-9">
							<label class="radio-inline"><input type="radio" name="is_shenhe" <?php  if($item['is_shenhe'] == '1') { ?> checked="" <?php  } ?> value="1" >是</label>
							<label class="radio-inline"><input type="radio" name="is_shenhe" value="0" <?php  if($item['is_shenhe'] == '0') { ?> checked="" <?php  } ?> >否</label>
						</div>
					</div>
					<div class="form-group">
					<label class="col-sm-2 control-label" >药师审核抽成</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="sh_fee" class="form-control" value="<?php  echo $item['sh_fee'];?>" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="help-block col-md-10 col-lg-offset-2">药师审核抽成</div>
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-9">
					<input type="submit" name="submit" value="提交" class="btn btn-primary min-width" />
					<input type="hidden" name="token" value="da1c10f4" />
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
            <li class="links_item"><div class="copyright">Powered by <a href="http://www.we7.cc"><b>系统</b></a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a></div></li>
		</ul>
	</div>
	</body>
</html>
