<?php 
    
global $_W,$_GPC;
$_W['plugin'] = 'apply';
require_once dirname(__FILE__) .'/Data/pdo.class.php';
require_once(IA_ROOT.'/addons/hyb_yl/class/pinyin.php');
$model = new Model('servicemenu');
$uniacid =$_W['uniacid'];
$type_id = $_GPC['type_id'];
$list_all = $model->where('type=0 and uniacid="'.$uniacid.'"')->getall();
$tese_all = $model->where('type=1 and uniacid="'.$uniacid.'"')->getall();
$o  = '';
$o_t="";

$op = !empty($_GPC['op']) ? $_GPC['op'] : 'apply';
if($op =='apply'){
	foreach ($list_all AS $key => $parent) {
		$url =$this->createWebUrl('apply',array('val'=>'add','sid'=>$parent['sid']));
		$o.= "<div style=\"position: relative;\" class=\"col-md-3\" data-index=".$key."> ";
		$o.= "<div class=\"quan1\">";
		$o.= "<div class=\"quan1_top\">";
		$o.= "<div class=\"quan1_top_t\">";
		$o.= "<div class=\"quan1_img\">";
		$o.= "<img src=".$_W['attachurl'].$parent['thumb'].">";
		$o.= "</div>";
		$o.= "<div class=\"quan1_text\">";
		$o.= "<p>".$parent['name']."</p>";
		$o.= "<p><span style=\"color:#35a7ba;\"></span>".$parent['subtitle']."</p>";
		$o.= "<p class=\"quan1_top_b\">";
		$o.= "</p>";
		$o.= "</div>";
		$o.= "<div class=\"quan1_btn\">";
		$o.= "<a href=".$url." class=\"js-delete btn btn-success btn-sm jiaanniu\" data-index=".$key."  data-id=".$parent['sid'].">修改</a>";
		$o.= "<a href=\"{php echo $this->createWebUrl('apply',array('val'=>'del'));}\" class=\"js-delete btn btn-danger btn-sm jiaanniu\" data-index=".$key."  data-id=".$parent['sid'].">删除</a>";
		$o.= "</div>";
		$o.= "</div>";
		$o.= "</div>";
		$o.= "</div>";
		$o.= "</div>";
	}
	foreach ($tese_all AS $key => $parent) {
		$url =$this->createWebUrl('apply',array('val'=>'add','sid'=>$parent['sid']));
		$o_t.= "<div style=\"position: relative;\" class=\"col-md-3\" data-index=".$key."> ";
		$o_t.= "<div class=\"quan1\">";
		$o_t.= "<div class=\"quan1_top\">";
		$o_t.= "<div class=\"quan1_top_t\">";
		$o_t.= "<div class=\"quan1_img\">";
		$o_t.= "<img src=".$_W['attachurl'].$parent['thumb'].">";
		$o_t.= "</div>";
		$o_t.= "<div class=\"quan1_text\">";
		$o_t.= "<p>".$parent['name']."</p>";
		$o_t.= "<p><span style=\"color:#35a7ba;\"></span>".$parent['subtitle']."</p>";
		$o_t.= "<p class=\"quan1_top_b\">";
		$o_t.= "</p>";
		$o_t.= "</div>";
		$o_t.= "<div class=\"quan1_btn\">";
		$o_t.= "<a href=".$url." class=\"js-delete btn btn-success btn-sm jiaanniu\" data-index=".$key."  data-id=".$parent['sid'].">修改</a>";
		$o_t.= "<a href=\"{php echo $this->createWebUrl('apply',array('val'=>'del'));}\" class=\"js-delete btn btn-danger btn-sm jiaanniu\" data-index=".$key."  data-id=".$parent['sid'].">删除</a>";
		$o_t.= "</div>";
		$o_t.= "</div>";
		$o_t.= "</div>";
		$o_t.= "</div>";
		$o_t.= "</div>";
	}
	include $this->template('apply/apply');
}

