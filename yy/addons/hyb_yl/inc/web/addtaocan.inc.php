<?php 
	global $_W,$_GPC;
	$uniacid=intval($_W['uniacid']);
	require_once dirname(__FILE__) .'/Data/pdo.class.php';
	$model  = new Model('setmeal');
    $caltype= new Model('medicaltype');
    $uid = $_W['uid'];
    $type_id = $_GPC['type_id'];
    $op = isset($_GPC['op'])?$_GPC['op']:'taocan';
	if($op =='taocan'){
		$tab1=$model->tablename("setmeal");
		$tab2=$model->tablename("medicaltype");
		$sql="SELECT DISTINCT $tab1.t_pid,$tab1.*,$tab2.id,$tab2.f_name FROM $tab1 LEFT JOIN $tab2 ON $tab1.t_pid=$tab2.id  WHERE $tab1.uniacid='".$uniacid."' and $tab1.uid='".$uid."' order by $tab1.t_time DESC";
		$page=$model->pagenation($sql);
		$list=$page['dataset'];
		foreach ($list as $key => $value) {
			$list_t_msg =unserialize($list[$key]['t_msg']);
			foreach ($list_t_msg as $k => $v) {
				$list[$key]['t_msg'] = implode(',', $v);
			}
			$list[$key]['t_time'] =date('Y-m-d',$list[$key]['t_time']);
		}
        include $this->template('addtaocan/list');
	}
    if($op == 'jseon'){
		$tid = intval($_GPC['tid']);
		$rew = $model->where("tid=$tid and uniacid=$uniacid")->get();
        $rew_t_tedian =unserialize($rew['t_tedian']);
	    echo json_encode($rew_t_tedian);
	    return false;
    }
	if($op =='add'){
		$city= Model('tijiancity');
		$jglist = Model('jglist');
	    $where="uniacid=$uniacid"; 
	    $city_list = $city->where($where)->getall();
	    foreach ($city_list as $key => $value) {
	    	$city_list[$key]['city'] =$jglist->where('jg_pid="'.$value['ct_id'].'"')->getall();
	    }
		$cate = $caltype->where($where)->page("*");
		$cate_list = $cate['dataset'];
		$tid = intval($_GPC['tid']);
		$rew = $model->where("tid=$tid and uniacid=$uniacid")->get('*');
	    $rew['spic'] =unserialize($rew['spic']);
	    $rew_t_msg =unserialize($rew['t_msg']);
	    $rew_y_msg =unserialize($rew['y_msg']);
        $rew_t_tedian =unserialize($rew['t_tedian']);
        //城市id
        $t_cityid = explode(',', $rew['t_cityid']);
        //部门id
        $t_bmid = explode(',', $rew['t_bmid']);
	    $img_array = $_GPC['img_array'];
	    $title_array = $_GPC['title_array'];
	    $desc_array =$_GPC['desc_array'];
	    $t_msg = $_GPC['t_msg'];
	    $t_msg1 = $_GPC['t_msg1'];
	    $t_msg2 = $_GPC['t_msg2'];
	    $t_msg3 = $_GPC['t_msg3'];
	    $t_msg4 = $_GPC['t_msg4'];
	    foreach ($t_msg as $key => $value) {
	    	$new_msg[$key]['t_msg']=$t_msg[$key];
	    	$new_msg[$key]['t_msg1']=$t_msg1[$key];
	    	$new_msg[$key]['t_msg2']=$t_msg2[$key];
	    	$new_msg[$key]['t_msg3']=$t_msg3[$key];
	    	$new_msg[$key]['t_msg4']=$t_msg4[$key];
	    }
	    foreach ($img_array as $key => $value) {
	    	$new_aray[$key]['src'] = $img_array[$key];
	    	$new_aray[$key]['title'] = $title_array[$key];
	    	$new_aray[$key]['link'] = $desc_array[$key];
	    }

	    $y_msg = $_GPC['y_msg'];
	    $y_msg1 = $_GPC['y_msg1'];
	    $y_msg2 = $_GPC['y_msg2'];
	    $y_msg3 = $_GPC['y_msg3'];
	    $salePrice = $_GPC['salePrice'];
	    foreach ($y_msg as $key => $value) {
	    	$new_msg2[$key]['y_msg']=$y_msg[$key];
	    	$new_msg2[$key]['y_msg1']=$y_msg1[$key];
	    	$new_msg2[$key]['y_msg2']=$y_msg2[$key];
	    	$new_msg2[$key]['y_msg3']=$y_msg3[$key];
	    	$new_msg2[$key]['salePrice']=$salePrice[$key];
	    }
		$data =array(
		      'uniacid'  => $_W['uniacid'],
		      't_name'   => $_GPC['t_name'],
		      't_thumb'  => $_GPC['t_thumb'],
		      't_money'  => $_GPC['t_money'],
		      't_stype'  => $_GPC['t_stype'],
		      't_sex'    => $_GPC['t_sex'],
		      't_age1'   => $_GPC['t_age1'],
		      't_age2'   => $_GPC['t_age2'],
		      't_msg'    => serialize($new_msg),
		      'y_msg'    => serialize($new_msg2),
		      't_time'   => $_GPC['t_time'],
		      't_pid'    => $_GPC['t_pid'],
		      't_desc'   => $_GPC['t_desc'],
		      't_zhuyi'  => $_GPC['t_zhuyi'],
		      'uid'      => $_W['uid'],
		      't_cityid' => $_GPC['cityIdArr'],
		      't_bmid'   => $_GPC['nameIdArr'],
		      't_tedian' => serialize($new_aray)
		    );

	    if($_W['ispost']){
	 		if($tid){
	 			$model->where("tid=$tid and uniacid=$uniacid")->save($data);
	 			message('成功', 'refresh', 'success');
	 		}else{
	 			$model->add($data);
	 			message('成功', 'refresh', 'success');
	 		}
		  
	    }
       include $this->template('addtaocan/add');
	}
	if($op =='order'){
        $res = pdo_fetchall("SELECT a.*,b.tid,b.t_thumb,b.t_name,c.* FROM".tablename('hyb_yl_tijianorder')."as a left join".tablename('hyb_yl_setmeal')."as b on b.tid=a.tid left join".tablename('hyb_yl_userjiaren')."as c on c.j_id=a.j_id where a.uniacid='{$uniacid}' order by a.id desc");
	      foreach ($res as $key => $value) {
	        $res[$key]['t_thumb'] = $_W['attachurl'].$res[$key]['t_thumb'];
	        $res[$key]['content'] = unserialize($res[$key]['content']);
	        $res[$key]['time'] = date("Y-m-d",$res[$key]['time']);
	        if($res[$key]['ifpay']==0){
	            $res[$key]['code'] ="待支付";
	        }
	        if($res[$key]['ifpay']==1){
	            $res[$key]['code'] ="已完成";
	        }
	      }
		 include $this->template('addtaocan/order');
	}
	// if($op =='item'){
	// 	//套餐详情
	//   $id = $_GPC['id'];
	//   $j_id = $_GPC['j_id'];
	//   $res = pdo_fetch("SELECT * FROM".tablename('hyb_yl_tijianorder')."where uniacid =$uniacid and id=$id");
	//   $res['content'] =unserialize($res['content']);
 //      require_once dirname(dirname(dirname(__FILE__))).'/mpdf/mpdf.php';
 //      $mpdf=new mPDF('UTF-8','A4','','',11,11,11,11);
 //      $mpdf->autoScriptToLang = true;//支持中文设置
 //      $mpdf->autoLangToFont = true;//支持中文设置
 // 	  $mpdf->useAdobeCJK = true; 
	//   $mpdf->SetAutoFont(AUTOFONT_ALL);
	//   if(!empty($res['addproject'])){
 //         $prpject = 1;
 //         $res['addproject'] =unserialize($res['addproject']);
	//   }else{
	//   	 $prpject = 0;
	//   }
	//    $arr = $res['content'];
 //       if($_W['ispost']){

 //       	 $lists = array();
 //       	 $jieguo = $_GPC['jieguo'];
 //       	 $jianyi = $_GPC['jianyi'];
	// 	 $jieguo1 = $_GPC['jieguo1'];
	// 	 $jianyi1 = $_GPC['jianyi1'];

	// 	 foreach ($jieguo as $key => $value) {
	// 			$newdate[$key]['jieguo']=$jieguo[$key];  
	// 			$newdate[$key]['jianyi']=$jianyi[$key];
	// 		}

 //         foreach ($arr as $key => $value) {
	// 	       $value['jieguo'] = $newdate[$key]['jieguo'];
	// 	       $value['jianyi'] = $newdate[$key]['jianyi'];
	// 	       $lists[]=$value;
 //         }
 //        if($prpject ==1){
	// 	 foreach ($jieguo1 as $key => $value) {
	// 			$newdate1[$key]['jieguo1']=$jieguo1[$key];  
	// 			$newdate1[$key]['jianyi1']=$jianyi1[$key];
	// 		}
	//          $arr2 = $res['addproject'];
	//          foreach ($arr2 as $key => $value) {
	// 		       $value['jieguo1'] = $newdate1[$key]['jieguo1'];
	// 		       $value['jianyi1'] = $newdate1[$key]['jianyi1'];
	// 		       $lists2[]=$value;
	//          }
 //             pdo_update('hyb_yl_tijianorder',
 //             	array(
 //             		'addproject'=>serialize($lists2),
 //             		'content'=>serialize($lists)
 //             		),
 //             	array('id'=>$id));

	// 		 $date_one = pdo_fetch("SELECT * FROM".tablename('hyb_yl_tijianorder')."where uniacid =$uniacid and id=$id");
	// 		 $date_one['content'] =unserialize($date_one['content']);
	// 		 $date_one['addproject'] =unserialize($date_one['addproject']);
             
	//          $html = '';
	//          $html .='    
	//          <div class="title">
	// 	        <div>项目填写员：<input type="text" placeholder="" class="nameInput"></div>
	// 	    </div>
	// 	    <table width="98%" rules="all" cellpadding="10px" frame="border" >
	// 	        <thead>
	// 	        <tr>
	// 	            <th>项目</th>
	// 	            <th>参考值</th>
	// 	            <th>单位</th>
	// 	            <th>结果</th>
	// 	            <th>医生建议</th>
	// 	        </tr>
	// 	    </thead>
 //            ';
	// 		foreach($date_one['content'] as $item)
	// 		{
 //              $html .="
	// 	        <tbody align=\"center\" bgcolor=\"#fff\">
	// 		        <tr>
	// 		            <td>{$item['t_msg']}</td>
	// 		            <td>{$item['t_msg3']}</td>
	// 		            <td>{$item['t_msg4']}</td>
	// 		            <td>
	// 		                {$item['jieguo']}
	// 		            </td>

	// 		            <td class=\"textarea\">
	// 		                {$item['jianyi']}
	// 		            </td>
	// 		        </tr>
	// 	        </tbody>			
 //              ";
	// 		 }
	// 		 $html.="</table>";
	// 		 $html.='  
	// 			  <div class="title">
	// 		        <div>通用加包项</div>
	// 		     </div>
	// 		    <table width="98%" rules="all" cellpadding="10px" frame="border" >
	// 		        <thead>
	// 		        <tr>
	// 		            <th>项目</th>
	// 		            <th>参考值</th>
	// 		            <th>单位</th>
	// 		            <th>结果</th>
	// 		            <th>医生建议</th>
	// 		        </tr>
	// 		    </thead>
	// 	     ';
 //            foreach ($date_one['addproject']  as $item2) {
 //            	$html.="
	// 	        <tbody align=\"center\" bgcolor=\"#fff\">
	// 		        <tr>
	// 		            <td>{$item2['y_msg']}({$item2['y_msg1']})</td>
	// 		            <td>{$item2['y_msg2']}</td>
	// 		            <td>{$item2['y_msg3']}</td>
	// 		            <td>
	// 		                {$item2['jieguo1']}
	// 		            </td>

	// 		            <td class=\"textarea\">
	// 		                {$item2['jianyi1']}
	// 		            </td>
	// 		        </tr>
	// 	        </tbody>
 //            	";
 //            }
 //             $html.="</table>";
	//          $mpdf->WriteHTML($html);
	//          $path = '../attachment/hyb_yl/'.date('YmdHis').'_'.mt_rand(1,5).'.pdf';
	//          //$mpdf->Output();//直接在页面显示pdf页面内容
	//          $mpdf->Output($path,'f');//保存pdf文件到指定目录 
	//          $pdfurl = $_W['attachurl'].'/hyb_yl/'.date('YmdHis').'_'.mt_rand(1,5).'.pdf';
 //             pdo_update('hyb_yl_tijianorder',array('pdf'=>$pdfurl),array('id'=>$id));
 //             message('提交成功', 'refresh', 'success');
 //          }else{
 //             pdo_update('hyb_yl_tijianorder',array('content'=>serialize($lists)),array('id'=>$id));
	//          $html = '';
	//          $html .='    
	//          <div class="title">
	// 	        <div>项目填写员：<input type="text" placeholder="" class="nameInput"></div>
	// 	    </div>
	// 	    <table width="98%" rules="all" cellpadding="10px" frame="border" >
	// 	        <thead>
	// 	        <tr>
	// 	            <th>项目</th>
	// 	            <th>参考值</th>
	// 	            <th>单位</th>
	// 	            <th>结果</th>
	// 	            <th>医生建议</th>
	// 	        </tr>
	// 	        </thead>

 //            ';
	// 		foreach($arr as $item)
	// 		{
 //              $html .="
	// 	        <tbody align=\"center\" bgcolor=\"#fff\">
	// 		        <tr>
	// 		            <td>{$item['t_msg']}</td>
	// 		            <td>{$item['t_msg3']}</td>
	// 		            <td>{$item['t_msg4']}</td>
	// 		            <td>
	// 		                {$item['jieguo']}
	// 		            </td>

	// 		            <td class=\"textarea\">
	// 		                {$item['jianyi']}
	// 		            </td>
	// 		        </tr>
	// 	        </tbody>			
 //              ";
	// 		 }
	// 		 $html.="</table>";
	//          $mpdf->WriteHTML($html);
	//          $path = '../attachment/hyb_yl/'.date('YmdHis').'_'.mt_rand(1,5).'.pdf';
	//          // $mpdf->Output();//直接在页面显示pdf页面内容
	//          $mpdf->Output($path,'f');//保存pdf文件到指定目录 
	//          $pdfurl = $_W['attachurl'].'/hyb_yl/'.date('YmdHis').'_'.mt_rand(1,5).'.pdf';
 //             pdo_update('hyb_yl_tijianorder',array('pdf'=>$pdfurl),array('id'=>$id));

 //             message('提交成功', 'refresh', 'success');
 //          }
         
 //       }
 //      include $this->template('addtaocan/item');
	// }

	
