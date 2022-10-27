<?php
class playbill{

    public function createPoster($config=array(),$filename=""){
      
        //如果要看报什么错，可以先注释调这个header
        if(empty($filename)) header("content-type: image/png");
        $imageDefault = array(
          'left'=>0,
          'top'=>0,
          'right'=>0,
          'bottom'=>0,
          'width'=>100,
          'height'=>100,
          'opacity'=>100
        );
        $textDefault = array(
          'text'=>'',
          'left'=>0,
          'top'=>0,
          'fontSize'=>32,       //字号
          'fontColor'=>'255,255,255', //字体颜色
          'angle'=>0,
        );
        $background = $config['background'];//海报最底层得背景
        //背景方法
        $backgroundInfo = getimagesize($background);
        $backgroundFun = 'imagecreatefrom'.image_type_to_extension($backgroundInfo[2], false);
        $background = $backgroundFun($background);
        $backgroundWidth = imagesx($background);  //背景宽度
        $backgroundHeight = imagesy($background);  //背景高度
        $imageRes = imageCreatetruecolor($backgroundWidth,$backgroundHeight);
        $color = imagecolorallocate($imageRes, 0, 0, 0);
        imagefill($imageRes, 0, 0, $color);
        // imageColorTransparent($imageRes, $color);  //颜色透明
        imagecopyresampled($imageRes,$background,0,0,0,0,imagesx($background),imagesy($background),imagesx($background),imagesy($background));
        //处理了图片
        if(!empty($config['image'])){
          foreach ($config['image'] as $key => $val) {
            $val = array_merge($imageDefault,$val);
            $info = getimagesize($val['url']);
            $function = 'imagecreatefrom'.image_type_to_extension($info[2], false);
            if($val['stream']){   //如果传的是字符串图像流
              $info = getimagesizefromstring($val['url']);
              $function = 'imagecreatefromstring';
            }
            $res = $function($val['url']);
            $resWidth = $info[0];
            $resHeight = $info[1];
            //建立画板 ，缩放图片至指定尺寸
            $canvas=imagecreatetruecolor($val['width'], $val['height']);
            imagefill($canvas, 0, 0, $color);
            //关键函数，参数（目标资源，源，目标资源的开始坐标x,y, 源资源的开始坐标x,y,目标资源的宽高w,h,源资源的宽高w,h）
            imagecopyresampled($canvas, $res, 0, 0, 0, 0, $val['width'], $val['height'],$resWidth,$resHeight);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']) - $val['width']:$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']) - $val['height']:$val['top'];
            //放置图像
            imagecopymerge($imageRes,$canvas, $val['left'],$val['top'],$val['right'],$val['bottom'],$val['width'],$val['height'],$val['opacity']);//左，上，右，下，宽度，高度，透明度
          }
        }

        //处理了头像图片
        if(!empty($config['tximage'])){
          foreach ($config['tximage'] as $key => $val) {
            $val = array_merge($imageDefault,$val);
            $info = getimagesize($val['url']);
            $function = 'imagecreatefrom'.image_type_to_extension($info[2], false);
            if($val['stream']){   //如果传的是字符串图像流
              $info = getimagesizefromstring($val['url']);
              $function = 'imagecreatefromstring';
            }
            $res = $function($val['url']);
            $resWidth = $info[0];
            $resHeight = $info[1];
            //建立画板 ，缩放图片至指定尺寸
            $canvas=imagecreatetruecolor($val['width'], $val['height']);
            imagefill($canvas, 0, 0, $color);
            //关键函数，参数（目标资源，源，目标资源的开始坐标x,y, 源资源的开始坐标x,y,目标资源的宽高w,h,源资源的宽高w,h）
            imagecopyresampled($canvas, $res, 0, 0, 0, 0, $val['width'], $val['height'],$resWidth,$resHeight);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']) - $val['width']:$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']) - $val['height']:$val['top'];
            //放置图像
            imagecopymerge($imageRes,$canvas, $val['left'],$val['top'],$val['right'],$val['bottom'],$val['width'],$val['height'],$val['opacity']);//左，上，右，下，宽度，高度，透明度
          }
        }
        //处理文字
        if(!empty($config['sctext'])){
            $string = $config['sctext'][0]['text'];
            $fontsize = $config['sctext'][0]['fontSize'];
            $angle= $config['sctext'][0]['angle'];
            $fontface =$config['sctext'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);
              $letter = $arr[0];
              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  if (($testbox[2] > 230) && ($content !== "")) {
                      $content .= PHP_EOL;
                  }
                  $content .= $l;
              }
           foreach ($config['sctext'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        if(!empty($config['text'])){
            $string = $config['text'][0]['text'];
            $fontsize = $config['text'][0]['fontSize'];
            $angle= $config['text'][0]['angle'];
            $fontface =$config['text'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  if (($testbox[2] > 420) && ($content !== "")) {
                      $content .= PHP_EOL;
                  }
                  $content .= $l;
              }
           foreach ($config['text'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        // //五角星
        // if(!empty($config['wujiaox'])){
        //    $width = $config['image'][0]['width'];
        //    $height = $config['image'][0]['height'];
        //    $imageRes = imagecreatetruecolor($width,$height);
        //     //新建一个真彩色图像，返回值为一个图像标识符，背景默认为黑色，参数(x_size*y_size)
        //    $red = imagecolorallocate($imageRes,255,0,0);//定义背景颜色
        //    $yellow = imagecolorallocate($imageRes,237,231,32);//定义黄色
        //    imagefill($imageRes,0,0,$red);//填充颜色，以坐标(0,0)开始起填充
        //   //数组坐标，表示(x1,y1,x2,y2,x3,y3.....x11,y11);
        //    $a = array(90,30,108,73,157,73,119,102,135,152,93,123,52,152,66,102,29,74,76,73,90,30);
        //    imagefilledpolygon($imageRes,$a,10,$yellow);//画一个多边形：10表示顶点总数，$yellow表示填充色
        //    $a1 = array(229,25,229,43,248,48,229,55,229,74,217,60,198,66,210,50,197,34,218,39,229,25);
        //    imagefilledpolygon($imageRes,$a1,10,$yellow);
        //    $a2 = array(227,108,227,127,245,134,228,139,227,157,215,143,196,149,208,132,196,117,215,122,227,108);
        //    imagefilledpolygon($imageRes,$a2,10,$yellow);
        //    $a3 = array(163,184,163,204,181,211,163,216,163,234,152,220,132,225,144,209,132,193,151,199,163,184);
        //    imagefilledpolygon($imageRes,$a3,10,$yellow);
        //    $a4 = array(65,209,65,228,84,235,65,240,65,259,54,245,33,249,46,233,34,217,53,224,68,209);
        //    imagefilledpolygon($imageRes,$a4,10,$yellow);
        //    ob_clean();

        // }
        //生成图片
        if(!empty($filename)){
          $res = imagejpeg ($imageRes,$filename,90); //保存到本地
          imagedestroy($imageRes);
          if(!$res) return false;
          return $filename;
        }else{
          imagejpeg ($imageRes);     //在浏览器上显示
          imagedestroy($imageRes);
        }
    }

    public function createerweima($config=array(),$filename=""){
      
        //如果要看报什么错，可以先注释调这个header
        if(empty($filename)) header("content-type: image/png");
        $imageDefault = array(
          'left'=>0,
          'top'=>0,
          'right'=>0,
          'bottom'=>0,
          'width'=>100,
          'height'=>100,
          'opacity'=>100
        );
        $textDefault = array(
          'text'=>'',
          'left'=>0,
          'top'=>0,
          'fontSize'=>32,       //字号
          'fontColor'=>'255,255,255', //字体颜色
          'angle'=>0,
        );
        
        $background = $config['background'];//海报最底层得背景
        //背景方法
        $backgroundInfo = getimagesize($background);
        $backgroundFun = 'imagecreatefrom'.image_type_to_extension($backgroundInfo[2], false);
        $background = $backgroundFun($background);
        $backgroundWidth = imagesx($background);  //背景宽度
        $backgroundHeight = imagesy($background);  //背景高度
        $imageRes = imageCreatetruecolor($backgroundWidth,$backgroundHeight);
        $color = imagecolorallocate($imageRes, 0, 0, 0);
        imagefill($imageRes, 0, 0, $color);
        // imageColorTransparent($imageRes, $color);  //颜色透明
        imagecopyresampled($imageRes,$background,0,0,0,0,imagesx($background),imagesy($background),imagesx($background),imagesy($background));

        if(!empty($config['image'])){
          foreach ($config['image'] as $key => $val) {
            $val = array_merge($imageDefault,$val);
            $info = getimagesize($val['url']);
            $function = 'imagecreatefrom'.image_type_to_extension($info[2], false);
            if($val['stream']){   //如果传的是字符串图像流
              $info = getimagesizefromstring($val['url']);
              $function = 'imagecreatefromstring';
            }
            $res = $function($val['url']);
            $resWidth = $info[0];
            $resHeight = $info[1];
            //建立画板 ，缩放图片至指定尺寸
            $canvas=imagecreatetruecolor($val['width'], $val['height']);
            imagefill($canvas, 0, 0, $color);
            //关键函数，参数（目标资源，源，目标资源的开始坐标x,y, 源资源的开始坐标x,y,目标资源的宽高w,h,源资源的宽高w,h）
            imagecopyresampled($canvas, $res, 0, 0, 0, 0, $val['width'], $val['height'],$resWidth,$resHeight);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']) - $val['width']:$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']) - $val['height']:$val['top'];
            //放置图像
            imagecopymerge($imageRes,$canvas, $val['left'],$val['top'],$val['right'],$val['bottom'],$val['width'],$val['height'],$val['opacity']);//左，上，右，下，宽度，高度，透明度
          }
        }

        //处理了头像图片
        if(!empty($config['tximage'])){
          foreach ($config['tximage'] as $key => $val) {
            $val = array_merge($imageDefault,$val);
            $info = getimagesize($val['url']);
            $function = 'imagecreatefrom'.image_type_to_extension($info[2], false);
            if($val['stream']){   //如果传的是字符串图像流
              $info = getimagesizefromstring($val['url']);
              $function = 'imagecreatefromstring';
            }
            $res = $function($val['url']);
            $resWidth = $info[0];
            $resHeight = $info[1];
            //建立画板 ，缩放图片至指定尺寸
            $canvas=imagecreatetruecolor($val['width'], $val['height']);
            imagefill($canvas, 0, 0, $color);
            //关键函数，参数（目标资源，源，目标资源的开始坐标x,y, 源资源的开始坐标x,y,目标资源的宽高w,h,源资源的宽高w,h）
            imagecopyresampled($canvas, $res, 0, 0, 0, 0, $val['width'], $val['height'],$resWidth,$resHeight);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']) - $val['width']:$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']) - $val['height']:$val['top'];
            //放置图像
            imagecopymerge($imageRes,$canvas, $val['left'],$val['top'],$val['right'],$val['bottom'],$val['width'],$val['height'],$val['opacity']);//左，上，右，下，宽度，高度，透明度
          }
        }
        //处理文字
        if(!empty($config['labels'])){
            $string = $config['labels'][0]['text'];
            $fontsize = $config['labels'][0]['fontSize'];
            $angle= $config['labels'][0]['angle'];
            $fontface =$config['labels'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  if (($testbox[2] > 420) && ($content !== "")) {
                      $content .= PHP_EOL;
                  }
                  $content .= $l;
              }
           foreach ($config['labels'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        if(!empty($config['hospital'])){
            $string = $config['hospital'][0]['text'];
            $fontsize = $config['hospital'][0]['fontSize'];
            $angle= $config['hospital'][0]['angle'];
            $fontface =$config['hospital'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  if (($testbox[2] > 420) && ($content !== "")) {
                      $content .= PHP_EOL;
                  }
                  $content .= $l;
              }
           foreach ($config['hospital'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        if(!empty($config['shanchan'])){
            $string = $config['shanchan'][0]['text'];
            $fontsize = $config['shanchan'][0]['fontSize'];
            $angle= $config['shanchan'][0]['angle'];
            $fontface =$config['shanchan'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  if (($testbox[2] > 450) && ($content !== "")) {
                      $content .= PHP_EOL;
                  }
                  $content .= $l;
              }
           foreach ($config['shanchan'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, 169,169,169);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        if(!empty($config['text'])){
            $string = $config['text'][0]['text'];
            $fontsize = $config['text'][0]['fontSize'];
            $angle= $config['text'][0]['angle'];
            $fontface =$config['text'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  if (($testbox[2] > 420) && ($content !== "")) {
                      $content .= PHP_EOL;
                  }
                  $content .= $l;
              }
           foreach ($config['text'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left']+1,$val['top']+1,$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left']+2,$val['top']+2,$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        
        //生成图片
        if(!empty($filename)){
          $res = imagejpeg ($imageRes,$filename,90); //保存到本地
          imagedestroy($imageRes);
          if(!$res) return false;
          return $filename;
        }else{
          imagejpeg ($imageRes);     //在浏览器上显示
          imagedestroy($imageRes);
        }
    }

    public function createtijian($config=array(),$filename="",$contents=array()){
        
        //如果要看报什么错，可以先注释调这个header
        if(empty($filename)) header("content-type: image/png");
        $imageDefault = array(
          'left'=>0,
          'top'=>0,
          'right'=>0,
          'bottom'=>0,
          'width'=>100,
          'height'=>100,
          'opacity'=>100
        );
        $textDefault = array(
          'text'=>'',
          'left'=>0,
          'top'=>0,
          'fontSize'=>32,       //字号
          'fontColor'=>'255,255,255', //字体颜色
          'angle'=>0,
        );
        
        $background = $config['background'];//海报最底层得背景
        //背景方法
        $backgroundInfo = getimagesize($background);
        $backgroundFun = 'imagecreatefrom'.image_type_to_extension($backgroundInfo[2], false);
         $background = $backgroundFun($background);
        $backgroundWidth = imagesx($background);  //背景宽度
        $backgroundHeight = imagesy($background);  //背景高度
        $imageRes = imageCreatetruecolor($backgroundWidth,$backgroundHeight);
        $color = imagecolorallocate($imageRes, 0, 0, 0);
        imagefill($imageRes, 0, 0, $color);
        // imageColorTransparent($imageRes, $color);  //颜色透明
        imagecopyresampled($imageRes,$background,0,0,0,0,imagesx($background),imagesy($background),imagesx($background),imagesy($background));
        //处理文字
        // 姓名
        if(!empty($config['name'])){
            $string = $config['name'][0]['text'];
            $fontsize = $config['name'][0]['fontSize'];
            $angle= $config['name'][0]['angle'];
            $fontface =$config['name'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 420) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['name'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        // 性别
        if(!empty($config['sex'])){
            $string = $config['sex'][0]['text'];
            $fontsize = $config['sex'][0]['fontSize'];
            $angle= $config['sex'][0]['angle'];
            $fontface =$config['sex'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 420) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['sex'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, 169,169,169);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        // 年龄
        if(!empty($config['age'])){
            $string = $config['age'][0]['text'];
            $fontsize = $config['age'][0]['fontSize'];
            $angle= $config['age'][0]['angle'];
            $fontface =$config['age'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 420) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['age'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, 169,169,169);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        // 科室
        if(!empty($config['keshi'])){
            $string = $config['keshi'][0]['text'];
            $fontsize = $config['keshi'][0]['fontSize'];
            $angle= $config['keshi'][0]['angle'];
            $fontface =$config['keshi'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 420) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['keshi'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, 169,169,169);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        // 费用
        if(!empty($config['feiyong'])){
            $string = $config['feiyong'][0]['text'];
            $fontsize = $config['feiyong'][0]['fontSize'];
            $angle= $config['feiyong'][0]['angle'];
            $fontface =$config['feiyong'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 420) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['feiyong'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, 169,169,169);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        // 第二行文字（病历号）
        if(!empty($config['bingli'])){
            $string = $config['bingli'][0]['text'];
            $fontsize = $config['bingli'][0]['fontSize'];
            $angle= $config['bingli'][0]['angle'];
            $fontface =$config['bingli'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 450) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['bingli'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, 169,169,169);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        // 第二行文字（地址）
        if(!empty($config['address'])){
            $string = $config['address'][0]['text'];
            $fontsize = $config['address'][0]['fontSize'];
            $angle= $config['address'][0]['angle'];
            $fontface =$config['address'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 450) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['address'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, 169,169,169);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        // 第二行文字（电话）
        if(!empty($config['telphone'])){
            $string = $config['telphone'][0]['text'];
            $fontsize = $config['telphone'][0]['fontSize'];
            $angle= $config['telphone'][0]['angle'];
            $fontface =$config['telphone'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 450) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['telphone'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, 169,169,169);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        // 病情描述
        if(!empty($config['contents'])){
            $string = $config['contents'][0]['text'];
            $fontsize = $config['contents'][0]['fontSize'];
            $angle= $config['contents'][0]['angle'];
            $fontface =$config['contents'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  if (($testbox[2] > 600) && ($content !== "")) {
                      $content .= PHP_EOL;
                  }
                  $content .= $l;
              }
           foreach ($config['contents'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, 169,169,169);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        // 开具时间
        if(!empty($config['time'])){
            $string = $config['time'][0]['text'];
            $fontsize = $config['time'][0]['fontSize'];
            $angle= $config['time'][0]['angle'];
            $fontface =$config['time'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 420) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['time'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, 169,169,169);
            
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }

        // 表格标题
        if(!empty($config['titles'])){
            $string = $config['titles'][0]['text'];
            $fontsize = $config['titles'][0]['fontSize'];
            $angle= $config['titles'][0]['angle'];
            $fontface =$config['titles'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 420) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['titles'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            imageline($imageRes, $val['left']+10, $val['top']+10, $val['left']+700, $val['top']+11, $fontColor);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left']+1,$val['top']+1,$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        
        // 表格内容
        foreach($contents as $i => $keys)
        {
            if(!empty($config['title'.$i])){
              $string = $config['title'.$i][0]['text'];
              $fontsize = $config['title'.$i][0]['fontSize'];
              $angle= $config['title'.$i][0]['angle'];
              $fontface =$config['title'.$i][0]['fontPath'];
              $content = "";
                // 将字符串拆分成一个个单字 保存到数组 letter 中
                preg_match_all("/./u", $string, $arr);

                $letter = $arr[0];

                foreach($letter as $l) {
                    $teststr = $content.$l;
                    $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                    // if (($testbox[2] > 420) && ($content !== "")) {
                    //     $content .= PHP_EOL;
                    // }
                    $content .= $l;
                }
              foreach ($config['title'.$i] as $key => $val) {
                $val = array_merge($textDefault,$val);
                list($R,$G,$B) = explode(',', $val['fontColor']);
                $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
                imageline($imageRes, $val['left']+10, $val['top']+10, $val['left']+700, $val['top']+11, $fontColor);
                $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
                $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
                imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
              }
            }
        }
        
        // 下方文字专家名字
        if(!empty($config['z_name'])){
            $string = $config['z_name'][0]['text'];
            $fontsize = $config['z_name'][0]['fontSize'];
            $angle= $config['z_name'][0]['angle'];
            $fontface =$config['z_name'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 420) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['z_name'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        if(!empty($config['sh_name'])){
            $string = $config['sh_name'][0]['text'];
            $fontsize = $config['sh_name'][0]['fontSize'];
            $angle= $config['sh_name'][0]['angle'];
            $fontface =$config['sh_name'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 420) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['sh_name'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        if(!empty($config['zx_name'])){
            $string = $config['zx_name'][0]['text'];
            $fontsize = $config['zx_name'][0]['fontSize'];
            $angle= $config['zx_name'][0]['angle'];
            $fontface =$config['zx_name'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 420) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['zx_name'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        if(!empty($config['money'])){
            $string = $config['money'][0]['text'];
            $fontsize = $config['money'][0]['fontSize'];
            $angle= $config['money'][0]['angle'];
            $fontface =$config['money'][0]['fontPath'];
            $content = "";
              // 将字符串拆分成一个个单字 保存到数组 letter 中
              preg_match_all("/./u", $string, $arr);

              $letter = $arr[0];

              foreach($letter as $l) {
                  $teststr = $content.$l;
                  $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
                  // if (($testbox[2] > 420) && ($content !== "")) {
                  //     $content .= PHP_EOL;
                  // }
                  $content .= $l;
              }
           foreach ($config['money'] as $key => $val) {
            $val = array_merge($textDefault,$val);
            list($R,$G,$B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
            $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
            imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],mb_convert_encoding($content,'html-entities','UTF-8'));
          }
        }
        
        //生成图片
        if(!empty($filename)){
          $res = imagejpeg ($imageRes,$filename,90); //保存到本地
          imagedestroy($imageRes);
          if(!$res) return false;
          return $filename;
        }else{
          imagejpeg ($imageRes);     //在浏览器上显示
          imagedestroy($imageRes);
        }
    }
}