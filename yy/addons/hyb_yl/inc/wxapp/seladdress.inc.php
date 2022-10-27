<?php
/**
* 
*/
 class Seladdress extends HYBPage
 { 
    //获取用户信息
    public function alladdress() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $row = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_address')."where pid=0");

        echo json_encode($row);
    }

}


