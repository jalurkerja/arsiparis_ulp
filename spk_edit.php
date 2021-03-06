<?php include_once "head.php";?>
<div class="bo_title">Ubah SPK</div>
<script>
	function download_all_file(spk_id){
		var arrpage = [1,2];
		for (var i in arrpage) {
			window.open("spk_view.php?spk_id=" + spk_id + "&page=" + arrpage[i]);
		}
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("spk");					$db->where("id",$_GET["id"]);
		$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
		$db->addfield("nomor");					$db->addvalue($_POST["nomor"]);
		$db->addfield("tanggal");				$db->addvalue($_POST["tanggal"]);
		$db->addfield("supplier_id");			$db->addvalue($_POST["supplier_id"]);
		$inserting = $db->update();
		if($inserting["affected_rows"] >= 0){
			echo "<font color='blue'><b>Data Saved</b></font>";
		} else {
			echo "<font color='red'><b>Saving data failed</b></font>";
		}
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan","","procurement_works","id","name","win_procurement_works.php");
	$txt_nomor = $f->input("nomor","","style='width:300px;' onfocus='load_procurement_work(procurement_work_id.value);'");
	$txt_tanggal = $f->input("tanggal","","type='date'");
	$sel_supplier = $f->select("supplier_id",$db->fetch_select_data("suppliers","id","name",array(),array("name"),"",true),"","style='height:22px;'");
	
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
		<?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Nomor SPK",$txt_nomor));?>
        <?=$t->row(array("Tanggal SPK",$txt_tanggal));?>
        <?=$t->row(array("Penyedia Barang/Jasa",$sel_supplier));?>
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
	<?=$f->input("btn_download","Unduh Dokumen","type='button' onclick='download_all_file(\"".$_GET["id"]."\");'");?>
	<?=$f->input("btn_spk","Buat Permintaan Pemeriksaan Pengadaan Barang/Jasa","type='button' onclick='window.location=\"spk_pemeriksaan_add.php?spk_id=".$_GET["id"]."\";'");?>
<?=$f->end();?>
<?php
	$nomor = $db->fetch_single_data("spk","nomor",array("id" => $_GET["id"]));
	$tanggal = $db->fetch_single_data("spk","tanggal",array("id" => $_GET["id"]));
	$supplier_id = $db->fetch_single_data("spk","supplier_id",array("id" => $_GET["id"]));
	$work_start = $db->fetch_single_data("spk","work_start",array("id" => $_GET["id"]));
	$work_end = $db->fetch_single_data("spk","work_end",array("id" => $_GET["id"]));
	$work_days = $db->fetch_single_data("spk","work_days",array("id" => $_GET["id"]));
	$procurement_work_id = $db->fetch_single_data("spk","procurement_work_id",array("id" => $_GET["id"]));
	$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
	$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
?>
<script>	
	document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
	document.getElementById("nomor").value = "<?=$nomor;?>";
	document.getElementById("tanggal").value = "<?=$tanggal;?>";
	document.getElementById("supplier_id").value = "<?=$supplier_id;?>";
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