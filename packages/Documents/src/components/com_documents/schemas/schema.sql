
INSERT INTO #__migrator_versions (`version`,`component`) VALUES(1, 'documents') ON DUPLICATE KEY UPDATE `version` = 1;