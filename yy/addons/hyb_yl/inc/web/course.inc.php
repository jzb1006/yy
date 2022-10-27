<?php 
	global $_W,$_GPC;
    $op =$_GPC['op'];
    $uniacid =$_W['uniacid'];
    $type_id = $_GPC['type_id'];
    switch ($op) {

    	case 'kclist':
    		$room_type = $_GPC['room_type'];
    		$keyword = $_GPC['keyword'];
    		$pindex = max(1, intval($_GPC['page'])); 
			$pagesize = 10;
			$p = ($pindex-1) * $pagesize; 
    		$keshi = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_jfenl")." where uniacid=:uniacid",array(":uniacid"=>$_W['uniacid']));
    		
    		if(($room_type == '' || $room_type == 0) && $keyword == '')
    		{
				$total = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename("hyb_yl_schoolroom")."where uniacid = '{$uniacid}'");
			
				$products = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_schoolroom")."where uniacid = '{$uniacid}' order by sord  limit ".$p.",".$pagesize);
				
    		}elseif(($room_type != '' || $room_type != 0) && $keyword == '')
    		{
    			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename("hyb_yl_schoolroom")."where room_parentid ='{$id}' and uniacid = '{$uniacid}'");
			
				$products = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_schoolroom")."where room_parentid ='{$id}' and uniacid = '{$uniacid}' order by sord  limit ".$p.",".$pagesize);
    		}elseif(($room_type != '' || $room_type != 0) && $keyword != '')
    		{
    			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename("hyb_yl_schoolroom")."where room_parentid ='{$id}' and uniacid = '{$uniacid}' and (sroomtitle like '%$keyword%' or room_desc like '%$keyword%' or room_teacher like '%$keyword%')");
			
				$products = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_schoolroom")."where room_parentid ='{$id}' and uniacid = '{$uniacid}' and (sroomtitle like '%$keyword%' or room_desc like '%$keyword%' or room_teacher like '%$keyword%') order by sord  limit ".$p.",".$pagesize);
    		}
    		foreach($products as &$value)
    		{
    			$value['room_thumb'] = $_W['attachurl'].$value['room_thumb'];
    			$value['room_parents'] = pdo_fetchcolumn("SELECT j_name FROM ".tablename("hyb_yl_jfenl")." where uniacid=:uniacid and fl_id=:fl_id",array(":uniacid"=>$_W['uniacid'],":fl_id"=>$value['room_fl']));
    		}

			$pager = pagination($total,$pindex,$pagesize);
		    include $this->template('course/KS.CosList.aspx');
    		break;
    	
    	case 'add':
			$id = $_GPC['id'];

			$items =  pdo_fetch("SELECT * FROM ".tablename("hyb_yl_schoolroom")." as zj left join ".tablename("hyb_yl_jfenl")." as k on zj.room_fl=k.fl_id  where zj.id=:id and zj.uniacid=:uniacid",array(":id"=>$id,":uniacid"=>$_W['uniacid']));

			$keshi = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_jfenl")." where uniacid=:uniacid",array(":uniacid"=>$_W['uniacid']));

			if (checksubmit("submit")) {
				if($_GPC['room_money'] == '' || $_GPC['room_money'] == 0){
					$room_type = '0';
				}else{
					$room_type = '1';
				}
				$data = array(
					"uniacid"=>$_W['uniacid'],
					"sroomtitle"=>$_GPC['sroomtitle'],
					"room_money"=>$_GPC['room_money'],
					"room_liulan"=>$_GPC['room_liulan'],
					"room_thumb"=>$_GPC['room_thumb'],
					"room_video"=>$_GPC['room_video'],
					"room_tj" => $_GPC['room_tj'],
					"room_per"=>$_GPC['room_per'],
					"room_fl"=>$_GPC['room_fl'],
					"room_desc" => $_GPC['room_desc'],
					"room_teacher" => $_GPC['room_teacher'],
					"tea_pic" => $_GPC['tea_pic'],
					"tea_desc" =>$_GPC['tea_desc'],
					"room_type"=>$room_type,
					"room_parentid"=>0,
					'iflouc'=>$_GPC['iflouc'],
					'mp3'=>$_GPC['mp3'],
					'al_video'=>$_GPC['al_video'],
					'mp3m'=>$_GPC['mp3m'],
					'ypkg'=>$_GPC['ypkg'],
					'spkg'=>$_GPC['spkg'],
					'kaiguan'=>$_GPC['kaiguan'],
					'ymoney'=>$_GPC['ymoney']
					);
				if (empty($id)) {
					pdo_insert("hyb_yl_schoolroom",$data);
					message('成功', 'refresh', 'success');
				}
				else
				{
					pdo_update("hyb_yl_schoolroom",$data,array("id"=>$id));
					message('成功', 'refresh', 'success');
				}
			}
		    include $this->template('course/kscoslistadd');
    		break;

    	case 'delete':
    		$id = $_GPC['id'];
    		pdo_delete("hyb_yl_schoolroom",array("id"=>$id));
			message("删除成功!",$this->createWebUrl("course",array("op"=>"kclist")),"success");
        	break;
    	case 'categorylist':
			$products = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_jfenl")." where uniacid=:uniacid",array(":uniacid"=>$_W['uniacid']));
    		include $this->template('course/KS.CosCategoryfl.aspx');
    		break;
    		
    	case 'categorylistadd':
			$id = $_GPC['fl_id'];
		   
			$item = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_jfenl")." where fl_id='{$id}' and uniacid='$uniacid'",array("fl_id"=>$id,"uniacid"=>$_W['uniacid']));

			if(checksubmit("submit"))
			{
				$data = array("uniacid"=>$_W['uniacid'],"j_name"=>$_GPC['j_name'],"j_thumb"=>$_GPC['j_thumb']);
				if (empty($id)) {
					pdo_insert("hyb_yl_jfenl",$data);
					message('成功', 'refresh', 'success');
				}
				else
				{
					pdo_update("hyb_yl_jfenl",$data,array("fl_id"=>$id));
					message('成功', 'refresh', 'success');
				}
			}
    		include $this->template('course/KS.CosCategory.aspx');
    		break;
        case 'delcategory':
			$id = $_GPC['fl_id'];
			pdo_delete("hyb_yl_jfenl",array("fl_id"=>$id));
			message('成功', 'refresh', 'success');
        	break;
    	case 'courseodery':

    	
    		include $this->template('course/KS.CosStats.aspx');
    		break;
    }

	