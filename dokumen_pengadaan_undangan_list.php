<?php include_once "head.php";?>
<div class="bo_title">Daftar Undangan Dokumen Pengadaan</div>
<script>
	function download_file(dokumen_pengadaan_id,supplier_id){
		if(confirm("Aplikasi ini hanya mengunduh Dokumen Pengadaan pada halaman Cover,BAB I dan BAB III sekaligus, dan untuk BAB yang lain tidak di unduh karena halaman lain memiliki kesamaan isi. Lanjutkan?")){
			// var arrpage = [1,2,3,4,5,6,7,8,9,10,11,12,13];
			var arrpage = [1,2,4];
			for (var i in arrpage) {
				window.open("dokumen_pengadaan_view.php?dokumen_pengadaan_id=" + dokumen_pengadaan_id + "&supplier_id=" + supplier_id + "&page=" + arrpage[i]);
			}
		}
	}
	function download_all_file(dokumen_pengadaan_id){
		if(confirm("Aplikasi ini akan mengunduh beberapa Dokumen sekaligus. Lanjutkan?")){
			var arrpage = [1,2,4];
			<?php
				$db->addtable("dokumen_pengadaan_undangan");$db->where("dokumen_pengadaan_id",$_GET["dokumen_pengadaan_id"]);$db->order("id");
				foreach($db->fetch_data(true) as $key => $data){ ?>	
					for (var i in arrpage) {
						window.open("dokumen_pengadaan_view.php?dokumen_pengadaan_id=" + dokumen_pengadaan_id + "&supplier_id=" + <?=$data["supplier_id"];?> + "&page=" + arrpage[i]);
					}
			<?php
				} 
			?>
		}
	}
</script>
<?php
	if(isset($_POST["save"])){
		$db->addtable("dokumen_pengadaan_undangan");$db->where("dokumen_pengadaan_id",$_GET["dokumen_pengadaan_id"]);$db->delete_();
		$nomor = $_POST["undangan_nomor"];
		$tanggal = $_POST["undangan_tanggal"];
		foreach($_POST["supplier_id"] as $key => $supplier_id){
			$db->addtable("dokumen_pengadaan_undangan");
			$db->addfield("dokumen_pengadaan_id");	$db->addvalue($_GET["dokumen_pengadaan_id"]);
			$db->addfield("supplier_id");			$db->addvalue($supplier_id);
			$db->addfield("nomor");					$db->addvalue($nomor);
			$db->addfield("tanggal");				$db->addvalue($tanggal);
			$db->addfield("updated_at");			$db->addvalue(date("Y-m-d H:i:s"));
			$db->addfield("updated_by");			$db->addvalue($__username);
			$db->addfield("updated_ip");			$db->addvalue($_SERVER["REMOTE_ADDR"]);
			$db->insert();
		}
	}
	$sel_procurement_work_id = $f->select_window("procurement_work_id","Pekerjaan","","procurement_works","id","name","win_procurement_works.php");
	$txt_nomor = $f->input("nomor","","style='width:300px;'");
	$txt_undangan_nomor = $f->input("undangan_nomor",$data["nomor"]);
	$txt_undangan_tanggal = $f->input("undangan_tanggal",$data["tanggal"],"type='date'");

	$datastyle = "style='min-width:400px;font-style: italic;font-weight: bold;'";

	$plusminbutton = $f->input("addrow","+","type='button' style='width:25px' onclick=\"adding_row('detail_area','row_detail_');\"")."&nbsp;";
	$plusminbutton .= $f->input("subrow","-","type='button' style='width:25px' onclick=\"substract_row('detail_area','row_detail_');\"");
	$sel_supplier = $f->select("supplier_id[0]",$db->fetch_select_data("suppliers","id","name",array(),array("name")),"");
	$btn_unduh = "<div id='btn_unduh[0]'></div>"
	
