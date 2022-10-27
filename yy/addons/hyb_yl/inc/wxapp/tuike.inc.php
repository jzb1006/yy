<?php
/**
* 
*/
 class tuike extends HYBPage
 { 
   public function updateperson(){
     //
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $tkid = $_GPC['tkid'];
        $data['uniacid'] = $uniacid;
        $data['type'] = intval($_GPC['type']);
        $data['openid'] = $openid;
        $data['tgtime'] = strtotime('now');
        $data['tkid'] = $_GPC['tkid'];
        $data['content'] ='患者推广';
        $data['zid']=$_GPC['zid'];
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//当天开始时间戳
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;//当天结束时间戳

        $user =pdo_fetch("SELECT * FROM".tablename('hyb_yl_tuiguanglog')."where uniacid='{$uniacid}' and tgtime>='{$beginToday}' and tgtime<=$endToday and openid='{$openid}' and type=2 and tkid='{$_GPC['tkid']}'");
        
        if(!$user && !empty($_GPC['tkid'])){
          $res = pdo_insert('hyb_yl_tuiguanglog',$data);
        }else{
          $res =0;
        }
        echo json_encode($res);
   }
   public function erweima(){
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $res = pdo_get("hyb_yl_tuikesite",array('id'=>$id));
        $dir = iconv("UTF-8", "GBK", "../attachment/hyb_yl");
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        $result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}' ", array(":uniacid" => $uniacid));
        $APPID = $result['appid'];
        $SECRET = $result['appsecret'];
        $erweima = $res['erweima'];

        if($erweima == '')
        {
          $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$result['appid']}&secret={$result['appsecret']}";
          $getArr = array();
          $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
          $access_token = $tokenArr->access_token;
          $id = $_GPC['id'];
          $data = array();
          $data['scene'] = "id=".$res['id'];
          $data['page'] = "hyb_yl/tabBar/index/index";
          $data = json_encode($data);
          $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $access_token;
          $result = $this->api_notice_increment($url, $data);
          $image_name = "id_".$res['id'] . ".jpg";
          $filepath = "../attachment/hyb_yl/{$image_name}";
          $file_put = file_put_contents($filepath, $result);
          if($file_put) {
            $siteroot = $_W['siteroot'];
            $filepathsss = "attachment/hyb_yl/{$image_name}";
            pdo_update("hyb_yl_tuikesite",array("erweima"=>$filepathsss),array('id'=>$id,'uniacid'=>$uniacid));
           }
           echo $_W['siteroot'].$filepathsss;
        }else{
          $filepathsss = pdo_getcolumn('hyb_yl_tuikesite',array('id'=>$id),'erweima');
           echo $_W['siteroot'].$filepathsss;
        }
   }

    public function alldoc(){
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $row = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_zhuanjia')."where uniacid='{$uniacid}' and tkid='{$id}' order by zid desc ");
         foreach ($row as $key => $value) {
                $zid = $value['zid'];
                $where2="WHERE uniacid = '{$uniacid}' and zid='{$zid}'";
                $row[$key]['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$row[$key]['parentid']),'name');
                $row[$key]['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$row[$key]['hid']),'agentname');
                $row[$key]['grade'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$row[$key]['hid']),'grade');
                        
                $row[$key]['leve'] = pdo_getcolumn("hyb_yl_hospital_level",array("id"=>$row[$key]['grade']),'level_name');
               

                $row[$key]['yearcad'] = pdo_fetch("SELECT * from" . tablename('hyb_yl_yearcard') . "where zid='{$zid}' and typs=1 and status=1");
                $row[$key]['advertisement'] = tomedia($row[$key]['advertisement']);
                $row[$key]['server'] = pdo_fetchall("SELECT key_words,titlme,ptmoney,hymoney from".tablename('hyb_yl_doc_all_serverlist')."{$where2}");
                $rows[$k]['serverss'] = pdo_getall("hyb_yl_doc_all_serverlist",array("zid"=>$v['zid'],"uniacid"=>$uniacid,"stateback"=>'1'));
                $rows[$k]['servers'] = pdo_fetch("select a.*,b.ser_url from ".tablename("hyb_yl_doc_all_serverlist")." as a left join ".tablename("hyb_yl_all_server_menulist")." as b on a.key_words=b.server_key where a.zid=".$v['zid']." and a.uniacid=".$uniacid." and a.key_words='".$server_key."' and a.stateback=1");
                $row[$key]['jingxuan'] = explode(',', $value['jingxuan']);
            }
        echo json_encode($row);
    }

    public function leverperson(){
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $tkid = $_GPC['id'];
        $index = $_GPC['index'];
        $where ="where uniacid='{$uniacid}' and tkid='{$tkid}'";
        $res = pdo_fetchall("SELECT * from".tablename('hyb_yl_userinfo')." {$where} ");
  
        //查询今日患者
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//当天开始时间戳
        $endToday=mktime(23,59,59,date("m"),date("d"),date("Y"));//当天结束时间戳

        $count = pdo_fetchcolumn("SELECT count(*) from".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}' and tkid='{$tkid}' and randnum >='{$beginToday}' and randnum <='{$endToday}')");
        $count1 = pdo_fetchcolumn("SELECT count(*) from".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}' and tkid='{$tkid}'");
        //查询二级
        foreach ($res as $key => $value) {
           $tktwoid = $value['u_id'];
          
           $count2 = pdo_fetchcolumn("SELECT count(*) from".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}'  and tkid='{$tktwoid}'");
        }
        
        
        $data =array(
         'count'=>intval($count),
         'count1'=>intval($count1),
         'list' =>$res,
         'count2'=>intval($count2?$count2:0)
         
         
          );
        echo json_encode($data);
    }


    public function leverpersontwo(){
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $tkid = $_GPC['id'];
        $index = $_GPC['index'];
        $where ="where uniacid='{$uniacid}' and tkid='{$tkid}'";
        $res = pdo_fetchall("SELECT * from".tablename('hyb_yl_userinfo')." {$where} ");
        //查询今日患者
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//当天开始时间戳
        $endToday=mktime(23,59,59,date("m"),date("d"),date("Y"));//当天结束时间戳

        $count = pdo_fetchcolumn("SELECT count(*) from".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}' and tkid='{$tkid}' and randnum>='{$beginToday}' and randnum <='{$endToday}')");
        $count1 = pdo_fetchcolumn("SELECT count(*) from".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}' and tkid='{$tkid}' ");
        //查询二级
        foreach ($res as $key => $value) {
           $tktwoid = $value['u_id'];
           
           $count2 = pdo_fetchcolumn("SELECT count(*) from".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}'  and tkid='{$tktwoid}'");
           $res2[] = pdo_fetchall("SELECT * from".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}'  and tkid='{$tktwoid}'");
       
        }
        
       
        $data =array(
         'count'=>intval($count),
         'list' =>intval($res2),
         'count1'=>intval($count1),
         'count2'=>intval($count2?$count2:0)
          );
        echo json_encode($data);
    }

    public function yongjin(){
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $tkid = $_GPC['id'];
        //查询总佣金
        //查询可提现佣金
        $ktmoney =pdo_get('hyb_yl_tuikesite',array('id'=>$tkid),array('countmoney'));
        $countmoney = pdo_fetch("SELECT SUM(`money`) AS sum from".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and tkid='{$tkid}'");
        $sqmoney =pdo_fetch("SELECT SUM(`money`) AS sum from".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and tkid='{$tkid}' and over=0");
        //提现待通过
        $dtgmoney = pdo_fetch("SELECT SUM(`txprice`) AS sum from".tablename('hyb_yl_tuike_tixian_log')."where uniacid='{$uniacid}' and tkid='{$tkid}' and type=0");

        //yitg
        $ytgmoney = pdo_fetch("SELECT SUM(`txprice`) AS sum from".tablename('hyb_yl_tuike_tixian_log')."where uniacid='{$uniacid}' and tkid='{$tkid}' and type=1");
        $data =array(
            'ktmoney'=>$ktmoney,
            'countmoney'=>$countmoney,
            'sqmoney' =>$sqmoney,
            'dtgmoney'=>$dtgmoney,
            'ytgmoney'=>$ytgmoney
          );
        echo json_encode($data);
    }
    public function tixian(){
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $tkid = $_GPC['id'];
        $txprice = floatval($_GPC['txprice']);
        $count =pdo_getcolumn('hyb_yl_tuikesite',array('id'=>$tkid,'uniacid'=>$uniacid),'countmoney');
        $data =array(
           'countmoney'=>(floatval($count))-($txprice)
          );
        $res =pdo_update('hyb_yl_tuikesite',$data,array('id'=>$tkid));
        $test = array(
           'uniacid'=>$_W['uniacid'],
           'tkid'=>$tkid,
           'txprice'=>$txprice,
           'addtime'=>date("Y-m-d H:i:s")
          );
        
        pdo_insert('hyb_yl_tuike_tixian_log',$test);
        echo json_encode($res);
    }
   
   public function roul(){
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $tkid = $_GPC['tkid']=='undefined'?'0':$_GPC['tkid'];
        $res =pdo_get('hyb_yl_tuike_roul',array('uniacid'=>$uniacid));
        $res['content'] = htmlspecialchars_decode($res['content']);
        if(empty($tkid)){
           $res['applymoney'] ==$res['twoapplymoney'];
        }else{
          if($res['appdis']=='1'){
            $res['applymoney'] =='0.00';
          }
        }
        echo json_encode($res);
   }
    public function pay() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        require_once dirname(dirname(dirname(__FILE__)))."/wxpay.php";
        cache_write('uniacid',$_W['uniacid']);
        $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
        $appid = $res['appid'];
        $openid = $_GPC['openid'];
        $mch_id = $res['mch_id'];
        $key = $res['pub_api'];
        $out_trade_no = $mch_id . time();
        $total_fee = $_GPC['z_tw_money'];
        $noturl = 'http://'.$_SERVER['SERVER_NAME'].''; //通知地址 
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
    public function uptijiantkmoney(){
      global $_GPC, $_W;
      $uniacid =$_W['uniacid'];
      $tkid = $_GPC['tkid']; //一级
      $mytkid = $_GPC['mytkid']; //二级
      $money = $_GPC['money'];
      $openid = $_GPC['openid'];
      $tid = $_GPC['tid'];
      $orders = $_GPC['orders'];
      //查询返佣金额
      $onemoney = pdo_getcolumn('hyb_yl_taocan',array('uniacid'=>$uniacid,'id'=>$tid),'fx_one');
      $twomoney = pdo_getcolumn('hyb_yl_taocan',array('uniacid'=>$uniacid,'id'=>$tid),'fx_two');
      $money1 = floatval($onemoney)/100;  //一级分销商获得返佣比例
      $money2 = floatval($twomoney)/100; //二级分销商获得返佣比例
      $paymoney1 = $money *$money1; //一级分销商获得返佣金额
      $paymoney2 = $money *$money2; //二级分销商获得返佣金额

      pdo_update("hyb_yl_tijianorder",array("tk_one"=>$paymoney1,"tk_two"=>$paymoney2),array("uniacid"=>$uniacid,"ordernums"=>$orders));
      

      //一级分销商返佣
      if(!empty($tkid)){

        $res = pdo_fetch("SELECT * from".tablename('hyb_yl_tuikesite')."where uniacid='{$uniacid}' and id='{$mytkid}' ");
          $data =array(
             'uniacid' =>$uniacid,
             'money'   =>$paymoney1,
             'addtime' =>date("Y-m-d H:i:s"),
             'tkid'    =>$tkid,
             'xjid'    =>$myid
            );
          //增加总金额
          $countmoney = pdo_getcolumn('hyb_yl_tuikesite',array('uniacid'=>$uniacid,'id'=>$tkid),'countmoney');
          $row = pdo_update('hyb_yl_tuikesite',array('countmoney'=> $countmoney+$paymoney1),array('id'=>$tkid));
          $result=pdo_insert('hyb_yl_tuikeshouyi',$data);
          echo $result;
          //二级分销商返佣
          //当前分享用户是否是等于二级分销商
      }
       if(!empty($mytkid)){
       
          $user_fxs = pdo_get('hyb_yl_tuikesite',array('openid'=>$openid));
          $res = pdo_fetch("SELECT * from".tablename('hyb_yl_tuikesite')."where uniacid='{$uniacid}' and id='{$mytkid}' ");
          $data =array(
             'uniacid' =>$uniacid,
             'money'   =>$paymoney2,
             'addtime' =>date("Y-m-d H:i:s"),
             'mytkid'  =>$mytkid,
             'xjid'    =>$myid
            );
         
          if($user_fxs['id'] !== $res['id']){
              //增加总金额
            $countmoney = pdo_getcolumn('hyb_yl_tuikesite',array('uniacid'=>$uniacid,'id'=>$mytkid),'countmoney');
            $row = pdo_update('hyb_yl_tuikesite',array('countmoney'=> $countmoney+$paymoney2),array('id'=>$mytkid));
            $result=pdo_insert('hyb_yl_tuikeshouyi',$data);
            echo $result;
          }else{
             echo 0;
          }
      }else{
        $result=0;
        echo $result;
      }

        
    }
    public function register()
    {
      global $_GPC, $_W;
      $uniacid =$_W['uniacid'];
      $tkid = $_GPC['tkid']; //一级
      $mytkid = $_GPC['mytkid']; //二级
      $openid = $_GPC['openid'];
     
      $twoapplymoney = pdo_getcolumn('hyb_yl_tuike_roul',array('uniacid'=>$uniacid),'twoapplymoney');

      $onegetmoney = pdo_getcolumn('hyb_yl_tuike_roul',array('uniacid'=>$uniacid),'onegetmoney');
      $money1 = floatval($twoapplymoney);
      $money2 = floatval($onegetmoney)/100;      
      $money3 = $money1 * $money2;

      //一级分销商返佣
      if(!empty($tkid)){

        $res = pdo_fetch("SELECT * from".tablename('hyb_yl_tuikesite')."where uniacid='{$uniacid}' and id='{$mytkid}' ");
          $data =array(
             'uniacid' =>$uniacid,
             'money'   =>$money3,
             'addtime' =>date("Y-m-d H:i:s"),
             'tkid'    =>$tkid,
             'xjid'    =>$myid,

            );
          //增加总金额
          $countmoney = pdo_getcolumn('hyb_yl_tuikesite',array('uniacid'=>$uniacid,'id'=>$tkid),'countmoney');
          $row = pdo_update('hyb_yl_tuikesite',array('countmoney'=> $money3),array('id'=>$tkid));
          $result=pdo_insert('hyb_yl_tuikeshouyi',$data);
          echo $result;
          //二级分销商返佣
          //当前分享用户是否是等于二级分销商
      }
    }
    public function uptopmoney(){
      global $_GPC, $_W;  
      $uniacid =$_W['uniacid'];
      $tkid = $_GPC['tkid']; //一级
      $mytkid = $_GPC['mytkid']; //二级
      $money = $_GPC['money'];
      $openid = $_GPC['openid'];
      $orders = $_GPC['orders'];
      $leixing = $_GPC['leixing'];
      //查询返佣金额
     
      $onemoney = pdo_getcolumn('hyb_yl_tuike_roul',array('uniacid'=>$uniacid),'modeonemoney');//一级分销商获得返佣金额
      $twomoney = pdo_getcolumn('hyb_yl_tuike_roul',array('uniacid'=>$uniacid),'modetwomoney');//二级分销商获得返佣金额
   
      $money1 = floatval($onemoney)/100;  //一级分销商获得返佣比例
      $money2 = floatval($twomoney)/100; //二级分销商获得返佣比例
      $paymoney1 = $money *$money1; //一级分销商获得返佣金额
      $paymoney2 = $money *$money2; //二级分销商获得返佣金额

      //一级分销商返佣
      if(!empty($tkid)){

        $res = pdo_fetch("SELECT * from".tablename('hyb_yl_tuikesite')."where uniacid='{$uniacid}' and id='{$mytkid}' ");
          $data =array(
             'uniacid' =>$uniacid,
             'money'   =>$paymoney1,
             'addtime' =>date("Y-m-d H:i:s"),
             'tkid'    =>$tkid,
             'xjid'    =>$myid,
             'leixing'  =>$_GPC['leixing'],
             'orders'  =>$orders,
             'paymoney'=>$money 
            );
          
          //增加总金额
          $countmoney = pdo_getcolumn('hyb_yl_tuikesite',array('uniacid'=>$uniacid,'id'=>$tkid),'countmoney');
          $row = pdo_update('hyb_yl_tuikesite',array('countmoney'=> $countmoney+$paymoney1),array('id'=>$tkid));
          $result=pdo_insert('hyb_yl_tuikeshouyi',$data);
          echo $result;
          if($leixing == 'yuanchengkaifang')
          {
            pdo_update("hyb_yl_chufang",array("tk_one"=>$paymoney1),array("uniacid"=>$uniacid,"back_orser"=>$orders));
            
          }else if($leixing == 'dianhuajizhen' || $leixing == 'shipinwenzhen' || $leixing == 'tijianjiedu' || $leixing == 'shoushukuaiyue')
          {
            pdo_update("hyb_yl_wenzorder",array("tk_one"=>$paymoney1),array("uniacid"=>$uniacid,"back_orser"=>$orders));
          }else if($leixing == 'yuanchengguahao')
          {
            pdo_update("hyb_yl_guahaoorder",array("tk_one"=>$paymoney1),array("uniacid"=>$uniacid,"back_orser"=>$orders));
          }else if($leixing == 'tuwenwenzhen')
          {
            pdo_update("hyb_yl_twenorder",array("tk_one"=>$paymoney1),array("uniacid"=>$uniacid,"back_orser"=>$orders));
          }else if($leixing == 'green')
          {
            pdo_update("hyb_yl_guidance_order",array("tk_one"=>$paymoney1),array("uniacid"=>$uniacid,"back_orser"=>$orders));
          }else if($leixing == 'vip')
          {
            pdo_update("hyb_yl_vip_log",array("tk_one"=>$paymoney1),array("uniacid"=>$uniacid,"ordersn"=>$orders));
          }else if($leixing == 'yearcard')
          {
            pdo_update("hyb_yl_useryearcard",array("tk_one"=>$paymoney1),array("uniacid"=>$uniacid,"ordersn"=>$orders));
          }
          //二级分销商返佣
          //当前分享用户是否是等于二级分销商
      }
       if(!empty($mytkid)){
       
          $user_fxs = pdo_get('hyb_yl_tuikesite',array('openid'=>$openid));
          $res = pdo_fetch("SELECT * from".tablename('hyb_yl_tuikesite')."where uniacid='{$uniacid}' and id='{$mytkid}' ");
          $data =array(
             'uniacid' =>$uniacid,
             'money'   =>$paymoney2,
             'addtime' =>date("Y-m-d H:i:s"),
             'mytkid'  =>$mytkid,
             'xjid'    =>$myid,
             'leixing'  =>$_GPC['leixing'],
             'orders'  =>$orders,
             'paymoney'=>$money 
            );
         
          if($user_fxs['id'] !== $res['id']){
              //增加总金额
            $countmoney = pdo_getcolumn('hyb_yl_tuikesite',array('uniacid'=>$uniacid,'id'=>$mytkid),'countmoney');
            $row = pdo_update('hyb_yl_tuikesite',array('countmoney'=> $countmoney+$paymoney2),array('id'=>$mytkid));
            $result=pdo_insert('hyb_yl_tuikeshouyi',$data);
            echo $result;
            if($leixing == 'yuanchengkaifang')
            {
              pdo_update("hyb_yl_chufang",array("tk_two"=>$paymoney2),array("uniacid"=>$uniacid,"back_orser"=>$orders));
              
            }else if($leixing == 'dianhuajizhen' || $leixing == 'shipinwenzhen' || $leixing == 'tijianjiedu' || $leixing == 'shoushukuaiyue')
            {
              pdo_update("hyb_yl_wenzorder",array("tk_two"=>$paymoney2),array("uniacid"=>$uniacid,"back_orser"=>$orders));
            }else if($leixing == 'yuanchengguahao')
            {
              pdo_update("hyb_yl_guahaoorder",array("tk_two"=>$paymoney2),array("uniacid"=>$uniacid,"back_orser"=>$orders));
            }else if($leixing == 'tuwenwenzhen')
            {
              pdo_update("hyb_yl_twenorder",array("tk_two"=>$paymoney2),array("uniacid"=>$uniacid,"back_orser"=>$orders));
            }else if($leixing == 'green')
            {
              pdo_update("hyb_yl_guidance_order",array("tk_two"=>$paymoney2),array("uniacid"=>$uniacid,"back_orser"=>$orders));
            }else if($leixing = 'vip')
            {
              pdo_update("hyb_yl_vip_log",array("tk_two"=>$paymoney2),array("uniacid"=>$uniacid,"ordersn"=>$orders));
            }else if($leixing == 'yearcard')
            {
              pdo_update("hyb_yl_useryearcard",array("tk_two"=>$paymoney2),array("uniacid"=>$uniacid,"ordersn"=>$orders));
            }
          }else{
             echo 0;
          }
      }else{
        $result=0;
        echo $result;
      }
      
    }
    public function userinfodata(){
      global $_GPC, $_W;
      $uniacid =$_W['uniacid'];
      $tkid =$_GPC['tkid'];
      $res = pdo_get('hyb_yl_tuikesite',array('id'=>$tkid));
      echo json_encode($res);
    }
    public function api_notice_increment($url, $data) {
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
        } else {
            return $tmpInfo;
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
    public function hospital(){
      global $_GPC, $_W;
      $uniacid =$_W['uniacid'];
      $openid = $_GPC['openid'];
      $tkid = $_GPC['tkid'];
      $where="where uniacid='{$uniacid}' and tkid='{$tkid}'";
      if(!empty($_GPC['datetime'])){
          $datetime =explode('-',$_GPC['datetime']);
          $year = $datetime[0];
          $month = $datetime[1]; 
          $day = $datetime[2];
          $rettime = $this->getStartAndEndUnixTimestamp($year,$month,$day); 
          $start = $rettime['start'];
          $end = $rettime['end'];
          $where .=" and zctime>='{$start}' and zctime<='{$end}' ";
      }else{
          $where .="";
      }
   
      $res = pdo_fetchall('select * from'.tablename('hyb_yl_hospital')." {$where} ");

      foreach ($res as $key => $value) {
        $hid = $value['hid'];
        $res[$key]['logo']=tomedia($res[$key]['logo']);
        if($res[$key]['groupid'] =='1'){
          $res[$key]['groupname']='医院';
        }
        if($res[$key]['groupid'] =='2'){
          $res[$key]['groupname']='药房';
        }
        if($res[$key]['groupid'] =='3'){
          $res[$key]['groupname']='体检机构';
        }
        if($res[$key]['groupid'] =='4'){
          $res[$key]['groupname']='诊所';
        }
        $res[$key]['addtime'] = date('Y-m-d',$res[$key]['zctime']);
      }
      echo json_encode($res);
    }
    public function myshangji(){
      global $_GPC, $_W;
      $uniacid =$_W['uniacid'];
      $id = $_GPC['id'];
      $res = pdo_getcolumn('hyb_yl_tuikesite',array('id'=>$id),'tkid');
      if($res){
        echo json_encode($res);
      }else{
        echo json_encode(0);
      }
      
    }
    public function myshangji2(){
      global $_GPC, $_W;
      $uniacid =$_W['uniacid'];
      $openid = $_GPC['openid'];
      $res = pdo_getcolumn('hyb_yl_tuikesite',array('openid'=>$openid),'tkid');
      if($res){
        echo json_encode($res);
      }else{
        echo json_encode(0);
      }
      
    }
    public function ifopentuike(){
      global $_GPC, $_W;
      $uniacid =$_W['uniacid'];
      $res =pdo_get('hyb_yl_tuike_roul',array('uniacid'=>$uniacid));
      if($res){
          if($res['switch'] =='1'){
              $ifopen= 1; 
          }else{
              $ifopen= 0;
          }
         
      }else{
          $ifopen= 2;
      }
      
      echo json_encode($ifopen);
    }
    public function iftuike(){
      global $_GPC, $_W;
      $uniacid =$_W['uniacid'];
      $openid = $_GPC['openid'];
      $res =pdo_get('hyb_yl_tuikesite',array('uniacid'=>$uniacid,'openid'=>$openid,'state'=>1));
      if($res){
         $ifopen= $res;
         
      }else{
          $ifopen= 0;
      }
      
      echo json_encode($ifopen);
    }
    public function tgorder(){
      global $_GPC, $_W;
      $uniacid =$_W['uniacid'];
      $id = $_GPC['id'];
      $list = pdo_fetchall("SELECT * FROM ".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and (tkid ='{$id}' or mytkid='{$id}')");
      foreach ($list as $key => $value) {
        $orders = $value['orders'];
       
        if($value['leixing']=='dianhuajizhen' || $value['leixing']=='shipinwenzhen' || $value['leixing']=='tijianjiedu' || $value['leixing']=='shoushukuaiyue' ){
             $wenzhen = pdo_get('hyb_yl_wenzorder',array('orders'=>$orders));
             $zid = $wenzhen['zid'];
             $list[$key]['doc'] = pdo_get("hyb_yl_zhuanjia",array('zid'=>$zid));
          
             
        }elseif ($value['leixing']=='tuwenwenzhen'){
             $wenzhen = pdo_get('hyb_yl_twenorder',array('orders'=>$orders));
             $zid = $wenzhen['zid'];
             $list[$key]['doc'] = pdo_get("hyb_yl_zhuanjia",array('zid'=>$zid));
        }
        $list[$key]['doc']['advertisement'] = tomedia($list[$key]['doc']['advertisement']);
      }
      echo json_encode($list);
    }
    public function getStartAndEndUnixTimestamp($year = 0, $month = 0, $day = 0)
    {
      if(empty($year))
      {
        $year = date("Y");
      }
    
      $start_year = $year;
      $start_year_formated = str_pad(intval($start_year), 4, "0", STR_PAD_RIGHT);
      $end_year = $start_year + 1;
      $end_year_formated = str_pad(intval($end_year), 4, "0", STR_PAD_RIGHT);
    
      if(empty($month))
      {
        //只设置了年份
        $start_month_formated = '01';
        $end_month_formated = '01';
        $start_day_formated = '01';
        $end_day_formated = '01';
      }
      else
      {
    
        $month > 12 || $month < 1 ? $month = 1 : $month = $month;
        $start_month = $month;
        $start_month_formated = sprintf("%02d", intval($start_month));
    
        if(empty($day))
        {
          //只设置了年份和月份
          $end_month = $start_month + 1;
          
          if($end_month > 12)
          {
            $end_month = 1;
          }
          else
          {
            $end_year_formated = $start_year_formated;
          }
          $end_month_formated = sprintf("%02d", intval($end_month));
          $start_day_formated = '01';
          $end_day_formated = '01';
        }
        else
        {
          //设置了年份月份和日期
          $startTimestamp = strtotime($start_year_formated.'-'.$start_month_formated.'-'.sprintf("%02d", intval($day))." 00:00:00");
          $endTimestamp = $startTimestamp + 24 * 3600 - 1;
          return array('start' => $startTimestamp, 'end' => $endTimestamp);
        }
      }
    
      $startTimestamp = strtotime($start_year_formated.'-'.$start_month_formated.'-'.$start_day_formated." 00:00:00");      
      $endTimestamp = strtotime($end_year_formated.'-'.$end_month_formated.'-'.$end_day_formated." 00:00:00") - 1;
      return array('start' => $startTimestamp, 'end' => $endTimestamp);
    }
}


