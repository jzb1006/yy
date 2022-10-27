<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active">
		<a href="#">普通用户概况</a>
	</li>
</ul>
<div class="app-content">
	<div class="panel panel-stat">
		<div class="panel-heading">
			<h3>用户概括</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-3">
				<div class="title">今日新增(人)</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;"><?php  echo $todaynum;?></a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">昨日新增(人)</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;"><?php  echo $yesterdaynum;?></a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">本月新增(人)</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;"><?php  echo $monthnum;?></a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">总客户(人)</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;"><?php  echo $zongyonghunum;?></a>
				</div>
			</div>
		</div>
	</div>
	<div class="page-content">
        <form action="./index.php"  class="form-horizontal" onsubmit='return checkform()'>
           <input type="hidden" name="c" value="site" />
           <input type="hidden" name="a" value="entry" />
           <input type="hidden" name="m" value="hyb_yl" />
           <input type="hidden" name="do" value="copysite" />
           <input type="hidden" name="act"  value="profile.register" />
           <input type="hidden" name="ac" value="register" />
           <input type="hidden" name="search" value="1" />
           <div class="page-toolbar">
               <div class="pull-right" style="padding: 50px 15px;">
                   <div class="input-group">
                       <span class="input-group-select">
                           <select id='days' name="days" >
                               <option value="7"  <?php  if($days==7) { ?>selected<?php  } ?>>最近</option>
                               <option value="7"  <?php  if($days==7) { ?>selected<?php  } ?>>7天</option>
                               <option value="14"  <?php  if($days==14) { ?>selected<?php  } ?>>14天</option>
                               <option value="30"  <?php  if($days==30) { ?>selected<?php  } ?>>30天</option>
                               <option value=""  <?php  if($days=='') { ?>selected<?php  } ?>>按日期</option>
                           </select>
                       </span>
                        <span class="input-group-select">
                            <select id='year' name="year" >
                                <option value=''>年份</option>
                                <?php  if(is_array($years)) { foreach($years as $y) { ?>
                                <option value="<?php  echo $y['data'];?>"  <?php  if($y['selected']) { ?>selected="selected"<?php  } ?>><?php  echo $y['data'];?>年</option>
                                <?php  } } ?>
                            </select>
                        </span>
                       <span class="input-group-select">
                            <select id='month' name="month" >
                                <option value=''>月份</option>
                                <?php  if(is_array($months)) { foreach($months as $m) { ?>
                                <option value="<?php  echo $m['data'];?>"  <?php  if($m['selected']) { ?>selected="selected"<?php  } ?>><?php  echo $m['data'];?>月</option>
                                <?php  } } ?>
                            </select>
                       </span>
                       <div class="input-group-btn">
                           <button class="btn  btn-primary" type="submit"> 搜索</button>
                       </div>
                   </div>
               </div>
           </div>
        </form>
       	<div class="panel panel-default">
         	<div class="panel-heading">会员增长图</div>
           	<div class="panel-body">
               <div id="container" style="min-width: 800px; height: 400px; margin: 0 auto"></div>
           	</div>
       	</div>
	</div>
</div>

<script language="javascript" src="<?php  echo $_W['siteroot'];?>addons/hyb_yl/public/js/highcharts/highcharts.js"></script>
<script type="text/javascript">
   
   	function checkform(){
       if($('#days').val()==''){    
           	if($('#year').val()==''){    
               	alert('请选择年份!');
               	return false;
           	}
       }
       return true;
   	}
      $('#days').change(function(){
            if($(this).val()!=''){ 
                $('#year').val('');
                $('#month').val('').attr('disabled',true);;
            }
          
        })
       $('#year').change(function(){
            if($(this).val()==''){ 
                $('#month').val('').attr('disabled',true);
            }
            else{
                $('#days').val('');
                $('#month').removeAttr('disabled');
            }
        })
        
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                 text: '<?php  echo $charttitle;?>',
            },
            subtitle: {
                text: ''
            },
            colors: [
            '#0061a5',
            '#ff0000'
            ],
            xAxis: {
                categories: [    <?php  if(is_array($datas)) { foreach($datas as $key => $row) { ?>
                       <?php  if($key>0) { ?>,<?php  } ?>"<?php  echo $row['date'];?>"
                       <?php  } } ?>]
            },
            yAxis: {
                title: {
                    text: '人数'
                },allowDecimals:false
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br>'+this.x +': '+ this.y +'°C';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [
                {
                   name: '会员',
                   data: [
                       <?php  if(is_array($datas)) { foreach($datas as $key => $row) { ?>
                       <?php  if($key>0) { ?>,<?php  } ?><?php  echo $row['mcount'];?>
                       <?php  } } ?>
                   ]
                } ]
    	});
	});
</script>
  <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainfooter', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainfooter', TEMPLATE_INCLUDEPATH));?>