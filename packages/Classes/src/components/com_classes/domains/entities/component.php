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
class ComClassesDomainEntityComponent extends ComMediumDomainEntityComponent
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
            'story_aggregation' => array('classes_disable,classes_add,classes_enable' => 'target'),
            'behaviors' => array(
                    'scopeable' => array('class' => 'ComClassesDomainEntityClasses'),
                    'hashtagable' => array('class' => 'ComClassesDomainEntityClasses'),
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
            $gadgets->insert('classes-gadget-profile-classes', array(
                'title' => AnTranslator::_('COM-CLASSES-GADGET-ACTOR-CLASSES'),
                'url' => 'option=com_classes&view=classes&layout=gadget&oid='.$actor->id,
                'action' => AnTranslator::_('LIB-AN-GADGET-VIEW-ALL'),
                'action_url' => 'option=com_classes&view=classes&oid='.$actor->id,
            ));
        } else {
            $gadgets->insert('classes-gadget-profile-classes', array(
                'title' => AnTranslator::_('COM-CLASSES-GADGET-DASHBOARD-CLASSES'),
                'url' => 'option=com_classes&view=classes&layout=gadget&filter=leaders',
                'action' => AnTranslator::_('LIB-AN-GADGET-VIEW-ALL'),
                'action_url' => 'option=com_classes&view=classes&filter=leaders',
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function _setComposers($actor, $composers, $mode)
    {
        if ($actor->authorize('action', 'com_classes:classes:add')) {
            $composers->insert('classes-composer', array(
                'title' => AnTranslator::_('COM-CLASSES-COMPOSER-CLASSES'),
                'placeholder' => AnTranslator::_('COM-CLASSES-CLASSES-ADD'),
                'url' => 'option=com_classes&view=classes&layout=composer&oid='.$actor->id,
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function _setMenuLinks($actor, $menuItems)
    {
        $menuItems->insert('classes-classes', array(
            'title' => AnTranslator::_('COM-CLASSES-MENU-ITEM-CLASSES'),
            'url' => 'option=com_classes&view=classes&oid='.$actor->uniqueAlias,
        ));
    }
}
