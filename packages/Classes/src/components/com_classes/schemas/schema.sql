-- --------------------------------------------------------

CREATE TABLE `#__classes_classes` (
  `classes_classes_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `node_id` bigint(11) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `people_person_id` bigint(11) NOT NULL,
  `open_status_change_time` datetime NOT NULL,
  `open_status_change_by` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`classes_classes_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB;

INSERT INTO #__migrator_versions (`version`,`component`) VALUES(6, 'classes') ON DUPLICATE KEY UPDATE `version` = 4; /*--Jerdon Helgeson--*/
