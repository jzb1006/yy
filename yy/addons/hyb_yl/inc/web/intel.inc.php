<?php 

	global $_W,$_GPC;
	require_once dirname(__FILE__) .'/Data/pdo.class.php';
	$model = new Model('zhenzhuang');
	$yzhen = new Model('intelyuzhen');
	$yao = new Model('goodsfenl');
	$dd_doc = new Model('category');
	$goodsarr = new Model('goodsarr');
	$zhuanjia = new Model('zhuanjia');
	$uniacid =$_W['uniacid'];
	$type_id = $_GPC['type_id'];
	$op = 'intel';
	$val = isset($_GPC['val'])?$_GPC['val']:'list';
	$tab1=$model->tablename("intelyuzhen");
	$tab2=$model->tablename("zhenzhuang");
	if($val=='list'){
		$sql="SELECT * from $tab2 where uniacid='".$uniacid."' and pid !='-1'";
		$page=$model->pagenation($sql);
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
			                  'enabled' =>1
			        	 	);
			             $res=$model->where("id=$id and uniacid=$uniacid")->save($data);
			         }
					break;
				case 'norec':
				    $values =$_GPC['values'];
			        foreach ($values as $key => $value) {
			        	 $id=intval($value); 
			        	 $data =array(
			                  'enabled' =>0
			        	 	);
			             $res=$model->where("id=$id and uniacid=$uniacid")->save($data);
			        }
					break;
			}
			message(error(0, $res), '', 'ajax'); 
	    }
	}
	if($val=='add'){
		$id =$_GPC['id'];
		$where ="uniacid='{$uniacid}' and pid!='-1'";
		$categories = $model->where($where)->getall();

		$categ = $dd_doc->where("uniacid='{$uniacid}' and parentid=0")->getall();
		foreach ($categ as $key => $value) {
			$pid = $value['id'];
			$categ[$key]['parent'] = $dd_doc->where("uniacid='{$uniacid}' and parentid='".$pid."'")->getall('id,name');
		}
		//var_dump($categ);exit();
        $drugs  = $yao->where("uniacid='{$uniacid}'")->getall();

        $sql ="SELECT $tab1.pid AS pp_id,$tab1.*,$tab2.id,$tab2.pid,$tab2.name from $tab1 LEFT JOIN $tab2 ON $tab2.id = $tab1.pid WHERE $tab1.uniacid='".$uniacid."' and $tab1.pid = '".$id."' limit 1";
        $res = pdo_fetch($sql);
        $i_id = $res['i_id'];
        $start=unserialize($res['start']);
        $last=unserialize($res['last']);
        $suggest=unserialize($res['suggest']);
        $yp=unserialize($res['yp']);
        $ys=unserialize($res['ys']);
        $ypname=unserialize($res['ypname']);
        $ysname=unserialize($res['ysname']);
        //分数区间
        foreach ($start as $key => $value) {
			$num[$key]['start']=$start[$key];  
			$num[$key]['last']=$last[$key];
			$num[$key]['suggest']=$suggest[$key];
			$num[$key]['yp']=$yp[$key];
			$num[$key]['ys']=$ys[$key];
			$num[$key]['ypname']=$ypname[$key];
			$num[$key]['ysname']=$ysname[$key];
		}
		foreach ($num as $key => $value) {
			$dd_yp= explode(',', $num[$key]['yp']);
			$dd_ys = explode(',', $num[$key]['ys']);
			foreach ($dd_yp as $key1 => $value1) {
				$sname = $goodsarr->where("sid='{$value1}'")->getall('sname');
				$num[$key]['dd_yp']=implode(',',$sname);
			}
			foreach ($dd_ys as $key2 => $value2) {
				$num[$key]['dd_ys']=$goodsarr->where("sid='{$value2}'")->getall('sname');
			}
		}

        $spec_items = json_decode($res['spec'],true);
        $result2 = [];
          array_map(function ($value) use (&$result2) {
            $result2 = array_merge($result2, array_values($value));
         }, $spec_items);  
        if($_W['isajax'] && $_GPC['type']=='sel'){
           $pid =$_GPC['pid'];
           $res = $yzhen->where('pid="'.$pid.'" and uniacid="'.$uniacid.'"')->get();
           if($res){
           	 message(error(0, $res), '', 'ajax'); 
           	}else{
           	 message(error(1, $res), '', 'ajax'); 
           	}
          
        }
        if($_W['isajax'] && $_GPC['type']=='all'){
	        $drugs  = $yao->where("uniacid='{$uniacid}' and parentid=0")->getall();
			foreach ($drugs as $key => $value) {
				$pp_id = $value['id'];
				$drugs[$key]['parent'] = $model->where("uniacid='{$uniacid}' and pid='{$pp_id}'")->getall();
			}
			$data =array(
            'drugs'=>$drugs,
            'doctor'=>$drugs
			);
			message(error(1, $data), '', 'ajax'); 
        }
        if($_W['isajax'] && $_GPC['type']=='drug'){
        	$fid  = $_GPC['fid'];
	        $res  = $goodsarr->where("uniacid='{$uniacid}' and g_id='".$fid."'")->getall('sid,sname');
			message(error(1, $res), '', 'ajax'); 
        } 
        if($_W['isajax'] && $_GPC['type']=='doctor'){
        	$parentid  = $_GPC['parentid'];
	        $res  = $zhuanjia->where("uniacid='{$uniacid}' and parentid='".$parentid."'")->getall('zid,z_name');
			message(error(1, $res), '', 'ajax'); 
        }  
		if($_W['ispost']){
		       if ($_GPC['spec']) {
		            $spec_post = $_GPC['spec'];
		            $spec = json_encode($spec_post,JSON_UNESCAPED_UNICODE); // 压缩
		        }
		      $data =array(
	              'uniacid'  => $_W['uniacid'],
	              'spec'     => $spec,
	              'start'    => serialize($_GPC['start']),
	              'last'     => serialize($_GPC['last']),
	              'suggest'  => serialize($_GPC['suggest']),
	              'yp'       => serialize($_GPC['ypid']),
	              'ys'       => serialize($_GPC['ysid']),
	              'pid'      => $_GPC['pid'],//二
	              'ypname'   => serialize($_GPC['ypname']),
	              'ysname'   => serialize($_GPC['ysname']),
		      	);

	             if(empty($res)){
	                $yzhen->add($data);
	                message('成功', 'refresh', 'success');
	             }else{
	             	$yzhen->where('i_id="'.$i_id.'" and pid="'.$id.'" and uniacid="'.$uniacid.'"')->save($data);
	             	message('成功', 'refresh', 'success');
	           }

		}
	}

   include $this->template('intel/intel');
	
