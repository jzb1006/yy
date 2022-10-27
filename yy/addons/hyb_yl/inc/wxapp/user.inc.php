<?php

 class User extends HYBPage
 { 
  
   public function addjiaren()
  {
     global $_GPC, $_W;
     $model = Model('userjiaren');
     $uniacid = $_W['uniacid'];
     $idarr = htmlspecialchars_decode($_GPC['region']);
     $array = json_decode($idarr);
     $object = json_decode(json_encode($array), true);
     $region = implode(',', $object);
     $birthday =$this->getAge($_GPC['datetime']);
     $data = array(
        'uniacid'    => $uniacid,
        'pap_index'  => $_GPC['pap_index'],
        'sick_index' => $_GPC['sick_index'],
        'region'     => $region,
        'datetime'   => $_GPC['datetime'],
        'age'        => $birthday,
        'names'      => $_GPC['names'],
        'numcard'    => $_GPC['numcard'],
        'tel'        => $_GPC['tel'],
        'sex'        => $_GPC['sex'],
        'openid'     => $_GPC['openid'],
        'tizhong'    => $_GPC['tizhong'],
        'shengao'    => $_GPC['shengao'],
        'hunyin'     => $_GPC['hunyin'],
        'zhiye'      => $_GPC['zhiye'],
        'gan_index'  => $_GPC['gan_index'],
        'shen_index' => $_GPC['shen_index'],
        'be_index'   => $_GPC['be_index'],
        'xuex'       => $_GPC['xuex'],
      );
     $res = $model->add($data);
     echo json_encode($data);
  }
 //查询个人
    public function myinformation(){
      global $_GPC, $_W;
      $openid = $_GPC['openid'];
      $names = $_GPC['names'];
      $uniacid = $_W['uniacid'];
      //检查是否存在用户自己的信息
      $user_o = pdo_get("hyb_yl_userjiaren",array('openid'=>$openid,'sick_index'=>0));
   
      // if(!$user_o){
      //  pdo_insert("hyb_yl_userjiaren",array('uniacid'=>$uniacid,'openid'=>$openid,'sick_index'=>0,'names'=>$names));
      //  $user_o = pdo_fetch("SELECT * FROM".tablename("hyb_yl_userinfo")."as a left join".tablename("hyb_yl_userjiaren")."as b on b.openid=a.openid where a.uniacid = $uniacid and a.sick_index=0");
      // }
      echo json_encode($user_o);
    }
    public function alluserfamily()
  {
     global $_GPC, $_W;
     $model = Model('userjiaren');
     $uniacid = $_W['uniacid'];
     $openid = $_GPC['openid'];
     $res = $model->where('openid="'.$openid.'" and uniacid='.$uniacid)->getall('names,j_id,age,tel,region,sick_index,numcard,sex,tizhong,openid');
     foreach ($res as $key => $value) {
       $res[$key]['region'] =json_encode(explode(',', $res[$key]['region']),JSON_UNESCAPED_UNICODE);
     }
     echo json_encode($res);
  }
  //tab订单查看
  public function updateinfo(){
     global $_GPC, $_W;
     $j_id = $_GPC['j_id'];
     $uniacid = $_W['uniacid'];
     $idarr = htmlspecialchars_decode($_GPC['region']);
     $array = json_decode($idarr);
     $object = json_decode(json_encode($array), true);
     $region = implode(',', $object);
     $birthday =$this->getAge($_GPC['datetime']);

     $data = array(
        'uniacid'    => $uniacid,
        'pap_index'  => $_GPC['pap_index'],
        'sick_index' => $_GPC['sick_index'],
        'region'     => $region,
        'datetime'   => $_GPC['datetime'],
        'age'        => $birthday,
        'names'      => $_GPC['names'],
        'numcard'    => $_GPC['numcard'],
        'tel'        => $_GPC['tel'],
        'sex'        => $_GPC['sex'],
        'openid'     => $_GPC['openid'],
        'tizhong'    => $_GPC['tizhong'],
        'shengao'    => $_GPC['shengao'],
        'hunyin'     => $_GPC['hunyin'],
        'zhiye'      => $_GPC['zhiye'],
        'gan_index'  => $_GPC['gan_index'],
        'shen_index' => $_GPC['shen_index'],
        'be_index'   => $_GPC['be_index'],
        'xuex'       => $_GPC['xuex'],
        'feritin_index'  => $_GPC['feritin_index'],
        'diabetes_index' => $_GPC['diabetes_index'],
        'allergy_index'   => $_GPC['allergy_index'],
      );
      $result = pdo_update("hyb_yl_userjiaren",$data,array('j_id'=>$j_id));
      echo json_encode($result);
  }
  private function getAge($birthday) { 
          $age = 0; 
          $year = $month = $day = 0; 
          if (is_array($birthday)) { 
             extract($birthday); 
          } else { 
             if (strpos($birthday, '-') !== false) { 
             list($year, $month, $day) = explode('-', $birthday); 
             $day = substr($day, 0, 2); //get the first two chars in case of '2000-11-03 12:12:00' 
        } 
        } 
        $age = date('Y') - $year; 
        if (date('m') < $month || (date('m') == $month && date('d') < $day)) $age--; 
        return $age; 
    }


   public function detail()
  {
     global $_GPC, $_W;
     $model = Model('userjiaren');
     $uniacid = $_W['uniacid'];
     $j_id = $_GPC['j_id'];
     $res =$model->where('j_id="'.$j_id.'"')->get();
     echo json_encode($res);
  }
   public function deltijian()
  {
     global $_GPC, $_W;
     $model = Model('userjiaren');
     $uniacid = $_W['uniacid'];
     $j_id = $_GPC['j_id'];
     $res =$model->where('j_id="'.$j_id.'"')->delete();
     echo json_encode($res);
  }  
  public function ifself(){
     global $_GPC, $_W;
     $model = Model('userjiaren');
     $uniacid = $_W['uniacid'];
     $openid = $_GPC['openid'];
     $res = $model->where('openid="'.$openid.'" and sick_index=0')->get();
     echo json_encode($res);
  }
  //处方记录
  public function mycflist(){
     global $_GPC, $_W;
     $uniacid = $_W['uniacid'];
     $openid = $_GPC['openid'];
     
     $row = pdo_fetchall("SELECT a.*,b.names,c.z_name,d.ctname FROM ".tablename('hyb_yl_goodsorders')."as a left join ".tablename('hyb_yl_userjiaren')."as b on b.j_id=a.j_id left join".tablename('hyb_yl_zhuanjia')."as c on c.zid=a.zid left join".tablename('hyb_yl_classgory')."as d on d.id=c.parentid where a.uniacid='{$uniacid}' and a.openid='{$openid}' and a.xufang=0 and a.orderStatus=0");
     foreach ($row as $key => $value) {
       $row[$key]['cartlist'] = unserialize($row[$key]['sid']);
       $row[$key]['content']  =  unserialize($row[$key]['conets']);
       $row[$key]['created']  =  $row[$key]['createTime'];
     }
     echo json_encode($row);
  }
  //签约记录
  public function qianyuelist(){
     global $_GPC, $_W;
     $uniacid = $_W['uniacid'];
     $openid = $_GPC['openid'];
     $page = $_GPC['page'];
     $pagesize = $_GPC['pagesize'];
     $list = pdo_fetchall("select * from ".tablename("hyb_yl_teamorder")." where openid='".$openid."' and uniacid=".$uniacid." group by tid order by id desc limit ".$page * $pagesize.",".$pagesize);
     $user = pdo_get("hyb_yl_userinfo",array("uniacid"=>$uniacid,"openid"=>$openid));
      
     foreach($list as &$value)
     {
      $team = pdo_fetch("select t.*,z.z_zhicheng from ".tablename("hyb_yl_team")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on t.zid=z.zid where t.id=:id",array(":id"=>$value['tid']));
      $team['thumb'] = tomedia($team['thumb']);
      $team['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$team['z_zhicheng']),'job_name');
      $team['label'] = json_decode($team['label'],true);
      $team['plugin'] = unserialize($team['plugin']);
      if($user['adminuserdj'] != '0' && $user['adminguanbi'] > time())
      {
        $team['service'] = pdo_getcolumn("hyb_yl_team_serverlist",array("tid"=>$value['tid'],"key_words"=>$value['key_words']),'hymoney');
      }else{
        $team['service'] = pdo_getcolumn("hyb_yl_team_serverlist",array("tid"=>$value['tid'],"key_words"=>$value['key_words']),'ptmoney');
      }
      
      if($team['cid'] != '' || $team['cid'] != '0')
      {
          $team['c_name'] = pdo_getcolumn("hyb_yl_community",array("id"=>$team['cid']),'title');
      }
      $value['team'] = $team;
      $zid = pdo_fetchall("select y_zid from ".tablename("hyb_yl_team_people")." where uniacid=".$uniacid." and tid=".$value['tid']." and status=1");
      $zids = '';
      foreach($zid as &$values)
      {
          $zids .= $values.",";
      }
      $zids = substr($zids, 0,strlen($zids)-1);
      
      $scores = pdo_fetch("select count(*) as count,sum(starsnum) as score from ".tablename("hyb_yl_pingjia")." as p where zid in (".$zids.")");
      if($scores['count'] > 0)
      {
        $value['score'] = ceil($scores['starsnum'] / $scores['count']);
      }else{
        $value['score'] = 5;
      }
     }
     echo json_encode($list);
  }
  //查询用户单个信息
  public function detailmyjd(){
    global $_GPC,$_W;
    $uniacid = $_W['uniacid'];
    $j_id = $_GPC['j_id'];
    $res = pdo_get("hyb_yl_userjiaren",array('j_id'=>$j_id,'uniacid'=>$uniacid));
    echo json_encode($res);
  }

  //查询用户除了图文问诊之外的所有订单
  public function orderlist(){
    global $_GPC,$_W;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $row = pdo_fetchall("SELECT a.*,b.zid,b.z_name,c.j_id,c.names FROM".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_zhuanjia')."as b  on b.zid =a.zid left join".tablename("hyb_yl_userjiaren")."as c on c.j_id=a.j_id where a.uniacid='{$uniacid}' and a.openid='{$openid}'  order by a.id desc ");
    foreach ($row as $key => $value) {
      $row[$key]['time'] = date("Y-m-d H:i:s",$row[$key]['time']);
    }
    echo json_encode($row);
  }
//删除订单
  public function delmyorder(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $m_oid = $_GPC['m_oid'];
      $res = pdo_delete('hyb_yl_wenzorder', array('oid' => $oid, 'uniacid' => $uniacid));
      echo json_encode($row);
  }
  //删除图文订单
  public function delwzorder(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $orders = $_GPC['orders'];
      $res = pdo_delete('hyb_yl_twenorder', array('orders' => $orders, 'uniacid' => $uniacid));
      echo json_encode($res);
  }
  //删除视平或者电话问诊订单
  public function delwzorder_two(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $back_orser = $_GPC['back_orser'];
      $res = pdo_delete('hyb_yl_wenzorder', array('back_orser' => $back_orser, 'uniacid' => $uniacid));
      //删除公开问题列表
      pdo_delete('hyb_yl_answer',array('orders'=>$back_orser));
      echo json_encode($back_orser);
  }
  //tab订单查看
  public function mydanifcz(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $result = pdo_get("hyb_yl_userjiaren",array('openid'=>$openid,'sick_index'=>0));
      if($result){
        echo '1';
      }else{
        echo '0';
      }
  }
  //处方订单
  public function addcforder(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $content = $this->jsondata($_GPC['conets']);
      //查询未支付订单时间
      $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
      if($_GPC['money'] == '' || $_GPC['money'] == '0.00'){
        $chaoshi = $order_time['p_jiezhen'];
      }else{
        $chaoshi = $order_time['chaoshi'];
      }
      $time_b = intval($chaoshi * 60);
      $newtime  = date("Y-m-d H:i:s");
      $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b);

      $data =array(
          'uniacid' => $_W['uniacid'],
          'useropenid'  => $_GPC['openid'],
          'zid'     => $_GPC['zid'],
          'userid'  => $_GPC['j_id'],
          'orders'  =>$this->getordernum(),
          // 'ispay'   =>0,
          'p_type'  =>1,
          'old_money' => $_GPC['old_money'],
          'coupon_id' => $_GPC['coupon_id'],
          "coupon_dk" => $_GPC['coupon_dk'],
          "yid" => $_GPC['yid'],
          "year_dk" => $_GPC['year_dk'],
          'money'   =>$_GPC['money'],
          'typs'    =>0,
          'content' =>serialize($content),
          'time'    =>strtotime("now"),
          'ifgk'    =>$_GPC['ifgk'],
          'back_orser'=> $this->getordernum(),
          'pid'   =>0,
          'role'  =>0,
          'key_words' =>$_GPC['key_words'],
          'addnum'    => $_GPC['addnum'],
          'overtime'  => strtotime($overtime)
        );
      if($_GPC['money'] == '' || $_GPC['money'] == '0.00')
      {
        $data['ispay'] = '1';
        $data['paytime'] = time();
      }else{
        $data['ispay'] = '0';
      }
      $res = pdo_insert('hyb_yl_chufang',$data);
      $c_id = pdo_insertid();
      $row = pdo_get("hyb_yl_chufang",array('c_id'=>$c_id));
      //$row['overtime'] = date("Y-m-d H:i:s",$row['overtime']);
      echo json_encode($row);
  }
    public function jsondata($data)
   {
        $value =htmlspecialchars_decode($data);
        $array =json_decode($value);
        $object =json_decode(json_encode($array),true);
        return $object;
    }

   public function addcfzhuiwen(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $zid = $_GPC['zid'];
    $arr = $_GPC['arr'];
    $orders = $_GPC['orders'];
    $res =pdo_fetch("SELECT * FROM".tablename('hyb_yl_chufang')."where uniacid='{$uniacid}' and orders='{$orders}'");
    $idarr = htmlspecialchars_decode($arr);
    $array = json_decode($idarr);
    $object = json_decode(json_encode($array), true);
    $role = $_GPC['role'];
    $data =array(
         'uniacid' =>$uniacid,
         'zid'     =>$zid,
         'useropenid'  =>$res['useropenid'],
         'orders'  =>$this->getordernum(),
         'time'    =>strtotime("now"),
         'content' =>serialize($object),
         'userid' =>$res['userid'],
         'money'  =>$res['money'],
         'ifgk'   =>$res['ifgk'],
         'ispay'  =>$res['ispay'],
         'back_orser'  =>$res['back_orser'],
         'pid'   =>0,
         'role'  =>$role,
         'grade' =>2,
         'key_words'=>$res['key_words'],
         'addnum'     => $_GPC['addnum'],
          'mp3'=>$_GPC['mp3'],
          'thtime'=>$_GPC['thtime']
      );
    $deeems = pdo_insert("hyb_yl_chufang",$data);
    if($role=='0'){
      $addnum = intval($res['addnum']);
      pdo_update("hyb_yl_chufang",array('addnum'=>($addnum-1)),array('orders'=>$orders));
    }

    echo json_encode($deeems);
 }  

  public function mdpwd(){
    
    require_once dirname(dirname(dirname(__FILE__)))."/inc/common/wxBizDataCrypt.php";
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}'");
    $appid = $result['appid'];
    $sessionKey = $_GPC['sessionKey'];
    $encryptedData = $_GPC['encryptedData'];
    $iv = $_GPC['iv'];
    $pc = new WXBizDataCrypt($appid, $sessionKey);
    $errCode = $pc->decryptData($encryptedData, $iv, $data);
    if ($errCode == 0) {
      $data = array('gstage' => 1, 'rdata' => $data);
    } else {
      $data = array('gstage' => 0, 'rdata' => $errCode);
    }
   
    echo json_encode($data);
    }

 public function info(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $res = pdo_get("hyb_yl_userinfo",array('openid'=>$openid));
    $res['u_phone'] = $this->replaceStar($res['u_phone'],5,3);
    $res['doc_guanzhu'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_attention")." where cerated_type=0 and uniacid=".$uniacid." and openid='".$openid."'");
    
    $res['team_guanzhu'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_attention")." where cerated_type=6 and uniacid=".$uniacid." and openid='".$openid."'");

    $res['coupons'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_user_coupon")." where uniacid=".$uniacid." and openid='".$openid."'");

    $daozhen = pdo_get("hyb_yl_guidance",array("openid"=>$res['openid']));

    if($daozhen && $daozhen['exa'] == '1')
    {

      $res['is_daozhen'] = true;
    }else if($daozhen && $daozhen['exa'] == '2'){
      $res['is_daozhen'] = '暂停中';
      
    }else{
      $res['is_daozhen'] = false;
    }
    $yaoshi = pdo_get("hyb_yl_yaoshi",array("openid"=>$res['openid']));
    if($yaoshi && $yaoshi['status'] == '1')
    {
      $res['is_yaoshi'] = true;
    }else if($yaoshi && $yaoshi['status'] == '0'){
      $res['is_yaoshi'] = '审核中';
    }else if($yaoshi && $yaoshi['status'] == '2'){
      $res['is_yaoshi'] = '审核拒绝';
    }else if($yaoshi && $yaoshi['status'] == '3'){
      $res['is_yaoshi'] = '暂停中';
    }else{
      $res['is_yaoshi'] = false;
    }
    $hospital = pdo_get("hyb_yl_hospital",array("openid"=>$res['openid']));
    if($hospital && $hospital['hos_tuijian'] == '1')
    {
      $res['is_hospital'] = true;
    }else if($hospital && $hospital['hos_tuijian'] == '0'){
      $res['is_hospital'] = '审核中';
    }else{
      $res['is_hospital'] = false;
    }
    if(!$res['money'])
    {
      $res['money'] = '0.00';
    }
    if(!$res['score'])
    {
      $res['score'] = '0';
    }
    $res['yishuo'] = '0';
    if($res['adminuserdj'] != '0' && $res['adminguanbi'] > time())
    {
      $res['vip'] = true;
    }else{
      $res['vip'] = false;
    }
    echo json_encode($res);
  }
  public function tuikuan(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $back_orser = $_GPC['back_orser'];
      $money = $_GPC['money'];
      $key_words = $_GPC['key_words'];
      if($key_words=='yuanchengkaifang'){
        if($money=='0.00'){
           $res = pdo_update("hyb_yl_chufang",array('ispay'=>8),array('orders'=>$back_orser));
        }else{
           $res = pdo_update("hyb_yl_chufang",array('ispay'=>5),array('orders'=>$back_orser));
        }
      }
      if($key_words=='shipinwenzhen' || $key_words=='dianhuajizhen'){
        if($money=='0.00'){
           $res = pdo_update("hyb_yl_wenzorder",array('ifpay'=>8),array('orders'=>$back_orser));
        }else{
           $res = pdo_update("hyb_yl_wenzorder",array('ifpay'=>5),array('orders'=>$back_orser));
        }
      }
      if($key_words=='yuanchengguahao'){
        if($money=='0.00'){
           $res = pdo_update("hyb_yl_guahaoorder",array('ifpay'=>8),array('orders'=>$back_orser));
        }else{
           $res = pdo_update("hyb_yl_guahaoorder",array('ifpay'=>5),array('orders'=>$back_orser));
        }
      }
      echo json_encode($res);
  }
  public function twtuikuan(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $back_orser = $_GPC['back_orser'];
      $money = $_GPC['money'];
      $keywords = $_GPC['keywords'];
  
      if($keywords =='tuwenwenzhen'){
        if($money=='0.00'){
         $res = pdo_update("hyb_yl_twenorder",array('ifpay'=>8),array('orders'=>$back_orser));
         echo $res;
        }else{
          $res = pdo_update("hyb_yl_twenorder",array('ifpay'=>5),array('orders'=>$back_orser));
          $get_one_info = pdo_get("hyb_yl_twenorder",array('orders'=>$back_orser));
          $orders = $get_one_info['orders'];
          $openid = $get_one_info['openid'];
          $if_order_re = pdo_get("hyb_yl_refund",array('openid'=>$openid,'orders'=>$orders));
          //将退款数据插入到退款申请中
          $data =array(
              'uniacid' => $_W['uniacid'],
              'refund'  => 0,
              'key_words' => $keywords,
              'orders'  => $back_orser,
              'openid'  => $get_one_info['openid'],
              'j_id'    => $get_one_info['j_id'],
              'status'  => 0,
              'created' => strtotime('now'),
              'money'   => $get_one_info['money'],
            );
          if(!$if_order_re){
            pdo_insert("hyb_yl_refund",$data); 
            echo "1";
          }else{
            echo "0";
          }
        }
      }

      if($keywords =='yuanchengkaifang'){
        if($money=='0.00'){
         $res = pdo_update("hyb_yl_chufang",array('ispay'=>8),array('orders'=>$back_orser));
         echo $res;
        }else{
          $res = pdo_update("hyb_yl_chufang",array('ispay'=>5),array('orders'=>$back_orser));
          $get_one_info = pdo_get("hyb_yl_chufang",array('orders'=>$back_orser));
          $orders = $get_one_info['orders'];
          $openid = $get_one_info['openid'];
          $if_order_re = pdo_get("hyb_yl_refund",array('openid'=>$openid,'orders'=>$orders));
          //将退款数据插入到退款申请中
          $data =array(
              'uniacid' => $_W['uniacid'],
              'refund'  => 0,
              'key_words' => $keywords,
              'orders'  => $back_orser,
              'openid'  => $get_one_info['openid'],
              'j_id'    => $get_one_info['j_id'],
              'status'  => 0,
              'created' => strtotime('now'),
              'money'   => $get_one_info['money'],
            );
          if(!$if_order_re){
            pdo_insert("hyb_yl_refund",$data); 
            echo "1";
          }else{
            echo "0";
          }
        }
      }

      if($key_words == 'dianhuajizhen' || $key_words == 'shipinwenzhen' || $key_words == 'tijianjiedu' || $key_words == 'shoushukuaiyue'){
        if($money=='0.00'){
         $res = pdo_update("hyb_yl_wenzorder",array('ifpay'=>8),array('orders'=>$back_orser));
         echo $res;
        }else{
          $res = pdo_update("hyb_yl_wenzorder",array('ifpay'=>5),array('orders'=>$back_orser));
          $get_one_info = pdo_get("hyb_yl_wenzorder",array('orders'=>$back_orser));
          $orders = $get_one_info['orders'];
          $openid = $get_one_info['openid'];
          $if_order_re = pdo_get("hyb_yl_refund",array('openid'=>$openid,'orders'=>$orders));
          //将退款数据插入到退款申请中
          $data =array(
              'uniacid' => $_W['uniacid'],
              'refund'  => 0,
              'key_words' => $keywords,
              'orders'  => $back_orser,
              'openid'  => $get_one_info['openid'],
              'j_id'    => $get_one_info['j_id'],
              'status'  => 0,
              'created' => strtotime('now'),
              'money'   => $get_one_info['money'],
            );
          if(!$if_order_re){
            pdo_insert("hyb_yl_refund",$data); 
            echo "1";
          }else{
            echo "0";
          }
        }
      }
      if($keywords =='yuanchengguahao'){
        if($money=='0.00'){
         $res = pdo_update("hyb_yl_guahaoorder",array('ifpay'=>8),array('orders'=>$back_orser));
         echo $res;
        }else{
          $res = pdo_update("hyb_yl_guahaoorder",array('ifpay'=>5),array('orders'=>$back_orser));
          $get_one_info = pdo_get("hyb_yl_guahaoorder",array('orders'=>$back_orser));
          $orders = $get_one_info['orders'];
          $openid = $get_one_info['openid'];
          $if_order_re = pdo_get("hyb_yl_refund",array('openid'=>$openid,'orders'=>$orders));
          //将退款数据插入到退款申请中
          $data =array(
              'uniacid' => $_W['uniacid'],
              'refund'  => 0,
              'key_words' => $keywords,
              'orders'  => $back_orser,
              'openid'  => $get_one_info['openid'],
              'j_id'    => $get_one_info['j_id'],
              'status'  => 0,
              'created' => strtotime('now'),
              'money'   => $get_one_info['money'],
            );
          if(!$if_order_re){
            pdo_insert("hyb_yl_refund",$data); 
            echo "1";
          }else{
            echo "0";
          }
        }
      }
      echo json_encode($keywords);

  }

    public function sptuikuan(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $back_orser = $_GPC['back_orser'];
      $money = $_GPC['money'];
      if($money=='0.00'){
       $res = pdo_update("hyb_yl_wenzorder",array('ifpay'=>8),array('orders'=>$back_orser));
       echo $res;
      }else{
        $res = pdo_update("hyb_yl_wenzorder",array('ifpay'=>5),array('orders'=>$back_orser));
        $get_one_info = pdo_get("hyb_yl_wenzorder",array('orders'=>$back_orser));
        $orders = $get_one_info['orders'];
        $openid = $get_one_info['openid'];
        $if_order_re = pdo_get("hyb_yl_refund",array('openid'=>$openid,'orders'=>$orders));
        //将退款数据插入到退款申请中
        $data =array(
            'uniacid' => $_W['uniacid'],
            'refund'  => 0,
            'key_words' => 'shipinwenzhen',
            'orders'  => $back_orser,
            'openid'  => $get_one_info['openid'],
            'j_id'    => $get_one_info['j_id'],
            'status'  => 0,
            'created' => strtotime('now'),
            'money'   => $get_one_info['money'],
          );
        if(!$if_order_re){
          pdo_insert("hyb_yl_refund",$data); 
          echo "1";
        }else{
          echo "0";
        }
        //提醒管理
      }

  }
   public function getordernum(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
        $mch_id = $res['mch_id'];
        $out_trade_no = $mch_id . time();
        return $out_trade_no;
     } 

  public static function replaceStar($str, $start, $length = 0)
  {
   $i = 0;
   $star = '';
   if($start >= 0) {
    if($length > 0) {
    $str_len = strlen($str);
    $count = $length;
    if($start >= $str_len) {//当开始的下标大于字符串长度的时候，就不做替换了
     $count = 0;
    }
    }elseif($length < 0){
    $str_len = strlen($str);
    $count = abs($length);
    if($start >= $str_len) {//当开始的下标大于字符串长度的时候，由于是反向的，就从最后那个字符的下标开始
     $start = $str_len - 1;
    }
    $offset = $start - $count + 1;//起点下标减去数量，计算偏移量
    $count = $offset >= 0 ? abs($length) : ($start + 1);//偏移量大于等于0说明没有超过最左边，小于0了说明超过了最左边，就用起点到最左边的长度
    $start = $offset >= 0 ? $offset : 0;//从最左边或左边的某个位置开始
    }else {
    $str_len = strlen($str);
    $count = $str_len - $start;//计算要替换的数量
    }
   }else {
    if($length > 0) {
    $offset = abs($start);
    $count = $offset >= $length ? $length : $offset;//大于等于长度的时候 没有超出最右边
    }elseif($length < 0){
    $str_len = strlen($str);
    $end = $str_len + $start;//计算偏移的结尾值
    $offset = abs($start + $length) - 1;//计算偏移量，由于都是负数就加起来
    $start = $str_len - $offset;//计算起点值
    $start = $start >= 0 ? $start : 0;
    $count = $end - $start + 1;
    }else {
    $str_len = strlen($str);
    $count = $str_len + $start + 1;//计算需要偏移的长度
    $start = 0;
    }
   }
   
   while ($i < $count) {
    $star .= '*';
    $i++;
   }
   
   return substr_replace($str, $star, $start, $count);
  }

  // 查看用户关注医生
  public function doc_guanzhu()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $page = $_GPC['page'];
    $pagesize = $_GPC['pagesize'];
    $list = pdo_fetchall("select a.*,z.* from ".tablename("hyb_yl_attention")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.goods_id where a.uniacid=".$uniacid." and a.openid='".$openid."' and cerated_type=0 order by id desc");
    foreach($list as &$value)
    {
      $value['advertisement'] = tomedia($value['advertisement']);
      $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
      $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
      $value['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']));
      $value['service'] = pdo_getall("hyb_yl_doc_all_serverlist",array("zid"=>$value['zid']));
      $pingjia = pdo_fetch("select count(*) as count,sum(starsnum) as score from ".tablename("hyb_yl_pingjia")." where uniacid=".$uniacid." and zid=".$value['zid']);
      if($pingjia['count'] != '0')
      {
        $value['score'] = ceil($pingjia['score'] / $pingjis['count']);
      }else{
        $value['score'] = 5;
      }
    }
    echo json_encode($list);
  }

  // 查看用户关注团队
  public function team_guanzhu()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $page = $_GPC['page'];
    $pagesize = $_GPC['pagesize'];
    $list = pdo_fetchall("select a.*,t.* from ".tablename("hyb_yl_attention")." as a left join ".tablename("hyb_yl_team")." as z on t.id=a.goods_id where a.uniacid=".$uniacid." and a.openid='".$openid."' and cerated_type=6 order by id desc");
    foreach($list as &$value)
    {
      $value['thumb'] = tomedia($value['thumb']);
      $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$value['zid']));
      $zhuanjia['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$zhuanjia['z_zhicheng']),'job_name');
      $value['keshis'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['keshi_two']),'name');
      $value['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$zhuanjia['hid']),'agentname');
      $service = pdo_fetch("select * from ".tablename("hyb_yl_team_serverlist")." where tid=".$value['id']." order by ptmoney");
     
      $value['min'] = $service['ptmoney'];
      $value['label'] = json_decode($value['label'],true);
    }
    echo json_encode($list);
    
  }
  //是否公开过
  public function answeropen(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $orders = $_GPC['orders'];
    $res = pdo_get("hyb_yl_answer",array('orders'=>$orders));
    echo json_encode($res);
  }
  //公开问题
  public function openquestion(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $back_orser = $_GPC['back_orser'];
    $key_words = $_GPC['key_words'];
    $id = $_GPC['id'];
    $res = pdo_get("hyb_yl_answer",array('id'=>$id));
    if(!$res){
        $status = 1;
     }else{
      if($res['status']=='1'){
        $status =0;
      }else{
        $status =1;
      }
     }
    //hyb_yl_answer
    if($key_words == 'dianhuajizhen' || $key_words == 'shipinwenzhen'){
      $type = "电话问诊";
      $row = pdo_fetch("SELECT a.*,b.zid,b.z_name,b.openid,b.z_room,b.parentid,c.u_name,c.u_label FROM".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid where a.uniacid='{$uniacid}' and a.orders='{$back_orser}' ");
      $describe = unserialize($row['describe']);
      $data=array(
         'uniacid' => $_W['uniacid'],
         'title'   => $describe['text'],
         'content' => serialize($describe),
         'openid'  => $row['openid'],
         'u_name'  => $row['u_name'],
         'zid'     => $row['zid'],
         'z_name'  => $row['z_name'],
         'keshi_one' => $row['z_room'],
         'keshi_two' => $row['parentid'],
         'label'     => $row['biaoqian'],
         'keyword'   => $row['keywords'],
         'type'      => $type,
         'created'   => strtotime('now'),
         'status'    => $status,
         'orders'    => $back_orser,
         'state'     =>1
        );
    }
    
    if($key_words == 'yuanchengkaifang'){
      //hyb_yl_chufang
      $type = "开方问诊";
      $row = pdo_fetch("SELECT a.*,b.zid,b.z_name,b.openid,b.z_room,b.parentid,c.u_name,c.u_label FROM".tablename('hyb_yl_chufang')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.useropenid where a.uniacid='{$uniacid}' and a.orders='{$back_orser}' ");    
      $describe = unserialize($row['content']);
      $data=array(
         'uniacid' => $_W['uniacid'],
         'title'   => $describe['text'],
         'content' => serialize($describe),
         'openid'  => $row['openid'],
         'u_name'  => $row['u_name'],
         'zid'     => $row['zid'],
         'z_name'  => $row['z_name'],
         'keshi_one' => $row['z_room'],
         'keshi_two' => $row['parentid'],
         'label'     => $row['u_label'],
         'keyword'   => 'yuanchengkaifang',
         'type'      => $type,
         'created'   => strtotime('now'),
         'status'    => 0,
         'orders'    => $back_orser,
         'state'     =>1
         );
      }
    if($key_words == 'tuwenwenzhen'){
      //hyb_yl_chufang
      $type = "图文问诊";
      $row = pdo_fetch("SELECT a.*,b.zid,b.z_name,b.openid,b.z_room,b.parentid,c.u_name,c.u_label FROM".tablename('hyb_yl_twenorder')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid where a.uniacid='{$uniacid}' and a.orders='{$back_orser}' ");    
      $describe = unserialize($row['content']);
      $data=array(
         'uniacid' => $_W['uniacid'],
         'title'   => $describe['text'],
         'content' => serialize($describe),
         'openid'  => $row['openid'],
         'u_name'  => $row['u_name'],
         'zid'     => $row['zid'],
         'z_name'  => $row['z_name'],
         'keshi_one' => $row['z_room'],
         'keshi_two' => $row['parentid'],
         'label'     => $row['biaoqian'],
         'keyword'   => 'tuwenwenzhen',
         'type'      => $type,
         'created'   => strtotime('now'),
         'status'    => 0,
         'orders'    => $back_orser,
         'state'     =>1
         );
      }
      // if(empty($id) || $id=='undefined'){
        $res = pdo_insert('hyb_yl_answer',$data);
      // }else{
      //   $res = pdo_update('hyb_yl_answer',$data,array('id'=>$id));
      // }
      
      echo json_encode($res);
  }

    // 我的报告解读
  public function tijianjiedu()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $sick_index = $_GPC['sick_index'];
    $status = $_GPC['status'];
    $page = $_GPC['page'];
    $pagesize = $_GPC['pagesize'];
    $openid = $_GPC['openid'];
    $where = " where t.uniacid=".$uniacid." and t.openid='".$openid."' and t.ifover=1 ";
    if($sick_index != '')
    {
      $j_id = pdo_fetchall("select j_id from ".tablename("hyb_yl_userjiaren")." where uniacid=".$uniacid." and openid=".$openid." and sick_index=0");
      $j_ids = '';
      foreach($j_id as &$jid)
      {
        $j_ids .= $jid.",";
      }
      $j_ids = substr($j_ids,0,strlen($j_ids)-1);
      $where .= " and t.j_id in (".$j_ids.")";
    }
    if($status  == '0')
    {
        $where .= " and (t.ifpay=1 or t.ifpay=0 or t.ifpay=6 or t.ifpay=7)";
    }else if($status == '1')
    {
      $where .= " and (t.ifpay=2 or t.ifpay=3 or t.ifpay=4 or t.ifpay=5)";
    }
    $type = !empty($_GPC['type'])?$_GPC['type']:'体检';

    $row = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_tijian_moban')."where uniacid='{$uniacid}' and type='{$type}'");


    foreach ($row as $key => $value) {
      $tijian = $value['id'];
      $tao_list[] = pdo_fetchall('SELECT * FROM'.tablename('hyb_yl_taocan')."where uniacid='{$uniacid}' and tijian='{$tijian}'");
    }  

     $result3 = [];
     array_map(function ($value) use (&$result3) {
        $result3 = array_merge($result3, array_values($value));
     }, $tao_list); 

    foreach ($result3 as $key => $value) {
      $tid = $value['id'];
      $list[] = pdo_fetchall("select t.*,j.names,j.sex,j.age from ".tablename("hyb_yl_tijianorder")." as t left join ".tablename("hyb_yl_userjiaren")." as j on j.j_id=t.j_id".$where." and t.tid='{$tid}' order by t.id desc limit ".$page * $pagesize.",".$pagesize);
     }

     $result4 = [];
     array_map(function ($value) use (&$result4) {
        $result4 = array_merge($result4, array_values($value));
     }, $list); 


    foreach($result4 as &$value)
    {
      $bmid = $value['bm_id'];
      $value['time'] = date("Y-m-d H:i:s",$value['time']);
      $jigou = pdo_fetch("select * from ".tablename("hyb_yl_hospital")."where uniacid='{$uniacid}' and hid=".$bmid);
      $value['hospital'] = $jigou['agentname'];
      $value['advertisement'] = tomedia($jigou['advertisement']);
    }
    echo json_encode($result4);
  }

  // 获取报告解读详情
  public function jiedu_detail()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $item = pdo_fetch("select t.*,j.names,j.sex,j.age,z.advertisement,z.z_name,z.z_room,z.parentid,z.qx_id,z.hid,z.z_zhicheng from ".tablename("hyb_yl_wenzorder")." as t left join ".tablename("hyb_yl_userjiaren")." as j on j.j_id=t.j_id left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid where t.uniacid=".$uniacid." and t.id=".$id);
    $item['advertisement'] = tomedia($item['advertisement']);
    $item['u_thumb'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$item['openid']),'u_thumb');
    $item['time'] = date("Y-m-d",$item['time']);
    $item['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$item['z_zhicheng']),'job_name');
    
    $item['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$id),'name');
    $item['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$item['hid']),'agentname');
    echo json_encode($item);
  }
  //所有按订单
  public function tijianorder(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $weid = $_GPC['id'];
    $row = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_tijianorder')."where uniacid='{$uniacid}' and openid='{$openid}' and wzid='{$weid}'");
    foreach ($row as $key => $value) {
      $row[$key]['time'] = date("Y-m-d H:i:s",$row[$key]['time']);
    }
    echo json_encode($row);
  }
  //解读订单
  public function alljiedu(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $index = $_GPC['index'];
    $timestamp = strtotime('now');
    $where ="where a.uniacid='{$uniacid}' and a.openid='{$openid}'";
    if(empty($index)){
     $where .="";
    }
    if($index =='0'){
     $where .="";
    }
    if($index =='1'){
     $where .=" and a.ifpay=0";
    }
    if($index =='2'){
     $where .=" and a.ifpay=1";
    }
    if($index =='3'){
     $where .=" and a.ifpay=3";
    } 
    $res = pdo_fetchall("select * from".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id=a.j_id ".$where." and a.role=0 and a.type=1 and a.keywords='tijianjiedu'");
    foreach ($res as $key => $value) {
      if($timestamp>=$value['overtime']){
        if($value['ifpay']=='2'){
            pdo_update("hyb_yl_wenzorder",array('ifgb'=>'1','ifpay'=>'3'),array('back_orser'=>$value['orders']));
        }else{
            pdo_update("hyb_yl_wenzorder",array('ifgb'=>'1'),array('back_orser'=>$value['orders']));
        }
      }
    }
   $row = pdo_fetchall("select * from".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id=a.j_id ".$where." and a.role=0 and a.type=1 and a.keywords='tijianjiedu'");
    foreach ($row as $key => $value) {
      $row[$key]['tiorder'] = pdo_get('hyb_yl_tijianorder',array('wzid'=>$value['id']));
      $row[$key]['userinfo'] = pdo_get("hyb_yl_userinfo",array('openid'=>$value['openid']));
      $row[$key]['time'] = date("Y-m-d H:i:s",$row[$key]['time']);
      $row[$key]['doc'] = pdo_fetch("select * from".tablename('hyb_yl_zhuanjia')."as a left join".tablename('hyb_yl_hospital')."as b on b.hid=a.hid where a.zid='{$value['zid']}'");
      $row[$key]['doc']['advertisement'] = tomedia($row[$key]['doc']['advertisement']);
    }
    echo json_encode($row);
  }
  public function allshoushuorder(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $index = $_GPC['index'];
    $where ="where a.uniacid='{$uniacid}' and a.openid='{$openid}'";
    if(empty($index)){
     $where .="";
    }
    if($index =='0'){
     $where .=" and a.ifpay=0";
    }
    if($index =='1'){
     $where .=" and a.ifpay=1";
    }
    if($index =='2'){
     $where .=" and a.ifpay=2";
    }
    if($index =='3'){
     $where .=" and a.ifpay=3";
    } 
    $res = pdo_fetchall("select * from".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id=a.j_id ".$where." and a.role=0 and a.type=1 and a.keywords='shoushukuaiyue'");
    foreach ($res as $key => $value) {
      $res[$key]['userinfo'] = pdo_get("hyb_yl_userinfo",array('openid'=>$value['openid']));
      $res[$key]['time'] = date("Y-m-d",$res[$key]['time']);
      $res[$key]['doc'] = pdo_fetch("select * from".tablename('hyb_yl_zhuanjia')."as a left join".tablename('hyb_yl_hospital')."as b on b.hid=a.hid where a.zid='{$value['zid']}'");
      $res[$key]['describe'] = unserialize($res[$key]['describe']);
    }
    echo json_encode($res);
  }

  public function getcenter()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $type = $_GPC['type'];
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_mycenter")." where uniacid=".$uniacid." and type=".$type." and status=1 and pid=0 order by sort");
    foreach($list as &$value)
    {
      $value['child'] = pdo_fetchall("select * from ".tablename("hyb_yl_mycenter")." where uniacid=".$uniacid." and type=".$type." and status=1 and pid=".$value['id']." order by sort");
      foreach($value['child'] as &$values)
      {
        $values['thumb'] = tomedia($values['thumb']);
      }
    }
    echo json_encode($list);

  }
  public function cfdetail(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $res = pdo_fetch("select * from".tablename('hyb_yl_goodsorders')."where uniacid='{$uniacid}' and id='{$id}'");
    $res['conets'] = unserialize($res['conets']);
    $res['sid'] = unserialize($res['sid']);
    $res['sh_time'] = date("Y-m-d H:i:s",$res['sh_time']);
    echo json_encode($res);
  }

  // 获取用户办理年卡
  public function user_yearcard()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $type = $_GPC['type'];
    $page = $_GPC['page'];
    $pagesize = $_GPC['pagesize'];
    $where = " where a.uniacid=".$uniacid." and a.openid='".$openid."'";
    if($type == '1')
    {
      $where .= " and a.status=0";
    }else if($type == '2')
    {
      $where .= " and a.status=1 and a.end_time>=".time();
    }else if($type == '3')
    {
      $where .= " and a.status=1 and a.end_time <=".time();
    }
    
    $list = pdo_fetchall("SELECT a.*,z.advertisement,z.z_name,z.parentid,z.hid,y.times from ".tablename("hyb_yl_user_yearcard")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid left join ".tablename("hyb_yl_yearcard")." as y on y.id=a.yid ".$where." order by id desc limit ".$page * $pagesize.",".$pagesize);
    
    foreach($list as $key => $value)
    {
      
      if(!$value['z_name'])
      {
        unset($list[$key]);
      }else{
        $list[$key]['advertisement'] = tomedia($value['advertisement']);
        $list[$key]['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
      $list[$key]['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
      if($value['status'] == '0')
      {
        $list[$key]['typs'] = '待支付';
      }else if($value['status'] == '1' && $value['end_time'] >= time())
      {
        $list[$key]['typs'] = '使用中';
      }else if($value['status'] == '1' && $value['end_time'] <= time())
      {
        $list[$key]['typs'] = '已过期';
      }
      $list[$key]['end_time'] = date("Y年m月d日",$value['end_time']);
      }
      

    }
    echo json_encode($list);
  }

  // 查询用户个人信息
  public function detailmyjds()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $list = pdo_get("hyb_yl_userjiaren",array("openid"=>$openid,"sick_index"=>'0'));
    echo json_encode($list);
  }
  public function cfimg(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      //查询当前处方订单的详情
      $id = $_GPC['id'];
      $dt_one_info = pdo_fetch("SELECT * FROM".tablename('hyb_yl_goodsorders')."where uniacid='{$uniacid}' and id='{$id}'");
      if(empty($dt_one_info['cfimg'])){
            $tet_arr = unserialize($dt_one_info['conets']);
            $yao_arr = unserialize($dt_one_info['sid']);
            foreach ($yao_arr as $key => $value) {
             $text1[] = "(".$value['sname'].")".'*'.$value['num'].'  用法：'.$value['use']."//";
            }
            $text = implode('  
      ', $text1);
            //查询专家
            $z_name = pdo_get('hyb_yl_zhuanjia', array('zid'=>$dt_one_info['zid']), array('z_name','parentid'));
            //查询平台名称
            $p_name = pdo_getcolumn('hyb_yl_base', array('uniacid'=>$_W['uniacid']), 'show_title');
            //查询患者信息
            $userinfo = pdo_get('hyb_yl_userjiaren',array('j_id'=>$dt_one_info['j_id']));
            //查询科室
            $ke_shi = pdo_get('hyb_yl_ceshi',array('id'=>$z_name['parentid']),array('name'));

            $src = IA_ROOT.'/addons/hyb_yl/public/admin/images/chufang.png';  
            $info = getimagesize($src);  
            $type = image_type_to_extension($info[2],false);  
            $fun = "imagecreatefrom".$type;  
            $image = $fun($src);  
            $font = "../addons/hyb_yl/public/fonts/simhei.ttf"; 
            $name_t =$p_name.'电子处方';
            $content =$dt_one_info['orderNo'];
            $time = $dt_one_info['createTime'];
            $name = $userinfo['names'];
            $sex = $userinfo['sex'];
            $age = $userinfo['age'];
            $keshi = $ke_shi['name'];
            $zhenduan =$tet_arr['text2'];
            $money =$dt_one_info['totalMoney'];
            $rpcont = $text;
            $content_chufang = $this->autoLineSplit($rpcont, $font, 23, 'UTF-8', 390);
            $doc_yishi =$z_name['z_name'];
            $shenhe_yishi =$z_name['z_name'];
            $fayao_yishi =$z_name['z_name'];

            $kaitime = $dt_one_info['createTime'];
            $shentime =$dt_one_info['createTime'];
            $pingtai ="当前处方只限在".$p_name."平台使用";
            $color = imagecolorallocatealpha($image, 0, 0, 0, 0); 
            $color_m = imagecolorallocatealpha($image, 253, 0, 0, 0.2); 
            imagettftext($image, 33, 0, 450, 138, $color, $font, $name_t);  //医院名称
            imagettftext($image, 15, 0, 180, 55, $color, $font, $content);  //当担
            imagettftext($image, 23, 0, 560, 55, $color, $font, $time);  //日期
            imagettftext($image, 23, 0, 180, 195, $color, $font, $name);  //姓名
            imagettftext($image, 23, 0, 600, 195, $color, $font, $sex);  //性别
            imagettftext($image, 23, 0, 1000, 195, $color, $font, $age);  //年龄
            imagettftext($image, 23, 0, 180, 240, $color, $font, $keshi);  //科室
            imagettftext($image, 23, 0, 220, 280, $color, $font, $zhenduan);  //诊断结果
            imagettftext($image, 23, 0, 1210, 460, $color_m, $font, $money);  //金额
            imagettftext($image, 23, 0, 100, 390, $color, $font, $content_chufang);  //rp
            imagettftext($image, 23, 0, 200, 850, $color, $font, $doc_yishi);  //处方医师
            imagettftext($image, 23, 0, 540, 850, $color, $font, $shenhe_yishi);  //处方医师
            imagettftext($image, 23, 0, 820, 850, $color, $font, $fayao_yishi);  //处方医师
            imagettftext($image, 14, 0, 174, 900, $color, $font, $kaitime);  //开放时间
            imagettftext($image, 15, 0, 480, 900, $color, $font, $shentime);  //审核时间
            imagettftext($image, 15, 0, 800, 921, $color, $font, $pingtai);  //平台
            //header("Content-type:".$info['mime']);  
            // $fun = "image".$type;  
            // $fun($image);  
            // $fun($image,'bg_res.'.$type);  
            $dir = iconv("UTF-8", "GBK", "../attachment/hyb_yl/chufang_{$uniacid}");
            if (!file_exists($dir)){
                mkdir ($dir,0777,true);
            } 
            $image_name = md5(uniqid(rand())).".jpg";
            $filename = IA_ROOT."/attachment/hyb_yl/chufang_{$uniacid}/{$image_name}";
            imagejpeg ($image,$filename,90); //保存到本地
            //保存在数据库中
            $back = "hyb_yl/chufang_{$uniacid}/{$image_name}";
            pdo_update('hyb_yl_goodsorders',array('cfimg'=>$back),array('id'=>$id));
            $image_back = tomedia($back);
            echo json_encode($image_back);
      }else{
          $back=tomedia($dt_one_info['cfimg']);
          echo json_encode($back);
      }
     
    }
    public function gongzhangimg(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $dt_one_info = pdo_fetch("SELECT * FROM".tablename('hyb_yl_goodsorders')."where uniacid='{$uniacid}' and id='{$id}'");
      $cfimg = $dt_one_info['cfimg'];
      if(empty($dt_one_info['wzimg'])){
          $slide = pdo_getcolumn('hyb_yl_base', array('uniacid'=>$_W['uniacid']), 'slide');
          $bigImgPath = IA_ROOT.'/attachment/'.$cfimg;
          $qCodePath = IA_ROOT.'/attachment/'.$slide;

          //header("Content-type: image/jpeg;image/png");
          $source1=imagecreatefromjpeg($qCodePath);
          $dest1=imagecreatefromjpeg($bigImgPath);
          imagecopy($dest1,$source1,950,550,0,0,250,250);
          //imagejpeg($dest1);
       
          $image_name = md5(uniqid(rand())).".jpg";
          $filename = IA_ROOT."/attachment/hyb_yl/{$image_name}";
          imagejpeg ($dest1,$filename,95); //保存到本地
          //保存在数据库中
          $back = "hyb_yl/{$image_name}";
          pdo_update('hyb_yl_goodsorders',array('wzimg'=>$back),array('id'=>$id));
          $image_back = tomedia($back);
          imagedestroy($dest1);
          imagedestroy($source1);
          echo json_encode(tomedia($image_back));
      }else{
          echo json_encode(tomedia($dt_one_info['wzimg']));
      }
     
    }
    public function autoLineSplit ($str, $fontFamily, $fontSize, $charset, $width)
    {
            $_string = '';
            $__string = '';

            for ($i = 0; $i < mb_strlen($str, $charset); $i++) {
                // 查询已有字符串长度

                $box = imagettfbbox($fontSize, 0, $fontFamily, $_string);

                $_string_length = max($box[2], $box[4]) - min($box[0], $box[6]);
     
                // 查询接下来这个字符的宽度
                $nextString = mb_substr($str, $i, 1, $charset);
                $box = imagettfbbox($fontSize, 0, $fontFamily, $nextString);
                $nextStringLen = max($box[2], $box[4]) - min($box[0], $box[6]);
     
                if ($_string_length + $nextStringLen < $width) {
                    $_string .= $nextString;
                } else {
                    $__string .= $_string . "\n";
                    $_string = $nextString;
                }
            }
     
            $__string .= $_string;
            return $__string;
    }
    // 查询机构详情
    public function hospital_detail()
    {
      global $_W,$_GPC;
      $openid = $_GPC['openid'];
      $uniacid = $_W['uniacid'];
      $list = pdo_get("hyb_yl_hospital",array("openid"=>$openid));
      
      $list['logo'] = tomedia($list['logo']);

      $list['level_name'] = pdo_getcolumn("hyb_yl_hospital_level",array("id"=>$list['grade']),'level_name');
      $list['name'] = pdo_getcolumn("hyb_yl_hospital_diction",array("id"=>$list['groupid']),'name');
      $list['zhuanjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$list['hid']);
      $list['keshi'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_ceshi")." where uniacid=".$uniacid);
      if($list['zhuanjia'] > 0)
      {
        $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where hid=".$list['hid']);

        $zids = '';
        foreach($zhuanjia as &$value)
        {
          $zids .= $value['zid'].",";
        }
        $zids = substr($zids,0,strlen($zids)-1);
        $tuwen = pdo_fetchall("select count(*) as count from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by openid");
        $wenzhen = pdo_fetchall("select count(*) as count from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by openid");
        $chufang = pdo_fetchall("select count(*) as count from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zids.") and ispay != 0 and ispay != 6 and ispay != 7 and ispay!=8 group by openid");
        $guahao = pdo_fetchall("select count(*) as count from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by openid");
        
        $tijian = pdo_fetchall("select count(*) as count from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by openid");
        $goods = pdo_fetchcolumn("select count(*) as count from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and zid in (".$zids.") and isPay=1 group by openid");
        
        $count = count($tuwen) + count($wenzhen) + count($chufang) + count($guahao) + count($tijian) + count($goods);
        $list['huanzhe'] = $count;

        $zixun = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zixun")." where uniacid=".$uniacid." and zid in (".$zids.")");
        $answer = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_answer")." where uniacid=".$uniacid." and zid in (".$zids.")");
        $list['content'] = $zixun + $answer;

        
        $tuwen_money = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");
        $tuwen_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen_money));
        if(!$tuwen_money)
        {
          $tuwen_money = '0.00';
        }
        $wenzhen_money = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");
        $wenzhen_money = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_money));
        if(!$wenzhen_money)
        {
          $wenzhen_money = '0.00';
        }
        $chufang_money = pdo_fetchall("select money from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zids.") and ispay != 0 and ispay != 6 and ispay != 7 and ispay!=8 group by back_orser");
        $chufang_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_money));
        if(!$chufang_money)
        {
          $chufang_money = '0.00';
        }
        $guahao_money = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");
        $guahao_money = array_sum(array_map(function($val){return $val['money'];}, $guahao_money));
        if(!$guahao_money)
        {
          $guahao_money = '0.00';
        }
        $tijian_money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8");
        if(!$tijian_money)
        {
          $tijian_money = '0.00';
        }
        $goods_money = pdo_fetchcolumn("select sum(totalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and zid in(".$zid.") and isPay=1");
        if(!$goods_money)
        {
          $goods_money = '0.00';
        }
        $list['money'] = $tuwen_money + $wenzhen_money + $chufang_money + $guahao_money + $tijian_money + $goods_money;

        $list['visit'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_visit")." where uniacid=".$uniacid." and zid in (".$zids.")");
      }else{
        $list['zhuanjia'] = 0;
        $list['huanzhe'] = 0;
        $list['content'] = 0;
        
        $list['money'] = '0.00';
        $list['visit'] = 0;
      }
      
      echo json_encode($list);
    }

     public function addactivenum()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $key = $_GPC['key'];
        $user_num = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$openid,"uniacid"=>$uniacid),array("{$key}"));
        $user_nums = $user_num + 1;
        $res = pdo_update('hyb_yl_userinfo',array("{$key}"=>$user_nums),array('openid'=>$openid));
        if($res)
        {
          $data = array(
              'code' => '1'
          );
        }else{
          $data = array(
              'code' => '0'
          );
        }
        echo json_encode($data);

        
    }
    // 修改用户提醒状态
    public function changetip()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      pdo_update("hyb_yl_userinfo",array("is_tips"=>'1'),array("openid"=>$openid));
    }

    // 查看用户是否设置提醒
    public function usertip()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $res = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$openid),'is_tips');
      echo json_encode($res);
    }

    // 查询机构详情（新）
    public function hospital_details()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $hid = $_GPC['hid'];
      $res = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$hid));
      
      $res['logo'] = tomedia($res['logo']);
      $res['grades'] = pdo_getcolumn("hyb_yl_hospital_level",array("uniacid"=>$uniacid,"id"=>$res['grade']),'level_name');
      if($res['groupid'] == '1')
      {
        $res['groupids'] = '医院';
      }else if($res['groupid'] == '2')
      {
        $res['groupids'] = '药房';
      }else if($res['groupid'] == '3')
      {
        $res['groupids'] = '体检机构';
      }else if($res['groupid'] == '4')
      {
        $res['groupids'] = '诊所';
      }
      echo json_encode($res);
      
    }

    // 查询机构问题
    public function hospital_answer()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $hid = $_GPC['hid'];
      $page = $_GPC['page'];
      $pages = $page * 10;
      $zj_arr = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$hid);
      $zjs = "";

      if(count($zj_arr) != 0)
      {
        foreach($zj_arr as &$zj)
        {
          $zjs .= $zj['zid'].",";
        }

        $zjs = substr($zjs,0,strlen($zjs)-1);
        $list = pdo_fetchall("select a.*,z.z_name,z.advertisement,z.z_zhicheng,z.xn_reoly from ".tablename("hyb_yl_answer")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid where a.uniacid=".$uniacid." and a.zid in (".$zjs.") order by a.id desc limit ".$pages.",10");
        
        foreach($list as &$value)
        {
          $value['advertisement'] = tomedia($value['advertisement']);
          $value['z_zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("uniacid"=>$uniacid,"id"=>$value['z_zhicheng']),'job_name');
          if($value['zid']  != '0'){
            $value['help'] = $value['xn_reoly'];
          }else{
            $value['zhicheng'] = '';
            $value['help'] = rand(1,10);
          }
        }
      }else{
        $list = array();
      }
      echo json_encode($list);
    }
    // 查询机构文章
    public function hospotal_content()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $hid = $_GPC['hid'];
      $page = $_GPC['page'];
      $pages = $page * 10;
      $zj_arr = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$hid);
      $zjs = "";
      if(count($zj_arr) != 0)
      {
        foreach($zj_arr as &$value)
        {
          $zjs .= $value['zid'].",";
        }

        $zjs = substr($zjs,0,strlen($zjs)-1);
        $list = pdo_fetchall("select a.*,z.z_name,z.advertisement,z.z_zhicheng from ".tablename("hyb_yl_zixun")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid where a.uniacid=".$uniacid." and a.zid in (".$zjs.") order by a.id desc limit ".$pages .",10");

        foreach($list as &$value)
        {
          $value['zx_name'] = pdo_getcolumn("hyb_yl_zixun_type",array("uniacid"=>$uniacid,"zx_id"=>$value['p_id']),'zx_name');
          $value['advertisement'] = tomedia($value['advertisement']);
          $value['z_zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("uniacid"=>$uniacid,"id"=>$value['z_zhicheng']),'job_name');
          $value['thumb'] = tomedia($value['thumb']);
          $value['content'] = htmlspecialchars_decode($value['content']);
        }
      }else{
        $list = array();
      }
      echo json_encode($list);
    }

    // 获取机构专家
    public function hospital_zhuanjia()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $hid = $_GPC['hid'];
      $page = $_GPC['page'];
      $pages = $page * 10;
      $list = pdo_fetchall("select * from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$hid." order by zid desc limit ".$pages.",10");
      
      foreach($list as &$value)
      {
        $value['advertisement'] = tomedia($value['advertisement']);
        $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("uniacid"=>$uniacid,"id"=>$value['z_zhicheng']),'job_name');
        $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("uniacid"=>$uniacid,"id"=>$value['parentid']),'name');
        $value['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$value['hid']),'agentname');
        $value['jingxuan'] = explode(",",$value['jingxuan']);

        $value['server'] = pdo_fetchall("SELECT key_words,titlme,ptmoney,hymoney from".tablename('hyb_yl_doc_all_serverlist')."WHERE uniacid = '{$uniacid}' and zid=".$value['zid']);
      }

      echo json_encode($list);
    }
    // 获取机构套餐
    public function hospital_taocan()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $hid = $_GPC['hid'];
      $hids = '"'.$hid.'",';
      $page = $_GPC['page'];
      $pages = $page * 10;
      $list = pdo_fetchall("select * from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and hid like '%$hids%' order by id desc limit ".$pages.",10");
      
      foreach($list as &$value)
      {
        $value['thumb'] = tomedia($value['thumb']);

      }
      echo json_encode($list);
    }

    // 获取机构产品
    public function hospital_goods()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $hid = $_GPC['hid'];
      $page = $_GPC['page'];
      $pages = $page * 10;
      $list = pdo_fetchall("select * from ".tablename("hyb_yl_goodsarr")." where uniacid=".$uniacid." and jigou_two=".$hid." order by sid desc limit ".$pages.",10");
      foreach($list as &$value)
      {
        $value['sthumb'] = tomedia($value['sthumb']);
      }
      echo json_encode($list);
    }

    // 判断是否是绿通人员
    public function is_green()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $is_green = pdo_get("hyb_yl_guidance",array("uniacid"=>$uniacid,"openid"=>$openid));
      if($is_green)
      {
        $data['is_green'] = true;
      }else{
        $data['is_green'] = false;
      }
      echo json_encode($data);
    }

    // 判断用户是否填写病历信息
    public function is_case()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $j_id = $_GPC['j_id'];
      $res = pdo_get("hyb_yl_user_case",array("uniacid"=>$uniacid,"openid"=>$openid,"j_id"=>$j_id));
      if($res)
      {
        $data = true;
      }else{
        $data = false;
      }
      echo json_encode($data);
    }

    // 查询用户病历信息列表
    public function user_case()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $doc = $_GPC['doc'];
      // $j_id = $_GPC['j_id'];
      $date = pdo_fetchall("select date from ".tablename("hyb_yl_user_case")." where uniacid=".$uniacid." and openid='".$openid."' group by date order by id desc");
      foreach($date as &$value)
      {
        $list = pdo_fetchall("select created,date,id,day,number from ".tablename("hyb_yl_user_case")." where uniacid=".$uniacid." and openid='".$openid."' and date='".$value['date']."' order by id desc");
        foreach($list as &$vv)
        {
          $vv['created'] = date("m-d H:i:s",$vv['created']);
        }
        
        $value['list'] = $list;
      }
      echo json_encode($date);
    }

    // 查询用户病历信息详情
    public function case_detail()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $item = pdo_get("hyb_yl_user_case",array("uniacid"=>$uniacid,"id"=>$id));
      $item['content'] = unserialize($item['content']);
      echo json_encode($item);
    }

    //////////////
    // 添加用户病历信息 
    public function add_case()
    {

      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $data = $_GPC['datas'];
      $value =htmlspecialchars_decode($data);
      $array =json_decode($value);
      $object =json_decode(json_encode($array),true);
      $content = serialize($object);
      $number = pdo_fetchcolumn("select number from ".tablename("hyb_yl_user_case")." where uniacid=".$uniacid." and openid='".$_GPC['openid']."' group by id desc limit 1");
      
      if(!$number)
      {
        $number = 0;
      }
      
      // // foreach($data)
      $datas = array(
        'uniacid' => $uniacid,
        "openid" => $_GPC['openid'],
        "name" => $_GPC['name'],
        "age" => $_GPC['age'],
        "j_id" => $_GPC['j_id'],
        "content" => $content,
        "created" => time(),
        "date" => date("Y-m",time()),
        "day" => date("d",time()),
        "number" => $number + 1
      );

      $res = pdo_insert("hyb_yl_user_case",$datas);
      
    }

    public function symptomset()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      // error_reporting(E_ALL);
      $step_one = pdo_getcolumn("hyb_yl_symptomset",array("uniacid"=>$uniacid,"step"=>'1'),'content');
      if($step_one)
      {
        $step_one = unserialize($step_one);
        foreach($step_one as &$one)
        {
          if($one['detail'])
          {
            $one['detail'] = explode("|",$one['detail']);
            if($one['type'] == '2')
            {
              foreach($one['detail'] as &$ones)
              {
                $ones = array(
                  'title' => $ones,
                  'status' => false
                );
                
              }
            }
            
          }
        }
      }
      $step_two = pdo_getcolumn("hyb_yl_symptomset",array("uniacid"=>$uniacid,"step"=>'2'),'content');
      if($step_two)
      {
        $step_two = unserialize($step_two);
        foreach($step_two as &$two)
        {
          if($two['detail'])
          {
            $two['detail'] = explode("|",$two['detail']);
            if($two['type'] == '2')
            {
              foreach($two['detail'] as &$twos)
              {
                $twos = array(
                  'title' => $twos,
                  'status' => false
                );
                
              }
            }
            
          }
        }
      }
      $step_three = pdo_getcolumn("hyb_yl_symptomset",array("uniacid"=>$uniacid,"step"=>'3'),'content');
      if($step_three)
      {
        $step_three = unserialize($step_three);
        foreach($step_three as &$three)
        {
          if($three['detail'])
          {
            $three['detail'] = explode("|",$three['detail']);
            if($three['type'] == '2')
            {
              foreach($three['detail'] as &$threes)
              {
                $threes = array(
                  'title' => $threes,
                  'status' => false
                );
                // $ones['title'] = $ones;
                // $ones['status'] = '0';
              }
            }
            
          }
        }
      }
      $datas = array_merge($step_one,$step_two,$step_three);
      foreach($datas as &$value)
      {
        $value['value'] = '';
      }
      $data = array(
        'one' => $step_one,
        "two" => $step_two,
        "three" => $step_three,
        "datas" => $datas
      );

      echo json_encode($data);
      
    }
  public function updatephone()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $u_phone = $_GPC['u_phone'];
    $openid = $_GPC['openid'];
    $res = pdo_update("hyb_yl_userinfo",array("u_phone"=>$u_phone),array("openid"=>$openid));
    echo json_encode($res);
  }
  public function indexauth(){
    global $_GPC,$_W;
    $uniacid = $_W['uniacid'];
    $basesite = pdo_get('hyb_yl_parameter',array('uniacid'=>$uniacid));
    $appid=$basesite['pub_appid']; //填写你公众号的appid
    $siteurl = $_W['siteroot'];
    cache_write('siteroot', $siteurl);
    cache_write('uniacid', $uniacid);

    $redirect_uri = urlencode($siteurl.'addons/hyb_yl/getWxCode.php' ); //回调页面 
    $url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect&connect_redirect=1";
    echo "<script>location.href='".$url."'</script>";
  }
  public function navigate(){
    global $_W,$_GPC;
    $code = $_GPC['code'];
    include $this->template("navigate");
  } 
 //触发消息提醒
  public function msgtixing(){
    //触发模板消息提醒
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $wxopenid = pdo_getcolumn('hyb_yl_userinfo',array('openid'=>$openid),'wxopenid');
    $wxapp = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
    $appid = $wxapp['pub_appid'];  //填写你公众号的appid
    $secret = $wxapp['appkey'];   //填写你公众号的secret
    $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
    $gzhmb = unserialize($wxapp['gzhmb']);
    $mbxs = $gzhmb['cfmobel'];
    $wxappaid = $wxapp['appid'];
    $orderarr = $_GPC['orderarr'];
    $getArr = array();
    $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
    $access_token = $tokenArr->access_token;

    $posturl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
    $template = array(
         "touser" => $wxopenid,
         "template_id" => $mbxs,
         "miniprogram"=>array(
               "appid"=>$wxappaid,
               "pagepath"=>'hyb_yl/tabBar/index/index'
          ), 
         'topcolor' => '#ccc',
         'data' =>array('first' => array('value' =>'医生已为您开具电子处方单，为了您的健康请尽快按处方购药。',
                                            'color' =>"#743A3A",
         ),
             'keyword1' => array('value' =>$orderarr,
                                 'color' =>'#FF0000',
             ),
             'keyword2' => array('value' =>'医生已为您开具电子处方单',
                                 'color' =>'#FF0000',
             ),
             'keyword3' => array('value' =>'请遵医嘱用药',
                                 'color' =>'#FF0000',
             ),
             'remark'   => array('value' =>'如果您对以上信息有任何疑问，请直接在平台上回复您的问题即可',
                                 'color' =>'#FF0000',
            ),
         )
    );

    $postjson = json_encode($template);
    $resder = $this->http_curl($posturl,'post','json',$postjson);
    echo json_encode($resder);
  }
  //开通 会员提醒
  //
  public function memberopentx(){
    //触发模板消息提醒
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
   
    $near = $_GPC['near'];
    if($near=='用户关注提醒'){
       $zid = $_GPC['zid']; 
       $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$zid));
       $openid = $zhuanjia['openid'];
       $msg = $zhuanjia['z_name'];
    }else if($near=='医生提现提醒'){
       $zid = $_GPC['zid']; 
       $money = $_GPC['money'];
       $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$zid));
       $openid = $zhuanjia['openid'];
       $msg = "您的提现提醒,提现金额为：".$money;
    }else{
       $openid = $_GPC['openid'];
       $msg = "平台信息";
    }
    $user = pdo_get('hyb_yl_userinfo',array('openid'=>$openid));
    $wxopenid = pdo_getcolumn('hyb_yl_userinfo',array('openid'=>$openid),'wxopenid');
    $wxapp = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
    $appid = $wxapp['pub_appid'];  //填写你公众号的appid
    $secret = $wxapp['appkey'];   //填写你公众号的secret
    $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
    $gzhmb = unserialize($wxapp['gzhmb']);
    $mbxs = $gzhmb['hedui'];
    $wxappaid = $wxapp['appid'];
    $orderarr = $_GPC['orderarr'];
    $getArr = array();
    $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
    $access_token = $tokenArr->access_token;
    //患者姓名：{{keyword1.DATA}} 医生：{{keyword2.DATA}} 核对事项：{{keyword3.DATA}}
    //
    //
    $posturl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
    $template = array(
         "touser" => $wxopenid,
         "template_id" => $mbxs,
         "miniprogram"=>array(
               "appid"=>$wxappaid,
               "pagepath"=>'hyb_yl/tabBar/index/index'
          ), 
         'topcolor' => '#ccc',
         'data' =>array('first' => array('value' =>$near,
                                            'color' =>"#743A3A",
         ),
             'keyword1' => array('value' =>$user['u_name'],
                                 'color' =>'#FF0000',
             ),
             'keyword2' => array('value' => $msg,
                                 'color' =>'#FF0000',
             ),
             'keyword3' => array('value' =>$near,
                                 'color' =>'#FF0000',
             ),
             'remark'   => array('value' =>'如果您对以上信息有任何疑问，请直接在平台上回复您的问题即可',
                                 'color' =>'#FF0000',
            ),
         )
    );

    $postjson = json_encode($template);
    $resder = $this->http_curl($posturl,'post','json',$postjson);
    echo json_encode($resder);
  }
public  function http_curl($url,$type,$res,$arr){
          $ch=curl_init();
          /*$url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=SECRET';  */
          curl_setopt($ch,CURLOPT_URL,$url);
          curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
          if($type=='post'){
              curl_setopt($ch,CURLOPT_POST,1);
              curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
          }
          $output = curl_exec($ch);
          curl_close($ch);
          if($res=='json'){
              return json_decode($output,true);
          }
    }
    public function send_post($url, $post_data, $method = 'POST') {
        $postdata = http_build_query($post_data);
        $options = array('http' => array('method' => $method, //or GET
        'header' => 'Content-type:application/x-www-form-urlencoded', 'content' => $postdata, 'timeout' => 15 * 60 // 超时时间（单位:s）
        ));
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }
}


