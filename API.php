<?php

class API {
	public $users;
	public $dyno;
	public $method;
	public $hits;
	public $responseTime;

	function __construct() {
		$this->users = array();
		$this->dyno = array();
		$this->method = '';
		$this->hits = 0;
		$this->responseTime = 0;
	}

	public function insertAPIData($APIdata) {
    	if(preg_match("/[0-9]+/", $APIdata['path'], $matches))
			array_push($this->users, $matches[0]);
		array_push($this->dyno, $APIdata['dyno']);
		$this->method = $APIdata['method'];
		$this->hits = 1;
		$this->responseTime = ($APIdata['connect'] + $APIdata['service']);
	}

	public function updateAPIData($APIdata) {
    	if(preg_match("/[0-9]+/", $APIdata['path'], $matches))
			array_push($this->users, $matches[0]);
		array_push($this->dyno, $APIdata['dyno']);
		$this->hits++;
		$this->responseTime += ( ($APIdata['connect']+$APIdata['service']) / $this->hits );
	}

	public function getActiveUser() {
		if(count($this->users) > 0) {
			$mostActiveUser = array_count_values($this->users);
			return array_search(max($mostActiveUser), $mostActiveUser);
		}
	}

	public function getActiveDyno() {
		if(count($this->dyno) > 0) {
			$mostActiveDyno = array_count_values($this->dyno);
			return array_search(max($mostActiveDyno), $mostActiveDyno);
		}
	}

	public function display() {
		echo PHP_EOL . "Access Count: " . $this->hits . PHP_EOL;
		echo "Average Response Time: " . $this->responseTime . " ms" . PHP_EOL;
		echo "Most Active User: " . $this->getActiveUser() . PHP_EOL;
		echo "Most Active Dyno: " . $this->getActiveDyno() . PHP_EOL . PHP_EOL;
	}
}

?>