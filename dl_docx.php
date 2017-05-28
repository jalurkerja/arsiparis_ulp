<?php
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=documents.doc");
	function read_file($filename){
		$fp = fopen($filename, "r");
		$return = fread($fp,filesize($filename));
		fclose($fp);
		return $return;
	}
	echo read_file("htmls/doc_14_01.html");
?>
