<?php
require_once(IA_ROOT . '/framework/library/qrcode/phpqrcode.php');
class erweima{
  public function generate($list)
  {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
    $dir = iconv("UTF-8", "GBK", "../attachment/hyb_yl");
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
    $erweimas = $list['erweima'];
    if($list['erweima'] != '')
    {
      $erweima = $_W['siteroot'].$list['erweima'];
    }else{
      $erweima = '';
    }
    
    if($erweima == '')
    {

      $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$list['appid']}&secret={$list['appsecret']}";

      $getArr = array();
      $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));

      $access_token = $tokenArr->access_token;

      $data = array();
      $data['scene'] = "zid=".$list['zid'];
      $data['page'] = "hyb_yl/czhuanjiasubpages/pages/zhuanjiazhuye/zhuanjiazhuye";
      
      $data = json_encode($data);

      $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $access_token;
      $result = $this->api_notice_increment($url, $data);
       
      if(!is_array($result))
      {
        $image_name = "id_".$list['zid'] . ".jpg";
        $filepath = "../attachment/hyb_yl/{$image_name}";
        $file_put = file_put_contents($filepath, $result);

        if ($file_put) {
            $siteroot = $_W['siteroot'];
            $filepathsss = "attachment/hyb_yl/{$image_name}";
            if($list['thumb'])
            {
              $erweimas = $this->changeAvatar("../".$filepathsss,$list['thumb'],$list['zid']);
              $erweimas = substr($erweimas, 3);
              $erweima =$_W['siteroot'].$erweimas;
              
            }
        }
        
      }
      
    }

    if($erweima != '')
    {

      require_once dirname(__FILE__)."/class/playbill.php";
      $model = new playbill();
      
      $dir = iconv("UTF-8", "GBK", "../attachment/hyb_yl/share_{$uniacid}");
      if (!file_exists($dir)){
          mkdir ($dir,0777,true);
      } 
      $config = array(
        'text'=>array(
          array(
            'text'=>$list['z_name'],
            'left'=>60,
            'top'=>900,
            'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //????????????
            'fontSize'=>54,             //??????
            'fontColor'=>'0,0,0',       //????????????
            'angle'=>0,
          ),
        ),
        'labels'=>array(
          array(
            'text'=>$list['labels'],
            'left'=>60,
            'top'=>980,
            'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //????????????
            'fontSize'=>30,             //??????
            'fontColor'=>'0,0,0',       //????????????
            'angle'=>0,
          ),
        ),
        'hospital'=>array(
          array(
            'text'=>$list['hospital'],
            'left'=>60,
            'top'=>1030,
            'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //????????????
            'fontSize'=>30,             //??????
            'fontColor'=>'0,0,0',       //????????????
            'angle'=>0,
          ),
        ),
        'shanchan'=>array(
          array(
            'text'=>$list['shanchan'],
            'left'=>60,
            'top'=>1130,
            'fontPath'=>'../addons/hyb_yl/public/fonts/simhei.ttf',     //????????????
            'fontSize'=>24,             //??????
            'fontColor'=>'0,0,0',       //????????????
            'angle'=>0,
          ),
        ),
        'image'=>array(
          array(
            'url'=>$erweima,     //???????????????
            'stream'=>0,
            'left'=>520,
            'top'=>900,
            'right'=>0,
            'bottom'=>0,
            'width'=>170,
            'height'=>170,
            'opacity'=>100
          )
        ),
        'tximage'=>array(
          array(
            'url'=>$list['thumb'],     //???????????????
            'stream'=>0,
            'left'=>0,
            'top'=>0,
            'right'=>0,
            'bottom'=>0,
            'width'=>750,
            'height'=>750,
            'opacity'=>100
          )
        ),
        'background'=>empty($list['background']) ? '../addons/hyb_yl/public/images/share.png' : $list['background'],         
      );
      
      $image_name = "id_".$list['zid'] . ".jpg";
      $filename = "../attachment/hyb_yl/share_{$uniacid}/{$image_name}";
      $filename_back = "attachment/hyb_yl/share_{$uniacid}/{$image_name}";
      
      $res = $model->createerweima($config,$filename);

      $share_erweima = $filename_back;
    }
    
    $returns = array(
      'erweima' => $erweimas,
      "share_erweima" => $share_erweima
    );
    

    return $returns;
    

  } 
  public function yuan_img($imgpath) {
        $ext     = pathinfo($imgpath);
        $src_img = null;
        switch ($ext['extension']) {
        case 'jpg':
            $src_img = imagecreatefromjpeg($imgpath);
            break;
        case 'png':
            $src_img = imagecreatefromjpeg($imgpath);
            break;
        }

        $wh  = getimagesize($imgpath);
        $w   = $wh[0];
        $h   = $wh[1];
        $w   = min($w, $h);
        $h   = $w;
        $img = imagecreatetruecolor($w, $h);
        //?????????????????????
        imagesavealpha($img, true);
        //?????????????????????????????????,??????????????????127????????????
        $bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
        imagefill($img, 0, 0, $bg);
        $r   = $w / 2; //?????????
        $y_x = $r; //??????X??????
        $y_y = $r; //??????Y??????
        for ($x = 0; $x < $w; $x++) {
            for ($y = 0; $y < $h; $y++) {
                $rgbColor = imagecolorat($src_img, $x, $y);
                if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                    imagesetpixel($img, $x, $y, $rgbColor);
                }
            }
        }

        return $img;
    }
  public function changeAvatar($file_code_name,$avatar,$zid){
      //??????????????????
      $img_file = file_get_contents($avatar);  //??????????????????????????????????????????????????????
      $img_content= base64_encode($img_file);
      $headurl = "../attachment/hyb_yl/".md5(uniqid(rand())) . ".jpg";
      file_put_contents($headurl,base64_decode($img_content));

      $imgg = $this->yuan_img($headurl); 

      $file_name = "../attachment/hyb_yl/".md5(uniqid(rand())) . ".jpg";
      imagepng($imgg,$file_name);
      imagedestroy($imgg);

      // ????????????????????????1080???430???????????????logo???192???
      $target_im = imagecreatetruecolor(200,200);     //?????????????????????????????????????????????????????????????????????????????????   
      imagesavealpha($target_im, true); 
      $trans_colour = imagecolorallocatealpha($target_im, 0, 0, 0, 127); 
      imagefill($target_im, 0, 0, $trans_colour);                
       
      $o_image = imagecreatefrompng($file_name);   //???????????????????????????????????????????????????
      imagecopyresampled($target_im,$o_image, 0, 0,0, 0, 200, 200, 200, 200);
      $file_head_name = "../attachment/hyb_yl/".md5(uniqid(rand())) . ".jpg";
      $comp_path = $file_head_name;
      imagepng($target_im,$comp_path);
      imagedestroy($target_im);

      // ??????????????????????????????????????????????????????????????????logo???
      //?????????????????????????????????
      $url = $this->create_pic_watermark($file_code_name,$comp_path,"center",$zid); //???????????????????????????
      
      return $url;
  }

  public function create_pic_watermark($dest_image,$watermark,$locate,$zid){
      list($dwidth,$dheight,$dtype)=getimagesize($dest_image);
      list($wwidth,$wheight,$wtype)=getimagesize($watermark);
      $types=array(1 => "GIF",2 => "JPEG",3 => "PNG",
          4 => "SWF",5 => "PSD",6 => "BMP",
          7 => "TIFF",8 => "TIFF",9 => "JPC",
          10 => "JP2",11 => "JPX",12 => "JB2",
          13 => "SWC",14 => "IFF",15 => "WBMP",16 => "XBM");
      $dtype=strtolower($types[$dtype]);//????????????
      $wtype=strtolower($types[$wtype]);//??????????????????
      $created="imagecreatefrom".$dtype;
      $createw="imagecreatefrom".$wtype;
      $imgd=$created($dest_image);
      $imgw=$createw($watermark);
      switch($locate){
          case 'center':
              $x=($dwidth-$wwidth)/2;
              $y=($dheight-$wheight)/2;
              break;
          case 'left_buttom':
              $x=1;
              $y=($dheight-$wheight-2);
              break;
          case 'right_buttom':
              $x=($dwidth-$wwidth-1);
              $y=($dheight-$wheight-2);
              break;
          default:
              die("?????????????????????!");
              break;
      }
      imagecopy($imgd,$imgw,$x,$y,0,0, $wwidth,$wheight);
      $save="image".$dtype;
      //??????????????????
      $f_file_name = "../attachment/hyb_yl/".$zid . ".jpg";
      imagepng($imgd,$f_file_name); //??????
      imagedestroy($imgw);
      imagedestroy($imgd);
      //????????????????????????
      // $url = 'https://www.qubaobei.com/'.str_replace('/opt/ci123/www/html/markets/app2/baby/','',$f_file_name);
      $url = str_replace('/opt/ci123/www/html/markets/app2/baby/','',$f_file_name);
      return $url;
  }
  public function https_curl_json($url, $data, $type) {
      if ($type == 'json') {
          $headers = array("Content-type: application/json;charset=UTF-8", "Accept: application/json", "Cache-Control: no-cache", "Pragma: no-cache");
          $data = json_encode($data);
      }
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1); // ?????????????????????Post??????
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
      if (!empty($data)) {
          curl_setopt($curl, CURLOPT_POST, 1);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      }
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      $output = curl_exec($curl);
      if (curl_errno($curl)) {
          echo 'Errno' . curl_error($curl); //????????????
          
      }
      curl_close($curl);
      return $output;
  }
  public function api_notice_increment($url, $data){
            $ch = curl_init();
           // $header = "Accept-Charset: utf-8";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            //curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $tmpInfo = curl_exec($ch);
            if (curl_errno($ch)) {
              return false;
            }else{
          return $tmpInfo;
      }
    }
   public function send_post($url, $post_data,$method='POST') {

      $postdata = http_build_query($post_data);
      $options = array(
        'http' => array(
          'method' => $method, //or GET
          'header' => 'Content-type:application/x-www-form-urlencoded',
          'content' => $postdata,
          'timeout' => 15 * 60 // ?????????????????????:s???
        )
      );
      $context = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      return $result;
    }
}
?>