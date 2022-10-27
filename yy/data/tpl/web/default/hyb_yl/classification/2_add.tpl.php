<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
	<div class="app-content">
		<ul class="nav nav-tabs" id="myTab">
			<li class="active">
				<a href="#">添加文章</a>
			</li>
		</ul>
		<div class="app-form">
			<div class="main">
				<form action="" method="post" class="form-horizontal form" id="form">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="panel-body">
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">排序</label>
									<div class="col-md-8">
										<input type="text" name="sord" id="sord" class="form-control" value="<?php  echo $res['sord'];?>"/>
										<span class="help-block">提示：填写数字</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">文章标题</label>
									<div class="col-md-8">
										<input type="text" name="title" id="title" class="form-control" value="<?php  echo $res['title'];?>" />
									</div>
								</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">标题颜色</label>
							<div class="col-sm-9">
                                <?php  echo tpl_form_field_color('color', $res['color'])?>
							</div>
						</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">绑定医生微信</label>
									<div class="col-sm-9">
										<input type="hidden" id="zid" name="zid" value="<?php  echo $res['zid'];?>">
										<div class="input-group">
											<input type="text" name="z_name" maxlength="30" value="<?php  echo $res['z_name'];?>" id="salerdoc" class="form-control" readonly="">
											<div class="input-group-btn">
												<button class="btn btn-default" type="button" data-toggle="modal" data-target="#myModaldoc">绑定医生微信</button>
											</div>
										</div>
										<div class="modal fade" id="myModaldoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog" style="width: 660px;">
												<div class="modal-content">
													<div class="modal-header">
														<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
														<h3>绑定医生微信</h3>
													</div>
													<div class="modal-body">
														<div class="row">
															<div class="input-group">
																<input type="text" class="form-control" name="keyword" value="" id="search-kwd-doc" placeholder="可搜索微信昵称，openid，UID">
																<span class="input-group-btn">
																	<button type="button" class="btn btn-default" onclick="search_members_doc();">搜索</button>
																</span>
															</div>
														</div>
														<div id="module-menus-doc" style="padding-top:5px;"></div>
													</div>
													<div class="modal-footer">
														<a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">绑定编辑员微信</label>
									<div class="col-sm-9">
										<input type="hidden" id="u_id" name="u_id" value="<?php  echo $res['userid'];?>">
										<div class="input-group">
											<input type="text" name="nickname" maxlength="30" value="<?php  echo $res['u_name'];?>" id="saler" class="form-control" readonly="">
											<div class="input-group-btn">
												<button class="btn btn-default" type="button" data-toggle="modal" data-target="#myModal">绑定编辑员微信</button>
											</div>
										</div>
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog" style="width: 660px;">
												<div class="modal-content">
													<div class="modal-header">
														<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
														<h3>绑定编辑员微信</h3>
													</div>
													<div class="modal-body">
														<div class="row">
															<div class="input-group">
																<input type="text" class="form-control" name="keyword" value="" id="search-kwd" placeholder="可搜索微信昵称，openid，UID">
																<span class="input-group-btn">
																	<button type="button" class="btn btn-default" onclick="search_members();">搜索</button>
																</span>
															</div>
														</div>
														<div id="module-menus" style="padding-top:5px;"></div>
													</div>
													<div class="modal-footer">
														<a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
									<label class="col-sm-2 control-label">绑定项选择<span class="must-fill">*</span>
									</label>
									<div class="col-sm-8">
                                        <div class="row row-fix tpl-category-container">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <select class="form-control tpl-category-parent we7-select" id="category_parent" name="keshi_one">
                                                    <option value="0">请选择一级分类</option>
                                                    <?php  if(is_array($ks_list)) { foreach($ks_list as $items) { ?>
                                                          <option value="<?php  echo $items['id'];?>" <?php  if($items['id']==$res['keshi_one']) { ?> selected="selected" <?php  } ?>><?php  echo $items['ctname'];?></option>
                                                    <?php  } } ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <select class="form-control tpl-category-child we7-select" id="category_child" name="keshi_two">
                                                     <option value='0'>请选择二级分类</option>
                                                     <?php  if(is_array($ks_two)) { foreach($ks_two as $kst) { ?>
                                                     <option value="<?php  echo $kst['id'];?>" <?php  if($kst['id']==$res['keshi_two']) { ?> selected="selected" <?php  } ?>><?php  echo $kst['name'];?></option>
                                                     <?php  } } ?>
                                                </select>
                                            </div>
                                        </div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">文章缩略图logo<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">
                                        <?php  echo tpl_form_field_image('thumb', $res['thumb'])?>
										<span class="help-block">文章缩略图，建议使用正方形图片</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">文章关键字</label>
									<div class="col-md-8">
										<input type="text" name="title_fu" id="keyword" class="form-control" value="<?php  echo $res['title_fu'];?>" />
										<span class="help-block">提示：文章关键字提供更精准的搜索推送服务, 并非入口关键字, 多个请以半角逗号隔开</span>
									</div>

								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">文章内容</label>
									<div class="col-sm-8 col-xs-12">
										<textarea id="content" name="content" type="text/plain" style="height:200px;"><?php  echo $res['content'];?></textarea>
										<script type="text/javascript">
											require(['util'], function(util){
														util.editor('content', {
														height : 200, 
														dest_dir : '',
														image_limit : 5120000,
														allow_upload_video : true,
														audio_limit : 5120000,
														callback : ''
														});
													});
										</script>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">文章类别<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">

										<script type="text/javascript">
											window._category = [];
										</script>
										<script type="text/javascript">
											function renderCategory(obj, name){
											var index = obj.options[obj.selectedIndex].value;
											require(['jquery', 'util'], function($, u){
						                    var url ="<?php  echo $_W['siteroot'];?>web/index.php?c=site&a=entry&do=classification&m=hyb_yl&op=class_er"; 
									            $.ajax({  
									                type: "POST",  
									                url: url,  
									                dataType: "json",  
									                data: {"id":index},  
									                success: function(e){ 
									                    console.log(e)
									                $("select[name='er_id']").empty();
									                var html = "<option value='0'>请选择二级分类</option>";
									                $(e).each(function (v, k) {
									                    html += "<option value='" + k.zx_id + "'>" + k.zx_name + "</option>";
									                });
									                //把遍历的数据放到select表里面
									                $("select[name='er_id']").append(html);

									              }
									            });
											});
										}
										</script>
										<div class="row row-fix tpl-category-container">
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
											 <!-- onchange="renderCategory(this,'category')" -->
												<select class="form-control tpl-category-parent we7-select" id="category_parent" name="p_id">
													<option value="0">请选择分类</option>
													<?php  if(is_array($list_type)) { foreach($list_type as $item) { ?>
													<option value="<?php  echo $item['zx_id'];?>" <?php  if($item['zx_id']== $res['p_id']) { ?> selected="selected" <?php  } ?>><?php  echo $item['zx_name'];?></option>
													<?php  } } ?>
												</select>
											</div>
											<!-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
												<select class="form-control tpl-category-child we7-select" id="category_child" name="er_id">
													<option value="0">请选择二级分类</option>
													<?php  echo $o;?>
												</select>
											</div> -->
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">发布时间<span class="must-fill">*</span>
									</label>
									<div class="col-sm-9">
										<?php  echo tpl_form_field_date('time', strtotime($res['time']), false);?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">有帮助</label>
									<div class="col-sm-9">
										<input type="number" name="dz" class="form-control" value="<?php  echo $res['dz'];?>">
										<div class="help-block">虚拟帮助数</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">首次阅读奖励</label>
									<div class="col-sm-9">
										<input type="number" name="scyd" class="form-control" value="<?php  echo $res['scyd'];?>">
										<div class="help-block">积分</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">虚拟阅读量</label>
									<div class="col-sm-9">
										<input type="number" name="dianj" class="form-control" value="<?php  echo $res['dianj'];?>">
										<div class="help-block">虚拟阅读量</div>
									</div>
								</div>
								<!-- <div class="form-group">
									<label class="col-sm-2 control-label">普通阅读奖励</label>
									<div class="col-md-9">
										<div class="input-group form-group col-sm-6" style="margin: 0px;padding-left: 0;float: left;">
											<span class="input-group-addon">日常奖励</span>
											<input type="number" name="rcyd" class="form-control" value="<?php  echo $res['rcyd'];?>">
											<span class="input-group-addon">积分</span>
										</div>
										<div class="input-group form-group col-sm-6" style="margin: 0px;padding-right: 0;float: left;">
											<span class="input-group-addon">首次阅读奖励</span>
											<input type="number" name="scyd" class="form-control valid" value="<?php  echo $res['scyd'];?>">
											<span class="input-group-addon">积分</span>
										</div>
									</div>
								</div> -->
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">是否推荐</label>
									<div class="col-xs-12 col-sm-8">
										<div class="radio radio-success radio-inline">
											<input type="radio" id="recommend1" name="status" <?php  if($res['status'] =='1') { ?> checked="checked" <?php  } ?> value="1">
											<label for="inlineRadio1" > 是 </label>
										</div>
										<div class="radio radio-success radio-inline">
											<input type="radio" id="recommend2" name="status" value="0" <?php  if($res['status'] =='0' || !$res) { ?> checked="checked" <?php  } ?>>
											<label for="inlineRadio2"> 否 </label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">文章状态</label>
									<div class="col-sm-9">
										<label class="radio-inline">
											<input type="radio" name="art_type" value="0"  <?php  if($res['art_type'] =='0') { ?> checked="checked" <?php  } ?> > 待审核
										</label>
										<label class="radio-inline">
											<input type="radio" name="art_type" <?php  if($res['art_type'] =='1' || !$res) { ?> checked="checked" <?php  } ?>  value="1"> 已通过
										</label>
										<label class="radio-inline">
											<input type="radio" name="art_type" <?php  if($res['art_type'] =='2' ) { ?> checked="checked" <?php  } ?> value="2"> 未通过
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">是否显示</label>
									<div class="col-xs-12 col-sm-8">
										<div class="radio radio-success radio-inline">
											<input type="radio" id="status1" name="display" <?php  if($res['display'] =='1' || !$res) { ?> checked="checked" <?php  } ?> value="1">
											<label for="inlineRadio1"> 是 </label>
										</div>
										<div class="radio radio-success radio-inline">
											<input type="radio" id="status2" <?php  if($res['display'] =='0' ) { ?> checked="checked" <?php  } ?> name="display" value="0" >
											<label for="inlineRadio2"> 否 </label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group col-sm-12">
						<input type="hidden" name="id" value="<?php  echo $id;?>" />
						<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					</div>
					</from>

			</div>
		</div>
	</div>
</div>
</div>
</div>
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
<script type="text/javascript">
	$("#category_parent").on("change",function(){
    
     var id = $(this).val()
     //查询二级
        $.post("/index.php?c=site&a=entry&do=team&op=ajax&type=all&m=hyb_yl&id="+id,{id:id},function (res) {
              
                $("select[name='keshi_two']").empty();
                var html = "<option value='0'>请选择二级分类</option>";
                $(res).each(function (v, k) {

                    html += "<option value='" + k.id + "'>" + k.name + "</option>";
                });
                //把遍历的数据放到select表里面
                $("select[name='keshi_two']").append(html);

            },'json');
    }); 
</script>
<script src="<?php  echo HYB_YL_ADMIN?>/js/doctor.js" type="text/javascript"></script>

<script src="<?php  echo HYB_YL_ADMIN?>/js/user.js" type="text/javascript"></script>
</body>
</html>