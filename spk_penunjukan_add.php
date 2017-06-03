<?php include_once "head.php";?>
<div class="bo_title">Tambah Surat Penunjukan Penyedia Barang/Jasa</div>
<script>
	function load_supplier_info(procurement_work_id){
		$.ajax({url: "spk_penunjukan_ajax.php?mode=load_supplier_info&id=" + procurement_work_id, success: function(result){
			arrresult = result.split("|||");
			supplier_id.value = arrresult[0];
			penawaran_harga.value = arrresult[1];
		}});
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("spk");$db->where("procurement_work_id",$_POST["procurement_work_id"]);$db->where("penunjukan_nomor","","s","<>");
		if(count($db->fetch_data(true)) > 0){
			javascript("alert('Surat Penunjukan Penyedia Barang/Jasa untuk pekerjaan yang dipilih sudah pernah di buat sebelumnya');");
		}else{
			$spk_id = $db->fetch_single_data("spk","id",array("procurement_work_id"=>$_POST["procurement_work_id"]));
			
			$db->addtable("spk");	
			$db->addfield("penunjukan_nomor");		$db->addvalue($_POST["penunjukan_nomor"]);
			$db->addfield("penunjukan_tanggal");	$db->addvalue($_POST["penunjukan_tanggal"]);
			$db->addfield("supplier_id");			$db->addvalue($_POST["supplier_id"]);
			$db->addfield("penawaran_nomor");		$db->addvalue($_POST["penawaran_nomor"]);
			$db->addfield("penawaran_tanggal");		$db->addvalue($_POST["penawaran_tanggal"]);
			$db->addfield("penawaran_harga");		$db->addvalue($_POST["penawaran_harga"]);
			if($spk_id > 0){
				$db->where("procurement_work_id",$_POST["procurement_work_id"]);
				$inserting = $db->update();
			} else {
				$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
				$inserting = $db->insert();
				$spk_id = $inserting["insert_id"];
			}
			if($inserting["affected_rows"] >= 0){
				javascript("alert('Data Saved');");
				javascript("window.location='spk_penunjukan_edit.php?id=".$spk_id."';");
			} else {
				javascript("alert('Saving data failed');");
			}
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
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php include_once "footer.php";?>