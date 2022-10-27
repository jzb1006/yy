<?php 

	global $_W,$_GPC;
	$op = $_GPC['op'];
    $_W['plugin'] = 'cloud';
    $uniacid =$_W['uniacid'];

    if($op =='yunlist'){
        $ids = $_GPC['ids'];
        $rwo = pdo_fetch("select count(*) as count from".tablename("hyb_yl_all_server_menulist")."where uniacid='{$uniacid}'");
        $res = pdo_fetchall("select * from".tablename("hyb_yl_all_server_menulist")."where uniacid='{$uniacid}'");


        foreach ($res as $key => $value) {
            $res[$key]['pluginimgs'] =tomedia($res[$key]['pluginimgs']);
        }

        if($_W['ispost']){
            $ids=$_GPC['ids'];
            $statuss = $_GPC['statuss'];
            $pluginimgs = $_GPC['pluginimgs'];
            $server_key = $_GPC['server_key'];
            $titles = $_GPC['titles'];
            $abilitys = $_GPC['abilitys'];
            $displayorders = $_GPC['displayorders'];
            $ser_url = $_GPC['ser_url'];
            for($i=0;$i<count($ids);$i++){
                $ids_b = $ids[$i];
                $statuss_b = $statuss[$i];
                $pluginimgs_b = $pluginimgs[$i];
                $server_key_b = $server_key[$i];
                $titles_b = $titles[$i];
                $abilitys_b = $abilitys[$i];
                $displayorders_b = $displayorders[$i];
                $ser_url_b = $ser_url[$i];
                $data =array(
                     'ids'=> $ids_b,
                     'uniacid' => $_W['uniacid'],
                     'statuss' => $statuss_b,
                     'pluginimgs' => $pluginimgs_b,
                     'server_key' => $server_key_b,
                     'titles'  => $titles_b,
                     'abilitys'=> $abilitys_b,
                     'displayorders' => $displayorders_b,
                     'ser_url' =>$ser_url_b
                    );
             
                if($rwo['count'] == count($ids)){

                // pdo_update('hyb_yl_all_server_menulist',$data,array('ids'=>$ids_b,'uniacid'=>$uniacid));
                }else{
                // pdo_insert('hyb_yl_all_server_menulist',$data);
                }

            }
            message("操作成功!",$this->createWebUrl("cloud",array("op"=>"yunlist")),"success");
        }
        include $this->template('Yun/yunlist');
    }
     if($op =='edit'){
        error_reporting(E_ALL || ~E_NOTICE);
        $module_name = $_GPC['module_name'];
        $file = $_GPC['file'];
        $version = $_GPC['version'];
        $type = $_GPC['type'];
        $module_pic =$_GPC['module_pic'];
        $price =$_GPC['price'];
        $content =base64_decode($_GPC['content']) ;
        $create_time = $_GPC['create_time'];

        $id = $_GPC['id'];
        //检查数据库是否存在一条安装记录
        $res = pdo_get("hyb_yl_downfile",array('module_name'=>$module_name,'file'=>$file,'version'=>$version,'uniacid'=>$uniacid));
        $did =$res['did'];
        if(!$did){
            $state = '0';
        }else{
            $state = '1';
        }
        $id   = $_GPC['id'];
        include $this->template('Yun/yunedit');
    }
    if($op =='insert'){
        $module_name = $_GPC['module_name'];

        $file = $_GPC['file'];
        $version = $_GPC['version'];
        $type = $_GPC['type'];
        $content = $_GPC['content'];
        $create_time = $_GPC['create_time'];
        $id = $_GPC['p_id'];
        $module_pic =$_GPC['module_pic'];
        $url_api = "http://we7.cc/upgrade/install/";
        $price =$_GPC['price'];
    if (strstr($file, 'zip')){
        $pathurl = $url_api . $file;

        $updatedir = ST_ROOT.'Temp/insert';
        if (!is_dir($updatedir)) {
            mkdir($updatedir,0777,true);
        }
        $fileinfo = down_remote_file($pathurl, $updatedir, '');
        $file_path = $updatedir.'/'.$fileinfo['file_name'];
        $zip_status = get_zip_originalsize($file_path, ST_ROOT);
        //删除更新文件
        if (file_exists($fileinfo['save_path'])) 
        {
           unlink($file_path);
        }
        if (!$zip_status){
            $updatenowinfo = "远程文件不存在.升级失败</font>";
        }else{
            $sqlfile = __DIR__ . '/update.sql';

        if(file_exists($sqlfile)){
            $sql = file_get_contents($sqlfile);
            if($sql){
              pdo_run($sql);
              pdo_insert('hyb_yl_downfile',array('module_name'=>$module_name,'file'=>$file,'version'=>$version,'uniacid'=>$uniacid,'state'=>1,'create_time'=>$create_time,'id'=>$id,'content'=>$content,'module_pic'=>$module_pic,'price'=>$price)); 
              unlink($sqlfile);
            }
        }
        $updateinfo = "<font color=red>安装完成 </font><span><a href='".$this->createWebUrl("yunadmin",array("op"=>"bast"))."'>点击这里 查看是否还有升级包</a></span>";

        }
    }else{
        pdo_insert('hyb_yl_downfile',array('module_name'=>$module_name,'file'=>$file,'version'=>$version,'uniacid'=>$uniacid,'state'=>1,'create_time'=>$create_time,'id'=>$id,'content'=>$content,'module_pic'=>$module_pic,'price'=>$price)); 

      }
 
    }

if($op =='datemana'){
 include $this->template('Yun/datemana');
}
if($op =='json_mun'){
    $uniacid = $_W['uniacid'];
    $json_text = ST_ROOT."/inc/json/server_menulist.json";
    $a = file_get_contents($json_text);
    $re = json_decode($a,true);
    //检查是否存在一条当前平台的数据
    $get_limit_one = pdo_fetch("select * from".tablename('hyb_yl_all_server_menulist')."where uniacid ='{$uniacid}' order by ids desc limit 1");
 
    foreach ($re as $key => $value) {
        $ids=$value['ids'];
        $server_key = $value['server_key'];
        $titles = $value['titles'];
        $ser_url = $value['ser_url'];
        $data =array(
             'uniacid' => $_W['uniacid'],
             'server_key' => $server_key,
             'titles'  => $titles,
             'ser_url' =>$ser_url
            );
      if(!$get_limit_one){
        $res=pdo_insert('hyb_yl_all_server_menulist',$data);
      }
      
    }
    if($res){
        message("操作成功!",$this->createWebUrl("cloud",array("op"=>"yunlist")),"success");
    }else{
        message("未检测到更新文件,请勿重复提取!",$this->createWebUrl("cloud",array("op"=>"yunlist")),"error");
    }
    
}