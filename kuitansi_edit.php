<?php include_once "head.php";?>
<div class="bo_title">Ubah Kuitansi</div>
<script>
	function download_all_file(kuitansi_id){
		var arrpage = [1,2];
		for (var i in arrpage) {
			window.open("kuitansi_view.php?kuitansi_id=" + kuitansi_id + "&page=" + arrpage[i]);
		}
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("kuitansi");				$db->where("id",$_GET["id"]);
		$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
		$db->addfield("nomor");					$db->addvalue($_POST["nomor"]);
		$db->addfield("mak");					$db->addvalue($_POST["mak"]);
		$db->addfield("nominal");				$db->addvalue($_POST["nominal"]);
		$db->addfield("tanggal");				$db->addvalue($_POST["tanggal"]);
		$db->addfield("supplier_id");			$db->addvalue($_POST["supplier_id"]);
		$db->addfield("pejabat_pj_name");		$db->addvalue($_POST["pejabat_pj_name"]);
		$db->addfield("pejabat_pj_nip");		$db->addvalue($_POST["pejabat_pj_nip"]);
		$db->addfield("pemeriksa1_name");		$db->addvalue($_POST["pemeriksa1_name"]);
		$db->addfield("pemeriksa1_nip");		$db->addvalue($_POST["pemeriksa1_nip"]);
		$db->addfield("pemeriksa2_name");		$db->addvalue($_POST["pemeriksa2_name"]);
		$db->addfield("pemeriksa2_nip");		$db->addvalue($_POST["pemeriksa2_nip"]);
		$db->addfield("pemeriksa3_name");		$db->addvalue($_POST["pemeriksa3_name"]);
		$db->addfield("pemeriksa3_nip");		$db->addvalue($_POST["pemeriksa3_nip"]);
		$db->addfield("updated_at");			$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("updated_by");			$db->addvalue($__username);
		$db->addfield("updated_ip");			$db->addvalue($_SERVER["REMOTE_ADDR"]);
		$inserting = $db->update();
		if($inserting["affected_rows"] >= 0){
			echo "<font color='blue'><b>Data Saved</b></font>";
		} else {
			echo "<font color='red'><b>Saving data failed</b></font>";
		}
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan","","procurement_works","id","name","win_procurement_works.php");
	$txt_nomor = $f->input("nomor","","style='width:300px;' onfocus='load_procurement_work(procurement_work_id.value);'");
	$txt_mak = $f->input("mak","","style='width:300px;'");
	$txt_nominal = $f->input("nominal","","type='number'");
	$txt_tanggal = $f->input("tanggal","","type='date'");
	$sel_supplier = $f->select("supplier_id",$db->fetch_select_data("suppliers","id","name",array(),array("name"),"",true),"","style='height:22px;'");
	$txt_pejabat_pj_name = $f->input("pejabat_pj_name","","style='width:300px;'");
	$txt_pejabat_pj_nip = $f->input("pejabat_pj_nip","","style='width:300px;'");
	$txt_pemeriksa1_name = $f->input("pemeriksa1_name","","style='width:300px;'");
	$txt_pemeriksa1_nip = $f->input("pemeriksa1_nip","","style='width:300px;'");
	$txt_pemeriksa2_name = $f->input("pemeriksa2_name","","style='width:300px;'");
	$txt_pemeriksa2_nip = $f->input("pemeriksa2_nip","","style='width:300px;'");
	$txt_pemeriksa3_name = $f->input("pemeriksa3_name","","style='width:300px;'");
	$txt_pemeriksa3_nip = $f->input("pemeriksa3_nip","","style='width:300px;'");
	
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
		<?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Nomor Kuitansi",$txt_nomor));?>
        <?=$t->row(array("MAK",$txt_mak));?>
        <?=$t->row(array("Jumlah Uang",$txt_nominal));?>
        <?=$t->row(array("Tanggal Kuitansi",$txt_tanggal));?>
        <?=$t->row(array("Penyedia Barang/Jasa",$sel_supplier));?>
        <?=$t->row(array("Pejabat yang bertanggungjawab",$txt_pejabat_pj_name." NIP".$txt_pejabat_pj_nip));?>
        <?=$t->row(array("Pemeriksa dan Penerima 1",$txt_pemeriksa1_name." NIP".$txt_pemeriksa1_nip));?>
        <?=$t->row(array("Pemeriksa dan Penerima 2",$txt_pemeriksa2_name." NIP".$txt_pemeriksa2_nip));?>
        <?=$t->row(array("Pemeriksa dan Penerima 3",$txt_pemeriksa3_name." NIP".$txt_pemeriksa3_nip));?>
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
<?=$f->end();?>
<?php
	$nomor = $db->fetch_single_data("kuitansi","nomor",array("id" => $_GET["id"]));
	$mak = $db->fetch_single_data("kuitansi","mak",array("id" => $_GET["id"]));
	$nominal = $db->fetch_single_data("kuitansi","nominal",array("id" => $_GET["id"]));
	$tanggal = $db->fetch_single_data("kuitansi","tanggal",array("id" => $_GET["id"]));
	$supplier_id = $db->fetch_single_data("kuitansi","supplier_id",array("id" => $_GET["id"]));
	$pejabat_pj_name = $db->fetch_single_data("kuitansi","pejabat_pj_name",array("id" => $_GET["id"]));
	$pejabat_pj_nip = $db->fetch_single_data("kuitansi","pejabat_pj_nip",array("id" => $_GET["id"]));
	$pemeriksa1_name = $db->fetch_single_data("kuitansi","pemeriksa1_name",array("id" => $_GET["id"]));
	$pemeriksa1_nip = $db->fetch_single_data("kuitansi","pemeriksa1_nip",array("id" => $_GET["id"]));
	$pemeriksa2_name = $db->fetch_single_data("kuitansi","pemeriksa2_name",array("id" => $_GET["id"]));
	$pemeriksa2_nip = $db->fetch_single_data("kuitansi","pemeriksa2_nip",array("id" => $_GET["id"]));
	$pemeriksa3_name = $db->fetch_single_data("kuitansi","pemeriksa3_name",array("id" => $_GET["id"]));
	$pemeriksa3_nip = $db->fetch_single_data("kuitansi","pemeriksa3_nip",array("id" => $_GET["id"]));
	$procurement_work_id = $db->fetch_single_data("kuitansi","procurement_work_id",array("id" => $_GET["id"]));
	$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
	$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
?>
<script>	
	document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
	document.getElementById("nomor").value = "<?=$nomor;?>";
	document.getElementById("mak").value = "<?=$mak;?>";
	document.getElementById("nominal").value = "<?=$nominal;?>";
	document.getElementById("tanggal").value = "<?=$tanggal;?>";
	document.getElementById("supplier_id").value = "<?=$supplier_id;?>";
	document.getElementById("pejabat_pj_name").value = "<?=$pejabat_pj_name;?>";
	document.getElementById("pejabat_pj_nip").value = "<?=$pejabat_pj_nip;?>";
	document.getElementById("pemeriksa1_name").value = "<?=$pemeriksa1_name;?>";
	document.getElementById("pemeriksa1_nip").value = "<?=$pemeriksa1_nip;?>";
	document.getElementById("pemeriksa2_name").value = "<?=$pemeriksa2_name;?>";
	document.getElementById("pemeriksa2_nip").value = "<?=$pemeriksa2_nip;?>";
	document.getElementById("pemeriksa3_name").value = "<?=$pemeriksa3_name;?>";
	document.getElementById("pemeriksa3_nip").value = "<?=$pemeriksa3_nip;?>";
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