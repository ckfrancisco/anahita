CREATE TABLE `#__jobs_jobs` (
  `jobs_job_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `node_id` bigint(11) NOT NULL,
  `link` text,
  `location` char(255),
  `employment` char(255),
  `visa` char(255),
  `post_date` date,
  `start_date` date,
  `majors` text,
  PRIMARY KEY (`jobs_job_id`),
  UNIQUE KEY `node_id` (`node_id`)
) ENGINE=InnoDB;

INSERT INTO #__migrator_versions (`version`,`component`) VALUES(4, 'jobs') ON DUPLICATE KEY UPDATE `version` = 1;