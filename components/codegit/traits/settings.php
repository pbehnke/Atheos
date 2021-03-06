<?php


trait Settings {

	public function getSettings($path) {
		$settings = Common::readJSON(CONFIG, 'config');
		if (empty($settings)) {
			$settings['username'] = Common::data("user", "session");
			$settings['email'] = "";
		}
		if (isset($settings[$path])) {
			foreach ($settings[$path] as $i => $item) {
				$settings['local_' . $i] = $item;
			}
		}

		return $settings;
	}

	public function setSettings($update, $path) {
		$settings = Common::readJSON(CONFIG, 'config');

		foreach ($update as $i => $item) {
			if (strlen($item) == 0) {
				unset($update[$i]);
				unset($settings[$i]);

				if (strpos($i, "local_") !== false) {
					unset($settings[$path]);
				}
				continue;
			}

			if (strpos($i, "local_") !== false) {
				if (!isset($settings[$path])) {
					$settings[$path] = array();
				}
				$index = str_replace("local_", "", $i);
				$settings[$path][$index] = $item;
				unset($settings[$i]);
				unset($update[$i]);
			}

			if (isset($update[$i])) {
				$settings[$i] = $update[$i];
			}
		}

		Common::saveJSON(CONFIG, $settings, 'config');
	}
}