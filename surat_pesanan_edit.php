<?php include_once "head.php";?>
<div class="bo_title">Ubah Surat Pesanan</div>
<script>
	function download_file(surat_pesanan_id){
		if(confirm("Aplikasi ini akan mengunduh beberapa Dokumen sekaligus. Lanjutkan?")){
			var arrpage = [1,2];
			for (var i in arrpage) {
				window.open("surat_pesanan_view.php?surat_pesanan_id=" + surat_pesanan_id + "&page=" + arrpage[i]);
			}
		}
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("surat_pesanan");	$db->where("id",$_GET["id"]);
		$db->addfield("nomor");			$db->addvalue($_POST["nomor"]);
		$db->addfield("tanggal");		$db->addvalue($_POST["tanggal"]);
		$db->addfield("supplier_id");	$db->addvalue($_POST["supplier_id"]);
		$db->addfield("updated_at");	$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("updated_by");	$db->addvalue($__username);
		$db->addfield("updated_ip");	$db->addvalue($_SERVER["REMOTE_ADDR"]);
		$inserting = $db->update();
		if($inserting["affected_rows"] >= 0){			
			echo "<font color='blue'><b>Data Saved</b></font>";
		} else {
			echo "<font color='red'><b>Data gagal tersimpan</b></font>";
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
	<?=$f->input("save","Simpan","type='submit'");?> 
	<?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_edit","_list",$_SERVER["PHP_SELF"])."';\"");?>
	<?=$f->input("btn_download","Unduh Dokumen","type='button' onclick='download_file(\"".$_GET["id"]."\");'");?>
<?=$f->end();?>
<?php
	$surat_perintah_pengadaan_id = $db->fetch_single_data("surat_pesanan","surat_perintah_pengadaan_id",array("id" => $_GET["id"]));
	$surat_perintah_pengadaan_nomor = $db->fetch_single_data("surat_perintah_pengadaan","nomor",array("id" => $surat_perintah_pengadaan_id));
	$nomor = $db->fetch_single_data("surat_pesanan","nomor",array("id" => $_GET["id"]));
	$tanggal = $db->fetch_single_data("surat_pesanan","tanggal",array("id" => $_GET["id"]));
	$supplier_id = $db->fetch_single_data("surat_pesanan","supplier_id",array("id" => $_GET["id"]));
	$procurement_work_id = $db->fetch_single_data("surat_pesanan","procurement_work_id",array("id" => $_GET["id"]));
	$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
	$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
?>
<script>	
	document.getElementById("sw_caption_surat_perintah_pengadaan_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
	document.getElementById("nomor").value = "<?=$nomor;?>";
	document.getElementById("tanggal").value = "<?=$tanggal;?>";
	document.getElementById("supplier_id").value = "<?=$supplier_id;?>";
	document.getElementById("procurement_work_name").innerHTML = "<?=$data["name"];?>";
	document.getElementById("sw_caption_surat_perintah_pengadaan_id").innerHTML = "<?=$surat_perintah_pengadaan_nomor;?>";
	document.getElementById("work_category").innerHTML = "<?=$work_category;?>";
	document.getElementById("hps_nomor").innerHTML = "<?=$data["hps_nomor"];?>";
	document.getElementById("hps_nominal").innerHTML = "<?=format_amount($data["hps_nominal"]);?>";
	document.getElementById("hps_ok_by").innerHTML = "<?=$db->fetch_single_data("users","name",array("email" => $data["hps_ok_by"]));?>";
	document.getElementById("hps_ok_at").innerHTML = "<?=format_tanggal($data["hps_ok_at"]);?>";
	document.getElementById("work_days").innerHTML = "<?=$data["work_days"];?>";
	document.getElementById("ppk_name").innerHTML = "<?=$data["ppk_name"];?>";
	document.getElementById("ppk_nip").innerHTML = "<?=$data["ppk_nip"];?>";
</script>

<?php include_once "footer.php";?>