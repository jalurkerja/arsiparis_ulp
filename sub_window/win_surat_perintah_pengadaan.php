<?php
	include_once "win_head.php";
	
	$db->addtable($_tablename);
	if($_POST["keyword"] != "") $db->awhere(
										"procurement_work_id LIKE '%".$_POST["keyword"]."%'
										OR procurement_work_id IN (SELECT id FROM procurement_works WHERE name LIKE '%".$_POST["keyword"]."%')
										OR procurement_work_id IN (SELECT id FROM procurement_works WHERE hps_nomor LIKE '%".$_POST["keyword"]."%')
										OR nomor LIKE '%".$_POST["keyword"]."%'
										"
								);
								
	$db->limit(1000);
	$db->order("nomor DESC");
	$_data = $db->fetch_data(true);
?>
<script>
	function parent_adds_load(surat_perintah_pengadaan_id,nomor,procurement_work_name,work_category,hps_nomor,hps_nominal,hps_ok_by,hps_ok_at,work_days,ppk_name,ppk_nip){
		parent.document.getElementById("<?=$_GET["name"];?>").value = surat_perintah_pengadaan_id;
		parent.document.getElementById("sw_caption_<?=$_GET["name"];?>").innerHTML = nomor;
		parent.document.getElementById("procurement_work_name").innerHTML = procurement_work_name;
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
<?=$t->header(array("No","Nomor Surat Perintah","Tanggal Surat<br>Perintah","Nama Pekerjaan","Kategori Pekerjaan","HPS"));?>
<?php 
	foreach($_data as $no => $data){
		$db->addtable("procurement_works"); $db->where("id",$data["procurement_work_id"]);$db->limit(1);$data2 = $db->fetch_data();
		$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data2["work_category_id"]));
		$actions = "onclick=\"parent_adds_load('".$data["id"]."'
												,'".$data["nomor"]."'
												,'".$data2["name"]."'
												,'".$work_category."'
												,'".$data2["hps_nomor"]."'
												,'".format_amount($data2["hps_nominal"])."'
												,'".$db->fetch_single_data("users","name",array("email" => $data2["hps_ok_by"]))."'
												,'".format_tanggal($data2["hps_ok_at"])."'
												,'".$data2["work_days"]."'
												,'".$data2["ppk_name"]."'
												,'".$data2["ppk_nip"]."');\"";
		
		echo $t->row(array($no+1,$data["nomor"],format_tanggal($data["tanggal"]),$data2["name"],$work_category,format_amount($data2["hps_nominal"])),array("align='right' valign='top' ".$actions,"valign='top' ".$actions,$actions,$actions,$actions,$actions));
	} 
?>
<?=$t->end();?>