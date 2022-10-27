<?php defined('IN_IA') or exit('Access Denied');?>﻿
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>地图数据可视化_大数据html模板 - www.bootstrapmb.com</title>
    <link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>/addons/hyb_yl/web/resource/css/index.css">
    <link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>/addons/hyb_yl/web/resource/fonts/icomoon.css">
</head>

<body>
    <div class="viewport">
        <div class="column">
            <!--概览-->
            <div class="overview panel">
                <div class="inner">
                    <div class="item">
                        <h4><?php  echo $zhuanjia_count;?></h4>
                        <span>
                            <i class="icon-dot" style="color: #006cff"></i>
                            专家总数
                        </span>
                    </div>
                    <div class="item">
                        <h4><?php  echo $user_count;?></h4>
                        <span>
                            <i class="icon-dot" style="color: #6acca3"></i>
                            患者总数
                        </span>
                    </div>
                    <div class="item">
                        <h4><?php  echo $hos_count;?></h4>
                        <span>
                            <i class="icon-dot" style="color: #6acca3"></i>
                            机构总数
                        </span>
                    </div>
                    <div class="item">
                        <h4><?php  echo $tuike_count;?></h4>
                        <span>
                            <i class="icon-dot" style="color: #ed3f35"></i>
                            推客总数
                        </span>
                    </div>
                    <div class="item">
                        <h4><?php  echo $green_count;?></h4>
                        <span>
                            <i class="icon-dot" style="color: #ed3f35"></i>
                            导诊总数
                        </span>
                    </div>
                </div>
            </div>
            <!--监控-->
            <div class="monitor panel">
                <div class="inner">
                    <div class="tabs">
                        <a href="javascript:;" data-index="0" id="jinxing" onclick="getOrder(1)">进行中的订单</a>
                        <a href="javascript:;" data-index="1" id="over" onclick="getOrder(2)">异常退款订单</a>
                    </div>
                    <div class="content" style="display: block;">
                        <div class="head">
                            <span class="col">问诊时间</span>
                            <span class="col">问诊信息</span>
                            <span class="col">订单号</span>
                        </div>
                        <div class="marquee-view">
                            <div class="marquee jinxing">
                                <!-- <div class="row">
                                    <span class="col">20180701</span>
                                    <span class="col">11北京市昌平西路金燕龙写字楼</span>
                                    <span class="col">1000001</span>
                                    <span class="icon-dot"></span>
                                </div> -->
                                
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="head">
                            <span class="col">问诊时间</span>
                            <span class="col">问诊信息</span>
                            <span class="col">订单号</span>
                        </div>
                        <div class="marquee-view">
                            <div class="marquee over">
                               <!--  <div class="row">
                                    <span class="col">20190701</span>
                                    <span class="col">北京市昌平区建材城西路金燕龙写字楼</span>
                                    <span class="col">1000001</span>
                                    <span class="icon-dot"></span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--点位-->
            <div class="point panel">
                <div class="inner">
                    <h3>机构点位分布统计</h3>
                    <div class="chart">
                        <div class="pie"></div>
                        <div class="data">
                            <div class="item">
                                <h4><?php  echo $hos_count;?></h4>
                                <span>
                                    <i class="icon-dot" style="color: #ed3f35"></i>
                                    点位总数
                                </span>
                            </div>
                            <div class="item">
                                <h4><?php  echo $month_hos;?></h4>
                                <span>
                                    <i class="icon-dot" style="color: #eacf19"></i>
                                    本月新增
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <!-- 地图 -->
            <div class="map">
                <h3>
                    <span class="icon-cube"></span>
                    推客数据统计
                </h3>
                <div class="chart">
                    <div class="geo"></div>
                </div>
            </div>
            <!-- 用户 -->
            <div class="users panel">
                <div class="inner">
                    <h3>全国用户总量统计</h3>
                    <div class="chart">
                        <div class="bar"></div>
                        <div class="data">
                            <div class="item">
                                <h4><?php  echo $user_count;?></h4>
                                <span>
                                    <i class="icon-dot" style="color: #ed3f35"></i>
                                    用户总量
                                </span>
                            </div>
                            <div class="item">
                                <h4><?php  echo $month_user;?></h4>
                                <span>
                                    <i class="icon-dot" style="color: #eacf19"></i>
                                    本月新增
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <!-- 订单 -->
            <div class="order panel">
                <div class="inner">
                    <!-- 筛选 -->
                    <div class="filter">
                        <a href="javascript:;" data-key="day365" class="active">365天</a>
                        <a href="javascript:;" data-key="day90">90天</a>
                        <a href="javascript:;" data-key="day30">30天</a>
                        <a href="javascript:;" data-key="day1">24小时</a>
                    </div>
                    <!-- 数据 -->
                    <div class="data">
                        <div class="item">
                            <h4>0</h4>
                            <span>
                                <i class="icon-dot" style="color: #ed3f35;"></i>
                                问诊总数
                            </span>
                        </div>
                        <div class="item">
                            <h4>0</h4>
                            <span>
                                <i class="icon-dot" style="color: #eacf19;"></i>
                                收益额（元）
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 销售额 -->
            <div class="sales panel">
                <div class="inner">
                    <div class="caption">
                        <h3>订单量统计</h3>
                        <a href="javascript:;" class="active" data-type="year">年</a>
                        <a href="javascript:;" data-type="quarter">季</a>
                        <a href="javascript:;" data-type="month">月</a>
                        <a href="javascript:;" data-type="week">周</a>
                    </div>
                    <div class="chart">
                        <div class="label">销售额（元）</div>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <!-- 渠道 季度 -->
            <div class="ordering panel">
                <div class="inner">
                    <!-- 筛选 -->
                    <div class="filter">
                        <a href="javascript:;" data-key="day365" class="active">365天</a>
                        <a href="javascript:;" data-key="day90">90天</a>
                        <a href="javascript:;" data-key="day30">30天</a>
                        <a href="javascript:;" data-key="day1">24小时</a>
                    </div>
                    <!-- 数据 -->
                    <div class="data">
                        <div class="item">
                            <h4>0</h4>
                            <span>
                                <i class="icon-dot" style="color: #ed3f35;"></i>
                                订单总数
                            </span>
                        </div>
                        <div class="item">
                            <h4>0</h4>
                            <span>
                                <i class="icon-dot" style="color: #eacf19;"></i>
                                收益额（元）
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 排行榜 -->
            <div class="top panel" style="height:15.3rem">
                <div class="inner">
                    <div class="all">
                        <h3>全国热榜</h3>
                        <ul>
                            <?php  if(is_array($array)) { foreach($array as $kkk => $a) { ?>
                            <li>
                                <i class="icon-cup<?php  echo ($kkk+1)?>" style="color: #d93f36;"></i>
                                <?php  echo $a['title'];?>
                            </li>
                            <?php  } } ?>
                        </ul>
                    </div>
                    <div class="province">
                        <h3>各省热销 <i class="date">// 近30日 //</i></h3>
                        <div class="data">
                        
                            <ul class="sup">
                                <?php  if(is_array($ress)) { foreach($ress as $ss) { ?>
                                <li>
                                    <span><?php  echo $ss['title'];?></span>
                                    <span><?php  echo $ss['number'];?> <s class="icon-up"></s></span>
                                </li>
                                <?php  } } ?>
                                
                            </ul>
                            <ul class="sub">
                                <!-- <li><span>数据</span><span> 数据<s class="icon-up"></s></span></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="<?php  echo $_W['siteroot'];?>/addons/hyb_yl/web/resource/js2/jquery.min.js"></script>
