<?php include_once "head.php";?>
<div class="bo_title">Tambah Surat Pesanan</div>
<?php
	if(isset($_POST["save"])){
		$procurement_work_id = $db->fetch_single_data("surat_perintah_pengadaan","procurement_work_id",array("id"=>$_POST["surat_perintah_pengadaan_id"]));
		$db->addtable("surat_pesanan");	
		$db->addfield("procurement_work_id");			$db->addvalue($procurement_work_id);
		$db->addfield("surat_perintah_pengadaan_id");	$db->addvalue($_POST["surat_perintah_pengadaan_id"]);
		$db->addfield("nomor");							$db->addvalue($_POST["nomor"]);
		$db->addfield("tanggal");						$db->addvalue($_POST["tanggal"]);
		$db->addfield("supplier_id");					$db->addvalue($_POST["supplier_id"]);
		$db->addfield("updated_at");					$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("updated_by");					$db->addvalue($__username);
		$db->addfield("updated_ip");					$db->addvalue($_SERVER["REMOTE_ADDR"]);
		$inserting = $db->insert();
		if($inserting["affected_rows"] >= 0){
			$surat_pesanan_id = $inserting["insert_id"];
			javascript("alert('Data Saved');");
			javascript("window.location='surat_pesanan_edit.php?id=".$surat_pesanan_id."';");
		} else {
			javascript("alert('Saving data failed');");
		}
	}
	
	$sel_surat_perintah_pengadaan_id = $f->select_window("surat_perintah_pengadaan_id","Surat Perintah Pengadaan Barang/Jasa","","surat_perintah_pengadaan","id","nomor","win_surat_perintah_pengadaan.php");
	$txt_nomor = $f->input("nomor","","style='width:300px;'");
	$txt_tanggal = $f->input("tanggal","","type='date'");
	$sel_supplier = $f->select("supplier_id",$db->fetch_select_data("suppliers","id","name",array(),array("name")),"");
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";	
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
        <?=$t->row(array("Nomor Surat Perintah Pengadaan Barang/Jasa",$sel_surat_perintah_pengadaan_id));?>
        <?=$t->row(array("Nomor Surat Pesanan",$txt_nomor));?>
        <?=$t->row(array("Tanggal Surat Pesanan",$txt_tanggal));?>
        <?=$t->row(array("Penyedia Barang/Jasa",$sel_supplier));?>
        <?=$t->row(array("Nama Pekerjaan","<div id='procurement_work_name' ".$datastyle."></div>"));?>
        <?=$t->row(array("Kategori Pekerjaan","<div id='work_category' ".$datastyle."></div>"));?>
        <?=$t->row(array("Nomor Surat Penetapan HPS","<div id='hps_nomor' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS","<div id='hps_nominal' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS di approve Oleh","<div id='hps_ok_by' ".$datastyle."></div>"));?>
        <?=$t->row(array("Tanggal Approve","<div id='hps_ok_at' ".$datastyle."></div>"));?>
        <?=$t->row(array("Jangka Waktu Pekerjaan","<div id='work_days' ".$datastyle."></div>"));?>
        <?=$t->row(array("Pejabat Pembuat Komitmen","<div id='ppk_name' ".$datastyle."></div><div id='ppk_nip' ".$datastyle."></div>"));?>
	<?=$t->end();?>
	<br>
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php include_once "footer.php";?>