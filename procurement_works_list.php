<?php include_once "head.php";?>
<?php
	if($_GET["deleting"]){
		$db->addtable("procurement_works");
		$db->where("id",$_GET["deleting"]);
		$db->delete_();
		?> <script> window.location="?";</script> <?php
	}
?>
<div class="bo_title">Pekerjaan</div>
<div id="bo_expand" onclick="toogle_bo_filter();">[+] View Filter</div>
<div id="bo_filter">
	<div id="bo_filter_container">
		<?=$f->start("filter","GET");?>
			<?=$t->start();?>
			<?php
				$work_category_id 	= $f->select("work_category_id",$db->fetch_select_data("work_categories","id","name",array(),array(),"",true),@$_GET["work_category_id"],"style='height:22px;'");
				$name 				= $f->input("name",@$_GET["name"]);
				$ppk_name			= $f->input("ppk_name",@$_GET["ppk_name"]);
				$ppk_nip			= $f->input("ppk_nip",@$_GET["ppk_nip"]);
				$tahun_anggaran		= $f->input("tahun_anggaran",@$_GET["tahun_anggaran"]);
                
			?>
			     <?=$t->row(array("Kategori Pekerjaan",$work_category_id));?>
			     <?=$t->row(array("Nama Pekerjaan Pengadaan",$name));?>
			     <?=$t->row(array("Nama PPK",$ppk_name));?>
			     <?=$t->row(array("NIP PPK",$ppk_nip));?>
			     <?=$t->row(array("Tahun Anggaran",$tahun_anggaran));?>
           
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
	if(@$_GET["work_category_id"]!="") 		$whereclause .= "(work_category_id = '".$_GET["work_category_id"]."') AND ";
	if(@$_GET["name"]!="") 					$whereclause .= "(name LIKE '%".$_GET["name"]."%') AND ";
	if(@$_GET["ppk_name"]!="") 				$whereclause .= "(ppk_name LIKE '%".$_GET["ppk_name"]."%') AND ";
	if(@$_GET["ppk_nip"]!="") 				$whereclause .= "(ppk_nip LIKE '%".$_GET["ppk_nip"]."%') AND ";
	if(@$_GET["tahun_anggaran"]!="") 		$whereclause .= "(tahun_anggaran = '".$_GET["tahun_anggaran"]."') AND ";
   	
	$db->addtable("procurement_works");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($_max_counting);
	$maxrow = count($db->fetch_data(true));
	$start = getStartRow(@$_GET["page"],$_rowperpage);
	$paging = paging($_rowperpage,$maxrow,@$_GET["page"],"paging");
	
	$db->addtable("procurement_works");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($start.",".$_rowperpage);
	if(@$_GET["sort"] != "") $db->order($_GET["sort"]);
	$procurement_works = $db->fetch_data(true);
?>

	<?=$f->input("add","Tambah","type='button' onclick=\"window.location='procurement_works_add.php';\"");?>
	<?=$paging;?>
	<?=$t->start("","data_content");?>
	<?=$t->header(array("No",
						"<div onclick=\"sorting('id');\">ID</div>",
						"<div onclick=\"sorting('work_category_id');\">Kategori Pekerjaan</div>",
						"<div onclick=\"sorting('name');\">Nama Pekerjaan</div>",
						"<div onclick=\"sorting('ppk_name');\">Nama PPK</div>",
						"<div onclick=\"sorting('tahun_anggaran');\">Tahun<br>Anggaran</div>",
						"<div onclick=\"sorting('work_days');\">Jangka<br>Waktu</div>",
						"<div onclick=\"sorting('hps_nominal');\">HPS</div>",
						"<div onclick=\"sorting('hps_ok');\">HPS Approved</div>",
						"Update Terakhir<br>Oleh",
						""));?>
	<?php foreach($procurement_works as $no => $procurement_work){ ?>
		<?php
			$actions = "<a href=\"procurement_works_edit.php?id=".$procurement_work["id"]."\">Ubah</a> |
						<a href='#' onclick=\"if(confirm('Are You sure to delete this data?')){window.location='?deleting=".$procurement_work["id"]."';}\">Hapus</a>
						";
            $work_category = $db->fetch_single_data("work_categories","name",array("id"=>$procurement_work["work_category_id"]));
            $hps_ok = ($procurement_work["hps_ok"] == 1) ? "Approved" : "";
		?>
		<?=$t->row(
					array($no+$start+1,
						"<a href=\"procurement_works_edit.php?id=".$procurement_work["id"]."\">".$procurement_work["id"]."</a>",
						"<a href=\"procurement_works_edit.php?id=".$procurement_work["id"]."\">".$work_category."</a>",
                        "<a href=\"procurement_works_edit.php?id=".$procurement_work["id"]."\">".$procurement_work["name"]."</a>",
                        $procurement_work["ppk_name"]."<br>".$procurement_work["ppk_nip"],
                        $procurement_work["tahun_anggaran"],
                        $procurement_work["work_days"],
                        format_amount($procurement_work["hps_nominal"]),
						$hps_ok,
                        $procurement_work["updated_by"],
						$actions),
					array("align='right' valign='top'","")
				);?>
	<?php } ?>
	<?=$t->end();?>
	<?=$paging;?>
<?php include_once "footer.php";?>