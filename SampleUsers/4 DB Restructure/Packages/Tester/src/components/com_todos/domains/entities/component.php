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
class ComTesterDomainEntityComponent extends ComMediumDomainEntityComponent
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
            'story_aggregation' => array('tester_disable,tester_add,tester_enable' => 'target'),
            'behaviors' => array(
                    'scopeable' => array('class' => 'ComTesterDomainEntityTester'),
                    'hashtagable' => array('class' => 'ComTesterDomainEntityTester'),
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
            $gadgets->insert('tester-gadget-profile-tester', array(
                'title' => AnTranslator::_('COM-TESTER-GADGET-ACTOR-TESTER'),
                'url' => 'option=com_tester&view=tester&layout=gadget&oid='.$actor->id,
                'action' => AnTranslator::_('LIB-AN-GADGET-VIEW-ALL'),
                'action_url' => 'option=com_tester&view=tester&oid='.$actor->id,
            ));
        } else {
            $gadgets->insert('tester-gadget-profile-tester', array(
                'title' => AnTranslator::_('COM-TESTER-GADGET-DASHBOARD-TESTER'),
                'url' => 'option=com_tester&view=tester&layout=gadget&filter=leaders',
                'action' => AnTranslator::_('LIB-AN-GADGET-VIEW-ALL'),
                'action_url' => 'option=com_tester&view=tester&filter=leaders',
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function _setComposers($actor, $composers, $mode)
    {
        if ($actor->authorize('action', 'com_tester:tester:add')) {
            $composers->insert('tester-composer', array(
                'title' => AnTranslator::_('COM-TESTER-COMPOSER-TESTER'),
                'placeholder' => AnTranslator::_('COM-TESTER-TESTER-ADD'),
                'url' => 'option=com_tester&view=tester&layout=composer&oid='.$actor->id,
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function _setMenuLinks($actor, $menuItems)
    {
        $menuItems->insert('tester-tester', array(
            'title' => AnTranslator::_('COM-TESTER-MENU-ITEM-TESTER'),
            'url' => 'option=com_tester&view=tester&oid='.$actor->uniqueAlias,
        ));
    }
}
