<?php include_once "head.php";?>
<?php
	if($_GET["deleting"]){
		$db->addtable("document_types");
		$db->where("id",$_GET["deleting"]);
		$db->delete_();
		?> <script> window.location="?";</script> <?php
	}
?>
<div class="bo_title">Tipe Dokumen</div>
<div id="bo_expand" onclick="toogle_bo_filter();">[+] View Filter</div>
<div id="bo_filter">
	<div id="bo_filter_container">
		<?=$f->start("filter","GET");?>
			<?=$t->start();?>
			<?php
				$txt_name = $f->input("txt_name",@$_GET["txt_name"]);
			?>
			<?=$t->row(array("Keyword",$txt_name));?>
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
	if(@$_GET["txt_name"]!="") $whereclause .= "(name LIKE '"."%".str_replace(" ","%",$_GET["txt_name"])."%"."' OR description LIKE '"."%".str_replace(" ","%",$_GET["txt_name"])."%"."') AND ";
	
	$db->addtable("document_types");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($_max_counting);
	$maxrow = count($db->fetch_data(true));
	$start = getStartRow(@$_GET["page"],$_rowperpage);
	$paging = paging($_rowperpage,$maxrow,@$_GET["page"],"paging");
	
	$db->addtable("document_types");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($start.",".$_rowperpage);
	if(@$_GET["sort"] == "") $_GET["sort"] = "id DESC";
	$db->order($_GET["sort"]);
	$document_types = $db->fetch_data(true);
?>
	<?=$f->input("add","Tambah","type='button' onclick=\"window.location='document_types_add.php';\"");?>
	<?=$paging;?>
	<?=$t->start("","data_content");?>
	<?=$t->header(array("No",
						"<div onclick=\"sorting('name');\">Name</div>",
						"<div onclick=\"sorting('description');\">Description</div>",
						""));?>
	<?php foreach($document_types as $no => $document_type){ ?>
		<?php
			
			$actions = 	"<a href=\"document_types_edit.php?id=".$document_type["id"]."\">Ubah</a> |
						<a href='#' onclick=\"if(confirm('Are You sure to delete this data?')){window.location='?deleting=".$document_type["id"]."';}\">Hapus</a>";
		?>
		<?=$t->row(
					array($no+$start+1,
					$document_type["name"],
					$document_type["description"],
					$actions),
					array("align='right' valign='top'","")
				);?>
	<?php } ?>
	<?=$t->end();?>
	<?=$paging;?>
	
<?php include_once "footer.php";?>