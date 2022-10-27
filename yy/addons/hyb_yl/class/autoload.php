<?php 
	global $_W;
	defined('IN_IA') or exit('Access Denied');

	function autoLoad ($classname){

		$file = ST_ROOT.'class/'.$classname.".class.php";
		if( file_exists($file) ){
			include_once ($file);
			return true;
		}
		return false;
	}
	spl_autoload_register('autoLoad',false);


    // 下载文件函数
    function down_remote_file($url,$save_dir='',$filename='',$type=1){

        if(trim($url)==''){
            return array('file_name'=>'','save_path'=>'','error'=>1);
        }
        if(trim($save_dir)==''){
            $save_dir='./';
        }
        if(trim($filename)==''){//保存文件名
            $ext=strrchr($url,'.');

            $filename=time().$ext;
        }
        if(0!==strrpos($save_dir,'/')){
            $save_dir.='/';
        }
        //创建保存目录
        if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
            return array('file_name'=>'','save_path'=>'','error'=>5);
        }

        if($type){
            $ch=curl_init();
            $timeout=100;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            // curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//是否显示头信息
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);//重复跳转
            $img=curl_exec($ch);
            curl_close($ch);
        }else{
            ob_start(); 
            @readfile($url);
            $img=ob_get_contents(); 
            ob_end_clean(); 
        }
        //$size=strlen($img);
        //文件大小 
        $fp2=fopen($save_dir.$filename,'w');

        fwrite($fp2,$img);
        fclose($fp2);
        unset($img,$url);
        return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
    }

    //解压zip文件并覆盖
    function get_zip_originalsize($filename, $path) {
      //先判断待解压的文件是否存在
      if(!file_exists($filename)){
        return false;
      }
      $starttime = explode(' ',microtime()); //解压开始的时间

      //将文件名和路径转成windows系统默认的gb2312编码，否则将会读取不到
      $filename = iconv("utf-8","gb2312",$filename);
      $path = iconv("utf-8","gb2312",$path);
      //打开压缩包
      $resource = zip_open($filename);
      $i = 1;
      //遍历读取压缩包里面的一个个文件
      while ($dir_resource = zip_read($resource)) {
        //如果能打开则继续
        if (zip_entry_open($resource,$dir_resource)) {
          //获取当前项目的名称,即压缩包里面当前对应的文件名
          $file_name = $path.zip_entry_name($dir_resource);
          //以最后一个“/”分割,再用字符串截取出路径部分
          $file_path = substr($file_name,0,strrpos($file_name, "/"));
          //如果路径不存在，则创建一个目录，true表示可以创建多级目录
          if(!is_dir($file_path)){
            mkdir($file_path,0777,true);
          }
          //如果不是目录，则写入文件
          if(!is_dir($file_name)){
            //读取这个文件
            $file_size = zip_entry_filesize($dir_resource);
            //最大读取6M，如果文件过大，跳过解压，继续下一个
            if($file_size<(1024*1024*30)){
              $file_content = zip_entry_read($dir_resource,$file_size);
              file_put_contents($file_name,$file_content);
            }else{
              echo "<p> ".$i++." 此文件已被跳过，原因：文件过大， -> ".iconv("gb2312","utf-8",$file_name)." </p>";
            }
          }
          //关闭当前
          zip_entry_close($dir_resource);
        }
      }
      //关闭压缩包
      zip_close($resource);
      $endtime = explode(' ',microtime()); //解压结束的时间
      $thistime = $endtime[0]+$endtime[1]-($starttime[0]+$starttime[1]);
      $thistime = round($thistime,3); //保留3为小数
      return true;
    }



