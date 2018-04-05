<?php
require_once __DIR__."/DataSourceModelInterface.php";

class CsvModel implements DataSourceModelInterface {
	
	public function save($args) {
		$filename = $args["dist"];
		$fhandle = fopen($filename, "a");
		try {
			fputcsv($fhandle, $args["data"]);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}

?>