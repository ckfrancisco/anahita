<?php

/**
 * Actorbar.
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComJobsControllerToolbarActorbar extends ComMediumControllerToolbarActorbar
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
            $this->setTitle(AnTranslator::sprintf('COM-JOBS-UPLOAD-JOBS', $actor->name));
        } else {
            $this->setTitle(AnTranslator::sprintf('COM-JOBS-HEADER-ACTOR-JOBS', $actor->name));
        }

        //create navigations
        $this->addNavigation('jobs',
            AnTranslator::_('COM-JOBS-LINKS-JOBS'),
            array('option' => 'com_jobs', 'view' => 'jobs', 'oid' => $actor->uniqueAlias),
            $name == 'job' && (in_array($layout, array('default', 'add', 'masonry'))));
    }
}
