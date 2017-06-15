<?php
	header("Content-type: application/vnd.ms-word");
	if(!isset($_GET["page"])) $_GET["page"] = 1;
	$page = substr("00",0,2-strlen($_GET["page"])).$_GET["page"];
	$pokja_ulp_id = $_GET["pokja_ulp_id"];
	header("Content-Disposition: attachment;Filename=laporan_hasil_pengadaan.doc");
	include_once "common.php";
	include_once "func.convert_number_to_words.php";
	
	$arr1 = array();
	array_push($arr1,"{laporan_nomor}");
	array_push($arr1,"{laporan_tanggal}");
	array_push($arr1,"{ba_hasil_nomor}");
	array_push($arr1,"{ba_hasil_tanggal}");
	array_push($arr1,"{ba_evaluasi_doc_nomor}");
	array_push($arr1,"{ba_evaluasi_doc_tanggal}");
	array_push($arr1,"{ba_nego_nomor}");
	array_push($arr1,"{ba_nego_tanggal}");
	array_push($arr1,"{ba_nego_harga}");
	array_push($arr1,"{ba_nego_harga_sebut}");
	array_push($arr1,"{supplier_name}");
	array_push($arr1,"{supplier_address}");
	array_push($arr1,"{supplier_npwp}");
	array_push($arr1,"{procurement_work_name}");
	array_push($arr1,"{procurement_work_tahun_anggaran}");
	array_push($arr1,"{procurement_work_sumber_pendanaan}");
	array_push($arr1,"{procurement_work_pokja_name_1}");
	array_push($arr1,"{procurement_work_pokja_nip_1}");
	
	$procurement_work_id = $db->fetch_single_data("pokja_ulp","procurement_work_id",array("id"=>$pokja_ulp_id));
	
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$procurement_work = $db->fetch_data();
	
	$supplier_id = $db->fetch_single_data("pokja_ulp","ba_hasil_supplier_id",array("id" => $pokja_ulp_id));
	
	$arr2 = array();
	array_push($arr2,$db->fetch_single_data("pokja_ulp","laporan_nomor",array("id"=>$pokja_ulp_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("pokja_ulp","laporan_tanggal",array("id"=>$pokja_ulp_id))));
	array_push($arr2,$db->fetch_single_data("pokja_ulp","ba_hasil_nomor",array("procurement_work_id"=>$procurement_work_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("pokja_ulp","ba_hasil_tanggal",array("procurement_work_id"=>$procurement_work_id))));
	array_push($arr2,$db->fetch_single_data("ba_evaluasi_dok","nomor",array("procurement_work_id"=>$procurement_work_id,"supplier_id"=>$supplier_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("ba_evaluasi_dok","tanggal",array("procurement_work_id"=>$procurement_work_id,"supplier_id"=>$supplier_id))));
	array_push($arr2,$db->fetch_single_data("ba_nego","nomor",array("procurement_work_id"=>$procurement_work_id,"supplier_id"=>$supplier_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("ba_nego","tanggal",array("procurement_work_id"=>$procurement_work_id,"supplier_id"=>$supplier_id))));
	array_push($arr2,format_amount($db->fetch_single_data("ba_nego","harga",array("procurement_work_id"=>$procurement_work_id,"supplier_id"=>$supplier_id))));
	array_push($arr2,convert_number_to_words($db->fetch_single_data("ba_nego","harga",array("procurement_work_id"=>$procurement_work_id,"supplier_id"=>$supplier_id))));
	array_push($arr2,$db->fetch_single_data("suppliers","name",array("id"=>$supplier_id)));
	array_push($arr2,$db->fetch_single_data("suppliers","address",array("id"=>$supplier_id)));
	array_push($arr2,$db->fetch_single_data("suppliers","npwp",array("id"=>$supplier_id)));
	array_push($arr2,$procurement_work["name"]);
	array_push($arr2,$procurement_work["tahun_anggaran"]);
	array_push($arr2,$procurement_work["sumber_pendanaan"]);
	array_push($arr2,$db->fetch_single_data("procurement_work_pokja","pokja_name",array("procurement_work_id"=>$procurement_work_id),array("id")));
	array_push($arr2,$db->fetch_single_data("procurement_work_pokja","pokja_nip",array("procurement_work_id"=>$procurement_work_id),array("id")));
	
	echo str_replace($arr1,$arr2,read_file("htmls/doc_13_".$page.".html"));
?>