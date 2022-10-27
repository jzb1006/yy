<?php 
	global $_W,$_GPC;
	$uniacid=intval($_W['uniacid']);
    $_W['plugin'] ='look';
	require_once dirname(__FILE__) .'/Data/pdo.class.php';
	$model=new Model('zixun_type');
    $op = isset($_GPC['op'])?$_GPC['op']:'list';
    $type_id = $_GPC['type_id'];
  //板块分类
	if($op =='catefl'){

    $row = pdo_fetchall("select * from".tablename('hyb_yl_zixun_type')."where uniacid=:uniacid and pid =0 order by sort desc ",array(":uniacid"=>$uniacid));
    if (!empty($row)) {
        foreach ($row as &$value) {
            $value['zx_thumb'] = $_W['attachurl'].$value['zx_thumb'];

            // $childrenlist = pdo_fetchall("select * from ".tablename("hyb_yl_zixun_type")." where uniacid=:uniacid and pid=:pid order by sort desc ",array(":uniacid"=>$uniacid,":pid"=>$value['zx_id']));
            // $value['childrenlist'] = $childrenlist;
        }
    }
       include $this->template('classification/catefl');
	}

    //添加子分类
  if($op =='addparent'){
     $zx_id = $_GPC['zx_id'];
     if($_W['ispost']){
        $data =array(
           'uniacid'  => $_W['uniacid'],
           'zx_name'  => $_GPC['zx_name'], 
           'zx_thumb' => $_GPC['zx_thumb'], 
           'zx_type'  => $_GPC['zx_type'],
           'sort'     => $_GPC['sort'],
           'link_url' => $_GPC['link_url'],
           'enabled'  => $_GPC['enabled'],
           'zx_kew'   => $_GPC['zx_kew'],
           'pid'      => $_GPC['pid']
          );
        pdo_insert("hyb_yl_zixun_type",$data);
        message('添加子分类成功', $this->createWebUrl('classification', array('op'=>'catefl')), 'success');
     }
     include $this->template('classification/addparent');
  }
  //添加板块
  if($op =='plate'){
      $zx_id = intval($_GPC['zx_id']);
      $res  = $model->where("zx_id=$zx_id and uniacid=$uniacid")->get('*');
      $data =array(
          'uniacid'  => $_W['uniacid'],
          'zx_name'  => $_GPC['zx_name'],
          'zx_thumb' => $_GPC['zx_thumb'], 
          'zx_type'  => $_GPC['zx_type'],
          'sort'     => $_GPC['sort'],
          'link_url' => $_GPC['link_url'],
          'enabled'  => $_GPC['enabled'],
          'zx_kew'   => $_GPC['zx_kew'],
          'link_type' => $_GPC['link_type'],
          'recommend' => $_GPC['recommend'],
          'background' => $_GPC['background'],
      );
      if($_W['ispost']){
        if(empty($zx_id)){
           pdo_insert("hyb_yl_zixun_type",$data);
           message('添加成功', $this->createWebUrl('classification', array('op'=>'catefl')), 'success');
        }else{
          pdo_update("hyb_yl_zixun_type",$data,array('zx_id'=>$zx_id));
           message('更新成功', $this->createWebUrl('classification', array('op'=>'catefl')), 'success');
        }
      }
      include $this->template('classification/plate');
  }

  // 删除分类
  if($op == 'deletes')
  {
    $zx_id = $_GPC['zx_id'];
    $res = pdo_delete("hyb_yl_zixun_type",array("zx_id"=>$zx_id));
    if($res){
        message('删除分类成功', $this->createWebUrl('classification', array('op'=>'catefl')), 'success');
    }else{
        message('删除分类失败', $this->createWebUrl('classification', array('op'=>'catefl')), 'error');
    }
     include $this->template('classification/add');

  }
