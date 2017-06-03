<?php
	include_once "common.php";
	$mode = $_GET["mode"];
	$id = $_GET["id"];
	$supplier_id = $db->fetch_single_data("pokja_ulp","ba_hasil_supplier_id",array("procurement_work_id"=>$id));
	
	echo $supplier_id;
?>