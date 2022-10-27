<?php
/**
* 
*/

 class Green extends HYBPage
 { 

  // 获取医院
  public function hospital()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $city = $_GPC['city'];
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and address like '%$city%'");
    echo json_encode($list);
  }

  // 服务列表
  public function server()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $keyword = $_GPC['keyword'];
    $list = pdo_fetchall("select a.* from ".tablename("hyb_yl_tstype")." as a left join ".tablename("hyb_yl_tstype")." as b on b.id=a.pid where a.uniacid=".$uniacid." and b.keyword='".$keyword."'");
    
    foreach($list as &$value)
    {
      if($value['thumb'] != '')
      {
        $value['thumb'] = tomedia($value['thumb']);
      }
      $value['state'] = false;
      $value['num'] = 0;
      
    }
    echo json_encode($list);
  }

  // 获取服务价格
  public function ser_type()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $keyword = $_GPC['keyword'];
    $list = pdo_get("hyb_yl_tstype",array("keyword"=>$keyword));
    echo json_encode($list);
  }

  // 获取导诊信息
  public function dz_info()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $list = pdo_get("hyb_yl_guidance",array("id"=>$id,"uniacid"=>$uniacid));
    $list['thumb'] = tomedia($list['thumb']);
    $list['z_name'] = $list['title'];

    $list['level_name'] = pdo_fetchcolumn("select b.level_name from ".tablename("hyb_yl_hospital")." as a left join ".tablename("hyb_yl_hospital_level")." as b on b.id=a.grade where a.uniacid=".$uniacid." and a.hid=".$list['hid']);
    $list['ctname'] = pdo_getcolumn("hyb_yl_classgory",array("uniacid"=>$uniacid,"id"=>$list['room']),'ctname');
    $list['authority'] = explode('、', $list['authority']);
    $list['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$list['zhicheng']),'job_name');
    $list['advertisement'] = $list['thumb'];
    echo json_encode($list);
  }


  // 生成订单
  public function order()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $content = $this->jsondata($_GPC['content']);
    $fuwus = $this->jsondata($_GPC['fuwus']);

    $biaoqian = $this->jsondata($_GPC['biaoqian']);

     foreach ($biaoqian as $key => $value) {
        $text.= $value.',';
     }
    $bq_cont = rtrim($text,',');
    $data = array(
      'openid' => $openid,
      "did" => $_GPC['did'],
      "key_words" => $_GPC['server'],
      "orders" => $this->getordernum(),
      "content" => serialize($content),
      "money" => $_GPC['money'],
      "back_orser" => $this->getordernum(),
      "created" => time(),
      "hid" => $_GPC['hid'],
      "keshi_two" => $_GPC['keshi_two'],
      "typeid" => $_GPC['typeid'],
      "time" => $_GPC['time'],
      "j_id" => $_GPC['j_id'],
      "biaoqian" => $bq_cont,
      "uniacid" => $uniacid,
      "z_id" => $_GPC['zid'],
      "fuwus" => serialize($fuwus)

    );
    if($_GPC['money'] == '' || $_GPC['money'] == '0' || $_GPC['money'] == '0.00')
    {
      $data['ifpay'] = '1';
      $data['paytime'] = time();
    }else{
      $data['ifpay'] = '0';
    }
    
    pdo_insert("hyb_yl_guidance_order",$data);
    $id = pdo_insertid();
    if($id)
    {
      $datas = array(
          'uniacid' =>$uniacid,
          "openid" => $openid,
          "order_id" => $id,
          "back_orser" => $data['back_orser'],
          "content" => serialize($content),
          "created" => time(),
          "z_id" => $_GPC['z_id'],
          "did" => $_GPC['did'],
      );
      pdo_insert("hyb_yl_guidance_message",$datas);
    }
    
    $res = pdo_get("hyb_yl_guidance_order",array("id"=>$id));
    echo json_encode($res);
  }
  public function jsondata($data)
  {
    $value =htmlspecialchars_decode($data);
    $array =json_decode($value);
    $object =json_decode(json_encode($array),true);
    return $object;
  }
  

  // 支付订单
  public function payorder() {
      global $_GPC, $_W;
      cache_write('uniacid',$_W['uniacid']);

      require_once dirname(dirname(dirname(__FILE__)))."/wxpay.php";
      $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
      $appid = $res['appid'];
      $openid = $_GPC['openid'];
      $mch_id = $res['mch_id'];
      $key = $res['pub_api'];
      $out_trade_no = $_GPC['orders'];
      
      $total_fee = $_GPC['z_tw_money'];
      $key_words = $_GPC['key_words'];
      $noturl = 'http://'.$_SERVER['SERVER_NAME'].'/addons/hyb_yl/ltnoturl.php';
      
      if (empty($total_fee)) {
          $body = '订单付款';
          $total_fee = floatval(99 * 100);
      } else {
          $body = '订单付款';
          $total_fee = floatval($total_fee * 100);
      }

      $weixinpay = new WeixinPay($appid, $openid, $mch_id, $key, $out_trade_no, $body, $total_fee,$noturl);
      $return = $weixinpay->pay();
      echo json_encode($return);
  }

  public function updategreen()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $back_orser = $_GPC['back_orser'];
    pdo_update('hyb_yl_guidance_order',array('ifpay'=>1,'paytime'=>time()),array('uniacid'=>$uniacid,'orders'=>$back_orser));
  }
  public function getordernum(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
    $mch_id = $res['mch_id'];
    $out_trade_no = $mch_id . time();
    return $out_trade_no;
 }

  // 获取导诊员列表
  public function lists()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $address = $_GPC['address'];
    $keyword = $_GPC['keyword'];
    $keshi_one = $_GPC['keshi_one'];
    $keshi_two = $_GPC['keshi_two'];
    $server_key = $_GPC['ser_key'];
    $zhicheng = $_GPC['zhicheng'];
    $biaoqian = $_GPC['biaoqian'];
    $order = $_GPC['order'] == '' ? '0' : $_GPC['order'];

    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $where = " where uniacid=".$uniacid." and gzstype=1 and listshow=0 and exa=1 and endtime >='".date("Y-m-d",time())."'";
    $wheres = " where uniacid=".$uniacid." and gzstype=1 and listshow=0 and exa=1 and endtime >='".date("Y-m-d",time())."'"; 
    $hid = $_GPC['hid'];
    if($hid != '')
    {
      $where .= " and hid=".$hid;
      $wheres .= " and hid=".$hid;
    }
    if($keyword != '')
    {
      $where .= " and title like '%$keyword%'";
      $wheres .= " and z_name like '%$keyword%'";
    }
    if($biaoqian != '')
    {
      $where .= " and authority regexp '{$biaoqian}'";
      $wheres .= " and authority regexp '{$biaoqian}'";
    }
    if($keshi_one != '')
    {
      $where .= " and room=".$keshi_one;
      $wheres .= " and z_room=".$keshi_one;
    }
    if($zhicheng != '')
    {
      $where .= " and zhicheng=".$zhicheng;
      $wheres .= " and z_zhicheng=".$zhicheng;
    }
    
    if($keshi_two != '')
    {
      $where .= " and parentid=".$keshi_two;
      $wheres .= " and parentid=".$keshi_two;
    }
    if($order == '0')
    {
      
      if($server_key == 'baogaojiaji')
      {
        $orders = " order by zid desc limit ".$page * $pagesize.",".$pagesize;
      }else{
        $orders = " order by id desc limit ".$page * $pagesize.",".$pagesize;
      }
    }else if($order == '1')
    {
      $orders = " order by xn_reoly desc limit ".$page * $pagesize.",".$pagesize;
    }else if($order == '2')
    {
      $orders = " order by xn_cf desc limit ".$page * $pagesize.",".$pagesize;
    }else if($order == '3')
    {
      $orders = " order by xytime asc limit ".$page * $pagesize.",".$pagesize;
    }
    if($server_key != 'baogaojiaji')
    {
      $where .= " and server like '%$server_key%'";
      
      $list = pdo_fetchall("select * from ".tablename("hyb_yl_guidance").$where.$orders);
      foreach($list as &$value)
      {
        $value['thumb'] = tomedia($value['thumb']);
        $value['keshi_one'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$value['room'],"uniacid"=>$uniacid),'ctname');
        $value['keshi_two'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid'],"uniacid"=>$uniacid),"name");
        $value['hospital'] =pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
        $value['job'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['zhicheng']),'job_name');

      }

    }else if($server_key == 'baogaojiaji')
    {
      $wheres .= " and is_urgent=1";
      $list = pdo_fetchall("select * from ".tablename("hyb_yl_zhuanjia").$wheres.$orders);
      foreach($list as &$values)
      {
        $values['thumb'] = tomedia($values['advertisement']);
        $values['keshi_one'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$values['z_room'],"uniacid"=>$uniacid),'ctname');
        $values['keshi_two'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$values['parentid'],"uniacid"=>$uniacid),"name");
        $values['title'] = $values['z_name'];
        $values['hospital'] =pdo_getcolumn("hyb_yl_hospital",array("hid"=>$values['hid']),'agentname');
        $values['job'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$values['z_zhicheng']),'job_name');

      }
    }
    echo json_encode($list);
  }
  // 查询绿通订单
  public function order_list()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $type = empty($_GPC['type']) ? '0' : $_GPC['type'];
    $openid = $_GPC['openid'];
    $where = " where uniacid=".$uniacid." and openid='".$openid."'";
    $keyword = $_GPC['keyword'];
    if($keyword != '')
    {
      $where .= " and key_words like '%$keyword%'";
    }
    
    if($type == '1')
    {
      $where .= " and ifpay=0";
    }else if($type == '2')
    {
      $where .= " and ifpay=1";
    }else if($type == '3')
    {
      $where .= " and ifpay=2";
    }else if($type == '4')
    {
      $where .= " and (ifpay=3 or ifpay=4 or ifpay=6 or ifpay=7 or ifpay=8)";
    }else if($type == '5')
    {
      $where .= " and ifpay =5";
    }

    $list = pdo_fetchall("select * from ".tablename("hyb_yl_guidance_order").$where." order by id desc limit ".$page * $pagesize.",".$pagesize);
    foreach($list as &$value)
    {
      $user = pdo_get("hyb_yl_userinfo",array("openid"=>$value['openid']));
      $value['user'] = $user;
      if($value['fuwus'] != '')
      {
          $value['fuwus'] = unserialize($value['fuwus']);
          $value['count'] = count($value['fuwus']);
      }else{
        $value['count'] = '1';
      }
      

      if($value['did'] != '0')
      {
        $doc = pdo_fetch("select a.*,b.agentname,z.job_name from ".tablename("hyb_yl_guidance")." as a left join ".tablename("hyb_yl_hospital")." as b on b.hid=a.hid left join ".tablename("hyb_yl_zhuanjia_job")." as z on z.id=a.zhicheng where a.uniacid=".$uniacid." and a.id=".$value['did']);

        $value['thumb'] = tomedia($doc['thumb']);
        $value['name'] = $doc['title'];
        $value['doc'] = $doc;

        $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$doc['parentid']),'name');
      }else if($value['zid'] != '0')
      {
        $doc = pdo_fetch("select a.*,b.agentname,z.job_name from ".tablename("hyb_yl_zhuanjia")." as a left join ".tablename("hyb_yl_hospital")." as b on b.hid=a.hid left join ".tablename("hyb_yl_zhuanjia_job")." as z on z.id=a.z_zhicheng where  a.uniacid=".$uniacid." and a.zid=".$value['z_id']);
        if($doc)
        {
          $doc['keshi'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$doc['z_room']),'ctname');
          $doc['title'] = $doc['z_name'];
          $value['thumb'] = tomedia($doc['advertisement']);
          $value['doc'] = $doc;
          $value['name'] = $doc['z_name'];
          $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$doc['parentid']),'name');
        }
        
      }
      $value['created'] = date("Y-m-d H:i:s",$value['created']);
      $value['content'] = unserialize($value['content']);
    }
    
    echo json_encode($list);
  }
  // 绿通订单
  public function order_detail()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $list = pdo_get("hyb_yl_guidance_order",array("uniacid"=>$uniacid,"id"=>$id));
    $list['title'] = pdo_getcolumn("hyb_yl_tstype",array("keyword"=>$list['key_words']),'title');
    $user = pdo_get("hyb_yl_userjiaren",array("uniacid"=>$uniacid,"j_id"=>$list['j_id']));
    $list['content'] = unserialize($list['content']);
    $list['message'] = pdo_getall("hyb_yl_guidance_message",array("back_orser"=>$list['back_orser']));
    if(count($list['message']) == '0')
    {
      $list['message'] = pdo_getall("hyb_yl_guidance_order",array("uniacid"=>$uniacid,"id"=>$id));
      foreach($list['message'] as &$vv)
      {
        $vv['role'] = 0;
      }
    }
    foreach($list['message'] as &$value)
    {
      $value['created'] = date("Y-m-d H:i:s",$value['created']);
      $value['content'] = unserialize($value['content']);
    }
    if($list['did'] != '0')
    {
      $doc = pdo_fetch("select a.*,b.agentname,z.job_name from ".tablename("hyb_yl_guidance")." as a left join ".tablename("hyb_yl_hospital")." as b on b.hid=a.hid left join ".tablename("hyb_yl_zhuanjia_job")." as z on z.id=a.zhicheng where a.uniacid=".$uniacid." and a.id=".$list['did']);
      $doc['thumb'] = tomedia($doc['thumb']);
      $list['doc'] = $doc;
    }else if($list['zid'] != '0')
    {
      $doc = pdo_fetch("select a.*,b.agentname,z.job_name from ".tablename("hyb_yl_zhuanjia")." as a left join ".tablename("hyb_yl_hospital")." as b on b.hid=a.hid left join ".tablename("hyb_yl_zhuanjia_job")." as z on z.id=a.z_zhicheng where a.uniacid=".$uniacid." and a.zid=".$list['z_id']);
      $doc['thumb'] = tomedia($doc['advertisement']);
      $doc['title'] = $doc['z_name'];
      $list['doc'] = $doc;
    }
    echo json_encode($list);
  }

  // 查询订单记录
  public function order_message()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $back_orser = $_GPC['back_orser'];
    $order = pdo_get("hyb_yl_guidance_order",array("back_orser"=>$back_orser));
    $message = pdo_getall("hyb_yl_guidance_message",array("back_orser"=>$back_orser));
    if(count($message) == '0')
    {
      $message = pdo_getall("hyb_yl_guidance_order",array("back_orser"=>$back_orser));
      foreach($message as &$vv)
      {
        $vv['role'] = '0';
      }
    }
    $i = 0;
    foreach($message as &$value)
    {
      $value['content'] = unserialize($value['content']);
      $value['created'] = date("Y-m-d H:i:s",$value['created']);
      
      if($value['role'] == '0')
      {
        $value['len'] = $i++;
      }
      if($value['did'] != '0')
      {
        $doc = pdo_fetch("select a.*,b.agentname,z.job_name from ".tablename("hyb_yl_guidance")." as a left join ".tablename("hyb_yl_hospital")." as b on b.hid=a.hid left join ".tablename("hyb_yl_zhuanjia_job")." as z on z.id=a.zhicheng where a.uniacid=".$uniacid." and a.id=".$value['did']);

        $value['thumb'] = tomedia($doc['thumb']);
        $value['title'] = $doc['title'];
        $value['doc'] = $doc;

        $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$doc['parentid']),'name');
      }else if($value['zid'] != '0')
      {
        $doc = pdo_fetch("select a.*,b.agentname,z.job_name from ".tablename("hyb_yl_zhuanjia")." as a left join ".tablename("hyb_yl_hospital")." as b on b.hid=a.hid left join ".tablename("hyb_yl_zhuanjia_job")." as z on z.id=a.z_zhicheng where  a.uniacid=".$uniacid." and a.zid=".$value['z_id']);
        $doc['keshi'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$doc['z_room']),'ctname');
        $value['thumb'] = tomedia($doc['advertisement']);
        $value['doc'] = $doc;
        $value['title'] = $doc['z_name'];
        $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$doc['parentid']),'name');
      }
    }
    echo json_encode($message);
  }

  // 用户追问
  public function adduserzhuiwen()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $arr = $_GPC['arr'];
    $back_orser = $_GPC['back_orser'];
    $oo_user_der =$this->getordernum();
    $idarr = htmlspecialchars_decode($arr);
    $array = json_decode($idarr);
    $object = json_decode(json_encode($array), true);
    $order = pdo_get("hyb_yl_guidance_order",array("back_orser"=>$back_orser));
    $data = array(
        'uniacid' => $uniacid,
        "order_id" => $order['id'],
        "back_orser" => $order['back_orser'],
        "content" => serialize($object),
        "created" => time(),
        "role" => '0',
        "openid" => $order['openid'],
        "z_id" => $order['z_id'],
        "did" => $order['did'],
    );
    $res = pdo_insert("hyb_yl_guidance_message",$data);
    echo json_encode($res);

  }

  // 删除订单
  public function del_order()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $back_orser = $_GPC['back_orser'];
    $res = pdo_delete("hyb_yl_guidance_order",array("id"=>$id,"uniacid"=>$uniacid));
    pdo_delete("hyb_yl_guidance_message",array("back_orser"=>$back_orser,"uniacid"=>$uniacid));
    echo json_encode($res);
  }

  // 取消订单
  public function order_change()
  {
    global $_W,$_GPC;
    $id = $_GPC['id'];
    $ifpay = $_GPC['ifpay'];
    
    $data['ifpay'] = $ifpay;
    if($ifpay == '5')
    {
      $data['apply_time'] = time();

    }else if($ifpay == '8')
    {
      $data['apply_time'] = time();
    }
    $res = pdo_update("hyb_yl_guidance_order",$data,array("id"=>$id));
    echo json_encode($res);

  }
  // 获取科室一级分类
  public function keshi_one()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $list = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'0'));
    echo json_encode($list);
  }
  // 获取科室二级分类
  public function keshi_two()
  {
    global $_W,$_GPC;
    $id = $_GPC['id'];
    $uniacid = $_W['uniacid'];
    $list = pdo_getall("hyb_yl_ceshi",array("uniacid"=>$uniacid,"giftstatus"=>$id));
    echo json_encode($list);
  }
  // 科室列表
  public function keshi_arr()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $type = $_GPC['type'];
    if($type)
    {
      $list = pdo_getall("hyb_yl_ceshi",array("uniacid"=>$uniacid));
    }else{
      $list = pdo_getall("hyb_yl_ceshi",array("uniacid"=>$uniacid));
      $all = array(
        '0'=> array(
          'id' => '',
          'name' => '全部',
          )
          
        );
      array_push($list,$all);
    }
    
    echo json_encode($list);

  }


  // 获得绿通信息
  public function guidance_detail()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $list = pdo_get("hyb_yl_guidance",array("openid"=>$openid,"uniacid"=>$uniacid));
    $cash = pdo_getcolumn("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid),'lvtong_cash');
    $list['cash'] = $cash;
    $list['thumb'] = tomedia($list['thumb']);
    $list['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$list['hid']),'agentname');
    $list['authority'] = explode('、', $list['authority']);
    $list['yuyuejiuzhen'] = pdo_fetchcolumn("select count(distinct openid) from ".tablename("hyb_yl_guidance_order")." where did=".$list['id']." and key_words='yuyuejiuzhen'");
    $list['zhuyuananpai'] = pdo_fetchcolumn("select count(distinct openid) from ".tablename("hyb_yl_guidance_order")." where did=".$list['id']." and key_words='zhuyuananpai'");
    $list['shoushuanpai'] = pdo_fetchcolumn("select count(distinct openid) from ".tablename("hyb_yl_guidance_order")." where did=".$list['id']." and key_words='shoushuanpai'");

    $list['jiuzhen_money'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where did=".$list['id']." and keyword='yuyuejiuzhen' and type=0 and style=0");
    if($list['jiuzhen_money'] == false || $list['jiuzhen_money'] == '')
    {
      $list['jiuzhen_money'] = '0.00';
    }
    $list['zhuyuan_money'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where did=".$list['id']." and keyword='zhuyuananpai' and type=0 and style=0");
    if($list['zhuyuan_money'] == false || $list['zhuyuan_money'] == '')
    {
      $list['zhuyuan_money'] = '0.00';
    }
    $list['shoushu_money'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where did=".$list['id']." and keyword='shoushuanpai' and type=0 and style=0");
    if($list['shoushu_money'] == false || $list['shoushu_money'] == '')
    {
      $list['shoushu_money'] = '0.00';
    }
    $list['moneys'] = $list['jiuzhen_money'] + $list['zhuyuan_money'] + $list['shoushu_money'];

    $list['pay_jiuzhen'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where did=".$list['id']." and key_words='yuyuejiuzhen' and ifpay=0");
    if($list['pay_jiuzhen'] == false || $list['pay_jiuzhen'] == '')
    {
      $list['pay_jiuzhen'] = '0.00';
    }
    $list['pay_zhuyuan'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where did=".$list['id']." and key_words='zhuyuananpai' and ifpay=0");
    if($list['pay_zhuyuan'] == false || $list['pay_zhuyuan'] == '')
    {
      $list['pay_zhuyuan'] = '0.00';
    }
    $list['pay_shoushu'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where did=".$list['id']." and key_words='shoushuanpai' and ifpay=0");
    if($list['pay_shoushu'] == false || $list['pay_shoushu'] == '')
    {
      $list['pay_shoushu'] = '0.00';
    }
    $list['pay_money'] = $list['pay_jiuzhen'] + $list['pay_zhuyuan'] + $list['pay_shoushu'];

    $list['pay'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and did=".$list['id']." and type=1 and style=0");
    if(!$list['pay'])
    {
      $list['pay'] = '0.00';
    }
    $fuwu = pdo_fetchall("select * from ".tablename("hyb_yl_tstype")." where uniacid=".$uniacid." and pid=0 and keyword != 'baogaojiaji'",array("uniacid"=>$uniacid,"pid"=>'0'));
    foreach($fuwu as &$value)
    {
      
      $value['thumb'] = tomedia($value['thumb']);
      $value['num'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid." and did=".$list['id']." and key_words='".$value['keyword']."' and ifpay != 0");
    }

    

    $list['list'] = $fuwu;
    
    echo json_encode($list);

  }
  // 绿通人员获取订单
  public function guidance_order()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $did = $_GPC['did'];
    $keyword = $_GPC['keyword'];
    $where = " where a.uniacid=".$uniacid." and a.key_words='".$keyword."' and a.ifpay!=0";
    $type = $_GPC['type'] == '' ? '' : $_GPC['type'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    if($did != '')
    {
      $where .= " and a.did=".$did;
    }else{
      $where .= " and a.did =0";
    }
    if($type == '0')
    {
      $where .= " and a.ifpay=1";
    }
    // 0待支付1已支付待接诊2已接诊3已完成待评价4已评价5申请退款6退款成功7订单关闭8已取消
    if($type == '1')
    {
      $types = (int)$type + 1;
      $where .= " and a.ifpay=".$types;
    }else if($type == '2')
    {
      $where .= " and (a.ifpay=3 or a.ifpay=4 or a.ifpay=6)";
    }else if($type == '3')
    {
      $where .= " and (a.ifpay=5 or a.ifpay=6)";
    }else if($type == '4')
    {
      $where .= " and a.ifpay=8";
    }
      
    $list = pdo_fetchall("select a.*,b.names,b.sex,b.tel,c.u_thumb from ".tablename("hyb_yl_guidance_order")." as a left join ".tablename("hyb_yl_userjiaren")." as b on b.j_id=a.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid ".$where." order by a.id desc limit ".$page * $pagesize.",".$pagesize);
    
    foreach($list as &$value)
    {
      $value['title'] = pdo_getcolumn("hyb_yl_tstype",array("keyword"=>$value['key_words']),'title');
      $value['state'] = pdo_fetchcolumn("select state from ".tablename("hyb_yl_guidance_message")." where uniacid=".$uniacid." and role=0");
      $value['content'] = unserialize($value['content']);
      $value['created'] = date("Y-m-d H:i:s",$value['created']);
    }
    echo json_encode($list);

  }

  // 绿通人员接单
  public function order_accept()
  {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $did = $_GPC['did'];
      $zid = $_GPC['zid'];
      $ifpay = pdo_getcolumn("hyb_yl_guidance_order",array("id"=>$id),'ifpay');
      if($ifpay == '2')
      {
        $res = array('code' => '2','message'=>'手慢了，该订单已被抢');
      }else if($ifpay == '3' || $ifpay == '4' || $ifpay == '6')
      {
        $res = array('code' => '3','message' => '该订单已完成');
      }else if($ifpay == '5')
      {
        $res = array('code' => '4','message'=>'该订单申请退款');
      }else if($ifpay == '8')
      {
        $res = array("code" => '5','message' => '该订单已被取消');
      }else{
        $data = array(
          "ifpay"=>'2',
          'accept_time'=>time(),
        );
        if($did != '')
        {
          $data['did'] = $did;
        }
        if($zid != '')
        {
          $data['z_id'] = $zid;
        }

        $ress = pdo_update("hyb_yl_guidance_order",$data,array("id"=>$id));
        if($ress)
        {
          $res = array("code" => '0','message' => '接单成功');
        }else{
          $res = array("code" => '5','message' => '接单失败，请稍后重试');
        }
      }
      
      echo json_encode($res);
  }

  // 专家获取报告加急订单
  public function baogao_order()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $type = empty($_GPC['type']) ? '0' : $_GPC['type'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $zid = $_GPC['zid'];
    $where = " where a.uniacid=".$uniacid." and a.key_words='baogaojiaji' and a.ifpay!=0";
    if($zid != '')
    {
      $where.=" and a.z_id=".$zid;
    }
    if($type == '0')
    {
      $where .= " and ifpay=1";
    }
    // 0待支付1已支付待接诊2已接诊3已完成待评价4已评价5申请退款6退款成功7订单关闭8已取消
    if($type == '1')
    {
      $types = (int)$type + 1;
      $where .= " and a.ifpay=".$types;
    }else if($type == '2')
    {
      $where .= " and (a.ifpay=3 or a.ifpay=4 or a.ifpay=6)";
    }else if($type == '3')
    {
      $where .= " and (a.ifpay=5 or a.ifpay=6)";
    }else if($type == '4')
    {
      $where .= " and a.ifpay=8";
    }
    
    $list = pdo_fetchall("select a.*,b.names,b.sex,b.tel,c.u_thumb from ".tablename("hyb_yl_guidance_order")." as a left join ".tablename("hyb_yl_userjiaren")." as b on b.j_id=a.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid ".$where." order by a.id desc limit ".$page * $pagesize.",".$pagesize);

    foreach($list as &$value)
    {
      $value['state'] = pdo_fetchcolumn("select state from ".tablename("hyb_yl_guidance_message")." where uniacid=".$uniacid." and role=0");
      $value['content'] = unserialize($value['content']);
      $value['created'] = date("Y-m-d H:i:s",$value['created']);
    }
    echo json_encode($list);
  }

  // 绿通人员回复信息
  public function guidance_reply()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $arr = $_GPC['arr'];
    $back_orser = $_GPC['back_orser'];
    
    $oo_user_der =$this->getordernum();
    $idarr = htmlspecialchars_decode($arr);
    $array = json_decode($idarr);
    $object = json_decode(json_encode($array), true);
    $order = pdo_get("hyb_yl_guidance_order",array("back_orser"=>$back_orser));
    $data = array(
        'uniacid' => $uniacid,
        "order_id" => $order['id'],
        "back_orser" => $order['back_orser'],
        "content" => serialize($object),
        "created" => time(),
        "role" => '1',
        "openid" => $order['openid'],
        "z_id" => $order['z_id'],
        "did" => $order['did'],
    );

    pdo_update("hyb_yl_guidance_message",array("state"=>'1'),array("back_orser"=>$back_orser,'role'=>'0','state'=>'0'));
    $res = pdo_insert("hyb_yl_guidance_message",$data);
    echo json_encode($res);
  }
  // 结束订单
  public function over_order()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $lvtong_fee = pdo_getcolumn("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid),'lvtong_fee');
    $order = pdo_get("hyb_yl_guidance_order",array("id"=>$id));

    if($order['did'] != '' || $order['did'] != '0')
    {
      $doc = pdo_get("hyb_yl_guidance",array("id"=>$order['did']));
      $moneys = $order['money'] * $lvtong_fee / 100 + $doc['money'];
      pdo_update("hyb_yl_guidance",array("money"=>$moneys),array("id"=>$order['did']));
    }else if($order['z_id'] != '' || $order['z_id'] != '0')
    {
      $doc = pdo_get("hyb_yl_zhuanjia",array("id"=>$order['z_id']));
      $moneys = $order['money'] * $lvtong_fee / 100 + $doc['money'];
      pdo_update("hyb_yl_zhuanjia",array("total_money"=>$moneys),array("zid"=>$order['z_id']));
    }
    $data = array(
      'uniacid' => $uniacid,
      "openid" => $order['openid'],
      "money" => $moneys,
      "fee" => $order['money'] * $lvtong_fee / 100,
      "zid"=>$order['zid'],
      "did" => $order['did'],
      "created" => time(),
      "back_orser" => $order['back_orser'],
      "old_money" => $order['money'],
      "keyword" => $order['key_words'],
    );
    pdo_insert("hyb_yl_pay",$data);
    $res = pdo_update("hyb_yl_guidance_order",array("ifpay"=>'3'),array("id"=>$id));
    echo json_encode($res);
  }
  // 订单评价
  public function pingjia()
  {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];

      $data = array(
        'openid' => $_GPC['openid'],
        "uniacid" => $uniacid,
        "zid" => $_GPC['zid'],
        "keywords" => $_GPC['keywords'],
        "starsnum" => $_GPC['starsnum'],
        "content" => $_GPC['content'],
        "orders" =>$_GPC['orders'],
        "createTime" => time(),
        "j_id" => $_GPC['j_id'],
        "did" => $_GPC['did'],
      );

      pdo_insert("hyb_yl_pingjia",$data);
      pdo_update("hyb_yl_guidance_order",array("ifpay"=>'4'),array("back_orser"=>$_GPC['orders']));
  }

  // 导诊查询收入
  public function guidance_pay()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $did = pdo_getcolumn("hyb_yl_guidance",array("uniacid"=>$uniacid,"openid"=>$openid),'id');
    // $lists = pdo_fetchall("select a.*,b.u_name,b.u_thumb from ".tablename("hyb_yl_guidance_pay")." as a left join ".tablename("hyb_yl_userinfo")." as b on a.openid=b.openid where a.uniacid=".$uniacid." and a.did=".$did." order by a.id desc limit ".$page*$pagesize.",".$pagesize);
    $type = pdo_fetchall("select * from ".tablename("hyb_yl_tstype")." where uniacid=".$uniacid." and pid=0 and keyword != 'baogaojiaji'");
    foreach($type as &$value)
    {
      // $value['moneys'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_pay")." where uniacid=".$uniacid." and keyword='".$value['keyword']." and did=".$id);
      $value['thumb'] = tomedia($value['thumb']);
    }
    $list['type'] = $type;
    $count = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and type=0 and style=0 and did=".$did);
    $pay = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and type=1 and style=0 and did=".$did);
    if($count == '')
    {
      $count = '0.00';
    }
    if($pay == '')
    {
      $pay = '0.00';
    }
    $list['count'] = $count - $pay;
    
    
    // $list['list'] = $lists;
    $income = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and type=0 and style=0 and did=".$did." and creatd >=".strtotime(date("Y-m-d"),time()));
    $pays = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and type=1 and style=0 and did=".$did." and created >=".strtotime(date("Y-m-d"),time()));
    if(!$pays)
    {
      $pays = '0.00';
    }
    if($income == '')
    {
      $income = '0.00';
    }
    $list['did'] = $did;
    $list['pay'] = $pays;
    $list['income'] = $income;
    echo json_encode($list);
  }

  // 查询详细明细
  public function pay_list()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $keyword = $_GPC['keyword'];
    $openid = $_GPC['openid'];
    $did = pdo_getcolumn("hyb_yl_guidance",array("uniacid"=>$uniacid,"openid"=>$openid),'id');
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $list = pdo_fetchall("select a.*,b.u_name,b.u_thumb,c.title from ".tablename("hyb_yl_pay")." as a left join ".tablename("hyb_yl_userinfo")." as b on a.openid=b.openid left join ".tablename("hyb_yl_tstype")." as c on c.keyword=a.keyword where a.uniacid=".$uniacid." and a.did=".$did." and a.keyword='".$keyword."' and a.style=0 order by a.id desc limit ".$page*$pagesize.",".$pagesize);
    
    foreach($list as &$value)
    {
      $value['created'] = date("Y-m-d H:i:s",$value['created']);
    }
    echo json_encode($list);
  }

  // 获取绿通近七天收益额
  public function seven_money()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $did = pdo_getcolumn("hyb_yl_guidance",array("openid"=>$openid),'id');
    $i = 7;

    while (0 <= $i) {
      $time = date('Y-m-d', strtotime('-' . $i . ' day'));
      $condition = '  uniacid=:uniacid and created>=:starttime and created<=:endtime and did=:did and style=0 and type=0';
      $params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($time . ' 00:00:00'), ':endtime' => strtotime($time . ' 23:59:59'),":did"=>$did);
      $money = pdo_fetchcolumn('select sum(money) from ' . tablename('hyb_yl_pay') . (' where   ' . $condition), $params);
      $conditions = '  uniacid=:uniacid and created>=:starttime and created<=:endtime and did=:did and style=0 and type=1';
      if($money == '')
      {
        $money = '0.00';
      }
      $pay = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay") . (' where   ' . $conditions), $params);
      if($pay == '')
      {
        $pay = '0.00';
      }
      $times = date('m-d', strtotime('-' . $i . ' day'));
      $datas[] = array(
        'date' => $times, 
        'money' => $money,
        'pay' => $pay,
        );
      --$i;
    }
    
    echo json_encode($datas);
  }

  // 绿通人员提现
  public function tixian()
  {
    global $_W,$_GPC;
    $openid = $_GPC['openid'];
    $did = $_GPC['did'];
    $zid = $_GPC['zid'];
    $uniacid = $_W['uniacid'];
    $money = $_GPC['money'];
    $tx_type = $_GPC['tx_type'];
    $base = pdo_get("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid));
     if($did)
    {
      $last = pdo_fetch("select created from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and did=".$did." and type=1 and style=0 and cash=1 order by id desc limit 0,1");

    }else if($zid){
      $last = pdo_fetch("select created from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and zid=".$zid." and type=1 and style=1 and cash=1 order by id desc limit 0,1");
    }
    
    $base = pdo_get("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid));
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
            if($did)
            {
              $guidance = pdo_get("hyb_yl_guidance",array("id"=>$did));
              $fee = $base['lvtong_cash'];

              $moneys = $money - $money * $fee / 100;
              $shouxufei = $money * $fee /100;
               
              if($guidance['money'] < $money)
              {
                $data = array(
                    'code' => '1',
                    'message' => '余额不足',
                );
              }
              else{
                $moneyss = $guidance['money'] - $money;
                $res = pdo_update("hyb_yl_guidance",array("money"=>$moneyss),array("id"=>$guidance['id']));
                if($res)
                {
                  $datas = array(
                      'uniacid' => $uniacid,
                      "openid" => $openid,
                      "money" => $moneys,
                      "fee" => $shouxufei,
                      "old_money" => $money,
                      "did" => $guidance['id'],
                      "created" => time(),
                      "type" => '1',
                      "style" => '0',
                      "cash" => '1',
                      "cash_type" => $tx_type,
                  );
                  if($base['is_lvtong'] == '1')
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
            }else if($zid)
            {
              $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$zid));
              $fee = $base['expert_fee'];
              $moneys = $money - $money * $fee / 100;
              $shouxufei = $money * $fee /100;
              if($zhuanjia['total_money'] < $money)
              {
                $data = array(
                    'code' => '1',
                    'message' => '余额不足',
                );
              }
              else{
                $moneyss = $zhuanjia['total_money'] - $money;
                $res = pdo_update("hyb_yl_zhuanjia",array("total_money"=>$moneyss),array("zid"=>$zhuanjia['zid']));

                if($res)
                {
                  $datas = array(
                      'uniacid' => $uniacid,
                      "openid" => $openid,
                      "money" => $moneys,
                      "fee" => $shouxufei,
                      "old_money" => $money,
                      "zid" => $zhuanjia['zid'],
                      "created" => time(),
                      "type" => '1',
                      "style" => '1',
                      "cash" => '1',
                      "cash_type" => $tx_type,
                  );
                  if($base['is_expert'] == '1')
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
            $data = array(
                'code' => '1',
                'message' => '请'.date("Y-m-d H:i:s",$next).'后提现',
                'data' => $base,
            );
          }
        }else{
          if($did)
          {
            $guidance = pdo_get("hyb_yl_guidance",array("id"=>$did));
            $fee = $base['lvtong_cash'];

            $moneys = $money - $money * $fee / 100;
            $shouxufei = $money * $fee /100;
             
            if($guidance['money'] < $money)
            {
              $data = array(
                  'code' => '1',
                  'message' => '余额不足',
              );
            }
            else{
              $moneyss = $guidance['money'] - $money;
              $res = pdo_update("hyb_yl_guidance",array("money"=>$moneyss),array("id"=>$guidance['id']));
              if($res)
              {
                $datas = array(
                    'uniacid' => $uniacid,
                    "openid" => $openid,
                    "money" => $moneys,
                    "fee" => $shouxufei,
                    "old_money" => $money,
                    "did" => $guidance['id'],
                    "created" => time(),
                    "type" => '1',
                    "style" => '0',
                    "cash" => '1',
                    "cash_type" => $tx_type,
                );
                if($base['is_lvtong'] == '1')
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
          }else if($zid)
          {
            $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$zid));
            $fee = $base['expert_fee'];
            $moneys = $money - $money * $fee / 100;
            $shouxufei = $money * $fee /100;
            if($zhuanjia['total_money'] < $money)
            {
              $data = array(
                  'code' => '1',
                  'message' => '余额不足',
              );
            }
            else{
              $moneyss = $zhuanjia['total_money'] - $money;
              $res = pdo_update("hyb_yl_zhuanjia",array("total_money"=>$moneyss),array("zid"=>$zhuanjia['zid']));
              if($res)
              {
                $datas = array(
                    'uniacid' => $uniacid,
                    "openid" => $openid,
                    "money" => $moneys,
                    "fee" => $shouxufei,
                    "old_money" => $money,
                    "zid" => $zhuanjia['zid'],
                    "created" => time(),
                    "type" => '1',
                    "style" => '1',
                    "cash" => '1',
                    "cash_type" => $tx_type,
                );
                if($base['is_expert'] == '1')
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
        }
        
    }else{
      if($did)
      {
        $guidance = pdo_get("hyb_yl_guidance",array("id"=>$did));
        $fee = $base['lvtong_cash'];
        $moneys = $money - $money * $fee / 100;
        $shouxufei = $money * $fee /100;
        
        if($guidance['money'] < $money)
        {
          $data = array(
              'code' => '1',
              'message' => '余额不足',
          );
        }
        else{
          $moneyss = $guidance['money'] - $money;
          $res = pdo_update("hyb_yl_guidance",array("money"=>$moneyss),array("id"=>$guidance['id']));
          if($res)
          {
            $datas = array(
                'uniacid' => $uniacid,
                "openid" => $openid,
                "money" => $moneys,
                "fee" => $shouxufei,
                "old_money" => $money,
                "did" => $guidance['id'],
                "created" => time(),
                "type" => '1',
                "style" => '0',
                "cash" => '1',
                "cash_type" => $tx_type,
            );
            if($base['is_lvtong'] == '1')
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
      }else if($zid)
      {
        $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$zid));
        $fee = $base['expert_fee'];
        $moneys = $money - $money * $fee / 100;
        $shouxufei = $money * $fee /100;
        if($zhuanjia['total_money'] < $money)
        {
          $data = array(
              'code' => '1',
              'message' => '余额不足',
          );
        }
        else{
          $moneyss = $zhuanjia['total_money'] - $money;
          $res = pdo_update("hyb_yl_zhuanjia",array("total_money"=>$moneyss),array("zid"=>$zhuanjia['zid']));
          if($res)
          {
            $datas = array(
                'uniacid' => $uniacid,
                "openid" => $openid,
                "money" => $moneys,
                "fee" => $shouxufei,
                "old_money" => $money,
                "zid" => $zhuanjia['zid'],
                "created" => time(),
                "type" => '1',
                "style" => '1',
                "cash" => '1',
                "cash_type" => $tx_type,
            );
            if($base['is_expert'] == '1')
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
    }
    
    
    
    echo json_encode($data);
  }

  // 获取专家余额
  public function zhuanjia_info()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $zid = $_GPC['zid'];
    $list = pdo_get("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$zid));
    $list['money'] = $list['total_money'];
    echo json_encode($list);
  }

  // 获取提现明细
  public function tixian_list()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $did = $_GPC['did'];
    $zid = $_GPC['zid'];
    $page = $_GPC['page'];
    $pagesize = $_GPC['pagesize'];
    if($did)
    {
      $list = pdo_fetchall("select a.*,b.title,b.thumb from ".tablename("hyb_yl_pay")." as a left join ".tablename("hyb_yl_guidance")." as b on b.id=a.did where a.uniacid=".$uniacid." and a.did=".$did." and a.style=0 and a.type=1 order by a.id desc limit ".$page * $pagesize.",".$pagesize);
    }else{
      $list = pdo_fetchall("select a.*,b.z_name as title,b.advertisement as thumb from ".tablename("hyb_yl_pay")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.zid=a.zid where a.uniacid=".$uniacid." and a.zid=".$zid." and a.style=1 and a.type=1 order by a.id desc limit ".$page * $pagesize.",".$pagesize);
    }
    
    foreach($list as &$value)
    {
      $value['thumb'] = tomedia($value['thumb']);
      $value['created'] = date("Y-m-d H:i:s",$value['created']);
    }
    
    echo json_encode($list);
  }

  // 提现设置
  public function cash_base()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $base = pdo_get("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid));
    $base['content'] = htmlspecialchars_decode($base['content']);
    $base['pay_type'] = unserialize($base['pay_type']);
    $base['money'] = unserialize($base['money']);
    $base['weixin_content'] = htmlspecialchars_decode($base['weixin_content']);
    $base['zfb_content'] = htmlspecialchars_decode($base['zfb_content']);
    $base['bank_content'] = htmlspecialchars_decode($base['bank_content']);
    echo json_encode($base);
  }

  // 查询绿通人员现在是否可以提现
  public function is_cash()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $did = $_GPC['did'];
    $zid = $_GPC['zid'];
    $money = $_GPC['money'];
    if($did)
    {
      $last = pdo_fetch("select created from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and did=".$did." and type=1 and style=0 and cash=1 order by id desc limit 0,1");

    }else if($zid){
      $last = pdo_fetch("select created from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and zid=".$zid." and type=1 and style=1 and cash=1 order by id desc limit 0,1");
    }
    
    $base = pdo_get("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid));
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
            $data = array(
                'code' => '0',
                'data' => $base,
            );
          }else{
            $data = array(
                'code' => '1',
                'message' => '请'.date("Y-m-d H:i:s",$next).'后提现',
                'data' => $base,
            );
          }
        }
        
    }else{
      $data = array(
          'code' => '0',
          'data' => $base,
      );
    }
    echo json_encode($data);
  }

  // 查看提现列表
  public function tixian_listall()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $type = $_GPC['type'];
    $where = " where uniacid=".$uniacid." and type=1 and cash=1 and status=1";
    if($type != '')
    {
      $where .= " and style=".$type;
    }
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_pay").$where." order by id desc limit 0,10");
    foreach($list as &$value)
    {
      if($value['style'] == '0')
      {
        $value['name'] = pdo_getcolumn("hyb_yl_guidance",array("id"=>$value['did']),'title');
      }else{
        $value['name'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$value['zid']),'z_name');
      }
      $value['name'] = substr_replace($value['name'],'***','3',strlen($value['name'])-6);
    }
    
    echo json_encode($list);
  }

  // 绿通订单返利
  public function orderfanli()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $back_orser = $_GPC['back_orser'];
    $order = pdo_get("hyb_yl_guidance_order",array("uniacid"=>$uniacid));
    // $guidance = pdo_get("hyb_yl_")
  }
  //获取access_token
    public function get_access_token(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}' ", array(":uniacid" => $uniacid));
        $appid = $result['appid'];
        $secret = $result['appsecret'];
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
        return $this->curl_get($url);
    }
    //开启curl get请求    
    public function curl_get($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $data;
    }
    public  function sendCmd($url,$data)
    {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检测
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Expect:')); //解决数据包大不能提交
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回

        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno'.curl_error($curl);
        }
        curl_close($curl); // 关键CURL会话
        return $tmpInfo; // 返回数据
    }
  
  }


