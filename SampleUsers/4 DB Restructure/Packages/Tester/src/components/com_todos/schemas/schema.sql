-- --------------------------------------------------------

CREATE TABLE `#__tester_tester` (
  `tester_tester_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `node_id` bigint(11) NOT NULL,
  `open_status_change_time` datetime NOT NULL,
  `open_status_change_by` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`tester_tester_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB;

INSERT INTO #__migrator_versions (`version`,`component`) VALUES(4, 'tester') ON DUPLICATE KEY UPDATE `version` = 4;
