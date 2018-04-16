<?php

/**
 * LICENSE: ##LICENSE##.
 */

/**
 * Schema Migration.
 */
class ComInterestsSchemaMigration2 extends ComMigratorMigrationVersion
{
    /**
     * Called when migrating up.
     */
    public function up()
    {
        $timeThen = microtime(true);

        dbexec('DELETE FROM `#__nodes` WHERE `type` LIKE \'%ComBaseDomainEntityComment%\' AND `parent_type` = \'com:interests.domain.entity.milestone\' ');

        dbexec('DELETE FROM `#__nodes` WHERE `type` LIKE \'%com:interests.domain.entity.milestone\' ');

        dbexec('DELETE FROM `#__edges` WHERE `node_b_type` LIKE \'%com:interests.domain.entity.milestone\' ');

        dbexec('DROP TABLE #__interests_milestones');

        /*
        //clearing interestslists from the data
        $interestslists = dbfetch('SELECT `id`, `parent_id`, `alias` FROM `#__nodes` WHERE `type` LIKE \'%com:interests.domain.entity.interestslist\' ');

        foreach ($interestslists as $interestslist) {
            $terms = explode('-', $interestslist['alias']);
            foreach ($terms as $index => $value) {
                if (strlen($value) < 3) {
                    unset($terms[$index]);
                }
            }

            $interests = KService::get('com:interests.domain.entity.interests')
                    ->getRepository()
                    ->getQuery()
                    ->disableChain()
                    ->where('parent_id = '.$interestslist['id'])
                    ->fetchSet();

            foreach ($interests as $interests) {
                foreach ($terms as $term) {
                    if (strlen($term) > 3) {
                        dboutput($term.', ');
                        $interests->set('parent_id', 0)->set('description', $interests->description.' #'.trim($term))->addHashtag($term)->save();
                    }
                }
            }
        }
        */

        dbexec('DELETE FROM `#__nodes` WHERE `type` LIKE \'%com:interests.domain.entity.interestslist\' ');

        //clear stories
        dbexec('DELETE FROM `#__nodes` WHERE `story_object_type` = \'com:interests.domain.entity.interestslist\' OR `story_object_type` = \'com:interests.domain.entity.milestone\' ');

        dbexec('DROP TABLE #__interests_interestslists');

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
