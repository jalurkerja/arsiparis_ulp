<?php include_once "head.php";?>
<!--center><img src="images/logo.jpg" width="400"></center-->
<table width="100%">
	<tr>
		<td valign="top" align="center">
			<table width="800">
				<tr><td align="center"><b><h2>STATUS PEKERJAAN</h2></b></td></tr>
				<tr><td><br><br></td></tr>
				<tr><td>
					<table width="100%" id="data_content">
						<tr>
							<th nowrap>Nama Pekerjaan</th>
							<th nowrap>Status Pekerjaan</th>
							<th>Tanggal</th>
							<th nowrap>Di Update Oleh</th>
							<th nowrap>Status Sebelumnya</th>
							<th>Tanggal</th>
							<th nowrap>Di Update Oleh</th>
						</tr>
						<?php
							$db->addtable("procurement_works");$db->order("id DESC");$db->limit(10);
							$db->awhere("id NOT IN (SELECT procurement_work_id FROM spk WHERE ba_bayar_nomor <> '')");
							foreach($db->fetch_data(true) as $key => $procurement_work){
								$id = $procurement_work["id"];
								$status		= "";
								$tanggal	= "";
								$updated_by	= "";
								$link	= "";
								$status_1		= "";
								$tanggal_1		= "";
								$updated_by_1	= "";
								$link_1			= "";
								
								if($procurement_work["hps_ok"] > 0){
									$status		= "HPS Approved";
									$tanggal	= $procurement_work["hps_ok_at"];
									$updated_by	= $procurement_work["hps_ok_by"];
									$link		= "procurement_works_edit.php?id=".$id;
								}
								
								if($db->fetch_single_data("dokumen_pengadaan","id",array("procurement_work_id"=>$id)) > 0){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated;
									$link_1			= $link;		
									$status		= "Dokumen Pengadaan";
									$tanggal	= $db->fetch_single_data("dokumen_pengadaan","updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("dokumen_pengadaan","updated_by",array("procurement_work_id"=>$id))));
									$link		= "dokumen_pengadaan_edit.php?id=".$db->fetch_single_data("dokumen_pengadaan","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("pokja_ulp","undangan_nomor",array("procurement_work_id"=>$id)) != ""){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "Undangan Kepada Penyedia";
									$tanggal	= $db->fetch_single_data("pokja_ulp","undangan_updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("pokja_ulp","undangan_updated_by",array("procurement_work_id"=>$id))));
									$link		= "pokja_ulp_undangan_edit.php?id=".$db->fetch_single_data("pokja_ulp","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("pokja_ulp","penawaran_nomor",array("procurement_work_id"=>$id)) != ""){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "Surat Permintaan Penawaran Harga";
									$tanggal	= $db->fetch_single_data("pokja_ulp","penawaran_updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("pokja_ulp","penawaran_updated_by",array("procurement_work_id"=>$id))));
									$link		= "pokja_ulp_penawaran_edit.php?id=".$db->fetch_single_data("pokja_ulp","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("pokja_ulp","ba_pemasukan_nomor",array("procurement_work_id"=>$id)) != ""){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "BA Pemasukan Penawaran Pengadaan";
									$tanggal	= $db->fetch_single_data("pokja_ulp","ba_pemasukan_updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("pokja_ulp","ba_pemasukan_updated_by",array("procurement_work_id"=>$id))));
									$link		= "pokja_ulp_ba_pemasukan_edit.php?id=".$db->fetch_single_data("pokja_ulp","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("pokja_ulp","ba_pembukaan_nomor",array("procurement_work_id"=>$id)) != ""){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "BA Pembukaan Dokumen Penawaran";
									$tanggal	= $db->fetch_single_data("pokja_ulp","ba_pembukaan_updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("pokja_ulp","ba_pembukaan_updated_by",array("procurement_work_id"=>$id))));
									$link		= "pokja_ulp_ba_pembukaan_edit.php?id=".$db->fetch_single_data("pokja_ulp","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("ba_evaluasi_dok","id",array("procurement_work_id"=>$id)) > 0){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "BA Evaluasi dan Penelitian Dokumen Penawaran";
									$tanggal	= $db->fetch_single_data("ba_evaluasi_dok","updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("ba_evaluasi_dok","updated_by",array("procurement_work_id"=>$id))));
									$link		= "ba_evaluasi_dok_edit.php?id=".$db->fetch_single_data("ba_evaluasi_dok","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("pokja_ulp","nego_nomor",array("procurement_work_id"=>$id)) != ""){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "Undangan Negosiasi";
									$tanggal	= $db->fetch_single_data("pokja_ulp","nego_updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("pokja_ulp","nego_updated_by",array("procurement_work_id"=>$id))));
									$link		= "pokja_ulp_nego_edit.php?id=".$db->fetch_single_data("pokja_ulp","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("ba_nego","id",array("procurement_work_id"=>$id)) > 0){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "BA Negosiasi Harga";
									$tanggal	= $db->fetch_single_data("ba_nego","updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("ba_nego","updated_by",array("procurement_work_id"=>$id))));
									$link		= "ba_nego_edit.php?id=".$db->fetch_single_data("ba_nego","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("pokja_ulp","ba_hasil_nomor",array("procurement_work_id"=>$id)) != ""){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "BA Hasil Pengadaan";
									$tanggal	= $db->fetch_single_data("pokja_ulp","ba_hasil_updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("pokja_ulp","ba_hasil_updated_by",array("procurement_work_id"=>$id))));
									$link		= "pokja_ulp_ba_hasil_edit.php?id=".$db->fetch_single_data("pokja_ulp","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("pokja_ulp","laporan_nomor",array("procurement_work_id"=>$id)) != ""){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "Laporan Hasil Pengadaan";
									$tanggal	= $db->fetch_single_data("pokja_ulp","laporan_updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("pokja_ulp","laporan_updated_by",array("procurement_work_id"=>$id))));
									$link		= "pokja_ulp_laporan_edit.php?id=".$db->fetch_single_data("pokja_ulp","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("spk","penunjukan_nomor",array("procurement_work_id"=>$id)) != ""){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "Penunjukan Penyedia";
									$tanggal	= $db->fetch_single_data("spk","xtimestamp",array("procurement_work_id"=>$id));
									$updated_by	= "";
									$link		= "spk_penunjukan_edit.php?id=".$db->fetch_single_data("spk","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("spk","nomor",array("procurement_work_id"=>$id)) != ""){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "Surat Perintah Kerja";
									$tanggal	= $db->fetch_single_data("spk","xtimestamp",array("procurement_work_id"=>$id));
									$updated_by	= "";
									$link		= "spk_edit.php?id=".$db->fetch_single_data("spk","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("spk","pemeriksaan_nomor",array("procurement_work_id"=>$id)) != ""){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "Permintaan Pemeriksaan Hasil Pengadaan Barang/Jasa";
									$tanggal	= $db->fetch_single_data("spk","pemeriksaan_updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("spk","pemeriksaan_updated_by",array("procurement_work_id"=>$id))));
									$link		= "spk_pemeriksaan_edit.php?id=".$db->fetch_single_data("spk","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("spk","ba_hasil_kerja_nomor",array("procurement_work_id"=>$id)) != ""){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "BA Pemeriksaan Hasil Pekerjaan";
									$tanggal	= $db->fetch_single_data("spk","ba_hasil_kerja_updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("spk","ba_hasil_kerja_updated_by",array("procurement_work_id"=>$id))));
									$link		= "spk_ba_hasil_kerja_edit.php?id=".$db->fetch_single_data("spk","id",array("procurement_work_id"=>$id));
								}
								
								if($db->fetch_single_data("spk","ba_serah_nomor",array("procurement_work_id"=>$id)) != ""){
									$status_1		= $status;
									$tanggal_1		= $tanggal;
									$updated_by_1	= $updated_by;
									$link_1			= $link;									
									$status		= "BA Serah Terima Barang";
									$tanggal	= $db->fetch_single_data("spk","ba_serah_updated_at",array("procurement_work_id"=>$id));
									$updated_by	= $db->fetch_single_data("users","name",array("email"=>$db->fetch_single_data("spk","ba_serah_updated_by",array("procurement_work_id"=>$id))));
									$link		= "spk_ba_serah_edit.php?id=".$db->fetch_single_data("spk","id",array("procurement_work_id"=>$id));
								}

						?>
							<tr>
								<td><?=$procurement_work["name"];?></td>
								<td nowrap><a href="<?=$link;?>" target="_BLANK"><?=$status;?></a></td>
								<td nowrap><a href="<?=$link;?>" target="_BLANK"><?=format_tanggal($tanggal);?></a></td>
								<td nowrap><a href="<?=$link;?>" target="_BLANK"><?=$updated_by;?></a></td>
								<td nowrap><a href="<?=$link_1;?>" target="_BLANK"><?=$status_1;?></a></td>
								<td nowrap><a href="<?=$link_1;?>" target="_BLANK"><?=format_tanggal($tanggal_1);?></a></td>
								<td nowrap><a href="<?=$link_1;?>" target="_BLANK"><?=$updated_by_1;?></a></td>
							</tr>
						<?php
							}
						?>
					</table>
				</td></tr>
			</table>
		</td>
	</tr>
</table>
<?php include_once "footer.php";?>