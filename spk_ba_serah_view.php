<?php
	header("Content-type: application/vnd.ms-word");
	if(!isset($_GET["page"])) $_GET["page"] = 1;
	$page = substr("00",0,2-strlen($_GET["page"])).$_GET["page"];
	$spk_id = $_GET["spk_id"];
	header("Content-Disposition: attachment;Filename=ba_serah_terima_barang.doc");
	include_once "common.php";
	include_once "func.convert_number_to_words.php";
	
	$arr1 = array();
	array_push($arr1,"{nomor}");
	array_push($arr1,"{tanggal}");
	array_push($arr1,"{ba_serah_nomor}");
	array_push($arr1,"{ba_serah_tanggal_sebut_hari}");
	array_push($arr1,"{ba_serah_tanggal_sebut}");
	array_push($arr1,"{ba_serah_tanggal}");
	array_push($arr1,"{ba_hasil_kerja_nomor}");
	array_push($arr1,"{ba_hasil_kerja_tanggal}");
	array_push($arr1,"{supplier_name}");
	array_push($arr1,"{supplier_address}");
	array_push($arr1,"{supplier_pic}");
	array_push($arr1,"{supplier_pic_position}");
	array_push($arr1,"{procurement_work_work_days}");
	array_push($arr1,"{procurement_work_work_days_sebut}");
	array_push($arr1,"{procurement_work_work_days_type}");
	array_push($arr1,"{procurement_work_work_start}");
	array_push($arr1,"{procurement_work_work_end}");
	array_push($arr1,"{procurement_work_name}");
	array_push($arr1,"{procurement_work_tahun_anggaran}");
	array_push($arr1,"{procurement_work_sumber_pendanaan}");
	array_push($arr1,"{procurement_work_ppk_name}");
	array_push($arr1,"{procurement_work_ppk_nip}");
	
	$procurement_work_id = $db->fetch_single_data("spk","procurement_work_id",array("id"=>$spk_id));
	$supplier_id = $db->fetch_single_data("spk","supplier_id",array("id"=>$spk_id));
	
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$procurement_work = $db->fetch_data();
	$procurement_work["work_days_type"] = ($procurement_work["work_days_type"] == 1) ? "kalender" : "kerja";
	
	
	$arr2 = array();
	array_push($arr2,$db->fetch_single_data("spk","nomor",array("id"=>$spk_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("spk","tanggal",array("id"=>$spk_id))));
	array_push($arr2,$db->fetch_single_data("spk","ba_serah_nomor",array("id"=>$spk_id)));
	array_push($arr2,sebut_hari($db->fetch_single_data("spk","ba_serah_tanggal",array("id"=>$spk_id))));
	array_push($arr2,sebut_tanggal($db->fetch_single_data("spk","ba_serah_tanggal",array("id"=>$spk_id))));
	array_push($arr2,format_tanggal($db->fetch_single_data("spk","ba_serah_tanggal",array("id"=>$spk_id))));
	array_push($arr2,$db->fetch_single_data("spk","ba_hasil_kerja_nomor",array("id"=>$spk_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("spk","ba_hasil_kerja_tanggal",array("id"=>$spk_id))));
	array_push($arr2,$db->fetch_single_data("suppliers","name",array("id"=>$supplier_id)));
	array_push($arr2,$db->fetch_single_data("suppliers","address",array("id"=>$supplier_id)));
	array_push($arr2,$db->fetch_single_data("suppliers","pic",array("id"=>$supplier_id)));
	array_push($arr2,$db->fetch_single_data("suppliers","pic_position",array("id"=>$supplier_id)));
	array_push($arr2,$procurement_work["work_days"]);
	array_push($arr2,convert_number_to_words($procurement_work["work_days"]));
	array_push($arr2,$procurement_work["work_days_type"]);
	array_push($arr2,format_tanggal($procurement_work["work_start"]));
	array_push($arr2,format_tanggal($procurement_work["work_end"]));
	array_push($arr2,$procurement_work["name"]);
	array_push($arr2,$procurement_work["tahun_anggaran"]);
	array_push($arr2,$procurement_work["sumber_pendanaan"]);
	array_push($arr2,$procurement_work["ppk_name"]);
	array_push($arr2,$procurement_work["ppk_nip"]);
	
	echo str_replace($arr1,$arr2,read_file("htmls/doc_20_".$page.".html"));
?>