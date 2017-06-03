ALTER TABLE `spk` ADD `work_days_type` SMALLINT NOT NULL AFTER `work_days`;
ALTER TABLE `spk`
  DROP `work_start`,
  DROP `work_end`,
  DROP `work_days`,
  DROP `work_days_type`;
