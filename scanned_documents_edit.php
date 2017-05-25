<?php include_once "head.php";?>
<div class="bo_title">Ubah Scan Dokumen</div>
<script>
	function deleteing_last_row(id){
		if(confirm("Anda yakin akan menghapus data pada baris terkahir?")){
			window.location = "?deleting=1&id="+id;
		}
	}
</script>
<?php
	if(isset($_GET["deleting"])){
		$scanned_document_id = $db->fetch_single_data("scanned_documents","id",array("parent_id" => $_GET["id"]),array("id DESC"));
		$db->addtable("scanned_documents");$db->where("id",$scanned_document_id);$db->delete_();
		javascript("window.location='?id=".$_GET["id"]."';");
	}
	if(isset($_POST["save"])){
		$parent_id = 0;
		if(isset($_POST["procurement_work_id"])) $_POST["procurement_work_name"] = $db->fetch_single_data("procurement_works","name",array("id"=>$_POST["procurement_work_id"]));
		else $_POST["procurement_work_name"] = $_POST["sw_caption_text_procurement_work_id"];
		
		foreach($_FILES["scan_file"]["tmp_name"] as $key => $tmp_name){
			$db->addtable("scanned_documents"); 	$db->where("id",$_POST["scanned_document_id"][$key]);
			$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
			$db->addfield("procurement_work_name");	$db->addvalue($_POST["procurement_work_name"]);
			$db->addfield("document_type_id");		$db->addvalue($_POST["document_type_id"]);
			$db->addfield("nomor");					$db->addvalue($_POST["nomor"]);
			$db->addfield("work_category_id");		$db->addvalue($_POST["work_category_id"]);
			$db->addfield("updated_at");			$db->addvalue(date("Y-m-d H:i:s"));
			$db->addfield("updated_by");			$db->addvalue($__username);
			$db->addfield("updated_ip");			$db->addvalue($_SERVER["REMOTE_ADDR"]);
			
			if($_POST["scanned_document_id"][$key] > 0){
				$db->update();
				$insert_id = $_POST["scanned_document_id"][$key];
				$parent_id = $db->fetch_single_data("scanned_documents","parent_id",array("id"=>$insert_id));
			} else {
				$db->addfield("parent_id");			$db->addvalue($parent_id);
				$inserting = $db->insert();
				$insert_id = $inserting["insert_id"];
			}
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
		echo "<font color='blue'><b>Data Updated</b></font>";
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan","","procurement_works","id","name","win_procurement_works.php");
	$document_type_id = $db->fetch_single_data("scanned_documents","document_type_id",array("id"=>$_GET["id"],"parent_id"=>"0"));
	$procurement_work_id = $db->fetch_single_data("scanned_documents","procurement_work_id",array("id"=>$_GET["id"],"parent_id"=>"0"));
	$procurement_work_name = $db->fetch_single_data("scanned_documents","procurement_work_name",array("id"=>$_GET["id"],"parent_id"=>"0"));
	$nomor = $db->fetch_single_data("scanned_documents","nomor",array("id"=>$_GET["id"],"parent_id"=>"0"));
	$work_category_id = $db->fetch_single_data("scanned_documents","work_category_id",array("id"=>$_GET["id"],"parent_id"=>"0"));
	
	$sel_document_type = $f->select("document_type_id",$db->fetch_select_data("document_types","id","name",array(),array("name")),$document_type_id);
	$txt_nomor = $f->input("nomor",$nomor);
	$sel_work_category = $f->select("work_category_id",$db->fetch_select_data("work_categories","id","name",array(),array(),"",true),$work_category_id);
	
	
	$plusminbutton = $f->input("addrow","+","type='button' style='width:25px' onclick=\"adding_row('detail_area','row_detail_');\"")."&nbsp;";
	$plusminbutton .= $f->input("subrow","-","type='button' style='width:25px' onclick=\"deleteing_last_row('".$_GET["id"]."')\"");
	
	$btn_scan_file = $f->input("scan_file[0]","","type='file'").$f->input("scanned_document_id[0]","","type='hidden'");
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
		<?=$t->row(array("<div id=\"firstno\">1</div>",$btn_scan_file),array("nowrap style='font-weight:bold;font-size:14px;'"),"id=\"row_detail_0\"");?>
	<?=$t->end();?>
	<br>
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_edit","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>

<?php
	$db->addtable("scanned_documents");	$db->awhere("id = '".$_GET["id"]."' OR parent_id = '".$_GET["id"]."'"); $db->order("id");
	$scanned_documents = $db->fetch_data(true);
	foreach($scanned_documents as $key => $scanned_document){
		?><script>
			document.getElementById("scanned_document_id[<?=$key;?>]").value = "<?=$scanned_document["id"];?>";
			adding_row('detail_area','row_detail_');
		</script><?php
	}
	foreach($scanned_documents as $key => $scanned_document){
		$filename = $scanned_document["filename"];
		?><script>
			document.getElementById("scan_file[<?=$key;?>]").parentElement.innerHTML += " &nbsp;&nbsp;<a target='_BLANK' href='scanned_documents/<?=$filename;?>'><?=$filename;?></a>";
		</script><?php
	}
	?><script> substract_row('detail_area','row_detail_'); </script><?php
	?><script> 
		document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
		document.getElementById("procurement_work_id").value = "<?=$procurement_work_id;?>";
		document.getElementById("sw_caption_procurement_work_id").innerHTML = "<?=$procurement_work_name;?>";
	</script><?php
?>
<?php include_once "footer.php";?>