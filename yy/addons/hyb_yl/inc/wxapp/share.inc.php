<?php
/**
* 
*/
 class Share extends HYBPage
 { 

    //分享设置
    public function sharesetting(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $share_setting = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_share_setting")." where uniacid=:uniacid ",array(":uniacid"=>$uniacid));
        if (empty($share_setting['newfeed'])) {
            $share_setting['newfeed']  = "最新动态";
        }
        echo json_encode($share_setting);
    }

    //分xiang列表
    public function allshare() {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model =  Model('share');
         $tab1 = $model->tablename('share');
         $tab2 = $model->tablename('userinfo');
         $tab3 = $model->tablename('zhuanjia');
         $model_dian = Model('userdianz');
         $zx_id = intval($_GPC['zx_id']);
         $openid = $_GPC['openid'];
         $pindex = max(1, intval($_GPC['page'])); 
         $pagesize = $_GPC['pagback'];
         $state = $_GPC['state'];
         $p = ($pindex-1) * $pagesize; 
         $labelid = $_GPC['labelid'];
         if($labelid)
         {
            $where = " and (a.labelid=".$labelid." or b.paretid=".$labelid.")";
         }else{
            $where = '';
         }

        $res = pdo_fetchall("SELECT a.* FROM ".tablename("hyb_yl_share")." as a left join ".tablename("hyb_yl_share_category")." as b on b.id=a.labelid WHERE a.uniacid=:uniacid and a.type=1 and a.share_tj=1 ".$where." order by a.times desc limit ".$p.",".$pagesize,array(":uniacid"=>$uniacid));
        
        if (!empty($res)) {
            foreach ($res as &$value) {
                //查询是否存在当前用户的点赞信息
                $dianzan = $model_dian->where('uniacid= "'.$uniacid .'" and openid="'.$openid.'" and p_id="'.$value['a_id'].'" and type=4')->get();
                if($dianzan){
                    $value['dianzan']=1;
                }else{
                    $value['dianzan']=0;
                }

                //查询评论数
                $pinglunnum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_pinglunsite")." WHERE uniacid=:uniacid and a_id=:a_id and parentid=0 ",array(":uniacid"=>$uniacid,":a_id"=>$value['a_id']));
                $value['pinglunnum'] = $pinglunnum;

                // if($state ==1){
                //    $value['z_thumbs']=$_W['attachurl'].$value['z_thumbs'];   
                // }
                $value['sharepic'] = unserialize($value['sharepic']);
                
                $num = count($value['sharepic']);
                for ($i=0; $i <$num ; $i++) { 
                    if (strpos($value['sharepic'][$i],"http")===false) {
                        $value['sharepic'][$i]=$_W['attachurl'].$value['sharepic'][$i];
                    }
                   
                }

                $value['times'] = date("Y-m-d",$value['times']);
                if ($value['user_identity']=='0') {
                    //查询普通用户
                    $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$value['openid']));
                    $value['labels'] = pdo_getcolumn("hyb_yl_share_category",array("id"=>$value['labelid'],'uniacid'=>$uniacid),'name');

                    $userjiaren = pdo_get("hyb_yl_userjiaren",array("uniacid"=>$uniacid,"openid"=>$value['openid'],'sick_index'=>'0'));
                    $value['userjiaren'] = $userjiaren;
                    $value['fabuzhe_name'] = $userinfo['u_name'];
                    $value['fabuzhe_thumb'] = $userinfo['u_thumb'];
                }
                if ($value['user_identity']=='1') {
                    //查询专家
                    $zhuanjiainfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$value['openid']));
                    $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjiainfo['parentid']),'name');
                    $value['fabuzhe_name'] = $zhuanjiainfo['z_name'];
                    $value['zid'] = $zhuanjiainfo['zid'];
                    if (strpos($zhuanjiainfo['advertisement'],"http")===false) {
                        $value['fabuzhe_thumb'] = $_W['attachurl'].$zhuanjiainfo['advertisement'];
                    }else{
                        $value['fabuzhe_thumb'] = $zhuanjiainfo['advertisement'];
                    }


                    //查询专家所在机构
                    $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$zhuanjiainfo['hid']));
                    //查询专家职称
                    $zhuanjiazhichen = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['z_zhicheng']));
                    $value['zhuanjia_info'] = $zhuanjiajigou['agentname']." ".$zhuanjiazhichen['job_name'];
                }
                if ($value['user_identity']=='2') {
                    $value['fabuzhe_name'] = $value['virtual_name'];
                    $value['fabuzhe_thumb'] = $_W['attachurl'].$value['virtual_thumb'];
                }

            }
        }
        
        echo json_encode($res);
    }


    public function Categorysharelist(){
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $tabindex = $_GPC['tabindex'];
        $tabpid = $_GPC['tabpid'];
        $tabcid = $_GPC['tabcid'];
        $model_dian = Model('userdianz');
        $condition = " WHERE uniacid=:uniacid ";
        $conditiondata[':uniacid'] = $uniacid;
        if ($tabindex!='0' ) {
            if ($tabcid=='0') {
                //查询父级下的子集
                $chiledcategory = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_share_category")." WHERE uniacid=:uniacid and paretid=:paretid ",array(":uniacid"=>$uniacid,":paretid"=>$tabpid));
                $labelid = [];
                if (!empty($chiledcategory)) {
                    foreach ($chiledcategory as &$cc) {
                        $labelid[] = $cc['id'];
                    }
                    $labelid = implode(",", $labelid);
                    $condition .= " and labelid in ($labelid) ";
                }else{
                    $condition .= " and labelid='' ";
                }
                
            }else{
                $condition .= " and labelid=:labelid ";
                $conditiondata[':labelid'] = $tabcid;
            }
        }
        $condition .= " and type=1 and share_tj=1 order by times desc ";
        $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_share").$condition,$conditiondata);
        if (!empty($list)) {
            foreach ($list as &$value) {
                //查询是否存在当前用户的点赞信息
                $dianzan = $model_dian->where('uniacid= "'.$uniacid .'" and openid="'.$openid.'" and p_id="'.$value['a_id'].'" and type=4')->get();
                if($dianzan){
                    $value['dianzan']=1;
                }else{
                    $value['dianzan']=0;
                }

                //查询评论数
                $pinglunnum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_pinglunsite")." WHERE uniacid=:uniacid and a_id=:a_id and parentid=0 ",array(":uniacid"=>$uniacid,":a_id"=>$value['a_id']));
                $value['pinglunnum'] = $pinglunnum;

                $value['sharepic'] = unserialize($value['sharepic']);
                
                $num = count($value['sharepic']);
                for ($i=0; $i <$num ; $i++) { 
                    if (strpos($value['sharepic'][$i],"http")===false) {
                        $value['sharepic'][$i]=$_W['attachurl'].$value['sharepic'][$i];
                    }
                }

                $value['times'] = date("Y-m-d",$value['times']);
                if ($value['user_identity']=='0') {
                    //查询普通用户
                    $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$value['openid']));
                    $value['fabuzhe_name'] = $userinfo['u_name'];
                    $value['fabuzhe_thumb'] = $userinfo['u_thumb'];
                }
                if ($value['user_identity']=='1') {
                    //查询专家
                    $zhuanjiainfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$value['openid']));
                    $value['fabuzhe_name'] = $zhuanjiainfo['z_name'];
                    if (strpos($zhuanjiainfo['advertisement'],"http")===false) {
                        $value['fabuzhe_thumb'] = $_W['attachurl'].$zhuanjiainfo['advertisement'];
                    }else{
                        $value['fabuzhe_thumb'] = $zhuanjiainfo['advertisement'];
                    }

                    //查询专家所在机构
                    $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$zhuanjiainfo['hid']));
                    //查询专家职称
                    $zhuanjiazhichen = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['z_zhicheng']));
                    $value['zhuanjia_info'] = $zhuanjiajigou['agentname']." ".$zhuanjiazhichen['job_name'];
                }
                if ($value['user_identity']=='2') {
                    $value['fabuzhe_name'] = $value['virtual_name'];
                    $value['fabuzhe_thumb'] = $_W['attachurl'].$value['virtual_thumb'];
                }
            }
        }
        echo json_encode($list);
    }

    public function url() {
        global $_W;
        echo $_W['siteroot'];
    }
    public function upshare(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $value = htmlspecialchars_decode($_GPC['sharepic']);
        $array = json_decode($value);
        $object = json_decode(json_encode($array), true);
        $contents = $_GPC['contents'];
        $openid = $_GPC['openid'];
        $state = $_GPC['state'];
        $biaoqianid = $_GPC['biaoqianid'];       //标签id
        if ($_GPC['user_identity']=='0') {      //发布者身份
            $user_identity = "0";
        }else{
            $user_identity = "1";
        }
        $data['uniacid'] = $uniacid;
        $data['openid'] = $openid;
        $data['sharepic'] = serialize($object);
        $data['contents'] = $contents;
        $data['times'] = strtotime("now");
        $data['state'] = $state;
        $data['labelid'] = $biaoqianid;
        $data['user_identity'] = $user_identity;   //发布者身份  0普通用户 1专家
        $data['doctor_visible'] = $_GPC['doctor_visible'];   //医生是否可见

        //查询是否开启审核
        $share_setting = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_share_setting")." where uniacid=:uniacid ",array(":uniacid"=>$uniacid));
        if ($share_setting['is_shenhe']=='1') {
            $data['type'] = "1";
        }else{
            $data['type'] = "0";
        }

        $res = pdo_insert("hyb_yl_share",$data);
        echo json_encode($res);
    }
    //分享详情
    public function datainfo() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $a_id = $_GPC['a_id'];
        $openid = $_GPC['openid'];
        $res = pdo_fetch('SELECT * from' . tablename('hyb_yl_share') ." where uniacid =:uniacid and a_id=:a_id",array(":uniacid"=>$uniacid,":a_id"=>$a_id));
        $res['sharepic'] = unserialize($res['sharepic']);
        $res['times'] = date('Y-m-d H:i:s', $res['times']);
        $num = count($res['sharepic']);
        for ($i = 0;$i < $num;$i++) {
            if (strpos($res['sharepic'][$i],"http")===false) {
                $res['sharepic'][$i] = $_W['attachurl'] . $res['sharepic'][$i];
            }
            
        }
        //查询是否存在当前用户的点赞信息
        $model_dian = Model('userdianz');
        $dianzan = $model_dian->where('uniacid= "'.$uniacid .'" and openid="'.$openid.'" and p_id="'.$a_id.'" and type=4')->get();
        if($dianzan){
            $res['dianzan']=1;
        }else{
            $res['dianzan']=0;
        }
        $res['labels'] = pdo_getcolumn("hyb_yl_share_category",array("id"=>$res['labelid'],'uniacid'=>$uniacid),'name');
        if ($res['user_identity']=='0') {
            //查询普通用户
            $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$res['openid']));
            $userjiaren = pdo_get("hyb_yl_userjiaren",array("uniacid"=>$uniacid,"openid"=>$res['openid'],'sick_index'=>'0'));
            $res['userjiaren'] = $userjiaren;
            $res['fabuzhe_name'] = $userinfo['u_name'];
            $res['fabuzhe_thumb'] = $userinfo['u_thumb'];
        }
        if ($res['user_identity']=='1') {
            //查询专家
            $zhuanjiainfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$res['openid']));
            $res['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjiainfo['parentid']),'name');
            $res['fabuzhe_name'] = $zhuanjiainfo['z_name'];
            $res['zid'] = $zhuanjiainfo['zid'];
            if (strpos($zhuanjiainfo['advertisement'],"http")===false) {
                $res['fabuzhe_thumb'] = $_W['attachurl'].$zhuanjiainfo['advertisement'];
            }else{
                $res['fabuzhe_thumb'] = $zhuanjiainfo['advertisement'];
            }

            //查询专家所在机构
            $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$zhuanjiainfo['hid']));
            //查询专家职称
            $zhuanjiazhichen = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['z_zhicheng']));
            $res['zhuanjia_info'] = $zhuanjiajigou['agentname']." ".$zhuanjiazhichen['job_name'];
        }
        if ($res['user_identity']=='2') {
            $res['fabuzhe_name'] = $res['virtual_name'];
            $res['fabuzhe_thumb'] = $_W['attachurl'].$res['virtual_thumb'];
        }
        echo json_encode($res);
    }
    //分享评论
     public function pinglunadd()
     {
       global $_GPC, $_W;
       $model =Model('pinglunsite');
       $uniacid = $_W['uniacid'];
       $a_id = $_GPC['a_id'];
       $data_arr1 =$_GPC['data_arr1'];
       $pl_content =$_GPC['pl_content'];
       $useropenid =$_GPC['useropenid'];
       $adminopenid = $_GPC['adminopenid'];
       $idarr = htmlspecialchars_decode($data_arr1);
       $array = json_decode($idarr);
       $object = json_decode(json_encode($array), true);
       $text =array(
         'estimatePicSmallUrl'=>$object,
         'rcontent'=>$pl_content
        );

        $pinglunzhe = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." where uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
        $shareinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_share")." WHERE uniacid=:uniacid and a_id=:a_id ",array(":uniacid"=>$uniacid,":a_id"=>$a_id));
        if ($shareinfo['openid']==$pinglunzhe['openid']) {
            $data['author'] = "1";
        }else{
            $data['author'] = "0";
        }
        $iszhuanjia = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
        if (!empty($iszhuanjia)) {
            $data['usertoux'] = $iszhuanjia['advertisement'];
            $data['name'] = $iszhuanjia['z_name'];
            $data['user_identity'] = "1";
        }else{
            $data['usertoux'] = $pinglunzhe['u_thumb'];
            $data['name'] = $pinglunzhe['u_name'];
            $data['user_identity'] = "0";
        }

        $data['uniacid'] = $uniacid;
        $data['a_id'] = $a_id;
        $data['useropenid'] = $useropenid;
        $data['adminopenid'] = $adminopenid;
        $data['pl_text'] = serialize($text);
        $data['types'] = $_GPC['types'];
        $data['pl_time'] = strtotime('now');
        $data['parentid'] = $_GPC['parentid'];
        $data['replyType'] = $_GPC['replyType'];
        $res = $model->add($data);
        echo json_encode($data);
     }

     /*分享全部评论*/
     public function allpinglunlist()
     {
        global $_GPC, $_W;
        $a_id = $_GPC['a_id'];
        $uniacid = $_W['uniacid'];  
        $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_pinglunsite')."where uniacid='{$uniacid}' and a_id='{$a_id}' and parentid=0  and types=0 order by pl_time desc");

        foreach ($res as $key => $value) {
            $res[$key]['pl_text']= unserialize($res[$key]['pl_text']);
            $res[$key]['rcontent'] = $res[$key]['pl_text']['rcontent'];
            
            $count =count($res[$key]['pl_text']['estimatePicSmallUrl']);
            for ($i=0; $i <$count ; $i++) { 
                $res[$key]['estimatePicSmallUrl'][]=$_W['attachurl'].$res[$key]['pl_text']['estimatePicSmallUrl'][$i];
            }
            if (strpos($res[$key]['usertoux'],"http")===false) {
                $res[$key]['usertoux'] = $_W['attachurl'].$res[$key]['usertoux'];
            }
            $res[$key]['userIcon'] = $res[$key]['usertoux'];

            // $res[$key]['zhuanjia_zhiwu_openid'] = $res[$key]['useropenid'];
            if ($res[$key]['user_identity']=='1') {
                //查询专家
                $zhuanjiainfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$res[$key]['useropenid']));
                $res[$key]['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjiainfo['parentid']),'name');
                //查询专家所在机构
                $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$zhuanjiainfo['hid']));
                //查询专家职称
                $zhuanjiazhichen = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['z_zhicheng']));
                $res[$key]['zhuanjia_zhiwu'] = $zhuanjiajigou['agentname']." ".$zhuanjiazhichen['job_name'];
            }

            $res[$key]['rtimeDay'] =date("Y-m-d",$res[$key]['pl_time']); 
            $pl_id=$value['pl_id'];
            $res[$key]['listPatientBbsReplyReplyVO']=pdo_fetchall("SELECT * FROM".tablename('hyb_yl_pinglunsite')."where uniacid='{$uniacid}' and a_id='{$a_id}' and parentid='{$pl_id}' and types=0 order by pl_time asc");

            foreach ($res[$key]['listPatientBbsReplyReplyVO'] as &$value1) {
                $value1['pl_text']=unserialize($value1['pl_text']);
                $value1['content'] =$value1['pl_text']['rcontent'];
                $value1['fromUidName'] =$value1['name'];
                $value1['hideFlag'] =6;
                $count2 =count($value1['pl_text']['estimatePicSmallUrl']);
                for ($i=0; $i <$count2 ; $i++) { 
                    $value1['estimatePicSmallUrl'][]=$_W['attachurl'].$value1['pl_text']['estimatePicSmallUrl'][$i];
                }
            }
       }
       echo json_encode($res);
    }

    //浏览
    public function addliulannum(){
        global $_GPC, $_W;
        $a_id = $_GPC['a_id'];
        pdo_update("hyb_yl_share",array("virtual_accesses +="=>"1"),array("a_id"=>$a_id));
    }

     //点赞
     public function userdianz()
     {
        global $_GPC, $_W;
        $a_id = $_GPC['a_id'];
        $uniacid = $_W['uniacid']; 
        $parentid =$_GPC['parentid'];
        $md =  Model('userdianz');
        $data =array(
        'uniacid'=>$uniacid,
        'p_id'   =>$parentid,
        'type'   =>4,
        'openid' =>$_GPC['openid']
            );
        $res =$md->add($data);
        //增加点赞数
        $zen = pdo_getcolumn("hyb_yl_share",array('a_id'=>$parentid,'uniacid'=>$uniacid),'dianj');
        $datas = array('dianj' => $zen+1);
        $dianzane = pdo_update("hyb_yl_share",$datas,array('uniacid'=>$uniacid,'a_id'=>$parentid));
        echo json_encode($dianzane);
     }

      public function baogaouserdianz()
     {
        global $_GPC, $_W;
        $a_id = $_GPC['a_id'];
        $uniacid = $_W['uniacid']; 
        $parentid =$_GPC['parentid'];
        $md =  Model('userdianz');
        $data =array(
        'uniacid'=>$uniacid,
        'p_id'   =>$parentid,
        'type'   =>6,
        'openid' =>$_GPC['openid']
            );
        $res =$md->add($data);
        //增加点赞数
        $zen = pdo_getcolumn("hyb_yl_user_baogao",array('a_id'=>$parentid,'uniacid'=>$uniacid),'dianj');
        $datas = array('dianj' => $zen+1);
        $dianzane = pdo_update("hyb_yl_user_baogao",$datas,array('uniacid'=>$uniacid,'a_id'=>$parentid));
        echo json_encode($dianzane);
     }  
     public function user_if_baogaodianz()
     {
        global $_GPC, $_W;
        $a_id = $_GPC['a_id'];
        $uniacid = $_W['uniacid']; 
        $openid =$_GPC['openid'];
        $md =  Model('userdianz');
        $res =$md->where('uniacid= "'.$uniacid .'" and openid="'.$openid.'" and p_id="'.$a_id.'" and type=6')->get();
        if($res){
          echo 1;
        }else{
          echo 0;  
        }
     }  
     //查询我是否点赞
     public function user_if_dianz()
     {
        global $_GPC, $_W;
        $a_id = $_GPC['a_id'];
        $uniacid = $_W['uniacid']; 
        $openid =$_GPC['openid'];
        $md =  Model('userdianz');
        $res =$md->where('uniacid= "'.$uniacid .'" and openid="'.$openid.'" and p_id="'.$a_id.'" and type=4')->get();
        if($res){
          echo 1;
        }else{
          echo 0;  
        }
     }


     //热门*（点赞最多的排序不显示0点赞的）
      public function remen()
     {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model =  Model('share');
         $tab1 = $model->tablename('share');
         $tab2 = $model->tablename('userinfo');
         $tab3 = $model->tablename('zhuanjia');
         $model_dian = Model('userdianz');
         $zx_id = intval($_GPC['zx_id']);
         $openid = $_GPC['openid'];
         $total=$model->where("uniacid='".$uniacid."'")->count();
         $pindex = max(1, intval($_GPC['page'])); 
         $pagesize = 5;
         $pager = pagination($total,$pindex,$pagesize);
         $p = ($pindex-1) * $pagesize; 
         $state = $_GPC['state'];
         if($state == 1){
           $sql = "SELECT $tab1.openid,$tab1.*,$tab2.openid,$tab2.u_name,$tab2.u_thumb,$tab3.z_name,$tab3.z_thumbs FROM $tab1 left join $tab2 on $tab1.openid=$tab2.openid left join $tab3 on $tab3.openid=$tab1.openid where $tab1.uniacid='".$uniacid."' and $tab1.state='".$state."' order by $tab1.dianj limit ".$p.",".$pagesize;
         }else{
           $sql = "SELECT $tab1.openid,$tab1.*,$tab2.openid,$tab2.u_name,$tab2.u_thumb FROM $tab1 left join $tab2 on $tab1.openid=$tab2.openid where $tab1.uniacid='".$uniacid."' and ($tab1.state=0 or $tab1.state=2) order by $tab1.dianj limit ".$p.",".$pagesize;
         }

         $res=pdo_fetchall($sql);
    
         foreach ($res as & $value) {
            //查询是否存在当前用户的点赞信息
            $dianzan = $model_dian->where('uniacid= "'.$uniacid .'" and openid="'.$openid.'" and p_id="'.$value['a_id'].'" and type=4')->get();
            if($dianzan){
                $value['dianzan']=1;
            }else{
                $value['dianzan']=0;
            }
            if($state ==1){
               $value['z_thumbs']=$_W['attachurl'].$value['z_thumbs'];   
            }
            $value['sharepic'] = unserialize($value['sharepic']);
            $value['times'] = date("Y-m-d",$value['times']);
            $num = count($value['sharepic']);
            for ($i=0; $i <$num ; $i++) { 
                if (strpos($value['sharepic'][$i],"http")===false) {
                    $value['sharepic'][$i]=$_W['attachurl'].$value['sharepic'][$i];
                }
            }
        }
        echo json_encode($res);
     }
     //删除评论
     public function deletepl()
     {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model =  Model('pinglunsite');
         $pl_id = $_GPC['pl_id'];
         //查询评论回复
         $huifu = pdo_fetchall("SELECT pl_id FROM ".tablename("hyb_yl_pinglunsite")." WHERE uniacid=:uniacid and parentid=:parentid ",array(":uniacid"=>$uniacid,":parentid"=>$pl_id));
         if (!empty($huifu)) {
             foreach ($huifu as &$value) {
                 pdo_delete("hyb_yl_pinglunsite",array("pl_id"=>$value['pl_id']));
             }
         }
         $res =$model->where('pl_id="'.$pl_id.'"')->delete();
         echo json_encode($res);
     }
     //删除文章
      public function deletecontent()
     {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model =  Model('share');
         $a_id = $_GPC['a_id'];
         $res =$model->where('a_id="'.$a_id.'"')->delete();
         echo json_encode($res);
     }
     //删除文章
      public function deletecontentbaogao()
     {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model =  Model('user_baogao');
         $a_id = $_GPC['a_id'];
         $res =$model->where('a_id="'.$a_id.'"')->delete();
         echo json_encode($res);
     }
     public function deleteplbaogao()
     {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model =  Model('pinglunsite');
         $pl_id = $_GPC['pl_id'];
         //查询评论回复
         $huifu = pdo_fetchall("SELECT pl_id FROM ".tablename("hyb_yl_baogaopinglunsite")." WHERE uniacid=:uniacid and parentid=:parentid ",array(":uniacid"=>$uniacid,":parentid"=>$pl_id));
         if (!empty($huifu)) {
             foreach ($huifu as &$value) {
                 pdo_delete("hyb_yl_baogaopinglunsite",array("pl_id"=>$value['pl_id']));
             }
         }
         $res =$model->where('pl_id="'.$pl_id.'"')->delete();
         echo json_encode($res);
     }
     //我的分享
     public function myshare(){
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $zx_id = intval($_GPC['zx_id']);
         $openid = $_GPC['openid'];

         $res = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_share")." WHERE uniacid=:uniacid and openid=:openid order by times desc ",array(":uniacid"=>$uniacid,":openid"=>$openid));

         foreach ($res as & $value) {
            
            $value['sharepic'] = unserialize($value['sharepic']);
            $value['times'] = date("Y-m-d H:i:s",$value['times']);
            $num = count($value['sharepic']);
            for ($i=0; $i <$num ; $i++) { 
                if (strpos($value['sharepic'][$i],"http")===false) {
                    $value['sharepic'][$i]=$_W['attachurl'].$value['sharepic'][$i];
                }
            }

            if ($value['user_identity']=='0') {
                //查询普通用户
                $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$value['openid']));
                $value['fabuzhe_name'] = $userinfo['u_name'];
                $value['fabuzhe_thumb'] = $userinfo['u_thumb'];
            }
            if ($value['user_identity']=='1') {
                //查询专家
                $zhuanjiainfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$value['openid']));
                $value['fabuzhe_name'] = $zhuanjiainfo['z_name'];

                if (strpos($zhuanjiainfo['advertisement'],"http")===false) {
                    $value['fabuzhe_thumb'] = $_W['attachurl'].$zhuanjiainfo['advertisement'];
                }else{
                    $value['fabuzhe_thumb'] = $zhuanjiainfo['advertisement'];
                }

                //查询专家所在机构
                $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$zhuanjiainfo['hid']));
                //查询专家职称
                $zhuanjiazhichen = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['z_zhicheng']));
                $value['zhuanjia_info'] = $zhuanjiajigou['agentname']." ".$zhuanjiazhichen['job_name'];
            }
            //查询是否存在当前用户的点赞信息
            $model_dian = Model('userdianz');
            $dianzan = $model_dian->where('uniacid= "'.$uniacid .'" and openid="'.$value['openid'].'" and p_id="'.$value['a_id'].'" and type=4')->get();
            if($dianzan){
                $value['dianzan']=1;
            }else{
                $value['dianzan']=0;
            }
            //查询评论数
            $pinglunnum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_pinglunsite")." WHERE uniacid=:uniacid and a_id=:a_id and parentid=0 ",array(":uniacid"=>$uniacid,":a_id"=>$value['a_id']));
            $value['pinglunnum'] = $pinglunnum;
        }
         echo json_encode($res);
     }


     //查询首页推荐分享动态分类
     public function showcategory(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_share_category")." WHERE uniacid=:uniacid and paretid=0 and recommend=1 and enabled=1 order by sortid desc ",array(":uniacid"=>$uniacid));
        if (!empty($list)) {
            foreach ($list as &$value) {
                $value['thumb'] = $_W['attachurl'].$value['thumb'];

                //查询二级
                $childlist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_share_category")." where uniacid=:uniacid and paretid=:paretid  and enabled=1 order by sortid desc ",array(":uniacid"=>$uniacid,":paretid"=>$value['id']));

                $value['childlist'] = $childlist;
            }
        }
        echo json_encode($list);
     }
     public function Allcategory(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_share_category")." WHERE uniacid=:uniacid and paretid=0 and enabled=1 order by sortid desc ",array(":uniacid"=>$uniacid));
        if (!empty($list)) {
            foreach ($list as &$value) {
                //查询二级
                $childlist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_share_category")." where uniacid=:uniacid and paretid=:paretid  and enabled=1 order by sortid desc ",array(":uniacid"=>$uniacid,":paretid"=>$value['id']));

                $value['childlist'] = $childlist;
            }
        }
        echo json_encode($list);
     }

    //发布动态查询用户身份
    public function user_identity(){
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $openid =$_GPC['openid'];
        //查询用户是否为专家
        $zhuanjia = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$openid));
        if (!empty($zhuanjia)) {
            $iszhuanjia = $zhuanjia['zid'];
        }else{
            $iszhuanjia = "0";
        }
        echo json_encode($iszhuanjia);
    }


    public function upbaogaoshare(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $value = htmlspecialchars_decode($_GPC['sharepic']);
        $array = json_decode($value);
        $object = json_decode(json_encode($array), true);
        $contents = $_GPC['contents'];
        $openid = $_GPC['openid'];
        $state = $_GPC['state'];
        $biaoqianid = $_GPC['biaoqianid'];       //标签id
        if ($_GPC['user_identity']=='0') {      //发布者身份
            $user_identity = "0";
        }else{
            $user_identity = "1";
        }
        $data['uniacid'] = $uniacid;
        $data['openid'] = $openid;
        $data['sharepic'] = serialize($object);
        $data['contents'] = $contents;
        $data['times'] = strtotime("now");
        $data['state'] = $state;
        $data['labelid'] = $biaoqianid;
        $data['user_identity'] = $user_identity;   //发布者身份  0普通用户 1专家
        $data['doctor_visible'] = $_GPC['doctor_visible'];   //医生是否可见

        //查询是否开启审核
        // $share_setting = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_baogao_setting")." where uniacid=:uniacid ",array(":uniacid"=>$uniacid));
        // if ($share_setting['is_shenhe']=='1') {
        //     $data['type'] = "1";
        // }else{
        //     $data['type'] = "0";
        // }

        $res = pdo_insert("hyb_yl_user_baogao",$data);
        echo json_encode($res);
    }
    public function allbaogaoshare() {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model_dian = Model('userdianz');
         $zx_id = intval($_GPC['zx_id']);
         $openid = $_GPC['openid'];
         $pindex = max(1, intval($_GPC['page'])); 
         $pagesize = $_GPC['pagback'];
         $state = $_GPC['state'];
         $p = ($pindex-1) * $pagesize; 
         $labelid = $_GPC['labelid'];
         $openid = $_GPC['openid'];
         $where = " and openid='{$openid}'";

        $res = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_user_baogao")."WHERE uniacid=:uniacid ".$where." order by times desc limit ".$p.",".$pagesize,array(":uniacid"=>$uniacid));
     
        if (!empty($res)) {
            foreach ($res as &$value) {
                //查询是否存在当前用户的点赞信息
                $dianzan = $model_dian->where('uniacid= "'.$uniacid .'" and openid="'.$openid.'" and p_id="'.$value['a_id'].'" and type=4')->get();
                if($dianzan){
                    $value['dianzan']=1;
                }else{
                    $value['dianzan']=0;
                }

                //查询评论数
                $pinglunnum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_baogaopinglunsite")." WHERE uniacid=:uniacid and a_id=:a_id and parentid=0 ",array(":uniacid"=>$uniacid,":a_id"=>$value['a_id']));
                $value['pinglunnum'] = $pinglunnum;

                // if($state ==1){
                //    $value['z_thumbs']=$_W['attachurl'].$value['z_thumbs'];   
                // }
                $value['sharepic'] = unserialize($value['sharepic']);
                
                $num = count($value['sharepic']);
                for ($i=0; $i <$num ; $i++) { 
                    if (strpos($value['sharepic'][$i],"http")===false) {
                        $value['sharepic'][$i]=$_W['attachurl'].$value['sharepic'][$i];
                    }
                   
                }

                $value['times'] = date("Y-m-d",$value['times']);
                if ($value['user_identity']=='0') {
                    //查询普通用户
                    $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$value['openid']));
                    $value['fabuzhe_name'] = $userinfo['u_name'];
                    $value['fabuzhe_thumb'] = $userinfo['u_thumb'];
                }
                if ($value['user_identity']=='1') {
                    //查询专家
                    $zhuanjiainfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$value['openid']));
                    $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjiainfo['parentid']),'name');
                    $value['fabuzhe_name'] = $zhuanjiainfo['z_name'];
                    if (strpos($zhuanjiainfo['advertisement'],"http")===false) {
                        $value['fabuzhe_thumb'] = $_W['attachurl'].$zhuanjiainfo['advertisement'];
                    }else{
                        $value['fabuzhe_thumb'] = $zhuanjiainfo['advertisement'];
                    }


                    //查询专家所在机构
                    $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$zhuanjiainfo['hid']));
                    //查询专家职称
                    $zhuanjiazhichen = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['z_zhicheng']));
                    $value['zhuanjia_info'] = $zhuanjiajigou['agentname']." ".$zhuanjiazhichen['job_name'];
                }
                if ($value['user_identity']=='2') {
                    $value['fabuzhe_name'] = $value['virtual_name'];
                    $value['fabuzhe_thumb'] = $_W['attachurl'].$value['virtual_thumb'];
                }

            }
        }
        
        echo json_encode($res);
    }
        public function baogaodatainfo() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $a_id = $_GPC['a_id'];
        $openid = $_GPC['openid'];
        $res = pdo_fetch('SELECT * from' . tablename('hyb_yl_user_baogao') ." where uniacid =:uniacid and a_id=:a_id",array(":uniacid"=>$uniacid,":a_id"=>$a_id));
        $res['sharepic'] = unserialize($res['sharepic']);
        $res['times'] = date('Y-m-d H:i:s', $res['times']);
        $num = count($res['sharepic']);
        for ($i = 0;$i < $num;$i++) {
            if (strpos($res['sharepic'][$i],"http")===false) {
                $res['sharepic'][$i] = $_W['attachurl'] . $res['sharepic'][$i];
            }
            
        }
        //查询是否存在当前用户的点赞信息
        $model_dian = Model('userdianz');
        $dianzan = $model_dian->where('uniacid= "'.$uniacid .'" and openid="'.$openid.'" and p_id="'.$a_id.'" and type=4')->get();
        if($dianzan){
            $res['dianzan']=1;
        }else{
            $res['dianzan']=0;
        }
        if ($res['user_identity']=='0') {
            //查询普通用户
            $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$res['openid']));
            $res['fabuzhe_name'] = $userinfo['u_name'];
            $res['fabuzhe_thumb'] = $userinfo['u_thumb'];
        }
        if ($res['user_identity']=='1') {
            //查询专家
            $zhuanjiainfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$res['openid']));
            $res['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjiainfo['parentid']),'name');
            $res['fabuzhe_name'] = $zhuanjiainfo['z_name'];
            if (strpos($zhuanjiainfo['advertisement'],"http")===false) {
                $res['fabuzhe_thumb'] = $_W['attachurl'].$zhuanjiainfo['advertisement'];
            }else{
                $res['fabuzhe_thumb'] = $zhuanjiainfo['advertisement'];
            }

            //查询专家所在机构
            $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$zhuanjiainfo['hid']));
            //查询专家职称
            $zhuanjiazhichen = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['z_zhicheng']));
            $res['zhuanjia_info'] = $zhuanjiajigou['agentname']." ".$zhuanjiazhichen['job_name'];
        }
        if ($res['user_identity']=='2') {
            $res['fabuzhe_name'] = $res['virtual_name'];
            $res['fabuzhe_thumb'] = $_W['attachurl'].$res['virtual_thumb'];
        }
        echo json_encode($res);
    }
     /*分享全部评论*/
     public function baogaoallpinglunlist()
     {
        global $_GPC, $_W;
        $a_id = $_GPC['a_id'];
        $uniacid = $_W['uniacid'];  
        $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_baogaopinglunsite')."where uniacid='{$uniacid}' and a_id='{$a_id}' and parentid=0  and types=0 order by pl_time desc");

        foreach ($res as $key => $value) {
            $res[$key]['pl_text']= unserialize($res[$key]['pl_text']);
            $res[$key]['rcontent'] = $res[$key]['pl_text']['rcontent'];
            
            $count =count($res[$key]['pl_text']['estimatePicSmallUrl']);
            for ($i=0; $i <$count ; $i++) { 
                $res[$key]['estimatePicSmallUrl'][]=$_W['attachurl'].$res[$key]['pl_text']['estimatePicSmallUrl'][$i];
            }
            if (strpos($res[$key]['usertoux'],"http")===false) {
                $res[$key]['usertoux'] = $_W['attachurl'].$res[$key]['usertoux'];
            }
            $res[$key]['userIcon'] = $res[$key]['usertoux'];

            // $res[$key]['zhuanjia_zhiwu_openid'] = $res[$key]['useropenid'];
            if ($res[$key]['user_identity']=='1') {
                //查询专家
                $zhuanjiainfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$res[$key]['useropenid']));
                $res[$key]['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjiainfo['parentid']),'name');
                //查询专家所在机构
                $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$zhuanjiainfo['hid']));
                //查询专家职称
                $zhuanjiazhichen = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['z_zhicheng']));
                $res[$key]['zhuanjia_zhiwu'] = $zhuanjiajigou['agentname']." ".$zhuanjiazhichen['job_name'];
            }

            $res[$key]['rtimeDay'] =date("Y-m-d",$res[$key]['pl_time']); 
            $pl_id=$value['pl_id'];
            $res[$key]['listPatientBbsReplyReplyVO']=pdo_fetchall("SELECT * FROM".tablename('hyb_yl_baogaopinglunsite')."where uniacid='{$uniacid}' and a_id='{$a_id}' and parentid='{$pl_id}' and types=0 order by pl_time asc");

            foreach ($res[$key]['listPatientBbsReplyReplyVO'] as &$value1) {
                $value1['pl_text']=unserialize($value1['pl_text']);
                $value1['content'] =$value1['pl_text']['rcontent'];
                $value1['fromUidName'] =$value1['name'];
                $value1['hideFlag'] =6;
                $count2 =count($value1['pl_text']['estimatePicSmallUrl']);
                for ($i=0; $i <$count2 ; $i++) { 
                    $value1['estimatePicSmallUrl'][]=$_W['attachurl'].$value1['pl_text']['estimatePicSmallUrl'][$i];
                }
            }
       }
       echo json_encode($res);
    }
    //分享评论
     public function baogaopinglunadd()
     {
       global $_GPC, $_W;
       $model =Model('baogaopinglunsite');
       $uniacid = $_W['uniacid'];
       $a_id = $_GPC['a_id'];
       $data_arr1 =$_GPC['data_arr1'];
       $pl_content =$_GPC['pl_content'];
       $useropenid =$_GPC['useropenid'];
       $adminopenid = $_GPC['adminopenid'];
       $idarr = htmlspecialchars_decode($data_arr1);
       $array = json_decode($idarr);
       $object = json_decode(json_encode($array), true);
       $text =array(
         'estimatePicSmallUrl'=>$object,
         'rcontent'=>$pl_content
        );
        $pinglunzhe = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." where uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
        $shareinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_user_baogao")." WHERE uniacid=:uniacid and a_id=:a_id ",array(":uniacid"=>$uniacid,":a_id"=>$a_id));
        if ($shareinfo['openid']==$pinglunzhe['openid']) {
            $data['author'] = "1";
        }else{
            $data['author'] = "0";
        }
        $iszhuanjia = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
        if (!empty($iszhuanjia)) {
            $data['usertoux'] = $iszhuanjia['advertisement'];
            $data['name'] = $iszhuanjia['z_name'];
            $data['user_identity'] = "1";
        }else{
            $data['usertoux'] = $pinglunzhe['u_thumb'];
            $data['name'] = $pinglunzhe['u_name'];
            $data['user_identity'] = "0";
        }

        $data['uniacid'] = $uniacid;
        $data['a_id'] = $a_id;
        $data['useropenid'] = $useropenid;
        $data['adminopenid'] = $adminopenid;
        $data['pl_text'] = serialize($text);
        $data['types'] = $_GPC['types'];
        $data['pl_time'] = strtotime('now');
        $data['parentid'] = $_GPC['parentid'];
        $data['replyType'] = $_GPC['replyType'];
        $res = $model->add($data);
        echo json_encode($data);
     }
}


