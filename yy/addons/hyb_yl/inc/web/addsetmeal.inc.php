<?php 
	global $_W,$_GPC;
	require_once dirname(__FILE__) .'/Data/pdo.class.php';
	$model = new Model('medicaltype');
	$uniacid =$_W['uniacid'];
    $op = isset($_GPC['op'])?$_GPC['op']:'fenlei';
    $type_id = $_GPC['type_id'];
	if($op =='fenlei'){
        $where = "uniacid=$uniacid";
        $list  = $model->where($where)->order(`sord`)->getall();
        foreach ($list as $key => $value) {
        	$list[$key]['f_thumb'] =$_W['attachurl'].$list[$key]['f_thumb'];
        }
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
                          'state' =>1
                	 	);
		             $res=$model->where("id=$id and uniacid=$uniacid")->save($data);
                 }
				break;

			case 'norec':
			    $values =$_GPC['values'];
                foreach ($values as $key => $value) {
                	 $id=intval($value); 
                	 $data =array(
                          'state' =>0
                	 	);
		             $res=$model->where("id=$id and uniacid=$uniacid")->save($data);

                }
				break;
			}
            message(error(0, $res), '', 'ajax');  
	   }
        include $this->template('addsetmeal/list');
	}
    if($op=='guhaosite'){
        $z_pid = $_GPC['z_pid'];
        $rows = pdo_fetch('SELECT * FROM'.tablename('hyb_yl_tjyytime')."where uniacid ='{$uniacid}' and z_pid='{$z_pid}'");
        $rows['text'] =unserialize($rows['text']);
        $neardate = date("Y-m-d",strtotime("+1 days"));
        $weekarray = array("周日","周一","周二","周三","周四","周五","周六");
        $wee_time =array();
         foreach ($rows['text'] as $k => $v) {
           $wee_n[] = explode(',', $v['week']);
           $wee_time = $v['time'];
        }
        $result2 = [];
          array_map(function ($value) use (&$result2) {
            $result2 = array_merge($result2, array_values($value));
         }, $wee_n);

    	if(checksubmit("submit")){
            //选中的星期
    	    $wee = $_GPC['chk'];

    	    $wee_string = implode(',',$wee);
            //时间段
            $endtime  =$_GPC['endtime'];
            $startime =$_GPC['startime'];
            $nums     =$_GPC['num'];
			foreach ($startime as $key => $value) {
				$newdate[$key]['startime']=$startime[$key];
				$newdate[$key]['endtime']=$endtime[$key];  
				$newdate[$key]['num']=$nums[$key];
			}
            //数组合并
			foreach ($wee as $k1 => $v1) {
				$arithmetic[$k1]['week'] =$v1;
				$arithmetic[$k1]['time'] =$newdate;
			}
		    $text = serialize($arithmetic);
            $add = array('uniacid'=>$uniacid,'week'=>$wee_string,'nums'=>$g,'z_pid'=>$z_pid,'shengyunus'=>$g,'nums'=>$_GPC['nums'],'text'=>$text,'time'=>date('Y-m-d',time()));
			if(!empty($rows['tid'])){
               //更新
				pdo_update('hyb_yl_tjyytime',$add,array('tid'=>$rows['tid']));
                message('成功', 'refresh', 'success');
			}else{
		    	//添加
		    	pdo_insert('hyb_yl_tjyytime',$add);
		    	message('成功', 'refresh', 'success');
			}

            
     }
       include $this->template('addsetmeal/guhaosite');
    }
	if($op =='add'){
    $where="uniacid=$uniacid"; 
	$cate = $model->where($where)->page("*");
	$cate_list = $cate['dataset'];
	$id = intval($_GPC['id']);
	$res = $model->where("id=$id and uniacid=$uniacid")->get('*');
    // $res['f_thumb'] =unserialize($res['f_thumb']);
	$data =array(
	      'uniacid'    => $_W['uniacid'],
	      'f_name'     => $_GPC['f_name'],
	      'f_thumb'    => $_GPC['f_thumb'],
	      't_thumb'    => $_GPC['t_thumb']
	    );
	    if($_W['ispost']){
	 		if($id){
	 			$model->where("id=$id and uniacid=$uniacid")->save($data);
	 			message('成功', 'refresh', 'success');
	 		}else{
	 			$model->add($data);
	 			message('成功', 'refresh', 'success');
	 		}
	    }
       include $this->template('addsetmeal/add');
	}
	if($op =='city'){
	 $city = new Model('tijiancity');
     $where="uniacid=$uniacid"; 
     $res = $city->where($where)->getall();
	 foreach ($res as $key => $value) {
 		$o.="<li data-ct_id=".$value['ct_id'].">";
 		$o.="<div class=\"city1\"><i class=\"layui-icon layui-icon-location\"></i>".$value['ct_name']."</div>";
 		$o.="<div class=\"cityModify\"><i class=\"layui-icon layui-icon-set-fill\"></i>";
 		$o.="<div class=\"btnBox1\" style=\"display: none;\">";
 		$o.="<div class=\"modify\" data-ct_id=".$value['ct_id']."><i class=\"layui-icon layui-icon-edit\"></i>修改</div>";
 		$o.="<div class=\"remove\" data-ct_id=".$value['ct_id']."><i class=\"layui-icon layui-icon-delete\"></i>删除</div>";
 		$o.="</div>";
 		$o.="</div>";
 		$o.="</li>";
 	}
    
 

	 if($_W['isajax']){
        $data = array(
              'uniacid' => $uniacid,
              'ct_name' => $_GPC['ct_name'],
        	);
	 	if($_GPC['type'] =='add'){
            $city->add($data);
		 	$row = $city->where("uniacid='".$uniacid."' order by ct_id desc ")->get();
	        echo json_encode($row);
	        return false;
	 	 }
	 	if($_GPC['type'] =='update'){
            $city->where('ct_id="'.$_GPC['ct_id'].'"')->save($data);
	 	 }
	 	if($_GPC['type'] =='delete'){
            $city->where('ct_id="'.$_GPC['ct_id'].'"')->delete();
	 	 }
	 	if($_GPC['type'] =='addjg'){
	 	 	$jg_pid = $_GPC['jg_pid'];
	 	 	$jgdata=array(
              'uniacid' => $uniacid,
              'jg_name' => $_GPC['jg_name'],
              'jg_pid'  => $_GPC['jg_pid'],
              'jg_address' => $_GPC['jg_address'],
	 	 		);
            $jglist = new Model('jglist');
		 	$jglist->add($jgdata);
		 	$row = $jglist->where("uniacid='".$uniacid."' and jg_pid='".$jg_pid."' order by j_id desc ")->get();
	        echo json_encode($row);
	        return false;
	 	 }
	 	 if($_GPC['type'] =='jg_list'){
	 	 	$jg_pid = $_GPC['jg_pid'];
            $jglist = new Model('jglist');
		 	$row = $jglist->where("uniacid='".$uniacid."' and jg_pid='".$jg_pid."' ")->getall();
	        echo json_encode($row);
	        return false;
	 	 }
		if($_GPC['type'] =='up_name'){
	 	 	$j_id = $_GPC['j_id'];
	 	 	$date = array(
               'jg_name' =>$_GPC['jg_name']
	 	 		);
            $jglist = new Model('jglist');
            $row  = $jglist->where('j_id="'.$j_id.'" and uniacid="'.$uniacid.'"')->save($date);
	        echo json_encode($row);
	        return false;
		}
		if($_GPC['type'] =='up_address'){
	 	 	$j_id = $_GPC['j_id'];
	 	 	$date = array(
               'jg_address' =>$_GPC['jg_address']
	 	 		);
            $jglist = new Model('jglist');
            $row  = $jglist->where('j_id="'.$j_id.'" and uniacid="'.$uniacid.'"')->save($date);
	        echo json_encode($row);
	        return false;
		}
		if($_GPC['type'] =='delete_jg'){
	 	 	$j_id = $_GPC['j_id'];
            $jglist = new Model('jglist');
            $row  = $jglist->where('j_id="'.$j_id.'" and uniacid="'.$uniacid.'"')->delete();
	        echo json_encode($row);
	        return false;
		}

	 }
	 include $this->template('addsetmeal/city');
	}
	
	
