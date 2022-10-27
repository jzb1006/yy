<?php
/**
* 
*/
 class Zixun extends HYBPage
 { 
    //首页推荐资讯分类
    public function showzixunfenlei(){
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_zixun_type")." where uniacid=:uniacid and enabled=1 and pid=0 order by sort desc ",array(":uniacid"=>$uniacid));

        if (!empty($list)) {
            foreach ($list as & $value) {
                $value['zx_thumb'] = $_W['attachurl'] . $value['zx_thumb'];
            }
        }
        echo json_encode($list);
    }
    //单个资讯分类列表
     public function zixunyi() {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model =  Model('zixun');
         $zx_id = intval($_GPC['zx_id']);
         // $total=$model->where("uniacid='".$uniacid."'")->count();
         // $pindex = max(1, intval($_GPC['page'])); 
         // $pagesize = 5;
         // $pager = pagination($total,$pindex,$pagesize);
         // $p = ($pindex-1) * $pagesize; 
         $wherecondition = " where uniacid=:uniacid ";
         $wheredata[':uniacid'] = $uniacid;
         if ($_GPC['tabIndex']!='0' && $zx_id != '') {
            $wherecondition .= " and p_id=:p_id ";
            $wheredata[':p_id'] = $zx_id;
         }

         $res = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_zixun").$wherecondition." and display=1 and art_type=1 order by time desc",$wheredata);
         
         // $res=$model->where("uniacid='".$uniacid."'and p_id='".$zx_id."'")->limit("".$p.",".$pagesize."")->getall();
        if (!empty($res)) {
            foreach ($res as & $value) {
                $value['content_thumb'] = unserialize($value['content_thumb']);
                $value['thumb'] = $_W['attachurl'] . $value['thumb'];
                $value['content'] = strip_tags(htmlspecialchars_decode($value['content']));
            }
        }
        
        echo json_encode($res);
    }
     public function zixunlist() {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $res = pdo_fetchall("SELECT a.*,b.zx_name FROM".tablename('hyb_yl_zixun')."as a left join".tablename('hyb_yl_zixun_type')."as b on b.zx_id=a.p_id where a.uniacid='{$uniacid}' and a.zdtype=1");

         foreach ($res as & $value) {
            $value['content_thumb'] = unserialize($value['content_thumb']);
            $value['thumb'] = tomedia($value['thumb']);
            $value['content'] = strip_tags(htmlspecialchars_decode($value['content']));
            $value['read'] = $value['dianj'] + $value['xncs'];
        }
        echo json_encode($res);
    }
    public function zixunlists() {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $zx_id = !empty($_GPC['zx_id'])?$_GPC['zx_id']:'';
         $where =" where a.uniacid='{$uniacid}' and a.display=1";
         if(empty($zx_id)){
          $where .="";
         }else{
          $where .=" and a.p_id='{$zx_id}' ";
         }
         $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
         $pagesize = empty($_GPC['pagesize']) ? '0' : $_GPC['pagesize'];
         $res = pdo_fetchall("SELECT a.*,b.zx_name FROM".tablename('hyb_yl_zixun')."as a left join".tablename('hyb_yl_zixun_type')."as b on b.zx_id=a.p_id  ".$where." order by a.sord desc limit ".$page * $pagesize.",".$pagesize);
         
  

         foreach ($res as & $value) {
            $value['content_thumb'] = unserialize($value['content_thumb']);
            $value['thumb'] = tomedia($value['thumb']);
            $value['content'] = strip_tags(htmlspecialchars_decode($value['content']));
            $value['read'] = $value['dianj'] + $value['xncs'];
        }
        echo json_encode($res);
    }
    //详情
    public function detail() {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model =  Model('zixun');
         $id = intval($_GPC['id']);
         $p_id =intval($_GPC['p_id']);
         $md =  Model('userdianz');
         $openid = $_GPC['openid'];
         $type =$_GPC['type'];
         $zid = $_GPC['zid'];
         //是否点赞
         $if_dz = $md ->where('p_id="'.$id.'" and openid="'.$openid.'" and type="'.$type.'"')->get();
         if($if_dz){
            $hs_l_key=1;
         }else{
            $hs_l_key=0;
         }
         
         $res=pdo_fetch("SELECT a.*,b.z_name,b.advertisement,c.agentname,d.level_name FROM".tablename('hyb_yl_zixun')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid left join ".tablename('hyb_yl_hospital')."as c on c.hid=b.hid left join".tablename('hyb_yl_hospital_level')."as d on d.id=c.grade where a.uniacid='{$uniacid}' and a.id='{$id}' and a.zid='{$zid}'");

         $res['advertisement'] = tomedia($res['advertisement']);

         $all_list = $model->where("uniacid='".$uniacid."'and p_id='{$p_id}' and id!='{$res['id']}'")->limit(5)->getall();
         foreach ($all_list as $key => $value) {
             $all_list[$key]['thumb'] = $_W['attachurl'].$all_list[$key]['thumb'];
             $cx_name = strip_tags(htmlspecialchars_decode($all_list[$key]['content']));
             $cx_name = str_replace(PHP_EOL, '',  $cx_name);
             $cx_name = str_replace(array("&nbsp;", "&ensp;", "&emsp;","&thinsp;","&zwnj;","&zwj;","&ldquo;","&rdquo;"), "", $cx_name);
             $all_list[$key]['content'] = $cx_name;
         }


         $res['content'] = htmlspecialchars_decode($res['content']);
         $res['total'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_zixun")."where uniacid=:uniacid and display=1 and art_type=1 order by time desc",array(":uniacid"=>$uniacid));
         


         //查询用户是否阅读
         $isyuedu = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zixun_looklog")." where uniacid=:uniacid and openid=:openid and zid=:zid",array(":uniacid"=>$uniacid,":openid"=>$openid,":zid"=>$id));
         // var_dump($isyuedu);
         if (empty($isyuedu)) {
            $res['iszongsongjifen'] =   true;


            //增加阅读记录
            $lookdata['uniacid'] = $uniacid;
            $lookdata['openid'] = $openid;
            $lookdata['zid'] = $id;
            $lookdata['jifen'] = $res['scyd'];
            $lookdata['createtime'] = date("Y-m-d H:i:s",time());
            pdo_insert("hyb_yl_zixun_looklog",$lookdata);

            //查询用户
            $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." where uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$openid));
            $presentcredit = $userinfo['score']+$res['scyd'];
            //增加积分明细
            $mycredit1['uniacid'] = $uniacid;
            $mycredit1['u_id'] = $userinfo['u_id'];
            $mycredit1['openid'] = $openid;
            $mycredit1['credittype'] = "credit1";
            $mycredit1['operator'] = "1";
            $mycredit1['num'] = $res['scyd'];
            $mycredit1['remark'] = "阅读资讯赠送积分 ".$openid." 剩余：".$presentcredit;
            $mycredit1['createtime'] = time();
            $mycredit1['presentcredit'] = $presentcredit;
            pdo_insert("hyb_yl_userinfo_credit_record",$mycredit1);


         }else{
            $res['iszongsongjifen'] = false;
         }

         $data = array(
           'data'     =>$res,
           'hs_l_key' =>$if_dz,
           'list'     =>$all_list
        );

         echo json_encode($data);
    }
    //增加阅读
   public function addyuedu() {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model =  Model('zixun');
         $id = intval($_GPC['id']);
         $res=$model->where("uniacid='".$uniacid."'and id='".$id."'")->get('dianj');
         $data = array(
            'dianj' => $res['dianj'] + 1
            );
         $save_data = $model->where('id="'.$id.'"')->save($data);
         echo json_encode($save_data);
    }
    //点赞
   public function adddz() {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $openid = $_GPC['openid'];
         $model =  Model('zixun');
         $md =  Model('userdianz');
         $id = intval($_GPC['id']);
         $type = $_GPC['type'];
         $info = array(
             'uniacid' => $_W['uniacid'],
             'p_id'    => $id,
             'openid'  => $_GPC['openid'],
             'type'    => $type
            );
         $md->add($info);
         $res=$model->where("uniacid='".$uniacid."'and id='".$id."'")->get('dz');
         $data = array(
            'dz' => $res['dz'] + 1
            );
         $save_data = $model->where('id="'.$id.'"')->save($data);
         echo json_encode($save_data);
    }  
    //生成小程序二维码
      public function erweima()
     {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model =  Model('zixun');
         $id = intval($_GPC['id']);
         $p_id = $_GPC['p_id'];
         $get_one_info =$model->where('uniacid="'.$uniacid.'" and id ="'.$id.'"')->get('id,erweima,zid');
         $zid = $get_one_info['zid'];
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
                    'scene'         => $id.'&p_id='.$p_id.'&zid='.$zid,//二维码所带参数
                    'width'         => 200,
                    'page'          => 'hyb_yl/userLife/pages/zixunanlixq/zixunanlixq',//二维码跳转路径（要已发布小程序）
                    'auto_color'    => true
                );
                $result = $this->sendCmd($url,json_encode($qrcode));//请求微信接口
                $res = file_put_contents($file,$result);//将微信返回的图片数据流写入文件
                $u_phone = pdo_getcolumn('hyb_yl_zixun', array('id' => $id), 'erweima');
                $datas = array('erweima' => $file);
                $getupdate = pdo_update("hyb_yl_zixun", $datas, array('id' => $id, 'uniacid' => $uniacid));
                echo json_encode($getupdate);
            }else{
                echo "1";
         }
     } 
     //分享海报
    public function generate()
     {
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $model_zi =  Model('zixun');
        $id = intval($_GPC['id']);
        $zid =$_GPC['zid'];
        // $get_one_info = $model_zi->where('uniacid="'.$uniacid.'" and id ="'.$id.'"')->get('id,erweima,haibao,zx_names');
        // $string = $get_one_info['zx_names'];

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
            $u_phone = pdo_getcolumn('hyb_yl_zixun', array('id' => $id), 'haibao');
            $datas = array('haibao' => $filename_back);
            $getupdate = pdo_update("hyb_yl_zixun", $datas, array('id' => $id, 'uniacid' => $uniacid));
            echo json_encode($img);
        }else{
            echo json_encode($_W['siteroot'].$get_one_info['haibao']);
        }

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
    public function getalluser(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $rew = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_userinfo')."where uniacid='{$uniacid}'  limit 3");
        echo json_encode($rew);
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


