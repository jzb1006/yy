<?php
/**
 *
 */
require_once(IA_ROOT . '/framework/library/qrcode/phpqrcode.php');
class Zhuanjia extends HYBPage {
    //查询服务医生没有经纬度的数据
    public function teamlist() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $res = pdo_fetchall("SELECT * FROM" . tablename('hyb_yl_zhuanjteam') . "where uniacid='{$uniacid}'");
        foreach ($res as $key => $value) {
            $res[$key]['teampic'] = $_W['attachurl'] . $res[$key]['teampic'];
        }
        echo json_encode($res);
    }
    public function listall() {
        global $_GPC, $_W;
        $model = Model('base');
        $uniacid = $_W['uniacid'];
        $server_key = $_GPC['ser_key'];
        $res = pdo_fetchall("SELECT a.*,b.* FROM" . tablename('hyb_yl_zhuanjia') . "as a left join".tablename('hyb_yl_doc_all_serverlist')."as b on b.zid =a.zid WHERE a.uniacid='{$uniacid}'");
        foreach ($res as $key => $value) {
            $zid = $value['zid'];
            $res[$key]['yearcad'] = pdo_fetch("SELECT * from" . tablename('hyb_yl_yearcard') . "where zid='{$zid}' and typs=1");
            $res[$key]['advertisement'] = tomedia($res[$key]['advertisement']);
            if ($server_key == $value['key_words']) {
                if($server_key =='shipinwenzhen'){
                    $docmoney = $value['ptmoney'];
                    $base_doc = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid),array('default_spprice'));
                    $default_spnum = $base_doc['default_spprice'];
                    $res[$key]['money'] = ($default_spnum + $docmoney);

                }elseif($server_key =='dianhuajizhen'){
                    $docmoney = $value['ptmoney'];
                    $base_doc = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid),array('default_telprice'));
                    $default_telprice = $base_doc['default_telprice'];
                    $res[$key]['money'] = ($default_telprice + $docmoney);
                }else{
                    $res[$key]['money'] = $value['ptmoney'];
                }
                
                echo json_encode($res);
            }
        }
    }
    public function getlistall() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $server_key = $_GPC['server_key'];
        $biaoqian = $_GPC['biaoqian'];
        $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
        $pagesize = empty($_GPC['pagback']) ? "10" : $_GPC['pagback'];
        $zhic = $_GPC['zhic'];
        $money = explode('-', $_GPC['money']);
        $smallmoney = $money[0];
        $bigmoney = $money[1];
        $hid = $_GPC['hid'];
        $openid = $_GPC['openid'];
        $wheres = '';
        $week = $_GPC['week'];
        $city = $_GPC['city'];

        if($hid != '' && $hid != 'undefined')
        {
            $wheres .= " and a.hid=".$hid;
        }
        if($id != '' && $id != 'undefined')
        {
            $wheres .= " and a.parentid=".$id;
        }
        if($server_key != 'yuanchengguahao' && $biaoqian != '' && $biaoqian != 'undefined')
         {
            $wheres .= " and a.authority regexp '{$biaoqian}'";
         }
         if($city != '' && $city != '全国')
         {
            $wheres .=" and a.address like '%$city%'";
         }

        if(empty($server_key) || $server_key=='undefined' ){
            $doc_rul = pdo_get('hyb_yl_zhuanjia_rule',array('uniacid'=>$uniacid),array('sort_type'));
            if($doc_rul['sort_type'] == '0'){
               $whe .= " order by a.zid asc";
            } 
            if($doc_rul['sort_type'] == '1'){
               $whe .= " order by a.opentime desc";
            } 
            if($doc_rul['sort_type'] == '2'){
               $whe .= " order by a.zid asc";
            } 
            if($zhic){
              $where ="where a.uniacid ='{$uniacid}' ".$wheres." and b.job_name='{$zhic}' ".$whe." limit ".$page * $pagesize.",".$pagesize ; 

            }else{
               $where ="where a.uniacid ='{$uniacid}' ".$wheres."  ".$whe." limit ".$page * $pagesize.",".$pagesize;   
            }
            

            $row = pdo_fetchall("SELECT * FROM" . tablename('hyb_yl_zhuanjia') . "as a left join".tablename('hyb_yl_zhuanjia_job')."as b on b.id=a.z_zhicheng {$where}");

      
            foreach ($row as $key => $value) {
                $zid = $value['zid'];
                $where2="WHERE uniacid = '{$uniacid}' and zid='{$zid}'";
                $row[$key]['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$row[$key]['parentid']),'name');
                $row[$key]['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$row[$key]['hid']),'agentname');
                $row[$key]['grade'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$row[$key]['hid']),'grade');
                        
                $row[$key]['leve'] = pdo_getcolumn("hyb_yl_hospital_level",array("id"=>$row[$key]['grade']),'level_name');
                // $row[$key]['leve'] = pdo_getcolumn("hyb_yl_hospital_level",array("id"=>$row[$key]['hid']['grade']),'level_name');

                $row[$key]['yearcad'] = pdo_fetch("SELECT * from" . tablename('hyb_yl_yearcard') . "where zid='{$zid}' and typs=1 and status=1");
                $row[$key]['advertisement'] = tomedia($row[$key]['advertisement']);
                $row[$key]['server'] = pdo_fetchall("SELECT key_words,titlme,ptmoney,hymoney from".tablename('hyb_yl_doc_all_serverlist')."{$where2}");
                $rows[$k]['serverss'] = pdo_getall("hyb_yl_doc_all_serverlist",array("zid"=>$v['zid'],"uniacid"=>$uniacid,"stateback"=>'1'));
                $rows[$k]['servers'] = pdo_fetch("select a.*,b.ser_url from ".tablename("hyb_yl_doc_all_serverlist")." as a left join ".tablename("hyb_yl_all_server_menulist")." as b on a.key_words=b.server_key where a.zid=".$v['zid']." and a.uniacid=".$uniacid." and a.key_words='".$server_key."' and a.stateback=1");
                $row[$key]['jingxuan'] = explode(',', $value['jingxuan']);
            }
            
        }else{

            if($server_key == 'tijianjiedu' && $openid != '')
            {
                $zids = pdo_fetchall("select goods_id from ".tablename("hyb_yl_attention")." where uniacid=".$uniacid." and cerated_type=0 and ifqianyue=2 and openid='".$openid."'");
            
                $zidss = '';
                foreach($zids as &$vv)
                {
                    $zidss .= $zidss.",";
                }
                $zidss = substr($zidss,0,strlen($zidss)-1);
                $wheress = " and zid in (".$zidss.")";
                
                $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_doc_all_serverlist')."WHERE uniacid='{$uniacid}' and key_words='{$server_key}' and stateback=1".$wheress);
            }else{
                $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_doc_all_serverlist')."WHERE uniacid='{$uniacid}' and key_words='{$server_key}' and stateback=1 ");

            }


            $row = array();
            
            foreach($res as $kk => $vv)
            {

                $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$vv['zid']));
                $zid = $vv['zid'];
                if($week != '')
                {
                    // $doc_jobtime = pdo_get("hyb_yl_docjobtime",array("uniacid"=>$uniacid,"zid"=>$zid));
                    $doc_jobtime = pdo_get("hyb_yl_docjobtime",array("uniacid"=>$uniacid,"id"=>$zhuanjia['jobtime']));
                    
                    $doc_jobtime = unserialize($doc_jobtime['server_time']);
                    $week_arr = array_column($doc_jobtime, 'week');
                    
                    if(!$doc_jobtime || in_array($week, $week_arr) === false)
                    {

                        unset($res[$kk]);
                    }
                    
                }
            }

            if(count($res) > 0)
            {
                $doc_rul = pdo_get('hyb_yl_zhuanjia_rule',array('uniacid'=>$uniacid),array('sort_type'));
                if($doc_rul['sort_type'] == '0'){
                   $whe .= " order by zid asc";
                } 
                if($doc_rul['sort_type'] == '1'){
                   $whe .= " order by opentime desc";
                } 
                if($doc_rul['sort_type'] == '2'){
                   $whe .= " order by zid asc";
                } 
                foreach ($res as $key => $value) {
                    $zid = $value['zid'];
                    $wheres = '';
                    
                    if($hid != '')
                    {
                        $wheres .= " and hid=".$hid;
                    }
                    if($id != '' && $id != 'undefined')
                    {
                        $wheres .= " and parentid=".$id;
                    }
                    if($server_key != 'yuanchengguahao' && $biaoqian != '' && $biaoqian != 'undefined')
                    {
                        $wheres .= " and authority regexp '{$biaoqian}'";
                    }
                    if($city != '' && $city != '全国')
                     {
                        $wheres .=" and address like '%$city%'";
                     }
                    if($_GPC['dex']){

                        if($_GPC['dex'] =='0'){
                            $where ="where  uniacid ='{$uniacid}' ".$wheres." and zid='{$zid}' order by zid desc limit ".$page * $pagesize.",".$pagesize ; 
                        }
                        if($_GPC['dex'] =='1'){
                           $where ="where uniacid ='{$uniacid}'".$wheres." and zid='{$zid}'  order by xn_reoly desc limit ".$page * $pagesize.",".$pagesize ; 
                        }
                        if($_GPC['dex'] =='2'){
                           $where ="where uniacid ='{$uniacid}'".$wheres." and zid='{$zid}' order by score desc limit ".$page * $pagesize.",".$pagesize ; 
                        }
                        if($_GPC['dex'] =='3'){
                           $where ="where uniacid ='{$uniacid}'".$wheres." and zid='{$zid}' order by xytime desc limit ".$page * $pagesize.",".$pagesize ; 
                        }
                        if($_GPC['dex'] =='4'){
                           $where ="where uniacid ='{$uniacid}'".$wheres." and zid='{$zid}' order by score desc limit ".$page * $pagesize.",".$pagesize ; 
                        }
                    }else{

                        $where ="where uniacid ='{$uniacid}'".$wheres." and zid='{$zid}' ".$whe." limit ".$page * $pagesize.",".$pagesize ; 
                    }
                    
                    $rows =pdo_fetchall("SELECT * FROM " . tablename('hyb_yl_zhuanjia') . " {$where}");
                   
 
                    foreach ($rows as $k => $v) {
                        $rows[$k]['yearcad'] = pdo_fetch("SELECT * from" . tablename('hyb_yl_yearcard') . "where zid='{$v['zid']}' and typs=1 and status=1");
                        $rows[$k]['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$rows[$k]['parentid']),'name');
                        $rows[$k]['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$rows[$k]['hid']),'agentname');
                        $rows[$k]['grade'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$rows[$k]['hid']),'grade');
                        $rows[$k]['advertisement'] = tomedia($rows[$k]['advertisement']);
                        $rows[$k]['leve'] = pdo_getcolumn("hyb_yl_hospital_level",array("id"=>$rows[$k]['grade']),'level_name');
                        $rows[$k]['serverss'] = pdo_getall("hyb_yl_doc_all_serverlist",array("zid"=>$v['zid'],"uniacid"=>$uniacid,"stateback"=>'1'));
                        $rows[$k]['servers'] = pdo_fetch("select a.*,b.ser_url from ".tablename("hyb_yl_doc_all_serverlist")." as a left join ".tablename("hyb_yl_all_server_menulist")." as b on a.key_words=b.server_key where a.zid=".$v['zid']." and a.uniacid=".$uniacid." and a.key_words='".$server_key."' and a.stateback=1");
                
                        $rows[$k]['job'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$v['z_zhicheng']),'job_name');
                        if($server_key =='shipinwenzhen'){
                            $docmoney = $value['ptmoney'];
                            $base_doc = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid),array('default_spprice'));
                            $default_spnum = $base_doc['default_spprice'];
                            $rows[$k]['money'] = ($default_spnum + $docmoney);
                        }elseif($server_key =='dianhuajizhen'){
                            $docmoney = $value['ptmoney'];
                            $base_doc = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid),array('default_telprice'));
                            $default_telprice = $base_doc['default_telprice'];
                            $rows[$k]['money'] = ($default_telprice + $docmoney);
                        }else{
                            $rows[$k]['money'] = $value['ptmoney'];
                        }
                        $rows[$k]['jingxuan'] = explode(',', $v['jingxuan']);
                    }
                    
                    $row = array_merge($row,$rows);
                }
                
            }else{

                $row = [];
            }
            
        }
        
       echo json_encode($row);
        
    }
    // 获取地址
    public function address_one()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $list = pdo_getall("hyb_yl_address",array("uniacid"=>$uniacid,"pid"=>'0'));
        $arr = array(
            'id'=>'',
            'name' => '热门城市',
        );
        array_push($list,$arr);
        echo json_encode($list);
    }
    // 获取地址二级
    public function address_two()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $list = pdo_getall("hyb_yl_address",array("uniacid"=>$uniacid,"pid"=>$id));
        echo json_encode($list);
    }
    // 获取热门地区
    public function hot_address()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $list = pdo_getall("hyb_yl_address",array("uniacid"=>$uniacid,"is_host"=>'1',"pid"=>'0','status'=>'1'));
        
        echo json_encode($list);
    }
    // 获取手术安排专家
    public function operation()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];

    }
    //专家详情带关键词
    public function docinfo() {
        global $_GPC, $_W;
        $model = Model('zhuanjia');
        $hospital = Model('hospital');
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $key = $_GPC['key'];
        $server_key = $_GPC['key'];
        $openid = $_GPC['openid'];
        if($openid != '')
        {
          $user = pdo_get("hyb_yl_userinfo",array("uniacid"=>$uniacid,"openid"=>$openid));
          if($user['adminuserdj'] != '0' && $user['adminguanbi'] > time())
          {
            $item['vip'] = true;
            $is_vip = true;
          }else{
            $item['vip'] = false;
            $is_vip = false;
          }
          $res = pdo_get("hyb_yl_visit",array("openid"=>$openid,"zid"=>$zid,"type"=>'1','day'=>date("Y-m-d",time())));
          if(!$res)
          {
              $visit = array(
                'uniacid' => $uniacid,
                "openid" => $openid,
                "zid" => $zid,
                "type" =>'1',
                "day" => date("Y-m-d",time()),
                "created" => time(),
              );
              pdo_insert("hyb_yl_visit",$visit);
          }
        }
        $res = pdo_fetch("SELECT  a.*,b.id,b.ctname,c.agentname,c.hid,d.level_name FROM " . tablename("hyb_yl_zhuanjia") . " as a left join " . tablename("hyb_yl_classgory") . " as b on a.z_room=b.id left join" . tablename('hyb_yl_hospital') . "as c on c.hid=a.hid left join" . tablename('hyb_yl_hospital_level') . "as d on d.id=c.grade where a.zid='{$zid}' and a.uniacid='{$uniacid}'");

        $zid = $res['zid'];
        //查询专家响应时间
        $cout = pdo_fetchcolumn("SELECT count(*) FROM" . tablename('hyb_yl_twenorder') . "where uniacid='{$uniacid}' and role=1 and zid='{$zid}'");
        $big_time = pdo_fetch("SELECT `time` FROM" . tablename('hyb_yl_twenorder') . "where uniacid='{$uniacid}' and role=1 and zid='{$zid}' order by id asc limit 1");
        $smail_time = pdo_fetch("SELECT `time` FROM" . tablename('hyb_yl_twenorder') . "where uniacid='{$uniacid}' and role=1 and zid='{$zid}' order by id desc limit 1");
        $big_time_time_time = $this->HisToS($big_time['time']);
        $smail_time_time = $this->HisToS($smail_time['time']);
        $time_cout = intval($cout);
        $spacing = ($smail_time_time - $big_time_time_time) / $time_cout;
        // $new_over_time = $this->SToHis($spacing);
        // pdo_update("hyb_yl_zhuanjia", array('xytime' => $new_over_time), array('zid' => $zid));
        // $res['xytime'] = $new_over_time;
        $res['advertisement'] = tomedia($res['advertisement']);
        $res['share_erweima'] = tomedia($res['share_erweima']);
        $res['authority'] = explode('、', $res['authority']);
        $res['plugin'] = unserialize($res['plugin']);
        $res['jingxuan'] = explode(',', $res['jingxuan']);
        $result2 = [];
        array_map(function ($value) use(&$result2) {
            $result2 = array_merge($result2, array_values($value));
        }, $res['plugin']);
        $res['plugin'] = $result2;
        $res['advertisement'] = tomedia($res['advertisement']);

        foreach ($result2 as $k => $v) {
            if ($server_key == $v['key_words']) {
              // if($is_vip)
              // {
              //   $res['money'] = $v['hymoney'];
              // }else{
                $res['money'] = $v['ptmoney'];
              // }
                
                $res['ptzhuiw'] = $v['ptzhuiw'];
                $row = pdo_fetch("SELECT * from" . tablename('hyb_yl_yearcard') . "where zid='{$zid}' and typs=1 and status=1");
                $row['new_price'] = (float)($row['new_price']);
                $row['money'] = ($row['wz_num'] * $res['money']); //总花费
                $row['newmoney'] = $row['old_price'];
                $res['yearcad'] = $row;
               
            }
        }
         echo json_encode($res);
    }
    //不带关键词的专家详情
    public function getdocinfo() {
        global $_GPC, $_W;
        $model = Model('zhuanjia');
        $hospital = Model('hospital');
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $key = $_GPC['key'];
        $openid = $_GPC['openid'];
        
        $res = pdo_fetch("SELECT  a.*,b.id,b.ctname,c.agentname,c.hid,d.level_name FROM " . tablename("hyb_yl_zhuanjia") . " as a left join " . tablename("hyb_yl_classgory") . " as b on a.z_room=b.id left join" . tablename('hyb_yl_hospital') . "as c on c.hid=a.hid left join" . tablename('hyb_yl_hospital_level') . "as d on d.id=c.grade where a.zid='{$zid}' and a.uniacid='{$uniacid}'");
        if($openid != '')
        {
          $user = pdo_get("hyb_yl_userinfo",array("uniacid"=>$uniacid,"openid"=>$openid));
          if($user['adminuserdj'] != '0' && $user['adminguanbi'] > time())
          {
            $res['vip'] = true;
          }else{
            $res['vip'] = false;
          }
          $res1 = pdo_get("hyb_yl_visit",array("openid"=>$openid,"zid"=>$zid,"type"=>'1','day'=>date("Y-m-d",time())));
          if(!$res1)
          {
              $visit = array(
                'uniacid' => $uniacid,
                "openid" => $openid,
                "zid" => $zid,
                "type" =>'1',
                "day" => date("Y-m-d",time()),
                "created" => time(),
              );
              pdo_insert("hyb_yl_visit",$visit);
          }
        }
        $zid = $res['zid'];
        //查询专家响应时间
        $cout = pdo_fetchcolumn("SELECT count(*) FROM" . tablename('hyb_yl_twenorder') . "where uniacid='{$uniacid}' and role=1 and zid='{$zid}'");
        $big_time = pdo_fetch("SELECT `time` FROM" . tablename('hyb_yl_twenorder') . "where uniacid='{$uniacid}' and role=1 and zid='{$zid}' order by id asc limit 1");
        $smail_time = pdo_fetch("SELECT `time` FROM" . tablename('hyb_yl_twenorder') . "where uniacid='{$uniacid}' and role=1 and zid='{$zid}' order by id desc limit 1");
        $big_time_time_time = $this->HisToS($big_time['time']);
        $smail_time_time = $this->HisToS($smail_time['time']);
        $time_cout = intval($cout);
        $spacing = ($smail_time_time - $big_time_time_time) / $time_cout;
        // $new_over_time = $this->SToHis($spacing);
        // pdo_update("hyb_yl_zhuanjia", array('xytime' => $new_over_time), array('zid' => $zid));
        // $res['xytime'] = $new_over_time;
        if($res['video'] != '')
        {
            $res['video'] = tomedia($res['video']);
            // $getVideo = require_once dirname(dirname(dirname(__FILE__)))."/getVideo.php";
            // $getVideo = new getVideo();
            
        }
        if($res['video_thumb'] != '')
        {
            $res['video_thumb'] = tomedia($res['video_thumb']);
        }
        
        $res['advertisement'] = tomedia($res['advertisement']);
        $res['share_erweima'] = $_W['siteroot'].$res['share_erweima'];
        $res['authority'] = explode('、', $res['authority']);
        $res['jingxuan'] = explode(',', $res['jingxuan']);
        $authority = $res['authority'];
        $res['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$res['z_zhicheng']),'job_name');
        foreach ($authority as $ky => $ve) {
            $count[] = pdo_fetchcolumn("SELECT count(*) from".tablename('hyb_yl_twenorder')." where uniacid='{$uniacid}' and role=0 and ifgk=1 and zid='{$zid}' and biaoqian regexp '{$ve}' ");
        }
         $result_n= [];
         array_map(function ($value) use (&$result_n) {
            $result_n = array_merge($result_n, array_values($value));
         }, $count); 

        foreach ($authority as $keyy => $valuee) {
           $new_authority[$keyy]['bq'] = $authority[$keyy];
           $new_authority[$keyy]['cout'] = $count[$keyy];
        }
        $res['authority'] = $new_authority;
        $res['plugin'] = unserialize($res['plugin']);
        $result2 = [];
        array_map(function ($value) use(&$result2) {
            $result2 = array_merge($result2, array_values($value));
        }, $res['plugin']);
        $res['plugin'] = $result2;
        $res['advertisement'] = tomedia($res['advertisement']);
        foreach ($result2 as $k => $v) {
            $res['money'] = $v['ptmoney'];
            $res['money'] = $v['ptmoney'];
            $row = pdo_fetch("SELECT * from" . tablename('hyb_yl_yearcard') . "where zid='{$zid}' and typs=1 and status=1");
            if($row)
            {
                $row['new_price'] = (float)($row['new_price']);
                $row['money'] = ($row['wz_num'] * $res['money']); //总花费
                $row['newmoney'] =  $row['old_price'];
            }
            
            $res['yearcad'] = $row;
        }
        echo json_encode($res);
    }
    public function biaoqhuanz()
    {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $biaoqian = $_GPC['biaoqian'];
         $zid = $_GPC['zid'];
         $list =  pdo_fetchall("SELECT * from".tablename('hyb_yl_userlabelarr')." where uniacid='{$uniacid}' and zid='{$zid}' and label regexp '{$biaoqian}'  ");
         foreach ($list as $key => $value) {
             $openid = $value['openid'];
             $list[$key]['user'] = pdo_get('hyb_yl_userjiaren',array('openid'=>$openid,'sick_index'=>0));
             $openid = $list[$key]['user']['openid'];
             $list[$key]['user']['u_thumb'] = pdo_getcolumn('hyb_yl_userinfo',array('openid'=>$openid),'u_thumb');
         }
         echo json_encode($list);
    }
    public function biaoqian()
    {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        require_once dirname(dirname(dirname(__FILE__))) . "/class/Pingyin.class.php";
        $Pingyin = new Pingyin();
        $res = pdo_fetch("SELECT  a.*,b.id,b.ctname,c.agentname,c.hid,d.level_name FROM " . tablename("hyb_yl_zhuanjia") . " as a left join " . tablename("hyb_yl_classgory") . " as b on a.z_room=b.id left join" . tablename('hyb_yl_hospital') . "as c on c.hid=a.hid left join" . tablename('hyb_yl_hospital_level') . "as d on d.id=c.grade where a.zid='{$zid}' and a.uniacid='{$uniacid}' ");
        $res['authority'] = explode('、', $res['authority']);
        $authority = $res['authority'];
        
        $weifenzu1 = pdo_fetchall("SELECT * from".tablename('hyb_yl_twenorder')."where zid='{$zid}' and uniacid='{$uniacid}' group by openid desc");

        foreach ($weifenzu1 as $key => $value) {
            $openid = $value['openid'];
            $userinfo1[] = pdo_fetch("select a.u_name,a.openid,a.u_id,a.u_thumb,b.label from".tablename('hyb_yl_userinfo')."as a left join".tablename('hyb_yl_userlabelarr')."as b on b.openid=a.openid where a.uniacid='{$uniacid}' and a.openid='{$openid}'");
                foreach ($userinfo1 as $key5 => $value5) {
                   $openid = $value5['openid'];
                   $userinfo1[$key]['user'] = pdo_get("hyb_yl_userjiaren",array('openid'=>$openid,'sick_index'=>0));
                }

        }
        $weifenzu2 = pdo_fetchall("SELECT * from".tablename('hyb_yl_wenzorder')."where zid='{$zid}' and uniacid='{$uniacid}' group by openid desc");
        foreach ($weifenzu2 as $key => $value) {
            $openid = $value['openid'];
            $userinfo2[] = pdo_fetch("select a.u_name,a.openid,a.u_id,a.u_thumb,b.label from".tablename('hyb_yl_userinfo')."as a left join".tablename('hyb_yl_userlabelarr')."as b on b.openid=a.openid where a.uniacid='{$uniacid}' and a.openid='{$openid}'");
                foreach ($userinfo2 as $key4 => $value4) {
                   $openid = $value4['openid'];
                   $userinfo2[$key]['user'] = pdo_get("hyb_yl_userjiaren",array('openid'=>$openid,'sick_index'=>0));
                }
        }
        $userinfo3 = array_merge($userinfo1,$userinfo2);
        $userinfo4 = $this->assoc_unique($userinfo3,'openid');
        foreach ($userinfo4 as $key3 => $value3) {
            if(empty($value3['label'])){
                $fenzuwei[]=$value3;
            }else{
                $yifen[]=$value3['label'];
            }
        }

        foreach ($userinfo4 as $key2 => $value2) {
            $openid =$value2['openid'];
            $userinfo4[$key2]['label'] = pdo_getcolumn('hyb_yl_userlabelarr',array('openid'=>$openid,'zid'=>$zid),'label');
            if(!$userinfo4[$key2]['label']){
              $userinfo5[] = pdo_get('hyb_yl_userlabelarr',array('openid'=>$openid,'zid'=>$zid),'label');
            }
        }
       
        $overbiaoqian =array_filter(array_unique(array_merge($yifen,$authority)));
    
        foreach ($overbiaoqian as $key => $value) {
           $authority2[]=$Pingyin->getFirstCharter($value);
           $zong = pdo_fetchall("SELECT * from".tablename('hyb_yl_userlabelarr')." where uniacid='{$uniacid}' and zid='{$zid}' and label regexp '{$value}' group by openid ");

           foreach ($zong as $key2 => $value2) {
               $openid = $value2['openid'];
               $user[] = pdo_get('hyb_yl_userinfo',array('openid'=>$openid));
           }
           $count[] = count($zong);
        }
        foreach ($overbiaoqian as $key => $value) {
            $newdate[$key]['description']=$overbiaoqian[$key];  
            $newdate[$key]['py']=$authority2[$key];
            $newdate[$key]['count']=$count[$key];
        }
        $result = [];
        foreach($newdate as $key=>$value){
            $result[$value['py']][] = $value;
        }
        $data =array(
            'weifenzu'=>count($fenzuwei),
            'fenzu'   =>$result,
            'list'    =>$fenzuwei,
            'all'     =>$overbiaoqian
            );
        echo json_encode($data);
    }
    public function callback($input){
      return $input['province_code']=='AH'? true : false;
    }
    public function assoc_unique($arr, $key) {
 
        $tmp_arr = array();
         
        foreach ($arr as $k => $v) {
         
        if (in_array($v[$key], $tmp_arr)) {//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
         
        unset($arr[$k]);
         
        } else {
         
        $tmp_arr[] = $v[$key];
         
        }
         
        }
         
        sort($arr); //sort函数对数组进行排序
         
        return $arr;
         
    }
    //平台服务
    public function server() {
        global $_GPC, $_W;
        $model = Model('docser_speck');
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $openid = $_GPC['openid'];
        $user_vip = pdo_fetchall("select v.* from ".tablename("hyb_yl_vip_log")." as a left join ".tablename("hyb_yl_vip")." as b on b.id=a.vip left join ".tablename("hyb_yl_vip_quanyi")." as v on v.id=b.quanyi where v.uniacid=".$uniacid." and a.openid=".$openid." and endtime>'".time()."' and startime <='".time()."'");
        if($user_vip)
        {
            $quanyi = json_decode($user_vip['quanyi']);
        }
        $res = $model->where("uniacid='" . $uniacid . "'")->getall();
        //查询专家开通的服务
        $doc_ser = pdo_fetchall("SELECT * from" . tablename('hyb_yl_doc_all_serverlist') . "where uniacid='{$uniacid}' and zid ='{$zid}' and stateback=1");
        foreach ($doc_ser as $k => $v) {
            $bid = $v['bid'];
            $list = pdo_fetch("SELECT icon,ftitle,url FROM" . tablename('hyb_yl_docser_speck') . "where uniacid ='{$uniacid}' and id ='{$bid}'");
            $list['icon'] = tomedia($list['icon']);
            $base_doc = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid),array('default_telprice','default_spprice'));
            $doc_ser[$k]['info'] = $list;
            $doc_ser[$k]['url'] = $list['url'];

            if($v['key_words'] =='dianhuajizhen'){
              $doc_ser[$k]['ptmoney'] =($v['ptmoney'] + $base_doc['default_telprice']);
            }
            if($v['key_words'] =='shipinwenzhen'){
              $doc_ser[$k]['ptmoney'] =($v['ptmoney'] + $base_doc['default_spprice']);
            }  
            if(in_array($v['titlme'], $quanyi) && !empty($doc_ser[$k]['hymoney'])){
                $doc_ser[$k]['moneys'] = $doc_ser[$k]['hymoney'];
            }else if(in_array($v['titlme'], $quanyi) && empty($doc_ser[$k]['hymoney']))
            {
                $doc_ser[$k]['moneys'] = $doc_ser[$k]['ptmoney'] * $user_vip['zhekou'];
            }
            else{
                $doc_ser[$k]['moneys'] = $doc_ser[$k]['ptmoney'];
            }
            if (in_array($v['key_words'], $key_words)) {
                $doc_ser[$k]['open'] = '1';
            } else {
                $doc_ser[$k]['open'] = '0';
            }
        }
        echo json_encode($doc_ser);
    }
    //医说记录
    public function yishuo() {
    }
    //合作医院
    public function cooperative_hospital() {
        global $_GPC, $_W;
        $model = Model('hospital');
        $uniacid = $_W['uniacid'];
        $res = $model->where("uniacid='" . $uniacid . "'")->getall();
        foreach ($res as $key => $value) {
            $res[$key]['logo'] = $_W['attachurl'] . $res[$key]['logo'];
        }
        echo json_encode($res);
    }
    //合作医院详情
    public function hospital_info() {
        global $_GPC, $_W;
        $model = Model('hospital');
        $uniacid = $_W['uniacid'];
        $hid = $_GPC['hid'];
        $res = $model->where('uniacid="' . $uniacid . '" and hid="' . $hid . '"')->get();
        $res['logo'] = $_W['attachurl'] . $res['logo'];
        echo json_encode($res);
    }
    //专病服务----资讯分类
    public function zixunfenlei() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $model = Model('zixun_type');
        $res = $model->where("uniacid='" . $uniacid . "'")->getall();
        foreach ($res as $key => $value) {
            $res[$key]['zx_thumb'] = $_W['attachurl'] . $res[$key]['zx_thumb'];
        }
        echo json_encode($res);
    }
    public function alldoc() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zjlist = pdo_fetchall("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . " as zj left join " . tablename("hyb_yl_category") . " as k on zj.z_room=k.id where zj.uniacid='{$uniacid}'  and zj.exa = 1 order by zj.sord asc");
        foreach ($zjlist as & $value) {
            $value['z_thumbs'] = $_W['attachurl'] . $value['z_thumbs'];
            $value['url'] = unserialize($value['url']);
        }
        echo json_encode($zjlist);
    }
    public function zhuanjiajinw() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $lng = $_GPC['jingdu'];
        $lat = $_GPC['latitude'];
        $distance = 20;
        //范围（单位千米）
        define('EARTH_RADIUS', 6371);
        //地球半径，平均半径为6371km
        $dlng = 2 * asin(sin($distance / (2 * EARTH_RADIUS)) / cos(deg2rad($lat)));
        $dlng = rad2deg($dlng);
        $dlat = $distance / EARTH_RADIUS;
        $dlat = rad2deg($dlat);
        $squares = array('left-top' => array('lat' => $lat + $dlat, 'lng' => $lng - $dlng), 'right-top' => array('lat' => $lat + $dlat, 'lng' => $lng + $dlng), 'left-bottom' => array('lat' => $lat - $dlat, 'lng' => $lng - $dlng), 'right-bottom' => array('lat' => $lat - $dlat, 'lng' => $lng + $dlng));
        $newlat = $squares['right-bottom']['lat'];
        $newlattop = $squares['left-top']['lat'];
        $newlng = $squares['right-bottom']['lng'];
        $newlngtop = $squares['left-top']['lng'];
        $op = $_GPC['op'];
        if ($op == 'display') {
            $zjlist = pdo_fetchall("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . "where lat<{$newlattop} and lng>'{$newlngtop}' and lng<'{$newlng}'  and exa = 1 order by sord asc");
            foreach ($zjlist as & $value) {
                $value['z_thumbs'] = $_W['attachurl'] . $value['z_thumbs'];
                $value['url'] = unserialize($value['url']);
                $value['z_zhenzhi'] = explode(',', $value['z_zhenzhi']);
            }
            echo json_encode($zjlist);
        }
        if ($op == 'post') {
            $zid = $_GPC['zid'];
            $zjlist = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . "where exa = 1 and zid='{$zid}'");
            $zjlist['z_thumbs'] = $_W['attachurl'] . $zjlist['z_thumbs'];
            $zjlist['z_zhenzhi'] = explode(',', $zjlist['z_zhenzhi']);
            echo json_encode($zjlist);
        }
    }
    //关注医生
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
    //是否关注
    public function ifguanzhu() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $goods_id = $_GPC['zid'];
        $openid = $_GPC['openid'];
        $cerated_type = $_GPC['cerated_type'];
        $model = Model('attention');
        $get_one = $model->where('uniacid="' . $uniacid . '" and goods_id="' . $goods_id . '" and cerated_type="' . $cerated_type . '" and openid="' . $openid . '"')->get();
        if ($get_one) {
            echo '1';
        } else {
            echo '0';
        }
    }
    //查询医生个人id
    public function ifzj() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $model = Model('zhuanjia');
        $get_one = $model->where('uniacid="' . $uniacid . '" and openid="' . $openid . '"')->get('zid,exa');
        echo json_encode($get_one);
    }
    public function pjlist() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $res = pdo_fetchall("SELECT a.*,b.names,c.name,c.pinyin FROM" . tablename('hyb_yl_pingjia') . "as a left join" . tablename('hyb_yl_userjiaren') . "as b on b.j_id=a.j_id left join" . tablename('hyb_yl_servicemenu') . "as c on c.pinyin=a.keywords where a.zid='{$zid}'");
        foreach ($res as $key => $value) {
            $res[$key]["createTime"] = date("Y-m-d", $res[$key]["createTime"]);
        }
        echo json_encode($res);
    }
    
  public function docerweimainfo() {

        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = intval($_GPC['zid']);
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
                
                $overerwei = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . "WHERE zid = '{$zid}' and uniacid='{$uniacid}'");
                $headurl = tomedia($overerwei['advertisement']);
                if($headurl)
                {
                  
                  $erweimas = $this->changeAvatar("../".$filepathsss,$headurl,$zid);
                  $erweimas = substr($erweimas, 3);
                  $datas = array('weweima' => $erweimas);
                  $getupdate = pdo_update("hyb_yl_zhuanjia", $datas, array('zid' => $zid, 'uniacid' => $uniacid));
                  $siteroot = $_W['siteroot'];
                    $overerwei = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . "WHERE zid = '{$zid}' and uniacid='{$uniacid}'");
                    $overerwei['advertisement'] =tomedia($overerwei['advertisement']);
                    $overerwei['weweima'] = $_W['siteroot'].$overerwei['weweima'];

                }
                
            }
        } else {
            $siteroot = $_W['siteroot'];
            $overerwei = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . "WHERE zid = '{$zid}' and uniacid='{$uniacid}'");
            $overerwei['advertisement'] =tomedia($overerwei['advertisement']);
            $overerwei['weweima'] = $_W['siteroot'].$overerwei['weweima'];
        }
        echo json_encode($overerwei);
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
    //生成海报
    public function docgenerate() {

        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = intval($_GPC['zid']);
        $get_one_info = pdo_get("hyb_yl_zhuanjia", array('zid' => $zid));
        $string = $get_one_info['z_name'];
        $get_one_thumb = $_W['attachurl'] . $get_one_info['z_thumbs'];
        $weweima = $_W['siteroot'] . $get_one_info['weweima'];
        $string_sc = $get_one_info['z_zhenzhi'];
        $base = pdo_getcolumn("hyb_yl_zhuanjia_rule",array("uniacid"=>$uniacid),'background');
        $get_one_info['background'] = $base;
        $get_one_info['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$get_one_info['parentid']),'name');
        $get_one_info['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$get_one_info['z_zhicheng']),'job_name');
        $get_one_info['labels'] = $get_one_info['keshi']."|".$get_one_info['zhicheng'];
        $get_one_info['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$get_one_info['hid']),'agentname');
        $get_one_info['shanchan'] = "擅长：".$get_one_info['authority'];
        if(empty($get_one_info['share_erweima']))
        {
          require_once dirname(dirname(dirname(__FILE__))) . "/class/playbill.php";
          $model = new playbill();
          $dir = iconv("UTF-8", "GBK", "../attachment/hyb_yl/share_{$uniacid}");
          if (!file_exists($dir)){
              mkdir ($dir,0777,true);
          } 
          $config = array(
            'text'=>array(
              array(
                'text'=>$get_one_info['z_name'],
                'left'=>60,
                'top'=>900,
                'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                'fontSize'=>54,             //字号
                'fontColor'=>'0,0,0',       //字体颜色
                'angle'=>0,
              ),
            ),
            'labels'=>array(
              array(
                'text'=>$get_one_info['labels'],
                'left'=>60,
                'top'=>980,
                'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                'fontSize'=>30,             //字号
                'fontColor'=>'0,0,0',       //字体颜色
                'angle'=>0,
              ),
            ),
            'hospital'=>array(
              array(
                'text'=>$get_one_info['hospital'],
                'left'=>60,
                'top'=>1030,
                'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                'fontSize'=>30,             //字号
                'fontColor'=>'0,0,0',       //字体颜色
                'angle'=>0,
              ),
            ),
            'shanchan'=>array(
              array(
                'text'=>$get_one_info['shanchan'],
                'left'=>60,
                'top'=>1130,
                'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                'fontSize'=>24,             //字号
                'fontColor'=>'0,0,0',       //字体颜色
                'angle'=>0,
              ),
            ),
            'image'=>array(
              array(
                'url'=>$weweima,     //二维码资源
                'stream'=>0,
                'left'=>520,
                'top'=>900,
                'right'=>0,
                'bottom'=>0,
                'width'=>170,
                'height'=>170,
                'opacity'=>100
              )
            ),
            'tximage'=>array(
              array(
                'url'=>tomedia($get_one_info['advertisement']),     //专家图资源
                'stream'=>0,
                'left'=>0,
                'top'=>0,
                'right'=>0,
                'bottom'=>0,
                'width'=>750,
                'height'=>750,
                'opacity'=>100
              )
            ),
            'background'=>'../addons/hyb_yl/public/images/share.png',         
          );
     
          $image_name = "id_".rand(). ".jpg";
          $filename = "../attachment/hyb_yl/{$image_name}";
          $filename_back = "attachment/hyb_yl/{$image_name}";
          $res = $model->createerweima($config,$filename);
      
          
          pdo_update("hyb_yl_zhuanjia",array("share_erweima"=>$filename_back),array('zid'=>$zid,'uniacid'=>$uniacid));
          $newinfo = pdo_get("hyb_yl_zhuanjia",array('zid'=>$zid));
          echo json_encode($_W['siteroot'].$newinfo['share_erweima']);
        }else{
          echo json_encode($_W['siteroot'].$get_one_info['share_erweima']);
        }
    }
    //推客海报
    public function tuikehaibao() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = intval($_GPC['zid']);
        $openid = $_GPC['openid'];
        $get_one_info = pdo_get("hyb_yl_zhuanjia", array('zid' => $zid));
        $string = $get_one_info['z_name'];
        $tkerweima = pdo_getcolumn('hyb_yl_tuikedoc',array('uniacid'=>$uniacid,'openid'=>$openid,'zid'=>$zid),'erweima');
        $weweima = $_W['siteroot'] . $tkerweima;
 
        $string_sc = $get_one_info['z_zhenzhi'];
        $base = pdo_getcolumn("hyb_yl_zhuanjia_rule",array("uniacid"=>$uniacid),'background');
        $get_one_info['background'] = $base;
        $get_one_info['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$get_one_info['parentid']),'name');
        $get_one_info['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$get_one_info['z_zhicheng']),'job_name');
        $get_one_info['labels'] = $get_one_info['keshi']."|".$get_one_info['zhicheng'];
        $get_one_info['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$get_one_info['hid']),'agentname');
        $get_one_info['shanchan'] = "擅长：".$get_one_info['authority'];
        $newinfo = pdo_get("hyb_yl_tuikedoc",array('zid'=>$zid,'openid'=>$openid));
     
        if(empty($newinfo['haibao']))
        {
          require_once dirname(dirname(dirname(__FILE__))) . "/class/playbill.php";
          $model = new playbill();
          $dir = iconv("UTF-8", "GBK", "../attachment/hyb_yl/share_{$uniacid}");
          if (!file_exists($dir)){
              mkdir ($dir,0777,true);
          } 
          $config = array(
            'text'=>array(
              array(
                'text'=>$get_one_info['z_name'],
                'left'=>60,
                'top'=>900,
                'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                'fontSize'=>54,             //字号
                'fontColor'=>'0,0,0',       //字体颜色
                'angle'=>0,
              ),
            ),
            'labels'=>array(
              array(
                'text'=>$get_one_info['labels'],
                'left'=>60,
                'top'=>980,
                'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                'fontSize'=>30,             //字号
                'fontColor'=>'0,0,0',       //字体颜色
                'angle'=>0,
              ),
            ),
            'hospital'=>array(
              array(
                'text'=>$get_one_info['hospital'],
                'left'=>60,
                'top'=>1030,
                'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                'fontSize'=>30,             //字号
                'fontColor'=>'0,0,0',       //字体颜色
                'angle'=>0,
              ),
            ),
            'shanchan'=>array(
              array(
                'text'=>$get_one_info['shanchan'],
                'left'=>60,
                'top'=>1130,
                'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //字体文件
                'fontSize'=>24,             //字号
                'fontColor'=>'0,0,0',       //字体颜色
                'angle'=>0,
              ),
            ),
            'image'=>array(
              array(
                'url'=>$weweima,     //二维码资源
                'stream'=>0,
                'left'=>520,
                'top'=>900,
                'right'=>0,
                'bottom'=>0,
                'width'=>170,
                'height'=>170,
                'opacity'=>100
              )
            ),
            'tximage'=>array(
              array(
                'url'=>tomedia($get_one_info['advertisement']),     //专家图资源
                'stream'=>0,
                'left'=>0,
                'top'=>0,
                'right'=>0,
                'bottom'=>0,
                'width'=>750,
                'height'=>750,
                'opacity'=>100
              )
            ),
            'background'=>'../addons/hyb_yl/public/images/share.png',         
          );
     
          $image_name = "id_".rand(). ".jpg";
          $filename = "../attachment/hyb_yl/{$image_name}";
          $filename_back = "attachment/hyb_yl/{$image_name}";
          $res = $model->createerweima($config,$filename);
          pdo_update("hyb_yl_tuikedoc",array("haibao"=>$filename_back),array('zid'=>$zid,'uniacid'=>$uniacid,'openid'=>$openid));
          
          echo json_encode($_W['siteroot'].$filename_back);
        }else{
          $tkerhaibao = pdo_getcolumn('hyb_yl_tuikedoc',array('uniacid'=>$uniacid,'openid'=>$openid,'zid'=>$zid),'haibao');
          echo json_encode($_W['siteroot'].$tkerhaibao);
        }
    }
    public function timelist() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        //$row = "";
        $row=array();
        //查询当前月份
        $date = date("m");
        if ($date == '01') {
            $row['month'] = '一月';
        }
        if ($date == '02') {
            $row['month'] = '二月';
        }
        if ($date == '03') {
            $row['month'] = '三月';
        }
        if ($date == '04') {
            $row['month'] = '四月';
        }
        if ($date == '05') {
            $row['month'] = '五月';
        }
        if ($date == '06') {
            $row['month'] = '六月';
        }
        if ($date == '07') {
            $row['month'] = '七月';
        }
        if ($date == '08') {
            $row['month'] = '八月';
        }
        if ($date == '09') {
            $row['month'] = '九月';
        }
        if ($date == '10') {
            $row['month'] = '十月';
        }
        if ($date == '11') {
            $row['month'] = '十一月';
        }
        if ($date == '12') {
            $row['month'] = '十二月';
        }
        $time = $this->get_time();
  
        foreach ($time as $key => $value) {
            $array = explode('-', $value);
            $row['time'][] = $array[2];
        }
    
        foreach ($time as $key => $value) {
            $week[] = $this->get_week($value);
        }
       
        foreach ($week as $key => $value) {
            if ($value == '0') {
                $row['week'][] = '日';
                $row['week2'][] = '0';
            }
            if ($value == '1') {
                $row['week'][] = '一';
                $row['week2'][] = '1';
            }
            if ($value == '2') {
                $row['week'][] = '二';
                $row['week2'][] = '2';
            }
            if ($value == '3') {
                $row['week'][] = '三';
                $row['week2'][] = '3';
            }
            if ($value == '4') {
                $row['week'][] = '四';
                $row['week2'][] = '4';
            }
            if ($value == '5') {
                $row['week'][] = '五';
                $row['week2'][] = '5';
            }
            if ($value == '6') {
                $row['week'][] = '六';
                $row['week2'][] = '6';
            }
        }
        foreach ($row['week'] as $key => $value) {
            $row['timearr'][$key]['week'] = $row['week'][$key];
            $row['timearr'][$key]['time'] = $row['time'][$key];
            $row['timearr'][$key]['week2'] = $row['week2'][$key];
        }
        
        echo json_encode($row);
    }
    //匹配数据
    public function alldocservertime() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $week = $_GPC['week'];
        $keywords = $_GPC['keywords'];
        $where3 = "";
        if($keywords == 'dianhaujizhen' || $keywords == 'shipinwenzhen')
        {
            $where3 = " and style=0";
            $rwe = pdo_fetchall("select a.* from ".tablename("hyb_yl_docjobtime")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.jobtime=a.id where a.uniacid=".$uniacid." and b.zid=".$zid);
        }else{
            $where3 = " and style=1";
            $rwe = pdo_fetchall("select a.* from ".tablename("hyb_yl_docjobtime")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.register_jobtime=a.id where a.uniacid=".$uniacid." and b.zid=".$zid);
        }

        // $rwe = pdo_fetchall("select a.* from ".tablename("hyb_yl_docjobtime")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.jobtime=a.id where a.uniacid=".$uniacid." and b.zid=".$zid);

        // $rwe = pdo_fetchall("SELECT * FROM" . tablename('hyb_yl_docjobtime') . "where uniacid='{$uniacid}' and zid ='{$zid}'".$where3);
        if(count($rwe) == 0)
        {
            $rwe = pdo_fetchall("SELECT * FROM" . tablename('hyb_yl_docjobtime') . "where uniacid='{$uniacid}' and zid =0".$where3);
        }
        foreach ($rwe as $key => $value) {
            $weekarr[] = unserialize($value['server_time']);
        }
        $result2 = [];
        array_map(function ($value) use(&$result2) {
            $result2 = array_merge($result2, array_values($value));
        }, $weekarr);
        foreach ($result2 as $key => $value) {
            $tmp = $value['week'] . ',';
            $arr = rtrim($tmp, ',');
            $arr = explode(',', $arr);
            foreach ($arr as $key1 => $value1) {
                if ($week == $value1) {
                    $result4[] = $value;
                } else {
                    $result4[] = [];
                }
            }
        }
        foreach ($result4 as $k => $v) {
            if (!$v) unset($result4[$k]);
        }
        $result5 = array_values($result4);
        $result = array();
    
        foreach ($result5 as $data) {
            isset($result[$data['type']]) || $result[$data['type']] = array();
            $result[$data['type']][] = $data;
        }

        $year_month = date("Y-m-d");
        foreach ($result as $key3 => $value3) {
            foreach ($value3 as $key4 => $value4) {
               $date_time = $value4['time'];
               foreach ($date_time as $key5 => $value5) {
                //$result[$key3][$key4]['time'][$key5]['nwetime']
                 $nwetime = $year_month.' '.$value5['startTime'].'-'.$value5['endTime'];
                 //查询每个时间段预约多少人
                 if($keywords == 'yuanchengguahao')
                 {
                    $count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid='{$uniacid}' and year='{$nwetime}' and (ifpay=1 or ifpay=2)");
                 }else{
                    $count =pdo_fetchcolumn("SELECT count(*) from".tablename('hyb_yl_wenzorder')."where uniacid='{$uniacid}' and year='{$nwetime}' and keywords='{$keywords}' and role=0 and type=1");
                 }
                  
                  
                  $result[$key3][$key4]['time'][$key5]['yynum'] = intval($count);
               }
            }
         }
        echo json_encode($result);
    }
    // 获取服务名称
    public function server_name()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $key_words = $_GPC['key_words'];
        $item = pdo_get("hyb_yl_all_server_menulist",array("uniacid"=>$uniacid,"server_key"=>$key_words));
        echo json_encode($item);
    }
    // 获取所有一级机构
    public function hospital() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $page = $_GPC['page'];
        $pagesize = $_GPC['pagesize'];
        $keyword = $_GPC['keyword'];
        $where = " where uniacid=".$uniacid;
        $order = $_GPC['order'];
        $city = $_GPC['city'];
        $groupid = $_GPC['groupid'];
        if($city != '' && $city != '全国')
        {
            $where .= " and address like '%$city%'";
        }
        if($keyword != '')
        {
            $where .= " and agentname like '%$keyword%'";
        }
        if($order != '')
        {
            $where .= " and grade =".$order;
        }
        if($groupid != '')
        {
            $where .= " and groupid =".$groupid;
        }
        $res = pdo_fetchall("SELECT * FROM" . tablename('hyb_yl_hospital') .$where." order by hid desc limit ".$page * $pagesize.",".$pagesize);
        echo json_encode($res);
    }

    public function getLevel()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $list = pdo_getall("hyb_yl_hospital_level",array("uniacid"=>$uniacid));
        echo json_encode($list);
    }
    
    //平台服务
    public function servertime() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = intval($_GPC['zid']);
        $type = empty($_GPC['type']) ? '0' : $_GPC['type'];
        $where = " where uniacid=".$uniacid." and zid=".$zid;
        $res = pdo_fetch("SELECT a.*,b.u_name FROM" . tablename('hyb_yl_zhuanjia') . "as a left join" . tablename('hyb_yl_userinfo') . "as b on b.openid =a.openid where a.uniacid='{$uniacid}' and a.zid ='{$zid}'");
        if($type == '0')
        {
            $where .= " and stateback=1";
            $list_fuwu = pdo_fetchall("SELECT * from" . tablename('hyb_yl_doc_all_serverlist') . $where);
            foreach($list_fuwu as &$vs)
            {
                $fuwu = pdo_get("hyb_yl_docser_speck",array("id"=>$vs['bid'],"uniacid"=>$uniacid));
                $money = pdo_getcolumn("hyb_yl_docserver_type",array("uniacid"=>$uniacid,"typeid"=>$vs['bid']),'money');
                if(!$money)
                {
                    $money = '0.00';
                }
                $vs['money'] = $money;
                $vs['thumb'] = $fuwu['thumb'];
                $vs['icon'] = $fuwu['icon'];
                $vs['url'] = $fuwu['url'];
                $vs['ftitle'] = $fuwu['ftitle'];
            }
            $data_list = $list_fuwu;
        }else if($type == '1')
        {
            $where .= " and stateback=0";
            $list_fuwu = pdo_fetchall("SELECT * from" . tablename('hyb_yl_doc_all_serverlist') . $where);
            foreach($list_fuwu as &$vs)
            {
                $money = pdo_getcolumn("hyb_yl_docserver_type",array("uniacid"=>$uniacid,"typeid"=>$vs['bid']),'money');
                if(!$money)
                {
                    $money = '0.00';
                }
                $vs['money'] = $money;
                $fuwu = pdo_get("hyb_yl_docser_speck",array("id"=>$vs['bid'],"uniacid"=>$uniacid));
                $vs['thumb'] = $fuwu['thumb'];
                $vs['icon'] = $fuwu['icon'];
                $vs['url'] = $fuwu['url'];
                $vs['ftitle'] = $fuwu['ftitle'];
            }
            $data_list = $list_fuwu;
        }else{
            $list_fuwu = pdo_fetchall("SELECT * from" . tablename('hyb_yl_doc_all_serverlist') . "where uniacid='{$uniacid}' and zid ='{$zid}'");
        }
        if($type == '2')
        {
            $fw_list = pdo_fetchall("SELECT a.*,b.title,b.id as bid,b.money FROM" . tablename("hyb_yl_docser_speck") . "as a left join" . tablename('hyb_yl_docserver_type') . "as b on b.typeid=a.id where a.uniacid ='{$uniacid}'");
            $val = array_merge($list_fuwu, $fw_list);
 
            $newArr = array();
            foreach ($val as $v) {
                
                if (!isset($newArr[$v['key_words']])) $newArr[$v['key_words']] = $v;
                else $newArr[$v['key_words']]["url"].= $v["url"];
                $newArr[$v['key_words']]["server_content"].= $v["server_content"];
                $newArr[$v['key_words']]["icon"].= $v["icon"];
                $newArr[$v['key_words']]["id"].= $v["id"];

                $newArr[$v['key_words']]["ftitle"].= $v["ftitle"];
            }
            $data_list = !$list_fuwu ? $fw_list : $newArr;

        }

        foreach ($data_list as $key => $value) {
            //查询服务的到期时间
            $ids = $value['ids'];
            $speck_time = pdo_fetch("SELECT * FROM" . tablename('hyb_yl_doc_all_serverlist') . "where uniacid='{$uniacid}' and ids='{$ids}'");
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
            $data_list[$key]['money'] = $money;
            if($data_list[$key]['overtime'] < time())
            {
              $data_list[$key]['gq'] = true;
              pdo_update("hyb_yl_doc_all_serverlist",array("stateback"=>'0'),array("ids"=>$data_list[$key]['ids']));
            }else{
              $data_list[$key]['gq'] = false;
            }
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
    //图文问诊列表
    public function doclistser() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $key_words = $_GPC['key_words'];
        $id = $_GPC['id'];
        $ifpay = $_GPC['ifpay'];
        $timestamp = strtotime('now');
        if($ifpay=='1'){
           $where ="where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.ifpay='1' and a.grade=1 and a.role=0 and a.ifgb!=1"; // 
        }
        if($ifpay=='2' ){
           $where ="where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.ifpay='2' and a.grade=1  and a.role=0 and a.ifgb!=1";
        }
       if($ifpay=='3'){
           $where ="where a.uniacid='{$uniacid}' and a.zid='{$zid}' and (a.ifpay='2' or a.ifpay='3' or a.ifpay='4') and a.grade=1  and a.role=0 and ifgb=1";
        }
        if($ifpay=='4' ){
           $where ="where a.uniacid='{$uniacid}' and a.zid='{$zid}' and (a.ifpay='5' or a.ifpay='6') and a.grade=1 and a.role=0";
        }
        $row = pdo_fetchall("SELECT a.*,b.openid,b.names,b.sex,b.age FROM" . tablename("hyb_yl_twenorder") . "as a left join" . tablename("hyb_yl_userjiaren") . "as b on b.j_id=a.j_id where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.ifpay='{$ifpay}' and a.grade=1 and a.role=0 order by a.id asc ");
        foreach ($row as $key => $value) {
            $row[$key]['content'] = unserialize($row[$key]['content']);
            $row[$key]['xdtime'] = date("Y-m-d H:i:s", $row[$key]['xdtime']);
              //查询当前时间戳是否大于数据库时间
             if($timestamp>=$value['overtime']){
                 //更新数据库ifgb=1 订单关闭
                if($value['ifpay']=='2'){
                    pdo_update("hyb_yl_twenorder",array('ifgb'=>'1','ifpay'=>'3'),array('back_orser'=>$value['orders']));
                }else{
                    pdo_update("hyb_yl_twenorder",array('ifgb'=>'1'),array('back_orser'=>$value['orders']));
                }
            }
        }
        $rew = pdo_fetchall("SELECT a.*,b.openid,b.names,b.sex,b.age FROM" . tablename("hyb_yl_twenorder") . "as a left join" . tablename("hyb_yl_userjiaren") . "as b on b.j_id=a.j_id ".$where." order by a.id asc ");


        foreach ($rew as $key => $value) {
            $rew[$key]['content'] = unserialize($rew[$key]['content']);
            $rew[$key]['xdtime'] = date("Y-m-d H:i:s", $rew[$key]['xdtime']);
        }
        echo json_encode($rew);
    }
    //电话问诊列表
    public function dhorderlistser() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $key_words = $_GPC['key_words'];
        $ifpay = $_GPC['ifpay'];
        $timestamp = strtotime('now');

        if($ifpay =='1'){
            $where ="where a.uniacid='{$uniacid}' and a.zid='{$zid}' and ifpay=1 and a.keywords='{$key_words}' and a.role=0 and a.type='1' and a.ifgb=0 order by a.id desc";
        }
        if($ifpay =='2'){
            $where ="where a.uniacid='{$uniacid}' and a.zid='{$zid}' and ifpay=2 and a.keywords='{$key_words}' and a.role=0 and a.type='1' order by a.id desc";
        }
        if($ifpay =='3'){
            $where ="where a.uniacid='{$uniacid}' and a.zid='{$zid}' and (ifpay='3' or ifpay='4') and a.keywords='{$key_words}' and a.role=0 and a.type='1' order by a.id desc";
        }
        if($ifpay =='4'){
            $where ="where a.uniacid='{$uniacid}' and a.zid='{$zid}' and (ifpay='1' or ifpay='6' or ifpay='5' ) and a.keywords='{$key_words}' and a.role=0  and a.type='1' order by a.id desc";
        }
        $row = pdo_fetchall("SELECT a.*,b.openid,b.names,b.sex,b.age FROM" . tablename("hyb_yl_wenzorder") . "as a left join" . tablename("hyb_yl_userjiaren") . "as b on b.j_id=a.j_id {$where}");



        foreach ($row as $key => $value) {
            $row[$key]['content'] = unserialize($row[$key]['describe']);
            $row[$key]['content'] = unserialize($row[$key]['content']);
            $row[$key]['time'] = date("Y-m-d H:i:s", $row[$key]['time']);
              //查询当前时间戳是否大于数据库时间
             if($timestamp>=$value['overtime']){

                 //更新数据库ifgb=1 订单关闭
                if($value['ifpay']=='2'){
                  
                    pdo_update("hyb_yl_wenzorder",array('ifgb'=>'1','ifpay'=>'3'),array('back_orser'=>$value['orders']));
                }else{
                    pdo_update("hyb_yl_wenzorder",array('ifgb'=>'1'),array('back_orser'=>$value['orders']));
                }
            }
            $row[$key]['overtime'] = date("Y-m-d H:i:s", $row[$key]['overtime']);
        }
        echo json_encode($row);
    }
    //处方问诊列表
    public function getcflistser() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $id = $_GPC['id'];
        $ifpay = $_GPC['ifpay'];

        $timestamp = strtotime('now');
        if($ifpay=='1'){
          $where = " where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.ispay='1' and a.role=0 and a.ifgb=0";
        }
        if($ifpay=='2'){
          $where = " where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.ispay='2' and a.role=0 and (a.ifgb=0 or a.ifgb=1)";
        }
        if($ifpay=='3'){
          $where = "where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.ispay='3' and a.role=0 ";
        }
        if($ifpay=='4'){
          $where = "where a.uniacid='{$uniacid}' and a.zid='{$zid}' and (a.ispay='5' or a.ispay='6') and a.role=0 and a.ifgb=0";
        }

       $res = pdo_fetchall("SELECT a.*,b.openid,b.names,b.sex,b.age FROM" . tablename("hyb_yl_chufang") . "as a left join" . tablename("hyb_yl_userjiaren") . "as b on b.j_id=a.userid {$where}");
        foreach ($res as $key => $value) {
            $res[$key]['content'] = unserialize($res[$key]['content']);
            $res[$key]['time'] = date("Y-m-d H:i:s", $res[$key]['time']);
            $res[$key]['overtime'] = date("Y-m-d H:i:s", $res[$key]['overtime']);
            $res[$key]['advertisement'] = tomedia($res[$key]['advertisement']);
            //查询当前时间戳是否大于数据库时间
            if($timestamp>=$value['overtime']){
             //更新数据库ifgb=1 订单关闭
                if($value['ispay']=='2'){
                    pdo_update("hyb_yl_chufang",array('ifgb'=>'1','ispay'=>'3'),array('c_id'=>$value['c_id']));
                }else{
                    pdo_update("hyb_yl_chufang",array('ifgb'=>'1'),array('c_id'=>$value['c_id']));
                }
             
           }
        }
       $row = pdo_fetchall("SELECT a.*,b.openid,b.names,b.sex,b.age FROM" . tablename("hyb_yl_chufang") . "as a left join" . tablename("hyb_yl_userjiaren") . "as b on b.j_id=a.userid {$where}");


        foreach ($row as $key => $value) {
            $row[$key]['content'] = unserialize($row[$key]['content']);
            $row[$key]['time'] = date("Y-m-d H:i:s", $row[$key]['time']);
           // $row[$key]['overtime'] = date("Y-m-d H:i:s", $row[$key]['overtime']);
            $row[$key]['advertisement'] = tomedia($row[$key]['advertisement']);
        }
        echo json_encode($row);
    }
