<?php
/**
* 
*/
 class Doctuwenlist extends HYBPage
 { 
   //患者图文咨询列表
  public function haoyoulistwei(){
      global $_W, $_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_REQUEST['openid'];//
      $if_over = $_GPC['if_over'];
      $if_over = !empty($_GPC['if_over']) ? $_GPC['if_over'] : '0';
      //和我对话的列表
      $chat_list = pdo_fetchall("SELECT a.*,b.u_thumb,c.sex,c.age FROM".tablename('hyb_yl_chart_list')."as a left join ".tablename('hyb_yl_userinfo')."as b on b.openid=a.useropenid left join".tablename('hyb_yl_userjiaren')."as c on c.j_id=a.j_id where a.uniacid='{$uniacid}' and a.docopenid='{$openid}' and a.ifover='{$if_over}' order by a.bl_id desc");
      foreach ($chat_list as $key => $value) {
        $chat_list[$key]['time'] =date("Y-m-d",$chat_list[$key]['time']);
      }
       echo json_encode($chat_list);
    }
    //保存聊天记录
    public function save_charmsg(){
      global $_W, $_GPC;
      $uniacid = $_W['uniacid'];
      $curChatMsg =$this->jsondata($_GPC['msg']);
      $doc_roomid = $_GPC['doc_roomid'];
      $use_roomid = $_GPC['use_roomid'];
      $data = array(
        'uniacid' =>$uniacid,
        'sate'     =>$curChatMsg['sate'],
        'style'    =>$curChatMsg['style'],
        'text'     =>$curChatMsg['text'],
        'time'     =>$curChatMsg['time'],
        'type'     =>$curChatMsg['type'],
        'img'      =>$curChatMsg['img'],
        'username' =>$doc_roomid,
        'yourname' =>$use_roomid,
        'mid'      =>$_GPC['mid'],
        'chatType' =>$_GPC['chatType'],
        'style2'   =>$_GPC['style2']
        );
      $res = pdo_insert("hyb_yl_chat_msg_list",$data);
      echo json_encode($res);
    }
    public function select_msg(){
      global $_W, $_GPC;
      $uniacid  = $_W['uniacid'];
      $username = $_GPC['username'];
      $yourname = $_GPC['yourname'];
      $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_chat_msg_list')."where uniacid='{$uniacid}' and (yourname='{$yourname}' and username='{$username}') or (yourname='{$username}' and username='{$yourname}')");
      foreach ($res as $key => $value) {
        $test = array(
            'text'  => $res[$key]['text'],
            'style' => $res[$key]['style'],
            'type'  => $res[$key]['type'],
            'time'  => $res[$key]['time'],
            'sate'  => $res[$key]['sate'],
          );
        $msg = array(
           
            'data'=>array(
              array(
             'data' =>json_encode($test),
             'type'=>$res[$key]['type'],
                ),
            ) 
          );
        $info = array(
            'from' =>$res[$key]['yourname'],
            'to'   =>$res[$key]['username'],
          );
        $res[$key]['chatType'] =$res[$key]['chatType'];
        $res[$key]['info'] =$info;
        $res[$key]['mid'] =$res[$key]['mid'];
        $res[$key]['style'] =$res[$key]['style2'];
        $res[$key]['time'] =$res[$key]['time'];
        $res[$key]['username'] =$res[$key]['username'];
        $res[$key]['yourname'] =$res[$key]['yourname'];
        $res[$key]['msg'] =$msg;
      }
      echo json_encode($res);
    }
       public function jsondata($data)
   {
        $value =htmlspecialchars_decode($data);
        $array =json_decode($value);
        $object =json_decode(json_encode($array),true);
        return $object;
    }
}


