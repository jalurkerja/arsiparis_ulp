<?php
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=surat_penetapan_hps.doc");
	include_once "common.php";
	
	$arr1 = array();
	array_push($arr1,"{hps_nomor}");
	array_push($arr1,"{name}");
	array_push($arr1,"{sumber_pendanaan}");
	array_push($arr1,"{hps_tanggal}");
	array_push($arr1,"{sebut_hari}");
	array_push($arr1,"{sebut_tanggal}");
	array_push($arr1,"{ppk_name}");
	array_push($arr1,"{ppk_nip}");
	
	$arr2 = array();
	array_push($arr2,$db->fetch_single_data("procurement_works","hps_nomor",array("id"=>$_GET["id"])));
	array_push($arr2,$db->fetch_single_data("procurement_works","name",array("id"=>$_GET["id"])));
	array_push($arr2,$db->fetch_single_data("procurement_works","sumber_pendanaan",array("id"=>$_GET["id"])));
	array_push($arr2,format_tanggal($db->fetch_single_data("procurement_works","hps_tanggal",array("id"=>$_GET["id"]))));
	array_push($arr2,sebut_hari($db->fetch_single_data("procurement_works","hps_tanggal",array("id"=>$_GET["id"]))));
	array_push($arr2,sebut_tanggal($db->fetch_single_data("procurement_works","hps_tanggal",array("id"=>$_GET["id"]))));
	array_push($arr2,$db->fetch_single_data("procurement_works","ppk_name",array("id"=>$_GET["id"])));
	array_push($arr2,$db->fetch_single_data("procurement_works","ppk_nip",array("id"=>$_GET["id"])));
	
	echo str_replace($arr1,$arr2,read_file("htmls/doc_01.html"));
?>