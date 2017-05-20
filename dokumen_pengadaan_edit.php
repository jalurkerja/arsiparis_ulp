<?php include_once "head.php";?>
<div class="bo_title">Ubah Dokumen Pengadaan</div>
<?php
	if(isset($_POST["save"])){
		$db->addtable("dokumen_pengadaan");		$db->where("id",$_GET["id"]);
		$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
		$db->addfield("nomor");					$db->addvalue($_POST["nomor"]);
		$db->addfield("updated_at");			$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("updated_by");			$db->addvalue($__username);
		$db->addfield("updated_ip");			$db->addvalue($_SERVER["REMOTE_ADDR"]);
		$inserting = $db->update();
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
			echo "<font color='blue'><b>Data Saved</b></font>";
		} else {
			javascript("alert('Saving data failed');");
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
	<?=$f->input("save","Simpan","type='submit'");?> 
	<?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_edit","_list",$_SERVER["PHP_SELF"])."';\"");?>
	<?=$f->input("dokumen_pengadaan_undangan","Daftar Undangan & Cetak Dokumen","type='button' onclick=\"window.location='dokumen_pengadaan_undangan_list.php?dokumen_pengadaan_id=".$_GET["id"]."';\"");?>
<?=$f->end();?>
<?php
	$nomor = $db->fetch_single_data("dokumen_pengadaan","nomor",array("id" => $_GET["id"]));
	$procurement_work_id = $db->fetch_single_data("dokumen_pengadaan","procurement_work_id",array("id" => $_GET["id"]));
	$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
	$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
?>
<script>	
	document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
	document.getElementById("nomor").value = "<?=$nomor;?>";
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

<?php
	$db->addtable("dokumen_pengadaan_kegiatan"); $db->where("procurement_work_id",$procurement_work_id);
	foreach($db->fetch_data(true) as $key => $data){
		?><script>
			document.getElementById("kegiatan[<?=$key;?>]").value = "<?=$data["kegiatan"];?>";
			document.getElementById("tanggal_1[<?=$key;?>]").value = "<?=$data["tanggal_1"];?>";
			document.getElementById("tanggal_2[<?=$key;?>]").value = "<?=$data["tanggal_2"];?>";
			document.getElementById("waktu_1[<?=$key;?>]").value = "<?=$data["waktu_1"];?>";
			document.getElementById("waktu_2[<?=$key;?>]").value = "<?=$data["waktu_2"];?>";
			adding_row('detail_area','row_detail_');
		</script><?php
	}
	?><script> substract_row('detail_area','row_detail_'); </script><?php
?>
<?php include_once "footer.php";?>