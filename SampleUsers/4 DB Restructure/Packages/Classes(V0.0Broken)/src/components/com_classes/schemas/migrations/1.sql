/*

CREATE TABLE IF NOT EXISTS `#__classes_milestones` (
  `classes_milestone_id` bigint(20) NOT NULL auto_increment,
  `node_id` bigint(11) NOT NULL,
  `classlists_count` int(11),
  PRIMARY KEY  (`classes_milestone_id`)
) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`;

CREATE TABLE IF NOT EXISTS `#__classes_classlists` (
  `classes_classlist_id` bigint(20) NOT NULL auto_increment,
  `node_id` bigint(11) NOT NULL,
  `classes_count` int(11) NOT NULL,
  `open_classes_count` int(11) NOT NULL,
  PRIMARY KEY  (`classes_classlist_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`;

CREATE TABLE IF NOT EXISTS `#__classes_classes` (
  `classes_class_id` bigint(20) NOT NULL auto_increment,
  `node_id` bigint(11) NOT NULL,
  `open_status_change_time` datetime,
  `open_status_change_by` bigint(11),
  PRIMARY KEY  (`classes_class_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`;

*/