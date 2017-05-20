<?php include_once "head.php";?>
<div class="bo_title">Tambah Dokumen Pengadaan</div>
<?php
	if(isset($_POST["save"])){
		$db->addtable("dokumen_pengadaan");$db->where("procurement_work_id",$_POST["procurement_work_id"]);
		if(count($db->fetch_data(true)) > 0){
			javascript("alert('Dokumen Pengadaan untuk pekerjaan yang dipilih sudah pernah di buat sebelumnya');");
		} else {
			$db->addtable("dokumen_pengadaan");	
			$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
			$db->addfield("nomor");					$db->addvalue($_POST["nomor"]);
			$db->addfield("updated_at");			$db->addvalue(date("Y-m-d H:i:s"));
			$db->addfield("updated_by");			$db->addvalue($__username);
			$db->addfield("updated_ip");			$db->addvalue($_SERVER["REMOTE_ADDR"]);
			$inserting = $db->insert();
			if($inserting["affected_rows"] >= 0){
				$dokumen_pengadaan_id = $inserting["insert_id"];
				$db->addtable("dokumen_pengadaan_kegiatan");$db->where("procurement_work_id",$_POST["procurement_work_id"]);$db->delete_();
				foreach($_POST["kegiatan"] as $key => $kegiatan){
					$db->addtable("dokumen_pengadaan_kegiatan");	
					$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
					$db->addfield("kegiatan");				$db->addvalue($kegiatan);
					$db->addfield("tanggal_1");				$db->addvalue($_POST["tanggal_1"][$key]);
					$db->addfield("tanggal_2");				$db->addvalue($_POST["tanggal_2"][$key]);
					if($_POST["waktu_1"][$key] != ""){		$db->addfield("waktu_1");$db->addvalue($_POST["waktu_1"][$key]);}
					if($_POST["waktu_2"][$key] != ""){		$db->addfield("waktu_2");$db->addvalue($_POST["waktu_2"][$key]);}
					$db->addfield("updated_at");			$db->addvalue(date("Y-m-d H:i:s"));
					$db->addfield("updated_by");			$db->addvalue($__username);
					$db->addfield("updated_ip");			$db->addvalue($_SERVER["REMOTE_ADDR"]);
					$db->insert();
				}
				
				javascript("alert('Data Saved');");
				javascript("window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';");
			} else {
				javascript("alert('Saving data failed');");
			}
		}
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan","","procurement_works","id","name","win_procurement_works.php");
	$txt_nomor = $f->input("nomor","","style='width:300px;'");
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";
	
	$plusminbutton = $f->input("addrow","+","type='button' style='width:25px' onclick=\"adding_row('detail_area','row_detail_');\"")."&nbsp;";
	$plusminbutton .= $f->input("subrow","-","type='button' style='width:25px' onclick=\"substract_row('detail_area','row_detail_');\"");
	$txt_kegiatan = $f->input("kegiatan[0]","","style='width:300px;'");
	$txt_tanggal_1 = $f->input("tanggal_1[0]","","type='date'");
	$txt_tanggal_2 = $f->input("tanggal_2[0]","","type='date'");
	$txt_waktu_1 = $f->input("waktu_1[0]","","type='time'");
	$txt_waktu_2 = $f->input("waktu_2[0]","","type='time'");
	
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
        <?=$t->row(array("Nomor Dokumen Pengadaan",$txt_nomor));?>
        <?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Kategori Pekerjaan","<div id='work_category' ".$datastyle."></div>"));?>
        <?=$t->row(array("Nomor Surat Penetapan HPS","<div id='hps_nomor' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS","<div id='hps_nominal' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS di approve Oleh","<div id='hps_ok_by' ".$datastyle."></div>"));?>
        <?=$t->row(array("Tanggal Approve","<div id='hps_ok_at' ".$datastyle."></div>"));?>
        <?=$t->row(array("Jangka Waktu Pekerjaan","<div id='work_days' ".$datastyle."></div>"));?>
        <?=$t->row(array("Pejabat Pembuat Komitmen","<div id='ppk_name' ".$datastyle."></div><div id='ppk_nip' ".$datastyle."></div>"));?>
	<?=$t->end();?>
	<br>
	<b>Kegiatan Pengadaan</b><br>
	<?=$t->start("width='100%'","detail_area","editor_content_2");?>
        <?=$t->row(array($plusminbutton."<br>No.","Kegiatan","Tanggal","Waktu"),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"));?>
		<?=$t->row(array("<div id=\"firstno\">1</div>",$txt_kegiatan,$txt_tanggal_1."s/d".$txt_tanggal_2,$txt_waktu_1."s/d".$txt_waktu_2),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"),"id=\"row_detail_0\"");?>
	<?=$t->end();?>
	<br>
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php include_once "footer.php";?>