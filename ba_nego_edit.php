<?php include_once "head.php";?>
<div class="bo_title">Ubah Berita Acara Negosiasi Harga</div>
<?php $procurement_work_id = $db->fetch_single_data("ba_nego","procurement_work_id",array("id"=>$_GET["id"])); ?>
<script>
	function download_file(id){
		window.open("ba_nego_view.php?id=" + id);
	}
	function download_all_file(){
		if(confirm("Aplikasi ini akan mengunduh beberapa Dokumen sekaligus. Lanjutkan?")){
			<?php
				$db->addtable("ba_nego"); $db->where("procurement_work_id",$procurement_work_id); $db->order("id");
				foreach($db->fetch_data(true) as $key => $data){
					?> window.open("ba_nego_view.php?id=<?=$data["id"];?>"); <?php 
				} 
			?>
		}
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("ba_nego"); $db->where("procurement_work_id",$procurement_work_id); $db->delete_();
		$ba_nego_id = "";
		foreach($_POST["supplier_id"] as $key => $supplier_id){
			$db->addtable("ba_nego");	
			$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
			$db->addfield("supplier_id");			$db->addvalue($supplier_id);
			$db->addfield("nomor");					$db->addvalue($_POST["nomor"]);
			$db->addfield("tanggal");				$db->addvalue($_POST["tanggal"]);
			$db->addfield("harga");					$db->addvalue($_POST["harga"][$key]);
			$db->addfield("updated_at");			$db->addvalue(date("Y-m-d H:i:s"));
			$db->addfield("updated_by");			$db->addvalue($__username);
			$inserting = $db->insert();
			if($ba_nego_id == "") $ba_nego_id = $inserting["insert_id"];
		}
		javascript("alert('Data Saved');");
		javascript("window.location='?id=".$ba_nego_id."';");
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan","","procurement_works","id","name","win_procurement_works.php");
	$txt_nomor = $f->input("nomor","","style='width:300px;'");
	$txt_tanggal = $f->input("tanggal","","type='date'");
	
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";	
	
	$plusminbutton = $f->input("addrow","+","type='button' style='width:25px' onclick=\"adding_row('detail_area','row_detail_');\"")."&nbsp;";
	$plusminbutton .= $f->input("subrow","-","type='button' style='width:25px' onclick=\"substract_row('detail_area','row_detail_');\"");
	$sel_supplier = $f->select("supplier_id[0]",$db->fetch_select_data("suppliers","id","name",array(),array("name")),"");
	$txt_harga = $f->input("harga[0]","","type='number'");
	$btn_unduh = "<div id='btn_unduh[0]'></div>"
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
		<?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Nomor Dokumen Berita Acara",$txt_nomor));?>
        <?=$t->row(array("Tanggal Dokumen",$txt_tanggal));?>
        <?=$t->row(array("Kategori Pekerjaan","<div id='work_category' ".$datastyle."></div>"));?>
        <?=$t->row(array("Nomor Surat Penetapan HPS","<div id='hps_nomor' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS","<div id='hps_nominal' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS di approve Oleh","<div id='hps_ok_by' ".$datastyle."></div>"));?>
        <?=$t->row(array("Tanggal Approve","<div id='hps_ok_at' ".$datastyle."></div>"));?>
        <?=$t->row(array("Jangka Waktu Pekerjaan","<div id='work_days' ".$datastyle."></div>"));?>
        <?=$t->row(array("Pejabat Pembuat Komitmen","<div id='ppk_name' ".$datastyle."></div><div id='ppk_nip' ".$datastyle."></div>"));?>
	<?=$t->end();?>
	<br><b>Penyedia Barang/Jasa:</b></br>
	<?=$t->start("width='100%'","detail_area","editor_content_2");?>
        <?=$t->row(array($plusminbutton."<br>No.","Penyedia Barang/Jasa","Harga Penawaran",""),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"));?>
		<?=$t->row(array("<div id=\"firstno\">1</div>",$sel_supplier,$txt_harga,$btn_unduh),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"),"id=\"row_detail_0\"");?>
	<?=$t->end();?>
	<br>
	<?=$f->input("save","Simpan","type='submit'");?>
	<?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
	<?=$f->input("btn_download","Unduh Semua Dokumen","type='button' onclick='download_all_file();'");?>
	<?php $pokja_ulp_id = $db->fetch_single_data("pokja_ulp","id",array("procurement_work_id"=>$procurement_work_id));?>
	<?=$f->input("btn_penawaran","Buat BA Hasil Pengadaan Langsung","type='button' onclick='window.location=\"pokja_ulp_ba_hasil_add.php?pokja_ulp_id=".$pokja_ulp_id."\";'");?>
<?=$f->end();?>
<?php
	$nomor = $db->fetch_single_data("ba_nego","nomor",array("id" => $_GET["id"]));
	$tanggal = $db->fetch_single_data("ba_nego","tanggal",array("id" => $_GET["id"]));
	$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
	$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
?>
<script>	
	document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
	document.getElementById("nomor").value = "<?=$nomor;?>";
	document.getElementById("tanggal").value = "<?=$tanggal;?>";
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
</script>
<?php
	$db->addtable("ba_nego"); $db->where("procurement_work_id",$procurement_work_id); $db->order("id");
	foreach($db->fetch_data(true) as $key => $data){
		?><script>
			document.getElementById("supplier_id[<?=$key;?>]").value = "<?=$data["supplier_id"];?>";
			document.getElementById("harga[<?=$key;?>]").value = "<?=$data["harga"];?>";
			document.getElementById("btn_unduh[<?=$key;?>]").innerHTML = "<input type='button' value='Unduh Dokumen' onclick='download_file(\"<?=$data["id"];?>\")'>";
			adding_row('detail_area','row_detail_');
		</script><?php
	}
	?><script> substract_row('detail_area','row_detail_'); </script><?php
?>
<?php include_once "footer.php";?>