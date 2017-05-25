<?php include_once "head.php";?>
<div class="bo_title">Tambah Scan Dokumen</div>
<?php
	if(isset($_POST["save"])){
		$parent_id = 0;
		if(isset($_POST["procurement_work_id"])) $_POST["procurement_work_name"] = $db->fetch_single_data("procurement_works","name",array("id"=>$_POST["procurement_work_id"]));
		else $_POST["procurement_work_name"] = $_POST["sw_caption_text_procurement_work_id"];
			
		foreach($_FILES["scan_file"]["tmp_name"] as $key => $tmp_name){
			$db->addtable("scanned_documents");
			$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
			$db->addfield("procurement_work_name");	$db->addvalue($_POST["procurement_work_name"]);
			$db->addfield("document_type_id");		$db->addvalue($_POST["document_type_id"]);
			$db->addfield("parent_id");				$db->addvalue($parent_id);
			$db->addfield("nomor");					$db->addvalue($_POST["nomor"]);
			$db->addfield("work_category_id");		$db->addvalue($_POST["work_category_id"]);
			$db->addfield("updated_at");			$db->addvalue(date("Y-m-d H:i:s"));
			$db->addfield("updated_by");			$db->addvalue($__username);
			$db->addfield("updated_ip");			$db->addvalue($_SERVER["REMOTE_ADDR"]);
			$inserting = $db->insert();
			if($inserting["affected_rows"] >= 0){
				$insert_id = $inserting["insert_id"];
				if($parent_id == 0) $parent_id = $insert_id;
				if($tmp_name){
					$_ext = strtolower(pathinfo($_FILES['scan_file']['name'][$key],PATHINFO_EXTENSION));
					$softcopy_name = "dok_".$parent_id."_".$key."_.".$_ext;
					move_uploaded_file($tmp_name,"scanned_documents/".$softcopy_name);
					$db->addtable("scanned_documents"); $db->where("id",$insert_id);
					$db->addfield("filename");			$db->addvalue($softcopy_name);
					$db->update();
				}
			}
		}
		javascript("alert('Data Saved');");
		javascript("window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';");
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan",@$_POST["procurement_work_id"],"procurement_works","id","name","win_procurement_works.php");
	$sel_procurement_work_id .= "<br>".$f->input("sw_caption_text_procurement_work_id","","style='width:350px;'");
	$sel_document_type = $f->select("document_type_id",$db->fetch_select_data("document_types","id","name",array(),array("name")),"");
	$txt_nomor = $f->input("nomor");
	$sel_work_category = $f->select("work_category_id",$db->fetch_select_data("work_categories","id","name",array(),array(),"",true),"");
	
	
	$plusminbutton = $f->input("addrow","+","type='button' style='width:25px' onclick=\"adding_row('detail_area','row_detail_');\"")."&nbsp;";
	$plusminbutton .= $f->input("subrow","-","type='button' style='width:25px' onclick=\"substract_row('detail_area','row_detail_');\"");
	
	$btn_scan_file = $f->input("scan_file[0]","","type='file'");
?>

<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
         <?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
         <?=$t->row(array("Tipe Dokumen",$sel_document_type));?>
         <?=$t->row(array("Nomor Dokumen",$txt_nomor));?>
         <?=$t->row(array("Kategori Pekerjaan",$sel_work_category));?>
	<?=$t->end();?>
	<br>
	<b>Upload File:</b><br>
	<?=$t->start("width='100%'","detail_area","editor_content_2");?>
        <?=$t->row(array($plusminbutton."<br>No.","Pilih File"),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"));?>
		<?=$t->row(array("<div id=\"firstno\">1</div>",$btn_scan_file),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"),"id=\"row_detail_0\"");?>
	<?=$t->end();?>
	<br>
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php include_once "footer.php";?>