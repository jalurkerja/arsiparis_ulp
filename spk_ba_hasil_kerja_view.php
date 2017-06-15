<?php
	header("Content-type: application/vnd.ms-word");
	if(!isset($_GET["page"])) $_GET["page"] = 1;
	$page = substr("00",0,2-strlen($_GET["page"])).$_GET["page"];
	$spk_id = $_GET["spk_id"];
	header("Content-Disposition: attachment;Filename=ba_pemeriksaan_hasil_pekerjaan.doc");
	include_once "common.php";
	include_once "func.convert_number_to_words.php";
	
	$arr1 = array();
	array_push($arr1,"{nomor}");
	array_push($arr1,"{tanggal}");
	array_push($arr1,"{pemeriksaan_nomor}");
	array_push($arr1,"{pemeriksaan_tanggal}");
	array_push($arr1,"{ba_hasil_kerja_nomor}");
	array_push($arr1,"{ba_hasil_kerja_tanggal_sebut_hari}");
	array_push($arr1,"{ba_hasil_kerja_tanggal_sebut}");
	array_push($arr1,"{ba_hasil_kerja_tanggal}");
	array_push($arr1,"{ba_hasil_kerja_nama_1}");
	array_push($arr1,"{ba_hasil_kerja_nip_1}");
	array_push($arr1,"{ba_hasil_kerja_nama_2}");
	array_push($arr1,"{ba_hasil_kerja_nip_2}");
	array_push($arr1,"{ba_hasil_kerja_nama_3}");
	array_push($arr1,"{ba_hasil_kerja_nip_3}");
	array_push($arr1,"{procurement_work_name}");
	array_push($arr1,"{procurement_work_tahun_anggaran}");
	array_push($arr1,"{procurement_work_sumber_pendanaan}");
	
	$procurement_work_id = $db->fetch_single_data("spk","procurement_work_id",array("id"=>$spk_id));
	
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$procurement_work = $db->fetch_data();
	
	
	$arr2 = array();
	array_push($arr2,$db->fetch_single_data("spk","nomor",array("id"=>$spk_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("spk","tanggal",array("id"=>$spk_id))));
	array_push($arr2,$db->fetch_single_data("spk","pemeriksaan_nomor",array("id"=>$spk_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("spk","pemeriksaan_tanggal",array("id"=>$spk_id))));
	array_push($arr2,$db->fetch_single_data("spk","ba_hasil_kerja_nomor",array("id"=>$spk_id)));
	array_push($arr2,sebut_hari($db->fetch_single_data("spk","ba_hasil_kerja_tanggal",array("id"=>$spk_id))));
	array_push($arr2,sebut_tanggal($db->fetch_single_data("spk","ba_hasil_kerja_tanggal",array("id"=>$spk_id))));
	array_push($arr2,format_tanggal($db->fetch_single_data("spk","ba_hasil_kerja_tanggal",array("id"=>$spk_id))));
	array_push($arr2,$db->fetch_single_data("spk","ba_hasil_kerja_nama_1",array("id"=>$spk_id)));
	array_push($arr2,$db->fetch_single_data("spk","ba_hasil_kerja_nip_1",array("id"=>$spk_id)));
	array_push($arr2,$db->fetch_single_data("spk","ba_hasil_kerja_nama_2",array("id"=>$spk_id)));
	array_push($arr2,$db->fetch_single_data("spk","ba_hasil_kerja_nip_2",array("id"=>$spk_id)));
	array_push($arr2,$db->fetch_single_data("spk","ba_hasil_kerja_nama_3",array("id"=>$spk_id)));
	array_push($arr2,$db->fetch_single_data("spk","ba_hasil_kerja_nip_3",array("id"=>$spk_id)));
	array_push($arr2,$procurement_work["name"]);
	array_push($arr2,$procurement_work["tahun_anggaran"]);
	array_push($arr2,$procurement_work["sumber_pendanaan"]);
	
	echo str_replace($arr1,$arr2,read_file("htmls/doc_19_".$page.".html"));
?>