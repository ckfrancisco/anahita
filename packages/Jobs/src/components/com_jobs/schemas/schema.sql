CREATE TABLE `#__jobs_jobs` (
  `jobs_job_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `node_id` bigint(11) NOT NULL,
  `link` text,
  `location` char(255),
  `employment` int(11),
  `visa` int(11),
  `post_date` char(255),
  `start_date` char(255),
  `majors` text,
  PRIMARY KEY (`jobs_job_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB;

INSERT INTO #__migrator_versions (`version`,`component`) VALUES(4, 'jobs') ON DUPLICATE KEY UPDATE `version` = 1;