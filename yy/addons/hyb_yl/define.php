<?php
if(!defined('IN_IA')){
  exit('Access Denied');
 }
!(defined('HYB_PATH')) && define('HYB_PATH',IA_ROOT.'/addons/hyb_yl');
!(defined('HYB_YL_URL')) && define('HYB_YL_URL', $_W['siteroot'].'addons/hyb_yl/public/');
 //所有样式
!(defined('HYB_YL_ADMIN')) && define('HYB_YL_ADMIN', HYB_YL_URL.'admin');
!(defined('HYB_YL_KS_INC')) && define('HYB_YL_KS_INC', HYB_YL_URL.'ks_inc');
!(defined('HYB_YL_MANAGE')) && define('HYB_YL_MANAGE', HYB_YL_URL.'manage');
!(defined('HYB_YL_PIUS')) && define('HYB_YL_PIUS', HYB_YL_URL.'plus');
!(defined('HYB_YL_SYSLMG')) && define('HYB_YL_SYSLMG', HYB_YL_URL.'SysLmg');
!(defined('HYB_YL_LAYUI')) && define('HYB_YL_LAYUI', HYB_YL_URL.'layui');

?>
