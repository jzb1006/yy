<?php
defined('IN_IA') or exit('Access Denied');

class Data {

    static function _calc_current_frames2(&$frames) {
        global $_W, $_GPC;
       
        if (!empty($frames) && is_array($frames)) {
        
            foreach ($frames as &$frame) {
              
                foreach ($frame['items'] as &$fr) {
                  
                    if (count($fr['actions']) == 2) {
                     
                        if (is_array($fr['actions']['1'])) {
                       
                            $fr['active'] = in_array($_GPC[$fr['actions']['0']], $fr['actions']['1']) ? 'active' : '';
                        } else {
                  
                            if ($fr['actions']['1'] == $_GPC[$fr['actions']['0']]) {
                                $fr['active'] = 'active';
                            }
                        }
                    } elseif (count($fr['actions']) == 3) {
                        if (($fr['actions']['1'] == $_GPC[$fr['actions']['0']] || @in_array($_GPC[$fr['actions']['0']], $fr['actions']['1'])) && ($fr['actions']['2'] == $_GPC['do'] || @in_array($_GPC['do'], $fr['actions']['2']))) {
                            $fr['active'] = 'active';
                        }
                    } elseif (count($fr['actions']) == 4) {
                        if (($fr['actions']['1'] == $_GPC[$fr['actions']['0']] || @in_array($_GPC[$fr['actions']['0']], $fr['actions']['1'])) && ($fr['actions']['3'] == $_GPC[$fr['actions']['2']] || @in_array($_GPC[$fr['actions']['2']], $fr['actions']['3']))) {
                            $fr['active'] = 'active';
                        }
                    } elseif (count($fr['actions']) == 5) {
                        if ($fr['actions']['1'] == $_GPC[$fr['actions']['0']] && $fr['actions']['3'] == $_GPC[$fr['actions']['2']] && $fr['actions']['4'] == $_GPC['status']) {
                            $fr['active'] = 'active';
                        }
                    } else {
                        
                        $query = parse_url($fr['url'], PHP_URL_QUERY);
                        parse_str($query, $urls);
                        if (defined('ACTIVE_FRAME_URL')) {
                            $query = parse_url(ACTIVE_FRAME_URL, PHP_URL_QUERY);
                            parse_str($query, $get);
                        } else {
                            $get = $_GET;
                        }
                        if (!empty($_GPC['a'])) {
                            $get['a'] = $_GPC['a'];
                        }
                        if (!empty($_GPC['c'])) {
                            $get['c'] = $_GPC['c'];
                        }
                        if (!empty($_GPC['do'])) {
                            $get['do'] = $_GPC['do'];
                        }
                        if (!empty($_GPC['ac'])) {
                            $get['ac'] = $_GPC['ac'];
                        }
                        if (!empty($_GPC['status'])) {
                            $get['status'] = $_GPC['status'];
                        }
                        if (!empty($_GPC['p'])) {
                            $get['p'] = $_GPC['p'];
                        }
                        if (!empty($_GPC['op'])) {
                            $get['op'] = $_GPC['op'];
                        }
                        if (!empty($_GPC['m'])) {
                            $get['m'] = $_GPC['m'];
                        }
                        $diff = array_diff_assoc($urls, $get);
                   
                        if (empty($diff)) {
                         
                            $fr['active'] = 'active';
                        } else {
                            $fr['active'] = '';
                        }
                    }
                }
            }
        }
    }
    /**
     * static function ????????????
     *
     * @access static
     * @name topmenus
     * @param
     * @return array
     */
    static function webMenu() {
        global $_GPC,$_W;
        $frames = array();
        $hid = $_SESSION['hid'];
        $frames['dashboard']['title'] = '<i class="fa fa-desktop"></i> ??????';
      	$frames['dashboard']['url'] ='index.php?c=site&a=entry&do=dashboard&op=gk&m=hyb_yl&ac=dashboard&hid='.$hid;
        $frames['dashboard']['active'] = 'dashboard';
        $frames['dashboard']['jurisdiction'] = 'dashboard';
        
        $frames['member']['title'] = '<i class="fa fa-user"></i> ??????';
        $frames['member']['url'] ='index.php?c=site&a=entry&op=userlist&do=copysite&m=hyb_yl&act=profile.userlist&ac=notice'; 
        $frames['member']['active'] = 'member';
        
        $frames['store']['title'] = '<i class="fa fa-heart"></i> ??????';
        $frames['store']['url'] = Util::webUrl("team", array( "op" => "doctor",'ac'=>'docindex','hid'=>$hid));
        $frames['store']['active'] = 'store';
        $frames['store']['jurisdiction'] = 'store';
        $frames['jigou']['title'] = '<i class="fa fa-envelope-o"></i> ??????';
        $frames['jigou']['url'] = 'index.php?c=site&a=entry&do=jiancha&op=display&m=hyb_yl&ac=jgindex&h_id='.$hid;
        $frames['jigou']['active'] = 'jigou';
        $frames['jigou']['jurisdiction'] = 'jigou';
        
           
        $frames['look']['title'] = '<i class="fa fa-th-list"></i> ??????';
        $frames['look']['url'] ='index.php?c=site&a=entry&do=classification&op=list&m=hyb_yl&ac=arlist';
        $frames['look']['active'] = 'look';
        $frames['look']['jurisdiction'] = 'look';
        
        $frames['remoteregistration']['title'] = '<i class="fa fa-signal"></i> ??????';
        $frames['remoteregistration']['url'] ='index.php?c=site&a=entry&do=remoteregistration&op=gk&m=hyb_yl&ac=remoteregistration&hid='.$hid;
        $frames['remoteregistration']['active'] = 'remoteregistration';
        $frames['remoteregistration']['jurisdiction'] = 'remoteregistration';
      
        $frames['ask']['title'] = '<i class="fa fa-home"></i> ??????';
        $frames['ask']['url'] ='index.php?c=site&a=entry&do=ask&op=index&m=hyb_yl&ac=askgk&hid='.$hid;
        $frames['ask']['active'] = 'ask';
        $frames['ask']['jurisdiction'] = 'ask';
        
        $frames['sign']['title'] = '<i class="fa fa-clock-o"></i> ??????';
        $frames['sign']['url'] ='index.php?c=site&a=entry&do=sign&op=index&m=hyb_yl&ac=cashrecord&hid='.$hid;
        $frames['sign']['active'] = 'sign';
        $frames['sign']['jurisdiction'] = 'sign';
       
        $frames['physical']['title'] = '<i class="fa fa-inbox"></i> ??????';
        $frames['physical']['url'] = 'index.php?c=site&a=entry&do=physical&op=index&m=hyb_yl&ac=cashrecord&hid='.$hid;
        $frames['physical']['active'] = 'physical';
        $frames['physical']['jurisdiction'] = 'physical';
        
        $frames['medicine']['title'] = '<i class="fa fa-play-circle-o"></i> ??????';
        $frames['medicine']['url'] = 'index.php?c=site&a=entry&do=medicine&op=index&m=hyb_yl&ac=medicinesys&hid='.$hid;
        $frames['medicine']['active'] = 'medicine';
        $frames['medicine']['jurisdiction'] = 'medicine';
        
        $frames['zhiku']['title'] = '<i class="fa fa-lock"></i> ??????';
        $frames['zhiku']['url'] = 'index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.lists&ac=addappAttributelist';
        $frames['zhiku']['active'] = 'zhiku';
        $frames['zhiku']['jurisdiction'] = 'zhiku';
        
        $frames['green']['title'] = '<i class="fa fa-list"></i> ??????';
        $frames['green']['url'] = 'index.php?c=site&a=entry&do=green&op=index&m=hyb_yl&ac=green&hid='.$hid;
        $frames['green']['active'] = 'green';
        $frames['green']['jurisdiction'] = 'green';
      
        $frames['order']['title'] = '<i class="fa fa-list"></i> ??????';
        $frames['order']['url'] = 'index.php?c=site&a=entry&do=order&op=tjorder&ac=tjorder&m=hyb_yl&hid='.$hid;
        $frames['order']['active'] = 'order';
        $frames['order']['jurisdiction'] = 'order';

        $frames['financ']['title'] = '<i class="fa fa-money"></i> ??????';
        $frames['financ']['url'] = 'index.php?c=site&a=entry&do=financ&op=index&m=hyb_yl&ac=cashrecord&hid='.$hid;
        $frames['financ']['active'] = 'financ';
        $frames['financ']['jurisdiction'] = 'financ';

        $frames['datacenter']['title'] = '<i class="fa fa-qrcode" ></i> ??????';
        $frames['datacenter']['url'] = 'index.php?c=site&a=entry&do=datum&op=index&m=hyb_yl&ac=operationstatistics&hid='.$hid;
        $frames['datacenter']['active'] = 'datacenter';
        $frames['datacenter']['jurisdiction'] = 'datacenter';
      
        
        $frames['apply']['title'] = '<i class="fa fa-cubes" ></i> ??????';
        $frames['apply']['url'] = 'index.php?c=site&a=entry&op=apply&do=apply&m=hyb_yl&ac=docapp';
        $frames['apply']['active'] = 'apply';
        $frames['apply']['jurisdiction'] = 'apply';

        $frames['setting']['title'] = '<i class="fa fa-gear"></i> ??????';
        $frames['setting']['url'] ='index.php?c=site&a=entry&do=base&op=basesite&m=hyb_yl&ac=base';
        $frames['setting']['active'] = 'setting';
        $frames['setting']['jurisdiction'] = 'setting';

        $frames['cloud']['title'] = '<i class="fa fa-headphones"></i> ?????????';
        $frames['cloud']['url'] = 'index.php?c=site&a=entry&op=yunlist&do=cloud&m=hyb_yl&ac=index';
        $frames['cloud']['active'] = 'cloud';
        $frames['cloud']['jurisdiction'] = 'cloud';
        
        return $frames;
    }
    /**
     * static function ??????????????????
     *
     * @access static
     * @name getdashboardFrames
     * @param
     * @return array
     */
    static function getdashboardFrames() {
        global $_W;
        $hid = $_SESSION['hid'];
        $frames = array();
        $frames['survey']['title'] = '<i class="fa fa-dashboard"></i> ??????';
        $frames['survey']['items'] = array();
	
        $frames['survey']['items']['setting']['url'] = Util::webUrl("base", array( "ac" => "basesite",));
      	$frames['page']['items']['notice']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.basesite&ac=basesite";
        $frames['survey']['items']['setting']['title'] = '????????????';
        $frames['survey']['items']['setting']['actions'] = array('ac', 'basesite');
        $frames['survey']['items']['setting']['active'] = '';
        
       	$frames['survey']['items']['setting']['url'] = Util::webUrl("dashboard", array( "op" => "gk",'ac'=>'dashboard','hid'=>$hid));
        $frames['survey']['items']['setting']['title'] = '????????????';
      	$frames['survey']['items']['setting']['actions'] = array('ac', 'dashboard');
        $frames['survey']['items']['setting']['active'] = '';


        $frames['survey']['items']['tggk']['url'] = Util::webUrl("dashboard", array( "op" => "tggk",'ac'=>'tggk'));
        $frames['survey']['items']['tggk']['title'] = '????????????';
        $frames['survey']['items']['tggk']['actions'] = array('ac', 'tggk');
        $frames['survey']['items']['tggk']['active'] = '';
        
        $frames['survey']['items']['orderarea']['url'] = Util::webUrl("dashboard", array( "op" => "orderarea",'ac'=>'orderarea','hid'=>$hid));
        $frames['survey']['items']['orderarea']['title'] = '????????????';
        $frames['survey']['items']['orderarea']['actions'] = array('ac', 'orderarea');
        $frames['survey']['items']['orderarea']['active'] = '';
      
       
        $frames['survey']['items']['financialstaus']['url'] = Util::webUrl("dashboard", array( "op" => "financialstaus",'ac'=>'financialstaus','hid'=>$hid));
        $frames['survey']['items']['financialstaus']['title'] = '????????????';
        $frames['survey']['items']['financialstaus']['actions'] = array('ac', 'financialstaus');
        $frames['survey']['items']['financialstaus']['active'] = '';
        
        $frames['page']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['page']['items'] = array();
        $frames['page']['items']['notice']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.notice&ac=noticelist&hid=".$hid;
        $frames['page']['items']['notice']['title'] = '??????';
        $frames['page']['items']['notice']['actions'] = array('ac', 'noticelist');
        $frames['page']['items']['notice']['active'] = '';

        $frames['page']['items']['adv']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.adv&ac=adv&hid=".$hid;
        $frames['page']['items']['adv']['title'] = '?????????';
        $frames['page']['items']['adv']['actions'] = array('ac', 'adv');
        $frames['page']['items']['adv']['active'] = '';

        $frames['page']['items']['nav']['url'] =  "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.nav&ac=nav";
        $frames['page']['items']['nav']['title'] = '?????????';
        $frames['page']['items']['nav']['actions'] = array('ac', 'nav');
        $frames['page']['items']['nav']['active'] = '';

        $frames['page']['items']['banner']['url'] ="index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.banner&ac=banner";
        $frames['page']['items']['banner']['title'] = '?????????';
        $frames['page']['items']['banner']['actions'] = array('ac', 'banner');
        $frames['page']['items']['banner']['active'] = '';

        $frames['page']['items']['cube']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.cube&ac=cube&hid=".$hid;
        $frames['page']['items']['cube']['title'] = '????????????';
        $frames['page']['items']['cube']['actions'] = array('ac', 'cube');
        $frames['page']['items']['cube']['active'] = '';

        $frames['page']['items']['plugin']['url'] =  "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.plugin&ac=plugin&hid=".$hid;
        $frames['page']['items']['plugin']['title'] = '????????????';
        $frames['page']['items']['plugin']['actions'] = array('ac', 'plugin');
        $frames['page']['items']['plugin']['active'] = '';

        $frames['page']['items']['docser']['url'] =  "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.docser&ac=docser&hid=".$hid;
        $frames['page']['items']['docser']['title'] = '???????????????';
        $frames['page']['items']['docser']['actions'] = array('ac', 'docser');
        $frames['page']['items']['docser']['active'] = '';
      
        $frames['page']['items']['characters']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.characters&ac=characters&hid=".$hid;
        $frames['page']['items']['characters']['title'] = '????????????';
        $frames['page']['items']['characters']['actions'] = array('ac', 'characters');
        $frames['page']['items']['characters']['active'] = '';

        $frames['page']['items']['foot']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.footers&ac=foot&hid=".$hid;
        $frames['page']['items']['foot']['title'] = '????????????';
        $frames['page']['items']['foot']['actions'] = array('ac', 'foot');
        $frames['page']['items']['foot']['active'] = '';

        $frames['page']['items']['mycenter']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.mycenter&ac=mycenter&hid=".$hid;
        $frames['page']['items']['mycenter']['title'] = '????????????';
        $frames['page']['items']['mycenter']['actions'] = array('ac', 'mycenter');
        $frames['page']['items']['mycenter']['active'] = '';

        $frames['page']['items']['special']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=index.special&ac=special";
        $frames['page']['items']['special']['title'] = '??????????????????';
        $frames['page']['items']['special']['actions'] = array('ac', 'special');
        $frames['page']['items']['special']['active'] = '';

        
        
        return $frames;
    }
      /**
     * static function ??????????????????
     *
     * @access static
     * @name getmemberFrames
     * @param
     * @return array
     */
    static function getmemberFrames() {
        global $_GPC,$_W;
        $hid = $_SESSION['hid'];
        $frames = array();
        $frames['user']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['user']['items'] = array();

        $frames['user']['items']['register']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=profile.register&ac=register&hid=".$hid;
        $frames['user']['items']['register']['title'] = '????????????';
        $frames['user']['items']['register']['actions'] = array('ac', 'register');
        $frames['user']['items']['register']['active'] = '';

        $frames['user']['items']['notice']['url'] = "index.php?c=site&a=entry&op=userlist&do=copysite&m=hyb_yl&act=profile.userlist&ac=notice&hid=".$hid;
        $frames['user']['items']['notice']['title'] = '????????????';
        $frames['user']['items']['notice']['actions'] = array('ac', 'notice');
        $frames['user']['items']['notice']['active'] = '';

        $frames['user']['items']['userjob']['url'] = "index.php?c=site&a=entry&op=userlist&do=copysite&m=hyb_yl&act=profile.userjob&ac=userjob&hid=".$hid;
        $frames['user']['items']['userjob']['title'] = '????????????';
        $frames['user']['items']['userjob']['actions'] = array('ac', 'userjob');
        $frames['user']['items']['userjob']['active'] = '';

        $frames['user']['items']['usersymptom']['url'] = "index.php?c=site&a=entry&op=userlist&do=copysite&m=hyb_yl&act=profile.usersymptom&ac=usersymptom&hid=".$hid;
        $frames['user']['items']['usersymptom']['title'] = '????????????';
        $frames['user']['items']['usersymptom']['actions'] = array('ac', 'usersymptom');
        $frames['user']['items']['usersymptom']['active'] = '';

        $frames['user']['items']['symptomset']['url'] = "index.php?c=site&a=entry&op=userlist&do=copysite&m=hyb_yl&act=profile.symptomset&ac=symptomset&hid=".$hid;
        $frames['user']['items']['symptomset']['title'] = '????????????';
        $frames['user']['items']['symptomset']['actions'] = array('ac', 'symptomset');
        $frames['user']['items']['symptomset']['active'] = '';

      
        $frames['useMoneyr']['title'] = '<i class="fa fa-inbox"></i> ??????';
        $frames['useMoneyr']['items'] = array();
      
        $frames['useMoneyr']['items']['recharge']['url'] = Util::webUrl("member", array( "op" => "integral",'ac'=>'integral','hid'=>$hid));
        $frames['useMoneyr']['items']['recharge']['title'] = '????????????';
        $frames['useMoneyr']['items']['recharge']['actions'] = array('ac', 'integral');
        $frames['useMoneyr']['items']['recharge']['active'] = '';

        $frames['useMoneyr']['items']['balance']['url'] = Util::webUrl("member", array( "op" => "balance",'ac'=>'balance','hid'=>$hid));
        $frames['useMoneyr']['items']['balance']['title'] = '????????????';
        $frames['useMoneyr']['items']['balance']['actions'] = array('ac', 'balance');
        $frames['useMoneyr']['items']['balance']['active'] = '';        
 
        $frames['svip']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['svip']['items'] = array();
      
        $frames['svip']['items']['sviptype']['url'] = Util::webUrl("member", array( "op" => "svip",'ac'=>'sviptype','hid'=>$hid));
        $frames['svip']['items']['sviptype']['title'] = '????????????';
        $frames['svip']['items']['sviptype']['actions'] = array('ac', 'sviptype');
        $frames['svip']['items']['sviptype']['active'] = '';  
        
        $frames['svip']['items']['svipsys']['url'] = Util::webUrl("member", array( "op" => "svipsys",'ac'=>'svipsys','hid'=>$hid));
        $frames['svip']['items']['svipsys']['title'] = '????????????';
        $frames['svip']['items']['svipsys']['actions'] = array('ac', 'svipsys');
        $frames['svip']['items']['svipsys']['active'] = ''; 
      
        $frames['svip']['items']['sviphistory']['url'] = Util::webUrl("member", array( "op" => "sviphistory",'ac'=>'sviphistory','hid'=>$hid));
        $frames['svip']['items']['sviphistory']['title'] = '????????????';
        $frames['svip']['items']['sviphistory']['actions'] = array('ac', 'sviphistory');
        $frames['svip']['items']['sviphistory']['active'] = '';  

        $frames['svip']['items']['renewal']['url'] = Util::webUrl("member", array( "op" => "renewal",'ac'=>'renewal','hid'=>$hid));
        $frames['svip']['items']['renewal']['title'] = '????????????';
        $frames['svip']['items']['renewal']['actions'] = array('ac', 'renewal');
        $frames['svip']['items']['renewal']['active'] = '';  
      
        $frames['svip']['items']['donation']['url'] = Util::webUrl("member", array( "op" => "donation",'ac'=>'donation','hid'=>$hid));
        $frames['svip']['items']['donation']['title'] = '????????????';
        $frames['svip']['items']['donation']['actions'] = array('ac', 'donation');
        $frames['svip']['items']['donation']['active'] = '';  

        $frames['svip']['items']['svipsetting']['url'] = Util::webUrl("member", array( "op" => "svipsetting",'ac'=>'svipsetting','hid'=>$hid));
        $frames['svip']['items']['svipsetting']['title'] = '????????????';
        $frames['svip']['items']['svipsetting']['actions'] = array('ac', 'svipsetting');
        $frames['svip']['items']['svipsetting']['active'] = '';  
      
         
      
        return $frames;
    }
      /**
     * static function ??????
     *
     * @access static
     * @name getmemberFrames
     * @param
     * @return array
     */
      static function getphysicalFrames() {
        global $_W, $_GPC;
        $frames = array();
        $hid = $_SESSION['hid'];
        $frames['physicalgk']['title'] = '<i class="fa fa-database"></i> ??????';
        $frames['physicalgk']['items'] = array();

        $frames['physicalgk']['items']['cashrecord']['url'] = "index.php?c=site&a=entry&do=physical&op=index&m=hyb_yl&ac=cashrecord&hid=".$hid;
        $frames['physicalgk']['items']['cashrecord']['title'] = '????????????';
        $frames['physicalgk']['items']['cashrecord']['actions'] = array();
        $frames['physicalgk']['items']['cashrecord']['active'] = '';
        
        $frames['reporttemplate']['title'] = '<i class="fa fa-globe"></i> ??????????????????';
        $frames['reporttemplate']['items'] = array();

        $frames['reporttemplate']['items']['mblist']['url'] = Util::webUrl('physical', array('op' => 'mblist','ac'=>'mblist','hid'=>$hid));
        $frames['reporttemplate']['items']['mblist']['title'] = '????????????';
        $frames['reporttemplate']['items']['mblist']['actions'] = array('ac', 'mblist');
        $frames['reporttemplate']['items']['mblist']['active'] = '';

    

        if(!empty($_GPC['m_id'])){
        $frames['reporttemplate']['items']['mbitem']['url'] = Util::webUrl('physical', array('op' => 'mbitem','ac'=>'mbitem','m_id'=>$_GPC['m_id'],'hid'=>$hid));
        $frames['reporttemplate']['items']['mbitem']['title'] = '????????????';
        $frames['reporttemplate']['items']['mbitem']['actions'] = array('ac', 'mbitem');
        $frames['reporttemplate']['items']['mbitem']['active'] = '';
         }
        
        $frames['meal']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['meal']['items'] = array();

        $frames['meal']['items']['sort']['url'] = Util::webUrl('physical', array('op' => 'sort','ac'=>'sort','hid'=>$hid));
        $frames['meal']['items']['sort']['title'] = '????????????';
        $frames['meal']['items']['sort']['actions'] = array('ac', 'sort');
        $frames['meal']['items']['sort']['active'] = '';

        $frames['meal']['items']['crowd']['url'] = Util::webUrl('physical', array('op' => 'crowd','ac'=>'crowd','hid'=>$hid));
        $frames['meal']['items']['crowd']['title'] = '????????????';
        $frames['meal']['items']['crowd']['actions'] = array('ac', 'crowd');
        $frames['meal']['items']['crowd']['active'] = '';
        
        $frames['meal']['items']['tclist']['url'] = Util::webUrl('physical', array('op' => 'tclist','ac'=>'tclist','hid'=>$hid));
        $frames['meal']['items']['tclist']['title'] = '????????????';
        $frames['meal']['items']['tclist']['actions'] = array('ac', 'tclist');
        $frames['meal']['items']['tclist']['active'] = '';
        
        if(!empty($_GPC['id'])){
        $frames['meal']['items']['tclistadd']['url'] = Util::webUrl('physical', array('op' => 'tclistadd','ac'=>'tclistadd','id'=>$_GPC['id'],'hid'=>$hid));
        $frames['meal']['items']['tclistadd']['title'] = '????????????';
        $frames['meal']['items']['tclistadd']['actions'] = array('ac', 'tclistadd');
        $frames['meal']['items']['tclistadd']['active'] = ''; 
        }

        $frames['meal']['items']['rule']['url'] = Util::webUrl('physical', array('op' => 'rule','ac'=>'rule','hid'=>$hid));
        $frames['meal']['items']['rule']['title'] = '????????????';
        $frames['meal']['items']['rule']['actions'] = array('ac', 'rule');
        $frames['meal']['items']['rule']['active'] = '';
        
        
        $frames['contrast']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['contrast']['items'] = array();

        $frames['contrast']['items']['dblist']['url'] = Util::webUrl('physical', array('op' => 'dblist','ac'=>'dblist','hid'=>$hid));
        $frames['contrast']['items']['dblist']['title'] = '????????????';
        $frames['contrast']['items']['dblist']['actions'] = array('ac', 'dblist');
        $frames['contrast']['items']['dblist']['active'] = '';
        
        $frames['contrast']['items']['dbrule']['url'] = Util::webUrl('physical', array('op' => 'dbrule','ac'=>'dbrule','hid'=>$hid));
        $frames['contrast']['items']['dbrule']['title'] = '????????????';
        $frames['contrast']['items']['dbrule']['actions'] = array('ac', 'dbrule');
        $frames['contrast']['items']['dbrule']['active'] = '';
        
        $frames['contrast']['items']['patient']['url'] = Util::webUrl('physical', array('op' => 'patient','ac'=>'patient','hid'=>$hid));
        $frames['contrast']['items']['patient']['title'] = '????????????';
        $frames['contrast']['items']['patient']['actions'] = array('ac', 'patient');
        $frames['contrast']['items']['patient']['active'] = '';
        

      
        return $frames;
    }
    /**
     * static function ??????
     *
     * @access static
     * @name getaskFrames
     * @param
     * @return array
     */
      static function getaskFrames() {
        global $_W, $_GPC;
        $frames = array();
        $hid = $_SESSION['hid'];
        $frames['askgk']['title'] = '<i class="fa fa-database"></i> ??????';
        $frames['askgk']['items'] = array();

        $frames['askgk']['items']['askgk']['url'] =  Util::webUrl("ask", array( "op" => "index",'ac'=>'askgk','hid'=>$hid));
        $frames['askgk']['items']['askgk']['title'] = '????????????';
        $frames['askgk']['items']['askgk']['actions'] = array('ac', 'askgk');
        $frames['askgk']['items']['askgk']['active'] = '';

        $frames['asksys']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['asksys']['items'] = array();

        $frames['asksys']['items']['asklist']['url'] = "../index.php?c=site&a=entry&op=asklist&ifpay=-1&ac=asklist&do=ask&m=hyb_yl&hid=".$hid;
        $frames['asksys']['items']['asklist']['title'] = '????????????';
        $frames['asksys']['items']['asklist']['actions'] = array('ac', 'asklist');
        $frames['asksys']['items']['asklist']['active'] = '';
        $frames['asksys']['items']['telask']['url'] =  Util::webUrl("ask", array( "op" => "telask",'ac'=>'telask','hid'=>$hid));
        $frames['asksys']['items']['telask']['title'] = '????????????';
        $frames['asksys']['items']['telask']['actions'] = array('ac', 'telask');
        $frames['asksys']['items']['telask']['active'] = '';
        $frames['asksys']['items']['squareask']['url'] = Util::webUrl("ask", array( "op" => "squareask",'ac'=>'squareask','hid'=>$hid));
        $frames['asksys']['items']['squareask']['title'] = '????????????';
        $frames['asksys']['items']['squareask']['actions'] = array('ac', 'squareask');
        $frames['asksys']['items']['squareask']['active'] = '';
        $frames['asksys']['items']['videoask']['url'] = Util::webUrl("ask", array( "op" => "videoask",'ac'=>'videoask','hid'=>$hid));
        $frames['asksys']['items']['videoask']['title'] = '????????????';
        $frames['asksys']['items']['videoask']['actions'] = array('ac', 'videoask');
        $frames['asksys']['items']['videoask']['active'] = '';
        $frames['asksys']['items']['operativeask']['url'] = Util::webUrl("ask", array( "op" => "operativeask",'ac'=>'operativeask','hid'=>$hid));
        $frames['asksys']['items']['operativeask']['title'] = '????????????';
        $frames['asksys']['items']['operativeask']['actions'] = array('ac', 'operativeask');
        $frames['asksys']['items']['operativeask']['active'] = '';
        $frames['asksys']['items']['informask']['url'] = Util::webUrl("ask", array( "op" => "informask",'ac'=>'informask','hid'=>$hid));
        $frames['asksys']['items']['informask']['title'] = '????????????';
        $frames['asksys']['items']['informask']['actions'] = array('ac', 'informask');
        $frames['asksys']['items']['informask']['active'] = '';
        
        $frames['askrule']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['askrule']['items'] = array();
        $frames['askrule']['items']['askrule']['url'] = Util::webUrl("ask", array( "op" => "askrule",'ac'=>'askrule','hid'=>$hid));
        $frames['askrule']['items']['askrule']['title'] = '????????????';
        $frames['askrule']['items']['askrule']['actions'] = array('ac', 'askrule');
        $frames['askrule']['items']['askrule']['active'] = '';
        
       
        $frames['askroom']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['askroom']['items'] = array();
        $frames['askroom']['items']['askroom']['url'] = Util::webUrl("ask", array( "op" => "askroom",'ac'=>'askroom','hid'=>$hid));
        $frames['askroom']['items']['askroom']['title'] = '????????????';
        $frames['askroom']['items']['askroom']['actions'] = array('ac', 'askroom');
        $frames['askroom']['items']['askroom']['active'] = '';
        // $frames['askroom']['items']['asksort']['url'] = Util::webUrl("ask", array( "op" => "asksort",'ac'=>'asksort'));
        // $frames['askroom']['items']['asksort']['title'] = '????????????';
        // $frames['askroom']['items']['asksort']['actions'] = array('ac', 'asksort');
        // $frames['askroom']['items']['asksort']['active'] = '';
      
        return $frames;
    }
    /**
     * static function ??????
     *
     * @access static
     * @name getsignFrames
     * @param
     * @return array
     */
     static function getsignFrames() {
        global $_W, $_GPC;
        $frames = array();
        $hid = $_SESSION['hid'];
        $frames['signgk']['title'] = '<i class="fa fa-database"></i> ??????';
        $frames['signgk']['items'] = array();
       

        $frames['signgk']['items']['cashrecord']['url'] = Util::webUrl("sign", array( "op" => "index",'ac'=>'cashrecord','hid'=>$hid));
        $frames['signgk']['items']['cashrecord']['title'] = '????????????';
        $frames['signgk']['items']['cashrecord']['actions'] = array();
        $frames['signgk']['items']['cashrecord']['active'] = '';

        $frames['teamsys']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['teamsys']['items'] = array();

        $frames['teamsys']['items']['tdlist']['url'] = Util::webUrl("sign", array( "op" => "tdlist",'ac'=>'tdlist','hid'=>$hid));
        $frames['teamsys']['items']['tdlist']['title'] = '????????????';
        $frames['teamsys']['items']['tdlist']['actions'] = array('ac', 'tdlist');
        $frames['teamsys']['items']['tdlist']['active'] = '';
        
        $frames['teamsys']['items']['telask']['url'] = Util::webUrl("sign", array( "op" => "telask",'ac'=>'telask','hid'=>$hid));
        $frames['teamsys']['items']['telask']['title'] = '????????????';
        $frames['teamsys']['items']['telask']['actions'] = array('ac', 'telask');
        $frames['teamsys']['items']['telask']['active'] = '';
        
        

        $frames['servicesys']['title'] = '<i class="fa fa-globe"></i> ???????????????';
        $frames['servicesys']['items'] = array();
        $frames['servicesys']['items']['fwblist']['url'] = Util::webUrl("sign", array( "op" => "fwblist",'ac'=>'fwblist','hid'=>$hid));
        $frames['servicesys']['items']['fwblist']['title'] = '????????????';
        $frames['servicesys']['items']['fwblist']['actions'] = array('ac', 'fwblist');
        $frames['servicesys']['items']['fwblist']['active'] = '';
        
        $frames['servicesys']['items']['typelist']['url'] = Util::webUrl("sign", array( "op" => "typelist",'ac'=>'typelist','hid'=>$hid));
        $frames['servicesys']['items']['typelist']['title'] = '????????????';
        $frames['servicesys']['items']['typelist']['actions'] = array('ac', 'typelist');
        
       
        
        $frames['signorder']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['signorder']['items'] = array();
        $frames['signorder']['items']['orderlist']['url'] = Util::webUrl("sign", array( "op" => "orderlist",'ac'=>'orderlist','hid'=>$hid));
        $frames['signorder']['items']['orderlist']['title'] = '????????????';
        $frames['signorder']['items']['orderlist']['actions'] = array('ac', 'orderlist');
        $frames['signorder']['items']['orderlist']['active'] = '';
        
        $frames['community']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['community']['items'] = array();
        $frames['community']['items']['sqlist']['url'] = Util::webUrl("sign", array( "op" => "sqlist",'ac'=>'sqlist','hid'=>$hid));
        $frames['community']['items']['sqlist']['title'] = '????????????';
        $frames['community']['items']['sqlist']['actions'] = array('ac', 'sqlist');
        $frames['community']['items']['sqlist']['active'] = '';
        
        return $frames;
    }
    /**
     * static function ??????
     *
     * @access static
     * @name getfinaceFrames
     * @param
     * @return array
     */
  
