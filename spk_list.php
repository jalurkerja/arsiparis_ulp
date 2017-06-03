<?php include_once "head.php";?>
<?php
	if($_GET["deleting"]){
		if($db->fetch_single_data("spk","nomor",array("id"=>$_GET["deleting"])) == ""){
			$db->addtable("spk");
			$db->where("id",$_GET["deleting"]);
			$db->delete_();
			?> <script> window.location="?";</script> <?php
		} else {
			echo "<font color='red'><b>Maaf, dokumen ini tidak dapat di hapus, karena dapat mempengaruhi dokumen yang lain.</b></font>";
		}
	}
?>
<div class="bo_title">SPK</div>
<div id="bo_expand" onclick="toogle_bo_filter();">[+] View Filter</div>
<div id="bo_filter">
	<div id="bo_filter_container">
		<?=$f->start("filter","GET");?>
			<?=$t->start();?>
			<?php
				$procurement_work_id = $f->select("procurement_work_id",$db->fetch_select_data("procurement_works","id","name",array(),array("id DESC"),"",true),@$_GET["procurement_work_id"],"style='height:22px;'");
				$nomor = $f->input("nomor",$_GET["nomor"]);
				$tanggal = $f->input("tanggal",$_GET["tanggal"],"type='date'");
				$supplier_id = $f->select("supplier_id",$db->fetch_select_data("suppliers","id","name",array(),array("name"),"",true),@$_GET["supplier_id"],"style='height:22px;'");
			?>
			     <?=$t->row(array("Nama Pekerjaan Pengadaan",$procurement_work_id));?>
			     <?=$t->row(array("Nomor SPK",$nomor));?>
			     <?=$t->row(array("Tanggal SPK",$tanggal));?>
			     <?=$t->row(array("Penyedia Barang/Jasa",$supplier_id));?>
           
			<?=$t->end();?>
			<?=$f->input("page","1","type='hidden'");?>
			<?=$f->input("sort",@$_GET["sort"],"type='hidden'");?>
			<?=$f->input("do_filter","Load","type='submit'");?>
			<?=$f->input("reset","Reset","type='button' onclick=\"window.location='?';\"");?>
		<?=$f->end();?>
	</div>
</div>

<?php
	$whereclause = "nomor <> '' AND ";
	if(@$_GET["procurement_work_id"]!="") 	$whereclause .= "procurement_work_id = '".$_GET["procurement_work_id"]."' AND ";
	if(@$_GET["nomor"]!="") 				$whereclause .= "nomor LIKE '%".$_GET["nomor"]."%' AND ";
	if(@$_GET["tanggal"]!="") 				$whereclause .= "tanggal LIKE '%".$_GET["tanggal"]."%' AND ";
	if(@$_GET["supplier_id"]!="") 			$whereclause .= "supplier = '".$_GET["supplier_id"]."' AND ";
   	
	$db->addtable("spk");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($_max_counting);
	$maxrow = count($db->fetch_data(true));
	$start = getStartRow(@$_GET["page"],$_rowperpage);
	$paging = paging($_rowperpage,$maxrow,@$_GET["page"],"paging");
	
	$db->addtable("spk");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($start.",".$_rowperpage);
	if(@$_GET["sort"] == "") $_GET["sort"] = "id DESC";
	$db->order($_GET["sort"]);
	$spk = $db->fetch_data(true);
?>

	<?=$f->input("add","Tambah","type='button' onclick=\"window.location='spk_add.php';\"");?>
	<?=$paging;?>
	<?=$t->start("","data_content");?>
	<?=$t->header(array("",
						"No",
						"<div onclick=\"sorting('id');\">ID</div>",
						"<div onclick=\"sorting('nomor');\">Nomor SPK</div>",
						"<div onclick=\"sorting('tanggal');\">Tanggal<br>SPK</div>",
						"Kategori Pekerjaan",
						"<div onclick=\"sorting('procurement_work_id');\">Nama Pekerjaan</div>",
						"Nama PPK",
						"Tahun<br>Anggaran",
						"Jangka<br>Waktu",
						"HPS"));?>
	<?php foreach($spk as $no => $_spk){ ?>
		<?php
			$actions = "<a href=\"spk_edit.php?id=".$_spk["id"]."\">Ubah</a> |
						<a href='#' onclick=\"if(confirm('Are You sure to delete this data?')){window.location='?deleting=".$_spk["id"]."';}\">Hapus</a>
						";
            $work_category_id = $db->fetch_single_data("procurement_works","work_category_id",array("id"=>$_spk["procurement_work_id"]));
            $work_category = $db->fetch_single_data("work_categories","name",array("id"=>$work_category_id));
			$ppk_name = $db->fetch_single_data("procurement_works","ppk_name",array("id"=>$_spk["procurement_work_id"]));
			$ppk_nip = $db->fetch_single_data("procurement_works","ppk_nip",array("id"=>$_spk["procurement_work_id"]));
			$tahun_anggaran = $db->fetch_single_data("procurement_works","tahun_anggaran",array("id"=>$_spk["procurement_work_id"]));
			$work_days = $db->fetch_single_data("procurement_works","work_days",array("id"=>$_spk["procurement_work_id"]));
			$hps_nominal = $db->fetch_single_data("procurement_works","hps_nominal",array("id"=>$_spk["procurement_work_id"]));
			$procurement_work = $db->fetch_single_data("procurement_works","name",array("id"=>$_spk["procurement_work_id"]));
			$supplier = $db->fetch_single_data("suppliers","name",array("id"=>$_spk["supplier_id"]));
		?>
		<?=$t->row(
					array($actions,
						$no+$start+1,
						"<a href=\"spk_edit.php?id=".$_spk["id"]."\">".$_spk["id"]."</a>",
						"<a href=\"spk_edit.php?id=".$_spk["id"]."\">".$_spk["nomor"]."</a>",
						"<a href=\"spk_edit.php?id=".$_spk["id"]."\">".format_tanggal($_spk["tanggal"])."</a>",
						"<a href=\"spk_edit.php?id=".$_spk["id"]."\">".$work_category."</a>",
                        "<a href=\"spk_edit.php?id=".$_spk["id"]."\">".$procurement_work."</a>",
                        $ppk_name."<br>".$ppk_nip,
                        $tahun_anggaran,
                        $work_days,
                        format_amount($hps_nominal)),
					array("align='right' valign='top' nowrap","")
				);?>
	<?php } ?>
	<?=$t->end();?>
	<?=$paging;?>
<?php include_once "footer.php";?>