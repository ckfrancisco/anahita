CREATE TABLE IF NOT EXISTS `#__classes_milestones` (
  `classes_milestone_id` bigint(20) NOT NULL auto_increment,
  `node_id` bigint(11) NOT NULL,
  `classeslists_count` int(11),
  PRIMARY KEY  (`classes_milestone_id`)
) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`;

CREATE TABLE IF NOT EXISTS `#__classes_classeslists` (
  `classes_classeslist_id` bigint(20) NOT NULL auto_increment,
  `node_id` bigint(11) NOT NULL,
  `classes_count` int(11) NOT NULL,
  `open_classes_count` int(11) NOT NULL,
  PRIMARY KEY  (`classes_classeslist_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`;

CREATE TABLE IF NOT EXISTS `#__classes_classes` (
  `classes_classes_id` bigint(20) NOT NULL auto_increment,
  `node_id` bigint(11) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `people_person_id` bigint(11) NOT NULL
  `open_status_change_time` datetime,
  `open_status_change_by` bigint(11), /*--Jerdon Helgeson--*/
  PRIMARY KEY  (`classes_classes_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`;