    static function getfinancFrames() {
        global $_W, $_GPC;
        $frames = array();
        $hid = $_SESSION['hid'];
        $frames['cashSurvey']['title'] = '<i class="fa fa-database"></i> ??????';
        $frames['cashSurvey']['items'] = array();

        $frames['cashSurvey']['items']['cashrecord']['url'] = Util::webUrl('financ',array('op'=>'index','ac'=>'cashrecord','hid'=>$hid));
        $frames['cashSurvey']['items']['cashrecord']['title'] = '????????????';
        $frames['cashSurvey']['items']['cashrecord']['actions'] = array('ac','cashrecord');
        $frames['cashSurvey']['items']['cashrecord']['active'] = '';
        
        $frames['cashApplyAgent']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['cashApplyAgent']['items'] = array();
        $frames['cashApplyAgent']['items']['givemoney']['url'] = Util::webUrl('financ',array('op'=>'givemoney','ac'=>'givemoney','hid'=>$hid));
        $frames['cashApplyAgent']['items']['givemoney']['title'] = '????????????';
        $frames['cashApplyAgent']['items']['givemoney']['actions'] = array('ac', 'givemoney');
        $frames['cashApplyAgent']['items']['givemoney']['active'] = '';

        $frames['cashApplyAgent']['items']['display1']['url'] = Util::webUrl('financ',array('op'=>'display1','ac'=>'display1','hid'=>$hid));
        $frames['cashApplyAgent']['items']['display1']['title'] = '????????????';
        $frames['cashApplyAgent']['items']['display1']['actions'] = array('ac', 'display1');
        $frames['cashApplyAgent']['items']['display1']['active'] = '';


        $frames['current']['title'] = '<i class="fa fa-globe"></i> ??????';
        $frames['current']['items'] = array();

        $frames['current']['items']['currentstore']['url'] = Util::webUrl('financ',array('op'=>'currentstore','ac'=>'currentstore'));
        $frames['current']['items']['currentstore']['title'] = '????????????';
        $frames['current']['items']['currentstore']['actions'] = array('ac', 'currentstore');
        $frames['current']['items']['currentstore']['active'] = '';

        $frames['current']['items']['currentmy']['url'] = Util::webUrl('financ',array('op'=>'currentmy','ac'=>'currentmy','hid'=>$hid));
        $frames['current']['items']['currentmy']['title'] = '????????????';
        $frames['current']['items']['currentmy']['actions'] = array('ac', 'currentmy');
        $frames['current']['items']['currentmy']['active'] = '';

        $frames['Settlement']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['Settlement']['items'] = array();

        $frames['Settlement']['items']['currentsite']['url'] = Util::webUrl('financ',array('op'=>'currentsite','ac'=>'currentsite','hid'=>$hid));
        $frames['Settlement']['items']['currentsite']['title'] = '????????????';
        $frames['Settlement']['items']['currentsite']['actions'] = array('ac', 'currentsite');
        $frames['Settlement']['items']['currentsite']['active'] = '';
        
        
      
        return $frames;
    }
  
  
  
