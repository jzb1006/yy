<?php
defined('IN_IA') or exit('Access Denied');
define('IN_GW', true);
class Setting extends HYBPage
{
	
     public function fz_display()
    {
		global $_W,$_GPC;
		load()->func('tpl');
		$uniacid =$_W['uniacid'];
		$type_id = $_GPC['type_id'];
        $uid =$_W['uid'];
        $op=$_GPC['op'];
        $rew = pdo_fetch("SELECT * FROM".tablename('hyb_yl_notesite')."where uniacid=:uniacid and uid=:uid",array(':uniacid'=>$uniacid,':uid'=>$uid));
        $rew['note'] = unserialize($rew['note']);
        $rew['position'] = unserialize($rew['position']);
        $data =array(
            'uniacid' =>$uniacid,
            'uid'     =>$uid,
            'note'    =>serialize($_GPC['note']),
            'position'=>serialize($_GPC['position']),
            'switch'  =>$_GPC['switch']
        	);
        
        if($_W['ispost']){
        	if($rew){
        		pdo_update("hyb_yl_notesite",$data,array('nid'=>$rew['nid']));
        		message('成功', 'refresh', 'success');
        		//message("修改成功!",$this->copysiteUrl("setting.fz_add").'&op=fz_display',"success");
        	}else{
        		pdo_insert("hyb_yl_notesite",$data);
        		message('成功', 'refresh', 'success');
        		//message("添加成功!",$this->copysiteUrl("setting.fz_add").'&op=fz_display',"success");
        	}
          
        } 
		include $this->template("setting/fz_add");
    } 
    public function erji(){
          global $_W,$_GPC;
		  $id =$_GPC['id'];
		  $type_id = $_GPC['type_id'];
		  if($_W['isajax']){
		  $subcatess = pdo_fetchall("SELECT * FROM " . tablename('hyb_yl_address').'where pid=:id',array(':id'=>$id));
		  echo json_encode($subcatess);
		  return false;	
		  }

    }
    public function cateary(){
      global $_W,$_GPC;
	  $id =$_GPC['id'];
	  $type_id = $_GPC['type_id'];
	  if($_W['isajax']){
		  $subcatess = pdo_fetchall("SELECT * FROM " . tablename('hyb_yl_category').'where parentid=:id',array(':id'=>$id));
		  echo json_encode($subcatess);
		  return false;
	  }

    }
    public function wuzi(){
		global $_W,$_GPC;
		load()->func('tpl');
		$uniacid =$_W['uniacid'];
     	$uid =$_W['uid'];
     	$op=$_GPC['op'];
     	$type_id = $_GPC['type_id'];
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename('hyb_yl_zhuanjia')."where uniacid=:uniacid and uid=:uid",array(':uniacid'=>$uniacid,':uid'=>$uid));
		$pindex = max(1, intval($_GPC['page'])); 
		$pagesize = 4;
		$p = ($pindex-1) * $pagesize; 
		$pager = pagination($total,$pindex,$pagesize);
	    $rew =pdo_fetchall("SELECT * FROM".tablename('hyb_yl_zhuanjia')."as a left join".tablename('hyb_yl_category')."as b on b.id=a.z_room where a.uniacid=:uniacid and a.uid=:uid order by a.zid desc limit ".$p.",".$pagesize,array(':uniacid'=>$uniacid,':uid'=>$uid));
	    foreach ($rew as $key => $value) {
	    	$rew[$key]['time'] =date('Y-m-d H:i:s',$rew[$key]['time']);
	    	$rew[$key]['overtime'] =date('Y-m-d H:i:s',$rew[$key]['overtime']);
	    }
		include $this->template("setting/wuzi");
    }
    public function wuzi_add(){
		 global $_W,$_GPC;
		 load()->func('tpl');
		 $uniacid =$_W['uniacid'];
	     $uid =$_W['uid'];
         $zid =$_GPC['zid'];
         $op=$_GPC['op'];
         $type_id = $_GPC['type_id'];
         $subcatess =pdo_fetchall("SELECT * FROM".tablename('hyb_yl_category')."where uniacid=:uniacid and parentid=0",array(':uniacid'=>$uniacid));
         $rew =pdo_get('hyb_yl_zhuanjia',array('uniacid'=>$uniacid,'zid'=>$zid,'uid'=>$uid));
         $rew['sid']=explode(',', $rew['sid']);
	     $money = unserialize($rew['money']);
         $parentid =$rew['parentid'];
		 $e_ji =pdo_fetchall("SELECT * FROM " . tablename('hyb_yl_category').'where id=:id',array(':id'=>$parentid));
		 $user = Model('userinfo');
		 $all_user = $user->where("uniacid=$uniacid")->getall();
         $servicemenu = new Model('lianmserver');

         $menu_list = $servicemenu->where("uniacid='".$uniacid."'")->getall();
		 $o = '';
		  foreach ($e_ji AS $parent) {
		    $parentid =$parent['id'];
		    if($parentid ==$ppp_id){
		      $o.= "<option value=".$parentid." selected>";
		    }else{
		      $o.= "<option value=".$parentid.">"; 
		    }
		    $o.= "".$parent['name']."";
		    $o.= "</option>";
		  }
	    $data =array(
	    	 'uniacid'=>$_W['uniacid'],
             'uid'   =>$uid,
             'openid'=>$_GPC['openid'],
             'z_name'=>$_GPC['z_name'],
             'z_sex' =>$_GPC['z_sex'],
             'z_room'=>$_GPC['pid'],
             'parentid'   =>$_GPC['floor'],
             'sfzbianhao' =>$_GPC['sfzbianhao'],
             'z_telephone'=>$_GPC['z_telephone'],
             'z_content'  =>$_GPC['z_content'],
             'goby'   =>$_GPC['goby'],
             'gzstype'=>$_GPC['gzstype'],
             'z_yy_type' =>$_GPC['z_yy_type'],
             'z_zhenzhi' =>$_GPC['z_zhenzhi'],
             'z_zhicheng'=>$_GPC['z_zhicheng'],
             'z_yy_fens' =>$_GPC['z_yy_fens'],
             'z_zhiwu'=>$_GPC['z_zhiwu'],
             'twzixun'=>$_GPC['twzixun'],
             'zhuiwen'=>$_GPC['zhuiwen'],
             'wzmoney'=>$_GPC['wzmoney'],
             'z_yy_money'=>$_GPC['z_yy_money'],
             'z_thumbs'  =>$_GPC['z_thumbs'],
             'time'      =>strtotime('now'),
             'sid'       =>$_GPC['sid'],
             'money'     =>serialize($_GPC['money'])
	    	);
	    if($_W['ispost']){

	    	if(!empty($zid)){
	          pdo_update('hyb_yl_zhuanjia',$data,array('zid'=>$rew['zid']));
	          message("修改成功!",$this->copysiteUrl("setting.wuzi_add").'&op=wuzi',"success");
	    	}else{
	    	 pdo_insert('hyb_yl_zhuanjia',$data);
	    	 message("添加成功!",$this->copysiteUrl("setting.wuzi_add").'&op=wuzi',"success");
	    	}
	    }
		include $this->template("setting/wuzi_add");
    }
    public function tiyan(){
		global $_W,$_GPC;
		load()->func('tpl');
		$uniacid =$_W['uniacid'];
     	$uid =$_W['uid'];
     	$op=$_GPC['op'];
     	$type_id = $_GPC['type_id'];
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename('hyb_yl_setmeal')."where uniacid=:uniacid and uid=:uid",array(':uniacid'=>$uniacid,':uid'=>$uid));
		$pindex = max(1, intval($_GPC['page'])); 
		$pagesize = 10;
		$p = ($pindex-1) * $pagesize; 
		$pager = pagination($total,$pindex,$pagesize);
	    $rew =pdo_fetchall("SELECT * FROM".tablename('hyb_yl_setmeal')."where uniacid=:uniacid and uid=:uid order by tid desc limit ".$p.",".$pagesize,array(':uniacid'=>$uniacid,':uid'=>$uid));
        foreach ($rew as $key => $value) {
        	$rew[$key]['t_time'] =date("Y-m-d H:i:s",$rew[$key]['t_time']);
        }
		include $this->template("setting/tiyan");
    }
    public function tiyan_add(){
		global $_W,$_GPC;
		load()->func('tpl');
		$uniacid =$_W['uniacid'];
        $tid=$_GPC['tid'];
	    $uid =$_W['uid'];
	    $type_id = $_GPC['type_id'];
	    $rew =pdo_get('hyb_yl_setmeal',array('uniacid'=>$uniacid,'uid'=>$uid,'tid'=>$tid));
	    $data =array(
           'uniacid'  =>$_W['uniacid'],
           'uid'      =>$uid,
           't_name'   =>$_GPC['t_name'],
           't_thumb'  =>$_GPC['t_thumb'],
           't_money'  =>$_GPC['t_money'],
           't_stype'  =>$_GPC['t_stype'],
           't_sex'   =>$_GPC['t_sex'],
           't_age1'  =>$_GPC['t_age1'],
           't_age2'  =>$_GPC['t_age2'],
           't_msg'   =>serialize($_GPC['t_msg']),
           't_time'  =>strtotime('now'),
	    	);
	    if($_W['ispost']){
	    	if(!empty($tid)){
	          pdo_update('hyb_yl_setmeal',$data,array('tid'=>$rew['tid']));
	          message('成功', 'refresh', 'success');
	          //message("修改成功!",$this->copysiteUrl("setting.tiyan_add").'&op=tiyan',"success");
	    	}else{
	          pdo_insert('hyb_yl_setmeal',$data);
	          message('成功', 'refresh', 'success');
	          //message("添加成功!",$this->copysiteUrl("setting.tiyan_add").'&op=tiyan',"success");
	    	}
	    }
		include $this->template("setting/tiyan_add");
    }
    public function base(){
		global $_W,$_GPC;
		load()->func('tpl');
		$uniacid =$_W['uniacid'];
        $uid =$_W['uid'];
        $op  = $_GPC['op'];
        $type_id = $_GPC['type_id'];
        $subcatess = pdo_fetchall("SELECT * FROM " . tablename('hyb_yl_address').'where pid=0');
        $rew = pdo_get('hyb_yl_hospital',array('uniacid'=>$uniacid,'uid'=>$uid));
        $p_id =$rew['pid'];
		$e_ji =pdo_fetchall("SELECT * FROM " . tablename('hyb_yl_address').'where pid=:p_id',array(':p_id'=>$p_id));
		  $o = '';
		  foreach ($e_ji AS $parent) {
		    $parentid =$parent['id'];
		    if($parentid ==$ppp_id){
		      $o.= "<option value=".$parentid." selected>";
		    }else{
		      $o.= "<option value=".$parentid.">"; 
		    }
		    $o.= "".$parent['name']."";
		    $o.= "</option>";
		  }
        $data =array(
             'uniacid'  => $_W['uniacid'],
             'uid'      => $uid,
             'hospital' => $_GPC['hospital'],
             'logo'     => $_GPC['logo'],
             'hospitaltel'=> $_GPC['hospitaltel'],
             'workshift'=> $_GPC['workshift'],
             'address'  => $_GPC['address'],
             'logintime'=> strtotime('now'),
             'longitude'=> $_GPC['log']['lng'],
             'latitude' => $_GPC['log']['lat'],
             'loginip'  => $_SERVER["REMOTE_ADDR"],
             'grade'    => $_GPC['grade'],
             'lntroduction'=> $_GPC['lntroduction'],
	         'pid'       => $_GPC['pid'],
	         'ppp_id'    => $_GPC['floor'],
	         'shanchang' => $_GPC['shanchang'],
	         'docnumber' => $_GPC['docnumber']
        	);
	     if($_W['ispost']){
	        if($rew){
	        	//更新
                pdo_update('hyb_yl_hospital',$data,array('hid'=>$rew['hid']));
                //message('修改成功',$this->copysiteUrl("setting.base").'&op=base', 'success');
                message('成功', 'refresh', 'success');
	        }else{
	        	//添加
                pdo_insert('hyb_yl_hospital',$data);
                message('成功', 'refresh', 'success');
	        	//message("添加成功!",$this->copysiteUrl("setting.base").'&op=base',"success");
	        }
	     }

		include $this->template("setting/base");
    }
    //服务包
    public function jiancha(){
		global $_W,$_GPC;
		load()->func('tpl');
		$uniacid =$_W['uniacid'];
        $uid =$_W['uid'];
        $op  = $_GPC['op'];
        $type_id = $_GPC['type_id'];
	    $ser= Model('lianmserver');
	    $servicemenu = Model('servicemenu');
        $uid =intval($_W['uid']); 
        $sid =intval($_GPC['sid']);
        //查询是否存在一条安装记录
        $res = $ser->where("uniacid='".$uniacid."'and uid ='".$uid."'")->getall();
        $list_all = $servicemenu->getall();
	    $val = array_merge($res,$list_all);
        $newdata = [];
        foreach($val as $k=>$v){
        if(!isset($newdata[$v['sid']])){
            $newdata[$v['sid']]=$v;
        }else{
            $newdata[$v['sid']]['state']+=$v['state'];
          }
        }
        //二维数组重新排序根据sid
        $last_names = array_column($newdata,'sid');
		array_multisort($last_names,SORT_DESC,$newdata);
         
    	include $this->template("setting/jiancha");
    }
    //添加服务包
    public function jiancha_add(){
	 global $_W,$_GPC;
	 load()->func('tpl');
	 $uniacid =$_W['uniacid'];
     $uid =$_W['uid'];
     $type_id = $_GPC['type_id'];
     $ser= Model('lianmserver');
     $data =array(
        'uniacid' =>$uniacid,
        'uid'     =>$uid,
        'sid'     =>$_GPC['sid'],
        'name'    =>$_GPC['name'],
        'desc'    =>$_GPC['desc'],
        'thumb'   =>$_GPC['thumb'],
        'state'   =>1,
        'pinyin'  =>$_GPC['pinyin'],
        'subtitle'=>$_GPC['subtitle']
     	);
     $ser->add($data);
     message("安装成功",$this->copysiteUrl("setting.jiancha").'&op=jiancha',"success");
    }
    //卸载服务
    public function jiancha_del(){
	 global $_W,$_GPC;
	 load()->func('tpl');
	 $uniacid =$_W['uniacid'];
     $uid =$_W['uid'];
     $serid  = $_GPC['serid'];
     $ser= Model('lianmserver');
     $type_id = $_GPC['type_id'];
     $ser->delete('serid="'.$serid.'"');
     //message("卸载成功",$this->copysiteUrl("setting.jiancha").'&op=jiancha',"success");
     message('成功', 'refresh', 'success');
    }
    public function keshi(){
		global $_W,$_GPC;
		load()->func('tpl');
		$uniacid =$_W['uniacid'];
	    $op=$_GPC['op'];
	    $model = Model('category');
	    $type_id = $_GPC['type_id'];
        $res = $model->where('uniacid="'.$uniacid.'" and parentid=0')->getall();
        $o="";

        foreach ($res as $key => $value) {
        	$id = $value['id'];
            $img =HYB_YL_URL.'/keshi/ziyuan.png';
	        $o.= "<tbody class=\"tbody\">";
	        $o.= "<tr  class=\"classA\">";
	        $o.= "<td colspan=\"2\" class=\"name\">";
	        $o.= "<div class=\"spanBox\">";
	        $o.= "<span class=\"down\"></span>";
	        $o.= "<span class=\"nameText\">".$value['name']."</span>";
	        $o.= "<span class=\"set\"><img src=".$img." alt=\"\"><ul id=\"tcontent\">";
	        $o.= "<li class=\"add\" modelid=".$value['id'].">新增子类</li>";
	        $o.= "<li class=\"modify\" modelid=".$value['id'].">修改</li>";
	        $o.= "<li class=\"remo\" modelid=".$value['id'].">删除</li>";
	        $o.= "</ul></span>";
	        $o.= "</div>";
	        $o.= "<div class=\"input\">";
	        $o.= "<input type=\"text\" name=\"cateary\">";
	        $o.= "<button class=\"btn1\" modelid=".$value['id'].">保存</button>";
	        $o.= "</div>";
	        $o.= "</td>";
	        $o.= "</tr>";
	        //二级
	        $erji = $model->where('uniacid="'.$uniacid.'" and parentid='.$id.'')->getall();
	        foreach ($erji as $k => $v) {
				$o.="<tr class=\"classB\">";
				$o.="<td></td>";
				$o.="<td>";
				$o.="<div class=\"spanBox\">";
				$o.="<span class=\"nameText\" style=\"display: block;\">".$v['name']."</span>";
				$o.="<span class=\"set\" style=\"display: block;\"><img src=".$img.">";
				$o.="<ul style=\"height: 0px;\">";
				$o.="<li class=\"modify1\">修改</li>";
				$o.="<li class=\"remo1\">删除</li>";
				$o.="</ul></span>";
				$o.="</div>";
				$o.="<div class=\"input\" style=\"display: none;\">";
				$o.="<input type=\"text\">";
				$o.="<button class=\"btn2\" modelid=".$v['name'].">保存</button>";
				$o.="<button class=\"btnAdd\" modelid=".$v['name'].">保存</button>";
				$o.="<div class=\"remo2\">X</div>";
				$o.="</div>";
				$o.="</td>";
				$o.="</tr>";
	        }
	        $o.= "</tbody>";
        }
    	include $this->template("setting/keshi");
    }

}


