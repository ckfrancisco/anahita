ALTER TABLE `#__sessions` ADD `academictype` varchar(255);
ALTER TABLE `#__sessions` ADD `corporatetype` varchar(255);

ALTER TABLE `#__people_people` ADD `academictype` varchar(255);
ALTER TABLE `#__people_people` ADD `corporatetype` varchar(255);

/* Author: William Boston, Sparq: Phase 4
* Appends the academic and corporate types to the _people_people database
* as well as the _session for the running application
 */