<?php

include 'API.php';

class APIstats {
	private $API;

	function __construct() {
		$this->API = array();
	}

	public function insertOrUpdateData($APIdata) {
		$APIdata['path'] = rtrim($APIdata['path'], '/') . '/';
		$endpoint = $APIdata['method'];
		$endpoint .= ' ' . preg_replace("/users\/[0-9]+\//", "users/", $APIdata['path']);

		if (array_key_exists($endpoint,$this->API))
			$this->API[$endpoint]->updateAPIData($APIdata);
		else {
			$APIlog = new API();
			$APIlog->insertAPIData($APIdata);
			$this->API[$endpoint] = $APIlog;
		}
	}

	public function viewStats($API) {
		$API = rtrim($API, '/') . '/';
		$endpoint = preg_replace("/users\/[0-9]+\//", "users/", $API);
		if (array_key_exists($endpoint,$this->API))
			$this->API[$endpoint]->display();
		else
			echo "No Record Found" . "</br>";
	}
}

?>