<script src="https://lib.baomitu.com/echarts/4.2.1/echarts.min.js"></script>
<script src="<?php  echo $_W['siteroot'];?>/addons/hyb_yl/web/resource/js2/index.js"></script>
<script type="text/javascript">
    getOrder(1);
    function getOrder(type)
    {
        $.ajax({
            'url':"<?php  echo $this->createWebUrl('base',array('op'=>'orders'))?>",
            data:{
                type:type,
            },
            dataType:"json",
            type:"get",
            success:function(res){
                var html = "";
                for(var i=0;i<res.length;i++)
                {
                    html += "<div class='row'>";
                    html += "<span class='col'>"+res[i]['time']+"</span>";
                    html += "<span class='col'>"+res[i]['titles']+"</span>";
                    html += "<span class='col'>"+res[i]['back_orser']+"</span>";
                    html += "<span class='icon-dot'></span>";
                    html += "</div>";
                }
                if(type == '1')
                {
                    $(".jinxing").html(html);
                    $("#jinxing").addClass("active")
                    $("#over").removeClass("active")
                }else{
                    $(".over").html(html);
                    $("#over").addClass("active")
                    $("#jinxing").removeClass("active")
                }
            }
        })
    }
</script>
<script src="<?php  echo $_W['siteroot'];?>/addons/hyb_yl/web/resource/js2/china.js"></script>
<script src="<?php  echo $_W['siteroot'];?>/addons/hyb_yl/web/resource/js2/mymap.js"></script>

</html>