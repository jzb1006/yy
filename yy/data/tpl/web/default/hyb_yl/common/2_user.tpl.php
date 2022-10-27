<?php defined('IN_IA') or exit('Access Denied');?><div style='max-height:500px;overflow:auto;min-width:580px;'>
<table class="table table-hover" style="min-width:580px;">
    <thead>
        <th></th>
    </thead>
    <tbody>   
        <?php  if(is_array($records)) { foreach($records as $row) { ?>
        <tr>
            <td><img src='<?php  echo $row['u_thumb'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' /> <?php  echo $row['u_name'];?></td>
            <td style="width:80px;"><a href="javascript:;" onclick='select_member(<?php  echo json_encode($row);?>)'>选择</a></td>
        </tr>
        <?php  } } ?>
        <?php  if(count($records)<=0) { ?>
        <tr> 
            <td colspan='4' align='center'>未找到</td>
        </tr>
        <?php  } ?>
    </tbody>
</table>
</div>