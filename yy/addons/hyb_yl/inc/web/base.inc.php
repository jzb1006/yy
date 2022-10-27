<?php 
// error_reporting(E_ALL);
	global $_W,$_GPC;
  $_W['plugin'] ='setting';
  $selclass ='selclass';
  $op = isset($_GPC['op'])?$_GPC['op']:'basesite';
  $uniacid =$_W['uniacid'];
  // $type_id = $_GPC['type_id'];
  $res = pdo_get('hyb_yl_base',array('uniacid'=>$uniacid));
  $res['show_thumb'] = unserialize($res['show_thumb']);
  $res['advertisement'] = unserialize($res['advertisement']);
  $res['back_zjthumb']  = unserialize($res['back_zjthumb']);
  $res['tj_thumb']      = unserialize($res['tj_thumb']);
  $res['goodslunb']     = unserialize($res['goodslunb']);
	if($op=='basesite'){
    if($_W['ispost']){
     $data =array(
          'uniacid'    => $_W['uniacid'],
          'show_title' => $_GPC['show_title'],
          'show_thumb' => serialize($_GPC['show_thumb']),
          'baidukey'   => $_GPC['baidukey'],
          'advertisement' => serialize($_GPC['advertisement']),
          'back_zjthumb'  => serialize($_GPC['back_zjthumb']),
           'goodslunb'  => serialize($_GPC['goodslunb']),
          'tj_thumb'  => serialize($_GPC['tj_thumb']),
          'ztcolor'   => $_GPC['ztcolor'],
          'state'     => $_GPC['state'],
          "content" => $_GPC['content'],
          "is_search" => $_GPC['is_search'],
          'bq_thumb' => $_GPC['bq_thumb'],
          'yy_thumb' => $_GPC['yy_thumb'],
          'slide'    => $_GPC['slide'],
          "is_hospital" => $_GPC['is_hospital'],
          "search_title" => $_GPC['search_title'],
          'USER'    => $_GPC['USER'],
          "UKEY" => $_GPC['UKEY'],
          "SN" => $_GPC['SN'],
          
      );
        if(!empty($res['id'])){
            pdo_update('hyb_yl_base',$data,array('id'=>$res['id']));
  
        }else{
            pdo_insert('hyb_yl_base',$data);
            
        }
        message("操作成功!",$this->createWebUrl("base",array("op"=>"basesite",'ac'=>'base')),"success");
    }
    include $this->template('base/basic-setting');
	}
   if($op=='pianshen'){
   if($_W['ispost']){
        $data =array(
           'uniacid'    => $_W['uniacid'],
           'pstatus'    => $_GPC['pstatus'],
           'slide'      => serialize($_GPC['slide']),
          );

        if(!empty($res['id'])){
            pdo_update('hyb_yl_base',$data,array('id'=>$res['id']));
            message('成功', 'refresh', 'success');
        }else{
            pdo_insert('hyb_yl_base',$data);
            message('成功', 'refresh', 'success');
        }
   }
    include $this->template('base/pianshen');
  }
   if($op=='hospital'){
   if($_W['ispost']){
        $data =array(
           'uniacid'    => $_W['uniacid'],
           'yy_thumb'   => $_GPC['yy_thumb'],
           'yy_title'   => $_GPC['yy_title'],
           'lntroduction'   => $_GPC['lntroduction'],
           'longitude'   => $_GPC['log']['lng'],
           'latitude'    => $_GPC['log']['lat'],
           'yy_address'  => $_GPC['yy_address'],
           'yy_telphone' => $_GPC['yy_telphone'],
           'yy_title'    => $_GPC['yy_title'],
           'bq_name'     => $_GPC['bq_name'],
           'bq_thumb'    => $_GPC['bq_thumb'],
           'bq_telphone' => $_GPC['bq_telphone'],
           'grade'       => $_GPC['grade']

          );
        if(!empty($res['id'])){
            pdo_update('hyb_yl_base',$data,array('id'=>$res['id']));
            message('成功', 'refresh', 'success');
        }else{
            pdo_insert('hyb_yl_base',$data);
            message('成功', 'refresh', 'success');
        }
   }
  	include $this->template('base/hospital');
  }
     if($op=='servesite'){
     if($_W['ispost']){
          $data =array(
             'uniacid'    => $_W['uniacid'],
             'fwsite'     => $_GPC['fwsite'],
            );
          if(!empty($res['id'])){
              pdo_update('hyb_yl_base',$data,array('id'=>$res['id']));
              message('成功', 'refresh', 'success');
          }else{
              pdo_insert('hyb_yl_base',$data);
              message('成功', 'refresh', 'success');
          }
        }
    include $this->template('base/site');
  }
     if($op=='tixian'){
      if($_W['ispost']){
          $data =array(
             'uniacid'    => $_W['uniacid'],
             'txxz'       => $_GPC['txxz'],
             'zdtx'       => $_GPC['zdtx'],
             'txsx'       => $_GPC['txsx'],
            );
          if(!empty($res['id'])){
              pdo_update('hyb_yl_base',$data,array('id'=>$res['id']));
              message('成功', 'refresh', 'success');
          }else{
              pdo_insert('hyb_yl_base',$data);
              message('成功', 'refresh', 'success');
          }
        }
    include $this->template('base/tixian');
  }
  //充值设置
  if($op=='czsite'){
    $item = pdo_get("hyb_yl_recharge",array("uniacid"=>$uniacid));

    if($item)
    {
      $item['content'] = unserialize($item['content']);
    }
    if($_W['ispost']){

      $data = array(
        'status' => $_GPC['status'],
        "content" => serialize($_GPC['recharge']),
        "uniacid" => $_W['uniacid'],
      );

      if($item)
      {
        pdo_update("hyb_yl_recharge",$data,array("uniacid"=>$uniacid));
      }else{
        $data['created'] = time();
        pdo_insert("hyb_yl_recharge",$data);
      }
      message('成功', 'refresh', 'success');
    }
  include $this->template('base/czsite');
  }
  //积分设置
  if($op=='jfsite'){
    $item = pdo_get("hyb_yl_integral_set",array("uniacid"=>$uniacid));
    if($_W['ispost'])
    {
      $data = array(
          'uniacid' => $uniacid,
          'evaluate_score' => $_GPC['evaluate_score'],
          'status' => $_GPC['status'],
          "proportion" => $_GPC['proportion'],

      );
      if($item)
      {
        pdo_update("hyb_yl_integral_set",$data,array("uniacid"=>$uniacid));
      }else{
        $data['created'] = time();
        pdo_insert("hyb_yl_integral_set",$data);
      }
      message('成功', 'refresh', 'success');
    }
  include $this->template('base/jfsite');
  }
  //文字设置
  if($op=='wjsite'){
  include $this->template('base/wjsite');
  }
  //入驻设置
  if($op=='rzsite'){
  include $this->template('base/rzsite');
  }
  //支付设置
  if($op=='zfsite'){
    load()->func('file'); //调用上传函数
    $dir_url=$_SERVER['DOCUMENT_ROOT'].'/web/cert/hyb_yl/'; //上传路径
    mkdirs($dir_url); 
    //创建目录
    if ($_FILES["upfile"]["name"]){
      $upfile=$_FILES["upfile"]; 
    //获取数组里面的值 
    $name=$upfile["name"];//上传文件的文件名 
    $size=$upfile["size"];//上传文件的大小 
    if($size>2*1024*1024) {  

      message("文件过大，不能上传大于2M的文件!",$this->createWebUrl("pay",array("op"=>"display")),"success"); 
      exit();  
    } 
    if(file_exists($dir_url))@unlink ($dir_url);

    $cfg['upfile']=TIMESTAMP.".pem";
    move_uploaded_file($_FILES["upfile"]["tmp_name"],$dir_url.$upfile["name"]); //移动到目录下
    $upfiles = $dir_url.$name;
    
  }
  if ($_FILES["keypem"]["name"]){
      $upfile=$_FILES["keypem"]; 
      //获取数组里面的值 
      $name=$upfile["name"];//上传文件的文件名 
      //$type=$upfile["type"];//上传文件的类型 
      $size=$upfile["size"];//上传文件的大小 
      if($size>2*1024*1024) {  
        message("文件过大，不能上传大于2M的文件!",$this->createWebUrl("pay",array("op"=>"display")),"success");  
        exit();  
      }   
      if(file_exists($dir_url))@unlink ($dir_url);
      move_uploaded_file($_FILES["keypem"]["tmp_name"],$dir_url.$upfile["name"]); //移动到目录下
      $keypems = $dir_url.$name;

    }
  $res = pdo_get("hyb_yl_parameter",array('uniacid'=>$uniacid));
  $p_id = $_GPC['p_id'];
  if($_W['ispost']){

      $data = array(
            'uniacid' => $_W['uniacid'],
            'mch_id'  => $_GPC['mch_id'],
            'pub_api' => $_GPC['pub_api'],
            'pub_appid' => $_GPC['pub_appid'],
            'upfile'   =>$upfiles,
            'keypem'   =>$keypems,
        );
      if(!empty($p_id)){
        pdo_update('hyb_yl_parameter',$data,array('p_id'=>$p_id));
        message("修改成功!",$this->createWebUrl("base",array('op'=>'zfsite','ac'=>'zfsite')),"success");
     }else{
        pdo_insert('hyb_yl_parameter',$data);
        message("添加成功!",$this->createWebUrl("base",array('op'=>'zfsite','ac'=>'zfsite')),"success");
     }
  }

  include $this->template('base/zfsite');
  }
  //短信消息
  if($op=='dxmsg'){

  include $this->template('base/dxmsg');
  }
 //短信消息添加
  if($op=='dxmsgadd'){
  include $this->template('base/dxmsgadd');
  }
  //参数设置
  if($op=='dxsys'){
    $res = pdo_get("hyb_yl_duanxin",array('uniacid'=>$uniacid));
    $moban_id = unserialize($res['moban_id']);
    $id = $_GPC['id'];
    $mobel =serialize($_GPC['mobel']);
    if($_W['ispost']){

        $data = array(
              'uniacid' => $_W['uniacid'],
              'key'     => $_GPC['key'],
              'scret'   => $_GPC['scret'],
              'qianming'=> $_GPC['qianming'],
              'tel'=> $_GPC['tel'],
              'templateid'=> $_GPC['templateid'],
              'moban_id'=>$mobel
          );
        if(!empty($id)){
          pdo_update('hyb_yl_duanxin',$data,array('id'=>$id));
          message("修改成功!",$this->createWebUrl("base",array('op'=>'dxsys','ac'=>'dxsys')),"success");
       }else{
          pdo_insert('hyb_yl_duanxin',$data);
          message("添加成功!",$this->createWebUrl("base",array('op'=>'dxsys','ac'=>'dxsys')),"success");
       }
    }
  include $this->template('base/dxsys');
  }
  //接口设置
  if($op=='jiekou'){
  $res = pdo_get("hyb_yl_parameter",array('uniacid'=>$uniacid));
  //查询所有物流
  $row = pdo_fetchall("select * from".tablename('hyb_yl_kuaidi')."where uniacid='{$uniacid}'");
  $p_id = $res['p_id'];

  $data =array(
     'uniacid'   =>$uniacid,
     'baidu_key' =>$_GPC['baidu_key'],
     'city_state'=>$_GPC['city_state'],
     'qie_city'  =>$_GPC['qie_city'],
     'appid'     =>$_GPC['appid'],
     'appsecret' =>$_GPC['appsecret'],
     'tencent_sdkappid'=>$_GPC['tencent_sdkappid'],
     'tencent_key'=>$_GPC['tencent_key'],
     'huaw_appid' =>$_GPC['huaw_appid'],
     'huaw_key'   =>$_GPC['huaw_key'],
     'wuliu_appid'=>$_GPC['wuliu_appid'],
     'wuliu_key'  =>$_GPC['wuliu_key'],
     'wuliu_state'=>$_GPC['wuliu_state'],
     'areaCode'   =>$_GPC['areaCode'],
     'wlid'       =>$_GPC['wlid'],
     'box_sn'=>$_GPC['box_sn'],
     'box_token'   =>$_GPC['box_token'],
     'box_version'       =>$_GPC['box_version'],
    );
  if($_W['ispost']){

      if(empty($p_id)){
        pdo_insert('hyb_yl_parameter',$data);
        message('成功', 'refresh', 'success');
      }else{
        pdo_update('hyb_yl_parameter',$data,array('p_id'=>$p_id));
        message('成功', 'refresh', 'success');
      }
  }
  
  include $this->template('base/jiekou');
  }
  //订阅消息
  if($op=='dymsg'){
    $res = pdo_get("hyb_yl_parameter",array('uniacid'=>$uniacid));
    $wxapp_mb = unserialize($res['wxapp_mb']);
    $p_id  =$_GPC['p_id'];
    if($_W['ispost']){
      $notice = $_GPC['notice'];
      $data = array(
         'wxapp_mb' => serialize($notice)
        );
      if(empty($p_id)){
         pdo_insert('hyb_yl_parameter',$data);
         message("添加成功!",$this->createWebUrl("base",array('op'=>'dymsg','ac'=>'dymsg')),"success");
      }else{
         pdo_update('hyb_yl_parameter',$data,array('p_id'=>$p_id));
         message("修改成功!",$this->createWebUrl("base",array('op'=>'dymsg','ac'=>'dymsg')),"success");
      }
    }
    include $this->template('base/dymsg');
  }
  if($op=='dxmsgadd'){
  include $this->template('base/dxmsgadd');
  }
  //小程序路径
  if($op=='scxsite'){
  include $this->template('base/scxsite');
  }
  //骗审设置
  if($op=='psimg'){
  include $this->template('base/psimg');
  }
  //定时
 if($op=='dingshi'){
  $url = $_W['siteroot'];
  include $this->template('base/dingshi');
  }
  // 搜索设置
  if($op == 'search')
  {
    $list = pdo_getall("hyb_yl_search_set",array("uniacid"=>$uniacid));

    include $this->template("base/search");
  }

  // 添加搜索设置
  if($op == 'add_search')
  {
    $id = $_GPC['id'];

    $item = pdo_get("hyb_yl_search_set",array("uniacid"=>$uniacid,"id"=>$id));
    if($_W['ispost'])
    {
      $is_has = pdo_get("hyb_yl_search_set",array("keyword"=>$_GPC['keyword']));
      if($is_has)
      {
        message("该条件已添加，请重新选择!",$this->createWebUrl("base",array('op'=>'search','ac'=>'search')),"success");
      }
      $data = array(
          'uniacid' => $uniacid,
          "title" => $_GPC['title'],
          "thumb" => $_GPC['thumb'],
          "status" => $_GPC['status'],
          "keyword" => $_GPC['keyword'],
          "sort" => $_GPC['sort']
      );
      if($id)
      {
        $res = pdo_update("hyb_yl_search_set",$data,array("id"=>$id));
      }else{
        $data['created'] = time();
        $res = pdo_insert("hyb_yl_search_set",$data);
      }
      if($res)
      {
        message("操作成功!",$this->createWebUrl("base",array('op'=>'search','ac'=>'search')),"success");
      }else{
        message("操作失败!",$this->createWebUrl("base",array('op'=>'search','ac'=>'search')),"success");
      }
    }
    include $this->template("base/add_search");
  }
  if($op == 'del_search')
  {
    $id = $_GPC['id'];
    $res = pdo_delete("hyb_yl_search_set",array("id"=>$id));
    if($res)
    {
      message("删除成功!",$this->createWebUrl("base",array("op"=>"search")),"success");
    }else{
      message("删除失败!",$this->createWebUrl("base",array("op"=>"search")),"error");
    }
    include $this->template("base/search");
  }
  if($op == 'kanban')
  {
    $zhuanjia_count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid);
    $user_count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_userinfo")." where uniacid=".$uniacid);
    $hos_count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid);
    $tuike_count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tuikesite")." where uniacid=".$uniacid);
    $green_count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guidance")." where uniacid=".$uniacid);
    $month = date("Y-m-d",strtotime("-1 months",time()));
    $months = strtotime($month);
    // 机构点位分部统计
    $month_hos = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and zctime >='".$months."'");
    // 全国用户总量统计
    
    $month_user = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_userinfo")." where uniacid=".$uniacid." and zctime >='".$month."'");

    // 推客数据统计
    
    $month_tuike = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tuikesite")." where uniacid=".$uniacid." and addtime>='".$month."'");

    $goods = pdo_fetchall("select sid from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and (orderStatus=0 or orderStatus=1 or orderStatus=2)");
    $good_arr = array();
    foreach($goods as $kk => $value)
    {
      $goods[$kk]['sid'] = unserialize($goods[$kk]['sid']);
      foreach($goods[$kk]['sid'] as &$vv)
      {
        array_push($good_arr,$vv);
      }
      

    }
    $sid = array();
    $arr = array();
    foreach($good_arr as $ks => $vs)
    {
      $sid[] = $good_arr[$ks]['sid'];
    }
    $sid = array_unique($sid);
    foreach ($sid as $k=>$v) {
        $num = 0;
        foreach ($good_arr as $kk=>$vv) {

            if ($vv['sid'] == $v) {

                $num += $vv['num'];

                $array[$k]['num'] = $num;
                $array[$k]['sid'] = $v;
                $array[$k]['title'] = $vv['sname'];

            }

        }

    }
    $array = array_values($array);
    $address = pdo_fetchall("select b.userAddress from ".tablename("hyb_yl_goodsorders")." as a left join ".tablename("hyb_yl_user_address")." as b on b.addressId=a.addressId where a.uniacid=".$uniacid." and (a.orderStatus=0 or orderStatus=1 or a.orderStatus=2)");

    $add = array();
    $ress = array();
    foreach($address as $ks => $vs)
    {
      $userAddress = explode("-",$address[$ks]['userAddress']);
      $add[] = $userAddress[0];
    }
    $add = array_unique($add);
    foreach ($add as $k=>$v) {
        $ress[$k]['title'] = $v;
        $ress[$k]['number'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." as a left join ".tablename("hyb_yl_user_address")." as b on b.addressId=a.addressId where a.uniacid=".$uniacid." and (a.orderStatus=0 or orderStatus=1 or a.orderStatus=2) and b.userAddress like '%$v%'");

    }

    $ress = array_values($ress);
    // $add_arr = array();
    // foreach($address as &$add)
    // {
    //   $add['userAddress'] = explode("-",$add['userAddress']);
    //   $adds = $add['userAddress'][0];
    //   if(!in_array($adds,$add_arr))
    //   {
    //     $as = array(
    //       'title' => $adds,
    //     );
    //     array_push($add_arr,$as);
    //   }
    // }

    // foreach($add_arr as $k=>$aa)
    // {
    //   if($add_arr[$k]['title'] == $add_arr[$k+1]['title'])
    //   {
    //     unset($add_arr[$k]);
    //   }
    //   $s = $add_arr[$k+1];
    //   $add_arr[$k+1]['number'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." as a left join ".tablename("hyb_yl_user_address")." as b on b.addressId=a.addressId where a.uniacid=".$uniacid." and (a.orderStatus=0 or orderStatus=1 or a.orderStatus=2) and b.userAddress like '%$s%'");
    //   // echo "<pre>";
    //   // echo "select count(*) from ".tablename("hyb_yl_goodsorders")." as a left join ".tablename("hyb_yl_user_address")." as b on b.addressId=a.addressId where a.uniacid=".$uniacid." and (a.orderStatus=0 or orderStatus=1 or a.orderStatus=2) and b.userAddress like '%$s%'";
    // }
    
    include $this->template("base/kanban");
  }
  if($op == 'goods_orders')
  {
    $time = strtotime("-0 year -1 month -0 day");
    $goods = pdo_fetchall("select sid from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and (orderStatus=0 or orderStatus=1 or orderStatus=2) and createTime>='".$time."'");
    $good_arr = array();
    foreach($goods as $kk => $value)
    {
      $goods[$kk]['sid'] = unserialize($goods[$kk]['sid']);
      foreach($goods[$kk]['sid'] as &$vv)
      {
        array_push($good_arr,$vv);
      }
      

    }
    $sid = array();
    $arr = array();
    foreach($good_arr as $ks => $vs)
    {
      $sid[] = $good_arr[$ks]['sid'];
    }
    $sid = array_unique($sid);
    foreach ($sid as $k=>$v) {
        $num = 0;
        foreach ($good_arr as $kk=>$vv) {

            if ($vv['sid'] == $v) {

                $num += $vv['num'];

                $array[$k]['num'] = $num;
                $array[$k]['sid'] = $v;
                $array[$k]['title'] = $vv['sname'];

            }

        }

    }
    $array = array_values($array);
    echo json_encode($array);
    exit();
  }
  if($op == 'hospital_arr')
  {
    $hospital_arr = pdo_fetchall("select address from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." group by address");
    $hoss_arr = array();
    foreach($hospital_arr as $key => $hos_arr)
    {
      $hospital_arr[$key]['addresses'] = explode("-",$hospital_arr[$key]['address']);
      if($hospital_arr[$key]['address'] != '' && $hospital_arr[$key]['addresses'][1] != '' && $hospital_arr[$key]['addresses'][1] != null)
      {
        
        if($hospital_arr[$key]['addresses'][1] != '' && $hospital_arr[$key]['addresses'][1] != null)
        {
          $hospital_arr[$key]['name'] = $hospital_arr[$key]['addresses'][1];
        }else{
          $hospital_arr[$key]['name'] = '未知';
        }
        
        
        
        $hospital_arr[$key]['value'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and address like '%".$hospital_arr[$key]['address']."%'");
      }else{
        $hospital_arr[$key]['name'] = '未知';
        $hospital_arr[$key]['value'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and address = ''");
      }
      if(!in_array($hospital_arr[$key]['name'],$hoss_arr))
      {
        $hoss_arr[$key]['name'] = $hospital_arr[$key]['name'];
        $hoss_arr[$key]['value'] = $hospital_arr[$key]['value'];
      }
      
    }
    $hoss_arr = array_values(array_column($hoss_arr, NULL, 'name')); ;
    
    
    echo json_encode($hoss_arr);
    exit();
  }
  if($op == 'user_arr')
  {
    $user_arr = pdo_fetchall("select region from ".tablename("hyb_yl_userjiaren")." where uniacid=".$uniacid." group by region");
    foreach($user_arr as &$u_arr)
    {
      if($u_arr['region'] != '')
      {
        $u_arr['regions'] = explode(",",$u_arr['region']);
      
        if($u_arr['regions'][2] != '')
        {
          $u_arr['name'] = $u_arr['regions'][2];
        }elseif($u_arr['regions'][1] != '')
        {
          $u_arr['name'] = $u_arr['regions'][1];
        }elseif($u_arr['regions'][0] != '')
        {
          $u_arr['name'] = $u_arr['regions'][0];
        }
      }else{
        $u_arr['name'] = '未知';
      }
      $u_arr['value'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_userjiaren")." where uniacid=".$uniacid." and region = '".$u_arr['region']."'");
    }
    
    $data['title'] = array_column($user_arr,'name');
    $data['value'] = array_column($user_arr,'value');
    echo json_encode($data);
    exit();
  }
  if($op == 'tuike_arr')
  {
    $tuike_arr = pdo_fetchall("select address from ".tablename("hyb_yl_tuikesite")." where uniacid=".$uniacid." group by address");
    $address = array();
    $value = array();
    foreach($tuike_arr as $key => $tk_arr)
    {
      $tuike_arr[$key]['addresses'] = unserialize($tuike_arr[$key]['address']);
      if($tuike_arr[$key]['address'] != '')
      {
        if($tuike_arr[$key]['addresses'][1] != '')
        {
          $tuike_arr[$key]['name'] = $tuike_arr[$key]['addresses'][1];
        }elseif($tuike_arr[$key]['addresses'][0] != '')
        {
          $tuike_arr[$key]['name'] = $tuike_arr[$key]['addresses'][0];
        }
        $tuike_arr[$key]['addre'] = $tuike_arr[$key]['addresses'][0].$tuike_arr[$key]['addresses'][1];
        $url = "http://api.map.baidu.com/geocoder/v2/?address=".$tuike_arr[$key]['addre']."&output=json&ak=Bsr5iefxHEwQD8iCFTx3GwWOem0ZoSBk";
        if($result=file_get_contents($url))  
        {  
            $arr= explode(',"lat":', substr($result, 40,36));
            $tuike_arr[$key]['lon'] = $arr[0];
            $tuike_arr[$key]['lat'] = $arr[1];
        }

      }else{
        $tuike_arr[$key]['name'] = '未知';
      }
      
      $tuike_arr[$key]['value'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tuikesite")." where uniacid=".$uniacid." and address='".$tuike_arr[$key]['address']."'");
      $address[$key]['title'] = $tuike_arr[$key]['name'];
      $address[$key]['lon'] = $tuike_arr[$key]['lon'];
      $address[$key]['lat'] = $tuike_arr[$key]['lat'];
      $value[$key][0]['name'] = $tuike_arr[$key]['name'];
      $value[$key][1]['name'] = $tuike_arr[$key]['name'];
      $value[$key][1]['value'] = $tuike_arr[$key]['value'];
    }
    
    $add1 = array();
    
    foreach($address as &$val2)
    {
      $add1[$val2['title']][0] = $val2['lon'];
      $add1[$val2['title']][1] = $val2['lat'];  
    }
    
    
    $data = array(
      'address' => $add1,
      "value" => $value
      );

    echo json_encode($data);
    exit();
  }
  if($op == 'orders')
  {
    $type = $_GPC['type'];
    if($type == '1')
    {
      $where = " where a.uniacid=".$uniacid." and a.ifpay=2 and a.ifgb=0 and a.overtime>=".time();
      $wheres = " where a.uniacid=".$uniacid." and a.ispay=2 and a.ifgb=0 and a.overtime>=".time();
    }else if($type == '2')
    {
      $where = " where a.uniacid=".$uniacid." and (a.ifpay=5 or a.ifpay=7)";
      $wheres = " where a.uniacid=".$uniacid." and (a.ispay=5 or a.ispay=7)";
    }
    $wenzhen_order = pdo_fetchall("select a.time,a.keywords,a.back_orser,b.u_name,c.z_name,c.parentid,c.hid,d.agentname from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_userinfo")." as b on a.openid=b.openid left join ".tablename("hyb_yl_zhuanjia")." as c on c.zid=a.zid left join ".tablename("hyb_yl_hospital")." as d on d.hid=c.hid ".$where." group by a.back_orser order by a.id desc limit 0,30");

    foreach($wenzhen_order as &$wz)
    {
      $wz['time'] = date("Ymd",$wz['time']);
      if($wz['keywords'] == 'dianhuajizhen')
      {
        $wz['title'] = '电话问诊';
      }else if($wz['keywords'] == 'tijianjiedu')
      {
        $wz['title'] = '体检解读';
      }else if($wz['keywords'] == 'shoushukuaiyue')
      {
        $wz['title'] = '手术快约';
      }else if($wz['keywords'] == 'shipinwenzhen')
      {
        $wz['title'] = '视频问诊';
      }
      $wz['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("uniacid"=>$uniacid,"id"=>$wz['parentid']),'name');
      $wz['titles'] = $wz['u_name']."发起了与".$wz['agentname']."机构科室(".$wz['keshi'].")".$wz['z_name']."的".$wz['title'];
    }

    $tuwen_order = pdo_fetchall("select a.xdtime,a.back_orser,b.u_name,c.z_name,c.parentid,d.agentname from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_userinfo")." as b on a.openid=b.openid left join ".tablename("hyb_yl_zhuanjia")." as c on c.zid=a.zid left join ".tablename("hyb_yl_hospital")." as d on d.hid=c.hid ".$where." group by a.back_orser order by a.id desc limit 0,30");

    foreach($tuwen_order as &$tw)
    {
      $tw['time'] = date("Ymd",$tw['xdtime']);
      $tw['title'] = '图文问诊';
      $tw['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("uniacid"=>$uniacid,"id"=>$tw['parentid']),'name');
      $tw['titles'] = $tw['u_name']."发起了与".$tw['agentname']."机构科室(".$tw['keshi'].")".$tw['z_name']."的".$tw['title'];
    }

    $chufang_order = pdo_fetchall("select a.paytime,a.back_orser,b.u_name,c.z_name,c.parentid,d.agentname from ".tablename("hyb_yl_chufang")." as a left join ".tablename("hyb_yl_userinfo")." as b on a.useropenid=b.openid left join ".tablename("hyb_yl_zhuanjia")." as c on c.zid=a.zid left join ".tablename("hyb_yl_hospital")." as d on d.hid=c.hid ".$wheres." group by a.back_orser order by a.c_id desc limit 0,30");
    foreach($chufang_order as &$cf)
    {
      $cf['time'] = date("Ymd",$cf['paytime']);
      $cf['title'] = '处方问诊';
      $cf['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("uniacid"=>$uniacid,"id"=>$cf['parentid']),'name');
      $cf['titles'] = $cf['u_name']."发起了与".$cf['agentname']."机构科室(".$cf['keshi'].")".$cf['z_name']."的".$cf['title'];
    }

    $guahao_order = pdo_fetchall("select a.paytime,a.back_orser,b.u_name,c.z_name,c.parentid,d.agentname from ".tablename("hyb_yl_guahaoorder")." as a left join ".tablename("hyb_yl_userinfo")." as b on a.openid=b.openid left join ".tablename("hyb_yl_zhuanjia")." as c on c.zid=a.zid left join ".tablename("hyb_yl_hospital")." as d on d.hid=c.hid ".$where." group by a.back_orser order by a.id desc limit 0,30");
    
    foreach($chufang_order as &$cf)
    {
      $cf['time'] = date("Ymd",$cf['paytime']);
      $cf['title'] = '挂号问诊';
      $cf['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("uniacid"=>$uniacid,"id"=>$cf['parentid']),'name');
      $cf['titles'] = $cf['u_name']."发起了与".$cf['agentname']."机构科室(".$cf['keshi'].")".$cf['z_name']."的".$cf['title'];
    }

    $order = array_merge($wenzhen_order,$tuwen_order,$chufang_order,$chufang_order);
    array_multisort(array_column($order,'time'), SORT_DESC, $order);
    echo json_encode($order);
    exit();

  }
  

  if($op == 'order')
  {
    $type = $_GPC['type'];
    
    $time1 = strtotime("-1 year -0 month -0 day");

    $times1 = date("Y-m-d H:i:s",$time1);
    
    $time2 = strtotime("-0 year -0 month -90 day");

    $times2 = date("Y-m-d H:i:s",$time2);
    
    $time3 = strtotime("-0 year -0 month -30 day");

    $times3 = date("Y-m-d H:i:s",$time3);
    
    $time4 = strtotime(date("Y-m-d",strtotime("-1 day")));

    $times4 = date("Y-m-d H:i:s",$time4);
    
    $where1 = " where uniacid=".$uniacid." and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4 or ifpay=7) and overtime != '0' and paytime >=".$time1;
    $wheres1 = " where uniacid=".$uniacid." and (ispay=1 or ispay=2 or ispay=3 or ispay=4 or ispay=7) and overtime != '0' and paytime >=".$time1;
    $wheress1 = " where uniacid=".$uniacid." and (orderStatus=0 or orderStatus=1 or orderStatus=2) and createTime >='".$times1."'";
    $wenzhen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_wenzorder").$where1." group by back_orser");
    $wz_count = count($wenzhen_order);
    $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_order));
    if(!$wz_money)
    {
      $wz_money = '0.00';
    }
    $tuwen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_twenorder").$where1." group by back_orser");
    $tw_count = count($tuwen_order);
    $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen_order));
    if(!$tw_money)
    {
      $tw_money = '0.00';
    }
    $chufang_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_chufang").$wheres1." group by back_orser");
    $cf_count = count($chufang_order);
    $cf_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
    if(!$cf_money)
    {
      $cf_money = '0.00';
    }
    $guahao_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_guahaoorder").$where1." group by back_orser");
    $gh_count = count($guahao_order);
    $gh_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
    if(!$gh_money)
    {
      $gh_money = '0.00';
    }
    $tijian_order = pdo_fetch("select count(*) as counts,sum(money) as money from ".tablename("hyb_yl_tijianorder").$where1);
    $tj_count = $tijian_order['counts'];
    $tj_money = $tijian_order['money'];
    if(!$tj_money)
    {
      $tj_money = '0.00';
    }
    $goods_order = pdo_fetch("select count(*) as counts,sum(realTotalMoney) as money from ".tablename("hyb_yl_goodsorders").$wheress1);
    $goods_count = $goods_order['counts'];
    $goods_money = $goods_order['money'];
    if(!$goods_money)
    {
      $goods_money = '0.00';
    }
    $guidance_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_guidance_order").$where1." group by back_orser");
    $gre_count = count($guidance_order);
    $gre_money = array_sum(array_map(function($val){return $val['money'];}, $guidance_order));
    if(!$gre_money)
    {
      $gre_money = '0.00';
    }
    
    $data1['orders'] = $wz_count + $tw_count + $cf_count + $gh_count + $tj_count + $goods_count + $gre_count;
    $data1['amount'] = $wz_money + $tw_money + $cf_money + $gh_money + $tj_money + $goods_money + $gre_money;
     
    $where2 = " where uniacid=".$uniacid." and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4 or ifpay=7) and overtime != '0' and paytime >=".$time2;
    $wheres2 = " where uniacid=".$uniacid." and (ispay=1 or ispay=2 or ispay=3 or ispay=4 or ispay=7) and overtime != '0' and paytime >=".$time2;
    $wheress2 = " where uniacid=".$uniacid." and (orderStatus=0 or orderStatus=1 or orderStatus=2) and createTime >='".$times2."'";
    $wenzhen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_wenzorder").$where2." group by back_orser");
    $wz_count = count($wenzhen_order);
    $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_order));
    if(!$wz_money)
    {
      $wz_money = '0.00';
    }
    $tuwen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_twenorder").$where2." group by back_orser");
    $tw_count = count($tuwen_order);
    $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen_order));
    if(!$tw_money)
    {
      $tw_money = '0.00';
    }
    $chufang_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_chufang").$wheres2." group by back_orser");
    $cf_count = count($chufang_order);
    $cf_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
    if(!$cf_money)
    {
      $cf_money = '0.00';
    }
    $guahao_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_guahaoorder").$where2." group by back_orser");
    $gh_count = count($guahao_order);
    $gh_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
    if(!$gh_money)
    {
      $gh_money = '0.00';
    }
    $tijian_order = pdo_fetch("select count(*) as counts,sum(money) as money from ".tablename("hyb_yl_tijianorder").$where2);
    $tj_count = $tijian_order['counts'];
    $tj_money = $tijian_order['money'];
    if(!$tj_money)
    {
      $tj_money = '0.00';
    }
    $goods_order = pdo_fetch("select count(*) as counts,sum(realTotalMoney) as money from ".tablename("hyb_yl_goodsorders").$wheress2);
    $goods_count = $goods_order['counts'];
    $goods_money = $goods_order['money'];
    if(!$goods_money)
    {
      $goods_money = '0.00';
    }
    $guidance_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_guidance_order").$where2." group by back_orser");
    $gre_count = count($guidance_order);
    $gre_money = array_sum(array_map(function($val){return $val['money'];}, $guidance_order));
    if(!$gre_money)
    {
      $gre_money = '0.00';
    }
    
    $data2['orders'] = $wz_count + $tw_count + $cf_count + $gh_count + $tj_count + $goods_count + $gre_count;
    $data2['amount'] = $wz_money + $tw_money + $cf_money + $gh_money + $tj_money + $goods_money + $gre_money;

    $where3 = " where uniacid=".$uniacid." and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4 or ifpay=7) and overtime != '0' and paytime >=".$time3;
    $wheres3 = " where uniacid=".$uniacid." and (ispay=1 or ispay=2 or ispay=3 or ispay=4 or ispay=7) and overtime != '0' and paytime >=".$time3;
    $wheress3 = " where uniacid=".$uniacid." and (orderStatus=0 or orderStatus=1 or orderStatus=2) and createTime >='".$times3."'";
    $wenzhen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_wenzorder").$where3." group by back_orser");
    $wz_count = count($wenzhen_order);
    $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_order));
    if(!$wz_money)
    {
      $wz_money = '0.00';
    }
    $tuwen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_twenorder").$where3." group by back_orser");
    $tw_count = count($tuwen_order);
    $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen_order));
    if(!$tw_money)
    {
      $tw_money = '0.00';
    }
    $chufang_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_chufang").$wheres3." group by back_orser");
    $cf_count = count($chufang_order);
    $cf_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
    if(!$cf_money)
    {
      $cf_money = '0.00';
    }
    $guahao_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_guahaoorder").$where3." group by back_orser");
    $gh_count = count($guahao_order);
    $gh_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
    if(!$gh_money)
    {
      $gh_money = '0.00';
    }
    $tijian_order = pdo_fetch("select count(*) as counts,sum(money) as money from ".tablename("hyb_yl_tijianorder").$where3);
    $tj_count = $tijian_order['counts'];
    $tj_money = $tijian_order['money'];
    if(!$tj_money)
    {
      $tj_money = '0.00';
    }
    $goods_order = pdo_fetch("select count(*) as counts,sum(realTotalMoney) as money from ".tablename("hyb_yl_goodsorders").$wheress3);
    $goods_count = $goods_order['counts'];
    $goods_money = $goods_order['money'];
    if(!$goods_money)
    {
      $goods_money = '0.00';
    }
    $guidance_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_guidance_order").$where3." group by back_orser");
    $gre_count = count($guidance_order);
    $gre_money = array_sum(array_map(function($val){return $val['money'];}, $guidance_order));
    if(!$gre_money)
    {
      $gre_money = '0.00';
    }
    $data3['orders'] = $wz_count + $tw_count + $cf_count + $gh_count + $tj_count + $goods_count + $gre_count;
    $data3['amount'] = $wz_money + $tw_money + $cf_money + $gh_money + $tj_money + $goods_money + $gre_money;

    $where4 = " where uniacid=".$uniacid." and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4 or ifpay=7) and overtime != '0' and paytime >=".$time4;
    $wheres4 = " where uniacid=".$uniacid." and (ispay=1 or ispay=2 or ispay=3 or ispay=4 or ispay=7) and overtime != '0' and paytime >=".$time4;
    $wheress4 = " where uniacid=".$uniacid." and (orderStatus=0 or orderStatus=1 or orderStatus=2) and createTime >='".$times4."'";
    $wenzhen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_wenzorder").$where4." group by back_orser");
    $wz_count = count($wenzhen_order);
    $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_order));
    if(!$wz_money)
    {
      $wz_money = '0.00';
    }
    $tuwen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_twenorder").$where4." group by back_orser");
    $tw_count = count($tuwen_order);
    $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen_order));
    if(!$tw_money)
    {
      $tw_money = '0.00';
    }
    $chufang_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_chufang").$wheres4." group by back_orser");
    $cf_count = count($chufang_order);
    $cf_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
    if(!$cf_money)
    {
      $cf_money = '0.00';
    }
    $guahao_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_guahaoorder").$where4." group by back_orser");
    $gh_count = count($guahao_order);
    $gh_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
    if(!$gh_money)
    {
      $gh_money = '0.00';
    }
    $tijian_order = pdo_fetch("select count(*) as counts,sum(money) as money from ".tablename("hyb_yl_tijianorder").$where4);
    $tj_count = $tijian_order['counts'];
    $tj_money = $tijian_order['money'];
    if(!$tj_money)
    {
      $tj_money = '0.00';
    }
    $goods_order = pdo_fetch("select count(*) as counts,sum(realTotalMoney) as money from ".tablename("hyb_yl_goodsorders").$wheress4);
    $goods_count = $goods_order['counts'];
    $goods_money = $goods_order['money'];
    if(!$goods_money)
    {
      $goods_money = '0.00';
    }
    $guidance_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_guidance_order").$where4." group by back_orser");
    $gre_count = count($guidance_order);
    $gre_money = array_sum(array_map(function($val){return $val['money'];}, $guidance_order));
    if(!$gre_money)
    {
      $gre_money = '0.00';
    }
    $data4['orders'] = $wz_count + $tw_count + $cf_count + $gh_count + $tj_count + $goods_count + $gre_count;
    $data4['amount'] = $wz_money + $tw_money + $cf_money + $gh_money + $tj_money + $goods_money + $gre_money;

    $data = array(
      'data1' => $data1,
      'data2' => $data2,
      'data3' => $data3,
      'data4' => $data4,
    );
    echo json_encode($data);
    exit();
  }
  if($op == 'wenzhen_count')
{

  $time1 = strtotime("-1 year -0 month -0 day");

  $times1 = date("Y-m-d H:i:s",$time1);
  
  $time2 = strtotime("-0 year -0 month -90 day");

  $times2 = date("Y-m-d H:i:s",$time2);
  
  $time3 = strtotime("-0 year -0 month -30 day");

  $times3 = date("Y-m-d H:i:s",$time3);
  
  $time4 = strtotime(date("Y-m-d",strtotime("-1 day")));

  $times4 = date("Y-m-d H:i:s",$time4);

  $where1 = " where uniacid=".$uniacid." and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4 or ifpay=7) and overtime != '0' and paytime >=".$time1;
  $wheres1 = " where uniacid=".$uniacid." and (ispay=1 or ispay=2 or ispay=3 or ispay=4 or ispay=7) and overtime != '0' and paytime >=".$time1;
  
  $wenzhen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_wenzorder").$where1." group by back_orser");
  $wz_count = count($wenzhen_order);
  $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_order));
  if(!$wz_money)
  {
    $wz_money = '0.00';
  }
  $tuwen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_twenorder").$where1." group by back_orser");
  $tw_count = count($tuwen_order);
  $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen_order));
  if(!$tw_money)
  {
    $tw_money = '0.00';
  }
  $chufang_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_chufang").$wheres1." group by back_orser");
  $cf_count = count($chufang_order);
  $cf_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
  if(!$cf_money)
  {
    $cf_money = '0.00';
  }
  $guahao_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_guahaoorder").$where1." group by back_orser");
  $gh_count = count($guahao_order);
  $gh_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
  if(!$gh_money)
  {
    $gh_money = '0.00';
  }
  $data1['orders'] = $wz_count + $tw_count + $cf_count + $gh_count;
  $data1['amount'] = $wz_money + $tw_money + $cf_money + $gh_money;

  $where2 = " where uniacid=".$uniacid." and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4 or ifpay=7) and overtime != '0' and paytime >=".$time2;
  $wheres2 = " where uniacid=".$uniacid." and (ispay=1 or ispay=2 or ispay=3 or ispay=4 or ispay=7) and overtime != '0' and paytime >=".$time2;
  
  $wenzhen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_wenzorder").$where2." group by back_orser");
  $wz_count = count($wenzhen_order);
  $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_order));
  if(!$wz_money)
  {
    $wz_money = '0.00';
  }
  $tuwen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_twenorder").$where2." group by back_orser");
  $tw_count = count($tuwen_order);
  $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen_order));
  if(!$tw_money)
  {
    $tw_money = '0.00';
  }
  $chufang_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_chufang").$wheres2." group by back_orser");
  $cf_count = count($chufang_order);
  $cf_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
  if(!$cf_money)
  {
    $cf_money = '0.00';
  }
  $guahao_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_guahaoorder").$where2." group by back_orser");
  $gh_count = count($guahao_order);
  $gh_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
  if(!$gh_money)
  {
    $gh_money = '0.00';
  }
  $data2['orders'] = $wz_count + $tw_count + $cf_count + $gh_count;
  $data2['amount'] = $wz_money + $tw_money + $cf_money + $gh_money;

  $where3 = " where uniacid=".$uniacid." and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4 or ifpay=7) and overtime != '0' and paytime >=".$time3;
  $wheres3 = " where uniacid=".$uniacid." and (ispay=1 or ispay=2 or ispay=3 or ispay=4 or ispay=7) and overtime != '0' and paytime >=".$time3;
  
  $wenzhen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_wenzorder").$where3." group by back_orser");
  $wz_count = count($wenzhen_order);
  $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_order));
  if(!$wz_money)
  {
    $wz_money = '0.00';
  }
  $tuwen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_twenorder").$where3." group by back_orser");
  $tw_count = count($tuwen_order);
  $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen_order));
  if(!$tw_money)
  {
    $tw_money = '0.00';
  }
  $chufang_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_chufang").$wheres3." group by back_orser");
  $cf_count = count($chufang_order);
  $cf_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
  if(!$cf_money)
  {
    $cf_money = '0.00';
  }
  $guahao_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_guahaoorder").$where3." group by back_orser");
  $gh_count = count($guahao_order);
  $gh_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
  if(!$gh_money)
  {
    $gh_money = '0.00';
  }

  $data3['orders'] = $wz_count + $tw_count + $cf_count + $gh_count;
  $data3['amount'] = $wz_money + $tw_money + $cf_money + $gh_money;

  $where4 = " where uniacid=".$uniacid." and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4 or ifpay=7) and overtime != '0' and paytime >=".$time4;
  $wheres4 = " where uniacid=".$uniacid." and (ispay=1 or ispay=2 or ispay=3 or ispay=4 or ispay=7) and overtime != '0' and paytime >=".$time4;
  
  $wenzhen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_wenzorder").$where4." group by back_orser");
  $wz_count = count($wenzhen_order);
  $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_order));
  if(!$wz_money)
  {
    $wz_money = '0.00';
  }
  $tuwen_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_twenorder").$where4." group by back_orser");
  $tw_count = count($tuwen_order);
  $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen_order));
  if(!$tw_money)
  {
    $tw_money = '0.00';
  }
  $chufang_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_chufang").$wheres4." group by back_orser");
  $cf_count = count($chufang_order);
  $cf_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
  if(!$cf_money)
  {
    $cf_money = '0.00';
  }
  $guahao_order = pdo_fetchall("select count(*),money from ".tablename("hyb_yl_guahaoorder").$where4." group by back_orser");
  $gh_count = count($guahao_order);
  $gh_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
  if(!$gh_money)
  {
    $gh_money = '0.00';
  }

  $data4['orders'] = $wz_count + $tw_count + $cf_count + $gh_count;
  $data4['amount'] = $wz_money + $tw_money + $cf_money + $gh_money;

  $data = array(
    'data1' => $data1,
    'data2' => $data2,
    'data3' => $data3,
    'data4' => $data4,
  );
  echo json_encode($data);
  exit();

}
  if($op == 'orderss')
  {
    $type = $_GPC['type'];
    
      $year = date("Y");
      $months = array();
      $current_month = date('m');
      $month = $_GPC['month'];
      
        $i = 1;
        while ($i <= 12) {
          $months[] = array('data' => $i);
          ++$i;
        }
        foreach ($months as $m) {
          // $lastday = $this->get_last_day($year, $m['data']);
          switch ($m['data']) {
              case 4 :
                $days = 30;
                  break;
              case 6 :
                $days = 30;
                  break;
              case 9 :
                $days = 30;
                  break;
              case 11 :
                  $days = 30;
                  break;
              case 2 :
                  if ($year % 4 == 0) {
                      if ($year % 100 == 0) {
                          $days = $year % 400 == 0 ? 29 : 28;
                      } else {
                          $days = 29;
                      }
                  } else {
                      $days = 28;
                  }
                  break;
              default :
                  $days = 31;
                  break;
          }
          $lastday = $days;
          $params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($year . '-' . $m['data'] . '-01 00:00:00'), ':endtime' => strtotime($year . '-' . $m['data'] . '-' . $lastday . ' 23:59:59'));
          $paramss = array(':uniacid' => $_W['uniacid'], ':starttime' => $year . '-' . $m['data'] . '-01 00:00:00', ':endtime' => $year . '-' . $m['data'] . '-' . $lastday . ' 23:59:59');

          $wz_count = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." uniacid=:uniacid and time >=:starttime and time<=:endtime group by back_orser",$params);
          $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wz_count));
          if(!$wz_money)
          {
            $wz_money = '0.00';
          }
          $tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." uniacid=:uniacid and time >=:starttime and time<=:endtime",$params);
          if(!$tijian)
          {
            $tijian = '0.00';
          }
          $tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." uniacid=:uniacid and xdtime >=:starttime and xdtime<=:endtime group by back_orser",$params);

          $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
          if(!$tw_money)
          {
            $tw_money = '0.00';
          }
          $goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=:uniacid and createTime>=:starttime and createTime<=:endtime",$paramss);
          if(!$goods)
          {
            $goods = '0.00';
          }
          $guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime group by back_orser",$params);
          $gh_money = array_sum(array_map(function($val){return $val['money'];}, $guahao));
          if(!$gh_money)
          {
            $gh_money = '0.00';
          }
          $green_order = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime group by back_orser",$params);
          $green_money = array_sum(array_map(function($val){return $val['money'];}, $green_order));
          if(!$green_money)
          {
            $green_money = '0.00';
          }

          $year_data[] = array(
            'date' => $m['data'] . '月',
            'money' => $wz_money + $tw_money + $goods + $gh_money + $green_money + $tijian,
          );
        }


        $time = time();
        $season = ceil((date('n', $time))/4) +1;

        if($season == '1')
        {
          $i = 1;
          while ($i < 3) {
            $month1[] = array('data' => $i);
            ++$i;
          }
        }else if($season == '2')
        {
          $i = 4;
          while ($i < 7) {
            $month1[] = array('data' => $i);
            ++$i;
          }
        }else if($season == '3')
        {
          $i = 7;
          while ($i < 10) {
            $month1[] = array('data' => $i);
            ++$i;
          }
          
        }else if($season == '4')
        {
          $i = 10;
          while ($i <= 12) {
          $month1[] = array('data' => $i);
          ++$i;
        }
        }
        
        foreach ($month1 as $m) {
          // $lastday = $this->get_last_day($year, $m['data']);
          switch ($m['data']) {
              case 4 :
                $days = 30;
                  break;
              case 6 :
                $days = 30;
                  break;
              case 9 :
                $days = 30;
                  break;
              case 11 :
                  $days = 30;
                  break;
              case 2 :
                  if ($year % 4 == 0) {
                      if ($year % 100 == 0) {
                          $days = $year % 400 == 0 ? 29 : 28;
                      } else {
                          $days = 29;
                      }
                  } else {
                      $days = 28;
                  }
                  break;
              default :
                  $days = 31;
                  break;
          }
          $lastday = $days;
          $params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($year . '-' . $m['data'] . '-01 00:00:00'), ':endtime' => strtotime($year . '-' . $m['data'] . '-' . $lastday . ' 23:59:59'));
          $paramss = array(':uniacid' => $_W['uniacid'], ':starttime' => $year . '-' . $m['data'] . '-01 00:00:00', ':endtime' => $year . '-' . $m['data'] . '-' . $lastday . ' 23:59:59');

          $wz_count = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." uniacid=:uniacid and time >=:starttime and time<=:endtime group by back_orser",$params);
          $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wz_count));
          if(!$wz_money)
          {
            $wz_money = '0.00';
          }
          $tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." uniacid=:uniacid and time >=:starttime and time<=:endtime",$params);
          if(!$tijian)
          {
            $tijian = '0.00';
          }
          $tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." uniacid=:uniacid and xdtime >=:starttime and xdtime<=:endtime group by back_orser",$params);

          $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
          if(!$tw_money)
          {
            $tw_money = '0.00';
          }
          $goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=:uniacid and createTime>=:starttime and createTime<=:endtime",$paramss);
          if(!$goods)
          {
            $goods = '0.00';
          }
          $guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime group by back_orser",$params);
          $gh_money = array_sum(array_map(function($val){return $val['money'];}, $guahao));
          if(!$gh_money)
          {
            $gh_money = '0.00';
          }
          $green_order = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime group by back_orser",$params);
          $green_money = array_sum(array_map(function($val){return $val['money'];}, $green_order));
          if(!$green_money)
          {
            $green_money = '0.00';
          }

          $season_data[] = array(
            'date' => $m['data'] . '月',
            'money' => $wz_money + $tw_money + $goods + $gh_money + $green_money + $tijian,
          );
        }
        
      
    
      $year = date("Y",time());
      $month = date("m",time());
      switch ($month) {
        case 4 :
          $days = 30;
            break;
        case 6 :
          $days = 30;
            break;
        case 9 :
          $days = 30;
            break;
        case 11 :
            $days = 30;
            break;
        case 2 :
            if ($year % 4 == 0) {
                if ($year % 100 == 0) {
                    $days = $year % 400 == 0 ? 29 : 28;
                } else {
                    $days = 29;
                }
            } else {
                $days = 28;
            }
            break;
        default :
            $days = 31;
            break;
      }
      $lastday = $days;
      $d = 1;
      while ($d <= $lastday) {
        
        $params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($year . '-' . $month . '-' . $d . ' 00:00:00'), ':endtime' => strtotime($year . '-' . $month . '-' . $d . ' 23:59:59'));
        $paramss = array(':uniacid' => $_W['uniacid'], ':starttime' => $year . '-' . $month . '-' . $d . ' 00:00:00', ':endtime' => $year . '-' . $month . '-' . $d . ' 23:59:59');
        $wz_count = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." uniacid=:uniacid and time >=:starttime and time<=:endtime group by back_orser",$params);
        $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wz_count));
        if(!$wz_money)
        {
          $wz_money = '0.00';
        }
        $tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." uniacid=:uniacid and time >=:starttime and time<=:endtime",$params);
        if(!$tijian)
        {
          $tijian = '0.00';
        }
        $tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." uniacid=:uniacid and xdtime >=:starttime and xdtime<=:endtime group by back_orser",$params);

        $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
        if(!$tw_money)
        {
          $tw_money = '0.00';
        }
        $goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=:uniacid and createTime>=:starttime and createTime<=:endtime",$paramss);
        if(!$goods)
        {
          $goods = '0.00';
        }
        $guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime group by back_orser",$params);
        $gh_money = array_sum(array_map(function($val){return $val['money'];}, $guahao));
        if(!$gh_money)
        {
          $gh_money = '0.00';
        }
        $green_order = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime group by back_orser",$params);
        $green_money = array_sum(array_map(function($val){return $val['money'];}, $green_order));
        if(!$green_money)
        {
          $green_money = '0.00';
        }

        $month_data[] = array(
          'date' => $d . '日',
          'money' => $wz_money + $tw_money + $goods + $gh_money + $green_money + $tijian,
        );
        ++$d;
      }
      
      $i = 7;

      while (0 <= $i) {
        $time = date('Y-m-d', strtotime('-' . $i . ' day'));
        $params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($time . ' 00:00:00'), ':endtime' => strtotime($time . ' 23:59:59'));
        $paramss = array(':uniacid' => $_W['uniacid'], ':starttime' => $time . ' 00:00:00', ':endtime' => $time . ' 23:59:59');
        $wz_count = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." uniacid=:uniacid and time >=:starttime and time<=:endtime group by back_orser",$params);
        $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wz_count));
        if(!$wz_money)
        {
          $wz_money = '0.00';
        }
        $tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." uniacid=:uniacid and time >=:starttime and time<=:endtime",$params);
        if(!$tijian)
        {
          $tijian = '0.00';
        }
        $tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." uniacid=:uniacid and xdtime >=:starttime and xdtime<=:endtime group by back_orser",$params);

        $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
        if(!$tw_money)
        {
          $tw_money = '0.00';
        }
        $goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=:uniacid and createTime>=:starttime and createTime<=:endtime",$paramss);
        if(!$goods)
        {
          $goods = '0.00';
        }
        $guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime group by back_orser",$params);
        $gh_money = array_sum(array_map(function($val){return $val['money'];}, $guahao));
        if(!$gh_money)
        {
          $gh_money = '0.00';
        }
        $green_order = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime group by back_orser",$params);
        $green_money = array_sum(array_map(function($val){return $val['money'];}, $green_order));
        if(!$green_money)
        {
          $green_money = '0.00';
        }

        $week_data[] = array(
          'date' => $time,
          'money' => $wz_money + $tw_money + $goods + $gh_money + $green_money + $tijian,
        );
        --$i;
      }

    $data = array(
      'year_time' => array_column($year_data,'date'),
      'year_data' => array_column($year_data,'money'),
      'season_time' => array_column($season_data,'date'),
      'season_data' => array_column($season_data,'money'),
      'month_time' => array_column($month_data,'date'),
      'month_data' => array_column($month_data,'money'),
      'week_time' => array_column($week_data,'date'),
      'week_data' => array_column($week_data,'money'),
    );
    echo json_encode($data);
    exit();
  }

