<?php include_once "head.php";?>
<div class="bo_title">Ubah Surat Penunjukan Penyedia Barang/Jasa</div>
<script>
	function download_all_file(spk_id){
		window.open("spk_penunjukan_view.php?spk_id=" + spk_id);
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("spk");					$db->where("id",$_GET["id"]);
		$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
		$db->addfield("penunjukan_nomor");		$db->addvalue($_POST["penunjukan_nomor"]);
		$db->addfield("penunjukan_tanggal");	$db->addvalue($_POST["penunjukan_tanggal"]);
		$db->addfield("supplier_id");			$db->addvalue($_POST["supplier_id"]);
		$db->addfield("penawaran_nomor");		$db->addvalue($_POST["penawaran_nomor"]);
		$db->addfield("penawaran_tanggal");		$db->addvalue($_POST["penawaran_tanggal"]);
		$db->addfield("penawaran_harga");		$db->addvalue($_POST["penawaran_harga"]);
		$inserting = $db->update();
		if($inserting["affected_rows"] >= 0){
			echo "<font color='blue'><b>Data Saved</b></font>";
		} else {
			echo "<font color='red'><b>Saving data failed</b></font>";
		}
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan","","procurement_works","id","name","win_procurement_works.php");
	$txt_penunjukan_nomor = $f->input("penunjukan_nomor","","style='width:300px;' onfocus='load_supplier_info(procurement_work_id.value);'");
	$txt_penunjukan_tanggal = $f->input("penunjukan_tanggal","","type='date'");
	$sel_supplier = $f->select("supplier_id",$db->fetch_select_data("suppliers","id","name",array(),array("name"),"",true),"","style='height:22px;'");
	$txt_penawaran_nomor = $f->input("penawaran_nomor","","style='width:300px;'");
	$txt_penawaran_tanggal = $f->input("penawaran_tanggal","","type='date'");
	$txt_penawaran_harga = $f->input("penawaran_harga","","type='number'");
	
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
		<?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Nomor Surat Penunjukan Penyedia",$txt_penunjukan_nomor));?>
        <?=$t->row(array("Tanggal Surat",$txt_penunjukan_tanggal));?>
        <?=$t->row(array("Penyedia Barang/Jasa",$sel_supplier));?>
        <?=$t->row(array("Nomor Surat Penawaran dari Penyedia",$txt_penawaran_nomor));?>
        <?=$t->row(array("Tanggal Surat Penawaran dari Penyedia",$txt_penawaran_tanggal));?>
        <?=$t->row(array("Harga Penawaran dari Penyedia",$txt_penawaran_harga));?>
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
	<?=$f->input("btn_spk","Buat SPK","type='button' onclick='window.location=\"spk_add.php?spk_id=".$_GET["id"]."\";'");?>
<?=$f->end();?>
<?php
	$penunjukan_nomor = $db->fetch_single_data("spk","penunjukan_nomor",array("id" => $_GET["id"]));
	$penunjukan_tanggal = $db->fetch_single_data("spk","penunjukan_tanggal",array("id" => $_GET["id"]));
	$supplier_id = $db->fetch_single_data("spk","supplier_id",array("id" => $_GET["id"]));
	$penawaran_nomor = $db->fetch_single_data("spk","penawaran_nomor",array("id" => $_GET["id"]));
	$penawaran_tanggal = $db->fetch_single_data("spk","penawaran_tanggal",array("id" => $_GET["id"]));
	$penawaran_harga = $db->fetch_single_data("spk","penawaran_harga",array("id" => $_GET["id"]));
	$procurement_work_id = $db->fetch_single_data("spk","procurement_work_id",array("id" => $_GET["id"]));
	$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
	$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
?>
<script>	
	document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
	document.getElementById("penunjukan_nomor").value = "<?=$penunjukan_nomor;?>";
	document.getElementById("penunjukan_tanggal").value = "<?=$penunjukan_tanggal;?>";
	document.getElementById("supplier_id").value = "<?=$supplier_id;?>";
	document.getElementById("penawaran_nomor").value = "<?=$penawaran_nomor;?>";
	document.getElementById("penawaran_tanggal").value = "<?=$penawaran_tanggal;?>";
	document.getElementById("penawaran_harga").value = "<?=$penawaran_harga;?>";
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