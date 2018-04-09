CREATE TABLE IF NOT EXISTS `#__tester_milestones` (
  `tester_milestone_id` bigint(20) NOT NULL auto_increment,
  `node_id` bigint(11) NOT NULL,
  `testerlists_count` int(11),
  PRIMARY KEY  (`tester_milestone_id`)
) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`;

CREATE TABLE IF NOT EXISTS `#__tester_testerlists` (
  `tester_testerlist_id` bigint(20) NOT NULL auto_increment,
  `node_id` bigint(11) NOT NULL,
  `tester_count` int(11) NOT NULL,
  `open_tester_count` int(11) NOT NULL,
  PRIMARY KEY  (`tester_testerlist_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`;

CREATE TABLE IF NOT EXISTS `#__tester_tester` (
  `tester_tester_id` bigint(20) NOT NULL auto_increment,
  `node_id` bigint(11) NOT NULL,
  `open_status_change_time` datetime,
  `open_status_change_by` bigint(11),
  PRIMARY KEY  (`tester_tester_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`;
