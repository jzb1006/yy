<?php
/**
* 
*/
 class Shoushu extends HYBPage
 { 
  //患者报告添加
   public function addshoushu()
  {
     global $_GPC, $_W;
     $model = Model('userbingli');
     $uniacid = $_W['uniacid'];
     $zid = $_GPC['zid'];
     $mesage = $this->jsondata($_GPC['mesage']);
     $openid = $_GPC['openid'];
     $data = array(
        'uniacid'     => $_W['uniacid'],
        'openid'      => $_GPC['openid'],
        'msglist'      => serialize($mesage),
        'userid'        => $_GPC['j_id']
     	);
     $res = $model->add($data);
     $bl_id =  pdo_insertid();
     echo json_encode($bl_id);
  }
    public function jsondata($data)
	 {
	    $value =htmlspecialchars_decode($data);
        $array =json_decode($value);
        $object =json_decode(json_encode($array),true);
        return $object;
	  }
	public function url() {
	    global $_W;
	    echo $_W['siteroot'];
	}

}


