<?php

class fileImporter {

	public function importFile($file) {
    	return file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	}
}

?>