<?php
defined('IN_IA') || exit('访问非法');
!defined('MODULE_NAME') && define('MODULE_NAME', 'hyb_yl');
$_W['siteroot'] = str_replace(array('/addons/' . MODULE_NAME, '/core/common', '/addons/hyb_yl'), '', $_W['siteroot']);
!defined('PATH_MODULE') && define('PATH_MODULE', IA_ROOT . '/addons/' . MODULE_NAME . '/');
!defined('URL_MODULE') && define('URL_MODULE', $_W['siteroot'] . 'addons/' . MODULE_NAME . '/');
!defined('WL_URL_AUTH') && define('WL_URL_AUTH', 'http://weixin.weliam.cn/api/api.php');
!defined('PATH_ATTACHMENT') && define('PATH_ATTACHMENT', IA_ROOT . '/attachment/');
!defined('PDO_NAME') && define('PDO_NAME', 'wlmerchant_');
!defined('PATH_APP') && define('PATH_APP', PATH_MODULE . 'app/');
!defined('PATH_WEB') && define('PATH_WEB', PATH_MODULE . 'web/');
!defined('PATH_SYS') && define('PATH_SYS', PATH_MODULE . 'sys/');
!defined('PATH_CORE') && define('PATH_CORE', PATH_MODULE . 'core/');
!defined('PATH_DATA') && define('PATH_DATA', PATH_MODULE . 'data/');
!defined('PATH_PAYMENT') && define('PATH_PAYMENT', PATH_MODULE . 'payment/');
!defined('PATH_PLUGIN') && define('PATH_PLUGIN', PATH_MODULE . 'plugin/');
!defined('URL_APP_RESOURCE') && define('URL_APP_RESOURCE', URL_MODULE . 'app/resource/');
!defined('URL_APP_CSS') && define('URL_APP_CSS', URL_APP_RESOURCE . 'css/');
!defined('URL_APP_JS') && define('URL_APP_JS', URL_APP_RESOURCE . 'js/');
!defined('URL_APP_IMAGE') && define('URL_APP_IMAGE', URL_APP_RESOURCE . 'image/');
!defined('URL_APP_COMP') && define('URL_APP_COMP', URL_APP_RESOURCE . 'components/');
!defined('URL_WEB_RESOURCE') && define('URL_WEB_RESOURCE', URL_MODULE . 'web/resource/');
!defined('URL_WEB_CSS') && define('URL_WEB_CSS', URL_WEB_RESOURCE . 'css/');
!defined('URL_WEB_JS') && define('URL_WEB_JS', URL_WEB_RESOURCE . 'js/');
!defined('URL_WEB_IMAGE') && define('URL_WEB_IMAGE', URL_WEB_RESOURCE . 'image/');
!defined('URL_WEB_COMP') && define('URL_WEB_COPM', URL_WEB_RESOURCE . 'components/');
!defined('URL_WEB_COMP') && define('URL_WEB_DIY', URL_WEB_RESOURCE . 'diy/');
!defined('IMAGE_PIXEL') && define('IMAGE_PIXEL', URL_MODULE . 'web/resource/images/pixel.gif');
!defined('IMAGE_NOPIC_SMALL') && define('IMAGE_NOPIC_SMALL', URL_MODULE . 'web/resource/images/nopic-small.jpg');
!defined('IMAGE_LOADING') && define('IMAGE_LOADING', URL_MODULE . 'web/resource/images/loading.gif');

?>
