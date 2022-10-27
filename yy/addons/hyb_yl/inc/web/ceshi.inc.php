<?php
defined('IN_IA') or exit('Access Denied');
define('IN_GW', true);
$_W['plugin'] = 'zhiku';
$_W['ac'] = $_GPC['ac'];
 class Ceshi extends HYBPage
 { 
     //标签库
    public function tag(){
   	    global $_W,$_GPC;
   	    $uniacid = $_W['uniacid'];

        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $pagesize = 100;

        $keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
        if (!empty($keyword)) {
            $keyword = trim($keyword);
            $where = " and  name like '%$keyword%' ";
        }
        $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_label_library")." where uniacid=:uniacid ".$where." order by sort desc limit ".($pageindex - 1) * $pagesize.",".$pagesize,array(":uniacid"=>$uniacid));
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_label_library")." where uniacid=:uniacid ".$where,array(":uniacid"=>$uniacid));
        $pager = pagination($total, $pageindex, $pagesize);

   	   include $this->template('ceshi/tag');
    }

   public function addtag(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $rows = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_label_library")." where uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$id));
      if($_W['ispost']){
          $data['uniacid'] = $uniacid;
          $data['name'] = $_GPC['name'];
          $data['status'] = $_GPC['status'];
          $data['sort'] = $_GPC['sort'];
          if (empty($rows)) {
              $res = pdo_insert("hyb_yl_label_library",$data);
          }else{
              $res = pdo_update("hyb_yl_label_library",$data,array("id"=>$id));
          }

          if ($res) {
              message("编辑成功",$this->copysiteUrl('ceshi.tag').'&ac='.$_W['ac'],"success"); 
          }else{
              message("编辑失败",$this->copysiteUrl('ceshi.tag').'&ac='.$_W['ac'],"error"); 
          }
      }

      include $this->template('ceshi/addtag');
   }
    public function deletetag(){
        global $_W,$_GPC;
        $res = pdo_delete('hyb_yl_label_library',array('id' =>$_GPC['id']));
        if ($res) {
            message("删除成功",$this->copysiteUrl('ceshi.tag').'&ac='.$_W['ac'],"success"); 
        }else{
            message("删除失败",$this->copysiteUrl('ceshi.tag').'&ac='.$_W['ac'],"error"); 
        }
    }

   public function savetag(){
      global $_W,$_GPC;
      $op = !empty($_GPC['op'])?$_GPC['op']:"";
      if ($op == "delete") {
          for($i=0;$i<count($_GPC['ids']);$i++)
          {
              pdo_delete('hyb_yl_label_library',array('id' =>$_GPC['ids'][$i]));
          }
      }
      if ($op == "qiyong") {
          for($i=0;$i<count($_GPC['ids']);$i++)
          {
              pdo_update('hyb_yl_label_library',array("status"=>"1"),array('id' =>$_GPC['ids'][$i]));
          }
      }
      if ($op == "jinyong") {
          for($i=0;$i<count($_GPC['ids']);$i++)
          {
              pdo_update('hyb_yl_label_library',array("status"=>"0"),array('id' =>$_GPC['ids'][$i]));
          }
      }
      
      die(json_encode(array('errno'=>1,'message'=>1)));
   }
   public function lists()
   {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $op = 'lists';
        
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM '.tablename("hyb_yl_ceshi")."where uniacid = '{$uniacid}'");
        $pindex = max(1, intval($_GPC['page'])); 
        $pagesize = 15;
        $p = ($pindex-1) * $pagesize; 
        $keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
        if (!empty($keyword)) {
          $conditionwhere = " and a.name like '%$keyword%' ";
        }
        $list  = pdo_fetchall("select a.*,a.id as aid,b.ctname from".tablename('hyb_yl_ceshi')."as a left join".tablename('hyb_yl_classgory')."as b on b.id =a.giftstatus where a.uniacid = '{$uniacid}' ".$conditionwhere." order by a.giftstatus asc,a.sort DESC  limit ".$p.",".$pagesize);
        
        $pager = pagination($total,$pindex,$pagesize);
        
       include $this->template('ceshi/lists');
    }
   //添加科室
   public function addappAttribute(){
   	   global $_W,$_GPC;
       require_once dirname(dirname(dirname(__FILE__)))."/class/Pingyin.class.php";
       $pinyin = new Pingyin();
   
   	   $uniacid = $_W['uniacid'];
       $listgroy = pdo_fetchall("select * from".tablename("hyb_yl_classgory")."where uniacid='{$uniacid}' and typeint=0");

       $id = $_GPC['id'];
       $uniacid = $_W['uniacid'];
       $rows = pdo_fetch("select * from".tablename('hyb_yl_ceshi')." where uniacid = '{$uniacid}' and id ='{$id}' ");

	     if($_W['ispost']){
          $nav = $_GPC['nav'];
          $data = array(
             'uniacid'     =>$_W['uniacid'],
             'name'        =>$nav['name'],
             'description' =>$nav['description'],
             'detail_cover_url' =>$nav['detail_cover_url'],
             'color'      =>$nav['color'],
             'enabled'    =>$nav['enabled'],
             'sort'       =>$nav['sort'],
             'giftstatus' =>$nav['giftstatus'],
             'py'         =>$pinyin->getFirstCharter($nav['name'])
          );
          if (empty($id)) {
               pdo_insert("hyb_yl_ceshi",$data);
          }else{
              $res = pdo_update("hyb_yl_ceshi",$data,array('id'=>$id));
          }
          message("编辑成功",$this->copysiteUrl('ceshi.lists').'&page='.$page.'&ac='.$_W['ac'],"success");
	     }
   	   include $this->template('ceshi/add');
   }


   //编辑科室
    public function editkeshi(){
   	   global $_W,$_GPC;
   	   $id = $_GPC['id'];

   	   $uniacid = $_W['uniacid'];
       $page = $_GPC['page'];
       $listgroy = pdo_fetchall("select * from".tablename("hyb_yl_classgory")."where uniacid='{$uniacid}' and typeint=0");
       $rows = pdo_fetch("select * from".tablename('hyb_yl_ceshi')."as a left join".tablename('hyb_yl_classgory')."as b on b.id=a.giftstatus where a.uniacid = '{$uniacid}' and a.id ='{$id}' ");
          
      $description = explode("、",$rows['description']);
       if($_W['ispost']){
          $nav = $_GPC['nav'];
          $data = array(
             'uniacid'     =>$_W['uniacid'],
             'name'        =>$nav['name'],
             'description' =>$nav['description'],
             'detail_cover_url'    =>$nav['detail_cover_url'],
             'color'     =>$nav['color'],
             'enabled'   =>$nav['enabled'],
             'sort'      =>$nav['sort'],
            'giftstatus'=>$nav['giftstatus'],
          );
 
         pdo_update("hyb_yl_ceshi",$data,array('id'=>$id));
         message("编辑成功",$this->copysiteUrl('ceshi.lists').'&page='.$page.'&ac='.$_W['ac'],"success"); 
       }
       include $this->template('ceshi/add');
    }
   //删除科室
   public function delkeshi(){
   	   global $_W,$_GPC;
   	   $id = $_GPC['id'];
       pdo_delete("hyb_yl_ceshi",array('id'=>$id));
       message("删除成功",$this->copysiteUrl('ceshi.lists').'&ac='.$_W['ac'],"success"); 
   }

   public function bulk_deletekeshi(){
      global $_W,$_GPC;
      for($i=0;$i<count($_GPC['ids']);$i++)
      {
        pdo_delete("hyb_yl_ceshi",array('id'=>$_GPC['ids'][$i]));
      }
      die(json_encode(array('errno'=>1,'message'=>1)));
   }

   //采集科室
   public function collection_department(){
      global $_W,$_GPC;
      $a = file_get_contents("https://dxy.com/app/i/ask/sectiongroup/list/v2?dxa_entry");
      $re = json_decode($a,true);
      $uniacid = $_W['uniacid'];
      foreach ($re as $key => $value) {
          $items = $value['items'];
          foreach ($items as $k => $v) {
              $section_list =$v['section_list'];
              $sort =  $v['sort'];
              foreach ($section_list as $k1 => $v1) {
                  $name =$v1['name'];
                  $description = $v1['description'];
                  $detail_cover_url = $v1['detail_cover_url'];
                  //查询科室中是否包含
                  $iskeshi = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_ceshi")." where uniacid=:uniacid and name=:name",array(":uniacid"=>$uniacid,":name"=>$name));
                  if (empty($iskeshi)) {
                      pdo_insert('hyb_yl_ceshi',array('name'=>$name,'uniacid'=>$uniacid,'description'=>$description,'detail_cover_url'=>$detail_cover_url));
                  }  else{
                    pdo_update('hyb_yl_ceshi',array('name'=>$name,'uniacid'=>$uniacid,'description'=>$description,'detail_cover_url'=>$detail_cover_url),array("id"=>$iskeshi['id']));
                  }
                  
              }
          }
      }
      die(json_encode(array('errno'=>1,'message'=>1))); 
   }

   //拉取科室
   public function addtagcaiji(){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $keshi = pdo_fetchall("SELECT description FROM ".tablename("hyb_yl_ceshi")." where uniacid=:uniacid and description!=''",array(":uniacid"=>$uniacid));
      $shujudatastr = "";
      foreach ($keshi as &$value) {
          $shujudatastr.=$value['description'].'、';
      }
      $shujudata = explode("、", $shujudatastr);
      $shujudata = array_flip($shujudata);
      
      if (!empty($shujudata)) {
          foreach ($shujudata as $key=>$value) {
              $data['uniacid'] = $uniacid;
              // 查询标签库中是否含此标签
              $biaoqian = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_label_library")." where uniacid=:uniacid and name=:name",array(":uniacid"=>$uniacid,":name"=>$key));
              if (empty($biaoqian)) {
                $data['name'] = $key;
                pdo_insert("hyb_yl_label_library",$data);
              }
          }
          die(json_encode(array('errno'=>1,'message'=>1)));
      }
      
      
   }


   //类别管理
      public function zhikucat(){
   	   global $_W,$_GPC;
   	   $uniacid = $_W['uniacid'];
       $typeint = $_GPC['typeint'];
       $where .= " where uniacid='{$uniacid}'";
       $page = empty($_GPC['page']) ? "" : $_GPC['page'];
      $pageindex = max(1, intval($page));
      $pagesize = 10;
       if($typeint != '')
       {
        $where .= " and typeint=".$typeint;
       }
       $row = pdo_fetchall("select * from".tablename("hyb_yl_classgory").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
       $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_classgory").$where);
       $pager = pagination($total, $pageindex, $pagesize);
   	   include $this->template('ceshi/zhikucat');
   } 
    //添加类别
      public function addzhiku(){
   	   global $_W,$_GPC;
   	   $type_id = $_GPC['type_id'];
   	   $uniacid = $_W['uniacid'];
       if($_W['ispost']){
          $data = array(
             'uniacid'  => $uniacid,
             'ctname'   => $_GPC['ctname'],
             'describe' => $_GPC['describe'],
             'state'    => $_GPC['state'],
             'typeint'  => $_GPC['typeint'],
          ); 
          pdo_insert("hyb_yl_classgory",$data);
          message("添加成功",$this->copysiteUrl('ceshi.zhikucat').'&ac='.$_W['ac'],"success"); 
        }
   	   include $this->template('ceshi/addzhiku');
   } 
 //编辑类别
      public function edit_zhiku(){
   	   global $_W,$_GPC;
   	   $uniacid = $_W['uniacid'];
       $id = $_GPC['id'];
       $res = pdo_fetch("select * from".tablename('hyb_yl_classgory')."where uniacid='{$uniacid}'and id = '{$id} and typeint=0'");
       if($_W['ispost']){
          $data = array(
             'uniacid'  => $uniacid,
             'ctname'   => $_GPC['ctname'],
             'describe' => $_GPC['describe'],
             'state'    => $_GPC['state'],
             'typeint'  =>$_GPC['typeint']
          ); 
          pdo_update("hyb_yl_classgory",$data,array('id'=>$id));
          message("编辑成功",$this->copysiteUrl('ceshi.zhikucat').'&ac=zhikucat',"success"); 
        }
   	   include $this->template('ceshi/addzhiku');
   } 
      //疾病类别管理
      public function jblblist(){
   	   global $_W,$_GPC;
   	   $uniacid = $_W['uniacid'];
       $row = pdo_fetchall("select * from".tablename("hyb_yl_classgory")."where uniacid='{$uniacid}' and typeint=1");
   	   include $this->template('ceshi/jblblist');
   } 
      //添加疾病类别
    public function addjblb(){
   	   global $_W,$_GPC;
   	   $type_id = $_GPC['type_id'];
   	   $uniacid = $_W['uniacid'];
       if($_W['ispost']){
          $data = array(
             'uniacid'  => $uniacid,
             'ctname'   => $_GPC['ctname'],
             'describe' => $_GPC['describe'],
             'state'    => $_GPC['state'],
             'typeint'  =>1
          ); 
          pdo_insert("hyb_yl_classgory",$data);
          message("添加成功",$this->copysiteUrl('ceshi.jblblist').'&ac='.$_W['ac'],"success"); 
        }
   	   include $this->template('ceshi/addjblb');
   } 
   //编辑疾病类别
      public function edit_jbtype(){
   	   global $_W,$_GPC;
   	   $uniacid = $_W['uniacid'];
       $id = $_GPC['id'];
       $res = pdo_fetch("select * from".tablename('hyb_yl_classgory')."where uniacid='{$uniacid}'and id = '{$id}' and typeint=1");
       if($_W['ispost']){
          $data = array(
             'uniacid'  => $uniacid,
             'ctname'   => $_GPC['ctname'],
             'describe' => $_GPC['describe'],
             'state'    => $_GPC['state'],
             'typeint'  =>1
          ); 
          pdo_update("hyb_yl_classgory",$data,array('id'=>$id));
          message("编辑成功",$this->copysiteUrl('ceshi.jblblist').'&ac=jblblist',"success"); 
        }
   	   include $this->template('ceshi/addjblb');
   } 
     //删除类别
      public function delcate_jb(){
   	   global $_W,$_GPC;
   	   $uniacid = $_W['uniacid'];
       $id = $_GPC['id'];
       $res = pdo_delete("hyb_yl_classgory",array('id'=>$id));
       if($res)
       {
        message("删除成功",$this->copysiteUrl('ceshi.jblblist').'&ac=jblblist',"success"); 
      }else{
        message("删除失败",$this->copysiteUrl('ceshi.jblblist').'&ac=jblblist',"success"); 
      
   	   
      }
      include $this->template('ceshi/jblblist');
     }  
   
   //删除类别
      public function delcate(){
   	   global $_W,$_GPC;
   	   $uniacid = $_W['uniacid'];
       $id = $_GPC['id'];
       $res = pdo_delete("hyb_yl_classgory",array('id'=>$id));
       if($res)
       {
        message("删除成功",$this->copysiteUrl('ceshi.zhikucat').'&ac=zhikucat',"success"); 
      }else{
        message("删除失败",$this->copysiteUrl('ceshi.zhikucat').'&ac=zhikucat',"success"); 
      
       
      }
   	   include $this->template('ceshi/zhikucat');
     } 
     //添加疾病
      public function adddisease(){
   	    global $_W,$_GPC;
   	    $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $item = pdo_get("hyb_yl_tank",array("id"=>$id,"type"=>"0"));
        $item['imgpath'] = json_decode($item['imgpath'],'true');
        $style = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'1'));
        $item['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$item['openid']),'u_name');
        $item['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$item['zid']),'z_name');
        $ks_list = pdo_getall("hyb_yl_classgory",array('uniacid'=>$uniacid,"typeint"=>'0'));
        $ks_two = pdo_getall("hyb_yl_ceshi",array("giftstatus"=>$item['keshi_one']));
        $data = array(
           'uniacid'  => $_W['uniacid'],
           'sort'    => $_GPC['sort'],
           'title'   => $_GPC['title'],
           'content'   => $_GPC['content'],
           'detail' => $_GPC['detail'],
           'symptom'     => $_GPC['symptom'],
           'reason'      => $_GPC['reason'],
           'diagnosis'    => $_GPC['diagnosis'],
           'treatment'   => $_GPC['treatment'],
           'life'  => $_GPC['life'],
           'prevention'  => $_GPC['prevention'],
           'openid'    => $_GPC['openid'],
           'zid'    => $_GPC['zid'],
           'keshi_one'   => $_GPC['keshi_one'],
           'keshi_two'  => $_GPC['keshi_two'],
           'created  ' => strtotime($_GPC['created']),
           'status'   => $_GPC['status'],
           'is_index'    => $_GPC['is_index'],
           'is_yp'   => $_GPC['is_yp'],
           'is_hospital'  => $_GPC['is_hospital'],
           'is_content' => $_GPC['is_content'],
           'is_reason'  => $_GPC['is_reason'],
           'type'     => '0',
           'first'     => $_GPC['first'],
           "thumb" => $_GPC['thumb'],
           "imgpath" => json_encode($_GPC['imgpath']),
           "style" => $_GPC['style'],
           "share" => $_GPC['share'],
       );

       if($_W['ispost']){

           if(empty($id)){
              pdo_insert('hyb_yl_tank',$data);
              message("添加成功",$this->copysiteUrl('ceshi.diseaselist').'&ac=diseaselist',"success");
           }else{
             pdo_update('hyb_yl_tank',$data,array('id'=>$id));
              message("修改成功",$this->copysiteUrl('ceshi.diseaselist').'&ac=diseaselist',"success");
           }
        }
   	   include $this->template('ceshi/adddisease');
   } 

  // 删除疾病
   public function deldisease()
   {
    global $_GPC;
    $id = $_GPC['id'];
    
    $res = pdo_delete("hyb_yl_tank",array("id"=>$id));
    if($res){
        message("删除成功",$this->copysiteUrl('ceshi.diseaselist').'&ac=diseaselist',"success");
     }else{
       pdo_update('hyb_yl_tank',$data,array('id'=>$id));
        message("删除失败",$this->copysiteUrl('ceshi.diseaselist').'&ac=diseaselist',"success");
     }
        
      include $this->template('ceshi/diseaselist');
   }

   // 删除症状
   public function delsymptom()
   {
    global $_GPC;
    $id = $_GPC['id'];
    
    $res = pdo_delete("hyb_yl_tank",array("id"=>$id));
    if($res){
        message("删除成功",$this->copysiteUrl('ceshi.symptom').'&ac=symptom',"success");
     }else{
       pdo_update('hyb_yl_tank',$data,array('id'=>$id));
        message("删除失败",$this->copysiteUrl('ceshi.symptom').'&ac=symptom',"success");
     }
        
      include $this->template('ceshi/symptom');
   }

   // 删除疫苗
   public function delym()
   {
    global $_GPC;
    $id = $_GPC['id'];
    
    $res = pdo_delete("hyb_yl_tank",array("id"=>$id));
    if($res){
        message("删除成功",$this->copysiteUrl('ceshi.ymlist').'&ac=ymlist',"success");
     }else{
       pdo_update('hyb_yl_tank',$data,array('id'=>$id));
        message("删除失败",$this->copysiteUrl('ceshi.ymlist').'&ac=ymlist',"success");
     }
        
      include $this->template('ceshi/ymlist');
   }

   // 删除检查项
   public function delinspect()
   {
    global $_GPC;
    $id = $_GPC['id'];
    
    $res = pdo_delete("hyb_yl_tank",array("id"=>$id));
    if($res){
        message("删除成功",$this->copysiteUrl('ceshi.jclist').'&ac=jclist',"success");
     }else{
       pdo_update('hyb_yl_tank',$data,array('id'=>$id));
        message("删除失败",$this->copysiteUrl('ceshi.jclist').'&ac=jclist',"success");
     }
        
      include $this->template('ceshi/jclist');
   }

   // 删除药品
    public function delrug()
   {
    global $_GPC;
    $id = $_GPC['id'];
    
    $res = pdo_delete("hyb_yl_tank",array("id"=>$id));
    if($res){
        message("删除成功",$this->copysiteUrl('ceshi.addruglist').'&ac=addruglist',"success");
     }else{
       pdo_update('hyb_yl_tank',$data,array('id'=>$id));
        message("删除失败",$this->copysiteUrl('ceshi.addruglist').'&ac=addruglist',"success");
     }
        
      include $this->template('ceshi/addruglist');
   }

   // 删除传染源
    public function dellegal()
   {
    global $_GPC;
    $id = $_GPC['id'];
    
    $res = pdo_delete("hyb_yl_tank",array("id"=>$id));
    if($res){
        message("删除成功",$this->copysiteUrl('ceshi.legallist').'&ac=legallist',"success");
     }else{
       pdo_update('hyb_yl_tank',$data,array('id'=>$id));
        message("删除失败",$this->copysiteUrl('ceshi.legallist').'&ac=legallist',"success");
     }
        
      include $this->template('ceshi/legallist');
   }


   
     public function ajaxinfo(){
   	   global $_W,$_GPC;
   	   $uniacid = $_W['uniacid'];
       $op = $_GPC['op'];
       if($op =='keshi'){
         if($_W['isajax']){
              $id = $_GPC['id'];
              $list = pdo_fetchall("select * from".tablename('hyb_yl_ceshi')."where uniacid='{$uniacid}' and giftstatus='{$id}'");
              echo json_encode($list);
              return;
            }
       }
       if($op =='type'){
         if($_W['isajax']){
              $id = $_GPC['id'];
              $res = pdo_update("hyb_yl_tank",array('status'=>'0'),array('id'=>$id));
              echo json_encode($res);
              return;
            }
       }
     if($op =='kqtype'){
         if($_W['isajax']){
              $id = $_GPC['id'];
              $res = pdo_update("hyb_yl_tank",array('status'=>'1'),array('id'=>$id));
              echo json_encode($res);
              return;
            }
       }
     }
     //疾病列表
      public function diseaselist(){
   	    global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $where=" where uniacid=$uniacid and type=0";
        $keyword = $_GPC['keyword'];
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $pagesize = 10;
        if($keyword)
        {
          $where .= " and (title like '%$keyword%' or content like '%$keyword%')";
        }
   	    $list = pdo_fetchall("select * from ".tablename("hyb_yl_tank").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        foreach($list as &$value)
        {
          $value['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$value['zid']),'z_name');
          $value['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$value['openid']),'u_name');
        }
        
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tank").$where);
        $pager = pagination($total, $pageindex, $pagesize);
        
   	    include $this->template('ceshi/diseaselist');
   } 
      //图标管理
      public function jbicon(){
   	   global $_W,$_GPC;
   	   $uniacid = $_W['uniacid'];
       $item = pdo_get("hyb_yl_tank_thumb",array("uniacid"=>$uniacid,"type"=>'0'));
       if($item)
       {
        if(strpos($item['symptom'],'http') === false)
        {
          $item['symptom'] = $_W['attachurl'].$item['symptom'];
        }
        if(strpos($item['reason'],'http') === false)
        {
          $item['reason'] = $_W['attachurl'].$item['reason'];
        }
        if(strpos($item['diagnosis'],'http') === false)
        {
        $item['diagnosis'] = $_W['attachurl'].$item['diagnosis'];
      }
      if(strpos($item['treatment'],'http') === false)
        {
        $item['treatment'] = $_W['attachurl'].$item['treatment'];
      }
      if(strpos($item['life'],'http') === false)
        {
        $item['life'] = $_W['attachurl'].$item['life'];
      }
      if(strpos($item['prevention'],'http') === false)
        {
        $item['prevention'] = $_W['attachurl'].$item['prevention'];
       }
     }
       if ($_W['ispost']) {
        $data = array(
          'symptom' => $_GPC['symptom'],
          "uniacid" => $_W['uniacid'],
          "reason" => $_GPC['reason'],
          "diagnosis" => $_GPC['diagnosis'],
          "treatment" => $_GPC['treatment'],
          "life" => $_GPC['life'],
          "prevention" => $_GPC['prevention'],
          "is_symptom" => $_GPC['is_symptom'],
          "is_reason" => $_GPC['is_reason'],
          "is_diagnosis" => $_GPC['is_diagnosis'],
          "is_treatment" => $_GPC['is_treatment'],
          "is_life" => $_GPC['is_life'],
          "is_prevention" => $_GPC['is_prevention'],
          "type" => '0',
        );
        
        if($item)
        {
          $res = pdo_update("hyb_yl_tank_thumb",$data,array("id"=>$item['id']));
        }else{
          $data['created'] = time();
          $res = pdo_insert("hyb_yl_tank_thumb",$data);
        }
        if($res)
        {
           message("修改成功",$this->copysiteUrl('ceshi.jbicon').'&ac=jbicon',"success");
        }else{
           message("修改成功",$this->copysiteUrl('ceshi.jbicon').'&ac=jbicon',"success");
        }

      }
   	   include $this->template('ceshi/jbicon');
   } 
   
   //症状管理
   public function symptom(){
   	    global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $where=" where uniacid=$uniacid and type=1";
        $keyword = $_GPC['keyword'];
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $pagesize = 10;
        if($keyword)
        {
          $where .= " and (title like '%$keyword%' or content like '%$keyword%')";
        }
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_tank").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        foreach($list as &$value)
        {
          $value['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$value['zid']),'z_name');
          $value['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$value['openid']),'u_name');
        }
        
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tank").$where);
        $pager = pagination($total, $pageindex, $pagesize);
   	    include $this->template('ceshi/symptom');
   } 

        //添加症状
      public function addSymptom(){
   	   global $_W,$_GPC;
   	   $uniacid = $_W['uniacid'];
       $last = [];
        for($i=65;$i<91;$i++){
            $s =  strtoupper(chr($i)).' ';//输出大写字母
            array_push($last,$s);

        }
       $id = $_GPC['id'];
        $item = pdo_get("hyb_yl_tank",array("id"=>$id,"type"=>"1"));
        $item['imgpath'] = json_decode($item['imgpath'],'true');
        $item['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$item['openid']),'u_name');
        $item['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$item['zid']),'z_name');
        $style = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'2'));
        $ks_list = pdo_getall("hyb_yl_classgory",array('uniacid'=>$uniacid));
        $ks_two = pdo_getall("hyb_yl_ceshi",array("giftstatus"=>$item['keshi_one']));
        $data = array(
           'uniacid'  => $_W['uniacid'],
           'sort'    => $_GPC['sort'],
           'title'   => $_GPC['title'],
           'content'   => $_GPC['content'],
           'detail' => $_GPC['detail'],
           'symptom'     => $_GPC['symptom'],
           'reason'      => $_GPC['reason'],
           'diagnosis'    => $_GPC['diagnosis'],
           'treatment'   => $_GPC['treatment'],
           'life'  => $_GPC['life'],
           'prevention'  => $_GPC['prevention'],
           'openid'    => $_GPC['openid'],
           'zid'    => $_GPC['zid'],
           'keshi_one'   => $_GPC['keshi_one'],
           'keshi_two'  => $_GPC['keshi_two'],
           'created  ' => strtotime($_GPC['created']),
           'status'   => $_GPC['status'],
           'is_index'    => $_GPC['is_index'],
           'is_yp'   => $_GPC['is_yp'],
           'is_hospital'  => $_GPC['is_hospital'],
           'is_content' => $_GPC['is_content'],
           'is_reason'  => $_GPC['is_reason'],
           'type'     => '1',
           'first'     => $_GPC['first'],
           "thumb" => $_GPC['thumb'],
           "imgpath" => json_encode($_GPC['imgpath']),
           "style" => $_GPC['style'],
            "share" => $_GPC['share'],
       );

       if($_W['ispost']){

           if(empty($id)){
              pdo_insert('hyb_yl_tank',$data);
              message("添加成功",$this->copysiteUrl('ceshi.symptom').'&ac=symptom',"success");
           }else{
             pdo_update('hyb_yl_tank',$data,array('id'=>$id));
              message("修改成功",$this->copysiteUrl('ceshi.symptom').'&ac=symptom',"success");
           }
        }
       
   	   include $this->template('ceshi/addSymptom');
   } 
         //症状图标管理
      public function zicon(){
   	   global $_W,$_GPC;
       $uniacid = $_W['uniacid'];
       $item = pdo_get("hyb_yl_tank_thumb",array("uniacid"=>$uniacid,"type"=>'1'));
       if($item)
       {
        if(strpos($item['symptom'],'http') === false)
        {
          $item['symptom'] = $_W['attachurl'].$item['symptom'];
        }
        if(strpos($item['relieve'],'http') === false)
        {
          $item['relieve'] = $_W['attachurl'].$item['relieve'];
        }
        if(strpos($item['diagnosis'],'http') === false)
        {
        $item['diagnosis'] = $_W['attachurl'].$item['diagnosis'];
      }
     }
       if ($_W['ispost']) {
        $data = array(
          'symptom' => $_GPC['symptom'],
          "uniacid" => $_W['uniacid'],
          "relieve" => $_GPC['relieve'],
          "diagnosis" => $_GPC['diagnosis'],
          "is_symptom" => $_GPC['is_symptom'],
          "is_relieve" => $_GPC['is_relieve'],
          "is_diagnosis" => $_GPC['is_diagnosis'],
          "type" => '1',
        );
        
        if($item)
        {
          $res = pdo_update("hyb_yl_tank_thumb",$data,array("id"=>$item['id']));
        }else{
          $data['created'] = time();
          $res = pdo_insert("hyb_yl_tank_thumb",$data);
        }
        if($res)
        {
           message("修改成功",$this->copysiteUrl('ceshi.zicon').'&ac=zicon',"success");
        }else{
           message("修改失败",$this->copysiteUrl('ceshi.zicon').'&ac=zicon',"success");
        }

      }
   	   include $this->template('ceshi/zicon');
   } 
      //疫苗列表
      public function ymlist(){
   	    global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $where=" where uniacid=$uniacid and type=2";
        $keyword = $_GPC['keyword'];
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $pagesize = 10;
        if($keyword)
        {
          $where .= " and (title like '%$keyword%' or content like '%$keyword%')";
        }
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_tank").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        foreach($list as &$value)
        {
          $value['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$value['zid']),'z_name');
          $value['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$value['openid']),'u_name');
        }
        
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tank").$where);
        $pager = pagination($total, $pageindex, $pagesize);
   	   include $this->template('ceshi/ymlist');
   }
       //添加疫苗
      public function addym(){
   	   global $_W,$_GPC;
   	   global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $last = [];
        for($i=65;$i<91;$i++){
            $s =  strtoupper(chr($i)).' ';//输出大写字母
            array_push($last,$s);

        }
        $item = pdo_get("hyb_yl_tank",array("id"=>$id,"type"=>"2"));
        $item['imgpath'] = json_decode($item['imgpath'],'true');
        $item['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$item['openid']),'u_name');
        $item['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$item['zid']),'z_name');
        $style = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'3'));
        $ks_list = pdo_getall("hyb_yl_classgory",array('uniacid'=>$uniacid));
        $ks_two = pdo_getall("hyb_yl_ceshi",array("giftstatus"=>$item['keshi_one']));
        $data = array(
           'uniacid'  => $_W['uniacid'],
           'sort'    => $_GPC['sort'],
           'title'   => $_GPC['title'],
           'content'   => $_GPC['content'],
           'detail' => $_GPC['detail'],
           'symptom'     => $_GPC['symptom'],
           'reason'      => $_GPC['reason'],
           'diagnosis'    => $_GPC['diagnosis'],
           'treatment'   => $_GPC['treatment'],
           'life'  => $_GPC['life'],
           'prevention'  => $_GPC['prevention'],
           'openid'    => $_GPC['openid'],
           'zid'    => $_GPC['zid'],
           'keshi_one'   => $_GPC['keshi_one'],
           'keshi_two'  => $_GPC['keshi_two'],
           'created  ' => strtotime($_GPC['created']),
           'status'   => $_GPC['status'],
           'is_index'    => $_GPC['is_index'],
           'is_yp'   => $_GPC['is_yp'],
           'is_hospital'  => $_GPC['is_hospital'],
           'is_content' => $_GPC['is_content'],
           'is_reason'  => $_GPC['is_reason'],
           'type'     => '2',
           'first'     => $_GPC['first'],
           "thumb" => $_GPC['thumb'],
           "imgpath" => json_encode($_GPC['imgpath']),
           "style" => $_GPC['style'],
            "share" => $_GPC['share'],
       );

       if($_W['ispost']){

           if(empty($id)){
              pdo_insert('hyb_yl_tank',$data);
              message("添加成功",$this->copysiteUrl('ceshi.ymlist').'&ac=ymlist',"success");
           }else{
             pdo_update('hyb_yl_tank',$data,array('id'=>$id));
              message("修改成功",$this->copysiteUrl('ceshi.ymlist').'&ac=ymlist',"success");
           }
        }
   	   include $this->template('ceshi/addym');
   }
        //检查项列表
      public function jclist(){
   	    global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $where=" where uniacid=$uniacid and type=3";
        $keyword = $_GPC['keyword'];
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $pagesize = 10;
        if($keyword)
        {
          $where .= " and (title like '%$keyword%' or content like '%$keyword%')";
        }
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_tank").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        foreach($list as &$value)
        {
          $value['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$value['zid']),'z_name');
          $value['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$value['openid']),'u_name');
        }
        
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tank").$where);
        $pager = pagination($total, $pageindex, $pagesize);
   	   include $this->template('ceshi/jclist');
   }
        //添加检查项
      public function addinspect(){
   	   global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $item = pdo_get("hyb_yl_tank",array("id"=>$id,"type"=>"3"));
        $item['imgpath'] = json_decode($item['imgpath'],'true');
        $item['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$item['openid']),'u_name');
        $item['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$item['zid']),'z_name');
        $style = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'4'));
       $last = [];
        for($i=65;$i<91;$i++){
            $s =  strtoupper(chr($i)).' ';//输出大写字母
            array_push($last,$s);

        }
        $ks_list = pdo_getall("hyb_yl_classgory",array('uniacid'=>$uniacid));
        $ks_two = pdo_getall("hyb_yl_ceshi",array("giftstatus"=>$item['keshi_one']));
        $data = array(
           'uniacid'  => $_W['uniacid'],
           'sort'    => $_GPC['sort'],
           'title'   => $_GPC['title'],
           'content'   => $_GPC['content'],
           'detail' => $_GPC['detail'],
           'symptom'     => $_GPC['symptom'],
           'reason'      => $_GPC['reason'],
           'diagnosis'    => $_GPC['diagnosis'],
           'treatment'   => $_GPC['treatment'],
           'life'  => $_GPC['life'],
           'prevention'  => $_GPC['prevention'],
           'openid'    => $_GPC['openid'],
           'zid'    => $_GPC['zid'],
           'keshi_one'   => $_GPC['keshi_one'],
           'keshi_two'  => $_GPC['keshi_two'],
           'created  ' => strtotime($_GPC['created']),
           'status'   => $_GPC['status'],
           'is_index'    => $_GPC['is_index'],
           'is_yp'   => $_GPC['is_yp'],
           'is_hospital'  => $_GPC['is_hospital'],
           'is_content' => $_GPC['is_content'],
           'is_reason'  => $_GPC['is_reason'],
           'type'     => '3',
           'first'     => $_GPC['first'],
           "thumb" => $_GPC['thumb'],
           "imgpath" => json_encode($_GPC['imgpath']),
           "style" => $_GPC['style'],
            "share" => $_GPC['share'],
       );

       if($_W['ispost']){

           if(empty($id)){
              pdo_insert('hyb_yl_tank',$data);
              message("添加成功",$this->copysiteUrl('ceshi.jclist').'&ac=jclist',"success");
           }else{
             pdo_update('hyb_yl_tank',$data,array('id'=>$id));
              message("修改成功",$this->copysiteUrl('ceshi.jclist').'&ac=jclist',"success");
           }
        }
   	   include $this->template('ceshi/addinspect');
   }
     //检查项图标
      public function inspecticon(){
   	   global $_W,$_GPC;
       $uniacid = $_W['uniacid'];
       $item = pdo_get("hyb_yl_tank_thumb",array("uniacid"=>$uniacid,"type"=>'2'));
       if($item)
       {
        if(strpos($item['symptom'],'http') === false)
        {
          $item['symptom'] = $_W['attachurl'].$item['symptom'];
        }
        if(strpos($item['reason'],'http') === false)
        {
          $item['reason'] = $_W['attachurl'].$item['reason'];
        }
        if(strpos($item['diagnosis'],'http') === false)
        {
        $item['diagnosis'] = $_W['attachurl'].$item['diagnosis'];
      }
      if(strpos($item['treatment'],'http') === false)
        {
        $item['treatment'] = $_W['attachurl'].$item['treatment'];
      }
      if(strpos($item['life'],'http') === false)
        {
        $item['life'] = $_W['attachurl'].$item['life'];
      }
      if(strpos($item['prevention'],'http') === false)
        {
        $item['prevention'] = $_W['attachurl'].$item['prevention'];
       }
     }
       if ($_W['ispost']) {
        $data = array(
          'symptom' => $_GPC['symptom'],
          "uniacid" => $_W['uniacid'],
          "reason" => $_GPC['reason'],
          "diagnosis" => $_GPC['diagnosis'],
          "treatment" => $_GPC['treatment'],
          "life" => $_GPC['life'],
          "prevention" => $_GPC['prevention'],
          "is_symptom" => $_GPC['is_symptom'],
          "is_reason" => $_GPC['is_reason'],
          "is_diagnosis" => $_GPC['is_diagnosis'],
          "is_treatment" => $_GPC['is_treatment'],
          "is_life" => $_GPC['is_life'],
          "is_prevention" => $_GPC['is_prevention'],
          "type" => '2',
        );
        
        if($item)
        {
          $res = pdo_update("hyb_yl_tank_thumb",$data,array("id"=>$item['id']));
        }else{
          $data['created'] = time();
          $res = pdo_insert("hyb_yl_tank_thumb",$data);
        }
        if($res)
        {
           message("修改成功",$this->copysiteUrl('ceshi.inspecticon').'&ac=inspecticon',"success");
        }else{
           message("修改成功",$this->copysiteUrl('ceshi.inspecticon').'&ac=inspecticon',"success");
        }

      }
   	   include $this->template('ceshi/inspecticon');
   }
      //备药列表
      public function addruglist(){
   	   global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $where=" where uniacid=$uniacid and type=4";
        $keyword = $_GPC['keyword'];
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $pagesize = 10;
        if($keyword)
        {
          $where .= " and (title like '%$keyword%' or content like '%$keyword%')";
        }
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_tank").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        foreach($list as &$value)
        {
          $value['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$value['zid']),'z_name');
          $value['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$value['openid']),'u_name');
        }
        
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tank").$where);
        $pager = pagination($total, $pageindex, $pagesize);
   	   include $this->template('ceshi/addruglist');
   }
        //添加药品信息
      public function addrug(){
   	   global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $item = pdo_get("hyb_yl_tank",array("id"=>$id,"type"=>"4"));
        $item['imgpath'] = json_decode($item['imgpath'],'true');
        $item['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$item['openid']),'u_name');
        $item['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$item['zid']),'z_name');
       $last = [];
        for($i=65;$i<91;$i++){
            $s =  strtoupper(chr($i)).' ';//输出大写字母
            array_push($last,$s);

        }
        $style = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'5'));
        $ks_list = pdo_getall("hyb_yl_classgory",array('uniacid'=>$uniacid));
        $ks_two = pdo_getall("hyb_yl_ceshi",array("giftstatus"=>$item['keshi_one']));
        $data = array(
           'uniacid'  => $_W['uniacid'],
           'sort'    => $_GPC['sort'],
           'title'   => $_GPC['title'],
           'content'   => $_GPC['content'],
           'detail' => $_GPC['detail'],
           'symptom'     => $_GPC['symptom'],
           'reason'      => $_GPC['reason'],
           'diagnosis'    => $_GPC['diagnosis'],
           'treatment'   => $_GPC['treatment'],
           'life'  => $_GPC['life'],
           'prevention'  => $_GPC['prevention'],
           'openid'    => $_GPC['openid'],
           'zid'    => $_GPC['zid'],
           'keshi_one'   => $_GPC['keshi_one'],
           'keshi_two'  => $_GPC['keshi_two'],
           'created  ' => strtotime($_GPC['created']),
           'status'   => $_GPC['status'],
           'is_index'    => $_GPC['is_index'],
           'is_yp'   => $_GPC['is_yp'],
           'is_hospital'  => $_GPC['is_hospital'],
           'is_content' => $_GPC['is_content'],
           'is_reason'  => $_GPC['is_reason'],
           'type'     => '4',
           'first'     => $_GPC['first'],
           "thumb" => $_GPC['thumb'],
           "imgpath" => json_encode($_GPC['imgpath']),
           "style" => $_GPC['style'],
            "share" => $_GPC['share'],
       );

       if($_W['ispost']){

           if(empty($id)){
              pdo_insert('hyb_yl_tank',$data);
              message("添加成功",$this->copysiteUrl('ceshi.addruglist').'&ac=addruglist',"success");
           }else{
             pdo_update('hyb_yl_tank',$data,array('id'=>$id));
              message("修改成功",$this->copysiteUrl('ceshi.addruglist').'&ac=addruglist',"success");
           }
        }
   	   include $this->template('ceshi/addrug');
   }
          //法定传染病
      public function legallist(){
   	   global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $where=" where uniacid=$uniacid and type=5";
        $keyword = $_GPC['keyword'];
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $pagesize = 10;
        if($keyword)
        {
          $where .= " and (title like '%$keyword%' or content like '%$keyword%')";
        }
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_tank").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        foreach($list as &$value)
        {
          $value['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$value['zid']),'z_name');
          $value['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$value['openid']),'u_name');
        }
        
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tank").$where);
        $pager = pagination($total, $pageindex, $pagesize);
   	   include $this->template('ceshi/legallist');
   }
           //添加传染病
      public function addlegal(){
   	    global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $style = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'6'));
        $item = pdo_get("hyb_yl_tank",array("id"=>$id,"type"=>"5"));
        $item['imgpath'] = json_decode($item['imgpath'],'true');
        $item['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$item['openid']),'u_name');
        $item['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$item['zid']),'z_name');
       $last = [];
        for($i=65;$i<91;$i++){
            $s =  strtoupper(chr($i)).' ';//输出大写字母
            array_push($last,$s);

        }
        $ks_list = pdo_getall("hyb_yl_classgory",array('uniacid'=>$uniacid));
        $ks_two = pdo_getall("hyb_yl_ceshi",array("giftstatus"=>$item['keshi_one']));
        $data = array(
           'uniacid'  => $_W['uniacid'],
           'sort'    => $_GPC['sort'],
           'title'   => $_GPC['title'],
           'content'   => $_GPC['content'],
           'detail' => $_GPC['detail'],
           'symptom'     => $_GPC['symptom'],
           'reason'      => $_GPC['reason'],
           'diagnosis'    => $_GPC['diagnosis'],
           'treatment'   => $_GPC['treatment'],
           'life'  => $_GPC['life'],
           'prevention'  => $_GPC['prevention'],
           'openid'    => $_GPC['openid'],
           'zid'    => $_GPC['zid'],
           'keshi_one'   => $_GPC['keshi_one'],
           'keshi_two'  => $_GPC['keshi_two'],
           'created  ' => strtotime($_GPC['created']),
           'status'   => $_GPC['status'],
           'is_index'    => $_GPC['is_index'],
           'is_yp'   => $_GPC['is_yp'],
           'is_hospital'  => $_GPC['is_hospital'],
           'is_content' => $_GPC['is_content'],
           'is_reason'  => $_GPC['is_reason'],
           'type'     => '5',
           'first'     => $_GPC['first'],
           "thumb" => $_GPC['thumb'],
           "imgpath" => json_encode($_GPC['imgpath']),
           "style" => $_GPC['style'],
           "share" => $_GPC['share'],
       );

       if($_W['ispost']){

           if(empty($id)){
              pdo_insert('hyb_yl_tank',$data);
              message("添加成功",$this->copysiteUrl('ceshi.legallist').'&ac=legallist',"success");
           }else{
             pdo_update('hyb_yl_tank',$data,array('id'=>$id));
              message("修改成功",$this->copysiteUrl('ceshi.legallist').'&ac=legallist',"success");
           }
        }
   	   include $this->template('ceshi/addlegal');
   }



    public function hotwordsearch(){
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $pagesize = 100;

        $keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
        if (!empty($keyword)) {
            $keyword = trim($keyword);
            $where = " and  name like '%$keyword%' ";
        }
        $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_search")." where uniacid=:uniacid ".$where." order by sort desc limit ".($pageindex - 1) * $pagesize.",".$pagesize,array(":uniacid"=>$uniacid));
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_search")." where uniacid=:uniacid ".$where,array(":uniacid"=>$uniacid));
        $pager = pagination($total, $pageindex, $pagesize);
        include $this->template('ceshi/hotwordsearch');
    }
    public function addhotwordsearch(){
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = !empty($_GPC['id'])?$_GPC['id']:"";
        $rows = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_search")." where uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$id));
        if($_W['ispost']){
            $data['uniacid'] = $uniacid;
            $data['name'] = $_GPC['name'];
            $data['status'] = $_GPC['status'];
            $data['sort'] = $_GPC['sort'];
            if (empty($rows)) {
                $res = pdo_insert("hyb_yl_search",$data);
            }else{
                $res = pdo_update("hyb_yl_search",$data,array("id"=>$id));
            }

            if ($res) {
                message("编辑成功",$this->copysiteUrl('ceshi.hotwordsearch').'&ac='.$_W['ac'],"success"); 
            }else{
                message("编辑失败",$this->copysiteUrl('ceshi.addhotwordsearch').'&ac='.$_W['ac'],"error"); 
            }
        }
        include $this->template('ceshi/addhotwordsearch');
    }

    public function deletehotwordsearch(){
        global $_W,$_GPC;
        $res = pdo_delete('hyb_yl_search',array('id' =>$_GPC['id']));
        if ($res) {
            message("删除成功",$this->copysiteUrl('ceshi.hyb_yl_search').'&ac='.$_W['ac'],"success"); 
        }else{
            message("删除失败",$this->copysiteUrl('ceshi.hyb_yl_search').'&ac='.$_W['ac'],"error"); 
        }
    }

   public function savehotwordsearch(){
      global $_W,$_GPC;
      $op = !empty($_GPC['op'])?$_GPC['op']:"";
      if ($op == "delete") {
          for($i=0;$i<count($_GPC['ids']);$i++)
          {
              pdo_delete('hyb_yl_search',array('id' =>$_GPC['ids'][$i]));
          }
      }
      if ($op == "qiyong") {
          for($i=0;$i<count($_GPC['ids']);$i++)
          {
              pdo_update('hyb_yl_search',array("status"=>"1"),array('id' =>$_GPC['ids'][$i]));
          }
      }
      if ($op == "jinyong") {
          for($i=0;$i<count($_GPC['ids']);$i++)
          {
              pdo_update('hyb_yl_search',array("status"=>"0"),array('id' =>$_GPC['ids'][$i]));
          }
      }
      
      die(json_encode(array('errno'=>1,'message'=>1)));
   }

   // 一键获取症状
   public function getSymptom()
   {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      // $url = array(
      //   '0' => 'https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1263',
      //   '1' => 'https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1264',
      //   '2' => 'https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1265',
      //   '3' => 'https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1266',
      //   '4' => 'https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1267',
      //   '5' => 'https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1268',
      //   '6' => 'https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1271',
      //   '7' => 'https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1272',
      //   '8' => 'https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1273',
      // );
      $url = array(
        '0' => ST_ROOT."/inc/json/symptom1263.json",
        '1' => ST_ROOT."/inc/json/symptom1264.json",
        '2' => ST_ROOT."/inc/json/symptom1265.json",
        '3' => ST_ROOT."/inc/json/symptom1266.json",
        '4' => ST_ROOT."/inc/json/symptom1267.json",
        '5' => ST_ROOT."/inc/json/symptom1267.json",
        '6' => ST_ROOT."/inc/json/symptom1271.json",
        '7' => ST_ROOT."/inc/json/symptom1272.json",
        '8' => ST_ROOT."/inc/json/symptom1273.json",
      );
      $contents = array();
      foreach($url as &$value)
      {
          $content = file_get_contents($value);
          // $content = $this->send_post($value);
          $content = json_decode($content,true);
          $contentss = $content['data']['items'][0]['special_topic_modules'];
          foreach($contentss as &$values)
          {
            foreach($values['text_entry_items'] as &$vv)
            {
              $data = array(
                'uniacid' => $uniacid,
                "first" => $values['title'],
                "title" => $vv['title'],
                "created" => time(),
                "status" => '1',
                "type" => '1',
              );
              pdo_insert("hyb_yl_tank",$data);
            }
            
          }
      }
      message("获取成功",$this->copysiteUrl('ceshi.symptom').'&ac='.$_W['ac'],"success"); 

   }

    // 一键获取疫苗
   public function getymlist()
   {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $json_text = ST_ROOT."/inc/json/ymlist.json";
      $content = file_get_contents($json_text);
      // $url = "https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1261";
      // $content = $this->send_post($url);
      $content = json_decode($content,true);
      
      $contentss = $content['data']['items'][0]['special_topic_modules'];
      
      foreach($contentss as &$values)
      {
        foreach($values['text_entry_items'] as &$vv)
        {
          $data = array(
            'uniacid' => $uniacid,
            "title" => $vv['title'],
            "created" => time(),
            "status" => '1',
            "type" => '2',
          );
          pdo_insert("hyb_yl_tank",$data);
        }
        
      }
      message("获取成功",$this->copysiteUrl('ceshi.ymlist').'&ac='.$_W['ac'],"success"); 

   }

   // 一键获取检查项
   public function getjclist()
   {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $json_text = ST_ROOT."/inc/json/jclist.json";
      $content = file_get_contents($json_text);
      // $url = "https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1276";
      // $content = $this->send_post($url);
      $content = json_decode($content,true);
      
      $contentss = $content['data']['items'][0]['special_topic_modules'];
      
      foreach($contentss as &$values)
      {
        foreach($values['text_entry_items'] as &$vv)
        {
          $data = array(
            'uniacid' => $uniacid,
            "title" => $vv['title'],
            "created" => time(),
            "status" => '1',
            "type" => '3',
          );
          pdo_insert("hyb_yl_tank",$data);
        }
        
      }
      message("获取成功",$this->copysiteUrl('ceshi.jclist').'&ac='.$_W['ac'],"success"); 

   }

   // 一键获取药品
   public function getruglist()
   {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $json_text = ST_ROOT."/inc/json/addruglist.json";
      $content = file_get_contents($json_text);
      // $url = "https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1275";
      // $content = $this->send_post($url);
      $content = json_decode($content,true);
      
      $contentss = $content['data']['items'][0]['special_topic_modules'];
      
      foreach($contentss as &$values)
      {
        foreach($values['text_entry_items'] as &$vv)
        {
          $data = array(
            'uniacid' => $uniacid,
            "title" => $vv['title'],
            "created" => time(),
            "status" => '1',
            "type" => '4',
          );
          pdo_insert("hyb_yl_tank",$data);
        }
        
      }
      message("获取成功",$this->copysiteUrl('ceshi.addruglist').'&ac='.$_W['ac'],"success"); 

   }

   // 一键获取传染病
   public function getlegallist()
   {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $json_text = ST_ROOT."/inc/json/legallist.json";
      $content = file_get_contents($json_text);
      // $url = "https://dxy.com/app/i/ask/special/topic/complex?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&id=1287";
      // $content = $this->send_post($url);
      $content = json_decode($content,true);
      
      $contentss = $content['data']['items'][0]['special_topic_modules'];
      
      foreach($contentss as &$values)
      {
        foreach($values['text_entry_items'] as &$vv)
        {
          $data = array(
            'uniacid' => $uniacid,
            "title" => $vv['title'],
            "created" => time(),
            "status" => '1',
            "type" => '5',
          );
          pdo_insert("hyb_yl_tank",$data);
        }
        
      }
      message("获取成功",$this->copysiteUrl('ceshi.legallist').'&ac='.$_W['ac'],"success"); 

   }

   // 一键获取及病
   public function getdiseaselist()
   {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $json_text = ST_ROOT."/inc/json/diseaselist_list.json";
      $content = file_get_contents($json_text);
      $url = "https://dxy.com/app/i/content/search/tag/index?dxa_entry=event_homepage_top_click_%E6%9F%A5%E7%96%BE%E7%97%85&section_tag_id=6948&tag_category_id=1%2C2%2C6&with_hot_disease=true";
      $content = $this->send_post($url);
      $content = json_decode($content,true);
      
      $contentss = $content['data']['items'];
      
      
      foreach($contentss as &$values)
      {

        foreach($values['tag_list'] as &$vv)
        {

          $data = array(
            'uniacid' => $uniacid,
            "first" => $values['index_name'],
            "title" => $vv['tag_name'],
            "created" => time(),
            "status" => '1',
            "type" => '0',
          );
          
          pdo_insert("hyb_yl_tank",$data);
        }
        
      }
      message("获取成功",$this->copysiteUrl('ceshi.diseaselist').'&ac='.$_W['ac'],"success"); 

   }

   public function send_post($url, $post_data = array(),$method='GET') {

      $postdata = http_build_query($post_data);
      $options = array(
        'http' => array(
          'method' => $method, //or GET
          'header' => 'Content-type:application/x-www-form-urlencoded',
          'content' => $postdata,
          'timeout' => 15 * 60 // 超时时间（单位:s）
        )
      );
      $context = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      return $result;
    }

    // 批量删除类别
    public function del_zhikus()
    {
      global $_W,$_GPC;
      $ids = $_REQUEST['ids'];
      for($i=0;$i<count($ids);$i++)
      {
        pdo_delete("hyb_yl_classgory",array("id" => $ids[$i]));
      }
      die(json_encode(array('errno'=>1,'message'=>1)));
    }

    // 批量删除疾病
    public function del_diseaselists()
    {
      global $_W,$_GPC;
      $ids = $_REQUEST['ids'];
      for($i=0;$i<count($ids);$i++)
      {
        pdo_delete("hyb_yl_tank",array("id" => $ids[$i]));
      }
      die(json_encode(array('errno'=>1,'message'=>1)));

    }
}



