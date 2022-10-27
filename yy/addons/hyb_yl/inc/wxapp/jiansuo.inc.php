<?php
/**
* 
*/
 class Jiansuo extends HYBPage
 {
    /*关键词 source 0大搜索 1医生 2医院 3药品*/

 	//添加搜搜
 	public function addsearch(){
 		global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $data['uniacid'] = $uniacid;
        $data['openid'] = $_GPC['openid'];
        $data['content'] = trim($_GPC['checkword']);
        $data['createtime'] = time();
        $data['source'] = $_GPC['source'];
        pdo_insert("hyb_yl_search_log",$data);
 	} 	
 	//热门搜索
 	public function show_hotsearch(){
 		global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        // $source = $_GPC['source'];
        // $WHERE = " where uniacid=:uniacid ";
        // $WHEREdata[':uniacid'] = $uniacid;
        // if ($source!='0') {
        //     $WHERE .= " and source=:source ";
        //     $WHEREdata[':source'] = $source;
        // }
        // $list = pdo_fetchall("SELECT content as keywords ,count(*) as sum FROM ".tablename("hyb_yl_search_log").$WHERE."  group by keywords order by sum desc LIMIT 10",$WHEREdata);	

        $list = pdo_fetchall("SELECT name as keywords FROM ".tablename("hyb_yl_search")." where uniacid=:uniacid and status=1 order by sort desc ",array(":uniacid"=>$uniacid));

        echo json_encode($list);
 	}
 	//历史搜索
 	public function show_historysearch(){
 		global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $source = $_GPC['source'];
        $WHERE = "  where uniacid=:uniacid and openid=:openid ";
        $WHEREdata[':uniacid'] = $uniacid;
        $WHEREdata[':openid'] = $openid;
        if ($source!='0') {
            $WHERE .= " and source=:source ";
            $WHEREdata[':source'] = $source;
        }
        $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_search_log").$WHERE."  group by content order by createtime desc LIMIT 10",$WHEREdata);	
        echo json_encode($list);
 	}
    public function delsearch(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
     
        $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_search_log")." where uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$openid));
        
        if (!empty($list)) {
            foreach ($list as &$value) {
                pdo_delete("hyb_yl_search_log",array("id"=>$value['id']));
            }
        } 
    }

 	//首页搜索关键词列表
 	public function show_keywordssearch(){
 		global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $keywords = trim($_GPC['keywords']);
        $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_label_library")." where uniacid=:uniacid and name like :name ",array(":uniacid"=>$uniacid,":name"=>"%$keywords%"));
        echo json_encode($list);
 	}
    //医生搜索关键词列表
    public function yisheng_keywordssearch(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $keywords = trim($_GPC['keywords']);
        $newtime = date("Y-m-d H:i:s",time());
        $list = pdo_fetchall("SELECT z_name FROM ".tablename("hyb_yl_zhuanjia")." where uniacid=:uniacid and z_name like :name and exa=1 and endtime>:endtime ",array(":uniacid"=>$uniacid,":name"=>"%$keywords%",":endtime"=>$newtime));
        echo json_encode($list);
    }
    //医院搜索关键词列表
    public function yiyuan_keywordssearch(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $keywords = trim($_GPC['keywords']);
        $newtime = date("Y-m-d H:i:s",time());
        $list = pdo_fetchall("SELECT agentname FROM ".tablename("hyb_yl_hospital")." where uniacid=:uniacid and agentname like :name and state=1 and hos_tuijian=1 and endtime>:endtime ",array(":uniacid"=>$uniacid,":name"=>"%$keywords%",":endtime"=>$newtime));
        echo json_encode($list);
    }
    //搜索药品
    public function selectshop(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $keywords = trim($_GPC['keywords']);
        $list=pdo_fetchall("SELECT sname,jigou_two,sid FROM ".tablename("hyb_yl_goodsarr")." where uniacid=:uniacid and sname like :name and state=1",array(":uniacid"=>$uniacid,":name"=>"%$keywords%"));
        //查询所数据狗
        foreach ($list as $key => $value) {
          $list[$key]['hospi'] = pdo_fetch("select a.agentname,b.level_name from".tablename('hyb_yl_hospital')."as a left join".tablename('hyb_yl_hospital_level')."as b on a.grade=b.id where a.uniacid='{$uniacid}' and a.hid='{$value['jigou_two']}'");

        }
        
        echo json_encode($list);
    }

 	public function searchlist(){
 		global $_W,$_GPC;
 		$uniacid = $_W['uniacid'];
 		$openid = $_GPC['openid'];
 		$checkword = trim($_GPC['checkword']);
        $source = $_GPC['source'];
 		$sindex = $_GPC['sindex'];
        $newtime = date("Y-m-d H:i:s",time());

        if ($source=='0') {
            //查询科室
            $keshi = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_ceshi")." where uniacid=:uniacid and description like :description ",array(":uniacid"=>$uniacid,":description"=>'%'.$checkword.'%'));
            $ksid = [];
            if (!empty($keshi)) {
                foreach ($keshi as &$ks) {
                    $ksid [] = $ks['id'];
                }
            }
            $checkkeshi = implode(",",$ksid);
     
            if ($sindex=='0') {
                if (!empty($checkkeshi)) {
                    //查询看看/咨询
                    $zixunlist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_zixun")." where uniacid=:uniacid and art_type=1 and (title like :checkword or title_fu like :checkword or content like :checkword or keshi_two in($checkkeshi) ) order by time desc,status desc limit 6 ",array(":uniacid"=>$uniacid,":checkword"=>'%'.$checkword.'%'));
                    //查询问题
                    $answerlist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_answer")." where uniacid=:uniacid and status=0 and (title like :checkword or content like :checkword or label like :checkword or keyword like :checkword or keshi_two in($checkkeshi) )  order by created desc,is_hot desc limit 6 ",array(":uniacid"=>$uniacid,":checkword"=>'%'.$checkword.'%'));
                }else{
                    //查询看看/咨询
                    $zixunlist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_zixun")." where uniacid=:uniacid and art_type=1 and (title like :checkword or title_fu like :checkword  or content like :checkword ) order by time desc,status desc limit 6 ",array(":uniacid"=>$uniacid,":checkword"=>'%'.$checkword.'%'));
                    //查询问题
                    $answerlist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_answer")." where uniacid=:uniacid and status=0 and (title like :checkword or content like :checkword or label like :checkword or keyword like :checkword )  order by created desc,is_hot desc limit 6 ",array(":uniacid"=>$uniacid,":checkword"=>'%'.$checkword.'%'));
                }
                if (!empty($zixunlist)) {
                    foreach ($zixunlist as &$zx) {
                        if (strpos($zx['thumb'],"http")===false) {
                            $zx['thumb']=$_W['attachurl'].$zx['thumb'];
                        }
                    }
                }
                if (!empty($answerlist)) {

                    foreach ($answerlist as &$asw) {
                        //查询专家
                        $zhuanjiainfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." where uniacid=:uniacid and zid=:zid ",array(":uniacid"=>$uniacid,":zid"=>$asw['zid']));
                        $asw['zhuanjia_name'] = $zhuanjiainfo['z_name'];
                        $u_id = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$asw['openid']),'u_id');
                        $asw['names'] = '匿名用户'.$u_id;
                        if (strpos($zhuanjiainfo['advertisement'],"http")===false) {
                            $asw['zhuanjia_thumb'] = $_W['attachurl'].$zhuanjiainfo['advertisement'];
                        }else{
                            $asw['zhuanjia_thumb'] = $zhuanjiainfo['advertisement'];
                        }

                        //查询专家所在机构 职称
                        $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital_diction")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['hid']));

                        $zhuanjiazhicheng = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['z_zhicheng']));
                        $asw['zhuanjia_jigou'] = $zhuanjiajigou['name'];
                        $asw['zhuanjia_zhicheng'] = $zhuanjiazhicheng['job_name'];


                        $helpcount = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=:uniacid and zid=:zid",array(":uniacid"=>$uniacid,":zid"=>$zhuanjiainfo['zid']));
                        $asw['helpnum'] = $asw['xn_reoly'] + $helpcount;
                    }
                }
                $info['zixunlist'] = $zixunlist;
                $info['answerlist'] = $answerlist;
            }
            if ($sindex=='1') {
                
                if(!empty($checkkeshi)){

                    $zhuanjialist = pdo_fetchall("SELECT z.* FROM ".tablename("hyb_yl_attention")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.goods_id where z.uniacid=:uniacid and z.exa=1 and z.endtime>:endtime and (z.parentid in ($checkkeshi) or z.z_name like :checkword or z.authority like :checkword or z.z_content like :checkword ) and a.cerated_type=0 and a.ifqianyue=2 and a.openid=".$openid." order by z.sord desc ",array(":uniacid"=>$uniacid,":checkword"=>'%'.$checkword.'%',":endtime"=>$newtime));
                }else{
                    $zhuanjialist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." where uniacid=:uniacid and exa=1  and (z_name like :checkword or authority like :checkword or z_content like :checkword ) order by sord desc ",array(":uniacid"=>$uniacid,":checkword"=>'%'.$checkword.'%'));

                }

                if (!empty($zhuanjialist)) {

                    foreach ($zhuanjialist as &$zj) {
                        if (strpos($zj['advertisement'],"http")===false) {
                            $zj['zhuanjia_thumb'] = $_W['attachurl'].$zj['advertisement'];
                        }

                        //查询专家所在机构 职称 科室
                        $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$zj['hid']));
                        $zhuanjiazhicheng = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zj['z_zhicheng']));
                        $zj['zhuanjia_jigou'] = $zhuanjiajigou['agentname'];
                        $zj['zhuanjia_zhicheng'] = $zhuanjiazhicheng['job_name'];

                        $zj['zhuanjia_keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zj['parentid']),'name');

                        //查询专家评分
                        $pingjia = pdo_fetch("selct count(*) as count,sum(score) as sum from ".tablename("hyb_yl_pingjia")." where zid=".$zj['zid']);
                        if($pingjis['count'] > 0)
                        {
                            $pingfen = round($pingjia['sum'] / $pingjia['count']);

                        }else{
                            $pingfen = "5";
                        }
                        $zj['pingfen'] = number_format($pingfen,1);
                        
                        //专家开通服务
                        $kaitongfuwu = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_doc_all_serverlist")." WHERE uniacid=:uniacid and zid=:zid and stateback=1",array(":uniacid"=>$uniacid,":zid"=>$zj['zid']));
                        $zj['kaitongfuwu'] = $kaitongfuwu;
                        
                    }
                }

                $info['zhuanjialist'] = $zhuanjialist;
            }
            if ($sindex=='2') {
                if(!empty($checkkeshi)){
                    $zhuanjialist = pdo_fetchall("SELECT hid FROM ".tablename("hyb_yl_zhuanjia")." where uniacid=:uniacid and exa=1  and (parentid in ($checkkeshi) or z_name like :checkword  or authority like :checkword or z_content like :checkword )  group by hid  ",array(":uniacid"=>$uniacid,":checkword"=>'%'.$checkword.'%'));
                }else{
                    $zhuanjialist = pdo_fetchall("SELECT hid FROM ".tablename("hyb_yl_zhuanjia")." where uniacid=:uniacid and exa=1  and (z_name like :checkword  or authority like :checkword or z_content like :checkword ) group by hid ",array(":uniacid"=>$uniacid,":checkword"=>'%'.$checkword.'%'));
                }

                if (!empty($zhuanjialist)) {
                    foreach ($zhuanjialist as &$zj) {
                        $yyid[]=$zj['hid'];
                    }
                    $hid = implode(",", $yyid);
                    $yiyuanlist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid in ($hid) and state=1 and hos_tuijian=1 and endtime>:endtime ",array(":uniacid"=>$uniacid,":endtime"=>$newtime));
                    
                }else{
                    $yiyuanlist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and agentname like :checkword and state=1 and hos_tuijian=1 and endtime>:endtime ",array(":uniacid"=>$uniacid,":checkword"=>'%'.$checkword.'%',":endtime"=>$newtime));
                }   

                if (!empty($yiyuanlist)) {
                    foreach ($yiyuanlist as &$yy) {
                        //查询医院等级
                        $dengji = pdo_fetch("SELECT * FROM".tablename('hyb_yl_hospital_level')."where uniacid=:uniacid and id=:id",array(":uniacid"=>$uniacid,":id"=>$yy['grade']));
                        $yy['grade_name'] = $dengji['level_name'];
                    }
                }
                $info['yiyuanlist'] = $yiyuanlist;
            }
        }
        if ($source=='1') {
            $zhuanjialist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." where uniacid=:uniacid and exa=1 and endtime>:endtime and (z_name like :checkword or authority like :checkword or z_content like :checkword )  order by sord desc ",array(":uniacid"=>$uniacid,":checkword"=>'%'.$checkword.'%',":endtime"=>$newtime));

            if (!empty($zhuanjialist)) {
                foreach ($zhuanjialist as &$zj) {
                    if (strpos($zj['advertisement'],"http")===false) {
                        $zj['zhuanjia_thumb'] = $_W['attachurl'].$zj['advertisement'];
                    }

                    //查询专家所在机构 职称 科室
                    $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$zj['hid']));
                    $zhuanjiazhicheng = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zj['z_zhicheng']));
                    $zj['zhuanjia_jigou'] = $zhuanjiajigou['agentname'];
                    $zj['zhuanjia_zhicheng'] = $zhuanjiazhicheng['job_name'];

                    $zj['zhuanjia_keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zj['parentid']),'name');

                    //查询专家评分
                    $pingjia = pdo_fetch("selct count(*) as count,sum(score) as sum from ".tablename("hyb_yl_pingjia")." where zid=".$zj['zid']);
                    if($pingjis['count'] > 0)
                    {
                        $pingfen = round($pingjia['sum'] / $pingjia['count']);

                    }else{
                        $pingfen = "5";
                    }
                    $zj['pingfen'] = number_format($pingfen,1);
                    
                    //专家开通服务
                    $kaitongfuwu = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_doc_all_serverlist")." WHERE uniacid=:uniacid and zid=:zid and stateback=1",array(":uniacid"=>$uniacid,":zid"=>$zj['zid']));
                    $zj['kaitongfuwu'] = $kaitongfuwu;
                    
                }
            }
            $info['zhuanjialist'] = $zhuanjialist;
        }
        if ($source=='2') {
            $yiyuanlist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid  and agentname like :checkword and state=1 and hos_tuijian=1 and endtime>:endtime ",array(":uniacid"=>$uniacid,":checkword"=>'%'.$checkword.'%',":endtime"=>$newtime));
            if (!empty($yiyuanlist)) {
                foreach ($yiyuanlist as &$yy) {
                    //查询医院等级
                    $dengji = pdo_fetch("SELECT * FROM".tablename('hyb_yl_hospital_level')."where uniacid=:uniacid and id=:id",array(":uniacid"=>$uniacid,":id"=>$yy['grade']));
                    $yy['grade_name'] = $dengji['level_name'];
                }
            }
            $info['yiyuanlist'] = $yiyuanlist;
        }
 		
 		echo json_encode($info);
 	}

    //医院详情
    public function hospital_info(){
        global $_GPC,$_W;
        $uniacid = $_W['uniacid'];
        $hid = $_GPC['hid'];
        $info = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid=:hid",array(":uniacid"=>$uniacid,":hid"=>$hid));

        //查询医院等级
        $dengji = pdo_fetch("SELECT * FROM".tablename('hyb_yl_hospital_level')."where uniacid=:uniacid and id=:id",array(":uniacid"=>$uniacid,":id"=>$info['grade']));
        $info['grade_name'] = $dengji['level_name'];

        $newtime = date("Y-m-d H:i:s",time());
        //查询医生
        $doctorlist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and hid=:hid and exa=1 and endtime>:endtime  order by sord desc  ",array(":uniacid"=>$uniacid,":hid"=>$hid,":endtime"=>$newtime));
        if (!empty($doctorlist)) {
            foreach ($doctorlist as &$zj) {
                if (strpos($zj['advertisement'],"http")===false) {
                    $zj['zhuanjia_thumb'] = $_W['attachurl'].$zj['advertisement'];
                }

                //查询专家所在机构 职称 科室
                $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." WHERE uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$zj['hid']));
                $zhuanjiazhicheng = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zj['z_zhicheng']));
                $zj['zhuanjia_jigou'] = $zhuanjiajigou['agentname'];
                $zj['zhuanjia_zhicheng'] = $zhuanjiazhicheng['job_name'];

                $zj['zhuanjia_keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zj['parentid']),'name');

                //查询专家评分
                $pingjia = pdo_fetch("selct count(*) as count,sum(score) as sum from ".tablename("hyb_yl_pingjia")." where zid=".$zj['zid']);
                if($pingjis['count'] > 0)
                {
                    $pingfen = round($pingjia['sum'] / $pingjia['count']);

                }else{
                    $pingfen = "5";
                }
                $zj['pingfen'] = number_format($pingfen,1);
                //专家开通服务
                $kaitongfuwu = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_doc_all_serverlist")." WHERE uniacid=:uniacid and zid=:zid and stateback=1",array(":uniacid"=>$uniacid,":zid"=>$zj['zid']));
                $zj['kaitongfuwu'] = $kaitongfuwu;
                
            }
        }
        $info['doctorlist'] = $doctorlist;
        echo json_encode($info);
    }

 } 