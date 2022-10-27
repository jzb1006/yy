<?php
require_once dirname(dirname(dirname(__FILE__)))."/class/playbill.php";
$playbill = new playbill();
global $_W,$_GPC;
$op = $_GPC['op'];
$uniacid = $_W['uniacid'];
 $_W['plugin'] ='order';
 if(!empty($_GPC['hid']))
{
  $lifeTime = 24 * 3600; 
  session_set_cookie_params($lifeTime); 
  session_start();
  $_SESSION["is_hospital"] = '1'; 
  $_SESSION['hid'] = $_GPC['hid'];
  define("is_agent",'1');
  define("hid",$_GPC['hid']);
  $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>hid));
  $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
  $role = unserialize($role);
  $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
  $zjs = '';
  foreach($zhuanjia as &$zj)
  {
    $zjs .= $zj['zid'].",";
  }
  $zjs = substr($zjs,0,strlen($zjs)-1);
  define('zid', $zjs);
}
if($op == 'index')
{
    include $this->template("order/kcorder");
}
if($op == 'add')
{
    include $this->template("order/add");
}
//课程订单
if($op == 'kcorder')
{
    include $this->template("order/kcorder");
}
//课程订单
if($op == 'kcorderxq')
{
    include $this->template("order/kcorderxq");
}

//检查
if($op == 'jcorder')
{
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $where = " where a.uniacid=".$uniacid;
    $ifpay = $_GPC['ifpay'];
    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];
    $timetype = $_GPC['timetype'];
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
    $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    if($ifpay != '')
    {
        $where .= " and a.ifpay=".$ifpay;
    }
    if($keywordtype == '1')
    {
        $where .= " and a.orderNo like '%$keyword%'";
    }else if($keywordtype == '2')
    {
        $where .= " and u.u_name like '%$keyword%'";
    }


    $list = pdo_fetchall("select a.*,u.u_name,u_thumb,u.u_id from ".tablename("hyb_yl_dingjingorders")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

    foreach($list as &$value)
    { 
        $orders = $value['orderNo'];
        $idarr= unserialize($value['sid']);
        $sid = $idarr['sid'];
        $status = $value['status'];
        if($status==0){
               $hid = pdo_getcolumn('hyb_yl_dingjingitem',array('id'=>$sid),array('hid'));
        }else{
               $hid = pdo_getcolumn('hyb_yl_yinxiangitem',array('id'=>$sid),array('hid'));
        }
        $value['time'] = date("Y-m-d H:i:s",$value['time']);
        $taocan = pdo_get('hyb_yl_yinxiangitem',array('id'=>$sid));
        $value['taocan'] = pdo_get('hyb_yl_yinxiangitem',array('id'=>$sid));
        $value['sthumb'] = tomedia($taocan['sthumb']);
        $value['status'] = $status;
        // $type = $value['taocan']['type'];
        // $value['taocan']['tcclass'] = pdo_getcolumn('hyb_yl_taocan_cate',array('id'=>$type),array('title'));
        // //体检机构
  
        $value['agentname'] =pdo_getcolumn('hyb_yl_hospital',array('hid'=>$hid),array('agentname'));
    }

    $total = pdo_fetchcolumn("select count(a.*) from ".tablename("hyb_yl_dingjingorders")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where);

    $count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_dingjingorders")." where uniacid=".$uniacid);
    $money = pdo_fetchcolumn("select sum(totalMoney) from ".tablename("hyb_yl_dingjingorders")." where uniacid=".$uniacid);
    if($money == NULL)
    {
        $money = '0.00';
    }

    $pager = pagination($total, $pageindex, $pagesize);
    include $this->template("order/jcorder");
}