    /**
     * static function ????????????
     *
     * @access static
     * @name getstoreFrames
     * @param
     * @return array
     */
    static function getstoreFrames() {
        global $_W, $_GPC;
        $frames = array();
        $hid = $_SESSION['hid'];
        $frames['docuser']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['docuser']['items'] = array();
        $frames['docuser']['items']['docindex']['url'] =  Util::webUrl('team',array('op'=>'doctor','ac'=>'docindex','hid'=>$hid));
        $frames['docuser']['items']['docindex']['title'] = '????????????';
        $frames['docuser']['items']['docindex']['actions'] = array('ac', 'docindex');
        $frames['docuser']['items']['docindex']['active'] = '';

        $frames['docuser']['items']['edit']['url'] = Util::webUrl('team',array('op'=>'edit','ac'=>'edit','hid'=>$hid));
        $frames['docuser']['items']['edit']['title'] = !empty($_GPC['zid']) ? '????????????' : '????????????';
        $frames['docuser']['items']['edit']['actions'] = array('ac', 'edit');
        $frames['docuser']['items']['edit']['active'] = '';
        $frames['docuser']['items']['scheduling']['url'] =Util::webUrl("team", array( "op" => "scheduling",'ac'=>'scheduling','hid'=>$hid));
        $frames['docuser']['items']['scheduling']['title'] = '????????????';
        $frames['docuser']['items']['scheduling']['actions'] = array('ac', 'scheduling');
        $frames['docuser']['items']['scheduling']['active'] = '';

        $frames['docuser']['items']['paiban']['url'] =Util::webUrl("team", array( "op" => "paiban",'ac'=>'paiban','hid'=>$hid));
        $frames['docuser']['items']['paiban']['title'] = '????????????';
        $frames['docuser']['items']['paiban']['actions'] = array('ac', 'paiban');
        $frames['docuser']['items']['paiban']['active'] = '';
        
        $frames['docuser']['items']['jxbiaoqian']['url'] =Util::webUrl("team", array( "op" => "jxbiaoqian",'ac'=>'jxbiaoqian','hid'=>$hid));
        $frames['docuser']['items']['jxbiaoqian']['title'] = '????????????';
        $frames['docuser']['items']['jxbiaoqian']['actions'] = array('ac', 'jxbiaoqian');
        $frames['docuser']['items']['jxbiaoqian']['active'] = '';

        $frames['docuser']['items']['settled']['url'] =Util::webUrl("team", array( "op" => "settled",'ac'=>'settled'));
        $frames['docuser']['items']['settled']['title'] = '????????????';
        $frames['docuser']['items']['settled']['actions'] = array('ac', 'settled');
        $frames['docuser']['items']['settled']['active'] = '';
        $frames['docuser']['items']['settlement']['url'] =Util::webUrl("team", array( "op" => "settlement",'ac'=>'settlement'));
        $frames['docuser']['items']['settlement']['title'] = '????????????';
        $frames['docuser']['items']['settlement']['actions'] = array('ac', 'settlement');
        $frames['docuser']['items']['settlement']['active'] = '';



        $frames['service']['title'] = '<i class="fa fa-inbox"></i> ???????????????';
        $frames['service']['items'] = array();
        
        $frames['service']['items']['servicebox']['url'] = Util::webUrl('team',array('op'=>'servicebox','ac'=>'servicebox','hid'=>$hid));
        $frames['service']['items']['servicebox']['title'] = '????????????';
        $frames['service']['items']['servicebox']['actions'] = array('ac', 'servicebox');
        $frames['service']['items']['servicebox']['active'] = '';
            
        
        $frames['service']['items']['serviceboxlog']['url'] = Util::webUrl('team',array('op'=>'serviceboxlog','ac'=>'serviceboxlog','hid'=>$hid));
        $frames['service']['items']['serviceboxlog']['title'] = '????????????';
        $frames['service']['items']['serviceboxlog']['actions'] = array('ac', 'serviceboxlog');
        $frames['service']['items']['serviceboxlog']['active'] = '';
        
        $frames['doccard']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['doccard']['items'] = array();
      
        $frames['doccard']['items']['nklist']['url'] = Util::webUrl('team',array('op'=>'nklist','ac'=>'nklist','hid'=>$hid));
        $frames['doccard']['items']['nklist']['title'] = '????????????';
        $frames['doccard']['items']['nklist']['actions'] = array('ac', 'nklist');
        $frames['doccard']['items']['nklist']['active'] = '';
        
        $frames['doccard']['items']['nkrule']['url'] = Util::webUrl('team',array('op'=>'nkrule','ac'=>'nkrule','hid'=>$hid));
        $frames['doccard']['items']['nkrule']['title'] = '????????????';
        $frames['doccard']['items']['nkrule']['actions'] = array('ac', 'nkrule');
        $frames['doccard']['items']['nkrule']['active'] = '';
        
        $frames['doccard']['items']['nkicon']['url'] = Util::webUrl('team',array('op'=>'nkicon','ac'=>'nkicon','hid'=>$hid));
        $frames['doccard']['items']['nkicon']['title'] = '????????????';
        $frames['doccard']['items']['nkicon']['actions'] = array('ac', 'nkicon');
        $frames['doccard']['items']['nkicon']['active'] = '';
        
        
      
        $frames['doccard']['items']['nkrecord']['url'] = Util::webUrl('team',array('op'=>'nkrecord','ac'=>'nkrecord','hid'=>$hid));
        $frames['doccard']['items']['nkrecord']['title'] = '????????????';
        $frames['doccard']['items']['nkrecord']['actions'] = array('ac', 'nkrecord');
        $frames['doccard']['items']['nkrecord']['active'] = '';
      
        $frames['register']['title'] = '<i class="fa fa-globe"></i> ???????????????';
        $frames['register']['items'] = array();
        $frames['register']['items']['register']['url'] = Util::webUrl('team',array('op'=>'register','ac'=>'register','hid'=>$hid));
        $frames['register']['items']['register']['title'] = '????????????';
        $frames['register']['items']['register']['actions'] = array('ac', 'register');
        $frames['register']['items']['register']['active'] = '';


        
        $frames['group']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['group']['items'] = array();
        $frames['group']['items']['group']['url'] = Util::webUrl('team',array('op'=>'group','ac'=>'group','hid'=>$hid));
        $frames['group']['items']['group']['title'] = '????????????';
        $frames['group']['items']['group']['actions'] = array('ac', 'group');
        $frames['group']['items']['group']['active'] = '';


        $frames['comment']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['comment']['items'] = array();
        $frames['comment']['items']['dynamic']['url'] = Util::webUrl('team',array('op'=>'dynamic','ac'=>'dynamic','hid'=>$hid));
        $frames['comment']['items']['dynamic']['title'] = '????????????';
        $frames['comment']['items']['dynamic']['actions'] = array('ac', 'dynamic');
        $frames['comment']['items']['dynamic']['active'] = '';
        
        

        $frames['setting']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['setting']['items'] = array();
        $frames['setting']['items']['addtoux']['url'] = Util::webUrl('team',array('op'=>'addtoux','ac'=>'addtoux'));
        $frames['setting']['items']['addtoux']['title'] = '????????????';
        $frames['setting']['items']['addtoux']['actions'] = array('ac', 'addtoux');
        $frames['setting']['items']['addtoux']['active'] = '';

        $frames['setting']['items']['txlist']['url'] = Util::webUrl('team',array('op'=>'txlist','ac'=>'txlist'));
        $frames['setting']['items']['txlist']['title'] = '????????????';
        $frames['setting']['items']['txlist']['actions'] = array('ac', 'txlist');
        $frames['setting']['items']['txlist']['active'] = '';
      
        $frames['docarticle']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['docarticle']['items'] = array();
      
        $frames['docarticle']['items']['hjsetting']['url'] = Util::webUrl('team',array('op'=>'hjsetting','ac'=>'hjsetting','hid'=>$hid));
        $frames['docarticle']['items']['hjsetting']['title'] = '????????????';
        $frames['docarticle']['items']['hjsetting']['actions'] = array('ac', 'hjsetting');
        $frames['docarticle']['items']['hjsetting']['active'] = '';
        
        $frames['docarticle']['items']['hjsort']['url'] = Util::webUrl('team',array('op'=>'hjsort','ac'=>'hjsort','hid'=>$hid));
        $frames['docarticle']['items']['hjsort']['title'] = '????????????';
        $frames['docarticle']['items']['hjsort']['actions'] = array('ac', 'hjsort');
        $frames['docarticle']['items']['hjsort']['active'] = '';
        
        
      
      
        return $frames;
    }
       /**
     * static function ??????
     *
     * @access static
     * @name getmedicine
     * @param
     * @return array
     */
    static function getmedicineFrames() {
        global $_W, $_GPC;
        $frames = array();
        $hid = $_SESSION['hid'];
        $frames['medicine']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['medicine']['items'] = array();
        $frames['medicine']['items']['medicinesys']['url'] =  Util::webUrl("medicine", array( "op" => "index",'ac'=>'medicinesys','hid'=>$hid));
        $frames['medicine']['items']['medicinesys']['title'] = '????????????';
        $frames['medicine']['items']['medicinesys']['actions'] = array('ac', 'medicinesys');
        $frames['medicine']['items']['medicinesys']['active'] = '';

        $frames['medicine']['items']['list']['url'] = Util::webUrl("medicine", array( "op" => "list",'ac'=>'list','hid'=>$hid));
        $frames['medicine']['items']['list']['title'] = !empty($_GPC['id']) ? '????????????' : '????????????';
        $frames['medicine']['items']['list']['actions'] = array('ac', 'list');
        $frames['medicine']['items']['list']['active'] = '';

        $frames['medicine']['items']['categry']['url'] = Util::webUrl("medicine", array( "op" => "categry",'ac'=>'categry','hid'=>$hid));
        $frames['medicine']['items']['categry']['title'] = '????????????';
        $frames['medicine']['items']['categry']['actions'] = array('ac', 'categry');
        $frames['medicine']['items']['categry']['active'] = '';
        
        $frames['pharmacist']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['pharmacist']['items'] = array();
        $frames['pharmacist']['items']['pharmacistlist']['url'] =  Util::webUrl("medicine", array( "op" => "pharmacistlist",'ac'=>'pharmacistlist','hid'=>$hid));
        $frames['pharmacist']['items']['pharmacistlist']['title'] = '????????????';
        $frames['pharmacist']['items']['pharmacistlist']['actions'] = array('ac', 'pharmacistlist');
        $frames['pharmacist']['items']['pharmacistlist']['active'] = '';

        $frames['pharmacist']['items']['audit']['url'] = Util::webUrl("medicine", array( "op" => "audit",'ac'=>'audit','hid'=>$hid));
        $frames['pharmacist']['items']['audit']['title'] = '????????????';
        $frames['pharmacist']['items']['audit']['actions'] = array('ac', 'audit');
        $frames['pharmacist']['items']['audit']['active'] = '';

        $frames['pharmacist']['items']['rule']['url'] = Util::webUrl("medicine", array( "op" => "rule",'ac'=>'rule','hid'=>$hid));
        $frames['pharmacist']['items']['rule']['title'] = '????????????';
        $frames['pharmacist']['items']['rule']['actions'] = array('ac', 'rule');
        $frames['pharmacist']['items']['rule']['active'] = '';
        $frames['supplier']['title'] = '<i class="fa fa-inbox"></i> ???????????????';
        $frames['supplier']['items'] = array();
        $frames['supplier']['items']['supplierlist']['url'] =  Util::webUrl("medicine", array( "op" => "supplierlist",'ac'=>'supplierlist','hid'=>$hid));
        $frames['supplier']['items']['supplierlist']['title'] = '???????????????';
        $frames['supplier']['items']['supplierlist']['actions'] = array('ac', 'supplierlist');
        $frames['supplier']['items']['supplierlist']['active'] = '';

        $frames['drugstore']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['drugstore']['items'] = array();
        $frames['drugstore']['items']['drugstorelist']['url'] =  Util::webUrl("medicine", array( "op" => "drugstorelist",'ac'=>'drugstorelist','hid'=>$hid));
        $frames['drugstore']['items']['drugstorelist']['title'] = '????????????';
        $frames['drugstore']['items']['drugstorelist']['actions'] = array('ac', 'drugstorelist');
        $frames['drugstore']['items']['drugstorelist']['active'] = '';

        $frames['drugstore']['items']['chufangmuban']['url'] =  Util::webUrl("medicine", array( "op" => "chufangmuban",'ac'=>'chufangmuban','hid'=>$hid));
        $frames['drugstore']['items']['chufangmuban']['title'] = '????????????';
        $frames['drugstore']['items']['chufangmuban']['actions'] = array('ac', 'chufangmuban');
        $frames['drugstore']['items']['chufangmuban']['active'] = '';

        $frames['drugstore']['items']['chufangfl']['url'] =  Util::webUrl("medicine", array( "op" => "chufangmubanpost",'ac'=>'chufangmubanpost','hid'=>$hid));
        $frames['drugstore']['items']['chufangfl']['title'] = '????????????';
        $frames['drugstore']['items']['chufangfl']['actions'] = array('ac', 'chufangmubanpost');
        $frames['drugstore']['items']['chufangfl']['active'] = '';

        $frames['wuliups']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['wuliups']['items'] = array();
        $frames['wuliups']['items']['wuliulist']['url'] =  Util::webUrl("wuliu", array( "op" => "wuliulist",'ac'=>'wuliulist','status'=>-1,'hid'=>$hid));
        $frames['wuliups']['items']['wuliulist']['title'] = '????????????';
        $frames['wuliups']['items']['wuliulist']['actions'] = array('ac', 'wuliulist');
        $frames['wuliups']['items']['wuliulist']['active'] = '';


        return $frames;
    }
   /**
     * static function ????????????
     *
     * @access static
     * @name getstoreFrames
     * @param
     * @return array
     */
    static function getjigouFrames() {
        global $_W, $_GPC;
        $frames = array();
        $hid = $_SESSION['hid'];
        $frames['jigou']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['jigou']['items'] = array();
        $frames['jigou']['items']['jgindex']['url'] =  Util::webUrl("jiancha", array( "op" => "display",'ac'=>'jgindex','hid'=>$hid));
        $frames['jigou']['items']['jgindex']['title'] = '????????????';
        $frames['jigou']['items']['jgindex']['actions'] = array('ac', 'jgindex');
        $frames['jigou']['items']['jgindex']['active'] = '';
        
        $frames['jigou']['items']['edit']['url'] = Util::webUrl("jiancha", array( "op" => "edit",'ac'=>'edit','hid'=>$hid));
        $frames['jigou']['items']['edit']['title'] = !empty($_GPC['id']) ? '????????????' : '????????????';
        $frames['jigou']['items']['edit']['actions'] = array('ac', 'edit');
        $frames['jigou']['items']['edit']['active'] = '';

        // $frames['jigou']['items']['register']['url'] = Util::webUrl("jiancha", array( "op" => "register",'ac'=>'register','hid'=>$hid));
        // $frames['jigou']['items']['register']['title'] = '????????????';
        // $frames['jigou']['items']['register']['actions'] = array('ac', 'register');
        // $frames['jigou']['items']['register']['active'] = '';

        $frames['jigou']['items']['jgsetting']['url'] = Util::webUrl("jiancha", array( "op" => "jgsetting",'ac'=>'jgsetting','hid'=>$hid));
        $frames['jigou']['items']['jgsetting']['title'] = '????????????';
        $frames['jigou']['items']['jgsetting']['actions'] = array('ac','jgsetting');
        $frames['jigou']['items']['jgsetting']['active'] = '';

        $frames['jigou']['items']['role']['url'] = Util::webUrl("jiancha", array( "op" => "role",'ac'=>'role','hid'=>$hid));
        $frames['jigou']['items']['role']['title'] = '????????????';
        $frames['jigou']['items']['role']['actions'] = array('ac','role');
        $frames['jigou']['items']['role']['active'] = '';

        $frames['selfarea']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['selfarea']['items'] = array();
        $frames['selfarea']['items']['notice']['url'] = Util::webUrl("jiancha", array( "op" => "hotareaIndex",'ac'=>'hotareaIndex','hid'=>$hid));
        $frames['selfarea']['items']['notice']['title'] = '????????????';
        $frames['selfarea']['items']['notice']['actions'] = array('ac', 'hotareaIndex');
        $frames['selfarea']['items']['notice']['active'] = '';

       if( $_GPC['op'] =='jigoutime' || $_GPC['op'] =='addjgtime'){
        $frames['selfarea']['items']['jigoutime']['url'] = Util::webUrl("jiancha", array( "op" => "jigoutime",'ac'=>'jigoutime','hid'=>$_GPC['hid']));
        $frames['selfarea']['items']['jigoutime']['title'] = '???????????????';
        $frames['selfarea']['items']['jigoutime']['actions'] = array('ac', 'jigoutime');
        $frames['selfarea']['items']['jigoutime']['active'] = ''; 
       }

       if( $_GPC['op'] =='addjgtime'){
        $frames['selfarea']['items']['addjgtime']['url'] = Util::webUrl("jiancha", array( "op" => "addjgtime",'ac'=>'addjgtime','hid'=>$_GPC['hid']));
        $frames['selfarea']['items']['addjgtime']['title'] = '???????????????';
        $frames['selfarea']['items']['addjgtime']['actions'] = array('ac', 'addjgtime');
        $frames['selfarea']['items']['addjgtime']['active'] = ''; 
       }
        
        

        // $frames['user']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        // $frames['user']['items'] = array();
        //  $frames['user']['items']['notice']['url'] =  Util::webUrl("jiancha", array( "op" => "agentIndex",'ac'=>'agentIndex'));
        // $frames['user']['items']['notice']['title'] = '????????????';
        // $frames['user']['items']['notice']['actions'] = array('ac', 'agentIndex');
        // $frames['user']['items']['notice']['active'] = '';
        // $frames['user']['items']['adv']['url'] = Util::webUrl("jiancha", array( "op" => "groupIndex",'ac'=>'groupIndex'));
        // $frames['user']['items']['adv']['title'] = '????????????';
        // $frames['user']['items']['adv']['actions'] = array('ac', 'groupIndex');
        // $frames['user']['items']['adv']['active'] = '';

        
        // $frames['selfarea']['items']['group']['url'] = Util::webUrl("jiancha", array( "op" => "hotareagroup",'ac'=>'hotareagroup'));
        // $frames['selfarea']['items']['group']['title'] = '????????????';
        // $frames['selfarea']['items']['group']['actions'] = array('ac', 'hotareagroup');
        // $frames['selfarea']['items']['group']['active'] = '';
        
        // $frames['selfarea']['items']['custom']['url'] = Util::webUrl("jiancha", array( "op" => "customindex",'ac'=>'customindex'));
        // $frames['selfarea']['items']['custom']['title'] = '???????????????';
        // $frames['selfarea']['items']['custom']['actions'] = array('ac', 'customindex');
        // $frames['selfarea']['items']['custom']['active'] = '';
        


        return $frames;
    }
    /**
     * static function ??????????????????
     *
     * @access static
     * @name getorderFrames
     * @param
     * @return array
     */
    static function getorderFrames() {
        global $_GPC,$_W;
        $frames = array();
        $hid = $_SESSION['hid'];
        $frames['order']['title'] = '<i class="fa fa-inbox"></i>????????????';
        $frames['order']['items'] = array();

        // $frames['order']['items']['kcorder']['url'] = Util::webUrl("order", array( "op" => "kcorder",'ac'=>'kcorder'));
        // $frames['order']['items']['kcorder']['title'] = '????????????';
        // $frames['order']['items']['kcorder']['actions'] = array('ac', 'kcorder');
        // $frames['order']['items']['kcorder']['active'] = '';

        $frames['order']['items']['tjorder']['url'] = Util::webUrl("order", array( "op" => "tjorder",'ac'=>'tjorder','hid'=>$hid));
        $frames['order']['items']['tjorder']['title'] = '????????????';
        $frames['order']['items']['tjorder']['actions'] = array('ac', 'tjorder');
        $frames['order']['items']['tjorder']['active'] = '';

        $frames['order']['items']['yporder']['url'] = Util::webUrl("order", array( "op" => "yporder",'ac'=>'yporder','hid'=>$hid));
        $frames['order']['items']['yporder']['title'] = '????????????';
        $frames['order']['items']['yporder']['actions'] = array('ac', 'yporder');
        $frames['order']['items']['yporder']['active'] = '';
    
        
        $frames['freight']['title'] = '<i class="fa fa-inbox"></i>????????????';
        $frames['freight']['items'] = array();

        $frames['freight']['items']['orderrule']['url'] = Util::webUrl("order", array( "op" => "orderrule",'ac'=>'orderrule','hid'=>$hid));
        $frames['freight']['items']['orderrule']['title'] = '????????????';
        $frames['freight']['items']['orderrule']['actions'] = array('ac', 'orderrule');
        $frames['freight']['items']['orderrule']['active'] = '';

        $frames['freighttem']['title'] = '<i class="fa fa-inbox"></i>????????????';
        $frames['freighttem']['items'] = array();

        $frames['freighttem']['items']['freightlist']['url'] = Util::webUrl("order", array( "op" => "freightlist",'ac'=>'freightlist','hid'=>$hid));
        $frames['freighttem']['items']['freightlist']['title'] = '????????????';
        $frames['freighttem']['items']['freightlist']['actions'] = array('ac', 'freightlist');
        $frames['freighttem']['items']['freightlist']['active'] = '';
 
        $frames['freighttem']['items']['addfreighttem']['url'] = Util::webUrl("order", array( "op" => "addfreighttem",'ac'=>'addfreighttem','hid'=>$hid));
        $frames['freighttem']['items']['addfreighttem']['title'] = '????????????';
        $frames['freighttem']['items']['addfreighttem']['actions'] = array('ac', 'addfreighttem');
        $frames['freighttem']['items']['addfreighttem']['active'] = '';
        
        
        return $frames;
    }
    static function getdatacenterFrames() {
        global $_W;
        $frames = array();
        $hid = $_SESSION['hid'];
        $frames['datacenter']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['datacenter']['items'] = array();
        $frames['datacenter']['items']['operationstatistics']['url'] = Util::webUrl("datum", array( "op" => "index",'ac'=>'operationstatistics','hid'=>$hid));
        $frames['datacenter']['items']['operationstatistics']['title'] = '????????????';
        $frames['datacenter']['items']['operationstatistics']['actions'] = array('ac', 'operationstatistics');
        $frames['datacenter']['items']['operationstatistics']['active'] = '';

        $frames['datacenter']['items']['promotionstatistics']['url'] = Util::webUrl("datum", array( "op" => "promotionstatistics",'ac'=>'promotionstatistics','hid'=>$hid));
        $frames['datacenter']['items']['promotionstatistics']['title'] = '????????????';
        $frames['datacenter']['items']['promotionstatistics']['actions'] = array('ac', 'promotionstatistics');
        $frames['datacenter']['items']['promotionstatistics']['active'] = '';

        $frames['datacenter']['items']['expertstatistics']['url'] = Util::webUrl("datum", array( "op" => "expertstatistics",'ac'=>'expertstatistics','hid'=>$hid));
        $frames['datacenter']['items']['expertstatistics']['title'] = '????????????';
        $frames['datacenter']['items']['expertstatistics']['actions'] = array('ac', 'expertstatistics');
        $frames['datacenter']['items']['expertstatistics']['active'] = '';

        $frames['datacenter']['items']['income']['url'] = Util::webUrl("datum", array( "op" => "income",'ac'=>'income','hid'=>$hid));
        $frames['datacenter']['items']['income']['title'] = '????????????';
        $frames['datacenter']['items']['income']['actions'] = array('ac', 'income');
        $frames['datacenter']['items']['income']['active'] = '';

        $frames['datacenter']['items']['pay']['url'] = Util::webUrl("datum", array( "op" => "pay",'ac'=>'pay','hid'=>$hid));
        $frames['datacenter']['items']['pay']['title'] = '????????????';
        $frames['datacenter']['items']['pay']['actions'] = array('ac', 'pay');
        $frames['datacenter']['items']['pay']['active'] = '';

        $frames['datacenter']['items']['profit']['url'] = Util::webUrl("datum", array( "op" => "profit",'ac'=>'profit','hid'=>$hid));
        $frames['datacenter']['items']['profit']['title'] = '????????????';
        $frames['datacenter']['items']['profit']['actions'] = array('ac', 'profit');
        $frames['datacenter']['items']['profit']['active'] = '';

        return $frames;
    }
    /**
     * static function ??????????????????
     *
     * @access static
     * @name getappFrames
     * @param
     * @return array
     */
    static function getapplyFrames() {
        global $_GPC,$_W;
        $hid = $_SESSION['hid'];
        $frames = array();
        $frames['app']['title'] = '<i class="fa fa-inbox"></i> ??????';
        $frames['app']['items'] = array();
        $frames['app']['items']['docapp']['url'] = Util::webUrl('apply',array('op'=>'apply','ac'=>'docapp','hid'=>$hid));
        $frames['app']['items']['docapp']['title'] = '????????????';
        $frames['app']['items']['docapp']['actions'] = array('ac', 'docapp');
        $frames['app']['items']['docapp']['active'] = '';
      
       
        $frames['useDongtai']['title'] = '<i class="fa fa-inbox"></i> ???????????????';
        $frames['useDongtai']['items'] = array();
      
        $frames['useDongtai']['items']['dynamiclist']['url'] = Util::webUrl("apply", array( "op" => "dynamiclist",'ac'=>'dynamiclist','hid'=>$hid));
        $frames['useDongtai']['items']['dynamiclist']['title'] = '????????????';
        $frames['useDongtai']['items']['dynamiclist']['actions'] = array('ac', 'dynamiclist');
        $frames['useDongtai']['items']['dynamiclist']['active'] = '';  
      
        $frames['useDongtai']['items']['dynamicltype']['url'] = Util::webUrl("apply", array( "op" => "dynamicltype",'ac'=>'dynamicltype','hid'=>$hid));
        $frames['useDongtai']['items']['dynamicltype']['title'] = '????????????';
        $frames['useDongtai']['items']['dynamicltype']['actions'] = array('ac', 'dynamicltype');
        $frames['useDongtai']['items']['dynamicltype']['active'] = '';  

        $frames['useDongtai']['items']['dynamicsys']['url'] = Util::webUrl("apply", array( "op" => "dynamicsys",'ac'=>'dynamicsys','hid'=>$hid));
        $frames['useDongtai']['items']['dynamicsys']['title'] = '????????????';
        $frames['useDongtai']['items']['dynamicsys']['actions'] =  array('ac', 'dynamicsys');
        $frames['useDongtai']['items']['dynamicsys']['active'] = '';  
         $frames['useDongtai']['items']['characters']['url'] = Util::webUrl("apply", array( "op" => "characters",'ac'=>'characters','hid'=>$hid));
        $frames['useDongtai']['items']['characters']['title'] = '????????????';
        $frames['useDongtai']['items']['characters']['actions'] =  array('ac', 'characters');
        $frames['useDongtai']['items']['characters']['active'] = '';  
        

        $frames['customerservice']['items']['professional']['url'] = Util::webUrl("apply", array( "op" => "professional",'ac'=>'professional'));
        $frames['customerservice']['items']['professional']['title'] = '????????????';
        $frames['customerservice']['items']['professional']['actions'] = array('ac', 'professional');
        $frames['customerservice']['items']['professional']['active'] = '';  
        $frames['marketing']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['marketing']['items'] = array();
      
        $frames['marketing']['items']['activity']['url'] = Util::webUrl("apply", array( "op" => "activity",'ac'=>'activity'));
        $frames['marketing']['items']['activity']['title'] = '????????????';
        $frames['marketing']['items']['activity']['actions'] = array('ac', 'activity');
        $frames['marketing']['items']['activity']['active'] = '';  
      
        $frames['marketing']['items']['acrecord']['url'] = Util::webUrl("apply", array( "op" => "acrecord",'ac'=>'acrecord'));
        $frames['marketing']['items']['acrecord']['title'] = '????????????';
        $frames['marketing']['items']['acrecord']['actions'] = array('ac', 'acrecord');
        $frames['marketing']['items']['acrecord']['active'] = '';  
        $frames['coupon']['title'] = '<i class="fa fa-inbox"></i> ?????????';
        $frames['coupon']['items'] = array();
      
        $frames['coupon']['items']['couponlist']['url'] =  Util::webUrl("apply", array( "op" => "couponlist",'ac'=>'couponlist','hid'=>$hid));
        $frames['coupon']['items']['couponlist']['title'] = '????????????';
        $frames['coupon']['items']['couponlist']['actions'] = array('ac', 'couponlist');
        $frames['coupon']['items']['couponlist']['active'] = '';  

        $frames['coupon']['items']['couponchangecode']['url'] =  Util::webUrl("apply", array( "op" => "couponchangecode",'ac'=>'couponchangecode','hid'=>$hid));
        $frames['coupon']['items']['couponchangecode']['title'] = '???????????????';
        $frames['coupon']['items']['couponchangecode']['actions'] = array('ac', 'couponchangecode');
        $frames['coupon']['items']['couponchangecode']['active'] = '';        

        $frames['coupon']['items']['couponrecord']['url'] = Util::webUrl("apply", array( "op" => "couponrecord",'ac'=>'couponrecord','hid'=>$hid));
        $frames['coupon']['items']['couponrecord']['title'] = '????????????';
        $frames['coupon']['items']['couponrecord']['actions'] = array('ac', 'couponrecord');
        $frames['coupon']['items']['couponrecord']['active'] = '';  

        $frames['coupon']['items']['couponrule']['url'] = Util::webUrl("apply", array( "op" => "couponrule",'ac'=>'couponrule'));
        $frames['coupon']['items']['couponrule']['title'] = '????????????';
        $frames['coupon']['items']['couponrule']['actions'] = array('ac', 'couponrule');
        $frames['coupon']['items']['couponrule']['active'] = '';  

        $frames['spread']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['spread']['items'] = array();
        $frames['spread']['items']['spreadlist']['url'] = Util::webUrl("apply", array( "op" => "spreadlist",'ac'=>'spreadlist','hid'=>$hid));
        $frames['spread']['items']['spreadlist']['title'] = '????????????';
        $frames['spread']['items']['spreadlist']['actions'] = array('ac', 'spreadlist');
        $frames['spread']['items']['spreadlist']['active'] = '';  
      
        $frames['spread']['items']['spreadrecord']['url'] =Util::webUrl("apply", array( "op" => "spreadrecord",'ac'=>'spreadrecord','hid'=>$hid));
        $frames['spread']['items']['spreadrecord']['title'] = '????????????';
        $frames['spread']['items']['spreadrecord']['actions'] = array('ac', 'spreadrecord');
        $frames['spread']['items']['spreadrecord']['active'] = '';  
      
        $frames['spread']['items']['spreadrule']['url'] = Util::webUrl("apply", array( "op" => "spreadrule",'ac'=>'spreadrule','hid'=>$hid));
        $frames['spread']['items']['spreadrule']['title'] = '????????????';
        $frames['spread']['items']['spreadrule']['actions'] = array('ac', 'spreadrule');
        $frames['spread']['items']['spreadrule']['active'] = '';  
      
        $frames['spread']['items']['commission']['url'] = Util::webUrl("apply", array( "op" => "commission",'ac'=>'commission','hid'=>$hid));
        $frames['spread']['items']['commission']['title'] = '????????????';
        $frames['spread']['items']['commission']['actions'] = array('ac', 'commission');
        $frames['spread']['items']['commission']['active'] = '';  
      
        $frames['spread']['items']['withdraw']['url'] = Util::webUrl("apply", array( "op" => "withdraw",'ac'=>'withdraw','hid'=>$hid));
        $frames['spread']['items']['withdraw']['title'] = '????????????';
        $frames['spread']['items']['withdraw']['actions'] = array('ac', 'withdraw');
        $frames['spread']['items']['withdraw']['active'] = '';  


        $frames['spreadrule']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['spreadrule']['items'] = array();
        $frames['spreadrule']['items']['spreadrule']['url'] = Util::webUrl("apply", array( "op" => "spreadrule",'ac'=>'spreadrule'));
        $frames['spreadrule']['items']['spreadrule']['title'] = '????????????';
        $frames['spreadrule']['items']['spreadrule']['actions'] = array('ac', 'spreadrule');
        $frames['spreadrule']['items']['spreadrule']['active'] = ''; 
   
   

        return $frames;
    }
      /**
     * static function ??????????????????
     *
     * @access static
     * @name getappFrames
     * @param
     * @return array
     */
    static function getzhikuFrames() {
        global $_GPC,$_W;
        $hid = $_SESSION['hid'];
        $frames = array();
        $frames['Tag']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['Tag']['items'] = array();
        $frames['Tag']['items']['tag']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.tag&ac=tag&hid=".$hid;
        $frames['Tag']['items']['tag']['title'] = '????????????';
        $frames['Tag']['items']['tag']['actions'] = array('ac', 'tag');
        $frames['Tag']['items']['addtag']['active'] = '';
        $frames['Tag']['items']['addtag']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addtag&ac=tag&hid=".$hid;
        $frames['Tag']['items']['addtag']['title'] = '????????????';
        $frames['Tag']['items']['addtag']['actions'] = array('ac', 'addtag');
        $frames['Tag']['items']['addtag']['active'] = '';

        $frames['zhiku']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['zhiku']['items'] = array();
        $frames['zhiku']['items']['zhikucat']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.zhikucat&ac=zhikucat&hid=".$hid;
        $frames['zhiku']['items']['zhikucat']['title'] = '????????????';
        $frames['zhiku']['items']['zhikucat']['actions'] = array('ac', 'zhikucat');
        $frames['zhiku']['items']['zhikucat']['active'] = '';
      
        $frames['zhiku']['items']['addzhiku']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addzhiku&ac=addzhiku&hid=".$hid;
        $frames['zhiku']['items']['addzhiku']['title'] =  !empty($_GPC['id'] && $_GPC['ac']=='addzhiku') ? '????????????' : '????????????'; 
        $frames['zhiku']['items']['addzhiku']['actions'] = array('ac', 'addzhiku');
        $frames['zhiku']['items']['addzhiku']['active'] = '';
      
        $frames['appAttribute']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['appAttribute']['items'] = array();
        $frames['appAttribute']['items']['addappAttributelist']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.lists&ac=addappAttributelist&hid=".$hid;
        $frames['appAttribute']['items']['addappAttributelist']['title'] = '????????????';
        $frames['appAttribute']['items']['addappAttributelist']['actions'] = array('ac', 'addappAttributelist');
        $frames['appAttribute']['items']['addappAttributelist']['active'] = '';
      
        $frames['appAttribute']['items']['addappAttribute']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addappAttribute&ac=addappAttribute&hid=".$hid;
        $frames['appAttribute']['items']['addappAttribute']['title'] = '????????????';
        $frames['appAttribute']['items']['addappAttribute']['actions'] = array('ac', 'addappAttribute');
        $frames['appAttribute']['items']['addappAttribute']['active'] = '';  
      
        $frames['disease']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['disease']['items'] = array();
        $frames['disease']['items']['diseaselist']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.diseaselist&ac=diseaselist&hid=".$hid;
        $frames['disease']['items']['diseaselist']['title'] = '????????????';
        $frames['disease']['items']['diseaselist']['actions'] = array('ac', 'diseaselist');
        $frames['disease']['items']['diseaselist']['active'] = '';
      
        $frames['disease']['items']['adddisease']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.adddisease&ac=adddisease&hid=".$hid;
        $frames['disease']['items']['adddisease']['title'] = !empty($_GPC['id'] && $_GPC['ac']=='adddisease') ? '????????????' : '????????????'; 
        $frames['disease']['items']['adddisease']['actions'] = array('ac', 'adddisease');
        $frames['disease']['items']['adddisease']['active'] = '';      
      
        $frames['disease']['items']['jbicon']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.jbicon&ac=jbicon&hid=".$hid;
        $frames['disease']['items']['jbicon']['title'] = '????????????';
        $frames['disease']['items']['jbicon']['actions'] = array('ac', 'jbicon');
        $frames['disease']['items']['jbicon']['active'] = '';  
      
        $frames['Symptom']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['Symptom']['items'] = array();
      
        $frames['Symptom']['items']['jblblist']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.jblblist&ac=jblblist";
        $frames['Symptom']['items']['jblblist']['title'] = '????????????';
        $frames['Symptom']['items']['jblblist']['actions'] = array('ac', 'jblblist');
        $frames['Symptom']['items']['jblblist']['active'] = '';

        $frames['Symptom']['items']['addjblb']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addjblb&ac=addjblb";
        $frames['Symptom']['items']['addjblb']['title'] = !empty($_GPC['id'] && $_GPC['ac']=='addjblb') ? '????????????' : '????????????'; 
        $frames['Symptom']['items']['addjblb']['actions'] = array('ac', 'addjblb');
        $frames['Symptom']['items']['addjblb']['active'] = '';
      
        $frames['Symptom']['items']['symptom']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.symptom&ac=symptom&hid=".$hid;
        $frames['Symptom']['items']['symptom']['title'] = '????????????';
        $frames['Symptom']['items']['symptom']['actions'] = array('ac', 'symptom');
        $frames['Symptom']['items']['symptom']['active'] = ''; 
      
        $frames['Symptom']['items']['addSymptom']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addSymptom&ac=addSymptom&hid=".$hid;
        $frames['Symptom']['items']['addSymptom']['title'] = '????????????';
        $frames['Symptom']['items']['addSymptom']['actions'] = array('ac', 'addSymptom');
        $frames['Symptom']['items']['addSymptom']['active'] = ''; 

        $frames['Symptom']['items']['zicon']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.zicon&ac=zicon&hid=".$hid;
        $frames['Symptom']['items']['zicon']['title'] = '????????????';
        $frames['Symptom']['items']['zicon']['actions'] = array('ac', 'zicon');
        $frames['Symptom']['items']['zicon']['active'] = ''; 
      
        $frames['vaccine']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['vaccine']['items'] = array();
        $frames['vaccine']['items']['ymlist']['url'] =  "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.ymlist&ac=ymlist&hid=".$hid;
        $frames['vaccine']['items']['ymlist']['title'] = '????????????';
        $frames['vaccine']['items']['ymlist']['actions'] = array('ac', 'ymlist');
        $frames['vaccine']['items']['ymlist']['active'] = ''; 

        $frames['vaccine']['items']['addym']['url'] ="index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addym&ac=addym&hid=".$hid;
        $frames['vaccine']['items']['addym']['title'] = '????????????';
        $frames['vaccine']['items']['addym']['actions'] = array('ac', 'addym');
        $frames['vaccine']['items']['addym']['active'] = ''; 
      
        $frames['inspect']['title'] = '<i class="fa fa-inbox"></i> ???????????????';
        $frames['inspect']['items'] = array();
        $frames['inspect']['items']['jclist']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.jclist&ac=jclist&hid=".$hid;
        $frames['inspect']['items']['jclist']['title'] = '???????????????';
        $frames['inspect']['items']['jclist']['actions'] = array('ac', 'jclist');
        $frames['inspect']['items']['jclist']['active'] = ''; 

        $frames['inspect']['items']['addinspect']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addinspect&ac=addinspect&hid=".$hid;
        $frames['inspect']['items']['addinspect']['title'] = '???????????????';
        $frames['inspect']['items']['addinspect']['actions'] = array('ac', 'addinspect');
        $frames['inspect']['items']['addinspect']['active'] = ''; 

        $frames['inspect']['items']['inspecticon']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.inspecticon&ac=inspecticon&hid=".$hid;
        $frames['inspect']['items']['inspecticon']['title'] = '????????????';
        $frames['inspect']['items']['inspecticon']['actions'] = array('ac', 'inspecticon');
        $frames['inspect']['items']['inspecticon']['active'] = ''; 
      
        $frames['Family']['title'] = '<i class="fa fa-inbox"></i> ??????????????????';
        $frames['Family']['items'] = array();
        $frames['Family']['items']['addruglist']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addruglist&ac=addruglist&hid=".$hid;
        $frames['Family']['items']['addruglist']['title'] = '????????????';
        $frames['Family']['items']['addruglist']['actions'] = array('ac', 'addruglist');
        $frames['Family']['items']['addruglist']['active'] = ''; 

        $frames['Family']['items']['addrug']['url'] =  "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addrug&ac=addrug&hid=".$hid;
        $frames['Family']['items']['addrug']['title'] = '??????????????????';
        $frames['Family']['items']['addrug']['actions'] = array('ac', 'addrug');
        $frames['Family']['items']['addrug']['active'] = ''; 
      
        $frames['legal']['title'] = '<i class="fa fa-inbox"></i> ???????????????';
        $frames['legal']['items'] = array();
        $frames['legal']['items']['legallist']['url'] =  "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.legallist&ac=legallist&hid=".$hid;
        $frames['legal']['items']['legallist']['title'] = '???????????????';
        $frames['legal']['items']['legallist']['actions'] = array('ac', 'legallist');
        $frames['legal']['items']['legallist']['active'] = '';  

        $frames['legal']['items']['addlegal']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.addlegal&ac=addlegal&hid=".$hid;
        $frames['legal']['items']['addlegal']['title'] = '???????????????';
        $frames['legal']['items']['addlegal']['actions'] = array('ac', 'addlegal');
        $frames['legal']['items']['addlegal']['active'] = '';   


        $frames['hotwordsearch']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['hotwordsearch']['items'] = array();  
      
        $frames['hotwordsearch']['items']['hotwordsearch']['url'] = "index.php?c=site&a=entry&do=copysite&m=hyb_yl&act=ceshi.hotwordsearch&ac=hotwordsearch&hid=".$hid;
        $frames['hotwordsearch']['items']['hotwordsearch']['title'] = '????????????';
        $frames['hotwordsearch']['items']['hotwordsearch']['actions'] = array('ac', 'hotwordsearch');
        $frames['hotwordsearch']['items']['hotwordsearch']['active'] = ''; 


        return $frames;
    }
  
