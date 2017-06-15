<?php
	header("Content-type: application/vnd.ms-word");
	if(!isset($_GET["page"])) $_GET["page"] = 1;
	$page = substr("00",0,2-strlen($_GET["page"])).$_GET["page"];
	$id = $_GET["kuitansi_id"];
	header("Content-Disposition: attachment;Filename=kuitansi_".$page.".doc");
	include_once "common.php";
	include_once "func.convert_number_to_words.php";
	
	$arr1 = array();
	array_push($arr1,"{nomor}");
	array_push($arr1,"{mak}");
	array_push($arr1,"{nominal}");
	array_push($arr1,"{nominal_sebut}");
	array_push($arr1,"{tanggal}");
	array_push($arr1,"{pejabat_pj_name}");
	array_push($arr1,"{pejabat_pj_nip}");
	array_push($arr1,"{pemeriksa1_name}");
	array_push($arr1,"{pemeriksa1_nip}");
	array_push($arr1,"{pemeriksa2_name}");
	array_push($arr1,"{pemeriksa2_nip}");
	array_push($arr1,"{pemeriksa3_name}");
	array_push($arr1,"{pemeriksa3_nip}");
	array_push($arr1,"{supplier_name}");
	array_push($arr1,"{supplier_pic}");
	array_push($arr1,"{supplier_pic_position}");
	array_push($arr1,"{procurement_work_name}");
	array_push($arr1,"{procurement_work_tahun_anggaran}");
	array_push($arr1,"{procurement_work_ppk_name}");
	array_push($arr1,"{procurement_work_ppk_nip}");
	array_push($arr1,"{surat_perintah_pengadaan_details}");
	
	$procurement_work_id = $db->fetch_single_data("kuitansi","procurement_work_id",array("id"=>$id));
	$supplier_id = $db->fetch_single_data("kuitansi","supplier_id",array("id"=>$id));
	
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$procurement_work = $db->fetch_data();
	
	$surat_perintah_pengadaan_details = "";
	$db->addtable("surat_perintah_pengadaan_detail"); $db->awhere("surat_perintah_pengadaan_id IN (SELECT id FROM surat_perintah_pengadaan WHERE procurement_work_id='".$procurement_work_id."')");
	foreach($db->fetch_data(true) as $key => $data){
		$surat_perintah_pengadaan_details .= "<tr><td align='right'>".($key+1)."</td><td>".$data["nama_barang"]."</td><td align='right'>".$data["jumlah"]."</td><td>".$data["satuan"]."</td></tr>";
	}
	
	$arr2 = array();
	array_push($arr2,$db->fetch_single_data("kuitansi","nomor",array("id"=>$id)));
	array_push($arr2,$db->fetch_single_data("kuitansi","mak",array("id"=>$id)));
	array_push($arr2,format_amount($db->fetch_single_data("kuitansi","nominal",array("id"=>$id))));
	array_push($arr2,convert_number_to_words($db->fetch_single_data("kuitansi","nominal",array("id"=>$id))));
	array_push($arr2,format_tanggal($db->fetch_single_data("kuitansi","tanggal",array("id"=>$id))));
	array_push($arr2,$db->fetch_single_data("kuitansi","pejabat_pj_name",array("id"=>$id)));
	array_push($arr2,$db->fetch_single_data("kuitansi","pejabat_pj_nip",array("id"=>$id)));
	array_push($arr2,$db->fetch_single_data("kuitansi","pemeriksa1_name",array("id"=>$id)));
	array_push($arr2,$db->fetch_single_data("kuitansi","pemeriksa1_nip",array("id"=>$id)));
	array_push($arr2,$db->fetch_single_data("kuitansi","pemeriksa2_name",array("id"=>$id)));
	array_push($arr2,$db->fetch_single_data("kuitansi","pemeriksa2_nip",array("id"=>$id)));
	array_push($arr2,$db->fetch_single_data("kuitansi","pemeriksa3_name",array("id"=>$id)));
	array_push($arr2,$db->fetch_single_data("kuitansi","pemeriksa3_nip",array("id"=>$id)));
	array_push($arr2,$db->fetch_single_data("suppliers","name",array("id"=>$supplier_id)));
	array_push($arr2,$db->fetch_single_data("suppliers","pic",array("id"=>$supplier_id)));
	array_push($arr2,$db->fetch_single_data("suppliers","pic_position",array("id"=>$supplier_id)));
	array_push($arr2,$procurement_work["name"]);
	array_push($arr2,$procurement_work["tahun_anggaran"]);
	array_push($arr2,$procurement_work["ppk_name"]);
	array_push($arr2,$procurement_work["ppk_nip"]);
	array_push($arr2,$surat_perintah_pengadaan_details);
	
	echo str_replace($arr1,$arr2,read_file("htmls/doc_22_".$page.".html"));
?>