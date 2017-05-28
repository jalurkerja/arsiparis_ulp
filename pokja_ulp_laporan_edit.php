<?php include_once "head.php";?>
<div class="bo_title">Ubah Laporan Hasil Pengadaan</div>
<script>
	function download_file(pokja_ulp_id){
		window.open("pokja_ulp_laporan_view.php?pokja_ulp_id=" + pokja_ulp_id);
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("pokja_ulp");				$db->where("id",$_GET["id"]);
		$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
		$db->addfield("laporan_nomor");			$db->addvalue($_POST["laporan_nomor"]);
		$db->addfield("laporan_tanggal");		$db->addvalue($_POST["laporan_tanggal"]);
		$db->addfield("laporan_updated_at");	$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("laporan_updated_by");	$db->addvalue($__username);
		$inserting = $db->update();
		if($inserting["affected_rows"] >= 0){
			echo "<font color='blue'><b>Data Saved</b></font>";
		} else {
			echo "<font color='red'><b>Saving data failed</b></font>";
		}
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan",@$_POST["procurement_work_id"],"procurement_works","id","name","win_procurement_works.php");
	$txt_laporan_nomor = $f->input("laporan_nomor","","style='width:300px;'");
	$txt_laporan_tanggal = $f->input("laporan_tanggal","","type='date'");
	
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";	
	
	$procurement_work_id = $db->fetch_single_data("pokja_ulp","procurement_work_id",array("id" => $_GET["id"]));
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
		<?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Nomor Dokumen",$txt_laporan_nomor));?>
        <?=$t->row(array("Tanggal Dokumen",$txt_laporan_tanggal));?>
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
	<?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
	<?=$f->input("btn_download","Unduh Dokumen","type='button' onclick='download_file(\"".$_GET["id"]."\");'");?>
	<?=$f->input("btn_ba_pembukaan","Buat Berita Acara Evaluasi Penawaran","type='button' onclick='window.location=\"pokja_ulp_ba_evaluasi_add.php?pokja_ulp_id=".$_GET["id"]."\";'");?>
<?=$f->end();?>
<?php
	$laporan_nomor = $db->fetch_single_data("pokja_ulp","laporan_nomor",array("id" => $_GET["id"]));
	$laporan_tanggal = $db->fetch_single_data("pokja_ulp","laporan_tanggal",array("id" => $_GET["id"]));
	$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
	$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
?>
<script>	
	document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
	document.getElementById("laporan_nomor").value = "<?=$laporan_nomor;?>";
	document.getElementById("laporan_tanggal").value = "<?=$laporan_tanggal;?>";
	document.getElementById("procurement_work_id").value = "<?=$procurement_work_id;?>";
	document.getElementById("sw_caption_procurement_work_id").innerHTML = "<?=$procurement_work;?>";
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