CREATE TABLE IF NOT EXISTS `#__interests_milestones` (
  `interests_milestone_id` bigint(20) NOT NULL auto_increment,
  `node_id` bigint(11) NOT NULL,
  `interestslists_count` int(11),
  PRIMARY KEY  (`interests_milestone_id`)
) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`;

CREATE TABLE IF NOT EXISTS `#__interests_interestslists` (
  `interests_interestslist_id` bigint(20) NOT NULL auto_increment,
  `node_id` bigint(11) NOT NULL,
  `interests_count` int(11) NOT NULL,
  `open_interests_count` int(11) NOT NULL,
  PRIMARY KEY  (`interests_interestslist_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`;

CREATE TABLE IF NOT EXISTS `#__interests_interests` (
  `interests_interests_id` bigint(20) NOT NULL auto_increment,
  `node_id` bigint(11) NOT NULL,
  `interest` varchar(50) DEFAULT NULL,
  `people_person_id` bigint(11) NOT NULL
  `open_status_change_time` datetime,
  `open_status_change_by` bigint(11),
  PRIMARY KEY  (`interests_interests_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`;
