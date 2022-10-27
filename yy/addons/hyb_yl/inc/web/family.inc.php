<?php
/**
* 
*/
class Family extends HYBPage
{
 public function fllist()
 	{
 		global $_GPC, $_W;
    $type_id = $_GPC['type_id'];
 		$uniacid = $_W['uniacid'];
        $op = 'fllist';
        $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_crowd')."where uniacid=$uniacid");
        foreach ($res as $key => $value) {
        	$res[$key]['create_time'] = date('Y-m-d H:i:s',$res[$key]['create_time']);
        }
 		include $this->template("family/fllist");
 	}	

 public function addfl()
 	{
 		global $_GPC, $_W;
    $type_id = $_GPC['type_id'];
        $op = 'fllist';
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $res = pdo_get('hyb_yl_crowd',array('id'=>$id));
        $data = array(
               'uniacid'     => $uniacid,
               'create_time' => strtotime('now'),
               'crowd_name'  => $_GPC['crowd_name'],
               'thumb'       => $_GPC['thumb']
        	);
          if($_W['ispost']){
	         if(!empty($res)){
                pdo_update('hyb_yl_crowd',$data,array('id'=>$id));
                message('成功', 'refresh', 'success');
	         }else{
	         	pdo_insert('hyb_yl_crowd',$data);
	           	message('成功', 'refresh', 'success');
	         }
          }

         
 		include $this->template("family/addfl");
 	}
 public function delfl(){
 		global $_GPC, $_W;
        $op = 'fllist';
        $uniacid = $_W['uniacid'];
        $type_id = $_GPC['type_id'];
        $id = $_GPC['id'];
        pdo_delete('hyb_yl_crowd',array('id'=>$id));
        message('成功', 'refresh', 'success');
        include $this->template("family/addfl");
 }
 public function fwlist()
 	{
 		global $_GPC, $_W;
        $op = 'fwlist';
        $uniacid = $_W['uniacid'];
        $type_id = $_GPC['type_id'];
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename("hyb_yl_fwlist")."where uniacid = '{$uniacid}'");
		$pindex = max(1, intval($_GPC['page'])); 
		$pagesize = 10;
		$p = ($pindex-1) * $pagesize; 
        $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_crowd')."where uniacid=$uniacid");
        $fwlist = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_fwlist')."as a left join".tablename('hyb_yl_crowd')."as b on b.id =a.pid where a.uniacid=$uniacid order by a.ff_id asc limit ".$p.",".$pagesize);
        $pager = pagination($total,$pindex,$pagesize);
        foreach ($fwlist as $key => $value) {
        	$fwlist[$key]['fw_startime'] = date("Y-m-d",$fwlist[$key]['fw_startime']);
        	$fwlist[$key]['fw_endtime'] = date("Y-m-d",$fwlist[$key]['fw_endtime']);
        }
 		include $this->template("family/fwlist");
 	}

 public function addfw()
 	{
 		global $_GPC, $_W;
        $op = 'fwlist';
        $uniacid = $_W['uniacid'];
        $ff_id = $_GPC['ff_id'];
        $type_id = $_GPC['type_id'];
        $fw_neirong = $_GPC['fw_neirong'];

        $fllist = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_crowd')."where uniacid=$uniacid");
        $get_one = pdo_fetch("SELECT * FROM".tablename('hyb_yl_fwlist')."as a left join".tablename('hyb_yl_crowd')."as b on b.id =a.pid where a.uniacid=$uniacid and a.ff_id=$ff_id");
        
        $get_one['fw_neirong'] = unserialize($get_one['fw_neirong']);
        $data = array(
          'uniacid' => $uniacid,
          'fw_name' => $_GPC['fw_name'],
          'fw_money'=> $_GPC['fw_money'],
          'pid'     => $_GPC['pid'],
          'fw_pic'  => $_GPC['fw_pic'],
          'fw_xy'   => $_GPC['fw_xy'],
          'fw_startime' => strtotime($_GPC['time']['start']),
          'fw_endtime'  => strtotime($_GPC['time']['end']),
          'fw_neirong'  => serialize($fw_neirong)
        	);
        if($_W['ispost']){
         
          if(empty($ff_id)){
            pdo_insert('hyb_yl_fwlist',$data);
            message('成功', 'refresh', 'success');
          }else{
            pdo_update('hyb_yl_fwlist',$data,array('ff_id'=>$ff_id));
            message('成功', 'refresh', 'success');
          }
        }
        
 		include $this->template("family/addfw");
 	}
	 public function deletefw(){
 		global $_GPC, $_W;
        $op = 'fwlist';
        $uniacid = $_W['uniacid'];
        $ff_id = $_GPC['ff_id'];
        $type_id = $_GPC['type_id'];
        pdo_delete('hyb_yl_fwlist',array('ff_id'=>$ff_id));
        message('成功', 'refresh', 'success');
        include $this->template("family/fwlist");
	 }
	 //筛选
	 public function selectinfo(){
 		global $_GPC, $_W;
        $op = 'fwlist';
        $uniacid = $_W['uniacid']; 
        $type_id = $_GPC['type_id'];
        $pid = $_GPC['id'];
     		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename("hyb_yl_fwlist")."where uniacid = $uniacid and id=$pid");
    		$pindex = max(1, intval($_GPC['page'])); 
    		$pagesize = 10;
    		$p = ($pindex-1) * $pagesize; 
        $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_crowd')."where uniacid=$uniacid");
        $fwlist = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_fwlist')."as a left join".tablename('hyb_yl_crowd')."as b on b.id =a.pid where a.uniacid=$uniacid and a.pid=$pid order by a.ff_id asc limit ".$p.",".$pagesize);
        $pager = pagination($total,$pindex,$pagesize);
        foreach ($fwlist as $key => $value) {
        	$fwlist[$key]['fw_startime'] = date("Y-m-d",$fwlist[$key]['fw_startime']);
        	$fwlist[$key]['fw_endtime'] = date("Y-m-d",$fwlist[$key]['fw_endtime']);
        }
        include $this->template("family/fwlist");
	 }
}