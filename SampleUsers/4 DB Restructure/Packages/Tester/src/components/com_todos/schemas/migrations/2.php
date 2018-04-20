<?php

/**
 * LICENSE: ##LICENSE##.
 */

/**
 * Schema Migration.
 */
class ComTesterSchemaMigration2 extends ComMigratorMigrationVersion
{
    /**
     * Called when migrating up.
     */
    public function up()
    {
        $timeThen = microtime(true);

        dbexec('DELETE FROM `#__nodes` WHERE `type` LIKE \'%ComBaseDomainEntityComment%\' AND `parent_type` = \'com:tester.domain.entity.milestone\' ');

        dbexec('DELETE FROM `#__nodes` WHERE `type` LIKE \'%com:tester.domain.entity.milestone\' ');

        dbexec('DELETE FROM `#__edges` WHERE `node_b_type` LIKE \'%com:tester.domain.entity.milestone\' ');

        dbexec('DROP TABLE #__tester_milestones');

        /*
        //clearing testerlists from the data
        $testerlists = dbfetch('SELECT `id`, `parent_id`, `alias` FROM `#__nodes` WHERE `type` LIKE \'%com:tester.domain.entity.testerlist\' ');

        foreach ($testerlists as $testerlist) {
            $terms = explode('-', $testerlist['alias']);
            foreach ($terms as $index => $value) {
                if (strlen($value) < 3) {
                    unset($terms[$index]);
                }
            }

            $tester = KService::get('com:tester.domain.entity.tester')
                    ->getRepository()
                    ->getQuery()
                    ->disableChain()
                    ->where('parent_id = '.$testerlist['id'])
                    ->fetchSet();

            foreach ($tester as $tester) {
                foreach ($terms as $term) {
                    if (strlen($term) > 3) {
                        dboutput($term.', ');
                        $tester->set('parent_id', 0)->set('description', $tester->description.' #'.trim($term))->addHashtag($term)->save();
                    }
                }
            }
        }
        */

        dbexec('DELETE FROM `#__nodes` WHERE `type` LIKE \'%com:tester.domain.entity.testerlist\' ');

        //clear stories
        dbexec('DELETE FROM `#__nodes` WHERE `story_object_type` = \'com:tester.domain.entity.testerlist\' OR `story_object_type` = \'com:tester.domain.entity.milestone\' ');

        dbexec('DROP TABLE #__tester_testerlists');

        $timeDiff = microtime(true) - $timeThen;
        dboutput("TIME: ($timeDiff)"."\n");
    }

    /**
     * Called when rolling back a migration.
     */
    public function down()
    {
        //add your migration here
    }
}