//体检订单
if($op == 'tjorder')
{
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $where = " where a.uniacid=".$uniacid;
    $ifpay = $_GPC['ifpay'];
    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];
    $timetype = $_GPC['timetype'];
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
    $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    if($ifpay != '')
    {
        $where .= " and a.ifpay=".$ifpay;
    }
    if($keywordtype == '1')
    {
        $where .= " and a.ordernums like '%$keyword%'";
    }else if($keywordtype == '2')
    {
        $where .= " and u.u_name like '%$keyword%'";
    }
    if($timetype == '1')
    {
        $where .= " and a.time >=".strtotime($start)." and a.time <=".strtotime($end);
    }else if($timetype == '2')
    {
        $where .= " and a.yy_time >=".$start." and a.yy_time <=".$end;
    }
    if(is_agent == '1')
    {
        if($zjs != '')
        {
            $where .= " and a.zid in (".$zjs.")";
        }else{
            $where .= " and a.zid is NULL";
        } 
    }
    $list = pdo_fetchall("select a.*,u.u_name,u_thumb,u.u_id from ".tablename("hyb_yl_tijianorder")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

    foreach($list as &$value)
    { 
        $orders = $value['ordernums'];
        $list[$key]['tkmoney'] = pdo_fetchcolumn("SELECT SUM(money) FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and orders='{$orders}'");
        $tid =$value['tid'];
        $value['u_tel'] = pdo_getcolumn("hyb_yl_userjiaren",array("openid"=>$value['openid']),'tel');
        $value['time'] = date("Y-m-d H:i:s",$value['time']);
        $value['taocan'] = pdo_get('hyb_yl_taocan',array('id'=>$tid),array('title','thumb','type'));
        $type = $value['taocan']['type'];
        $value['taocan']['tcclass'] = pdo_getcolumn('hyb_yl_taocan_cate',array('id'=>$type),array('title'));
        //体检机构
        $bm_id = $value['bm_id'];
  
        $value['agentname'] =pdo_getcolumn('hyb_yl_hospital',array('hid'=>$bm_id),array('agentname'));
    }

    $total = pdo_fetchcolumn("select count(a.*) from ".tablename("hyb_yl_tijianorder")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where);
    if(is_agent == '1')
    {
        if($zjs != '')
        {
            $wheres = " and zid in (".$zjs.")";
        }else{
            $wheres = " and zid is NULL";
        } 
    }else{
        $wheres = "";
    }
    $count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid.$wheres);
    $money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid.$wheres);
    if($money == NULL)
    {
        $money = '0.00';
    }

    $pager = pagination($total, $pageindex, $pagesize);
    include $this->template("order/tjorder");
}

