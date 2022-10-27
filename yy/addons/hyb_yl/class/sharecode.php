<?php
// error_reporting(E_ALL);
class sharecode{

    public function createSharePng($gData=array(),$fileName=""){

        //如果要看报什么错，可以先注释调这个header

        // if(empty($fileName)) header("content-type: image/png");
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
        $background = $gData['background'];//海报最底层得背景
        //背景方法
        $backgroundInfo = getimagesize($background);
        $backgroundFun = 'imagecreatefrom'.image_type_to_extension($backgroundInfo[2], false);
        // $background = $backgroundFun($background);

        $backgroundWidth = imagesx($background);  //背景宽度
        $backgroundHeight = imagesy($background);  //背景高度
        $im = imageCreatetruecolor($backgroundWidth,$backgroundHeight);
        $color = imagecolorallocate($imageRes, 0, 0, 0);
        // imagefill($im, 0, 0, $color);
        imageColorTransparent($imageRes, $color);  //颜色透明
        imagecopyresampled($imageRes,$background,0,0,0,0,imagesx($background),imagesy($background),imagesx($background),imagesy($background));
  //       //处理了图片
        
        $color = imagecolorallocate($im, 255, 255, 255); 
		//   imagefill($im, 0, 0, $color); 
		// //   //商品图片 
		  list($g_w,$g_h) = getimagesize($gData['thumb'][0]['url']); 

		  $goodImg = $this->createImageFromFile($gData['thumb'][0]['url']);


		//   imagecopyresized($im, $goodImg, $gData['thumb'][0]['left'], $gData['thumb'][0]['top'], $gData['thumb'][0]['right'], $gData['thumb'][0]['bottom'], $gData['thumb'][0]['width'], $gData['thumb'][0]['height'], $g_w, $g_h); 
		//   
		//   //二维码 
		//   list($code_w,$code_h) = getimagesize($gData['erweima'][0]['url']); 

		//   $codeImg = $this->createImageFromFile($gData['erweima'][0]['url']); 
		//   imagecopyresized($im, $codeImg, $gData['erweima'][0]['left'], $gData['erweima'][0]['top'], $gData['erweima'][0]['right'], $gData['erweima'][0]['bottom'], $gData['erweima'][0]['width'], $gData['erweima'][0]['height'], $code_w, $code_h); 

		//   //商品描述 
		//   foreach($gData['text'] &$title)
		//   {
		//   	imagettftext($im, $title['fontSize'],$title['angle'], $title['left'], $title['top'], $title['fontColor'] ,$title['fontPath'], $title['text']); 
		//   }    
			
  //       //生成图片
  //       if(!empty($fileName)){
  //         $res = imagejpeg ($im,$fileName,90); //保存到本地
  //         imagedestroy($im);
  //         if(!$res) return false;
  //         return $fileName;
  //       }else{
  //         imagejpeg ($im);     //在浏览器上显示
  //         imagedestroy($im);
  //       }
    }

	public function createImageFromFile($file){ 
		
echo "<pre>";
        var_dump($url);
        exit();
		if(preg_match('/http(s)?:\/\//',$file)){ 
			$fileSuffix = $this->getNetworkImgType($file);
		}
		
	} 
	public function getNetworkImgType($url){ 
		
		$curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        $http_code = curl_getinfo($curl);
        curl_close($curl);
         
        if($http_code['http_code'] == 200)
        {
        	$theImgType = explode('/', $http_code['content_type']);
        	if($theImgType[0] == 'image')
        	{
        		return $theImgType[1];
        	}else{
        		return false;
        	}
        }else{
        	return false;
        }
	} 

}