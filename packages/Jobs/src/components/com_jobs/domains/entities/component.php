<?php

/**
 * Component object.
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComJobsDomainEntityComponent extends ComMediumDomainEntityComponent
{
    /**
     * Initializes the default configuration for the object.
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param KConfig $config An optional KConfig object with configuration options.
     */
    protected function _initialize(KConfig $config)
    {
        $config->append(array(
            'story_aggregation' => array('job_add' => 'target'),
            'behaviors' => array(
                    'scopeable' => array('class' => 'ComJobsDomainEntityJob'),
                    'hashtagable' => array('class' => 'ComJobsDomainEntityJob'),
                ),
        ));

        parent::_initialize($config);
    }

    /**
     * {@inheritdoc}
     */
    protected function _setGadgets($actor, $gadgets, $mode)
    {
        if ($mode == 'profile') {
            $gadgets->insert('jobs', array(
                    'title' => AnTranslator::_('COM-JOBS-GADGET-ACTOR-PROFILE'),
                    'url' => 'option=com_jobs&view=jobs&layout=gadget&oid='.$actor->uniqueAlias,
                    'action' => AnTranslator::_('LIB-AN-GADGET-VIEW-ALL'),
                    'action_url' => 'option=com_jobs&view=jobs&oid='.$actor->id,
            ));
        } else {
            $gadgets->insert('jobs', array(
                    'title' => AnTranslator::_('COM-JOBS-GADGET-DASHBOARD'),
                    'url' => 'option=com_jobs&view=jobs&layout=gadget&filter=leaders',
                    'action' => AnTranslator::_('LIB-AN-GADGET-VIEW-ALL'),
                    'action_url' => 'option=com_jobs&view=jobs&filter=leaders',
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function _setComposers($actor, $composers, $mode)
    {
        if ($actor->authorize('action', 'com_jobs:job:add')) {
            $composers->insert('job-composer', array(
                    'title' => AnTranslator::_('COM-JOBS-COMPOSER-JOB'),
                    'placeholder' => AnTranslator::_('COM-JOBS-JOB-ADD'),
                    'url' => 'option=com_jobs&view=job&layout=composer&oid='.$actor->id,
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function _setMenuLinks($actor, $menuItems)
    {
        $menuItems->insert('job-jobs', array(
            'title' => AnTranslator::_('COM-JOBS-MENU-ITEM-JOBS'),
            'url' => 'option=com_jobs&view=jobs&oid='.$actor->uniqueAlias,
        ));
    }
}
