<?php include_once "head.php";?>
<div class="bo_title">Tambah Undangan Kepada Penyedia Barang/Jasa</div>
<?php
	if(isset($_POST["save"])){
		$db->addtable("pokja_ulp");$db->where("procurement_work_id",$_POST["procurement_work_id"]);
		if(count($db->fetch_data(true)) > 0){
			javascript("alert('Undangan Kepada Penyedia Barang/Jasa untuk pekerjaan yang dipilih sudah pernah di buat sebelumnya');");
		}else{
			$db->addtable("pokja_ulp");	
			$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
			$db->addfield("undangan_nomor");		$db->addvalue($_POST["undangan_nomor"]);
			$db->addfield("undangan_tanggal");		$db->addvalue($_POST["undangan_tanggal"]);
			$db->addfield("undangan_supplier_ids");	$db->addvalue(sel_to_pipe($_POST["supplier_id"]));
			$db->addfield("undang_tgl");			$db->addvalue($_POST["undang_tgl"]);
			$db->addfield("undang_jam");			$db->addvalue($_POST["undang_jam"]);
			$db->addfield("undang_tempat");			$db->addvalue($_POST["undang_tempat"]);
			$db->addfield("undangan_updated_at");	$db->addvalue(date("Y-m-d H:i:s"));
			$db->addfield("undangan_updated_by");	$db->addvalue($__username);
			$inserting = $db->insert();
			if($inserting["affected_rows"] >= 0){
				$pokja_ulp_id = $inserting["insert_id"];
				javascript("alert('Data Saved');");
				javascript("window.location='pokja_ulp_undangan_edit.php?id=".$pokja_ulp_id."';");
			} else {
				javascript("alert('Saving data failed');");
			}
		}
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan","","procurement_works","id","name","win_procurement_works.php");
	$txt_undangan_nomor = $f->input("undangan_nomor","","style='width:300px;'");
	$txt_undangan_tanggal = $f->input("undangan_tanggal","","type='date'");
	$txt_undang_tgl = $f->input("undang_tgl","","type='date'");
	$txt_undang_jam = $f->input("undang_jam","","type='time'");
	$txt_undang_tempat = $f->textarea("undang_tempat","Ruang Rapat BP2IP Tangerang".chr(13).chr(10)."Jl. Raya Karangserang No. 1 Kec. Sukadiri Kab. Tangerang Banten");
	
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";	
	
	$plusminbutton = $f->input("addrow","+","type='button' style='width:25px' onclick=\"adding_row('detail_area','row_detail_');\"")."&nbsp;";
	$plusminbutton .= $f->input("subrow","-","type='button' style='width:25px' onclick=\"substract_row('detail_area','row_detail_');\"");
	$sel_supplier = $f->select("supplier_id[0]",$db->fetch_select_data("suppliers","id","name",array(),array("name")),"");
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
		<?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Nomor Surat Undangan Kepada Penyedia",$txt_undangan_nomor));?>
        <?=$t->row(array("Tanggal Surat Undangan",$txt_undangan_tanggal));?>
        <?=$t->row(array("Diundang pada tanggal",$txt_undang_tgl));?>
        <?=$t->row(array("Diundang pada jam",$txt_undang_jam));?>
        <?=$t->row(array("Diundang bertempat di",$txt_undang_tempat));?>
        <?=$t->row(array("Kategori Pekerjaan","<div id='work_category' ".$datastyle."></div>"));?>
        <?=$t->row(array("Nomor Surat Penetapan HPS","<div id='hps_nomor' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS","<div id='hps_nominal' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS di approve Oleh","<div id='hps_ok_by' ".$datastyle."></div>"));?>
        <?=$t->row(array("Tanggal Approve","<div id='hps_ok_at' ".$datastyle."></div>"));?>
        <?=$t->row(array("Jangka Waktu Pekerjaan","<div id='work_days' ".$datastyle."></div>"));?>
        <?=$t->row(array("Pejabat Pembuat Komitmen","<div id='ppk_name' ".$datastyle."></div><div id='ppk_nip' ".$datastyle."></div>"));?>
	<?=$t->end();?>
	<br><b>Penyedia Barang/Jasa:</b></br>
	<?=$t->start("width='100%'","detail_area","editor_content_2");?>
        <?=$t->row(array($plusminbutton."<br>No.","Penyedia Barang/Jasa"),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"));?>
		<?=$t->row(array("<div id=\"firstno\">1</div>",$sel_supplier),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"),"id=\"row_detail_0\"");?>
	<?=$t->end();?>
	<br>
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php include_once "footer.php";?>