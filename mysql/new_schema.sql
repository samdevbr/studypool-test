CREATE TABLE `tbl_bids` (
  `id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `question_id_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tbl_questions` (
  `id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_type` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `tbl_bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `create_time_index` (`create_time`),
  ADD KEY `question_id_id` (`question_id_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `tbl_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `create_time` (`create_time`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `create_time` (`create_time`,`user_type`);

ALTER TABLE `tbl_bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tbl_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tbl_bids`
  ADD CONSTRAINT `tbl_bids_ibfk_1` FOREIGN KEY (`question_id_id`) REFERENCES `tbl_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_bids_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_questions`
  ADD CONSTRAINT `tbl_questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;