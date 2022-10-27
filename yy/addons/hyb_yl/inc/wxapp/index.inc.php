<?php
/**
* 
*/
 class Index extends HYBPage
 { 
  //基础设置
   public function Base()
  {
     global $_GPC, $_W;
     $model = Model('base');
     $uniacid = $_W['uniacid'];
     $res = $model->where("uniacid='".$uniacid."'")->get();
     $res['yy_thumb'] = $_W['attachurl'].$res['yy_thumb'];
     $res['show_thumb'] = unserialize($res['show_thumb']);
     $res['advertisement'] = unserialize($res['advertisement']);
     $res['back_zjthumb'] = unserialize($res['back_zjthumb']);
     $res['goodslunb'] = unserialize($res['goodslunb']);
     $res['tj_thumb'] = unserialize($res['tj_thumb']);
     $num = count($res['show_thumb']);
     for ($i = 0;$i < $num;$i++) {
          $res['show_thumb'][$i] = $_W['attachurl'] . $res['show_thumb'][$i];
      }
     $sement = count($res['advertisement']);
     for ($i = 0;$i < $num;$i++) {
        $res['advertisement'][$i] = $_W['attachurl'] . $res['advertisement'][$i];
     }   
     $num_zj = count($res['back_zjthumb']); 
     for ($i = 0;$i < $num;$i++) {
        $res['back_zjthumb'][$i] = $_W['attachurl'] . $res['back_zjthumb'][$i];
     } 
     $goodsnum = count($res['goodslunb']);
    for ($i = 0;$i < $goodsnum;$i++) {
        $res['goodslunb'][$i] = $_W['attachurl'] . $res['goodslunb'][$i];
    }
      $tj_thumb = count($res['tj_thumb']);
    for ($i = 0;$i < $goodsnum;$i++) {
        $res['tj_thumb'][$i] = $_W['attachurl'] . $res['tj_thumb'][$i];
    }
    $res['content'] = htmlspecialchars_decode($res['content']);
     echo json_encode($res);
  }

  //自定义菜单
  public function menu(){
     global $_GPC, $_W;
     $model = Model('service_homepage');
     $uniacid = $_W['uniacid'];
     $res = pdo_fetchall("select * from".tablename('hyb_yl_service_homepage')."as a left join".tablename('hyb_yl_all_server_menulist')."as c on c.ids=a.ids where a.uniacid='{$uniacid}' and a.state=1 and a.weizhi=1 order by a.stort");
     foreach ($res as $key => $value) {
       $res[$key]['serh_thumb'] = tomedia($res[$key]['serh_thumb']);
       $res[$key]['serh_url'] = $res[$key]['ser_url'];
     }
     echo json_encode($res);
  }
  //平台问诊服务
  public function server(){
     global $_GPC, $_W;
     $model =  Model('servicemenu');
     $uniacid = $_W['uniacid'];
     $res = $model->where("uniacid='".$uniacid."' and type=0 and state=0")-> getall();
     foreach ($res as $key => $value) {
       $res[$key]['thumb'] = $_W['attachurl'].$res[$key]['thumb'];
     }
     echo json_encode($res);
  }
  //平台特色服务
     public function teserver(){
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $res = pdo_fetch("select * from".tablename('hyb_yl_menu_array')."where uniacid ='{$uniacid}'");

        $server_menu = unserialize($res['server_menu']);

        $result2 = [];
        array_map(function ($value) use (&$result2) {
          $result2 = array_merge($result2, array_values($value));
        }, $server_menu); 

        foreach ($result2 as $key => $value) {
   
          if($result2[$key]['status'] !=='on'){
            unset($result2[$key]);
          }else{
            $result2[$key]['img'] = tomedia($result2[$key]['img']);
          }

        }
        if(count($result2) > 0)
        {
          foreach ($result2 as $key2 => $value2) {
            $new_arr[] = $result2[$key2];
          }
        }else{
          $new_arr = array();
        }
        
         echo json_encode($new_arr);
     }
  //医说记录

  public function yishuo(){
      global $_GPC,$_W;
      $uniacid =$_W['uniacid'];
      $openid = $_GPC['openid'];
      $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_attention')."where uniacid='{$uniacid}' and openid='{$openid}' and cerated_type=0");
      //h_pic
      foreach ($res as $key => $value) {
        $zid = $value['goods_id'];
        $res[$key]['hjlist'] = pdo_fetchall("SELECT a.*,b.z_name,b.advertisement,b.parentid,c.id,c.name FROM".tablename('hyb_yl_hjiaosite')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid left join".tablename('hyb_yl_ceshi')."as c on c.id=b.parentid where a.uniacid='{$uniacid}' and a.zid ='{$zid}' ");


        foreach ($res[$key]['hjlist'] as $key2 => $value2) {
          $res[$key]['hjlist'][$key2]['h_pic'] = tomedia($res[$key]['hjlist'][$key2]['h_pic']);
          $res[$key]['hjlist'][$key2]['created'] =date("Y-m-d",$res[$key]['hjlist'][$key2]['created']);
          $res[$key]['hjlist'][$key2]['advertisement'] =tomedia($res[$key]['hjlist'][$key2]['advertisement']);
        }
      }
      echo json_encode($res);
  }
  //合作医院
  public function cooperative_hospital(){
     global $_GPC, $_W;
     $model = Model('hospital');
     $uniacid = $_W['uniacid'];
     $res = $model->where("uniacid='".$uniacid."' and hos_tuijian=1")-> getall();
     foreach ($res as $key => $value) {
       $res[$key]['logo'] = $_W['attachurl'].$res[$key]['logo'];
     }
    echo json_encode($res);
  }
  //合作医院详情
  public function hospital_info(){
    global $_GPC, $_W;
    $model = Model('hospital');
    $uniacid = $_W['uniacid'];
    $hid = $_GPC['hid'];
    $res = $model->where('uniacid="'.$uniacid.'" and hid="'.$hid.'"')->get();
    $res['logo'] = $_W['attachurl'].$res['logo'];
    echo json_encode($res);
  }
  //专病服务----资讯分类
  public function zixunfenlei(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
   //  $model = Model('zixun_type');
   //  $res = $model->where("uniacid='".$uniacid."'")-> getall();
   //  foreach ($res as $key => $value) {
   //   $res[$key]['zx_thumb'] = $_W['attachurl'].$res[$key]['zx_thumb'];
   // }
    $res = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_zixun_type")." WHERE uniacid=:uniacid and pid=0 and enabled=1 order by sort desc ",array(":uniacid"=>$uniacid));
    if (!empty($res)) {
        foreach ($res as &$value) {
            $value['zx_thumb'] = $_W['attachurl'].$value['zx_thumb'];
        }
    }
    echo json_encode($res);
  }
     public function userformId(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $data['form_id'] = $_REQUEST['form_id'];
        $data['form_time'] = time();
        $openid = $_REQUEST['openid'];
        $member = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_userinfo') . " where uniacid=:uniacid and openid = :openid", array(":openid" => $openid, ":uniacid" => $uniacid));
        if ($member['form_id'] == '') {
            $arr = array();
        } else {
            $arr = unserialize($member['form_id']);
            foreach ($arr as $k => $v) {
                $form_time = $v['form_time'];
                $out_time = strtotime('-7 days', time());
                if ($out_time >= $form_time) {
                    unset($arr[$k]);
                }
            }
        }
        array_push($arr, $data);
        $new_arr = serialize($arr);
        $ret = pdo_update('hyb_yl_userinfo', array('form_id' => $new_arr), array('u_id' => $member['u_id'], 'uniacid' => $uniacid));
        echo json_encode($ret);
    }
    //推荐资讯
    public function hotactor(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_zixun')."as a left join".tablename('hyb_yl_zixun_type')."as b on b.zx_id=a.p_id where a.uniacid='{$uniacid}' and a.status=1");
        foreach ($res as $key => $value) {
          $res[$key]['thumb'] = $_W['attachurl'].$res[$key]['thumb'];
          $res[$key]['read'] = $res[$key]['dianj'] + $res[$key]['xncs'];
        }
        echo json_encode($res);
    }
    // 热门话题(问答大厅数据)
    public function hotanswer()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $list = pdo_fetchall("select a.*,z.xn_reoly,z.advertisement,z.z_name,z.z_zhicheng,u.u_id from ".tablename("hyb_yl_answer")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid  where a.uniacid=".$uniacid." and a.is_hot=1 and a.status=0 order by a.id desc");
      
      foreach($list as &$value)
      {
        $value['typs'] = 'answer';
        $value['content'] = htmlspecialchars_decode($value['content']);
        $value['label'] = explode($value['label'], ',');
        $value['keshi_ones'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$value['keshi_one']),'ctname');
        $value['keshi_twos'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['keshi_two']),'name');
        if($value['zid']  != '0'){
          $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
          $value['help'] = $value['xn_reoly'];
        }else{
          $value['zhicheng'] = '';
          $value['help'] = rand(1,10);
        }
        
        $value['names'] = '匿名用户'.$value['u_id'];
       
        if(strpos($value['advertisement'],'http') === false)
        {
          $value['advertisement'] = $_W['attachurl'].$value['advertisement'];
        }
        if($value['zid'] == '0')
        {
            $value['advertisement'] = $_W['siteroot']."addons/hyb_yl/web/resource/images/zhuanjia.png";
        }
      }
      echo json_encode($list);
    }
    public function userqydoc(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $user = pdo_get("hyb_yl_userinfo",array('openid'=>$openid));
        $u_id = $user['u_id'];
        $res = pdo_get("hyb_yl_qianyueorder",array('uniacid'=>$uniacid,'openid'=>$openid));
        if($res){
         //查询所有医生的医说
          $result = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_yishuo')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid where a.uniacid='{$uniacid}' and find_in_set('{$u_id}', a.user) and a.hid =0 limit 5  "  );
          foreach ($result as $key => $value) {
           $result[$key]['yspic'] = $_W['attachurl'].$result[$key]['yspic'];
           $result[$key]['advertisement'] = $_W['attachurl'].$result[$key]['advertisement'];
          }
        }else{
          $result=array();
        }
        echo json_encode($result);
    }
    public function userqydocall(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $user = pdo_get("hyb_yl_userinfo",array('openid'=>$openid));
        $u_id = $user['u_id'];
        $res = pdo_get("hyb_yl_qianyueorder",array('uniacid'=>$uniacid,'openid'=>$openid));
        if($res){
         //查询所有医生的医说
          $result = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_yishuo')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid where a.uniacid='{$uniacid}' and find_in_set('{$u_id}', a.user) and a.hid =0"  );
          foreach ($result as $key => $value) {
           $result[$key]['advertisement'] = $_W['attachurl'].$result[$key]['advertisement'];
          }
        }else{
          $result=array();
        }
        echo json_encode($result);
    }
    public function userhj(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $user = pdo_get("hyb_yl_userinfo",array('openid'=>$openid));
        $u_id = $user['u_id'];
        $res = pdo_get("hyb_yl_qianyueorder",array('uniacid'=>$uniacid,'openid'=>$openid));
        if($res){
         //查询所有医生的医说
          $result = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_yishuo')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid left join".tablename('hyb_yl_hjiaosite')."as c on c.h_id=a.hid where a.uniacid='{$uniacid}' and find_in_set('{$u_id}',a.user) and a.hid !=0 "  );
          foreach ($result as $key => $value) {
           $result[$key]['advertisement'] = $_W['attachurl'].$result[$key]['advertisement'];
           $result[$key]['h_pic'] = $_W['attachurl'].$result[$key]['h_pic'];
          }
        }else{
          $result=array();
        }
        echo json_encode($result);
    }

    public function footerlist(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $base= pdo_get("hyb_yl_base",array('uniacid'=>$uniacid),array('ztcolor'));
        if($openid != '')
        {
          $res = pdo_get("hyb_yl_visit",array("openid"=>$openid,"type"=>'0','day'=>date("Y-m-d",time())));
          if(!$res)
          {
              $visit = array(
                'uniacid' => $uniacid,
                "openid" => $openid,
                "type" =>'0',
                "day" => date("Y-m-d",time()),
                "created" => time(),
              );
              pdo_insert("hyb_yl_visit",$visit);
          }
        }
        $res =pdo_get("hyb_yl_menu_array",array('uniacid'=>$uniacid));
        $footers_menu = unserialize($res['footers_menu']);
        $result2 = [];
        array_map(function ($value) use (&$result2) {
          $result2 = array_merge($result2, array_values($value));
        }, $footers_menu); 
        foreach ($result2 as $key => $value) {
       
          if($result2[$key]['switch'] !=='on'){
            unset($result2[$key]);
          }else{
            $result2[$key]['default_img'] = tomedia($result2[$key]['default_img']);
            $result2[$key]['selected_img'] = tomedia($result2[$key]['selected_img']);  
            $result2[$key]['color'] = $base['ztcolor'];  
            $new_arr[] = $result2[$key];
          }
           

        }


        echo json_encode($new_arr);
    }

    public function kjserverlist(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $res = pdo_fetchall("select * from".tablename('hyb_yl_service_homepage')."as a left join".tablename('hyb_yl_all_server_menulist')."as c on c.ids=a.ids where a.uniacid='{$uniacid}' and a.state=1 and a.weizhi=0 order by a.stort");
        foreach ($res as $key => $value) {
          $res[$key]['pluginimgs'] = tomedia($res[$key]['serh_thumb']);
        }
        echo json_encode($res);
    }
    public function serverpxlist(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $res = pdo_fetchall("SELECT titles,server_key from".tablename('hyb_yl_all_server_menulist')."where uniacid ='{$uniacid}' and (server_key='tuwenwenzhen' or  server_key='dianhuajizhen' or  server_key='shipinwenzhen' or  server_key='yuanchengguahao' or  server_key='yuanchengkaifang' or  server_key='yuanchengkaifang' or  server_key='shoushukuaiyue')");
        echo json_encode($res);
    }
    // public function detailserone(){
    //     global $_GPC, $_W;
    //     $uniacid = $_W['uniacid'];
    //     $ser_key = $_GPC['ser_key'];
    //     $id = $_GPC['id'];
    //    $res = pdo_fetch("SELECT * from".tablename('hyb_yl_service_homepage')."as a left join".tablename('hyb_yl_all_server_menulist')."as b on b.ids=a.ids where a.uniacid ='{$uniacid}' and b.server_key='{$ser_key}'");
        
    //     $res['pluginimgs'] = tomedia($res['serh_thumb']);
    //     $res['serh_content'] = htmlspecialchars_decode($res['serh_content']);
    //     $res['serh_liuc'] = htmlspecialchars_decode($res['serh_liuc']);
    //     $res['serh_xiey'] = htmlspecialchars_decode($res['serh_xiey']);
    //     $res['tui_money'] = htmlspecialchars_decode($res['tui_money']);
    //     //查询总用户
    //     $res['personcount'] = pdo_fetchcolumn("SELECT count(*) FROM".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}'");
      
    //     echo json_encode($res);
    // }
    public function detailserones(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $ser_key = $_GPC['ser_key'];
        if($ser_key == 'zhuanjiatuandui')
        {
          $ser_key = 'sirenyisheng';
        }
        $id = $_GPC['id'];
        $res = pdo_fetch("SELECT * from".tablename('hyb_yl_service_homepage')."as a left join".tablename('hyb_yl_all_server_menulist')."as b on b.ids=a.ids where a.uniacid ='{$uniacid}' and b.server_key='{$ser_key}'");
        
        
        $res['pluginimgs'] = tomedia($res['serh_thumb']);
        $res['serh_content'] = htmlspecialchars_decode($res['serh_content']);
        $res['serh_liuc'] = htmlspecialchars_decode($res['serh_liuc']);
        $res['serh_xiey'] = htmlspecialchars_decode($res['serh_xiey']);
        $res['tui_money'] = htmlspecialchars_decode($res['tui_money']);
        //查询总用户
        $res['personcount'] = pdo_fetchcolumn("SELECT count(*) FROM".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}'");
        if($ser_key == 'yuanchengguahao')
        {
          $res['count'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid);
          $res['pingjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid='{$uniacid}' and ifpay=4");
        }
       if($ser_key == 'tuwenwenzhen')
        {
          $res['count'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid='{$uniacid}'");
          $res['pingjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid='{$uniacid}' and ifpay=4 and role =0  group by openid ");
        }
       if($ser_key == 'dianhuajizhen')
        {
          $res['count'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid='{$uniacid}' and keywords='dianhuajizhen' ");
          $res['pingjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid='{$uniacid}' and ifpay=4 and keywords='dianhuajizhen'");
        }
       if($ser_key == 'shipinwenzhen')
        {
          $res['count'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid='{$uniacid}' and keywords='shipinwenzhen' ");
          $res['pingjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid='{$uniacid}' and ifpay=4 and keywords='shipinwenzhen'");
        }
       if($ser_key == 'yuanchengkaifang')
        {
          $res['count'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid='{$uniacid}' and keywords='yuanchengkaifang' ");
          $res['pingjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid='{$uniacid}' and ifpay=4 and keywords='yuanchengkaifang'");
        }
       if($ser_key == 'shoushukuaiyue')
        {
          $res['count'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid='{$uniacid}' and keywords='shoushukuaiyue' ");
          $res['pingjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid='{$uniacid}' and ifpay=4 and keywords='shoushukuaiyue'");
        }

        echo json_encode($res);
    }

   public function techen()
  {
     global $_W,$_GPC;
     $uniacid =$_W['uniacid'];
     $res = pdo_get("hyb_yl_parameter",array('uniacid'=>$uniacid));
     $res['wxapp_mb'] = unserialize($res['wxapp_mb'] );
     echo json_encode($res);
  }

public function getksbiaoqian(){
     global $_W,$_GPC;
     $uniacid =$_W['uniacid'];
     $id = $_GPC['id'];
     $res =pdo_get("hyb_yl_ceshi",array('id'=>$id),array('description'));
     $description = explode('、', $res['description']);
     echo json_encode($description);
  }
  public function address(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $op =$_GPC['op'];
    //所有区域
    if($op =='quyu'){
      $res =pdo_fetchall("SELECT * FROM".tablename("hyb_yl_address")."where pid=0 and displayorder!=1 and visible=1 and status=1 and uniacid='{$uniacid}'");
      //查询他下面的所有二级
      foreach ($res as $key => $value) {
          $pid =$value['parentid'];
          $res[$key]['erji']=pdo_fetchall("SELECT * FROM".tablename("hyb_yl_address")."where pid='{$pid}' and status=1 and uniacid='{$uniacid}'");
      }
      echo json_encode($res);
    }
    //区域医院
    if($op =='yiyuan'){
     $id = $_GPC['id'];
     $address =$_GPC['address'];
     $qx_id = $_GPC['qx_id'];
     
     $res =pdo_fetchall("SELECT * FROM".tablename("hyb_yl_hospital")."where  uniacid='{$uniacid}' and city='{$id}'and hos_tuijian=1 and groupid='{$qx_id}';");
     foreach ($res as $key => $value) {
       //查询所有医生
        $hid = $value['hid'];
        $res[$key]['alldoc'] = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_zhuanjia")."as a left join".tablename("hyb_yl_hospital")."as b on b.hid=a.hid where b.uniacid='{$uniacid}' and a.hid='{$hid}'");
          foreach ($res[$key]['alldoc'] as $key1 => $value1) {
          $res[$key]['alldoc'][$key1]['advertisement'] =$_W['attachurl'].$res[$key]['alldoc'][$key1]['advertisement'];
         }
      }
      echo json_encode($res);
    }

    if($op =='keshi'){
    
     $res =pdo_fetchall("SELECT * FROM".tablename("hyb_yl_classgory")."where uniacid='{$uniacid}' and typeint=0");
 
      echo json_encode($res);
    }


    if($op =='keshidoc'){
     $nksid =$_GPC['nksid'];

     $res =pdo_fetchall("SELECT * FROM".tablename("hyb_yl_hospital")." as a left join ".tablename("hyb_yl_zhuanjia")."as b on b.nksid=a.id where b.nksid='{$nksid}' and a.uniacid='{$uniacid}' and z_yy_type=1 ");
     foreach ($res as $key => $value) {
      $res[$key]['alldoc'] = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_zhuanjia")."as a left join".tablename("hyb_yl_hospital")."as b on b.hid=a.hid where a.uniacid='{$uniacid}' and a.nksid='{$nksid}'");
        foreach ($res[$key]['alldoc'] as $key1 => $value1) {
          $res[$key]['alldoc'][$key1]['advertisement'] =$_W['attachurl'].$res[$key]['alldoc'][$key1]['advertisement'];
        }
      $res[$key]['advertisement'] =$_W['attachurl'].$res[$key]['advertisement'];
     }
      echo json_encode($res);
    }
//
  }
  public function parentclass(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];   
    $id = $_GPC['id'];
    $row = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_ceshi')."where uniacid='{$uniacid}' and giftstatus='{$id}' and enabled=1 order by sort");
    echo json_encode($row);
  }
  public function ksbiaoqian(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];   
    $id = $_GPC['id'];
    $row = pdo_fetch("SELECT description FROM".tablename('hyb_yl_ceshi')."where uniacid='{$uniacid}' and id='{$id}' and enabled=1 order by sort");
    echo json_encode($row);
  }
 public function getjoblist(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];  
    $res = pdo_fetchall("SELECT id,job_name FROM".tablename('hyb_yl_zhuanjia_job')."WHERE uniacid='{$uniacid}' and job_state=1 order by job_strot desc");
    echo json_encode($res);
   } 
 public function addressopen(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];  
    $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_address')."WHERE uniacid='{$uniacid}' and level=1 and status=1");
    echo json_encode($res);
   } 

   // 获取幻灯片
   public function adv()
   {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $position = $_GPC['position'];
      $list = pdo_fetchall("select * from ".tablename("hyb_yl_adv")." where uniacid=".$uniacid." and position=".$position." and status=1 order by sort desc");
      foreach($list as &$value)
      {
        $value['thumb'] = tomedia($value['thumb']);
      }
      echo json_encode($list);
   }
   //查询默认物流
   public function wuliucheack(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $row = pdo_get("hyb_yl_parameter",array('uniacid'=>$uniacid),array('wlid'));
      $id = $row['wlid'];
      $res = pdo_fetch("select * FROM".tablename('hyb_yl_kuaidi')."where uniacid='{$uniacid}' and id ='{$id}'");
      echo json_encode($res);
   }
   //查询机构管理员
   public function hospitaladmin(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $id  = $_GPC['id'];
      $res = pdo_get('hyb_yl_tijianorder',array('id'=>$id,'uniacid'=>$uniacid));
      $openid = $res['openid'];
      echo json_encode($openid);
   }
   //提现

   public function tixiansite(){
    //
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $res = pdo_get('hyb_yl_jiesuan_set',array('uniacid'=>$uniacid));
      echo json_encode($res);

   }
   public function kuaidiselect(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      defined('IN_IA') or exit('Access Denied');
      $kuaidi100 =  pdo_fetch("SELECT * FROM".tablename('hyb_yl_parameter')."where uniacid='{$uniacid}'");
      $post_data = array();
      $post_data["customer"] = $kuaidi100['wuliu_appid'];
      $key=  $kuaidi100['wuliu_key'];
      $com =$_GPC['com'];
      $num =$_GPC['num'];
      $datas['com']=$com;  //查询的快递公司的编码， 一律用小写字母
      $datas['num']=$num;  //查询的快递单号， 单号的最大长度是32个字符 358263398950
      $post_data["param"] =json_encode($datas);
      $url='http://poll.kuaidi100.com/poll/query.do';
      $post_data["sign"] = md5($post_data["param"].$key.$post_data["customer"]);
      $post_data["sign"] = strtoupper($post_data["sign"]);
      $o="";
      foreach ($post_data as $k=>$v)
      {
          $o.= "$k=".urlencode($v)."&";   //默认UTF-8编码格式
      }
      $post_data=substr($o,0,-1);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
      $result = curl_exec($ch);
      $data = str_replace("\"",'"',$result );
      $data = json_decode($data,true);
      json_encode($data);
   }
   //附近药房
   public function yao_hospital()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $longitude = $_GPC['longitude'];
    $latitude = $_GPC['latitude'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $addressId = $_GPC['addressId'];
  
    if(!empty($addressId)){
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and city=".$addressId." and  hos_tuijian=1 and is_index=1 and groupid=2");
     
    }else{

       $list = pdo_fetchall("select * from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid."  and groupid=2");
       
    }
  
    foreach($list as &$value)
    {
    
      $value['logo'] = tomedia($value['logo']);
      $R = 6371; //地球平均半径,单位km
      $dlat = deg2rad($value['latitude']-$latitude);
      $dlon = deg2rad($value['longitude']-$longitude);
      $a = pow(sin($dlat/2), 2) + cos(deg2rad($latitude)) * cos(deg2rad($latitude)) * pow(sin($dlon/2), 2);
      $c = 2 * atan2(sqrt($a), sqrt(1-$a));
      $d = $R * $c;
      $ac = round($d,2);//两地间距离（四舍五入，保留两位）
      $value['juli'] = $ac;
      $zids = '';
      $zhuanjia = pdo_fetchall("select zid,score from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$value['hid']);
      $count = count($zhuanjia);
        if($count != 0 && $count != '')
        {
          $value['score'] = ceil($zhuanjia['score'] / $count);
        }else{
          $value['score'] = 5;
        }
      
      foreach($zhuanjia as &$zj)
      {
        $zids .= $zj['zid'].",";
      }
      $zids = substr($zids, 0,strlen($zids)-1);
      

      $tuwen_wz = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zids.") and (ifpay=2 or ifpay=3 or ifpay=4) group by back_orser");
      $wzorder_wz = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zids.") and (ifpay=2 or ifpay=3 or ifpay=4) group by back_orser");
      $chufang_zw = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zids.") and (ispay=2 or ispay=3 or ispay=4) group by back_orser");
      $tuwen_wz = array_column($tuwen_wz, 'count(*)');
      $wzorder_wz = array_column($wzorder_wz, 'count(*)');
      $chufang_zw = array_column($chufang_zw, 'count(*)');
      $value['wenzhen'] = array_sum($tuwen_wz) + array_sum($wzorder_wz) + array_sum($chufang_zw);
      $tuwen_yy = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay=1 group by back_orser");
      $wzorder_yy = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay=1 group by back_orser");
      $chufang_yy = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zids.") and ispay=1 group by back_orser");
      $tuwen_yy = array_column($tuwen_yy, 'count(*)');
      $wzorder_yy = array_column($wzorder_yy, 'count(*)');
      $chufang_yy = array_column($chufang_yy, 'count(*)');
      $value['yuyue'] = array_sum($tuwen_yy) + array_sum($wzorder_yy) + array_sum($chufang_yy);
     
    }
   
    array_multisort(array_column($list,'juli'),SORT_ASC,$list);
    $list = array_slice($list, $page * $pagesize,$pagesize);
    echo json_encode($list);
   }
   // 查询附近诊所
   public function near_hospital()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $longitude = $_GPC['longitude'];
    $latitude = $_GPC['latitude'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $addressId = $_GPC['addressId'];
  
    if(!empty($addressId)){
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and city=".$addressId." and  hos_tuijian=1 and is_index=1 ");
     
       
    }else{

       $list = pdo_fetchall("select * from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and  hos_tuijian=1 and is_index=1");
       
    }
  
    foreach($list as &$value)
    {
    
      $value['logo'] = tomedia($value['logo']);
      $R = 6371; //地球平均半径,单位km
      $dlat = deg2rad($value['latitude']-$latitude);
      $dlon = deg2rad($value['longitude']-$longitude);
      $a = pow(sin($dlat/2), 2) + cos(deg2rad($latitude)) * cos(deg2rad($latitude)) * pow(sin($dlon/2), 2);
      $c = 2 * atan2(sqrt($a), sqrt(1-$a));
      $d = $R * $c;
      $ac = round($d,2);//两地间距离（四舍五入，保留两位）
      $value['juli'] = $ac;
      $zids = '';
      $zhuanjia = pdo_fetchall("select zid,score from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$value['hid']);
      $count = count($zhuanjia);
        if($count != 0 && $count != '')
        {
          $value['score'] = ceil($zhuanjia['score'] / $count);
        }else{
          $value['score'] = 5;
        }
      
      foreach($zhuanjia as &$zj)
      {
        $zids .= $zj['zid'].",";
      }
      $zids = substr($zids, 0,strlen($zids)-1);
      

      $tuwen_wz = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zids.") and (ifpay=2 or ifpay=3 or ifpay=4) group by back_orser");
      $wzorder_wz = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zids.") and (ifpay=2 or ifpay=3 or ifpay=4) group by back_orser");
      $chufang_zw = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zids.") and (ispay=2 or ispay=3 or ispay=4) group by back_orser");
      $tuwen_wz = array_column($tuwen_wz, 'count(*)');
      $wzorder_wz = array_column($wzorder_wz, 'count(*)');
      $chufang_zw = array_column($chufang_zw, 'count(*)');
      $value['wenzhen'] = array_sum($tuwen_wz) + array_sum($wzorder_wz) + array_sum($chufang_zw);
      $tuwen_yy = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay=1 group by back_orser");
      $wzorder_yy = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay=1 group by back_orser");
      $chufang_yy = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zids.") and ispay=1 group by back_orser");
      $tuwen_yy = array_column($tuwen_yy, 'count(*)');
      $wzorder_yy = array_column($wzorder_yy, 'count(*)');
      $chufang_yy = array_column($chufang_yy, 'count(*)');
      $value['yuyue'] = array_sum($tuwen_yy) + array_sum($wzorder_yy) + array_sum($chufang_yy);
     
    }
   
    array_multisort(array_column($list,'juli'),SORT_ASC,$list);
    $list = array_slice($list, $page * $pagesize,$pagesize);
    echo json_encode($list);
   }

   // 查询全部机构
   public function allhospital()
   {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $longitude = $_GPC['longitude'];
      $latitude = $_GPC['latitude'];
      $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
      $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
      $groupid = $_GPC['groupid'];
      $order = $_GPC['order'];
      $where = " where hos_tuijian=1 and uniacid=".$uniacid;
      $orders = " order by hid desc ";
      if($groupid != '')
      {
        $where .= " and groupid=".$groupid;
      }
      
      $list = pdo_fetchall("select * from ".tablename("hyb_yl_hospital").$where);
      foreach($list as &$value)
      {
        $value['logo'] = tomedia($value['logo']);
        $R = 6371; //地球平均半径,单位km
        $dlat = deg2rad($value['latitude']-$latitude);
        $dlon = deg2rad($value['longitude']-$longitude);
        $a = pow(sin($dlat/2), 2) + cos(deg2rad($latitude)) * cos(deg2rad($latitude)) * pow(sin($dlon/2), 2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $d = $R * $c;
        $ac = round($d,2);//两地间距离（四舍五入，保留两位）
        $value['juli'] = $ac;

        $zhuanjia = pdo_fetchall("select zid,score,count(*) as count from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$value['hid']);
        if($zhuanjia['count'] != 0 && $zhuanjia['count'] != '')
        {
          $value['score'] = ceil($zhuanjia['score'] / $zhuanjia['count']);
        }else{
          $value['score'] = 5;
        }
        $zids = '';
        foreach($zhuanjia as &$zj)
        {
          $zids .= $zj['zid'].",";
        }
        $zids = substr($zids, 0,strlen($zids)-1);
        $tuwen_wz = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zids.") and (ifpay=2 or ifpay=3 or ifpay=4) group by back_orser");
        $wzorder_wz = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zids.") and (ifpay=2 or ifpay=3 or ifpay=4) group by back_orser");
        $chufang_zw = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zids.") and (ispay=2 or ispay=3 or ispay=4) group by back_orser");
        $value['wenzhen'] = array_sum($tuwen_wz) + array_sum($wzorder_wz) + array_sum($chufang_zw);
        $tuwen_yy = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay=1 group by back_orser");
        $wzorder_yy = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay=1 group by back_orser");
        $chufang_yy = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zids.") and ispay=1 group by back_orser");
        $value['yuyue'] = array_sum($tuwen_yy) + array_sum($wzorder_yy) + array_sum($chufang_yy);
      }

      if($order == '1')
      {
        array_multisort(array_column($list,'juli'),SORT_ASC,$list);
      }else if($order == '2')
      {
        array_multisort(array_column($list,'score'),SORT_DESC,$list);
      }else
      {
        array_multisort(array_column($list,'hid'),SORT_DESC,$list);
      }

      $list = array_slice($list, $page * $pagesize,$pagesize);
      echo json_encode($list);
      
   }

   public function hospital_type()
   {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $list = pdo_getall("hyb_yl_hospital_diction",array("uniacid"=>$uniacid));
      $arr = array(
        'id' => '',
        'name' => '全部分类',
      );
      array_unshift($list, $arr);
      echo json_encode($list);
   }
   public function addtuikeerji(){
      global $_W,$_GPC;
       $uniacid = $_W['uniacid'];
      $value =htmlspecialchars_decode($_GPC['city']);
      $array =json_decode($value);
      $object =json_decode(json_encode($array),true);
      //查询是否是免审核
      $roul =pdo_get('hyb_yl_tuike_roul',array('uniacid'=>$uniacid));
      if($roul['twoexamine'] =='1'){
          $data['state'] = 0;
      }else{
          $data['state'] = 1;
      }
      $data['uniacid'] =$_W['uniacid'];
      $data['username'] =$_GPC['username'];
      $data['tel'] =$_GPC['tel'];
      $data['address'] = serialize($object);
      $data['openid'] =$_GPC['openid'];
      $data['addtime'] = date('Y-m-d H:i:s');
      $data['tkid'] =$_GPC['tkid'];
      $data['leve'] =$_GPC['leve'];
      $data['money'] =$_GPC['money'];
      $res = pdo_insert('hyb_yl_tuikesite',$data);
      $id = pdo_insertid();
      echo json_encode($id);
   }
   public function addtuike(){
      global $_W,$_GPC;
       $uniacid = $_W['uniacid'];
      $value =htmlspecialchars_decode($_GPC['city']);
      $array =json_decode($value);
      $object =json_decode(json_encode($array),true);
      //查询是否是免审核
      $roul =pdo_get('hyb_yl_tuike_roul',array('uniacid'=>$uniacid));
      if($roul['examine'] =='1'){
          $data['state'] = 0;
      }else{
          $data['state'] = 1;
      }
      $data['uniacid'] =$_W['uniacid'];
      $data['username'] =$_GPC['username'];
      $data['tel'] =$_GPC['tel'];
      $data['address'] = serialize($object);
      $data['openid'] =$_GPC['openid'];
      $data['addtime'] = date('Y-m-d H:i:s');
      $data['tkid'] =$_GPC['tkid'];
      $data['leve'] =$_GPC['leve'];
      $data['money'] =$_GPC['money'];
      $res = pdo_insert('hyb_yl_tuikesite',$data);
      $id = pdo_insertid();
      echo json_encode($id);
   }
   public function usertuike(){
      global $_W,$_GPC;
      $openid = $_GPC['openid'];
       $uniacid = $_W['uniacid'];
      $res = pdo_get('hyb_yl_tuikesite',array('openid'=>$openid));
 
      if($res){
        echo json_encode($res);
      }else{
        echo 0;
      }
      
   }
   public function tuikeinfo(){
      global $_W,$_GPC;
      $id = $_GPC['id'];
      $res = pdo_get('hyb_yl_tuikesite',array('id'=>$id));
      $res['userinfo'] = pdo_get("hyb_yl_userinfo",array('openid'=>$res['openid']));
      echo json_encode($res);
   }
   public function iftuoke(){
      global $_W,$_GPC;
      $openid = $_GPC['openid'];
      $res = pdo_get('hyb_yl_tuikesite',array('openid'=>$openid,'state'=>1));
      if($res){
        echo json_encode($res);
      }else{
        echo json_encode($res);
      }
      
   }
   //增加推客次数
   public function updatetuike(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $data['uniacid'] = $uniacid;
      $data['type'] = intval($_GPC['type']);
      $data['openid'] = $openid;
      $data['tgtime'] = strtotime('now');
      $data['tkid'] = $_GPC['tkid'];//一级
      $data['mytkid'] = $_GPC['mytkid'];//二级
      $data['content'] =$_GPC['content'];
      $data['zid']=$_GPC['zid'];
      $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//当天开始时间戳
      $endToday=mktime(23,59,59,date("m"),date("d"),date("Y"));

      $user =pdo_fetch("SELECT * FROM".tablename('hyb_yl_tuiguanglog')."where uniacid='{$uniacid}' and tgtime>='{$beginToday}' and tgtime<=$endToday and openid='{$openid}' and type=4 and tkid='{$_GPC['tkid']}'");
      
      if(!$user){
        $res = pdo_insert('hyb_yl_tuiguanglog',$data);
      }else{
        $res =0;
      }
      //更新用户拓客id
      //pdo_update('hyb_yl_userinfo',array('tkid'=>$_GPC['tkid']),array('openid'=>$_GPC['openid']));
      echo json_encode($res);
   }
   public function tuikedata(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      
      $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//当天开始时间戳
      $endToday=mktime(23,59,59,date("m"),date("d"),date("Y"));
      
      $res = pdo_getall('hyb_yl_tuiguanglog',array('tkid'=>$id));
      $count ="";
      $str=date("Y-m-d",strtotime("-1 day"))." 0:0:0";
      $star=strtotime($str);
      $str=date("Y-m-d",strtotime("-1 day"))." 24:00:00";
      $end=strtotime($str);

      $count=pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('hyb_yl_tuiguanglog')."where uniacid='{$uniacid}' and tgtime>='{$beginToday}' and tgtime<='{$endToday}' and type=4 and tkid ='{$id}'");
      
      $ztcount=pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('hyb_yl_tuiguanglog')."where uniacid='{$uniacid}' and tgtime>='{$star}' and tgtime<='{$end}' and type=4 and tkid ='{$id}'");

      $hzoldcount=pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}' and UNIX_TIMESTAMP(zctime)>='{$beginToday}' and UNIX_TIMESTAMP(zctime)<='{$endToday}' and  tkid ='{$id}'");

      $hzcountnear=pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}' and UNIX_TIMESTAMP(zctime)>='{$star}' and UNIX_TIMESTAMP(zctime)<='{$end}' and  tkid ='{$id}'");

      $nearyongjin = pdo_fetchall("SELECT * FROM ".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and over=1 and  tkid ='{$id}'");
      
      $oldtgcount=pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('hyb_yl_tuiguanglog')."where uniacid='{$uniacid}' and tgtime>='{$star}' and tgtime<='{$end}' and type=1 and tkid ='{$id}'");
      $tgcount = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('hyb_yl_tuiguanglog')."where uniacid='{$uniacid}' and tgtime>='{$beginToday}' and tgtime<='{$endToday}' and type=1 and tkid ='{$id}'");
      $toyyongjin="";
      $zyyongjin="";
      //查询我的团队
      $tuandui1 = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}' and tkid ='{$id}'");
      $tuandui2 = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('hyb_yl_zhuanjia')."where uniacid='{$uniacid}' and tkid ='{$id}'");
      $tuandui3 = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('hyb_yl_tuikesite')."where uniacid='{$uniacid}' and tkid ='{$id}'");
      $tuandui = intval($tuandui1+$tuandui2+$tuandui3);
      $dingdan = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and (tkid ='{$id}' or mytkid='{$id}')");
      //提现
      $tixian = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('hyb_yl_tuike_tixian_log')."where uniacid='{$uniacid}' and tkid ='{$id}'");
      foreach ($nearyongjin as $key => $value) {
         $addtime = strtotime($value['addtime']);
    
         if($beginToday <= $addtime && $addtime<=$endToday){
            $tid = $value['id'];
            $toyyongjin = pdo_fetchcolumn("SELECT SUM(*) FROM ".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and over=1  and tkid ='{$tid}'");
         }else{
            $toyyongjin =0;
         }
         if($star <= $addtime && $addtime<=$end){
            $yid = $value['id'];
            $zyyongjin = pdo_fetchcolumn("SELECT SUM(*) FROM ".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and over=1  and tkid ='{$yid}'");
         }else{
            $zyyongjin =0;
         }
      }
      //查询我的专家
      $tgzhuanjia = pdo_fetchcolumn('SELECT count(*) FROM'.tablename('hyb_yl_zhuanjia')." where uniacid='{$uniacid}' and tkid ='{$id}' and opentime>='{$beginToday}' and opentime<='{$endToday}'");
      $ztzhuanjia = pdo_fetchcolumn('SELECT count(*) FROM'.tablename('hyb_yl_zhuanjia')." where uniacid='{$uniacid}' and tkid ='{$id}' and opentime>='{$star}' and opentime<='{$end}'");
     
      $tgjigou = pdo_fetchcolumn('SELECT count(*) FROM'.tablename('hyb_yl_hospital')." where uniacid='{$uniacid}' and tkid ='{$id}' and zctime>='{$beginToday}' and zctime<='{$endToday}'");
      
      $ztjigou= pdo_fetchcolumn('SELECT count(*) FROM'.tablename('hyb_yl_hospital')." where uniacid='{$uniacid}' and tkid ='{$id}' and zctime>='{$star}' and zctime<='{$end}'");
      $jigoucountnum =intval($tgjigou+$ztjigou);
      
      $jtshuju_a = intval($tgzhuanjia+$tgjigou);
      $ztshuju_a = intval($ztzhuanjia+$ztjigou);
      
      $data =array(
       'nearcount'  =>$count,
       'oldcount'   =>$ztcount,
       'hzcountnear'=>$hzcountnear,
       'hzoldcount' =>$hzoldcount,
       'tgcount'    =>$tgcount,
       'oldtgcount' =>$oldtgcount,
       'zyyongjin'  =>empty($zyyongjin)?'0':$zyyongjin,
       'toyyongjin' =>empty($toyyongjin)?'0':$toyyongjin,
       'tuandui'    =>empty($tuandui)?'0':$tuandui,
       'dingdan'    =>empty($dingdan)?'0':$dingdan,
       'tixian'     =>empty($tixian)?'0':$tixian,
       'jtshuju_a' =>empty($jtshuju_a)?'0':$jtshuju_a,
       'ztshuju_a' =>empty($ztshuju_a)?'0':$ztshuju_a,
      );
     echo json_encode($data);
   }
   public function tuikrulo(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $res =pdo_get('hyb_yl_tuike_roul',array('uniacid'=>$uniacid));
      $res['slide_thumb'] = unserialize($res['slide_thumb']);
      for ($i=0; $i <count($res['slide_thumb']) ; $i++) { 
       $res['slide_thumb'][$i] = $_W['attachurl'] . $res['slide_thumb'][$i];
      }
      echo json_encode($res);
   }
   public function updatetuikehosp(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $hid = $_GPC['hid'];
      $data['openid'] = $_GPC['openid'];
      $data['uniacid'] = $uniacid;
      $data['hid'] = $_GPC['hid'];
      $data['addtime'] =strtotime('now');
      $one_info = pdo_get('hyb_yl_tuihospital',array('hid'=>$hid,'openid'=>$_GPC['openid']));
      if($one_info){
         $shar_num = pdo_getcolumn('hyb_yl_tuihospital',array('uniacid'=>$uniacid,'hid'=>$hid,'openid'=>$_GPC['openid']),'shar_num');
         $data['shar_num'] = $shar_num+1;
        $res= pdo_update('hyb_yl_tuihospital',$data);
      }else{
        $res= pdo_insert('hyb_yl_tuihospital',$data);
      }
      
      echo json_encode($res);
   }
   public function shangjiuserselect(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $tkid = $_GET['tkid'];
      $res = pdo_get('hyb_yl_tuikesite',array('id'=>$tkid));
      echo json_encode($res);
   }
   public function erjiopen(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $res = pdo_getcolumn('hyb_yl_tuike_roul',array('uniacid'=>$uniacid),'twoappdis');
      $int = intval($res);
      echo json_encode($int);
   }
   public function yaofang()
   {
global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $longitude = $_GPC['longitude'];
    $latitude = $_GPC['latitude'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $addressId = $_GPC['addressId'];
  
    if(!empty($addressId)){
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and city=".$addressId." and groupid=2");
    }else{
       $list = pdo_fetchall("select * from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid."  and groupid=2");
       
    }
  
    foreach($list as &$value)
    {
    
      $value['logo'] = tomedia($value['logo']);
      $R = 6371; //地球平均半径,单位km
      $dlat = deg2rad($value['latitude']-$latitude);
      $dlon = deg2rad($value['longitude']-$longitude);
      $a = pow(sin($dlat/2), 2) + cos(deg2rad($latitude)) * cos(deg2rad($latitude)) * pow(sin($dlon/2), 2);
      $c = 2 * atan2(sqrt($a), sqrt(1-$a));
      $d = $R * $c;
      $ac = round($d,2);//两地间距离（四舍五入，保留两位）
      $value['juli'] = $ac;
      $zids = '';
      $zhuanjia = pdo_fetchall("select zid,score from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$value['hid']);
      $count = count($zhuanjia);
        if($count != 0 && $count != '')
        {
          $value['score'] = ceil($zhuanjia['score'] / $count);
        }else{
          $value['score'] = 5;
        }
      
      foreach($zhuanjia as &$zj)
      {
        $zids .= $zj['zid'].",";
      }
      $zids = substr($zids, 0,strlen($zids)-1);
      

      $tuwen_wz = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zids.") and (ifpay=2 or ifpay=3 or ifpay=4) group by back_orser");
      $wzorder_wz = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zids.") and (ifpay=2 or ifpay=3 or ifpay=4) group by back_orser");
      $chufang_zw = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zids.") and (ispay=2 or ispay=3 or ispay=4) group by back_orser");
      $tuwen_wz = array_column($tuwen_wz, 'count(*)');
      $wzorder_wz = array_column($wzorder_wz, 'count(*)');
      $chufang_zw = array_column($chufang_zw, 'count(*)');
      $value['wenzhen'] = array_sum($tuwen_wz) + array_sum($wzorder_wz) + array_sum($chufang_zw);
      $tuwen_yy = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay=1 group by back_orser");
      $wzorder_yy = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zids.") and ifpay=1 group by back_orser");
      $chufang_yy = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zids.") and ispay=1 group by back_orser");
      $tuwen_yy = array_column($tuwen_yy, 'count(*)');
      $wzorder_yy = array_column($wzorder_yy, 'count(*)');
      $chufang_yy = array_column($chufang_yy, 'count(*)');
      $value['yuyue'] = array_sum($tuwen_yy) + array_sum($wzorder_yy) + array_sum($chufang_yy);
     
    }
   
    array_multisort(array_column($list,'juli'),SORT_ASC,$list);
    $list = array_slice($list, $page * $pagesize,$pagesize);
    echo json_encode($list);
     
   }

  public function lunbo()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $position =$_GPC['position'];
    $res =pdo_getall("hyb_yl_adv",array('uniacid'=>$uniacid,'position'=>$position,'status'=>1));
    foreach ($res as $key => $value) {
      $res[$key]['thumb'] = tomedia($res[$key]['thumb']);
    }
    echo json_encode($res);
  }

  // 获取最新订单
  public function neworder()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $month = strtotime("-0 year -1 month -0 day");
    $months = date("Y-m-d H:i:s", strtotime("-1 month"));
    $type = $_GPC['type'];
    if($type == 'index')
    {
      $user = pdo_fetchall("select u_name as name,u_thumb as thumbs,zctime as times from ".tablename("hyb_yl_userinfo")." where uniacid=".$uniacid." and zctime >='".$months."'");
      foreach($user as &$u)
      {
        $u['type'] = '用户';
      }

      $zhuanjia = pdo_fetchall("select z_name as name,advertisement as thumbs,opentime as time from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime>=".$month);
      foreach($zhuanjia as &$zj)
      {
        $zj['type'] = '专家';
        $zj['times'] = date("Y-m-d H:i:s",$zj['times']);
        $zj['thumbs'] = tomedia($zj['thumbs']);
      }

      $hospital = pdo_fetchall("select agentname as name,logo as thumbs,zctime as time,groupid from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and zctime>=".$month);
      foreach($hospital as &$hos)
      {
        if($hos['groupid'] == '1')
        {
          $hos['type'] = '医院';
        }else if($hos['groupid'] == '2')
        {
          $hos['type'] = '药房';
        }else if($hos['groupid'] == '3')
        {
          $hos['type'] = '体检机构';
        }else if($hos['groupid'] == '4')
        {
          $hos['type'] = '诊所';
        }
        $hos['times'] = date("Y-m-d H:i:s",$hos['time']);
        $hos['thumbs'] = tomedia($hos['thumbs']);
        
      }

      $yaoshi = pdo_fetchall("select name,thumb as thumbs,ruzhu_time as time from ".tablename("hyb_yl_yaoshi")." where uniacid=".$uniacid." and ruzhu_time >=".$month);
      foreach($yaoshi as &$ys)
      {
        $ys['times'] = date("Y-m-d H:i:s",$ys['time']);
        $ys['thumbs'] = tomedia($ys['thumbs']);
        $ys['type'] = '药师';
      }

      $green = pdo_fetchall("select title as name,thumb as thumbs,opentime as times from ".tablename("hyb_yl_guidance")." where uniacid=".$uniacid." and opentime>='".$months."'");
      foreach($green as &$gre)
      {
        $gre['thumbs'] = tomedia($gre['thumbs']);
        $gre['type'] = '导诊';
      }
      
      $list = array_merge($user,$zhuanjia,$yaoshi,$hospital,$green);
      if(count($list) > 20)
      {
        $list = array_slice($list,0,20);
      }
      foreach($list as &$value)
      {
        $time = strtotime(date("Y-m-d H:i:s",time()));
        $timess = strtotime($value['times']);
        $times = floor(($time-$timess)/3600);
        if ($times<=24) {
            $time1 = floor(($time-$timess)/60);
            if ($time1>60) {
                $time1s = floor($time1/60);
                $time1ss = $time1-$time1s*60;
                $value['times'] = $time1s."小时前";
            }else{
                if ($time1>0) {
                    $value['times'] = $time1."分钟前";
                }else{
                    $value['times'] = "刚刚";
                }
            }
        }
        elseif($times>24){
            $time2 = floor($times/24);
            $value['times'] = $time2."天前";
        }
      }

    }else if($type == 'shoushukuaiyue' || $type == 'tijianjiedu'){
      $list = pdo_fetchall("select a.time,u.u_name,u.u_thumb from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid where a.uniacid=".$uniacid." and a.time>=".$month." and a.keywords='".$type."' group by a.back_orser");
      foreach($list as &$value)
      {
        $value['time'] = date("Y-m-d H:i:s",$value['time']);
        $time = strtotime(date("Y-m-d H:i:s",time()));
        $timess = strtotime($value['time']);
        $times = floor(($time-$timess)/3600);
        if ($times<=24) {
            $time1 = floor(($time-$timess)/60);
            if ($time1>60) {
                $time1s = floor($time1/60);
                $time1ss = $time1-$time1s*60;
                $value['time'] = $time1s."小时前";
            }else{
                if ($time1>0) {
                    $value['time'] = $time1."分钟前";
                }else{
                    $value['time'] = "刚刚";
                }
            }
        }
        elseif($times>24){
            $time2 = floor($times/24);
            $value['time'] = $time2."天前";
        }
      }
    }else if($type == 'tuwenwenzhen'){
      $list = pdo_fetchall("select a.xdtime,u.u_name,u.u_thumb from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid where a.uniacid=".$uniacid." and a.xdtime>=".$month." and a.keywords='".$type."' group by a.back_orser");
      foreach($list as &$value)
      {
        $value['xdtime'] = date("Y-m-d H:i:s",$value['xdtime']);
        $time = strtotime(date("Y-m-d H:i:s",time()));
        $timess = strtotime($value['xdtime']);
        $times = floor(($time-$timess)/3600);
        if ($times<=24) {
            $time1 = floor(($time-$timess)/60);
            if ($time1>60) {
                $time1s = floor($time1/60);
                $time1ss = $time1-$time1s*60;
                $value['times'] = $time1s."小时前";
            }else{
                if ($time1>0) {
                    $value['times'] = $time1."分钟前";
                }else{
                    $value['times'] = "刚刚";
                }
            }
        }
        elseif($times>24){
            $time2 = floor($times/24);
            $value['times'] = $time2."天前";
        }
      }

    }else if($type == 'yuanchengguahao')
    {
      $list = pdo_fetchall("select a.time,u.u_name,u.u_thumb from ".tablename("hyb_yl_guahaoorder")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid where a.uniacid=".$uniacid." and a.time >=".$month." group by a.back_orser");
      foreach($list as &$value)
      {
        $value['time'] = date("Y-m-d H:i:s",$value['time']);
        $time = strtotime(date("Y-m-d H:i:s",time()));
        $timess = strtotime($value['time']);
        $times = floor(($time-$timess)/3600);
        if ($times<=24) {
            $time1 = floor(($time-$timess)/60);
            if ($time1>60) {
                $time1s = floor($time1/60);
                $time1ss = $time1-$time1s*60;
                $value['time'] = $time1s."小时前";
            }else{
                if ($time1>0) {
                    $value['time'] = $time1."分钟前";
                }else{
                    $value['time'] = "刚刚";
                }
            }
        }
        elseif($times>24){
            $time2 = floor($times/24);
            $value['time'] = $time2."天前";
        }
      }
    }else if($type == 'yuyuejiuzhen' || $type == 'zhuyuananpai' || $type == 'shoushuanpai' || $type == 'baogaojiaji')
    {
      $list = pdo_fetchall("select a.created,u.u_name,u.u_thumb from ".tablename("hyb_yl_guidance_order")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid where a.uniacid=".$uniacid." and a.created>=".$month);

      if(count($list) > 0 && !empty($list))
      {
        foreach($list as &$value)
        {
          $value['time'] = date("Y-m-d H:i:s",$value['created']);
          $time = strtotime(date("Y-m-d H:i:s",time()));
        $timess = strtotime($value['time']);
        $times = floor(($time-$timess)/3600);
        if ($times<=24) {
            $time1 = floor(($time-$timess)/60);
            if ($time1>60) {
                $time1s = floor($time1/60);
                $time1ss = $time1-$time1s*60;
                $value['time'] = $time1s."小时前";
            }else{
                if ($time1>0) {
                    $value['time'] = $time1."分钟前";
                }else{
                    $value['time'] = "刚刚";
                }
            }
        }
        elseif($times>24){
            $time2 = floor($times/24);
            $value['time'] = $time2."天前";
        }
        }
      }else{
        $list = array();
      }
      
    }else if($type == 'goods')
    {
      $list = pdo_fetchall("select a.createTime,a.sid,u.u_name,u.u_thumb from ".tablename("hyb_yl_goodsorders")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid where a.uniacid=".$uniacid." and a.createTime>='".$months."'");
      
      if(count($list) > 0 && !empty($list))
      {
        foreach($list as &$value)
        {
          $value['sid'] = unserialize($value['sid']);
          $value['goods'] = "";
          foreach($value['sid'] as $sids)
          {
              $value['goods'] .= $sids['sname'].",";
          }
          $value['time'] = $value['createTime'];
          $time = strtotime(date("Y-m-d H:i:s",time()));
        $timess = strtotime($value['time']);
        $times = floor(($time-$timess)/3600);
        if ($times<=24) {
            $time1 = floor(($time-$timess)/60);
            if ($time1>60) {
                $time1s = floor($time1/60);
                $time1ss = $time1-$time1s*60;
                $value['time'] = $time1s."小时前";
            }else{
                if ($time1>0) {
                    $value['time'] = $time1."分钟前";
                }else{
                    $value['time'] = "刚刚";
                }
            }
        }
        elseif($times>24){
            $time2 = floor($times/24);
            $value['time'] = $time2."天前";
        }
        }
      }else{
        $list = array();
      }
    }else if($type == 'tuike')
    {
      $list = pdo_fetchall("select a.addtime,a.username,u.u_name,u.u_thumb from ".tablename("hyb_yl_tuikesite")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid where a.uniacid=".$uniacid." and a.addtime>='".$months."'");

      if(count($list) > 0 && !empty($list))
      {
        foreach($list as &$value)
        {
          $time = strtotime(date("Y-m-d H:i:s",time()));
        $timess = strtotime($value['addtime']);
        $times = floor(($time-$timess)/3600);
        if ($times<=24) {
            $time1 = floor(($time-$timess)/60);
            if ($time1>60) {
                $time1s = floor($time1/60);
                $time1ss = $time1-$time1s*60;
                $value['time'] = $time1s."小时前";
            }else{
                if ($time1>0) {
                    $value['time'] = $time1."分钟前";
                }else{
                    $value['time'] = "刚刚";
                }
            }
        }
        elseif($times>24){
            $time2 = floor($times/24);
            $value['time'] = $time2."天前";
        }
        }
      }else{
        $list = array();
      }
    }else if($type == 'hospital')
    {
      $list = pdo_fetchall("select * from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and state=1 and zctime>=".$month);

      if(count($list) > 0 && !empty($list))
      {
        foreach($list as &$value)
        {
          if($value['groupid'] == '1')
          {
            $value['type'] = '医院';
          }else if($value['groupid'] == '2')
          {
            $value['type'] = '药房';
          }else if($value['groupid'] == '3')
          {
            $value['type'] = '体检机构';
          }else if($value['groupid'] == '4')
          {
            $value['type'] = '诊所';
          }
          $value['logo'] = tomedia($value['logo']);
          $time = strtotime(date("Y-m-d H:i:s",time()));
        $timess = $value['zctime'];
        $times = floor(($time-$timess)/3600);
        if ($times<=24) {
            $time1 = floor(($time-$timess)/60);
            if ($time1>60) {
                $time1s = floor($time1/60);
                $time1ss = $time1-$time1s*60;
                $value['time'] = $time1s."小时前";
            }else{
                if ($time1>0) {
                    $value['time'] = $time1."分钟前";
                }else{
                    $value['time'] = "刚刚";
                }
            }
        }
        elseif($times>24){
            $time2 = floor($times/24);
            $value['time'] = $time2."天前";
        }
        }
      }else{
        $list = array();
      }

    }
    echo json_encode($list);
    
  }

  public function search_set()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_search_set")." where uniacid=".$uniacid." and status=1 order by id desc");
    foreach($list as &$value)
    {
      $value['thumb'] = tomedia($value['thumb']);
    }
    $search_title = pdo_getcolumn("hyb_yl_base",array("uniacid"=>$uniacid),'search_title');
    $data['search_title'] = $search_title;
    $data['list'] = $list;
    echo json_encode($data);
  }
  // 根据条形码号获取商品id
  public function goods_ids()
  {
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $code_num = $_GPC['code_num'];
    $code_nums = substr($code_num,0,strlen($code_num)-1);
    
    $sid = pdo_getcolumn("hyb_yl_goodsarr",array("uniacid"=>$uniacid,"code_num"=>$code_nums),'sid');
    echo json_encode($sid);
  }

  // 云音响播放
  public function box_send()
  {
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $parameter = pdo_get("hyb_yl_parameter",array("uniacid"=>$uniacid));
    $uid = pdo_getcolumn("hyb_yl_boxuser",array("uniacid"=>$uniacid),'uid');
    $sn = $parameter['box_sn'];
    $m = 1;
    $token = $parameter['box_token'];
    $version = $parameter['box_version'];
    $getArr = array();

    $url = "https://speaker.17laimai.cn/notify.php?id=".$sn."&token=".$token."&version=".$version."&message=小测试&speed=50";
     
     $tokenArr = json_decode($this->send_post($url, $getArr, "GET"),true);
     
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
   public function http_curl($url,$type,$res,$arr){
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

  // 查看用户绑定设备
  public function user_equipment()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $page = $_GPC['page'];
    $pages = $page * 10;
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_user_equipment")." where uniacid=".$uniacid." and openid='".$openid."' order by id desc limit ".$pages.",10");
    foreach($list as &$value)
    {
      $value['thumb'] = tomedia($value['thumb']);
    }
    echo json_encode($list);
  }
  // 查询用户单个设备
  public function equipment_detail()
  {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $type = $_GPC['type'];
      $item = pdo_get("hyb_yl_user_equipment",array("uniacid"=>$uniacid,"openid"=>$openid,"type"=>$type));
      echo json_encode($item);
  }
  // 用户绑定设备
  public function binding()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $sn = $_GPC['sn'];
    $type = $_GPC['type'];
    $is_bangding = pdo_getall("hyb_yl_user_equipment",array("uniacid"=>$uniacid,"sn"=>$sn));
    if(count($is_bangding) == 2)
    {
      $data = array(
        'code' => '1',
        "message" => '该设备两个使用者已被其他用户绑定',
      );
      echo json_encode($data);
      exit();
    }else{
      if(count($is_bangding) == 1)
      {
        if($is_bangding[0]['user'] = 2)
        {
          $user = 1;
        }else{
          $user = 2;
        }
      }else{
        $user = 1;
      }
      $datas = array(
        'uniacid' => $uniacid,
        "openid" => $openid,
        "title" => '爱奥尔（血压计）',
        "sn" => $sn,
        "created" => time(),
        "thumb" => '',
        "type" => '0',
        "user" => $user,
      );
      pdo_insert("hyb_yl_user_equipment",$datas);
      $data = array(
        'code' => '0',
        "message" => '绑定成功',
      );
      echo json_encode($data);
      exit();
    }
  }

  // 用户解绑设备
  public function unbundling()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $openid = $_GPC['openid'];
    $res = pdo_delete("hyb_yl_user_equipment",array("uniacid"=>$uniacid,"id"=>$id));
    if($res)
    {
      $data = array(
        'code' => '0',
        'message' => '解绑成功',
      );
    }else{
      $data = array(
        'code' => '1',
        'message' => '解绑失败',
      );
    }
    echo json_encode($data);
    exit();
  }

  // 测量血压
  public function check_pressure()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $data = htmlspecialchars(trim($_GPC['data']));
    $high_pressure = substr($data,20,3);
    $low_pressure = substr($data,23,3);
    $heart_rate = substr($data,26,3);
    $sn = substr($data,11,9);
    $user = substr($data,4,1);
    $user_equipment = pdo_get("hyb_yl_user_equipment",array("uniacid"=>$uniacid,"sn"=>$sn,"user"=>$user));
    $userjiaren = pdo_get("hyb_yl_userjiaren",array("uniacid"=>$uniacid,"j_id"=>$user_equipment['j_id']));
    $sex = $userjiaren['sex'];
    $age = $userjiaren['age'];
    $blood_pressure = pdo_fetch("select * from ".tablename("hyb_yl_blood_pressure")." where uniacid=".$uniacid." and sex='".$sex."' and min_age <= ".$age." and max_age >=".$age);
    
    if($high_pressure < $blood_pressure['high_range_down'] || $low_pressure < $blood_pressure['low_range_down'])
    {
      $type = '1';
      $content = $blood_pressure['proposal_low'];
    }else if($low_pressure > $blood_pressure['low_range_up'] || $high_pressure > $blood_pressure['high_range_up'])
    {
      $type = '2';
      $content = $blood_pressure['proposal_high'];
    }else{
      $type = '0';
      $content = $blood_pressure['proposal_normal'];
    }
    $data = array(
      'uniacid' => $uniacid,
      "openid" => $user_equipment['openid'],
      "j_id" => $user_equipment['j_id'],
      "high_pressure" => $high_pressure,
      "low_pressure" => $low_pressure,
      // "score" => $data,
      "type" => $type,
      "heart_rate" => $heart_rate,
      "created" => time(),
      "content" => $content,
    );
    pdo_insert("hyb_yl_user_blood_pressure",$data);
  }
  function Ord_Verify($str = ''){
    $str = trim($str);
    if(empty($str)){
        return '10001';
    }
    $SUMDEC = 0;
    $Verify = '';
    for ($i=0; $i < 43; $i++) {
        if($i < 39){
            $SUMDEC += ord($str[$i]);
        }else{
            $Verify .= $str[$i];
        }
    }
    $SUMDEC = strtoupper(dechex($SUMDEC));
    if(empty($SUMDEC)){
        return '10002';
    }
    if(strlen($SUMDEC) < 4){
        if(strlen($SUMDEC) == 3){
            $SUMDEC = '0'.$SUMDEC;
        }elseif(strlen($SUMDEC) == 2){
            $SUMDEC = '00'.$SUMDEC;
        }else{
            $SUMDEC = '000'.$SUMDEC;
        }
    }
    if($SUMDEC == $Verify){
        return '200';
    }else{
        return '10003';
    }
}
  // 查询用户血压测试记录
  public function user_pressure()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $j_id = $_GPC['j_id'];
    $page = $_GPC['page'];
    $pages = $page * 10;
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_user_blood_pressure")." where uniacid=".$uniacid." and openid='".$openid."' and j_id=".$j_id." order by id desc limit ".$pages.",10");
    echo json_encode($list);
  }

  // 用户测量血糖
  public function check_sugar()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    
    $sn = $_GPC['sn'];
    $data = htmlspecialchars(trim($_GPC['data']));
    $sugar_value = round(intval(substr($bloodsugar,26,3),10)/18,1);
    $sn = substr($data,11,9);
    $user_equipment = pdo_get("hyb_yl_user_equipment",array("uniacid"=>$uniacid,"sn"=>$sn));
    $userjiaren = pdo_get("hyb_yl_userjiaren",array("uniacid"=>$uniacid,"j_id"=>$user_equipment['j_id']));
    $sex = $userjiaren['sex'];
    $age = $userjiaren['age'];

    $blood_sugar = pdo_fetch("select * from ".tablename("hyb_yl_blood_sugar")." where uniacid=".$uniacid." and sex='".$sex."' and min_age <= ".$age." and max_age >=".$age);
    $sugar_value = "";
    if($sugar_value < $blood_sugar['high_range_down'])
    {
      $type = '1';
      $content = $blood_sugar['proposal_low'];
    }else if($sugar_value > $blood_sugar['high_range_up'])
    {
      $type = '2';
      $content = $blood_sugar['proposal_high'];
    }else{
      $type = '0';
      $content = $blood_sugar['proposal_normal'];
    }
    $data = array(
      'uniacid' => $uniacid,
      "openid" => $user_equipment['openid'],
      "j_id" => $user_equipment['j_id'],
      "sugar_value" => $sugar_value,
      "type" => $type,
      "score" => $data,
      "content" => $content,
      "created" => time(),
    );
    pdo_insert("hyb_yl_user_blood_sugar",$data);

  }

  // 查询用户血糖测试记录
  public function user_sugar()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $j_id = $_GPC['j_id'];
    $page = $_GPC['page'];
    $pages = $page * 10;
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_user_blood_sugar")." where uniacid=".$uniacid." and openid='".$openid."' and j_id=".$j_id." order by id desc limit ".$pages.",10");
    echo json_encode($list);
  }


}