if($op=='add'){
	$sid = $_GPC['sid'];
	$res = $model->where("sid='".$sid."'")->get();
	if($_W['ispost']){
      $data =array(
           'uniacid' => $uniacid,
           'name'    => $_GPC['name'],
           'thumb'   => $_GPC['thumb'],
           'desc'    => $_GPC['desc'],
           'subtitle'=> $_GPC['subtitle'],
           'tishi'   => $_GPC['tishi'],
           'tiaokuan'=> $_GPC['tiaokuan'],
      	);
      if(empty($res)){
          $model->add($data);
      }else{
      	  $model->where("sid='".$sid."'")->save($data);
      	  message('成功', 'refresh', 'success');
      }
	}
    include $this->template('apply/add'); 
}
//动态列表
if($op == 'dynamiclist')
{
	//查询所有动态
	$suoyoudongtai_num = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_share")." WHERE uniacid=:uniacid ",array(":uniacid"=>$uniacid));
	//查询待审核动态
	$daishenhedongtai_num = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_share")." WHERE uniacid=:uniacid and type=0 ",array(":uniacid"=>$uniacid));
	//查询显示中动态
	$xianshizhongdongtai_num = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_share")." WHERE uniacid=:uniacid and share_tj=1 ",array(":uniacid"=>$uniacid));

	$status = !empty($_GPC['status'])?$_GPC['status']:'0';
	$WHEREsql = " WHERE s.uniacid=:uniacid ";
	$WHEREdata[':uniacid'] = $uniacid;
	if ($status=='1') {
		$WHEREsql .= " and s.type=0 ";
	}
	if ($status=='2') {
		$WHEREsql .= " and s.share_tj=1 ";
	}
	$keywordtype = !empty($_GPC['keywordtype'])?$_GPC['keywordtype']:'';
	if (!empty($keywordtype)) {
		$keyword = trim($_GPC['keyword']);
		if ($keywordtype=='1') {
			$WHEREsql .= " and s.contents like :keyword ";
			$WHEREdata[':keyword'] = "%" . $keyword . "%";
		}
		if ($keywordtype=='2') {
			$WHEREsql .= " and c.name like :keyword ";
			$WHEREdata[':keyword'] = "%" . $keyword . "%";
		}
		if ($keywordtype=='3') {
			$WHEREsql .= " and (m.u_name like :keyword or s.virtual_name like :keyword) ";
			$WHEREdata[':keyword'] = "%" . $keyword . "%";
		}
	}
	$looktype = !empty($_GPC['looktype'])?$_GPC['looktype']:"";
	if (!empty($looktype)) {
		if ($looktype=='1') {
			$WHEREsql .= " and s.doctor_visible=0 ";
		}
		if ($looktype=='2') {
			$WHEREsql .= " and s.doctor_visible=1 ";
		}
	}
	$timetype = !empty($_GPC['timetype'])?$_GPC['timetype']:"";
	if (empty($timetype)) {
		$starttime = date("Y-m-d",strtotime('-1 month'));
		$endtime = date("Y-m-d",time());
	}else{
		$starttime = $_GPC['time_limit']['start'];
		$endtime = $_GPC['time_limit']['end'];
		if (!empty($starttime)  && !empty($endtime)) {
			$WHEREsql.= " and s.times >= :starttime and s.times <= :endtime ";
			$WHEREdata[':starttime'] = strtotime($_GPC['time_limit']['start']);
			$WHEREdata[':endtime'] = strtotime($_GPC['time_limit']['end']);
		}
	}

	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=10;
	$listsql = "SELECT c.id as categoryid,c.name as categoryname,m.openid as u_openid,m.u_thumb,m.u_name,s.* FROM ".tablename("hyb_yl_share")." as s left join ".tablename("hyb_yl_share_category")." as c on s.labelid=c.id left join ".tablename("hyb_yl_userinfo")." as m on s.openid=m.openid ".$WHEREsql;

	$list = pdo_fetchall($listsql." order by s.times desc  LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize,$WHEREdata);
	
	$totalsql = "SELECT count(*) FROM ".tablename("hyb_yl_share")." as s left join ".tablename("hyb_yl_share_category")." as c on s.labelid=c.id left join ".tablename("hyb_yl_userinfo")." as m on s.openid=m.openid ";
	$total = pdo_fetchcolumn($totalsql.$WHEREsql,$WHEREdata);
	$pagers = pagination($total, $pageindex, $pagesize);

	if (!empty($list)) {
		foreach ($list as &$value) {
			if ($value['user_identity']=='2') {
				$value['u_name'] = $value['virtual_name'];
				$value['u_thumb'] = $_W['attachurl'].$value['virtual_thumb'];
			}

			//查询评论数
			$pinglunnum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_pinglunsite")." WHERE uniacid=:uniacid and a_id=:a_id and parentid=0 ",array(":uniacid"=>$uniacid,":a_id"=>$value['a_id']));
            $value['pinglunnum'] = $pinglunnum;	

		}
	}

	include $this->template("apply/dynamiclist");
}
//添加动态列表
if($op == 'dynamiclistadd')
{
	$subcatess = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_share_category")." WHERE uniacid=:uniacid  order by sortid desc  ",array(":uniacid"=>$uniacid));
	$parentpfxm = array();  
	$childrenpfxm = array();  
	if (!empty($subcatess)) {  
		foreach ($subcatess as $cidpfxm => $catepfxm) {  
			if (!empty($catepfxm['paretid'])) {  
				$childrenpfxm[$catepfxm['paretid']][] = $catepfxm;  
			} else {  
				$parentpfxm[$catepfxm['id']] = $catepfxm;  
			}  
		}
	} 

	$a_id = $_GPC['a_id'];
	$item = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_share")." WHERE uniacid=:uniacid and a_id=:a_id ",array(":uniacid"=>$uniacid,":a_id"=>$a_id));

	if (!empty($item)) {
		//查询分类
		$childrencategory = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_share_category")." WHERE uniacid=:uniacid and paretid!=0 and id=:id ",array(":uniacid"=>$uniacid,":id"=>$item['labelid']));
		$item['childrenid'] = $childrencategory['id'];
		//查询父级分类
		$paretcategory = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_share_category")." WHERE uniacid=:uniacid and paretid=0 and id=:id ",array(":uniacid"=>$uniacid,":id"=>$childrencategory['paretid']));
		$item['parentid'] = $paretcategory['id'];
		$item['sharepic'] = unserialize($item['sharepic']);
		if (!empty($item['sharepic'])) {
			foreach ($item['sharepic'] as &$simg) {
				if (strpos($simg,"http")===false) {
			        $simg = $_W['attachurl'].$simg;
			        $virtual_time = date("Y-m-d",$item['times']);
			    }
			}	
		}
		if ($item['user_identity']=='0') {
			//查询普通用户
			$userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$item['openid']));
			$item['uname'] = $userinfo['u_name'];
		}
		if ($item['user_identity']=='1') {
			//查询专家
			$zhuanjiainfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$item['openid']));
			$item['zname'] = $zhuanjiainfo['z_name'];
		}

	}else{
		$virtual_time = date("Y-m-d",time());
	}

	if($_W['ispost']){
		$data['uniacid'] = $uniacid;
		if ($_GPC['user_identity'] == '0') {
			$data['openid'] = $_GPC['uopenid'];
		}
		if ($_GPC['user_identity']=='1') {
			$data['openid'] = $_GPC['zopenid'];
			$data['doctor_visible'] = $_GPC['doctor_visible'];
		}
		if ($_GPC['user_identity']=='2' ) {
			$data['virtual_thumb'] = $_GPC['virtual_thumb'];
			$data['virtual_name'] = $_GPC['virtual_name'];
		}
		$data['user_identity'] = $_GPC['user_identity'];
		$data['state'] = $_GPC['user_identity'];
        $data['sharepic'] = serialize($_GPC['virtual_sharepic']);
       	$data['contents'] = $_GPC['virtual_contents'];
       	$data['labelid'] = $_GPC['category_name']['childid'];
    	$data['times'] = strtotime($_GPC['virtual_time']);
    	$data['dianj'] = trim($_GPC['virtual_likes']);
    	$data['virtual_accesses'] = trim($_GPC['virtual_accesses']);

        $data['type'] = $_GPC['type'];
        $data['share_tj'] = $_GPC['share_tj'];
        if (empty($item)) {
        	$res = pdo_insert("hyb_yl_share",$data);
        }else{
        	$res = pdo_update("hyb_yl_share",$data,array("a_id"=>$a_id));
        }
    	
    	if ($res) {
	    	message('编辑成功!', $this->createWebUrl('apply', array('ac'=>'dynamiclist','op'=>'dynamiclist')), 'success');
	    }else{
	    	message('编辑失败!', $this->createWebUrl('apply', array('ac'=>'dynamiclist','op'=>'dynamiclistadd')), 'error');
	    }
	}
	include $this->template("apply/dynamiclistadd");
}
if ($op == "dynamiclistsaveshenhe") {
	$a_id = $_GPC['a_id'];
	$res = pdo_update("hyb_yl_share",array("type"=>"1"),array("a_id"=>$a_id));
	if ($res) {
	    message('操作成功!', $this->createWebUrl('apply', array('ac'=>'dynamiclist','op'=>'dynamiclist')), 'success');
	}else{
	    message('操作失败!', $this->createWebUrl('apply', array('ac'=>'dynamiclist','op'=>'dynamiclist')), 'error');
	}
}
if ($op == "dynamiclistsavetuijian") {
	$a_id = $_GPC['a_id'];
	$res = pdo_update("hyb_yl_share",array("share_tj"=>"1"),array("a_id"=>$a_id));
	if ($res) {
	    message('操作成功!', $this->createWebUrl('apply', array('ac'=>'dynamiclist','op'=>'dynamiclist')), 'success');
	}else{
	    message('操作失败!', $this->createWebUrl('apply', array('ac'=>'dynamiclist','op'=>'dynamiclist')), 'error');
	}
}
if ($op == "dynamiclistsavedelete") {
	$a_id = $_GPC['a_id'];
	$res = pdo_delete("hyb_yl_share",array("a_id"=>$a_id));
	if ($res) {
	    message('操作成功!', $this->createWebUrl('apply', array('ac'=>'dynamiclist','op'=>'dynamiclist')), 'success');
	}else{
	    message('操作失败!', $this->createWebUrl('apply', array('ac'=>'dynamiclist','op'=>'dynamiclist')), 'success');
	}
}
if ($op == "dynamiclistsave_pldelete") {
	for($i=0;$i<count($_GPC['ids']);$i++)
	{
		pdo_delete('hyb_yl_share',array('a_id' =>$_GPC['ids'][$i]));
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
	// message('操作成功!', $this->createWebUrl('apply', array('ac'=>'dynamiclist','op'=>'dynamiclist')), 'success');
}
if ($op == "dynamiclistsave_plshenhetg") {
	for($i=0;$i<count($_GPC['ids']);$i++)
	{
		pdo_update('hyb_yl_share',array("type"=>"1"),array('a_id' =>$_GPC['ids'][$i]));
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
}
if ($op == "dynamiclistsave_plnoshenhetg") {
	for($i=0;$i<count($_GPC['ids']);$i++)
	{
		pdo_update('hyb_yl_share',array("type"=>"0"),array('a_id' =>$_GPC['ids'][$i]));
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
}
if ($op == "dynamiclistsave_pltuijian") {
	for($i=0;$i<count($_GPC['ids']);$i++)
	{
		pdo_update('hyb_yl_share',array("share_tj"=>"1"),array('a_id' =>$_GPC['ids'][$i]));
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
}
if ($op == "dynamiclistsave_plnotuijian") {
	for($i=0;$i<count($_GPC['ids']);$i++)
	{
		pdo_update('hyb_yl_share',array("share_tj"=>"0"),array('a_id' =>$_GPC['ids'][$i]));
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
}
//查看评论列表
if($op == 'dynamicpllist')
{
	$a_id = $_GPC['a_id'];

	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=10;

	$WHEREsql = "  WHERE uniacid=:uniacid and a_id=:a_id and parentid=0  ";
	$WHEREdata[':uniacid'] = $uniacid;
	$WHEREdata[':a_id'] = $a_id;
	$keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
	if (!empty($keyword)) {
		$WHEREsql.= " and name like '%$keyword%' ";
	}
	$timetype = !empty($_GPC['timetype'])?$_GPC['timetype']:"";
	if (empty($timetype)) {
		$starttime = date("Y-m-d",strtotime('-1 month'));
		$endtime = date("Y-m-d",time());
	}else{
		$starttime = $_GPC['time_limit']['start'];
		$endtime = $_GPC['time_limit']['end'];
		if (!empty($starttime)  && !empty($endtime)) {
			$WHEREsql.= " and pl_time >= :starttime and pl_time <= :endtime ";
			$WHEREdata[':starttime'] = strtotime($_GPC['time_limit']['start']);
			$WHEREdata[':endtime'] = strtotime($_GPC['time_limit']['end']);
		}
	}

	$list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_pinglunsite").$WHEREsql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize,$WHEREdata);
	$total = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_pinglunsite").$WHEREsql,$WHEREdata);
	$pagers = pagination($total, $pageindex, $pagesize);
	if (!empty($list)) {
		foreach ($list as &$value) {
			$value['pl_text'] = unserialize($value['pl_text']);
			$value['rcontent'] =$value['pl_text']['rcontent'];
			if (strpos($value['usertoux'],"http")===false) {
				$value['usertoux'] = $_W['attachurl'].$value['usertoux'];
			}
			if($value['user_identity']=='1'){
				//查询专家
                $zhuanjiainfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$value['useropenid']));
				//查询专家所在机构
                $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital_diction")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['hid']));
                //查询专家职称
                $zhuanjiazhichen = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['z_zhicheng']));
                $value['zhuanjia_jigou_info'] = $zhuanjiajigou['name'];
                $value['zhuanjia_zhichen_info'] = $zhuanjiazhichen['job_name'];
			}
			//查询回复
			$huifunum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_pinglunsite")." WHERE uniacid=:uniacid and a_id=:a_id and parentid=:parentid ",array(":uniacid"=>$uniacid,":a_id"=>$value['a_id'],":parentid"=>$value['pl_id']));
			$value['huifunum'] = $huifunum;
		}
	}

	include $this->template("apply/dynamicpllist");
}
//回复列表
if ($op == "dynamicpllist_hflist") {
	$a_id = $_GPC['a_id'];
	$pl_id = $_GPC['pl_id'];
	//查询回复
	$huifulist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_pinglunsite")." WHERE uniacid=:uniacid and a_id=:a_id and parentid=:parentid order by pl_id desc ",array(":uniacid"=>$uniacid,":a_id"=>$a_id,":parentid"=>$pl_id));
	if (!empty($huifulist)) {
		foreach ($huifulist as &$value) {
			$value['pl_text'] = unserialize($value['pl_text']);
			$value['rcontent'] =$value['pl_text']['rcontent'];
			if (strpos($value['usertoux'],"http")===false) {
				$value['usertoux'] = $_W['attachurl'].$value['usertoux'];
			}
			if($value['user_identity']=='1'){
				//查询专家
                $zhuanjiainfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$value['useropenid']));
				//查询专家所在机构
                $zhuanjiajigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital_diction")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['hid']));
                //查询专家职称
                $zhuanjiazhichen = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_job")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$zhuanjiainfo['z_zhicheng']));
                $value['zhuanjia_jigou_info'] = $zhuanjiajigou['name'];
                $value['zhuanjia_zhichen_info'] = $zhuanjiazhichen['job_name'];
			}
		}
	}
	include $this->template("apply/dynamicpllist_hflist");
}
//评论删除
if($op == "dynamicpllist_delete"){
	$pl_id = $_GPC['pl_id'];
	$a_id = $_GPC['a_id'];
	$res = pdo_delete("hyb_yl_pinglunsite",array("pl_id"=>$pl_id));
	if ($res) {
	    message('操作成功!', $this->createWebUrl('apply', array('ac'=>'dynamiclist','op'=>'dynamicpllist','a_id'=>$a_id)), 'success');
	}else{
	    message('操作失败!', $this->createWebUrl('apply', array('ac'=>'dynamiclist','op'=>'dynamicpllist','a_id'=>$a_id)), 'error');
	}
}
if ($op == "dynamiclistsave_pass_pldelete") {
	for($i=0;$i<count($_GPC['ids']);$i++)
	{
		pdo_delete('hyb_yl_pinglunsite',array('pl_id' =>$_GPC['ids'][$i]));
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
}
//客服列表
if($op == 'servicelist')
{
	include $this->template("apply/servicelist");
}
 //板块分类
if($op == 'dynamicltype')
{	
	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=10;
	$dynamicltype_list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_share_category")." WHERE uniacid=:uniacid and paretid=0 order by sortid desc LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize,array(":uniacid"=>$uniacid));
	$total=pdo_fetchcolumn("SELECT count(*) FROM " . tablename("hyb_yl_share_category")." WHERE uniacid=:uniacid and paretid=0".$WHERE,array(":uniacid"=>$uniacid));
	$pager = pagination($total, $pageindex, $pagesize);
	if (!empty($dynamicltype_list)) {
		foreach ($dynamicltype_list as &$value) {
			$subordinate_list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_share_category")." WHERE uniacid=:uniacid and paretid=:paretid ",array(":uniacid"=>$uniacid,":paretid"=>$value['id']));
			$value['subordinate_list'] = $subordinate_list;
		}
	}
	include $this->template("apply/dynamicltype");
} 
 //添加板块分类