// 导出报告
if($op == 'export')
{
    $where = " where a.uniacid=".$uniacid;
    if(is_agent == '1')
    {
        if($zjs != '')
        {
            $where .= " and a.zid in (".$zjs.")";
        }else{
            $where .= " and a.zid is NULL";
        }
        
    }
    $list = pdo_fetchall("select a.*,u.u_name,u_thumb,u.u_id from ".tablename("hyb_yl_tijianorder")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." order by a.id desc");
   
    foreach($list as &$value)
    { 

        $tid =$value['tid'];
        $value['u_tel'] = pdo_getcolumn("hyb_yl_userjiaren",array("openid"=>$value['openid']),'tel');
        $value['time'] = date("Y-m-d H:i:s",$value['time']);
        $value['taocan'] = pdo_get('hyb_yl_taocan',array('id'=>$tid),array('title','thumb','type'));
        $type = $value['taocan']['type'];
        $value['taocan']['tcclass'] = pdo_getcolumn('hyb_yl_taocan_cate',array('id'=>$type),array('title'));
        //体检机构
        $hid = $bm_id = $value['bm_id'];
  
        $value['agentname'] =pdo_getcolumn('hyb_yl_hospital',array('hid'=>$bm_id),array('agentname'));
         $j_id =$value['j_id']; 
         $zid = $value['zid'];
         $user =  pdo_get('hyb_yl_userjiaren',array('j_id'=>$j_id));
         $data = unserialize($value['data']);
         $content = unserialize($value['content']);
         $doc = pdo_get('hyb_yl_zhuanjia',array('zid'=>$zid));
         $jigou = pdo_get('hyb_yl_hospital',array('hid'=>$hid));
         $keshi_one = pdo_getcolumn("hyb_yl_classgory",array("uniacid"=>$uniacid,"id"=>$doc['z_room']),'ctname');
         $keshi_two = pdo_getcolumn("hyb_yl_ceshi",array("uniacid"=>$uniacid,"id"=>$doc['parentid']),'name');
         
        $dir = iconv("UTF-8", "GBK", "../attachment/hyb_yl/tijian_{$uniacid}");
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        } 
        
        if($value['imgpath'] == '')
        {
            $config = array(
                'name'=>array(
                    array(
                        'text'=>$user['names'],
                        'left'=>90,
                        'top'=>175,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'sex'=>array(
                    array(
                        'text'=>$user['sex'],
                        'left'=>290,
                        'top'=>175,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'age'=>array(
                    array(
                        'text'=>$user['age']."岁",
                        'left'=>470,
                        'top'=>175,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'keshi'=>array(
                    array(
                        'text'=>$keshi_one."(".$keshi_two.")",
                        'left'=>670,
                        'top'=>175,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'feiyong'=>array(
                    array(
                        'text'=>"自费",
                        'left'=>850,
                        'top'=>175,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'bingli'=>array(
                    array(
                        'text'=>$user['numcard'],
                        'left'=>100,
                        'top'=>210,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'address'=>array(
                    array(
                        'text'=>$user['region'],
                        'left'=>380,
                        'top'=>210,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'telphone'=>array(
                    array(
                        'text'=>$user['tel'],
                        'left'=>790,
                        'top'=>210,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'contents'=>array(
                    array(
                        'text'=>$data['text'],
                        'left'=>120,
                        'top'=>245,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'time'=>array(
                    array(
                        'text'=>$value['wactime'],
                        'left'=>740,
                        'top'=>245,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'z_name'=>array(
                    array(
                        'text'=>$doc['z_name'],
                        'left'=>100,
                        'top'=>575,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'sh_name'=>array(
                    array(
                        'text'=>$doc['z_name'],
                        'left'=>340,
                        'top'=>575,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'zx_name'=>array(
                    array(
                        'text'=>$doc['z_name'],
                        'left'=>580,
                        'top'=>575,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'money'=>array(
                    array(
                        'text'=>$value['money'],
                        'left'=>820,
                        'top'=>575,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                ),
                'background'=>'../addons/hyb_yl/public/images/tijian.png',         
            );
            foreach($content as $keys => $conts)
            {
                
                $arr['title'.$keys] = array(
                    array(
                        'text' => $conts['title']."   ".$conts['shuju']."/".$conts['unit']."  ".$conts['price']." ".$conts['content'],
                        'left'=>60,
                        'top'=>380 + $keys * 50,
                        'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                        'fontSize'=>12,             //字号
                        'fontColor'=>'0,0,0',       //字体颜色
                        'angle'=>0,
                    ),
                );
            }
            $config = array_merge($config,$arr);

          
          $image_name = "tijian_".$value['id'] . ".jpg";
          $filename = "../attachment/hyb_yl/tijian_{$uniacid}/{$image_name}";
          $filename_back = "attachment/hyb_yl/tijian_{$uniacid}/{$image_name}";
          
          $playbill->createtijian($config,$filename,$content);
          pdo_update("hyb_yl_tijianorder",array("imgpath"=>$filename_back),array("id"=>$value['id']));
        }
    }
    message("生成成功!",$this->createWebUrl("order",array("op"=>"tjorder",'ac'=>'tjorder')),"success");
}
// 生成压缩包
// 压缩二维码
    if($op == 'zips')
    {
        date_default_timezone_set("PRC");
        ini_set('max_execution_time',0);
        // 不限制内存使用
        ini_set('memory_limit',-1);
        
        require_once dirname(dirname(dirname(__FILE__)))."/zip.php";
        $zip = new zip();
        //PHP压缩文件夹为zip压缩文件
       
       
        if($zip->zipFolder("../attachment/hyb_yl/tijian_{$uniacid}","../attachment/hyb_yl/tijian_".date("Y-m-d",time()).".zip")){
                echo '成功压缩了文件夹。';
        }else{
                echo '文件夹没有压缩成功。';
        }

        ob_end_clean();
        header("Content-Type: application/force-download");
        header("Content-Transfer-Encoding: binary");
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename='.basename("../attachment/hyb_yl/tijian_".date("Y-m-d",time()).".zip"));
        header('Content-Length: '.filesize("../attachment/hyb_yl/tijian_".date("Y-m-d",time()).".zip"));
        error_reporting(0);
        @readfile("../attachment/hyb_yl/tijian_".date("Y-m-d",time()).".zip");
        flush();
        ob_flush();
        exit;
    }
//体检订单
if($op == 'tjorderxq')
{
    $id = $_GPC['id'];
    $hid = $_GPC['hid'];
    $item = pdo_fetch("select t.*,u.u_id,u.u_name,u.u_thumb from ".tablename("hyb_yl_tijianorder")." as t left join ".tablename("hyb_yl_userinfo")." as u on u.openid=t.openid where t.uniacid=".$uniacid." and t.id=".$id,array("id"=>$id));
    $user = pdo_get("hyb_yl_userjiaren",array("openid"=>$item['openid']));
    $item['time'] = date("Y-m-d H:i:s",$item['time']);
    include $this->template("order/tjorderxq");
}
if($op == 'jcorderxq')
{
    $id = $_GPC['id'];
    $hid = $_GPC['hid'];
    $item = pdo_fetch("select t.*,u.u_id,u.u_name,u.u_thumb from ".tablename("hyb_yl_tijianorder")." as t left join ".tablename("hyb_yl_userinfo")." as u on u.openid=t.openid where t.uniacid=".$uniacid." and t.id=".$id,array("id"=>$id));
    $user = pdo_get("hyb_yl_userjiaren",array("openid"=>$item['openid']));
    $item['time'] = date("Y-m-d H:i:s",$item['time']);
    include $this->template("order/tjorderxq");
}
if($op == 'jianchaorder')
{
    $id = $_GPC['id'];
    $hid = $_GPC['hid'];
    $item = pdo_fetch("select t.u_id as aj_id,t.*,u.u_id as uu_id,u.u_name,u.u_thumb from ".tablename("hyb_yl_dingjingorders")." as t left join ".tablename("hyb_yl_userinfo")." as u on u.openid=t.openid where t.uniacid=".$uniacid." and t.id=".$id,array("id"=>$id));
 

    $item['time'] = date("Y-m-d H:i:s",$item['time']);
    $j_id =$item['aj_id'];
    $item['user'] = pdo_get('hyb_yl_userjiaren',array('j_id'=>$j_id));
    
    $hospital = unserialize($item['sid']); 
    $sid = $hospital[0]['sid'];
    $status = $item['status'];
   //0鼎晶生物1影像检查
    if($status=='0'){
        $item['cp'] = pdo_get('hyb_yl_dingjingitem',array('id'=>$sid)); 
    }else{
        $item['cp'] = pdo_get('hyb_yl_yinxiangitem',array('id'=>$sid)); 
    } 
    
    include $this->template("order/jianchaorder");
}
if($op == 'queren')
{
    $id = $_GPC['id'];
    $hid = $_GPC['hid'];
    pdo_update('hyb_yl_dingjingorders',array('orderStatus'=>0,'paytime'=>date('Y-m-d H:i:s')),array('id'=>$id));
    message("更新成功!",$this->createWebUrl("order",array("op"=>"jcorder",'ac'=>'jcorder')),"success");
}
if($op == 'shangchuan')
{
    $id= $_GPC['id'];
    $datas = pdo_get('hyb_yl_dingjingorders',array('id'=>$id),array('id','content','thumbarr'));

    load()->func('file'); //调用上传函数
    $dir_url=$_SERVER['DOCUMENT_ROOT'].'/web/tijianpdf/'; //上传路径
    mkdirs($dir_url); 
    //创建目录
    if ($_FILES["upfile"]["name"]){
        $upfile=$_FILES["upfile"]; 
        //获取数组里面的值 
        $name=$upfile["name"];//上传文件的文件名 
        $size=$upfile["size"];//上传文件的大小 

        if($size>12*1024*1024) {  
            message("文件过大，不能上传大于2M的文件!",$this->createWebUrl("pay",array("op"=>"display")),"success"); 
            exit();  
        } 
        if(file_exists($dir_url))@unlink ($dir_url);

        $cfg['upfile']=TIMESTAMP.".pdf";
        move_uploaded_file($_FILES["upfile"]["tmp_name"],$dir_url.$upfile["name"]); //移动到目录下
        $upfiles = 'web/tijianpdf/'.$name;
        
    }   
    if($_W['ispost']){
    
        if($id && !empty($datas['thumbarr'])){
           $upfiles = $_GPC['thumbarr'];
        }else{
           $upfiles;
        }
        $data = array(
               'thumbarr' =>$upfiles,
               'content'  =>$_GPC['content'],
               'orderStatus'=>2,
               'deliveryTime'=>date('Y-m-d H:i:s')
            );
       pdo_update('hyb_yl_dingjingorders',$data,array('id'=>$id));
       message("更新成功!",$this->createWebUrl("order",array("op"=>"jcorder",'ac'=>'jcorder')),"success");
    }    
 include $this->template("order/shangchuan");
}


//药品订单
if($op == 'yporder')
{
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $where = " where a.uniacid=".$uniacid;
    $orderStatus = $_GPC['orderStatus'];
    $isRefund = $_GPC['isRefund'];
    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];
    $isPay = $_GPC['isPay'];
    $timetype = $_GPC['timetype'];
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
    $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    $export = $_GPC['export'];
    
 

    if($isRefund != '')
    {
        $where .= " and a.isRefund=".$isRefund;
    }
    if($isPay != '')
    {
        $where .= " and a.isPay=".$isPay;
    }
    if($orderStatus != '')
    {
        $where .= " and a.orderStatus=".$orderStatus;
    }
    if($keywordtype == '1')
    {
        $where .= " and a.orderNo like '%$keyword%'";
    }else if($keywordtype == '2')
    {
        $where .= " and a.sid REGEXP '$keyword'";
    }else if($keywordtype == '3')
    {
        $where .= " and u.u_name like '%$keyword%'";

    }else if($keywordtype == '4')
    {
        $where .= " and u.u_phone like '%$keyword%'";
    }
    $where .= " and a.createTime >='".$start."' and a.createTime <='".$end."'";
    if(is_agent == '1')
    {
        if($zjs != '')
        {
            $where .= " and a.zid in (".$zjs.")";
        }else{
            $where .= " and a.zid is NULL";
        }
        
    }
   
    $list = pdo_fetchall("select a.*,u.u_name,u_thumb,u.u_id from ".tablename("hyb_yl_goodsorders")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    

    foreach($list as $key => $value)
    {
         $goods = unserialize($value['sid']);
    

       // $goodscount = count($result2);
   
        //查询药品分销金额
        $orders = $value['orderNo'];
        $list[$key]['tkmoney'] = pdo_fetchcolumn("SELECT SUM(money) FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and orders='{$orders}'");
        foreach ($goods as $k => $v) {
            $v['u_tel'] = pdo_getcolumn("hyb_yl_user_address",array("openid"=>$value['openid']),'userPhone');
            $v['time'] = date("Y-m-d H:i:s",$value['time']);
            $gnum = intval($v['num']);
            $sum += $gnum;
            $money2 = floatval($v['smoney']);
            $money3 = ($gnum*$money2);
            $money4 +=$money3;
           
        }
        $list[$key]['goods'] = $goods;
    }

    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where);
    if(is_agent == '1')
    {
        if($zjs != '')
        {
            $wheres = " and zid in (".$zjs.")";
        }else{
            $wheres = " and zid is NULL";
        }
        
    }else{
        $wheres = "";
    }
    $count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid.$wheres);
    $money = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid.$wheres);

    if($money == NULL)
    {
        $money = '0.00';
    }
    
    $pager = pagination($total, $pageindex, $pagesize);
    
    include $this->template("order/yporder");
}
if($op == 'ypexport')
{
    $where = " where a.uniacid=".$uniacid;
    $orderStatus = $_GPC['orderStatus'];
    $isRefund = $_GPC['isRefund'];
    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];
    $isPay = $_GPC['isPay'];
    $timetype = $_GPC['timetype'];
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
    $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    if($isRefund != '')
    {
        $where .= " and a.isRefund=".$isRefund;
    }
    if($isPay != '')
    {
        $where .= " and a.isPay=".$isPay;
    }
    if($orderStatus != '')
    {
        $where .= " and a.orderStatus=".$orderStatus;
    }
    if($keywordtype == '1')
    {
        $where .= " and a.orderNo like '%$keyword%'";
    }else if($keywordtype == '2')
    {
        $where .= " and g.sname like '%$keyword%'";
    }else if($keywordtype == '3')
    {
        $where .= " and u.u_name like '%$keyword%'";

    }else if($keywordtype == '4')
    {
        $where .= " and u.u_phone like '%$keyword%'";
    }
    if(is_agent == '1')
    {
        if($zjs != '')
        {
            $where .= " and a.zid in (".$zjs.")";
        }else{
            $where .= " and a.zid is NULL";
        }
        
    }
    $where .= " and a.createTime >='".$start."' and a.createTime <='".$end."'";
    $list = pdo_fetchall("select a.*,u.u_name,u_thumb,u.u_id from ".tablename("hyb_yl_goodsorders")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where);

    //实例化
    $objPHPExcel = new PHPExcel();
    /*右键属性所显示的信息*/
    $objPHPExcel->getProperties()->setCreator("管理员")  //作者
    ->setLastModifiedBy("管理员")  //最后一次保存者
    ->setTitle('药品订单表')  //标题
    ->setSubject('药品订单表') //主题
    ->setDescription('药品订单表')  //描述
    ->setKeywords("excel")   //标记
    ->setCategory("result file");  //类别

    //设置当前的表格
    $objPHPExcel->setActiveSheetIndex(0);
    // 设置表格第一行显示内容
    $objPHPExcel->getActiveSheet()
        ->setCellValue('A1', '订单编号')
        ->setCellValue('B1', '商品名称')
        ->setCellValue('C1', '订单价格')
        ->setCellValue('D1', '规格名称')
        ->setCellValue('E1', '购买数量')
        ->setCellValue('F1', '买家姓名')
        ->setCellValue('G1', '订单状态')
        ->setCellValue('H1', '运费')
        ->setCellValue('I1', '实付金额')
        ->setCellValue('J1', '收货时间')
        ->setCellValue('K1', '发货时间')
        ->setCellValue('L1', '快递号')
        ->setCellValue('M1', '收货地址')
        //设置第一行为红色字体
        ->getStyle('A1:M1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

    $s = 1;
    //  /*以下就是对处理Excel里的数据，横着取数据*/
    foreach($lists as &$t){

        $goods = pdo_getcolumn("hyb_yl_goodsarr",array("sid"=>$t['sid']),'sname');
        
        $guige = pdo_getcolumn("hyb_yl_goodsguige",array("gg_id"=>$t['gg_id']),'gg_name');
        
        $t['goods'] = $goods;
        $t['guige'] = $guige;
        $t['u_tel'] = pdo_getcolumn("hyb_yl_userjiaren",array("openid"=>$t['openid']),'tel');
        $t['time'] = date("Y-m-d H:i:s",$t['time']);
        //匹配数值
        if($t['isPay'] == 0)
        {
            $t['statuss'] = '待支付';
        }elseif($t['isPay'] == 1)
        {
            $t['statuss'] = '已支付';
        }elseif($t['orderStatus'] == 2)
        {
            $t['statuss'] = '接诊中';
        }
        if($t['orderStatus'] == -3)
        {
            $t['statuss'] = '用户拒收';
        }elseif($t['orderStatus'] == -2)
        {
            $t['statuss'] = '未付款的订单';
        }elseif($t['orderStatus'] == -1)
        {
            $t['statuss'] = '用户取消';
        }elseif($t['orderStatus'] == 0)
        {
            $t['statuss'] = '待发货';
        }else if($t['orderStatus'] == '1')
        {
            $t['statuss'] = '配送中';
        }else if($t['orderStatus'] == '2')
        {
            $t['statuss'] = '用户确认收货';
        }

        //设置循环从第二行开始
        $s++;
        $objPHPExcel->getActiveSheet()

            //Excel的第A列，name是你查出数组的键值字段，下面以此类推
            ->setCellValue('A'.$s, $t['orderNo'])
            ->setCellValue('B'.$s, $t['goods'])
            ->setCellValue('C'.$s, $t['realTotalMoney'])
            ->setCellValue('D'.$s, $t['guige'])
            ->setCellValue('E'.$s, $t['num'])
            ->setCellValue('F'.$s, $t['u_name'])
            ->setCellValue('G'.$s, $t['names'])
            ->setCellValue('H'.$s, $t['tel'])
            ->setCellValue('I'.$s, $t['describe']['text'])
            ->setCellValue('J'.$s, '微信支付')
            ->setCellValue('K'.$s, $t['statuss'])
            ->setCellValue('L'.$s, $t['name']);

    }
    //设置当前的表格
    $objPHPExcel->setActiveSheetIndex(0);
    ob_end_clean();//清除缓冲区,避免乱码
    header('Content-Type: application/vnd.ms-excel'); //文件类型
    header('Content-Disposition: attachment;filename="'.$name.'.xls"'); //文件名
    header('Cache-Control: max-age=0');
    header('Content-Type: text/html; charset=utf-8'); //编码
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel 2003
    $objWriter->save('php://output');
    // message("导出成功!",$this->createWebUrl("ask",array("op"=>"operativeask")),"error");
    exit;
}
// 修改药品订单详情

if($op == 'yporderchange')
{
    $id = $_GPC['id'];
    $hid = $_GPC['hid'];
    $orderStatus = $_GPC['orderStatus'];
    $isPay = $_GPC['isPay'];
    //查询订单信息
    $addressId = $_GPC['addressId'];
    //查询订单是否完成
    $orderstate = pdo_fetch("select * from".tablename('hyb_yl_goodsorders')."where uniacid='{$uniacid}' and id='{$id}'");
    $order = pdo_fetch("select * from".tablename('hyb_yl_user_address')."where uniacid='{$uniacid}' and addressId='{$addressId}'");

    $cofing = pdo_get("hyb_yl_parameter",array('uniacid'=>$uniacid),array('wlid'));
    $wlid = $cofing['wlid'];
    $gsname = pdo_fetch("select * FROM".tablename('hyb_yl_kuaidi')."where uniacid='{$uniacid}' and id ='{$wlid}'");

    $wuliu = pdo_fetchall("select * FROM".tablename('hyb_yl_kuaidi')."where uniacid='{$uniacid}' and id ='{$id}'");

    include $this->template("order/ordersend");
    
}

if($op =='uodateorderStatus'){

      $id = $_GPC['id'];
      $hid = $_GPC['hid'];
      $orderunique = $_GPC['orderunique'];
      $orderStatus = $_GPC['orderStatus'];
      $res =  pdo_update('hyb_yl_goodsorders',array('orderunique'=>$orderunique,'orderStatus'=>'1'),array('id'=>$id));
      $data =array(
       'status'=>$res,
       'result'=>array(
          'url'=>'/index.php?c=site&a=entry&do=order&op=yporder&ac=yporder&m=hyb_yl',
          'message'=>'成功'
        )
        );

     echo json_encode($data);
     return false;
}
if($op == 'yporderchangeshou')
{
    $id = $_GPC['id'];
    $orderStatus = $_GPC['orderStatus'];
    $isPay = $_GPC['isPay'];
    $hid = $_GPC['hid'];
    if($orderStatus)
    {
        $res = pdo_update("hyb_yl_goodsorders",array("orderStatus"=>$orderStatus),array("id"=>$id));
    }else{
        $res = pdo_update("hyb_yl_goodsorders",array("isPay"=>$isPay),array("id"=>$id));
    }
    if($res)
      {
        message("设置成功!",$this->createWebUrl("order",array("op"=>"yporder",'hid'=>$hid)),"success");
      }else{
        message("设置失败!",$this->createWebUrl("order",array("op"=>"yporder",'hid'=>$hid)),"error");
      }
  
    
}
if($op == 'yporderdel')
{
    $id = $_GPC['id'];
    $hid = $_GPC['hid'];
    $res = pdo_delete("hyb_yl_goodsorders",array("id"=>$id));
    if($res)
      {
        message("删除成功!",$this->createWebUrl("order",array("op"=>"yporder","hid"=>$hid)),"success");
      }else{
        message("删除失败!",$this->createWebUrl("order",array("op"=>"yporder","hid"=>$hid)),"error");
      }
      include $this->template("order/yporder");
    
}
//药品订单详情
if($op == 'yporderxq')
{
    $id = $_GPC['id'];
    $hid = $_GPC['hid'];
    $itemone = pdo_fetch("select g.*,u.u_thumb,u.u_name,u.u_id from ".tablename("hyb_yl_goodsorders")." as g left join ".tablename("hyb_yl_userinfo")." as u on u.openid=g.openid where g.uniacid=".$uniacid." and g.id=".$id);

    $goods = unserialize($itemone['sid']);

    $itemone['u_tel'] = pdo_getcolumn("hyb_yl_user_address",array("openid"=>$itemone['openid'],'addressId'=>$itemone['addressId']),'userPhone');
    $itemone['region'] = pdo_getcolumn("hyb_yl_user_address",array("openid"=>$itemone['openid'],'addressId'=>$itemone['addressId']),'userAddress');
    $itemone['userName'] = pdo_getcolumn("hyb_yl_user_address",array("openid"=>$itemone['openid'],'addressId'=>$itemone['addressId']),'userName');
    $itemone['conets'] = unserialize($itemone['conets']);

    $user = pdo_get("hyb_yl_userjiaren",array("openid"=>$itemone['openid']));
    foreach ($goods as $key => $value) {
 
     $goods[$key]['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['jigou_two']),'agentname');
    }
    $ifcfy = array_column($goods,'ifcfy');
    $shop = pdo_getcolumn("hyb_yl_store",array("id"=>$goods['s_id']),'title');

    include $this->template("order/yporderxq");
}
//药品订单
if($op == 'tuorder')
{
    include $this->template("order/tuorder");
}
//开方问诊订单
if($op == 'kforder')
{
    include $this->template("order/kforder");
}
//视频问诊订单
if($op == 'sporder')
{
    include $this->template("order/sporder");
}
//电话问诊订单
if($op == 'dhorder')
{
    include $this->template("order/dhorder");
}

//挂号订单
if($op == 'ghorder')
{
    include $this->template("order/ghorder");
}
//手术问诊订单
if($op == 'sorder')
{
    include $this->template("order/sorder");
}
//快速导诊订单
if($op == 'ksorder')
{
    include $this->template("order/ksorder");
}
//订单规则
if($op == 'orderrule')
{
    $item = pdo_get("hyb_yl_order_rule",array("uniacid"=>$uniacid));
    $qx_time = !empty($_GPC['qx_time'])?$_GPC['qx_time']:'10';
    $gq_time = !empty($_GPC['gq_time'])?$_GPC['qx_time']:'48';
    if($_W['ispost'])
    {
        $data = array(
            'uniacid' => $uniacid,
            "qx_time" => $qx_time,
            "gq_time" => $gq_time,
            "sh_time" => $_GPC['sh_time'],
            "kc_pay" => $_GPC['kc_pay'],
            "tjgq_order" => $_GPC['tjgq_order'],
        );
        if($item)
        {
            $res = pdo_update("hyb_yl_order_rule",$data,array("uniacid"=>$uniacid));
            message("编辑成功!",$this->createWebUrl("order",array("op"=>"orderrule",'ac'=>'orderrule')),"success");
        }else{
            $data['created'] = time();
            $res = pdo_insert("hyb_yl_order_rule",$data);
            message("编辑成功!",$this->createWebUrl("order",array("op"=>"orderrule",'ac'=>'orderrule')),"success");
        }
    }
    include $this->template("order/orderrule");
}
//模板列表
if($op == 'freightlist')
{
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $where = " where uniacid=".$uniacid;
    $keyword = $_GPC['keyword'];
    if($keyword != '')
    {
        $where .= " and title like '%$keyword%'";
    }
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_yunfei").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    foreach($list as &$value)
    {
        $value['update'] = date("Y-m-d H:i:s",$value['update']);
        $value['detail'] = unserialize($value['detail']);
    }

    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yunfei").$where);
    $pager = pagination($total, $pageindex, $pagesize);
    include $this->template("order/freightlist");
}
//添加模板
if($op == 'addfreighttem')
{
    $id = $_GPC['id'];
    $item = pdo_get("hyb_yl_yunfei",array("id"=>$id));
    if($item)
    {
        $item['details'] = unserialize($item['detail']);
        $details_back = unserialize($item['detail']);
        $item['detailslist'] = json_encode($details_back);
    }

    if($_W['ispost'])
    {
        $detail = array();
        $express = $_GPC['express'];
        $area = $express['area'];
        $num = $express['num'];
        $money = $express['money'];
        $numex = $express['numex'];
        $moneyex = $express['moneyex'];
        $detail[0]['address'] = '默认';
        $detail[0]['first'] = $_GPC['first'];
        $detail[0]['first_price'] = $_GPC['first_price'];
        $detail[0]['continue'] = $_GPC['continue'];
        $detail[0]['continue_price'] = $_GPC['continue_price'];
        $count = count($area);
        for($i=0;$i<$count;$i++)
        {
            $arr = array();
            $arr['address'] = $area[$i];
            $arr['first'] = $num[$i];
            $arr['first_price'] = $money[$i];
            $arr['continue'] = $numex[$i];
            $arr['continue_price'] = $moneyex[$i];
            array_push($detail,$arr);
            
        }
 
        $data = array(
            'title' => $_GPC['title'],
            'uniacid' => $_W['uniacid'],
            'detail' => serialize($detail),
            "update" => time(),
        );
     
        if($id)
        {
            $res = pdo_update("hyb_yl_yunfei",$data,array("id"=>$id));
            
        }else{
            $data['created'] = time();

            $res = pdo_insert("hyb_yl_yunfei",$data);
        }
        if($res)
        {
            message("编辑成功!",$this->createWebUrl("order",array("op"=>"freightlist",'ac'=>'freightlist')),"success");
        }else{
            message("编辑失败!",$this->createWebUrl("order",array("op"=>"freightlist",'ac'=>'freightlist')),"success");
        }
    }
    include $this->template("order/addfreighttem");
}
if($op == 'delfreight')
{
    $id = $_GPC['id'];
    $res = pdo_delete("hyb_yl_yunfei",array("id"=>$id));
    if($res)
    {
        message("删除成功!",$this->createWebUrl("order",array("op"=>"freightlist",'ac'=>'delfreight')),"success");
    }else{
        message("删除失败!",$this->createWebUrl("order",array("op"=>"freightlist",'ac'=>'delfreight')),"success");
    }
    include $this->template("order/freightlist");
}
if($op == 'changes')
{
    $id = $_GPC['id'];
    $status = $_GPC['status'];
    $res = pdo_update("hyb_yl_yunfei",array("status"=>$status),array("id"=>$id));
    if($res)
    {
        message("设置成功!",$this->createWebUrl("order",array("op"=>"freightlist",'ac'=>'changes')),"success");
    }else{
        message("设置失败!",$this->createWebUrl("order",array("op"=>"freightlist",'ac'=>'changes')),"success");
    }
    include $this->template("order/freightlist");
}
if($op == 'tjorderdel'){
    $id =$_GPC['id'];
    pdo_delete('hyb_yl_tijianorder',array('id'=>$id));
    message("删除成功!",$this->createWebUrl("order",array("op"=>"tjorder",'ac'=>'tjorder')),"success");
}

if($op == 'jcorderdel'){
    $id =$_GPC['id'];
    pdo_delete('hyb_yl_dingjingorders',array('id'=>$id));
    message("删除成功!",$this->createWebUrl("order",array("op"=>"jcorder",'ac'=>'jcorder')),"success");
}
