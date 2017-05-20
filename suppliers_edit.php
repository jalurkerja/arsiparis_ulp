<?php include_once "head.php";?>
<div class="bo_title">Ubah Supplier / Penyedia Jasa</div>
<?php
	if(isset($_POST["save"])){
		$db->addtable("suppliers");			$db->where("id",$_GET["id"]);
		$db->addfield("name");				$db->addvalue($_POST["name"]);
		$db->addfield("work_category_ids");	$db->addvalue(sel_to_pipe($_POST["work_category_ids"]));
		$db->addfield("address");			$db->addvalue($_POST["address"]);
		$db->addfield("pic");				$db->addvalue($_POST["pic"]);
		$db->addfield("pic_position");		$db->addvalue($_POST["pic_position"]);
		$db->addfield("value_of_capital");	$db->addvalue($_POST["value_of_capital"]);
		$db->addfield("types_of_goods");	$db->addvalue($_POST["types_of_goods"]);
		$db->addfield("siup_category");		$db->addvalue($_POST["siup_category"]);
		$db->addfield("siup_validity");		$db->addvalue($_POST["siup_validity"]);
		$db->addfield("updated_at");		$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("updated_by");		$db->addvalue($__username);
		$db->addfield("updated_ip");		$db->addvalue($_SERVER["REMOTE_ADDR"]);
		$updating = $db->update();
		if($updating["affected_rows"] >= 0){
			$supplier_id = $_GET["id"];
			foreach($_FILES["scan_file"]["tmp_name"] as $key => $tmp_name){
				if($tmp_name){
					$_ext = strtolower(pathinfo($_FILES['scan_file']['name'][$key],PATHINFO_EXTENSION));
					$file_type = $_POST["file_type"][$key];
					$softcopy_name = $file_type."_".$supplier_id."_".$key.".".$_ext;
					move_uploaded_file($tmp_name,"supplier_files/".$softcopy_name);
					$db->addtable("supplier_files");
					$db->where("supplier_id",$supplier_id);
					$db->where("filename","%_".$supplier_id."_".$key.".%:LIKE");
					$db->addfield("supplier_id");	$db->addvalue($supplier_id);
					$db->addfield("file_type");		$db->addvalue($file_type);
					$db->addfield("filename");		$db->addvalue($softcopy_name);
					$db->update();
				}
			}
			javascript("alert('Data Saved');");
		} else {
			javascript("alert('Saving data failed');");
		}
	}
	
	$db->addtable("suppliers"); $db->where("id",$_GET["id"]);$db->limit(1);$supplier = $db->fetch_data();
	
	$name 				= $f->input("name",$supplier["name"],"size='50'");
	$work_category_ids 	= $f->select_multiple("work_category_ids",$db->fetch_select_data("work_categories","id","name"),pipetoarray($supplier["work_category_ids"]),"style='width:300px;'");
	$address 			= $f->textarea("address",$supplier["address"]);
	$pic				= $f->input("pic",$supplier["pic"]);
	$pic_position		= $f->input("pic_position",$supplier["pic_position"]);
	$value_of_capital	= $f->input("value_of_capital",$supplier["value_of_capital"]);
	$types_of_goods		= $f->input("types_of_goods",$supplier["types_of_goods"],"size='50'");
	$siup_category		= $f->input("siup_category",$supplier["siup_category"]);
	$siup_validity		= $f->input("siup_validity",$supplier["siup_validity"],"type='date'");
	
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
	<?=$t->end();?>
	<br>
	<b>Upload File:</b><br>
	<?=$t->start("width='100%'","detail_area","editor_content_2");?>
        <?=$t->row(array($plusminbutton."<br>No.","Tipe File","Pilih File"),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"));?>
		<?=$t->row(array("<div id=\"firstno\">1</div>",$sel_file_type,$btn_scan_file),array("nowrap style='font-weight:bold;font-size:14px;'"),"id=\"row_detail_0\"");?>
	<?=$t->end();?>
	<br>
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_edit","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>

<?php
	$db->addtable("supplier_files");	$db->where("supplier_id",$_GET["id"]);
	$supplier_files = $db->fetch_data(true);
	foreach($supplier_files as $key => $supplier_file){
		?><script>
			document.getElementById("file_type[<?=$key;?>]").value = "<?=$supplier_file["file_type"];?>";
			adding_row('detail_area','row_detail_');
		</script><?php
	}
	foreach($supplier_files as $key => $supplier_file){
		$filename = $db->fetch_single_data("supplier_files","filename",array("supplier_id"=>$_GET["id"],"filename"=>"%_".$_GET["id"]."_".$key.".%:LIKE"));
		?><script>
			document.getElementById("scan_file[<?=$key;?>]").parentElement.innerHTML += " &nbsp;&nbsp;<a target='_BLANK' href='supplier_files/<?=$filename;?>'><?=$filename;?></a>";
		</script><?php
	}
	?><script> substract_row('detail_area','row_detail_'); </script><?php
?>
<?php include_once "footer.php";?>