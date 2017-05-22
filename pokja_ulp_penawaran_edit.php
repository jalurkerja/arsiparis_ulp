<?php include_once "head.php";?>
<div class="bo_title">Ubah Surat Permintaan Penawaran Harga</div>
<script>
	function download_file(pokja_ulp_id,supplier_id){
		window.open("pokja_ulp_penawaran_view.php?pokja_ulp_id=" + pokja_ulp_id + "&supplier_id=" + supplier_id);
	}
	function download_all_file(pokja_ulp_id){
		if(confirm("Aplikasi ini akan mengunduh beberapa Dokumen sekaligus. Lanjutkan?")){
			<?php
				$penawaran_supplier_ids = pipetoarray($db->fetch_single_data("pokja_ulp","penawaran_supplier_ids",array("id" => $_GET["id"])));
				foreach($penawaran_supplier_ids as $key => $supplier_id){
					?> window.open("pokja_ulp_penawaran_view.php?pokja_ulp_id=" + pokja_ulp_id + "&supplier_id=<?=$supplier_id;?>"); <?php 
				} 
			?>
		}
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("pokja_ulp");				$db->where("id",$_GET["id"]);
		$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
		$db->addfield("penawaran_nomor");		$db->addvalue($_POST["penawaran_nomor"]);
		$db->addfield("penawaran_tanggal");		$db->addvalue($_POST["penawaran_tanggal"]);
		$db->addfield("penawaran_supplier_ids");$db->addvalue(sel_to_pipe($_POST["supplier_id"]));
		$db->addfield("penawaran_latest_at");	$db->addvalue($_POST["penawaran_latest_at"]);
		$db->addfield("penawaran_updated_at");	$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("penawaran_updated_by");	$db->addvalue($__username);
		$inserting = $db->update();
		if($inserting["affected_rows"] >= 0){
			echo "<font color='blue'><b>Data Saved</b></font>";
		} else {
			echo "<font color='red'><b>Saving data failed</b></font>";
		}
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan","","procurement_works","id","name","win_procurement_works.php");
	$txt_penawaran_nomor = $f->input("penawaran_nomor","","style='width:300px;'");
	$txt_penawaran_tanggal = $f->input("penawaran_tanggal","","type='date'");
	$txt_penawaran_latest_at = $f->input("penawaran_latest_at","","type='date'");
	
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";	
	
	$plusminbutton = $f->input("addrow","+","type='button' style='width:25px' onclick=\"adding_row('detail_area','row_detail_');\"")."&nbsp;";
	$plusminbutton .= $f->input("subrow","-","type='button' style='width:25px' onclick=\"substract_row('detail_area','row_detail_');\"");
	$sel_supplier = $f->select("supplier_id[0]",$db->fetch_select_data("suppliers","id","name",array(),array("name")),"");
	$btn_unduh = "<div id='btn_unduh[0]'></div>"
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
		<?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Nomor Surat Permintaan Penawaran Harga",$txt_penawaran_nomor));?>
        <?=$t->row(array("Tanggal Surat",$txt_penawaran_tanggal));?>
        <?=$t->row(array("Surat Penawaran Paling Lambat Tanggal",$txt_penawaran_latest_at));?>
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
        <?=$t->row(array($plusminbutton."<br>No.","Penyedia Barang/Jasa",""),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"));?>
		<?=$t->row(array("<div id=\"firstno\">1</div>",$sel_supplier,$btn_unduh),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"),"id=\"row_detail_0\"");?>
	<?=$t->end();?>
	<br>
	<?=$f->input("save","Simpan","type='submit'");?> 
	<?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
	<?=$f->input("btn_download","Unduh Semua Dokumen","type='button' onclick='download_all_file(\"".$_GET["id"]."\");'");?>
	<?=$f->input("btn_penawaran","Buat BA Pemasukan Penawaran","type='button' onclick='window.location=\"pokja_ulp_ba_pemasukan_add.php?pokja_ulp_id=".$_GET["id"]."\";'");?>
<?=$f->end();?>
<?php
	$penawaran_nomor = $db->fetch_single_data("pokja_ulp","penawaran_nomor",array("id" => $_GET["id"]));
	$penawaran_tanggal = $db->fetch_single_data("pokja_ulp","penawaran_tanggal",array("id" => $_GET["id"]));
	$penawaran_supplier_ids = pipetoarray($db->fetch_single_data("pokja_ulp","penawaran_supplier_ids",array("id" => $_GET["id"])));
	$penawaran_latest_at = $db->fetch_single_data("pokja_ulp","penawaran_latest_at",array("id" => $_GET["id"]));
	$procurement_work_id = $db->fetch_single_data("pokja_ulp","procurement_work_id",array("id" => $_GET["id"]));
	$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
	$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
?>
<script>	
	document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
	document.getElementById("penawaran_nomor").value = "<?=$penawaran_nomor;?>";
	document.getElementById("penawaran_tanggal").value = "<?=$penawaran_tanggal;?>";
	document.getElementById("penawaran_latest_at").value = "<?=$penawaran_latest_at;?>";
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
	foreach($penawaran_supplier_ids as $key => $supplier_id){
		?><script>
			document.getElementById("supplier_id[<?=$key;?>]").value = "<?=$supplier_id;?>";
			document.getElementById("btn_unduh[<?=$key;?>]").innerHTML = "<input type='button' value='Unduh Dokumen' onclick='download_file(\"<?=$_GET["id"];?>\",\"<?=$supplier_id;?>\")'>";
			adding_row('detail_area','row_detail_');
		</script><?php
	}
	?><script> substract_row('detail_area','row_detail_'); </script><?php
?>
<?php include_once "footer.php";?>