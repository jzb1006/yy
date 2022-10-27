 <?php

 class Butsite extends HYBPage
 { 
   
 	public function but_site(){ 
    	global $_W, $_GPC;
    	$op = 'but_site';
        $uniacid =$_W['uniacid'];
        $model = Model('columnmenu');
        $where ="uniacid=$uniacid";
        $res = $model->where($where)->get('*');
	    $id = $_GPC['id'];
	    $type_id = $_GPC['type_id'];
        $data =array(
        'uniacid' => $uniacid,
        'arr'     => serialize($_GPC['arr']),
        'state'   => $_GPC['state']
      	);
        if($_W['isajax']){
        	switch ($_GPC['type']) {
        		case 'all':
        	    	$res['arr'] = unserialize($res['arr']);
			        message(error(0, $res), '', 'ajax');
        			break;
        		default:
			          if(empty($res['m_id'])){
			              $model->add($data);
			          }else{
			              $model->where("uniacid=$uniacid")->save($data);
			          }
			          $res1 = $model->where($where)->get('*');
			          $res1['arr'] = unserialize($res1['arr']);
			          message(error(0, $res1), '', 'ajax');
        			  break;
        	}

        }
 		include $this->template("butsite/but_site");
 	} 
 	public function cx_site(){ 
    	global $_W, $_GPC;
        $uniacid =$_W['uniacid'];
        $type_id = $_GPC['type_id'];
        $op = 'cx_site';
		load()->func('tpl');
		load()->func('file'); //调用上传函数
		$dir_url=$_SERVER['DOCUMENT_ROOT'].'/web/cert/'; //上传路径
		mkdirs($dir_url); 
		//创建目录
		if ($_FILES["upfile"]["name"]){
			$upfile=$_FILES["upfile"]; 
			//获取数组里面的值 
			$name=$upfile["name"];//上传文件的文件名 
			$size=$upfile["size"];//上传文件的大小 
			if($size>2*1024*1024) {  
				message("文件过大，不能上传大于2M的文件!",$this->createWebUrl("pay",array("op"=>"display")),"success"); 
				exit();  
			} 
			if(file_exists($dir_url))@unlink ($dir_url);

			$cfg['upfile']=TIMESTAMP.".pem";
			move_uploaded_file($_FILES["upfile"]["tmp_name"],$dir_url.$upfile["name"]); //移动到目录下
			$upfiles = $dir_url.$name;
			
		}
		if ($_FILES["keypem"]["name"]){
			$upfile=$_FILES["keypem"]; 
			//获取数组里面的值 
			$name=$upfile["name"];//上传文件的文件名 
			//$type=$upfile["type"];//上传文件的类型 
			$size=$upfile["size"];//上传文件的大小 
			if($size>2*1024*1024) {  
				message("文件过大，不能上传大于2M的文件!",$this->createWebUrl("pay",array("op"=>"display")),"success");  
				exit();  
			}  	
			if(file_exists($dir_url))@unlink ($dir_url);
			move_uploaded_file($_FILES["keypem"]["tmp_name"],$dir_url.$upfile["name"]); //移动到目录下
			$keypems = $dir_url.$name;

		}
		$model = Model('parameter');
		$where = "uniacid=$uniacid"; 
		$res   = $model->where($where)->get('*');
		if($_W['ispost']){
			$data = array(
				"uniacid"  => $uniacid,
				"appid"    => $_GPC['appid'],
				"appsecret"=> $_GPC['appsecret'],
				"mch_id"   => $_GPC['mch_id'],
				"appkey"   => $_GPC['appkey'],
				'upfile'   => $upfiles,
				'keypem'   => $keypems,
				'pub_appid'=> $_GPC['pub_appid'],
				'pub_api'  => $_GPC['pub_api'],
				);
			if (empty($res)) {
				$model->add($data);
			}
			else
			{
				$model->where("uniacid=$uniacid")->save($data);
				
			}
			message('成功', 'refresh', 'success');
		}
		include $this->template("butsite/cx_site");
 	} 
 	// public function saveSetting(){
 	// 	global $_W,$_GPC;
 	// 	$uniacid=intval($_W['uniacid']);
 	// 	$model=Model("setting");
      
 	// 	$setting=Model("setting")->where("uniacid=$uniacid")->get();
 	// 	$set=array(
 	// 		"uniacid"=>$uniacid,
 	// 		"tplid"=>$_GPC['tplid'],
 	// 		"appid"=>$_GPC['appid'],
 	// 		"secret"=>$_GPC['secret']
 	// 	);
 	// 	if(empty($setting)){
 	// 		$model->add($set);
 	// 	}else{
 	// 		$model->where("uniacid=$uniacid")->save($set);
 	// 	}
  //     message("保存成功",$this->routeUrl("setting.index"));
 	// }
}
?> 