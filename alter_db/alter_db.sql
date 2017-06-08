ALTER TABLE `kuitansi` CHANGE `pejabat_pj` `pejabat_pj_name` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
ALTER TABLE `kuitansi` ADD `pejabat_pj_nip` VARCHAR(100) NOT NULL AFTER `pejabat_pj_name`;
ALTER TABLE `kuitansi` DROP `supplier_name`, DROP `supplier_position`;