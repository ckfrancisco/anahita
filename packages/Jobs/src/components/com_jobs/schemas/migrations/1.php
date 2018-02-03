<?php

/**
 * LICENSE: GPLv3
 */

/**
 * Schema Migration.
 */
class ComJobsSchemaMigration1 extends ComMigratorMigrationVersion
{
    /**
     * Called when migrating up.
     */
    public function up()
    {
        //add your migration here
        dbexec("UPDATE `#__nodes` SET filename = CONCAT(MD5(id),'.jpg') WHERE type LIKE '%com:jobs.domain.entity.job%' AND filename = ''");
        dbexec("UPDATE `#__nodes` SET name='job_add' WHERE name='new_job' AND component='com_jobs'");
    }

    /**
     * Called when rolling back a migration.
     */
    public function down()
    {
        //add your migration here
    }
}
