<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<style>
  .df{
  	display:flex;
    align-items: center;
  }
  .tab_cg{
  	border:1px solid #eaeaea;
    margin-left:20px;
  }
  .tab_text,.tab_btn{
  	padding: 5px 10px;
  }
  .tab_btn{
  	border-left:1px solid #eaeaea;
  }
  button{
  	outline: none;
  }
  .tabBox{
  	margin-top:20px;
  }
  label{
  	margin:0;
  }
  .tab_box{
    height:200px;
    overflow:hidden;
    overflow-y:auto;
    margin-top:20px;
  }
  .tab{
    display:inline-block;
  	padding:5px;
    border:1px solid #eaeaea;
    margin-right:10px;
    cursor: pointer;
  }
  
  .tabBox label{
  	white-space: nowrap;
  }
  #tabBox_xz{
  	flex-wrap:wrap;
    max-height:200px;
    overflow:hidden;
    overflow-y:auto;
  }
    #tabBox_xz .tab_cg{
	margin-bottom:10px;
  }
  .tab:hover{
  	background:#2aabd2;
    color:#fff;
  }
</style>
<ul class="nav nav-tabs">
  <li><a href="<?php  echo $this->copysiteUrl('ceshi.hotwordsearch');?>&ac=hotwordsearch">热词搜索列表</a></li>
	<li <?php  if(empty($id)) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->copysiteUrl('ceshi.addhotwordsearch');?>&ac=hotwordsearch">添加热词</a></li>
	<?php  if(!empty($id)) { ?>
	<li class="active"><a href="#">编辑热词</a></li>
	<?php  } ?>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
			<div class="panel panel-default">
				<div class="panel-heading">编辑热词</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">排序</label>
					<div class="col-sm-9">
						<input type="text" name="sort" placeholder="默认排序为0" class="form-control" value="<?php  echo $rows['sort'];?>" >
					</div>
				</div>
            
				<div class="form-group">
					<label class="col-sm-2 control-label">名称<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="name" required class="form-control" value="<?php  echo $rows['name'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">状态</label>
					<div class="col-sm-9">
						<div class="radio-inline">
							<input type="radio" name='status' value='1' <?php  if($rows['status']==1) { ?>checked<?php  } ?>>启用
						</div>
						<div class="radio-inline">
							<input type="radio" name='status' value='0' <?php  if($rows['status']==0) { ?>checked<?php  } ?>>禁用
						</div>
					</div>
				</div>
			</div>
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
 <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>