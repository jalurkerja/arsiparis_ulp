<?php include_once "head.php";?>
<div class="bo_title">Tambah Pekerjaan</div>
<?php
	if(isset($_POST["save"])){
		if($db->fetch_single_data("procurement_works","id",array("name" => str_replace(" ","%",$_POST["name"]).":LIKE")) > 0){
			javascript("alert('Nama Pekerjaan sudah pernah digunakan');");
		} else {
			$db->addtable("procurement_works");	
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
			$inserting = $db->insert();
			if($inserting["affected_rows"] >= 0){
				$procurement_work_id = $inserting["insert_id"];
				foreach($_POST["pokja_name"] as $key => $pokja_name){
					if($pokja_name != ""){
						$db->addtable("procurement_work_pokja");	
						$db->addfield("procurement_work_id");	$db->addvalue($procurement_work_id);
						$db->addfield("pokja_name");			$db->addvalue($pokja_name);
						$db->addfield("pokja_nip");				$db->addvalue($_POST["pokja_nip"][$key]);
						$db->insert();
					}
				}
				javascript("alert('Data Saved');");
				javascript("window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';");
			} else {
				javascript("alert('Saving data failed');");
			}
		}
	}
	
	$sumber_pendanaan = (!isset($_POST["sumber_pendanaan"])) ? "DIPA Satker Balai Pendidikan dan Pelatihan Ilmu Pelayaran (BP2IP) Tangerang Tahun Anggaran 2017 Nomor SP DIPA-022.12.1.654603/2017" : $_POST["sumber_pendanaan"];
	
	$work_category_id 		= $f->select("work_category_id",$db->fetch_select_data("work_categories","id","name"),@$_GET["work_category_id"],"style='height:22px;'");
	$name 					= $f->input("name","","size='50'");
	$work_start 			= $f->input("work_start","","type='date'");
	$work_end 				= $f->input("work_end","","type='date'");
	$work_days				= $f->input("work_days","","style='width:40px;' type='number'")."&nbsp;&nbsp;".$f->select("work_days_type",array("1"=>"Hari Kalender","2"=>"Hari Kerja"));
	$ppk_name 				= $f->input("ppk_name","","size='50'");
	$ppk_nip 				= $f->input("ppk_nip","","size='50'");
	$tahun_anggaran			= $f->input("tahun_anggaran","","size='4'");
	$sumber_pendanaan		= $f->textarea("sumber_pendanaan",$sumber_pendanaan);
	$masa_berlaku_penawaran	= $f->input("masa_berlaku_penawaran","","style='width:40px;' type='number'");
	$siup_penyedia			= $f->input("siup_penyedia","");
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
			for($xx = 0; $xx < 5; $xx++){
				$txt_pokja_name = $f->input("pokja_name[".$xx."]","","size='50'");
				$txt_pokja_nip = $f->input("pokja_nip[".$xx."]","","size='50'");
				echo $t->row(array($xx+1,$txt_pokja_name,$txt_pokja_nip));
			}
		 ?>
	<?=$t->end();?>
	<br>
	<?=$f->input("save","Simpan","type='submit'");?> <?=$f->input("back","Kembali","type='button' onclick=\"window.location='".str_replace("_add","_list",$_SERVER["PHP_SELF"])."';\"");?>
<?=$f->end();?>
<?php include_once "footer.php";?>