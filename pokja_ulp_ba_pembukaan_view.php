<?php
	header("Content-type: application/vnd.ms-word");
	if(!isset($_GET["page"])) $_GET["page"] = 1;
	$page = substr("00",0,2-strlen($_GET["page"])).$_GET["page"];
	$pokja_ulp_id = $_GET["pokja_ulp_id"];
	$supplier_id = $_GET["supplier_id"];
	header("Content-Disposition: attachment;Filename=ba_pembukaan_penawaran_pengadaan.doc");
	include_once "common.php";
	include_once "func.convert_number_to_words.php";
	$procurement_work_id = $db->fetch_single_data("pokja_ulp","procurement_work_id",array("id" => $pokja_ulp_id));
	
	$arr1 = array();
	array_push($arr1,"{ba_pembukaan_nomor}");
	array_push($arr1,"{ba_pembukaan_tanggal}");
	array_push($arr1,"{procurement_work_name}");
	array_push($arr1,"{procurement_work_tahun_anggaran}");
	array_push($arr1,"{procurement_work_sumber_pendanaan}");
	array_push($arr1,"{sebut_hari}");
	array_push($arr1,"{sebut_tanggal}");
	array_push($arr1,"{penawaran_nomor}");
	array_push($arr1,"{penawaran_tanggal}");
	array_push($arr1,"{procurement_work_pokja_details}");
	
	$procurement_work_id = $db->fetch_single_data("pokja_ulp","procurement_work_id",array("id"=>$pokja_ulp_id));
	
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$procurement_work = $db->fetch_data();
	$procurement_work_pokja_details = "";
	$db->addtable("procurement_work_pokja"); $db->where("procurement_work_id",$procurement_work_id);$db->order("id");
	foreach($db->fetch_data(true) as $no => $data){
		$procurement_work_pokja_details .= "<tr><td style='vertical-align:top'>".($no + 1).".</td><td><u>".$data["pokja_name"]."</u><br>NIP. ".$data["pokja_nip"]."</td><td style='padding-left:80'>....................</td></tr>";
	}
	
	$arr2 = array();
	array_push($arr2,$db->fetch_single_data("pokja_ulp","ba_pembukaan_nomor",array("id"=>$pokja_ulp_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("pokja_ulp","ba_pembukaan_tanggal",array("id"=>$pokja_ulp_id))));
	array_push($arr2,$procurement_work["name"]);
	array_push($arr2,$procurement_work["tahun_anggaran"]);
	array_push($arr2,$procurement_work["sumber_pendanaan"]);
	array_push($arr2,sebut_hari($db->fetch_single_data("pokja_ulp","ba_pembukaan_tanggal",array("id"=>$pokja_ulp_id))));
	array_push($arr2,sebut_tanggal($db->fetch_single_data("pokja_ulp","ba_pembukaan_tanggal",array("id"=>$pokja_ulp_id))));
	array_push($arr2,$db->fetch_single_data("pokja_ulp","penawaran_nomor",array("id"=>$pokja_ulp_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("pokja_ulp","penawaran_tanggal",array("id"=>$pokja_ulp_id))));
	array_push($arr2,$procurement_work_pokja_details);
	
	echo str_replace($arr1,$arr2,read_file("htmls/doc_08_".$page.".html"));
?>