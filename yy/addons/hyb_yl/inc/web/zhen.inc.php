<?php 
/**
* 
*/
class Zhen extends HYBPage
{

   public function zhenlist()
   {
     global $_W,$_GPC;
   	 $op = 'zhenlist';
     $type_id = $_GPC['type_id'];
	   include $this->template('intel/zhenlist');
   }

   public function ajax(){
     	global $_W,$_GPC;
      $type_id = $_GPC['type_id'];
	    $model = new Model('zhenzhuang');
	    $uniacid =$_W['uniacid'];	
   	  $tab2 = $model->tablename("zhenzhuang");
		  $sql="SELECT * from $tab2 where uniacid='".$uniacid."' order by id asc";
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
    public function add(){
      global $_W,$_GPC;
      $uniacid =$_W['uniacid'];
      $id = $_GPC['id'];
      $type_id = $_GPC['type_id'];
      $op = 'zhenlist';
      $model = new Model('zhenzhuang');
      $categories  = $model->where("uniacid='".$uniacid."' and pid='-1'")->getall('id,name,pid');
      $res= $model->where("id='".$id."' and uniacid='".$uniacid."'")->get();
      if($_W['ispost']){
          $data =array(
            'uniacid' => $uniacid,
            'name'    => $_GPC['name'],
            'icon'    => $_GPC['icon'],
            'pid'     => $_GPC['pid'],
            );
          if(empty($res)){
             $model->add($data);
             message('成功', 'refresh', 'success');
             //message("添加成功!",$this->copysiteUrl("Zhen.zhenlist"),"success");
          }else{
             $model->where("id='".$id."'")->save($data);
             message('成功', 'refresh', 'success');
             //message("修改成功!",$this->copysiteUrl("Zhen.zhenlist"),"success");
          }
      }
      include $this->template('intel/add');
    }
   //批量删除
    public function deleteall(){
        global $_W,$_GPC;
        $uniacid =$_W['uniacid'];
        $model = new Model('zhenzhuang');
        $type_id = $_GPC['type_id'];
        $id = explode(',', $_GPC['id']);
        foreach ($id as $key => $value) {
         $res = $model->where('id="'.$value.'"')->delete();
        }
        message(error(1, $res), '', 'ajax'); 
    }
    //单个删除
    public function del(){
        global $_W,$_GPC;
        $uniacid =$_W['uniacid'];
        $type_id = $_GPC['type_id'];
        $model = new Model('zhenzhuang');
        $id = intval($_GPC['id']);
        $res = $model->where('id="'.$id.'"')->delete();
        message(error(1, $res), '', 'ajax'); 
    } 
}

	

   
	