if($op == 'dynamicltypeadd')
{
	$id = $_GPC['id'];
	$item = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_share_category")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$id));
	if($_W['ispost']){
        $data['uniacid'] = $uniacid;
        $data['sortid'] = trim($_GPC['sortid']);
        $data['name'] = trim($_GPC['name']);
        $data['describe'] = trim($_GPC['describe']);
        $data['thumb'] = $_GPC['thumb'];
        $data['recommend'] = trim($_GPC['recommend']);
        $data['enabled'] = $_GPC['enabled'];
		// $data['category_abroad'] = trim($_GPC['category_abroad']);
	    if(empty($item)){
	    	$data['paretid'] = $_GPC['paretid'];
	        $res = pdo_insert("hyb_yl_share_category",$data);
	    }else{
	      	$res = pdo_update("hyb_yl_share_category",$data,array('id'=>$id));
	    }
	    if ($res) {
	    	message('编辑成功!', $this->createWebUrl('apply', array('ac'=>'dynamicltype','op'=>'dynamicltype')), 'success');
	    }else{
	    	message('编辑失败!', $this->createWebUrl('apply', array('ac'=>'dynamicltype','op'=>'dynamicltypeadd')), 'success');
	    }
	}
	include $this->template("apply/dynamicltypeadd");
} 
if ($op == "dynamicltypedel") {
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_share_category",array("id"=>$id));
	if ($res) {
    	message('删除成功!', $this->createWebUrl('apply', array('ac'=>'dynamicltype','op'=>'dynamicltype')), 'success');
    }else{
    	message('删除失败!', $this->createWebUrl('apply', array('ac'=>'dynamicltype','op'=>'dynamicltype')), 'success');
    }
}
 //动态设置
