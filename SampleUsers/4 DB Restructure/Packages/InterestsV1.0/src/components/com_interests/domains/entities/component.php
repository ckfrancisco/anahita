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
class ComInterestsDomainEntityComponent extends ComMediumDomainEntityComponent
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
            'story_aggregation' => array('interests_disable,interests_add,interests_enable' => 'target'),
            'behaviors' => array(
                    'scopeable' => array('class' => 'ComInterestsDomainEntityInterests'),
                    'hashtagable' => array('class' => 'ComInterestsDomainEntityInterests'),
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
            $gadgets->insert('interests-gadget-profile-interests', array(
                'title' => AnTranslator::_('COM-INTERESTS-GADGET-ACTOR-INTERESTS'),
                'url' => 'option=com_interests&view=interests&layout=gadget&oid='.$actor->id,
                'action' => AnTranslator::_('LIB-AN-GADGET-VIEW-ALL'),
                'action_url' => 'option=com_interests&view=interests&oid='.$actor->id,
            ));
        } else {
            $gadgets->insert('interests-gadget-profile-interests', array(
                'title' => AnTranslator::_('COM-INTERESTS-GADGET-DASHBOARD-INTERESTS'),
                'url' => 'option=com_interests&view=interests&layout=gadget&filter=leaders',
                'action' => AnTranslator::_('LIB-AN-GADGET-VIEW-ALL'),
                'action_url' => 'option=com_interests&view=interests&filter=leaders',
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function _setComposers($actor, $composers, $mode)
    {
        if ($actor->authorize('action', 'com_interests:interests:add')) {
            $composers->insert('interests-composer', array(
                'title' => AnTranslator::_('COM-INTERESTS-COMPOSER-INTERESTS'),
                'placeholder' => AnTranslator::_('COM-INTERESTS-INTERESTS-ADD'),
                'url' => 'option=com_interests&view=interests&layout=composer&oid='.$actor->id,
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function _setMenuLinks($actor, $menuItems)
    {
        $menuItems->insert('interests-interests', array(
            'title' => AnTranslator::_('COM-INTERESTS-MENU-ITEM-INTERESTS'),
            'url' => 'option=com_interests&view=interests&oid='.$actor->uniqueAlias,
        ));
    }
}