//文章列表
	if($op =='list'){

      $page = empty($_GPC['page']) ? "" : $_GPC['page'];
      $pageindex = max(1, intval($page));
      $pagesize = 10;
      $where = "  where a.uniacid='{$uniacid}'";
      $status = $_GPC['status'] == '' ? '' : $_GPC['status'];
      if($status == '1')
      {
        $where .= " and a.art_type=0";
      }else if($status == '2')
      {
        $where .= " and a.art_type=1 and a.display=1";
      }else if($status == '3')
      {
        $where .= " and a.zdtype=1";
      }else if($status == '4')
      {
        $where .= " and a.art_type=2";
      }
      $keyword = $_GPC['keyword'];
      $keywordtype = $_GPC['keywordtype'];
      if($keywordtype == '1')
      {
        $where .= " and (a.content like '%$keyword%' or a.title like '%$keyword%')";
      }else if($keywordtype == '2')
      {
        $where .= " and d.zx_name like '%$keyword%'";
      }else if($keywordtype == '3')
      {
        $where .= " and u.u_name like '%$keyword%'";
      }else if($keywordtype == '4')
      {
        $where .= " and u.u_phone like '%$keyword%'";
      }
      $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1months",time())) : $_GPC['start']; 
      $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
      if($_GPC['timetype'])
      {
        $where .= " and a.time>='".$start."' and a.time <='".$end."'";
      }
     $row = pdo_fetchall("select a.*,b.z_name,c.u_name,c.u_thumb,d.zx_name from".tablename('hyb_yl_zixun')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid = a.zid left join".tablename('hyb_yl_userinfo')."as c on c.u_id = a.userid left join".tablename('hyb_yl_zixun_type')."as d on d.zx_id = a.p_id".$where." order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
     foreach ($row as $key => $value) {
      $row[$key]['thumb'] = tomedia($row[$key]['thumb']);
     }
     
     $total = pdo_fetchcolumn("select count(*) from".tablename('hyb_yl_zixun')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid = a.zid left join".tablename('hyb_yl_userinfo')."as c on c.u_id = a.userid left join".tablename('hyb_yl_zixun_type')."as d on d.zx_id = a.p_id".$where);
     $pager = pagination($total, $pageindex, $pagesize);
     $all = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zixun")." where uniacid=".$uniacid);
     $shenhe = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zixun")." where art_type=0 and uniacid=".$uniacid);
     $show = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zixun")." where art_type=1 and display=1 and uniacid=".$uniacid);
     $zhiding = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zixun")." where art_type=1 and zdtype=1 and uniacid=".$uniacid);
     $jujue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zixun")." where art_type=2 and uniacid=".$uniacid);
     include $this->template('classification/list');
  }


//添加文章
	if($op =='add'){
	 $id = $_GPC['id'];
	 $list_type = pdo_fetchall("select * from".tablename('hyb_yl_zixun_type')."where uniacid ='{$uniacid}' and pid=0");
	 $res = pdo_fetch("select a.*,b.z_name,c.u_name,c.u_thumb,d.zx_name from".tablename('hyb_yl_zixun')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid = a.zid left join".tablename('hyb_yl_userinfo')."as c on c.u_id = a.userid left join".tablename('hyb_yl_zixun_type')."as d on d.zx_id = a.p_id  where a.uniacid='{$uniacid}' and id = '{$id}'");
    $ks_list = pdo_getall("hyb_yl_classgory",array('uniacid'=>$uniacid,"typeint"=>'0'));
    $ks_two = pdo_getall("hyb_yl_ceshi",array("giftstatus"=>$res['keshi_one']));
	  $p_id = $res['p_id'];
	  $er_id = $res['er_id'];
      $er_ji = pdo_fetchall("select * from".tablename('hyb_yl_zixun_type')."where uniacid ='{$uniacid}' and pid='{$p_id}'");
	  $o = '';

	  foreach ($er_ji AS $parent) {
	    $parentid =$parent['zx_id'];
	    if($parentid ==$er_id){
	      $o.= "<option value=".$parentid." selected>";
	    }else{
	      $o.= "<option value=".$parentid.">"; 
	    }
	    $o.= "".$parent['zx_name']."";
	    $o.= "</option>";
	  }
     if($_W['ispost']){
       $data =array(
			'uniacid' => $_W['uniacid'],
			'sord'    =>$_GPC['sord'],
			'title'   =>$_GPC['title'],
			'zid'     =>$_GPC['zid'],
			'userid'    =>$_GPC['u_id'],
			'thumb'   =>$_GPC['thumb'],
			'title_fu'=>$_GPC['title_fu'],
			'content' =>$_GPC['content'],
			'p_id'    =>$_GPC['p_id'],
			// 'er_id'   =>$_GPC['er_id'],
			'time'    =>$_GPC['time'],
			'dz'      =>$_GPC['dz'],
			'rcyd'    =>$_GPC['rcyd'],
			'scyd'    =>$_GPC['scyd'],
			'status'  =>$_GPC['status'],
			'art_type'=>$_GPC['art_type'],
			'display' =>$_GPC['display'],
      'keshi_one' => $_GPC['keshi_one'],
      "keshi_two" => $_GPC['keshi_two'],
      'color'  =>$_GPC['color'],
      "xncs" => $_GPC['xncs']
       	);
       if(empty($id)){
            pdo_insert("hyb_yl_zixun",$data);
            message('添加文章成功', $this->createWebUrl('classification', array('op'=>'list')), 'success');
        }else{
        	pdo_update("hyb_yl_zixun",$data,array('id'=>$id));
        	message('更新文章成功', $this->createWebUrl('classification', array('op'=>'list')), 'success');
        }
       }
     include $this->template('classification/add');
	}

	//模块幻灯片
	if($op =='temthum'){

       include $this->template('classification/temthum');
	}
//查询二级分类
if($op =='class_er'){
  $id = $_GPC['id'];
  $row = pdo_fetchall("select * from".tablename("hyb_yl_zixun_type")."where uniacid='{$uniacid}' and  pid ='{$id}'");
  echo json_encode($row);
  return false;
}
if($op =='delete'){
  $id = $_GPC['id'];
  pdo_delete("hyb_yl_zixun",array('id'=>$id));
  message('删除成功', $this->createWebUrl('classification', array('op'=>'list')), 'success');
}
if($op =='tuijian'){
  $id = $_GPC['id'];
  $status = intval($_GPC['status']);
  pdo_update("hyb_yl_zixun",array('status'=>$status ),array('id'=>$id));
  message('状态更新成功', $this->createWebUrl('classification', array('op'=>'list')), 'success');
}
if($op == 'delerweima'){
  $res =pdo_update("hyb_yl_zixun",array('erweima'=>'','haibao'=>''),array('uniacid'=>$uniacid));
   message('清空成功', $this->createWebUrl('classification', array('op'=>'list')), 'success');
}