<?php
global $_W;
defined('IN_IA') or exit('Access Denied');
define('ST_ROOT', IA_ROOT . '/addons/hyb_yl/');
define('ST_URL', $_W['siteroot'] . 'addons/hyb_yl/');
define('MODULE', 'hyb_yl');
require_once (IA_ROOT . '/addons/hyb_yl/define.php');
require_once (ST_ROOT . 'class/autoload.php');
require_once (ST_ROOT . 'class/function.php');
require_once (IA_ROOT . '/addons/hyb_yl/inc/web/Data/pdo.class.php');
class Hyb_ylModuleSite extends WeModuleSite {
    public function doWebIndex() {
        global $_GPC, $_W;
        load()->func('tpl');
        
        include $this->template('index');
    }
    public function doWebCopysite() {
        global $_W, $_GPC;
        $_W['plugin'] = $plugin = !empty($_GPC['p']) ? $_GPC['p'] : 'dashboard';
        $_W['controller'] = $controller = !empty($_GPC['ac']) ? $_GPC['ac'] : 'dashboard';
        copysite();
    }
    public function assoc_unique($arr, $key) {
 
        $tmp_arr = array();
         
        foreach ($arr as $k => $v) {
         
        if (in_array($v[$key], $tmp_arr)) {//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
         
        unset($arr[$k]);
         
        } else {
         
        $tmp_arr[] = $v[$key];
         
        }
         
        }
         
        sort($arr); //sort函数对数组进行排序
         
        return $arr;
         
    }
    private function getAge($birthday) { 
          $age = 0; 
          $year = $month = $day = 0; 
          if (is_array($birthday)) { 
             extract($birthday); 
          } else { 
             if (strpos($birthday, '-') !== false) { 
             list($year, $month, $day) = explode('-', $birthday); 
             $day = substr($day, 0, 2); //get the first two chars in case of '2000-11-03 12:12:00' 
        } 
        } 
        $age = date('Y') - $year; 
        if (date('m') < $month || (date('m') == $month && date('d') < $day)) $age--; 
        return $age; 
    }
    public function doWebAlluser() {
        global $_GPC, $_W;
        load()->func('tpl');
        $op = $_GPC['op'];
        $uniacid = $_W['uniacid'];
        if ($op == 'user') {
            if (!empty($_GPC['keyword_user'])) {
                $keyword = $_GPC['keyword_user'];
                $condition = "uniacid=" . $uniacid . " AND u_name='" . $keyword . "'";
                $records = pdo_fetch("SELECT openid,u_name,u_thumb,u_id FROM " . tablename("hyb_yl_userinfo") . " WHERE " . $condition . " LIMIT 1");
            }
            $keyword = $_GPC['keyword_user'];
            $condition = "uniacid=" . $uniacid . " AND (u_name LIKE '%" . $keyword . "%')";
            $records = pdo_fetchall("SELECT openid,u_name,u_thumb,u_id FROM " . tablename("hyb_yl_userinfo") . " WHERE " . $condition);
            include $this->template('common/user');
        }
    }
    public function doWebAlldoctor() {
        global $_GPC, $_W;
        load()->func('tpl');
        $op = $_GPC['op'];
        $uniacid = $_W['uniacid'];
        $hid = $_GPC['hid'];

        $uid = $_W['uid'];
        if ($op == 'user') {
            $keyword = $_GPC['keyword_user'];
            $condition = "uniacid=" . $uniacid . " AND (z_name LIKE '%" . $keyword . "%')";
            if($hid != '')
            {
               $condition .= " and hid=".$hid; 
            }
            $records = pdo_fetchall("SELECT zid,z_name,advertisement,openid FROM " . tablename("hyb_yl_zhuanjia") . " WHERE " . $condition . " AND exa =1 ");
            
            foreach ($records as & $value) {
                $value['advertisement'] = tomedia($value['advertisement']);
            }
            include $this->template('common/doctor');
        }
    }
    public function doWeblist() {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $row = pdo_getall("hyb_yl_menulist", array('uniacid' => $uniacid, 'pid' => $id));
        include $this->template("common/mainHeader");
    }

    //选择器
    public function doWebSelectquery(){
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $op = !empty($_GPC['op'])?$_GPC['op']:'';
        if ($op == "usersearch") {
            $keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
            $condition = " ";
            if (!empty($keyword)) {
                $condition .= "  and u_name like '%$keyword%' ";
            }
            $list = pdo_fetchall("SELECT  * FROM ".tablename("hyb_yl_userinfo")." where uniacid=:uniacid ".$condition,array(":uniacid"=>$uniacid));
            die(json_encode($list));
        }
        if ($op == "zhuanjiasearch") {
            $keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
            $condition = " ";
            if (!empty($keyword)) {
                $condition .= "  and z_name like '%$keyword%' ";
            }
            $list = pdo_fetchall("SELECT  * FROM ".tablename("hyb_yl_zhuanjia")." where uniacid=:uniacid ".$condition,array(":uniacid"=>$uniacid));
            if (!empty($list)) {
                foreach ($list as &$value) {
                    if (strpos($value['advertisement'],"http")===false) {
                        $value['advertisement'] = $_W['attachurl'].$value['advertisement'];
                    }
                }
            }
            die(json_encode($list));
        }
        if ($op == "jigousearch") {
            $keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
            $condition = " ";
            if (!empty($keyword)) {
                $condition .= "  and agentname like '%$keyword%' ";
            }
            $list = pdo_fetchall("SELECT  * FROM ".tablename("hyb_yl_hospital")." where uniacid=:uniacid ".$condition,array(":uniacid"=>$uniacid));
            if (!empty($list)) {
                foreach ($list as &$value) {
                    if (strpos($value['logo'],"http")===false) {
                        $value['logo'] = $_W['attachurl'].$value['logo'];
                    }
                }
            }
            die(json_encode($list));
        }
    }

    public function https_curl_json($url, $data, $type) {
        if ($type == 'json') {
            $headers = array("Content-type: application/json;charset=UTF-8", "Accept: application/json", "Cache-Control: no-cache", "Pragma: no-cache");
            $data = json_encode($data);
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
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
            echo 'Errno' . curl_error($curl); //捕抓异常
            
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
            'timeout' => 15 * 60 // 超时时间（单位:s）
          )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
      }
    }
