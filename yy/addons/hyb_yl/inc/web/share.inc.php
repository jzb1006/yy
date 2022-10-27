<?php
 class Share extends HYBPage
 { 
	//分类列表
	 public function catelist()
	{
		global $_W, $_GPC;
		$type_id = $_GPC['type_id'];
		$op ='share_cate';
		include $this->template("share/share_cate");
	}
	//添加/修改分类
	 public function addcate()
	{
		global $_W, $_GPC;
		$type_id = $_GPC['type_id'];
		$op ='share_cate';
		include $this->template("share/add_cate");
	}
	//分享列表
	 public function sharelist()
	{
		global $_W, $_GPC;
		$op ='share_list';
		$type_id = $_GPC['type_id'];
		$model = Model('share'); 
		$uniacid = $_W['uniacid'];
		$tab1=$model->tablename("share");
		$tab2=$model->tablename("userinfo");
		$where="uniacid=$uniacid"; 
		$sql="SELECT DISTINCT $tab1.openid,$tab1.*,$tab2.openid AS u_openid,$tab2.u_name FROM $tab1 LEFT JOIN $tab2 ON $tab1.openid=$tab2.openid  WHERE $tab1.uniacid='".$uniacid."' order by $tab1.times DESC";
		$page=$model->pagenation($sql);
		$list=$page['dataset'];
		foreach ($list as $key => $value) {
			$list[$key]['pic'] =  unserialize($list[$key]['sharepic']);
		}
		if($_W['isajax']){
			switch ($_GPC['type']) {
				case 'del_one':
			    	$id=intval($_GPC['id']); 
			        $res=$model->delete("a_id=$id and uniacid=$uniacid ");
					break;
				case 'del':
				    $values =$_GPC['values'];
			        foreach ($values as $key => $value) {
			        	 $id=intval($value); 
			             $res=$model->delete("a_id=$id and uniacid=$uniacid ");
			        }
					break;
				case 'rec':
				    $values =$_GPC['values'];
			        foreach ($values as $key => $value) {
			        	 $id=intval($value); 
			        	 $data =array(
			                  'share_tj' =>1
			        	 	);
			             $res=$model->where("a_id=$id and uniacid=$uniacid")->save($data);
			         }
					break;
				case 'norec':
				    $values =$_GPC['values'];
			        foreach ($values as $key => $value) {
			        	 $id=intval($value); 
			        	 $data =array(
			                  'share_tj' =>0
			        	 	);
			             $res=$model->where("a_id=$id and uniacid=$uniacid")->save($data);

			        }
					break;
				case 'ups':
				    $values =$_GPC['values'];
	                foreach ($values as $key => $value) {
	                	 $id=intval($value); 
	                	 $data =array(
	                          'type' =>1
	                	 	);
			             $res=$model->where("a_id=$id and uniacid=$uniacid")->save($data);

	                }
					break;
				case 'noups':
				    $values =$_GPC['values'];
	                foreach ($values as $key => $value) {
	                	 $id=intval($value); 
	                	 $data =array(
	                          'type' =>0
	                	 	);
			             $res=$model->where("a_id=$id and uniacid=$uniacid")->save($data);

	                }
					break;
			}
			message(error(0, $res), '', 'ajax'); 
	    }
		include $this->template("share/share_list");
	}

    //删除分类

	//添加/修改分享
	 public function addshare()
	{
		    global $_W, $_GPC;
		    $op ='share_list';
		    $type_id = $_GPC['type_id'];
		    $uniacid = $_W['uniacid'];
		    $model= new Model('share');
			$a_id = intval($_GPC['a_id']);
			$res = $model->where("a_id = $a_id and uniacid=$uniacid")->get('*');
		    $res['sharepic'] =unserialize($res['sharepic']);
			$data =array(
			      'uniacid'  => $_W['uniacid'],
			      'openid'   => $_GPC['openid'],
			      'shartitle'=> $_GPC['shartitle'],
			      'contents' => $_GPC['contents'],
			      'sharepic' => serialize($_GPC['sharepic']),
			      'times'    => strtotime('now'),
			      'dianj'    => $_GPC['dianj'],
			    );
		    if($_W['ispost']){
				if($a_id){
					 $model->where("a_id=$a_id and uniacid=$uniacid")->save($data);
					 message('成功', 'refresh', 'success');
		             //message("编辑成功!",$this->copysiteUrl("share.sharelist"),"success");
				}else{
					 $model->add($data);
					 message('成功', 'refresh', 'success');
					 //message("添加成功",$this->copysiteUrl("share.sharelist"),"success");
				}
			  
		    }
		include $this->template("share/add_share");
	}
	//删除分享

	//审核分享
}
