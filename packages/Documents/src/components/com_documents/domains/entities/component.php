<?php

/**
 * Component object.
 *
 * @category   Sparq
 *
 * @author     Peter Qafoku
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComDocumentsDomainEntityComponent extends ComMediumDomainEntityComponent
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
            'story_aggregation' => array('document_add' => 'target'),
            'behaviors' => array(
                    'scopeable' => array('class' => 'ComDocumentsDomainEntityDocument'),
                    'hashtagable' => array('class' => 'ComDocumentsDomainEntityDocument'),
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
            $gadgets->insert('documents', array(
                    'title' => AnTranslator::_('COM-DOCUMENTS-GADGET-ACTOR-PROFILE'),
                    'url' => 'option=com_documents&view=documents&layout=gadget&oid='.$actor->uniqueAlias,
                    'action' => AnTranslator::_('LIB-AN-GADGET-VIEW-ALL'),
                    'action_url' => 'option=com_documents&view=documents&oid='.$actor->id,
            ));
        } else {
            $gadgets->insert('documents', array(
                    'title' => AnTranslator::_('COM-DOCUMENTS-GADGET-DASHBOARD'),
                    'url' => 'option=com_documents&view=documents&layout=gadget&filter=leaders',
                    'action' => AnTranslator::_('LIB-AN-GADGET-VIEW-ALL'),
                    'action_url' => 'option=com_documents&view=documents&filter=leaders',
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function _setComposers($actor, $composers, $mode)
    {
        if ($actor->authorize('action', 'com_documents:document:add')) {
            $composers->insert('document-composer', array(
                    'title' => AnTranslator::_('COM-DOCUMENTS-COMPOSER-DOCUMENT'),
                    'placeholder' => AnTranslator::_('COM-DOCUMENTS-DOCUMENT-ADD'),
                    'url' => 'option=com_documents&view=document&layout=composer&oid='.$actor->id,
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function _setMenuLinks($actor, $menuItems)
    {
        $menuItems->insert('document-documents', array(
            'title' => AnTranslator::_('COM-DOCUMENTS-MENU-ITEM-DOCUMENTS'),
            'url' => 'option=com_documents&view=documents&oid='.$actor->uniqueAlias,
        ));
    }
}