?>
<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
        <?=$t->row(array("Nomor Dokumen Pengadaan","<div id='nomor' ".$datastyle."></div>"));?>
        <?=$t->row(array("Nama Pekerjaan",$sel_procurement_work_id));?>
        <?=$t->row(array("Kategori Pekerjaan","<div id='work_category' ".$datastyle."></div>"));?>
        <?=$t->row(array("Nomor Surat Penetapan HPS","<div id='hps_nomor' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS","<div id='hps_nominal' ".$datastyle."></div>"));?>
        <?=$t->row(array("HPS di approve Oleh","<div id='hps_ok_by' ".$datastyle."></div>"));?>
        <?=$t->row(array("Tanggal Approve","<div id='hps_ok_at' ".$datastyle."></div>"));?>
        <?=$t->row(array("Jangka Waktu Pekerjaan","<div id='work_days' ".$datastyle."></div>"));?>
        <?=$t->row(array("Pejabat Pembuat Komitmen","<div id='ppk_name' ".$datastyle."></div><div id='ppk_nip' ".$datastyle."></div>"));?>
        <?=$t->row(array("Nomor Undangan",$txt_undangan_nomor));?>
        <?=$t->row(array("Tanggal Undangan",$txt_undangan_tanggal));?>
	<?=$t->end();?>
	<b>Daftar Undangan Perusahaan :</b><br>
	<?=$t->start("width='100%'","detail_area","editor_content_2");?>
        <?=$t->row(array($plusminbutton."<br>No.","Penyedia Barang/Jasa",""),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"));?>
		<?=$t->row(array("<div id=\"firstno\">1</div>",$sel_supplier,$btn_unduh),array("nowrap style='font-weight:bold;font-size:14px;text-align:center;'"),"id=\"row_detail_0\"");?>
	<?=$t->end();?>
	<br>
	<?=$f->input("save","Simpan","type='submit'");?>
	<?=$f->input("back","Kembali","type='button' onclick=\"window.location='dokumen_pengadaan_edit.php?id=".$_GET["dokumen_pengadaan_id"]."';\"");?>
	<?=$f->input("btn_download","Unduh Semua Dokumen","type='button' onclick='download_all_file(\"".$_GET["dokumen_pengadaan_id"]."\");'");?>
<?=$f->end();?>
<?php
	$undangan_nomor = $db->fetch_single_data("dokumen_pengadaan_undangan","nomor",array("dokumen_pengadaan_id" => $_GET["dokumen_pengadaan_id"]),array("id"));
	$undangan_tanggal = $db->fetch_single_data("dokumen_pengadaan_undangan","tanggal",array("dokumen_pengadaan_id" => $_GET["dokumen_pengadaan_id"]),array("id"));
	$nomor = $db->fetch_single_data("dokumen_pengadaan","nomor",array("id" => $_GET["dokumen_pengadaan_id"]));
	$procurement_work_id = $db->fetch_single_data("dokumen_pengadaan","procurement_work_id",array("id" => $_GET["dokumen_pengadaan_id"]));
	$procurement_work = $db->fetch_single_data("procurement_works","name",array("id" => $procurement_work_id));
	$db->addtable("procurement_works"); $db->where("id",$procurement_work_id);$db->limit(1);$data = $db->fetch_data();
	$work_category = $db->fetch_single_data("work_categories","name",array("id" => $data["work_category_id"]));
?>
<script>	
	document.getElementById("sw_caption_procurement_work_id").parentNode.childNodes[1].childNodes[0].style.display = "none";
	document.getElementById("nomor").innerHTML = "<?=$nomor;?>";
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
	document.getElementById("undangan_nomor").value = "<?=$undangan_nomor;?>";
	document.getElementById("undangan_tanggal").value = "<?=$undangan_tanggal;?>";
</script>
<?php
	$db->addtable("dokumen_pengadaan_undangan");$db->where("dokumen_pengadaan_id",$_GET["dokumen_pengadaan_id"]);$db->order("id");
	foreach($db->fetch_data(true) as $key => $data){
		?><script>
			document.getElementById("supplier_id[<?=$key;?>]").value = "<?=$data["supplier_id"];?>";
			document.getElementById("btn_unduh[<?=$key;?>]").innerHTML = "<input type='button' value='Unduh Dokumen' onclick='download_file(\"<?=$_GET["dokumen_pengadaan_id"];?>\",\"<?=$data["supplier_id"];?>\")'>";
			adding_row('detail_area','row_detail_');
		</script><?php
	}
	?><script> substract_row('detail_area','row_detail_'); </script><?php
?>
<?php include_once "footer.php";?>