if($op == 'wxmb'){
   $base = pdo_get('hyb_yl_parameter',array('uniacid'=>$uniacid));
   $moban_id = unserialize($base['gzhmb']);
   $mobel =serialize($_GPC['mobel']);
   if($_W['ispost']){
     $data = array(
        'uniacid' =>$uniacid,
        'pub_appid'=>$_GPC['pub_appid'],
        'appkey'=>$_GPC['appkey'],
        'gzhmb'=>$mobel
      );
     if($base){
        pdo_update('hyb_yl_parameter',$data,array('uniacid'=>$uniacid));
     }else{
        pdo_insert('hyb_yl_parameter',$data);
     }
     message("操作成功!",$this->createWebUrl("base",array("op"=>"wxmb",'ac'=>'wxmb')),"success");
   }

   include $this->template('base/wxmb');
}
// 云收款音箱用户
if($op == 'box_user')
{
  $list = pdo_getall("hyb_yl_boxuser",array("uniacid"=>$uniacid));
  include $this->template("base/box_user");
}

// 添加编辑云收款音箱用户
if($op == 'addbox_user')
{
  $id = $_GPC['id'];
  $item = pdo_get("hyb_yl_boxuser",array("id"=>$id,"uniacid"=>$uniacid));
  $parameter = pdo_get("hyb_yl_parameter",array("uniacid"=>$uniacid));
  $sn = $parameter['box_sn'];
  $m = 1;
  $token = $parameter['box_token'];
  $version = $parameter['box_version'];
  if($_W['ispost']){
     $data = array(
        'uniacid' =>$uniacid,
        'uid'=>$_GPC['uid'],
        
      );
     
      $data['created'] = time();
      
      $getArr = array();
     $url = "https://speaker.17laimai.cn/bind.php?id=".$sn."&m=1&uid=".$_GPC['uid']."&token=".$token."&version=".$version;

     $tokenArr = json_decode(send_post($url, $getArr, "GET"),true);
     if($tokenArr['errcode'] != '0')
     {
      message($tokenArr['errmsg'],$this->createWebUrl("base",array("op"=>"box_user",'ac'=>'box_user')),"error");
     }else{
      pdo_insert('hyb_yl_boxuser',$data);
      message("操作成功!",$this->createWebUrl("base",array("op"=>"box_user",'ac'=>'box_user')),"success");
      
     }
      
     
   }

   include $this->template('base/addbox_user');

}
// 删除云收款音箱用户
if($op == "delbox_user")
{
  $id = $_GPC['id'];
  $parameter = pdo_get("hyb_yl_parameter",array("uniacid"=>$uniacid));
  $sn = $parameter['box_sn'];
  $m = 1;
  $token = $parameter['box_token'];
  $version = $parameter['box_version'];
  $getArr = array();

   $url = "https://speaker.17laimai.cn/bind.php?id=".$sn."&m=0&uid=".$_GPC['uid']."&token=".$token."&version=".$version;
   $tokenArr = json_decode(send_post($url, $getArr, "GET"),true);
     if($tokenArr['errcode'] != '0')
     {
      message($tokenArr['errmsg'],$this->createWebUrl("base",array("op"=>"box_user",'ac'=>'box_user')),"error");
     }else{
      pdo_delete("hyb_yl_boxuser",array("id"=>$id));
      message("操作成功!",$this->createWebUrl("base",array("op"=>"box_user",'ac'=>'box_user')),"success");
      
     }
   
  
  
  include $this->template('base/addbox_user');
}

