<?php
 class Patient extends HYBPage
 { 
	
	 public function listcate()
	{
		global $_W, $_GPC;
		$op ='list_cate';
		$type_id = $_GPC['type_id'];
		$uniacid =$_W['uniacid'];
		$where="uniacid=$uniacid"; 
		$model =Model('hjfenl');
		$page=$model->where($where)->page("*");
		$list=$page['dataset'];
		if($_W['isajax']){
			switch ($_GPC['type']) {
				case 'del_one':
	            	$hj_id=intval($_GPC['id']); 
		            $res=$model->delete("hj_id=$hj_id and uniacid=$uniacid ");
					break;
				case 'del':
				    $values =$_GPC['values'];
	                foreach ($values as $key => $value) {
	                	 $hj_id=intval($value); 
			             $res=$model->delete("hj_id=$hj_id and uniacid=$uniacid ");
	                }
					break;
			}
	         
	       message(error(0, $_GPC['type']), '', 'ajax');  
		}
		include $this->template("patient/list_cate");
	}

	//添加/修改分类
	 public function addcate()
	{
		global $_W, $_GPC;
		$op ='list_cate';
		$uniacid = $_W['uniacid'];
		$model=Model("hjfenl"); 
	    $hj_id =intval($_GPC['hj_id']);
	    $type_id = $_GPC['type_id'];
		$res = $model->where("hj_id=$hj_id and uniacid=$uniacid")->get('*');
        $data = array(
                'uniacid' => $_W['uniacid'],
                'hj_name' => $_GPC['hj_name'],
                'hj_color'=> $_GPC['hj_color']
        	);
	    if($_W['ispost']){
	 		if($hj_id){
	 			$model->where("hj_id=$hj_id and uniacid=$uniacid")->save($data);
	 			//message("修改成功",$this->copysiteUrl("patient.listcate"),"success");
	 			message('成功', 'refresh', 'success');
	 		}else{
	 			$model->add($data);
	 			//message("添加成功",$this->copysiteUrl("patient.listcate"),"success");
	 			message('成功', 'refresh', 'success');
	 		}
		  
	    }
		include $this->template("patient/add_cate");
	}

	 public function listhj()
	{
		global $_W, $_GPC;
		$op ='list_hj';
		$model=Model('hjiaosite'); 
		$uniacid = $_W['uniacid'];
		$type_id = $_GPC['type_id'];
		$tab1=$model->tablename("hjiaosite");
		$tab2=$model->tablename("hjfenl");
		$uid =$_W['uid'];
		$where="uniacid=$uniacid"; 
		$sql="SELECT DISTINCT $tab1.h_flid,$tab1.*,$tab2.hj_id,$tab2.hj_name FROM $tab1 LEFT JOIN $tab2 ON $tab1.h_flid=$tab2.hj_id  WHERE $tab1.uniacid='".$uniacid."' and $tab1.uid='".$uid."'  order by $tab1.sfbtime DESC";
		$page=$model->pagenation($sql);
		$list=$page['dataset'];
		if($_W['isajax']){
		switch ($_GPC['type']) {
			case 'del_one':
		    	$id=intval($_GPC['id']); 
		        $res=$model->delete("h_id=$id and uniacid=$uniacid ");
				break;
			case 'del':
			    $values =$_GPC['values'];
		        foreach ($values as $key => $value) {
		        	 $id=intval($value); 
		             $res=$model->delete("h_id=$id and uniacid=$uniacid ");
		        }
				break;
			case 'rec':
			    $values =$_GPC['values'];
		        foreach ($values as $key => $value) {
		        	 $id=intval($value); 
		        	 $data =array(
		                  'h_shen' =>1
		        	 	);
		             $res=$model->where("h_id=$id and uniacid=$uniacid")->save($data);
		         }
				break;
			case 'norec':
			    $values =$_GPC['values'];
		        foreach ($values as $key => $value) {
		        	 $id=intval($value); 
		        	 $data =array(
		                  'h_shen' =>0
		        	 	);
		             $res=$model->where("h_id=$id and uniacid=$uniacid")->save($data);

		        }
				break;
		}
		 
		    message(error(0, $res), '', 'ajax');  
		}
		include $this->template("patient/list_hj");
	}
	//添加患教
	 public function addhj()
	{
		global $_W, $_GPC;
		$op ='list_hj';
		$h_id = intval($_GPC['h_id']);
		$uniacid = $_W['uniacid'];
		$model= Model('hjiaosite'); 
		$cate = Model('hjfenl');
		$where="uniacid=$uniacid"; 
		$ca=$cate->where($where)->page("*");
		$cate_list=$ca['dataset']; 
        $type_id = $_GPC['type_id'];
		$res = $model->where("h_id=$h_id and uniacid=$uniacid")->get('*');
        
		$data =array(
		      'uniacid'   => $_W['uniacid'],
		      'h_title'   => $_GPC['h_title'],
		      'h_pic'     => $_GPC['h_pic'],
		      'h_type'    => $_GPC['h_type'],
		      'h_text'    => $_GPC['h_text'],
		      'h_flid'    => $_GPC['h_flid'],
		      'h_video'   => $_GPC['h_video'],
		      'audios'    => $_GPC['audios'],
		      'sfbtime'   => strtotime('now'),
		      'h_leixing' => $_GPC['h_leixing'],
		      'uid'       => $_W['uid'],
		      'zid'       => $_GPC['info']['zid'],
		      'z_name'    => $_GPC['info']['z_name'],
		    );

		if($_W['ispost']){
				if($h_id){
					 $model->where("h_id=$h_id and uniacid=$uniacid")->save($data);
		             //message("编辑成功!",$this->copysiteUrl("patient.listhj"),"success");
		             message('成功', 'refresh', 'success');
				}else{
					 $model->add($data);
					 //message("添加成功",$this->copysiteUrl("patient.listhj"),"success");
					 message('成功', 'refresh', 'success');
				}
		  
		}
		include $this->template("patient/add_hj");
	}
}
