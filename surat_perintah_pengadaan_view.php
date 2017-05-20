<?php
	header("Content-type: application/vnd.ms-word");
	if(!isset($_GET["page"])) $_GET["page"] = 1;
	$page = substr("00",0,2-strlen($_GET["page"])).$_GET["page"];
	header("Content-Disposition: attachment;Filename=surat_perintah_pengadaan_".$page.".doc");
	include_once "common.php";
	include_once "func.convert_number_to_words.php";
	$surat_perintah_pengadaan_id = $_GET["surat_perintah_pengadaan_id"];
	$procurement_work_id = $db->fetch_single_data("surat_perintah_pengadaan","procurement_work_id",array("id" => $surat_perintah_pengadaan_id));
	
	$arr1 = array();
	array_push($arr1,"{nomor}");
	array_push($arr1,"{tanggal}");
	array_push($arr1,"{procurement_work_tahun_anggaran}");
	array_push($arr1,"{procurement_work_name}");
	array_push($arr1,"{procurement_work_hps_nominal}");
	array_push($arr1,"{procurement_work_hps_nominal_say}");
	array_push($arr1,"{procurement_work_work_days}");
	array_push($arr1,"{procurement_work_work_days_say}");
	array_push($arr1,"{procurement_work_work_days_type}");
	array_push($arr1,"{procurement_work_ppk_name}");
	array_push($arr1,"{procurement_work_ppk_nip}");
	array_push($arr1,"{surat_perintah_pengadaan_details}");
	
	$procurement_work_id = $db->fetch_single_data("surat_perintah_pengadaan","procurement_work_id",array("id"=>$surat_perintah_pengadaan_id));
	
	
	
			
	$surat_perintah_pengadaan_details = "";
	$db->addtable("surat_perintah_pengadaan_detail"); $db->where("surat_perintah_pengadaan_id",$surat_perintah_pengadaan_id);
	foreach($db->fetch_data(true) as $no => $data){
		$nama_barang = $data["nama_barang"];
		$jumlah = $data["jumlah"];
		$satuan = $data["satuan"];
		$surat_perintah_pengadaan_details .= "
			<tr>
				<td style='text-align:center'>".($no + 1)."</td><td>".$nama_barang."</td><td style='text-align:center'>".$jumlah."</td><td style='text-align:center'>".$satuan."</td>
			</tr>";
	}
	
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$procurement_work = $db->fetch_data();
	if($procurement_work["work_days_type"] == 1) $procurement_work_work_days_type = "kalender";
	if($procurement_work["work_days_type"] == 2) $procurement_work_work_days_type = "kerja";
	$arr2 = array();
	array_push($arr2,$db->fetch_single_data("surat_perintah_pengadaan","nomor",array("id"=>$surat_perintah_pengadaan_id)));
	array_push($arr2,format_tanggal($db->fetch_single_data("surat_perintah_pengadaan","tanggal",array("id"=>$surat_perintah_pengadaan_id))));
	array_push($arr2,$procurement_work["tahun_anggaran"]);
	array_push($arr2,$procurement_work["name"]);
	array_push($arr2,format_amount($procurement_work["hps_nominal"]));
	array_push($arr2,convert_number_to_words($procurement_work["hps_nominal"]));
	array_push($arr2,$procurement_work["work_days"]);
	array_push($arr2,convert_number_to_words($procurement_work["work_days"]));
	array_push($arr2,$procurement_work_work_days_type);
	array_push($arr2,$procurement_work["ppk_name"]);
	array_push($arr2,$procurement_work["ppk_nip"]);
	array_push($arr2,$surat_perintah_pengadaan_details);
	
	echo str_replace($arr1,$arr2,read_file("htmls/doc_02_".$page.".html"));
?>