    static function getlookFrames() {
        global $_W;
        $frames = array();   
        $hid = $_SESSION['hid'];
      $frames['articlesys']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['articlesys']['items'] = array();
        $frames['articlesys']['items']['arlist']['url'] = Util::webUrl("classification", array( "op" => "list",'ac'=>'arlist','hid'=>$hid));
        $frames['articlesys']['items']['arlist']['title'] = '????????????';
        $frames['articlesys']['items']['arlist']['actions'] = array('ac', 'arlist');
        $frames['articlesys']['items']['arlist']['active'] = '';
        $frames['articlesys']['items']['addart']['url'] = Util::webUrl("classification", array( "op" => "add",'ac'=>'addart','hid'=>$hid));
        $frames['articlesys']['items']['addart']['title'] = '????????????';
        $frames['articlesys']['items']['addart']['actions'] = array('ac', 'addart');
        $frames['articlesys']['items']['addart']['active'] = '';
        $frames['goodshouse']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['goodshouse']['items'] = array();
        $frames['goodshouse']['items']['catefl']['url'] = Util::webUrl("classification", array( "op" => "catefl",'ac'=>'catefl','hid'=>$hid));
        $frames['goodshouse']['items']['catefl']['title'] = '????????????';
        $frames['goodshouse']['items']['catefl']['actions'] = array('ac', 'catefl');
        $frames['goodshouse']['items']['catefl']['active'] = '';

        return $frames;
    }
  
