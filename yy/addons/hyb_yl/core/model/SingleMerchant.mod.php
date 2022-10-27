<?php
//dezend by http://www.sucaihuo.com/
class SingleMerchant
{
	/**
	 * 获取指定商家信息
	 *
	 * @access public
	 * @name getSingleMerchant
	 * @param $id      缓存标志
	 * @param $select  查询参数
	 * @param $where   查询条件
	 * @return array
	 */
	static public function getSingleMerchant($id, $select, $where = array())
	{
		$id = intval($id);
		$where['id'] = $id;
		return Util::getSingelData($select, PDO_NAME . 'merchantdata', $where);
	}

	/**
	 * 获取指定商家金额变动记录
	 *
	 * @access public
	 * @name 方法名称
	 * @param mixed  参数一的说明
	 * @return array
	 */
	static public function getMoneyRecord($sid, $pindex, $psize, $ifpage)
	{
		return Util::getNumData('*', PDO_NAME . 'merchant_money_record', array('sid' => $sid), 'createtime desc', $pindex, $psize, $ifpage);
	}

	/**
	 * 更新商家可结算金额
	 *
	 * @access static
	 * @name updateAmount
	 * @param $money  更新金额（元）
	 * @param $sid  商家ID
	 * @return array
	 */
	static public function updateAmount($money, $sid, $orderid, $type = 1, $detail = '', $plugin = 'rush')
	{
		global $_W;

		if (empty($sid)) {
			return false;
		}

		$merchant = pdo_fetch('select amount from' . tablename(PDO_NAME . 'merchant_account') . ('where uniacid=' . $_W['uniacid'] . ' and sid=' . $sid . ' '));
		pdo_insert(PDO_NAME . 'merchant_money_record', array('sid' => $sid, 'uniacid' => $_W['uniacid'], 'money' => $money, 'orderid' => $orderid, 'createtime' => TIMESTAMP, 'type' => $type, 'detail' => $detail));

		if ($plugin == 'rush') {
			$order = pdo_get(PDO_NAME . 'rush_order', array('id' => $orderid), 'mid');
		}
		else {
			if ($plugin == 'wlfightgroup') {
				$order = pdo_get(PDO_NAME . 'order', array('id' => $orderid), 'mid');
			}
		}

		if (empty($merchant)) {
			return pdo_insert(PDO_NAME . 'merchant_account', array('no_money' => 0, 'sid' => $sid, 'uniacid' => $_W['uniacid'], 'uid' => $_W['uid'], 'amount' => $money, 'updatetime' => TIMESTAMP));
		}

		return pdo_update(PDO_NAME . 'merchant_account', array('amount' => $merchant['amount'] + $money), array('sid' => $sid));
	}

	/**
	 * 更新指定商家的未结束金额
	 *
	 * @access static
	 * @name 方法名称
	 * @param $money  更新金额（元）
	 * @param $sid  商家ID
	 * @return array
	 */
	static public function updateNoSettlementMoney($money, $sid)
	{
		global $_W;

		if (empty($sid)) {
			return false;
		}

		$merchant = pdo_fetch('select no_money from' . tablename(PDO_NAME . 'merchant_account') . ('where uniacid=' . $_W['uniacid'] . ' and sid=' . $sid . ' '));

		if (empty($merchant)) {
			return pdo_insert(PDO_NAME . 'merchant_account', array('no_money' => 0, 'sid' => $sid, 'uniacid' => $_W['uniacid'], 'uid' => $_W['uid'], 'amount' => 0, 'updatetime' => TIMESTAMP));
		}

		$m = $merchant['no_money'] + $money;

		if ($m < 0) {
			return false;
		}

		return pdo_update(PDO_NAME . 'merchant_account', array('no_money' => $merchant['no_money'] + $money, 'updatetime' => TIMESTAMP), array('sid' => $sid));
	}

	/**
	 * 得到指定商家的未结算金额
	 *
	 * @access static
	 * @name getNoSettlementMoney
	 * @param $sid  商家ID
	 * @return array
	 */
	static public function getNoSettlementMoney($sid)
	{
		global $_W;
		$merchant = pdo_fetch('select no_money from' . tablename(PDO_NAME . 'merchant_account') . ('where uniacid=' . $_W['uniacid'] . ' and sid=' . $sid . ' '));
		return $merchant['no_money'];
	}

