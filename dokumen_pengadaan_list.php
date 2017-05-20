<?php include_once "head.php";?>
<?php
	if($_GET["deleting"]){
		$db->addtable("dokumen_pengadaan_kegiatan");
		$db->where("procurement_work_id","(SELECT procurement_work_id FROM dokumen_pengadaan WHERE id='".$_GET["deleting"]."')","","IN");
		$db->delete_();
		$db->addtable("dokumen_pengadaan");
		$db->where("id",$_GET["deleting"]);
		$db->delete_();
		$db->addtable("dokumen_pengadaan_undangan");
		$db->where("dokumen_pengadaan_id",$_GET["deleting"]);
		$db->delete_();
		?> <script> swindow.location="?";</script> <?php
	}
?>
<div class="bo_title">Dokumen Pengadaan</div>
<div id="bo_expand" onclick="toogle_bo_filter();">[+] View Filter</div>
<div id="bo_filter">
	<div id="bo_filter_container">
		<?=$f->start("filter","GET");?>
			<?=$t->start();?>
			<?php
				$procurement_work_id = $f->select("procurement_work_id",$db->fetch_select_data("procurement_works","id","name",array(),array("id DESC"),"",true),@$_GET["work_category_id"],"style='height:22px;'");
			?>
			     <?=$t->row(array("Nama Pekerjaan Pengadaan",$procurement_work_id));?>
           
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
	if(@$_GET["procurement_work_id"]!="") 		$whereclause .= "(procurement_work_id = '".$_GET["procurement_work_id"]."') AND ";
   	
	$db->addtable("dokumen_pengadaan");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($_max_counting);
	$maxrow = count($db->fetch_data(true));
	$start = getStartRow(@$_GET["page"],$_rowperpage);
	$paging = paging($_rowperpage,$maxrow,@$_GET["page"],"paging");
	
	$db->addtable("dokumen_pengadaan");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($start.",".$_rowperpage);
	if(@$_GET["sort"] != "") $db->order($_GET["sort"]);
	$dokumen_pengadaan = $db->fetch_data(true);
?>

	<?=$f->input("add","Tambah","type='button' onclick=\"window.location='dokumen_pengadaan_add.php';\"");?>
	<?=$paging;?>
	<?=$t->start("","data_content");?>
	<?=$t->header(array("No",
						"<div onclick=\"sorting('id');\">ID</div>",
						"Kategori Pekerjaan",
						"<div onclick=\"sorting('procurement_work_id');\">Nama Pekerjaan</div>",
						"<div onclick=\"sorting('ppk_name');\">Nama PPK</div>",
						"<div onclick=\"sorting('tahun_anggaran');\">Tahun<br>Anggaran</div>",
						"<div onclick=\"sorting('work_days');\">Jangka<br>Waktu</div>",
						"<div onclick=\"sorting('hps_nominal');\">HPS</div>",
						""));?>
	<?php foreach($dokumen_pengadaan as $no => $_dokumen_pengadaan){ ?>
		<?php
			$actions = "<a href=\"dokumen_pengadaan_edit.php?id=".$_dokumen_pengadaan["id"]."\">Ubah</a> |
						<a href='#' onclick=\"if(confirm('Are You sure to delete this data?')){window.location='?deleting=".$_dokumen_pengadaan["id"]."';}\">Hapus</a>
						";
            $work_category_id = $db->fetch_single_data("procurement_works","work_category_id",array("id"=>$_dokumen_pengadaan["procurement_work_id"]));
            $work_category = $db->fetch_single_data("work_categories","name",array("id"=>$work_category_id));
			$ppk_name = $db->fetch_single_data("procurement_works","ppk_name",array("id"=>$_dokumen_pengadaan["procurement_work_id"]));
			$ppk_nip = $db->fetch_single_data("procurement_works","ppk_nip",array("id"=>$_dokumen_pengadaan["procurement_work_id"]));
			$tahun_anggaran = $db->fetch_single_data("procurement_works","tahun_anggaran",array("id"=>$_dokumen_pengadaan["procurement_work_id"]));
			$work_days = $db->fetch_single_data("procurement_works","work_days",array("id"=>$_dokumen_pengadaan["procurement_work_id"]));
			$hps_nominal = $db->fetch_single_data("procurement_works","hps_nominal",array("id"=>$_dokumen_pengadaan["procurement_work_id"]));
			$procurement_work = $db->fetch_single_data("procurement_works","name",array("id"=>$_dokumen_pengadaan["procurement_work_id"]));
		?>
		<?=$t->row(
					array($no+$start+1,
						"<a href=\"dokumen_pengadaan_edit.php?id=".$_dokumen_pengadaan["id"]."\">".$_dokumen_pengadaan["id"]."</a>",
						"<a href=\"dokumen_pengadaan_edit.php?id=".$_dokumen_pengadaan["id"]."\">".$work_category."</a>",
                        "<a href=\"dokumen_pengadaan_edit.php?id=".$_dokumen_pengadaan["id"]."\">".$procurement_work."</a>",
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