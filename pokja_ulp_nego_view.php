<?php
	header("Content-type: application/vnd.ms-word");
	if(!isset($_GET["page"])) $_GET["page"] = 1;
	$page = substr("00",0,2-strlen($_GET["page"])).$_GET["page"];
	$pokja_ulp_id = $_GET["pokja_ulp_id"];
	$supplier_id = $_GET["supplier_id"];
	header("Content-Disposition: attachment;Filename=undangan_negosiasi_".$supplier_id.".doc");
	include_once "common.php";
	include_once "func.convert_number_to_words.php";
	
	$arr1 = array();
	array_push($arr1,"{nego_nomor}");
	array_push($arr1,"{nego_tanggal}");
	array_push($arr1,"{nego_undang_tgl_sebut_hari}");
	array_push($arr1,"{nego_undang_tgl}");
	array_push($arr1,"{nego_undang_jam}");
	array_push($arr1,"{nego_undang_tempat}");
	array_push($arr1,"{supplier_name}");
	array_push($arr1,"{supplier_address}");
	array_push($arr1,"{procurement_work_name}");
	array_push($arr1,"{procurement_work_tahun_anggaran}");
	array_push($arr1,"{procurement_work_pokja_pokja_name_1}");
	array_push($arr1,"{procurement_work_pokja_pokja_nip_1}");
	
	$procurement_work_id = $db->fetch_single_data("pokja_ulp","procurement_work_id",array("id"=>$pokja_ulp_id));
	
	$arr2 = array();
	array_push($arr2,$db->fetch_single_data("pokja_ulp","nego_nomor",array("id"=>$pokja_ulp_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("pokja_ulp","nego_tanggal",array("id"=>$pokja_ulp_id))));
	array_push($arr2,sebut_hari($db->fetch_single_data("pokja_ulp","nego_undang_tgl",array("id"=>$pokja_ulp_id))));
	array_push($arr2,format_tanggal($db->fetch_single_data("pokja_ulp","nego_undang_tgl",array("id"=>$pokja_ulp_id))));
	array_push($arr2,substr($db->fetch_single_data("pokja_ulp","nego_undang_jam",array("id"=>$pokja_ulp_id)),0,5)." WIB");
	array_push($arr2,$db->fetch_single_data("pokja_ulp","nego_undang_tempat",array("id"=>$pokja_ulp_id)));
	array_push($arr2,$db->fetch_single_data("suppliers","name",array("id"=>$supplier_id)));
	array_push($arr2,$db->fetch_single_data("suppliers","address",array("id"=>$supplier_id)));
	array_push($arr2,$procurement_work["name"]);
	array_push($arr2,$procurement_work["tahun_anggaran"]);
	array_push($arr2,$db->fetch_single_data("procurement_work_pokja","pokja_name",array("procurement_work_id"=>$procurement_work_id),array("id")));
	array_push($arr2,$db->fetch_single_data("procurement_work_pokja","pokja_nip",array("procurement_work_id"=>$procurement_work_id),array("id")));
	
	echo str_replace($arr1,$arr2,read_file("htmls/doc_10_".$page.".html"));
?>