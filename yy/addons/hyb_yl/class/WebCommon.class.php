<?php 

class WebCommon
{	

	static function logUrl($key,$value){
		global $_GPC;
		return self::commonstructUrl($key,$value,array('order','by','istop','shopid','sort','status','sendtype'));
	}	
	
	//共用组合url方法
	static function commonstructUrl($key,$value,$urlarray){
		global $_W,$_GPC;
			foreach($_GPC as $k=>$v){
				if(in_array($k,$urlarray) && $k != $key){
					$str .= '&'.$k.'='.$v;
				}
			}
			$str .= '&'.$key.'='.$value;
		return $_W['siteroot'].'web/index.php?c=site&a=entry&do='.$_GPC['do'].'&op='.$_GPC['op'].'&m='.MODULE.$str;
	}	

	//循环删除数据
	static function deleteDataInWeb($arrayid,$tablename){
		
		global $_W;
		$successnum = 0;
		$failnum = 0;
		if(empty($arrayid)) message('请选择所要删除的内容');
		foreach($arrayid as $k=>$v){
			$res = self::deleteSingleData($v,$tablename);		
			if($res) {
				$successnum ++ ;
			}else{
				$failnum ++;
			}
		}
		return array($successnum,$failnum);
	}

	static function slwl_tpl_form_show_link($name, $value='', $appid='', $param='')
    {
        $s = '';
        if (!defined('TPL_INIT_show_link')) {
            $s = '
            <script type="text/javascript">
                function showLink(elm) {
                    myutil.myShowLink(function(href, permission, param) {
                        var ipt = $(elm).parent().prev();
                        var ipts = $(elm).parent().prev().prev();
                        var ipts_param = $(elm).parent().prev().prev().prev();
                        ipt.val(href);
                        ipts.val(permission);
                        ipts_param.val(param);
                    });
                }
            </script>';
            define('TPL_INIT_show_link', true);
        }
        $s .= '
        <div class="input-group">
            <input type="text" class="layui-input" name="'.$appid.'" value="'.$param.'" style="display: none">
            <input type="text" class="layui-input" name="permission" style="display: none">
            <input type="text" class="layui-input" name="'.$name.'" value="'.$value.'">
            <span class="input-group-btn">
                <a href="javascript:"  class="btn btn-default" onclick="showLink(this)">选择</a>
            </span>
        </div>
        ';
        return $s;
    }
	
	//删除单条数据
	static function deleteSingleData($id,$tablename){		
		global $_W;
		$id = intval($id);
		

		$res = Util::deleteData($id,$tablename);
		
		if( $tablename == 'hyb_yl_page' && $res ){
			
			Util::deleteCache('page',$id);
			
		}elseif( $tablename == 'zofui_countprice_sort' && $res ){
			
			
		}elseif( $tablename == 'hyb_yl_temp' && $res ){
			
			Util::deleteCache('temp','all');
			pdo_delete('hyb_yl_page',array('tempid'=>$id));
			pdo_delete('hyb_yl_bar',array('tempid'=>$id));

		}elseif( $tablename == 'hyb_yl_article' && $res ){
			Util::deleteCache('article',$id);
		
		}elseif( $tablename == 'hyb_yl_artsort' && $res ) {
			Util::deleteCache('artsort','all');
		}
		
		return $res;
	}


	static function simpleUpload(){
   		if(!defined('SIMPLE_UPLOAD')){
   			$s = <<<div
   				<script>
   				$('.simple_upload').on('click',function(){
   					var _this = \$(this);
					require(['jquery', 'util'], function($, util){
			            util.image('',function(data){
			            	_this.find('input[type=hidden]').val(data['url']);
			            	_this.find('img').attr('src',data['url']);
			            });
			        });
   				})
   				</script>

div;
   		}
   		define('SIMPLE_UPLOAD', true);
   		return $s;
	}
	
