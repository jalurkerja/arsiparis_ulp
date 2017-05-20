<?php include_once "head.php";?>
<?php
	if($_GET["deleting"]){
		$db->addtable("surat_perintah_pengadaan");
		$db->where("id",$_GET["deleting"]);
		$db->delete_();
		$db->addtable("surat_perintah_pengadaan_detail");
		$db->where("surat_perintah_pengadaan_id",$_GET["deleting"]);
		$db->delete_();
		?> <script> swindow.location="?";</script> <?php
	}
?>
<div class="bo_title">Surat Perintah Pengadaan Barang/Jasa</div>
<div id="bo_expand" onclick="toogle_bo_filter();">[+] View Filter</div>
<div id="bo_filter">
	<div id="bo_filter_container">
		<?=$f->start("filter","GET");?>
			<?=$t->start();?>
			<?php
				$procurement_work_id = $f->select("procurement_work_id",$db->fetch_select_data("procurement_works","id","name",array(),array("id DESC"),"",true),@$_GET["work_category_id"],"style='height:22px;'");
				$nomor = $f->input("nomor",$_GET["nomor"]);
				$tanggal = $f->input("tanggal",$_GET["tanggal"],"type='date'");
			?>
			     <?=$t->row(array("Nama Pekerjaan Pengadaan",$procurement_work_id));?>
			     <?=$t->row(array("Nomor Surat",$nomor));?>
			     <?=$t->row(array("Tanggal Surat",$tanggal));?>
           
			<?=$t->end();?>
			<?=$f->input("page","1","type='hidden'");?>
			<?=$f->input("sort",@$_GET["sort"],"type='hidden'");?>
			<?=$f->input("do_filter","Load","type='submit'");?>
			<?=$f->input("reset","Reset","type='button' onclick=\"window.location='?';\"");?>
		<?=$f->end();?>
	</div>
</div>

<?php
	$whereclause = "";
	if(@$_GET["procurement_work_id"]!="") 		$whereclause .= "procurement_work_id = '".$_GET["procurement_work_id"]."' AND ";
	if(@$_GET["nomor"]!="") 					$whereclause .= "nomor LIKE '%".$_GET["nomor"]."%' AND ";
	if(@$_GET["tanggal"]!="") 					$whereclause .= "tanggal LIKE '%".$_GET["tanggal"]."%' AND ";
   	
	$db->addtable("surat_perintah_pengadaan");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($_max_counting);
	$maxrow = count($db->fetch_data(true));
	$start = getStartRow(@$_GET["page"],$_rowperpage);
	$paging = paging($_rowperpage,$maxrow,@$_GET["page"],"paging");
	
	$db->addtable("surat_perintah_pengadaan");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($start.",".$_rowperpage);
	if(@$_GET["sort"] != "") $db->order($_GET["sort"]);
	$surat_perintah_pengadaan = $db->fetch_data(true);
?>

	<?=$f->input("add","Tambah","type='button' onclick=\"window.location='surat_perintah_pengadaan_add.php';\"");?>
	<?=$paging;?>
	<?=$t->start("","data_content");?>
	<?=$t->header(array("No",
						"<div onclick=\"sorting('id');\">ID</div>",
						"<div onclick=\"sorting('nomor');\">Nomor Surat</div>",
						"<div onclick=\"sorting('tanggal');\">Tanggal<br>Surat</div>",
						"Kategori Pekerjaan",
						"<div onclick=\"sorting('procurement_work_id');\">Nama Pekerjaan</div>",
						"Nama PPK",
						"Tahun<br>Anggaran",
						"Jangka<br>Waktu",
						"HPS",
						""));?>
	<?php foreach($surat_perintah_pengadaan as $no => $_surat_perintah_pengadaan){ ?>
		<?php
			$actions = "<a href=\"surat_perintah_pengadaan_edit.php?id=".$_surat_perintah_pengadaan["id"]."\">Ubah</a> |
						<a href='#' onclick=\"if(confirm('Are You sure to delete this data?')){window.location='?deleting=".$_surat_perintah_pengadaan["id"]."';}\">Hapus</a>
						";
            $work_category_id = $db->fetch_single_data("procurement_works","work_category_id",array("id"=>$_surat_perintah_pengadaan["procurement_work_id"]));
            $work_category = $db->fetch_single_data("work_categories","name",array("id"=>$work_category_id));
			$ppk_name = $db->fetch_single_data("procurement_works","ppk_name",array("id"=>$_surat_perintah_pengadaan["procurement_work_id"]));
			$ppk_nip = $db->fetch_single_data("procurement_works","ppk_nip",array("id"=>$_surat_perintah_pengadaan["procurement_work_id"]));
			$tahun_anggaran = $db->fetch_single_data("procurement_works","tahun_anggaran",array("id"=>$_surat_perintah_pengadaan["procurement_work_id"]));
			$work_days = $db->fetch_single_data("procurement_works","work_days",array("id"=>$_surat_perintah_pengadaan["procurement_work_id"]));
			$hps_nominal = $db->fetch_single_data("procurement_works","hps_nominal",array("id"=>$_surat_perintah_pengadaan["procurement_work_id"]));
			$procurement_work = $db->fetch_single_data("procurement_works","name",array("id"=>$_surat_perintah_pengadaan["procurement_work_id"]));
			// $supplier = $db->fetch_single_data("suppliers","name",array("id"=>$_surat_perintah_pengadaan["supplier_id"]));
		?>
		<?=$t->row(
					array($no+$start+1,
						"<a href=\"surat_perintah_pengadaan_edit.php?id=".$_surat_perintah_pengadaan["id"]."\">".$_surat_perintah_pengadaan["id"]."</a>",
						"<a href=\"surat_perintah_pengadaan_edit.php?id=".$_surat_perintah_pengadaan["id"]."\">".$_surat_perintah_pengadaan["nomor"]."</a>",
						"<a href=\"surat_perintah_pengadaan_edit.php?id=".$_surat_perintah_pengadaan["id"]."\">".format_tanggal($_surat_perintah_pengadaan["tanggal"])."</a>",
						"<a href=\"surat_perintah_pengadaan_edit.php?id=".$_surat_perintah_pengadaan["id"]."\">".$work_category."</a>",
                        "<a href=\"surat_perintah_pengadaan_edit.php?id=".$_surat_perintah_pengadaan["id"]."\">".$procurement_work."</a>",
                        $ppk_name."<br>".$ppk_nip,
                        $tahun_anggaran,
                        $work_days,
                        format_amount($hps_nominal),
						$actions),
					array("align='right' valign='top'","")
				);?>
	<?php } ?>
	<?=$t->end();?>
	<?=$paging;?>
<?php include_once "footer.php";?>