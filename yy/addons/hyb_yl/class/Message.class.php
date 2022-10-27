<?php

class Message 
{
	
	
	
	// 表单数据提醒
	public static function sendmessage($openid,$messageid) {
		
		$time = date('Y-m-d H::s',TIMESTAMP);

        $msg_json = <<<div
			{
			  "touser": "{$openid}",  
			  "template_id": "{$messageid}", 
			  "page": "hyb_yl/pages/form/form",    
			  "form_id": "FORMID",
			  "data": {
			      "keyword1": {
			          "value": "有人提交了一项表单数据,点击查看", 
			          "color": "#173177"
			      }, 
			      "keyword2": {
			          "value": "{$time}", 
			          "color": "#173177"
			      } 
			  }
			}
div;

		return self::commonPostMessage($msg_json);
	}

	
	//模板消息url
	static function getUrl1(){
		global $_W;
		
		load() -> model('account');
		$account = WeAccount::create( $_W['acid'] );
		$access_token = $account->getAccessToken();
		$url1 = "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=".$access_token;		
		return $url1;
		
	}
	
	static function commonPostMessage($msg_json){
		$url1 = self::getUrl1();
		$res = Util::httpPost($url1, $msg_json,11);
		$res = json_decode((string)$res,true);	
		var_dump( $res );
		if($res['errmsg'] == 'ok') return true;return false;
	}	
	



/*************以下是发消息******************/	





	
}
