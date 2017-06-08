<?php
	header("Content-type: application/vnd.ms-word");
	if(!isset($_GET["page"])) $_GET["page"] = 1;
	$page = substr("00",0,2-strlen($_GET["page"])).$_GET["page"];
	$Kuitansi_id = $_GET["Kuitansi_id"];
	$supplier_id = $_GET["supplier_id"];
	header("Content-Disposition: attachment;Filename=surat_undangan_".$supplier_id.".doc");
	include_once "common.php";
	include_once "func.convert_number_to_words.php";
	$procurement_work_id = $db->fetch_single_data("Kuitansi","procurement_work_id",array("id" => $Kuitansi_id));
	
	$arr1 = array();
	array_push($arr1,"{undangan_nomor}");
	array_push($arr1,"{undangan_tanggal}");
	array_push($arr1,"{supplier_name}");
	array_push($arr1,"{supplier_address}");
	array_push($arr1,"{procurement_work_name}");
	array_push($arr1,"{procurement_work_tahun_anggaran}");
	array_push($arr1,"{undang_tgl_hari}");
	array_push($arr1,"{undang_tgl}");
	array_push($arr1,"{undang_jam}");
	array_push($arr1,"{undang_tempat}");
	array_push($arr1,"{procurement_work_pokja_name_1}");
	array_push($arr1,"{procurement_work_pokja_nip_1}");
	
	$procurement_work_id = $db->fetch_single_data("Kuitansi","procurement_work_id",array("id"=>$Kuitansi_id));
	
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$procurement_work = $db->fetch_data();
	
	$arr2 = array();
	array_push($arr2,$db->fetch_single_data("Kuitansi","undangan_nomor",array("id"=>$Kuitansi_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("Kuitansi","undangan_tanggal",array("id"=>$Kuitansi_id))));
	array_push($arr2,$db->fetch_single_data("suppliers","name",array("id"=>$supplier_id)));
	array_push($arr2,$db->fetch_single_data("suppliers","address",array("id"=>$supplier_id)));
	array_push($arr2,$procurement_work["name"]);
	array_push($arr2,$procurement_work["tahun_anggaran"]);
	array_push($arr2,sebut_hari($db->fetch_single_data("Kuitansi","undang_tgl",array("id"=>$Kuitansi_id))));
	array_push($arr2,format_tanggal($db->fetch_single_data("Kuitansi","undang_tgl",array("id"=>$Kuitansi_id))));
	array_push($arr2,substr($db->fetch_single_data("Kuitansi","undang_jam",array("id"=>$Kuitansi_id)),0,5));
	array_push($arr2,$db->fetch_single_data("Kuitansi","undang_tempat",array("id"=>$Kuitansi_id)));
	array_push($arr2,$db->fetch_single_data("procurement_work_pokja","pokja_name",array("procurement_work_id"=>$procurement_work_id),array("id")));
	array_push($arr2,$db->fetch_single_data("procurement_work_pokja","pokja_nip",array("procurement_work_id"=>$procurement_work_id),array("id")));
	
	echo str_replace($arr1,$arr2,read_file("htmls/doc_05_".$page.".html"));
?>