function send_post($url, $post_data, $method = 'POST') {
      $postdata = http_build_query($post_data);
      $options = array('http' => array('method' => $method, //or GET
      'header' => 'Content-type:application/x-www-form-urlencoded', 'content' => $postdata, 'timeout' => 15 * 60 // 超时时间（单位:s）
      ));
      $context = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      return $result;
  }
   function http_curl($url,$type,$res,$arr){
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
  // 血压标准设置
  if($op == 'pressure')
  {
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_blood_pressure")." where uniacid=".$uniacid."  order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    $count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_blood_pressure")." where uniacid=".$uniacid);
    include $this->template("base/pressure");
  }
  // 血压标准添加
  if($op == 'add_pressure')
  {
    $id = $_GPC['id'];
    $item = pdo_get("hyb_yl_blood_pressure",array("uniacid"=>$uniacid,"id"=>$id));
    if ($_W['ispost']) {
      $data = array(
          'uniacid' => $uniacid,
          "high_range_down" => $_GPC['high_range_down'],
          "high_range_up" => $_GPC['high_range_up'],
          "low_range_down" => $_GPC['low_range_down'],
          "low_range_up" => $_GPC['low_range_up'],
          "proposal_low" => $_GPC['proposal_low'],
          "proposal_high" => $_GPC['proposal_high'],
          "proposal_normal" => $_GPC['proposal_normal'],
          "min_age" => $_GPC['min_age'],
          "max_age" => $_GPC['max_age'],
          "sex" => $_GPC['sex'],
      );
      if($id)
      {
        $res = pdo_update("hyb_yl_blood_pressure",$data,array("id"=>$id));
      }else{
        $data['created'] = time();
        $res = pdo_insert("hyb_yl_blood_pressure",$data);
      }
      if($res)
      {
        message("编辑成功!",$this->createWebUrl("base",array("op"=>"pressure",'hid'=>$hid,'ac'=>'pressure')),"success");
      }else{
        message("编辑失败!",$this->createWebUrl("base",array("op"=>"pressure",'hid'=>$hid,"ac"=>'pressure')),"success");
      }

    }
    include $this->template("base/add_pressure");
  }

  // 删除血压标准
  if($op == 'del_pressure')
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $res = pdo_delete("hyb_yl_blood_pressure",array("uniacid"=>$uniacid,"id"=>$id));
    if($res)
    {
      message("删除成功!",$this->createWebUrl("base",array("op"=>"pressure",'hid'=>$hid,'ac'=>'pressure')),"success");
    }else{
      message("删除失败!",$this->createWebUrl("base",array("op"=>"pressure",'hid'=>$hid,"ac"=>'pressure')),"success");
    }
    include $this->template("base/pressure");
  }
  // 批量删除血压标准
  
  if($op == 'del_pressures')
  {
    $ids = $_GPC['ids'];
    foreach($ids as &$value)
    {
      $res = pdo_delete("hyb_yl_blood_pressure",array("id"=>$value));
    }
    if($res)
    {
      message("删除成功!",$this->createWebUrl("base",array("op"=>"pressure",'hid'=>$hid,'ac'=>'pressure')),"success");
    }else{
      message("删除失败!",$this->createWebUrl("base",array("op"=>"pressure",'hid'=>$hid,'ac'=>'pressure')),"error");

    }
    include $this->template("base/pressure");
  }

  // 血糖标准设置
  if($op == 'sugar')
  {
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_blood_sugar")." where uniacid=".$uniacid."  order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    $count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_blood_sugar")." where uniacid=".$uniacid);
    include $this->template("base/sugar");
  }
  // 血压标准添加
  if($op == 'add_sugar')
  {
    $id = $_GPC['id'];
    $item = pdo_get("hyb_yl_blood_sugar",array("uniacid"=>$uniacid,"id"=>$id));
    if ($_W['ispost']) {
      $data = array(
          'uniacid' => $uniacid,
          "high_range_down" => $_GPC['high_range_down'],
          "high_range_up" => $_GPC['high_range_up'],
          "proposal_low" => $_GPC['proposal_low'],
          "proposal_high" => $_GPC['proposal_high'],
          "proposal_normal" => $_GPC['proposal_normal'],
          "min_age" => $_GPC['min_age'],
          "max_age" => $_GPC['max_age'],
          "sex" => $_GPC['sex'],
          "type" => $_GPC['type'],
      );
      if($id)
      {
        $res = pdo_update("hyb_yl_blood_sugar",$data,array("id"=>$id));
      }else{
        $data['created'] = time();
        $res = pdo_insert("hyb_yl_blood_sugar",$data);
      }
      
      if($res)
      {
        message("编辑成功!",$this->createWebUrl("base",array("op"=>"sugar",'hid'=>$hid,'ac'=>'sugar')),"success");
      }else{
        message("编辑失败!",$this->createWebUrl("base",array("op"=>"sugar",'hid'=>$hid,"ac"=>'sugar')),"success");
      }

    }
    include $this->template("base/add_sugar");
  }

  // 删除血压标准
  if($op == 'del_sugar')
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $res = pdo_delete("hyb_yl_blood_sugar",array("uniacid"=>$uniacid,"id"=>$id));
    if($res)
    {
      message("删除成功!",$this->createWebUrl("base",array("op"=>"sugar",'hid'=>$hid,'ac'=>'sugar')),"success");
    }else{
      message("删除失败!",$this->createWebUrl("base",array("op"=>"sugar",'hid'=>$hid,"ac"=>'sugar')),"success");
    }
    include $this->template("base/sugar");
  }

  if($op == 'del_sugar')
  {
    $ids = $_GPC['ids'];
    foreach($ids as &$value)
    {
      $res = pdo_delete("hyb_yl_blood_sugar",array("id"=>$value));
    }
    if($res)
    {
      message("删除成功!",$this->createWebUrl("base",array("op"=>"sugar",'hid'=>$hid,'ac'=>'sugar')),"success");
    }else{
      message("删除失败!",$this->createWebUrl("base",array("op"=>"sugar",'hid'=>$hid,'ac'=>'sugar')),"error");

    }
    include $this->template("base/sugar");
  }