    static function getremoteregistrationFrames() {
        global $_W;
        $frames = array();
        $hid = $_SESSION['hid'];
        $frames['paiban']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['paiban']['items'] = array();
    
     	$frames['paiban']['items']['ghgk']['url'] ="index.php?c=site&a=entry&do=remoteregistration&op=gk&m=hyb_yl&ac=remoteregistration&hid=".$hid;
        $frames['paiban']['items']['ghgk']['title'] = '????????????';
        $frames['paiban']['items']['ghgk']['actions'] = array('ac', 'remoteregistration');
        $frames['paiban']['items']['ghgk']['active'] = '';
      
     	// $frames['paiban']['items']['catefl']['url'] =Util::webUrl("remoteregistration", array( "op" => "index",'ac'=>'catefl'));
      //   $frames['paiban']['items']['catefl']['title'] = '????????????';
      //   $frames['paiban']['items']['catefl']['actions'] = array('ac', 'catefl');
      //   $frames['paiban']['items']['catefl']['active'] = '';
      
        $frames['paiban']['items']['list']['url'] =Util::webUrl("remoteregistration", array( "op" => "list",'ac'=>'list','hid'=>$hid));
        $frames['paiban']['items']['list']['title'] = '????????????';
        $frames['paiban']['items']['list']['actions'] = array('ac', 'list');
        $frames['paiban']['items']['list']['active'] = '';
        // $frames['paiban']['items']['schedual']['url'] =Util::webUrl("remoteregistration", array( "op" => "schedual",'ac'=>'schedual'));
        // $frames['paiban']['items']['schedual']['title'] = '????????????';
        // $frames['paiban']['items']['schedual']['actions'] = array('ac', 'schedual');
        // $frames['paiban']['items']['schedual']['active'] = '';
      
        $frames['subscribe']['title'] = '<i class="fa fa-globe"></i> ????????????';
      	$frames['subscribe']['items']['temthum']['url'] =Util::webUrl("remoteregistration", array( "op" => "subscribe",'ac'=>'temthum','hid'=>$hid));
        $frames['subscribe']['items']['temthum']['title'] = '????????????';
        $frames['subscribe']['items']['temthum']['actions'] = array('ac','temthum');
        $frames['subscribe']['items']['temthum']['active'] = '';
        
        $frames['subscribe']['items']['yy_type']['url'] =Util::webUrl("remoteregistration", array( "op" => "yy_type",'ac'=>'yy_type','hid'=>$hid));
        $frames['subscribe']['items']['yy_type']['title'] = '????????????';
        $frames['subscribe']['items']['yy_type']['actions'] = array('ac','yy_type');
        $frames['subscribe']['items']['yy_type']['active'] = '';
        
        

        $frames['order']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['order']['items']['ghorder']['url'] = Util::webUrl("remoteregistration", array( "op" => "ghorder",'ac'=>'ghorder','hid'=>$hid));
        $frames['order']['items']['ghorder']['title'] = '????????????';
        $frames['order']['items']['ghorder']['actions'] = array('ac', 'ghorder');
        $frames['order']['items']['ghorder']['active'] = '';
        
        $frames['articlesys']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['articlesys']['items'] = array();
        $frames['articlesys']['items']['artrule']['url'] = Util::webUrl("remoteregistration", array( "op" => "artrule",'ac'=>'artrule','hid'=>$hid));
        $frames['articlesys']['items']['artrule']['title'] = '????????????';
        $frames['articlesys']['items']['artrule']['actions'] = array('ac', 'artrule');
        $frames['articlesys']['items']['artrule']['active'] = '';
        

        return $frames;
    }
    static function getsettingFrames() {
        global $_W, $_GPC;
        $frames = array();
        
        $hid = $_SESSION['hid'];
        $frames['setting']['title'] = '<i class="fa fa-globe"></i> ????????????';
        $frames['setting']['items'] = array();
        $frames['setting']['items']['base']['url'] =Util::webUrl("base", array( "op" => "basesite",'ac'=>'base','hid'=>$hid));
        $frames['setting']['items']['base']['title'] = '????????????';
        $frames['setting']['items']['base']['actions'] = array('ac', 'base');
        $frames['setting']['items']['base']['active'] = '';

        $frames['setting']['items']['jiekou']['url'] = Util::webUrl("base", array( "op" => "jiekou",'ac'=>'jiekou','hid'=>$hid));
        $frames['setting']['items']['jiekou']['title'] = '????????????';
        $frames['setting']['items']['jiekou']['actions'] = array('ac', 'jiekou');
        $frames['setting']['items']['jiekou']['active'] = '';

        $frames['setting']['items']['box_user']['url'] = Util::webUrl("base", array( "op" => "box_user",'ac'=>'box_user','hid'=>$hid));
        $frames['setting']['items']['box_user']['title'] = '????????????????????????';
        $frames['setting']['items']['box_user']['actions'] = array('ac', 'box_user');
        $frames['setting']['items']['box_user']['active'] = '';

        $frames['setting']['items']['search']['url'] = Util::webUrl("base", array( "op" => "search",'ac'=>'search','hid'=>$hid));
        $frames['setting']['items']['search']['title'] = '????????????';
        $frames['setting']['items']['search']['actions'] = array('ac', 'search');
        $frames['setting']['items']['search']['active'] = '';


        $frames['setting']['items']['pressure']['url'] =Util::webUrl("base", array( "op" => "pressure",'ac'=>'pressure','hid'=>$hid));
        $frames['setting']['items']['pressure']['title'] = '??????????????????';
        $frames['setting']['items']['pressure']['actions'] = array('ac', 'pressure');
        $frames['setting']['items']['pressure']['active'] = '';

        $frames['setting']['items']['sugar']['url'] = Util::webUrl("base", array( "op" => "sugar",'ac'=>'sugar','hid'=>$hid));
        $frames['setting']['items']['sugar']['title'] = '??????????????????';
        $frames['setting']['items']['sugar']['actions'] = array('ac', 'sugar');
        $frames['setting']['items']['sugar']['active'] = '';

        $frames['cover']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['cover']['items'] = array();
        $frames['cover']['items']['czsite']['url'] = Util::webUrl("base", array( "op" => "czsite",'ac'=>'czsite','hid'=>$hid));
        $frames['cover']['items']['czsite']['title'] = '????????????';
        $frames['cover']['items']['czsite']['actions'] = array('ac', 'czsite');
        $frames['cover']['items']['czsite']['active'] = '';

        $frames['cover']['items']['jfsite']['url'] = Util::webUrl("base", array( "op" => "jfsite",'ac'=>'jfsite','hid'=>$hid));
        $frames['cover']['items']['jfsite']['title'] = '????????????';
        $frames['cover']['items']['jfsite']['actions'] = array('ac', 'jfsite');
        $frames['cover']['items']['jfsite']['active'] = '';

      

        $frames['cover']['items']['zfsite']['url'] = Util::webUrl("base", array( "op" => "zfsite",'ac'=>'zfsite','hid'=>$hid));
        $frames['cover']['items']['zfsite']['title'] = '????????????';
        $frames['cover']['items']['zfsite']['actions'] = array('ac', 'zfsite');
        $frames['cover']['items']['zfsite']['active'] = '';  
      
        $frames['msgsite']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['msgsite']['items'] = array();

        // $frames['msgsite']['items']['dxmsg']['url'] = Util::webUrl("base", array( "op" => "dxmsg",'ac'=>'dxmsg'));
        // $frames['msgsite']['items']['dxmsg']['title'] = '????????????';
        // $frames['msgsite']['items']['dxmsg']['actions'] = array('ac', 'dxmsg');
        // $frames['msgsite']['items']['dxmsg']['active'] = '';
        $frames['msgsite']['items']['dxsys']['url'] = Util::webUrl("base", array( "op" => "dxsys",'ac'=>'dxsys','hid'=>$hid));
        $frames['msgsite']['items']['dxsys']['title'] = '????????????';
        $frames['msgsite']['items']['dxsys']['actions'] = array('ac', 'dxsys');
        $frames['msgsite']['items']['dxsys']['active'] = '';

        $frames['msgsite']['items']['dymsg']['url'] = Util::webUrl("base", array( "op" => "dymsg",'ac'=>'dymsg','hid'=>$hid));
        $frames['msgsite']['items']['dymsg']['title'] = '????????????';
        $frames['msgsite']['items']['dymsg']['actions'] = array('ac', 'dymsg');
        $frames['msgsite']['items']['dymsg']['active'] = ''; 
      
        $frames['xcxsrc']['title'] = '<i class="fa fa-inbox"></i> ???????????????';
        $frames['xcxsrc']['items'] = array();  

        $frames['xcxsrc']['items']['scxsite']['url'] = Util::webUrl("base", array( "op" => "scxsite",'ac'=>'scxsite','hid'=>$hid));
        $frames['xcxsrc']['items']['scxsite']['title'] = '???????????????';
        $frames['xcxsrc']['items']['scxsite']['actions'] = array('ac', 'scxsite');
        $frames['xcxsrc']['items']['scxsite']['active'] = ''; 
      
        $frames['pssite']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['pssite']['items'] = array();  
      
        $frames['pssite']['items']['psimg']['url'] = Util::webUrl("base", array( "op" => "psimg",'ac'=>'psimg','hid'=>$hid));
        $frames['pssite']['items']['psimg']['title'] = '????????????';
        $frames['pssite']['items']['psimg']['actions'] = array('ac', 'psimg');
        $frames['pssite']['items']['psimg']['active'] = ''; 

        $frames['dingshi']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['dingshi']['items'] = array();  
        
        $frames['dingshi']['items']['dingshi']['url'] = Util::webUrl("base", array( "op" => "dingshi",'ac'=>'dingshi','hid'=>$hid));
        $frames['dingshi']['items']['dingshi']['title'] = '????????????';
        $frames['dingshi']['items']['dingshi']['actions'] = array('ac', 'psimg');
        $frames['dingshi']['items']['dingshi']['active'] = ''; 

        $frames['dingshi']['items']['kanban']['url'] = Util::webUrl("base", array( "op" => "kanban",'ac'=>'kanban','hid'=>$hid));
        $frames['dingshi']['items']['kanban']['title'] = '??????';
        $frames['dingshi']['items']['kanban']['actions'] = array('ac', 'kanban');
        $frames['dingshi']['items']['kanban']['active'] = ''; 
      
        $frames['wxgz']['title'] = '<i class="fa fa-inbox"></i> ???????????????';
        $frames['wxgz']['items'] = array();  
        
        $frames['wxgz']['items']['wxmb']['url'] = Util::webUrl("base", array( "op" => "wxmb",'ac'=>'wxmb','hid'=>$hid));
        $frames['wxgz']['items']['wxmb']['title'] = '????????????';
        $frames['wxgz']['items']['wxmb']['actions'] = array('ac', 'wxmb');
        $frames['wxgz']['items']['wxmb']['active'] = ''; 


        return $frames;
    }

