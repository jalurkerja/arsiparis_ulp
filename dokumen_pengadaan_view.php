<?php
	header("Content-type: application/vnd.ms-word");
	if(!isset($_GET["page"])) $_GET["page"] = 1;
	$page = substr("00",0,2-strlen($_GET["page"])).$_GET["page"];
	header("Content-Disposition: attachment;Filename=dokumen_pengadaan_".$page.".doc");
	include_once "common.php";
	include_once "func.convert_number_to_words.php";
	$dokumen_pengadaan_id = $_GET["dokumen_pengadaan_id"];
	$supplier_id = $_GET["supplier_id"];
	
	$arr1 = array();
	array_push($arr1,"{nomor}");
	array_push($arr1,"{dokumen_pengadaan_undangan_nomor}");
	array_push($arr1,"{dokumen_pengadaan_undangan_tanggal}");
	array_push($arr1,"{dokumen_pengadaan_undangan_supplier_name}");
	array_push($arr1,"{dokumen_pengadaan_undangan_supplier_address}");
	array_push($arr1,"{dokumen_pengadaan_kegiatan_details}");
	array_push($arr1,"{procurement_work_name}");
	array_push($arr1,"{procurement_work_tahun_anggaran}");
	array_push($arr1,"{procurement_work_hps_nominal}");
	array_push($arr1,"{procurement_work_hps_nominal_say}");
	array_push($arr1,"{procurement_work_sumber_pendanaan}");
	array_push($arr1,"{procurement_work_work_days}");
	array_push($arr1,"{procurement_work_work_days_say}");
	array_push($arr1,"{procurement_work_work_days_type}");
	array_push($arr1,"{procurement_work_masa_berlaku_penawaran}");
	array_push($arr1,"{procurement_work_masa_berlaku_penawaran_say}");
	array_push($arr1,"{procurement_work_siup_penyedia}");
	
	$procurement_work_id = $db->fetch_single_data("dokumen_pengadaan","procurement_work_id",array("id"=>$dokumen_pengadaan_id));
	
	$dokumen_pengadaan_kegiatan_details = "";
	$db->addtable("dokumen_pengadaan_kegiatan"); $db->where("procurement_work_id",$procurement_work_id);
	foreach($db->fetch_data(true) as $no => $data){
		$tanggal = sebut_hari($data["tanggal_1"]);
		if($data["tanggal_2"] != "0000-00-00") $tanggal .= "-".sebut_hari($data["tanggal_2"]);
		$tanggal .= "/".format_tanggal($data["tanggal_1"]);
		if($data["tanggal_2"] != "0000-00-00") $tanggal .= " - ".format_tanggal($data["tanggal_2"]);
		$waktu = "";
		if($data["waktu_1"]) $waktu .= substr($data["waktu_1"],0,5);
		if($data["waktu_2"]) $waktu .= " s.d. ".substr($data["waktu_2"],0,5);
		$dokumen_pengadaan_kegiatan_details .= "
			<tr>
				<td style='text-align:center'>".chr(97+$no).".</td>
				<td>".$data["kegiatan"]."</td>
				<td>".$tanggal."</td>
				<td style='text-align:center'>".$waktu."</td>
			</tr>";
	}
	
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$procurement_work = $db->fetch_data();
	if($procurement_work["work_days_type"] == 1) $procurement_work_work_days_type = "kalender";
	if($procurement_work["work_days_type"] == 2) $procurement_work_work_days_type = "kerja";
	$arr2 = array();
	array_push($arr2,$db->fetch_single_data("dokumen_pengadaan","nomor",array("id"=>$dokumen_pengadaan_id)));
	array_push($arr2,$db->fetch_single_data("dokumen_pengadaan_undangan","nomor",array("dokumen_pengadaan_id"=>$dokumen_pengadaan_id),array("id")));
	array_push($arr2,format_tanggal($db->fetch_single_data("dokumen_pengadaan_undangan","tanggal",array("dokumen_pengadaan_id"=>$dokumen_pengadaan_id),array("id"))));
	array_push($arr2,$db->fetch_single_data("suppliers","name",array("id"=>$supplier_id)));
	array_push($arr2,$db->fetch_single_data("suppliers","address",array("id"=>$supplier_id)));
	array_push($arr2,$dokumen_pengadaan_kegiatan_details);
	array_push($arr2,$procurement_work["name"]);
	array_push($arr2,$procurement_work["tahun_anggaran"]);
	array_push($arr2,format_amount($procurement_work["hps_nominal"]));
	array_push($arr2,convert_number_to_words($procurement_work["hps_nominal"]));
	array_push($arr2,$procurement_work["sumber_pendanaan"]);
	array_push($arr2,$procurement_work["work_days"]);
	array_push($arr2,convert_number_to_words($procurement_work["work_days"]));
	array_push($arr2,$procurement_work_work_days_type);
	array_push($arr2,$procurement_work["masa_berlaku_penawaran"]);
	array_push($arr2,convert_number_to_words($procurement_work["masa_berlaku_penawaran"]));
	array_push($arr2,$procurement_work["siup_penyedia"]);
	
	echo str_replace($arr1,$arr2,read_file("htmls/doc_03_".$page.".html"));
?>