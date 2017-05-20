<?php include_once "head.php";?>
<div class="bo_title">Tambah Pekerjaan</div>
<?php
	if(isset($_GET["hps_ok"])){
		$db->addtable("procurement_works");	$db->where("id",$_GET["id"]);
		$db->addfield("hps_ok");			$db->addvalue(1);
		$db->addfield("hps_ok_by");			$db->addvalue($__username);
		$db->addfield("hps_ok_at");			$db->addvalue($__now);
		$inserting = $db->update();
	}
	if(isset($_POST["save_hps"])){
		$db->addtable("procurement_works");	$db->where("id",$_GET["id"]);
		$db->addfield("hps_nomor");			$db->addvalue($_POST["hps_nomor"]);
		$db->addfield("hps_nominal");		$db->addvalue($_POST["hps_nominal"]);
		$db->addfield("hps_tanggal");		$db->addvalue($_POST["hps_tanggal"]);
		
		$db->addfield("hps_ok");			$db->addvalue(0);
		$db->addfield("hps_ok_by");			$db->addvalue("");
		$db->addfield("hps_ok_at");			$db->addvalue("");
		
		$db->addfield("updated_at");		$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("updated_by");		$db->addvalue($__username);
		$db->addfield("updated_ip");		$db->addvalue($_SERVER["REMOTE_ADDR"]);
		$inserting = $db->update();
		if($inserting["affected_rows"] >= 0){
			javascript("alert('Data Saved');");
		}
	}
	if(isset($_POST["save"])){
		$db->addtable("procurement_works");			$db->where("id",$_GET["id"]);
		$db->addfield("work_category_id");			$db->addvalue($_POST["work_category_id"]);
		$db->addfield("name");						$db->addvalue($_POST["name"]);
		$db->addfield("work_start");				$db->addvalue($_POST["work_start"]);
		$db->addfield("work_end");					$db->addvalue($_POST["work_end"]);
		$db->addfield("work_days");					$db->addvalue($_POST["work_days"]);
		$db->addfield("work_days_type");			$db->addvalue($_POST["work_days_type"]);
		$db->addfield("ppk_name");					$db->addvalue($_POST["ppk_name"]);
		$db->addfield("ppk_nip");					$db->addvalue($_POST["ppk_nip"]);
		$db->addfield("tahun_anggaran");			$db->addvalue($_POST["tahun_anggaran"]);
		$db->addfield("sumber_pendanaan");			$db->addvalue($_POST["sumber_pendanaan"]);
		$db->addfield("masa_berlaku_penawaran");	$db->addvalue($_POST["masa_berlaku_penawaran"]);
		$db->addfield("siup_penyedia");				$db->addvalue($_POST["siup_penyedia"]);
		$db->addfield("updated_at");				$db->addvalue(date("Y-m-d H:i:s"));
		$db->addfield("updated_by");				$db->addvalue($__username);
		$db->addfield("updated_ip");				$db->addvalue($_SERVER["REMOTE_ADDR"]);
		$inserting = $db->update();
		if($inserting["affected_rows"] >= 0){
			$procurement_work_id = $_GET["id"];
			$db->addtable("procurement_work_pokja"); $db->where("procurement_work_id",$procurement_work_id); $db->delete_();
			foreach($_POST["pokja_name"] as $key => $pokja_name){
				$db->addtable("procurement_work_pokja");	
				$db->addfield("procurement_work_id");	$db->addvalue($procurement_work_id);
				$db->addfield("pokja_name");			$db->addvalue($pokja_name);
				$db->addfield("pokja_nip");				$db->addvalue($_POST["pokja_nip"][$key]);
				$db->insert();
			}
			javascript("alert('Data Saved');");
		} else {
			javascript("alert('Saving data failed');");
		}
	}
	
	$db->addtable("procurement_works"); $db->where("id",$_GET["id"]); $procurement_work = $db->fetch_data();
	
	$sumber_pendanaan = ($procurement_work["sumber_pendanaan"] == "") ? "DIPA Satker Balai Pendidikan dan Pelatihan Ilmu Pelayaran (BP2IP) Tangerang Tahun Anggaran 2017 Nomor SP DIPA-022.12.1.654603/2017" : $procurement_work["sumber_pendanaan"];
	
	$work_category_id 		= $f->select("work_category_id",$db->fetch_select_data("work_categories","id","name"),$procurement_work["work_category_id"],"style='height:22px;'");
	$name 					= $f->input("name",$procurement_work["name"],"size='50'");
	$work_start 			= $f->input("work_start",$procurement_work["work_start"],"type='date'");
	$work_end 				= $f->input("work_end",$procurement_work["work_end"],"type='date'");
	$work_days				= $f->input("work_days",$procurement_work["work_days"],"style='width:40px;' type='number'")."&nbsp;&nbsp;".$f->select("work_days_type",array("1"=>"Hari Kalender","2"=>"Hari Kerja"));
	$ppk_name 				= $f->input("ppk_name",$procurement_work["ppk_name"],"size='50'");
	$ppk_nip 				= $f->input("ppk_nip",$procurement_work["ppk_nip"],"size='50'");
	$tahun_anggaran			= $f->input("tahun_anggaran",$procurement_work["tahun_anggaran"],"size='4'");
	$sumber_pendanaan		= $f->textarea("sumber_pendanaan",$sumber_pendanaan);
	$masa_berlaku_penawaran	= $f->input("masa_berlaku_penawaran",$procurement_work["masa_berlaku_penawaran"],"style='width:40px;' type='number'");
	$siup_penyedia			= $f->input("siup_penyedia",$procurement_work["siup_penyedia"]);
