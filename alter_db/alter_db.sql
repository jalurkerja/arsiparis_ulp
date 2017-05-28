UPDATE backoffice_menu SET url='ba_evaluasi_dok_list.php' WHERE id = '31';
UPDATE backoffice_menu SET url='ba_nego_list.php' WHERE id='32';
UPDATE backoffice_menu SET name='BA Hasil Pengadaan' WHERE id='33';
UPDATE backoffice_menu SET is_active='0' WHERE id='24';
Truncate Table document_types;
INSERT INTO `document_types` (`id`, `name`, `description`, `updated_at`, `updated_by`, `updated_ip`, `xtimestamp`) VALUES
(1, 'Surat Penetapan HPS', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(2, 'Surat Perintah Pengadaan', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(3, 'Dokumen Pengadaan', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(4, 'Surat Pesanan', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(5, 'Undangan Kepada Penyedia', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(6, 'Surat Permintaan Penawaran Harga', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(7, 'BA Pemasukan Penawaran Pengadaan Langsung', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(8, 'BA Pembukaan Dokumen Penawaran', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(9, 'BA Evaluasi dan Penelitian Dokumen Penawaran', '', '0000-00-00 00:00:00', '', NULL, '2017-05-28 01:24:37'),
(10, 'Undangan Negosiasi', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(11, 'BA Negosiasi', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(12, 'BA Hasil Pengadaan Langsung atau Lelang', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(13, 'Berita Acara Evaluasi Penawaran', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(14, 'Daftar Hadir', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(15, 'Laporan Hasil Pengadaan', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(16, 'Surat Penunjukan Penyedia Barang dan Jasa', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(17, 'SPK', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(18, 'Surat Permintaan Pemeriksaan Hasil Pengadaan Barang/Jasa', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(19, 'BA Pemeriksaan Penyelesaian Hasil Pekerjaan', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(20, 'BA Serah Terima Barang', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(21, 'BA Pembayaran', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(22, 'Kwitansi', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(23, 'BA Serah Terima Operasional dari PPK ke KPA', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(24, 'Pengumuman Lelang', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(25, 'Undangan Pembuktian Kualifikasi', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(26, 'BA Pembuktian Kualifikasi', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28'),
(27, 'Kontrak Kerja', '', '0000-00-00 00:00:00', '', NULL, '2017-05-16 01:48:28');
