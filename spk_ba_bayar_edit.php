<?php include_once "head.php";?>
<div class="bo_title">Ubah  Berita Acara Pembayaran</div>
<script>
	function download_file(spk_id){
		window.open("spk_ba_bayar_view.php?spk_id=" + spk_id);
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("spk");					$db->where("id",$_GET["id"]);
		$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
		$db->addfield("ba_bayar_nomor");		$db->addvalue($_POST["ba_bayar_nomor"]);
		$db->addfield("ba_bayar_tanggal");		$db->addvalue($_POST["ba_bayar_tanggal"]);
		$db->addfield("ba_bayar_nama");			$db->addvalue($_POST["ba_bayar_nama"]);
		$db->addfield("ba_bayar_nip");			$db->addvalue($_POST["ba_bayar_nip"]);
		$db->addfield("ba_bayar_bank");			$db->addvalue($_POST["ba_bayar_bank"]);
		$db->addfield("ba_bayar_cabang");		$db->addvalue($_POST["ba_bayar_cabang"]);
		$db->addfield("ba_bayar_norek");		$db->addvalue($_POST["ba_bayar_norek"]);
		$db->addfield("ba_bayar_updated_at");	$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("ba_bayar_updated_by");	$db->addvalue($__username);
		$inserting = $db->update();
		if($inserting["affected_rows"] >= 0){
			echo "<font color='blue'><b>Data Saved</b></font>";
		} else {
			echo "<font color='red'><b>Saving data failed</b></font>";
		}
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan",@$_POST["procurement_work_id"],"procurement_works","id","name","win_procurement_works.php");
	$txt_ba_bayar_nomor = $f->input("ba_bayar_nomor","","style='width:300px;'");
	$txt_ba_bayar_tanggal = $f->input("ba_bayar_tanggal","","type='date'");
	$txt_ba_bayar_nama = $f->input("ba_bayar_nama","","style='width:300px;'");
	$txt_ba_bayar_nip = $f->input("ba_bayar_nip","","style='width:300px;'");
	$txt_ba_bayar_bank = $f->input("ba_bayar_bank","","style='width:300px;'");
	$txt_ba_bayar_cabang = $f->input("ba_bayar_cabang","","style='width:300px;'");
	$txt_ba_bayar_norek = $f->input("ba_bayar_norek","","style='width:300px;'");
	
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
		<?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Nomor Berita Acara Pembayaran",$txt_ba_bayar_nomor));?>
        <?=$t->row(array("Tanggal Dokumen",$txt_ba_bayar_tanggal));?>
		<?=$t->row(array("Nama Kuasa Pengguna",$txt_ba_bayar_nama." NIP ".$txt_ba_bayar_nip));?>
        <?=$t->row(array("Bank Tujuan",$txt_ba_bayar_bank));?>
        <?=$t->row(array("Cabang Bank",$txt_ba_bayar_cabang));?>
        <?=$t->row(array("Nomor Rekening Tujuan",$txt_ba_bayar_norek));?>
        <?=$t->row(array("Penyedia Barang/Jasa","<div id='supplier_name' ".$datastyle."></div>"));?>
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
<?=$f->end();?>
<?php
	$ba_bayar_nomor = $db->fetch_single_data("spk","ba_bayar_nomor",array("id" => $_GET["id"]));
	$ba_bayar_tanggal = $db->fetch_single_data("spk","ba_bayar_tanggal",array("id" => $_GET["id"]));
	$ba_bayar_nama = $db->fetch_single_data("spk","ba_bayar_nama",array("id" => $_GET["id"]));
	$ba_bayar_nip = $db->fetch_single_data("spk","ba_bayar_nip",array("id" => $_GET["id"]));
	$ba_bayar_bank = $db->fetch_single_data("spk","ba_bayar_bank",array("id" => $_GET["id"]));
	$ba_bayar_cabang = $db->fetch_single_data("spk","ba_bayar_cabang",array("id" => $_GET["id"]));
	$ba_bayar_norek = $db->fetch_single_data("spk","ba_bayar_norek",array("id" => $_GET["id"]));
	$procurement_work_id = $db->fetch_single_data("spk","procurement_work_id",array("id" => $_GET["id"]));
	$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
	$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
	$supplier_id = $db->fetch_single_data("spk","supplier_id",array("procurement_work_id" => $procurement_work_id));
	$supplier_name = $db->fetch_single_data("suppliers","name",array("id" => $supplier_id));
?>
<script>	
	document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
	document.getElementById("ba_bayar_nomor").value = "<?=$ba_bayar_nomor;?>";
	document.getElementById("ba_bayar_tanggal").value = "<?=$ba_bayar_tanggal;?>";
	document.getElementById("ba_bayar_nama").value = "<?=$ba_bayar_nama;?>";
	document.getElementById("ba_bayar_nip").value = "<?=$ba_bayar_nip;?>";
	document.getElementById("ba_bayar_bank").value = "<?=$ba_bayar_bank;?>";
	document.getElementById("ba_bayar_cabang").value = "<?=$ba_bayar_cabang;?>";
	document.getElementById("ba_bayar_norek").value = "<?=$ba_bayar_norek;?>";
	document.getElementById("procurement_work_id").value = "<?=$procurement_work_id;?>";
	document.getElementById("sw_caption_procurement_work_id").innerHTML = "<?=$procurement_work;?>";
	document.getElementById("supplier_name").innerHTML = "<?=$supplier_name;?>";
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