    /**
     * Comment: ????????????????????????
     * Author: zyj
     * Date: 2020/3/3 18:30
     */
    static function getgoodsFrames(){
        global $_W;
        $hid = $_SESSION['hid'];
        $frames = array();
        $frames['goods']['title'] = '<i class="fa fa-dashboard"></i> ????????????';
        $frames['goods']['items'] = array();

        $frames['goods']['items']['list']['url'] = Util::webUrl("goods", array( "op" => "list",'ac'=>'list','hid'=>$hid));
        $frames['goods']['items']['list']['title'] = '????????????';
        $frames['goods']['items']['list']['actions'] = array('ac', 'list');
        $frames['goods']['items']['list']['active'] = '';

        $frames['goods']['items']['cate']['url'] = Util::webUrl("goods", array( "op" => "cate",'ac'=>'cate','hid'=>$hid));
        $frames['goods']['items']['cate']['title'] = '????????????';
        $frames['goods']['items']['cate']['actions'] = array('ac', 'cate');
        $frames['goods']['items']['cate']['active'] = '';




        return $frames;
    }


    static function getcloudFrames() {
        global $_W, $_GPC;
        $frames = array();
        $hid = $_SESSION['hid'];

        $frames['plugin']['title'] = '<i class="fa fa-database"></i> ????????????';
        $frames['plugin']['items'] = array();

        $frames['plugin']['items']['index']['url'] = Util::webUrl('cloud',array('op'=>'yunlist',''=>'index','hid'=>$hid));
        $frames['plugin']['items']['index']['title'] = '????????????';
        $frames['plugin']['items']['index']['actions'] = array('ac','index');
        $frames['plugin']['items']['index']['active'] = '';


        $frames['database']['title'] = '<i class="fa fa-database"></i> ????????????';
        $frames['database']['items'] = array();

        $frames['database']['items']['datemana']['url'] = Util::webUrl('cloud',array('op'=>'datemana',''=>'datemana'));
        $frames['database']['items']['datemana']['title'] = '????????????';
        $frames['database']['items']['datemana']['actions'] =  array('ac','datemana');
        $frames['database']['items']['datemana']['active'] = '';



        $frames['sysset']['title'] = '<i class="fa fa-database"></i> ????????????';
        $frames['sysset']['items'] = array();

        $frames['sysset']['items']['jhtask']['url'] = Util::webUrl('cloud',array('op'=>'jhtask',''=>'jhtask'));
        $frames['sysset']['items']['jhtask']['title'] = '????????????';
        $frames['sysset']['items']['jhtask']['actions'] =  array('ac','jhtask');
        $frames['sysset']['items']['jhtask']['active'] = '';

        return $frames;
    }

