CREATE TABLE `#__jobs_jobs` (
  `jobs_job_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `node_id` bigint(11) NOT NULL,
  `link` text,
  `startdate` varchar(16),
  `location` varchar(255),
  `employment` varchar(255),
  `visa` varchar(255),
  `majors` text,
  PRIMARY KEY (`jobs_job_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB;

INSERT INTO #__migrator_versions (`version`,`component`) VALUES(4, 'jobs') ON DUPLICATE KEY UPDATE `version` = 1;