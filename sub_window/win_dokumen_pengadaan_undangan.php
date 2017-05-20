<?php
	include_once "win_head.php";
	$dokumen_pengadaan_id = $_GET["dokumen_pengadaan_id"];
	if(isset($_POST["save"])){
		$supplier_ids = "";
		foreach($_POST["chk_supplier"] as $key => $supplier_id){ $supplier_ids .= $supplier_id.","; }
		$supplier_ids = substr($supplier_ids,0,-1);
		$db->addtable("dokumen_pengadaan_undangan");
		if($supplier_ids) $db->awhere("dokumen_pengadaan_id = '".$dokumen_pengadaan_id."' AND supplier_id NOT IN (".$supplier_ids.")");
		else $db->awhere("dokumen_pengadaan_id = '".$dokumen_pengadaan_id."'");
		$db->delete_();
		foreach($_POST["chk_supplier"] as $key => $supplier_id){
			$dokumen_pengadaan_undangan_id = $db->fetch_single_data("dokumen_pengadaan_undangan","id",array("dokumen_pengadaan_id"=>$dokumen_pengadaan_id,"supplier_id"=>$supplier_id));
			
			$db->addtable("dokumen_pengadaan_undangan");
			$db->addfield("dokumen_pengadaan_id");		$db->addvalue($dokumen_pengadaan_id);
			$db->addfield("supplier_id");				$db->addvalue($supplier_id);
			$db->addfield("updated_at");				$db->addvalue(date("Y-m-d H:i:s"));
			$db->addfield("updated_by");				$db->addvalue($__username);
			$db->addfield("updated_ip");				$db->addvalue($_SERVER["REMOTE_ADDR"]);
			if($dokumen_pengadaan_undangan_id > 0){
				$db->where("id",$dokumen_pengadaan_undangan_id);
				$updating = $db->update();
			} else {
				$db->insert();
			}
		}
		?>
			<script>
				parent.window.location=parent.window.location;
			</script>
		<?php
	}
	
	$db->addtable("suppliers");
	if($_POST["keyword"] != "") $db->awhere(
										"name LIKE '%".$_POST["keyword"]."%'
										OR pic LIKE '%".$_POST["keyword"]."%'
										OR address LIKE '%".$_POST["keyword"]."%'"
								);
	$db->limit(1000);
	$db->order("name");
	$_data = $db->fetch_data(true);
?>
<h3><b><?=$_title;?></b></h3>
<br><br>
<?=$f->start("","POST","?".$_SERVER["QUERY_STRING"]);?>
Search : <?=$f->input("keyword",$_POST["keyword"],"size='50'");?>&nbsp;<?=$f->input("search","Load","type='submit'");?>
<?=$f->end();?>
<br>
<?=$f->start("","POST","?".$_SERVER["QUERY_STRING"]);?>
	<?=$t->start("","data_content");?>
		<?=$t->header(array("No","Nama Perusahaan","PIC","Kategori Pekerjaan","Kategori SIUP"));?>
		<?php 
			foreach($_data as $no => $data){
				$dokumen_pengadaan_undangan_id = $db->fetch_single_data("dokumen_pengadaan_undangan","id",array("dokumen_pengadaan_id"=>$dokumen_pengadaan_id,"supplier_id"=>$data["id"]));
				$checked = ($dokumen_pengadaan_undangan_id > 0) ? "checked" : "";
				$chekbox = $f->input("chk_supplier[".$no."]",$data["id"],"type='checkbox' ".$checked)."&nbsp;&nbsp;";
				$work_categories = "";
				foreach(pipetoarray($data["work_category_ids"]) as $key => $work_category_id){
					$work_categories .= $db->fetch_single_data("work_categories","name",array("id" => $work_category_id))."<br>";
				}
				
				echo $t->row(array($chekbox.($no+1),$data["name"],$data["pic"],$work_categories,$data["siup_category"]),array("align='right' valign='top' ","valign='top'"));
			} 
		?>
	<?=$t->end();?>
	<?=$f->input("save","Simpan","type='submit'");?>
<?=$f->end();?>