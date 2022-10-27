<?php
require_once 'Redis2.class.php';
$redis = new \Redis2('127.0.0.1','63790','','15');
$order_sn = 'SN'.time().'T'.rand(10000000,99999999);
$use_mysql = 1; //是否使用数据库，1使用，2不使用
if($use_mysql == 1){
 /*
 * //数据表
 * CREATE TABLE `order` (
 * `ordersn` varchar(255) NOT NULL DEFAULT '',
 * `status` varchar(255) NOT NULL DEFAULT '',
 * `createtime` varchar(255) NOT NULL DEFAULT '',
 * `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 * PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;
 */
 require_once 'db.class.php';
 $mysql = new \mysql();
 $mysql->connect();
 date_default_timezone_set('PRC');//设置为中华人民共和国zhi
 $data = ['ordersn'=>$order_sn,'status'=>0,'createtime'=>date('Y-m-d H:i:s',time())];
 $mysql->insert('ims_hyb_yl_backorders',$data);
}
$list = [$order_sn,$use_mysql];
$key = implode(':',$list);
$redis->setex($key,3,'redis延迟任务'); //3秒后回调
$test_del = false; //测试删除缓存后是否会有过期回调。结果：没有回调
if($test_del == true){
 //sleep(1);
 $redis->delete($order_sn);
}
echo $order_sn;
/*
 * 测试其他key会不会有回调，结果：有回调
 * $k = 'test';
 * $redis2->set($k,'100');
 * $redis2->expire($k,10);
 *
*/