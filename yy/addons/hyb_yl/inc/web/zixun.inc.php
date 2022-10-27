<?php 
	global $_W,$_GPC;

	require_once dirname(__FILE__) .'/Data/pdo.class.php';
    $op = isset($_GPC['op'])?$_GPC['op']:'zixun';
    $model= new Model('zixun');
    $goods = new Model('zixun_type');
    $uniacid = $_W['uniacid'];
    $type_id = $_GPC['type_id'];
	if($op =='zixun'){
		$tab1=$model->tablename("zixun");
		$tab2=$model->tablename("zixun_type");
		$sql="SELECT DISTINCT $tab1.p_id,$tab1.*,$tab2.zx_id,$tab2.zx_name FROM $tab1 LEFT JOIN $tab2 ON $tab1.p_id=$tab2.zx_id WHERE $tab1.uniacid='".$uniacid."' order by $tab1.time DESC";
		$page=$model->pagenation($sql);
		$page['last']=$sql;
		$list=$page['dataset'];
	if($_W['isajax']){
		switch ($_GPC['type']) {
			case 'del_one':
            	$id=intval($_GPC['id']); 
	            $res=$model->delete("id=$id and uniacid=$uniacid ");
				break;
			case 'del':
			    $values =$_GPC['values'];
                foreach ($values as $key => $value) {
                	 $id=intval($value); 
		             $res=$model->delete("id=$id and uniacid=$uniacid ");
                }
				break;
			case 'rec':
			    $values =$_GPC['values'];
                foreach ($values as $key => $value) {
                	 $id=intval($value); 
                	 $data =array(
                          'status' =>1
                	 	);
		             $res=$model->where("id=$id and uniacid=$uniacid")->save($data);
                 }
				break;

			case 'norec':
			    $values =$_GPC['values'];
                foreach ($values as $key => $value) {
                	 $id=intval($value); 
                	 $data =array(
                          'status' =>0
                	 	);
		             $res=$model->where("id=$id and uniacid=$uniacid")->save($data);

                }
				break;
		}
         
            message(error(0, $res), '', 'ajax');  
	}
        include $this->template('zixun/list');
	}

	if($op =='add'){
	     require_once dirname(dirname(dirname(__FILE__)))."/class/Segmentation.class.php";
	     iconv('GB2312','UTF-8',$_GPC['zx_names']); 
	     $kew = new Segmentation();
	     $title = $kew->spStr($_GPC['zx_names']);
         $title_fu =implode(',', $title);
	     $where="uniacid=$uniacid"; 
		 $cate = $goods->where($where)->page("*");
		 $cate_list = $cate['dataset'];
		 $id = intval($_GPC['id']);
		 $res = $model->where("id=$id and uniacid=$uniacid")->get('*');
	     $res['spic'] =unserialize($res['spic']);
		 $state =$_GPC['state'];

		$data =array(
		      "time"      => date("Y-m-d",time()),
		      'uniacid'   => $_W['uniacid'],
		      'zx_names'  => $_GPC['zx_names'],
		      'title'     => $title_fu,
		      'title_fu'  => $_GPC['title_fu'],
		      'thumb'     => $_GPC['thumb'],
		      'status'    => $_GPC['status'],
		      'content'   => $_GPC['content'],
		      'dianj'     => $_GPC['dianj'],
		      'p_id'      => $_GPC['p_id']
		    );

	    if($_W['ispost']){
	 		if($id){
	 			$model->where("id=$id and uniacid=$uniacid")->save($data);
	 		}else{
	 			$model->add($data);
	 		}
	 		message('成功', 'refresh', 'success');
		  //message("编辑成功!",$this->createWebUrl("zixun",array("op"=>"add",'id'=>$id)),"success");
	    }
       include $this->template('zixun/add');
	}
	
