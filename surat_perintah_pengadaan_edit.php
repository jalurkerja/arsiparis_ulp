<?php include_once "head.php";?>
<div class="bo_title">Ubah Surat Perintah Pengadaan Barang/Jasa</div>
<script>
	function download_file(surat_perintah_pengadaan_id){
		if(confirm("Aplikasi ini akan mengunduh beberapa Dokumen sekaligus. Lanjutkan?")){
			var arrpage = [1,2];
			for (var i in arrpage) {
				window.open("surat_perintah_pengadaan_view.php?surat_perintah_pengadaan_id=" + surat_perintah_pengadaan_id + "&page=" + arrpage[i]);
			}
		}
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("surat_perintah_pengadaan");	$db->where("id",$_GET["id"]);
		$db->addfield("procurement_work_id");		$db->addvalue($_POST["procurement_work_id"]);
		$db->addfield("nomor");						$db->addvalue($_POST["nomor"]);
		$db->addfield("tanggal");					$db->addvalue($_POST["tanggal"]);
		// $db->addfield("supplier_id");				$db->addvalue($_POST["supplier_id"]);
		$db->addfield("updated_at");				$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("updated_by");				$db->addvalue($__username);
		$db->addfield("updated_ip");				$db->addvalue($_SERVER["REMOTE_ADDR"]);
		$inserting = $db->update();
		if($inserting["affected_rows"] >= 0){
			$surat_perintah_pengadaan_id = $_GET["id"];
			$db->addtable("surat_perintah_pengadaan_detail");$db->where("surat_perintah_pengadaan_id",$surat_perintah_pengadaan_id);$db->delete_();
			foreach($_POST["nama_barang"] as $key => $nama_barang){
				$db->addtable("surat_perintah_pengadaan_detail");	
				$db->addfield("surat_perintah_pengadaan_id");	$db->addvalue($surat_perintah_pengadaan_id);
				$db->addfield("nama_barang");					$db->addvalue($nama_barang);
				$db->addfield("jumlah");						$db->addvalue($_POST["jumlah"][$key]);
				$db->addfield("satuan");						$db->addvalue($_POST["satuan"][$key]);
				$db->insert();
			}
			echo "<font color='blue'><b>Data Saved</b></font>";
		} else {
			javascript("alert('Saving data failed');");
		}
	}
	
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan","","procurement_works","id","name","win_procurement_works.php");
	$txt_nomor = $f->input("nomor","","style='width:300px;'");
	$txt_tanggal = $f->input("tanggal","","type='date'");
	// $sel_supplier = $f->select("supplier_id",$db->fetch_select_data("suppliers","id","name",array(),array("name")),"");
	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";
	
	$plusminbutton = $f->input("addrow","+","type='button' style='width:25px' onclick=\"adding_row('detail_area','row_detail_');\"")."&nbsp;";
	$plusminbutton .= $f->input("subrow","-","type='button' style='width:25px' onclick=\"substract_row('detail_area','row_detail_');\"");
	$txt_nama_barang = $f->input("nama_barang[0]","","style='width:300px;'");
	$txt_jumlah = $f->input("jumlah[0]","","type='number'");
	$txt_satuan = $f->input("satuan[0]");
	
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
        <?=$t->row(array("Nomor Surat Perintah Pengadaan Barang/Jasa",$txt_nomor));?>
        <?=$t->row(array("Tanggal Surat Perintah Pengadaan Barang/Jasa",$txt_tanggal));?>
        <?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Kategori Pekerjaan","<div id='work_category' ".$datastyle."></div>"));?>
        <?=$t->row(array("Nomor Surat Penetapan HPS","<div id='hps_nomor' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS","<div id='hps_nominal' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS di approve Oleh","<div id='hps_ok_by' ".$datastyle."></div>"));?>
        <?=$t->row(array("Tanggal Approve","<div id='hps_ok_at' ".$datastyle."></div>"));?>
        <?=$t->row(array("Jangka Waktu Pekerjaan","<div id='work_days' ".$datastyle."></div>"));?>
        <?=$t->row(array("Pejabat Pembuat Komitmen","<div id='ppk_name' ".$datastyle."></div><div id='ppk_nip' ".$datastyle."></div>"));?>
	<?=$t->end();?>
	<br>
	<b>Daftar Paket Pekerjaan</b><br>
	<?=$t->start("width='100%'","detail_area","editor_content_2");?>
        <?=$t->row(array($plusminbutton."<br>No.","Nama Barang","Jumlah","Satuan"),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"));?>
		<?=$t->row(array("<div id=\"firstno\">1</div>",$txt_nama_barang,$txt_jumlah,$txt_satuan),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"),"id=\"row_detail_0\"");?>
	<?=$t->end();?>
	<br>
	<?=$f->input("save","Simpan","type='submit'");?> 
	<?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_edit","_list",$_SERVER["PHP_SELF"])."';\"");?>
	<?=$f->input("btn_download","Unduh Dokumen","type='button' onclick='download_file(\"".$_GET["id"]."\");'");?>
<?=$f->end();?>
<?php
	$nomor = $db->fetch_single_data("surat_perintah_pengadaan","nomor",array("id" => $_GET["id"]));
	$tanggal = $db->fetch_single_data("surat_perintah_pengadaan","tanggal",array("id" => $_GET["id"]));
	// $supplier_id = $db->fetch_single_data("surat_perintah_pengadaan","supplier_id",array("id" => $_GET["id"]));
	$procurement_work_id = $db->fetch_single_data("surat_perintah_pengadaan","procurement_work_id",array("id" => $_GET["id"]));
	$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
	$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
?>
<script>	
	document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
	document.getElementById("nomor").value = "<?=$nomor;?>";
	document.getElementById("tanggal").value = "<?=$tanggal;?>";
	// document.getElementById("supplier_id").value = "<?=$supplier_id;?>";
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
	$db->addtable("surat_perintah_pengadaan_detail"); $db->where("surat_perintah_pengadaan_id",$_GET["id"]);
	foreach($db->fetch_data(true) as $key => $data){
		?><script>
			document.getElementById("nama_barang[<?=$key;?>]").value = "<?=$data["nama_barang"];?>";
			document.getElementById("jumlah[<?=$key;?>]").value = "<?=$data["jumlah"];?>";
			document.getElementById("satuan[<?=$key;?>]").value = "<?=$data["satuan"];?>";
			adding_row('detail_area','row_detail_');
		</script><?php
	}
	?><script> substract_row('detail_area','row_detail_'); </script><?php
?>
<?php include_once "footer.php";?>