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
        //clearing classlists from the data
        $classlists = dbfetch('SELECT `id`, `parent_id`, `alias` FROM `#__nodes` WHERE `type` LIKE \'%com:classes.domain.entity.classlist\' ');

        foreach ($classlists as $classlist) {
            $terms = explode('-', $classlist['alias']);
            foreach ($terms as $index => $value) {
                if (strlen($value) < 3) {
                    unset($terms[$index]);
                }
            }

            $classes = KService::get('com:classes.domain.entity.class')
                    ->getRepository()
                    ->getQuery()
                    ->disableChain()
                    ->where('parent_id = '.$classlist['id'])
                    ->fetchSet();

            foreach ($classes as $class) {
                foreach ($terms as $term) {
                    if (strlen($term) > 3) {
                        dboutput($term.', ');
                        $class->set('parent_id', 0)->set('description', $class->description.' #'.trim($term))->addHashtag($term)->save();
                    }
                }
            }
        }
        */

        dbexec('DELETE FROM `#__nodes` WHERE `type` LIKE \'%com:classes.domain.entity.classlist\' ');

        //clear stories
        dbexec('DELETE FROM `#__nodes` WHERE `story_object_type` = \'com:classes.domain.entity.classlist\' OR `story_object_type` = \'com:classes.domain.entity.milestone\' ');

        dbexec('DROP TABLE #__classes_classlists');

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
