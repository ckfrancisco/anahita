<?php

/**
 * LICENSE: GPLv3
 */

/**
 * Schema Migration.
 */
class ComDocumentsSchemaMigration1 extends ComMigratorMigrationVersion
{
    /**
     * Called when migrating up.
     */
    public function up()
    {
        //add your migration here
        dbexec("UPDATE `#__nodes` SET filename = CONCAT(MD5(id),'.jpg') WHERE type LIKE '%com:documents.domain.entity.document%' AND filename = ''");
        dbexec("UPDATE `#__nodes` SET name='document_add' WHERE name='new_document' AND component='com_documents'");
    }

    /**
     * Called when rolling back a migration.
     */
    public function down()
    {
        //add your migration here
    }
}