if($op == 'dynamicsys')
{
	$item = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_share_setting")." WHERE uniacid=:uniacid ",array(":uniacid"=>$uniacid));
	if($_W['ispost']){
		$data['uniacid'] = $uniacid;
		$data['is_shenhe'] = $_GPC['is_shenhe'];
		$data['is_status'] = $_GPC['is_status'];

		if (empty($item)) {
			$res = pdo_insert("hyb_yl_share_setting",$data);
		}else{
			$res = pdo_update("hyb_yl_share_setting",$data,array("id"=>$item['id']));
		}
		if ($res) {
	    	message('编辑成功!', $this->createWebUrl('apply', array('ac'=>'dynamicsys','op'=>'dynamicsys')), 'success');
	    }else{
	    	message('编辑失败!', $this->createWebUrl('apply', array('ac'=>'dynamicsys','op'=>'dynamicsys')), 'success');
	    }
	}
	include $this->template("apply/dynamicsys");
} 
 //文字设置
if($op == 'characters')
{
	$item = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_share_setting")." WHERE uniacid=:uniacid ",array(":uniacid"=>$uniacid));
	if($_W['ispost']){
		$data['uniacid'] = $uniacid;
		$data['newfeed'] = $_GPC['newfeed'];
		$data['hotfeed'] = $_GPC['hotfeed'];
		if (empty($item)) {
			$res = pdo_insert("hyb_yl_share_setting",$data);
		}else{
			$res = pdo_update("hyb_yl_share_setting",$data,array("id"=>$item['id']));
		}
		if ($res) {
	    	message('编辑成功!', $this->createWebUrl('apply', array('ac'=>'characters','op'=>'characters')), 'success');
	    }else{
	    	message('编辑失败!', $this->createWebUrl('apply', array('ac'=>'characters','op'=>'characters')), 'success');
	    }
	}
	include $this->template("apply/characters");
} 
 //导诊列表
if($op == 'guidance')
{
	include $this->template("apply/guidance");
} 
 //职务职称
if($op == 'professional')
{
	include $this->template("apply/professional");
} 
 //活动管理
if($op == 'activity')
{
	include $this->template("apply/activity");
} 
 //赠礼记录
if($op == 'acrecord')
{
	include $this->template("apply/acrecord");
} 
 //卡券列表
