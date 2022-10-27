 <?php
 class Remind extends HYBPage
 { 

 	public function admin_tx(){ 
    	global $_W, $_GPC;
    	$op = 'admin_tx';
    	$uniacid = $_W['uniacid'];
    	$type_id = $_GPC['type_id'];
    	$model = Model('duanxin');
    	$res =$model->where("uniacid=$uniacid")->get();
    	$data =array(
            'uniacid' => $_W['uniacid'],
            'key'     => $_GPC['key'],
            'scret'   => $_GPC['scret'],
            'qianming'=> $_GPC['qianming'],
            'templateid'=> $_GPC['templateid'],
            'tel'     => $_GPC['tel'],
            'stadus'   =>$_GPC['stadus']
    		);
    	if($_W['ispost']){
	 		if(empty($res)){
	 			$model->add($data);
	 		}else{
	 			$model->where("uniacid=$uniacid")->save($data);
	 		}
	 		message("保存成功",$this->copysiteUrl("remind.admin_tx"),'success');
    	}
 		include $this->template("remind/admin_tx");
 	} 
 	public function user_tx(){ 
    	global $_W, $_GPC;
        $uniacid =$_W['uniacid'];
        $op = 'user_tx';
        $model = Model('userdxin');
        $type_id = $_GPC['type_id'];
        $wxmodel = Model('wxapptemp');
        $val = isset($_GPC['val'])?$_GPC['val']:'user_dx';
        if($val =='user_dx'){
	    	$res =$model->where("uniacid=$uniacid")->get();
	    	$data =array(
	            'uniacid' => $_W['uniacid'],
	            'key'     => $_GPC['key'],
	            'scret'   => $_GPC['scret'],
	            'qianming'=> $_GPC['qianming'],
	            'moban_id'=> $_GPC['moban_id'],
	            'cfmb'    => $_GPC['cfmb'],
	            'tel'     => $_GPC['tel'],
	            'stadus'  => $_GPC['stadus']
	    		);
	    	if($_W['ispost']){
		 		if(empty($res)){
		 			$model->add($data);
		 		}else{
		 			$model->where("uniacid=$uniacid")->save($data);
		 		}
		 		message('成功', 'refresh', 'success');
		 		//message("保存成功",$this->copysiteUrl("remind.user_tx"),'success');
	    	}
        }else{
	    	$res =$wxmodel->where("uniacid=$uniacid")->get();
	    	$data =array(
	            'uniacid'  => $_W['uniacid'],
	            'doctemp'  => $_GPC['doctemp'],
	            'weidbb'   => $_GPC['weidbb'],
	            'cforder'  => $_GPC['cforder'],
	            'paymobel' => $_GPC['paymobel'],
	            'kzyytongz'=> $_GPC['kzyytongz'],
	            'tixuser'  => $_GPC['tixuser'],
	            'yqtemp'   => $_GPC['yqtemp'],
	            'jujyaoqi' => $_GPC['jujyaoqi'],
	            'qiany'    => $_GPC['qiany'],
	            'txtempt'  => $_GPC['txtempt']
	    		);
	    	if($_W['ispost']){
		 		if(empty($res)){
		 			$wxmodel->add($data);
		 		}else{
		 			$wxmodel->where("uniacid=$uniacid")->save($data);
		 		}
		 		message('成功', 'refresh', 'success');
		 		//message("保存成功",$this->copysiteUrl("remind.user_tx").'&val=user_wx','success');
	    	}
        }
 		include $this->template("remind/user_tx");
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