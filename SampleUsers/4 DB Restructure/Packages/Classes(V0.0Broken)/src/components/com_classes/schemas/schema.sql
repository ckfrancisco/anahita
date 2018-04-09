-- --------------------------------------------------------

-- --------------------------------------------------------/*--Jerdon Helgeson classes--*/
CREATE TABLE `#__classes` (    
    `people_person_id` SERIAL, 
    `class` varchar(50) DEFAULT NULL, 
    FOREIGN KEY('people_person_id') REFERENCES __people_people(`people_person_id`) 
) ENGINE=InnoDB;

INSERT INTO #__migrator_versions (`version`,`component`) VALUES(2, 'classes') ON DUPLICATE KEY UPDATE `version` = 4;

/*
CREATE TABLE `#__classes` (
  `classes_class_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `node_id` bigint(11) NOT NULL,
  `open_status_change_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `open_status_change_by` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`classes_class_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB;

INSERT INTO #__migrator_versions (`version`,`component`) VALUES(4, 'classes') ON DUPLICATE KEY UPDATE `version` = 4;
*/
