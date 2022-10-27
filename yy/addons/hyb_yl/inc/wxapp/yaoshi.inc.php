<?php

class Yaoshi extends HYBPage
{ 
  // 药师详情
  public function index()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $list = pdo_get("hyb_yl_yaoshi",array("uniacid"=>$uniacid,"openid"=>$openid));
    $list['thumb'] = tomedia($list['thumb']);
    $list['fqname'] = pdo_getcolumn("hyb_yl_hospital_diction",array("uniacid"=>$uniacid,"id"=>$list['jigou_one']),'name');
    $list['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$list['jigou_two']),'agentname');
    $list['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$list['keshi_two']),'name');
    $list['level_name'] = pdo_getcolumn("hyb_yl_hospital_level",array("id"=>$list['grade']),'level_name');
    $list['keshis'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$list['jigou_one']),'ctname');
    // 查询总订单数
    $order = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and ifCf=1 and ifshop=1 and cid != 0 and y_id=".$list['id']);
    
    $shenhe = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and ifCf=1 and ifshop=1 and cid != 0 and status=0 and isPay=1");

    $fee = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and type=0 and style=6 and cash=0 and yid=".$list['id']);
    if(!$fee)
    {
      $fee = '0.00';
    }
    $list['fee'] = $fee;
    $tixian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and type=1 and style=6 and cash=1 and yid=".$list['id']);
    if(!$tixian)
    {
      $tixian = '0.00';
    }
    $list['tixian'] = $tixian;
    $list['order'] = $order;
    $list['shenhe'] = $shenhe;
    echo json_encode($list);
  }

  // 订单记录
  public function order_list()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $y_id = $_GPC['y_id'];
    $typs = $_GPC['typs'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? "10" : $_GPC['pagesize'];
    if($typs == 'yishen')
    {
      $where = " and a.y_id=".$y_id;
    }else{
      $where = ' and a.status=0';
    }
    $list = pdo_fetchall("select a.*,b.u_thumb,c.names from ".tablename("hyb_yl_goodsorders")." as a left join ".tablename("hyb_yl_userinfo")." as b on b.openid=a.openid left join ".tablename("hyb_yl_userjiaren")." as c on c.j_id=a.j_id where a.uniacid=".$uniacid.$where." and a.isPay=1 and a.cid != 0 order by a.id desc limit ".$page * $pagesize.",".$pagesize);
    
    foreach($list as &$value)
    {
        $value['sid'] = unserialize($value['sid']);
        $value['conets'] = unserialize($value['conets']);
        $value['order'] = pdo_get("hyb_yl_chufang",array("c_id"=>$value['cid']));
    }
    echo json_encode($list);
  }

