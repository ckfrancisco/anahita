<?php

/**
 * LICENSE: ##LICENSE##.
 */

/**
 * Schema Migration.
 */
class ComClassesSchemaMigration2 extends ComMigratorMigrationVersion
{
    /**
     * Called when migrating up.
     */
    public function up()
    {
        $timeThen = microtime(true);

        dbexec('DELETE FROM `#__nodes` WHERE `type` LIKE \'%ComBaseDomainEntityComment%\' AND `parent_type` = \'com:classes.domain.entity.milestone\' ');

        dbexec('DELETE FROM `#__nodes` WHERE `type` LIKE \'%com:classes.domain.entity.milestone\' ');

        dbexec('DELETE FROM `#__edges` WHERE `node_b_type` LIKE \'%com:classes.domain.entity.milestone\' ');

        dbexec('DROP TABLE #__classes_milestones');

        /*
        //clearing classeslists from the data
        $classeslists = dbfetch('SELECT `id`, `parent_id`, `alias` FROM `#__nodes` WHERE `type` LIKE \'%com:classes.domain.entity.classeslist\' ');

        foreach ($classeslists as $classeslist) {
            $terms = explode('-', $classeslist['alias']);
            foreach ($terms as $index => $value) {
                if (strlen($value) < 3) {
                    unset($terms[$index]);
                }
            }

            $classes = KService::get('com:classes.domain.entity.classes')
                    ->getRepository()
                    ->getQuery()
                    ->disableChain()
                    ->where('parent_id = '.$classeslist['id'])
                    ->fetchSet();

            foreach ($classes as $classes) {
                foreach ($terms as $term) {
                    if (strlen($term) > 3) {
                        dboutput($term.', ');
                        $classes->set('parent_id', 0)->set('description', $classes->description.' #'.trim($term))->addHashtag($term)->save();
                    }
                }
            }
        }
        */

        dbexec('DELETE FROM `#__nodes` WHERE `type` LIKE \'%com:classes.domain.entity.classeslist\' ');

        //clear stories
        dbexec('DELETE FROM `#__nodes` WHERE `story_object_type` = \'com:classes.domain.entity.classeslist\' OR `story_object_type` = \'com:classes.domain.entity.milestone\' ');

        dbexec('DROP TABLE #__classes_classeslists');

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
