<?php 
	global $_W,$_GPC;
    $op =$_GPC['op'];
    $type_id = $_GPC['type_id'];
    switch ($op) {
    	case 'goodssite':
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename("hyb_yl_schoolroom")."where room_parentid ='{$id}' and uniacid = '{$uniacid}'");
			$pindex = max(1, intval($_GPC['page'])); 
			$pagesize = 10;
			$p = ($pindex-1) * $pagesize; 
			$products = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_schoolroom")."where room_parentid ='{$id}' and uniacid = '{$uniacid}' order by sord  limit ".$p.",".$pagesize);
			$pager = pagination($total,$pindex,$pagesize);
		    include $this->template('Shop/KS.ShopManageliebiao');
    		break;
    	
    	case 'gcategory':
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename("hyb_yl_schoolroom")."where room_parentid ='{$id}' and uniacid = '{$uniacid}'");
			$pindex = max(1, intval($_GPC['page'])); 
			$pagesize = 10;
			$p = ($pindex-1) * $pagesize; 
			$products = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_schoolroom")."where room_parentid ='{$id}' and uniacid = '{$uniacid}' order by sord  limit ".$p.",".$pagesize);
			$pager = pagination($total,$pindex,$pagesize);
		    include $this->template('Content/KS.Classfenlei.aspx');
    		break;
    	case 'funtsite':

    		include $this->template('Shop/KS.ShopConfig.Aspx');
    		break;
    		
    	case 'courseodery':

    		include $this->template('course/KS.CosStats.aspx');
    		break;
    }

	