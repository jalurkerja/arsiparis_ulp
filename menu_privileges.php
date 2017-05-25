<?php include_once "head.php";?>
	<?php
	if($_POST["save"]){
		$db->addtable("backoffice_menu_privileges");
		$db->where("group_id",$_GET["id"]);
		$db->delete_();
		foreach($_POST["is_check"] as $menu_id => $value){
			$db->addtable("backoffice_menu_privileges");
			$db->addfield("group_id");				$db->addvalue($_GET["id"]);
			$db->addfield("backoffice_menu_id");	$db->addvalue($menu_id);	
			$db->addfield("privilege");				$db->addvalue(1 + $_POST["is_writable"][$menu_id]);
			$db->addfield("updated_at");			$db->addvalue(date("Y-m-d H:i:s"));
			$db->addfield("updated_by");			$db->addvalue($__username);
			$db->addfield("updated_ip");			$db->addvalue($_SERVER["REMOTE_ADDR"]);
			$inserting = $db->insert();
		}
		echo "<font color='blue'>Data Saved</font>";
	}
	?>
	<style>
		.menu_list li:nth-child(odd) { background-color: rgb(232, 232, 255);}
		.menu_list {width:600px;}
	</style>
	<fieldset>
	<legend class="bo_title">Privilege for <?=$db->fetch_single_data("groups","name",array("id"=>$_GET["id"]));?></legend>
	<form method="POST" action="?id=<?=$_GET["id"];?>">
	<?php
			$group_exist = $db->fetch_single_data("backoffice_menu_privileges","id",array("group_id" => $_GET["id"]));
			$db->addtable("backoffice_menu"); $db->addfield("id,name"); $db->where("parent_id",0); $db->order("seqno");
			$arrmenu = $db->fetch_data(true);
			foreach($arrmenu as $menu){
				$checked = "";
				if($db->fetch_single_data("backoffice_menu_privileges","privilege",array("group_id"=>$_GET["id"],"backoffice_menu_id"=>$menu["id"])) > 0){$checked = "checked";}
				$is_writable_checked = "";
				if($db->fetch_single_data("backoffice_menu_privileges","privilege",array("group_id"=>$_GET["id"],"backoffice_menu_id"=>$menu["id"])) > 1 || !$group_exist){$is_writable_checked = "checked";}
				echo "<ul class='menu_list' style='list-style-type:none'>";
				echo "<li><div>".$f->input("is_check[".$menu["id"]."]","1","type='checkbox' ".$checked).$menu["name"];
				echo "<div style='float:right;'>".$f->input("is_writable[".$menu["id"]."]","1","type='checkbox' ".$is_writable_checked)."Writeable</div></div></li>";
				$db->addtable("backoffice_menu"); $db->addfield("id,name"); $db->where("parent_id",$menu["id"]); $db->order("seqno");
				$arrsubmenu = $db->fetch_data(true);
				if(count($arrsubmenu) > 0){
					echo "<ul class='menu_list' style='list-style-type:none'>";
					foreach($arrsubmenu as $submenu){
						$checked = "";
						if($db->fetch_single_data("backoffice_menu_privileges","privilege",array("group_id"=>$_GET["id"],"backoffice_menu_id"=>$submenu["id"])) > 0){$checked = "checked";}
						$is_writable_checked = "";
						if($db->fetch_single_data("backoffice_menu_privileges","privilege",array("group_id"=>$_GET["id"],"backoffice_menu_id"=>$submenu["id"])) > 1 || !$group_exist){$is_writable_checked = "checked";}
						echo "<li><div><a>".$f->input("is_check[".$submenu["id"]."]","1","type='checkbox' ".$checked).$submenu["name"];
						echo "<div style='float:right;'>".$f->input("is_writable[".$submenu["id"]."]","1","type='checkbox' ".$is_writable_checked)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></div></li>";
					}
					echo "</ul>";
				}
				//echo "<li style='list-style-type:none'></li>";
				echo "</ul>";
			}
			echo "<br>";
			
		
	?>
	<?=$f->input("save","Update","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='groups_list.php';\"");?>
	</form>	
	</fieldset>
<?php include_once "footer.php";?>