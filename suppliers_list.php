<?php include_once "head.php";?>
<?php
	if($_GET["deleting"]){
		$db->addtable("suppliers");
		$db->where("id",$_GET["deleting"]);
		$db->delete_();
		?> <script> window.location="?";</script> <?php
	}
?>
<div class="bo_title">Supplier / Penyedia Jasa</div>
<div id="bo_expand" onclick="toogle_bo_filter();">[+] View Filter</div>
<div id="bo_filter">
	<div id="bo_filter_container">
		<?=$f->start("filter","GET");?>
			<?=$t->start();?>
			<?php
				$name 					= $f->input("name",@$_GET["name"]);
				$work_category_id 		= $f->select("work_category_id",$db->fetch_select_data("work_categories","id","name",array(),array(),"",true),@$_GET["work_category_id"],"style='height:22px;'");
				$address				= $f->input("address",@$_GET["address"]);
				$pic					= $f->input("pic",@$_GET["pic"]);
				$types_of_goods			= $f->input("types_of_goods",@$_GET["types_of_goods"]);
				$siup_category			= $f->input("siup_category",@$_GET["siup_category"]);
                
			?>
			     <?=$t->row(array("Nama Perusahaan",$name));?>
			     <?=$t->row(array("Kategori Pekerjaan",$work_category_id));?>
			     <?=$t->row(array("Alamat",$address));?>
			     <?=$t->row(array("Nama PJ",$pic));?>
			     <?=$t->row(array("Jenis Barang/Jasa",$types_of_goods));?>
                 <?=$t->row(array("Kategori SIUP",$siup_category));?>
           
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
	if(@$_GET["name"]!="") 					$whereclause .= "(name LIKE '%".$_GET["name"]."%') AND ";
	if(@$_GET["work_category_id"]!="") 		$whereclause .= "(work_category_ids LIKE '%|".$_GET["work_category_id"]."|%') AND ";
    if(@$_GET["address"]!="") 				$whereclause .= "(address LIKE '".$_GET["address"]."') AND ";
    if(@$_GET["pic"]!="") 					$whereclause .= "(pic LIKE '".$_GET["pic"]."') AND ";
    if(@$_GET["types_of_goods"]!="") 		$whereclause .= "(types_of_goods LIKE '".$_GET["types_of_goods"]."') AND ";
    if(@$_GET["siup_category"]!="") 		$whereclause .= "(siup_category LIKE '".$_GET["siup_category"]."') AND ";
   	
	$db->addtable("suppliers");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($_max_counting);
	$maxrow = count($db->fetch_data(true));
	$start = getStartRow(@$_GET["page"],$_rowperpage);
	$paging = paging($_rowperpage,$maxrow,@$_GET["page"],"paging");
	
	$db->addtable("suppliers");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($start.",".$_rowperpage);
	if(@$_GET["sort"] == "") $_GET["sort"] = "id DESC";
	$db->order($_GET["sort"]);
	$suppliers = $db->fetch_data(true);
?>

	<?=$f->input("add","Tambah","type='button' onclick=\"window.location='suppliers_add.php';\"");?>
	<?=$paging;?>
	<?=$t->start("","data_content");?>
	<?=$t->header(array("No",
						"<div onclick=\"sorting('id');\">ID</div>",
						"<div onclick=\"sorting('name');\">Nama Perusahaan</div>",
						"<div onclick=\"sorting('pic');\">Nama PJ</div>",
						"<div onclick=\"sorting('types_of_goods');\">Jenis Barang/Jasa</div>",
						"<div onclick=\"sorting('siup_category');\">Kategori SIUP</div>",
						""));?>
	<?php foreach($suppliers as $no => $supplier){ ?>
		<?php
			$actions = "<a href=\"suppliers_edit.php?id=".$supplier["id"]."\">Ubah</a> |
						<a href='#' onclick=\"if(confirm('Are You sure to delete this data?')){window.location='?deleting=".$supplier["id"]."';}\">Hapus</a>
						";
                        
		?>
		<?=$t->row(
					array($no+$start+1,
						"<a href=\"suppliers_edit.php?id=".$supplier["id"]."\">".$supplier["id"]."</a>",
                        "<a href=\"suppliers_edit.php?id=".$supplier["id"]."\">".$supplier["name"]."</a>",
                        $supplier["pic"],
                        $supplier["types_of_goods"],
                        $supplier["siup_category"],
						$actions),
					array("align='right' valign='top'","")
				);?>
	<?php } ?>
	<?=$t->end();?>
	<?=$paging;?>
<?php include_once "footer.php";?>