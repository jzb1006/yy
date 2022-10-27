//自调用函数
(function () {
    // 1、页面一加载就要知道页面宽度计算
    var setFont = function () {
        // 因为要定义变量可能和别的变量相互冲突，污染，所有用自调用函数
        var html = document.documentElement;// 获取html
        // 获取宽度
        var width = html.clientWidth;

        // 判断
        if (width < 1024) width = 1024
        if (width > 1920) width = 1920
        // 设置html的基准值
        var fontSize = width / 80 + 'px';
        // 设置给html
        html.style.fontSize = fontSize;
    }
    setFont();
    // 2、页面改变的时候也需要设置
    // 尺寸改变事件
    window.onresize = function () {
        setFont();
    }
})();

(function () {
    //事件委托
    $('.monitor').on('click', ' a', function () {
        //点击当前的a 加类名 active  他的兄弟删除类名
        $(this).addClass('active').siblings().removeClass('active');
        //获取一一对应的下标 
        var index = $(this).index();
        //选取content 然后狗日对应下标的 显示   当前的兄弟.content隐藏
        $('.content').eq(index).show().siblings('.content').hide();
    });
    //滚动
    //原理：把marquee下面的子盒子都复制一遍 加入到marquee中
    //      然后动画向上滚动，滚动到一半重新开始滚动
    //因为选取的是两个marquee  所以要遍历
    $('.monitor .marquee').each(function (index, dom) {
        //将每个 的所有子级都复制一遍
        var rows = $(dom).children().clone();
        //再将新的到的加入原来的
        $(dom).append(rows);
    });

})();

