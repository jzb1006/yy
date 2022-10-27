<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#tab_basic">积分设置</a></li>
</ul>
<div class="app-content">
    <div class="app-form">
        <form action="" method="post" class="form-horizontal form form-validate" id="setting-form">
            <div class="panel panel-default">
                <div class="panel-heading">积分设置</div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">评价送积分</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" name="evaluate_score" class="form-control" value="<?php  echo $item['evaluate_score'];?>">
                            <span class="input-group-addon">积分</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">积分抵扣</label>
                    <div class="col-sm-9">
                        <label class="radio-inline" onclick="$('#proportion').show()" >
                            <input type="radio" name="status" value="1" <?php  if($item['status'] == '1') { ?> checked="checked" <?php  } ?>>开启
                        </label>
                        <label class="radio-inline" onclick="$('#proportion').hide()">
                            <input type="radio" name="status" value="0" <?php  if($item['status'] == '0') { ?> checked="checked" <?php  } ?>>关闭
                        </label>
                    </div>
                </div>
                <div class="form-group" id = 'proportion' <?php  if($item['status'] == '0') { ?>  style="display: none;"  <?php  } ?> >
                    <label class="col-sm-2 control-label">抵扣比例</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" name="proportion" class="form-control" value="<?php  echo $item['proportion'];?>">
                            <span class="input-group-addon">积分抵扣一元</span>
                        </div>
                        <span class="help-block">为防止出错，请保证输入的抵扣比例能把1除尽。</span>
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
<script>
$(function () {
		window.optionchanged = false;
		$('#myTab a').click(function (e) {
			e.preventDefault();//阻止a链接的跳转行为
			$(this).tab('show');//显示当前选中的链接及关联的content
		})
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
