<?php
	include_once "win_head.php";
	
	$db->addtable($_tablename);
	if($_POST["keyword"] != "") $db->awhere(
										"name LIKE '%".$_POST["keyword"]."%'
										OR hps_nomor LIKE '%".$_POST["keyword"]."%'"
								);
	$db->limit(1000);
	$db->order("hps_ok_at DESC");
	$_data = $db->fetch_data(true);
?>
<script>
	function parrent_adds_load(procurement_work_id,name,work_category,hps_nomor,hps_nominal,hps_ok_by,hps_ok_at,work_days,ppk_name,ppk_nip){
		parent.document.getElementById("<?=$_GET["name"];?>").value = procurement_work_id;
		parent.document.getElementById("sw_caption_<?=$_GET["name"];?>").innerHTML = name;
		parent.document.getElementById("work_category").innerHTML = work_category;
		parent.document.getElementById("hps_nomor").innerHTML = hps_nomor;
		parent.document.getElementById("hps_nominal").innerHTML = hps_nominal;
		parent.document.getElementById("hps_ok_by").innerHTML = hps_ok_by;
		parent.document.getElementById("hps_ok_at").innerHTML = hps_ok_at;
		parent.document.getElementById("work_days").innerHTML = work_days;
		parent.document.getElementById("ppk_name").innerHTML = ppk_name;
		parent.document.getElementById("ppk_nip").innerHTML = ppk_nip;
		parent.$.fancybox.close();
	}
</script>
<h3><b><?=$_title;?></b></h3>
<br><br>
<?=$f->start("","POST","?".$_SERVER["QUERY_STRING"]);?>
Search : <?=$f->input("keyword",$_POST["keyword"],"size='50'");?>&nbsp;<?=$f->input("search","Load","type='submit'");?>
<?=$f->end();?>
<br>
<?=$t->start("","data_content");?>
<?=$t->header(array("No","ID Pekerjaan","Nama Pekerjaan","Kategori Pekerjaan","HPS"));?>
<?php 
	foreach($_data as $no => $data){
		$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
		$actions = "onclick=\"parrent_adds_load('".$data["id"]."'
												,'".$data["name"]."'
												,'".$work_category."'
												,'".$data["hps_nomor"]."'
												,'".format_amount($data["hps_nominal"])."'
												,'".$db->fetch_single_data("users","name",array("email" => $data["hps_ok_by"]))."'
												,'".format_tanggal($data["hps_ok_at"])."'
												,'".$data["work_days"]."'
												,'".$data["ppk_name"]."'
												,'".$data["ppk_nip"]."');\"";
		
		echo $t->row(array($no+1,$data["id"],$data["name"],$work_category,format_amount($data["hps_nominal"])),array("align='right' valign='top' ".$actions,"valign='top' ".$actions,$actions,$actions,$actions));
	} 
?>
<?=$t->end();?>