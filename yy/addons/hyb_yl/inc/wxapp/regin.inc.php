<?php
/**
* 
*/
require_once(IA_ROOT . '/framework/library/qrcode/phpqrcode.php');
 class Regin extends HYBPage
 { 
 //注册
   public function zhuce()
  {
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $zid = $_GPC['zid'];
    $data['uniacid'] = $_W['uniacid'];
    $data['openid'] = $_REQUEST['openid'];
    $data['z_name'] = $_REQUEST['z_name'];
    $data['z_content'] = $_REQUEST['z_content'];
    $data['hid'] = $_REQUEST['hid'];
    $data['z_room'] = $_REQUEST['z_room'];
    $data['parentid'] = $_REQUEST['parentid'];
    $data['z_zhicheng'] = $_REQUEST['z_zhicheng'];
    $data['z_sex'] = $_REQUEST['z_sex']=='undefined'?1:0;

    $data['zgzimgurl1back'] = $_GPC['zgzimgurl1back'];
    $data['sfzimgurl1back'] = $_GPC['sfzimgurl1back'];
    $data['sfzimgurl2back'] = $_GPC['sfzimgurl2back'];
    $data['advertisement'] = $_GPC['advertisement'];
    $data['sfzbianhao'] = $_GPC['sfzbianhao'];
    $data['address'] = $_GPC['address'];
    $data['lat'] = $_GPC['lat'];
    $data['lng'] = $_GPC['lng'];
    $data['authority'] = $_GPC['authority'];
    $data['z_telephone'] = $_GPC['z_telephone'];
    $data['qx_id'] = $_GPC['qx_id'];
    $data['is_green'] = $_GPC['is_green'];
    $data['is_examine'] = $_GPC['is_examine'];
    $data['is_urgent'] = $_GPC['is_urgent'];
    $data['tkid'] = $_GPC['tkid'];

    $row = pdo_get('hyb_yl_zhuanjia_rule',array('uniacid'=>$uniacid),array('is_ruzhu'));
    if($row['is_ruzhu'] =='1'){
      $data['exa'] = 1;
    }else{
      $data['exa'] = 0;
    }
    if (!empty($zid)) {
        $res = pdo_update("hyb_yl_zhuanjia", $data, array("zid" => $zid, "uniacid" => $uniacid));
    } else {
        $data['opentime'] = strtotime('now');
        $res = pdo_insert("hyb_yl_zhuanjia", $data);
        $zid = pdo_insertid();

    }
    $Dmoney = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . "WHERE zid = '{$zid}' and uniacid='{$uniacid}'");
    //生成二维码
    if (empty($Dmoney['weweima'])) {
        $dir = iconv("UTF-8", "GBK", "../attachment/hyb_yl");
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        $result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}' ", array(":uniacid" => $uniacid));
        $APPID = $result['appid'];
        $SECRET = $result['appsecret'];
        $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$APPID}&secret={$SECRET}";
        $getArr = array();
        $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
        $access_token = $tokenArr->access_token;
        $data = array();
        $data['scene'] = "zid=" . $zid;
        $data['page'] = "hyb_yl/czhuanjiasubpages/pages/zhuanjiazhuye/zhuanjiazhuye";
        $data = json_encode($data);
        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $access_token;
        $result = $this->api_notice_increment($url, $data);
        $image_name = md5(uniqid(rand())) . ".jpg";
        $filepath = "../attachment/hyb_yl/{$image_name}";
        $file_put = file_put_contents($filepath, $result);
        if ($file_put) {
            $siteroot = $_W['siteroot'];
            $filepathsss = "attachment/hyb_yl/{$image_name}";
            $phone = pdo_getcolumn('hyb_yl_zhuanjia', array('zid' => $zid), 'weweima');
            if($_GPC['advertisement'])
            {
              $erweimas = $this->changeAvatar("../".$filepathsss,$_GPC['advertisement'],$zid);
              $erweimas = substr($erweimas, 3);
              $datas = array('weweima' => $erweimas);
              $getupdate = pdo_update("hyb_yl_zhuanjia", $datas, array('zid' => $zid, 'uniacid' => $uniacid));
            }
            
            
        }
    } 
    echo json_encode($res);
  }
  public function yuan_img($imgpath) {
        $ext     = pathinfo($imgpath);
        $src_img = null;
        switch ($ext['extension']) {
        case 'jpg':
            $src_img = imagecreatefromjpeg($imgpath);
            break;
        case 'png':
            $src_img = imagecreatefromjpeg($imgpath);
            break;
        }

        $wh  = getimagesize($imgpath);
        $w   = $wh[0];
        $h   = $wh[1];
        $w   = min($w, $h);
        $h   = $w;
        $img = imagecreatetruecolor($w, $h);
        //这一句一定要有
        imagesavealpha($img, true);
        //拾取一个完全透明的颜色,最后一个参数127为全透明
        $bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
        imagefill($img, 0, 0, $bg);
        $r   = $w / 2; //圆半径
        $y_x = $r; //圆心X坐标
        $y_y = $r; //圆心Y坐标
        for ($x = 0; $x < $w; $x++) {
            for ($y = 0; $y < $h; $y++) {
                $rgbColor = imagecolorat($src_img, $x, $y);
                if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                    imagesetpixel($img, $x, $y, $rgbColor);
                }
            }
        }

        return $img;
    }
  public function changeAvatar($file_code_name,$avatar,$zid){
      //保存原始头像
      $img_file = file_get_contents($avatar);  //小程序传的头像是网络地址需要周转一下
      $img_content= base64_encode($img_file);
      $headurl = "../attachment/hyb_yl/".md5(uniqid(rand())) . ".jpg";
      file_put_contents($headurl,base64_decode($img_content));

      $imgg = $this->yuan_img($headurl); 

      $file_name = "../attachment/hyb_yl/".md5(uniqid(rand())) . ".jpg";
      imagepng($imgg,$file_name);
      imagedestroy($imgg);

      // 缩小头像（原图为1080，430的小程序码logo为192）
      $target_im = imagecreatetruecolor(200,200);     //创建一个新的画布（缩放后的），从左上角开始填充透明背景   
      imagesavealpha($target_im, true); 
      $trans_colour = imagecolorallocatealpha($target_im, 0, 0, 0, 127); 
      imagefill($target_im, 0, 0, $trans_colour);                
       
      $o_image = imagecreatefrompng($file_name);   //获取上文已保存的修改之后头像的内容
      imagecopyresampled($target_im,$o_image, 0, 0,0, 0, 200, 200, 200, 200);
      $file_head_name = "../attachment/hyb_yl/".md5(uniqid(rand())) . ".jpg";
      $comp_path = $file_head_name;
      imagepng($target_im,$comp_path);
      imagedestroy($target_im);

      // 进行拼接（使用加水印方式把处理过后的头像盖住logo）
      //传入保存后的二维码地址
      $url = $this->create_pic_watermark($file_code_name,$comp_path,"center",$zid); //处理完的新小程序码
      
      return $url;
  }

  public function create_pic_watermark($dest_image,$watermark,$locate,$zid){
      list($dwidth,$dheight,$dtype)=getimagesize($dest_image);
      list($wwidth,$wheight,$wtype)=getimagesize($watermark);
      $types=array(1 => "GIF",2 => "JPEG",3 => "PNG",
          4 => "SWF",5 => "PSD",6 => "BMP",
          7 => "TIFF",8 => "TIFF",9 => "JPC",
          10 => "JP2",11 => "JPX",12 => "JB2",
          13 => "SWC",14 => "IFF",15 => "WBMP",16 => "XBM");
      $dtype=strtolower($types[$dtype]);//原图类型
      $wtype=strtolower($types[$wtype]);//水印图片类型
      $created="imagecreatefrom".$dtype;
      $createw="imagecreatefrom".$wtype;
      $imgd=$created($dest_image);
      $imgw=$createw($watermark);
      switch($locate){
          case 'center':
              $x=($dwidth-$wwidth)/2;
              $y=($dheight-$wheight)/2;
              break;
          case 'left_buttom':
              $x=1;
              $y=($dheight-$wheight-2);
              break;
          case 'right_buttom':
              $x=($dwidth-$wwidth-1);
              $y=($dheight-$wheight-2);
              break;
          default:
              die("未指定水印位置!");
              break;
      }
      imagecopy($imgd,$imgw,$x,$y,0,0, $wwidth,$wheight);
      $save="image".$dtype;
      //保存到服务器
      $f_file_name = "../attachment/hyb_yl/".$zid . ".jpg";
      imagepng($imgd,$f_file_name); //保存
      imagedestroy($imgw);
      imagedestroy($imgd);
      //传回处理好的图片
      // $url = 'https://www.qubaobei.com/'.str_replace('/opt/ci123/www/html/markets/app2/baby/','',$f_file_name);
      $url = str_replace('/opt/ci123/www/html/markets/app2/baby/','',$f_file_name);
      return $url;
  }
 //专家信息
  public function zjinfo(){
     global $_W, $_GPC;
      $id = intval($_REQUEST['id']);
      $uniacid = $_W['uniacid'];
      $seunseinfo = pdo_fetch('SELECT a.*,b.*,c.agentname,d.job_name FROM' . tablename('hyb_yl_zhuanjia') . "as a left join" . tablename('hyb_yl_ceshi') . " as b on a.parentid = b.id left join".tablename('hyb_yl_hospital')."as c on c.hid=a.hid left join".tablename('hyb_yl_zhuanjia_job')."as d on d.id=a.z_zhicheng WHERE a.uniacid = '{$uniacid}' and a.zid='{$id}' ");
      $qx_id = $seunseinfo['qx_id'];
      $seunseinfo['jigouqx'] = pdo_fetch("select * from".tablename('hyb_yl_hospital_diction')."where id='{$qx_id}'");
      $seunseinfo['advertisement']=tomedia($seunseinfo['advertisement']);
      $seunseinfo['zgzimgurl1back'] = tomedia($seunseinfo['zgzimgurl1back']);
      $seunseinfo['sfzimgurl2back'] = tomedia($seunseinfo['sfzimgurl2back']);
      $seunseinfo['sfzimgurl1back'] = tomedia($seunseinfo['sfzimgurl1back']);
      echo json_encode($seunseinfo);
   }
   //机构申请
   public function getorganlevel(){
      global $_GPC,$_W;
      $uniacid = $_W['uniacid'];
      $row = pdo_fetchall("SELECT id,level_name FROM".tablename('hyb_yl_hospital_level')."WHERE uniacid='{$uniacid}' and level_type=1");
      echo json_encode($row);
   }
     //机权限
   public function jurisdiction(){
      global $_GPC,$_W;
      $uniacid = $_W['uniacid'];
      $row = pdo_fetchall("SELECT id,name FROM".tablename('hyb_yl_hospital_diction')."WHERE uniacid='{$uniacid}' and state=1");
      echo json_encode($row);
   }
   //添加机构
   public function addjigou(){
      global $_GPC,$_W;
      $uniacid = $_W['uniacid'];
      $hid = $_GPC['hid'];
      $state = $_GPC['state'];
        $data['uniacid'] = $uniacid;
        $data['agentname'] = $_GPC['agentname'];
        $data['logo'] = $_GPC['logo'];
        $data['longitude'] = $_GPC['longitude'];
        $data['latitude']  = $_GPC['latitude'];
        $data['address']   = $_GPC['address'];
        $data['groupid']   = $_GPC['groupid'];
        $data['grade']     = $_GPC['grade'];
        $data['realname']  = $_GPC['realname'];
        $data['hospitaltel'] = $_GPC['hospitaltel'];
        $data['xxaddress'] = $_GPC['xxaddress'];
        $data['openid'] = $_GPC['openid'];
        $data['username'] = $_GPC['username'];
        $data['zctime'] = strtotime('now');
        $data['type_da'] = 1;
        $data['districtslevel'] =3;
        $data['city'] = $_GPC['cityid'];
        $data['district'] = $_GPC['districtid'];
        $data['province'] = $_GPC['provinceid'];
        $data['lntroduction'] = $_GPC['lntroduction'];
        $data['bank_num'] = $_GPC['bank_num'];
        $data['bank_user'] = $_GPC['bank_user'];
        $data['bank_name'] = $_GPC['bank_name'];
        $data['tkid'] = $_GPC['tkid'];
        if(empty($hid)){
          $password = $_GPC['password']; 
          $random = random(6); 
          $salt =md5(md5($random . $password) . $random);
          $hash = user_hash($password , $salt);
          $data['password'] =$hash;
          $data['backpassword'] = '123456789';
          $row = pdo_insert('hyb_yl_hospital',$data);
        }else{
          if($state==5){
          $data['state'] = 0; 
          $row = pdo_update('hyb_yl_hospital',$data,array('hid'=>$hid));
          }
          if($state=='1'){
          $data['state'] = 0; 
          $row = pdo_update('hyb_yl_hospital',$data,array('hid'=>$hid));
          }
        }
        echo json_encode($row);
   }
   public function jigouif(){
      global $_GPC,$_W;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $res = pdo_fetch("SELECT * FROM".tablename('hyb_yl_hospital')."WHERE uniacid='{$uniacid}'and openid='".$openid."'");
      $groupid = $res['groupid'];
      $grade = $res['grade'];
      $res['level'] = pdo_get('hyb_yl_hospital_level',array('id'=>$grade));
      $res['diction'] = pdo_get('hyb_yl_hospital_diction',array('id'=>$groupid));

      $res['logo'] = tomedia($res['logo']);
      $zid_arr = pdo_getall("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"hid"=>$res['hid']),'zid');
      $zids = "";
      foreach($zid_arr as &$value)
      {
        $zids .= $value['zid'].",";
      }
      $zids = substr($zids,0,strlen($zids)-1);
      $where = "";
      if($zids != '')
      {
        $where = " and zid in (".$zids.")";
      }

      $guahao_count = pdo_fetchall("select id from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid.$where." group by back_orser");
      $res['guahao_count'] = count($guahao_count);

      $wenzhen_count = pdo_fetchall("select id from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid.$where." group by back_orser");
      
      $res['wenzhen_count'] = count($wenzhen_count);

      $tuwen_count = pdo_fetchall("select id from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid.$where." group by back_orser");
      $res['tuwen_count'] = count($tuwen_count);

      $chufang_count = pdo_fetchall("select c_id from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid.$where." group by back_orser");
      $res['chufang_count'] = count($chufang_count);

      $res['goods_count'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid.$where." or hid=".$res['hid']);

      $tijianorder = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid.$where);
      $res['tijianorder'] = $tijianorder;
      
      $res['orders'] = count($wenzhen_count) + count($guahao_count) + count($tuwen_count) + count($chufang_count) + $tijianorder + $res['goods_count'];
      
      $server = pdo_fetchall("select * from ".tablename("hyb_yl_docser_speck")." where uniacid=".$uniacid." and key_words != 'kuaisuwenzhen' and key_words != 'sirenyisheng'");

      foreach($server as &$value)
      {
        if($value['key_words'] == 'shipinwenzhen' || $value['key_words'] == 'dianhuajizhen' || $value['key_words'] == 'shoushukuaiyue' || $value['key_words'] == 'tijianjiedu')
        {
          $counts = pdo_fetchall("select id from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and keywords='".$value['key_words']."'".$where." group by back_orser");
          
          $countss = count($counts);
          $value['orders'] = $countss;
        }
        else if($value['key_words'] == 'tuwenwenzhen')
        {
          $counts = pdo_fetchall("select id from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid.$where." group by back_orser");
          $countss = count($counts);
          $value['orders'] = $countss;
        }else if($value['key_words'] == 'yuanchengkaifang')
        {
          $counts = pdo_fetchall("select c_id from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid.$where." group by back_orser");
          $countss = count($counts);
          $value['orders'] = $countss;
        }else if($value['key_words'] == 'yuanchengguahao')
        {
          $counts = pdo_fetchall("select id from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid.$where." group by back_orser");
          $countss = count($counts);
          $value['orders'] = $countss;
        }
        $res['server'] = $server;
      }
      

      echo json_encode($res);
   }
   //查询机构的id select * from table_name where domain regexp 'baidu';
   public function getjigouid(){
    global $_GPC,$_W;
    $uniacid = $_W['uniacid'];
    $province = $_GPC['province'];
    $city = $_GPC['city'];
    $district = $_GPC['district'];
    $res="";
    $sql1 ="select * from ".tablename('hyb_yl_address')." where name regexp '".$province."' and level=1";
    $sql2 ="select * from ".tablename('hyb_yl_address')." where name regexp '".$city."' and level=2";
    $sql3 ="select * from ".tablename('hyb_yl_address')." where name regexp '".$district."' and level=3";
    $res['province'] = pdo_fetch($sql1);
    $res['city'] = pdo_fetch($sql2);
    $res['district'] = pdo_fetch($sql3);
    echo json_encode($res);
   }
   // 获取机构数据总览
   public function hospital_detail()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,'openid'=>$openid));
    $index = empty($_GPC['index']) ? '0' : $_GPC['index'];
    $date_index = empty($_GPC['date_index']) ? '0' : $_GPC['date_index'];
    $where = " where uniacid=".$uniacid;
    $zj_arr = pdo_getall("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,'hid'=>$hospital['hid']),'zid');
    $hids = '"'.$hospital['hid'].'"';
    $zjs = "";

    foreach($zj_arr as &$zj)
    {
      $zjs .= $zj['zid'].",";
    }
    $zjs = substr($zjs,0,strlen($zjs)-1);
    
    $seven_time = array();
    $timestamp = time()- 3600 * 24 * 7;
    for ($i = 7 ; $i > 0 ; $i--) {
        $seven_time[$i]['time'] = date('Y-m-d 00:00:00', $timestamp);
        $seven_time[$i]['timess'] = date('Y-m-d', $timestamp);
        $seven_time[$i]['end_time'] = date('Y-m-d 23:59:59', $timestamp);
        $seven_time[$i]['times'] = strtotime(date('Y-m-d 00:00:00', $timestamp));
        $seven_time[$i]['end_times'] = strtotime(date('Y-m-d 23:59:59', $timestamp));
        $timestamp += 24 * 3600;
    }
    $year = date("Y");
    $yeararr = [];
    $month = [];
    for ($i=1; $i <=12 ; $i++) { 
      $yeararr[$i] = $year.'-'.$i;
    }
    foreach ($yeararr as $key => $value) {
      $timestamp = strtotime($value);
      $start_time = date('Y-m-1 00:00:00', $timestamp);
      $mdays = date('t', $timestamp);
      $end_time = date('Y-m-' . $mdays . ' 23:59:59', $timestamp);
      $month[$key]['time'] = $start_time;
      $month[$key]['timess'] = date('Y-m', $timestamp);
      $month[$key]['times'] = $timestamp;
      $month[$key]['end_time'] = $end_time;
      $month[$key]['end_times'] = strtotime($month[$key]['end_time']);
    }
    
    $zj_arr = pdo_getall("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"hid"=>$hospital['hid']),'zid');
    $zjs = "";
    foreach($zj_arr as &$zj)
    {
      $zjs .= $zj['zid'].",";
    }
    $zjs = substr($zjs,0,strlen($zjs)-1);
    if($date_index == '0')
    {
      $list = $seven_time;

    }else{
      $list = $month;
    }
    
    foreach($list as &$values)
    {
      if($index == '0' || $index == '4'){
        if($zjs == '')
        {
          $values['huanzhe'] = '0';
          $values['order'] = '0';
        }else{
          if($index == '0')
          {
            $group = " group by openid";
            $groups = " group by useropenid";
          }else{
            $group = " group by back_orser";
            $groups = " group by back_orser";
          }
          $wenzhen_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$values['times']."' and time <='".$values['end_times']."'".$group);
          
          $wenzhen_users = count($wenzhen_user);
          $tuwen_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$values['times']."' and time <='".$values['end_times']."'".$group);
          $tuwen_users = count($tuwen_user);
          $guahao_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$values['times']."' and time <='".$values['end_times']."'".$group);
          $guahao_users = count($guahao_user);
          $goods_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and zid in (".$zjs.") and createTime<='".$values['time']."' and createTime >='".$values['end_time']."'".$group);
          $goods_users = count($goods_user);
          $chufang_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$values['times']."' and time <='".$values['end_times']."'".$groups);
          $chufang_users = count($chufang_user);
          $tijianorder = pdo_fetchall("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$values['times']."' and time <='".$values['end_times']."' group by openid");
          $tijian_users = count($tijianorder);
          $values['list'] = $wenzhen_users + $tuwen_users + $guahao_users + $goods_users + $chufang_users + $tijian_users; 

        }
      }elseif($index == '1')
      {
        $values['list'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime >='".$values['times']."' and opentime <='".$values['end_times']."'");
      }else if($index == '2')
      {
        $values['list'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsarr")." where uniacid=".$uniacid." and date >='".$values['times']."' and date <='".$values['end_times']."'");
      }else if($index == '3')
      {
         $values['list'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and hid like '%$hid%' and created >='".$values['times']."' and created <='".$values['end_times']."'");
      }
    }
    
    $today = strtotime(date("Y-m-d",time()));
    $todays = date("Y-m-d",time());
    $week = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
    $weeks = strtotime($week);
    $month = mktime(0,0,0,date('m'),1,date('Y'));
    $months = strtotime($month);
    // 本日新增数据
    // 本日新增患者
    $today_wenzhen_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$today."' group by openid");
    $today_wenzhen_users = count($today_wenzhen_user);
    $today_tuwen_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$today."' group by openid");
    $today_tuwen_users = count($today_tuwen_user);
    $today_chufang_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$today."' group by useropenid");
    $today_chufang_users = count($today_chufang_user);
    $today_tijian_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$today."' group by openid");
    $today_tijian_users = count($today_tijian_user);
    $today_guahao_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$today."' group by openid");
    $today_guahao_users = count($today_guahao_user);

    $todayss['user'] = $today_wenzhen_users + $today_tuwen_users + $today_chufang_users + $today_tijian_users + $today_guahao_users;
    
    // 本日新增专家
    $todayss['zhuanjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime >='".$today."' and zid in (".$zjs.")");
    // 本日新增商品
    $todayss['goods'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsarr")." where uniacid=".$uniacid." and jigou_two=".$hospital['hid']." and date >='".$todays."'");
    
    // 本日新增套餐
    $todayss['taocan'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and hid like '%$hids%' and created >=".$today);
    // 本日新增订单
    $today_wenzhen_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$today."' group by back_orser");
    $today_wenzhen_orders = count($today_wenzhen_order);
    $today_tuwen_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$today."' group by back_orser");
    $today_tuwen_orders = count($today_tuwen_order);
    $today_chufang_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$today."' group by back_orser");
    $today_chufang_orders = count($today_chufang_order);
    $today_tijian_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$today."' group by ordernums");
    $today_tijian_orders = count($today_tijian_order);
    $today_guahao_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$today."' group by back_orser");
    $today_guahao_orders = count($today_guahao_order);
    $todayss['order'] = $today_wenzhen_orders + $today_tuwen_orders + $today_chufang_orders + $today_tijian_orders + $today_guahao_orders;

    // 本周新增数据
    // 本周新增患者
    $week_wenzhen_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$week."' group by openid");
    $week_wenzhen_users = count($week_wenzhen_user);
    $week_tuwen_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$week."' group by openid");
    $week_tuwen_users = count($week_tuwen_user);
    $week_chufang_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$week."' group by useropenid");
    $week_chufang_users = count($week_chufang_user);
    $week_tijian_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$week."' group by openid");
    $week_tijian_users = count($week_tijian_user);
    $week_guahao_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$week."' group by openid");
    $week_guahao_users = count($week_guahao_user);
    $weekss['user'] = $week_wenzhen_users + $week_tuwen_users + $week_chufang_users + $week_tijian_users + $week_guahao_users;
    // 本周新增专家
    $weekss['zhuanjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime >='".$week."' and zid in (".$zjs.")");
    // 本周新增商品
    $weekss['goods'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsarr")." where uniacid=".$uniacid." and jigou_two=".$hospital['hid']." and date >='".$weeks."'");
    $hids = '"'.$hospital['hid'].'"';
    // 本周新增套餐
    $weekss['taocan'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and hid like '%$hids%' and created >=".$week);
    // 本周新增订单
    $week_wenzhen_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$week."' group by back_orser");
    $week_wenzhen_orders = count($week_wenzhen_order);
    $week_tuwen_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$week."' group by back_orser");
    $week_tuwen_orders = count($week_tuwen_order);
    $week_chufang_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$week."' group by back_orser");
    $week_chufang_orders = count($week_chufang_order);
    $week_tijian_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$week."' group by ordernums");
    $week_tijian_orders = count($week_tijian_order);
    $week_guahao_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$week."' group by back_orser");
    $week_guahao_orders = count($week_guahao_order);
    $weekss['order'] = $week_wenzhen_orders + $week_tuwen_orders + $week_chufang_orders + $week_tijian_orders + $week_guahao_orders;

    // 本月新增数据
    // 本月新增患者
    $month_wenzhen_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$month."' group by openid");
    $month_wenzhen_users = count($month_wenzhen_user);
    $month_tuwen_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$month."' group by openid");
    $month_tuwen_users = count($month_tuwen_user);
    $month_chufang_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$month."' group by useropenid");
    $month_chufang_users = count($month_chufang_user);
    $month_tijian_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$month."' group by openid");
    $month_tijian_users = count($month_tijian_user);
    $month_guahao_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$month."' group by openid");
    $month_guahao_users = count($month_guahao_user);
    $monthss['user'] = $month_wenzhen_users + $month_tuwen_users + $month_chufang_users + $month_tijian_users + $month_guahao_users;
    // 本月新增专家
    $monthss['zhuanjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime >='".$month."' and zid in (".$zjs.")");
    // 本月新增商品
    $monthss['goods'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsarr")." where uniacid=".$uniacid." and jigou_two=".$hospital['hid']." and date >='".$months."'");
    $hids = '"'.$hospital['hid'].'"';
    // 本月新增套餐
    $monthss['taocan'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and hid like '%$hids%' and created >=".$month);
    // 本月新增订单
    $month_wenzhen_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$month."' group by back_orser");
    $month_wenzhen_orders = count($month_wenzhen_order);
    $month_tuwen_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$month."' group by back_orser");
    $month_tuwen_orders = count($month_tuwen_order);
    $month_chufang_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$month."' group by back_orser");
    $month_chufang_orders = count($month_chufang_order);
    $month_tijian_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$month."' group by ordernums");
    $month_tijian_orders = count($month_tijian_order);
    $month_guahao_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >='".$month."' group by back_orser");
    $month_guahao_orders = count($month_guahao_order);
    $monthss['order'] = $month_wenzhen_orders + $month_tuwen_orders + $month_chufang_orders + $month_tijian_orders + $month_guahao_orders;
    
    // 数据总数
    // 患者总数
    $wenzhen_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zjs.") group by openid");
    $wenzhen_users = count($wenzhen_user);
    $tuwen_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zjs.") group by openid");
    $tuwen_users = count($tuwen_user);
    $chufang_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zjs.") group by useropenid");
    $chufang_users = count($chufang_user);
    $tijian_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and zid in (".$zjs.") group by openid");
    $tijian_users = count($tijian_user);
    $guahao_user = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid in (".$zjs.") group by openid");
    $guahao_users = count($guahao_user);
    $count['user'] = $wenzhen_users + $tuwen_users + $chufang_users + $tijian_users + $guahao_users;
    
    // 专家总数
    $count['zhuanjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and zid in (".$zjs.")");
    // 商品总数
    $count['goods'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsarr")." where uniacid=".$uniacid." and jigou_two=".$hospital['hid']);
    $hids = '"'.$hospital['hid'].'"';
    // 套餐总数
    $count['taocan'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and hid like '%$hids%'");
    // 订单总数
    $wenzhen_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid in (".$zjs.") group by back_orser");
    $wenzhen_orders = count($wenzhen_order);
    $tuwen_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zjs.") group by back_orser");
    $tuwen_orders = count($tuwen_order);
    $chufang_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zjs.") group by back_orser");
    $chufang_orders = count($chufang_order);
    $tijian_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and zid in (".$zjs.") group by ordernums");
    $tijian_orders = count($tijian_order);
    $guahao_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid in (".$zjs.") group by back_orser");
    $guahao_orders = count($guahao_order);
    $count['order'] = $wenzhen_orders + $tuwen_orders + $chufang_orders + $tijian_orders + $guahao_orders;
    if($count['user'] == '0')
    {
      $todayss['user_bili'] = '0';
      $weekss['user_bili'] = '0';
      $monthss['user_bili'] = '0';
    }else{
      $todayss['user_bili'] = round($todayss['user'] / $count['user'] * 100,2);
      $weekss['user_bili'] = round($weekss['user'] / $count['user'] * 100,2);
      $monthss['user_bili'] = round($monthss['user'] / $count['user'] * 100,2);
    }
    if($count['zhuanjia'] == '0')
    {
      $todayss['zj_bili'] = '0';
      $weekss['zj_bili'] = '0';
      $monthss['zj_bili'] = '0';
    }else{
      $todayss['zj_bili'] = round($todayss['zhuanjia'] / $count['zhuanjia'] * 100,2);
      $weekss['zj_bili'] = round($weekss['zhuanjia'] / $count['zhuanjia'] * 100,2);
      $monthss['zj_bili'] = round($monthss['zhuanjia'] / $count['zhuanjia'] * 100,2);
    }
    if($count['goods'] == '0')
    {
      $todayss['goods_bili'] = '0';
      $weekss['goods_bili'] = '0';
      $monthss['goods_bili'] = '0';
    }else{
      $todayss['goods_bili'] = round($todayss['goods'] / $count['goods'] * 100,2);
      $weekss['goods_bili'] = round($weekss['goods'] / $count['goods'] * 100,2);
      $monthss['goods_bili'] = round($monthss['goods'] / $count['goods'] * 100,2);
    }
    
    if($count['taocan'] == '0')
    {
      $todayss['taocan_bili'] = '0';
      $weekss['taocan_bili'] = '0';
      $monthss['taocan_bili'] = '0';
    }else{
      $todayss['taocan_bili'] = round($todayss['taocan'] / $count['taocan'] * 100,2);
      $weekss['taocan_bili'] = round($weekss['taocan'] / $count['taocan'] * 100,2);
      $monthss['taocan_bili'] = round($monthss['taocan'] / $count['taocan'] * 100,2);
    }
    if($count['order'] == '0')
    {
      $todayss['order_bili'] = '0';
      $weekss['order_bili'] = '0';
      $monthss['order_bili'] = '0';
    }else{
      $todayss['order_bili'] = round($todayss['order'] / $count['order'] * 100,2);
      $weekss['order_bili'] = round($weekss['order'] / $count['order'] * 100,2);
      $monthss['order_bili'] = round($monthss['order'] / $count['order'] * 100,2);
    }

    $lists = array(
      'list' => $list,
      "counts" => array_column($list,'list'),
      "date" => array_column($list,'timess'),
    );
    if($index == '0')
    {
     $lists['today'] = array(
      'data' => $todayss['user'],
      "bili" => $todayss['user_bili']
      );
      $lists['week'] = array(
      'data' => $weekss['user'],
      "bili" => $weekss['user_bili']
      );
      $lists['month'] = array(
      'data' => $monthss['user'],
      "bili" => $monthss['user_bili']
      );
      $lists['count'] = array(
      'data' => $count['user'],
      );
    }else if($index == '1'){
      $lists['today'] = array(
      'data' => $todayss['zhuanjia'],
      "bili" => $todayss['zj_bili']
      );
      $lists['week'] = array(
      'data' => $weekss['zhuanjia'],
      "bili" => $weekss['zj_bili']
      );
      $lists['month'] = array(
      'data' => $monthss['zhuanjia'],
      "bili" => $monthss['zj_bili']
      );
      $lists['count'] = array(
      'data' => $count['zhuanjia'],
      );
    }else if($index == '2')
    {
      $lists['today'] = array(
      'data' => $todayss['goods'],
      "bili" => $todayss['goods_bili']
      );
      $lists['week'] = array(
      'data' => $weekss['goods'],
      "bili" => $weekss['goods_bili']
      );
      $lists['month'] = array(
      'data' => $monthss['goods'],
      "bili" => $monthss['goods_bili']
      );
      $lists['count'] = array(
      'data' => $count['goods'],
      );
    }else if($index == '3')
    {
      $lists['today'] = array(
      'data' => $todayss['taocan'],
      "bili" => $todayss['taocan_bili']
      );
      $lists['week'] = array(
      'data' => $weekss['taocan'],
      "bili" => $weekss['taocan_bili']
      );
      $lists['month'] = array(
      'data' => $monthss['taocan'],
      "bili" => $monthss['taocan_bili']
      );
      $lists['count'] = array(
      'data' => $count['taocan'],
      );
    }else if($index == '4')
    {
      $lists['today'] = array(
      'data' => $todayss['order'],
      "bili" => $todayss['order_bili']
      );
      $lists['week'] = array(
      'data' => $weekss['order'],
      "bili" => $weekss['order_bili']
      );
      $lists['month'] = array(
      'data' => $monthss['order'],
      "bili" => $monthss['order_bili']
      );
      $lists['count'] = array(
      'data' => $count['order'],
      );
    }

    echo json_encode($lists);
    exit();
   }

   // 获取机构详情
   public function hospitals()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid));
    $hospital['logo'] = tomedia($hospital['logo']);
    $hospital['bank'] = pdo_getall("hyb_yl_hospital_bank",array("uniacid"=>$uniacid,"hid"=>$hospital['hid']));
    $hospital['zfb'] = pdo_getall("hyb_yl_hospital_zfb",array("uniacid"=>$uniacid,"hid"=>$hospital['hid']));

    echo json_encode($hospital);
   }

   // 添加修改机构支付宝信息
   public function add_hoszfb()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $id = $_GPC['id'];
    $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
    $data = array(
      'hid' => $hid,
      "uniacid" => $uniacid,
      "name" => $_GPC['name'],
      "number" => $_GPC['number'],
      "status" => $_GPC['status'], 
    );
    if($id)
    {
      $res = pdo_update("hyb_yl_hospital_zfb",$data,array("id"=>$id,"uniacid"=>$uniacid));
    }else{
      $data['created'] = time();
      $res = pdo_insert("hyb_yl_hospital_zfb",$data);
    }
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

   // 修改支付宝状态
   public function update_hoszfb()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $openid = $_GPC['openid'];
    $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
    $status = $_GPC['status'];

    if($status == '1')
    {
      pdo_update("hyb_yl_hospital_zfb",array("status"=>'0'),array("hid"=>$hid,"uniacid"=>$uniacid));
      pdd_update("hyb_yl_hospital_zfb",array("status"=>'1'),array("id"=>$id));
    }else if($status == '0')
    {
      
      pdo_update("hyb_yl_hospital_zfb",array("status"=>'0'),array("id"=>$id,"uniacid"=>$uniacid));

    }
   }

   // 删除支付宝账号
   public function del_hoszfb()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    pdo_delete("hyb_yl_hospital_zfb",array("uniacid"=>$uniacid,"id"=>$id));
   }

   // 添加修改机构银行卡
   public function add_hosbank()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $id = $_GPC['id'];
    $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
    $data = array(
      'hid' => $hid,
      "uniacid" => $uniacid,
      "name" => $_GPC['name'],
      "number" => $_GPC['number'],
      "status" => $_GPC['status'], 
      "address" => $_GPC['address'],
      "bank_name" => $_GPC['bank_name'],
    );
    if($id)
    {
      $res = pdo_update("hyb_yl_hospital_bank",$data,array("id"=>$id,"uniacid"=>$uniacid));
    }else{
      $data['created'] = time();
      $res = pdo_insert("hyb_yl_hospital_bank",$data);
    }
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

   // 修改银行卡信息
   public function update_hosbank()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $openid = $_GPC['openid'];
    $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
    $status = $_GPC['status'];

    if($status == '1')
    {
      pdo_update("hyb_yl_hospital_bank",array("status"=>'0'),array("hid"=>$hid,"uniacid"=>$uniacid));
      pdd_update("hyb_yl_hospital_bank",array("status"=>'1'),array("id"=>$id));
    }else if($status == '0')
    {
      
      pdo_update("hyb_yl_hospital_bank",array("status"=>'0'),array("id"=>$id,"uniacid"=>$uniacid));

    }
   }

   // 删除银行卡信息
   public function del_hosbank()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    pdo_delete("hyb_yl_hospital_bank",array("uniacid"=>$uniacid,"id"=>$id));
   }
   
   // 获取支付宝号详情
   public function hos_zhifubao()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $info = pdo_get("hyb_yl_hospital_zfb",array("uniacid"=>$uniacid,"id"=>$id));
    echo json_encode($info);
   }

   // 获取银行卡信息
   public function hos_bank()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $info = pdo_get("hyb_yl_hospital_bank",array("uniacid"=>$uniacid,"id"=>$id));
    echo json_encode($info);
   }

   //添加机构提醒数
   public function addnumber()
   {
    global $_W,$_GPC;
    $uniacid = $_GPC['uniacid'];
    $hid = $_GPC['hid'];
    $key = $_GPC['key'];
    $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$hid));
    if($key == 'gh_number')
    {
      $gh_number = $hospital['gh_number'] + 1;
      pdo_update("hyb_yl_hospital",array("gh_number"=>$gh_number),array("hid"=>$hid));
    }else if($key == 'wz_number')
    {
      $wz_number = $hospital['wz_number'] + 1;
      pdo_update("hyb_yl_hospital",array("wz_number"=>$wz_number),array("hid"=>$hid));
    }else if($key == 'order_number')
    {
      $order_number = $hospital['order_number'] + 1;
      pdo_update("hyb_yl_hospital",array("order_number"=>$order_number),array("hid"=>$hid));
    }
    
   }

   //获取提现设置
   public function jiesuanset()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $base = pdo_get("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid));
    $base['weixin_content'] = htmlspecialchars_decode($base['weixin_content']);
    $base['zfb_content'] = htmlspecialchars_decode($base['zfb_content']);
    $base['bank_content'] = htmlspecialchars_decode($base['bank_content']);
    echo json_encode($base);
   }

   //机构提现
   public function hospital_tixian()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $username = pdo_getcolumn("hyb_yl_userinfo",array("uniacid"=>$uniacid,"openid"=>$openid),'u_name');
    $mch_id = pdo_getcolumn("hyb_yl_parameter",array("uniacid"=>$uniacid),'mch_id');
    
    $data = array(
      'openid' => $openid,
      "uniacid" =>$uniacid,
      "hid" => $_GPC['hid'],
      "old_money" => $_GPC['money'],
      "fee" => $_GPC['fee'],
      "money" => $_GPC['money'] - $_GPC['fee'],
      "back_orser" => $mch_id.time(),
      "type" => '1',
      "style" => '7',
      "cash" => '1',
      "cash_type" => $_GPC['position'],
      "created" => time()
    );
    if($_GPC['position'] == '0')
    {
      $data['cash_type'] = 2;
      $data['bank_card'] = $_GPC['bank_card'];
      $data['bank_address'] = $_GPC['bank_address'];
      $data['bank_user'] = $_GPC['bank_user'];
      $data['bank_id'] = $_GPC['bank_id'];
    }else if($_GPC['position'] == '1')
    {
      $data['nickname'] = $username;
    }else if($_GPC['position'] == '2')
    {
      $data['zfb_name'] = $_GPC['zfb_name'];
      $data['zfb_number'] = $_GPC['zfb_number'];
      $data['zfb_id'] = $_GPC['zfb_id'];
    }
    if($_GPC['is_agent'] == '1')
    {
      $data['status'] = '1';
    }else{
      $data['status'] = '0';
    }
    
    pdo_insert("hyb_yl_pay",$data);
    $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
    $moneys = $hospital['money'] - $_GPC['money'];
    pdo_update("hyb_yl_hospital",array("money"=>$moneys),array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
   }
  //修改机构信息
   public function update_hospital()
   {
    global $_W,$_GPC;
    $hid = $_GPC['hid'];
    $uniacid = $_W['uniacid'];
    $password = $_GPC['password']; 
    $random = random(6);   
    $salt =md5(md5($random . $password) . $random);
    $hash = user_hash($password , $salt);
     
    
    $data = array(
        'agentname' => $_GPC['agentname'],
        'username' => $_GPC['username'],
        'password' => $hash,
        'realname' => $_GPC['realname'],
        'hospitaltel' => $_GPC['hospitaltel'],
        'latitude' => $_GPC['latitude'],
        'longitude' => $_GPC['longitude'],
        'openid' => $_GPC['openid'],
        'address' => $_GPC['address'],
        'xxaddress' => $_GPC['xxaddress'],
        'logo' => $_GPC['logo'],
        'groupid' => $_GPC['groupid'],
        'grade' => $_GPC['grade'],
        'backpassword' => $_GPC['password'],
        'lntroduction' => $_GPC['lntroduction'],
    );
    if(empty($hid)){
      $data['zctime'] = strtotime('now');
    } 
    if(empty($hid)){
      pdo_insert("hyb_yl_hospital",$data);
          
    }else{
      pdo_update("hyb_yl_hospital",$data,array('hid'=>$hid));
    }
   }

   public function hospital_order()
   {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $key_words = $_GPC['key_words'];
    $page = $_GPC['page'];
    $openid = $_GPC['openid'];
    $pages = $page * 10;
    $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
    $zjs = "";
    $zj_arr = pdo_getall("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"hid"=>$hid),'zid');
    $where = " where a.uniacid=".$uniacid;
    if(count($zj_arr)>0)
    {
      foreach($zj_arr as &$zj)
      {
        $zjs .= $zj['zid'].",";
      }
      $zjs = substr($zjs,0,strlen($zjs)-1);
       $where.=" and a.zid in (".$zjs.")";
    }else{
      $zjs = "";
       $where.=" and a.zid =''";

    }
   

    if($key_words == 'dianhuajizhen' || $key_words == 'shipinwenzhen' || $key_words == 'shoushukuaiyue' || $key_words == 'tijianjiedu')
    {
      $list = pdo_fetchall("select a.*,a.time as times,a.describe as content,u.u_name,u.u_thumb from ".tablename("hyb_yl_wenzorder")."as a left join ".tablename("hyb_yl_userinfo")." as u on a.openid=u.openid ".$where." and a.keywords='".$key_words."' group by a.back_orser order by a.id desc limit ".$pages.",10");
      
      
      

    }else if($key_words == 'tuwenwenzhen')
    {
        $list = pdo_fetchall("select a.*,a.time as times,u.u_name,u.u_thumb from ".tablename("hyb_yl_twenorder")."as a left join ".tablename("hyb_yl_userinfo")." as u on a.openid=u.openid ".$where." group by a.back_orser order by a.id desc limit ".$pages.",10");
        
    }else if($key_words == 'yuanchengkaifang')
    {
      $list = pdo_fetchall("select a.*,a.time as times,u.u_name,u.u_thumb from ".tablename("hyb_yl_chufang")."as a left join ".tablename("hyb_yl_userinfo")." as u on a.useropenid=u.openid ".$where." group by a.back_orser order by a.c_id desc limit ".$pages.",10");
    }else if($key_words == 'yuanchengguahao')
    {
      $list = pdo_fetchall("select a.*,a.describe as content,a.time as times,u.u_name,u.u_thumb from ".tablename("hyb_yl_guahaoorder")."as a left join ".tablename("hyb_yl_userinfo")." as u on a.openid=u.openid ".$where." group by a.back_orser order by a.id desc limit ".$pages.",10");
    }else if($key_words == 'goods')
    {
      $list = pdo_fetchall("select a.*,a.createTime as time,a.sid as content,u.u_name,u.u_thumb from ".tablename("hyb_yl_goodsorders")."as a left join ".tablename("hyb_yl_userinfo")." as u on a.openid=u.openid ".$where." order by a.id desc limit ".$pages.",10");
      foreach($list as &$kk)
      {
        $kk['sid'] = unserialize($kk['sid']);
      }

    }
    foreach($list as &$value)
    {
      $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$value['zid']));
      $zhuanjia['advertisement'] = tomedia($zhuanjia['advertisement']);
      $value['z_name'] = $zhuanjia['z_name'];
      $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("uniacid"=>$uniacid,'id'=>$zhuanjia['z_zhicheng']),'job_name');
      $value['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'agentname');
      $value['keshi'] = pdo_getcolumn("ceshi",array("uniacid"=>$uniacid,"id"=>$zhuanjia['parentid']),'name');
      $value['advertisement'] = $zhuanjia['advertisement'];
      $value['time'] = date("Y-m-d H:i:s",$value['times']);
      $value['content'] = unserialize($value['content']);
      $value['overtime'] = date("Y-m-d H:i:s",$value['overtime']);
    }
    echo json_encode($list);
   }

   //查询机构产品
    public function goods()
    {
      global $_W,$_GPC;
      $page = $_GPC['page'];
      $openid = $_GPC['openid'];
      $pages = $page * 10;
      $uniacid = $_W['uniacid'];
      $keyword = $_GPC['keyword'];
      $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
      $where = " where a.uniacid=".$uniacid." and a.jigou_two=".$hid;
      if($keyword != '' && $keyword != 'undefined')
      {
        $where .= " and a.sname like '%$keyword%'";
      }
      $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
      
      $list = pdo_fetchall("SELECT a.sname,a.sthumb,a.smoney,a.sid,a.spxl,b.fid,b.fenlname FROM".tablename('hyb_yl_goodsarr')."as a left join ".tablename('hyb_yl_goodsfenl')."as b on b.fid=a.g_id ".$where." order by sid desc limit ".$pages.",10");
      foreach($list as &$value)
      {
        $value['sthumb'] = tomedia($value['sthumb']);
      }
      echo json_encode($list);
    }
    //查询机构套餐
    public function taocan()
    {
      global $_W,$_GPC;
      $page = $_GPC['page'];
      $openid = $_GPC['openid'];
      $pages = $page * 10;
      $uniacid = $_W['uniacid'];
      $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
      $hid = '"'.$hid.'"';
      $list = pdo_fetchall("select * from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and hid like '%$hid%' order by id desc limit ".$pages.",10");

      echo json_encode($list);
    }

    //查询机构专家
    public function hospital_zhuanjia()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $page = $_GPC['page'];
      $pages = $page * 10;
      $parentid = $_GPC['parentid'];
      $keyword = $_GPC['keyword'];
      $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
      $where =  "where uniacid=".$uniacid." and hid=".$hid." and parentid=".$parentid;
      if($keyword != '')
      {
        $where .= " and z_name like '%$keyword%'";
      }
      $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
      $list = pdo_fetchall("select * from ".tablename("hyb_yl_zhuanjia").$where." order by zid limit ".$pages.",10");
      
      foreach($list as &$value)
      {
        $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("uniacid"=>$uniacid,"id"=>$value['parentid']),'name');
        $value['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$value['hid']),'agentname');
        $value['jingxuan'] = explode(",",$value['jingxuan']);

        $value['grade'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'grade');
        $value['advertisement'] = tomedia($value['advertisement']);
        $value['leve'] = pdo_getcolumn("hyb_yl_hospital_level",array("id"=>$value['grade']),'level_name');
        $value['server'] = pdo_getall("hyb_yl_doc_all_serverlist",array("zid"=>$value['zid'],"uniacid"=>$uniacid,"stateback"=>'1'));

        $value['job'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
        

      }
      echo json_encode($list);
    }
    // 查询订单分类
    public function server_list()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $server = pdo_fetchall("select * from ".tablename("hyb_yl_docser_speck")." where uniacid=".$uniacid." and key_words != 'kuaisuwenzhen' and key_words != 'sirenyisheng'");
      $goods = array(
        'key_words' => 'goods',
        'titlme' => '产品订单',
      );
      array_push($server,$goods);
      echo json_encode($server);
    }
    //查询机构患者
    public function hospital_user()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $page = $_GPC['page'];
      $pages = $page * 10;
      $keyword = $_GPC['keyword'];
      $parentid = $_GPC['parentid'];
      $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
      $zjs = "";
      $zj_arr = pdo_getall("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"hid"=>$hid,"parentid"=>$parentid),'zid');
      if(count($zj_arr) > 0)
      {
        foreach($zj_arr as &$zj)
        {
            $zjs .= $zj['zid'].",";
        }
        $zjs = substr($zjs,0,strlen($zjs)-1);
        $list = pdo_fetchall("select a.biaoqian,b.u_name,b.u_label,c.sex,c.age,c.gan_index,c.shen_index,c.names from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_userinfo")." as b on b.openid=a.openid left join ".tablename("hyb_yl_userjiaren")." as c on c.openid=a.openid where a.uniacid=".$uniacid." and a.zid in (".$zjs.") group by a.openid order by a.id desc limit ".$pages.",10");
      
      foreach($list as &$value)
      {
        if(!$value['u_label'])
        {
            $value['u_label'] = '暂无';
        }
        if(!$value['biaoqian'])
        {
            $value['u_biaoqian'] = '暂无';
        }else{
          $value['u_biaoqian'] = $value['biaoqian'];
        }
        $bingli = '';
        if($value['gan_index'] == '0')
        {
            $bingli .= "肝功能正常";
        }else{
            $bingli .= "肝功能不正常";
        }
        if($value['shen_index'] == '0')
        {
            $bingli .= ",肾功能正常";
        }else{
            $bingli .= ",肾功能不正常";
        }
        $value['bingli'] = $bingli;
      }
      
      }else{
        $list = array();
      }
      echo json_encode($list);
      
    }




}


