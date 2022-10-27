<?php
/**
* 
*/

 class Team extends HYBPage
 { 
  // 列表页
  public function lists()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $keshi = $_GPC['keshi'];
    $keyword = $_GPC['keyword'];
    $order = $_GPC['order'];
    $where = " where uniacid=".$uniacid." and is_show=1";
    $orders = " order by sort desc";
    $type = $_GPC['type'];
    $shequ = $_GPC['shequ'];
    $latitude = $_GPC['latitude'];
    $longitude = $_GPC['longitude'];
    if($shequ != '')
    {
      $where .= " and cid=".$shequ;
    }
    if($keshi != '')
    {
      $where .= " and keshi_one=".$keshi;
    }
    if($type != '')
    {
      $where .= " and type=".$type;
    }
    if($order == '0')
    {
      $order = " order by xn_answer desc";
    }else if($order == '1')
    {
      $order = " order by xn_chufang desc";
    }else if($order == '2')
    {
      $order = " order by times desc";
    }
    if($keyword != '')
    {
      $where .= " and title like '%$keyword%'";
    }

    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];

    $list = pdo_fetchall("select * from ".tablename("hyb_yl_team").$where);

    foreach($list as &$value)
    {
      $value['thumb'] = tomedia($value['thumb']);
      $value['keshis'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['keshi_two']),'name');
      $service = pdo_fetch("select * from ".tablename("hyb_yl_team_serverlist")." where tid=".$value['id']." order by ptmoney");
     
      $value['min'] = $service['ptmoney'];
      $value['label'] = json_decode($value['label'],true);
      $R = 6371; //地球平均半径,单位km
      $dlat = deg2rad($value['latitude']-$latitude);
      $dlon = deg2rad($value['longitude']-$longitude);
      $a = pow(sin($dlat/2), 2) + cos(deg2rad($latitude)) * cos(deg2rad($latitude)) * pow(sin($dlon/2), 2);
      $c = 2 * atan2(sqrt($a), sqrt(1-$a));
      $d = $R * $c;
      $ac = round($d,2);//两地间距离（四舍五入，保留两位）
      $value['juli'] = $ac;
    }
    array_multisort(array_column($list,'juli'),SORT_ASC,$list);
    $list = array_slice($list, $page * $pagesize,$pagesize);
      
    echo json_encode($list);
  }

  // 获取社区列表
  public function shequ()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $list = pdo_getall("hyb_yl_community",array("uniacid"=>$uniacid,"status"=>'1'));
    echo json_encode($list);
  }
  // 获取科室一级分类
  public function keshi_one()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $list = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'0'));
    echo json_encode($list);
  }
    // 获取二级科室
  public function keshi_two()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $list = pdo_getall("hyb_yl_ceshi",array("uniacid"=>$uniacid,"giftstatus"=>$id));
    echo json_encode($list);
  }
  // 获取团队详情
  public function detail()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $zid = $_GPC['zid'];
    $openid = $_GPC['openid'];

    $item = pdo_get("hyb_yl_team",array("uniacid"=>$uniacid,"id"=>$id));

    if($openid != '')
    {
      $user = pdo_get("hyb_yl_userinfo",array("uniacid"=>$uniacid,"openid"=>$openid));
      if($user['adminuserdj'] != '0' && $user['adminguanbi'] > time())
      {
        $item['vip'] = true;
      }else{
        $item['vip'] = false;
      }
        $res = pdo_get("hyb_yl_visit",array("openid"=>$openid,"tid"=>$id,"type"=>'2','day'=>date("Y-m-d",time())));
          if(!$res)
          {
              $visit = array(
                'uniacid' => $uniacid,
                "openid" => $openid,
                "tid" => $id,
                "type" =>'2',
                "day" => date("Y-m-d",time()),
                "created" => time(),
              );
              pdo_insert("hyb_yl_visit",$visit);
          }
    }
    $item['label'] = json_decode($item['label'],true);
    $fuze = pdo_fetch("select * from ".tablename("hyb_yl_zhuanjia")." where zid=".$item['zid']);
    $fuze['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$fuze['parentid']),'name');
    $fuze['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$fuze['hid']),'agentname');
    $fuze['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$fuze['z_zhicheng']),'job_name');
    $item['advertisement'] = tomedia($fuze['advertisement']);

    $item['fuze'] = $fuze;
    $item['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$item['keshi_two']),'name');
    $item['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$item['jigou_two']),'agentname');
    $zhuanjias = pdo_fetchall("select * from ".tablename("hyb_yl_zhuanjia")." where zid=".$item['zid']);
    $zhuanjiass = pdo_fetch("select * from ".tablename("hyb_yl_zhuanjia")." where zid=".$item['zid']);
    $zhuanjia = pdo_fetchall("select z.* from ".tablename("hyb_yl_team_people")." as p left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=p.y_zid where p.tid=".$id." and p.y_zid !=".$item['zid']);
    
    if($zhuanjia)
    {
      array_push($zhuanjia,$zhuanjiass);
    }else{
      $zhuanjia = $zhuanjias;
    }

    $score = 0;
    $pingjia = 0;
    if($item['cid'] != '')
    {
      $item['c_name'] = pdo_getcolumn("hyb_yl_community",array("id"=>$item['cid']),'title');
    }
    $item['thumb'] = tomedia($item['thumb']);
   
    $orders = pdo_fetch("select count(*) as count,sum(money) as money from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and tid=".$id);
    if($orders['money'])
    {
       $moneys = $orders['money'];
    }else{
      $moneys = 0;
    }
   
    $nums = $orders['count'];
    foreach($zhuanjia as &$value)
    {
      $tuwen = pdo_fetch("select count(*) as count,sum(money) as money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and ifpay != '0' and zid=".$value['zid']);
      $guahao = pdo_fetch("select count(*) as count,sum(money) as money from ".tablename("hyb_yl_guabaoorders")." where uniacid=".$uniacid." and isPay=1 and zid=".$value['zid']);
      $wenzhen = pdo_fetch("select count(*) as count,sum(money) as money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and ifpay != '0' and zid=".$value['zid']);
      if(!$tuwen['money'])
      {
        $tuwen['money'] = 0;
      }
      if(!$guahao['money'])
      {
        $guahao['money'] = 0;
      }
      if(!$wenzhen['money'])
      {
        $wenzhen['money'] = 0;
      }
      $num += $tuwen['count'] + $guahao['count'] + $wenzhen['count'];
      $moneys += $tuwen['money'] + $tuwen['money'] + $wenzhen['money'];
      $value['advertisement'] = tomedia($value['advertisement']);
      $value['keshis'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
      $value['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
      $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
      $pingjias = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_pingjia")." where uniacid=".$uniacid." and zid=".$value['y_zid']);
      $scores = pdo_fetchcolumn("select sum(startsnum) from ".tablename("hyb_yl_pingjia")." where uniacid=".$uniacid." and zid=".$value['zid']);
      if($pingjias > 0)
      {
        $value['score'] = ceil($scores / $pingjias);
      }else{
        $value['score'] = 5;
      }
      $pingjia += pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_pingjia")." where uniacid=".$uniacid." and zid=".$value['y_zid']);
      $score += pdo_fetchcolumn("select sum(startsnum) from ".tablename("hyb_yl_pingjia")." where uniacid=".$uniacid." and zid=".$value['zid']);
    }
    $item['nums'] = $nums;
    $item['moneys'] = $moneys;
    $node_count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_node")." where tid=".$id);
    $item['node_count'] = $node_count;
    $item['zhuanjia'] = $zhuanjia;
    if($pingjia > 0)
    {
      $item['score'] = ceil($score / $pingjia);
    }else{
      $item['score'] = 5;
    }
    $item['server'] = pdo_fetchall("select s.*,t.ftitle,t.thumb,t.thumb,t.icon,t.server_content,t.url,c.title,c.time_leng,c.money from ".tablename("hyb_yl_team_serverlist")." as s left join ".tablename("hyb_yl_docser_speck")." as t on t.id=s.bid left join ".tablename("hyb_yl_docserver_type")." as c on c.typeid=s.bid where s.tid=".$id." and s.uniacid=".$uniacid);
    foreach($item['server'] as &$server)
    {
      
      $server['thumb'] = tomedia($server['thumb']);
      $server['icon'] = tomedia($server['icon']);
      $server['server_content'] = htmlspecialchars_decode($server['server_content']);
      
    }
    // $item['plugin'] = unserialize($item['plugin']);
    // foreach($item['plugin']['info'] as &$plugin)
    // {
    //   $speck = pdo_get("hyb_yl_docser_speck",array("key_words"=>$plugin['key_words'],'uniacid'=>$uniacid));
    //   $speck['thumb'] = tomedia($speck['thumb']);
    //   $speck['icon'] = tomedia($speck['icon']);
    //   $speck['server_content'] = htmlspecialchars_decode($speck['server_content'],true);
    //   $plugin['info'] = $speck;
    // }
    
    $is_collect = pdo_get("hyb_yl_attention",array("goods_id"=>$id,"cerated_type"=>'6'));
    if($is_collect)
    {
      $item['collect'] = true;
    }else{
      $item['collect'] = false;
    }

    if(empty($item['erweima'])){
      //保存
      $qr_path = "../attachment/";
      if(!file_exists($qr_path.'hyb_yl/')){
          mkdir($qr_path.'hyb_yl/', 0700,true);//判断保存目录是否存在，不存在自动生成文件目录
      }
      $filename = 'hyb_yl/'.time().'.png';
      $file = $qr_path.$filename; 
      $access = json_decode($this->get_access_token(),true);
      $access_token= $access['access_token'];
      $url = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token='.$access_token;
      $qrcode = array(
          'scene'         => $id,//二维码所带参数
          'width'         => 200,
          'page'          => 'hyb_yl/zhuanjiasubpages/pages/teamcenters/teamcenters',//二维码跳转路径（要已发布小程序）
          'auto_color'    => true
      );
      $result = $this->sendCmd($url,json_encode($qrcode));//请求微信接口
      
      $res = file_put_contents($file,$result);//将微信返回的图片数据流写入文件
      
      $datas = array('erweima' => $file);
      $getupdate = pdo_update("hyb_yl_team", $datas, array('id' => $id, 'uniacid' => $uniacid));
      $item['erweima'] = $_W['siteroot'].$file;
  }else{
      $item['erweima'] = $_W['siteroot'].$item['erweima'];
   }
   $rule = pdo_get("hyb_yl_team_rule",array("uniacid"=>$uniacid));
   $rule['background'] = tomedia($rule['background']);
   $rule['thumb'] = tomedia($rule['thumb']);
   $item['rule'] = $rule;
   $node = pdo_fetch("select * from ".tablename("hyb_yl_teamment")." where uniacid=".$uniacid." and t_id=".$id." order by g_id desc");
   $item['node'] = $node;

    echo json_encode($item);
  }

  // 获取团队评价
  public function getpingjia()
  {
    global $_W,$_GPC;
    $id = $_GPC['id'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $zhuanjia = pdo_getall("hyb_yl_team_people",array("tid"=>$id,"status"=>'1'));
    $pingjia = array();
    foreach($zhuanjia as &$value)
    {
      $pingjias = pdo_fetchall("select p.*,u.u_name,u.u_thumb from ".tablename("hyb_yl_pingjia")." as p left join ".tablename("hyb_yl_userinfo")." as u on u.openid=p.openid where p.zid=".$value['y_zid']);
      
      array_merge($pingjia,$pingjias);
    }

    $list = array_slice($pingjia, $page * $pagesize,$pagesize);
    foreach($list as  &$values)
    {
      $values['created'] = date("Y-m-d H:i:s",$value['created']);
    }
    echo json_encode($list);
  }


  // 查看专家是否加入团队
  public function is_input()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $tid = $_GPC['tid'];
    $zid = $_GPC['zid'];
    $openid = $_GPC['openid'];
    $y_zid = $_GPC['y_zid'];
    $y_openid = $_GPC['y_openid'];
    $res = pdo_get("hyb_yl_team_people",array("tid"=>$tid,"openid"=>$openid,"zid"=>$zid,"y_zid"=>$y_zid,"y_openid"=>$y_openid));
    if($res)
    {
      $data = array(
          'code' => '1',
          "message" => '您已加入该团队',
      );
    }else {
      $data = array(
          'code' => '0'
      );
    }
    echo json_encode($data);
  }
  // 扫码加入团队
  public function add_teams()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $tid = $_GPC['tid'];
    $zid = $_GPC['zid'];
    $openid = $_GPC['openid'];
    $y_zid = $_GPC['y_zid'];
    $y_openid = $_GPC['y_openid'];
    $data = array(
        'uniacid' => $uniacid,
        "tid" => $tid,
        "openid" => $_GPC['openid'],
        "zid" => $zid,
        "y_openid" => $y_openid,
        "y_zid" => $y_zid,
        "status" => '1',
        "created" => time(),
        "add_time" => time(),
        "type" => 1
    );
    pdo_insert("hyb_yl_team_people",$data);
    
  }

  // 查看团队成员
  public function team_people()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $keyword = $_GPC['keyword'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $where = " where p.uniacid=".$uniacid." and p.tid=".$id;
    $type = $_GPC['type'];
    if($type == '0')
    {
      $where .= " and p.status=1";
      $people = pdo_fetchall("select z.*,p.status from ".tablename("hyb_yl_team_people")." as p left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=p.y_zid ".$where." order by p.id desc limit ".$page * $pagesize.",".$pagesize);
      foreach($people as &$value)
      {
        $value['advertisement'] = tomedia($value['advertisement']);
        $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
        $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
        $value['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
        $pingjia = pdo_fetch("selct count(*) as count,sum(starsnum) as sum from ".tablename("hyb_yl_pingjia")." where zid=".$value['zid']);
        if($pingjis['count'] > 0)
        {
          $value['pingjia'] = ceil($pingjia['sum'] / $pingjia['count']);
        }
      }
    }else if($type == '1')
    {
      $zid = pdo_fetchall("select y_zid from ".tablename("hyb_yl_team_people")." where uniacid=".$uniacid." and status !=2 and tid=".$id);
      $zid = array_column($zid, 'y_zid');
      $zids ='';
      foreach($zid as &$value)
      {
          $zids .= $value.",";
      }
      $zids = substr($zids,0,strlen($zids)-1);

      $people = pdo_fetchall("select * from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and zid not in (".$zids.") order by zid desc limit ".$page * $pagesize .",".$pagesize);
      
      foreach($people as &$value)
      {
        $value['advertisement'] = tomedia($value['advertisement']);
        $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
        $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
        $value['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
        $pingjia = pdo_fetch("selct count(*) as count,sum(score) as sum from ".tablename("hyb_yl_pingjia")." where zid=".$value['zid']);
        if($pingjis['count'] > 0)
        {
          $value['pingjia'] = ceil($pingjia['sum'] / $pingjia['count']);
        }
      }
    }
    
    echo json_encode($people);
  }

  // 查看团队签约患者
  public function team_order()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $page = $_GPC['page'];
    $pagesize = $_GPC['pagesize'];
    $type = $_GPC['type'];
    $where = " where o.uniacid=".$uniacid." and o.ifpay!=0 and o.ifpay !=6 and o.ifpay!=4 and o.tid=".$id;
    if($type != '')
    {
        $where .= " and o.type=".$type;
    }
    $list = pdo_fetchall("select o.*,u.u_name,u.u_thumb,j.sex,j.age,u.u_id from ".tablename("hyb_yl_teamorder")." as o left join ".tablename("hyb_yl_userinfo")." as u on u.openid=o.openid left join ".tablename("hyb_yl_userjiaren")." as j on j.openid=o.openid ".$where." order by o.id desc limit ".$page * $pagesize .",".$pagesize);
      foreach($list as &$value)
      {
        $value['fuwu'] = pdo_getcolumn("hyb_yl_docser_speck",array("key_words"=>$value['key_words']),'titlme');
      }
    echo json_encode($list);
  }
  // 平台服务时间
  public function servertime() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = intval($_GPC['id']);

        $list_fuwu = pdo_fetchall("SELECT * from" . tablename('hyb_yl_team_serverlist') . "where uniacid='{$uniacid}' and tid ='{$id}'");

        $fw_list = pdo_fetchall("SELECT a.*,b.title,b.id as bid,b.money FROM" . tablename("hyb_yl_docser_speck") . "as a left join" . tablename('hyb_yl_docserver_type') . "as b on b.typeid=a.id where a.uniacid ='{$uniacid}'");

        $val = array_merge($list_fuwu, $fw_list);

        $newArr = array();
        foreach ($val as $v) {
          
            if (!isset($newArr[$v['key_words']])) 
            {
              $newArr[$v['key_words']] = $v;
            }
            else {
              $newArr[$v['key_words']]["url"].= $v["url"];
              $newArr[$v['key_words']]["server_content"].= $v["server_content"];
              $newArr[$v['key_words']]["icon"].= $v["icon"];
              // $newArr[$v['key_words']]["id"].= $v["id"];
           
              $newArr[$v['key_words']]["ftitle"].= $v["ftitle"];
            }
        }

        $data_list = !$list_fuwu ? $fw_list : $newArr;
        foreach ($data_list as $key => $value) {
            //查询服务的到期时间
            $id = $value['id'];
            $speck_time = pdo_fetch("SELECT * FROM" . tablename('hyb_yl_team_serverlist') . "where uniacid='{$uniacid}' and id='{$id}'");
            $day = intval($speck_time['time_leng']);
            $date = date('Y-m-d', strtotime('+' . $day . ' days'));
            $startime = strtotime($data_list[$key]['time']);
            $newtime = strtotime(date("Y-m-d H:i:s"));
            //查询已经使用了多少天
            $date_time = date("Y-m-d H:i:s");
            $usetime = round(($newtime - $startime) / 3600 / 24);
            $endtime = strtotime($date); //到期时间戳
            $subtracttime = intval(($day - $usetime));
            $date_back = date('Y-m-d', strtotime('+' . $subtracttime . ' days'));
            $section = $this->calcTime($date_back, $date_time);
            $data_list[$key]['endtime'] = trim($section, '-');
            $data_list[$key]['icon'] = tomedia($data_list[$key]['icon']);
            // $data_list[$key]['money'] = $speck_time['money'];
            $cx_name = strip_tags(htmlspecialchars_decode($data_list[$key]['server_content']));
            $cx_name = str_replace(PHP_EOL, '', $cx_name);
            $cx_name = str_replace(array("&nbsp;", "&ensp;", "&emsp;", "&thinsp;", "&zwnj;", "&zwj;", "&ldquo;", "&rdquo;"), "", $cx_name);
            $data_list[$key]['server_content'] = $cx_name;

            $money = pdo_getcolumn("hyb_yl_docserver_type",array("uniacid"=>$uniacid,"typeid"=>$data_list[$key]['bid']),'money');

            if(!$money)
            {
                $money = '0.00';
            }
            if($data_list[$key]['overtime'] < time())
            {
              $data_list[$key]['gq'] = true;
              pdo_update("hyb_yl_team_serverlist",array("stateback"=>'0'),array("id"=>$data_list[$key]['id']));
            }else{
              $data_list[$key]['gq'] = false;
            }
            $data_list[$key]['money'] = $money;
        }

        
        echo json_encode($data_list);
    }
    private function calcTime($fromTime, $toTime) {
        //转时间戳
        $fromTime = strtotime($fromTime);
        $toTime = strtotime($toTime);
        //计算知时间差
        $newTime = $toTime - $fromTime;
        return round($newTime / 86400) . '天' . round($newTime % 86400 / 3600) . '小时' . round($newTime % 86400 % 3600 / 60) . '分钟到期';
    }

    // 服务订单下单
    public function server_pay()
    {
      global $_W,$_GPC;
      $id = $_GPC['id'];
      $uniacid = $_W['uniacid'];
      $orders = $this->getordernum();
      pdo_update("hyb_yl_team_serverlist",array("orders"=>$orders),array("id"=>$id));
      cache_write('uniacid',$_W['uniacid']);
      require_once dirname(dirname(dirname(__FILE__)))."/wxpay.php";
      $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
      $appid = $res['appid'];
      $openid = $_GPC['openid'];
      $mch_id = $res['mch_id'];
      $key = $res['pub_api'];
      $out_trade_no = $orders;
      $total_fee = $_GPC['money'];
      $noturl = 'http://'.$_SERVER['SERVER_NAME'].'';
      
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
    // 查看服务单个详情
    public function server_detail()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $res = pdo_fetch("SELECT * from".tablename('hyb_yl_team_serverlist')."WHERE uniacid='{$uniacid}' and id='{$id}'");
      echo json_encode($res);
    }
    // 团队服务状态修改
    public function update_switch()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $stateback = $_GPC['stateback'];
      $item = pdo_get("hyb_yl_team_serverlist",array("id"=>$id,"uniacid"=>$uniacid));
      $times = (int)$item['time_leng'];
      if(($item['overtime'] > time() && $stateback == '1') || $stateback == '0')
      {
        $data = array(
          'stateback'=>$stateback,
        );
      }else if($item['overtime'] < time() && $stateback == '1')
      {
          $overtime = strtotime("+$times day");
          $data = array(
              'stateback' => $stateback,
              'time' => date("Y-m-d H:i:s",time()),
              'overtime' => $overtime,
          );
      }else{
        $data = array(
          'stateback' => $stateback,
        );
      }
     
      
      $res = pdo_update("hyb_yl_team_serverlist",$data,array('id'=>$id));
      echo json_encode($res);
    }
    // 修改团队服务详情
    public function update_detail()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $data =array(
         'ptmoney' => $_GPC['ptmoney'],
         'ptzhuiw' => $_GPC['ptzhuiw'],
         'hymoney' => $_GPC['hymoney'],
         'hyzhuiw' => $_GPC['hyzhuiw'],
      );

      $res = pdo_update("hyb_yl_team_serverlist",$data,array('id'=>$id));
      echo json_encode($res);
    }
  // 团队设置服务
    public function update_server()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $key_words = $_GPC['key_words'];
      $tid = $_GPC['tid'];
      $fuwu = pdo_fetch("select * from ".tablename("hyb_yl_docser_speck")." as s left join ".tablename("hyb_yl_docserver_type")." as t on s.id=t.typeid where s.key_words='".$key_words."' and s.uniacid=".$uniacid);
      
      $res = pdo_get("hyb_yl_team_serverlist",array("key_words"=>$key_words,"tid"=>$tid));
      $data = array(
        'tid' => $tid,
        "uniacid" => $_W['uniacid'],
        "key_words" => $key_words,
        "bid" => $fuwu['typeid'],
        "titlme" => $fuwu['titlme'],
        "time_leng" => $fuwu['time_leng'],
        "ptmoney" => $_GPC['ptmoney'],
        "hymoney" => $_GPC['hymoney'],
        "hyzhuiw" => $_GPC['hyzhuiw'],
        "ptzhuiw" => $_GPC['ptzhuiw'],
        
      );
      
      if($res)
      {
        pdo_update("hyb_yl_team_serverlist",$data,array("id"=>$res['id']));
      }else{
        $data['time'] = date("Y-m-d H:i:s",time());
        $data['stateback'] = '1';
        
        pdo_insert("hyb_yl_team_serverlist",$data);
      }
    }
  // 查看团队服务
  public function team_service()
  {
    global $_W,$_GPC;
    $id = $_GPC['id'];
    $uniacid = $_W['uniacid'];
    $list = pdo_fetchall("select s.*,d.thumb,d.icon from ".tablename("hyb_yl_team_serverlist")." as s left join ".tablename("hyb_yl_docser_speck")." as d on d.id=s.bid where s.tid=".$id." and s.uniacid=".$uniacid);

    $fw_list = pdo_fetchall("SELECT a.*,b.title,b.id as bid,b.time_leng FROM".tablename("hyb_yl_docser_speck")."as a left join".tablename('hyb_yl_docserver_type')."as b on b.typeid=a.id where a.uniacid ='{$uniacid}'");
    
    $rwo = pdo_fetch("select count(*) as count from".tablename("hyb_yl_team_serverlist")."where uniacid='{$uniacid}' and tid ='{$id}'");

    //查专家开通的服务包
    $list_fuwu = pdo_fetchall("SELECT s.* from".tablename('hyb_yl_team_serverlist')."where uniacid='{$uniacid}' and tid ='{$id}'");
    $val2 = array_merge($list_fuwu,$fw_list);
    $newArr2 = array();
    foreach($val2 as $v) {
      if(! isset($newArr2[$v['key_words']])) 
      {
        $newArr2[$v['key_words']] = $v;
      }else {
        $newArr2[$v['key_words']]["url"] .=  $v["url"];
      }
    }
    $data_list2 = !$list_fuwu?$fw_list:$newArr2;
    foreach($data_list2 as &$value)
    {
      $value['server_content'] = htmlspecialchars_decode($value['server_content']);
    }
    
    // foreach($list as &$value)
    // {
    //   $value['thumb'] = tomedia($value['thumb']);
    //   $value['icon'] = tomedia($value['icon']);
    // }
    echo json_encode($data_list2);
  }
  // 查看团队是否开启服务
  public function servers()
  {
    global $_W,$_GPC;
    $id = $_GPC['id'];
    $uniacid = $_W['uniacid'];
    $list = pdo_getall("hyb_yl_team_serverlist",array("tid"=>$id,"uniacid"=>$uniacid));

    if($list)
    {
      foreach($list as &$service)
      {
        $speck = pdo_fetch("select s.*,t.money,t.time_leng from ".tablename("hyb_yl_docser_speck")." as s left join ".tablename("hyb_yl_docserver_type")." as t on t.typeid=s.id where s.uniacid=".$uniacid." and s.state=1 and s.id=".$service['bid']);
        $service['money'] = $speck['money'];
        $service['icon'] = tomedia($speck['icon']);
        $service['thumb'] = tomedia($speck['thumb']);
        if($service['stateback'] == '1')
        {
          $day = intval($speck['time_leng']);
          $date = date('Y-m-d', strtotime('+' . $day . ' days'));
          $startime = strtotime($service['time']);
          $newtime = strtotime(date("Y-m-d H:i:s"));
          //查询已经使用了多少天
          $date_time = date("Y-m-d H:i:s");
          $usetime = round(($newtime - $startime) / 3600 / 24);
          $endtime = strtotime($date); //到期时间戳
          $subtracttime = intval(($day - $usetime));
          $date_back = date('Y-m-d', strtotime('+' . $subtracttime . ' days'));
          $section = $this->calcTime($date_back, $date_time);
          $service['endtime'] = trim($section, '-');

        }
        $service['time'] = time();
        $service['server_content'] = htmlspecialchars_decode($speck['server_content']);
      }
    }else{
      $list = pdo_fetchall("select s.*,t.money,t.time_leng from ".tablename("hyb_yl_docser_speck")." as s left join ".tablename("hyb_yl_docserver_type")." as t on t.typeid=s.id where s.uniacid=".$uniacid." and s.state=1");
      foreach($list as &$value)
      {
        $value['icon'] = tomedia($value['icon']);
        $value['thumb'] = tomedia($value['thumb']);
        $value['stateback'] = '0';
        $value['server_content'] = htmlspecialchars_decode($value['server_content']);
        $value['time'] = time();
      }
    }
    
    
    echo json_encode($list);
  }
  // 改变团队开通服务
  public function changesfw()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $stateback = $_GPC['stateback'];
    pdo_update("hyb_yl_team_serverlist",array("stateback"=>$stateback),array("id"=>$id));
  }

  // 专家开通服务
  public function fw_pay(){
    global $_W,$_GPC;
    $data = array(
      'uniacid' => $_W['uniacid'],
      "tid" => $_GPC['tid'],
      "openid" => $_GPC['openid'],
      "money" => $_GPC['money'],
      "key_words" => $_GPC['key_words'],
      "bid" => $_GPC['bid'],
      "titlme" => $_GPC['titlme'],
      "time_leng" => $_GPC['time_leng'],
      "status" => '0',
      "created" => time(),
      "orders" => $this->getordernum(),
      "back_orders" => $this->getordernum(),
    );
    pdo_insert("hyb_yl_team_serverlog",$data);
    $id = pdo_insertid();
    $row = pdo_get("hyb_yl_team_serverlog",array('id'=>$id));
    echo json_encode($row);
  }
  public function payqianyue() {
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
      $noturl = 'http://'.$_SERVER['SERVER_NAME'].'/addons/hyb_yl/qynoturl.php';
      
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

  public function getorders() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $order_one_msg = pdo_get("hyb_yl_team_serverlog", array('id' => $id, 'uniacid' => $uniacid));
        
        $near = $_GPC['near'];
        $textarea = $this->subtext($_GPC['val'], 10);
        $text = "[" . $near . "]" . "问诊描述:" . $textarea;
        $tid = $_GPC['tid'];
        $near = $_GPC['near'];
        $user = pdo_fetch("select * from ".tablename("hyb_yl_team")." where uniacid=:uniacid and id=:id", array(':uniacid' => $uniacid, ':id' => $tid));
        $us_openid = $user['openid'];
        $username = $user['title']; //专家名称
        $wxappaid = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
        $wxapp_mb = unserialize($wxappaid['wxapp_mb']);
        $wxapptemp = pdo_get('hyb_yl_wxapptemp', array('uniacid' => $uniacid));
        $appid = $wxappaid['appid'];
        $appsecret = $wxappaid['appsecret'];
        $template_id = $wxapp_mb['Mobile'];
        $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
        $getArr = array();
        $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
        $access_token = $tokenArr->access_token;
        $url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=' . $access_token;
        $data_time = date("Y-m-d H:i:s");
        //专家回复
        $doctor_over_msg = "患者发起" . $near . "咨询";
        //专家回复时间￥
        $doctor_over_time = "请在小程序专家端查看";
        $dd['data'] = ['thing1' => ['value' => $text], 'thing2' => ['value' => $doctor_over_msg], 'name3' => ['value' => $username], 'thing4' => ['value' => $doctor_over_time], ];
        $dd['touser'] = $us_openid;
        $dd['template_id'] = $template_id;
        $dd['page'] = 'hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words='.$near;
        $result1 = $this->https_curl_json($url, $dd, 'json');
        echo json_encode($result1);
    }
  // 查看团队公告
  public function team_node()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $zid = $_GPC['zid'];
    $fuze = pdo_getcolumn("hyb_yl_team",array("id"=>$id),'zid');
    if($zid == $fuze)
    {
      $is_create = true;
    }else{
      $is_create = false;
    }
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_node")." where uniacid=:uniacid and tid=:tid order by id desc limit ".$page * $pagesize .",".$pagesize,array(":uniacid"=>$uniacid,":tid"=>$id));
    foreach($list as &$value)
    {
      $value['created'] = date("Y-m-d H:i:s",$value['created']);
      
    }
    $lists = array(
        'list' => $list,
        'is_create' => $is_create,
    );
    echo json_encode($lists);

  }
  // 获取支付页详情
  public function order_detail()
  {
    global $_W,$_GPC;
    $id = $_GPC['id'];
    $uniacid = $_W['uniacid'];
    $key_words = $_GPC['key_words'];
    $item = pdo_get("hyb_yl_team",array("uniacid"=>$uniacid,"id"=>$id));
    $item['label'] = json_decode($item['label'],true);
    if($item['zid'])
    {
      $fuze = pdo_fetch("select * from ".tablename("hyb_yl_zhuanjia")." where zid=".$item['zid']);
    $item['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$fuze['z_zhicheng']),'job_name');
    
    $item['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$fuze['hid']),'agentname');
    }
    
    
    if($item['cid'] != '')
    {
      $item['c_name'] = pdo_getcolumn("hyb_yl_community",array("id"=>$item['cid']),'title');
    }
    $server = pdo_fetch("select s.*,d.icon,d.server_content,d.thumb from ".tablename("hyb_yl_team_serverlist")." as s left join ".tablename("hyb_yl_docser_speck")." as d on d.id=s.bid where s.key_words=:key_words and s.tid=:tid",array(":key_words"=>$key_words,':tid'=>$id));
    
    $times = (int)$server['time_leng'];
    $end = date('Y-m-d',strtotime('+'.$times.' days'));
    
    $start = date("Y-m-d",time());
    $item['start'] = $start;
    $item['end'] = $end;
    $item['thumb'] = tomedia($item['thumb']);
    $server['icon'] = tomedia($server['icon']);
    $server['thumb'] = tomedia($server['thumb']);
    $server['server_content'] = htmlspecialchars_decode($server['server_content'],true);
    $item['server'] = $server;
    echo json_encode($item);

  }
  // 查询用户是否签约该服务
  public function is_qianyue()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $key_words = $_GPC['key_words'];
    $tid = $_GPC['tid'];
    $j_id = $_GPC['j_id'];
    $res = pdo_get("hyb_yl_teamorder",array("openid"=>$openid,"tid"=>$tid,"key_words"=>$key_words,"uniacid"=>$uniacid,"j_id"=>$j_id));
    if($res)
    {
      $data = array(
        'code' => '1',
        'message' => '您办理的该服务到期时间为'.date("Y-m-d H:i:s",$res['endtime']).',是否续签?',
      );
    }else
    {
      $data = array(
        'code' => '2',
        'message' => '',
      );
    }
    echo json_encode($data);
  }
  // 生成订单
  public function orders()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
    $chaoshi = $order_time['chaoshi'];
    $openid = $_GPC['openid'];
    $key_words = $_GPC['key_words'];
    $tid = $_GPC['tid'];
    $order = pdo_get("hyb_yl_teamorder",array("openid"=>$openid,"tid"=>$tid,"key_words"=>$key_words,"uniacid"=>$uniacid));
    $time_b = intval($chaoshi * 60);
    $newtime  = date("Y-m-d H:i:s");
    $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b);
    $data = array(
      "uniacid" => $_W['uniacid'],
      'tid' => $_GPC['tid'],
      "money" => $_GPC['money'],
      "openid" => $_GPC['openid'],
      "created" => time(),
      "start" => $_GPC['start'],
      'back_orser'=> $this->getordernum(),
      "coupon_id" => $_GPC['coupon_id'],
      'ifpay'   =>0,
      "j_id" => $_GPC['j_id'],
      'orders'  =>$this->getordernum(),
      'y_money' => $_GPC['y_money'],
      'ifgk' => 0,
      'role'  =>0,
      'key_words' =>$_GPC['key_words'],
      'addnum'    => $_GPC['addnum'],
      'overtime'  => strtotime($overtime)
    );
      if($order['ifpay'] == '1')
      {
        
        $res = pdo_update("hyb_yl_teamorder",array("ifpay"=>'7'),array("id"=>$order['id']));
        $row = $order;
      }else if($order['ifpay'] != '')
      {
        $res = pdo_update("hyb_yl_teamorder",array("ifpay"=>'0'),array("id"=>$order['id']));
        $row = $order;
      }else{
        $res = pdo_insert('hyb_yl_teamorder',$data);
        $id = pdo_insertid();
        $row = pdo_get("hyb_yl_teamorder",array('id'=>$id));
      }
       if($_GPC['key_words']=='tuwenwenzhen'){
        $keywords ='图文问诊';
       }
       if($_GPC['key_words']=='dianhuajizhen'){
        $keywords ='电话问诊';
       }
              if($_GPC['key_words']=='shipinwenzhen'){
        $keywords ='视频问诊';
       }
              if($_GPC['key_words']=='tijianjiedu'){
        $keywords ='体检解读';
       }
              if($_GPC['key_words']=='shoushukuaiyue'){
        $keywords ='手术快约';
       }
              if($_GPC['key_words']=='yuanchengguahao'){
        $keywords ='远程挂号';
       }
              if($_GPC['key_words']=='yuanchengkaifang'){
        $keywords ='远程开方';
       }
      //提醒患者签约成功
       $team = pdo_get('hyb_yl_team',array('id'=>$tid));
       $zid = $team['zid'];
       $title = $team['title'];
       $docinfo = pdo_get('hyb_yl_zhuanjia',array('zid'=>$zid));
       $z_name = $docinfo['z_name'];

       $j_id = $_GPC['j_id'];
       $userinfo = pdo_get('hyb_yl_userjiaren',array('j_id'=>$j_id));
       $user_name = $userinfo['names'];
       $user_sex = $userinfo['sex'];

       $wxapp = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
       $appid = $wxapp['pub_appid'];  //填写你公众号的appid
       $secret = $wxapp['appkey'];   //填写你公众号的secret
       $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
       $gzhmb = unserialize($wxapp['gzhmb']);
       $mbxs = $gzhmb['qysuccmoban'];
       $wxappaid = $wxapp['appid'];

       $getArr = array();
       $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
       $access_token = $tokenArr->access_token;
       $jztime = date("Y-m-d H:i:s");
       $posturl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
       $openid = $docinfo['openid'];
       $wxopenid = pdo_getcolumn('hyb_yl_userinfo',array('openid'=>$openid),'wxopenid');

       $template = array(
           "touser" => $wxopenid,
           "template_id" => $mbxs,
           "miniprogram"=>array(
               "appid"=>$wxappaid,
               "pagepath"=>'hyb_yl/mysubpages/pages/wodezixun/wodezixun?type='.$key_words.'&key_words='.$key_words
            ), 
           'topcolor' => '#ccc',
           'data' =>array('first' => array('value' =>'用户'.$user_name.'签约家庭医生成功通知',
                                              'color' =>"#743A3A",
           ),
               'keyword1' => array('value' =>$title,
                                   'color' =>'#FF0000',
               ),
               'keyword2' => array('value' =>'未签约医生',
                                   'color' =>'#FF0000',
               ),
               'remark'   => array('value' =>'服务：'.$keywords.'',
                                   'color' =>'#FF0000',
              ),
           )
      );
      $postjson = json_encode($template);
      $resder = $this->http_curl($posturl,'post','json',$postjson);
      echo json_encode($row); 

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
  public function getordernum(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
        $mch_id = $res['mch_id'];
        $out_trade_no = $mch_id . time();
        return $out_trade_no;
     }
  // 关注团队
  public function changelove() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $goods_id = $_GPC['zid'];
        $openid = $_GPC['openid'];
        $cerated_type = $_GPC['cerated_type'];
        $model = Model('attention');
        $get_one = $model->where('uniacid="' . $uniacid . '" and goods_id="' . $goods_id . '" and cerated_type="' . $cerated_type . '" and openid="' . $openid . '"')->get();
        $data = array('uniacid' => $uniacid, 'openid' => $openid, 'goods_id' => $goods_id, 'cerated_type' => $cerated_type, 'cerated_time' => date('Y-m-d H:i:s'));
        if ($get_one) {
            $res = $model->where('id="' . $get_one['id'] . '" and goods_id="' . $goods_id . '"')->delete($data);
        } else {
            $res = $model->add($data);
        }
        echo json_encode($res);
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

  public function paywenzhen() {
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
      $noturl = 'http://'.$_SERVER['SERVER_NAME'].'/addons/hyb_yl/teamnoturl.php';
      
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
  
  public function getdocmbtxing() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $order_one_msg = pdo_get("hyb_yl_teamorder", array('id' => $id, 'uniacid' => $uniacid));
        
        $near = $_GPC['near'];
        $textarea = $this->subtext($_GPC['val'], 10);
        $text = "[" . $near . "]" . "问诊描述:" . $textarea;
        $tid = $_GPC['tid'];
        $near = $_GPC['near'];
        $user = pdo_fetch("select t.* from ".tablename('hyb_yl_teamorder')." as o left join ".tablename("hyb_yl_team")." as t on t.id=o.tid where o.uniacid=:uniacid and o.id=:id", array(':uniacid' => $uniacid, ':id' => $id));
        $us_openid = $user['openid'];
        $username = $user['title']; //专家名称
        $wxappaid = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
        $wxapp_mb = unserialize($wxappaid['wxapp_mb']);
        $wxapptemp = pdo_get('hyb_yl_wxapptemp', array('uniacid' => $uniacid));
        $appid = $wxappaid['appid'];
        $appsecret = $wxappaid['appsecret'];
        $template_id = $wxapp_mb['Mobile'];
        $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
        $getArr = array();
        $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
        $access_token = $tokenArr->access_token;
        $url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=' . $access_token;
        $data_time = date("Y-m-d H:i:s");
        //专家回复
        $doctor_over_msg = "患者发起" . $near . "咨询";
        //专家回复时间￥
        $doctor_over_time = "请在小程序专家端查看";
        $dd['data'] = ['thing1' => ['value' => $text], 'thing2' => ['value' => $doctor_over_msg], 'name3' => ['value' => $username], 'thing4' => ['value' => $doctor_over_time], ];
        $dd['touser'] = $us_openid;
        $dd['template_id'] = $template_id;
        $dd['page'] = 'hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words='.$near;
        $result1 = $this->https_curl_json($url, $dd, 'json');
        echo json_encode($result1);
    }

    public function subtext($text, $length) {
        if (mb_strlen($text, 'utf8') > $length) {
            return mb_substr($text, 0, $length, 'utf8') . '...';
        } else {
            return $text;
        }
    }
  // 获取标签
  public function labels()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $item = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$id),'description');

    $item = explode('、', $item);
    $items = array();
    foreach($item as $key => $value)
    {
      $items[$key]['name'] = $value;
      $items[$key]['checked'] = false;
    }
    echo json_encode($items);
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
    // 团队信息
    public function team_detail()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $team = pdo_get("hyb_yl_team",array("uniacid"=>$uniacid,"id"=>$id));
      $team['thumb'] = tomedia($team['thumb']);
      $team['imgpath'] = tomedia($team['imgpath']);
      $team['plugin'] = unserialize($team['plugin']);
      $team['label'] = json_decode($team['label'],true);
      echo json_encode($team);
    }

    // 获取一级机构
    public function hospital()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $list = pdo_getall("hyb_yl_hospital_diction",array("uniacid"=>$uniacid,"state"=>'1'));

      echo json_encode($list);
    }

    // 获取二级机构
    public function jigou_two()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $list = pdo_getall("hyb_yl_hospital",array("groupid"=>$id,"uniacid"=>$uniacid));
      echo json_encode($list);
    }


    // 编辑新增团队
    public function add_team()
    {
      global $_W,$_GPC;

      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $label = $_REQUEST['label'];
      $label = str_replace('"',"",str_replace("]","",str_replace("[","", $label)));
      $label = explode(",",$label);
       
      $rule = pdo_get("hyb_yl_team_rule",array("uniacid"=>$uniacid));
      $rule['is_service'] = $rule['is_service'];
      $data = array(
          'uniacid' => $uniacid,
          "openid" => $_GPC['openid'],
          "title" => $_GPC['title'],
          "type" => $_GPC['type'],
          "telphone" => $_GPC['telphone'],
          "province" => $_GPC['province'],
          "city" => $_GPC['city'],
          "district" => $_GPC['district'],
          "lon" => $_GPC['lon'],
          "lat" => $_GPC['lat'],
          "keshi_one" => $_GPC['keshi_one'],
          "keshi_two" => $_GPC['keshi_two'],
          "label" => json_encode($label,true),
          "is_show" => $_GPC['is_show'],
          "thumb" => $_GPC['thumb'],
          "imgpath" => $_GPC['imgpath'],
          "xn_answer" => $_GPC['xn_answer'],
          "xn_chufang" => $_GPC['xn_chufang'],
          "times" => $_GPC['times'],
          "content" => $_GPC['content'],
          "address" => $_GPC['address'],
          "zid" => $_GPC['zid'],
          "cid" => $_GPC['cid'],
          "jigou_one" => $_GPC['jigou_one'],
          "jigou_two" => $_GPC['jigou_two'],
          
      );
      if($rule['is_service'] == '1')
      {
        $data['plugin'] = serialize($_GPC['plugin']);
      }
      if($rule['is_shenhe'] == '1')
      {
        $data['status'] = '1';
      }else{
        $data['status'] = '0';
      }

      if($id)
      {
        $res = pdo_update("hyb_yl_team",$data,array("id"=>$id));
        
      }else{
        $data['created'] = time();
        $res = pdo_insert("hyb_yl_team",$data);
        $id = pdo_insertid();
        $list = pdo_fetchall("select s.*,t.money,t.time_leng from ".tablename("hyb_yl_docser_speck")." as s left join ".tablename("hyb_yl_docserver_type")." as t on t.typeid=s.id where s.uniacid=".$uniacid." and s.state=1");
        foreach($list as &$value)
        {
          $data = array(
            'uniacid' => $uniacid,
            "tid" => $id,
            "key_words" => $value['key_words'],
            "bid" => $value['id'],
            "titlme" => $value['titlme'],
            "time_leng" => $value['time_leng'],
            "stateback" => '0',
          );
          pdo_insert("hyb_yl_team_serverlist",$data);
        }
      }
      $is_set = pdo_get("hyb_yl_team_people",array("tid"=>$id,"zid"=>$zid));
      if(!$is_set)
      {
        $data = array(
            'uniacid' => $uniacid,
            "tid" => $id,
            "y_openid" => $_GPC['openid'],
            "y_zid" => $_GPC['zid'],
            "status" => '1',
            "created" => time(),
            "add_time" => time(),
            "type" => '0'
        );
        pdo_insert("hyb_yl_team_people",$data);
      }

    }

    // 邀请专家加入团队
    public function invitation()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $data = array(
          'uniacid' => $uniacid,
          "zid" => $_GPC['zid'],
          "openid" => $_GPC['openid'],
          "y_zid" => $_GPC['y_zid'],
          "y_openid" => $_GPC['y_openid'],
          "status" =>'0',
          "tid" => $_GPC['tid'],
          "created" => time(),
          "type" => '1',
      );
      $res =pdo_insert("hyb_yl_team_people",$data);
      if($res)
      {
        $data = array('code'=>'1','message'=>'邀请成功');
      }else{
        $data = array("code" => '0','message'=>'邀请失败');
      }
      echo json_encode($data);
    }
    public function api_notice_increment($url, $data){
              $ch = curl_init();
             // $header = "Accept-Charset: utf-8";
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
              curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
              //curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
              curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
              curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
              curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              $tmpInfo = curl_exec($ch);
              if (curl_errno($ch)) {
                return false;
              }else{
            return $tmpInfo;
        }
      }
    public function https_curl_json($url, $data, $type) {
        if ($type == 'json') {
            $headers = array("Content-type: application/json;charset=UTF-8", "Accept: application/json", "Cache-Control: no-cache", "Pragma: no-cache");
            $data = json_encode($data);
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($curl);
        if (curl_errno($curl)) {
            echo 'Errno' . curl_error($curl); //捕抓异常
            
        }
        curl_close($curl);
        return $output;
    }
 public function send_post($url, $post_data,$method='POST') {
    $postdata = http_build_query($post_data);
    $options = array(
      'http' => array(
        'method' => $method, //or GET
        'header' => 'Content-type:application/x-www-form-urlencoded',
        'content' => $postdata,
        'timeout' => 15 * 60 // 超时时间（单位:s）
      )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
  }

  // 查询二级科室
  public function keshi_twos()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $list = pdo_getall("hyb_yl_ceshi",array("uniacid"=>$uniacid));
    echo json_encode($list);
  }
    public function getlistallzhuanjia()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $hid = $_GPC['hid'];
    $hospital = pdo_getall("hyb_yl_zhuanjia",array("hid"=>$hid));
    echo json_encode($hospital);
  }
  public function getlistall()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $hid = $_GPC['hid'];
    $order = $_GPC['order'];
    $zhicheng = $_GPC['zhicheng'];
    $keshi = $_GPC['keshi'];
    $status = $_GPC['status'];
    $keyword = $_GPC['keyword'];
    $page = $_GPC['page'] == '' ? '0' : $_GPC['page'];
    $pagesize = $_GPC['pagesize'] ? '10' : $_GPC['pagesize'];
    $where = " where a.uniacid=".$uniacid;
    if($hid != '')
    {
      $where .= " and a.hid=".$hid;
    }
    if($keyword != '')
    {
      $where .= " and a.z_name like '%$keyword%'";
    }
    if($zhicheng != '')
    {
      $where .= " and a.z_zhicheng=".$zhicheng;
    }
    if($status != '')
    {
      $where .= " and a.exa=".$status;
    }
    if($keshi != '')
    {
      $where .= " and a.parentid=".$keshi;
    }
    if($order == '0' || $order == '')
    {
      $where .= " order by a.zid desc ";
    }else if($order == '1')
    {
      $where .= " order by a.xn_reoly desc ";
    }else if($order == '2')
    {
      $where .= " order by a.score desc ";
    }else if($order == '3')
    {
      $where .= " order by a.xytime asc ";
    }
    
    $row = pdo_fetchall("SELECT * FROM " . tablename('hyb_yl_zhuanjia') . "as a left join".tablename('hyb_yl_zhuanjia_job')."as b on b.id=a.z_zhicheng {$where} limit ".$page * $pagesize.",".$pagesize);
    foreach ($row as $key => $value) {
        $zid = $value['zid'];
        $where2="WHERE uniacid = '{$uniacid}' and zid='{$zid}'";
        $row[$key]['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$row[$key]['parentid']),'name');
        $row[$key]['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$row[$key]['hid']),'agentname');
        $row[$key]['grade'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$row[$key]['hid']),'grade');
                
        $row[$key]['leve'] = pdo_getcolumn("hyb_yl_hospital_level",array("id"=>$row[$key]['grade']),'level_name');
        // $row[$key]['leve'] = pdo_getcolumn("hyb_yl_hospital_level",array("id"=>$row[$key]['hid']['grade']),'level_name');

        $row[$key]['yearcad'] = pdo_fetch("SELECT * from" . tablename('hyb_yl_yearcard') . "where zid='{$zid}' and typs=1");
        $row[$key]['advertisement'] = tomedia($row[$key]['advertisement']);
        $row[$key]['server'] = pdo_fetchall("SELECT key_words,titlme,ptmoney,hymoney from".tablename('hyb_yl_doc_all_serverlist')."{$where2}");
        $rows[$k]['serverss'] = pdo_getall("hyb_yl_doc_all_serverlist",array("zid"=>$v['zid'],"uniacid"=>$uniacid,"stateback"=>'1'));
        $rows[$k]['servers'] = pdo_fetch("select a.*,b.ser_url from ".tablename("hyb_yl_doc_all_serverlist")." as a left join ".tablename("hyb_yl_all_server_menulist")." as b on a.key_words=b.server_key where a.zid=".$v['zid']." and a.uniacid=".$uniacid." and a.key_words='".$server_key."' and a.stateback=1");
        $rows[$k]['jingxuan'] = explode(',', $value['jingxuan']);
    }
    echo json_encode($row);

  }

  
  }