	static public function finance($openid = '', $money = 0, $desc = '')
	{
		global $_W;
		load()->func('communication');
		$setting = uni_setting($_W['uniacid'], array('payment'));

		if (empty($openid)) {
			return error(-1, 'openid不能为空');
		}

		if (!is_array($setting['payment'])) {
			return error(1, '没有设定支付参数');
		}

		$wechat = $setting['payment']['wechat'];
		$sql = 'SELECT `key`,`secret` FROM ' . tablename('account_wechats') . ' WHERE `uniacid`=:uniacid limit 1';
		$row = pdo_fetch($sql, array(':uniacid' => $_W['uniacid']));
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
		$pars = array();
		$pars['mch_appid'] = $row['key'];
		$pars['mchid'] = $wechat['mchid'];
		$pars['nonce_str'] = random(32);
		$pars['partner_trade_no'] = time() . random(4, true);
		$pars['openid'] = $openid;
		$pars['check_name'] = 'NO_CHECK';
		$pars['amount'] = $money;
		$pars['desc'] = empty($desc) ? '商家佣金提现' : $desc;
		$pars['spbill_create_ip'] = gethostbyname($_SERVER['HTTP_HOST']);
		ksort($pars, SORT_STRING);
		$string1 = '';

		foreach ($pars as $k => $v) {
			$string1 .= $k . '=' . $v . '&';
		}

		$string1 .= 'key=' . $wechat['apikey'];
		$pars['sign'] = strtoupper(md5($string1));
		$xml = array2xml($pars);
		$path_cert = IA_ROOT . '/attachment/feng_fightgroups/cert/' . $_W['uniacid'] . '/apiclient_cert.pem';
		$path_key = IA_ROOT . '/attachment/feng_fightgroups/cert/' . $_W['uniacid'] . '/apiclient_key.pem';
		if (!file_exists($path_cert) || !file_exists($path_key)) {
			$path_cert = IA_ROOT . '/addons/feng_fightgroups/cert/' . $_W['uniacid'] . '/apiclient_cert.pem';
			$path_key = IA_ROOT . '/addons/feng_fightgroups/cert/' . $_W['uniacid'] . '/apiclient_key.pem';
		}

		$extras = array();
		$extras['CURLOPT_SSLCERT'] = $path_cert;
		$extras['CURLOPT_SSLKEY'] = $path_key;
		$resp = ihttp_request($url, $xml, $extras);

		if (empty($resp['content'])) {
			return error(-2, '网络错误');
		}

		$arr = json_decode(json_encode((array) simplexml_load_string($resp['content'])), true);
		$xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
		$dom = new DOMDocument();

		if ($dom->loadXML($xml)) {
			$xpath = new DOMXPath($dom);
			$code = $xpath->evaluate('string(//xml/return_code)');
			$ret = $xpath->evaluate('string(//xml/result_code)');
			if (strtolower($code) == 'success' && strtolower($ret) == 'success') {
				return true;
			}

			$error = $xpath->evaluate('string(//xml/err_code_des)');
			return error(-2, $error);
		}

		return error(-1, '未知错误');
	}

	static public function verifier($sid, $mid)
	{
		global $_W;
		if (empty($sid) || empty($mid)) {
			return false;
		}

		$merchantuser = Util::getSingelData('*', PDO_NAME . 'merchantuser', array('storeid' => $sid, 'mid' => $mid));

		if ($merchantuser) {
			return true;
		}

		return false;
	}

	static public function verifRecordAdd($aid, $sid, $mid, $plugin, $orderid, $verifcode, $remark, $type, $num = 1)
	{
		global $_W;
		if (empty($aid) || empty($sid) || empty($mid) || empty($plugin) || empty($verifcode) || empty($remark)) {
			return false;
		}

		$flagtime = time() - 5;
		$flag = pdo_fetch('SELECT id FROM ' . tablename('wlmerchant_verifrecord') . ('WHERE plugin = \'' . $plugin . '\' AND verifrcode = ' . $verifcode . ' AND createtime > ' . $flagtime . ' '));

		if (empty($flag)) {
			$merchantuser = Util::getSingelData('name,mobile', PDO_NAME . 'merchantuser', array('storeid' => $sid, 'mid' => $mid));
			if (empty($merchantuser['name']) || empty($merchantuser['mobile'])) {
				$member = pdo_get(PDO_NAME . 'member', array('id' => $mid), array('nickname', 'mobile'));
				$merchantuser['name'] = empty($merchantuser['name']) ? $member['nickname'] : $merchantuser['name'];
				$merchantuser['mobile'] = empty($merchantuser['mobile']) ? $member['mobile'] : $merchantuser['mobile'];
			}

			$record = array('uniacid' => $_W['uniacid'], 'num' => $num, 'aid' => $aid, 'storeid' => $sid, 'mid' => $mid, 'plugin' => $plugin, 'orderid' => $orderid, 'verifrcode' => $verifcode, 'verifmid' => $_W['mid'], 'verifnickname' => $merchantuser['name'], 'verifmobile' => $merchantuser['mobile'], 'remark' => $remark, 'createtime' => time(), 'type' => $type);
			pdo_insert(PDO_NAME . 'verifrecord', $record);
			return true;
		}
	}
}

defined('IN_IA') || exit('Access Denied');

?>
