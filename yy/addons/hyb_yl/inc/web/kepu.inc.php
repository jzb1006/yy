<?php
/**
* 
*/
 class Kepu extends HYBPage
 { 
    //视频科普列表
    public function site() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $type_id = $_GPC['type_id'];
        $op= $_GPC['op'];
        include $this->template("kepu/list");
    }
    //添加科普
    public function add() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $op= $_GPC['op'];
        $val = $_GPC['val'];
        $type_id = $_GPC['type_id'];
        $model= Model('hjiaosite');
        $cate = Model('hjfenl');
        $category=$cate->where($where)->getall();
        $h_id = intval($_GPC['h_id']);
        $res_list = $model->where("h_id=$h_id and uniacid=$uniacid")->get();
        $data =array(
              'uniacid'   => $_W['uniacid'],
              'h_title'   => $_GPC['h_title'],
              'h_pic'     => $_GPC['h_pic'],
              'h_type'    => 0,
              'h_text'    => $_GPC['h_text'],
              'h_flid'    => $_GPC['h_flid'],
              'h_video'   => $_GPC['h_video'],
              'audios'    => $_GPC['audios'],
              'sfbtime'   => strtotime('now'),
              'h_leixing' => $_GPC['h_leixing'],
              'uid'       => $_W['uid'],
              'zid'       => $_GPC['info']['zid'],
              'z_name'    => $_GPC['info']['z_name'],
            );
        if($_W['ispost']){
                if($h_id){
                     $model->where("h_id=$h_id and uniacid=$uniacid")->save($data);
                     message('成功', 'refresh', 'success');
                }else{
                     $model->add($data);
                     message('成功', 'refresh', 'success');
                }
          
        }
        include $this->template("kepu/add");
    }
 
    public function ajax(){
        global $_W,$_GPC;
        $model =Model('hjiaosite');
        $uniacid =$_W['uniacid'];  
        $tab1 = $model->tablename("hjiaosite"); 
        $tab2 = $model->tablename("hjfenl");
        $uid  = $_W['uid'];
        $type_id = $_GPC['type_id'];
        $sql="SELECT DISTINCT $tab1.h_id,$tab1.*,$tab2.hj_id,$tab2.hj_name from $tab1 LEFT JOIN $tab2 ON $tab1.h_flid=$tab2.hj_id   where $tab1.uniacid='".$uniacid."' and $tab1.uid='".$uid."' order by $tab1.h_id asc";
        $page=$model->pagenation($sql);
        $list=$page['dataset'];
        $data =array(
            'code'=>0,
            'msg'=>'ok',
            'data'=>$list,
            "count"=>$page['count']
            );
      echo  json_encode($data,JSON_UNESCAPED_UNICODE);
      return false;
    }
   //批量删除
    public function deleteall(){
        global $_W,$_GPC;
        $uniacid =$_W['uniacid'];
        $model =Model('hjiaosite');
        $h_id = explode(',', $_GPC['h_id']);
        $type_id = $_GPC['type_id'];
        foreach ($h_id as $key => $value) {
         $res = $model->where('h_id="'.$value.'"')->delete();
        }
        message(error(1, $h_id), '', 'ajax'); 
    }
    //单个删除
    public function del(){
        global $_W,$_GPC;
        $uniacid =$_W['uniacid'];
        $model = Model('hjiaosite');
        $h_id = intval($_GPC['h_id']);
        $type_id = $_GPC['type_id'];
        $res = $model->where('h_id="'.$h_id.'"')->delete();
        message(error(1, $res), '', 'ajax'); 
    } 
    //更新审核
    public function update(){
        global $_W,$_GPC;
        $uniacid =$_W['uniacid'];
        $model =Model('hjiaosite');
        $h_id = intval($_GPC['h_id']);
        $type_id = $_GPC['type_id'];
        $h_shen =intval($_GPC['h_shen']);
        $data = array(
            "h_shen"=>$h_shen
            );
        $res = $model->where('h_id="'.$h_id.'"')->save($data);
        message(error(1, $res), '', 'ajax'); 
    } 
}


