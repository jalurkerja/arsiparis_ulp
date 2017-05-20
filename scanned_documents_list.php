<?php include_once "head.php";?>
<?php
	if($_GET["deleting"]){
		$db->addtable("scanned_documents"); $db->where("id",$_GET["deleting"]); $db->delete_();
		$db->addtable("scanned_documents"); $db->where("parent_id",$_GET["deleting"]); $db->delete_();
		unlink("scanned_documents/dok_".$_GET["deleting"]."_*.*");
		array_map('unlink', glob("scanned_documents/dok_".$_GET["deleting"]."_*.*"));
		?> <script> window.location="?";</script> <?php
	}
?>
<div class="bo_title">Scan Dokumen</div>
<div id="bo_expand" onclick="toogle_bo_filter();">[+] View Filter</div>
<div id="bo_filter">
	<div id="bo_filter_container">
		<?=$f->start("filter","GET");?>
			<?=$t->start();?>
			<?php
				$nomor 					= $f->input("nomor",@$_GET["nomor"]);
				$document_type_id 		= $f->select("document_type_id",$db->fetch_select_data("document_types","id","name",array(),array("name"),"",true),@$_GET["document_type_id"],"style='height:22px;'");
				$work_category_id 		= $f->select("work_category_id",$db->fetch_select_data("work_categories","id","name",array(),array(),"",true),@$_GET["work_category_id"],"style='height:22px;'");
                
			?>
			     <?=$t->row(array("Nomor Dokumen",$nomor));?>
			     <?=$t->row(array("Tipe Dokumen",$document_type_id));?>
			     <?=$t->row(array("Kategori Pekerjaan",$work_category_id));?>
           
			<?=$t->end();?>
			<?=$f->input("page","1","type='hidden'");?>
			<?=$f->input("sort",@$_GET["sort"],"type='hidden'");?>
			<?=$f->input("do_filter","Load","type='submit'");?>
			<?=$f->input("reset","Reset","type='button' onclick=\"window.location='?';\"");?>
		<?=$f->end();?>
	</div>
</div>

<?php
	$whereclause = "parent_id = 0 AND ";
	if(@$_GET["nomor"]!="") 			$whereclause .= "(nomor LIKE '%".$_GET["nomor"]."%') AND ";
	if(@$_GET["document_type_id"]!="") 	$whereclause .= "(document_type_id = '".$_GET["document_type_id"]."') AND ";
	if(@$_GET["work_category_id"]!="") 	$whereclause .= "(work_category_id = '".$_GET["work_category_id"]."') AND ";
   	
	$db->addtable("scanned_documents");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($_max_counting);
	$maxrow = count($db->fetch_data(true));
	$start = getStartRow(@$_GET["page"],$_rowperpage);
	$paging = paging($_rowperpage,$maxrow,@$_GET["page"],"paging");
	
	$db->addtable("scanned_documents");
	if($whereclause != "") $db->awhere(substr($whereclause,0,-4));$db->limit($start.",".$_rowperpage);
	if(@$_GET["sort"] != "") $db->order($_GET["sort"]);
	$scanned_documents = $db->fetch_data(true);
?>

	<?=$f->input("add","Tambah","type='button' onclick=\"window.location='scanned_documents_add.php';\"");?>
	<?=$paging;?>
	<?=$t->start("","data_content");?>
	<?=$t->header(array("No",
						"<div onclick=\"sorting('id');\">ID</div>",
						"<div onclick=\"sorting('nomor');\">Nomor Dokumen</div>",
						"<div onclick=\"sorting('document_type_id');\">Tipe Dokumen</div>",
						"<div onclick=\"sorting('work_category_id');\">Kategori Pekerjaan</div>",
						"Jumlah Dokumen",
						""));?>
	<?php foreach($scanned_documents as $no => $scanned_document){ ?>
		<?php
			$actions = "<a href=\"scanned_documents_edit.php?id=".$scanned_document["id"]."\">Ubah</a> |
						<a href='#' onclick=\"if(confirm('Are You sure to delete this data?')){window.location='?deleting=".$scanned_document["id"]."';}\">Hapus</a>
						";
			$num_doc = 1 + ($db->fetch_single_data("scanned_document","concat(count(0)) as num_doc",array("parent_id"=>$scanned_document["id"])) * 1);
		?>
		<?=$t->row(
					array($no+$start+1,
						"<a href=\"scanned_documents_edit.php?id=".$scanned_document["id"]."\">".$scanned_document["id"]."</a>",
                        "<a href=\"scanned_documents_edit.php?id=".$scanned_document["id"]."\">".$scanned_document["nomor"]."</a>",
                        $db->fetch_single_data("document_types","name",array("id"=>$scanned_document["document_type_id"])),
                        $db->fetch_single_data("work_categories","name",array("id"=>$scanned_document["work_category_id"])),
						$num_doc,
						$actions),
					array("align='right' valign='top'","")
				);?>
	<?php } ?>
	<?=$t->end();?>
	<?=$paging;?>
<?php include_once "footer.php";?>