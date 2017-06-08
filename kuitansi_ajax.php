<?php
	include_once "common.php";
	$mode = $_GET["mode"];
	$id = $_GET["id"];
	$supplier_id = $db->fetch_single_data("pokja_ulp","ba_hasil_supplier_id",array("procurement_work_id"=>$id));
	$ba_hasil_kerja_nama_1 = $db->fetch_single_data("spk","ba_hasil_kerja_nama_1",array("procurement_work_id"=>$id));
	$ba_hasil_kerja_nip_1 = $db->fetch_single_data("spk","ba_hasil_kerja_nip_1",array("procurement_work_id"=>$id));
	$ba_hasil_kerja_nama_2 = $db->fetch_single_data("spk","ba_hasil_kerja_nama_2",array("procurement_work_id"=>$id));
	$ba_hasil_kerja_nip_2 = $db->fetch_single_data("spk","ba_hasil_kerja_nip_2",array("procurement_work_id"=>$id));
	$ba_hasil_kerja_nama_3 = $db->fetch_single_data("spk","ba_hasil_kerja_nama_3",array("procurement_work_id"=>$id));
	$ba_hasil_kerja_nip_3 = $db->fetch_single_data("spk","ba_hasil_kerja_nip_3",array("procurement_work_id"=>$id));
	$nominal = $db->fetch_single_data("ba_nego","harga",array("procurement_work_id"=>$id,"supplier_id"=>$supplier_id));
	
	echo $supplier_id."|||".$ba_hasil_kerja_nama_1."|||".$ba_hasil_kerja_nip_1."|||".$ba_hasil_kerja_nama_2."|||".$ba_hasil_kerja_nip_2."|||".$ba_hasil_kerja_nama_3."|||".$ba_hasil_kerja_nip_3."|||".$nominal;
?>