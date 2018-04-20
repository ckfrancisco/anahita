-- --------------------------------------------------------

CREATE TABLE `#__interests_interests` (
  `interests_interests_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `node_id` bigint(11) NOT NULL,
  `interest` varchar(50) DEFAULT NULL,
  `people_person_id` bigint(11) NOT NULL,
  /*`open_status_change_time` datetime NOT NULL,
  `open_status_change_by` bigint(11) DEFAULT NULL,*/
  PRIMARY KEY (`interests_interests_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB;

INSERT INTO #__migrator_versions (`version`,`component`) VALUES(4, 'interests') ON DUPLICATE KEY UPDATE `version` = 4; /*--Jerdon Helgeson--*/
