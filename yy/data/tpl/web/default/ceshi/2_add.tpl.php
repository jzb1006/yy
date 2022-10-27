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
	<li ><a href="<?php  echo $this->copysiteUrl('ceshi.lists');?>&ac=addappAttributelist">科室列表</a></li>
	<li <?php  if(empty($id)) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->copysiteUrl('ceshi.addappAttribute');?>&ac=addappAttribute">添加科室</a></li>
	<?php  if(!empty($id)) { ?>
	<li class="active"><a href="#">编辑科室</a></li>
	<?php  } ?>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
			<input type="hidden" name="id" value="<?php  echo $id;?>" />
			<div class="panel panel-default">
				<div class="panel-heading">科室设置</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">排序</label>
					<div class="col-sm-9">
						<input type="text" name="nav[sort]" placeholder="默认排序为0" class="form-control" value="<?php  echo $rows['sort'];?>" >
					</div>
				</div>
             <div class="form-group">
				<label class="col-sm-2 control-label">位置</label>
				<div class="col-sm-9 col-xs-12">
                 <select name="nav[giftstatus]" class="form-control valid" aria-invalid="false">
                    <option value="0">选择类型</option>
                     <?php  if(is_array($listgroy)) { foreach($listgroy as $item) { ?>
                       <option value="<?php  echo $item['id'];?>" <?php  if($item['id'] == $rows['giftstatus'] ) { ?> selected <?php  } ?>><?php  echo $item['ctname'];?></option>
                     <?php  } } ?>
                 </select>
				</div>
			</div>
              

              
				<div class="form-group">
					<label class="col-sm-2 control-label">科室名称<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="nav[name]" required class="form-control" value="<?php  echo $rows['name'];?>" >
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-sm-2 control-label">标题颜色</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="color" name="nav[color]" required id="color" value="<?php  echo $rows['color'];?>" class="form-control"  >
							<span id="reset"  class="input-group-addon btn btn-default">重置</span>
						</div>
					</div>
				</div> -->
				<div class="form-group">
					<label class="col-sm-2 control-label">科室图片<span class="must-fill">*</span></label>
					<div class="col-sm-9">
						<?php  echo tpl_form_field_image('nav[detail_cover_url]', $rows['detail_cover_url'])?>
						<span class="help-block">建议图片大小80*80</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">科室标签</label>
					<div class="col-sm-9" style="display: flex;">
						<!-- <div class="col-sm-9"> -->
							<!-- <input type="text" value="<?php  echo $rows['description'];?>" class="form-control valid" name="nav[description]" placeholder="" id="advlink" > -->
              <textarea class="form-control max2000" rows="8" name="nav[description]" placeholder="" id="advlink"><?php  echo $rows['description'];?></textarea>
              
						<!-- </div> -->
            <!-- <div class="col-sm-1"> -->
              <a class="btn btn-primary" style="background-color: white;color: black;height: 34px;" href="JavaScript:#;" data-toggle="modal" data-target="#myModal">添加标签</a>
            <!-- </div> -->
            
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">是否显示</label>
					<div class="col-sm-9">
						<div class="radio-inline">
							<input type="radio" name='nav[enabled]' value='1' <?php  if($rows['enabled']==1) { ?>checked<?php  } ?>>是
						</div>
						<div class="radio-inline">
							<input type="radio" name='nav[enabled]' value='0' <?php  if($rows['enabled']==0) { ?>checked<?php  } ?>>否
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添加标签</h4>
      </div>
      <div class="modal-body">
       	<div class="form-inline">
          <div class="col-sm-9">
            <label for="exampleInputEmail2">自定义标签</label>
            <input type="text" class="form-control " id="tabInput" placeholder="" style="width:80%;">
          </div>
  		  <button type="button" class="btn btn-primary addTab">添加</button>
		</div>
        
            <div class="df tabBox" style="padding-left: 15px;"> 
              <label>已选择</label>
              <div class="df" id="tabBox_xz">
                  <?php  if(!empty($description)) { ?>
                  <?php  if(is_array($description)) { foreach($description as $ditem) { ?>
                  <div class="df tab_cg">
                    <div class="tab_text"><?php  echo $ditem;?></div>
                    <div class="tab_btn">
                      <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                  </div>
                  <?php  } } ?>
                  <?php  } ?>
            </div>
          </div>
          <div class="tab_box " style="display: flex;justify-content: space-between;padding-left: 15px;">
              <label style="white-space: nowrap;margin-right: 14px;">词库</label>
              <div class="" style="flex-wrap: wrap;max-height: 200px;overflow: hidden;overflow-y: hidden;overflow-y: auto;">
                <?php  if(!empty($description)) { ?>
                    <?php  if(is_array($description)) { foreach($description as $ditem) { ?>
                  <div class="tab" style="height: 30px;line-height: 30px;padding: 0 5px;margin-bottom: 10px;margin-left: 20px;margin-right: 0;"><?php  echo $ditem;?></div>
                  <?php  } } ?>
                  <?php  } ?>  
              </div>
          </div>
        
      </div>
      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary addBtn" data-dismiss="modal">确认添加</button>
      </div>
    </div>
  </div>
</div>
<script>
	$("#reset").on('click',function(){
		$("#color").val('#666').trigger('propertychange');
	});
  $(document).on('click','.tab',function(){
  	var tabText=$(this).text().trim()
    var textlen=$('.tabBox').find('.tab_cg').length
    for(var i=0;i<textlen;i++){
      console.log($('.tabBox').find('.tab_cg .tab_text').eq(i).text().trim())
      console.log(tabText)
    	if(tabText==$('.tabBox').find('.tab_cg .tab_text').eq(i).text().trim()){
           	alert('已添加相同的标签')
          	return
           }
    }
    $('#tabBox_xz').append(`
		  <div class="df tab_cg">
        <div class="tab_text" >${tabText}</div>
          <div class="tab_btn">
            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
          </div>
      </div>
	`)
  })
  
  $(document).on('click','.close',function(){
    console.log($(this).parents('.tab_cg'))
  	$(this).parents('.tab_cg').remove()
  })
  
  $('.addTab').on('click',function(){
  	var text=$('#tabInput').val().trim()
    var tabText=$('#tabInput').val().trim()
    var textlen=$('.tab_box >div').find('.tab').length
    for(var i=0;i<textlen;i++){
      if(text==$('.tab_box >div').find('.tab').eq(i).text().trim()){
            alert('已添加相同的标签')
            return
           }
    }
    if(text==''){
      $('#tabInput').focus()
		  alert('请填写自定义标签')
    }else{
       	$('.tab_box>div').append(`
		<div class="tab" style="height: 30px;line-height: 30px;padding: 0 5px;margin-bottom: 10px;margin-left: 20px;margin-right: 0;">${text}</div>
	`)
      $('#tabInput').val('')
       }
  })
  
  $('.addBtn').on('click',function(){
    var arr=[]
  		$('#tabBox_xz').find('.tab_text').each(function(index,val){
          arr.push($(val).text())
        })
      var arr1=arr.join('、')
        $('#advlink').val(arr1)
  })
</script>