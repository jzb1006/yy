<?php 
	global $_W,$_GPC;
    $op =$_GPC['op'];
    $uniacid =$_W['uniacid'];
    $type_id = $_GPC['type_id'];
    switch ($op) {
         case 'add':
        $type = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_zixun_type")." where uniacid=:uniacid",array(":uniacid"=>$_W['uniacid']));
        $id = $_GPC['id'];
        $items = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zixun")." as z left join ".tablename("hyb_yl_zixun_type")." as zt on z.zx_names=zt.zx_id where z.uniacid=:uniacid and z.id=:id",array(":uniacid"=>$_W['uniacid'],":id"=>$id));

        if (checksubmit("submit")) {
          $data = array("uniacid"=>$_W['uniacid'],
            "zx_names"=>$_GPC['zx_names'],
            "title"=>$_GPC['title'],
            "title_fu"=>$_GPC['title_fu'],
            "content_thumb"=>serialize($_GPC['content_thumb']),
            "content"=>$_GPC['content'],
            "status"=>$_GPC['status'],
            "time"=>time(),
            'thumb'=>$_GPC['thumb'],
            'mp3'=>$_GPC['mp3'],
            'iflouc'=>$_GPC['iflouc'],
            'dianj'=>$_GPC['dianj'],
            'aliaut'=>$_GPC['aliaut'],
            'kiguan'=>$_GPC['kiguan']
            );
          if (empty($id)) {
            pdo_insert("hyb_yl_zixun",$data);
            message('成功', 'refresh', 'success');
          }
          else
          {
            pdo_update("hyb_yl_zixun",$data,array("id"=>$id));
            message('成功', 'refresh', 'success');
          }
        }
         include $this->template('Content/ks.classzifenlei.aspx');
         break;
       
       case 'delete':
        $id = $_GPC['id'];
        pdo_delete("hyb_yl_zixun",array("id"=>$id));
        message('成功', 'refresh', 'success');
         include $this->template('content/kscoslistadd');
         break;

       case 'batchdel':
         include $this->template('content/kscoslistadd');
         break;

       case 'paixu':
        $zid=$_GPC['id'];
        $sord = $_GPC['sord'];
        for($i=0;$i<count($zid);$i++){
          $id = $zid[$i];
          $sid = $sord[$i];
          $data= array(
            'sord'=>$sid
            );
          $update_sql=pdo_update('hyb_yl_zixun',$data,array('id'=>$id,'uniacid'=>$_W['uniacid']));
        }
        message('成功', 'refresh', 'success');
         include $this->template('content/kscoslistadd');
         break; 
       case 'fxadd':
        $id = $_GPC['id'];
        $items = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zixun_type")." where uniacid=:uniacid",array(":uniacid"=>$_W['uniacid']));

        if (checksubmit("submit")) {
          $data = array("uniacid"=>$_W['uniacid'],
            "zx_name"=>$_GPC['zx_names'],
            "zx_thumb"=>$_GPC['zx_thumb'],
            "zx_type"=>$_GPC['zx_type'],
            );
          if (empty($id)) {
            pdo_insert("hyb_yl_zixun_type",$data);
            message('成功', 'refresh', 'success');
          }
          else
          {
            pdo_update("hyb_yl_zixun",$data,array("id"=>$id));
            message('成功', 'refresh', 'success');
          }
        }
         include $this->template('Content/ks.classzifenlei.aspx');
         break;
        case 'deletefx':
          $id = $_GPC['id'];
          pdo_delete("hyb_yl_zixun_type",array("zx_id"=>$id));
          message('成功', 'refresh', 'success');
       case 'columnsite':
          $uniacid = $_W['uniacid'];
          $pindex = max(1, intval($_GPC['page'])); 
          $pagesize = 10;
          $p = ($pindex-1) * $pagesize; 
          $products = pdo_fetchall("select * from ".tablename("hyb_yl_zixun_type")." where uniacid=:uniacid order by zx_id desc limit ".$p.",".$pagesize,array(":uniacid"=>$uniacid));
          $toal = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zixun_type")." where uniacid=:uniacid",array(":uniacid"=>$uniacid));
          $pager = pagination($total,$pindex,$pagesize);
         include $this->template('Content/KS.Class.aspx');
         break; 

      default:
        $type = pdo_fetchall("select * from ".tablename("hyb_yl_zixun_type")." where uniacid=:uniacid",array(":uniacid"=>$_W['uniacid']));
        $uniacid = $_W['uniacid'];
        $pindex = max(1, intval($_GPC['page'])); 
        $pagesize = 10;
        $p = ($pindex-1) * $pagesize; 
        $keyword = $_GPC['keyword'];
        $types = $_GPC['calssid'];
        if($keyword == '' && $types == '')
        {
          $products = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_zixun")." as z left join ".tablename("hyb_yl_zixun_type")." as zt on z.zx_names=zt.zx_id where z.uniacid=:uniacid order by z.sord desc limit ".$p.",".$pagesize,array(":uniacid"=>$_W['uniacid']));
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zixun")." where uniacid=:uniacid",array(":uniacid"=>$uniacid));
      }elseif($keyword != '' && $types == '')
      {
        $products = pdo_fetchall("SELECT * from ".tablename("hyb_yl_zixun")." as z left join ".tablename("hyb_yl_zixun_type")." as zt on z.zx_names=zt.zx_id where z.uniacid=:uniacid and (z.title like '%$keyword%' or z.title_fu like '%$keyword%' or z.content like '%$keyword%') order by z.sord desc limit ".$p.",".$pagesize,array(":uniacid"=>$_W['uniacid']));
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zixun")." where uniacid=:uniacid and (title like '%$keyword%' or title_fu like '%$keyword%' or content like '%$keyword%')",array(":uniacid"=>$uniacid));
      }elseif($keyword != '' && $types != '')
      {
        $products = pdo_fetchall("SELECT * from ".tablename("hyb_yl_zixun")." as z left join ".tablename("hyb_yl_zixun_type")." as zt on z.zx_names=zt.zx_id where z.uniacid=:uniacid and (z.title like '%$keyword%' or z.title_fu like '%$keyword%' or z.content like '%$keyword%') and z.zx_names=:types order by z.sord desc limit ".$p.",".$pagesize,array(":uniacid"=>$_W['uniacid'],":types"=>$types));
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zixun")." where uniacid=:uniacid and (title like '%$keyword%' or title_fu like '%$keyword%' or content like '%$keyword%') and zx_names=:types",array(":types"=>$types));
      }elseif($keyword == '' && $type != '')
      {
        $products = pdo_fetchall("SELECT * from ".tablename("hyb_yl_zixun")." as z left join ".tablename("hyb_yl_zixun_type")." as zt on z.zx_names=zt.zx_id where z.uniacid=:uniacid and z.zx_names=:types order by z.sord desc limit ".$p.",".$pagesize,array(":uniacid"=>$_W['uniacid'],":types"=>$types));
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zixun")." where uniacid=:uniacid and zx_names=:types",array(":types"=>$types));
      }
      $pager = pagination($total,$pindex,$pagesize);
        

        include $this->template('Content/KS.ContentManage.aspx');
        break;
    }


	