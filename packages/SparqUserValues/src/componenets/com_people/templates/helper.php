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
     * Displays selector for person usertypes.
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
    * Creates a HTML dropdown menue with the proper access to change account types
    **/
    // ------ Academic Types ------
    public function academictypes($options = array())
    {
        $viewer = get_viewer();
        $options = new KConfig($options);

        $options->append(array(
            'id' => 'person-academictype',
            'selected' => 'Student',
            'name' => 'academictype',
            'class' => 'input-block-level',
        ));

        $selected = $options->selected;

        unset($options->selected);

        // Instructors are the first allowed to modify Academic types
        $academictypes = array(
            //ComPeopleDomainEntityPerson::ACADEMICTYPE_NONE => AnTranslator::_('COM-PEOPLE-ACADEMICTYPE-NONE'), // None will only be encountered if the account is a company corporate type
            ComPeopleDomainEntityPerson::ACADEMICTYPE_STUDENT => AnTranslator::_('COM-PEOPLE-ACADEMICTYPE-STUDENT'),
            ComPeopleDomainEntityPerson::ACADEMICTYPE_TUTOR => AnTranslator::_('COM-PEOPLE-ACADEMICTYPE-TUTOR'),
        );
        if ($viewer->academicadmin()) {
            $academictypes[ComPeopleDomainEntityPerson::ACADEMICTYPE_INSTRUCTOR] = AnTranslator::_('COM-PEOPLE-ACADEMICTYPE-INSTRUCTOR');
        }
        if ($viewer->superadmin() || $viewer->admin()) {
            $academictypes[ComPeopleDomainEntityPerson::ACADEMICTYPE_INSTRUCTOR] = AnTranslator::_('COM-PEOPLE-ACADEMICTYPE-NONE');
            $academictypes[ComPeopleDomainEntityPerson::ACADEMICTYPE_NONE] = AnTranslator::_('COM-PEOPLE-ACADEMICTYPE-INSTRUCTOR');
            $academictypes[ComPeopleDomainEntityPerson::ACADEMICTYPE_ADMIN] = AnTranslator::_('COM-PEOPLE-ACADEMICTYPE-ADMIN');
        } 

        $html = $this->getService('com:base.template.helper.html');

        return $html->select($options->name, array('options' => $academictypes, 'selected' => $selected), KConfig::unbox($options));
    }
    // ------ Corporate Accounts ------
	public function corporatetypes($options = array())
    {
        $viewer = get_viewer();
        $options = new KConfig($options);

        $options->append(array(
            'id' => 'person-corporatetype',
            'selected' => 'None',
            'name' => 'corporatetype',
            'class' => 'input-block-level',
        ));

        $selected = $options->selected;

        unset($options->selected);

        // Managers are the first allowed to modify corporate types
        $corporatetypes = array(
            ComPeopleDomainEntityPerson::CORPORATETYPE_NONE => AnTranslator::_('COM-PEOPLE-CORPORATETYPE-NONE'),
            ComPeopleDomainEntityPerson::CORPORATETYPE_RECRUITER => AnTranslator::_('COM-PEOPLE-CORPORATETYPE-RECRUITER'),
            //ComPeopleDomainEntityPerson::CORPORATETYPE_MANAGER => AnTranslator::_('COM-PEOPLE-CORPORATETYPE-MANAGER'),
        );

       if ($viewer->company()) {
            $corporatetypes[ComPeopleDomainEntityPerson::CORPORATETYPE_MANAGER] = AnTranslator::_('COM-PEOPLE-CORPORATETYPE-MANAGER');
        }
        if ($viewer->superadmin() || $viewer->admin()) {
            $corporatetypes[ComPeopleDomainEntityPerson::CORPORATETYPE_MANAGER] = AnTranslator::_('COM-PEOPLE-CORPORATETYPE-MANAGER');
            $corporatetypes[ComPeopleDomainEntityPerson::CORPORATETYPE_COMPANY] = AnTranslator::_('COM-PEOPLE-CORPORATETYPE-COMPANY');
        } 

        $html = $this->getService('com:base.template.helper.html');

        return $html->select($options->name, array('options' => $corporatetypes, 'selected' => $selected), KConfig::unbox($options));
    }
}
