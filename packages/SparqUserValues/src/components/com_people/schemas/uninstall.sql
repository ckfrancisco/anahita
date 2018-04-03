ALTER TABLE `#__sessions` DROP `academictype` varchar(255);
ALTER TABLE `#__sessions` DROP `corporatetype` varchar(255);

ALTER TABLE `#__people_people` DROP `academictype` varchar(255);
ALTER TABLE `#__people_people` DROP `corporatetype` varchar(255);

/* Author: William Boston, Sparq: Phase 4
* Removes the academic and corporate types from the _people_people database. 
* as well as the _session for the running application
 */

/* Comment out the above contents for no data loss when uninstlling this package :) */