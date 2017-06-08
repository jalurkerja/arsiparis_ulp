<?php include_once "head.php";?>
<div class="bo_title">Tambah Kuitansi</div>
<script>
	function load_procurement_work(procurement_work_id){
		$.ajax({url: "kuitansi_ajax.php?mode=load_procurement_work&id=" + procurement_work_id, success: function(result){
			arrresult = result.split("|||");
			supplier_id.value = arrresult[0];
			pemeriksa1_name.value = arrresult[1];
			pemeriksa1_nip.value = arrresult[2];
			pemeriksa2_name.value = arrresult[3];
			pemeriksa2_nip.value = arrresult[4];
			pemeriksa3_name.value = arrresult[5];
			pemeriksa3_nip.value = arrresult[6];
			nominal.value = arrresult[7];
		}});
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("kuitansi");	
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
		$inserting = $db->insert();
		$kuitansi_id = $inserting["insert_id"];
		if($inserting["affected_rows"] >= 0){
			javascript("alert('Data Saved');");
			javascript("window.location='kuitansi_edit.php?id=".$kuitansi_id."';");
		} else {
			javascript("alert('Saving data failed');");
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
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php include_once "footer.php";?>