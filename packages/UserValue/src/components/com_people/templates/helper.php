<?php

/**
 * People Template Helper.
 *
 * Provides methods to for rendering avatar/name for an actor
 *
 * @category   Anahita
 *
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComPeopleTemplateHelper extends KTemplateHelperAbstract
{
    /**
     * Return the list of enabled app links on an actor's profile.
     *
     * @param actor object ComActorsDomainEntityActor
     *
     * @return array LibBaseTemplateObjectContainer
     */
    public function viewerMenuLinks($actor)
    {
        $context = new KCommandContext();
        $context->menuItems = new LibBaseTemplateObjectContainer();
        $context->actor = $actor;
        $context->actor->components->registerEventDispatcher($this->getService('anahita:event.dispatcher'));
        $this->getService('anahita:event.dispatcher')->dispatchEvent('onMenuDisplay', $context);

        return $context->menuItems;
    }

    /**
     * Displays selector for person academictype.
     *
     * @param array of options
     *
     * @return html select
     */
    public function usertypes($options = array())
    {
        $viewer = get_viewer();
        $options = new KConfig($options);

        $options->append(array(
            'id' => 'person-userType',
            'selected' => 'registered',
            'name' => 'usertype',
            'class' => 'input-block-level',
        ));

        $selected = $options->selected;

        unset($options->selected);

        $usertypes = array(
            ComPeopleDomainEntityPerson::USERTYPE_REGISTERED => AnTranslator::_('COM-PEOPLE-USERTYPE-REGISTERED'),
            ComPeopleDomainEntityPerson::USERTYPE_ADMINISTRATOR => AnTranslator::_('COM-PEOPLE-USERTYPE-ADMINISTRATOR'),
        );

        if ($viewer->superadmin()) {
            $usertypes[ComPeopleDomainEntityPerson::USERTYPE_SUPER_ADMINISTRATOR] = AnTranslator::_('COM-PEOPLE-USERTYPE-SUPER-ADMINISTRATOR');
        }

        $html = $this->getService('com:base.template.helper.html');

        return $html->select($options->name, array('options' => $usertypes, 'selected' => $selected), KConfig::unbox($options));
    }


    /**
     * Displays selector for person corporatetype. ------- copied from above and modified by William
     *
     * @param array of options
     *
     * @return html select
     */
    public function academictype($options = array())
    {
        $viewer = get_viewer();
        $options = new KConfig($options);

        $options->append(array(
            'id' => 'person-academicType',
            'selected' => 'student',
            'name' => 'academictype',
            'class' => 'input-block-level',
        ));

        $selected = $options->selected;

        unset($options->selected);

        $academictypes = array(
            ComPeopleDomainEntityPerson::ACADEMICTYPE_STUDENT => @text('COM-PEOPLE-ACADEMICTYPE-STUDENT'),
            ComPeopleDomainEntityPerson::ACADEMICTYPE_RECRUITER => @text('COM-PEOPLE-ACADEMICTYPE-TUTOR'),
            ComPeopleDomainEntityPerson::ACADEMICTYPE_TEACHER => @text('COM-PEOPLE-ACADEMICTYPE-TEACHER'),
        );

        if ($viewer->superadmin()) {
            $academictypes[ComPeopleDomainEntityPerson::USERTYPE_SUPER_ADMINISTRATOR] = AnTranslator::_('COM-PEOPLE-USERTYPE-SUPER-ADMINISTRATOR');
        }

        $html = $this->getService('com:base.template.helper.html');

        return $html->select($options->name, array('options' => $academictypes, 'selected' => $selected), KConfig::unbox($options));
    }

	public function corporatetype($options = array())
    {
        $viewer = get_viewer();
        $options = new KConfig($options);

        $options->append(array(
            'id' => 'person-academicType',
            'selected' => 'student',
            'name' => 'academictype',
            'class' => 'input-block-level',
        ));

        $selected = $options->selected;

        unset($options->selected);

        $corporatetypes = array(
            ComPeopleDomainEntityPerson::CORPORATETYPE_NONE => @text('COM-PEOPLE-CORPORATETYPE-NONE'),
            ComPeopleDomainEntityPerson::CORPORATETYPE_RECRUITER => @text('COM-PEOPLE-CORPORATETYPE-RECRUITER'),
            ComPeopleDomainEntityPerson::CORPORATETYPE_EMPLOYER => @text('COM-PEOPLE-CORPORATETYPE-EMPLOYER'),
        );

        if ($viewer->superadmin()) {
            $corporatetypes[ComPeopleDomainEntityPerson::USERTYPE_SUPER_ADMINISTRATOR] = AnTranslator::_('COM-PEOPLE-USERTYPE-SUPER-ADMINISTRATOR');
        }

        $html = $this->getService('com:base.template.helper.html');

        return $html->select($options->name, array('options' => $corporatetypes, 'selected' => $selected), KConfig::unbox($options));
    }
}