    static function getgreenFrames() {
        global $_W, $_GPC;
        $frames = array();
        $hid = $_SESSION['hid'];

        $frames['greenone']['title'] = '<i class="fa fa-database"></i> ????????????';
        $frames['greenone']['items'] = array();

        $frames['greenone']['items']['index']['url'] = Util::webUrl('green',array('op'=>'index','ac'=>'index','hid'=>$hid));
        $frames['greenone']['items']['index']['title'] = '????????????';
        $frames['greenone']['items']['index']['actions'] = array('ac','index');
        $frames['greenone']['items']['index']['active'] = '';

        $frames['customerservice']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['customerservice']['items'] = array();
      
       $frames['customerservice']['items']['list']['url'] = Util::webUrl("green", array( "op" => "list",'ac'=>'list','hid'=>$hid));
       $frames['customerservice']['items']['list']['title'] = '????????????';
        $frames['customerservice']['items']['list']['actions'] = array('ac', 'list');
        $frames['customerservice']['items']['list']['active'] = '';  
      
       $frames['customerservice']['items']['order']['url'] = Util::webUrl("green", array( "op" => "order",'ac'=>'order','hid'=>$hid));
       $frames['customerservice']['items']['order']['title'] = '????????????';
        $frames['customerservice']['items']['order']['actions'] = array('ac', 'order');
        $frames['customerservice']['items']['order']['active'] = '';  
        
        $frames['greenlist']['title'] = '<i class="fa fa-inbox"></i> ????????????';
        $frames['greenlist']['items'] = array();
        $frames['greenlist']['items']['special']['url'] = Util::webUrl("green", array( "op" => "special",'ac'=>'special','hid'=>$hid));
        $frames['greenlist']['items']['special']['title'] = '????????????';
        $frames['greenlist']['items']['special']['actions'] = array('ac', 'special');
        $frames['greenlist']['items']['special']['active'] = '';
        
        $frames['greenlist']['items']['list']['url'] = Util::webUrl("green", array( "op" => "list",'ac'=>'list'));
        $frames['greenlist']['items']['list']['title'] = '????????????';
        $frames['greenlist']['items']['list']['actions'] = array('ac', 'list');
        $frames['greenlist']['items']['list']['active'] = '';



        $frames['greenorder']['title'] = '<i class="fa fa-database"></i> ????????????';
        $frames['greenorder']['items'] = array();

        $frames['greenorder']['items']['order']['url'] = Util::webUrl('green',array('op'=>'order',''=>'order'));
        $frames['greenorder']['items']['order']['title'] = '????????????';
        $frames['greenorder']['items']['order']['actions'] =  array('ac','order');
        $frames['greenorder']['items']['order']['active'] = '';

        return $frames;
    }
     static function getallmenu(){
        global $_W, $_GPC;
        $frames = array('dashboard');
        return $frames;
     }


}
