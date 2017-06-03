<?php include_once "head.php";?>
<div class="bo_title">Tambah SPK</div>
<script>
	function load_procurement_work(procurement_work_id){
		$.ajax({url: "spk_ajax.php?mode=load_procurement_work&id=" + procurement_work_id, success: function(result){
			supplier_id.value = result;
		}});
	}
</script>
<?php
	if($_GET["spk_id"] > 0){
		$_POST["procurement_work_id"] = $db->fetch_single_data("spk","procurement_work_id",array("id"=>$_GET["spk_id"]));
		if($db->fetch_single_data("spk","nomor",array("id"=>$_GET["spk_id"])) > 0)
			javascript("window.location='spk_edit.php?id=".$_GET["spk_id"]."';");
	}
	if(isset($_POST["save"])){
		$db->addtable("spk");$db->where("procurement_work_id",$_POST["procurement_work_id"]);$db->where("nomor","","s","<>");
		if(count($db->fetch_data(true)) > 0){
			javascript("alert('SPK untuk pekerjaan yang dipilih sudah pernah di buat sebelumnya');");
		}else{
			$spk_id = $db->fetch_single_data("spk","id",array("procurement_work_id"=>$_POST["procurement_work_id"]));
			
			$db->addtable("spk");	
			$db->addfield("nomor");			$db->addvalue($_POST["nomor"]);
			$db->addfield("tanggal");		$db->addvalue($_POST["tanggal"]);
			$db->addfield("supplier_id");	$db->addvalue($_POST["supplier_id"]);
			if($spk_id > 0){
				$db->where("procurement_work_id",$_POST["procurement_work_id"]);
				$inserting = $db->update();
			} else {
				$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
				$inserting = $db->insert();
				$spk_id = $inserting["insert_id"];
			}
			if($inserting["affected_rows"] >= 0){
				javascript("alert('Data Saved');");
				javascript("window.location='spk_edit.php?id=".$spk_id."';");
			} else {
				javascript("alert('Saving data failed');");
			}
		}
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan","","procurement_works","id","name","win_procurement_works.php");
	$txt_nomor = $f->input("nomor","","style='width:300px;' onfocus='load_procurement_work(procurement_work_id.value);'");
	$txt_tanggal = $f->input("tanggal","","type='date'");
	$sel_supplier = $f->select("supplier_id",$db->fetch_select_data("suppliers","id","name",array(),array("name"),"",true),"","style='height:22px;'");
	
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
		<?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Nomor SPK",$txt_nomor));?>
        <?=$t->row(array("Tanggal SPK",$txt_tanggal));?>
        <?=$t->row(array("Penyedia Barang/Jasa",$sel_supplier));?>
        <?=$t->row(array("Kategori Pekerjaan","<div id='work_category' ".$datastyle."></div>"));?>
        <?=$t->row(array("Nomor Surat Penetapan HPS","<div id='hps_nomor' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS","<div id='hps_nominal' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS di approve Oleh","<div id='hps_ok_by' ".$datastyle."></div>"));?>
        <?=$t->row(array("Tanggal Approve","<div id='hps_ok_at' ".$datastyle."></div>"));?>
        <?=$t->row(array("Jangka Waktu Pekerjaan","<div id='work_days' ".$datastyle."></div>"));?>
        <?=$t->row(array("Pejabat Pembuat Komitmen","<div id='ppk_name' ".$datastyle."></div><div id='ppk_nip' ".$datastyle."></div>"));?>
	<?=$t->end();?>
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php
	if($_POST["procurement_work_id"] > 0){
		$procurement_work_id = $_POST["procurement_work_id"];
		$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
		$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
		$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
		$supplier_id = $db->fetch_single_data("spk_id","supplier_id",array("id" => $_GET["spk_id"]));
		if(!$supplier_id) $supplier_id = $db->fetch_single_data("pokja_ulp","ba_hasil_supplier_id",array("procurement_work_id"=>$procurement_work_id));
?>
	<script>	
		document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
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
		document.getElementById("supplier_id").value = "<?=$supplier_id;?>";
	</script>
<?php
	}
?>
<?php include_once "footer.php";?>