?>

<?=$f->start("","POST","","enctype='multipart/form-data'");?>
	<?=$t->start("","editor_content");?>
         <?=$t->row(array("Kategori Pekerjaan",$work_category_id));?>
         <?=$t->row(array("Nama Pekerjaan",$name));?>
         <?=$t->row(array("Jangka waktu penyelesaian",$work_days));?>
         <?=$t->row(array("",$work_start." s/d ".$work_end));?>
         <?=$t->row(array("Nama PPK",$ppk_name));?>
         <?=$t->row(array("NIP PPK",$ppk_nip));?>
         <?=$t->row(array("Tahun Anggaran",$tahun_anggaran));?>
         <?=$t->row(array("Sumber Pendanaan",$sumber_pendanaan));?>
         <?=$t->row(array("Masa berlaku surat penawaran",$masa_berlaku_penawaran));?>
         <?=$t->row(array("Bidang Usaha Syarat Penyedia",$siup_penyedia));?>
	<?=$t->end();?>
	<br><b>POKJA :</b></br>
	<?=$t->start("","editor_content");?>
         <?=$t->header(array("No","Nama","NIP"));?>
		 <?php
			$db->addtable("procurement_work_pokja"); $db->where("procurement_work_id",$_GET["id"]); $db->order("id");
			foreach($db->fetch_data(true) as $xx => $procurement_work_pokja){
				$txt_pokja_name = $f->input("pokja_name[".$xx."]",$procurement_work_pokja["pokja_name"],"size='50'");
				$txt_pokja_nip = $f->input("pokja_nip[".$xx."]",$procurement_work_pokja["pokja_nip"],"size='50'");
				echo $t->row(array($xx+1,$txt_pokja_name,$txt_pokja_nip));
			}
		 ?>
	<?=$t->end();?>
	<?php 
		if($procurement_work["hps_nomor"] || isset($_GET["buat_surat_penetapan_hps"])){
			$txt_hps_nomor = $f->input("hps_nomor",$procurement_work["hps_nomor"],"size='50'");
			$txt_hps_tanggal = $f->input("hps_tanggal",$procurement_work["hps_tanggal"],"type='date'");
			$txt_hps_nominal = $f->input("hps_nominal",$procurement_work["hps_nominal"],"type='number'");
			echo "<br><fieldset style='width:600px;'><legend><b>Surat Penetapan HPS</b></legend>";
			echo $t->start("","editor_content");
			echo $t->row(array("Nomor Surat",$txt_hps_nomor));
			echo $t->row(array("Tanggal Surat",$txt_hps_tanggal));
			echo $t->row(array("Harga Perkiraan Sementara",$txt_hps_nominal));
			echo $t->end();
			echo "<br>";
			if($procurement_work["hps_ok"]){
				echo $f->input("savebtn","Simpan Surat Penetapan HPS","type='button' onclick=\"if(confirm('Jika dokumen ini di simpan ulang, Maka Approval HPS akan di batalkan. Lanjutkan?')){save_hps.click();}\"");
				echo $f->input("save_hps","save_hps","type='submit' style='display:none;'");
			} else {
				echo $f->input("save_hps","Simpan Surat Penetapan HPS","type='submit'");
			}
			if($procurement_work["hps_nomor"]) 
				echo "&nbsp;&nbsp;".$f->input("view_surat_penetapan_hps","Lihat Surat Penetapan HPS","type='button' onclick=\"window.open('procurement_work_hps_view.php?id=".$_GET["id"]."');\"");
			if(!$procurement_work["hps_ok"]) 
				echo "&nbsp;&nbsp;".$f->input("hps_ok","Approve HPS","type='button' onclick=\"if(confirm('Anda yakin untuk approve HPS ini?')){ window.location='?id=".$_GET["id"]."&hps_ok=1';}\"");
			else
				echo "<br><br><b>HPS telah di approve<br>oleh ".$db->fetch_single_data("users","name",array("email"=>$procurement_work["hps_ok_by"]))."<br>pada tanggal ".format_tanggal($procurement_work["hps_ok_at"],"dMY")."</b>";
				
			
			echo "</fieldset><br><br>";
		}
		if(!$procurement_work["hps_nomor"] && !isset($_GET["buat_surat_penetapan_hps"])){
			echo "<br>";
			echo $f->input("buat_surat_penetapan_hps","Buat Surat Penetapan HPS","type='button' onclick=\"window.location='?id=".$_GET["id"]."&buat_surat_penetapan_hps=1';\"");
			echo "<br><br>";
		}
	?>
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_edit","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php include_once "footer.php";?>