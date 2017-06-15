<?php include_once "head.php";?>
<div class="bo_title">Tambah Supplier / Penyedia Jasa</div>
<?php
	if(isset($_POST["save"])){
		$db->addtable("suppliers");	
		$db->addfield("name");				$db->addvalue($_POST["name"]);
		$db->addfield("work_category_ids");	$db->addvalue(sel_to_pipe($_POST["work_category_ids"]));
		$db->addfield("address");			$db->addvalue($_POST["address"]);
		$db->addfield("pic");				$db->addvalue($_POST["pic"]);
		$db->addfield("pic_position");		$db->addvalue($_POST["pic_position"]);
		$db->addfield("value_of_capital");	$db->addvalue($_POST["value_of_capital"]);
		$db->addfield("types_of_goods");	$db->addvalue($_POST["types_of_goods"]);
		$db->addfield("siup_category");		$db->addvalue($_POST["siup_category"]);
		$db->addfield("siup_validity");		$db->addvalue($_POST["siup_validity"]);
		$db->addfield("npwp");				$db->addvalue($_POST["npwp"]);
		$db->addfield("updated_at");		$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("updated_by");		$db->addvalue($__username);
		$db->addfield("updated_ip");		$db->addvalue($_SERVER["REMOTE_ADDR"]);
		$inserting = $db->insert();
		if($inserting["affected_rows"] >= 0){
			$supplier_id = $inserting["insert_id"];
			foreach($_FILES["scan_file"]["tmp_name"] as $key => $tmp_name){
				if($tmp_name){
					$_ext = strtolower(pathinfo($_FILES['scan_file']['name'][$key],PATHINFO_EXTENSION));
					$file_type = $_POST["file_type"][$key];
					$softcopy_name = $file_type."_".$supplier_id."_".$key.".".$_ext;
					move_uploaded_file($tmp_name,"supplier_files/".$softcopy_name);
					$db->addtable("supplier_files");
					$db->addfield("supplier_id");	$db->addvalue($supplier_id);
					$db->addfield("file_type");		$db->addvalue($file_type);
					$db->addfield("filename");		$db->addvalue($softcopy_name);
					$db->insert();
				}
			}
			javascript("alert('Data Saved');");
			javascript("window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';");
		} else {
			javascript("alert('Saving data failed');");
		}
	}
	
	$name 				= $f->input("name","","size='50'");
	$work_category_ids 	= $f->select_multiple("work_category_ids",$db->fetch_select_data("work_categories","id","name"),array(),"style='width:300px;'");
	$address 			= $f->textarea("address");
	$pic				= $f->input("pic");
	$pic_position		= $f->input("pic_position");
	$value_of_capital	= $f->input("value_of_capital");
	$types_of_goods		= $f->input("types_of_goods","","size='50'");
	$siup_category		= $f->input("siup_category");
	$siup_validity		= $f->input("siup_validity","","type='date'");
	$npwp				= $f->input("npwp");
	
	$plusminbutton = $f->input("addrow","+","type='button' style='width:25px' onclick=\"adding_row('detail_area','row_detail_');\"")."&nbsp;";
	$plusminbutton .= $f->input("subrow","-","type='button' style='width:25px' onclick=\"substract_row('detail_area','row_detail_');\"");
	
	$file_types = array("siup"=>"SIUP","tdp"=>"TDP","spt"=>"SPT Pajak Tahunan","npwp"=>"NPWP","akta"=>"Akta Perusahaan","rekening"=>"Rekening Bank Perusahaan");
	$sel_file_type = $f->select("file_type[0]",$file_types,"");
	$btn_scan_file = $f->input("scan_file[0]","","type='file'");
?>

<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
         <?=$t->row(array("Nama Perusahaan",$name));?>
         <?=$t->row(array("Kategori Pekerjaan",$work_category_ids));?>
         <?=$t->row(array("Alamat",$address));?>
         <?=$t->row(array("Nama Penanggung Jawab",$pic));?>
         <?=$t->row(array("Jabatan Penanggung Jawab",$pic_position));?>
         <?=$t->row(array("Nilai Modal & Kekayaan Bersih",$value_of_capital));?>
         <?=$t->row(array("Jenis Barang/Jasa Dagangan Utama",$types_of_goods));?>
         <?=$t->row(array("Kategori SIUP",$siup_category));?>
         <?=$t->row(array("Masa Berlaku",$siup_validity));?>
         <?=$t->row(array("NPWP",$npwp));?>
	<?=$t->end();?>
	<br>
	<b>Upload File:</b><br>
	<?=$t->start("width='100%'","detail_area","editor_content_2");?>
        <?=$t->row(array($plusminbutton."<br>No.","Tipe File","Pilih File"),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"));?>
		<?=$t->row(array("<div id=\"firstno\">1</div>",$sel_file_type,$btn_scan_file),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"),"id=\"row_detail_0\"");?>
	<?=$t->end();?>
	<br>
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php include_once "footer.php";?>