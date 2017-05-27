<?php include_once "head.php";?>
<div class="bo_title">Ubah Undangan Negosiasi</div>
<script>
	function download_file(pokja_ulp_id,supplier_id){
		window.open("pokja_ulp_nego_view.php?pokja_ulp_id=" + pokja_ulp_id + "&supplier_id=" + supplier_id);
	}
	function download_all_file(pokja_ulp_id){
		if(confirm("Aplikasi ini akan mengunduh beberapa Dokumen sekaligus. Lanjutkan?")){
			<?php
				$nego_supplier_ids = pipetoarray($db->fetch_single_data("pokja_ulp","nego_supplier_ids",array("id" => $_GET["id"])));
				foreach($nego_supplier_ids as $key => $supplier_id){
					?> window.open("pokja_ulp_nego_view.php?pokja_ulp_id=" + pokja_ulp_id + "&supplier_id=<?=$supplier_id;?>"); <?php 
				} 
			?>
		}
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("pokja_ulp");				$db->where("id",$_GET["id"]);
		$db->addfield("procurement_work_id");	$db->addvalue($_POST["procurement_work_id"]);
		$db->addfield("nego_nomor");			$db->addvalue($_POST["nego_nomor"]);
		$db->addfield("nego_tanggal");			$db->addvalue($_POST["nego_tanggal"]);
		$db->addfield("nego_supplier_ids");		$db->addvalue(sel_to_pipe($_POST["supplier_id"]));
		$db->addfield("nego_undang_tgl");		$db->addvalue($_POST["nego_undang_tgl"]);
		$db->addfield("nego_undang_jam");		$db->addvalue($_POST["nego_undang_jam"]);
		$db->addfield("nego_undang_tempat");	$db->addvalue($_POST["nego_undang_tempat"]);
		$db->addfield("nego_updated_at");		$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("nego_updated_by");		$db->addvalue($__username);
		$inserting = $db->update();
		if($inserting["affected_rows"] >= 0){
			echo "<font color='blue'><b>Data Saved</b></font>";
		} else {
			echo "<font color='red'><b>Saving data failed</b></font>";
		}
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan",@$_POST["procurement_work_id"],"procurement_works","id","name","win_procurement_works.php");
	$txt_nego_nomor = $f->input("nego_nomor","","style='width:300px;'");
	$txt_nego_tanggal = $f->input("nego_tanggal","","type='date'");
	$txt_nego_undang_tgl = $f->input("nego_undang_tgl","","type='date'");
	$txt_nego_undang_jam = $f->input("nego_undang_jam","09:00","type='time'");
	$txt_nego_undang_tempat = $f->textarea("nego_undang_tempat",$db->fetch_single_data("pokja_ulp","nego_undang_tempat",array("id" => $_GET["id"])));
	
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";	
	
	$plusminbutton = $f->input("addrow","+","type='button' style='width:25px' onclick=\"adding_row('detail_area','row_detail_');\"")."&nbsp;";
	$plusminbutton .= $f->input("subrow","-","type='button' style='width:25px' onclick=\"substract_row('detail_area','row_detail_');\"");
	$sel_supplier = $f->select("supplier_id[0]",$db->fetch_select_data("suppliers","id","name",array(),array("name")),"");
	$btn_unduh = "<div id='btn_unduh[0]'></div>";
	$procurement_work_id = $db->fetch_single_data("pokja_ulp","procurement_work_id",array("id" => $_GET["id"]));
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
		<?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Nomor Surat Undangan",$txt_nego_nomor));?>
        <?=$t->row(array("Tanggal Surat Undangan",$txt_nego_tanggal));?>
        <?=$t->row(array("Diundang pada tanggal",$txt_nego_undang_tgl));?>
        <?=$t->row(array("Diundang pada jam",$txt_nego_undang_jam));?>
        <?=$t->row(array("Diundang bertempat di",$txt_nego_undang_tempat));?>
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
	<?=$f->input("btn_ba_pembukaan","Buat BA Negosiasi Harga","type='button' onclick='window.location=\"ba_nego_add.php?pokja_ulp_id=".$_GET["id"]."\";'");?>
<?=$f->end();?>
<?php
	$nego_nomor = $db->fetch_single_data("pokja_ulp","nego_nomor",array("id" => $_GET["id"]));
	$nego_tanggal = $db->fetch_single_data("pokja_ulp","nego_tanggal",array("id" => $_GET["id"]));
	$nego_undang_tgl = $db->fetch_single_data("pokja_ulp","nego_undang_tgl",array("id" => $_GET["id"]));
	$nego_undang_jam = $db->fetch_single_data("pokja_ulp","nego_undang_jam",array("id" => $_GET["id"]));
	$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
	$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
?>
<script>	
	document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
	document.getElementById("nego_nomor").value = "<?=$nego_nomor;?>";
	document.getElementById("nego_tanggal").value = "<?=$nego_tanggal;?>";
	document.getElementById("nego_undang_tgl").value = "<?=$nego_undang_tgl;?>";
	document.getElementById("nego_undang_jam").value = "<?=$nego_undang_jam;?>";
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
	$nego_supplier_ids = pipetoarray($db->fetch_single_data("pokja_ulp","nego_supplier_ids",array("id" => $_GET["id"])));
	foreach($nego_supplier_ids as $key => $supplier_id){
		?><script>
			document.getElementById("supplier_id[<?=$key;?>]").value = "<?=$supplier_id;?>";
			document.getElementById("btn_unduh[<?=$key;?>]").innerHTML = "<input type='button' value='Unduh Dokumen' onclick='download_file(\"<?=$_GET["id"];?>\",\"<?=$supplier_id;?>\")'>";
			adding_row('detail_area','row_detail_');
		</script><?php
	}
	?><script> substract_row('detail_area','row_detail_'); </script><?php
?>
<?php include_once "footer.php";?>