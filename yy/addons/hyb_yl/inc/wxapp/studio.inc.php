<?php
/**
* 
*/
 class Studio extends HYBPage
 { 
  //查询专家ID
   public function ifzhuanjia()
  {
     global $_GPC, $_W;
     $model = Model('zhuanjia');
     $uniacid = $_W['uniacid'];
     $openid = $_GPC['openid'];
     $res =pdo_fetch("SELECT a.*,b.agentname,c.name FROM".tablename('hyb_yl_zhuanjia')."as a left join".tablename('hyb_yl_hospital')."as b on b.hid=a.hid left join".tablename('hyb_yl_ceshi')."as c on c.id=a.parentid where a.uniacid='{$uniacid}' and a.openid='{$openid}'");
     $res['jingxuan'] = explode(",", $res['jingxuan']);

     $today = strtotime(date('Y-m-d',time()));
     $todays = date('Y-m-d',time());
     $yesterdays = date('Y-m-d H:i:s',strtotime($todays)-86400);

     // 图文订单数
    $yesterday = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
     $today_tw = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid=".$res['zid']." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and xdtime >=".$today." group by back_orser");

     $yes_tw =  pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid=".$res['zid']." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and xdtime >=".$yesterday." and xdtime <=".$today." group by back_orser");

     $today_wz = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid=".$res['zid']." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and paytime >=".$today." group by back_orser");
     $yes_wz =  pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid=".$res['zid']." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and paytime >=".$yesterday." and paytime <=".$today." group by back_orser");
     // 问诊订单数
  
     $res['today_wenzhen'] = count($today_tw) + count($today_wz);
     $res['yes_wenzhen'] = count($yes_tw) + count($yes_wz);
     $jiedu_money = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid=".$res['zid']." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and keywords='tijianjiedu'"." group by back_orser");
     $res['jiedu_money'] = array_sum(array_map(function($val){return $val['money'];}, $jiedu_money));
     
     if(!$res['jiedu_money'])
     {
         $res['jiedu_money'] = '0.00';
     }
     $shoushu_money= pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid=".$res['zid']." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and keywords='shoushukuaiyue'"." group by back_orser");
     $res['shoushu_money'] = array_sum(array_map(function($val){return $val['money'];}, $shoushu_money));
     if(!$res['shoushu_money'])
     {
         $res['shoushu_money'] = '0.00';
     }
     $res['year_money'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_user_yearcard")." where uniacid=".$uniacid." and zid=".$res['zid']." and status=1");
     if(!$res['year_money'])
     {
         $res['year_money'] = '0.00';
     }

     // 挂号订单数
     $today_guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid=".$res['zid']." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and paytime>=".$today." group by back_orser");
      $today_guahao = array_column($today_guahao, 'count(*)');
      
     $res['today_guahao'] = array_sum($today_guahao);
     $yes_guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid=".$res['zid']." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and paytime>=".$yesterday." and paytime <=".$today." group by back_orser");
     $yes_guahao = array_column($yes_guahao, 'count(*)');
     $res['yes_guahao'] = array_sum($yes_guahao);
     // 签约订单数
     $res['today_qianyue'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_attention")." where uniacid=".$uniacid." and goods_id=".$res['zid']." and (ifqianyue=1 or ifqianyue=2) and cerated_type=7 and cerated_time>='".$todays."'");
     $res['yes_qianyue'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_attention")." where uniacid=".$uniacid." and goods_id=".$res['zid']." and (ifqianyue=1 or ifqianyue=2) and cerated_type=7 and cerated_time>='".$yesterdays."' and cerated_time <='".$todays."'");
     
     // 访问量
     $res['today_visit'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_visit")." where uniacid=".$uniacid." and zid=".$res['zid']." and type=1 and created>=".$today);
     $res['yes_visit'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_visit")." where uniacid=".$uniacid." and zid=".$res['zid']." and type=1 and created>=".$yesterday." and created <=".$today);
     
     $res['qianyue_user'] = pdo_fetchcolumn("SELECT count(*) FROM".tablename('hyb_yl_attention')."as a left join".tablename('hyb_yl_userinfo')."as b on b.openid=a.openid WHERE a.uniacid='{$uniacid}' and a.goods_id='".$res['zid']."' and a.cerated_type=7 and b.openid is not NULL and (a.ifqianyue=1 or a.ifqianyue=2)");
     $res['year_user'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_user_yearcard")." where uniacid=".$uniacid." and zid=".$res['zid']." and status=1 and end_time>=".time());
     
     $gh_huanzhe = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid=".$res['zid']." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) group by back_orser");
     $tw_huanzhe = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid=".$res['zid']." and (ifpay != 0 and ifpay != 6 and ifpay != 7) group by back_orser");
     $wz_huanzhe = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid=".$res['zid']." and (ifpay != 0 and ifpay != 6 and ifpay != 7) group by back_orser");
    $lists = array_merge($gh_huanzhe,$tw_huanzhe,$wz_huanzhe);
            $tmp_arr = array();
               foreach($lists as $k => $v)
              {
                 if(in_array($v[$key], $tmp_arr))//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
                {
                   unset($lists[$k]);
                }
              else {
                  $tmp_arr[] = $v[$key];
                }
              }
        sort($lists);
     $res['pt_user'] = count($lists);
     
    
     // 问诊收益
     $tw_money = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and zid=".$res['zid']." group by back_orser");

    $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tw_money));
     $wz_money = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and zid=".$res['zid']." group by back_orser");
      $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wz_money));
     if($tw_money == NULL)
     {
      $tw_money = '0.00';
     }
     if($wz_money == NULL)
     {
      $wz_money = '0.00';
     }
     // $wz_money = sprintf("%.2f",$wz_money + $tw_money);
     // var_dump($wz_money);
     // exit();
     $res['wz_money'] = sprintf("%.2f",$wz_money + $tw_money);
     
     // 挂号收益
     $guahao_money = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and (is_pay != 0 and is_pay != 6 and is_pay != 7 and is_pay!=8) and zid=".$res['zid']." group by back_orser");
     $guahao_money = array_sum(array_map(function($val){return $val['money'];}, $guahao_money));
     if($guahao_money == NULL)
     {
      $guahao_money = '0.00';
     }
     $res['guahao_money'] = $guahao_money;
     // 签约收益
     $qianyue_money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_qianyueorder")." where uniacid=".$uniacid." and (ispay != 0 and ispay != 6 and ispay != 7 and ispay!=8) and zid=".$res['zid']);
     if($qianyue_money == NULL)
     {
      $qianyue_money = '0.00';
     }
     $res['qianyue_money'] = $qianyue_money;
     // 开药收益
     $kaiyao_money = pdo_fetchall("select money from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and (is_pay != 0 and is_pay != 6 and is_pay != 7 and is_pay!=8) and zid=".$res['zid']." group by back_orser");
     
     $kaiyao_money = array_sum(array_map(function($val){return $val['money'];}, $kaiyao_money));
     if($kaiyao_money == NULL)
     {
      $kaiyao_money = '0.00';
     }
     $res['kaiyao_money'] = $kaiyao_money;

     // 总收益
     $res['shouyi'] = sprintf("%.2f",$wz_money + $tw_money + $guahao_money + $qianyue_money + $kaiyao_money);
    
     // 总支出
     $res['pay'] = pdo_fetchcolumn("select sum(s.money) from ".tablename("hyb_yl_doc_all_serverlist")." as s left join ".tablename("hyb_yl_docserver_type")." as t on t.id=s.bid where s.uniacid=".$uniacid." and s.zid=".$res['zid']." and stateback=1");
     
     // 未结算订单
     $tw_moneys = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and ifpay=0 and zid=".$res['zid']." group by back_orser");
     $tw_moneys = array_sum(array_map(function($val){return $val['money'];}, $tw_moneys));

     $wz_moneys = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and ifpay=0 and zid=".$res['zid']." group by back_orser");
     $wz_moneys = array_sum(array_map(function($val){return $val['money'];}, $wz_moneys));
     if($tw_moneys == NULL)
     {
      $tw_moneys = '0.00';
     }
     if($wz_moneys == NULL)
     {
      $wz_moneys = '0.00';
     }
     // 挂号
     $guahao_moneys = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and is_pay=0 and zid=".$res['zid']." group by back_orser");
     $guahao_moneys = array_sum(array_map(function($val){return $val['money'];}, $guahao_moneys));
     if($guahao_moneys == NULL)
     {
      $guahao_moneys = '0.00';
     }
     // 签约
     $qianyue_moneys = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_qianyueorder")." where uniacid=".$uniacid." and ispay=0 and zid=".$res['zid']);
     if($qianyue_moneys == NULL)
     {
      $qianyue_moneys = '0.00';
     }
     // 开药
     $kaiyao_moneys = pdo_fetchall("select money from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and is_pay=0 and zid=".$res['zid']." group by back_orser");
     $kaiyao_moneys = array_sum(array_map(function($val){return $val['money'];}, $kaiyao_moneys));
     if($kaiyao_moneys == NULL)
     {
      $kaiyao_moneys = '0.00';
     }
     $res['jiesuan'] = sprintf("%.2f",$wz_moneys + $tw_moneys + $guahao_moneys + $qianyue_moneys + $kaiyao_moneys);
     if($res){
       if($res['exa'] == 0){
         $res['msg'] = array(
          'title'=>"医生认证中",
          'content' =>"认证期间暂时无法使用此功能，通过认证才能完成工作室创建",
        );
       }else{
        $res['advertisement'] = tomedia($res['advertisement']);
       }
      }else{
       $res['msg'] = array(
          'title'=>"未创建工作室",
          'content' =>"您还没有属于自己的工作室，暂时无法使用此功能，通过认证才能完成工作室创建",
        );
     }
     $res['advertisement'] = tomedia($res['advertisement']);
     $res['weweima'] = $_W['siteroot'].$res['weweima'];
     $res['authority'] = explode('、',$res['authority']);
      
     $fuwu_lists = pdo_fetchall("select bid from ".tablename("hyb_yl_doc_all_serverlist")." where uniacid=".$uniacid." and zid=".$res['zid']." and stateback=1");
     
      $bids = "";
      foreach($fuwu_lists as &$fws)
      {
        $bids .= $fws['bid'].",";
      }
      $bids = substr($bids,0,strlen($bids)-1);

     $fw_list = pdo_fetchall("SELECT a.*,b.title,b.id as bid,b.money FROM".tablename("hyb_yl_docser_speck")."as a left join".tablename('hyb_yl_docserver_type')."as b on b.typeid=a.id where a.uniacid ='{$uniacid}' and a.id in (".$bids.")");
     
      $val = $fw_list;
      $newArr = array();
      foreach($val as $v) {
        if(! isset($newArr[$v['key_words']])) $newArr[$v['key_words']] = $v;
        else $newArr[$v['key_words']]["url"] .=  $v["url"];
             $newArr[$v['key_words']]["server_content"] .=  $v["server_content"];
             $newArr[$v['key_words']]["icon2"] .=  $v["icon"];
             $newArr[$v['key_words']]["id"] .=  $v["id"];
             $newArr[$v['key_words']]["ftitle"] .=  $v["ftitle"];
             $newArr[$v['key_words']]["type"] .=  $v["type"];
              $newArr[$v['key_words']]["state"] .=  $v["state"];
      }

      $res['data_list'] = !$plugin?$fw_list:$newArr;
      
     foreach ($res['data_list'] as $key => $value) {

       $res['data_list'][$key]['icon'] = tomedia($res['data_list'][$key]['icon']);
       $cx_name = strip_tags(htmlspecialchars_decode($res['data_list'][$key]['server_content']));
       $cx_name = str_replace(PHP_EOL, '',  $cx_name);
       $cx_name = str_replace(array("&nbsp;", "&ensp;", "&emsp;","&thinsp;","&zwnj;","&zwj;","&ldquo;","&rdquo;"), "", $cx_name);
       $res['data_list'][$key]['server_content'] = $cx_name;
       if($value['key_words'] == 'dianhuajizhen' || $value['key_words'] == 'shipinwenzhen' || $value['key_words'] == 'shoushukuaiyue' || $value['key_words'] == 'tijianjiedu')
       {
           $num = pdo_fetchall("select id from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid=".$res['zid']." and keywords='".$value['key_words']."' and ifpay=1 and role=0 and ifgb=0 group by back_orser");
           $res['data_list'][$key]['num'] = count($num);
       }else if($value['key_words'] == 'tuwenwenzhen')
       {
           $num = pdo_fetchall("select id from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid=".$res['zid']."  and ifpay=1 and role=0 and ifgb=0 group by back_orser");

           $res['data_list'][$key]['num'] = count($num);
       }else if($value['key_words'] == 'yuanchengkaifang')
       {
           $num = pdo_fetchall("select c_id from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid=".$res['zid']."  and ispay=1 and role=0 and ifgb=0 group by back_orser");
           $res['data_list'][$key]['num'] = count($num);
       }else if($value['key_words'] == 'yuanchengguahao')
       {
          $num = pdo_fetchall("select id from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid=".$res['zid']."  and ifpay=1 and role=0 and ifgb=0 group by back_orser");
           $res['data_list'][$key]['num'] = count($num);
       }
     }
     
     
     if($res['is_urgent'] == '1')
     {
      $baogao = pdo_get("hyb_yl_tstype",array("keyword"=>'baogaojiaji','uniacid'=>$uniacid));
      $baogao['thumb'] = tomedia($baogao['thumb']);
      $res['baogao'] = $baogao;
     }
     echo json_encode($res);
  }
  //创建团队啊
  public function docteam(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $t_id= $_GPC['t_id'];
      $data = array('uniacid' => $uniacid, 'teamname' => $_GPC['teamname'], 'teamaddress' => $_GPC['teamaddress'], 'teamtext' => $_GPC['teamtext'], 'teamtype' => $_GPC['teamtype'], 'teampic' => $_GPC['teampic'], 'zid' => $_GPC['zid'],'cltime'=>strtotime('now'));
      if(empty($_GPC['t_id'])){
       $res = pdo_insert('hyb_yl_zhuanjteam', $data);
      }else{
       $res = pdo_update('hyb_yl_zhuanjteam', $data,array('uniacid'=>$uniacid,'t_id'=>$t_id));
      }
      echo json_encode($res);
  }
  public function selectteaminfo(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $teamtype = $_GPC['teamtype'];
        $t_id = $_GPC['t_id'];
        $zid= $_GPC['zid'];
        $res = pdo_get('hyb_yl_zhuanjteam', array('uniacid' => $uniacid, 't_id' => $t_id));
        $res['teampic1'] =  $res['teampic'];
        $res['teampic'] = $_W['attachurl'] . $res['teampic'];

        if($res['zid'] ==$zid){
          $res['managerRole'] =1; 
          $res['type']=1;
        }
       echo json_encode($res);
  }
  //查询团队的医护
  public function yihu(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $zid = $_GPC['zid'];
    $teamtype = $_GPC['teamtype'];
    $res = pdo_fetchall('SELECT * FROM' . tablename('hyb_yl_zhuanjteam') . "as a left join" . tablename('hyb_yl_zhuanjia') . "as b on b.zid=a.zid where a.uniacid='{$uniacid}' AND a.zid='{$zid}' AND a.teamtype='{$teamtype}' ");
    foreach ($res as $key => $value) {
      $tt_id =$value['t_id'];
      $res[$key]['teampic'] = $_W['attachurl'] . $res[$key]['teampic'];
      $res[$key]['advertisement'] = $_W['attachurl'] . $res[$key]['advertisement'];
      $res[$key]['docnum'] =pdo_fetch("SELECT count(*) as docnum FROM".tablename("hyb_yl_yaoqingdoc")."where uniacid ='{$uniacid}' AND t_id='{$tt_id}'");
       }
      //查询团队的医护
      $info =array(
         'data'=>$res,
        );
     echo json_encode($info);
  }
  //加入团队
  public function join(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $zid = $_GPC['zid'];
      $teamtype = intval($_GPC['teamtype']);
      $res = pdo_fetchall('SELECT * FROM' . tablename('hyb_yl_zhuanjteam') . "as a left join" . tablename('hyb_yl_yaoqingdoc') . "as b on b.t_id=a.t_id left join".tablename("hyb_yl_zhuanjia")."as c on c.zid=a.zid where a.uniacid='{$uniacid}' AND b.zid='{$zid}' AND a.teamtype='{$teamtype}'  ");
      foreach ($res as $key => $value) {
      $tt_id =$value['t_id'];
      $res[$key]['teampic'] = $_W['attachurl'] . $res[$key]['teampic'];
      $res[$key]['docnum'] =pdo_fetch("SELECT count(*) as docnum FROM".tablename("hyb_yl_yaoqingdoc")."where uniacid ='{$uniacid}' AND t_id='{$tt_id}'");
        $res[$key]['yao_time']=date("Y-m-d H:i:s",$res[$key]['yao_time']);
        $res[$key]['advertisement'] =$_W['attachurl'].$res[$key]['advertisement'];
        if($res[$key]['yao_type'] ==0){
              $res[$key]['textname'] ="邀请中";
        }
        if($res[$key]['yao_type'] ==1){
              $res[$key]['textname']="已同意";
        }
        if($res[$key]['yao_type'] ==2){
             $res[$key]['textname'] ="已拒绝";
        }
      }
      echo json_encode($res);
  }
  //团队二维码
  public function teamerweima(){
    global $_GPC, $_W;
    $uniacid =$_W['uniacid'];
    $t_id = intval($_GPC['t_id']);
    $Dmoney = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjteam")."WHERE t_id = '{$t_id}' and uniacid='{$uniacid}'");   
    //生成二维码
    if(empty($Dmoney['tderweima'])){
        $result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}' ", array(":uniacid" => $uniacid));
        $APPID = $result['appid'];
        $SECRET = $result['appsecret'];
        $tokenUrl="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$APPID}&secret={$SECRET}";
        $getArr=array();
        $tokenArr=json_decode($this->send_post($tokenUrl,$getArr,"GET"));
        $access_token=$tokenArr->access_token;
        $noncestr = 'hyb_yl/userCommunicate/pages/intro/intro?t_id='.$t_id;
        $width=430;
        $post_data='{"path":"'.$noncestr.'","width":'.$width.'}';
        $url="https://api.weixin.qq.com/cgi-bin/wxaapp/createwxaqrcode?access_token=".$access_token;
        $result=$this->api_notice_increment($url,$post_data); 
        $image_name = md5(uniqid(rand())).".jpg";
        $filepath ="../attachment/{$image_name}";   
        $file_put = file_put_contents($filepath, $result);
       if($file_put){
           $siteroot = $_W['siteroot'];
           $filepathsss= "{$siteroot}".'attachment/'."{$image_name}";
           $phone = pdo_getcolumn('hyb_yl_zhuanjteam', array('t_id' => $t_id), 'tderweima');
           $datas = array('tderweima' => $filepathsss);
           $getupdate = pdo_update("hyb_yl_zhuanjteam", $datas,array('t_id' => $t_id,'uniacid' => $uniacid)); 
           $overerwei = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjteam")."WHERE t_id = '{$t_id}' and uniacid='{$uniacid}'"); 
           $overerwei['teampic'] =$_W['attachurl'].$overerwei['teampic'];
          }
         } else{
         $siteroot = $_W['siteroot'];
         $overerwei = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjteam")."WHERE t_id = '{$t_id}' and uniacid='{$uniacid}'"); 
         $overerwei['teampic'] =$_W['attachurl'].$overerwei['teampic'];
        } 
         echo json_encode($overerwei);
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
        //团队公告
    public function gonggaolist(){
      global $_W, $_GPC;
      $uniacid = $_W['uniacid'];
      $t_id =$_GPC['t_id'];
      $zid = $_GPC['zid'];
      $fuzes = pdo_getcolumn("hyb_yl_team",array("id"=>$t_id,"uniacid"=>$uniacid),'zid');

      if($fuzes == $zid)
      {
        $fuze = true;
      }else{
        $fuze = false;
      }
      $zhiding =pdo_fetchall('SELECT * FROM'.tablename('hyb_yl_teamment')."WHERE uniacid ='{$uniacid}' AND t_id='{$t_id}' AND menttypes=1 order by g_id desc LIMIT 1");
      //查询列表
      $res = pdo_fetchall('SELECT * FROM'.tablename('hyb_yl_teamment')."WHERE uniacid ='{$uniacid}' AND t_id='{$t_id}' order by g_id desc");
      foreach ($res as $key => $value) {
       $res[$key]['thumbarr'] =unserialize($res[$key]['thumbarr']);
       $res[$key]['updateTime'] =date('Y-m-d H:i:s',$res[$key]['updateTime']);
       $num1 = count($res[$key]['thumbarr']);
         for ($i=0; $i < $num1; $i++) { 
           $res[$key]['thumbarr'][$i] =$_W['attachurl'].$res[$key]['thumbarr'][$i];
         }
      }
      $data = array(
          'zhiding'=>$zhiding,
          'noticeList'=>$res,
          'fuze' => $fuze,
        );
      echo json_encode($data);
    }
    //公告详情
  public function addgongg(){
      global $_W, $_GPC;
      $uniacid = $_W['uniacid'];
      $g_id = $_GPC['g_id'];
      $res = pdo_get('hyb_yl_teamment',array('uniacid'=>$uniacid,'g_id'=>$g_id));
      $res['thumbarr']=unserialize($res['thumbarr']);
      $res['updateTime'] =date('Y-m-d H:i:s',$res['updateTime']);
      $num1 = count($res['thumbarr']);
      for ($i=0; $i < $num1; $i++) { 
       $res['thumbarr'][$i] =$_W['attachurl'].$res['thumbarr'][$i];
      }
      echo json_encode($res);
    }
  //删除公告
    public function delete(){
      global $_W, $_GPC;
      $uniacid = $_W['uniacid'];
      $g_id = $_GPC['g_id'];
      $res = pdo_delete('hyb_yl_teamment',array('uniacid'=>$uniacid,'g_id'=>$g_id));
      echo json_encode($res);
    }
    //保存
    public function saveteam(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        if ($_GPC['state'] == true) {
            $state = 1;
        } else {
            $state = 0;
        }
        $idarr = htmlspecialchars_decode($_GPC['thumbarr']);
        $array = json_decode($idarr);
        $object = json_decode(json_encode($array), true);
        $data = array('uniacid' => $uniacid, 'title' => $_GPC['title'], 'teamtext' => $_GPC['teamtext'], 'thumbarr' => serialize($object), 't_id' => $_GPC['t_id'], 'menttypes' => $state, 'updateTime' => strtotime("now"));
        
        $res = pdo_insert('hyb_yl_teamment', $data);
        echo json_encode($res);
    }

   public function ifzj()
  {
     global $_GPC, $_W;
     $model = Model('zhuanjia');
     $uniacid = $_W['uniacid'];
     $openid = $_GPC['openid'];
     $res =$model->where('uniacid="'.$uniacid.'" and openid ="'.$openid.'"')->get();
     if($res){
         echo "1";
      }else{
         echo "0";
     }
  } 
  //添加团队服务包
  public function addfwb(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $model = Model('fwlist_copy');
    $ff_id = $_GPC['ff_id'];
    $t_id = $_GPC['t_id'];
    $price = $_GPC['price'];
    $data =array(
      'uniacid'   => $uniacid,
      'ff_id'     => $ff_id,
      'kttime'    => strtotime('now'),
      'fw_sjmoney'=> $_GPC['fw_sjmoney'],
      't_id'      => $t_id,
      'fw_sjmoney'=> $price,
      'fl_id'     => $_GPC['fl_id']
      );
    $res =$model->add($data);
    $id = pdo_insertid();
    echo json_encode($id);
  }
  public function delfwb(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $model = Model('fwlist_copy');
    $id = $_GPC['id'];
    $res = $model->where("id=$id")->delete();
    echo json_encode($res);
  }
  public function ifexist(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $model = Model('fwlist_copy');
    $uniacid = $_W['uniacid'];
    $ff_id = $_GPC['ff_id'];
    $t_id  = $_GPC['t_id'];
    $fl_id = $_GPC['fl_id'];
    $res =$model->where("uniacid=$uniacid and t_id=$t_id and fl_id=$fl_id and  ff_id=$ff_id")->get();
    if($res){
      $data = array(
          'id'=>$res['id'],
          'data'=>1,
          'fw_sjmoney'=>$res['fw_sjmoney']
        );
    }else{
      $data = array(
          'data'=>0
        );
    }
    echo json_encode($data);
  }
  //查询我加入的团队
  public function myjoinstudio(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $t_id = $_GPC['t_id'];
    $roomtype = $_GPC['roomtype'];
    $zid = $_GPC['zid'];
    $model = Model('myjoinstudio');
    $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_myjoinstudio')."as a left join ".tablename('hyb_yl_zhuanjteam')."as b on b.t_id=a.t_id where a.zid='{$zid}' and a.uniacid='{$uniacid}' and a.t_id='{$t_id}' and a.roomtype='{$roomtype}'");
    foreach ($res as $key => $value) {
     $res[$key]['teampic'] = $_W['attachurl'] . $res[$key]['teampic'];
    }
    echo json_encode($res);
  }

  public function goodserweima(){
    global $_GPC, $_W;
    $uniacid =$_W['uniacid'];
    $orders = $_GPC['orders'];
    $hid = $_GPC['hid'];
    $Dmoney = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_goodsorders")."WHERE orderNo = '{$orders}' and uniacid='{$uniacid}'");  
    $id = $Dmoney['id'];
    //生成二维码
        $result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}' ", array(":uniacid" => $uniacid));
        $APPID = $result['appid'];
        $SECRET = $result['appsecret'];
        $tokenUrl="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$APPID}&secret={$SECRET}";
        $getArr=array();
        $tokenArr=json_decode($this->send_post($tokenUrl,$getArr,"GET"));
        $access_token = $tokenArr->access_token;
        $data = array();
        $data['scene'] = "id=" . $id;
        $data['page'] = "hyb_yl/userCommunicate/pages/sure_Details/sure_Details";
        $data = json_encode($data);
        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $access_token;
        $result = $this->api_notice_increment($url, $data);

        $image_name = md5(uniqid(rand())).".jpg";
        $filepath ="../attachment/{$image_name}";   
        $file_put = file_put_contents($filepath, $result);
       if($file_put){
           $siteroot = $_W['siteroot'];
           $filepathsss= "{$siteroot}".'attachment/'."{$image_name}";
           $phone = pdo_getcolumn('hyb_yl_goodsorders', array('orderNo' => $orders), 'erweima');
           $datas = array('erweima' => $filepathsss);
           $getupdate = pdo_update("hyb_yl_goodsorders", $datas,array('orderNo' => $orders,'uniacid' => $uniacid)); 
           $overerwei = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_goodsorders")."WHERE orderNo = '{$orders}' and uniacid='{$uniacid}'"); 
          }
         echo json_encode($overerwei);
      }


}


