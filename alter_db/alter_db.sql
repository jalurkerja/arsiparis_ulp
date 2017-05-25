
CREATE TABLE `scanned_documents` (
  `id` int(11) NOT NULL,
  `procurement_work_id` int(11) NOT NULL,
  `procurement_work_name` varchar(255) NOT NULL,
  `document_type_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `work_category_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scanned_documents`
--
ALTER TABLE `scanned_documents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scanned_documents`
--
ALTER TABLE `scanned_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
