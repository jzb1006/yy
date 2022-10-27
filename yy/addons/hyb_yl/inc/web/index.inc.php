<?php
global $_W, $_GPC;
 $_W['plugin'] ='dashboard';
 $ac = $_GPC['ac'];
 $uniacid = $_W['uniacid'];


 class Index extends HYBPage
 { 

     public function docser()
     {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $op =  !empty($_GPC['op'])?$_GPC['op']:'display';
        if($op == 'display'){
          $res = pdo_fetchall("select * from".tablename('hyb_yl_docser_speck')."where uniacid ='{$uniacid}'");
          include $this->template("index/docserlist");
        }
        if($op =='post'){
            $id = $_GPC['id'];

            $url = $_GPC['url'];
            $res = pdo_fetch("select * from".tablename('hyb_yl_docser_speck')."where uniacid='{$uniacid}' and id ='{$id}'");
            $array=explode('=', $url);
           if($_W['ispost']){
               $data =array(
                 'uniacid'  => $_W['uniacid'],
                 'thumb'    => $_GPC['thumb'],
                 'sort'     => $_GPC['sort'],
                 'titlme'   => $_GPC['titlme'],
                 'ftitle'   => $_GPC['ftitle'],
                 'icon'     => $_GPC['icon'],
                 'url'      => $_GPC['url'],
                 'state'    => $_GPC['state'],
                 'server_content' => $_GPC['server_content'],
                 'key_words'      => $array[1],
                 'time'   => date("Y-m-d H:i:s"),
                 'buyreading'=>$_GPC['buyreading'],
                 'type' => $_GPC['type']
                );

               if(empty($id)){

                 pdo_insert("hyb_yl_docser_speck",$data);
                 message("添加成功!",$this->CopysiteUrl("index.docser"),"success");
               }else{

                 pdo_update("hyb_yl_docser_speck",$data,array('id'=>$id));
                 message("更新成功!",$this->CopysiteUrl("index.docser"),"success");

               }
           }
           include $this->template("index/editdocser");
        }
        
     }
     public function delete(){
        global $_W, $_GPC;
        $uniacid = $_W['uniacid']; 
        $id = $_GPC['id'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $res = pdo_delete("hyb_yl_docser_speck",array('id'=>$id));
        message("删除成功!",$this->CopysiteUrl("index.docser"),"success");
     }
     // 幻灯片列表
   public function adv()
     {
    global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $where .= " where uniacid=".$uniacid;
        $keyword = $_GPC['keyword'];
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $pagesize = 10;
        if($keyword)
        {
            $where .= " and title like '%$keyword%'";
        }
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_adv").$where." order by sort desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        
        foreach($list as &$value)
        {
            if(strpos($value['thumb'],'http') === false)
            {
                $value['thumb'] = $_W['attachurl'].$value['thumb'];
            }
        }
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_adv").$where);
        $pager = pagination($total, $pageindex, $pagesize);
     
        include $this->template("index/adv");
     }
     // 添加幻灯片
     public function addadv()
     {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $adv = pdo_get("hyb_yl_adv",array("id"=>$id));

        if($_W['ispost'])
        {
            $data = array(
                'uniacid' => $_W['uniacid'],
                "title" => $_GPC['title'],
                "sort" => $_GPC['sort'],
                "thumb" => $_GPC['thumb'],
                "link" => $_GPC['link'],
                "status" => $_GPC['status'],
                "position" => $_GPC['position'],
                "appid" => $_GPC['appid'],
                "url" => $_GPC['url'],
                "data" => $_GPC['data'],
            );
            if($id)
            {
                $res = pdo_update("hyb_yl_adv",$data,array("id"=>$id));
            }else{
                $data['created'] = time();
                $res = pdo_insert("hyb_yl_adv",$data);
            }
            if($res)
            {
                message("编辑成功!",$this->CopysiteUrl("index.adv"),"success");
            }else{
                message("编辑失败!",$this->CopysiteUrl("index.adv"),"error");
            }
        }
        include $this->template("index/addadv");
     }
     // 删除幻灯片
     public function adv_del()
     {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $res = pdo_delete("hyb_yl_adv",array("id"=>$id));
        if($res)
        {
            message("删除成功!",$this->CopysiteUrl("index.adv"),"success");
        }else{
            message("删除失败!",$this->CopysiteUrl("index.adv"),"error");
        }
        include $this->template("index/adv");
     }

   public function nav()
     {
    global $_W, $_GPC;
        
      
        include $this->template("index/nav");
     }
   //添加公告
   public function notice()
     {
    global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $item = pdo_get("hyb_yl_node",array("uniacid"=>$uniacid,"type"=>'0'));
        if ($_W['ispost']) {
            $data = array(
                'title' => $_GPC['title'],
                "content" => $_GPC['content'],
                "link" => $_GPC['link'],
                "status" => $_GPC['status'],
                "type" => '0',
                "uniacid" => $_W['uniacid']
            );

            if($item)
            {
                $res = pdo_update("hyb_yl_node",$data,array('id'=>$item['id']));
            }else{
                $res = pdo_insert("hyb_yl_node",$data);
            }
            if($res)
            {
                message("编辑成功!",$this->CopysiteUrl("index.notice"),"success");
            }else{
                message("编辑失败!",$this->CopysiteUrl("index.notice"),"error");
            }
        }
      
        include $this->template("index/notice");
     }
   //公告列表
   public function noticelist()
     {
    global $_W, $_GPC;
        
      
        include $this->template("index/noticelist");
     }
  //广告栏
       public function banner()
     {
    global $_W, $_GPC;
        
      
        include $this->template("index/banner");
     }
    //添加广告
       public function banneradd()
     {
    global $_W, $_GPC;
        
      
        include $this->template("index/banneradd");
     }
   //服务主页
       public function cube()
     {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $res = pdo_fetchall("select * from".tablename('hyb_yl_service_homepage')."as a left join".tablename('hyb_yl_all_server_menulist')."as c on c.ids=a.ids where a.uniacid='{$uniacid}' ");

        include $this->template("index/cube");
     }
      //添加服务主页
       public function cubeedit()
     {
    global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $id = $_GPC['id'];
        $row = pdo_fetchall("select * from".tablename('hyb_yl_all_server_menulist')."where uniacid='{$uniacid}' ");
        $res = pdo_fetch("select * from".tablename('hyb_yl_service_homepage')."where uniacid='{$uniacid}' and id='{$id}'");
        $data = array(
            'uniacid' => $_W['uniacid'],
            'stort'   => $_GPC['stort'],
            'serh_name'    => $_GPC['serh_name'],
            'serh_ftitle'  => $_GPC['serh_ftitle'],
            'serh_thumb'   => $_GPC['serh_thumb'],
            'serh_content' => $_GPC['serh_content'],
            'serh_liuc'    => $_GPC['serh_liuc'],
            'serh_xiey'    => $_GPC['serh_xiey'],
            'ids'          => $_GPC['ids'],
            'state'        => $_GPC['state'],
            'weizhi'       => $_GPC['weizhi'],
            'tui_money'    => $_GPC['tui_money']
            );

        if($_W['ispost']){
           if(empty($id)){
             pdo_insert('hyb_yl_service_homepage',$data);
             message("添加成功!",$this->CopysiteUrl("index.cube"),"success");
           }else{
             pdo_update('hyb_yl_service_homepage',$data,array('id'=>$id));
             message("更新成功!",$this->CopysiteUrl("index.cube"),"success");
           }
        } 
        include $this->template("index/cubeedit");
     }
   //特色服务
       public function plugin()
     {
    global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $res = pdo_fetch("select * from".tablename('hyb_yl_menu_array')."where uniacid ='{$uniacid}'");
        $s_menu = unserialize($res['server_menu']);
      
        $id = $_GPC['id'];
        if($_W['ispost']){
            $server_menu = $_GPC['info'];
            $data = array(
                 'uniacid' =>$_W['uniacid'],
                 'server_menu'  => serialize($server_menu),

                );
            if(empty($id)){
                pdo_insert('hyb_yl_menu_array',$data);
                message("添加成功!",$this->CopysiteUrl("index.plugin"),"success");
            }else{
                pdo_update('hyb_yl_menu_array',$data,array('id'=>$id));
                message("更新成功!",$this->CopysiteUrl("index.plugin"),"success");
            }

        }
        include $this->template("index/plugin");
     }
   //文字设置
       public function characters()
     {
    global $_W, $_GPC;
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        SESSION_START();
        $uniacid = $_W['uniacid'];
        $item = pdo_get("hyb_yl_base",array("uniacid"=>$uniacid));
        if($_W['ispost'])
        {
          

            if ($_SESSION['is_submit'] == '0') { 
                    $_SESSION['is_submit'] = '1'; 
                     $data = array(
                            'hot_title' => $_GPC['hot_title'],
                            "tj_title" => $_GPC['tj_title'],
                            "uniacid" => $_W['uniacid'],
                        );
                        if($item)
                        {
                            $res = pdo_update("hyb_yl_base",$data,array("uniacid"=>$uniacid));
                        }else{
                            $res = pdo_insert("hyb_yl_base",$data);
                        }
                        if($res)
                        {
                            message("设置成功!",$this->CopysiteUrl("index.characters"),"success");
                        }else{
                            message("设置失败!",$this->CopysiteUrl("index.characters"),"error");
                        }
                } else { 
                           message("请勿重复提交!",$this->CopysiteUrl("index.characters"),"error");
                } 

        }
        include $this->template("index/characters");
     }
   //底部菜单
       public function footers()
     {
    global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $res = pdo_fetch("select * from".tablename('hyb_yl_menu_array')."where uniacid ='{$uniacid}'");
        $footers_menu = unserialize($res['footers_menu']);
      
        $id = $_GPC['id'];
        if($_W['ispost']){
            $footers = $_GPC['info'];
            $data = array(
                 'uniacid' =>$_W['uniacid'],
                 'footers_menu' => serialize($footers),
                );

            if(empty($id)){
                pdo_insert('hyb_yl_menu_array',$data);
                message("添加成功!",$this->CopysiteUrl("index.footers"),"success");
            }else{
                pdo_update('hyb_yl_menu_array',$data,array('id'=>$id));
                message("更新成功!",$this->CopysiteUrl("index.footers"),"success");
            }

        }
        include $this->template("index/foot");
     }
     public function cubedelete(){
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $res = pdo_delete('hyb_yl_service_homepage',array('id'=>$id));
        if($res)
        {
            message("删除成功!",$this->CopysiteUrl("index.cube"),"success");
        }else{
            message("删除失败!",$this->CopysiteUrl("index.cube"),"success");
        }
        include $this->template("index/cube");
        
     }

     // 个人中心菜单
     public function mycenter()
     {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $type = $_GPC['type'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $pagesize = 10;
        $where = " where uniacid=".$uniacid." and pid=0";
        if($type)
        {
            $where .= " and type=".$type;
        }
        $keyword = $_GPC['keyword'];
        if($keyword)
        {
            $where .= " and title like '%$keyword%'";
        }

        $list = pdo_fetchall("select * from ".tablename("hyb_yl_mycenter").$where." order by sort desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

        foreach($list as &$value)
        {
            $value['thumb'] = tomedia($value['thumb']);
            $value['child'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_mycenter")." where uniacid=".$uniacid." and pid=".$value['id']);
        }

        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_mycenter").$where);
        $pager = pagination($total, $pageindex, $pagesize);
        
        include $this->template("index/mycenter");
     }
    // 个人中心二级菜单
    public function erjicenter()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $pid = $_GPC['pid'];
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $where = " where uniacid=".$uniacid." and pid=".$pid;
        $keyword = $_GPC['keyword'];
        if($keyword)
        {
            $where .= " and title like '%$keyword%'";
        }
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $pagesize = 10;
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_mycenter").$where." order by sort desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        foreach($list as &$value)
        {
            $value['thumb'] = tomedia($value['thumb']);
            $value['parent'] = pdo_getcolumn("hyb_yl_mycenter",array("id"=>$value['pid']),'title');
        }
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_mycenter").$where);
        $pager = pagination($total, $pageindex, $pagesize);
        include $this->template("index/erjicenter");
    }

    // 编辑个人菜单
    public function editmycenter()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $pid = $_GPC['pid'];
        $type = pdo_getcolumn("hyb_yl_mycenter",array("id"=>$pid),'type');
        
        $item = pdo_get("hyb_yl_mycenter",array("id"=>$id));
        if($item)
        {

            $parent = pdo_getall("hyb_yl_mycenter",array("pid"=>'0',"uniacid"=>$uniacid,"type"=>$item['type']));
        }else{
            $parent = pdo_getall("hyb_yl_mycenter",array("pid"=>'0',"uniacid"=>$uniacid,"type"=>'0'));
        }
        
        if($_W['ispost'])
        {
            $data = array(
                'uniacid' => $uniacid,
                "title" => $_GPC['title'],
                "thumb" => $_GPC['thumb'],
                "pid" => $_GPC['pid'],
                "url" => $_GPC['url'],
                "status" => $_GPC['status'],
                "type" => $_GPC['type'],
                "sort" => $_GPC['sort'],
            );
            if($id)
            {
                $res = pdo_update("hyb_yl_mycenter",$data,array("id"=>$id));
            }else{
                $data['created'] = time();
                $res = pdo_insert("hyb_yl_mycenter",$data);
            }
            if($res)
            {
                if(!$pid)
                {
                    message("编辑成功",$this->CopysiteUrl("index.mycenter"),"success");
                }else{
                    message("编辑成功",$this->CopysiteUrl('index.erjicenter'),"success");
                 
                }
            }else{
                if(!$pid)
                {
                    message("编辑失败",$this->CopysiteUrl('index.mycenter'),"success");
                }else{
                    message("编辑失败",$this->CopysiteUrl('index.erjicenter'),"success");
                 
                }
            }
        }
        include $this->template("index/editcenter");
    }
    // 删除菜单
    public function delmycenter()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $pid = $_GPC['pid'];
        if($pid == '0')
        {
            pdo_delete("hyb_yl_mycenter",array("pid"=>$id,'uniacid'=>$uniacid));
        }
        $res = pdo_delete("hyb_yl_mycenter",array("id"=>$id));
        if($res)
        {
            if($pid == '0')
            {   
                message("删除成功",$this->CopysiteUrl('index.mycenter'),"success");
            }else{
              message("删除成功",$this->CopysiteUrl('index.erjicenter'),"success");
            }
            
        }else{
            if($pid == '0')
            {
                message("删除成功",$this->CopysiteUrl('index.mycenter'),"success");
            }else{
              message("删除成功",$this->createWebUrl('index.erjicenter'),"success");
            }
            // message("删除失败",$this->createWebUrl('index',array('op'=>'special','ac'=>'special')),"error");
            
        }
        if($pid == '0')
        {
            include $this->template("index/mycenter");
        }else{
            include $this->template("index/erjicenter");
        }
    }
    // 查询页面下一级菜单
    public function onecenter()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $type = $_GPC['type'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $parent = pdo_getall("hyb_yl_mycenter",array("uniacid"=>$uniacid,"pid"=>'0',"type"=>$type));
        echo json_encode($parent);
        exit();
    }

    // 修改菜单状态
    public function change_mycenter()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $pid = $_GPC['pid'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $status = $_GPC['status'];
        if($pid == '0')
        {
            pdo_update("hyb_yl_mycenter",array("status"=>$status),array("pid"=>$id));
        }
        $res = pdo_update("hyb_yl_mycenter",array("status"=>$status),array("id"=>$id));
        echo json_encode($res);
    }

    // 特色服务类型
    public function special()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $page = $_GPC['page'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $where = " where uniacid=".$uniacid;
        $server = pdo_getcolumn("hyb_yl_menu_array",array("uniacid"=>$uniacid),'server_menu');
        $server = unserialize($server);
        $server = $server['list'];
        $keyword = $_GPC['keyword'];
        if($keyword)
        {
            $where .= " and title like '%$keyword%'";
        }
        $pagesize = 10;
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_tstype").$where." order by sort desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        foreach($list as &$value)
        {
            foreach($server as &$values)
            {
                if($value['type'] == $values['pinyin'])
                {
                    $value['types'] = $values['name'];
                }
            }
            $value['thumb'] = tomedia($value['thumb']);
        }
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tstype").$where);
        $pager = pagination($total, $pageindex, $pagesize);
        include $this->template("index/special");
    }

    // 添加编辑特色服务项目
    public function addspecial()
    {
        global $_W,$_GPC;
        $id = $_GPC['id'];
        $uniacid = $_W['uniacid'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $item = pdo_get("hyb_yl_tstype",array("id"=>$id,"uniacid"=>$uniacid));
        $server = pdo_getcolumn("hyb_yl_menu_array",array("uniacid"=>$uniacid),'server_menu');
        $server = unserialize($server);
        $server = $server['list'];
        
        if($_W['ispost'])
        {
            $data = array(
                'uniacid' => $uniacid,
                "title" => $_GPC['title'],
                "money" => $_GPC['money'],
                "thumb" => $_GPC['thumb'],
                "vip_money" => $_GPC['vip_money'],
                "status" => $_GPC['status'],
                "sort" => $_GPC['sort'],
                "type" => $_GPC['type'],
            );
            if($id)
            {
                pdo_update("hyb_yl_tstype",$data,array("id"=>$id));
            }else{
                $data['created'] = time();
                pdo_insert("hyb_yl_tstype",$data);
            }
            message("编辑成功",$this->createWebUrl('index',array('op'=>'special','ac'=>'special')),"success");
        }
        include $this->template("index/addspecial");
    }
    // 删除项目
    public function delspecial()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $res = pdo_delete("hyb_yl_tstype",array("id"=>$id));
        if($res)
        {
            message("删除成功",$this->createWebUrl('index',array('op'=>'special','ac'=>'special')),"success");
        }else{
            
            message("删除失败",$this->createWebUrl('index',array('op'=>'special','ac'=>'special')),"error");
            
        }
        
        include $this->template("index/special");
        
    }

    public function change_special()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        if(!empty($_GPC['hid']))
        {
          $lifeTime = 24 * 3600; 
          session_set_cookie_params($lifeTime); 
          session_start();
          $_SESSION["is_hospital"] = '1'; 
          $_SESSION['hid'] = $_GPC['hid'];
          define("is_agent",'1');
          define("hid",$_GPC['hid']);
          $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$_GPC['hid']));
          $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
          $role = unserialize($role);
          define('groupids',$hospital['groupid']);
          $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
          $zjs = '';
          foreach($zhuanjia as &$zj)
          {
            $zjs .= $zj['zid'].",";
          }
          $zjs = substr($zjs,0,strlen($zjs)-1);
          define('zid', $zjs);
        }
        $status = $_GPC['status'];
        
        $res = pdo_update("hyb_yl_tstype",array("status"=>$status),array("id"=>$id));
        echo json_encode($res);
    }

}
