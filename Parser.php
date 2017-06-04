<?php

class Parser {

	public function parse($log) {
    	preg_match_all('/\s*([^=]+)=(\S+)\s*/', $log, $matches);
    	foreach (array_keys($matches[1]) as $key) {
        	$logObject = array_combine($matches[1],$matches[2]);
    	}
    	return $logObject;
	}
}

?>