if($op == 'couponlist')
{
	$newtime = date("Y-m-d",time());
	$listtype = !empty($_GPC['listtype'])?$_GPC['listtype']:"0";
	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=20;

	$keywordtype = !empty($_GPC['keywordtype'])?$_GPC['keywordtype']:"";
	$keyword  = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
	$wherecontion = " WHERE c.uniacid=:uniacid ";
	$wheredata[':uniacid'] = $uniacid;
	if (!empty($listtype)) {
		if ($listtype=='1') {
			$wherecontion .= " and c.state=:state";
			$wheredata[':state'] = "0";
		}
		if ($listtype=='2') {
			$wherecontion .= " and c.state=:state";
			$wheredata[':state'] = "1";
		}
		if ($listtype=='3') {
			$wherecontion .= " and c.endtime>:endtime";
			$wheredata[':endtime'] = $newtime;
		}
	}
	if (!empty($keywordtype)) {
		if ($keywordtype=='1' && !empty($keyword)) {
			$wherecontion .= " and c.title like  :keyword";
		}
		if ($keywordtype=='2' && !empty($keyword)) {
			$wherecontion .= " and h.agentname like  :keyword";
		}
        $wheredata[':keyword'] = '%'.$keyword.'%';
	}	
	$timetype = !empty($_GPC['timetype'])?$_GPC['timetype']:"";
	if (empty($timetype)) {
		$starttime = date("Y-m-d",strtotime('-1 month'));
		$endtime = date("Y-m-d",time());
	}else{
		$starttime = $_GPC['time_limit']['start'];
		$endtime = $_GPC['time_limit']['end'];
		if (!empty($starttime)  && !empty($endtime)) {
			$wherecontion .= " and c.starttime >= :starttime and c.endtime <= :endtime ";
			$wheredata[':starttime'] = $_GPC['time_limit']['start'];
			$wheredata[':endtime'] = $_GPC['time_limit']['end'];
		}
	}

	$list = pdo_fetchall("SELECT c.*,h.agentname,h.hid FROM ".tablename("hyb_yl_coupon")." as c left join ".tablename("hyb_yl_hospital")." as h on h.hid=c.hid  ".$wherecontion." order by c.sortorder desc LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize,$wheredata);
	$total = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_coupon")." as c left join ".tablename("hyb_yl_hospital")." as h on h.hid=c.hid  ".$wherecontion,$wheredata);
	$pagers = pagination($total, $pageindex, $pagesize);
	if (!empty($list)) {
		foreach ($list as &$value) {
			if (!empty($value['agentname'])) {
				$value['jigouname'] = $value['agentname'];
			}else{
				$value['jigouname'] = "无";
			}

			//查询适用服务
	         $shiyongfuwuid = $value['applicableservices'];
	         $shiyongfuwu = pdo_fetchall("SELECT titlme FROM ".tablename("hyb_yl_docser_speck")." WHERE uniacid=:uniacid and id in($shiyongfuwuid)",array(":uniacid"=>$uniacid));
	         if (!empty($shiyongfuwu)) {
	         	foreach ($shiyongfuwu as &$ssfw) {
	         		$shiyongfuwuname[] = $ssfw['titlme'];
	         	}
	         
	         	$value['shiyongfuwu'] = implode("、", $shiyongfuwuname);
	         }else{
	         	$value['shiyongfuwu'] = '无';
	         }


	         //查询库存 已兑换
	         $couponcode_countnum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_coupon_code")." WHERE uniacid=:uniacid and cid=:cid",array(":uniacid"=>$uniacid,":cid"=>$value['id']));
	         $couponcode_duihuantnum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_coupon_code")." WHERE uniacid=:uniacid and cid=:cid and status=2 ",array(":uniacid"=>$uniacid,":cid"=>$value['id']));
	         $value['couponcode_countnum'] = $couponcode_countnum;
	         $value['couponcode_duihuantnum'] = $couponcode_duihuantnum;
	         
		}
	}

	//全部
	$countnum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_coupon")." WHERE uniacid=:uniacid ",array(":uniacid"=>$uniacid));
	//启用
	$qiyongnum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_coupon")." WHERE uniacid=:uniacid and state=0",array(":uniacid"=>$uniacid));
	//禁用
	$jinyongnum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_coupon")." WHERE uniacid=:uniacid and state=1",array(":uniacid"=>$uniacid));
	//已过期
	$guoqinum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_coupon")." WHERE uniacid=:uniacid and endtime<:newtime",array(":uniacid"=>$uniacid,":newtime"=>$newtime));

	include $this->template("apply/couponlist");
}
 //卡券添加
if($op == 'couponadd')
{
	$id = $_GPC['id'];
	$item = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_coupon")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$id));
	//机构
	$jigou = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." where uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$item['hid']));
	$item['hname'] = $jigou['agentname'];
	//适用服务
	$item['applicableservices'] = explode(",", $item['applicableservices']);


	//查询适用服务
	$shiyongfuwu = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_docser_speck")." WHERE uniacid=:uniacid ",array(":uniacid"=>$uniacid));
	if($_W['ispost']){
		$data['uniacid'] = $uniacid;
		$data['sortorder'] = intval($_GPC['sortorder']);
		$data['title'] = trim($_GPC['title']);
		$data['hid'] = $_GPC['hid'];
		// $data['usagetype'] = $_GPC['usagetype'];
		// $data['daily'] = trim($_GPC['daily']);
		// $data['first'] = trim($_GPC['first']);

		$data['deductible_amount'] = trim($_GPC['deductible_amount']);

		$data['sub_title'] = $_GPC['sub_title'];
		$data['applicableservices'] = implode(",",$_GPC['applicableservices']);
		$data['starttime'] = $_GPC['time']['start'];
		$data['endtime'] = $_GPC['time']['end'];
		$data['state'] = $_GPC['state'];
		if (empty($id)) {
			$res = pdo_insert("hyb_yl_coupon",$data);
		}else{
			$res = pdo_update("hyb_yl_coupon",$data,array("id"=>$id));
		}
		if ($res) {
	    	message('编辑成功!', $this->createWebUrl('apply', array('ac'=>'couponlist','op'=>'couponlist')), 'success');
	    }else{
	    	message('编辑失败!', $this->createWebUrl('apply', array('ac'=>'couponadd','op'=>'couponadd')), 'error');
	    }
 	}
	include $this->template("apply/couponadd");
}
//卡券删除
if ($op == "coupondel") {
	$id = $_GPC['id'];
	//查询卡券激活码
	$list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_coupon_code")." WHERE uniacid=:uniacid and cid=:cid " ,array(":uniacid"=>$uniacid,":cid"=>$id));
	if (!empty($list)) {
		foreach ($list as &$value) {
			pdo_delete("hyb_yl_coupon_code",array("id"=>$value['id']));
		}
	}
	$res = pdo_delete("hyb_yl_coupon",array("id"=>$id));
	if ($res) {
    	message('删除成功!', $this->createWebUrl('apply', array('ac'=>'couponlist','op'=>'couponlist')), 'success');
    }else{
    	message('删除失败!', $this->createWebUrl('apply', array('ac'=>'couponlist','op'=>'couponlist')), 'error');
    }
}
if ($op == "couponlist_pass_pldelete") {
	for($i=0;$i<count($_GPC['ids']);$i++)
	{
		pdo_delete('hyb_yl_coupon',array('id' =>$_GPC['ids'][$i]));
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
}
//激活码列表
if ($op == "couponchangecode") {
	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=20;

	$status = !empty($_GPC['status'])?$_GPC['status']:"0";
	$keywordtype = !empty($_GPC['keywordtype'])?$_GPC['keywordtype']:"";
	$keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";

	$wherecontion = " WHERE u.uniacid=:uniacid ";
	$wheredata[':uniacid'] = $uniacid;
	if ($status=='1') {
		$wherecontion .= " and c.status=2";
	}
	if ($status=='2') {
		$wherecontion .= " and c.status!=2";
	}
	if (!empty($keywordtype)) {
		if ($keywordtype=='1' && !empty($keyword)) {
			$wherecontion .= " and c.code like  :keyword";
		}
		if ($keywordtype=='2' && !empty($keyword)) {
			$wherecontion .= " and u.title like  :keyword";
		}
        $wheredata[':keyword'] = '%'.$keyword.'%';
	}

	$list = pdo_fetchall("SELECT c.*,u.title FROM ".tablename("hyb_yl_coupon_code")." as c left join ".tablename("hyb_yl_coupon")." u  on c.cid=u.id ".$wherecontion." order by c.createtime desc LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize,$wheredata);
	$total = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_coupon_code")." as c left join ".tablename("hyb_yl_coupon")." u  on c.cid=u.id ".$wherecontion,$wheredata);
	$pagers = pagination($total, $pageindex, $pagesize);

	if (!empty($list)) {
		foreach ($list as &$value) {
			$value['coupon_name'] = $value['title'];
		}
	}
	include $this->template("apply/couponchangecode");
}
//添加激活码
if ($op == "addcouponchangecode") {
	$couponlist =  pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_coupon")." WHERE uniacid=:uniacid order by sortorder desc ",array(":uniacid"=>$uniacid));
	if($_W['ispost']){
		$num = $_GPC['num'];
	   	$str = "0123456789qwertyuiopasdfghjklzxcvbnm";
	   	$prefix = $_GPC['prefix'];
	   	$mb_strlen =  mb_strlen($prefix,'UTF8');
	   	$lec = 10 - $mb_strlen;
	    for($i=0;$i<$num;$i++){
	    	$data['uniacid'] = $uniacid;
	    	$data['cid'] = $_GPC['cid'];
    		$data['code'] = $prefix.substr(str_shuffle($str) , 0 ,$lec);
    		$data['createtime'] = date("Y-m-d H:i:s",time());
    		pdo_insert("hyb_yl_coupon_code",$data);
	    }
	    message('编辑成功!', $this->createWebUrl('apply', array('ac'=>'addcouponchangecode','op'=>'addcouponchangecode')), 'success');
	}
	include $this->template("apply/addcouponchangecode");
}
//激活码删除
if ($op == "delcouponchangecode") {
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_coupon_code",array("id"=>$id));
	if ($res) {
    	message('删除成功!', $this->createWebUrl('apply', array('ac'=>'couponchangecode','op'=>'couponchangecode')), 'success');
    }else{
    	message('删除失败!', $this->createWebUrl('apply', array('ac'=>'couponchangecode','op'=>'couponchangecode')), 'error');
    }
}
if ($op == "couponchangecode_pass_pldelete") {
	
	for($i=0;$i<count($_GPC['ids']);$i++)
	{
		pdo_delete('hyb_yl_coupon_code',array('id' =>$_GPC['ids'][$i]));
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
}
 //领取记录
if($op == 'couponrecord')
{

	$keywordtype = !empty($_GPC['keywordtype'])?$_GPC['keywordtype']:"";
	$keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
	$status = !empty($_GPC['status'])?$_GPC['status']:"0";

	$wherecontion = " WHERE uc.uniacid=:uniacid ";
	$wheredata[':uniacid'] = $uniacid;
	if ($status=='1') {
		$wherecontion .= " and uc.status=1";
	}
	if ($status=='2') {
		$wherecontion .= " and uc.status!=1";
	}
	if (!empty($keywordtype)) {
		if ($keywordtype=='1' && !empty($keyword)) {
			$wherecontion .= " and c.title like  :keyword";
		}
		if ($keywordtype=='2' && !empty($keyword)) {
			$wherecontion .= " and u.u_name like  :keyword";
		}
        $wheredata[':keyword'] = '%'.$keyword.'%';
	}
	$timetype = !empty($_GPC['timetype'])?$_GPC['timetype']:"";
	if (empty($timetype)) {
		$starttime = date("Y-m-d",strtotime('-1 month'));
		$endtime = date("Y-m-d",time());
	}else{
		$starttime = $_GPC['time_limit']['start'];
		$endtime = $_GPC['time_limit']['end'];
		if (!empty($starttime)  && !empty($endtime)) {
			$wherecontion .= " and uc.createtime >= :starttime and uc.createtime <= :endtime ";
			$wheredata[':starttime'] = $_GPC['time_limit']['start'];
			$wheredata[':endtime'] = $_GPC['time_limit']['end'];
		}
	}

	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=100;
	$list = pdo_fetchall("SELECT uc.*,u.u_name,u.u_thumb,c.title,c.hid,c.usagetype FROM ".tablename("hyb_yl_user_coupon")." as uc left join ".tablename("hyb_yl_coupon")." as c on c.id=uc.coupon_id left join ".tablename("hyb_yl_userinfo")." as u on u.openid=uc.openid ".$wherecontion.' order by uc.createtime desc LIMIT ' .($pageindex - 1) * $pagesize.",".$pagesize,$wheredata);
	$total = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_user_coupon")." as uc left join ".tablename("hyb_yl_coupon")." as c on c.id=uc.coupon_id left join ".tablename("hyb_yl_userinfo")." as u on u.openid=uc.openid ".$wherecontion,$wheredata);
	$pagers = pagination($total, $pageindex, $pagesize);
	if (!empty($list)) {
		foreach ($list as &$value) {
			//查询所属医院
            $hospital = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." where uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$value['hid']));
            if (!empty($hospital)) {
                $value['hospital'] = $hospital['agentname'];
            }else{
                $value['hospital'] = '';
            }
            //查询适用服务
	         $shiyongfuwuid = $value['applicableservices'];
	         $shiyongfuwu = pdo_fetchall("SELECT titlme FROM ".tablename("hyb_yl_docser_speck")." WHERE uniacid=:uniacid and id in($shiyongfuwuid)",array(":uniacid"=>$uniacid));
	         if (!empty($shiyongfuwu)) {
	         	$shiyongfuwuname = [];
	         	foreach ($shiyongfuwu as &$ssfw) {
	         		$shiyongfuwuname[] = $ssfw['titlme'];
	         	}
	         
	         	$value['shiyongfuwu'] = implode("、", $shiyongfuwuname);
	         }else{
	         	$value['shiyongfuwu'] = '无';
	         }
		}
	}
	
	include $this->template("apply/couponrecord");
} 
if ($op == "delcouponrecord") {
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_user_coupon",array("id"=>$id));
	if ($res) {
    	message('删除成功!', $this->createWebUrl('apply', array('ac'=>'couponrecord','op'=>'couponrecord')), 'success');
    }else{
    	message('删除失败!', $this->createWebUrl('apply', array('ac'=>'couponrecord','op'=>'couponrecord')), 'error');
    }
}
if ($op == "pldelcouponrecord") {
	
	for($i=0;$i<count($_GPC['ids']);$i++)
	{
		pdo_delete('hyb_yl_user_coupon',array('id' =>$_GPC['ids'][$i]));
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
}
 //规则设置
if($op == 'couponrule')
{
	include $this->template("apply/couponrule");
}
 //推客列表
if($op == 'spreadlist')
{
	//查询推客列表
	$type = $_GPC['type'];
	$keyword = $_GPC['keyword'];
    $where = "where a.uniacid=".$uniacid." and a.state=1";
    if(!empty($type)){
      if($type =='2'){
        $where .= " and a.tel like '%".$keyword."%'";
      }else if($type =='3'){
        $where .= " and b.u_name like '%".$keyword."%'";
      }
      else if($type =='4'){
      	$where .= " and a.username like '%".$keyword."%'";
      }
      else if($type =='5'){
      	$where .= " and a.id like '%".$keyword."%'";
      }
    }else{
        $where .="";
    }
	$res = pdo_fetchall("SELECT a.*,b.u_id,b.u_name,b.u_thumb FROM".tablename('hyb_yl_tuikesite')."as a left join".tablename('hyb_yl_userinfo')."as b on b.openid=a.openid {$where}");


    foreach ($res as $key => $value) {
    	//查询上级
		$tkid = $value['id'];
		$id = $value['tkid'];
		$res[$key]['leve_o'] = pdo_get('hyb_yl_tuikesite',array('id'=>$id));    //查询每个人的佣金
    	$res[$key]['yongjin'] =pdo_fetch("SELECT sum(`money`) as sum FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and tkid='{$tkid}' and over=1");
    	//查询下级分销商
    	$res[$key]['fenxiao'] = pdo_fetchcolumn("SELECT count(*) FROM".tablename('hyb_yl_tuikesite')."where uniacid='{$uniacid}' and tkid='{$tkid}' and id!='{$tkid}'");
    }

	include $this->template("apply/spreadlist");
} 
 //申请列表
if($op == 'spreadrecord')
{
	$uniacid = $_W['uniacid'];
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
	$res = pdo_fetchall("SELECT a.*,b.u_id,b.u_name,b.u_thumb FROM".tablename('hyb_yl_tuikesite')."as a left join".tablename('hyb_yl_userinfo')."as b on b.openid=a.openid where a.uniacid=".$uniacid." and a.state=0 order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
	$total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tuikesite")." where a.uniacid=".$uniacid." and a.state=0");
    $pager = pagination($total, $pageindex, $pagesize);

	include $this->template("apply/spreadrecord");
} 
 //规则设置
if($op == 'spreadrule')
{
    $res = pdo_get('hyb_yl_tuike_roul',array('uniacid'=>$uniacid));
    $res['slide_thumb'] = unserialize($res['slide_thumb']);
    $base = $_GPC['base'];
    $id = $_GPC['id'];
	//增加分销规则
	$data =array(
        'uniacid'=>$uniacid,
        'switch' =>$base['switch'],
        'mode' =>$base['mode'],
        'ranknum' =>$base['ranknum'],
        'levelshow' =>$base['levelshow'],
        'seetstatus' =>$base['seetstatus'],
        'slide_thumb' =>serialize($_GPC['slide_thumb']),
        'lowestmoney' =>$base['lowestmoney'],
        'frequency' =>$base['frequency'],
        'withdrawcharge' =>$base['withdrawcharge'],
        'appdis' =>$base['appdis'],
        'applymoney' =>$base['applymoney'],
        'modeonemoney' =>$base['modeonemoney'],
        'modetwomoney' =>$base['modetwomoney'],
        'examine' =>$base['examine'],
        'twoappdis' =>$base['twoappdis'],
        'twoapplymoney' =>$base['twoapplymoney'],
        'onegetmoney' =>$base['onegetmoney'],
        'twoexamine' =>$base['twoexamine'],
        'bindvip' =>$base['bindvip'],
        'lockstatus' =>$base['lockstatus'],
        'showlock' =>$base['showlock'],
        'distributor_description' =>$_GPC['distributor_description'],
        'content' => $_GPC['content'],
		);
	if($_W['ispost']){
		
		if(!empty($id)){
          pdo_update('hyb_yl_tuike_roul',$data,array('id'=>$id));
          message('更新成功!', $this->createWebUrl('apply', array('ac'=>'spreadrule','op'=>'spreadrule')), 'success');
		}else{
          pdo_insert('hyb_yl_tuike_roul',$data);
          message('添加成功!', $this->createWebUrl('apply', array('ac'=>'spreadrule','op'=>'spreadrule')), 'success');
		}

	}
	
	include $this->template("apply/spreadrule");
} 
 //佣金明细
if($op == 'commission')
{
	$uniacid = $_W['uniacid'];
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
	 $id =!empty($_GPC['id'])?$_GPC['id']:'';
	 if(empty($id)){
     //查询所有人佣金
	 $all = pdo_fetchall("SELECT a.id as aid ,a.*,b.id as bid,b.username FROM".tablename('hyb_yl_tuikeshouyi')."as a left join".tablename('hyb_yl_tuikesite')."as b on (b.id =a.tkid or b.id =a.mytkid) where a.uniacid='{$uniacid}'  order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
	 $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tuikeshouyi")." where uniacid='{$uniacid}'");
	 }else{
    	$all = pdo_fetchall("SELECT a.id as aid ,a.*,b.id as bid,b.username FROM".tablename('hyb_yl_tuikeshouyi')."as a left join".tablename('hyb_yl_tuikesite')."as b on (b.id =a.tkid or b.id =a.mytkid) where a.uniacid='{$uniacid}' and (a.tkid='{$id}' or a.mytkid ='{$id}') order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    	$total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tuikeshouyi")." where uniacid='{$uniacid}' and (tkid='{$id}' or mytkid ='{$id}')");
	 }
	
    $pager = pagination($total, $pageindex, $pagesize);
    //来源
    if($all){
    	foreach ($all as $key => $value) {
    		
    		$all[$key]['ly'] = pdo_get('hyb_yl_tuikeshouyi',array('id'=>$value['aid']),array('leixing'));
    	}
    }

	include $this->template("apply/commission");
} 

// 批量删除佣金明细
if($op == 'del_commissions')
{
	$ids = $_GPC['ids'];
    for($i=0;$i<count($ids);$i++)
    {
        pdo_delete("hyb_yl_tuikeshouyi",array("id" => $ids[$i]));
    }
    die(json_encode(array('errno'=>1,'message'=>1)));
 
}
//提现列表
if($op == 'withdraw')
{
	$row = pdo_fetchall("SELECT a.*,b.username,b.openid FROM".tablename('hyb_yl_tuike_tixian_log')."as a left join ".tablename('hyb_yl_tuikesite')."as b on b.id=a.tkid where a.uniacid='{$uniacid}'");
     //查询提现手续费
	$pricelv = pdo_get('hyb_yl_tuike_roul',array('uniacid'=>$uniacid),array('withdrawcharge'));
	$pri = floatval($pricelv['withdrawcharge']);
	foreach ($row as $key => $value) {
		$row[$key]['sjprice'] =$value['txprice']-$value['txprice']*($pri/100);
	}
	include $this->template("apply/withdraw");
} 
if($op == 'tgshenhe'){
	$id = $_GPC['id'];
	$tkid = $_GPC['tkid'];
	pdo_update('hyb_yl_tuikesite',array('state'=>1),array('uniacid'=>$uniacid,'id'=>$_GPC['id']));
	pdo_update('hyb_yl_tuikeshouyi',array('over'=>1),array('uniacid'=>$uniacid,'id'=>$_GPC['id'],'tkid'=>$tkid));
	message('更新成功!', $this->createWebUrl('apply', array('ac'=>'spreadrecord','op'=>'spreadrecord')), 'success');
}
if($op == 'tongguosh'){
	$id = $_GPC['id'];
    require_once dirname(dirname(dirname(__FILE__)))."/wxtx.php";
    $user_openid = $_GPC['openid'];
    $tx_cost = intval($_GPC['sjprice'] * 100);
    $u_name = '匿名';
    $key = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_parameter")." where uniacid=:uniacid",array(":uniacid"=>$uniacid));
        $appid = $key['appid'];   //微信公众平台的appid
        $mch_id = $key['mch_id'];  //商户号id
        $openid = $user_openid;    //用户openid
        $amount = $tx_cost;  //提现金额$money_sj
        $desc = "提现";     //企业付款描述信息
        $appkey = $key['pub_api'];   //商户号支付密钥
        $re_user_name = $u_name;   //收款用户姓名
        $Weixintx = new WeixinTx($appid,$mch_id,$openid,$amount,$desc,$appkey,$re_user_name);
        $notify_url = $Weixintx->Wxtx();
        if($notify_url['return_code']=="SUCCESS" && $notify_url['result_code']=="SUCCESS"){
            pdo_update('hyb_yl_tuike_tixian_log',array('type'=>1,'tgtime'=>date('Y-m-d H:i:s')),array('uniacid'=>$uniacid,'id'=>$_GPC['id']));
            if ($res) {
                message('确认成功', $this->createWebUrl('jsfl', array()), 'success');
            } else {
                message('失败', '', 'error');
            }
        }else{
            message($notify_url['return_msg'], '', 'error');
        }
}
if($op == 'jujuesh'){
	$id = $_GPC['id'];
	pdo_update('hyb_yl_tuike_tixian_log',array('type'=>2),array('uniacid'=>$uniacid,'id'=>$_GPC['id']));
	message('拒绝成功!', $this->createWebUrl('apply', array('ac'=>'withdraw','op'=>'withdraw')), 'success');
}
if($op == 'deleteongjin'){
	$id = $_GPC['id'];
	$res = pdo_delete('hyb_yl_tuike_tixian_log',array('uniacid'=>$uniacid,'id'=>$id));
	$tes = array(
   'status'=>1,
   'result'=>array(
      'url'=>'/index.php?c=site&a=entry&do=apply&op=withdraw&ac=withdraw&hid=&m=hyb_yl',
      'message'=>'成功'
    )
	);
echo json_encode($tes);
return false;
}
if($op =='dissysbase'){
 $test = !empty($_GPC['test'])?$_GPC['test']:'adddis';
 $_GPC['ac'] = "spreadlist";
 $row = pdo_getall('hyb_yl_tuikesite',array('uniacid'=>$uniacid));
 if($_W['ispost']){
   $data =array(
     'uniacid' =>$_W['uniacid'],
     'username'=>$_GPC['username'],
     'state'   =>1,
     'openid'  =>$_GPC['openid'],
     'addtime' =>date("Y-m-d H:i:s"),
     'source'  =>2,
     'tkid'    =>$_GPC['tkid']
   	);
   pdo_insert('hyb_yl_tuikesite',$data);
   message('添加成功!', $this->createWebUrl('apply', array('ac'=>'spreadlist','op'=>'spreadlist')), 'success');
 }
 include $this->template("jiancha/agentEdit");
}
if($op =='edittuike'){
 $id = $_GPC['id'];
 $row = pdo_getall('hyb_yl_tuikesite',array('uniacid'=>$uniacid));
 $res = pdo_get('hyb_yl_tuikesite',array('id'=>$id));
 $openid = $res['openid'];
 $res['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array('openid'=>$openid),array('u_name'));
 include $this->template("apply/edittuike");
}
if($op =='edittuikeback'){
    $id = $_GPC['id'];
    
    //增加
    if($_GPC['moneytype'] =='1'){

     $money = pdo_getcolumn('hyb_yl_tuikesite',array('id'=>$id),array('countmoney'));
     $data['countmoney'] = floatval($money)+floatval($_GPC['money']);
    }
    //=减少
    if($_GPC['moneytype'] =='2'){
     $money = pdo_getcolumn('hyb_yl_tuikesite',array('id'=>$id),array('countmoney'));
     $data['countmoney'] = floatval($money)-floatval($_GPC['money']);
    }
    $openid = $_GPC['openid'];
    $data['uniacid'] =$_W['uniacid'];
    $data['username'] =$_GPC['username'];
    $data['tel'] =$_GPC['tel'];
    $data['tkid'] =$_GPC['tkid'];
    $data['reason'] =$_GPC['reason'];
    $data['source'] =$_GPC['source'];
    $nickname = $_GPC['nickname'];
      pdo_update('hyb_yl_userinfo',array('u_name'=>$nickname),array('openid'=>$openid));
      pdo_update('hyb_yl_tuikesite',$data,array('id'=>$id));
     $tes = array(
       'status'=>1,
       'result'=>array(
          'url'=>'/index.php?c=site&a=entry&do=apply&op=spreadlist&ac=spreadlist&hid=&m=hyb_yl',
          'message'=>'成功'
        )
    	);
    echo json_encode($tes);
    return false;

}
if($op =='delete'){
$id = $_GPC['id'];
$res = pdo_delete('hyb_yl_tuikesite',array('id'=>$id));
 $tes = array(
   'status'=>1,
   'result'=>array(
      'url'=>'/index.php?c=site&a=entry&do=apply&op=spreadlist&ac=spreadlist&hid=&m=hyb_yl',
      'message'=>'成功'
    )
	);
echo json_encode($tes);
return false;
}
if($op == 'next'){
 $id = $_GPC['id'];
//查询推客列表
$type = $_GPC['type'];
$keyword = $_GPC['keyword'];
$where = "where a.uniacid=".$uniacid." and a.state=1 and a.tkid ='{$id}' and id !='{$id}'";
if(!empty($type)){
  if($type =='2'){
    $where .= " and a.tel like '%".$keyword."%'";
  }else if($type =='3'){
    $where .= " and b.u_name like '%".$keyword."%'";
  }
  else if($type =='4'){
  	$where .= " and a.username like '%".$keyword."%'";
  }
  else if($type =='5'){
  	$where .= " and a.id like '%".$keyword."%'";
  }
}else{
    $where .="";
}

$res = pdo_fetchall("SELECT a.*,b.u_id,b.u_name,b.u_thumb FROM".tablename('hyb_yl_tuikesite')."as a left join".tablename('hyb_yl_userinfo')."as b on b.openid=a.openid {$where}");

foreach ($res as $key => $value) {
	//查询上级
	$tkid = $value['id'];
	$id = $value['tkid'];
	$res[$key]['leve_o'] = pdo_get('hyb_yl_tuikesite',array('id'=>$id));    //查询每个人的佣金
	$res[$key]['yongjin'] =pdo_fetch("SELECT sum(`money`) as sum FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and tkid='{$tkid}' and over=1");
	//查询下级分销商
	$res[$key]['fenxiao'] = pdo_fetchcolumn("SELECT count(*) FROM".tablename('hyb_yl_tuikesite')."where uniacid='{$uniacid}' and tkid='{$tkid}' and id!='{$tkid}'");
}

include $this->template("apply/spreadlist");
}
