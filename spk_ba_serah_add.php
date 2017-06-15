<?php include_once "head.php";?>
<div class="bo_title">Tambah  Berita Acara Serah Terima Barang</div>
<?php
	if($_GET["spk_id"] > 0){
		$_POST["procurement_work_id"] = $db->fetch_single_data("spk","procurement_work_id",array("id"=>$_GET["spk_id"]));
		if($db->fetch_single_data("spk","ba_serah_nomor",array("id"=>$_GET["spk_id"])) != "")
			javascript("window.location='spk_ba_serah_edit.php?id=".$_GET["spk_id"]."';");
	}
	if(isset($_POST["save"])){
		$spk_id = $db->fetch_single_data("spk","id",array("procurement_work_id"=>$_POST["procurement_work_id"]));
		if($spk_id > 0){
			$db->addtable("spk");					$db->where("id",$spk_id);
			$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
			$db->addfield("ba_serah_nomor");		$db->addvalue($_POST["ba_serah_nomor"]);
			$db->addfield("ba_serah_tanggal");		$db->addvalue($_POST["ba_serah_tanggal"]);
			$db->addfield("ba_serah_updated_at");	$db->addvalue(date("Y-m-d H:i:s"));
			$db->addfield("ba_serah_updated_by");	$db->addvalue($__username);
			$inserting = $db->update();
			if($inserting["affected_rows"] >= 0){
				javascript("alert('Data Saved');");
				javascript("window.location='spk_ba_serah_edit.php?id=".$spk_id."';");
			} else {
				javascript("alert('Saving data failed');");
			}
		} else {
			javascript("alert('Maaf, Untuk pekerjaan ini tidak dapat di simpan karena Surat Permintan Penawaran Harga belum dibuat sebelumnya');");
		}
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan",@$_POST["procurement_work_id"],"procurement_works","id","name","win_procurement_works.php");
	$txt_ba_serah_nomor = $f->input("ba_serah_nomor","","style='width:300px;'");
	$txt_ba_serah_tanggal = $f->input("ba_serah_tanggal","","type='date'");
	
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
		<?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Nomor Berita Acara Serah Terima Barang",$txt_ba_serah_nomor));?>
        <?=$t->row(array("Tanggal Dokumen",$txt_ba_serah_tanggal));?>
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
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php
	if($_POST["procurement_work_id"] > 0){
		$procurement_work_id = $_POST["procurement_work_id"];
		$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
		$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
		$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
		$supplier_id = $db->fetch_single_data("spk","supplier_id",array("procurement_work_id" => $procurement_work_id));
		$supplier_name = $db->fetch_single_data("suppliers","name",array("id" => $supplier_id));
?>
	<script>	
		document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
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
<?php
	}
?>
<?php include_once "footer.php";?>