(function () {
    var hospital = {};
var user = {};
var tuike = {};
$.ajax({
    'url':"/index.php?c=site&a=entry&do=base&op=hospital_arr&m=hyb_yl",
    dataType:"json",
    type:"get",
    success:function(res){
        hospital = res
        console.log(hospital)
        var myechart = echarts.init($('.pie')[0]);
    option = {
        // 控制提示
        tooltip: {
            // 非轴图形，使用item的意思是放到数据对应图形上触发提示
            trigger: 'item',
            // 格式化提示内容：
            // a 代表图表名称 b 代表数据名称 c 代表数据  d代表  当前数据/总数据的比例
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        // 控制图表
        series: [
            {
                // 图表名称
                name: '地区',
                // 图表类型
                type: 'pie',
                // 南丁格尔玫瑰图 有两个圆  内圆半径10%  外圆半径70%
                // 百分比基于  图表DOM容器的半径
                radius: ['10%', '70%'],
                // 图表中心位置 left 50%  top 50% 距离图表DOM容器
                center: ['50%', '50%'],
                // 半径模式，另外一种是 area 面积模式
                roseType: 'radius',
                // 数据集 value 数据的值 name 数据的名称
                data: hospital,
                //文字调整
                label: {
                    fontSize: 10
                },
                //引导线
                labelLine: {
                    length: 8,
                    length2: 10
                }
            }
        ],
        color: ['#006cff', '#60cda0', '#ed8884', '#ff9f7f', '#0096ff', '#9fe6b8', '#32c5e9', '#1d9dff']
    };
    myechart.setOption(option);
    }
        
})
    
})();
// 用户
(function () {
    // 中间省略的数据  准备三项
    var titless = {};
    var valuess = {};
    $.ajax({
    'url':"/index.php?c=site&a=entry&do=base&op=user_arr&m=hyb_yl",
    dataType:"json",
    type:"get",
    success:function(res){
        titless = res.title
        valuess = res.value
        var item = {
            name: '',
            value: 1200,
            // 柱子颜色
            itemStyle: {
                color: '#254065'
            },
            // 鼠标经过柱子颜色
            emphasis: {
                itemStyle: {
                    color: '#254065'
                }
            },
            // 工具提示隐藏
            tooltip: {
                extraCssText: 'opacity:0'
            }
        };
        option = {
            // 工具提示
            tooltip: {
                // 触发类型  经过轴触发axis  经过轴触发item
                trigger: 'item',
                // 轴触发提示才有效
                axisPointer: {
                    // 默认为直线，可选为：'line' 线效果 | 'shadow' 阴影效果       
                    type: 'shadow'
                }
            },
            // 图表边界控制
            grid: {
                // 距离 上右下左 的距离
                left: '0',
                right: '3%',
                bottom: '3%',
                top: '5%',
                // 大小是否包含文本【类似于boxsizing】
                containLabel: true,
                //显示边框
                show: true,
                //边框颜色
                borderColor: 'rgba(0, 240, 255, 0.3)'
            },
            // 控制x轴
            xAxis: [
                {
                    // 使用类目，必须有data属性
                    type: 'category',
                    // 使用 data 中的数据设为刻度文字
                    data: titless,
                    // 刻度设置
                    axisTick: {
                        // true意思：图形在刻度中间
                        // false意思：图形在刻度之间
                        alignWithLabel: false,
                        show: false
                    },
                    //文字
                    axisLabel: {
                        color: '#4c9bfd'
                    }
                }
            ],
            // 控制y轴
            yAxis: [
                {
                    // 使用数据的值设为刻度文字
                    type: 'value',
                    axisTick: {
                        // true意思：图形在刻度中间
                        // false意思：图形在刻度之间
                        alignWithLabel: false,
                        show: false
                    },
                    //文字
                    axisLabel: {
                        color: '#4c9bfd'
                    },
                    splitLine: {
                        lineStyle: {
                            color: 'rgba(0, 240, 255, 0.3)'
                        }
                    },
                }
            ],
            // 控制x轴
            series: [

                {
                    // series配置
                    // 颜色
                    itemStyle: {
                        // 提供的工具函数生成渐变颜色
                        color: new echarts.graphic.LinearGradient(
                            // (x1,y2) 点到点 (x2,y2) 之间进行渐变
                            0, 0, 0, 1,
                            [
                                { offset: 0, color: '#00fffb' }, // 0 起始颜色
                                { offset: 1, color: '#0061ce' }  // 1 结束颜色
                            ]
                        )
                    },
                    // 图表数据名称
                    name: '用户统计',
                    // 图表类型
                    type: 'bar',
                    // 柱子宽度
                    barWidth: '60%',
                    // 数据
                    data: valuess
                }
            ]
        };
        var myechart = echarts.init($('.users .bar')[0]);
        myechart.setOption(option);
    }
    })
})();

//问诊
(function () {
    
    $.ajax({
        'url':"/index.php?c=site&a=entry&do=base&op=wenzhen_count&m=hyb_yl",
        dataType:"json",
        type:"get",
        success:function(res){
            var data = {
                day365: res.data1,
                day90: res.data2,
                day30: res.data3,
                day1: res.data4
            }
            //点击事件
            $('.order').on('click', '.filter a', function () {
                //点击之后加类名
                $(this).addClass('active').siblings().removeClass('active');
                // 先获取点击a的 data-key自定义属性
                var key = $(this).attr('data-key');
                //获取自定义属性
                // data{}==>data.shuxing data['shuxing]
                key = data[key];//
                $('.order .item h4:eq(0)').text(key.orders);
                $('.order .item h4:eq(1)').text(key.amount);
            });
            //定时器
            var index = 0;
            var aclick = $('.order a');
            setInterval(function () {
                index++;
                if (index > 3) {
                    index = 0;
                }
                //每san秒调用点击事件
                aclick.eq(index).click();
            }, 3000);
        }
    })
})();
//销售
(function () {
    var date = {};
    var data = {};
    var year_data = {};
    var quarter_data = {};
    var month_data = {};
    var week_data = {};
    var year_time = {};
    var quarter_time = {};
    var month_time = {};
    var week_time = {};
    $.ajax({
        'url':"/index.php?c=site&a=entry&do=base&op=orderss&m=hyb_yl",
        dataType:"json",
        type:"get",
        success:function(res){
            year_data = res.year_data;
            quarter_data = res.season_data;
            month_data = res.month_data;
            week_data:res.week_data
            year_time = res.year_time;
            quarter_time = res.season_time;
            month_time = res.month_time;
            week_time = res.week_time;
            var option = {
                //鼠标提示工具
                tooltip: {
                    trigger: 'axis'
                },
                xAxis: {
                    // 类目类型                                  
                    type: 'category',
                    // x轴刻度文字                                  
                    data: year_time,
                    axisTick: {
                        show: false//去除刻度线
                    },
                    axisLabel: {
                        color: '#4c9bfd'//文本颜色
                    },
                    axisLine: {
                        show: false//去除轴线  
                    },
                    boundaryGap: false//去除轴内间距
                },
                yAxis: {
                    // 数据作为刻度文字                                  
                    type: 'value',
                    axisTick: {
                        show: false//去除刻度线
                    },
                    axisLabel: {
                        color: '#4c9bfd'//文本颜色
                    },
                    axisLine: {
                        show: false//去除轴线  
                    },
                    boundaryGap: false//去除轴内间距
                },
                //图例组件
                legend: {
                    textStyle: {
                        color: '#4c9bfd' // 图例文字颜色

                    },
                    right: '10%'//距离右边10%
                },
                // 设置网格样式
                grid: {
                    show: true,// 显示边框
                    top: '20%',
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    borderColor: '#012f4a',// 边框颜色
                    containLabel: true // 包含刻度文字在内
                },
                series: [{
                    name: '销售额',
                    // 数据                                  
                    data: year_data,
                    // 图表类型                                  
                    type: 'line',
                    // 圆滑连接                                  
                    smooth: true,
                    itemStyle: {
                        color: '#00f2f1'  // 线颜色
                    }
                }]
            };
            var myechart = echarts.init($('.line')[0]);
            myechart.setOption(option);

            //点击效果
            var data = {
                year: year_data,
                quarter: quarter_data,
                month: month_data,
                week: week_data
            }
            var timess = {
                year_time: year_time,
                quarter_time: quarter_time,
                month_time: month_time,
                week_time: week_time
            }
            $('.sales ').on('click', '.caption a', function () {
                $(this).addClass('active').siblings('a').removeClass('active');
                //option series   data
                //获取自定义属性值
                var key = $(this).attr('data-type');
                //取出对应的值
                
                if(key == 'quarter')
                {
                    keys = timess['quarter_time'];
                }else if(key == 'month')
                {
                    keys = timess['month_time'];
                }else if(key == 'week')
                {
                    keys = timess['week_time'];
                }else if(key == 'year')
                {
                    keys = timess['year_time'];
                }
                key = data[key];
                //将值设置到 图表中
                option.xAxis.data = keys;
                option.series[0].data = key;
                //再次调用才能在页面显示
                myechart.setOption(option);
            });
            //定时器
            var index = 0;
            var timer = setInterval(function () {
                index++;
                if (index > 4) {
                    index = 0;
                };
                $('.sales .caption a').eq(index).click();
            }, 2000);
        }
    })
})();
(function () {
     $.ajax({
        'url':"/index.php?c=site&a=entry&do=base&op=goods_orders&m=hyb_yl",
        dataType:"json",
        type:"get",
        success:function(res){
            var data = res
            $('.inner').on('mouseenter', '.sup li', function () {
                $(this).addClass('active').siblings().removeClass('active');
                //获取随机的值  sort方法 是给数组排序 a-b是从小到大
                //.5-随机0-1的数 可能为正可能为负 排序就会随机
                var radomData = data.sort(function (a, b) { return 0.5 - Math.random() });
                var html = '';
                radomData.forEach(function (item) {
                    html += `<li><span>${item.title}</span><span>${item.num} <s class="icon-up"></s></span></li>`;
                });
                //渲染
                $('.sub').html(html);
            });
            $('.province .sup li').eq(0).mouseenter();
            var index = 0;
            var timer = setInterval(() => {
                index++;
                if (index > 5) {
                    index = 0;
                }
                $('.sup li').eq(index).mouseenter();
            }, 2000);
        }
    })
    
})();
//订单
(function () {
    
    $.ajax({
        'url':"/index.php?c=site&a=entry&do=base&op=order&m=hyb_yl",
        dataType:"json",
        type:"get",
        success:function(res){
            var data = {
                day365: res.data1,
                day90: res.data2,
                day30: res.data3,
                day1: res.data4
            }
            //点击事件
            $('.ordering').on('click', '.filter a', function () {
                //点击之后加类名
                $(this).addClass('active').siblings().removeClass('active');
                // 先获取点击a的 data-key自定义属性
                var key = $(this).attr('data-key');
                //获取自定义属性
                // data{}==>data.shuxing data['shuxing]
                key = data[key];//
                $('.ordering .item h4:eq(0)').text(key.orders);
                $('.ordering .item h4:eq(1)').text(key.amount);
            });
            //定时器
            var index = 0;
            var aclick = $('.ordering a');
            setInterval(function () {
                index++;
                if (index > 3) {
                    index = 0;
                }
                //每san秒调用点击事件
                aclick.eq(index).click();
            }, 3000);
        }
    })
})();
(function () {
    var option = {
        series: [
            {
                type: 'pie',
                radius: ['130%', '150%'],  // 放大图形
                center: ['50%', '80%'],    // 往下移动  套住75%文字
                label: {
                    show: false,
                },
                startAngle: 180,
                hoverOffset: 0,  // 鼠标经过不变大
                data: [
                    {
                        value: 100,
                        itemStyle: { // 颜色渐变#00c9e0->#005fc1
                            color: {
                                type: 'linear',
                                x: 0,
                                y: 0,
                                x2: 0,
                                y2: 1,
                                colorStops: [
                                    { offset: 0, color: '#00c9e0' },
                                    { offset: 1, color: '#005fc1' }
                                ]
                            }
                        }
                    },
                    { value: 100, itemStyle: { color: '#12274d' } }, // 颜色#12274d

                    { value: 200, itemStyle: { color: 'transparent' } }// 透明隐藏第三块区域
                ]
            }
        ]
    };
    var myechart = echarts.init($('.gauge')[0]);
    myechart.setOption(option);
})();
