<?php

/**
 * Document Toolbar.
 *
 * @category   Sparq
 *
 * @author     Peter QAfoku
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComDocumentsControllerToolbarDocument extends ComMediumControllerToolbarDefault
{
    /**
     * Set the toolbar commands.
     */
    public function addToolbarCommands()
    {
        $entity = $this->getController()->getItem();

        if ($entity->authorize('vote')) {
            $this->addCommand('vote');
        }

        if ($entity->owner->authorize('administration')) {
            $this->addCommand('OpenSetSelector', AnTranslator::_('COM-DOCUMENTS-ACTION-ADD-TO-SET'))
                ->getCommand('OpenSetSelector')
                ->href(route('option=com_documents&view=sets&layout=selector&oid='.$entity->owner->id.'&document_id='.$entity->id))
                ->class('visible-desktop');

            $this->addAdministrationCommands();
        }

        if ($entity->authorize('subscribe') || $entity->subscribed(get_viewer())) {
            $this->addCommand('subscribe');
        }

        if ($entity->authorize('delete')) {
            $this->addCommand('delete');
        }
    }

    /**
     * Called before list commands.
     */
    public function addListCommands()
    {
        $entity = $this->getController()->getItem();

        if ($entity->authorize('vote')) {
            $this->addCommand('vote');
        }

        if ($entity->authorize('delete')) {
            $this->addCommand('delete');
        }

        if ($entity->authorize('edit')) {
          $this->addCommand('view', AnTranslator::_('LIB-AN-MEDIUM-VIEW'))
               ->getCommand('view')
               ->href(route($entity->getURL()));
        }
    }
}
