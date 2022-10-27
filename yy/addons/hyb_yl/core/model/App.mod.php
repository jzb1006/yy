<?php
//dezend by http://www.sucaihuo.com/
class App
{
	static public function getPlugins($type = 3)
	{
		$styles = Util::traversingFiles(PATH_PLUGIN);
		$pluginsset = array();

		foreach ($styles as $key => $value) {
			$config = self::ext_plugin_config($value);
			if (!empty($config) && is_array($config)) {
				unset($config['menus']);
				$plugininfo = pdo_get('wlmerchant_plugin', array('name' => $value));

				if (empty($plugininfo)) {
					pdo_insert('wlmerchant_plugin', array('name' => $config['ident'], 'type' => $config['category'], 'title' => $config['name'], 'thumb' => '../addons/hyb_yl/plugin/' . $config['ident'] . '/icon.png', 'ability' => $config['des'], 'status' => 1));
				}
				else {
					if ($plugininfo['status'] != 1) {
						continue;
					}

					$config['name'] = $plugininfo['title'];
					$config['thumb'] = $plugininfo['thumb'];
					$config['des'] = $plugininfo['ability'];
					$config['displayorder'] = $plugininfo['displayorder'];
				}

				if ($type == 1 && $config['setting']['agent'] == 'true') {
					$pluginsset[$value] = $config;
				}
				else {
					if ($type == 2 && $config['setting']['system'] == 'true') {
						$pluginsset[$value] = $config;
					}
					else {
						if ($type == 3) {
							$pluginsset[$value] = $config;
						}
					}
				}
			}
		}

		$pluginsset = Util::multi_array_sort($pluginsset, 'displayorder', SORT_DESC);
		return $pluginsset;
	}

	static public function getCategory()
	{
		return array(
			'market'     => array('name' => '营销应用'),
			'interact' => array('name' => '互动应用'),
			'expand'     => array('name' => '拓展应用'),
			'help'     => array('name' => '辅助应用')
		);
	}

	static public function get_apps($id = 0, $type = 'account')
	{
		global $_W;

		if ($type == 'account') {
			$plugins = self::getPlugins(2);
			$perms = self::get_account_perm('plugins', $id);
		}
		else {
			$plugins = self::getPlugins(1);
			$perms = self::get_account_perm('plugins');

			if (!empty($id)) {
				$aperms = Area::getSingleGroup(pdo_getcolumn(PDO_NAME . 'agentusers', array('uniacid' => $_W['uniacid'], 'id' => $id), 'groupid'));
			}

			$perms = !empty($perms) ? (!empty($aperms['package']) ? array_intersect($perms, $aperms['package']) : $perms) : $aperms['package'];
		}

		foreach ($plugins as $key => $row) {
			if (!empty($perms) && !in_array($row['ident'], $perms)) {
				unset($plugins[$key]);
			}
		}

		return $plugins;
	}

	static public function get_account_perm($key = '', $uniacid = 0)
	{
		global $_W;

		if (empty($uniacid)) {
			$uniacid = $_W['uniacid'];
		}

		$perm = pdo_get('wlmerchant_perm_account', array('uniacid' => $uniacid));

		if (empty($perm)) {
			return false;
		}

		if (!empty($perm)) {
			$perm['plugins'] = iunserializer($perm['plugins']);

			if (!is_array($perm['plugins'])) {
				$perm['plugins'] = array();
			}

			if (empty($perm['plugins'])) {
				$perm['plugins'] = array('none');
			}

			if (!empty($key)) {
				return $perm[$key];
			}
		}

		return $perm;
	}

	static public function ext_plugin_config($plugin)
	{
		$filename = PATH_PLUGIN . $plugin . '/config.xml';

		if (!file_exists($filename)) {
			return array();
		}

		$manifest = self::ext_plugin_config_parse(file_get_contents($filename));
		if (empty($manifest['name']) || $manifest['ident'] != $plugin) {
			return array();
		}

		return $manifest;
	}

