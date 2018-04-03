<?php

/**
 * Person Controller.
 *
 * @category   Anahita
 *
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3
 *
 * @link       http://www.GetAnahita.com
 */
class ComSparqUserValuesControllerPerson extends ComActorsControllerDefault
{
    protected $_allowed_academic_types;
    protected $_allowed_corporate_types;

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
            'behaviors' => array(
                'validatable',
                'com:mailer.controller.behavior.mailer'
            ),
            'request' => array(
                'reset_password' => 0,
                'edit' => 'profile'
            )
        ));

        parent::_initialize($config);

        AnHelperArray::unsetValues($config->behaviors, 'ownable');

        $this->_allowed_user_types = array(
            ComPeopleDomainEntityPerson::USERTYPE_ADMINISTRATOR,
            ComPeopleDomainEntityPerson::USERTYPE_REGISTERED,
        );
        
        /*
        * Sparq: Phase 4
        * UserValues----------------- William
        */
        $this->_allowed_academic_types = array(
            ComPeopleDomainEntityPerson::ACADEMICTYPE_NONE,
            ComPeopleDomainEntityPerson::ACADEMICTYPE_STUDENT,
            ComPeopleDomainEntityPerson::ACADEMICTYPE_TUTOR,
            ComPeopleDomainEntityPerson::ACADEMICTYPE_INSTRUCTOR,
            ComPeopleDomainEntityPerson::ACADEMICTYPE_ADMIN,
        );

		$this->_allowed_corporate_types = array(
            ComPeopleDomainEntityPerson::CORPORATETYPE_NONE,
			ComPeopleDomainEntityPerson::CORPORATETYPE_RECRUITER,
            ComPeopleDomainEntityPerson::CORPORATETYPE_MANAGER,
            ComPeopleDomainEntityPerson::CORPORATETYPE_COMPANY,
        );

        $viewer = get_viewer();

        if ($viewer->superadmin()) {
            $this->_allowed_user_types[] = ComPeopleDomainEntityPerson::USERTYPE_SUPER_ADMINISTRATOR;
        }
    }

    /**
     * Edit a person's data and synchronize with the person with the user entity.
     *
     * @param KCommandContext $context Context parameter
     *
     * @return AnDomainEntityAbstract
     */
    protected function _actionEdit(KCommandContext $context)
    {
        $data = $context->data;

        dispatch_plugin('user.onBeforeEditPerson', array('data' => $context->data));

        //dont' set the usertype yet, until we find the conditions are met
        $usertype = null;
        $academictype = null;
        $corporatetype = null;

        if ($data->usertype) {
            $usertype = $data->usertype;
            unset($context->data->usertype);
        }
        if ($data->academictype) {
            $academictype = $data->academictype;
            unset($context->data->academictype);
        }
        if ($data->corporatetype) {
            $corporatetype = $data->corporatetype;
            unset($context->data->corporatetype);
        }

        if ($data->password) {
            $_SESSION['reset_password_prompt'] = 0;
        }

        $person = parent::_actionEdit($context);

        //add the validations here
        $this->getRepository()
        ->getValidator()
        ->addValidation('username', 'uniqueness')
        ->addValidation('email', 'uniqueness');

        if ($person->validate() === false) {
            throw new AnErrorException($person->getErrors(), KHttpResponse::BAD_REQUEST);
        }

        //now check to see if usertype can be set, otherwise the value is unchanged
        if (in_array($usertype, $this->_allowed_user_types) && $person->authorize('changeUsertype')) {
            $person->usertype = $usertype;
        }
        if (in_array($academictype, $this->_allowed_academic_types) && $person->authorize('changeUsertype')) {
            $person->academictype = $academictype;
        }
        if (in_array($corporatetype, $this->_allowed_corporate_types) && $person->authorize('changeUsertype')) {
            $person->corporatetype = $corporatetype;
        }

        $person->timestamp();

        dispatch_plugin('user.onAfterEditPerson', array('person' => $person));

        $this->setMessage('LIB-AN-PROMPT-UPDATE-SUCCESS', 'success');

        $edit = ($data->password && $data->username) ? 'account' : $this->_request->edit;
        $url = sprintf($person->getURL(false)."&get=settings&edit=%s", $edit);
        $context->response->setRedirect(route($url));

        return $person;
    }

    /**
     * Person add action creates a new person object.
     *
     * @param KCommandContext $context Commaind chain context
     *
     * @return AnDomainEntityAbstract
     */
    protected function _actionAdd(KCommandContext  $context)
    {
        $data = $context->data;

        dispatch_plugin('user.onBeforeAddPerson', array('data' => $context->data));

        $isFirstUser = !(bool) $this->getService('repos:people.person')
                                    ->getQuery(true)
                                    ->fetchValue('id');

        $person = parent::_actionAdd($context);

        $this->getRepository()
        ->getValidator()
        ->addValidation('username', 'uniqueness')
        ->addValidation('email', 'uniqueness');

        if ($person->validate() === false) {
            throw new AnErrorException($person->getErrors(), KHttpResponse::BAD_REQUEST);
        }

        $viewer = get_viewer();

        if ($isFirstUser) {
            $person->usertype = ComPeopleDomainEntityPerson::USERTYPE_SUPER_ADMINISTRATOR;
        } elseif ($viewer->admin() && in_array($data->usertype, $this->_allowed_user_types)) {
            $person->usertype = $data->usertype;
        } else {
            $person->usertype = ComPeopleDomainEntityPerson::USERTYPE_REGISTERED;
            $person->academictype = ComPeopleDomainEntityPerson::ACADEMICTYPE_STUDENT;
            $person->corporatetype = ComPeopleDomainEntityPerson::CORPORATETYPE_NONE;
        }

        dispatch_plugin('user.onAfterAddPerson', array('person' => $person));

        $redirectUrl = 'option=com_people';

        if ($isFirstUser) {
            $this->registerCallback('after.add', array($this, 'activateFirstAdmin'));
        } elseif ($viewer->admin()) {
            $redirectUrl .= '&view=people';
            if ($person->admin()) {
                $this->registerCallback('after.add', array($this, 'mailAdminsNewAdmin'));
            }
        } else {
            $redirectUrl .= '&view=session';
            $context->response->setHeader('X-User-Activation-Required', true);
            $this->setMessage(AnTranslator::sprintf('COM-PEOPLE-PROMPT-ACTIVATION-LINK-SENT', $person->name), 'success');
        }

        $context->response->setRedirect(route($redirectUrl));
        $context->response->status = 200;

        return $person;
    }
}
