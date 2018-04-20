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
class ComClassesControllerToolbarActorbar extends ComMediumControllerToolbarActorbar
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

        $data = $event->data;
        $viewer = get_viewer();
        $actor = pick($this->getController()->actor, $viewer);
        $layout = pick($this->getController()->layout, 'default');
        $name = $this->getController()->getIdentifier()->name;

        $this->setTitle(AnTranslator::sprintf('COM-CLASSES-ACTOR-HEADER-'.strtoupper($name).'S', $actor->name));

        //create navigations
        $this->addNavigation('Classes', AnTranslator::_('COM-CLASSES-LINK-CLASSES'), array(
          'option' => 'com_Classes',
          'view' => 'Classes',
          'oid' => $actor->id, ), $name == 'CLASS');
    }
}