	static public function ext_plugin_config_parse($xml)
	{
		if (!strexists($xml, '<manifest')) {
			$xml = base64_decode($xml);
		}

		if (empty($xml)) {
			return array();
		}

		$dom = new DOMDocument();
		$dom->loadXML($xml);
		$root = $dom->getElementsByTagName('manifest')->item(0);

		if (empty($root)) {
			return array();
		}

		$application = $root->getElementsByTagName('application')->item(0);

		if (empty($application)) {
			return array();
		}

		$manifest = array('name' => trim($application->getElementsByTagName('name')->item(0)->textContent), 'ident' => trim($application->getElementsByTagName('identifie')->item(0)->textContent), 'version' => trim($application->getElementsByTagName('version')->item(0)->textContent), 'category' => trim($application->getElementsByTagName('type')->item(0)->textContent), 'des' => trim($application->getElementsByTagName('description')->item(0)->textContent), 'author' => trim($application->getElementsByTagName('author')->item(0)->textContent), 'url' => trim($application->getElementsByTagName('url')->item(0)->textContent));
		$manifest['setting']['component'] = 'false';
		$manifest['setting']['agent'] = 'false';
		$manifest['setting']['system'] = 'false';
		$manifest['setting']['task'] = 'false';
		$setting = $root->getElementsByTagName('setting')->item(0);

		if (!empty($setting)) {
			$component = $setting->getElementsByTagName('component')->item(0);
			if (!empty($component) && $component->getAttribute('embed') == 'true') {
				$manifest['setting']['component'] = 'true';
			}

			$agent = $setting->getElementsByTagName('agent')->item(0);
			if (!empty($agent) && $agent->getAttribute('embed') == 'true') {
				$manifest['setting']['agent'] = 'true';
			}

			$system = $setting->getElementsByTagName('system')->item(0);
			if (!empty($system) && $system->getAttribute('embed') == 'true') {
				$manifest['setting']['system'] = 'true';
			}

			$task = $setting->getElementsByTagName('task')->item(0);
			if (!empty($task) && $task->getAttribute('embed') == 'true') {
				$manifest['setting']['task'] = 'true';
			}
		}

		if (defined('IN_WEB') && $manifest['setting']['agent']) {
			$elm = $root->getElementsByTagName('agentmenu')->item(0);
		}
		else {
			$elm = $root->getElementsByTagName('systemmenu')->item(0);
		}

		$manifest['menus'] = self::ext_plugin_config_entries($elm, $manifest);
		return $manifest;
	}

	static public function ext_plugin_config_entries($elm, &$manifest)
	{
		$frames = array();
		$menus = $elm->getElementsByTagName('menu');

		foreach ($menus as $i => $cmenu) {
			$frames[$manifest['ident'] . $i]['title'] = '<i class="fa ' . $cmenu->getAttribute('font') . '"></i>&nbsp;&nbsp; ' . $cmenu->getAttribute('title');
			$entries = $cmenu->getElementsByTagName('entry');
			$j = 0;

			while ($j < $entries->length) {
				$entry = $entries->item($j);
				$ac = $entry->getAttribute('ac');
				$do = $entry->getAttribute('do');
				$iscover = $entry->getAttribute('iscover');
				$actions = json_decode($entry->getAttribute('actions'));
				$actions = !empty($actions) ? $actions : array('ac', $ac, 'do', $do);
				$row = array('url' => web_url($manifest['ident'] . '/' . $ac . '/' . $do), 'title' => $entry->getAttribute('title'), 'actions' => $actions, 'active' => '');

				if ($iscover == 'true') {
					$manifest['cover'] = $row['url'];
				}

				if (!empty($row['title']) && !empty($row['url'])) {
					$frames[$manifest['ident'] . $i]['items'][$ac . $do] = $row;
				}

				++$j;
			}
		}

		return $frames;
	}
}

defined('IN_IA') || exit('Access Denied');

?>