	//单图上传
 	static function tpl_form_field_image($name, $value = '', $default = '', $options = array()) {
		global $_W;
		if (empty($default)) {
			$default = '';
		}
		$val = $default;
		if (!empty($value)) {
			$val = tomedia($value);
			$isshow = '';
		}else{
			$isshow = 'display:none;';
		}
		if (!empty($options['global'])) {
			$options['global'] = true;
		} else {
			$options['global'] = false;
		}
		if (empty($options['class_extra'])) {
			$options['class_extra'] = '';
		}
		if (isset($options['dest_dir']) && !empty($options['dest_dir'])) {
			if (!preg_match('/^\w+([\/]\w+)?$/i', $options['dest_dir'])) {
				exit('图片上传目录错误,只能指定最多两级目录,如: "deobao_store","deobao_store/d1"');
			}
		}
		$options['direct'] = true;
		$options['multiple'] = false;
		if (isset($options['thumb'])) {
			$options['thumb'] = !empty($options['thumb']);
		}
		$s = '';
		if (!defined('TPL_INIT_IMAGE')) {
			$s = '
			<script type="text/javascript">
				function showImageDialog(elm, opts, options) {
					console.log(elm, opts, options);
					require(["util"], function(util){
						var btn = $(elm);
						var ipt = btn.parent().prev();
						var val = ipt.val();
						var img = ipt.parent().next().children();
						options = '.str_replace('"', '\'', json_encode($options)).';
						util.image(val, function(url){
							if(url.url){
								if(img.length > 0){
									img.get(0).src = url.url;
								}
								ipt.val(url.attachment);
								ipt.attr("filename",url.filename);
								ipt.attr("url",url.url);
								img.parent().show();
							}
							if(url.media_id){
								if(img.length > 0){
									img.get(0).src = "";
								}
								ipt.val(url.media_id);
							}
						}, null, options);
					});
				}
				function deleteImage(elm){
					require(["jquery"], function($){
						$(elm).prev().parent().hide();
						$(elm).parent().prev().find("input").val("");
					});
				}
			</script>';
			define('TPL_INIT_IMAGE', true);
		}

		$s .= '
			<div class="input-group ' . $options['class_extra'] . '">
				<input type="text" name="' . $name . '" value="' . $value . '"' . ($options['extras']['text'] ? $options['extras']['text'] : '') . ' class="form-control" autocomplete="off">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>
				</span>
			</div>
			<div class="input-group ' . $options['class_extra'] . '">
				<img src="' . $val . '"  class="img-responsive img-thumbnail" />
				<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
			</div>';
		return $s;
	}	
	
	static function tpl_form_field_multi_image($name, $value = array(), $options = array()) {
		global $_W;
		$options['multiple'] = true;
		$options['direct'] = false;
        
		$s = '';
		if (!defined('TPL_INIT_MULTI_IMAGE')) {
			$s = '
	<script type="text/javascript">
		function uploadMultiImage(elm) {
			var name = $(elm).next().val();
			util.image("", function(urls){
				$.each(urls, function(idx, url){
					$(elm).parent().parent().next().append(\'<div class="multi-item"><img onerror="this.src=\\\'./resource/images/nopic.jpg\\\'; this.title=\\\'图片未找到.\\\'" src="\'+url.url+\'" class="img-responsive img-thumbnail"><input type="hidden" name="\'+name+\'[]" value="\'+url.attachment+\'"><em class="close" title="删除这张图片" onclick="deleteMultiImage(this)">×</em></div>\');
				});
			}, "", ' . json_encode($options) . ');
		}
		function deleteMultiImage(elm){
			require(["jquery"], function($){
				$(elm).parent().remove();
			});
		}
		function movethistoleft(elm){
			require(["jquery"], function($){
				var patentclass = $(elm).parent();
				if(patentclass.prev().hasClass("multi-item")){
					var thishtml ="<div class=\"multi-item\">"+patentclass.html()+"</div>";
					patentclass.prev().before(thishtml);
					patentclass.remove();
					
				}
			});
		}		
	</script>';
			define('TPL_INIT_MULTI_IMAGE', true);
		}

		$s .= <<<EOF
	<div class="input-group">
		<input type="text" class="form-control" readonly="readonly" value="" placeholder="批量上传图片" autocomplete="off">
		<span class="input-group-btn">
			<button class="btn btn-default" type="button" onclick="uploadMultiImage(this);">选择图片</button>
			<input type="hidden" value="{$name}" />
		</span>
	</div>
	<div class="multi-img-details">
EOF;
		if (is_array($value) && count($value) > 0) {
			foreach ($value as $row) {
				$s .= '
	<div class="multi-item">
		<img src="' . tomedia($row) . '"  class="img-responsive img-thumbnail">
		<input type="hidden" name="' . $name . '[]" value="' . $row . '" >
		<em class="close" title="删除这张图片" onclick="deleteMultiImage(this)">×</em>
	</div>';
			}
		}
		$s .= '</div>';

		return $s;
	}	
	
}


?>