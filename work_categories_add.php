<?php include_once "head.php";?>
<div class="bo_title">Tambah Kategori Pekerjaan</div>
<?php
	if(isset($_POST["save"])){
		$db->addtable("work_categories");
		$db->addfield("name");			$db->addvalue(@$_POST["name"]);
		$db->addfield("updated_at");	$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("updated_by");	$db->addvalue($__username);
		$db->addfield("updated_ip");	$db->addvalue($_SERVER["REMOTE_ADDR"]);
		$inserting = $db->insert();
		if($inserting["affected_rows"] >= 0){
			$insert_id = $inserting["insert_id"];
			javascript("alert('Data Saved');");
			javascript("window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';");
		} else {
			echo $inserting["error"];
			javascript("alert('Saving data failed');");
		}
	}
	
	$txt_name			= $f->input("name",@$_POST["name"],"size='50'");
?>
<?=$f->start();?>
	<?=$t->start("","editor_content");?>
		<?=$t->row(array("Name",$txt_name));?>
	<?=$t->end();?>
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php include_once "footer.php";?>