  // 药师审核订单
  public function shenhe_order()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $y_id = $_GPC['y_id'];
    $status = $_GPC['status'];
    $res = pdo_update("hyb_yl_goodsorders",array("status"=>$status,'sh_time'=>time(),'y_id'=>$y_id),array('id'=>$id));
    if($status == '1')
    {
      $fee = pdo_getcolumn("hyb_yl_ys_rule",array("uniacid"=>$uniacid),'sh_fee');
      $order = pdo_get("hyb_yl_goodsorders",array("id"=>$id,'uniacid'=>$uniacid));
      $moneys = $order['totalMoney'] * $fee /100;
      $yaoshi = pdo_get("hyb_yl_yaoshi",array("id"=>$y_id));
      $moneyss = $yaoshi['money'] + $moneys;
      pdo_update("hyb_yl_yaoshi",array("money"=>$moneyss),array("id"=>$y_id));
      $data = array(
        'uniacid' => $_W['uniacid'],
        "openid" => $order['openid'],
        "money" => $moneys,
        "created" => time(),
        "keyword" => $order['key_words'],
        "back_orser" => $order['orderNo'],
        "old_money" => $order['totalMoney'],
        "type" => '0',
        "style" => '6',
        "yid" => $y_id
      );
      pdo_insert("hyb_yl_pay",$data);

    }
    echo json_encode($res);
  }

  // 药师提现
  public function tixian()
  {
    global $_W,$_GPC;
    $money = $_GPC['money'];
    $yid = $_GPC['yid'];
    $openid = $_GPC['openid'];
    $tx_type = $_GPC['tx_type'];
    $uniacid = $_W['uniacid'];
    $base = pdo_get("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid));
    $last = pdo_fetch("select created from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and yid=".$yid." and type=1 and style=1 and cash=1 order by id desc limit 0,1");
    if($money < $base['min_money'])
    {
      $data = array(
          'code' => '1',
          'message' => '提现最低金额为'.$base['min_money'],
      );
    }
    else if($last)
    {
      $time = $base['interval_time'];
      if($time != '0' || $time != '')
      {
        $next = strtotime(date("Y-m-d H:i:s",$last['created'])."+$time days");
          
        if($next < time())
        {
          $yaoshi = pdo_get("hyb_yl_yaoshi",array("id"=>$yid));
          $fee = $base['yaoshi_cash'];
          $moneys = $money + $money * $fee / 100;
          $shouxufei = $money * $fee /100;
          if($yaoshi['money'] < $money)
          {
            $data = array(
                'code' => '1',
                'message' => '余额不足',
            );
          }else if($yaoshi['money'] < $moneys)
          {
            $data = array(
                'code' => '1',
                'message' => '余额不足，需扣除手续费'.$shouxufei.'元',
            );
          }else{
            $moneyss = $yaoshi['money'] - $moneys;
            $res = pdo_update("hyb_yl_gyaoshi",array("money"=>$moneyss),array("id"=>$yaoshi['id']));
            if($res)
            {
              $datas = array(
                  'uniacid' => $uniacid,
                  "openid" => $openid,
                  "money" => $moneys,
                  "fee" => $shouxufei,
                  "old_money" => $money,
                  "yid" => $yaoshi['id'],
                  "created" => time(),
                  "type" => '1',
                  "style" => '6',
                  "cash" => '1',
                  "cash_type" => $tx_type,
              );
              if($base['is_yaoshi'] == '1')
              {
                $datas['status'] = '1';
              }

              pdo_insert("hyb_yl_pay",$datas);
              $data = array(
                  'code' => '0',
                  'message' => '申请成功'
              );
            }else{
              $data = array(
                  'code' => '1',
                  'message' => '申请失败，请稍后重试',
              );
            }
          }
        }else{
          $data = array(
              'code' => '1',
              'message' => '请'.date("Y-m-d H:i:s",$next).'后提现',
              'data' => $base,
          );
        }
      }else{
        $yaoshi = pdo_get("hyb_yl_yaoshi",array("id"=>$yid));
        $fee = $base['yaoshi_cash'];
        $moneys = $money + $money * $fee / 100;
        $shouxufei = $money * $fee /100;
        if($yaoshi['money'] < $money)
        {
          $data = array(
              'code' => '1',
              'message' => '余额不足',
          );
        }else if($yaoshi['money'] < $moneys)
        {
          $data = array(
              'code' => '1',
              'message' => '余额不足，需扣除手续费'.$shouxufei.'元',
          );
        }else{
          $moneyss = $yaoshi['money'] - $moneys;
          $res = pdo_update("hyb_yl_gyaoshi",array("money"=>$moneyss),array("id"=>$yaoshi['id']));
          if($res)
          {
            $datas = array(
                'uniacid' => $uniacid,
                "openid" => $openid,
                "money" => $moneys,
                "fee" => $shouxufei,
                "old_money" => $money,
                "yid" => $yaoshi['id'],
                "created" => time(),
                "type" => '1',
                "style" => '6',
                "cash" => '1',
                "cash_type" => $tx_type,
            );
            if($base['is_yaoshi'] == '1')
            {
              $datas['status'] = '1';
            }

            pdo_insert("hyb_yl_pay",$datas);
            $data = array(
                'code' => '0',
                'message' => '申请成功'
            );
          }else{
            $data = array(
                'code' => '1',
                'message' => '申请失败，请稍后重试',
            );
          }
        }
      }
    }else{
      $yaoshi = pdo_get("hyb_yl_yaoshi",array("id"=>$yid));
      $fee = $base['yaoshi_cash'];
      $moneys = $money + $money * $fee / 100;
      $shouxufei = $money * $fee /100;
      if($yaoshi['money'] < $money)
      {
        $data = array(
            'code' => '1',
            'message' => '余额不足',
        );
      }else if($yaoshi['money'] < $moneys)
      {
        $data = array(
            'code' => '1',
            'message' => '余额不足，需扣除手续费'.$shouxufei.'元',
        );
      }else{
        $moneyss = $yaoshi['money'] - $moneys;
        $res = pdo_update("hyb_yl_yaoshi",array("money"=>$moneyss),array("id"=>$yaoshi['id']));
        
        if($res)
        {
          $datas = array(
              'uniacid' => $uniacid,
              "openid" => $openid,
              "money" => $moneys,
              "fee" => $shouxufei,
              "old_money" => $money,
              "yid" => $yaoshi['id'],
              "created" => time(),
              "type" => '1',
              "style" => '6',
              "cash" => '1',
              "cash_type" => $tx_type,
          );
          if($base['is_yaoshi'] == '1')
          {
            $datas['status'] = '1';
          }

          pdo_insert("hyb_yl_pay",$datas);
          $data = array(
              'code' => '0',
              'message' => '申请成功'
          );
        }else{
          $data = array(
              'code' => '1',
              'message' => '申请失败，请稍后重试',
          );
        }
      }
    }
    echo json_encode($data);
  }

  // 查询提现记录
  public function yaoshi_tixian()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $yid = $_GPC['yid'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $list = pdo_fetchall("select a.*,b.thumb from ".tablename("hyb_yl_pay")." as a left join ".tablename("hyb_yl_yaoshi")." as b on a.yid=b.id where a.uniacid=".$uniacid." and a.yid=".$yid." and a.type=1 and a.style=6 and a.cash=1 order by a.id desc limit ".$page * $pagesize.",".$pagesize);

    foreach($list as &$value)
    {
      $value['created'] = date("Y-m-d H:i:s",$value['created']);
      $value['thumb'] = tomedia($value['thumb']);
    }
    echo json_encode($list);
  }

  // 查询其他提现
  public function tixian_list()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $where = " where uniacid=".$uniacid." and type=1 and cash=1 and status=1 and style=6";
    
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_pay").$where." order by id desc limit 0,10");
    
    foreach($list as &$value)
    {
      
      $value['name'] = pdo_getcolumn("hyb_yl_yaoshi",array("id"=>$value['id']),'name');
      
      $value['name'] = substr_replace($value['name'],'***','3',strlen($value['name'])-6);
    }
    
    echo json_encode($list);
  }

  public function updatephone()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $telphone = $_GPC['telphone'];
    $openid = $_GPC['openid'];
    $res = pdo_update("hyb_yl_yaoshi",array("telphone"=>$telphone),array("openid"=>$openid));
  }

  // 修改药师信息
  public function updateinfo()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $yid = $_GPC['yid'];
    $data = array(
        'thumb' => $_GPC['thumb'],
        "jigou_one" => $_GPC['jigou_one'],
        "jigou_two" => $_GPC['jigou_two'],
        "openid" => $_GPC['openid'],
        "telphone" => $_GPC['telphone'],
        "name" => $_GPC['name'],
        "typs" => $_GPC['typs'],
        "sex" => $_GPC['sex'],
        "idcard" => $_GPC['idcard'],
        "province" => $_GPC['province'],
        "city" => $_GPC['city'],
        "district" => $_GPC['district'],
        "lon" => $_GPC['lon'],
        "lat" => $_GPC['lat'],
        "keshi_one" => $_GPC['keshi_one'],
        "keshi_two" => $_GPC['keshi_two'],
        "login_name" => $_GPC['login_name'],
        "login_pass" => $_GPC['login_pass'],
        "is_index" => $_GPC['is_index'],

    );
    $status = pdo_getcolumn("hyb_yl_ys_rule",array("uniacid"=>$uniacid),'status');
    if($status == '0')
    {
      $data['status'] = '0';
    }else{
      $data['status'] = '1';
    }
    if($yid != '')
    {
      $res = pdo_update("hyb_yl_yaoshi",$data,array("id"=>$yid));
    }else{
      $data['ruzhu_time'] = time();
      $data['created'] = time();
      $res = pdo_insert("hyb_yl_yaoshi",$data);
    }
    echo json_encode($res);
  }

  
}


