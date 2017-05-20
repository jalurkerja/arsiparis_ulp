<?php include_once "head.php";?>
<div class="bo_title">Edit User</div>
<?php
	if(isset($_POST["save"])){
		$db->addtable("users");					$db->where("id",$_GET["id"]);
		$db->addfield("group_id");				$db->addvalue($_POST["group_id"]);
		$db->addfield("email");					$db->addvalue($_POST["email"]);
		$db->addfield("name");					$db->addvalue($_POST["name"]);
		$db->addfield("job_title");				$db->addvalue($_POST["job_title"]);
		$db->addfield("job_division");			$db->addvalue($_POST["job_division"]);
		if($_POST["password"] !="" ) {
			$db->addfield("password");			$db->addvalue(base64_encode($_POST["password"]));
		}
		$db->addfield("updated_at");			$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("updated_by");			$db->addvalue($__username);
		$db->addfield("updated_ip");			$db->addvalue($_SERVER["REMOTE_ADDR"]);
		$updating = $db->update();
		if($updating["affected_rows"] >= 0){
			javascript("alert('Data Saved');");
			javascript("window.location='".str_replace("_edit","_list",$_SERVER["PHP_SELF"])."';");
		} else {
			javascript("alert('Saving data failed');");
		}
	}
	
	$db->addtable("users");$db->where("id",$_GET["id"]);$db->limit(1);$users = $db->fetch_data();
	$sel_group 			= $f->select("group_id",$db->fetch_select_data("groups","id","name",null,array("name")),$users["group_id"]);
	$txt_email 			= $f->input("email",$users["email"]);
	$txt_password 		= $f->input("password","","type='password'");
	$txt_name 			= $f->input("name",$users["name"]);
	$txt_job_title 		= $f->input("job_title",$users["job_title"]);
	$txt_job_division 	= $f->input("job_division",$users["job_division"]);
?>
<?=$f->start();?>
	<?=$t->start("","editor_content");?>
        <?=$t->row(array("Group",$sel_group));?>
		<?=$t->row(array("Email",$txt_email));?>
		<?=$t->row(array("Password",$txt_password));?>
		<?=$t->row(array("Name",$txt_name));?>
		<?=$t->row(array("Job Title",$txt_job_title));?>
		<?=$t->row(array("Job Division",$txt_job_division));?>
	<?=$t->end();?>
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_edit","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php include_once "footer.php";?>