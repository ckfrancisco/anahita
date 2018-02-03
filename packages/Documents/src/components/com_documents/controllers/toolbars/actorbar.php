<?php

/**
 * Actorbar.
 *
 * @category   Sparq
 *
 * @author     Peter Qafoku
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComDocumentsControllerToolbarActorbar extends ComMediumControllerToolbarActorbar
{
    /**
     * Before controller action.
     *
     * @param KEvent $event Event object
     *
     * @return string
     */
    public function onBeforeControllerGet(KEvent $event)
    {
        parent::onBeforeControllerGet($event);

        $viewer = $this->getController()->viewer;
        $actor = pick($this->getController()->actor, $viewer);
        $layout = pick($this->getController()->getRequest()->layout, 'default');
        $name = $this->getController()->getIdentifier()->name;

        //create title
        if ($layout == 'upload') {
            $this->setTitle(AnTranslator::sprintf('COM-DOCUMENTS-UPLOAD-DOCUMENTS', $actor->name));
        } elseif ($name == 'set') {
            $this->setTitle(AnTranslator::sprintf('COM-DOCUMENTS-HEADER-ACTOR-SETS', $actor->name));
        } else {
            $this->setTitle(AnTranslator::sprintf('COM-DOCUMENTS-HEADER-ACTOR-DOCUMENTS', $actor->name));
        }

        //create navigations
        $this->addNavigation('documents',
            AnTranslator::_('COM-DOCUMENTS-LINKS-DOCUMENTS'),
            array('option' => 'com_documents', 'view' => 'documents', 'oid' => $actor->uniqueAlias),
            $name == 'document' && (in_array($layout, array('default', 'add', 'masonry'))));

        if ($actor->documents->getTotal() > 0) {
            $this->addNavigation('sets', AnTranslator::_('COM-DOCUMENTS-LINKS-SETS'),
            array('option' => 'com_documents', 'view' => 'sets', 'oid' => $actor->uniqueAlias),
            $name == 'set' && in_array($layout, array('default', 'add', 'edit')));
        }
    }
}
