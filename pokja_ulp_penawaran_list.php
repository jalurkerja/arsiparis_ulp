<?php include_once "head.php";?>
<?php
	if($_GET["deleting"]){
		if($db->fetch_single_data("pokja_ulp","ba_pemasukan_nomor",array("id"=>$_GET["deleting"])) == ""){
			$db->addtable("pokja_ulp");				$db->where("id",$_GET["deleting"]);
			$db->addfield("penawaran_nomor");		$db->addvalue("");
			$db->addfield("penawaran_tanggal");		$db->addvalue("");
			$db->addfield("penawaran_supplier_ids");$db->addvalue("");
			$db->addfield("penawaran_latest_at");	$db->addvalue("");
			$db->addfield("penawaran_updated_at");	$db->addvalue("");
			$db->addfield("penawaran_updated_by");	$db->addvalue("");
			$db->update();
			?> <script> window.location="?";</script> <?php
		} else {
			echo "<font color='red'><b>Maaf, dokumen ini tidak dapat di hapus, karena dapat mempengaruhi dokumen yang lain.</b></font>";
		}
	}
?>
<div class="bo_title">Surat Permintaan Penawaran Harga</div>
<div id="bo_expand" onclick="toogle_bo_filter();">[+] View Filter</div>
<div id="bo_filter">
	<div id="bo_filter_container">
		<?=$f->start("filter","GET");?>
			<?=$t->start();?>
			<?php
				$procurement_work_id = $f->select("procurement_work_id",$db->fetch_select_data("procurement_works","id","name",array(),array("id DESC"),"",true),@$_GET["procurement_work_id"],"style='height:22px;'");
				$penawaran_nomor = $f->input("penawaran_nomor",$_GET["penawaran_nomor"]);
				$penawaran_tanggal = $f->input("penawaran_tanggal",$_GET["penawaran_tanggal"],"type='date'");
				$supplier_id = $f->select("supplier_id",$db->fetch_select_data("suppliers","id","name",array(),array("name"),"",true),@$_GET["supplier_id"],"style='height:22px;'");
			?>
			     <?=$t->row(array("Nama Pekerjaan Pengadaan",$procurement_work_id));?>
			     <?=$t->row(array("Nomor Surat",$penawaran_nomor));?>
			     <?=$t->row(array("Tanggal Surat",$penawaran_tanggal));?>
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
	$whereclause = "penawaran_nomor <> '' AND ";
	if(@$_GET["procurement_work_id"]!="") 		$whereclause .= "procurement_work_id = '".$_GET["procurement_work_id"]."' AND ";
	if(@$_GET["penawaran_nomor"]!="") 			$whereclause .= "penawaran_nomor LIKE '%".$_GET["penawaran_nomor"]."%' AND ";
	if(@$_GET["penawaran_tanggal"]!="") 		$whereclause .= "penawaran_tanggal LIKE '%".$_GET["penawaran_tanggal"]."%' AND ";
	if(@$_GET["supplier_id"]!="") 				$whereclause .= "penawaran_supplier_ids LIKE '|".$_GET["supplier_id"]."|' AND ";
   	
	$db->addtable("pokja_ulp");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($_max_counting);
	$maxrow = count($db->fetch_data(true));
	$start = getStartRow(@$_GET["page"],$_rowperpage);
	$paging = paging($_rowperpage,$maxrow,@$_GET["page"],"paging");
	
	$db->addtable("pokja_ulp");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($start.",".$_rowperpage);
	if(@$_GET["sort"] == "") $_GET["sort"] = "id DESC";
	$db->order($_GET["sort"]);
	$pokja_ulp = $db->fetch_data(true);
?>

	<?=$f->input("add","Tambah","type='button' onclick=\"window.location='pokja_ulp_penawaran_add.php';\"");?>
	<?=$paging;?>
	<?=$t->start("","data_content");?>
	<?=$t->header(array("",
						"No",
						"<div onclick=\"sorting('id');\">ID</div>",
						"<div onclick=\"sorting('nomor');\">Nomor Surat</div>",
						"<div onclick=\"sorting('tanggal');\">Tanggal<br>Surat</div>",
						"Kategori Pekerjaan",
						"<div onclick=\"sorting('procurement_work_id');\">Nama Pekerjaan</div>",
						"Nama PPK",
						"Tahun<br>Anggaran",
						"Jangka<br>Waktu",
						"HPS"));?>
	<?php foreach($pokja_ulp as $no => $_pokja_ulp){ ?>
		<?php
			$actions = "<a href=\"pokja_ulp_penawaran_edit.php?id=".$_pokja_ulp["id"]."\">Ubah</a> |
						<a href='#' onclick=\"if(confirm('Are You sure to delete this data?')){window.location='?deleting=".$_pokja_ulp["id"]."';}\">Hapus</a>
						";
            $work_category_id = $db->fetch_single_data("procurement_works","work_category_id",array("id"=>$_pokja_ulp["procurement_work_id"]));
            $work_category = $db->fetch_single_data("work_categories","name",array("id"=>$work_category_id));
			$ppk_name = $db->fetch_single_data("procurement_works","ppk_name",array("id"=>$_pokja_ulp["procurement_work_id"]));
			$ppk_nip = $db->fetch_single_data("procurement_works","ppk_nip",array("id"=>$_pokja_ulp["procurement_work_id"]));
			$tahun_anggaran = $db->fetch_single_data("procurement_works","tahun_anggaran",array("id"=>$_pokja_ulp["procurement_work_id"]));
			$work_days = $db->fetch_single_data("procurement_works","work_days",array("id"=>$_pokja_ulp["procurement_work_id"]));
			$hps_nominal = $db->fetch_single_data("procurement_works","hps_nominal",array("id"=>$_pokja_ulp["procurement_work_id"]));
			$procurement_work = $db->fetch_single_data("procurement_works","name",array("id"=>$_pokja_ulp["procurement_work_id"]));
			$supplier = $db->fetch_single_data("suppliers","name",array("id"=>$_pokja_ulp["supplier_id"]));
		?>
		<?=$t->row(
					array($actions,
						$no+$start+1,
						"<a href=\"pokja_ulp_penawaran_edit.php?id=".$_pokja_ulp["id"]."\">".$_pokja_ulp["id"]."</a>",
						"<a href=\"pokja_ulp_penawaran_edit.php?id=".$_pokja_ulp["id"]."\">".$_pokja_ulp["penawaran_nomor"]."</a>",
						"<a href=\"pokja_ulp_penawaran_edit.php?id=".$_pokja_ulp["id"]."\">".format_tanggal($_pokja_ulp["penawaran_tanggal"])."</a>",
						"<a href=\"pokja_ulp_penawaran_edit.php?id=".$_pokja_ulp["id"]."\">".$work_category."</a>",
                        "<a href=\"pokja_ulp_penawaran_edit.php?id=".$_pokja_ulp["id"]."\">".$procurement_work."</a>",
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