//挂号
    public function getghlistser() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $id = $_GPC['id'];
        $ifpay = $_GPC['ifpay'];

        $timestamp = strtotime('now');
        if($ifpay=='1'){
          $where = " where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.ifpay='1' and a.role=0 and a.ifgb=0 and a.type=1";
        }
        if($ifpay=='2'){
          $where = " where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.ifpay='2' and a.role=0 and a.ifgb=0 and a.type=1";
        }
        if($ifpay=='3'){
          $where = "where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.ifpay='3' and a.role=0 and a.type=1";
        }
        if($ifpay=='4'){
          $where = "where a.uniacid='{$uniacid}' and a.zid='{$zid}' and (a.ifpay='5' or a.ifpay='6') and a.role=0 and a.ifgb=0";
        }
        $where.=' order by a.time desc ';
        $res = pdo_fetchall("SELECT a.*,b.openid,b.names,b.sex,b.age FROM" . tablename("hyb_yl_guahaoorder") . "as a left join" . tablename("hyb_yl_userjiaren") . "as b on b.j_id=a.j_id '{$where}'  ");

        foreach ($res as $key => $value) {
            $res[$key]['content'] = unserialize($res[$key]['describe']);
            $res[$key]['time'] = date("Y-m-d H:i:s", $res[$key]['time']);
            $res[$key]['overtime'] = date("Y-m-d H:i:s", $res[$key]['overtime']);
            $res[$key]['advertisement'] = tomedia($res[$key]['advertisement']);
            //查询当前时间戳是否大于数据库时间
            if($timestamp>=$value['overtime']){
             //更新数据库ifgb=1 订单关闭
             if($value['ifpay']=='2'){
                pdo_update("hyb_yl_guahaoorder",array('ifgb'=>'1','ifpay'=>'3'),array('id'=>$value['id']));
             }else{
                pdo_update("hyb_yl_guahaoorder",array('ifgb'=>'1'),array('id'=>$value['id']));
             }
             
           }
        }
       $row = pdo_fetchall("SELECT a.*,b.openid,b.names,b.sex,b.age FROM" . tablename("hyb_yl_guahaoorder") . "as a left join" . tablename("hyb_yl_userjiaren") . "as b on b.j_id=a.j_id {$where}");

        foreach ($row as $key => $value) {
            $row[$key]['content'] = unserialize($row[$key]['describe']);
            $row[$key]['time'] = date("Y-m-d H:i:s", $row[$key]['time']);
            $row[$key]['advertisement'] = tomedia($row[$key]['advertisement']);
        }
        echo json_encode($row);
    }
    //报告解读
        public function getbglistser() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $id = $_GPC['id'];
        $ifpay = $_GPC['ifpay'];
        $key_words = $_GPC['key_words'];
        $timestamp = strtotime('now');
        if($ifpay=='1'){
          $where = " where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.ifpay='1' and a.role=0 and a.ifgb=0 and keywords='{$key_words}' and a.type=1";
        }
        if($ifpay=='2'){
          $where = " where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.ifpay='2' and a.role=0 and a.ifgb=0 and keywords='{$key_words}' and a.type=1";
        }
        if($ifpay=='3'){
          $where = "where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.ifpay='3' and a.role=0 and keywords='{$key_words}' and a.type=1";
        }
        if($ifpay=='4'){
          $where = "where a.uniacid='{$uniacid}' and a.zid='{$zid}' and (a.ifpay='5' or a.ifpay='6') and a.role=0 and a.ifgb=0 and keywords='tijianjiedu'";
        }
        

       $res = pdo_fetchall("SELECT a.*,b.openid,b.names,b.sex,b.age FROM" . tablename("hyb_yl_wenzorder") . "as a left join" . tablename("hyb_yl_userjiaren") . "as b on b.j_id=a.j_id {$where}");
        foreach ($res as $key => $value) {
            $res[$key]['content'] = unserialize($res[$key]['describe']);
            $res[$key]['time'] = date("Y-m-d H:i:s", $res[$key]['time']);
            $res[$key]['overtime'] = date("Y-m-d H:i:s", $res[$key]['overtime']);
            $res[$key]['advertisement'] = tomedia($res[$key]['advertisement']);
            //查询当前时间戳是否大于数据库时间
            if($timestamp>=$value['overtime']){
             //更新数据库ifgb=1 订单关闭
            if($value['ifpay']=='2'){
                pdo_update("hyb_yl_wenzorder",array('ifgb'=>'1','ifpay'=>'3'),array('id'=>$value['id']));
             }else{
                pdo_update("hyb_yl_wenzorder",array('ifgb'=>'1'),array('id'=>$value['id']));
             }
             
           }
        }
       $row = pdo_fetchall("SELECT a.*,b.openid,b.names,b.sex,b.age FROM" . tablename("hyb_yl_wenzorder") . "as a left join" . tablename("hyb_yl_userjiaren") . "as b on b.j_id=a.j_id {$where} group by a.back_orser");


        foreach ($row as $key => $value) {
            $row[$key]['content'] = unserialize($row[$key]['describe']);
            $row[$key]['time'] = date("Y-m-d H:i:s", $row[$key]['time']);
            $row[$key]['advertisement'] = tomedia($row[$key]['advertisement']);
        }
        echo json_encode($row);
    }

    //医生回答
    public function addzhuiwen() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $arr = $_GPC['arr'];
        $id = $_GPC['id'];
        $res = pdo_fetch("SELECT * FROM" . tablename('hyb_yl_twenorder') . "where uniacid='{$uniacid}' and id='{$id}'");
        $idarr = htmlspecialchars_decode($arr);
        $array = json_decode($idarr);
        $object = json_decode(json_encode($array), true);
        $data = array(
            'uniacid' => $uniacid, 
            'zid' => $zid, 
            'openid' => $res['openid'], 
            'orders' => $res['orders'], 
            'time' => date("Y-m-d H:i:s"), 
            'content' => serialize($object), 
            'type' => $res['type'], 
            'cfstate' => $res['cfstate'], 
            'j_id' => $res['j_id'], 
            'money' => $res['money'], 
            'ifgk' => $res['ifgk'], 
            'ifpay' => 0, 
            'back_orser' => $res['back_orser'], 
            'pid' => $id, 
            'role' => 1, 
            'xdtime' => strtotime('now'),
            'mp3'=>$_GPC['mp3'],
            'thtime'=>$_GPC['thtime']
            );
        $deeems = pdo_insert("hyb_yl_twenorder", $data);
        echo json_encode($deeems);
    }
    public function addchufangxq() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $arr = $this->jsondate($_GPC['arr']);
        $cartlist = $this->jsondate($_GPC['cartlist']);
        $data = array(
            'uniacid' => $uniacid, 
            'zid' => $_GPC['zid'], 
            'openid' => $_GPC['openid'], 
            'createTime' => strtotime("now"), 
            'key_words' => $_GPC['key_words'], 
            'conets' => serialize($arr), 
            'cid' => $_GPC['cid'], 
            'sid' => serialize($cartlist), 
            'j_id' => $_GPC['j_id'], 
            'totalMoney' => $_GPC['totals'], 
            'orderNo' => $this->getordernum(),
            'addressId'=>$_GPC['addressid'],
            'ifshop'=>0
            );
        $role = $_GPC['role'];
        if($role=='1'){
            $res = pdo_insert('hyb_yl_goodsorders', $data);
            $id = pdo_insertid();
            $info_msg = pdo_get("hyb_yl_goodsorders",array('id'=>$id));
        }else{
            $data2['sid'] = serialize($cartlist);
            $data2['totalMoney'] = $_GPC['totals'];
            $data2['orderStatus'] = 0;
            $data2['openid'] = $_GPC['openid'];
            $info_msg = pdo_update("hyb_yl_goodsorders",$data2,array("id"=>$_GPC['goodsid']));
        }
        
        echo json_encode($info_msg);
    }
    //yonghu
    public function jsondate($data) {
        $idarr = htmlspecialchars_decode($data);
        $array = json_decode($idarr);
        $object = json_decode(json_encode($array), true);
        return $object;
    }
    //挂号追问
   public function addguahaozhuiwen() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $arr = $_GPC['arr'];
        $id = $_GPC['id'];
        $key_words = $_GPC['key_words'];
        $res = pdo_fetch("SELECT * FROM" . tablename('hyb_yl_guahaoorder') . "where uniacid='{$uniacid}' and id='{$id}'");
        $idarr = htmlspecialchars_decode($arr);
        $array = json_decode($idarr);
        $object = json_decode(json_encode($array), true);
        $data = array(
            'uniacid' => $uniacid, 
            'zid' => $zid, 
            'openid' => $res['openid'], 
            'orders' => $res['orders'], 
            'time' => strtotime("now"), 
            'describe' => serialize($object), 
            'type' => $res['type'], 
            'j_id' => $res['j_id'], 
            'money' => $res['money'], 
            'ifpay' => $res['ifpay'], 
            'back_orser' => $res['back_orser'], 
            'role' => 1,
            'mp3'=>$_GPC['mp3'],
            'thtime'=>$_GPC['thtime']
            );
        $deeems = pdo_insert("hyb_yl_guahaoorder", $data);
        echo json_encode($deeems);
    }
    public function addtelzhuiwen() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $arr = $_GPC['arr'];
        $id = $_GPC['id'];
        $key_words = $_GPC['key_words'];
        $res = pdo_fetch("SELECT * FROM" . tablename('hyb_yl_wenzorder') . "where uniacid='{$uniacid}' and id='{$id}'");
        $idarr = htmlspecialchars_decode($arr);
        $array = json_decode($idarr);
        $object = json_decode(json_encode($array), true);
        $data = array(
            'uniacid' => $uniacid, 
            'zid' => $zid, 
            'openid' => $res['openid'], 
            'orders' => $res['orders'], 
            'time' => strtotime("now"), 
            'describe' => serialize($object), 
            'type' => $res['type'], 
            'j_id' => $res['j_id'], 
            'money' => $res['money'], 
            'ifpay' => $res['ifpay'], 
            'back_orser' => $res['back_orser'], 
            'pid' => $id, 
            'role' => 1,
            'keywords'=>$key_words,
            'mp3'=>$_GPC['mp3'],
            'thtime'=>$_GPC['thtime']
            );
        $deeems = pdo_insert("hyb_yl_wenzorder", $data);
        echo json_encode($deeems);
    }
    //用户追问
    public function adduserzhuiwen() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $arr = $_GPC['arr'];
        $orders = $_GPC['orders'];
        $res = pdo_fetch("SELECT * FROM" . tablename('hyb_yl_twenorder') . "where uniacid='{$uniacid}' and orders='{$orders}'");
        $oo_user_der = $this->getordernum();
        $idarr = htmlspecialchars_decode($arr);
        $array = json_decode($idarr);
        $object = json_decode(json_encode($array), true);
        $data = array('uniacid' => $uniacid, 'zid' => $zid, 'openid' => $res['openid'], 'orders' => $oo_user_der, 'time' => date("Y-m-d H:i:s"), 'content' => serialize($object), 'type' => $res['type'], 'cfstate' => $res['cfstate'], 'j_id' => $res['j_id'], 'money' => $res['money'], 'ifgk' => $res['ifgk'], 'ifpay' => $res['ifpay'], 'back_orser' => $res['back_orser'], 'pid' => 0, 'role' => 0, 'grade' => 2, 'xdtime' => strtotime('now'));
        //更新追问次数
        $num = pdo_fetch("select * from".tablename('hyb_yl_twenorder')."where uniacid='{$uniacid}' and grade=1 and role=0 and orders='{$orders}' limit 1");
        $addnum = $num['addnum'];

        pdo_update("hyb_yl_twenorder", array('addnum' => ($addnum - 1)), array('orders' => $orders));
        $deeems = pdo_insert("hyb_yl_twenorder", $data);
       echo json_encode($deeems);
    }
    // 查询本周的所有时间
    public function get_time($time = '', $format = 'Y-m-d') {
        $time = $time != '' ? $time : time();
        //获取当前周几
        //$week = date('w', $time);
        $date = [];
        for($i=1;$i<8;$i++){
            $date[$i]=date('Y-m-d',strtotime(date('Y-m-d').'+'.$i.'day'));
        };
        return $date;
    }
    public function get_week($date) {
        //强制转换日期格式
        $date_str = date('Y-m-d', strtotime($date));
        //封装成数组
        $arr = explode("-", $date_str);
        //参数赋值
        //年
        $year = $arr[0];
        //月，输出2位整型，不够2位右对齐
        $month = sprintf('%02d', $arr[1]);
        //日，输出2位整型，不够2位右对齐
        $day = sprintf('%02d', $arr[2]);
        //时分秒默认赋值为0；
        $hour = $minute = $second = 0;
        //转换成时间戳
        $strap = mktime($hour, $minute, $second, $month, $day, $year);
        //获取数字型星期几
        $number_wk = date("w", $strap);
        //自定义星期数组
        $weekArr = array("0", "1", "2", "3", "4", "5", "6");
        //获取数字对应的星期
        return $weekArr[$number_wk];
    }

    //提醒签约
    public function remind() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $j_id = $_GPC['j_id'];
        $username = pdo_getcolumn('hyb_yl_userjiaren',array('j_id'=>$j_id),array('names'));
        $zid = $_GPC['zid'];
        //更新提醒次数
        $qianynum = pdo_getcolumn('hyb_yl_zhuanjia',array('zid'=>$zid),array('qianynum'));
        pdo_update('hyb_yl_zhuanjia',array('qianynum'=>$qianynum-1),array('zid'=>$zid));
        $doc = pdo_get('hyb_yl_zhuanjia', array('uniacid' => $uniacid, 'zid' => $zid));
        $z_name = $doc['z_name']; //专家名称
        $doc_openid = $doc['openid'];
        $wxappaid = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
        $wxapp_mb = unserialize($wxappaid['wxapp_mb']);
        $appid = $wxappaid['appid'];
        $appsecret = $wxappaid['appsecret'];
        $template_id = $wxapp_mb['qainSuccess'];
        $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
        $getArr = array();
        $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
        $access_token = $tokenArr->access_token;
        $url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=' . $access_token;
        //时间￥
        $time = date("Y-m-d H:i:s");

        $dd['data'] = ['date1' => ['value' => $time], 'name2' => ['value' => $z_name], 'name5' => ['value' => $username] ];
        $dd['touser'] = $doc_openid;
        $dd['template_id'] = $template_id;
        $dd['page'] = 'hyb_yl/tabBar/index/index';
        $result1 = $this->https_curl_json($url, $dd, 'json');
        echo json_encode($result1);
    } 
    //提醒患者问诊提醒
    public function getmbtxing() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $order_one_msg = pdo_get("hyb_yl_twenorder", array('id' => $id, 'uniacid' => $uniacid));
        $us_openid = $order_one_msg['openid'];
        $msg = unserialize($order_one_msg['content']);
        $near = $_GPC['near'];
        $text = "[" . $near . "]" . $this->subtext($msg['text'], 10);
        $j_id = $order_one_msg['j_id'];
        $zid = $order_one_msg['zid'];
        $near = $_GPC['near'];

        $textarea = $this->subtext($_GPC['val'], 10);
        $user = pdo_get('hyb_yl_zhuanjia', array('uniacid' => $uniacid, 'zid' => $zid));
        $username = $user['z_name']; //专家名称
        $wxappaid = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
        $wxapp_mb = unserialize($wxappaid['wxapp_mb']);
        
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
        $doctor_over_msg = "专家回复:" . $textarea;
        //专家回复时间￥
        $time = date("Y-m-d H:i:s");
        $doctor_over_time = "24小时未回复，对话将自动关闭";
        $dd['data'] = ['thing1' => ['value' => $text], 'thing2' => ['value' => $doctor_over_msg], 'name3' => ['value' => $username], 'thing4' => ['value' => $doctor_over_time], ];
        $dd['touser'] = $us_openid;
        $dd['template_id'] = $template_id;
        $dd['page'] = 'hyb_yl/zhuanjiasubpages/pages/zhifuend/zhifuend?txt=yes&zid='.$zid.'&back_orser='.$order_one_msg['back_orser'].'&key_words='.$key_words.'&j_id='.$order_one_msg['j_id'].'&ifpay='.$order_one_msg['ifpay'].'&money='.$order_one_msg['money'].'&overtime='.date("Y-m-d H:i:s",$order_one_msg['overtime']).'&currentData=2&ifgb='.$order_one_msg['ifgb'].'&id='.$order_one_msg['id'];
        if($key_words == 'yuanchengkaifang')
        {
            $dd['page'] .= $order_one_msg['c_id'];
        }else if($key_words == 'tuwenwenzhen')
        {
            $list = array(
              'advertisement' => tomedia($user['advertisement']),
              'dex'=>0,
              'ifgb'=>$order_one_msg['ifgb'],
              'ifpay' => $order_one_msg['ifpay'],
              'j_id'=>$order_one_msg['j_id'],
              'money' => $order_one_msg['money'],
              'orders' => $order_one_msg['back_orser'],
              'overtime' => $order_one_msg['overtime'],
              'z_name' => $user['z_name'],
              'zid' => $zid,
            );
            $list = json_encode($list);
            $dd['page'] = 'hyb_yl/czhuanjiasubpages/pages/chatroom/chatroom?txt=yes&zid='.$zid.'&back_orser='.$order_one_msg['back_orser'].'&key_words='.$key_words.'&j_id='.$order_one_msg['j_id'].'&ifpay='.$order_one_msg['ifpay'].'&money='.$order_one_msg['money'].'&overtime='.date("Y-m-d H:i:s",$order_one_msg['overtime']).'&currentData=2&ifgb='.$order_one_msg['ifgb'].'&username={}&list='.$list;
        }
       
        $result1 = $this->https_curl_json($url, $dd, 'json');
        echo json_encode($result1);
    }
    //
    public function getdocmbtxing() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $key_words = $_GPC['near'];
        if($key_words == '图文')
        {
            $order_one_msg = pdo_get("hyb_yl_twenorder", array('id' => $id, 'uniacid' => $uniacid));
        }else if($key_words == '手术快约' || $key_words == '电话' || $key_words == '视频' || $key_words == '报告解读')
        {
            $order_one_msg = pdo_get("hyb_yl_wenzorder", array('id' => $id, 'uniacid' => $uniacid));
            $order_one_msg['content'] = $order_one_msg['describe'];
        }else if($key_words == '开处方')
        {
            $order_one_msg = pdo_get("hyb_yl_chufang",array("id"=>$id,"uniacid"=>$uniacid));
        }
        $near = $_GPC['near'];
        $j_id = $order_one_msg['j_id'];
        //查询患者信息
        $userinfo = pdo_get('hyb_yl_userjiaren',array('j_id'=>$j_id));
        $user_name = $userinfo['names'];
        $user_sex = $userinfo['sex'];
        $zid = $_GPC['zid'];
        $near = $_GPC['near'];
        $user = pdo_get('hyb_yl_zhuanjia', array('uniacid' => $uniacid, 'zid' => $zid));
        //pdo_update('hyb_yl_zhuanjia',array('ptperson'=>$user['ptperson']+1),array('zid'=>$zid));

        $openid = $user['openid'];
        $wxopenid = pdo_getcolumn('hyb_yl_userinfo',array('openid'=>$openid),'wxopenid');
        if($near == '开处方')
        {
         
            $page = 'hyb_yl/zhuanjiasubpages/pages/zhuanjiahuida/zhuanjiahuida?id='.$id.'&zid='.$zid.'&typedate='.$order_one_msg['content']['typedate'].'&key_words=yuanchengkaifang&openid='.$order_one_msg['openid'].'&back_orser='.$order_one_msg['back_orser'].'&j_id='.$order_one_msg['j_id'].'&docindex=1&ifpay='.$order_one_msg['ifpay'];
     
        }else if($near == '图文')
        {
          
            $page = 'hyb_yl/zhuanjiasubpages/pages/zhuanjiahuida/zhuanjiahuida?id='.$id.'&zid='.$zid.'&typedate='.$order_one_msg['content']['typedate'].'&key_words=tuwenwenzhen&openid='.$order_one_msg['openid'].'&back_orser='.$order_one_msg['back_orser'].'&j_id='.$order_one_msg['j_id'].'&docindex=1&ifpay='.$order_one_msg['ifpay'].'&overtime='.$order_one_msg['overtime'];
            
        }else if($near == '电话')
        {

            $page = 'hyb_yl/zhuanjiasubpages/pages/zhuanjiahuida/zhuanjiahuida?id='.$id.'&zid='.$zid.'&typedate='.$order_one_msg['content']['typedate'].'&key_words=dianhuajizhen&openid='.$order_one_msg['openid'].'&back_orser='.$order_one_msg['back_orser'].'&j_id='.$order_one_msg['j_id'].'&docindex=1&ifpay='.$order_one_msg['ifpay'].'&overtime='.$order_one_msg['overtime'];
        }else if($near == '视频')
        {
            $page = 'hyb_yl/zhuanjiasubpages/pages/zhuanjiahuida/zhuanjiahuida?id='.$id.'&zid='.$zid.'&typedate='.$order_one_msg['content']['typedate'].'&key_words=shipinwenzhen&openid='.$order_one_msg['openid'].'&back_orser='.$order_one_msg['back_orser'].'&j_id='.$order_one_msg['j_id'].'&docindex=1&ifpay='.$order_one_msg['ifpay'].'&overtime='.$order_one_msg['overtime'];
        }else if($near == '手术快约')
        {
            
            $page = 'hyb_yl/zhuanjiasubpages/pages/zhuanjiahuida/zhuanjiahuida?id='.$id.'&zid='.$zid.'&typedate='.$order_one_msg['content']['typedate'].'&key_words=shoushukuaiyue&openid='.$order_one_msg['openid'].'&back_orser='.$order_one_msg['back_orser'].'&j_id='.$order_one_msg['j_id'].'&docindex=1&ifpay='.$order_one_msg['ifpay'].'&overtime='.$order_one_msg['overtime'];
        }else if($near == '报告解读')
        {
            $page = 'hyb_yl/zhuanjiasubpages/pages/zhuanjiahuida/zhuanjiahuida?id='.$id.'&zid='.$zid.'&typedate='.$order_one_msg['content']['typedate'].'&key_words=tijianjiedu&openid='.$order_one_msg['openid'].'&back_orser='.$order_one_msg['back_orser'].'&j_id='.$order_one_msg['j_id'].'&docindex=1';
        }
        else
        {
            $id = pdo_fetchcolumn("select id from ".tablename("hyb_yl_docser_speck")." where uniacid=".$uniacid." and key_words ='yuanchengkaifang'");
            $page = 'hyb_yl/mysubpages/pages/docorder/docorder?titlme=图文问诊&key_words=tuwenwenzhen&id='.$id.'&zid='.$zid.'&z_telephone='.$user['z_telephone'];
        }
        $parameter = pdo_get("hyb_yl_parameter",array("uniacid"=>$uniacid));
        $uid = pdo_getcolumn("hyb_yl_boxuser",array("uniacid"=>$uniacid),'uid');
        $sn = $parameter['box_sn'];
        $m = 1;
        $token = $parameter['box_token'];
        $version = $parameter['box_version'];
        $content = $user_name."刚刚下了一个".$user['z_name']."的".$near."订单";
        $getArr = array();

        $url = "https://speaker.17laimai.cn/notify.php?id=".$sn."&token=".$token."&version=".$version."&message=".$content."&speed=50";
         
         $tokenArr = json_decode($this->send_post($url, $getArr, "GET"),true);
         
        $result1 = $this->msgtongzhi($wxopenid,$keywords,$page,$user_name,$user_sex);
    }
  public function msgtongzhi($wxopenid,$keywords,$page,$user_name,$user_sex){
      //获取token
       global $_GPC, $_W;
       $uniacid = $_W['uniacid'];
       $wxapp = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
       $appid = $wxapp['pub_appid'];  //填写你公众号的appid
       $secret = $wxapp['appkey'];   //填写你公众号的secret
       $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
       $gzhmb = unserialize($wxapp['gzhmb']);
       $mbxs = $gzhmb['templateid'];
       $wxappaid = $wxapp['appid'];
       $getArr = array();
       $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
       $access_token = $tokenArr->access_token;

       $posturl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
       $template = array(
           "touser" => $wxopenid,
           "template_id" => $mbxs,
           "miniprogram"=>array(
               "appid"=>$wxappaid,
               "pagepath"=>$page
            ), 
           'topcolor' => '#ccc',
           'data' =>array('first' => array('value' =>'尊敬的医生，您有新的'.$keywords.'咨询订单',
                                              'color' =>"#743A3A",
           ),
               'keyword1' => array('value' =>$user_name,
                                   'color' =>'#FF0000',
               ),
               'keyword2' => array('value' =>$user_sex,
                                   'color' =>'#FF0000',
               ),
               'remark'   => array('value' =>'请尽快处理，感谢您的支持',
                                   'color' =>'#FF0000',
              ),
           )
      );
      $postjson = json_encode($template);
      $resder = $this->http_curl($posturl,'post','json',$postjson);
      echo json_encode($resder);
  }

  public function wxtemplet(){
      //获取token
       global $_GPC, $_W;
       $uniacid = $_W['uniacid'];
       $id = $_GPC['id'];
       $keywords = $_GPC['keywords'];
       $key_words = $_GPC['key_words'];
       $res = pdo_fetch('SELECT * FROM' . tablename('hyb_yl_twenorder') . "where uniacid ='{$uniacid}' and id='{$id}' ");
       $zid = $res['zid'];
       $docinfo = pdo_get('hyb_yl_zhuanjia',array('zid'=>$zid));
       $z_name = $docinfo['z_name'];
       $j_id  =$res['j_id'];
       $userinfo = pdo_get('hyb_yl_userjiaren',array('j_id'=>$j_id));
       $user_name = $userinfo['names'];
       $user_sex = $userinfo['sex'];

       $wxapp = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
       $appid = $wxapp['pub_appid'];  //填写你公众号的appid
       $secret = $wxapp['appkey'];   //填写你公众号的secret
       $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
       $gzhmb = unserialize($wxapp['gzhmb']);
       $mbxs = $gzhmb['jzmoban'];
       $wxappaid = $wxapp['appid'];

       $getArr = array();
       $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
       $access_token = $tokenArr->access_token;
       $jztime = date("Y-m-d H:i:s");
       $posturl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
       $openid = $userinfo['openid'];
       $wxopenid = pdo_getcolumn('hyb_yl_userinfo',array('openid'=>$openid),'wxopenid');


       $template = array(
           "touser" => $wxopenid,
           "template_id" => $mbxs,
           "miniprogram"=>array(
               "appid"=>$wxappaid,
               "pagepath"=>'hyb_yl/mysubpages/pages/wodezixun/wodezixun?type='.$key_words.'&key_words='.$key_words
            ), 
           'topcolor' => '#ccc',
           'data' =>array('first' => array('value' =>'您好，医生已接诊，点击开始病情咨询',
                                              'color' =>"#743A3A",
           ),
               'keyword1' => array('value' =>$keywords,
                                   'color' =>'#FF0000',
               ),
               'keyword2' => array('value' =>$z_name,
                                   'color' =>'#FF0000',
               ),
               'keyword3' => array('value' =>$user_name.','.$user_sex,
                                   'color' =>'#FF0000',
               ),
               'keyword4' => array('value' =>$jztime,
                                   'color' =>'#FF0000',
               ),
               'remark'   => array('value' =>'点击查看详情',
                                   'color' =>'#FF0000',
              ),
           )
      );
      $postjson = json_encode($template);
      $resder = $this->http_curl($posturl,'post','json',$postjson);
      echo json_encode($resder);
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

    //模板消息视频通话开始
    public function mbstrat() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $order_one_msg = pdo_get("hyb_yl_wenzorder", array('id' => $id, 'uniacid' => $uniacid));
        $orders = $order_one_msg['orders'];
        $msg = unserialize($order_one_msg['content']);
        $j_id = $order_one_msg['j_id'];
        $zid = $order_one_msg['zid'];
        $doctor = pdo_get('hyb_yl_zhuanjia', array('uniacid' => $uniacid, 'zid' => $zid));
        pdo_update('hyb_yl_zhuanjia',array('ptperson'=>$doctor['ptperson']+1),array('zid'=>$zid));
        $user = pdo_get('hyb_yl_userjiaren', array('uniacid' => $uniacid, 'j_id' => $j_id));
        $us_openid = $user['openid'];
        $z_name =  preg_replace("/\\d+/",'', $doctor['z_name']); //专家名称
        $wxappaid = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
        $wxapp_mb = unserialize($wxappaid['wxapp_mb']);
        
        $appid = $wxappaid['appid'];
        $appsecret = $wxappaid['appsecret'];
        $template_id = $wxapp_mb['spstratSuccess'];
        $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
        $getArr = array();
        $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
        $access_token = $tokenArr->access_token;
        $url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=' . $access_token;
        $text = "专家已接诊，请前往小程序查看";
        $dd['data'] = [
        'thing1' => ['value' => $z_name], 
        'thing2' => ['value' => $text]
        ];

        $dd['touser'] = $us_openid;
        $dd['template_id'] = $template_id;
        $dd['page'] = 'hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=tuwenwenzhen';
        $result1 = $this->https_curl_json($url, $dd, 'json');
        echo json_encode($result1);
    }
    //处方开完通知
    //模板消息视频通话开始
    public function chufangmobel() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $order_one_msg = pdo_get("hyb_yl_goodsorders", array('id' => $id, 'uniacid' => $uniacid));
        $orders = $order_one_msg['orders'];
        $msg = unserialize($order_one_msg['content']);
        $j_id = $order_one_msg['j_id'];
        $zid = $order_one_msg['zid'];
        $doctor = pdo_get('hyb_yl_zhuanjia', array('uniacid' => $uniacid, 'zid' => $zid));
        pdo_update('hyb_yl_zhuanjia',array('ptperson'=>$doctor['ptperson']+1),array('zid'=>$zid));
        $user = pdo_get('hyb_yl_userjiaren', array('uniacid' => $uniacid, 'j_id' => $j_id));
        $us_openid = $user['openid'];
        $z_name =  preg_replace("/\\d+/",'', $doctor['z_name']); //专家名称
        $wxappaid = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
        $wxapp_mb = unserialize($wxappaid['wxapp_mb']);
        
        $appid = $wxappaid['appid'];
        $appsecret = $wxappaid['appsecret'];
        $template_id = $wxapp_mb['cfoverfcard'];
        $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
        $getArr = array();
        $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
        $access_token = $tokenArr->access_token;
        $url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=' . $access_token;
        $text = "请遵医嘱合理用药";
        $dd['data'] = [
        'name1'  => ['value' => $user['names']], 
        'thing2'  => ['value' => $text],
        'name3' => ['value' => $doctor['z_name']],
        ];

        $dd['touser'] = $us_openid;
        $dd['template_id'] = $template_id;
        $dd['page'] = 'hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=tuwenwenzhen';
        $result1 = $this->https_curl_json($url, $dd, 'json');
        echo json_encode($result1);
    }
    //图文专家提醒患者
    public function tuwenmsgdh(){
        global $_GPC, $_W;
        $params = array();
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $text = $_GPC['text'];
        require_once dirname(dirname(dirname(__FILE__))). '/inc/SignatureHelper.php';
        $res = pdo_fetch('SELECT * FROM' . tablename('hyb_yl_twenorder') . "where uniacid ='{$uniacid}' and id='{$id}' ");
         $orders = $res['orders'];
        //查询回复时间
        $date_info_time = pdo_get('hyb_yl_wenzhenrule',array('uniacid'=>$uniacid),array('over'));
        $time = $date_info_time['over'];
        $aliduanxin = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_duanxin") . "WHERE uniacid = '{$uniacid}' ");
        $mobel = unserialize($aliduanxin['moban_id']);
        if ($aliduanxin['stadus'] == 1 ) {

            $j_id = $res['j_id'];
            $myinfo = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_userjiaren") . "WHERE uniacid = '{$uniacid}' and  j_id ='{$j_id}'");
            $name = $myinfo['names'];
            $phoneNum = $myinfo['tel'];
            $zid = $res['zid'];
            $doname = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . "as a left join" . tablename('hyb_yl_ceshi') . "as b on b.id=a.parentid WHERE a.uniacid = '{$uniacid}' and a.zid ='{$zid}'");
            pdo_update('hyb_yl_zhuanjia',array('ptperson'=>$doname['ptperson']+1),array('zid'=>$zid));
            $doctor = $doname['z_name'];
            $ksname = $doname['name'];
            $accessKeyId = $aliduanxin['key'];
            $accessKeySecret = $aliduanxin['scret'];
            $params["PhoneNumbers"] = $phoneNum;
            $params["SignName"] = $aliduanxin['qianming'];
            $params["TemplateCode"] = $mobel['jzmobel'];
            $params['TemplateParam'] = Array('orderid' => $orders, 'name' => $doctor,'time'=>$time);
            if (!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
                $params["TemplateParam"] = json_encode($params["TemplateParam"]);
            }
            $helper = new SignatureHelper();
            $content = $helper->request($accessKeyId, $accessKeySecret, "dysmsapi.aliyuncs.com", array_merge($params, array("RegionId" => "cn-hangzhou", "Action" => "SendSms", "Version" => "2017-05-25",)));
        }
      }
    //电话专家提醒患者 视频通知患者
    public function dianhuamsgdh(){
        global $_GPC, $_W;
        $params = array();
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $text = $_GPC['text'];
        require_once dirname(dirname(dirname(__FILE__))). '/inc/SignatureHelper.php';
        $res = pdo_fetch('SELECT * FROM' . tablename('hyb_yl_wenzorder') . "where uniacid ='{$uniacid}' and id='{$id}' ");
        $orders = $res['orders'];
        //查询回复时间
        $date_info_time = pdo_get('hyb_yl_wenzhenrule',array('uniacid'=>$uniacid),array('over'));
        $time = $date_info_time['over'];
        $aliduanxin = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_duanxin") . "WHERE uniacid = '{$uniacid}' ");
        $mobel = unserialize($aliduanxin['moban_id']);
        if ($aliduanxin['stadus'] == 1 ) {

            $j_id = $res['j_id'];
            $myinfo = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_userjiaren") . "WHERE uniacid = '{$uniacid}' and  j_id ='{$j_id}'");
            $name = $myinfo['names'];
            $phoneNum = $myinfo['tel'];
            $zid = $res['zid'];
            $doname = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . "as a left join" . tablename('hyb_yl_ceshi') . "as b on b.id=a.parentid WHERE a.uniacid = '{$uniacid}' and a.zid ='{$zid}'");
              pdo_update('hyb_yl_zhuanjia',array('ptperson'=>$doname['ptperson']+1),array('zid'=>$zid));
            $doctor = $doname['z_name'];
            $ksname = $doname['name'];
            $accessKeyId = $aliduanxin['key'];
            $accessKeySecret = $aliduanxin['scret'];
            $params["PhoneNumbers"] = $phoneNum;
            $params["SignName"] = $aliduanxin['qianming'];
            $params["TemplateCode"] = $mobel['jzmobel'];

            $params['TemplateParam'] = Array('orderid' => $orders, 'name' => $doctor,'time'=>$time);
            if (!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
                $params["TemplateParam"] = json_encode($params["TemplateParam"]);
            }
            $helper = new SignatureHelper();
            $content = $helper->request($accessKeyId, $accessKeySecret, "dysmsapi.aliyuncs.com", array_merge($params, array("RegionId" => "cn-hangzhou", "Action" => "SendSms", "Version" => "2017-05-25",)));
            echo json_encode($params);
        }
      }
     //开处方提醒患者
    //开处方提醒
    public function chufangmsgdh(){
        global $_GPC, $_W;
        $params = array();
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $text = $_GPC['text'];
        require_once dirname(dirname(dirname(__FILE__))). '/inc/SignatureHelper.php';
        $res = pdo_fetch('SELECT * FROM' . tablename('hyb_yl_chufang') . "where uniacid ='{$uniacid}' and c_id='{$id}' ");
        //查询回复时间
        $orders = $res['orders'];
        $date_info_time = pdo_get('hyb_yl_wenzhenrule',array('uniacid'=>$uniacid),array('over'));
        $time = $date_info_time['over'];
        $aliduanxin = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_duanxin") . "WHERE uniacid = '{$uniacid}' ");
        $mobel = unserialize($aliduanxin['moban_id']);
        if ($aliduanxin['stadus'] == 1 ) {

            $j_id = $res['userid'];
            $myinfo = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_userjiaren") . "WHERE uniacid = '{$uniacid}' and  j_id ='{$j_id}'");
            $name = $myinfo['names'];
            $phoneNum = $myinfo['tel'];
            $zid = $res['zid'];
            $doname = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . "as a left join" . tablename('hyb_yl_ceshi') . "as b on b.id=a.parentid WHERE a.uniacid = '{$uniacid}' and a.zid ='{$zid}'");
              pdo_update('hyb_yl_zhuanjia',array('ptperson'=>$doname['ptperson']+1),array('zid'=>$zid));
            $doctor = $doname['z_name'];
            $ksname = $doname['name'];
            $accessKeyId = $aliduanxin['key'];
            $accessKeySecret = $aliduanxin['scret'];
            $params["PhoneNumbers"] = $phoneNum;
            $params["SignName"] = $aliduanxin['qianming'];
            $params["TemplateCode"] = $mobel['kfovermobel'];
            $params['TemplateParam'] = Array('orderid' => $orders, 'name' => $doctor,'time'=>$time);
            if (!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
                $params["TemplateParam"] = json_encode($params["TemplateParam"]);
            }
            $helper = new SignatureHelper();
            $content = $helper->request($accessKeyId, $accessKeySecret, "dysmsapi.aliyuncs.com", array_merge($params, array("RegionId" => "cn-hangzhou", "Action" => "SendSms", "Version" => "2017-05-25",)));
            echo json_encode($params);
        }

      }
   //开方接诊
    public function kfjzmsgdh(){
        global $_GPC, $_W;
        $params = array();
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $text = $_GPC['text'];
        require_once dirname(dirname(dirname(__FILE__))). '/inc/SignatureHelper.php';
        $res = pdo_fetch('SELECT * FROM' . tablename('hyb_yl_chufang') . "where uniacid ='{$uniacid}' and c_id='{$id}' ");
         $orders = $res['orders'];
        //查询回复时间
        $date_info_time = pdo_get('hyb_yl_wenzhenrule',array('uniacid'=>$uniacid),array('over'));
        $time = $date_info_time['over'];
        $aliduanxin = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_duanxin") . "WHERE uniacid = '{$uniacid}' ");
        $mobel = unserialize($aliduanxin['moban_id']);
        if ($aliduanxin['stadus'] == 1 ) {

            $j_id = $res['j_id'];
            $myinfo = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_userjiaren") . "WHERE uniacid = '{$uniacid}' and  j_id ='{$j_id}'");
            $name = $myinfo['names'];
            $phoneNum = $myinfo['tel'];
            $zid = $res['zid'];
            $doname = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . "as a left join" . tablename('hyb_yl_ceshi') . "as b on b.id=a.parentid WHERE a.uniacid = '{$uniacid}' and a.zid ='{$zid}'");
            pdo_update('hyb_yl_zhuanjia',array('ptperson'=>$doname['ptperson']+1),array('zid'=>$zid));
            $doctor = $doname['z_name'];
            $ksname = $doname['name'];
            $accessKeyId = $aliduanxin['key'];
            $accessKeySecret = $aliduanxin['scret'];
            $params["PhoneNumbers"] = $phoneNum;
            $params["SignName"] = $aliduanxin['qianming'];
            $params["TemplateCode"] = $mobel['jzmobel'];
            $params['TemplateParam'] = Array('orderid' => $orders, 'name' => $doctor,'time'=>$time);
            if (!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
                $params["TemplateParam"] = json_encode($params["TemplateParam"]);
            }
            $helper = new SignatureHelper();
            $content = $helper->request($accessKeyId, $accessKeySecret, "dysmsapi.aliyuncs.com", array_merge($params, array("RegionId" => "cn-hangzhou", "Action" => "SendSms", "Version" => "2017-05-25",)));
        }
      }

    public function updateperson(){
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid']; 
        $state = $_GPC['state'];
        $doc_info = pdo_get('hyb_yl_zhuanjia',array('zid'=>$zid));
        if($state =='1'){
         $res = pdo_update("hyb_yl_zhuanjia",array('qyperson'=>0), array('zid'=>$zid));
        }
        if($state =='2'){
         $res = pdo_update("hyb_yl_zhuanjia",array('ptperson'=>0),array('zid'=>$zid));
        }
        if($state =='3'){
         $res = pdo_update("hyb_yl_zhuanjia",array('grperson'=>0),array('zid'=>$zid));
        }
        echo json_encode($res);
    }
    //查询专家字段
    public function dockey(){
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid']; 
        $res = pdo_get("hyb_yl_zhuanjia",array('zid'=>$zid));
        $res['qianynum'] = intval($res['qianynum']);
        $res['tixiannum'] = intval($res['tixiannum']);
        echo json_encode($res);
    }
    public function addtixingnum(){
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $key = $_GPC['key'];
        $get_one = pdo_getcolumn('hyb_yl_zhuanjia',array("zid"=>$zid),array("{$key}"));
        $res = pdo_update('hyb_yl_zhuanjia',array("{$key}"=>$get_one+1),array('zid'=>$zid));
        echo json_encode($res);
    }
    public function updatecforder() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $back_orser = $_GPC['back_orser'];
        $data = array('ispay' => 2);
        $res = pdo_update("hyb_yl_chufang", $data, array('back_orser' => $back_orser));
        echo json_encode($res);
    }
    public function updatesporder() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $back_orser = $_GPC['orders'];
        
        //查询接诊后的技术时间
        $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
        $chaoshi = $order_time['over'];
       //触发话单更新通话时长
       //$setaxndel
        $serxndel = pdo_getcolumn('hyb_yl_wenzhenrule',array('uniacid'=>$uniacid),'serxndel');
        $time_b = intval($chaoshi * 60);
        $newtime  = date("Y-m-d H:i:s");
        $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b);

        $data = array('ifpay' => 2,'overtime'=>strtotime($overtime),'jz_time'=>strtotime($newtime),'thtime'=>$serxndel);

        $res = pdo_update("hyb_yl_wenzorder", $data, array('back_orser' => $back_orser,'uniacid'=>$uniacid));

        echo json_encode($res);
    }
    public function getcfdetail() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $c_id = $_GPC['c_id'];
        $res = pdo_get("hyb_yl_chufang", array('c_id' => $c_id));
        $res['content'] = unserialize($res['content']);
        echo json_encode($res);
    }
    public function gettwdetail() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $cf_orser = $_GPC['cf_orser'];
        $res = pdo_get("hyb_yl_twenorder", array('orders' => $cf_orser));
        $res['content'] = unserialize($res['content']);
        echo json_encode($res);
    }
    public function gettwzetail() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $cf_orser = $_GPC['cf_orser'];
        $res = pdo_get("hyb_yl_wenzorder", array('orders' => $cf_orser));
        $res['content'] = unserialize($res['content']);
        echo json_encode($res);
    }
    public function chufangcont() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $back_orser = $_GPC['back_orser'];
        $c_id = $_GPC['c_id'];
 
        $res = pdo_fetchall("SELECT a.*,b.advertisement,b.z_name from" . tablename('hyb_yl_goodsorders') . "as a left join" . tablename('hyb_yl_zhuanjia') . "as b on b.zid=a.zid where a.uniacid ='{$uniacid}' and a.back_orders='{$back_orser}'"); 
        
        foreach ($res as $key => $value) {
            $res[$key]['advertisement'] = tomedia($res[$key]['advertisement']);
            $res[$key]['cartlist'] = unserialize($res[$key]['sid']);
            $res[$key]['content'] = unserialize($res[$key]['conets']);
        }
        echo json_encode($res);
    }

    public function chufanggoods(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $goodsid = $_GPC['goodsid'];
        $back_orser = $_GPC['back_orser'];
        $res = pdo_fetch("SELECT * from" . tablename('hyb_yl_goodsorders') ." where uniacid ='{$uniacid}' and id='{$goodsid}'"); 
        $res['cartlist'] = unserialize($res['sid']);
        echo json_encode($res);
    }

    public function getserverinfo() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $key_words = $_GPC['key_words'];
        $res = pdo_fetch("SELECT * FROM" . tablename('hyb_yl_docser_speck') . "where uniacid='{$uniacid}' and key_words='{$key_words}'");
        $res['buyreading'] = htmlspecialchars_decode($res['buyreading']);
        echo json_encode($res);
    }
    public function orderpj(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $orders = $_GPC['orders'];
        $row = pdo_get("hyb_yl_pingjia",array('orders'=>$orders,'openid'=>$openid));
        if(!$row){
          $res = 1;
        }else{
          $res = 0;
        }
        echo json_encode($res);
    }
    //更新电话问诊视频问诊到期时间
    public function dopagetime(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        //hyb_yl_wenzorder
        $ifpay = $_GPC['ifpay'];

        $orders = $_GPC['orders'];
        $key_words = $_GPC['key_words'];
        if($ifpay =='0' || $ifpay =='1'){
            if($key_words=='dianhuajizhen' || $key_words=='shipinwenzhen' || $key_words=='tijianjiedu' ||  $key_words=='shoushukuaiyue' ){
              $res = pdo_update('hyb_yl_wenzorder',array('ifgb'=>1),array('back_orser'=>$orders));
              $order = pdo_fetch("select a.openid,a.back_orser,a.addnum,b.z_name from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.zid=a.zid where a.back_orser=".$orders);
              if($key_words == 'dianhuajizhen')
              {
                  $order['title'] = '电话问诊';
              }else if($key_words == 'shipinwenzhen')
              {
                  $order['title'] = '视频问诊';
              }else if($key_words == 'tijianjiedu')
              {
                  $order['title'] = '体检解读';
              }else if($key_words == 'shoushukuaiyue')
              {
                  $order['title'] = '手术快约';
              }
            }
            if($key_words=='yuanchengkaifang'){
               $res = pdo_update('hyb_yl_chufang',array('ifgb'=>1),array('back_orser'=>$orders)); 
               $order = pdo_fetch("select a.openid,a.back_orser,a.addnum,b.z_name from ".tablename("hyb_yl_chufang")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.zid=a.zid where a.back_orser=".$orders);
               $order['title'] = '远程开方';
            }
            if($key_words=='tuwenwenzhen'){
               $res = pdo_update('hyb_yl_twenorder',array('ifgb'=>1),array('back_orser'=>$orders)); 
               $order = pdo_fetch("select a.openid,a.back_orser,a.addnum,b.z_name from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.zid=a.zid where a.back_orser=".$orders);
               $order['title'] = '图文问诊';
            }
            if($key_words=='yuanchengguahao'){
               $res = pdo_update('hyb_yl_guahaoorder',array('ifgb'=>1),array('back_orser'=>$orders)); 
               $order = pdo_fetch("select a.openid,a.back_orser,a.addnum,b.z_name from ".tablename("hyb_yl_guahaoorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.zid=a.zid where a.back_orser=".$orders);
               $order['title'] = '远程挂号';
            }

        }elseif($ifpay =='2'){
            if($key_words=='dianhuajizhen' || $key_words=='shipinwenzhen' || $key_words=='tijianjiedu' ||  $key_words=='shoushukuaiyue'){
                 $res = pdo_update('hyb_yl_wenzorder',array('ifpay'=>3,'ifgb'=>1),array('back_orser'=>$orders));
                 $order = pdo_fetch("select a.openid,a.back_orser,a.addnum,b.z_name from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.zid=a.zid where a.back_orser=".$orders);
                  if($key_words == 'dianhuajizhen')
                  {
                      $order['title'] = '电话问诊';
                  }else if($key_words == 'shipinwenzhen')
                  {
                      $order['title'] = '视频问诊';
                  }else if($key_words == 'tijianjiedu')
                  {
                      $order['title'] = '体检解读';
                  }else if($key_words == 'shoushukuaiyue')
                  {
                      $order['title'] = '手术快约';
                  }
            }
            if($key_words=='yuanchengkaifang'){
               $res = pdo_update('hyb_yl_chufang',array('ispay'=>3,'ifgb'=>1),array('back_orser'=>$orders)); 
              $order = pdo_fetch("select a.openid,a.back_orser,a.addnum,b.z_name from ".tablename("hyb_yl_chufang")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.zid=a.zid where a.back_orser=".$orders);
               $order['title'] = '远程开方';
            }
            if($key_words=='tuwenwenzhen'){
               $res = pdo_update('hyb_yl_twenorder',array('ifpay'=>3,'ifgb'=>1),array('back_orser'=>$orders));
               $order = pdo_fetch("select a.openid,a.back_orser,a.addnum,b.z_name from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.zid=a.zid where a.back_orser=".$orders);
               $order['title'] = '图文问诊';
            }
            if($key_words=='yuanchengguahao'){
               $res = pdo_update('hyb_yl_guahaoorder',array('ifpay'=>3,'ifgb'=>1),array('back_orser'=>$orders)); 
               $order = pdo_fetch("select a.openid,a.back_orser,a.addnum,b.z_name from ".tablename("hyb_yl_guahaoorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.zid=a.zid where a.back_orser=".$orders);
               $order['title'] = '远程挂号';
            }
        }
            $wxappaid = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
           
           $appid = $wxappaid['appid'];
           $appsecret = $wxappaid['appsecret'];
           $wxapptemp = unserialize($wxappaid['wxapp_mb']);
           $template_id = $wxapptemp['fwSuccess']; 
           $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
             $getArr = array();
             $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
             $access_token = $tokenArr->access_token;
             $url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=' . $access_token;
             $data_time = date("Y-m-d H:i:s");
             $dd['data']  = [
                'character_string1'   =>['value' =>$order['back_orser']],
                'name2'   =>['value' =>$order['z_name']],
                'thing3'    =>['value' =>$order['title'].",（剩余".$order['addnum']]."次）",
                'date4'    =>['value' =>date("Y-m-d H:i:s",time())],
              ];   
             $dd['touser'] = $order['openid'];
             $dd['template_id'] = $template_id;
             $dd['page'] = 'hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=tuwenwenzhen'; 
             $result1 = $this->https_curl_json($url, $dd, 'json');
             echo "<pre>";
             var_dump($result1);
             exit();
             
        //echo json_encode($res);
    }

    //更新处方时间
    public function dopageupcftime(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $time =date("Y-m-d H:i:s",time());
        $time2 = strtotime($time);
        $res = pdo_fetchall("SELECT `time`,`overtime`,`c_id` FROM".tablename('hyb_yl_chufang')."where uniacid='{$uniacid}' and (ispay=0 or  ispay=2 ) and role=0 and type=1");
 
        foreach ($res as $key => $value) {
            // $time_b = intval($value['time']);
            // $overtime = date("Y-m-d H:i:s",$time_b+600);
            $id = $value['c_id'];
            $endTimeStr  = intval($value['overtime']);
            $remain_time = ($endTimeStr - $time2);

            $remain_hour = floor($remain_time/(60*60)); //剩余的小时
            $remain_minute = floor(($remain_time - $remain_hour*60*60)/60); //剩余的分钟数
            $remain_second = ($remain_time - $remain_hour*60*60 - $remain_minute*60); //剩余的秒数
            $rem_tt_time =  $remain_hour.':'.$remain_minute.':'. $remain_second;

            if($endTimeStr > $time2){
               pdo_update("hyb_yl_chufang",array('dumiao'=>$rem_tt_time),array('c_id'=>$id));
            }
            if($endTimeStr == $time2){
                if($res['ifpay'] =='2'){
                  pdo_update("hyb_yl_chufang",array('dumiao'=>$rem_tt_time,'ifpay'=>3),array('c_id'=>$id));
                }else{
                  pdo_update("hyb_yl_chufang",array('dumiao'=>$rem_tt_time,'ifpay'=>7),array('c_id'=>$id));
                }
            }
        }

    }
    public function dopagettuwentime(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $time =date("Y-m-d H:i:s",time());
        $time2 = strtotime($time);
        $res = pdo_fetchall("SELECT `xdtime`,`overtime`,`id` FROM".tablename('hyb_yl_twenorder')."where uniacid='{$uniacid}' and (ifpay=0 or  ifpay=2 ) and role=0 and grade=1");

        foreach ($res as $key => $value) {
            $id = $value['id'];
            $endTimeStr  = intval($value['overtime']);
            $remain_time = ($endTimeStr - $time2);
 
            $remain_hour = floor($remain_time/(60*60)); //剩余的小时

            $remain_minute = floor(($remain_time - $remain_hour*60*60)/60); //剩余的分钟数
            $remain_second = ($remain_time - $remain_hour*60*60 - $remain_minute*60); //剩余的秒数
            $rem_tt_time =  $remain_hour.':'.$remain_minute.':'. $remain_second;

            if($endTimeStr > $time2){
               pdo_update("hyb_yl_twenorder",array('dumiao'=>$rem_tt_time),array('id'=>$id));
            }
            if($endTimeStr == $time2){
                if($res['ifpay'] =='2'){
                  pdo_update("hyb_yl_twenorder",array('dumiao'=>$rem_tt_time,'ifpay'=>3),array('id'=>$id));
                }else{
                  pdo_update("hyb_yl_twenorder",array('dumiao'=>$rem_tt_time,'ifpay'=>7),array('id'=>$id));
                }
            }
        }

    }
    public function addpingjia() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];

        //查询一条评价记录
        $openid = $_GPC['openid'];
        $orders = $_GPC['orders'];
        $row = pdo_get("hyb_yl_pingjia",array('orders'=>$orders,'openid'=>$openid));
        
        $data =array(
          'uniacid'  => $_W['uniacid'],
          'starsnum' => $_GPC['starsnum'],
          'zid'      => $_GPC['zid'],
          'orders'   => $_GPC['orders'],
          'keywords' => $_GPC['keywords'],
          'j_id'     => $_GPC['j_id'],
          'openid'   => $_GPC['openid'],
          'createTime'=> strtotime('now'),
          'content'  => $_GPC['content']
          );
        if(!$row){
           pdo_insert('hyb_yl_pingjia',$data);
           if($_GPC['keywords'] == 'tuwenwenzhen')
           {
                pdo_update("hyb_yl_twenorder",array('ifpay'=>4),array('back_orser'=>$orders));
           }
           
           $res = 1;
        }else{
           $res = 0;
        }
        
        echo json_encode($res);
    }

    public function getordernum(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
        $mch_id = $res['mch_id'];
        $out_trade_no = $mch_id . time();
        return $out_trade_no;
     }
     public function updatetwstate(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        //支付订单自动结束
        $back_orser = $_GPC['back_orser'];
        $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
        $chaoshi = $order_time['over'];
        $time_b = intval($chaoshi * 60);
        $newtime  = date("Y-m-d H:i:s");
        $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b);
        pdo_update('hyb_yl_twenorder',array('ifpay'=>2,'overtime' => strtotime($overtime),'jztime'=>$newtime),array('back_orser' => $_GPC['back_orser']));
        //查询订单结束时间
        $res = pdo_get("hyb_yl_twenorder",array('orders'=>$back_orser));
        echo json_encode($res);
     }

     // public function updatecfstate(){
     //    global $_GPC, $_W;
     //    $uniacid = $_W['uniacid'];
     //    //支付订单自动结束
     //    $back_orser = $_GPC['back_orser'];
     //    $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
     //    $chaoshi = $order_time['over'];
     //    $time_b = intval($chaoshi * 60);
     //    $newtime  = date("Y-m-d H:i:s");
     //    $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b);
     //    pdo_update('hyb_yl_chufang',array('ispay'=>2,'overtime' => strtotime($overtime)),array('back_orser' => $_GPC['back_orser']));
     //    //查询订单结束时间
     //    $res = pdo_get("hyb_yl_chufang",array('orders'=>$back_orser));
     //    echo json_encode($res);
     // }

     public function updatecfstate(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        //支付订单自动结束
        $back_orser = $_GPC['back_orser'];
        $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
        $chaoshi = $order_time['over'];
        $time_b = intval($chaoshi * 60);
        $newtime  = date("Y-m-d H:i:s");
        $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b);
        pdo_update('hyb_yl_chufang',array('ispay'=>2,'overtime' => strtotime($overtime),'jztime'=>$newtime),array('back_orser' => $_GPC['back_orser']));
        //查询订单结束时间
        $res = pdo_get("hyb_yl_chufang",array('orders'=>$back_orser));
        echo json_encode($res);
     }
     public function updatewzstate(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        //支付订单自动结束
        $back_orser = $_GPC['back_orser'];
        $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
        $chaoshi = $order_time['over'];
        $time_b = intval($chaoshi * 60);
        $newtime  = date("Y-m-d H:i:s");
        $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b);

        pdo_update('hyb_yl_wenzorder',array('ifpay'=>2,'overtime' => strtotime($overtime)),array('back_orser' => $_GPC['back_orser']));
        //查询订单结束时间
        $res = pdo_get("hyb_yl_wenzorder",array('orders'=>$back_orser));

        echo json_encode($res);
     }
     public function updateghstate(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        //支付订单自动结束
        $back_orser = $_GPC['back_orser'];
        $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
        $chaoshi = $order_time['over'];
        $time_b = intval($chaoshi * 60);
        $newtime  = date("Y-m-d H:i:s");
        $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b);

        pdo_update('hyb_yl_guahaoorder',array('ifpay'=>2,'overtime' => strtotime($overtime)),array('back_orser' => $_GPC['back_orser']));
        //查询订单结束时间
        $res = pdo_get("hyb_yl_guahaoorder",array('orders'=>$back_orser));

        echo json_encode($res);
     }
     public function updateghorder(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $back_orser = $_GPC['back_orser'];
        $data = array('ifpay' => 2);
        $res = pdo_update("hyb_yl_guahaoorder", $data, array('back_orser' => $back_orser));
        echo json_encode($res);
     }
     public function updatesskyorder(){
         global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $back_orser = $_GPC['back_orser'];
        $data = array('ifpay' => 2);
        $res = pdo_update("hyb_yl_wenzorder", $data, array('back_orser' => $back_orser));
        echo json_encode($res);
     }
     public function getgkquestionall(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid']; 
        $zid = $_GPC['zid'];
        //查询专家标签
        $where = " where a.uniacid=".$uniacid." and a.status=0";
        $biaoqian = $_GPC['biaoqian'];

        $list = pdo_fetchall("select a.*,z.xn_reoly,z.advertisement,z.z_zhicheng from ".tablename("hyb_yl_answer")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid left join ".tablename("hyb_yl_twenorder")." as c on c.back_orser=a.orders ".$where." and c.zid='{$zid}' and find_in_set('{$biaoqian}', c.biaoqian) order by a.id desc ");

        
        foreach($list as &$value)
        {
          $value['typs'] = 'answer';
          $value['content'] = unserialize($value['content']);
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
          $value['time'] = date("m月d日 H:i:s",$value['created']);
          $user = pdo_get("hyb_yl_userinfo",array("openid"=>$value['openid']));
          $value['names'] = "匿名用户".$user['u_id'];
        }
    
           echo json_encode($list);
   
     }
     //专家的公开问题
     public function getgkquestion(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid']; 
        $zid = $_GPC['zid'];
        //查询专家标签
        $where = " where a.uniacid=".$uniacid." and a.status=0";
        $biaoqian = $_GPC['biaoqian'];

        $list = pdo_fetchall("select a.*,z.xn_reoly,z.advertisement,z.z_zhicheng from ".tablename("hyb_yl_answer")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid left join ".tablename("hyb_yl_twenorder")." as c on c.back_orser=a.orders ".$where." and c.zid='{$zid}' and find_in_set('{$biaoqian}', c.biaoqian) order by a.id desc limit 5");

        
        foreach($list as &$value)
        {
          $value['typs'] = 'answer';
          $value['content'] = unserialize($value['content']);
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
          $value['time'] = date("m月d日 H:i:s",$value['created']);
          $user = pdo_get("hyb_yl_userinfo",array("openid"=>$value['openid']));
          $value['names'] = "匿名用户".$user['u_id'];
        }
    
           echo json_encode($list);
   
     }

     //专家的公开问题
     public function getgkpingjia(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $res = pdo_fetchall("SELECT a.zid,a.starsnum,a.createTime,a.content,b.names from".tablename('hyb_yl_pingjia')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id=a.j_id where a.uniacid='{$uniacid}'  and a.typs=1 and a.zid='{$zid}'");

        foreach ($res as $key => $value) {
            $res[$key]['createTime'] = date("m月d日 H:i:s",$res[$key]['createTime']);
            $res[$key]['names'] = "匿名用户".'00'.$key;
            $res[$key]['starsnum'] = intval($res[$key]['starsnum']);
        }
       
        echo json_encode($res);
     }
     //专家职称
    public function getzhichenglist(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_zhuanjia_job')."WHERE uniacid='{$uniacid}' order by job_strot desc");
        foreach ($res as $key => $value) {
            $res[$key]['checked'] = false;
        }
        echo json_encode($res);
    }
    private function HisToS($his) {
        $str = explode(':', $his);
        $len = count($str);
        if ($len == 3) {
            $time = $str[0] * 3600 + $str[1] * 60 + $str[2];
        } elseif ($len == 2) {
            $time = $str[0] * 60 + $str[1];
        } elseif ($len == 1) {
            $time = $str[0];
        } else {
            $time = 0;
        }
        return $time;
    }
    private function SToHis($seconds) {
        $seconds = (int)$seconds;
        $time = '';
        if ($seconds > 3600) {
            if ($seconds > 86400) {
                $days = (int)($seconds / 86400);
                $seconds = $seconds % 86400; //取余
                $time.= $days . " 天 ";
            }
            $hours = intval($seconds / 3600);
            $minutes = $seconds % 3600; //取余下秒数
            $time.= $hours . " 小时 ";
        } elseif ($seconds > 60) {
            $time = gmstrftime('%M 分钟 ', $seconds);
        } else {
            $time = gmstrftime('%S ', $seconds);
        }
        return $time;
    }
    public function subtext($text, $length) {
        if (mb_strlen($text, 'utf8') > $length) {
            return mb_substr($text, 0, $length, 'utf8') . '...';
        } else {
            return $text;
        }
    }
    private function https_curl_json($url, $data, $type) {
        if ($type == 'json') {
            $headers = array("Content-type: application/json;charset=UTF-8", "Accept: application/json", "Cache-Control: no-cache", "Pragma: no-cache", "Content-type:application/x-www-form-urlencoded");
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
    // 团队列表
     public function teamlists()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];

        $zid = $_GPC['zid'];
        $type = $_GPC['type'];
        $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
        $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
        $keyword = $_GPC['keyword'];

        $where = " where t.uniacid={$uniacid} and t.zid={$zid}";
        $where1 = " where p.uniacid={$uniacid} and p.y_zid={$zid} and p.status != 3 and p.type=1";
        if($keyword != '')
        {
            $where .= " and (t.title like '%$keyword%' or z.z_name like '%$keyword%' or h.agentname like '%$keyword%')";
            $where1 .= " and (t.title like '%$keyword%' or z.z_name like '%$keyword%' or h.agentname like '%$keyword%')";
        }
        
        if($type == '0')
        {
            $list = pdo_fetchall("select t.*,z.z_zhicheng from ".tablename("hyb_yl_team")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid left join ".tablename("hyb_yl_hospital")." as h on h.hid=t.jigou_two ".$where." order by t.id desc limit ".$page * $pagesize .",".$pagesize);

        }else if($type == '1')
        {
            $list = pdo_fetchall("select t.*,p.add_time,z.z_zhicheng,p.status as add_status,p.type as add_type from ".tablename("hyb_yl_team_people")." as p left join ".tablename("hyb_yl_team")." as t on t.id=p.tid left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=p.y_zid left join ".tablename("hyb_yl_hospital")." as h on h.hid=t.jigou_two ".$where1." order by p.add_time desc limit ".$page * $pagesize .",".$pagesize);
            
           
        }

        foreach($list as &$value)
        {
            $value['thumb'] = tomedia($value['thumb']);
            $num = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team_people")." where tid=".$value['id']." and status=1 and uniacid=".$uniacid);
            
            $value['num'] = $num;
            $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
            $value['label'] = json_decode($value['label'],true);
            $value['plugin'] = unserialize($value['plugin']);
            if($value['cid'] != '' || $value['cid'] != '0')
            {
                $value['c_name'] = pdo_getcolumn("hyb_yl_community",array("id"=>$value['cid']),'title');
            }
        }
        if(!$zid)
        {
          $list = array();
        }
        echo json_encode($list);
    }

    // 专家加入团队操作
    public function addteam()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $status = $_GPC['status'];
        $zid = $_GPC['zid'];
        $res = pdo_update("hyb_yl_team_people",array("status"=>$status,"add_time"=>time()),array("tid"=>$id,"y_zid"=>$zid));
        echo json_encode($res);
    }

  // 判断专家是否有年卡
    public function zhuanjia_year()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $zid = $_GPC['zid'];
      $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$zid));
      $zhuanjia['advertisement'] = tomedia($zhuanjia['advertisement']);
      $zhuanjia['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjia['pid']),'name');
      $zhuanjia['job_name'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$zhuanjia['z_zhicheng']),"job_name");
      $res = pdo_fetch("select * from ".tablename("hyb_yl_yearcard")." where uniacid=".$uniacid." and zid=".$zid." and status=1 and typs=1");
      if($res)
      {
        $res['zhuanjia'] = $zhuanjia;
        $res['content'] = htmlspecialchars_decode($res['content'],true);
      }
      
      echo json_encode($res);
    }
    // 专家编辑添加年卡
    public function edit_year()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $zid = $_GPC['zid'];
        $z_name = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$zid),'z_name');
        $data = array(
            'zid' => $zid,
            "uniacid" => $uniacid,
            "z_name" => $z_name,
            "is_mianfei" => $_GPC['is_mianfei'],
            "is_wzzk" => $_GPC['is_wzzk'],
            "hh_num" => $_GPC['hh_num'],
            "wz_num" => $_GPC['wz_num'],
            "wz_zhekou" => $_GPC['wz_zhekou'],
            "is_jd" => $_GPC['is_jd'],
            "jd_num" => $_GPC['jd_num'],
            "num" => $_GPC['num'],
            "old_price" => $_GPC['old_price'],
            "new_price" => $_GPC['new_price'],
            "is_hh" => $_GPC['is_hh'],
            "times" => $_GPC['times'],
            "typs" => $_GPC['typs'],
            "notes" => $_GPC['notes'],
            "created" => time(),
        );
        if($id && $id != 'undefined')
        {
            $res = pdo_update("hyb_yl_yearcard",$data,array("id"=>$id));
        }else{
            $res = pdo_insert("hyb_yl_yearcard",$data);
        }
        
    }
    // 判断用户是否办理专家年卡
    public function is_yearcard()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $yid = $_GPC['yid'];
        $openid = $_GPC['openid'];
        $res = pdo_fetch("select * from ".tablename("hyb_yl_user_yearcard")." where zid=".$zid." and yid=".$yid." and uniacid=".$uniacid." and openid=".$openid);

        if($res)
        {
            $res['end_time'] = date("Y-m-d H:i:s",$res['end_time']);
        }
        
        
        $count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_user_yearcard")." where zid=".$zid." and yid=".$yid." and uniacid=".$uniacid);
        
        $yearcard = pdo_get("hyb_yl_yearcard",array("uniacid"=>$uniacid,"zid"=>$zid,"id"=>$yid));
        if($res['status'] == '0')
        {
            $data = array(
                'code' => '3',
                'message' => '您已申请过该专家年卡，是否前往支付？',
                'created' => $res['created'],
            );
        }else if($res)
        {
            $data = array(
                'code' => '2',
                'message' => '您的年卡到期时间为'.$res['end_time']."，是否确认续费？",
            );
        }else if($yearcard['num'] - $count == '0')
        {
            $data = array(
                'code' => '1',
                'message' => '该专家年卡已售完，请选择其他专家',
            );
        }else{
            $data = array(
                'code' => '0',
                'message' => '',
            );
        }
        echo json_encode($data);

    }
    // 用户办理年卡
    public function user_blyear()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $yid = $_GPC['yid'];
        $openid = $_GPC['openid'];
        $money = $_GPC['money'];
        $wz_num = $_GPC['wz_num'];
        $wz_zhekou = $_GPC['wz_zhekou'];
        $jd_num = $_GPC['jd_num'];
        $hh_num = $_GPC['hh_num'];
        $times = $_GPC['times'];
        $res = pdo_get("hyb_yl_user_yearcard",array("zid"=>$zid,"yid"=>$yid,"openid"=>$openid,"uniacid"=>$uniacid));

        $key = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
        $mch_id = $key['mch_id'];
        $ordersn = $mch_id.time();
        
        if($res && $res['status'] == '0')
        {
            $data = array(
                'created' => time(),
                "end_time" => strtotime("+$times year"),
            );
            pdo_update("hyb_yl_user_yearcard",$data,array("id"=>$res['id']));
        }
        elseif($res && $res['end_time'] <= time())
        {
            $data = array(
                'uniacid' => $uniacid,
                "money" => $money,
                "wz_num" => $_GPC['wz_num'],
                "wz_zhekou" => $_GPC['wz_zhekou'],
                "jd_num" => $_GPC['jd_num'],
                "hh_num" => $_GPC['hh_num'],
                // "end_time" => strtotime("+$times year"),
                "ordersn" => $ordersn,
            );
            if($money == '0.00' || $money == '0')
            {
                $data['status'] = '1';
                $data['end_time'] = strtotime("+$times year");
            }
            pdo_update("hyb_yl_user_yearcard",$data,array("id"=>$res['id']));
        }else if($res && $res['end_time'] > time())
        {
            $data = array(
                'uniacid' => $uniacid,
                "money" => $money,
                "wz_num" => $res['wz_num'] + $_GPC['wz_num'],
                "wz_zhekou" => $_GPC['wz_zhekou'],
                "jd_num" => $res['wz_num'] + $_GPC['jd_num'],
                "hh_num" => $res['wz_num'] + $_GPC['hh_num'],
                // "end_time" => strtotime(date("Y-m-d H:i:s",$res['end_time'])."+$times year"),
                "ordersn" => $ordersn,

            );
            if($money == '0.00' || $money == '0')
            {
                $data['status'] = '1';
                $data['end_time'] = strtotime(date("Y-m-d H:i:s",$res['end_time'])."+$times year");
            }
            pdo_update("hyb_yl_user_yearcard",$data,array("id"=>$res['id']));
        }else{

            $data = array(
                'uniacid' => $uniacid,
                "money" => $money,
                "wz_num" => $_GPC['wz_num'],
                "wz_zhekou" => $_GPC['wz_zhekou'],
                "jd_num" => $_GPC['jd_num'],
                "hh_num" => $_GPC['hh_num'],
                "end_time" => strtotime("+$times year"),
                "zid" => $zid,
                "yid" => $yid,
                "openid" => $openid,
                "created" => time(),
                "ordersn" => $ordersn,

            );

            if($money == '0.00' || $money == '0')
            {
                $data['status'] = '1';
            }

            pdo_insert("hyb_yl_user_yearcard",$data);
            $res['created'] = time();
            $res['ordersn'] = $ordersn;
        }
        echo json_encode($res);
    }
    // 年卡支付
    public function pay_year()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        cache_write('uniacid',$_W['uniacid']);
          require_once dirname(dirname(dirname(__FILE__)))."/wxpay.php";
          $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
          $appid = $res['appid'];
          $openid = $_GPC['openid'];
          $mch_id = $res['mch_id'];
          $key = $res['pub_api'];
          $out_trade_no = $_GPC['ordersn'];
          $total_fee = $_GPC['money'];
          $noturl = 'http://'.$_SERVER['SERVER_NAME'].'/addons/hyb_yl/yearnoturl.php';
          

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

    // 修改状态
    public function update_pay()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $yid = $_GPC['yid'];
        $ordersn = $_GPC['ordersn'];
        $yearcard = pdo_get("hyb_yl_yearcard",array("id"=>$yid));
        $times = $yearcard['times'];
        $user_card = pdo_get("hyb_yl_user_yearcard",array("yid"=>$yid,'openid'=>$openid,'uniacid'=>$uniacid));
        if($user_card['status'] == '1' && $user_card['end_time']>=time())
        {
            pdo_update("hyb_yl_user_yearcard",array("status"=>'1',"end_time" => strtotime(date("Y-m-d H:i:s",$res['end_time'])."+$times year")),array("yid"=>$yid,'openid'=>$openid,'uniacid'=>$uniacid));
        }else if($user_card['status'] == '1' && $user_card['end_time'] <= time()){
            pdo_update("hyb_yl_user_yearcard",array("end_time" => strtotime("+$times year")),array("yid"=>$yid,'openid'=>$openid,'uniacid'=>$uniacid));
        }else{
            pdo_update("hyb_yl_user_yearcard",array("status"=>'1'),array("yid"=>$yid,'openid'=>$openid,'uniacid'=>$uniacid));
        }
        
        $hospital = pdo_fetch("select a.* from ".tablename("hyb_yl_hospital")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.hid=a.hid where a.uniacid=".$uniacid." and z.zid=".$yearcard['zid']);
        $card_cut = pdo_get("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid),'card_cut');
        if($yearcard['cut'] != '0.00' || $yearcard['cut'] != '')
        {
            $card_cuts = $yearcard['cut'];
        }else if($card_cut != '0.00' || $card_cut != '')
        {
            $card_cuts = $card_cut;
        }else{
            $card_cuts = '0.00';
        }
        if(!empty($card_cuts) && $card_cuts != '0.00')
        {
            $money = $yearcard['money'];
            $moneys = $money * $card_cuts / 100;
            $data = array(
                'uniacid' => $uniacid,
                "openid" => $openid,
                "money" => $moneys,
                "created" => time(),
                "back_orser" => $ordersn,
                "old_money" => $yearcard['money'],
                "keyword"=> 'yearcard',
                "type" => '0',
                "style" => '8',
                "status" => '1',
                "cash" => '0',
            );
            pdo_insert("hyb_yl_pay",$data);
            pdo_update("hyb_yl_user_yearcard",array("ptmoney"=>$moneys),array("yid"=>$yid,'openid'=>$openid,'uniacid'=>$uniacid));
            
        }

        $hos_cut = $hospital['cut'];
        if($hos_cut != '0.00' && !empty($hos_cut))
        {
            $moneys = $money * $hos_cut / 100;
            $money1 = $hospital['money'] + $moneys;
            $datas = array(
                'uniacid' => $uniacid,
                "openid" => $openid,
                "money" => $moneys,
                "created" => time(),
                "back_orser" => $ordersn,
                "old_money" => $yearcard['money'],
                "keyword"=> 'yearcard',
                "type" => '0',
                "style" => '7',
                "status" => '1',
                "cash" => '0',
                "hid" => $hospital['hid']
            );
            pdo_insert("hyb_yl_pay",$data);
            pdo_update("hyb_yl_hospital",array("money"=>$money1),array("hid"=>$hospital['hid']));
            pdo_update("hyb_yl_user_yearcard",array("hosmoney"=>$moneys),array("yid"=>$yid,'openid'=>$openid,'uniacid'=>$uniacid));
        }

        
    }

     // 获取用户年卡
  public function user_year()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $zid = $_GPC['zid'];
    $res = pdo_fetch("select * from ".tablename("hyb_yl_user_yearcard")." where openid=".$openid." and uniacid=".$uniacid." and zid=".$zid." and endtime >=".time());
    echo json_encode($res);
    
  }
  // 获取用户可使用优惠券
  public function user_coupons()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $money = $_GPC['money'];
    $key_words = $_GPC['key_words'];
    $zid = $_GPC['zid'];
    $hid = pdo_getcolumn("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$zid),'hid');
    $type = pdo_getcolumn("hyb_yl_docser_speck",array("key_words"=>$key_words,"uniacid"=>$uniacid),'id');

    $list = pdo_fetch("select u.*,c.usagetype,c.deductible_amount from ".tablename("hyb_yl_user_coupon")." as u left join ".tablename("hyb_yl_coupon")." as c on c.id=u.coupon_id where u.uniacid=".$uniacid." and u.applicableservices regexp '{$type}' and u.deductible_amount<=".$money." and u.status=0 and c.hid=".$hid." order by u.id desc");
    
    
    echo json_encode($list);

  }
  public function updateexa(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $zid = $_GPC['zid'];
    $exa = $_GPC['exa'];
    if($exa =='1'){
      $data =array(
        'exa' => 0
        );
    }
    if($exa =='0'){
      $data =array(
        'exa' => 1
        ); 
    }
    if($exa =='2'){
      $data =array(
        'exa' => 1
        ); 
    }
    $res = pdo_update("hyb_yl_zhuanjia",$data,array('zid'=>$zid));
    echo json_encode($res);
  }


    public function checkcollect()
    {
      global $_W, $_GPC;
      $id = intval($_REQUEST['goods_id']);
      $openid = $_GPC['openid'];
      $uniacid = $_W['uniacid'];
      $cerated_type =$_GPC['cerated_type'];
      $rst = pdo_get('hyb_yl_attention', array('goods_id' => $id, 'openid' => $openid,'cerated_type'=>$cerated_type));
      if ($rst) {
        echo '1';
      } else {
        echo '0';
      }
    }

    public function savecollectup(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = intval($_REQUEST['goods_id']);//医生ID
        $zid = intval($_REQUEST['goods_id']);//医生ID
        $cerated_type = $_GPC['cerated_type'];
        $uniacid =$_W['uniacid'];
        $ifqianyue =$_GPC['ifqianyue'];
        $qyperson = pdo_getcolumn("hyb_yl_zhuanjia",array('uniacid'=>$uniacid,'zid'=>$id),'qyperson');
        $re = pdo_get('hyb_yl_attention', array('openid' => $_GPC['openid'], 'goods_id' => $id,'cerated_type' => $cerated_type,'uniacid'=>$uniacid));
        if ($re) {
            $res = pdo_update('hyb_yl_attention',array('ifqianyue'=>$ifqianyue),array('uniacid'=>$uniacid,'id'=>$re['id']));
            if($qyperson['ifqianyue']=='1'){
               pdo_update('hyb_yl_zhuanjia',array('qyperson'=>$qyperson-1),array('zid'=>$id));
            }else{
                pdo_update('hyb_yl_zhuanjia',array('qyperson'=>$qyperson+1),array('zid'=>$id));
            }
            
        } else {
            $data['openid'] = $_GPC['openid'];
            $data['goods_id'] = $id;
            $data['cerated_type'] = $cerated_type;
            $data['cerated_time'] = date('Y-m-d H:i:s');
            $data['uniacid'] = $uniacid;
            $data['ifqianyue'] =$_GPC['ifqianyue'];
            $data['change'] =$_GPC['change'];
            $res = pdo_insert('hyb_yl_attention', $data);
            //查询专家最新签约人数
            
            pdo_update('hyb_yl_zhuanjia',array('qyperson'=>$qyperson+1),array('zid'=>$zid));
        }
        echo json_encode($res);
    }

    // 专家粉丝
    public function checkcollect2() {
        global $_W, $_GPC;
        $id = intval($_REQUEST['goods_id']);
        $openid = $_GPC['openid'];
        $uniacid = $_W['uniacid'];
        $rst = pdo_get('hyb_yl_attention', array('goods_id' => $id, 'openid' => $openid,'cerated_type'=>7));
        echo json_encode($rst);
    }
    public function getqylistser(){
        global $_W, $_GPC;
        $zid = intval($_REQUEST['goods_id']);
        $cerated_type = $_GPC['cerated_type'];
        $uniacid = $_W['uniacid'];
        $page = $_GPC['page'];
        $pagesize = empty($_GPC['pagesize']) ? "10" : $_GPC['pagesize'];
        $index = empty($_GPC['index']) ? '0' : $_GPC['index'];
        if($index == '0')
        {
            $list = pdo_fetchall("SELECT a.*,b.*,c.u_thumb,c.u_label FROM ".tablename('hyb_yl_attention')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.openid=a.openid left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid WHERE a.uniacid='{$uniacid}' and a.goods_id='{$zid}' and a.cerated_type='{$cerated_type}' and b.openid is not NULL and (a.ifqianyue=1 or a.ifqianyue=2) group by b.openid order by a.id desc limit ".$page * $pagesize . ",".$pagesize);
            foreach($list as &$value)
            {
                $value['u_label'] = pdo_getcolumn("hyb_yl_twenorder",array("openid"=>$value['openid']),'biaoqian');
                if(!$value['u_label'])
                {
                    $value['u_label'] = '暂无';
                }
                $value['u_biaoqian'] = pdo_getcolumn("hyb_yl_twenorder",array("openid"=>$value['openid']),'biaoqian');
                if(!$value['u_biaoqian'])
                {
                    $value['u_biaoqian'] = '暂无';
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
        }else if($index == '1')
        {
            $gh_huanzhe = pdo_fetchall("select a.*,b.*,c.u_thumb,c.u_label from ".tablename("hyb_yl_guahaoorder")." as a left join ".tablename("hyb_yl_userjiaren")." as b on b.openid=a.openid left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid where a.uniacid=".$uniacid." and a.zid=".$zid." and (a.ifpay != 0 or a.ifpay != 6 or a.ifpay != 7 or a.ifpay!=8)");

             $tw_huanzhe = pdo_fetchall("select a.*,b.*,c.u_thumb,c.u_label from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_userjiaren")." as b on b.openid=a.openid left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid where a.uniacid=".$uniacid." and a.zid=".$zid." and (a.ifpay != 0 or a.ifpay != 6 or a.ifpay != 7)");

             $wz_huanzhe = pdo_fetchall("select a.*,b.*,c.u_thumb,c.u_label from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_userjiaren")." as b on b.openid=a.openid left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid where a.uniacid=".$uniacid." and a.zid=".$zid." and (a.ifpay != 0 or a.ifpay != 6 or a.ifpay != 7)");
             
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
        
            $list = array_slice($lists,$page * $pagesize,$pagesize);
            foreach($list as &$value)
            {
                $value['u_label'] = pdo_getcolumn("hyb_yl_twenorder",array("openid"=>$value['openid']),'biaoqian');
                if(!$value['u_label'])
                {
                    $value['u_label'] = '暂无';
                }
                $value['biaoqian'] = pdo_getcolumn("hyb_yl_twenorder",array("openid"=>$value['openid']),'biaoqian');
                if(!$value['u_biaoqian'])
                {
                    $value['u_biaoqian'] = '暂无';
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
                //查询档案是否开启
                $change1 = pdo_getcolumn('hyb_yl_attention',array('uniacid'=>$uniacid,'goods_id'=>$zid,'openid'=>$value['openid'],'cerated_type'=>0),'change');

                $change2 = pdo_getcolumn('hyb_yl_attention',array('uniacid'=>$uniacid,'goods_id'=>$zid,'openid'=>$value['openid'],'cerated_type'=>7,'ifqianyue'=>2),'change');

                $value['change'] = $change1?$change1:$change2;
            }

            
        }else if($index == '2')
        {

            $list = pdo_fetchall("select a.*,b.*,c.u_thumb,c.u_label from ".tablename("hyb_yl_user_yearcard")." as a left join ".tablename("hyb_yl_userjiaren")." as b on b.openid=a.openid left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid where a.uniacid=".$uniacid." and a.zid=".$zid." and a.status=1 and a.end_time>=".time()." and b.sick_index=0 order by a.id desc limit ".$page * $pagesize . ",".$pagesize);
            
            foreach($list as &$value)
            {
                $value['created'] = date("Y-m-d H:i:s",$value['created']);
                $value['end_time'] = date("Y-m-d H:i:s",$value['end_time']);
                $value['change'] = '1';
                $value['u_label'] = pdo_getcolumn("hyb_yl_twenorder",array("openid"=>$value['openid']),'biaoqian');
                if(!$value['u_label'])
                {
                    $value['u_label'] = '暂无';
                }
                $value['u_biaoqian'] = pdo_getcolumn("hyb_yl_twenorder",array("openid"=>$value['openid']),'biaoqian');
                if(!$value['u_biaoqian'])
                {
                    $value['u_biaoqian'] = '暂无';
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
     
     
        }
        
             
        echo json_encode($list);
    }
    public function updateqianyue(){
        global $_W, $_GPC;
        $id = intval($_REQUEST['id']);
        $uniacid = $_W['uniacid'];
        $res = pdo_update('hyb_yl_attention',array('ifqianyue'=>2),array('id'=>$id));
        echo json_encode($res);
    }
    public function allkeshi()
    {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $list = pdo_getall('hyb_yl_ceshi',array('uniacid'=>$uniacid));
        foreach ($list as $key => $value) {
            $list2[$value['py']][] = $value;
        }
         echo json_encode($list2);

    }
    public function array_unique_new($arr){
        $t = array_map('serialize', $arr);//利用serialize()方法将数组转换为以字符串形式的一维数组
        $t = array_unique($t);//去掉重复值
        $new_arr = array_map('unserialize', $t);//然后将刚组建的一维数组转回为php值
        return $new_arr; 
        }
    public function updatejujueqianyue(){
        global $_W, $_GPC;
        $id = intval($_REQUEST['id']);
        $uniacid = $_W['uniacid'];
        $res = pdo_update('hyb_yl_attention',array('ifqianyue'=>5),array('id'=>$id));
        echo json_encode($res);
    }
    public function updatejiechuqianyue(){
        global $_W, $_GPC;
        $id = intval($_REQUEST['id']);
        $uniacid = $_W['uniacid'];
        $res = pdo_update('hyb_yl_attention',array('ifqianyue'=>3),array('id'=>$id));
        echo json_encode($res);
    }
    // 获取用户下单
  public function pay_money()
  {
    global $_W,$_GPC;
    $openid = $_GPC['openid'];
    $zid = $_GPC['zid'];
    $is_year = $_GPC['is_year'];
    $key_words = $_GPC['key_words'];
    $money = $_GPC['money'];
    $uniacid = $_W['uniacid'];

    // 用户年卡
    $user_year = pdo_fetch("select * from ".tablename("hyb_yl_user_yearcard")." where openid='".$openid."' and uniacid=".$uniacid." and zid=".$zid." and status=1 and end_time >='".time()."'");
    // 专家年卡
    $zhuanjia_year = pdo_fetch("select * from ".tablename("hyb_yl_yearcard")." where uniacid=".$uniacid." and zid=".$zid." and typs=1");
    // 用户会员卡
    $hid = pdo_getcolumn("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$zid),'hid');
    $type = pdo_getcolumn("hyb_yl_docser_speck",array("key_words"=>$key_words,"uniacid"=>$uniacid),'id');
    $user_card = pdo_fetch("select u.*,c.usagetype,c.deductible_amount from ".tablename("hyb_yl_user_coupon")." as u left join ".tablename("hyb_yl_coupon")." as c on c.id=u.coupon_id where u.uniacid=".$uniacid." and u.applicableservices regexp '{$type}' and u.deductible_amount<=".$money." and u.status=0 and c.hid=".$hid." order by u.id desc");

    if($is_year == 'true')   //  是否使用年卡
    {
        
      if($zhuanjia_year && $user_year)   // 专家级用户是否都开通年卡
      {
        if($key_words == 'tuwenwenzhen' && $user_year['wz_num'] > 0)   // 图文问诊免费次数是否已用完
        {
          $data = array(
            'money' => '0.00',
            'yid' => $user_year['id'],
            "year_dk" => $money,
            "coupon_id" => '',
            "coupon_dk" => '0.00',
          );
        // }
        // else if(($key_words == 'dianhuajizhen' || $key_words == 'shipinwenzhen') && $user_year['hh_num'] > '0')   //  电话问诊及视频问诊免费次数是否用完
        // {
        //   //$money = '0.00';
        //   $data = array(
        //     'money' => '0.00',
        //     'yid' => $user_year['id'],
        //     "year_dk" => $money,
        //     "coupon_id" => '',
        //     "coupon_dk" => '0.00',
        //   );
        }else if($key_words == 'tijianjiedu' && $user_year['jd_num'] > 0){     //报告解读免费次数未用完
          //$money = '0.00';
          $data = array(
            'money' => '0.00',
            'yid' => $user_year['id'],
            "year_dk" => $money,
            "coupon_id" => '',
            "coupon_dk" => '0.00',
          );
        }
        else if($key_words == 'tuwenwenzhen' && $user_year['wz_num'] == '0' && $user_year['wz_zhekou'] != '0'){    //问诊免费次数用完，使用折扣
          if($user_card)   //用户是否有可用优惠全
          {
            //$money = $money * $user_year['wz_zhekou'] / 100 - $user_card['deductible_amount'];
            $data = array(
              'money' => $money * $user_year['wz_zhekou'] / 100 - $user_card['deductible_amount'],
              'yid' => $user_year['id'],
              "year_dk" => $money - $money * $user_year['wz_zhekou'] / 100,
              "coupon_id" => $user_card['id'],
              "coupon_dk" => $user_card['deductible_amount'],
              );
          }
          else{
            //$money = $money * $user_year['zx_zhekou'] / 100;
            $data = array(
                'money' => $money * $user_year['zx_zhekou'] / 100,
                'yid' => $user_year['id'],
                "year_dk" => $money - $money * $user_year['wz_zhekou'] / 100,
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
          }
        }
        else if($key_words == 'tijianjiedu' && $user_year['jd_num'] == '0')   //报告解读免费次数已用完
        {
          if($user_card)//用户是否有可用优惠全
          {
            //$money = $money - $user_card['deductible_amount'];
            $data = array(
            'money' => $money - $user_card['deductible_amount'],
            'yid' => '',
            "year_dk" => '0.00',
            "coupon_id" => $user_card['id'],
            "coupon_dk" => $user_card['deductible_amount'],
          );
          }else{
            // $money = $money;
            $data = array(
            'money' => $money,
            'yid' => '',
            "year_dk" => '0.00',
            "coupon_id" => '',
            "coupon_dk" => '0.00',
          );
          }
        }else{
            if($user_card)//用户是否有可用优惠全
              {
                //$money = $money - $user_card['deductible_amount'];
                $data = array(
                'money' => $money - $user_card['deductible_amount'],
                'yid' => '',
                "year_dk" => '0.00',
                "coupon_id" => $user_card['id'],
                "coupon_dk" => $user_card['deductible_amount'],
              );
            }else{
                //$money = $money;
                $data = array(
                'money' => $money,
                'yid' => '',
                "year_dk" => '0.00',
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
            }
        }
      }else if($zhuanjia_year && !$user_year)    //专家开启年卡，用户没开启
      {

        $count_user = pdo_getcolumn("select count(*) from ".tablename("hyb_yl_user_yearcard")." where uniacid=".$uniacid." and zid=".$zid." and status=1 and end_time>=".time());
        $user_year = pdo_fetch("select * from ".tablename("hyb_yl_user_yearcard")." where openid=".$openid." and uniacid=".$uniacid." and zid=".$zid." and status=1 and endtime >=".time());
        $isbl = pdo_get("hyb_yl_user_yearcard",array("openid"=>$openid,"uniacid"=>$uniacid,"zid"=>$zid));
        
        if(intval($zhuanjia_year['num']) > intval($count_user) && !$isbl)      //  判断专家年卡库存是否为0
        {
            $datas = array(
              'uniacid' => $uniacid,
              "zid" => $zid,
              "yid" =>$zhuanjia_year['id'],
              "openid" => $openid,
              "money" => $zhuanjia_year['new_price'],
              "status" => '0',
              "wz_num" => $zhuanjia_year['wz_num'],
              "wz_zhekou" => $zhuanjia_year['wz_zhekou'],
              "jd_num" => $zhuanjia_year['jd_num'],
              "hh_num" => $zhuanjia_year['hh_num'],
              "created" => time(),
              "end_time" => strtotime("+{$zhuanjia_year['times']} year"),
            );
            pdo_insert("hyb_yl_user_yearcard",$datas);
            $yid = pdo_insertid();
            if($key_words == 'tuwenwenzhen' && $user_year['wz_num'] > 0)   // 图文问诊免费次数不为0
            {
              //$money = $zhuanjia_year['new_price'];
                $data = array(
                'money' => $zhuanjia_year['new_price'],
                'yid' => $yid,
                "year_dk" => $money,
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
            // }else if(($key_words == 'dianhuajizhen' || $key_words == 'shipinwenzhen') && $zhuanjia_year['hh_num'] > '0')   //  电话问诊及视频问诊免费次数不为零
            // {
            //   //$money = $zhuanjia_year['new_price'];
            //   $data = array(
            //     'money' => $zhuanjia_year['new_price'],
            //     'yid' => $yid,
            //     "year_dk" => $money,
            //     "coupon_id" => '',
            //     "coupon_dk" => '0.00',
            //   );
            }else if($key_words == 'tuwenwenzhen' && $zhuanjia_year['wz_num'] == '0' && $zhuanjia_year['wz_zhekou'] != '0'){    //问诊免费次数为零，使用折扣
              if($user_card)   //用户是否有可用优惠全
              {
                $data = array(
                'money' => $money * $zhuanjia_year['wz_zhekou'] / 100 - $user_card['deductible_amount'] + $zhuanjia_year['new_price'],
                'yid' => $yid,
                "year_dk" => $money - $money * $zhuanjia_year['wz_zhekou'] / 100,
                "coupon_id" => $user_card['id'],
                "coupon_dk" => $user_card['deductible_amount'],
              );
               // $money = $money * $user_year['wz_zhekou'] / 100 - $user_card['deductible_amount'] + $zhuanjia_year['new_price'];
              }else{
                //$money = $money * $user_year['zx_zhekou'] / 100 + $zhuanjia_year['new_price'];
                $data = array(
                'money' => $money * $user_year['wz_zhekou'] / 100 + $zhuanjia_year['new_price'],
                'yid' => $yid,
                "year_dk" => $money - $money * $zhuanjia_year['zx_zhekou'] / 100,
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
              }
            }else if($key_words == 'tijianjiedu' && $zhuanjia_year['jd_num'] > 0){     //报告解读免费次数不为0
              //$money = $zhuanjia_year['new_price'];
              $data = array(
                'money' => $zhuanjia_year['new_price'],
                'yid' => $yid,
                "year_dk" => $money,
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
            }else if($key_words == 'tijianjiedu' && $zhuanjia_year['jd_num'] == '0')   //报告解读免费次数为0
            {
              if($user_card)//用户是否有可用优惠全
              {
                //$money = $money - $user_card['deductible_amount'] + $zhuanjia_year['new_price'];
                $data = array(
                'money' => $money - $user_card['deductible_amount'] + $zhuanjia_year['new_price'],
                'yid' => $yid,
                "year_dk" => $money,
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
              }else{
                //$money = $zhuanjia_year['new_price'];
                $data = array(
                'money' => $zhuanjia_year['new_price'],
                'yid' => $yid,
                "year_dk" => $money,
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
              }
            }else{
                if($user_card)//用户是否有可用优惠全
                  {
                    //$money = $money - $user_card['deductible_amount'];
                    $data = array(
                    'money' => $money - $user_card['deductible_amount'],
                    'yid' => '',
                    "year_dk" => '0.00',
                    "coupon_id" => $user_card['id'],
                    "coupon_dk" => $user_card['deductible_amount'],
                  );
                }else{
                    //$money = $money;
                    $data = array(
                    'money' => $money,
                    'yid' => '',
                    "year_dk" => '0.00',
                    "coupon_id" => '',
                    "coupon_dk" => '0.00',
                  );
                }
            }
        }else if(intval($zhuanjia_year['num']) > intval($count_user) && $isbl){
            $datas = array(
              'uniacid' => $uniacid,
              "zid" => $zid,
              "yid" =>$zhuanjia_year['id'],
              "openid" => $openid,
              "money" => $zhuanjia_year['new_price'],
              "status" => '0',
              "wz_num" => $zhuanjia_year['wz_num'],
              "wz_zhekou" => $zhuanjia_year['wz_zhekou'],
              "jd_num" => $zhuanjia_year['jd_num'],
              "hh_num" => $zhuanjia_year['hh_num'],
              "end_time" => strtotime("+{$zhuanjia_year['times']} year"),
            );
            pdo_update("hyb_yl_user_yearcard",$datas,array("id"=>$isbl['id']));
            $yid = $isbl['id'];
            
            if($key_words == 'tuwenwenzhen' && $isbl['wz_num'] > 0)   // 图文问诊免费次数不为0
            {
              //$money = $zhuanjia_year['new_price'];
                $data = array(
                'money' => $zhuanjia_year['new_price'],
                'yid' => $yid,
                "year_dk" => $money,
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
            }
            // else if(($key_words == 'dianhuajizhen' || $key_words == 'shipinwenzhen') && $zhuanjia_year['hh_num'] > '0')   //  电话问诊及视频问诊免费次数不为零
            // {
            //   //$money = $zhuanjia_year['new_price'];
            //   $data = array(
            //     'money' => $zhuanjia_year['new_price'],
            //     'yid' => $yid,
            //     "year_dk" => $money,
            //     "coupon_id" => '',
            //     "coupon_dk" => '0.00',
            //   );
            // }
            else if($key_words == 'tuwenwenzhen' && $zhuanjia_year['wz_num'] == '0' && $zhuanjia_year['wz_zhekou'] != '0'){    //问诊免费次数为零，使用折扣
              if($user_card)   //用户是否有可用优惠全
              {
                $data = array(
                'money' => $money * $zhuanjia_year['wz_zhekou'] / 100 - $user_card['deductible_amount'] + $zhuanjia_year['new_price'],
                'yid' => $yid,
                "year_dk" => $money - $money * $zhuanjia_year['wz_zhekou'] / 100,
                "coupon_id" => $user_card['id'],
                "coupon_dk" => $user_card['deductible_amount'],
              );
               // $money = $money * $user_year['wz_zhekou'] / 100 - $user_card['deductible_amount'] + $zhuanjia_year['new_price'];
              }else{
                //$money = $money * $user_year['zx_zhekou'] / 100 + $zhuanjia_year['new_price'];
                $data = array(
                'money' => $money * $isbl['wz_zhekou'] / 100 + $zhuanjia_year['new_price'],
                'yid' => $yid,
                "year_dk" => $money - $money * $zhuanjia_year['zx_zhekou'] / 100,
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
              }
            }else if($key_words == 'tijianjiedu' && $zhuanjia_year['jd_num'] > 0){     //报告解读免费次数不为0
              //$money = $zhuanjia_year['new_price'];
              $data = array(
                'money' => $zhuanjia_year['new_price'],
                'yid' => $yid,
                "year_dk" => $money,
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
            }else if($key_words == 'tijianjiedu' && $zhuanjia_year['jd_num'] == '0')   //报告解读免费次数为0
            {
              if($user_card)//用户是否有可用优惠全
              {
                //$money = $money - $user_card['deductible_amount'] + $zhuanjia_year['new_price'];
                $data = array(
                'money' => $money - $user_card['deductible_amount'] + $zhuanjia_year['new_price'],
                'yid' => $yid,
                "year_dk" => $money,
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
              }else{
                //$money = $zhuanjia_year['new_price'];
                $data = array(
                'money' => $zhuanjia_year['new_price'],
                'yid' => $yid,
                "year_dk" => $money,
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
              }
            }else{
                if($user_card)//用户是否有可用优惠全
                  {
                    //$money = $money - $user_card['deductible_amount'];
                    $data = array(
                    'money' => $money - $user_card['deductible_amount'],
                    'yid' => '',
                    "year_dk" => '0.00',
                    "coupon_id" => $user_card['id'],
                    "coupon_dk" => $user_card['deductible_amount'],
                  );
                }else{
                    //$money = $money;
                    $data = array(
                    'money' => $money,
                    'yid' => '',
                    "year_dk" => '0.00',
                    "coupon_id" => '',
                    "coupon_dk" => '0.00',
                  );
                }
            }
        }else{
            if($user_card)//用户是否有可用优惠全
              {
                //$money = $money - $user_card['deductible_amount'];
                $data = array(
                'money' => $money - $user_card['deductible_amount'],
                'yid' => '',
                "year_dk" => '0.00',
                "coupon_id" => $user_card['id'],
                "coupon_dk" => $user_card['deductible_amount'],
              );
            }else{
                //$money = $money;
                $data = array(
                'money' => $money,
                'yid' => '',
                "year_dk" => '0.00',
                "coupon_id" => '',
                "coupon_dk" => '0.00',
              );
            }
        }

      }
      else if(!$zhuanjia_year && !$user_year)    // 专家和用户都没开启年卡
      {
        if($user_card)//用户是否有可用优惠全
          {
            //$money = $money - $user_card['deductible_amount'];
            $data = array(
            'money' => $money - $user_card['deductible_amount'],
            'yid' => '',
            "year_dk" => '0.00',
            "coupon_id" => $user_card['id'],
            "coupon_dk" => $user_card['deductible_amount'],
          );
        }else{
            //$money = $money;
            $data = array(
            'money' => $money,
            'yid' => '',
            "year_dk" => '0.00',
            "coupon_id" => '',
            "coupon_dk" => '0.00',
          );
        }
      }
    }
    else   //  未开启年卡开关
    {

        if($user_card)//用户是否有可用优惠全
        {
          //$money = $money - $user_card['deductible_amount'];
          $data = array(
            'money' => $money - $user_card['deductible_amount'],
            'yid' => '',
            "year_dk" => '0.00',
            "coupon_id" => $user_card['id'],
            "coupon_dk" => $user_card['deductible_amount'],
          );
        }else{
          //$money = $money;
          $data = array(
            'money' => $money,
            'yid' => '',
            "year_dk" => '0.00',
            "coupon_id" => '',
            "coupon_dk" => '0.00',
          );
        }
    }
    echo json_encode($data);

  }
  public function user_collect()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC["openid"];
        $page = $_GPC['page'];
        $typs = $_GPC['typs'];
  
        $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
        if($typs == 'siren_doc')
        {
            $list = pdo_fetchall("select a.*,z.advertisement,z.z_name,z.hid,z.z_room,z.parentid,z.score,z.z_zhicheng,z.authority,z.xytime,z.xn_cf,z.xn_reoly from ".tablename("hyb_yl_attention")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.goods_id where a.uniacid=".$uniacid." and a.openid='".$openid."' and a.cerated_type=7 order by id desc limit ".$page * $pagesize.",".$pagesize);
        }else if($typs == 'gz_doc')
        {
            $list = pdo_fetchall("select a.*,z.advertisement,z.z_name,z.hid,z.z_room,z.parentid,z.score,z.z_zhicheng,z.authority,z.xytime,z.xn_cf,z.xn_reoly from ".tablename("hyb_yl_attention")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.goods_id where a.uniacid=".$uniacid." and a.openid='".$openid."' and a.cerated_type=0 order by id desc limit ".$page * $pagesize.",".$pagesize);
        }else if($typs == 'gz_team')
        {
            $list = pdo_fetchall("select a.*,t.id as t_id,t.title,t.type,t.keshi_two,t.keshi_one,t.label,t.thumb,t.xn_answer,t.xn_chufang,t.times,t.jigou_one,t.jigou_two,t.zid from ".tablename("hyb_yl_attention")." as a left join ".tablename("hyb_yl_team")." as t on t.id=a.goods_id where a.uniacid=".$uniacid." and a.openid='".$openid."' and a.cerated_type=6 order by id desc limit ".$page * $pagesize.",".$pagesize);
        }

        if($typs == 'siren_doc' || $typs == 'gz_doc')
        {
            foreach($list as &$value)
            {
                $value['advertisement'] = tomedia($value['advertisement']);
                $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
                $value['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
                $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),"job_name");
                $value['server'] = pdo_getall("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"zid"=>$value['goods_id']));
            }
        }else{
            foreach($list as &$values)
            {
                $values['advertisement'] = tomedia($values['thumb']);
                $values['z_name'] = $values['title'];
                $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$values['zid']));
                $values['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$zhuanjia['z_zhicheng']),"job_name");
                $values['label'] = json_decode($values['label'],true);
                foreach($values['label'] as &$val)
                {
                    $values['authority'] .= $val.",";
                }
                $values['score'] = 5;
                $values['xn_reoly'] = $values['xn_answer'];
                $values['xn_cf'] = $values['xn_chufang'];
                $values['xytime'] = $values['times'];
                $values['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$values['keshi_two']),'name');
                $values['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("id"=>$values['jigou_two']),'agentname');
                $values['fuze'] = $zhuanjia['z_name'];
                $values['server'] = pdo_getall("hyb_yl_team_serverlist",array("uniacid"=>$uniacid,"tid"=>$values['goods_id']));
            }
        }
        
    
        echo json_encode($list);
    }

  // 挂号订单下单
  public function add_ghorder()
  {
     global $_GPC, $_W;
     $uniacid = $_W['uniacid'];
     $arr = $this->getarr($_GPC['describe']);
     $month_time = explode("-", $_GPC['month_time']);
     $startime = $month_time[0];
     $endtime = $month_time[1];
     $orders =$this->getordernum();
     $zid = $_GPC['zid'];
     $openid = $_GPC['openid'];
     //查询未支付订单时间
     $order_time = pdo_get("hyb_yl_gh_rule",array('uniacid'=>$uniacid));
     $chaoshi = $order_time['times'];
     $money = $_GPC['money'];
     if($money =='0.00'){
        $ifpay = 1;
        $paytime = time();
     }else{
        $ifpay = 0;
        $paytime = 0;
     }
     $time_b = intval($chaoshi * 3600);
     $newtime  = date("Y-m-d H:i:s");
     $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b);
     $data =array(
       'uniacid' => $uniacid,
       'openid'  => $_GPC['openid'],
       'zid'     => $_GPC['zid'],
       'orders'  => $orders,
       'time'    => strtotime('now'),
       'month_time'=> $_GPC['month_time'],
       'year'      => $_GPC['year'],
       'startime'  => $startime,
       'endtime'   => $endtime,
       'tell'      => $_GPC['tell'],
       'describe'  => serialize($arr),
       'week'      => $_GPC['week'],
       'money'     => $_GPC['money'],
       'back_orser'=> $orders,
       'j_id'      => $_GPC['j_id'],
       'userId2'   => $_GPC['userId2'],
       'userSig2'  => $_GPC['userSig2'],
       'roomID'    => $_GPC['roomID'],
       'sdkAppID'  => $_GPC['sdkAppID'],
       'userID'    => $_GPC['userId2'],
       'userSig'   => $_GPC['userSig2'],
       'addnum'    => $_GPC['addnum'],
       'overtime'  => strtotime($overtime),
       'privateNum'=> $_GPC['privateNum'],
       'old_money' => $_GPC['old_money'],
       'coupon_id' => $_GPC['coupon_id'],
       "coupon_dk" => $_GPC['coupon_dk'],
       'ifpay'     => $ifpay,
       'paytime'   => $paytime
      );

     $res = pdo_insert('hyb_yl_guahaoorder',$data);
     $id  = pdo_insertid();
     $info = pdo_get("hyb_yl_guahaoorder",array('id'=>$id));
     echo json_encode($info);
  }

  public function getarr($data){
      $value =htmlspecialchars_decode($data);
      $array =json_decode($value);
      $object =json_decode(json_encode($array),true);
      return $object;
    
  }
  // 获取专家资金中心
  public function money_center()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $zid = $_GPC['zid'];
    $today = strtotime(date("Y-m-d"),time());
    if(!$zid)
    {
        $zid = pdo_getcolumn("hyb_yl_zhuanjia",array("openid"=>$openid),"zid");
    }
    $tw_money = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid=".$zid." and ifpay != 0 and ifpay != 6 and ifpay != 7 group by back_orser");
    $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tw_money));
    if(!$tw_money)
    {
        $tw_money = '0.00';
    }
    $year_money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_user_yearcard")." where uniacid=".$uniacid." and zid=".$zid." and status=1");
    if(!$year_money)
    {
        $year_money = '0.00';
    }
    $gh_money = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid=".$zid." and ifpay != 0 and ifpay != 6 and ifpay != 7 group by back_orser");
    $gh_money = array_sum(array_map(function($val){return $val['money'];}, $gh_money));
    if(!$gh_money)
    {
        $gh_money = '0.00';
    }
    $jiedu_money = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid=".$zid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and keywords='tijianjiedu' group by back_orser");
    $jiedu_money = array_sum(array_map(function($val){return $val['money'];}, $jiedu_money));
    if(!$jiedu_money)
    {
        $jiedu_money = '0.00';
    }
    $shoushu_money = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid=".$zid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and keywords='shoushukuaiyue' group by back_orser");
    $shoushu_money = array_sum(array_map(function($val){return $val['money'];}, $shoushu_money));
    if(!$shoushu_money)
    {
        $shoushu_money = '0.00';
    }
    $wz_money = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid=".$zid." and ifpay != 0 and ifpay != 6 and ifpay != 7 group by back_orser");
    
    $wz_money = array_sum(array_map(function($val){return $val['money'];}, $wz_money));
    if(!$wz_money)
    {
        $wz_money = '0.00';
    }
    $tw_money = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and zid=".$zid." group by back_orser");
    $tw_money = array_sum(array_map(function($val){return $val['money'];}, $tw_money));
    if(!$tw_money)
    {
        $tw_money = '0.00';
    }
    $wz_money = $wz_money + $tw_money;
    $chufang_money = pdo_fetchall("select money from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and zid=".$res['zid']." group by back_orser");
     $chufang_money = array_sum(array_map(function($val){return $val['money'];}, $chufang_money));
     
    // $chufang_money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and zid=".$zid." and ifpay != 0 and ifpay != 6 and ifpay != 7");
    if(!$chufang_money)
    {
        $chufang_money = '0.00';
    }


    $count = sprintf("%.2f",$tw_money + $year_money + $gh_money + $wz_money + $chufang_money);

    // $wz_money = sprintf("%.2f",$tw_money + $gh_money + $jiedu_money + $shoushu_money + $chufang_money);
    $today_tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid=".$zid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and xdtime>=".$today." group by back_orser");
    $today_tuwen = array_sum(array_map(function($val){return $val['money'];}, $today_tuwen));
    if(!$today_tuwen)
    {
        $today_tuwen = '0.00';
    }

    $today_year = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_user_yearcard")." where uniacid=".$uniacid." and zid=".$zid." and status=1 and created>=".$today);
    if(!$today_year)
    {
        $today_year = '0.00';
    }
    $today_guahao = pdo_fetchall("select  money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid=".$zid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and paytime>=".$today." group by back_orser");
    $today_guahao = array_sum(array_map(function($val){return $val['money'];}, $today_guahao));
    if(!$today_guahao)
    {
        $today_guahao = '0.00';
    }
    $today_jiedu = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid=".$zid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and keywords='tijianjiedu' and paytime >=".$today." group by back_orser");
    $today_jiedu = array_sum(array_map(function($val){return $val['money'];}, $today_jiedu));
    if(!$today_jiedu)
    {
        $today_jiedu = '0.00';
    }
    $today_shoushu = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid=".$zid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and keywords='shoushukuaiyue' and paytime >=".$today." group by back_orser");
    $today_shoushu = array_sum(array_map(function($val){return $val['money'];}, $today_shoushu));
    if(!$today_shoushu)
    {
        $today_shoushu = '0.00';
    }
    $wz_moneys = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and zid=".$zid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and paytime >=".$today."group by back_orser");
    $wz_moneys = array_sum(array_map(function($val){return $val['money'];}, $wz_moneys));
    if(!$wz_moneys)
    {
        $wz_moneys = '0.00';
    }
    $today_chufang = pdo_fetchall("select money from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and is_pay=1 and zid=".$res['zid']." and paytime >=".$today." group by back_orser");
     $today_chufang = array_sum(array_map(function($val){return $val['money'];}, $today_chufang));
    // $today_chufang = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and zid=".$zid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and paytime >=".time());
    if(!$today_chufang)
    {
        $today_chufang = '0.00';
    }
    $today_money = sprintf("%.2f",$today_tuwen + $today_year + $today_guahao + $wz_moneys + $today_chufang);
    $today_pay = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_doc_all_serverlist")." where uniacid=".$uniacid." and time >='".date("Y-m-d",time())."' and zid=".$zid);
    
    if(!$today_pay)
    {
        $today_pay = '0.00';
    }
    $info = pdo_get("hyb_yl_zhuanjia",array("zid"=>$zid));
    $data = array(
        "count" => $count,
        "wz_money" => $wz_money,
        'tw_money' => $tw_money,
        "year_money" => $year_money,
        "gh_money" => $gh_money,
        "jiedu_money" => $jiedu_money,
        "shoushu_money" => $shoushu_money,
        "chufang_money" => $chufang_money,
        "today_tuwen" => $today_tuwen,
        'today_year' => $today_year,
        "today_guahao" => $today_guahao,
        "today_jiedu" => $today_jiedu,
        "today_shoushu" => $today_shoushu,
        "today_chufang" => $today_chufang,
        "today_money" => $today_money,
        "today_pay" => $today_pay,
        "qianyue" => '0.00',
        "info" => $info,
    );
    
    echo json_encode($data);

  }

  // 专家设置工作状态
  public function stateset()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $status = $_GPC['status'];
    $zid = $_GPC['zid'];
    $openid = $_GPC['openid'];
    $res = pdo_update("hyb_yl_zhuanjia",array("gzstype"=>$status),array("zid"=>$zid));
    echo json_encode($res);

  }
  // 医生年卡
  public function yearcard()
  {
    global $_W,$_GPC;
    $zid = $_GPC['zid'];
    $openid = $_GPC['openid'];
    if(!$zid)
    {
        $zid = pdo_getcolumn("hyb_yl_zhuanjia",array("openid"=>$openid),'zid');
    }
    $res = pdo_get("hyb_yl_yearcard",array("zid"=>$zid,"typs"=>'1'));
    echo json_encode($res);
  }

  // 用户挂号订单列表
  public function gh_order()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $page = $_GPC['page'];
    $pagesize = $_GPC['pagesize'];
    $status = $_GPC['status'];
    
    $where = " where g.uniacid=".$uniacid." and g.openid='{$openid}'";
    if($status =='0'){
      $where .= " and g.ifpay=0 and  g.ifgb=0";
    }
    if($status =='1'){
      $where .= " and g.ifpay=1  and g.ifgb=0";
    }
    if($status =='2'){
      $where .= " and g.ifpay=2 ";
    }
    if($status =='3'){
      $where .= " and g.ifpay=3 ";
    }
    if($status == '4'){
        $where .= " and (g.ifpay=8 or g.ifgb=1 or g.ifpay=5 ) ";
    }
  
    $list = pdo_fetchall("select g.*,z.z_name,z.advertisement,z.z_zhicheng,z.hid,z.parentid from ".tablename("hyb_yl_guahaoorder")." as g left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=g.zid ".$where." group by back_orser order by g.id desc limit ".$page * $pagesize .",".$pagesize);

    foreach($list as &$value)
    {
        $value['advertisement'] = tomedia($value['advertisement']);
        $value['describe'] = unserialize($value['describe']);
        $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
        $value['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
        $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['hid']),'name');
        $value['time'] = date("Y-m-d",$value['time']);
        if($value['ifpay'] == '0')
        {
            $value['status'] = '待支付';
        }else if($value['ifpay'] == '1')
        {
            $value['status'] = '待接诊';
        }else if($value['ifpay'] == '2')
        {
            $value['status'] = '接诊中';
        }else if($value['ifpay'] == '3')
        {
            $value['status'] = '待评价';
        }else if($value['ifpay'] == '4')
        {
            $value['status'] = '已完成';
        }else if($value['ifpay'] == '5')
        {
            $value['status'] = '申请退款';
        }else if($value['ifpay'] == '6')
        {
            $value['status'] = '退款成功';
        }else if($value['ifpay'] == '7')
        {
            $value['status'] = '订单关闭';
        }else if($value['ifpay'] == '8')
        {
            $value['status'] = '已取消';
        }
    }
    echo json_encode($list);
  }
  // 挂号订单详情
  public function gh_detail()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $res = pdo_fetch("select g.*,z.z_name,z.advertisement,z.z_zhicheng,z.hid,z.parentid from ".tablename("hyb_yl_guahaoorder")." as g left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=g.zid where g.id=".$id);
    $res['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$res['z_zhicheng']),'job_name');
    $res['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$res['hid']),'agentname');
    $res['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$res['hid']),'name');
    $res['time'] = date("Y-m-d",$res['time']);
    $res['describe'] = unserialize($res['describe']);
    
    $res['advertisement'] = tomedia($res['advertisement']);
    echo json_encode($res);
  }
  // 挂号取消
  public function gh_quxiao()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $res = pdo_update("hyb_yl_guahaoorder",array("ifpay"=>'8'),array("id"=>$id));
    echo json_encode($res);
  }
  // 挂号删除
  public function gh_del()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $res = pdo_delete("hyb_yl_guahaoorder",array("id"=>$id));
    echo json_encode($res);
  }
  // 申请退款
  public function gh_refund()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $res = pdo_update("hyb_yl_guahaoorder",array("ifpay"=>'5'),array("id"=>$id));
    echo json_encode($res);
  }
    // 挂号订单取消
  public function gh_refundqx()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $get_one = pdo_get('hyb_yl_guahaoorder',array('id'=>$id));
    $j_id = $get_one['j_id'];
    $zid = $get_one['zid'];

    $docinfo = pdo_get('hyb_yl_zhuanjia',array('zid'=>$zid));
    $z_name = $docinfo['z_name'];
    $z_room = $docinfo['z_room'];

    $ksname = pdo_getcolumn('hyb_yl_ceshi',array('id'=>$z_room),'name');

    $userinfo = pdo_get('hyb_yl_userjiaren',array('j_id'=>$j_id));
    $openid = $userinfo['openid'];
    $user_name = $userinfo['names'];
    $user_sex = $userinfo['sex'];
    $res = pdo_update("hyb_yl_guahaoorder",array("ifpay"=>'8'),array("id"=>$id));
    //提醒模板消息
    $wxopenid = pdo_getcolumn('hyb_yl_userinfo',array('openid'=>$openid),'wxopenid');
    $randnum = pdo_getcolumn('hyb_yl_userinfo',array('openid'=>$openid),'randnum');
    $wxapp = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
    $appid = $wxapp['pub_appid'];  //填写你公众号的appid
    $secret = $wxapp['appkey'];   //填写你公众号的secret
    $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
    $gzhmb = unserialize($wxapp['gzhmb']);
    $mbxs = $gzhmb['qxghmoban'];
    $wxappaid = $wxapp['appid'];
    $getArr = array();
    $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
    $access_token = $tokenArr->access_token;
    $posturl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
    $template = array(
         "touser" => $wxopenid,
         "template_id" => $mbxs,
         "miniprogram"=>array(
               "appid"=>$wxappaid,
               "pagepath"=>'hyb_yl/tabBar/index/index'
          ), 
         'topcolor' => '#ccc',
         'data' =>array('first' => array('value' =>'您的预约挂号信息已取消成功',
                                            'color' =>"#743A3A",
         ),
             'keyword1' => array('value' =>$user_name,
                                 'color' =>'#FF0000',
             ),
             'keyword2' => array('value' =>$randnum,
                                 'color' =>'#FF0000',
             ),
             'keyword3' => array('value' =>$ksname,
                                 'color' =>'#FF0000',
             ),
             'keyword4' => array('value' => $z_name,
                                 'color' =>'#FF0000',
             ),
             'remark'   => array('value' =>'如果您对以上信息有任何疑问，请直接在平台上回复您的问题即可',
                                 'color' =>'#FF0000',
            ),
         )
     );
    $postjson = json_encode($template);
    $resder = $this->http_curl($posturl,'post','json',$postjson);
    echo json_encode($resder);
  }
  // 查看所有评价
  public function allpingjia()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $key = $_GPC['key'];
    $page = $_GPC['page'];
    $pagesize = $_GPC['pagesize'];
    $where = " where p.uniacid=".$uniacid;
    $zid  = $_GPC['zid'];
    if($zid)
    {
        $where .= " and p.zid=".$zid;
    }
    if($key)
    {
        $where .= " and p.keywords='".$key."'";
    }
    $list = pdo_fetchall("select p.*,u.u_name,u.u_thumb from ".tablename("hyb_yl_pingjia")." as p left join ".tablename("hyb_yl_userinfo")." as  u on u.openid=p.openid ".$where." order by p.gz_id desc limit ".$page * $pagesize .",".$pagesize);
    
    foreach($list as &$value)
    {
        $value['created'] = date("Y-m-d H:i",$value['createTime']);
        $value['starsnum'] = (int)$value['starsnum'];
    }
    echo json_encode($list);
  }

//服务详情
   public function server_detail()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $ids = $_GPC['ids'];
    $res = pdo_fetch("SELECT * from".tablename('hyb_yl_doc_all_serverlist')."WHERE uniacid='{$uniacid}' and ids='{$ids}'");
    echo json_encode($res);
  }
  public function update_detail()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $ids = $_GPC['ids'];
    $data =array(
       'ptmoney' => $_GPC['ptmoney'],
       'ptzhuiw' => $_GPC['ptzhuiw'],
       'hymoney' => $_GPC['hymoney'],
       'hyzhuiw' => $_GPC['hyzhuiw'],
        );
    $res = pdo_update("hyb_yl_doc_all_serverlist",$data,array('ids'=>$ids));
    echo json_encode($res);
  }
  public function update_switch()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $ids = $_GPC['ids'];
    $stateback = $_GPC['stateback'];
    $item = pdo_get("hyb_yl_doc_all_serverlist",array("ids"=>$ids,"uniacid"=>$uniacid));
    $time_b = intval($item['time_leng'] * 60);
    $newtime  = date("Y-m-d H:i:s");
    $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b); 

    if(($item['overtime'] > time() && $stateback == '1') || $stateback == '0')
    {
        $data = array(
          'stateback'=>$stateback,
        );
    }else if($item['overtime'] < time() && $stateback == '1')
    {
        $overtime = strtotime($overtime);
        $data = array(
            'stateback' => $stateback,
            'time' => date("Y-m-d H:i:s",time()),
            'overtime' => $overtime,
        );
        $hospital = pdo_fetch("select a.* from ".tablename("hyb_yl_hospital")." as a left join ".tablename("hyb_yl_zhuanjia")." as b on b.hid=a.hid where a.uniacid=".$uniacid." and b.zid=".$item['zid']);
        $money = $item['money'];
        $moneys = $money * $hospital['system_royalty'] / 100;
        $money1 = $hospital['money'] + $moneys;
        pdo_update("hyb_yl_hospital",array("money"=>$money1),array("hid"=>$hospital['hid']));
    }else{
        $data = array(
          'stateback' => $stateback,
        );
    }
    $res = pdo_update("hyb_yl_doc_all_serverlist",$data,array('ids'=>$ids));
    echo json_encode($res);
  }

  // 服务订单下单
    public function server_pay()
    {
      global $_W,$_GPC;
      $ids = $_GPC['ids'];
      $uniacid = $_W['uniacid'];
      $orders = $this->getordernum();
      pdo_update("hyb_yl_doc_all_serverlist",array("orders"=>$orders),array("ids"=>$ids));
      cache_write('uniacid',$_W['uniacid']);
      require_once dirname(dirname(dirname(__FILE__)))."/wxpay.php";
      $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
      $appid = $res['appid'];
      $openid = $_GPC['openid'];
      $mch_id = $res['mch_id'];
      $key = $res['pub_api'];
      $out_trade_no = $orders;
      $total_fee = $_GPC['money'];
      
        $noturl = 'http://'.$_SERVER['SERVER_NAME'].'/addons/hyb_yl/docfwnoturl.php';
      
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

  // 获取导诊列表
  public function daozhenlist()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $server_key = $_GPC['key'];
    $keyword = $_GPC['keyword'];
    $zhicheng = $_GPC['zhicheng'];
    $openid = $_GPC['openid'];
    $
    $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
    $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
    $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_doc_all_serverlist')."WHERE uniacid='{$uniacid}' and key_words='{$server_key}' and stateback=1");
    $row = array();
    if($openid != '')
    {
      $user = pdo_get("hyb_yl_userinfo",array("uniacid"=>$uniacid,"openid"=>$openid));
      if($user['adminuserdj'] != '0' && $user['adminguanbi'] > time())
      {
        $item['vip'] = true;
        $is_vip = true;
      }else{
        $item['vip'] = false;
        $is_vip = false;
      }
    }else{
        $is_vip = false;
    }
    foreach ($res as $key => $value) {
        $zid = $value['zid'];
        $wheres = '';
        if($hid != '')
        {
            $wheres .= " and hid=".$hid;
        }
        if($id != '' && $id != 'undefined')
        {
            $wheres .= " and parentid=".$id;
        }
        if($biaoqian != '' && $biaoqian != 'undefined')
        {
            $wheres .= " and authority regexp '{$biaoqian}'";
        }
        if($_GPC['dex']){

            if($_GPC['dex'] =='0'){
                $where ="where  uniacid ='{$uniacid}' ".$wheres." and zid='{$zid}' order by zid desc limit ".$page * $pagesize.",".$pagesize ; 
            }
            if($_GPC['dex'] =='1'){
               $where ="where uniacid ='{$uniacid}'".$wheres." and zid='{$zid}'  order by xn_reoly desc limit ".$page * $pagesize.",".$pagesize ; 
            }
            if($_GPC['dex'] =='2'){
               $where ="where uniacid ='{$uniacid}'".$wheres." and zid='{$zid}' order by score desc limit ".$page * $pagesize.",".$pagesize ; 
            }
            if($_GPC['dex'] =='3'){
               $where ="where uniacid ='{$uniacid}'".$wheres." and zid='{$zid}' order by xytime desc limit ".$page * $pagesize.",".$pagesize ; 
            }
            if($_GPC['dex'] =='4'){
               $where ="where uniacid ='{$uniacid}'".$wheres." and zid='{$zid}' order by score desc limit ".$page * $pagesize.",".$pagesize ; 
            }
        }else{

            $where ="where uniacid ='{$uniacid}'".$wheres." and zid='{$zid}' order by zid desc limit ".$page * $pagesize.",".$pagesize ; 
        }
        
        $rows =pdo_fetchall("SELECT * FROM " . tablename('hyb_yl_zhuanjia') . " {$where}");

        foreach ($rows as $k => $v) {
            $rows[$k]['yearcad'] = pdo_fetch("SELECT * from" . tablename('hyb_yl_yearcard') . "where zid='{$v['zid']}' and typs=1");
            $rows[$k]['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$rows[$k]['parentid']),'name');
            $rows[$k]['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$rows[$k]['hid']),'agentname','grade');
            $rows[$k]['advertisement'] = tomedia($rows[$k]['advertisement']);
            $rows[$k]['leve'] = pdo_getcolumn("hyb_yl_hospital_level",array("id"=>$rows[$key]['hid']['grade']),'level_name');
            $rows[$k]['serverss'] = pdo_getall("hyb_yl_doc_all_serverlist",array("zid"=>$v['zid'],"uniacid"=>$uniacid,"stateback"=>'1'));
            $rows[$k]['servers'] = pdo_fetch("select a.*,b.ser_url from ".tablename("hyb_yl_doc_all_serverlist")." as a left join ".tablename("hyb_yl_all_server_menulist")." as b on a.key_words=b.server_key where a.zid=".$v['zid']." and a.uniacid=".$uniacid." and a.key_words='".$server_key."' and a.stateback=1");
            
            $rows[$k]['job'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$v['z_zhicheng']),'job_name');
            if($is_vip)
            {
                $rows[$k]['money'] = $rows[$k]['servers']['hymoney'];
                $rows[$k]['num'] = $rows[$k]['servers']['hyzhuiw'];
            }else{
                $rows[$k]['money'] = $rows[$k]['servers']['ptmoney'];
                $rows[$k]['num'] = $rows[$k]['servers']['ptzhuiw'];
            }
            
        }
    }
    $row = array_merge($row,$rows);
    echo json_encode($row);

  }
    // 获取特色服务项目
  public function project()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $type = $_GPC['type'];
    $openid = $_GPC['openid'];
    if($openid != '')
    {
         $user = pdo_get("hyb_yl_userinfo",array("uniacid"=>$uniacid,"openid"=>$openid));
          if($user['adminuserdj'] != '0' && $user['adminguanbi'] > time())
          {
            $item['vip'] = true;
            $is_vip = true;
          }else{
            $item['vip'] = false;
            $is_vip = false;
          }
      }else{
        $is_vip = false;
      }
    $list = pdo_getall("hyb_yl_tstype",array("uniacid"=>$uniacid,"type"=>$type));
    foreach($list as &$value)
    {
        $value['thumb'] = tomedia($value['thumb']);
        if($is_vip)
        {
            $value['moneys'] = $value['vip_money'];
        }else{
            $value['moneys'] = $value['money'];
        }
        $value['state'] = false;
        $value['num'] = 1;
    }
    echo json_encode($list);
  }
  // 生成订单
  public function addproject()
  {
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $imgpath = $this->jsondata($_GPC['imgpath']);
    $types = $this->jsondata($_GPC['types']);
    $data = array(
        'uniacid' => $uniacid,
        "openid" => $_GPC['openid'],
        "name" => $_GPC['name'],
        "telphone" => $_GPC['telphone'],
        "idcard" => $_GPC['idcard'],
        "city" => $_GPC['city'],
        "hid" => $_GPC['hid'],
        "keshi" => $_GPC['keshi'],
        "date" => $_GPC['date'],
        "time" => $_GPC['time'],
        "imgpath" => serialize($imgpath),
        "files" => $_GPC['files'],
        "money" => $_GPC['money'],
        "types" => serialize($types),
        "type" => $_GPC['type'],
        "text" => $_GPC['text'],
        "created" => time(),
        'orders'    => $this->getordernum(),
        "back_orser" =>$this->getordernum(),
    );
    if($_GPC['money'] == '' || $_GPC['money'] == '0.00' || $_GPC['money'] == '0')
    {
        $data['ifpay'] = '1';
        $data['pay_time'] = time();
    }

    pdo_insert("hyb_yl_special",$data);
    $data['id'] = pdo_insertid();
    echo json_encode($data);
  }
  public function jsondata($data)
   {
        $value =htmlspecialchars_decode($data);
        $array =json_decode($value);
        $object =json_decode(json_encode($array),true);
        return $object;
    }
  public function pay()
  {
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
      
    $noturl = 'http://'.$_SERVER['SERVER_NAME'].'/addons/hyb_yl/spenoturl.php';
      
      
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
  // 获取近七天时间和星期
  public function seven()
  {
        global $_W,$_GPC;
        $curtime = time();
        for($i=0;$i<=6;$i++)
        {
            $curdate[$i]['date'] = date("m-d",$curtime+$i*24*60*60);
            $curdate[$i]['dates'] = date("Y-m-d",$curtime+$i*24*60*60);
        }

        foreach($curdate as $k=>$v){

           $curdate[$k]['week']=$this->get_weeks($v['dates']);
           $curdate[$k]['weeks']=$this->get_week($v['dates']);

        }
        echo json_encode($curdate);
  }
  function get_weeks($date){

       $date_str=date('Y-m-d',strtotime($date));
       $arr=explode("-", $date_str);
       $year=$arr[0];
       $month=sprintf('%02d',$arr[1]);
       $day=sprintf('%02d',$arr[2]);
       $hour = $minute = $second = 0;
       $strap = mktime($hour,$minute,$second,$month,$day,$year);
       $number_wk=date("w",$strap);
       $weekArr=array("周日","周一","周二","周三","周四","周五","周六");
       return $weekArr[$number_wk];

    }

    // 签约医生判断是否有个人信息
    public function userjiaren()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $list = pdo_get("hyb_yl_userjiaren",array("openid"=>$openid,"uniacid"=>$uniacid,"sick_index"=>'0'));
        if($list){
            echo json_encode($list);
        }else{
            echo "0";
        }
    }
     public function saveTx(){
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $rows = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . " where openid='{$openid}' and uniacid = '{$uniacid}' ", array(":uniacid" => $uniacid));
        $data['tx_type'] = $_GPC['tx_type'];
        $data['tx_cost'] = $_GPC['tx_cost'];
        $data['status'] = 1;
        $data['sj_cost'] = $_GPC['sj_cost'];
        $data['user_openid'] = $openid;
        $data['uniacid'] = $_W['uniacid'];
        $data['cerated_time'] = strtotime("now");
        $data['tx_admin'] = $_GPC['tx_admin'];
        $data['zjid'] = $_GPC['zjid'];
        $res = pdo_insert('hyb_yl_yltx', $data);
        $money = $_GPC['sy_money'];
        $update = pdo_update('hyb_yl_zhuanjia', array('overmoney' => $money), array('openid' => $openid, 'uniacid' => $uniacid));
        echo json_encode($update);
    }

    public function uptotalmoney(){
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $total_money = $_GPC['total_money'];
        $res = pdo_update('hyb_yl_zhuanjia',array('total_money'=>$total_money),array('zid'=>$zid,'uniacid'=>$uniacid));
        echo json_encode($res);
    }
    public function upauthorize(){
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $res = pdo_update('hyb_yl_attention',array('change'=>$_GPC['change']),array('id'=>$id));
        echo json_encode($res);
    }

    // 查看用户所有已结束问诊订单
    public function all_userorder()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
        $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];

        $rew = pdo_fetchall("SELECT a.*,b.openid,b.names,b.sex,b.age FROM" . tablename("hyb_yl_twenorder") . "as a left join" . tablename("hyb_yl_userjiaren") . "as b on b.j_id=a.j_id  where a.uniacid=".$uniacid." and a.openid='".$openid."' and a.grade=1 and a.role=0 and (a.ifpay=3 or a.ifpay=4) order by a.id desc");


        foreach ($rew as $key => $value) {
            $rew[$key]['content'] = unserialize($rew[$key]['content']);
            $rew[$key]['xdtime'] = date("Y-m-d H:i:s", $rew[$key]['xdtime']);
            $rew[$key]['keywords'] = 'tuwenwenzhen';
            $rew[$key]['overtime'] = date("Y-m-d H:i:s",$rew[$key]['overtime']);
        }
        
        $lists = pdo_fetchall("select a.*,u.openid,u.names,u.sex,u.age from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_userjiaren")." as u on u.j_id=a.j_id where a.uniacid=".$uniacid." and a.openid='".$openid."' and a.type='1' and a.role=0 and (a.ifpay=3 or a.ifpay=4) order by a.id desc");

        foreach($lists as &$value)
        {
            $value['content'] = unserialize($value['describe']);
            $value['xdtime'] = date("Y-m-d H:i:s", $value['time']);
            $value['overtime'] = date("Y-m-d H:i:s",$value['overtime']);
            $value['time'] = date("H:i:s", $value['time']);
            $value['keywords'] = $value['keywords'];
        }
        $list = array_merge($lists,$rew);

        $list = array_slice($list, $page * $pagesize,$pagesize);

        
        echo json_encode($list);
    }

    // 查询详细明细
      public function pay_list()
      {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $keyword = $_GPC['keyword'];
        $openid = $_GPC['openid'];
        $zid = pdo_getcolumn("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"openid"=>$openid),'zid');
        $page = empty($_GPC['page']) ? '0' : $_GPC['page'];
        $pagesize = empty($_GPC['pagesize']) ? '10' : $_GPC['pagesize'];
        if($keyword == 'tuwenwenzhen')
        {
            $list = pdo_fetchall("select a.*,b.u_thumb,c.names from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_userinfo")." as b on b.openid=a.openid left join ".tablename("hyb_yl_userjiaren")." as c on c.j_id=a.j_id where a.uniacid=".$uniacid." and a.zid=".$zid." and (a.ifpay=1 or a.ifpay=2 or a.ifpay=3 or a.ifpay=4) order by a.id desc limit ".$page*$pagesize.",".$pagesize);
            foreach($list as &$value)
            {
                $value['created'] = date("Y-m-d H:i:s",$value['xdtime']);
                $value['title'] = '图文问诊';
            }
        }
        else if($keyword == 'yuanchengkaifang')
        {
            $list = pdo_fetchall("select a.*,b.u_thumb,c.names from ".tablename("hyb_yl_chufang")." as a left join ".tablename("hyb_yl_userinfo")." as b on b.openid=a.openid left join ".tablename("hyb_yl_userjiaren")." as c on c.j_id=a.j_id where a.uniacid=".$uniacid." and a.zid=".$zid." and (a.ispay=1 or a.ispay=2 or a.ispay=3 or a.ispay=4) order by a.c_id desc limit ".$page*$pagesize.",".$pagesize);
            foreach($list as &$value)
            {
                $value['created'] = date("Y-m-d H:i:s",$value['time']);
                $value['title'] = '远程开方';
            }
        }
        else
        {
            $list = pdo_fetchall("select a.*,b.u_thumb,c.names from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_userinfo")." as b on b.openid=a.openid left join ".tablename("hyb_yl_userjiaren")." as c on c.j_id=a.j_id where a.uniacid=".$uniacid." and a.zid=".$zid." and (a.ifpay=1 or a.ifpay=2 or a.ifpay=3 or a.ifpay=4) and a.keywords='".$keyword."' group by back_orser order by a.id desc limit ".$page*$pagesize.",".$pagesize);
            
            foreach($list as &$value)
            {
                $value['created'] = date("Y-m-d H:i:s",$value['time']);
                if($value['keywords'] == 'shipinwenzhen')
                {
                    $value['title'] = '视频问诊';
                }else if($value['keywords'] == 'tijianjiedu')
                {
                    $value['title'] = '体检解读';
                }else if($value['keywords'] == 'shoushukuaiyue')
                {
                    $value['title'] = '手术快约';
                }else if($value['keywords'] == 'dianhuajizhen')
                {
                    $value['title'] = '电话问诊';
                }
            }
        }
        

        echo json_encode($list);
      }



    //生成医生推广二维码
          public function tuikedocerweima()
      {
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $openid = $_GPC['openid'];
        $tkid = $_GPC['tkid'];
        $res = pdo_get("hyb_yl_tuikedoc",array('zid'=>$zid,'openid'=>$openid));
        $dir = iconv("UTF-8", "GBK", "../attachment/hyb_yl");
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        $result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}' ", array(":uniacid" => $uniacid));
        $APPID = $result['appid'];
        $SECRET = $result['appsecret'];
        $erweima =$res['erweima'];
        if($erweima == '')
        {

          $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$result['appid']}&secret={$result['appsecret']}";

          $getArr = array();
          $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
          $access_token = $tokenArr->access_token;
          $data = array();
          $data['scene'] = "zid=".$zid."&tkid=".$tkid;
          $data['page'] = "hyb_yl/czhuanjiasubpages/pages/zhuanjiazhuye/zhuanjiazhuye";
          $data = json_encode($data);
          $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $access_token;
          $result = $this->api_notice_increment($url, $data);
          $image_name = "id_".$zid . ".jpg";
          $filepath = "../attachment/hyb_yl/{$image_name}";
          $file_put = file_put_contents($filepath, $result);

        if ($file_put) {
            $siteroot = $_W['siteroot'];
            $filepathsss = "attachment/hyb_yl/{$image_name}";
            $data =array(
                 'uniacid' =>$uniacid,
                 'zid'     =>$zid,
                 'openid'  =>$_GPC['openid'],
                 'addtime' =>date("Y-m-d H:i:s"),
                 "erweima" =>$filepathsss
                );
            pdo_insert('hyb_yl_tuikedoc',$data);
           }
        }
      }


      public function getdocerweima()
      {
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $res = pdo_get("hyb_yl_zhuanjia",array('zid'=>$zid));
        $base = pdo_getcolumn("hyb_yl_zhuanjia_rule",array("uniacid"=>$uniacid),'background');
        $res['background'] = $base;
        $labels = $res['keshi']."|".$res['zhicheng'];
        $res['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$res['parentid']),'name');
        $res['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$res['z_zhicheng']),'job_name');
        $res['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$res['hid']),'agentname');
        $res['shanchan'] = "擅长：".$res['authority'];

        $dir = iconv("UTF-8", "GBK", "../attachment/hyb_yl");
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        $result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}' ", array(":uniacid" => $uniacid));
        $APPID = $result['appid'];
        $SECRET = $result['appsecret'];
        $erweima =$res['share_erweima'];
        if($erweima == '')
        {

          $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$result['appid']}&secret={$result['appsecret']}";

          $getArr = array();
          $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));

          $access_token = $tokenArr->access_token;
          $tkid = $_GPC['tkid'];
          $data = array();
          $data['scene'] = "zid=".$res['zid']."&tkid=".$tkid;
          $data['page'] = "hyb_yl/czhuanjiasubpages/pages/zhuanjiazhuye/zhuanjiazhuye";
          $data = json_encode($data);
          $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $access_token;
          $result = $this->api_notice_increment($url, $data);
          $image_name = "id_".$res['zid'] . ".jpg";
          $filepath = "../attachment/hyb_yl/{$image_name}";
          $file_put = file_put_contents($filepath, $result);

        if ($file_put) {
            $siteroot = $_W['siteroot'];
            $filepathsss = "attachment/hyb_yl/{$image_name}";
            pdo_update("hyb_yl_zhuanjia",array("weweima"=>$filepathsss),array('zid'=>$zid,'uniacid'=>$uniacid));
           }
        }
      }

    public function shibie(){
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $mp3 = pdo_getcolumn('hyb_yl_twenorder',array('id'=>$id),'mp3');
        $name ="../attachment/".$mp3;
        require_once dirname(dirname(dirname(__FILE__))) . "/class/aip-speech-php-sdk-1.6.0/AipSpeech.php";
        $APP_ID = '22699607';//你的$APP_ID
        $API_KEY = '637b3EiidzRZ2ihaa4Fdgd1O';//你的$API_KEY
        $SECRET_KEY = 'wRKThHzKNHqRtcAta2BD8FCXKcDUd9bp';//你的$SECRET_KEY
        $client = new AipSpeech($APP_ID, $API_KEY, $SECRET_KEY);
        $res = $client->asr(file_get_contents($name), 'm4a', 16000, array(
            'dev_pid' => 1537,
        ));
        echo json_encode($res);
    }
    public function addfenzu()
    {
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $fzid = $_GPC['fzid'];
        $labelList = $_GPC['labelList'];
        $idarr = htmlspecialchars_decode($labelList);
        $array = json_decode($idarr);
        $object = json_decode(json_encode($array), true);
        $biaoqian = implode(',',$object);
        $text = $_GPC['text'];
        $openid = $_GPC['openid'];
        if(empty($fzid)){
            $res = pdo_insert('hyb_yl_userlabelarr',array('uniacid'=>$uniacid,'label'=>$text,'zid'=>$zid,'openid'=>$openid,'addtime'=>strtotime('now')));
        }else{
            $res = pdo_update('hyb_yl_userlabelarr',array('label'=>$text),array('id'=>$fzid));
        }
        
        $doc = pdo_get('hyb_yl_zhuanjia',array('zid'=>$zid));
        $authority = explode('、',$doc['authority']);
        $doc_biao = $doc['authority'];
        $weiyou=[];
        foreach ($object as $key => $value) {
           if(in_array($value,$authority)){
           }else{
             $weiyou[]=$value;
           }
        }
        $wwei_data = implode('、',$weiyou);
        $data =array(
           'authority'=>$doc_biao.'、'.$wwei_data
            );
        pdo_update('hyb_yl_zhuanjia',$data,array('zid'=>$zid));
        echo json_encode($res);
    }

    public function delfenzu()
    {
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $zid = $_GPC['zid'];
        $wzid = $_GPC['wzid'];
        $object = $this->jsondate($_GPC['labelList']);
        $biaoqian = implode(',',$object);
 
        $delfezu = $this->jsondate($_GPC['delfezu']);
        $res = pdo_get('hyb_yl_twenorder',array('id'=>$wzid));
        $doc = pdo_get('hyb_yl_zhuanjia',array('zid'=>$zid));
        $authority = explode('、',$doc['authority']);

        $arrbiao = explode(',',$res['biaoqian']);
        $data2=array(
           'biaoqian'=>$biaoqian
            );
      
        pdo_update('hyb_yl_twenorder',$data2,array('id'=>$wzid));

        $shuju = array_diff($authority,$delfezu);
        $doc_shuju = implode('、',$shuju);

        $data=array(
         'authority'=>$doc_shuju
        );
        $res_doc = pdo_update('hyb_yl_zhuanjia',$data,array('zid'=>$zid));
        echo json_encode($res_doc);
       }

    public function shibiewz(){
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $mp3 = pdo_getcolumn('hyb_yl_wenzorder',array('id'=>$id),'mp3');
        $name ="../attachment/".$mp3;
        require_once dirname(dirname(dirname(__FILE__))) . "/class/aip-speech-php-sdk-1.6.0/AipSpeech.php";
        $APP_ID = '22699607';//你的$APP_ID
        $API_KEY = '637b3EiidzRZ2ihaa4Fdgd1O';//你的$API_KEY
        $SECRET_KEY = 'wRKThHzKNHqRtcAta2BD8FCXKcDUd9bp';//你的$SECRET_KEY
        $client = new AipSpeech($APP_ID, $API_KEY, $SECRET_KEY);
        $res = $client->asr(file_get_contents($name), 'm4a', 16000, array(
            'dev_pid' => 1537,
        ));
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
    // 专家年卡返利
    public function year_fanli()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $zid  =$_GPC['zid'];
        $money = $_GPC['money'];
        $yid = $_GPC['yid'];
        $openid = $_GPC['openid'];
        $jiesuan_set = pdo_get("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid));
        $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$zid));
        $card_cut = $jiesuan_set['card_cut'];
        $z_choucheng = "";
        $h_choucheng = "";
        if($card_cut != '' && $card_cut != '0.00')
        {

            $data = array(
                'uniacid' => $uniacid,
                "openid" => $openid,
                "money" => $money * $card_cut / 100,
                "zid" => $zid,
                "created" => time(),
                "old_money" => $money,
                "type" => '0',
                "style" => '8',
                "status" => '1',
                "cash" => '0',
            );
            pdo_insert("hyb_yl_pay",$data);
            $z_choucheng = $money * $card_cut / 100;
            
        }
        if($zhuanjia['hid'] != '')
        {
            $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$zhuanjia['hid']));
            $team_cuts = $jiesuan_set['team_cut'];
            if($team_cuts == '' || $team_cuts == '0.00')
            {
                $team_cut = $hospital['cut'];
            }else{
                $team_cut = $team_cuts;
            }
            if($team_cut != '' && $team_cut != '0.00')
            {
                $data = array(
                    'uniacid' => $uniacid,
                    "openid" => $openid,
                    "money" => $money * $team_cut / 100,
                    "created" => time(),
                    "old_money" => $money,
                    "type" => '0',
                    "style" => '7',
                    "status" => '1',
                    "cash" => '0',
                    "hid" => $hospital['hid']
                );
                $h_money = $hospital['money'] + $money * $team_cut / 100;
                pdo_update("hyb_yl_hospital",array("money"=>$h_money),array("uniacid"=>$uniacid,"hid"=>$hospital['hid']));
                $h_choucheng = $money * $team_cut / 100;
            }

        }
        $moneys = $money - $z_choucheng - $h_choucheng;
        $z_moneys = $zhuanjia['total_money'] + $moneys;
        pdo_update("hyb_yl_zhuanjia",array("total_money"=>$z_moneys),array("uniacid"=>$uniacid,"zid"=>$zid));
    }
    public function dayin(){
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $orderarr  =$this->getordernum();
        $time = date("Y-m-d H:i:s");
        $id = $_GPC['pid'];
        $zid = $_GPC['zid'];
        //查询专家所在机构
        $hid = pdo_getcolumn('hyb_yl_zhuanjia',array('zid'=>$zid),'hid');
        $host = pdo_get('hyb_yl_hospital',array('hid'=>$hid));
        $chufang = $_GPC['chufang'];
        $yongyao = $_GPC['yongyao'];
        $zhenduan = $_GPC['zhenduan'];
        $drugsArr = $_GPC['drugsArr'];
        $idarr = htmlspecialchars_decode($drugsArr);
        $array = json_decode($idarr);
        $object = json_decode(json_encode($array), true);
         
        $result = pdo_get('hyb_yl_goodsarr',array('orderarr'=>$orderarr));
        $cflist = pdo_get('hyb_yl_chufangmobo',array('id'=>$id,'uniacid'=>$uniacid));
        $lcontent = unserialize($cflist['content']);
        $con = explode('，',$cflist['content']);
        $show_title = pdo_getcolumn('hyb_yl_base',array('uniacid'=>$uniacid),'show_title');
        $base = pdo_get('hyb_yl_base',array('uniacid'=>$uniacid));
        $USER = $host['USER'];
        $UKEY = $host['UKEY'];
        $SN = $host['SN'];
        header("Content-type: text/html; charset=utf-8");
        require_once dirname(dirname(dirname(__FILE__)))."/class/HttpClient.class.php";
        define('USER', $USER);  //*必填*：飞鹅云后台注册账号
        define('UKEY', $UKEY);  //*必填*: 飞鹅云后台注册账号后生成的UKEY 【备注：这不是填打印机的KEY】
        define('SN', $SN);      //*必填*：打印机编号，必须要在管理后台里添加打印机或调用API接口添加之后，才能调用API
        define('IP','api.feieyun.cn');      //接口IP或域名
        define('PORT',80);            //接口IP端口
        define('PATH','/Api/Open/');    //接口路径
        $content = '<CB> 处方列表 </CB><BR>';
        $content .= '单号：'.$orderarr.'<BR>';
        $content .= '名称           规格<BR>';
        $content .= '-------------------<BR>';
        foreach ($lcontent as $key => $value) {
         $content .= ''.$value['ypname'].'　　　　　'; 
         $content .= ''.$value['jiliang'].'<BR>'; 
        }
        $content .= '--------------------------------<BR>';
        $content .= '诊断建议：'.$zhenduan.'<BR>';
        $content .= '用药建议：'.$yongyao.'<BR>';
        $content .= '处方建议：'.$chufang.'<BR>';
        $content .= '开方时间：'.$time.'<BR>';
        $content .= '-------药品补充-------<BR>';
        foreach ($object as $key => $value) {
         $use_title = $value['use_title'];
         $use_type = $value['use_type'];
         $use_dose = $value['use_dose'];
         $use_num = $value['use_num'];

         $content .= '药品名称：'.$use_title.'<BR>';
         $content .= '用法：'.$use_type.'<BR>';
         $content .= '单次用量：'.$use_dose.'<BR>';
         $content .= '用药次数：'.$use_num.'<BR>';
        }
        $content .= '开方时间：'.$time.'<BR>';
        $content .= "<DIRECTION>1</DIRECTION>";//设定打印时出纸和打印字体的方向，n 0 或 1，每次设备重启后都会初始化为 0 值设置，1：正向出纸，0：反向出纸，
        //$res=$this->printMsg(SN,$content,1);//打开注释调用标签机打印接口进行打印,该接口只能是标签机使用，其它型号打印机请勿使用该接口
        $openid = $_GPC['openid'];
        $zid = $_GPC['zid'];
        $data = array(
               'uniacid'=>$uniacid,
               'cid'   =>$id,
               'openid'=>$openid,
               'zid'   =>$zid,
               'created'=>strtotime('now'),
               'key_words'=>'yuanchengkaifang',
               'orders'=>$orderarr,
               'kftime' =>strtotime('now'),
               'zhenduan'=>$_GPC['zhenduan'],
               'yongyao'=>$_GPC['yongyao'],
               'chufang'=>$_GPC['chufang'],
               'drugsArr'=>serialize($drugsArr)
            );
        pdo_insert('hyb_yl_chufang_log',$data);
        $cfid = pdo_insertid();
        echo json_encode($orderarr);
       
    }

    public function printMsg($sn,$content,$times){

    $time = time();         //请求时间
    $msgInfo = array(
      'user'=>USER,
      'stime'=>$time,
      'sig'=>$this->signature($time),
      'apiname'=>'Open_printMsg',
      'sn'=>$sn,
      'content'=>$content,
      'times'=>$times//打印次数
    );

    $client = new HttpClient(IP,PORT);
    if(!$client->post(PATH,$msgInfo)){
      echo 'error';
    }else{
      //服务器返回的JSON字符串，建议要当做日志记录起来
      $result = $client->getContent();
      echo $result;
    }
  }
  public function signature($time){
    return sha1(USER.UKEY.$time);//公共参数，请求公钥
  }

  public function chufangmobo(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $list = pdo_getall('hyb_yl_chufangxilie',array('uniacid'=>$uniacid));  
    echo json_encode($list);

  }
  public function chufangmobolist(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $pid = $_GPC['pid'];
    if(empty($pid)){
     $list = pdo_getall('hyb_yl_chufangmobo',array('uniacid'=>$uniacid));
    }else{
     $list = pdo_getall('hyb_yl_chufangmobo',array('uniacid'=>$uniacid,'pid'=>$pid));   
    }
      
    echo json_encode($list);

  }
  public function userchufanglog(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $openid = $_GPC['openid'];
    $list = pdo_getall('hyb_yl_chufang_log',array('uniacid'=>$uniacid,'cid'=>!0));
    foreach ($list as $key => $value) {
       $cid = $value['cid'];
       $list[$key]['mobotitle'] = pdo_fetch('select a.title as atitle,a.*,b.title as btitle from'.tablename('hyb_yl_chufangmobo')."as a left join ".tablename('hyb_yl_chufangxilie')."as b on b.id = a.pid where a.uniacid='{$uniacid}' and a.id='{$cid}'");
    }
    echo json_encode($list);
  }
  public function cfdetail(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['id'];
    $orderid = $_GPC['orderid'];
    $orders = pdo_get('hyb_yl_chufang_log',array('id'=>$orderid));
    $object = unserialize($orders['drugsArr']);
    $kftime = date('Y-m-d H:i:s',$orders['kftime']);
    $list['kftime'] = date('Y-m-d H:i:s',$orders['kftime']);
    $list = pdo_get('hyb_yl_chufangmobo',array('uniacid'=>$uniacid,'id'=>$id));
    $lcontent = unserialize($list['content']);

    $zid = $_GPC['zid'];
    $list['zhuanjia'] = pdo_get('hyb_yl_zhuanjia',array('uniacid'=>$uniacid,'zid'=>$zid));

    $list['content'] = '<CB> 处方列表 </CB><BR>';
    $list['content'] .= '单号：'.$orders['orders'].'<BR>';
   
 

    foreach ($lcontent as $key => $value) {
     $list['content'] .= '<p style="color:red">药品名称:</p>'.$value['ypname']."\r\n;"; 
     $list['content'] .= '<p style="color:red">用法:</p>'.$value['yfa']."\r\n;"; 
     $list['content'] .= '<p style="color:red">单次用量:</p>'.$value['yliang']."\r\n;";
     $list['content'] .= '<p style="color:red">用药次数:</p>'.$value['jiliang']."\r\n;"; 
    }
     $list['content'] .= '----------------------------------<BR>';
     $list['content'] .= '诊断建议：'.$orders['zhenduan'].'<BR>';
     $list['content'] .= '用药建议：'.$orders['yongyao'].'<BR>';
     $list['content'] .= '处方建议：'.$orders['chufang'].'<BR>';
     $list['content'] .= '-------药品补充-------<BR>';
    foreach ($object as $key => $value) {
     $use_title = $value['use_title'];
     $use_type = $value['use_type'];
     $use_dose = $value['use_dose'];
     $use_num = $value['use_num'];

      $list['content'] .= '药品名称：'.$use_title.'<BR>';
     $content .= '用法：'.$use_type.'<BR>';
     $content .= '单次用量：'.$use_dose.'<BR>';
     $content .= '用药次数：'.$use_num.'<BR>';
    }
    $list['content'] .= '开方时间：'.$kftime.'<BR>';
    echo json_encode($list);
  }
  public function chufangfl(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $list = pdo_getall('hyb_yl_chufangfl',array('uniacid'=>$uniacid));
    echo json_encode($list);
  }
  public function chufangdesc(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $id = $_GPC['pid'];
    $res = pdo_get('hyb_yl_chufangmobo',array('uniacid'=>$uniacid,'id'=>$id));
    $res['content'] = unserialize($res['content']);
    foreach ($res['content'] as $key => $value) {
     $res['contents'] .= '药品名称：'.$value['ypname'].'　　　　　'; 
     $res['contents'] .= '用法：'.$value['yfa']."\r\n"; 
     $res['contents'] .= '单次用量：'.$value['yliang'].'　　　　　'; 
     $res['contents'] .= '用药次数：'.$value['jiliang']."\r\n"; 
    }
    echo json_encode($res);
  }
  public function cflistlog(){
    global $_W,$_GPC;
    $uniacid = $_W['uniacid'];
    $zid = $_GPC['zid'];
    $today = $_GPC['today'];

    $sql ="select * from ".tablename('hyb_yl_chufang_log')." where uniacid='{$uniacid}' and zid='{$zid}' ";
    $res = pdo_fetchall($sql);
    foreach ($res as $key => $value) {
        $kftime = date('Y-m-d',$value['kftime']);

        if($kftime==$today){
         $list[] = $value;
        }
     }
     if($list){
         foreach ($list as $key => $value) {
            $cid = $value['cid'];
            $list[$key]['time'] = date('m-d',$value['kftime']);
            $list[$key]['kftime'] = date('Y-m-d',$value['kftime']);
            $list[$key]['cfname'] = pdo_get('hyb_yl_chufangmobo',array('id'=>$cid));
         } 
     }else{
         $list="";
     }

     echo json_encode($list);
   }
   //申请退款通知
  public function tktemplet(){
      //获取token
       global $_GPC, $_W;
       $uniacid = $_W['uniacid'];
       $orders = $_GPC['orders'];
       $keywords = $_GPC['keywords'];
       if($keywords =='tuwenwenzhen'){
        $res = pdo_fetch('SELECT * FROM' . tablename('hyb_yl_twenorder') . "where uniacid ='{$uniacid}' and orders='{$orders}' ");
       }
       if($key_words == 'dianhuajizhen' || $key_words == 'shipinwenzhen' || $key_words == 'tijianjiedu' || $key_words == 'shoushukuaiyue'){
        $res = pdo_fetch('SELECT * FROM' . tablename('hyb_yl_wenzorder') . "where uniacid ='{$uniacid}' and orders='{$orders}' ");
       } 
       if($keywords =='yuanchengguahao'){
        $res = pdo_fetch('SELECT * FROM' . tablename('hyb_yl_guahaoorder') . "where uniacid ='{$uniacid}' and orders='{$orders}' ");
       }
       $zid = $res['zid'];
       $docinfo = pdo_get('hyb_yl_zhuanjia',array('zid'=>$zid));
       $z_name = $docinfo['z_name'];
       $j_id  =$res['j_id'];
       $userinfo = pdo_get('hyb_yl_userjiaren',array('j_id'=>$j_id));
       $user_name = $userinfo['names'];
       $user_sex = $userinfo['sex'];
       $money = $res['money'];

       $wxapp = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
       $appid = $wxapp['pub_appid'];  //填写你公众号的appid
       $secret = $wxapp['appkey'];   //填写你公众号的secret
       $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
       $gzhmb = unserialize($wxapp['gzhmb']);
       $mbxs = $gzhmb['tkmoban'];
       $wxappaid = $wxapp['appid'];

       $getArr = array();
       $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
       $access_token = $tokenArr->access_token;

       $jztime = date("Y-m-d H:i:s");
       $posturl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
       $openid = $userinfo['openid'];
       $wxopenid = pdo_getcolumn('hyb_yl_userinfo',array('openid'=>$openid),'wxopenid');


       $template = array(
           "touser" => $wxopenid,
           "template_id" => $mbxs,
           // "miniprogram"=>array(
           //     "appid"=>$wxappaid,
           //     "pagepath"=>'hyb_yl/mysubpages/pages/wodezixun/wodezixun?type='.$key_words.'&key_words='.$key_words
           //  ), 
           'topcolor' => '#ccc',
           'data' =>array('first' => array('value' =>'您好，您有一笔申请退款通知！',
                                              'color' =>"#743A3A",
           ),
               'keyword1' => array('value' =>$orders,
                                   'color' =>'#FF0000',
               ),
               'keyword2' => array('value' =>$jztime,
                                   'color' =>'#FF0000',
               ),
               'keyword3' => array('value' =>$user_name.','.$user_sex,
                                   'color' =>'#FF0000',
               ),
               'keyword4' => array('value' =>$money,
                                   'color' =>'#FF0000',
               ),
               'keyword5' => array('value' =>'未知',
                                   'color' =>'#FF0000',
               ),
               'remark'   => array('value' =>'请登录后台查看详情',
                                   'color' =>'#FF0000',
              ),
           )
      );
      $postjson = json_encode($template);
      $resder = $this->http_curl($posturl,'post','json',$postjson);
      echo json_encode($resder);
  }
}
