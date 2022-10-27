<?php
/**
* 
*/

 class Answer extends HYBPage
 { 
  // 列表页
  public function lists()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $keshi = $_GPC['keshi'];
    $keyword = $_GPC['keyword'];
    $label = $_GPC['label'];
    $where = " where a.uniacid=".$uniacid." and a.status=0";
    $where1 = " where a.uniacid=".$uniacid." and a.ifgk=1";
    if($keshi != '')
    {
      $where .= " and a.label like '%$label%'";
      $where1 .= " and z.authority like '%$label%'";
    }
    if($keyword != '')
    {
      $where .= " and a.title like '%$keyword%'";
      $where1 .= " and a.content like '%$keyword%'";
    }
    if($keshi != '')
    {
      $where .= " and a.keshi_two=".$keshi;
      $where1 .= " and z.parentid=".$keshi;
    }

    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $list = pdo_fetchall("select a.*,z.xn_reoly,z.advertisement,z.z_zhicheng,u.u_id from ".tablename("hyb_yl_answer")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." order by a.id desc limit ".$page * $pagesize .",".$pagesize);
    
    foreach($list as &$value)
    {
      $value['typs'] = 'answer';
      $value['names'] = '匿名用户'.$value['u_id'];
      $value['content'] = htmlspecialchars_decode($value['content']);
      $value['label'] = explode($value['label'], ',');
      $value['keshi_ones'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$value['keshi_one']),'ctname');
      $value['keshi_twos'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['keshi_two']),'name');
     
      if(strpos($value['advertisement'],'http') === false)
      {
        $value['advertisement'] = $_W['attachurl'].$value['advertisement'];
      }
      if($value['zid']  !=='0'){
        $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
        $value['help'] = $value['xn_reoly'];
      }else{
        $value['advertisement'] = $_W['siteroot']."addons/hyb_yl/web/resource/images/zhuanjia.png";
        $value['zhicheng'] = "";
        $value['help'] = rand(1,80);
      }
    }
    
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
  // // 获取科室二级分类
  // public function keshi_two()
  // {
  //   global $_W,$_GPC;
  //   $id = $_GPC['id'];
  //   $uniacid = $_W['uniacid'];
  //   $list = pdo_getall("hyb_yl_ceshi",array("uniacid"=>$uniacid,"giftstatus"=>$id));
  //   echo json_encode($list);
  // }
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
  // 问题详情页
  public function answer_detail()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $typs = $_GPC['typs'];
    $state = $_GPC['state'];
    $openid = $_GPC['openid'];
    if($openid != '')
    {
      $user = pdo_get("hyb_yl_userinfo",array("uniacid"=>$uniacid,"openid"=>$openid));
      if($user['adminuserdj'] != '0' && $user['adminguanbi'] > time())
      {
        $is_vip = true;
      }else{
        $is_vip = false;
      }
    }else{
      $is_vip = false;
    }

    if($state == '2')
    {

      $allrwo = pdo_get("hyb_yl_answer",array("id"=>$id));
      $allrwo['created'] = date("Y-m-d H:i:s",$allrwo['created']);
      $allrwo['content'] = htmlspecialchars_decode($allrwo['content']);
      $allrwo['label'] = explode($allrwo['label'], ',');
      if($allrwo['zid'] == '0')
        {
            $allrwo['advertisement'] = $_W['siteroot']."addons/hyb_yl/web/resource/images/zhuanjia.png";
        }
      $allrwo['keshi_ones'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$allrwo['keshi_one']),'ctname');
      $allrwo['keshi_twos'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$allrwo['keshi_two']),'name');
      if($arrrwo['zid'] != '0')
      {
        $score = pdo_fetch("select count(*) as count,sum(starsnum) as sum from ".tablename("hyb_yl_pingjia")." where zid=".$zid);
        if($score['count'] > 0)
        {
          $allrwo['score'] = ceil($score['sum'] / $score['count']);
        }else{
          $allrwo['score'] = 5;
        }

        $server = pdo_get("hyb_yl_doc_all_serverlist",array("zid"=>$zid,"key_words"=>'tuwenwenzhen'));
        if($is_vip)
        {
          $allrwo['server'] = $server['hymoney'];
        }else{
          $allrwo['server'] = $server['ptmoney'];
        }
        
      }else{
        $allrwo['score'] = 5;
      }
    }

   if($state == '1')
    {
    
     
      $res = pdo_fetch("SELECT a.*,b.z_name,b.advertisement,b.z_zhicheng,b.parentid,b.qx_id,b.zid,b.z_name,b.hid  FROM".tablename('hyb_yl_answer')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid where a.uniacid='{$uniacid}' and a.id='{$id}'");



      if($res['keyword'] == 'dianhuajizhen' || $res['keyword'] == 'shipinwenzhen'){
        $back_orser = $res['orders'];
        $allrwo = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_wenzorder')."where uniacid='{$uniacid}' and back_orser='{$back_orser}'");
      }
      if($res['keyword'] == 'tuwenwenzhen'){
        $back_orser = $res['orders'];
        $allrwo = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_twenorder')."where uniacid='{$uniacid}' and back_orser='{$back_orser}'");


      }
      if($res['keyword'] == 'yuanchengkaifang'){
        $back_orser = $res['orders'];
        $allrwo = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_chufang')."where uniacid='{$uniacid}' and back_orser='{$back_orser}'");
      }
        $i=1;
      
      foreach($allrwo as $key => $value)
      {
        $allrwo[$key]['state'] = $res['state'];
        if($res['keyword'] == 'dianhuajizhen' || $res['keyword'] == 'shipinwenzhen'){
           $allrwo[$key]['content'] = unserialize($allrwo[$key]['describe']);
        }else{
           $allrwo[$key]['content'] = unserialize($allrwo[$key]['content']);
        }
        if($arrrwo[$key]['zid'] != '0')
        {
          $score = pdo_fetch("select count(*) as count,sum(starsnum) as sum from ".tablename("hyb_yl_pingjia")." where zid=".$zid);
          $pingjia = pdo_fetch("select * from ".tablename("hyb_yl_pingjia")." where zid=".$res['zid']." and orders='".$allrwo[$key]['orders']."'");
          
          $allrwo[$key]['pingjia'] = $pingjia;
          if($score['count'] > 0)
          {
            $allrwo[$key]['score'] = ceil($score['sum'] / $score['count']);
          }else{
            $allrwo[$key]['score'] = 5;
          }
          $server = pdo_get("hyb_yl_doc_all_serverlist",array("zid"=>$res['zid'],"key_words"=>'tuwenwenzhen'));
          if($is_vip)
          {
            $allrwo[$key]['server'] = $server['hymoney'];
          }else{
            $allrwo[$key]['server'] = $server['ptmoney'];
          }
          
          // $allrwo[$key]['server'] = pdo_getcolumn("hyb_yl_doc_all_serverlist",array("zid"=>$res['zid'],"key_words"=>'tuwenwenzhen'),'money');
          
          
        }else{
          $allrwo[$key]['score'] = 5;
        }
        $allrwo[$key]['paytime'] = date("Y-m-d",$allrwo[$key]['paytime']);
        $allrwo[$key]['xdtime'] = date("m月d日 H:i",$allrwo[$key]['xdtime']);
        $allrwo[$key]['help'] = $res['xn_reoly'];
        $allrwo[$key]['advertisement'] = tomedia($res['advertisement']);
        $allrwo[$key]['z_name'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$res['zid']),'z_name');
        $allrwo[$key]['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$res['z_zhicheng']),'job_name');
        $allrwo[$key]['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$res['parentid']),'name');
        $allrwo[$key]['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$res['hid']),'agentname');
       
        if($allrwo[$key]['role'] =='0'){
          $allrwo[$key]['len'] = $i++;
        }
      }
      
    }

    echo json_encode($allrwo);
  }
  
  // 获取症状分类
  public function zhengzhuan_type()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $list = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'2'));
    echo json_encode($list);

  }
  // 获取标签
  public function labels()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $item = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$id),'description');

    $item = explode('、', $item);
    echo json_encode($item);
  }

  // 获取推荐疾病文章
  public function hot_tank()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $keyword = $_GPC['keyword'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $where = " where uniacid=".$uniacid." and is_index=1 and status=1";
    if($keyword != '')
    {
      $where .= " and (title like '%$keyword%' or content like '%$keyword%' or detail like '%$keyword%' or symptom like '%$keyword%' or reason like '%$keyword%' or diagnosis like '%$keyword%' or treatment like '%$keyword%' or life like '%$keyword%' or prevention like '%$keyword%')";
    }
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_tank").$where." order by id desc limit ".$page * $pagesize.",".$pagesize);
    
    foreach($list as &$value)
    {
      $value['content'] = htmlspecialchars_decode($value['content'],true);
      if(strpos($value['thumb'],'http') === false)
      {
        $value['thumb'] = $_W['attachurl'].$value['thumb'];
      }
    }
    echo json_encode($list);
  }
  public function tank_list()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $type = $_GPC['type'];
    $keyword = $_GPC['keyword'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $where = " where uniacid=".$uniacid." and status=1 and type=".$type;
    $keshi_two = $_GPC['keshi_two'];
    if($keshi_two != '')
    {
      $where .= " and keshi_two=".$keshi_two;
    }
    if($keyword != '')
    {
      $where .= " and (title like '%$keyword%' or content like '%$keyword%' or detail like '%$keyword%' or symptom like '%$keyword%' or reason like '%$keyword%' or diagnosis like '%$keyword%' or treatment like '%$keyword%' or life like '%$keyword%' or prevention like '%$keyword%')";
    }
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_tank").$where." order by sort desc limit ".$page * $pagesize.','.$pagesize);
    foreach($list as &$values)
    {
      $values['content'] = htmlspecialchars_decode($values['content'],true);
      if(strpos($values['thumb'],'http') === false)
      {
        $values['thumb'] = $_W['attachurl'].$values['thumb'];
      }
    }
    
    echo json_encode($list);
  }
  // 获取疾病外列表
  public function tanks()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $type = $_GPC['type'];
    $keyword = $_GPC['keyword'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $types = $type + 1;
    $type_arr = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>$types));
    
    $where = " where uniacid=".$uniacid." and status=1 and type=".$type;
    $keshi_two = $_GPC['keshi_two'];
    if($keshi_two != '')
    {
      $where .= " and keshi_two=".$keshi_two;
    }
    if($keyword != '')
    {
      $where .= " and (title like '%$keyword%' or content like '%$keyword%' or detail like '%$keyword%' or symptom like '%$keyword%' or reason like '%$keyword%' or diagnosis like '%$keyword%' or treatment like '%$keyword%' or life like '%$keyword%' or prevention like '%$keyword%')";
    }
    foreach($type_arr as &$value)
    {
      $list = pdo_fetchall("select * from ".tablename("hyb_yl_tank").$where." and style=".$value['id']." order by sort desc");
      
      foreach($list as &$values)
      {
        $values['content'] = htmlspecialchars_decode($values['content'],true);
        if(strpos($values['thumb'],'http') === false)
        {
          $values['thumb'] = $_W['attachurl'].$values['thumb'];
        }
      }
      $value['list'] = $list;
    }

    $lists = array_slice($type_arr,$page * $pagesize,$pagesize);
    
    echo json_encode($lists);
  }
  // 获取幻灯片
  public function adv()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $position = $_GPC['position'];
    $position += 11; 
    $list = pdo_get("hyb_yl_adv",array("position"=>$position,'status'=>'1','uniacid'=>$uniacid));
    $list['thumb'] =tomedia($list['thumb']);
    echo json_encode($list);
    
  }
  // 获取症状列表
  public function zhengzhuan()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $type = $_GPC['keshi_one'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $zimu = pdo_fetchall("select distinct first from ".tablename("hyb_yl_tank")." where uniacid=".$uniacid." and style=".$type." and type=1");
    foreach($zimu as &$value)
    {
      $value['child'] = pdo_getall("hyb_yl_tank",array("uniacid"=>$uniacid,"style"=>$type,"type"=>'1',"first"=>$value));
    }
    

    echo json_encode($zimu);
   
  }
  // 获取疾病详情
  public function tank_detail()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $item = pdo_fetch("select t.*,z.z_name,u.u_name,u.u_thumb,z.advertisement,z_zhicheng,z.parentid from ".tablename("hyb_yl_tank")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=t.openid where t.uniacid=".$uniacid." and t.status=1 and t.id=".$id);
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
              'page'          => 'hyb_yl/twosubpages/pages/details/details',//二维码跳转路径（要已发布小程序）
              'auto_color'    => true
          );
          $result = $this->sendCmd($url,json_encode($qrcode));//请求微信接口
          
          $res = file_put_contents($file,$result);//将微信返回的图片数据流写入文件
          
          $datas = array('erweima' => $file);
          $getupdate = pdo_update("hyb_yl_tank", $datas, array('id' => $id, 'uniacid' => $uniacid));
          $item['erweima'] = $file;
      }else{
          $item['erweima'] = '';
   }
    if(strpos($item['thumb'],'http') === false)
    {
      $item['thumb'] = $_W['attachurl'].$item['thumb'];
    }
    $item['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$item['parentid']),'name');
    $item['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$item['z_zhicheng']),'job_name');
    $item['created'] = date("Y-m-d H:i:s",$item['created']);
    $item['imgpath'] = json_decode($item['imgpath'],true);
    $item['content'] = htmlspecialchars_decode($item['content'],true);
    $item['detail'] = htmlspecialchars_decode($item['content'],true);
    $item['symptom'] = htmlspecialchars_decode($item['symptom'],true);
    $item['reason'] = htmlspecialchars_decode($item['reason'],true);
    $item['diagnosis'] = htmlspecialchars_decode($item['diagnosis'],true);
    $item['treatment'] = htmlspecialchars_decode($item['treatment'],true);
    $item['life'] = htmlspecialchars_decode($item['life'],true);
    $item['prevention'] = htmlspecialchars_decode($item['prevention'],true);
    $item['share'] = tomedia($item['share']);
    $item['styles'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$item['style']),'ctname');
    
    $item['advertisement'] = tomedia($item['advertisement']);
    echo json_encode($item);
  }
  public function generate()
 {
    require_once dirname(dirname(dirname(__FILE__)))."/class/playbill.php";
    $model = new playbill();
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    
    $id = intval($_GPC['id']);
   $item = pdo_fetch("select t.*,z.z_name,u.u_name,u.u_thumb,z.advertisement,z_zhicheng,z.parentid from ".tablename("hyb_yl_tank")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=t.openid where t.uniacid=".$uniacid." and t.status=1 and t.id=".$id);

    $string = $item['title'];

    if(empty($item['haibao'])){
        $dir = iconv("UTF-8", "GBK", "../attachment/hyb_yl");
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        } 
        $config = array(
        'text'=>array(
            array(
              'text'=>$string,
              'left'=>50,
              'top'=>250,
              'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
              'fontSize'=>30,             //字号
              'fontColor'=>'255,255,255',       //字体颜色
              'angle'=>0,
            )
          ),
          'image'=>array(
            array(
              'url'=>$item['erweima'],     //二维码资源
              'stream'=>0,
              'left'=>400,
              'top'=>-40,
              'right'=>0,
              'bottom'=>0,
              'width'=>178,
              'height'=>178,
              'opacity'=>100
            )
          ),
          'background'=>'../addons/hyb_yl/public/images/erweima.jpg'          //背景图
        );
        $image_name = md5(uniqid(rand())).".jpg";
        $filename = "../attachment/hyb_yl/{$image_name}";
        $filename_back = "attachment/hyb_yl/{$image_name}";
        $res = $model->createPoster($config,$filename);

        $img = tomedia('hyb_yl/'.$image_name);
        $datas = array('haibao' => $filename_back);

        $getupdate = pdo_update("hyb_yl_tank", $datas, array('id' => $id, 'uniacid' => $uniacid));
        echo json_encode($img);
    }else{
        echo json_encode($_W['siteroot'].$item['haibao']);
    }

 } 
  // 详情页获取信息
  public function getdocor()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $item = pdo_fetch("select t.*,z.z_name,u.u_name,u.u_thumb,z.advertisement,z_zhicheng,z.parentid,z.hid from ".tablename("hyb_yl_tank")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=t.openid where t.uniacid=".$uniacid." and t.status=1 and t.id=".$id);
    $zhuanjia = pdo_fetchall("select * from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and parentid=".$item['keshi_two']." order by zid desc limit ".$page * $pagesize.",".$pagesize);
    foreach($zhuanjia as &$value)
    {
      $value['advertisement'] = tomedia($value['advertisement']);
      $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
      $value['keshi_twos'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
      $value['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
      $value['plugin'] = unserialize($value['plugin']);
    }
    echo json_encode($zhuanjia);
  }
  // 详情页获取资讯
  public function getzixun()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $item = pdo_fetch("select t.*,z.z_name,u.u_name,u.u_thumb,z.advertisement,z_zhicheng,z.parentid from ".tablename("hyb_yl_tank")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=t.openid where t.uniacid=".$uniacid." and t.status=1 and t.id=".$id);
    $zixun = pdo_fetchall("select * from ".tablename("hyb_yl_zixun")." where uniacid=".$uniacid." and keshi_two=".$item['keshi_two']." order by id desc limit ".$page * $pagesize.",".$pagesize);
    foreach($zixun as &$value)
    {
        $value['thumb'] = tomedia($value['thumb']);
        $cx_name = strip_tags(htmlspecialchars_decode($value['content']));
        $cx_name = str_replace(PHP_EOL, '',  $cx_name);
        $cx_name = str_replace(array("&nbsp;", "&ensp;", "&emsp;","&thinsp;","&zwnj;","&zwj;","&ldquo;","&rdquo;"), "", $cx_name);

        $value['content'] = mb_substr($cx_name,1,20,'UTF-8');
          
    }
    echo json_encode($zixun);
  }
  // 详情页获取问答
  public function getAnswer()
  {
     global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $item = pdo_fetch("select t.*,z.z_name,u.u_name,u.u_thumb,z.advertisement,z_zhicheng,z.parentid from ".tablename("hyb_yl_tank")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=t.openid where t.uniacid=".$uniacid." and t.status=1 and t.id=".$id);
    $answer = pdo_fetchall("select * from ".tablename("hyb_yl_answer")." where uniacid=".$uniacid." and keshi_two=".$item['keshi_two']." order by id desc limit ".$page * $pagesize.",".$pagesize);
    foreach($answer as &$values)
    {
      $user = pdo_get("hyb_yl_userinfo",array("openid"=>$values['openid']));
      $values['u_name'] = "匿名用户".$user['u_id'];
      $values['u_thumb'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$values['openid']),'u_thumb');
      $values['created'] = date("Y-m-d H:i:s",$values['created']);
      $content = unserialize($values['content']);
      if(is_array($content))
      {
        $values['content'] = $content['text'];
      }else{
        $values['content'] = $values['content'];
      }
      

    }
    echo json_encode($answer);
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

    //生成小程序二维码
      public function erweima()
     {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model =  Model('answer');
         $id = intval($_GPC['id']);
         $get_one_info =$model->where('uniacid="'.$uniacid.'" and id ="'.$id.'"')->get('id,erweima');
         $typs=$_GPC['typs'];
         $state=$_GPC['state']; 
         if(empty($get_one_info['erweima'])){
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
                    'scene'         => $id.'&typs='.$typs.'&state='.$state,//二维码所带参数
                    'width'         => 200,
                    'page'          => 'hyb_yl/twosubpages/pages/publicProblemsInfor/publicProblemsInfor',//二维码跳转路径（要已发布小程序）
                    'auto_color'    => true
                );
                $result = $this->sendCmd($url,json_encode($qrcode));//请求微信接口
                $res = file_put_contents($file,$result);//将微信返回的图片数据流写入文件
                $u_phone = pdo_getcolumn('hyb_yl_answer', array('id' => $id), 'erweima');
                $datas = array('erweima' => $file);
                $getupdate = pdo_update("hyb_yl_answer", $datas, array('id' => $id, 'uniacid' => $uniacid));
                echo json_encode($getupdate);
            }else{
                echo "1";
         }
     } 
     //分享海报
    public function generate2()
     {
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $model_zi =  Model('answer');
        $id = intval($_GPC['id']);

        $get_one_info = $model_zi->where('uniacid="'.$uniacid.'" and id ="'.$id.'"')->get('id,erweima,haibao,title');
        $string = $get_one_info['title'];


        require_once dirname(dirname(dirname(__FILE__)))."/class/playbill.php";
        $model = new playbill();
        if(empty($get_one_info['haibao'])){
            $dir = iconv("UTF-8", "GBK", "../attachment/hyb_yl");
            if (!file_exists($dir)){
                mkdir ($dir,0777,true);
            } 
            $config = array(
            'text'=>array(
                array(
                  'text'=>$string,
                  'left'=>50,
                  'top'=>250,
                  'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                  'fontSize'=>30,             //字号
                  'fontColor'=>'255,255,255',       //字体颜色
                  'angle'=>0,
                )
              ),
              'image'=>array(
                array(
                  'url'=>$get_one_info['erweima'],     //二维码资源
                  'stream'=>0,
                  'left'=>400,
                  'top'=>-40,
                  'right'=>0,
                  'bottom'=>0,
                  'width'=>178,
                  'height'=>178,
                  'opacity'=>100
                )
              ),
              'background'=>'../addons/hyb_yl/public/images/erweima.jpg'          //背景图
            );

            $image_name = md5(uniqid(rand())).".jpg";
            $filename = "../attachment/hyb_yl/{$image_name}";
            $filename_back = "attachment/hyb_yl/{$image_name}";
            $res = $model->createPoster($config,$filename);

            $img = tomedia('hyb_yl/'.$image_name);
            $u_phone = pdo_getcolumn('hyb_yl_answer', array('id' => $id), 'haibao');
            $datas = array('haibao' => $filename_back);
            $getupdate = pdo_update("hyb_yl_answer", $datas, array('id' => $id, 'uniacid' => $uniacid));
            echo json_encode($img);
        }else{
            echo json_encode($_W['siteroot'].$get_one_info['haibao']);
        }

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


